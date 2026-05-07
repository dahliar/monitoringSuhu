<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Monitoring Suhu') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm border-0 overflow-hidden">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                                <div>
                                    <h1 class="display-6 fw-semibold mb-2 d-flex align-items-center gap-2">
                                        <i data-lucide="thermometer" class="text-success"></i>
                                        <span>{{ config('app.name', 'Monitoring Suhu') }}</span>
                                    </h1>
                                    <p class="text-muted mb-0">Aplikasi monitoring suhu, manajemen perangkat, ruangan, user, dan token API untuk perangkat IoT.</p>
                                </div>
                                <div class="d-flex gap-2">
                                    @auth
                                        <a href="{{ url('/devices') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                                            <i data-lucide="layout-dashboard"></i>
                                            <span>Buka Aplikasi</span>
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                                            <i data-lucide="log-in"></i>
                                            <span>Login</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="border rounded-3 p-3 h-100 bg-light">
                                        <h2 class="h6 d-flex align-items-center gap-2 mb-2">
                                            <i data-lucide="door-open" class="text-success"></i>
                                            <span>Ruangan</span>
                                        </h2>
                                        <p class="text-muted small mb-0">Kelola tipe ruangan untuk suhu panas, dingin, dan suhu ruangan.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded-3 p-3 h-100 bg-light">
                                        <h2 class="h6 d-flex align-items-center gap-2 mb-2">
                                            <i data-lucide="cpu" class="text-success"></i>
                                            <span>Device</span>
                                        </h2>
                                        <p class="text-muted small mb-0">Atur batas minimal dan maksimal temperatur tiap perangkat.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded-3 p-3 h-100 bg-light">
                                        <h2 class="h6 d-flex align-items-center gap-2 mb-2">
                                            <i data-lucide="key-round" class="text-success"></i>
                                            <span>API Token</span>
                                        </h2>
                                        <p class="text-muted small mb-0">Token untuk pengiriman data suhu dari perangkat IoT ke server.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
