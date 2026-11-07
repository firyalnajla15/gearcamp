@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - GearCamp')
@section('page-heading', 'Dashboard Admin')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .admin-dash-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .dashboard-card {
        background: white;
        border: 1px solid #edf1ed;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        transition: all 0.35s cubic-bezier(.22, .61, .36, 1);
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.02);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px -15px rgba(16, 39, 28, 0.12);
        border-color: transparent;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .dashboard-card:hover .stat-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .stat-number {
        font-family: 'Fraunces', serif;
        font-size: 32px;
        font-weight: 700;
        color: #183b2b;
        margin-top: 16px;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 13.5px;
        color: #6b7a70;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .icon-green { background: #eaf2ed; color: #1f4d3a; }
    .icon-gold { background: #fbf1e3; color: #c38b3e; }
    .icon-red { background: #fceaea; color: #c34d4d; }
    .icon-blue { background: #eaf1fa; color: #4775a9; }

    .section-card {
        background: white;
        border: 1px solid #edf1ed;
        border-radius: 18px;
        padding: 30px;
        height: 100%;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.02);
    }

    .section-title {
        font-family: 'Fraunces', serif;
        font-size: 22px;
        font-weight: 700;
        color: #183b2b;
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px;
        border: 1px solid #edf1ed;
        border-radius: 14px;
        text-decoration: none;
        color: #26352b;
        margin-top: 15px;
        transition: all 0.3s ease;
        background: #fafbfa;
        height: 100%;
    }

    .quick-link:hover {
        border-color: #1f4d3a;
        background: white;
        color: #1f4d3a;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -10px rgba(31, 77, 58, 0.15);
    }

    .quick-link i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        background: white;
        border-radius: 10px;
        color: #d49a4a;
        font-size: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .quick-link:hover i {
        background: #1f4d3a;
        color: white;
    }

    .quick-link strong {
        font-size: 14.5px;
        display: block;
        margin-bottom: 2px;
    }

    .quick-link small {
        display: block;
        color: #7b887e;
        font-size: 12.5px;
    }

    @media (max-width: 768px) {
        .stat-number { font-size: 28px; }
        .section-card { padding: 20px; }
    }
</style>

<div class="admin-dash-wrap">

    {{-- WELCOME --}}
    <div class="mb-5">
        <h4 class="fw-bold mb-2" style="font-family: 'Fraunces', serif; font-size: 28px; color: #10271c;">
            Selamat Datang, {{ auth()->user()->name }}! 👋
        </h4>

        <p class="text-muted mb-0 fw-medium">
            Berikut ringkasan aktivitas dan informasi terkini dari GearCamp.
        </p>
    </div>

    {{-- STATISTIK BARANG --}}
    <div class="row g-4 mb-2">

        {{-- TOTAL BARANG --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="stat-label">Total Barang</span>
                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-campground"></i>
                    </div>
                </div>

                <div class="stat-number">{{ number_format($totalBarang) }}</div>

                <small class="text-muted fw-medium mt-1 d-block" style="font-size: 12.5px;">
                    Jenis perlengkapan camping
                </small>
            </div>
        </div>

        {{-- TOTAL STOK --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="stat-label">Total Stok</span>
                    <div class="stat-icon icon-gold">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>

                <div class="stat-number">{{ number_format($totalStok) }}</div>

                <small class="text-muted fw-medium mt-1 d-block" style="font-size: 12.5px;">
                    Unit barang tersedia di inventaris
                </small>
            </div>
        </div>

        {{-- STOK HABIS --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="stat-label">Stok Habis</span>
                    <div class="stat-icon icon-red">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                </div>

                <div class="stat-number">{{ number_format($stokHabis) }}</div>

                <small class="text-muted fw-medium mt-1 d-block" style="font-size: 12.5px;">
                    Barang dengan stok nol
                </small>
            </div>
        </div>

        {{-- STOK MENIPIS --}}
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="stat-label">Stok Menipis</span>
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                </div>

                <div class="stat-number">{{ number_format($stokMenipis) }}</div>

                <small class="text-muted fw-medium mt-1 d-block" style="font-size: 12.5px;">
                    Barang dengan stok 1–5 unit
                </small>
            </div>
        </div>

    </div>

    {{-- STATISTIK TRANSAKSI --}}
    <div class="row g-4 mt-1">

        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="stat-label">Total Transaksi</span>

                    <div class="stat-icon icon-gold">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                <div class="stat-number">{{ number_format($totalTransaksi) }}</div>

                <small class="text-muted fw-medium mt-1 d-block" style="font-size: 12.5px;">
                    Total penyewaan GearCamp
                </small>
            </div>
        </div>

    </div>

    {{-- STATISTIK PENGGUNA --}}
    <div class="row g-4 mt-1">

        {{-- TOTAL USER --}}
        <div class="col-lg-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Pengguna</div>

                        <div class="stat-number">{{ number_format($totalUser) }}</div>

                        <small class="text-muted fw-medium" style="font-size: 12.5px;">
                            Akun penyewa GearCamp
                        </small>
                    </div>

                    <div class="stat-icon icon-green" style="width:65px;height:65px;font-size:26px;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- TOTAL ADMIN --}}
        <div class="col-lg-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Admin</div>

                        <div class="stat-number">{{ number_format($totalAdmin) }}</div>

                        <small class="text-muted fw-medium" style="font-size: 12.5px;">
                            Akun administrator
                        </small>
                    </div>

                    <div class="stat-icon icon-gold" style="width:65px;height:65px;font-size:26px;">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- MENU CEPAT --}}
    <div class="row g-4 mt-1">
        <div class="col-lg-12">
            <div class="section-card">

                <h5 class="section-title mb-1">Menu Pengelolaan</h5>

                <p class="text-muted small mb-4">
                    Akses menu untuk mengelola sistem GearCamp dengan cepat.
                </p>

                <div class="row g-3">

                    <div class="col-md-4">
                        <a href="#" class="quick-link">
                            <i class="fa-solid fa-campground"></i>

                            <div>
                                <strong>Kelola Barang</strong>
                                <small>Data dan stok perlengkapan</small>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#" class="quick-link">
                            <i class="fa-solid fa-receipt"></i>

                            <div>
                                <strong>Kelola Transaksi</strong>
                                <small>Informasi penyewaan barang</small>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="#" class="quick-link">
                            <i class="fa-solid fa-users"></i>

                            <div>
                                <strong>Kelola Pengguna</strong>
                                <small>Data akun pengguna GearCamp</small>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection