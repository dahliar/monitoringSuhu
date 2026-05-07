<x-layouts.app title="API Token">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 d-flex align-items-center gap-2">
                <i data-lucide="key-round" class="text-success"></i>
                <span>API Token</span>
            </h1>
            <p class="text-muted mb-0">Kelola token untuk akses API perangkat IoT.</p>
        </div>
        <a href="{{ route('api-tokens.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
            <i data-lucide="plus"></i>
            <span>Buat Token</span>
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="api-tokens-table" class="table table-striped table-hover align-middle w-100 mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pemilik</th>
                            <th>Ability</th>
                            <th>Terakhir Dipakai</th>
                            <th>Dibuat</th>
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
                new DataTable('#api-tokens-table', {
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('api-tokens.index') }}',
                    order: [[4, 'desc']],
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'owner', name: 'owner', orderable: false, searchable: false },
                        { data: 'abilities_label', name: 'abilities', orderable: false, searchable: false },
                        { data: 'last_used_at', name: 'last_used_at' },
                        { data: 'created_at', name: 'created_at' },
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
