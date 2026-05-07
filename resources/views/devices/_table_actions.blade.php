<div class="flex justify-end gap-2">
    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium {{ $device->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-100 text-zinc-700' }}">
        <i data-lucide="{{ $device->is_active ? 'power' : 'power-off' }}" class="h-3 w-3"></i>
        {{ $device->is_active ? 'Aktif' : 'Nonaktif' }}
    </span>
    <a href="{{ route('devices.show', $device) }}" class="inline-flex items-center gap-1 rounded-md border border-zinc-300 px-3 py-1.5 text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="eye" class="h-3.5 w-3.5"></i>
        <span>Detail</span>
    </a>
    <a href="{{ route('devices.edit', $device) }}" class="inline-flex items-center gap-1 rounded-md border border-zinc-300 px-3 py-1.5 text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
        <span>Edit</span>
    </a>
</div>
