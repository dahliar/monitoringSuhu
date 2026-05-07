<x-layouts.app title="Manajemen User">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 d-flex align-items-center gap-2">
                <i data-lucide="users" class="text-success"></i>
                <span>Manajemen User</span>
            </h1>
            <p class="text-muted mb-0">Kelola akses aplikasi berdasarkan role dan status aktif.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
            <i data-lucide="user-plus"></i>
            <span>Tambah User</span>
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-striped table-hover align-middle w-100 mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
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
                new DataTable('#users-table', {
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('users.index') }}',
                    order: [[0, 'desc']],
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'role_label', name: 'role' },
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
