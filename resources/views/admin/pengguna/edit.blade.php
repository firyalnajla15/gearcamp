@extends('admin.layouts.app')

@section('title', 'Edit Pengguna')
@section('page-heading', 'Edit Pengguna')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .form-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .form-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    /* Card Form */
    .form-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 20px;
        padding: 35px;
        max-width: 800px;
        box-shadow: 0 8px 30px -10px rgba(0, 0, 0, 0.05);
    }

    /* Label & Input */
    .form-label {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 14.5px;
        background-color: #fafbfa;
        transition: all 0.3s ease;
        color: #1f2937;
    }

    .form-control:focus {
        border-color: #1f4d3a;
        box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
        background-color: white;
    }

    /* Tombol Kustom */
    .btn-custom-secondary {
        background: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 14.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-custom-secondary:hover {
        background: #e5e7eb;
        color: #111827;
        transform: translateY(-2px);
    }

    .btn-custom-primary {
        background: #1f4d3a;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 28px;
        font-size: 14.5px;
        font-weight: 700;
        transition: all 0.28s ease;
        box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
    }

    .btn-custom-primary:hover {
        background: #10271c;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -8px rgba(16, 39, 28, 0.8);
    }
</style>

<div class="form-wrap">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="form-title mb-2">Edit Data Pengguna</h4>
            <p class="text-muted mb-0 fw-medium">
                Perbarui informasi pelanggan GearCamp dengan benar.
            </p>
        </div>

        <a href="{{ route('admin.pengguna.index') }}" class="btn btn-custom-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="form-card">

        <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Lengkap</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $pengguna->name) }}"
                       placeholder="Masukkan nama lengkap"
                       required>

                @error('name')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $pengguna->email) }}"
                       placeholder="nama@email.com"
                       required>

                @error('email')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Nomor HP</label>
                <input type="text"
                       name="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $pengguna->phone) }}"
                       placeholder="Contoh: 081234567890">

                @error('phone')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <textarea name="address"
                          rows="4"
                          class="form-control @error('address') is-invalid @enderror"
                          placeholder="Masukkan alamat lengkap pengguna">{{ old('address', $pengguna->address) }}</textarea>

                @error('address')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4" style="border-color: #edf1ed;">

            <div class="d-flex flex-wrap justify-content-end gap-3">
                <a href="{{ route('admin.pengguna.index') }}" class="btn btn-custom-secondary">
                    Batal
                </a>

                <button type="submit" class="btn btn-custom-primary">
                    <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection