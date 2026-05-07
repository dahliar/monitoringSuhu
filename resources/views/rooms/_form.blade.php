@csrf

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="block text-sm font-medium text-zinc-700">Nama Ruangan</label>
        <input id="name" name="name" type="text" value="{{ old('name', $room->name) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="type" class="block text-sm font-medium text-zinc-700">Tipe</label>
        <select id="type" name="type" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" @selected((string) old('type', $room->type) === (string) $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label for="descriptions" class="block text-sm font-medium text-zinc-700">Deskripsi</label>
        <textarea id="descriptions" name="descriptions" rows="4" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('descriptions', $room->descriptions) }}</textarea>
        @error('descriptions') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<label class="mt-5 flex items-center gap-3">
    <input name="is_active" type="hidden" value="0">
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $room->is_active ?? true)) class="rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500">
    <span class="text-sm font-medium text-zinc-700">Aktif</span>
</label>
@error('is_active') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

<div class="mt-8 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
        <i data-lucide="save" class="h-4 w-4"></i>
        <span>Simpan</span>
    </button>
    <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
        <i data-lucide="x" class="h-4 w-4"></i>
        <span>Batal</span>
    </a>
</div>
