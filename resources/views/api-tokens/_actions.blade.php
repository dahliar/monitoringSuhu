<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('api-tokens.show', $token) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="eye"></i>
        <span>Detail</span>
    </a>
    <form action="{{ route('api-tokens.destroy', $token) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center gap-1">
            <i data-lucide="trash-2"></i>
            <span>Revoke</span>
        </button>
    </form>
</div>
