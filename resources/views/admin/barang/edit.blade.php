@extends('admin.layouts.app')

@section('title', 'Edit Barang')
@section('page-heading', 'Edit Barang')

@section('content')

    @php
        $foto = $barang->foto;
        $fotoUrl = null;

        if ($foto) {
            if (\Illuminate\Support\Str::startsWith($foto, ['http://', 'https://'])) {
                $fotoUrl = $foto;
            } else {
                $foto = ltrim(str_replace('storage/', '', $foto), '/');
                $fotoUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($foto);
            }
        }

        $daftarKategori = [
            'Tenda',
            'Tas Carrier',
            'Perlengkapan Tidur',
            'Alat Masak',
            'Penerangan',
            'Perlengkapan Hiking',
            'Aksesoris Camping',
        ];
    @endphp

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

        .edit-barang-wrap {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #26352b;
        }

        .edit-title {
            font-family: 'Fraunces', serif;
            color: #10271c;
            font-weight: 700;
            font-size: 28px;
        }

        .custom-card {
            border: 1px solid #edf1ed;
            border-radius: 18px;
            box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
            background: white;
        }

        .form-label {
            font-size: 14px;
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            padding: 13px 16px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            font-size: 14.5px;
            background-color: #fafbfa;
            transition: all 0.3s ease;
            color: #1f2937;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1f4d3a;
            box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
            background-color: white;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .input-group-text {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #6b7280;
            font-weight: 600;
            padding-left: 16px;
            padding-right: 12px;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .foto-preview {
            width: 160px;
            height: 120px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 2px solid white;
            outline: 1px solid #edf1ed;
            object-fit: cover;
            display: block;
            background: #f7f9f7;
        }

        .form-control[type="file"] {
            padding: 9px 12px;
        }

        .form-control[type="file"]::file-selector-button {
            background-color: #eaf2ed;
            color: #1f4d3a;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            margin-right: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .form-control[type="file"]::file-selector-button:hover {
            background-color: #1f4d3a;
            color: white;
        }

        .btn-custom-secondary {
            background: transparent;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 14.5px;
            transition: all 0.25s ease;
        }

        .btn-custom-secondary:hover {
            background: #f3f4f6;
            color: #10271c;
            border-color: #d1d5db;
            transform: translateY(-2px);
        }

        .btn-custom-primary {
            background: #1f4d3a;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 14.5px;
            transition: all 0.28s ease;
            box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
        }

        .btn-custom-primary:hover {
            background: #10271c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(16, 39, 28, 0.8);
        }
    </style>

    <div class="edit-barang-wrap container-fluid px-0">

        <div class="mb-4 pb-2">
            <h4 class="edit-title mb-2">Edit Barang</h4>
            <p class="text-muted mb-0 fw-medium">
                Perbarui informasi barang rental dengan benar.
            </p>
        </div>

        <div class="custom-card">
            <div class="card-body p-4 p-md-5">

                <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang"
                                class="form-control @error('nama_barang') is-invalid @enderror"
                                value="{{ old('nama_barang', $barang->nama_barang) }}" placeholder="Masukkan nama barang"
                                required>

                            @error('nama_barang')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>

                                <option value="" disabled>-- Pilih Kategori Barang --</option>

                                @foreach ($kategori as $item)
                                    <option value="{{ $item->nama_kategori }}"
                                        {{ old('kategori', $barang->kategori) == $item->nama_kategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach

                                {{-- Tetap tampilkan kategori lama jika belum terdaftar --}}
                                @if (!$kategori->contains('nama_kategori', $barang->kategori))
                                    <option value="{{ $barang->kategori }}" selected>
                                        {{ $barang->kategori }} (Kategori sebelumnya)
                                    </option>
                                @endif

                            </select>

                            @error('kategori')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror

                            @error('kategori')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga per Hari</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_per_hari"
                                    class="form-control @error('harga_per_hari') is-invalid @enderror"
                                    value="{{ old('harga_per_hari', $barang->harga_per_hari) }}" placeholder="0"
                                    min="0" required>
                            </div>

                            @error('harga_per_hari')
                                <small class="text-danger fw-semibold d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Stok Barang</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok', $barang->stok) }}" placeholder="0" min="0" required>

                            @error('stok')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4"
                                placeholder="Tuliskan deskripsi singkat mengenai barang...">{{ old('deskripsi', $barang->deskripsi) }}</textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <label class="form-label d-block">Foto Saat Ini</label>

                            <div class="mb-3">
                                <img id="foto-preview"
                                    src="{{ $fotoUrl ?: 'https://placehold.co/160x120?text=Belum+Ada+Foto' }}"
                                    alt="{{ $barang->nama_barang }}" class="foto-preview"
                                    onerror="this.onerror=null; this.src='https://placehold.co/160x120?text=No+Image';">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Ganti Foto (Opsional)</label>

                            <input type="file" name="foto" id="input-foto"
                                class="form-control @error('foto') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                            <small class="text-muted d-block mt-2" style="font-size: 12.5px;">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </small>

                            @error('foto')
                                <small class="text-danger fw-semibold d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <hr class="my-4" style="border-color: #edf1ed;">

                    <div class="d-flex flex-wrap gap-3 justify-content-end">
                        <a href="{{ route('admin.barang.index') }}" class="btn btn-custom-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-custom-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFoto = document.getElementById('input-foto');
            const previewFoto = document.getElementById('foto-preview');

            if (inputFoto && previewFoto) {
                inputFoto.addEventListener('change', function() {
                    const file = this.files[0];

                    if (!file) {
                        return;
                    }

                    if (!file.type.startsWith('image/')) {
                        alert('File harus berupa gambar.');
                        this.value = '';
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran foto maksimal 2 MB.');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(event) {
                        previewFoto.src = event.target.result;
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
    </script>

@endsection
