<x-layouts.app title="Lupa Password">
    <div class="mx-auto max-w-md rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="key-round" class="h-6 w-6 text-emerald-700"></i>
            <span>Lupa Password</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Masukkan email untuk menerima link reset password.</p>

        @if (session('status'))
            <div class="mt-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="mt-6 space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-zinc-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" autofocus>
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                <i data-lucide="send" class="h-4 w-4"></i>
                <span>Kirim Link Reset</span>
            </button>
            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 text-sm font-medium text-zinc-700 hover:text-zinc-900">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                <span>Kembali ke login</span>
            </a>
        </form>
    </div>
</x-layouts.app>
