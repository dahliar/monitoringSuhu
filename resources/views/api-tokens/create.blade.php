<x-layouts.app title="Buat API Token">
    <div class="mb-4">
        <h1 class="h3 mb-1 d-flex align-items-center gap-2">
            <i data-lucide="key-round" class="text-success"></i>
            <span>Buat API Token</span>
        </h1>
        <p class="text-muted mb-0">Token dipakai perangkat IoT untuk mengirim data suhu ke API.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('api-tokens.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Token</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Sensor Cold Storage 1" class="form-control">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Pemilik Token</label>
                        <select id="user_id" name="user_id" class="form-select">
                            <option value="">Pilih user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected((string) old('user_id') === (string) $user->id)>{{ $user->name }} - {{ $user->email }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <fieldset class="mt-4">
                    <legend class="fs-6">Ability</legend>
                    <div class="mt-2 d-grid gap-2">
                        @foreach ($abilities as $value => $label)
                            <label class="form-check d-flex align-items-center gap-2 mb-0">
                                <input name="abilities[]" type="checkbox" value="{{ $value }}" @checked(in_array($value, old('abilities', ['temperature:write']), true)) class="form-check-input">
                                <span class="form-check-label">{{ $label }} <span class="text-muted">({{ $value }})</span></span>
                            </label>
                        @endforeach
                    </div>
                    @error('abilities') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    @error('abilities.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </fieldset>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i data-lucide="save"></i>
                        <span>Simpan</span>
                    </button>
                    <a href="{{ route('api-tokens.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                        <i data-lucide="x"></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
