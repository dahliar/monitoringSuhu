<x-layouts.app title="Detail Device">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="d-flex align-items-center gap-2 h3 mb-1 fw-semibold">
                <i data-lucide="cpu" class="text-success"></i>
                <span>Detail Device</span>
            </h1>
            <p class="text-secondary mb-0">{{ $device->nama }}</p>
        </div>
        <a href="{{ route('devices.edit', $device) }}" class="btn btn-success d-inline-flex align-items-center gap-2">
            <i data-lucide="pencil"></i>
            <span>Edit Device</span>
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <dl class="row g-4 mb-0">
                <div class="col-md-6">
                    <dt class="text-secondary small">Nama</dt>
                    <dd class="mb-0 fw-medium">{{ $device->nama }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-secondary small">Jenis</dt>
                    <dd class="mb-0 fw-medium">{{ $device->jenis }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-secondary small">ID Room</dt>
                    <dd class="mb-0 fw-medium">{{ $device->room?->name ?? $device->idRoom }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-secondary small">Lokasi</dt>
                    <dd class="mb-0 fw-medium">{{ $device->lokasi }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-secondary small">Minimum Temperature</dt>
                    <dd class="mb-0 fw-medium">{{ $device->minTemperature }} C</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-secondary small">Maximum Temperature</dt>
                    <dd class="mb-0 fw-medium">{{ $device->maxTemperature }} C</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-secondary small">Status</dt>
                    <dd class="mb-0">{{ $device->is_active ? 'Aktif' : 'Nonaktif' }}</dd>
                </div>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                    <i data-lucide="arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <form action="{{ $device->is_active ? route('devices.deactivate', $device) : route('devices.activate', $device) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn {{ $device->is_active ? 'btn-warning' : 'btn-success' }} d-inline-flex align-items-center gap-2">
                        <i data-lucide="{{ $device->is_active ? 'power-off' : 'power' }}"></i>
                        <span>{{ $device->is_active ? 'Deaktivasi' : 'Aktivasi' }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
