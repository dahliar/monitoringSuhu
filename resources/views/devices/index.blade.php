<x-layouts.app title="Data Device">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="flex items-center gap-2 text-2xl font-semibold">
                <i data-lucide="cpu" class="h-6 w-6 text-emerald-700"></i>
                <span>Data Device</span>
            </h1>
            <p class="mt-1 text-sm text-zinc-600">Kelola perangkat tanpa menghapus data historis.</p>
        </div>
        <a href="{{ route('devices.create') }}" class="inline-flex w-fit items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
            <i data-lucide="plus" class="h-4 w-4"></i>
            <span>Tambah Device</span>
        </a>
    </div>

    <div class="overflow-hidden rounded-md border border-zinc-200 bg-white p-4 shadow-sm">
        <div class="overflow-x-auto">
            <table id="devices-table" class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50">
                    <tr>
                        <th>No</th>
                        <th>Nama Device</th>
                        <th>Ruangan</th>
                        <th>Min Temperatur</th>
                        <th>Max Temperatur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new DataTable('#devices-table', {
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('devices.index') }}',
                    order: [[1, 'desc']],
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nama', name: 'nama' },
                        { data: 'room_name', name: 'room.name' },
                        { data: 'minTemperature', name: 'minTemperature' },
                        { data: 'maxTemperature', name: 'maxTemperature' },
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
            });
        </script>
    @endpush
</x-layouts.app>
