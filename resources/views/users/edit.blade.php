<x-layouts.app title="Edit User">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="pencil" class="text-success"></i>
            <span>Edit User</span>
        </h1>
        <p class="text-muted mb-0">Kosongkan password jika tidak ingin mengubahnya.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @method('PUT')
                @include('users._form')
            </form>
        </div>
    </div>
</x-layouts.app>
