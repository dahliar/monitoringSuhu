<x-layouts.app title="Tambah Ruangan">
    <div class="mb-4">
        <h1 class="d-flex align-items-center gap-2 h3 mb-1 fw-semibold">
            <i data-lucide="door-open" class="text-success"></i>
            <span>Tambah Ruangan</span>
        </h1>
        <p class="text-secondary mb-0">Masukkan data ruangan untuk penempatan device.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('rooms.store') }}" method="POST">
                @include('rooms._form')
            </form>
        </div>
    </div>
</x-layouts.app>
