@extends('user.layouts.app')

@section('title', 'Rental Saya')
@section('page-title', 'Rental Saya')

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

    .rental-wrap {
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        color: #1f2937;
    }

    .rental-title {
        font-family: 'Fraunces', serif;
        color: var(--green-900);
        font-weight: 700;
    }

    /* Filter Tombol */
    .filter-btn {
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.25s ease;
        border: 1px solid var(--green-700);
    }

    .filter-btn.active {
        background: var(--green-700);
        color: white;
        box-shadow: 0 4px 12px -4px rgba(31, 77, 58, 0.4);
    }

    .filter-btn.outline {
        background: white;
        color: var(--green-700);
    }

    .filter-btn.outline:hover {
        background: var(--green-100);
        transform: translateY(-2px);
    }

    /* Card Utama */
    .rental-card {
        border: 1px solid var(--line);
        border-radius: 20px !important;
        background: white;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
    }

    /* Empty State */
    .empty-icon-box {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--green-100);
        color: var(--green-700);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: inset 0 0 0 6px white, 0 10px 20px -10px rgba(31, 77, 58, 0.15);
        transition: transform 0.4s ease;
    }

    .rental-card:hover .empty-icon-box {
        transform: scale(1.05) translateY(-5px);
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

    /* Info Alert */
    .info-alert {
        background: var(--green-100);
        color: var(--green-800);
        border-radius: 14px;
        font-weight: 500;
        font-size: 14.5px;
        border-left: 4px solid var(--green-700);
    }
</style>

<div class="rental-wrap">

    {{-- HEADER --}}
    <div class="mb-4 pb-2">
        <h2 class="rental-title mb-2" style="font-size: 32px;">Rental Saya</h2>
        <p class="text-secondary mb-0 fw-medium" style="font-size: 16px;">
            Pantau status dan riwayat penyewaan perlengkapan camping kamu.
        </p>
    </div>

    {{-- FILTER STATUS --}}
    <div class="d-flex flex-wrap gap-2 mb-4 pb-2">
        <button type="button" class="btn filter-btn active">
            Semua Rental
        </button>

        <button type="button" class="btn filter-btn outline">
            Menunggu
        </button>

        <button type="button" class="btn filter-btn outline">
            Diproses
        </button>

        <button type="button" class="btn filter-btn outline">
            Selesai
        </button>

        <button type="button" class="btn filter-btn outline">
            Dibatalkan
        </button>
    </div>

    {{-- KONTEN RENTAL KOSONG --}}
    <div class="card rental-card">
        <div class="card-body text-center py-5 px-4">

            <div class="empty-icon-box">
                <i class="fa-solid fa-campground fa-3x"></i>
            </div>

            <h4 class="fw-bold mb-2" style="font-family: 'Fraunces', serif; font-size: 26px; color: var(--green-900);">
                Belum Ada Rental
            </h4>

            <p class="text-secondary mx-auto mb-4" style="max-width: 450px; line-height: 1.7; font-size: 15px;">
                Kamu belum memiliki penyewaan perlengkapan camping.
                Yuk, pilih perlengkapan yang kamu butuhkan untuk petualangan berikutnya!
            </p>

            <a href="{{ route('katalog.index') }}" class="btn btn-custom-primary">
                <i class="fa-solid fa-store me-2"></i>
                Jelajahi Katalog
            </a>

        </div>
    </div>

    {{-- INFORMASI --}}
    <div class="alert info-alert mt-4 border-0 d-flex align-items-center">
        <i class="fa-solid fa-circle-info me-3 fs-5"></i>
        <div>
            Riwayat rental akan ditampilkan di sini setelah kamu melakukan pemesanan.
        </div>
    </div>

</div>

@endsection