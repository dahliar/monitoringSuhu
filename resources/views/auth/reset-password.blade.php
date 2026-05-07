<x-layouts.app title="Reset Password">
    <div class="mx-auto max-w-md rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="key-round" class="h-6 w-6 text-emerald-700"></i>
            <span>Reset Password</span>
        </h1>

        <form action="{{ route('password.update') }}" method="POST" class="mt-6 space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="block text-sm font-medium text-zinc-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-zinc-700">Password Baru</label>
                <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-700">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            </div>

            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                <i data-lucide="save" class="h-4 w-4"></i>
                <span>Reset Password</span>
            </button>
        </form>
    </div>
</x-layouts.app>
