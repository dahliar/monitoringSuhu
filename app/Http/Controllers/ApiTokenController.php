<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;
use Yajra\DataTables\Facades\DataTables;

class ApiTokenController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $tokens = PersonalAccessToken::query()
                ->with('tokenable')
                ->latest();

            return DataTables::eloquent($tokens)
                ->addColumn('owner', fn (PersonalAccessToken $token): string => $token->tokenable?->name ?? '-')
                ->addColumn('abilities_label', fn (PersonalAccessToken $token): string => implode(', ', $token->abilities ?? []))
                ->editColumn('last_used_at', fn (PersonalAccessToken $token): string => $token->last_used_at?->format('d M Y H:i') ?? '-')
                ->editColumn('created_at', fn (PersonalAccessToken $token): string => $token->created_at?->format('d M Y H:i') ?? '-')
                ->addColumn('action', fn (PersonalAccessToken $token): string => view('api-tokens._actions', compact('token'))->render())
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('api-tokens.index');
    }

    public function create(): View
    {
        return view('api-tokens.create', [
            'users' => User::where('is_active', true)->orderBy('name')->get(),
            'abilities' => $this->abilities(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'abilities' => ['required', 'array', 'min:1'],
            'abilities.*' => ['required', 'string', 'in:temperature:write'],
        ]);

        $user = User::findOrFail($data['user_id']);
        $plainTextToken = $user->createToken($data['name'], $data['abilities'])->plainTextToken;

        return redirect()
            ->route('api-tokens.index')
            ->with('api_token', $plainTextToken)
            ->with('success', 'API token berhasil dibuat.');
    }

    public function show(PersonalAccessToken $apiToken): View
    {
        $apiToken->load('tokenable');

        return view('api-tokens.show', compact('apiToken'));
    }

    public function destroy(PersonalAccessToken $apiToken): RedirectResponse
    {
        $apiToken->delete();

        return back()->with('success', 'API token berhasil dicabut.');
    }

    private function abilities(): array
    {
        return [
            'temperature:write' => 'Kirim data suhu',
        ];
    }
}
