<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DeviceController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Device::query()->with('room')->latest())
                ->addIndexColumn()
                ->addColumn('room_name', fn (Device $device): string => $device->room?->name ?? '-')
                ->editColumn('minTemperature', fn (Device $device): string => "{$device->minTemperature} C")
                ->editColumn('maxTemperature', fn (Device $device): string => "{$device->maxTemperature} C")
                ->addColumn('action', function (Device $device): string {
                    return view('devices._table_actions', compact('device'))->render();
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('devices.index');
    }

    public function create(): View
    {
        return view('devices.create', [
            'device' => new Device(['is_active' => true]),
            'rooms' => Room::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Device::create($this->validatedData($request));

        return redirect()->route('devices.index')->with('success', 'Device berhasil ditambahkan.');
    }

    public function show(Device $device): View
    {
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device): View
    {
        return view('devices.edit', [
            'device' => $device,
            'rooms' => Room::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Device $device): RedirectResponse
    {
        $device->update($this->validatedData($request));

        return redirect()->route('devices.index')->with('success', 'Device berhasil diperbarui.');
    }

    public function activate(Device $device): RedirectResponse
    {
        $device->update(['is_active' => true]);

        return back()->with('success', 'Device berhasil diaktifkan.');
    }

    public function deactivate(Device $device): RedirectResponse
    {
        $device->update(['is_active' => false]);

        return back()->with('success', 'Device berhasil dinonaktifkan.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'idRoom' => ['required', 'integer', 'exists:rooms,id'],
            'lokasi' => ['required', 'string', 'max:255'],
            'maxTemperature' => ['required', 'numeric', 'between:-99.99,999.99', 'gte:minTemperature'],
            'minTemperature' => ['required', 'numeric', 'between:-99.99,999.99'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}
