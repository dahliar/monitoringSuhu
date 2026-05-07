<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\TemperatureReading;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    public function chart(): View
    {
        $devices = Device::query()
            ->with('room')
            ->orderBy('nama')
            ->get();

        $defaultDevice = $devices->first();
        $endAt = now();
        $startAt = $endAt->copy()->subDay();

        return view('temperature-readings.chart', compact('devices', 'defaultDevice', 'startAt', 'endAt'));
    }

    public function chartData(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'device_id' => ['required', 'integer', 'exists:devices,id'],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date'],
        ]);

        $endAt = isset($validated['end_at'])
            ? Carbon::parse($validated['end_at'])
            : now();
        $startAt = isset($validated['start_at'])
            ? Carbon::parse($validated['start_at'])
            : $endAt->copy()->subDay();

        if ($startAt->gt($endAt)) {
            throw ValidationException::withMessages([
                'start_at' => 'Waktu mulai tidak boleh lebih besar dari waktu akhir.',
            ]);
        }

        if ($startAt->diffInSeconds($endAt) > 86400) {
            throw ValidationException::withMessages([
                'end_at' => 'Rentang waktu grafik maksimal 1 hari.',
            ]);
        }

        $device = Device::query()
            ->with('room')
            ->findOrFail($validated['device_id']);

        $bucketExpression = 'FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(recorded_at) / 300) * 300)';

        $readings = TemperatureReading::query()
            ->selectRaw($bucketExpression.' as bucket_time')
            ->selectRaw('ROUND(AVG(temperature), 2) as temperature')
            ->where('device_id', $device->id)
            ->whereNotNull('recorded_at')
            ->whereBetween('recorded_at', [$startAt, $endAt])
            ->groupBy('bucket_time')
            ->orderBy('bucket_time')
            ->get()
            ->keyBy(fn (TemperatureReading $reading): string => Carbon::parse($reading->bucket_time)->format('Y-m-d H:i:00'));

        $labels = [];
        $temperatures = [];
        $timestamps = [];

        $cursor = $this->floorToFiveMinutes($startAt);
        $lastBucket = $this->floorToFiveMinutes($endAt);

        while ($cursor->lte($lastBucket)) {
            $bucketKey = $cursor->format('Y-m-d H:i:00');
            $reading = $readings->get($bucketKey);

            $labels[] = $cursor->format('H:i');
            $timestamps[] = $cursor->toIso8601String();
            $temperatures[] = $reading ? (float) $reading->temperature : null;

            $cursor->addMinutes(5);
        }

        $summary = TemperatureReading::query()
            ->where('device_id', $device->id)
            ->whereNotNull('recorded_at')
            ->whereBetween('recorded_at', [$startAt, $endAt])
            ->selectRaw('COUNT(*) as total_readings')
            ->selectRaw('ROUND(MIN(temperature), 2) as min_temperature')
            ->selectRaw('ROUND(MAX(temperature), 2) as max_temperature')
            ->selectRaw('ROUND(AVG(temperature), 2) as avg_temperature')
            ->first();

        return response()->json([
            'device' => [
                'id' => $device->id,
                'name' => $device->nama,
                'room' => $device->room?->name,
                'min_temperature' => $device->minTemperature !== null ? (float) $device->minTemperature : null,
                'max_temperature' => $device->maxTemperature !== null ? (float) $device->maxTemperature : null,
            ],
            'range' => [
                'start_at' => $startAt->toIso8601String(),
                'end_at' => $endAt->toIso8601String(),
            ],
            'series' => [
                'labels' => $labels,
                'timestamps' => $timestamps,
                'temperatures' => $temperatures,
            ],
            'summary' => [
                'total_readings' => (int) ($summary->total_readings ?? 0),
                'min_temperature' => $summary->min_temperature !== null ? (float) $summary->min_temperature : null,
                'max_temperature' => $summary->max_temperature !== null ? (float) $summary->max_temperature : null,
                'avg_temperature' => $summary->avg_temperature !== null ? (float) $summary->avg_temperature : null,
            ],
        ]);
    }

    public function show(TemperatureReading $temperatureReading): View
    {
        $temperatureReading->load(['device.room']);

        return view('temperature-readings.show', compact('temperatureReading'));
    }

    private function floorToFiveMinutes(Carbon $dateTime): Carbon
    {
        return $dateTime->copy()
            ->second(0)
            ->microsecond(0)
            ->minute((int) (floor($dateTime->minute / 5) * 5));
    }
}
