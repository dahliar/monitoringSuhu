<x-layouts.app title="Tambah User">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="user-plus" class="text-success"></i>
            <span>Tambah User</span>
        </h1>
        <p class="text-muted mb-0">Buat akses baru untuk aplikasi.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @include('users._form')
            </form>
        </div>
    </div>
</x-layouts.app>
