@extends('admin.layouts.app')

@section('title', 'Detail Pengguna')
@section('page-heading', 'Detail Pengguna')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .detail-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .detail-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    /* Card Kustom */
    .detail-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 8px 30px -10px rgba(0, 0, 0, 0.05);
    }

    /* Avatar Profil */
    .profile-avatar {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background: #eaf2ed;
        color: #1f4d3a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-family: 'Fraunces', serif;
        font-weight: 800;
        box-shadow: inset 0 0 0 4px white, 0 4px 15px rgba(31, 77, 58, 0.15);
    }

    /* Info Box */
    .info-box {
        background: #fafbfa;
        border: 1px solid #edf1ed;
        border-radius: 12px;
        padding: 18px 20px;
        height: 100%;
        transition: background 0.2s ease;
    }

    .info-box:hover {
        background: white;
    }

    .info-label {
        color: #7b887e;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        color: #10271c;
        font-weight: 600;
        font-size: 15px;
    }

    /* Badge Status */
    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .status-aktif {
        background: #eaf2ed;
        color: #1f4d3a;
        border: 1px solid #a7f3d0;
    }

    .status-diblokir {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
    }

    /* Tombol Kustom */
    .btn-custom-secondary {
        background: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 11px 20px;
        font-size: 14px;
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
        padding: 11px 24px;
        font-size: 14px;
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

<div class="detail-wrap">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="detail-title mb-2">Detail Pengguna</h4>
            <p class="text-muted mb-0 fw-medium">
                Informasi lengkap mengenai akun pelanggan.
            </p>
        </div>

        <a href="{{ route('admin.pengguna.index') }}" class="btn btn-custom-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="detail-card">

        {{-- Header Profil --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center gap-4 mb-4 pb-4 border-bottom" style="border-color: #edf1ed !important;">
            <div class="profile-avatar">
                {{ strtoupper(substr($pengguna->name, 0, 1)) }}
            </div>

            <div>
                <h3 class="fw-bold mb-2" style="font-family: 'Fraunces', serif; color: #10271c; font-size: 26px;">
                    {{ $pengguna->name }}
                </h3>
                <div class="d-flex flex-wrap gap-2">
                    <span class="status-badge {{ $pengguna->status == 'aktif' ? 'status-aktif' : 'status-diblokir' }}">
                        <i class="fa-solid {{ $pengguna->status == 'aktif' ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                        {{ ucfirst($pengguna->status) }}
                    </span>
                </div>
            </div>

            <div class="ms-md-auto mt-3 mt-md-0">
                <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" class="btn btn-custom-primary">
                    <i class="fa-solid fa-pen me-2"></i> Edit Pengguna
                </a>
            </div>
        </div>

        {{-- Info Grid --}}
        <div class="row g-4">

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $pengguna->name }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $pengguna->email }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Nomor HP</div>
                    <div class="info-value">{{ $pengguna->phone ?: '-' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <div class="info-label">Tanggal Bergabung</div>
                    <div class="info-value">
                        {{ $pengguna->created_at?->translatedFormat('d F Y') ?? '-' }}
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="info-box">
                    <div class="info-label">Alamat Lengkap</div>
                    <div class="info-value" style="line-height: 1.6;">{{ $pengguna->address ?: '-' }}</div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection