<x-layouts.app title="Tambah Device">
    <div class="mb-4">
        <h1 class="d-flex align-items-center gap-2 h3 mb-1 fw-semibold">
            <i data-lucide="cpu" class="text-success"></i>
            <span>Tambah Device</span>
        </h1>
        <p class="text-secondary mb-0">Masukkan data perangkat pemantauan suhu.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('devices.store') }}" method="POST">
                @include('devices._form')
            </form>
        </div>
    </div>
</x-layouts.app>
