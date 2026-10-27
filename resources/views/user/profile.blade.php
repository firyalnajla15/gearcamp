@extends('user.layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap');

    :root {
        --green-900: #10271c;
        --green-800: #183b2b;
        --green-700: #1f4d3a;
        --green-100: #e5eee8;
        --gold-500: #d49a4a;
        --line: #e5e7eb;
    }

    .profile-wrap {
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        color: #1f2937;
    }

    .profile-title {
        font-family: 'Fraunces', serif;
        color: var(--green-900);
        font-weight: 700;
    }

    /* Card Umum */
    .profile-card {
        border: 1px solid var(--line);
        border-radius: 20px !important;
        background: white;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
        transition: all 0.35s ease;
    }

    /* Avatar & Badge */
    .avatar-box {
        width: 100px;
        height: 100px;
        background: var(--green-100);
        color: var(--green-700);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin: 0 auto 1.5rem;
        box-shadow: inset 0 0 0 4px white, 0 8px 16px -8px rgba(31, 77, 58, 0.2);
        transition: transform 0.3s ease;
    }

    .profile-card:hover .avatar-box {
        transform: scale(1.05);
    }

    .member-badge {
        background: var(--green-100);
        color: var(--green-800);
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
    }

    /* Section Titles di dalam Form */
    .section-icon {
        width: 48px;
        height: 48px;
        background: var(--green-100);
        color: var(--green-700);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .section-title-text h5 {
        font-family: 'Fraunces', serif;
        color: var(--green-900);
        font-size: 20px;
        margin-bottom: 4px;
    }

    /* Form Inputs */
    .form-label {
        font-size: 14px;
        color: #374151;
    }

    .form-control {
        padding: 14px 16px;
        border-radius: 10px;
        border: 1px solid var(--line);
        font-size: 15px;
        background-color: #fafbfa;
        transition: all 0.3s ease;
        color: #1f2937;
    }

    .form-control:focus {
        border-color: var(--green-700);
        box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
        background-color: white;
    }

    .form-control[readonly] {
        background-color: #f3f4f6;
        color: #6b7280;
        border-color: #e5e7eb;
        cursor: not-allowed;
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    /* Tombol Kustom */
    .btn-custom-primary {
        background: var(--green-700);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.28s ease;
        box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
    }

    .btn-custom-primary:hover {
        background: var(--green-900);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -8px rgba(12, 35, 24, 0.8);
    }

    .btn-custom-secondary {
        background: transparent;
        color: #6b7280;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 14px 28px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.25s ease;
    }

    .btn-custom-secondary:hover {
        background: #f3f4f6;
        color: var(--green-900);
        border-color: #d1d5db;
        transform: translateY(-2px);
    }
</style>

<div class="profile-wrap">

    <div class="mb-4 pb-2">
        <h2 class="profile-title mb-2" style="font-size: 32px;">Profil Saya</h2>
        <p class="text-secondary mb-0 fw-medium" style="font-size: 16px;">Kelola informasi akun kamu di GearCamp.</p>
    </div>

    <div class="row g-4">

        {{-- INFORMASI AKUN --}}
        <div class="col-12 col-lg-4">
            <div class="card profile-card h-100">
                <div class="card-body p-4 p-md-5 text-center">

                    <div class="avatar-box">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <h5 class="fw-bold mb-1" style="font-family: 'Fraunces', serif; font-size: 22px; color: var(--green-900);">
                        {{ Auth::user()->name }}
                    </h5>
                    <p class="text-secondary small mb-3">{{ Auth::user()->email }}</p>

                    <span class="badge member-badge">
                        <i class="fa-solid fa-circle-check me-1"></i>
                        Member GearCamp
                    </span>

                    <hr class="my-4" style="border-color: var(--line);">

                    <div class="text-start">
                        <p class="text-secondary small mb-1 fw-semibold">Nama Lengkap</p>
                        <p class="fw-semibold mb-3">{{ Auth::user()->name }}</p>

                        <p class="text-secondary small mb-1 fw-semibold">Email</p>
                        <p class="fw-semibold mb-3 text-break">{{ Auth::user()->email }}</p>

                        <p class="text-secondary small mb-1 fw-semibold">Nomor WhatsApp</p>
                        <p class="fw-semibold mb-3">
                            {{ Auth::user()->phone ?: 'Belum diisi' }}
                        </p>

                        <p class="text-secondary small mb-1 fw-semibold">Alamat Lengkap</p>
                        <p class="fw-semibold mb-0" style="line-height: 1.6;">
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
                <div class="card profile-card mb-4">
                    <div class="card-body p-4 p-md-5">

                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom" style="border-color: var(--line) !important;">
                            <div class="section-icon">
                                <i class="fa-solid fa-user-pen"></i>
                            </div>

                            <div class="section-title-text">
                                <h5 class="fw-bold mb-1">Informasi Pribadi</h5>
                                <p class="text-secondary small mb-0">
                                    Perbarui informasi akun kamu.
                                </p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   placeholder="Masukkan nama lengkap"
                                   required maxlength="255">

                            @error('name')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">
                                Email
                            </label>
                            <input type="email" id="email" class="form-control"
                                   value="{{ Auth::user()->email }}" readonly>

                            <small class="text-secondary d-block mt-2" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-info me-1"></i> Email tidak dapat diubah melalui halaman ini.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label fw-bold">
                                Nomor WhatsApp
                            </label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', Auth::user()->phone) }}"
                                   placeholder="Contoh: 081234567890"
                                   maxlength="20">

                            @error('phone')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="address" class="form-label fw-bold">
                                Alamat Lengkap
                            </label>
                            <textarea name="address" id="address" rows="3"
                                      class="form-control @error('address') is-invalid @enderror"
                                      placeholder="Masukkan alamat lengkap kamu">{{ old('address', Auth::user()->address) }}</textarea>

                            @error('address')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- GANTI PASSWORD --}}
                <div class="card profile-card mb-4">
                    <div class="card-body p-4 p-md-5">

                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom" style="border-color: var(--line) !important;">
                            <div class="section-icon">
                                <i class="fa-solid fa-lock"></i>
                            </div>

                            <div class="section-title-text">
                                <h5 class="fw-bold mb-1">Ganti Password</h5>
                                <p class="text-secondary small mb-0">
                                    Kosongkan bagian ini jika tidak ingin mengganti password.
                                </p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-bold">
                                Password Saat Ini
                            </label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="Masukkan password saat ini"
                                   autocomplete="current-password">

                            @error('current_password')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">
                                Password Baru
                            </label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 8 karakter"
                                   minlength="8" autocomplete="new-password">

                            @error('password')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label fw-bold">
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
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <button type="submit" class="btn btn-custom-primary">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('user.dashboard') }}" class="btn btn-custom-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection