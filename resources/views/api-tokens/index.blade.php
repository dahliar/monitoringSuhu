<x-layouts.app title="API Token">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="flex items-center gap-2 text-2xl font-semibold">
                <i data-lucide="key-round" class="h-6 w-6 text-emerald-700"></i>
                <span>API Token</span>
            </h1>
            <p class="mt-1 text-sm text-zinc-600">Kelola token untuk akses API perangkat IoT.</p>
        </div>
        <a href="{{ route('api-tokens.create') }}" class="inline-flex w-fit items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
            <i data-lucide="plus" class="h-4 w-4"></i>
            <span>Buat Token</span>
        </a>
    </div>

    <div class="overflow-hidden rounded-md border border-zinc-200 bg-white p-4 shadow-sm">
        <div class="overflow-x-auto">
            <table id="api-tokens-table" class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50">
                    <tr>
                        <th>Nama</th>
                        <th>Pemilik</th>
                        <th>Ability</th>
                        <th>Terakhir Dipakai</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
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
