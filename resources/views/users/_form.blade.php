@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="form-control">
        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control">
        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <input id="password" name="password" type="password" class="form-control">
        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
    </div>

    <div class="col-md-6">
        <label for="role" class="form-label">Role</label>
        <select id="role" name="role" class="form-select">
            @foreach (['admin' => 'Admin', 'operator' => 'Operator', 'viewer' => 'Viewer'] as $value => $label)
                <option value="{{ $value }}" @selected(old('role', $user->role) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('role') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-check mt-3">
    <input name="is_active" type="hidden" value="0">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $user->is_active ?? true)) class="form-check-input" id="user_is_active">
    <label class="form-check-label fw-medium" for="user_is_active">Aktif</label>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
        <i data-lucide="save"></i>
        <span>Simpan</span>
    </button>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
        <i data-lucide="x"></i>
        <span>Batal</span>
    </a>
</div>
