@extends('admin.layouts.app')

@section('title', 'Tambah Kategori - GearCamp')
@section('page-heading', 'Tambah Kategori')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .kategori-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .kategori-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    /* Card Form */
    .kategori-form {
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
        margin-bottom: 10px;
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

    .form-control::placeholder {
        color: #9ca3af;
    }

    /* Tombol Kustom */
    .btn-kembali {
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

    .btn-kembali:hover {
        background: #e5e7eb;
        color: #111827;
        transform: translateY(-2px);
    }

    .btn-simpan {
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

    .btn-simpan:hover {
        background: #10271c;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -8px rgba(16, 39, 28, 0.8);
    }
</style>

<div class="kategori-wrap">

    <div class="mb-4 pb-2">
        <h4 class="kategori-title mb-2">Tambah Kategori Baru</h4>
        <p class="text-muted mb-0 fw-medium">
            Masukkan informasi kategori perlengkapan camping dengan lengkap.
        </p>
    </div>

    <div class="kategori-form">

        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>

                <input type="text"
                       name="nama_kategori"
                       class="form-control @error('nama_kategori') is-invalid @enderror"
                       value="{{ old('nama_kategori') }}"
                       placeholder="Contoh: Peralatan Memasak, Tenda, Tas Carrier"
                       required>

                @error('nama_kategori')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi <span class="text-muted fw-normal" style="font-size: 13px;">(Opsional)</span></label>

                <textarea name="deskripsi"
                          rows="4"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          placeholder="Jelaskan secara singkat kategori barang ini...">{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4" style="border-color: #edf1ed;">

            <div class="d-flex flex-wrap justify-content-end gap-3">
                <a href="{{ route('admin.kategori.index') }}" class="btn-kembali">
                    Batal / Kembali
                </a>

                <button type="submit" class="btn-simpan">
                    <i class="fa-solid fa-save me-2"></i> Simpan Kategori
                </button>
            </div>
        </form>

    </div>

</div>

@endsection