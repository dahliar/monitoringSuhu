<x-layouts.app title="Data Suhu">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="thermometer" class="h-6 w-6 text-emerald-700"></i>
            <span>Data Suhu</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Data suhu yang diterima dari perangkat IoT.</p>
    </div>

    <div class="mb-6 rounded-md border border-zinc-200 bg-white p-4 shadow-sm">
        <div class="grid gap-4 md:grid-cols-[1fr_1fr_auto] md:items-end">
            <div>
                <label for="start_date" class="block text-sm font-medium text-zinc-700">Tanggal Mulai</label>
                <input id="start_date" type="date" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-zinc-700">Tanggal Akhir</label>
                <input id="end_date" type="date" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            </div>
            <div class="flex gap-2">
                <button id="filter-button" type="button" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    <i data-lucide="filter" class="h-4 w-4"></i>
                    <span>Filter</span>
                </button>
                <button id="reset-filter-button" type="button" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                    <i data-lucide="x" class="h-4 w-4"></i>
                    <span>Reset</span>
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-md border border-zinc-200 bg-white p-4 shadow-sm">
        <div class="overflow-x-auto">
            <table id="temperature-readings-table" class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50">
                    <tr>
                        <th>No</th>
                        <th>Device</th>
                        <th>Ruangan</th>
                        <th>Tipe</th>
                        <th>Suhu</th>
                        <th>Status</th>
                        <th>Waktu Record</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
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
