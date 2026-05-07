<x-layouts.app title="Detail User">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 d-flex align-items-center gap-2">
                <i data-lucide="user" class="text-success"></i>
                <span>Detail User</span>
            </h1>
            <p class="text-muted mb-0">{{ $user->name }}</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                <i data-lucide="pencil"></i>
                <span>Edit User</span>
            </a>
            <form action="{{ $user->is_active ? route('users.deactivate', $user) : route('users.activate', $user) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $user->is_active ? 'btn-warning' : 'btn-success' }} d-inline-flex align-items-center gap-2">
                    <i data-lucide="{{ $user->is_active ? 'power-off' : 'power' }}"></i>
                    <span>{{ $user->is_active ? 'Deaktivasi' : 'Aktivasi' }}</span>
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row g-3 mb-0">
                <div class="col-md-6">
                    <dt class="text-muted small">Nama</dt>
                    <dd class="mb-0">{{ $user->name }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Email</dt>
                    <dd class="mb-0">{{ $user->email }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Role</dt>
                    <dd class="mb-0">{{ ucfirst($user->role) }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Status</dt>
                    <dd class="mb-0">
                        <span class="badge {{ $user->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
        <div class="card-footer bg-white border-0 pt-0">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i data-lucide="arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</x-layouts.app>
