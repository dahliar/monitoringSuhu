<div class="flex justify-end gap-2">
    <a href="{{ route('api-tokens.show', $token) }}" class="inline-flex items-center gap-1 rounded-md border border-zinc-300 px-3 py-1.5 text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="eye" class="h-3.5 w-3.5"></i>
        <span>Detail</span>
    </a>
    <form action="{{ route('api-tokens.destroy', $token) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center gap-1 rounded-md bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">
            <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
            <span>Revoke</span>
        </button>
    </form>
</div>
