@extends('user.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

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

    /* Base Font untuk halaman ini */
    .dashboard-wrap {
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        color: #1f2937;
    }

    /* Judul Halaman */
    .dashboard-title {
        font-family: 'Fraunces', serif;
        color: var(--green-900);
        font-weight: 700;
    }

    /* Card Kustom */
    .dash-card {
        border: 1px solid var(--line);
        border-radius: 20px !important;
        background: white;
        transition: all 0.35s cubic-bezier(.22, .61, .36, 1);
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
    }

    .dash-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px -15px rgba(16, 39, 28, 0.15) !important;
        border-color: transparent;
    }

    /* Ikon Kotak */
    .icon-box {
        width: 60px;
        height: 60px;
        background: var(--green-100);
        color: var(--green-700);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .dash-card:hover .icon-box {
        background: var(--green-700);
        color: white;
        transform: scale(1.05) rotate(-5deg);
    }

    /* Link Panah */
    .link-arrow {
        color: var(--green-700);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.25s ease;
    }

    .link-arrow i {
        transition: transform 0.25s ease;
    }

    .link-arrow:hover {
        color: var(--green-900);
    }

    .link-arrow:hover i {
        transform: translateX(4px);
    }

    /* Tombol Kustom */
    .btn-custom-primary {
        background: var(--green-700);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
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

    .btn-custom-outline {
        background: transparent;
        color: var(--green-700);
        border: 1px solid var(--green-700);
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.25s ease;
    }

    .btn-custom-outline:hover {
        background: var(--green-100);
        color: var(--green-800);
        transform: translateY(-2px);
    }
</style>

<div class="dashboard-wrap">

    {{-- SAPAAN --}}
    <div class="mb-4 pb-2">
        <h2 class="dashboard-title mb-2" style="font-size: 32px;">
            Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }}! 👋
        </h2>

        <p class="text-secondary mb-0 fw-medium" style="font-size: 16px;">
            Selamat datang di akun GearCamp. Siap merencanakan petualanganmu?
        </p>
    </div>

    {{-- RINGKASAN --}}
    <div class="row g-4 mb-4">

        {{-- KERANJANG --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 dash-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="text-secondary mb-2 fw-medium" style="font-size: 14px;">Barang di Keranjang</p>
                            <h2 class="fw-bold mb-0" style="font-size: 32px; color: var(--green-900);">
                                {{ $jumlahKeranjang ?? 0 }}
                            </h2>
                        </div>

                        <div class="icon-box">
                            <i class="fa-solid fa-cart-shopping fa-xl"></i>
                        </div>
                    </div>

                    <a href="{{ route('cart.index') }}" class="link-arrow mt-2">
                        Lihat Keranjang
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- RENTAL --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 dash-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="text-secondary mb-2 fw-medium" style="font-size: 14px;">Rental Saya</p>
                            <h2 class="fw-bold mb-0" style="font-size: 32px; color: var(--green-900);">—</h2>
                        </div>

                        <div class="icon-box">
                            <i class="fa-solid fa-campground fa-xl"></i>
                        </div>
                    </div>

                    <a href="{{ route('user.rentals') }}" class="link-arrow mt-2">
                        Lihat Rental
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- TRANSAKSI --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 dash-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="text-secondary mb-2 fw-medium" style="font-size: 14px;">Transaksi</p>
                            <h2 class="fw-bold mb-0" style="font-size: 32px; color: var(--green-900);">—</h2>
                        </div>

                        <div class="icon-box">
                            <i class="fa-solid fa-receipt fa-xl"></i>
                        </div>
                    </div>

                    <a href="{{ route('user.transactions') }}" class="link-arrow mt-2">
                        Lihat Transaksi
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- AKSI CEPAT --}}
    <div class="card dash-card mb-4">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold mb-2" style="font-family: 'Fraunces', serif; color: var(--green-900); font-size: 24px;">Mulai Petualanganmu</h5>

            <p class="text-secondary mb-4" style="font-size: 15.5px;">
                Temukan perlengkapan camping yang sesuai dengan kebutuhanmu.
            </p>

            <div class="d-flex flex-wrap gap-3">

                <a href="{{ route('katalog.index') }}" class="btn btn-custom-primary">
                    <i class="fa-solid fa-store me-2"></i>
                    Jelajahi Katalog
                </a>

                <a href="{{ route('cart.index') }}" class="btn btn-custom-outline">
                    <i class="fa-solid fa-cart-shopping me-2"></i>
                    Buka Keranjang
                </a>

            </div>
        </div>
    </div>

    {{-- INFORMASI AKUN --}}
    <div class="card dash-card">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-start gap-4">
                <div class="icon-box flex-shrink-0" style="width: 50px; height: 50px;">
                    <i class="fa-solid fa-circle-info fa-lg"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-2" style="font-family: 'Fraunces', serif; color: var(--green-900); font-size: 22px;">Informasi GearCamp</h5>

                    <p class="text-secondary mb-3" style="font-size: 15px; line-height: 1.7;">
                        Pilih barang dari katalog, masukkan ke keranjang,
                        lalu tentukan tanggal rental saat checkout.
                    </p>

                    <a href="{{ route('user.help') }}" class="link-arrow">
                        Butuh bantuan?
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection