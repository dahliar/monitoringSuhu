<x-layouts.app title="Tambah Device">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="cpu" class="h-6 w-6 text-emerald-700"></i>
            <span>Tambah Device</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Masukkan data perangkat pemantauan suhu.</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <form action="{{ route('devices.store') }}" method="POST">
            @include('devices._form')
        </form>
    </div>
</x-layouts.app>
