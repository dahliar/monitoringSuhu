<x-layouts.app title="Detail Data Suhu">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="thermometer" class="text-success"></i>
            <span>Detail Data Suhu</span>
        </h1>
        <p class="text-muted mb-0">{{ $temperatureReading->device?->nama ?? 'Device tidak ditemukan' }}</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row g-3 mb-0">
                <div class="col-md-6">
                    <dt class="text-muted small">Device</dt>
                    <dd class="mb-0">{{ $temperatureReading->device?->nama ?? '-' }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Ruangan</dt>
                    <dd class="mb-0">{{ $temperatureReading->device?->room?->name ?? '-' }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Tipe</dt>
                    <dd class="mb-0">{{ $temperatureReading->device?->room?->type_label ?? '-' }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Suhu</dt>
                    <dd class="mb-0">{{ $temperatureReading->temperature }} C</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Status</dt>
                    <dd class="mb-0">
                        <span class="badge {{ $temperatureReading->temperature_status_class }}">
                            <i data-lucide="{{ $temperatureReading->temperature_status === 'Aman' ? 'circle-check' : 'circle-alert' }}"></i>
                            {{ $temperatureReading->temperature_status }}
                        </span>
                    </dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Batas Minimal</dt>
                    <dd class="mb-0">{{ $temperatureReading->device?->minTemperature ?? '-' }} C</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Batas Maksimal</dt>
                    <dd class="mb-0">{{ $temperatureReading->device?->maxTemperature ?? '-' }} C</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Waktu Record</dt>
                    <dd class="mb-0">{{ $temperatureReading->recorded_at?->format('d M Y H:i:s') ?? '-' }}</dd>
                </div>
                <div class="col-12">
                    <dt class="text-muted small">Metadata</dt>
                    <dd class="mb-0">
                        <pre class="bg-light border rounded p-3 mb-0 small">{{ json_encode($temperatureReading->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: '-' }}</pre>
                    </dd>
                </div>
            </dl>
        </div>
        <div class="card-footer bg-white border-0 pt-0">
            <a href="{{ route('temperature-readings.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i data-lucide="arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</x-layouts.app>
