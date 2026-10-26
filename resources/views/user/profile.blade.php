
@extends('user.layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-2" style="font-size: 25px;">Profil Saya</h2>
    <p class="text-secondary mb-0">Kelola informasi akun kamu di GearCamp.</p>
</div>

<div class="row g-4">

    {{-- INFORMASI AKUN --}}
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-4 text-center">

                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width: 90px; height: 90px; background: #e5eee8; color: #1f4d3a; border-radius: 50%; font-size: 34px;">
                    <i class="fa-solid fa-user"></i>
                </div>

                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-secondary small mb-3">{{ Auth::user()->email }}</p>

                <span class="badge rounded-pill px-3 py-2"
                      style="background: #e5eee8; color: #1f4d3a;">
                    <i class="fa-solid fa-circle-check me-1"></i>
                    Member GearCamp
                </span>

                <hr class="my-4">

                <div class="text-start">
                    <p class="text-secondary small mb-1">Nama Lengkap</p>
                    <p class="fw-semibold mb-3">{{ Auth::user()->name }}</p>

                    <p class="text-secondary small mb-1">Email</p>
                    <p class="fw-semibold mb-3 text-break">{{ Auth::user()->email }}</p>

                    <p class="text-secondary small mb-1">Nomor WhatsApp</p>
                    <p class="fw-semibold mb-3">
                        {{ Auth::user()->phone ?: 'Belum diisi' }}
                    </p>

                    <p class="text-secondary small mb-1">Alamat Lengkap</p>
                    <p class="fw-semibold mb-0">
                        {{ Auth::user()->address ?: 'Belum diisi' }}
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- FORM PROFIL DAN PASSWORD --}}
    <div class="col-12 col-lg-8">

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- INFORMASI PRIBADI --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center justify-content-center"
                             style="width: 45px; height: 45px; background: #e5eee8; color: #1f4d3a; border-radius: 10px;">
                            <i class="fa-solid fa-user-pen"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Informasi Pribadi</h5>
                            <p class="text-secondary small mb-0">
                                Perbarui informasi akun kamu.
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', Auth::user()->name) }}"
                               placeholder="Masukkan nama lengkap"
                               required maxlength="255">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email
                        </label>
                        <input type="email" id="email" class="form-control"
                               value="{{ Auth::user()->email }}" readonly>

                        <small class="text-secondary">
                            Email tidak dapat diubah melalui halaman ini.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">
                            Nomor WhatsApp
                        </label>
                        <input type="text" name="phone" id="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', Auth::user()->phone) }}"
                               placeholder="Contoh: 081234567890"
                               maxlength="20">

                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="address" class="form-label fw-semibold">
                            Alamat Lengkap
                        </label>
                        <textarea name="address" id="address" rows="3"
                                  class="form-control @error('address') is-invalid @enderror"
                                  placeholder="Masukkan alamat lengkap kamu">{{ old('address', Auth::user()->address) }}</textarea>

                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- GANTI PASSWORD --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center justify-content-center"
                             style="width: 45px; height: 45px; background: #e5eee8; color: #1f4d3a; border-radius: 10px;">
                            <i class="fa-solid fa-lock"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Ganti Password</h5>
                            <p class="text-secondary small mb-0">
                                Kosongkan bagian ini jika tidak ingin mengganti password.
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">
                            Password Saat Ini
                        </label>
                        <input type="password" name="current_password" id="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               placeholder="Masukkan password saat ini"
                               autocomplete="current-password">

                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            Password Baru
                        </label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter"
                               minlength="8" autocomplete="new-password">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            Konfirmasi Password Baru
                        </label>
                        <input type="password" name="password_confirmation"
                               id="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password baru"
                               minlength="8" autocomplete="new-password">
                    </div>

                </div>
            </div>

            {{-- TOMBOL SIMPAN --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <button type="submit" class="btn text-white px-4 py-2"
                        style="background: #1f4d3a; border-radius: 9px;">
                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    Simpan Perubahan
                </button>

                <a href="{{ route('user.dashboard') }}"
                   class="btn btn-outline-secondary px-4 py-2"
                   style="border-radius: 9px;">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
