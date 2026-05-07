<div class="d-flex justify-content-end gap-2">
    <span class="badge rounded-pill {{ $device->is_active ? 'text-bg-success' : 'text-bg-secondary' }} d-inline-flex align-items-center gap-1 px-2 py-2">
        <i data-lucide="{{ $device->is_active ? 'power' : 'power-off' }}"></i>
        {{ $device->is_active ? 'Aktif' : 'Nonaktif' }}
    </span>
    <a href="{{ route('devices.show', $device) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="eye"></i>
        <span>Detail</span>
    </a>
    <a href="{{ route('devices.edit', $device) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1">
        <i data-lucide="pencil"></i>
        <span>Edit</span>
    </a>
</div>
