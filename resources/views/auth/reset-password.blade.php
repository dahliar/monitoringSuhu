<x-layouts.app title="Reset Password">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h1 class="d-flex align-items-center gap-2 h3 mb-4 fw-semibold">
                        <i data-lucide="key-round" class="text-success"></i>
                        <span>Reset Password</span>
                    </h1>

                    <form action="{{ route('password.update') }}" method="POST" class="vstack gap-3">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" class="form-control">
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="password" class="form-label">Password Baru</label>
                            <input id="password" name="password" type="password" class="form-control">
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100 d-inline-flex align-items-center justify-content-center gap-2">
                            <i data-lucide="save"></i>
                            <span>Reset Password</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
