{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="mx-auto" style="max-width: 820px;">

        {{-- STATUS --}}
        @if (session('status'))
            <div class="mb-3 rounded-4 border border-success-subtle bg-success-subtle px-3 py-2 text-success-emphasis small">
                {{ session('status') }}
            </div>
        @endif

        {{-- ERRORS --}}
        @if ($errors->any())
            <div class="mb-3 rounded-4 border border-danger-subtle bg-danger-subtle px-3 py-2 text-danger-emphasis">
                <div class="fw-semibold mb-1 small">Ada error:</div>
                <ul class="mb-0 ps-4">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border rounded-4 shadow-sm overflow-hidden">

            {{-- HEADER --}}
            <div class="p-4 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center fw-bold text-white"
                         style="width:48px;height:48px;border-radius:16px;background:#111;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="h5 mb-0 fw-bold">Profile</div>
                        <div class="text-muted small">
                            Role:
                            <span class="fw-semibold text-dark">
                                {{ auth()->user()->role === 'seller' ? 'Seller' : 'Buyer' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="p-4">

                {{-- FORM UPDATE PROFILE (SENDIRI) --}}
                <form method="POST" action="{{ route('profile.update') }}" class="d-grid gap-3">
                    @csrf
                    @method('PATCH')

                    {{-- Nama --}}
                    <div>
                        <label class="form-label fw-semibold small">Nama</label>
                        <input type="text" name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="form-control rounded-4">
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label class="form-label fw-semibold small">Bio</label>
                        <textarea name="bio" rows="3"
                                  class="form-control rounded-4"
                                  placeholder="Tulis bio singkat...">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="form-label fw-semibold small">Gender</label>
                        <select name="gender" class="form-select rounded-4">
                            <option value="">Pilih</option>
                            <option value="male"   {{ old('gender', auth()->user()->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', auth()->user()->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other"  {{ old('gender', auth()->user()->gender) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="form-control rounded-4">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="pt-1">
                        <button type="submit" class="btn btn-dark rounded-4 px-4">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                {{-- ACTIONS --}}
                <div class="d-flex flex-column flex-sm-row gap-2">

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}" class="ms-sm-auto">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-4 px-4">
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
