<x-layouts.app title="Edit Ruangan">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="pencil" class="text-success"></i>
            <span>Edit Ruangan</span>
        </h1>
        <p class="text-muted mb-0">Perbarui data dan status ruangan.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('rooms.update', $room) }}" method="POST">
                @method('PUT')
                @include('rooms._form')
            </form>
        </div>
    </div>
</x-layouts.app>
