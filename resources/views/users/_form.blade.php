@csrf

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="block text-sm font-medium text-zinc-700">Nama</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-zinc-700">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
        <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Konfirmasi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
    </div>

    <div>
        <label for="role" class="block text-sm font-medium text-zinc-700">Role</label>
        <select id="role" name="role" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            @foreach (['admin' => 'Admin', 'operator' => 'Operator', 'viewer' => 'Viewer'] as $value => $label)
                <option value="{{ $value }}" @selected(old('role', $user->role) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<label class="mt-5 flex items-center gap-3">
    <input name="is_active" type="hidden" value="0">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $user->is_active ?? true)) class="rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500">
    <span class="text-sm font-medium text-zinc-700">Aktif</span>
</label>

<div class="mt-8 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
        <i data-lucide="save" class="h-4 w-4"></i>
        <span>Simpan</span>
    </button>
    <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="x" class="h-4 w-4"></i>
        <span>Batal</span>
    </a>
</div>
