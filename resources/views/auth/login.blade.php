@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="mx-auto" style="max-width: 420px;">

        <div class="bg-white border rounded-4 shadow-sm overflow-hidden">
            <div class="p-4 border-bottom">
                <div class="fs-5 fw-bold mb-1">Login</div>
                <div class="text-muted small">
                    Masuk untuk lanjut belanja / jualan.
                </div>
            </div>

            <div class="p-4">

                {{-- status --}}
                @if (session('status'))
                    <div class="mb-3 rounded-4 border border-success-subtle bg-success-subtle px-3 py-2 small text-success-emphasis">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- error --}}
                @if ($errors->any())
                    <div class="mb-3 rounded-4 border border-danger-subtle bg-danger-subtle px-3 py-2 small text-danger-emphasis">
                        <ul class="mb-0 ps-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="d-grid gap-3">
                    @csrf

                    <div>
                        <label class="form-label fw-semibold small mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="form-control rounded-3 py-2 small">
                    </div>

                    <div>
                        <label class="form-label fw-semibold small mb-1">Password</label>
                        <input type="password" name="password" required
                               class="form-control rounded-3 py-2 small">
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <label class="d-flex align-items-center gap-2 small text-muted">
                            <input type="checkbox" name="remember" class="form-check-input mt-0">
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                Forgot?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-dark rounded-3 py-2 small fw-semibold">
                        LOG IN
                    </button>

                    <div class="text-center small text-muted">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                            Register
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
