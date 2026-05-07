<?php

namespace App\Http\Controllers;

use App\Models\TemperatureReading;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class TemperatureReadingController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $query = TemperatureReading::query()
                ->with(['device.room'])
                ->latest('recorded_at')
                ->latest();

            if ($request->filled('start_date')) {
                $query->where('recorded_at', '>=', Carbon::parse($request->input('start_date'))->startOfDay());
            }

            if ($request->filled('end_date')) {
                $query->where('recorded_at', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
            }

            return DataTables::eloquent(
                $query
            )
                ->addIndexColumn()
                ->addColumn('device_name', fn (TemperatureReading $reading): string => $reading->device?->nama ?? '-')
                ->addColumn('room_name', fn (TemperatureReading $reading): string => $reading->device?->room?->name ?? '-')
                ->addColumn('type_label', fn (TemperatureReading $reading): string => $reading->device?->room?->type_label ?? '-')
                ->editColumn('temperature', fn (TemperatureReading $reading): string => "{$reading->temperature} C")
                ->addColumn('temperature_status', function (TemperatureReading $reading): string {
                    return '<span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium '.$reading->temperature_status_class.'">'
                        .'<i data-lucide="'.($reading->temperature_status === 'Aman' ? 'circle-check' : 'circle-alert').'" class="h-3 w-3"></i>'
                        .$reading->temperature_status
                        .'</span>';
                })
                ->editColumn('recorded_at', fn (TemperatureReading $reading): string => $reading->recorded_at?->format('d M Y H:i:s') ?? '-')
                ->addColumn('action', fn (TemperatureReading $reading): string => view('temperature-readings._actions', compact('reading'))->render())
                ->rawColumns(['temperature_status', 'action'])
                ->toJson();
        }

        return view('temperature-readings.index');
    }

    public function show(TemperatureReading $temperatureReading): View
    {
        $temperatureReading->load(['device.room']);

        return view('temperature-readings.show', compact('temperatureReading'));
    }
}
