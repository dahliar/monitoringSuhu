@csrf

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label for="nama" class="block text-sm font-medium text-zinc-700">Nama</label>
        <input id="nama" name="nama" type="text" value="{{ old('nama', $device->nama) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('nama') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="jenis" class="block text-sm font-medium text-zinc-700">Jenis</label>
        <input id="jenis" name="jenis" type="text" value="{{ old('jenis', $device->jenis) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('jenis') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="idRoom" class="block text-sm font-medium text-zinc-700">ID Room</label>
        <select id="idRoom" name="idRoom" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            <option value="">Pilih ruangan</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" @selected((string) old('idRoom', $device->idRoom) === (string) $room->id)>
                    {{ $room->name }} ({{ $room->type_label }})
                </option>
            @endforeach
        </select>
        @error('idRoom') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="lokasi" class="block text-sm font-medium text-zinc-700">Lokasi</label>
        <input id="lokasi" name="lokasi" type="text" value="{{ old('lokasi', $device->lokasi) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('lokasi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="minTemperature" class="block text-sm font-medium text-zinc-700">Minimum Temperature</label>
        <input id="minTemperature" name="minTemperature" type="number" step="0.01" value="{{ old('minTemperature', $device->minTemperature) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('minTemperature') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="maxTemperature" class="block text-sm font-medium text-zinc-700">Maximum Temperature</label>
        <input id="maxTemperature" name="maxTemperature" type="number" step="0.01" value="{{ old('maxTemperature', $device->maxTemperature) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('maxTemperature') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<label class="mt-5 flex items-center gap-3">
    <input name="is_active" type="hidden" value="0">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $device->is_active ?? true)) class="rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500">
    <span class="text-sm font-medium text-zinc-700">Aktif</span>
</label>
@error('is_active') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

<div class="mt-8 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
        <i data-lucide="save" class="h-4 w-4"></i>
        <span>Simpan</span>
    </button>
    <a href="{{ route('devices.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="x" class="h-4 w-4"></i>
        <span>Batal</span>
    </a>
</div>
