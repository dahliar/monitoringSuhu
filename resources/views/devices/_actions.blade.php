<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('devices.show', $device) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="eye"></i>
        <span>Detail</span>
    </a>
    <a href="{{ route('devices.edit', $device) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="pencil"></i>
        <span>Edit</span>
    </a>
    <form action="{{ $toggleRoute }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn {{ $device->is_active ? 'btn-warning' : 'btn-success' }} btn-sm d-inline-flex align-items-center gap-1">
            <i data-lucide="{{ $device->is_active ? 'power-off' : 'power' }}"></i>
            <span>{{ $toggleLabel }}</span>
        </button>
    </form>
</div>
