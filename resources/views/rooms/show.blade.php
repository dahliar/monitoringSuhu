<x-layouts.app title="Detail Ruangan">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="flex items-center gap-2 text-2xl font-semibold">
                <i data-lucide="door-open" class="h-6 w-6 text-emerald-700"></i>
                <span>Detail Ruangan</span>
            </h1>
            <p class="mt-1 text-sm text-zinc-600">{{ $room->name }}</p>
        </div>
        <a href="{{ route('rooms.edit', $room) }}" class="inline-flex w-fit items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
            <i data-lucide="pencil" class="h-4 w-4"></i>
            <span>Edit Ruangan</span>
        </a>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 md:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-zinc-500">Nama</dt>
                <dd class="mt-1 text-zinc-900">{{ $room->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Tipe</dt>
                <dd class="mt-1 text-zinc-900">{{ $room->type_label }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-zinc-500">Deskripsi</dt>
                <dd class="mt-1 text-zinc-900">{{ $room->descriptions ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Status</dt>
                <dd class="mt-1 text-zinc-900">{{ $room->is_active ? 'Aktif' : 'Nonaktif' }}</dd>
            </div>
        </dl>

        <div class="mt-8 flex gap-3">
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                <span>Kembali</span>
            </a>
            <form action="{{ $room->is_active ? route('rooms.deactivate', $room) : route('rooms.activate', $room) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex items-center gap-2 rounded-md px-5 py-2 text-sm font-medium text-white {{ $room->is_active ? 'bg-amber-600 hover:bg-amber-700' : 'bg-emerald-600 hover:bg-emerald-700' }}">
                    <i data-lucide="{{ $room->is_active ? 'power-off' : 'power' }}" class="h-4 w-4"></i>
                    <span>{{ $room->is_active ? 'Deaktivasi' : 'Aktivasi' }}</span>
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
