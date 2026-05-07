@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama Ruangan</label>
        <input id="name" name="name" type="text" value="{{ old('name', $room->name) }}" class="form-control">
        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="type" class="form-label">Tipe</label>
        <select id="type" name="type" class="form-select">
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" @selected((string) old('type', $room->type) === (string) $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('type') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="descriptions" class="form-label">Deskripsi</label>
        <textarea id="descriptions" name="descriptions" rows="4" class="form-control">{{ old('descriptions', $room->descriptions) }}</textarea>
        @error('descriptions') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-check mt-3">
    <input name="is_active" type="hidden" value="0">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $room->is_active ?? true)) class="form-check-input" id="room_is_active">
    <label class="form-check-label fw-medium" for="room_is_active">Aktif</label>
</div>
@error('is_active') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
        <i data-lucide="save"></i>
        <span>Simpan</span>
    </button>
    <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
        <i data-lucide="x"></i>
        <span>Batal</span>
    </a>
</div>
