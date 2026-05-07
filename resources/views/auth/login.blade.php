<x-layouts.app title="Login">
    <div class="mx-auto max-w-md rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="flex items-center gap-2 text-2xl font-semibold">
            <i data-lucide="log-in" class="h-6 w-6 text-emerald-700"></i>
            <span>Login</span>
        </h1>
        <p class="mt-1 text-sm text-zinc-600">Masuk untuk mengakses aplikasi monitoring suhu.</p>

        <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-zinc-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" autofocus>
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
                <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <label class="flex items-center gap-3">
                <input name="remember" type="checkbox" class="rounded border-zinc-300 text-emerald-600 focus:ring-emerald-500">
                <span class="text-sm text-zinc-700">Ingat saya</span>
            </label>

            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-emerald-600 px-5 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                <i data-lucide="log-in" class="h-4 w-4"></i>
                <span>Login</span>
            </button>

            <a href="{{ route('password.request') }}" class="flex items-center justify-center gap-2 text-sm font-medium text-emerald-700 hover:text-emerald-800">
                <i data-lucide="key-round" class="h-4 w-4"></i>
                <span>Lupa password?</span>
            </a>
        </form>
    </div>
</x-layouts.app>
