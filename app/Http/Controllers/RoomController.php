<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Room::query()->latest())
                ->addColumn('type_label', fn (Room $room): string => $room->type_label)
                ->addColumn('status', function (Room $room): string {
                    $class = $room->is_active
                        ? 'bg-emerald-100 text-emerald-800'
                        : 'bg-zinc-100 text-zinc-700';
                    $label = $room->is_active ? 'Aktif' : 'Nonaktif';

                    return '<span class="rounded-full px-2.5 py-1 text-xs font-medium '.$class.'">'.$label.'</span>';
                })
                ->addColumn('action', function (Room $room): string {
                    $toggleRoute = $room->is_active
                        ? route('rooms.deactivate', $room)
                        : route('rooms.activate', $room);
                    $toggleClass = $room->is_active
                        ? 'bg-amber-600 hover:bg-amber-700'
                        : 'bg-emerald-600 hover:bg-emerald-700';
                    $toggleLabel = $room->is_active ? 'Deaktivasi' : 'Aktivasi';

                    return view('rooms._actions', compact('room', 'toggleRoute', 'toggleClass', 'toggleLabel'))->render();
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }

        return view('rooms.index');
    }

    public function create(): View
    {
        return view('rooms.create', [
            'room' => new Room(['type' => 3, 'is_active' => true]),
            'types' => Room::TYPES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Room::create($this->validatedData($request));

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Room $room): View
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room): View
    {
        return view('rooms.edit', [
            'room' => $room,
            'types' => Room::TYPES,
        ]);
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $room->update($this->validatedData($request));

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function activate(Room $room): RedirectResponse
    {
        $room->update(['is_active' => true]);

        return back()->with('success', 'Ruangan berhasil diaktifkan.');
    }

    public function deactivate(Room $room): RedirectResponse
    {
        $room->update(['is_active' => false]);

        return back()->with('success', 'Ruangan berhasil dinonaktifkan.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'integer', Rule::in(array_keys(Room::TYPES))],
            'descriptions' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}
