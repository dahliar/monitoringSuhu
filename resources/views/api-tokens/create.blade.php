<x-layouts.app title="Buat API Token">
    <div class="mb-6">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="key-round" class="h-6 w-6 text-emerald-700"></i>
            <span>Buat API Token</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Token dipakai perangkat IoT untuk mengirim data suhu ke API.</p>
    </div>

    <div class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <form action="{{ route('api-tokens.store') }}" method="POST">
            @csrf

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700">Nama Token</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Sensor Cold Storage 1" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="user_id" class="block text-sm font-medium text-zinc-700">Pemilik Token</label>
                    <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Pilih user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected((string) old('user_id') === (string) $user->id)>{{ $user->name }} - {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <fieldset class="mt-5">
                <legend class="text-sm font-medium text-zinc-700">Ability</legend>
                <div class="mt-2 space-y-2">
                    @foreach ($abilities as $value => $label)
                        <label class="flex items-center gap-3">
                            <input name="abilities[]" type="checkbox" value="{{ $value }}" @checked(in_array($value, old('abilities', ['temperature:write']), true)) class="rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm text-zinc-700">{{ $label }} <span class="text-zinc-500">({{ $value }})</span></span>
                        </label>
                    @endforeach
                </div>
                @error('abilities') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @error('abilities.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </fieldset>

            <div class="mt-8 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    <span>Simpan</span>
                </button>
                <a href="{{ route('api-tokens.index') }}" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-5 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                    <i data-lucide="x" class="h-4 w-4"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
