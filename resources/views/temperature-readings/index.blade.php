<x-layouts.app title="Data Suhu">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="thermometer" class="text-success"></i>
            <span>Data Suhu</span>
        </h1>
        <p class="text-muted mb-0">Data suhu yang diterima dari perangkat IoT.</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input id="start_date" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input id="end_date" type="date" class="form-control">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button id="filter-button" type="button" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i data-lucide="filter"></i>
                        <span>Filter</span>
                    </button>
                    <button id="reset-filter-button" type="button" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                        <i data-lucide="x"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="temperature-readings-table" class="table table-striped table-hover align-middle w-100 mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Device</th>
                            <th>Ruangan</th>
                            <th>Tipe</th>
                            <th>Suhu</th>
                            <th>Status</th>
                            <th>Waktu Record</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const table = new DataTable('#temperature-readings-table', {
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('temperature-readings.index') }}',
                        data: function (data) {
                            data.start_date = document.getElementById('start_date').value;
                            data.end_date = document.getElementById('end_date').value;
                        },
                    },
                    order: [[4, 'desc']],
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'device_name', name: 'device.nama' },
                        { data: 'room_name', name: 'device.room.name', orderable: false },
                        { data: 'type_label', name: 'device.room.type', orderable: false },
                        { data: 'temperature', name: 'temperature' },
                        { data: 'temperature_status', name: 'temperature_status', orderable: false, searchable: false },
                        { data: 'recorded_at', name: 'recorded_at' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: {
                        search: 'Cari:',
                        lengthMenu: 'Tampilkan _MENU_ data',
                        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                        infoEmpty: 'Tidak ada data',
                        infoFiltered: '(difilter dari _MAX_ total data)',
                        processing: 'Memuat...',
                        zeroRecords: 'Data tidak ditemukan',
                        paginate: {
                            first: 'Pertama',
                            last: 'Terakhir',
                            next: 'Berikutnya',
                            previous: 'Sebelumnya',
                        },
                    },
                    drawCallback: function () {
                        window.createLucideIcons?.();
                    },
                });

                document.getElementById('filter-button').addEventListener('click', function () {
                    table.ajax.reload();
                });

                document.getElementById('reset-filter-button').addEventListener('click', function () {
                    document.getElementById('start_date').value = '';
                    document.getElementById('end_date').value = '';
                    table.ajax.reload();
                });
            });
        </script>
    @endpush
</x-layouts.app>
