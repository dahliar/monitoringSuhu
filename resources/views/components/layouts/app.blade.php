<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Monitoring Suhu') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-zinc-100 text-zinc-900 antialiased">
    @php
        $menuItem = 'flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition';
        $activeItem = 'bg-emerald-50 text-emerald-800';
        $inactiveItem = 'text-zinc-700 hover:bg-zinc-100 hover:text-zinc-950';
    @endphp

    <div class="min-h-screen">
        <header class="sticky top-0 z-20 border-b border-zinc-200 bg-white">
            <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ auth()->check() ? route('devices.index') : url('/') }}" class="flex items-center gap-2 text-lg font-semibold">
                    <i data-lucide="thermometer-sun" class="h-5 w-5 text-emerald-700"></i>
                    <span>Monitoring Suhu</span>
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-medium text-zinc-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-zinc-500">{{ auth()->user()->email }}</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                                <i data-lucide="log-out" class="h-4 w-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                            <i data-lucide="log-in" class="h-4 w-4"></i>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <div class="lg:flex">
        <aside class="hidden w-64 shrink-0 border-r border-zinc-200 bg-white lg:flex lg:min-h-[calc(100vh-73px)] lg:flex-col">
            <nav class="flex-1 space-y-1 px-3 py-4">
                @auth
                    <a href="{{ route('rooms.index') }}" class="{{ $menuItem }} {{ request()->routeIs('rooms.*') ? $activeItem : $inactiveItem }}">
                        <i data-lucide="door-open" class="h-4 w-4"></i>
                        <span>Ruangan</span>
                    </a>

                    <a href="{{ route('devices.index') }}" class="{{ $menuItem }} {{ request()->routeIs('devices.*') ? $activeItem : $inactiveItem }}">
                        <i data-lucide="cpu" class="h-4 w-4"></i>
                        <span>Device</span>
                    </a>

                    <a href="{{ route('temperature-readings.index') }}" class="{{ $menuItem }} {{ request()->routeIs('temperature-readings.*') ? $activeItem : $inactiveItem }}">
                        <i data-lucide="thermometer" class="h-4 w-4"></i>
                        <span>Data Suhu</span>
                    </a>

                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="{{ $menuItem }} {{ request()->routeIs('users.*') ? $activeItem : $inactiveItem }}">
                            <i data-lucide="users" class="h-4 w-4"></i>
                            <span>User</span>
                        </a>

                        <a href="{{ route('api-tokens.index') }}" class="{{ $menuItem }} {{ request()->routeIs('api-tokens.*') ? $activeItem : $inactiveItem }}">
                            <i data-lucide="key-round" class="h-4 w-4"></i>
                            <span>API Token</span>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="{{ $menuItem }} {{ request()->routeIs('login') ? $activeItem : $inactiveItem }}">
                        <i data-lucide="log-in" class="h-4 w-4"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </nav>
        </aside>

        <div class="min-w-0 flex-1">
            <div class="border-b border-zinc-200 bg-white lg:hidden">
                @auth
                    <nav class="flex gap-2 overflow-x-auto px-4 py-3">
                        <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('rooms.*') ? $activeItem : $inactiveItem }}">
                            <i data-lucide="door-open" class="h-4 w-4"></i>
                            <span>Ruangan</span>
                        </a>
                        <a href="{{ route('devices.index') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('devices.*') ? $activeItem : $inactiveItem }}">
                            <i data-lucide="cpu" class="h-4 w-4"></i>
                            <span>Device</span>
                        </a>
                        <a href="{{ route('temperature-readings.index') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('temperature-readings.*') ? $activeItem : $inactiveItem }}">
                            <i data-lucide="thermometer" class="h-4 w-4"></i>
                            <span>Data Suhu</span>
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('users.*') ? $activeItem : $inactiveItem }}">
                                <i data-lucide="users" class="h-4 w-4"></i>
                                <span>Manajemen User</span>
                            </a>
                            <a href="{{ route('api-tokens.index') }}" class="inline-flex items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('api-tokens.*') ? $activeItem : $inactiveItem }}">
                                <i data-lucide="key-round" class="h-4 w-4"></i>
                                <span>API Token</span>
                            </a>
                        @endif
                    </nav>
                @endauth
            </div>

            <main class="px-4 py-8 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    @if (session('success'))
                        <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                            <i data-lucide="circle-check" class="mr-2 inline h-4 w-4"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('api_token'))
                        <div class="mb-6 rounded-md border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900">
                            <div class="flex items-center gap-2 font-medium">
                                <i data-lucide="key-round" class="h-4 w-4"></i>
                                <span>Token baru hanya ditampilkan sekali.</span>
                            </div>
                            <code class="mt-3 block break-all rounded bg-white px-3 py-2 text-zinc-900">{{ session('api_token') }}</code>
                        </div>
                    @endif

                    @if ($errors->has('user'))
                        <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            <i data-lucide="circle-alert" class="mr-2 inline h-4 w-4"></i>
                            {{ $errors->first('user') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
