<x-layouts.app title="Grafik Suhu">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="chart-line" class="text-success"></i>
            <span>Grafik Suhu</span>
        </h1>
        <p class="text-muted mb-0">Pergerakan suhu device dalam rentang maksimal 1 hari dengan interval 5 menit.</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4">
                    <label for="device_id" class="form-label">Device</label>
                    <select id="device_id" class="form-select" @disabled($devices->isEmpty())>
                        @forelse ($devices as $device)
                            <option value="{{ $device->id }}" @selected($defaultDevice?->id === $device->id)>
                                {{ $device->nama }}{{ $device->room ? ' - '.$device->room->name : '' }}
                            </option>
                        @empty
                            <option value="">Tidak ada device aktif</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label for="start_at" class="form-label">Waktu Mulai</label>
                    <input id="start_at" type="datetime-local" class="form-control" value="{{ $startAt->format('Y-m-d\TH:i') }}" @disabled($devices->isEmpty())>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label for="end_at" class="form-label">Waktu Akhir</label>
                    <input id="end_at" type="datetime-local" class="form-control" value="{{ $endAt->format('Y-m-d\TH:i') }}" @disabled($devices->isEmpty())>
                </div>
                <div class="col-lg-2 d-flex gap-2">
                    <button id="load-chart-button" type="button" class="btn btn-success d-inline-flex align-items-center gap-2" @disabled($devices->isEmpty())>
                        <i data-lucide="filter"></i>
                        <span>Tampilkan</span>
                    </button>
                    <button id="reset-chart-button" type="button" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" @disabled($devices->isEmpty())>
                        <i data-lucide="refresh-cw"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </div>
            <div id="chart-error" class="alert alert-danger mt-3 mb-0 d-none" role="alert"></div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Rata-rata</div>
                    <div id="summary-average" class="h4 mb-0">-</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Minimum</div>
                    <div id="summary-minimum" class="h4 mb-0">-</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Maksimum</div>
                    <div id="summary-maximum" class="h4 mb-0">-</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Data</div>
                    <div id="summary-total" class="h4 mb-0">-</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-2 mb-3">
                <div>
                    <h2 id="chart-title" class="h5 mb-1">Pergerakan Suhu</h2>
                    <div id="chart-subtitle" class="text-muted small">Interval data per 5 menit.</div>
                </div>
                <div class="d-flex align-items-center gap-3 small">
                    <span class="d-inline-flex align-items-center gap-2">
                        <span class="chart-legend-swatch bg-success"></span>
                        Suhu
                    </span>
                    <span class="d-inline-flex align-items-center gap-2">
                        <span class="chart-legend-swatch bg-danger"></span>
                        Batas device
                    </span>
                </div>
            </div>
            <div class="temperature-chart-frame">
                <canvas id="temperature-chart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartElement = document.getElementById('temperature-chart');
                const deviceInput = document.getElementById('device_id');
                const startInput = document.getElementById('start_at');
                const endInput = document.getElementById('end_at');
                const loadButton = document.getElementById('load-chart-button');
                const resetButton = document.getElementById('reset-chart-button');
                const errorElement = document.getElementById('chart-error');
                const defaultStart = @json($startAt->format('Y-m-d\TH:i'));
                const defaultEnd = @json($endAt->format('Y-m-d\TH:i'));

                if (!chartElement || !deviceInput || !deviceInput.value) {
                    return;
                }

                const chart = new Chart(chartElement, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [
                            {
                                label: 'Suhu',
                                data: [],
                                borderColor: '#198754',
                                backgroundColor: 'rgba(25, 135, 84, 0.12)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.25,
                                pointRadius: 0,
                                pointHitRadius: 10,
                                spanGaps: false,
                            },
                            {
                                label: 'Batas Minimum',
                                data: [],
                                borderColor: '#dc3545',
                                borderDash: [6, 6],
                                borderWidth: 1.5,
                                pointRadius: 0,
                                fill: false,
                            },
                            {
                                label: 'Batas Maksimum',
                                data: [],
                                borderColor: '#dc3545',
                                borderDash: [6, 6],
                                borderWidth: 1.5,
                                pointRadius: 0,
                                fill: false,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 0,
                                    autoSkip: true,
                                    maxTicksLimit: 12,
                                },
                                grid: {
                                    display: false,
                                },
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Suhu (C)',
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    title: function (items) {
                                        return items[0]?.label ?? '';
                                    },
                                    label: function (item) {
                                        if (item.raw === null) {
                                            return item.dataset.label + ': tidak ada data';
                                        }

                                        return item.dataset.label + ': ' + item.raw + ' C';
                                    },
                                },
                            },
                        },
                    },
                });

                function formatTemperature(value) {
                    return value === null || value === undefined ? '-' : Number(value).toFixed(2) + ' C';
                }

                function showError(message) {
                    errorElement.textContent = message;
                    errorElement.classList.remove('d-none');
                }

                function clearError() {
                    errorElement.textContent = '';
                    errorElement.classList.add('d-none');
                }

                function setLoading(isLoading) {
                    loadButton.disabled = isLoading;
                    resetButton.disabled = isLoading;
                    loadButton.querySelector('span').textContent = isLoading ? 'Memuat...' : 'Tampilkan';
                }

                async function loadChart() {
                    clearError();
                    setLoading(true);

                    const params = new URLSearchParams({
                        device_id: deviceInput.value,
                        start_at: startInput.value,
                        end_at: endInput.value,
                    });

                    try {
                        const response = await fetch('{{ route('temperature-readings.chart-data') }}?' + params.toString(), {
                            headers: {
                                Accept: 'application/json',
                            },
                        });
                        const payload = await response.json();

                        if (!response.ok) {
                            const errors = payload.errors ? Object.values(payload.errors).flat() : [];
                            throw new Error(errors[0] || payload.message || 'Grafik gagal dimuat.');
                        }

                        const labels = payload.series.labels;
                        const minLimit = payload.device.min_temperature;
                        const maxLimit = payload.device.max_temperature;

                        chart.data.labels = labels;
                        chart.data.datasets[0].data = payload.series.temperatures;
                        chart.data.datasets[1].data = labels.map(() => minLimit);
                        chart.data.datasets[2].data = labels.map(() => maxLimit);
                        chart.update();

                        document.getElementById('summary-average').textContent = formatTemperature(payload.summary.avg_temperature);
                        document.getElementById('summary-minimum').textContent = formatTemperature(payload.summary.min_temperature);
                        document.getElementById('summary-maximum').textContent = formatTemperature(payload.summary.max_temperature);
                        document.getElementById('summary-total').textContent = payload.summary.total_readings;
                        document.getElementById('chart-title').textContent = payload.device.name;
                        document.getElementById('chart-subtitle').textContent = (payload.device.room || 'Tanpa ruangan') + ' | interval data per 5 menit';
                    } catch (error) {
                        showError(error.message);
                    } finally {
                        setLoading(false);
                    }
                }

                loadButton.addEventListener('click', loadChart);
                deviceInput.addEventListener('change', loadChart);
                resetButton.addEventListener('click', function () {
                    startInput.value = defaultStart;
                    endInput.value = defaultEnd;
                    loadChart();
                });

                loadChart();
            });
        </script>
    @endpush
</x-layouts.app>
