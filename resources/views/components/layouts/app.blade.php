<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Monitoring Suhu') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="app-shell text-body">
    @php
        $navLink = 'nav-link d-flex align-items-center gap-2 rounded-3 px-3 py-2';
        $activeLink = 'active bg-success-subtle text-success-emphasis';
        $inactiveLink = 'text-body-secondary';
    @endphp

    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top shadow-sm">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-semibold" href="{{ auth()->check() ? route('devices.index') : url('/') }}">
                <i data-lucide="thermometer-sun" class="text-success"></i>
                <span>Monitoring Suhu</span>
            </a>

            @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarNav" aria-controls="sidebarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            @endauth

            <div class="d-none d-lg-flex align-items-center gap-3 ms-auto">
                @auth
                    <div class="text-end">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="small text-body-secondary">{{ auth()->user()->email }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                            <i data-lucide="log-out" class="small"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i data-lucide="log-in" class="small"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="d-flex">
        @auth
            <aside class="offcanvas-lg offcanvas-start sidebar bg-white border-end" tabindex="-1" id="sidebarNav" aria-labelledby="sidebarNavLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="sidebarNavLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarNav" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-3">
                    <nav class="nav nav-pills flex-column gap-1">
                        <a href="{{ route('rooms.index') }}" class="{{ $navLink }} {{ request()->routeIs('rooms.*') ? $activeLink : $inactiveLink }}">
                            <i data-lucide="door-open" class="small"></i>
                            <span>Ruangan</span>
                        </a>
                        <a href="{{ route('devices.index') }}" class="{{ $navLink }} {{ request()->routeIs('devices.*') ? $activeLink : $inactiveLink }}">
                            <i data-lucide="cpu" class="small"></i>
                            <span>Device</span>
                        </a>
                        <a href="{{ route('temperature-readings.index') }}" class="{{ $navLink }} {{ request()->routeIs('temperature-readings.*') ? $activeLink : $inactiveLink }}">
                            <i data-lucide="thermometer" class="small"></i>
                            <span>Data Suhu</span>
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('users.index') }}" class="{{ $navLink }} {{ request()->routeIs('users.*') ? $activeLink : $inactiveLink }}">
                                <i data-lucide="users" class="small"></i>
                                <span>User</span>
                            </a>
                            <a href="{{ route('api-tokens.index') }}" class="{{ $navLink }} {{ request()->routeIs('api-tokens.*') ? $activeLink : $inactiveLink }}">
                                <i data-lucide="key-round" class="small"></i>
                                <span>API Token</span>
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2">
                                <i data-lucide="log-out" class="small"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>
        @endauth

        <main class="content-shell flex-grow-1 p-3 p-lg-4">
            <div class="container-fluid px-0">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                        <i data-lucide="circle-check"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('api_token'))
                    <div class="alert alert-warning" role="alert">
                        <div class="d-flex align-items-center gap-2 fw-semibold mb-2">
                            <i data-lucide="key-round"></i>
                            <span>Token baru hanya ditampilkan sekali.</span>
                        </div>
                        <code class="d-block text-break bg-white border rounded p-2">{{ session('api_token') }}</code>
                    </div>
                @endif

                @if ($errors->has('user'))
                    <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                        <i data-lucide="circle-alert"></i>
                        <div>{{ $errors->first('user') }}</div>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
