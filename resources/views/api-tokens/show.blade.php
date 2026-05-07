<x-layouts.app title="Detail API Token">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="key-round" class="text-success"></i>
            <span>Detail API Token</span>
        </h1>
        <p class="text-muted mb-0">{{ $apiToken->name }}</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <dl class="row g-3 mb-0">
                <div class="col-md-6">
                    <dt class="text-muted small">Nama Token</dt>
                    <dd class="mb-0">{{ $apiToken->name }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Pemilik</dt>
                    <dd class="mb-0">{{ $apiToken->tokenable?->name ?? '-' }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Ability</dt>
                    <dd class="mb-0">{{ implode(', ', $apiToken->abilities ?? []) }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Terakhir Dipakai</dt>
                    <dd class="mb-0">{{ $apiToken->last_used_at?->format('d M Y H:i') ?? '-' }}</dd>
                </div>
                <div class="col-md-6">
                    <dt class="text-muted small">Dibuat</dt>
                    <dd class="mb-0">{{ $apiToken->created_at?->format('d M Y H:i') ?? '-' }}</dd>
                </div>
            </dl>
        </div>
        <div class="card-footer bg-white border-0 pt-0 d-flex flex-wrap gap-2">
            <a href="{{ route('api-tokens.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i data-lucide="arrow-left"></i>
                <span>Kembali</span>
            </a>
            <form action="{{ route('api-tokens.destroy', $apiToken) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger d-inline-flex align-items-center gap-2">
                    <i data-lucide="trash-2"></i>
                    <span>Revoke</span>
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
