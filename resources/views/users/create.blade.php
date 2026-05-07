<x-layouts.app title="Tambah User">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="user-plus" class="h-6 w-6 text-emerald-700"></i>
            <span>Tambah User</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Buat akses baru untuk aplikasi.</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <form action="{{ route('users.store') }}" method="POST">
            @include('users._form')
        </form>
    </div>
</x-layouts.app>
