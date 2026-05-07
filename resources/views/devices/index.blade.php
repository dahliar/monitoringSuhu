<x-layouts.app title="Data Device">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 d-flex align-items-center gap-2">
                <i data-lucide="cpu" class="text-success"></i>
                <span>Data Device</span>
            </h1>
            <p class="text-muted mb-0">Kelola perangkat tanpa menghapus data historis.</p>
        </div>
        <a href="{{ route('devices.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
            <i data-lucide="plus"></i>
            <span>Tambah Device</span>
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="devices-table" class="table table-striped table-hover align-middle w-100 mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Device</th>
                            <th>Ruangan</th>
                            <th>Min Temperatur</th>
                            <th>Max Temperatur</th>
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
