<x-layouts.app title="Tambah Ruangan">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="door-open" class="h-6 w-6 text-emerald-700"></i>
            <span>Tambah Ruangan</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Masukkan data ruangan untuk penempatan device.</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <form action="{{ route('rooms.store') }}" method="POST">
            @include('rooms._form')
        </form>
    </div>
</x-layouts.app>
