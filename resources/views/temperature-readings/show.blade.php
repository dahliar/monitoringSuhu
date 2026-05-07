<x-layouts.app title="Detail Data Suhu">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="thermometer" class="h-6 w-6 text-emerald-700"></i>
            <span>Detail Data Suhu</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">{{ $temperatureReading->device?->nama ?? 'Device tidak ditemukan' }}</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 md:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-zinc-500">Device</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->device?->nama ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Ruangan</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->device?->room?->name ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Tipe</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->device?->room?->type_label ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Suhu</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->temperature }} C</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Status</dt>
                <dd class="mt-1">
                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium {{ $temperatureReading->temperature_status_class }}">
                        <i data-lucide="{{ $temperatureReading->temperature_status === 'Aman' ? 'circle-check' : 'circle-alert' }}" class="h-3 w-3"></i>
                        {{ $temperatureReading->temperature_status }}
                    </span>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Batas Minimal</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->device?->minTemperature ?? '-' }} C</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Batas Maksimal</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->device?->maxTemperature ?? '-' }} C</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Waktu Record</dt>
                <dd class="mt-1 text-zinc-900">{{ $temperatureReading->recorded_at?->format('d M Y H:i:s') ?? '-' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-zinc-500">Metadata</dt>
                <dd class="mt-1">
                    <pre class="overflow-x-auto rounded-md bg-zinc-50 p-4 text-sm text-zinc-800">{{ json_encode($temperatureReading->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: '-' }}</pre>
                </dd>
            </div>
        </dl>

        <div class="mt-8">
            <a href="{{ route('temperature-readings.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</x-layouts.app>
