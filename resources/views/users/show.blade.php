<x-layouts.app title="Detail User">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="flex items-center gap-2 text-2xl font-semibold">
                <i data-lucide="user" class="h-6 w-6 text-emerald-700"></i>
                <span>Detail User</span>
            </h1>
            <p class="mt-1 text-sm text-zinc-600">{{ $user->name }}</p>
        </div>
        <a href="{{ route('users.edit', $user) }}" class="inline-flex w-fit items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
            <i data-lucide="pencil" class="h-4 w-4"></i>
            <span>Edit User</span>
        </a>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 md:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-zinc-500">Nama</dt>
                <dd class="mt-1 text-zinc-900">{{ $user->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Email</dt>
                <dd class="mt-1 text-zinc-900">{{ $user->email }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Role</dt>
                <dd class="mt-1 text-zinc-900">{{ ucfirst($user->role) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Status</dt>
                <dd class="mt-1 text-zinc-900">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</dd>
            </div>
        </dl>

        <div class="mt-8">
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

</x-layouts.app>
