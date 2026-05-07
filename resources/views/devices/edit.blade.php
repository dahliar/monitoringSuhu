<x-layouts.app title="Edit Device">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="pencil" class="h-6 w-6 text-emerald-700"></i>
            <span>Edit Device</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Perbarui data {{ $device->nama }}.</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <form action="{{ route('devices.update', $device) }}" method="POST">
            @method('PUT')
            @include('devices._form')
        </form>
    </div>
</x-layouts.app>
