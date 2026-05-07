<x-layouts.app title="Detail API Token">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="key-round" class="h-6 w-6 text-emerald-700"></i>
            <span>Detail API Token</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">{{ $apiToken->name }}</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 md:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-zinc-500">Nama Token</dt>
                <dd class="mt-1 text-zinc-900">{{ $apiToken->name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Pemilik</dt>
                <dd class="mt-1 text-zinc-900">{{ $apiToken->tokenable?->name ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Ability</dt>
                <dd class="mt-1 text-zinc-900">{{ implode(', ', $apiToken->abilities ?? []) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Terakhir Dipakai</dt>
                <dd class="mt-1 text-zinc-900">{{ $apiToken->last_used_at?->format('d M Y H:i') ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-zinc-500">Dibuat</dt>
                <dd class="mt-1 text-zinc-900">{{ $apiToken->created_at?->format('d M Y H:i') ?? '-' }}</dd>
            </div>
        </dl>

        <div class="mt-8 flex gap-3">
            <a href="{{ route('api-tokens.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                <span>Kembali</span>
            </a>
            <form action="{{ route('api-tokens.destroy', $apiToken) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-red-600 px-5 py-2 text-sm font-medium text-white hover:bg-red-700">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                    <span>Revoke</span>
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
