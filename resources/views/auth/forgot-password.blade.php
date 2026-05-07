<x-layouts.app title="Lupa Password">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h1 class="d-flex align-items-center gap-2 h3 mb-1 fw-semibold">
                        <i data-lucide="key-round" class="text-success"></i>
                        <span>Lupa Password</span>
                    </h1>
                    <p class="text-secondary mb-4">Masukkan email untuk menerima link reset password.</p>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST" class="vstack gap-3">
                        @csrf
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" autofocus>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100 d-inline-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="send"></i>
                            <span>Kirim Link Reset</span>
                        </button>
                        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center gap-2 text-decoration-none fw-medium text-body-secondary">
                            <i data-lucide="arrow-left"></i>
                            <span>Kembali ke login</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
