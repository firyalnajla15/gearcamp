
@extends('admin.layouts.app')

@section('title', 'Detail Barang')
@section('page-heading', 'Detail Barang')

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
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .detail-barang-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .detail-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    .custom-card {
        border: 1px solid #edf1ed;
        border-radius: 20px;
        box-shadow: 0 8px 30px -10px rgba(0, 0, 0, 0.06) !important;
        background: white;
        overflow: hidden;
    }

    .product-img {
        width: 100%;
        height: 350px;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transition: transform 0.4s ease;
        background: #f7f9f7;
    }

    .product-img:hover {
        transform: scale(1.02);
    }

    .no-image {
        width: 100%;
        min-height: 350px;
        background-color: #f7f9f7;
        border: 2px dashed #e5e7eb;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #adb8b1;
    }

    .product-title {
        font-family: 'Fraunces', serif;
        font-size: 32px;
        font-weight: 700;
        color: #10271c;
        line-height: 1.3;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .info-label {
        color: #7b887e;
        font-weight: 600;
        min-width: 120px;
    }

    .info-value {
        color: #26352b;
        font-weight: 600;
    }

    .price-value {
        font-family: 'Fraunces', serif;
        font-size: 24px;
        color: #1f4d3a;
        font-weight: 700;
    }

    .category-badge {
        background-color: #eaf2ed;
        color: #1f4d3a;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
    }

    .btn-custom-secondary {
        background: white;
        color: #6b7280;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 11px 22px;
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
        padding: 11px 24px;
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

<div class="detail-barang-wrap container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="detail-title mb-1">Detail Barang</h4>
            <p class="text-muted mb-0 fw-medium">
                Informasi lengkap barang rental GearCamp.
            </p>
        </div>

        <a href="{{ route('admin.barang.index') }}" class="btn btn-custom-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="custom-card">
        <div class="card-body p-4 p-md-5">

            <div class="row g-4 g-md-5">

                <div class="col-md-5">

                    @if ($fotoUrl)
                        <img
                            src="{{ $fotoUrl }}"
                            class="product-img"
                            alt="{{ $barang->nama_barang }}"
                            onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';"
                        >
                    @else
                        <div class="no-image">
                            <i class="fas fa-image fa-4x mb-3" style="opacity: 0.5;"></i>
                            <span class="fw-semibold" style="font-size: 15px;">
                                Foto belum tersedia
                            </span>
                        </div>
                    @endif

                </div>

                <div class="col-md-7 d-flex flex-column">

                    <div class="mb-2">
                        <span class="category-badge">
                            <i class="fa-solid fa-tag me-1"></i>
                            {{ $barang->kategori }}
                        </span>
                    </div>

                    <h3 class="product-title mb-4">
                        {{ $barang->nama_barang }}
                    </h3>

                    <div class="info-row">
                        <span class="info-label">Harga Sewa</span>
                        <span class="price-value">
                            Rp{{ number_format($barang->harga_per_hari, 0, ',', '.') }}
                            <span style="font-size: 14px; font-family: 'Plus Jakarta Sans'; color: #7b887e; font-weight: 500;">
                                / hari
                            </span>
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Stok Tersedia</span>
                        <span class="info-value">

                            @if ($barang->stok > 5)
                                <span class="badge" style="background-color: #eaf2ed; color: #1f4d3a; padding: 6px 12px; border-radius: 6px; font-weight: 700;">
                                    <i class="fa-solid fa-circle-check me-1"></i>
                                    {{ $barang->stok }} Unit
                                </span>
                            @elseif($barang->stok > 0)
                                <span class="badge" style="background-color: #fef3c7; color: #b45309; padding: 6px 12px; border-radius: 6px; font-weight: 700;">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i>
                                    Sisa {{ $barang->stok }} Unit
                                </span>
                            @else
                                <span class="badge" style="background-color: #fee2e2; color: #b91c1c; padding: 6px 12px; border-radius: 6px; font-weight: 700;">
                                    <i class="fa-solid fa-circle-xmark me-1"></i>
                                    Stok Habis
                                </span>
                            @endif

                        </span>
                    </div>

                    <hr class="my-4" style="border-color: #edf1ed;">

                    <h6 class="fw-bold mb-3" style="color: #10271c; font-size: 16px;">
                        <i class="fa-solid fa-align-left me-2" style="color: #d49a4a;"></i>
                        Deskripsi Barang
                    </h6>

                    <p class="text-secondary mb-4" style="line-height: 1.8; font-size: 15px;">
                        {{ $barang->deskripsi ?: 'Belum ada deskripsi untuk barang ini.' }}
                    </p>

                    <div class="mt-auto">
                        <a href="{{ route('admin.barang.edit', $barang->id) }}" class="btn btn-custom-primary">
                            <i class="fas fa-edit me-2"></i>Edit Barang
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
