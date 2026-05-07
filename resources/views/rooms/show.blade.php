<x-layouts.app title="Detail Ruangan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 d-flex align-items-center gap-2">
                <i data-lucide="door-open" class="text-success"></i>
                <span>Detail Ruangan</span>
            </h1>
            <p class="text-muted mb-0">{{ $room->name }}</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                <i data-lucide="pencil"></i>
                <span>Edit Ruangan</span>
            </a>
            <form action="{{ $room->is_active ? route('rooms.deactivate', $room) : route('rooms.activate', $room) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $room->is_active ? 'btn-warning' : 'btn-success' }} d-inline-flex align-items-center gap-2">
                    <i data-lucide="{{ $room->is_active ? 'power-off' : 'power' }}"></i>
                    <span>{{ $room->is_active ? 'Deaktivasi' : 'Aktivasi' }}</span>
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row g-3 mb-0">
                <div class="col-md-6">
                    <dt class="text-muted small">Nama</dt>
                    <dd class="mb-0">{{ $room->name }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Tipe</dt>
                    <dd class="mb-0">{{ $room->type_label }}</dd>
                </div>
                <div class="col-12">
                    <dt class="text-muted small">Deskripsi</dt>
                    <dd class="mb-0">{{ $room->descriptions ?? '-' }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Status</dt>
                    <dd class="mb-0">
                        <span class="badge {{ $room->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                            {{ $room->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
        <div class="card-footer bg-white border-0 pt-0">
            <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i data-lucide="arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</x-layouts.app>
