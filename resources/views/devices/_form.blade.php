@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="nama" class="form-label">Nama</label>
        <input id="nama" name="nama" type="text" value="{{ old('nama', $device->nama) }}" class="form-control">
        @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="jenis" class="form-label">Jenis</label>
        <input id="jenis" name="jenis" type="text" value="{{ old('jenis', $device->jenis) }}" class="form-control">
        @error('jenis') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="idRoom" class="form-label">ID Room</label>
        <select id="idRoom" name="idRoom" class="form-select">
            <option value="">Pilih ruangan</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" @selected((string) old('idRoom', $device->idRoom) === (string) $room->id)>
                    {{ $room->name }} ({{ $room->type_label }})
                </option>
            @endforeach
        </select>
        @error('idRoom') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input id="lokasi" name="lokasi" type="text" value="{{ old('lokasi', $device->lokasi) }}" class="form-control">
        @error('lokasi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="minTemperature" class="form-label">Minimum Temperature</label>
        <input id="minTemperature" name="minTemperature" type="number" step="0.01" value="{{ old('minTemperature', $device->minTemperature) }}" class="form-control">
        @error('minTemperature') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="maxTemperature" class="form-label">Maximum Temperature</label>
        <input id="maxTemperature" name="maxTemperature" type="number" step="0.01" value="{{ old('maxTemperature', $device->maxTemperature) }}" class="form-control">
        @error('maxTemperature') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-check mt-3">
    <input name="is_active" type="hidden" value="0">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $device->is_active ?? true)) class="form-check-input" id="device_is_active">
    <label class="form-check-label fw-medium" for="device_is_active">Aktif</label>
</div>
@error('is_active') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
        <i data-lucide="save"></i>
        <span>Simpan</span>
    </button>
    <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
        <i data-lucide="x"></i>
        <span>Batal</span>
    </a>
</div>
