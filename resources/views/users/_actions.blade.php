<div class="flex justify-end gap-2">
    <a href="{{ route('users.show', $user) }}" class="inline-flex items-center gap-1 rounded-md border border-zinc-300 px-3 py-1.5 text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="eye" class="h-3.5 w-3.5"></i>
        <span>Detail</span>
    </a>
    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-1 rounded-md border border-zinc-300 px-3 py-1.5 text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
        <span>Edit</span>
    </a>

    @if ($disableToggle)
        <button type="button" class="inline-flex cursor-not-allowed items-center gap-1 rounded-md bg-zinc-300 px-3 py-1.5 text-white" disabled>
            <i data-lucide="lock" class="h-3.5 w-3.5"></i>
            <span>{{ $toggleLabel }}</span>
        </button>
    @else
        <form action="{{ $toggleRoute }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="inline-flex items-center gap-1 rounded-md px-3 py-1.5 text-white {{ $toggleClass }}">
                <i data-lucide="{{ $user->is_active ? 'power-off' : 'power' }}" class="h-3.5 w-3.5"></i>
                <span>{{ $toggleLabel }}</span>
            </button>
        </form>
    @endif
</div>
