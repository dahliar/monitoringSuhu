<x-layouts.app title="Login">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h1 class="d-flex align-items-center gap-2 h3 mb-1 fw-semibold">
                        <i data-lucide="log-in" class="text-success"></i>
                        <span>Login</span>
                    </h1>
                    <p class="text-secondary mb-4">Masuk untuk mengakses aplikasi monitoring suhu.</p>

                    <form action="{{ route('login') }}" method="POST" class="vstack gap-3">
                        @csrf

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" autofocus>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="password" class="form-label">Password</label>
                            <input id="password" name="password" type="password" class="form-control">
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-check">
                            <input name="remember" type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn btn-success w-100 d-inline-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="log-in"></i>
                            <span>Login</span>
                        </button>

                        <a href="{{ route('password.request') }}" class="d-flex align-items-center justify-content-center gap-2 text-decoration-none fw-medium text-success">
                            <i data-lucide="key-round"></i>
                            <span>Lupa password?</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
