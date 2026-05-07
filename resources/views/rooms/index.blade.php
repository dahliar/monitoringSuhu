<x-layouts.app title="Manajemen Ruangan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 d-flex align-items-center gap-2">
                <i data-lucide="door-open" class="text-success"></i>
                <span>Manajemen Ruangan</span>
            </h1>
            <p class="text-muted mb-0">Kelola data ruangan dan status penggunaannya.</p>
        </div>
        <a href="{{ route('rooms.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
            <i data-lucide="plus"></i>
            <span>Tambah Ruangan</span>
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="rooms-table" class="table table-striped table-hover align-middle w-100 mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
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
                new DataTable('#rooms-table', {
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('rooms.index') }}',
                    order: [[0, 'desc']],
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'type_label', name: 'type' },
                        { data: 'descriptions', name: 'descriptions' },
                        { data: 'status', name: 'is_active', orderable: false, searchable: false },
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
