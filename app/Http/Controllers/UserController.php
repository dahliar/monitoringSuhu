<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return DataTables::eloquent(User::query()->latest())
                ->addColumn('role_label', fn (User $user): string => ucfirst($user->role))
                ->addColumn('status', function (User $user): string {
                    $class = $user->is_active
                        ? 'bg-emerald-100 text-emerald-800'
                        : 'bg-zinc-100 text-zinc-700';
                    $label = $user->is_active ? 'Aktif' : 'Nonaktif';

                    return '<span class="rounded-full px-2.5 py-1 text-xs font-medium '.$class.'">'.$label.'</span>';
                })
                ->addColumn('action', function (User $user): string {
                    $toggleRoute = $user->is_active
                        ? route('users.deactivate', $user)
                        : route('users.activate', $user);
                    $toggleClass = $user->is_active
                        ? 'bg-amber-600 hover:bg-amber-700'
                        : 'bg-emerald-600 hover:bg-emerald-700';
                    $toggleLabel = $user->is_active ? 'Deaktivasi' : 'Aktivasi';

                    return view('users._actions', [
                        'user' => $user,
                        'toggleRoute' => $toggleRoute,
                        'toggleClass' => $toggleClass,
                        'toggleLabel' => $toggleLabel,
                        'disableToggle' => auth()->id() === $user->id,
                    ])->render();
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }

        return view('users.index');
    }

    public function create(): View
    {
        return view('users.create', ['user' => new User(['role' => 'viewer', 'is_active' => true])]);
    }

    public function store(Request $request): RedirectResponse
    {
        User::create($this->validatedData($request));

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($this->validatedData($request, $user));

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function activate(User $user): RedirectResponse
    {
        $user->update(['is_active' => true]);

        return back()->with('success', 'User berhasil diaktifkan.');
    }

    public function deactivate(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors(['user' => 'User yang sedang login tidak dapat dinonaktifkan.']);
        }

        $user->update(['is_active' => false]);

        return back()->with('success', 'User berhasil dinonaktifkan.');
    }

    private function validatedData(Request $request, ?User $user = null): array
    {
        $passwordRule = $user ? ['nullable', 'string', 'min:8', 'confirmed'] : ['required', 'string', 'min:8', 'confirmed'];

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'password' => $passwordRule,
            'role' => ['required', Rule::in(['admin', 'operator', 'viewer'])],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        return $data;
    }
}
