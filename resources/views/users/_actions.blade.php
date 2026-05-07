<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="eye"></i>
        <span>Detail</span>
    </a>
    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="pencil"></i>
        <span>Edit</span>
    </a>

    @if ($disableToggle)
        <button type="button" class="btn btn-secondary btn-sm d-inline-flex align-items-center gap-1" disabled>
            <i data-lucide="lock"></i>
            <span>{{ $toggleLabel }}</span>
        </button>
    @else
        <form action="{{ $toggleRoute }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn {{ $user->is_active ? 'btn-warning' : 'btn-success' }} btn-sm d-inline-flex align-items-center gap-1">
                <i data-lucide="{{ $user->is_active ? 'power-off' : 'power' }}"></i>
                <span>{{ $toggleLabel }}</span>
            </button>
        </form>
    @endif
</div>
