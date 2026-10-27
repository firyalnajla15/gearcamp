
@extends('user.layouts.app')

@section('title', 'Bantuan')
@section('page-title', 'Bantuan')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap');

    :root {
        --green-900: #10271c;
        --green-800: #183b2b;
        --green-700: #1f4d3a;
        --green-100: #e5eee8;
        --gold-500: #d49a4a;
        --line: #e5e7eb;
    }

    .help-wrap {
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        color: #1f2937;
    }

    .help-title {
        font-family: 'Fraunces', serif;
        color: var(--green-900);
        font-weight: 700;
    }

    .help-card {
        border: 1px solid var(--line);
        border-radius: 16px !important;
        background: white;
        transition: all 0.35s cubic-bezier(.22, .61, .36, 1);
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
    }

    .help-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -15px rgba(16, 39, 28, 0.15) !important;
        border-color: transparent;
    }

    .help-card h6 {
        font-size: 17px;
        color: var(--green-900);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .help-card:hover .icon-circle {
        transform: scale(1.1) rotate(-5deg);
    }

    /* FAQ */
    .faq-accordion .accordion-item {
        border: none;
        border-bottom: 1px solid var(--line);
        background-color: transparent;
    }

    .faq-accordion .accordion-item:last-child {
        border-bottom: none;
    }

    .faq-accordion .accordion-button {
        background-color: transparent !important;
        color: var(--green-900);
        font-size: 16px;
        font-weight: 600;
        padding: 22px 0;
        box-shadow: none !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: color 0.3s ease;
    }

    .faq-accordion .accordion-button:hover {
        color: var(--green-700);
    }

    .faq-accordion .accordion-button:not(.collapsed) {
        color: var(--green-700);
        background-color: transparent !important;
    }

    .faq-accordion .accordion-button::after {
        background-image: none;
        content: '\f078';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 14px;
        color: #9ca3af;
        transition: transform 0.3s ease, color 0.3s ease;
        width: auto;
        height: auto;
    }

    .faq-accordion .accordion-button:not(.collapsed)::after {
        transform: rotate(180deg);
        color: var(--green-700);
    }

    .faq-accordion .accordion-body {
        padding: 0 0 24px 0;
        font-size: 15px;
        line-height: 1.7;
        color: #6b7280;
    }

    /* Tombol katalog */
    .btn-custom-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--green-700);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14.5px;
        text-decoration: none;
        transition: all 0.28s ease;
        box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
    }

    .btn-custom-primary:hover {
        background: var(--green-900);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -8px rgba(12, 35, 24, 0.8);
    }

    /* Tombol dashboard */
    .btn-custom-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        color: #6b7280;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14.5px;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-custom-secondary:hover {
        background: #f3f4f6;
        color: var(--green-900);
        border-color: #d1d5db;
        transform: translateY(-2px);
    }

    /* Tombol WhatsApp: tampil saja, belum aktif */
    .btn-whatsapp {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        background: #25D366;
        color: white;
        border: 1px solid #25D366;
        border-radius: 10px;
        padding: 12px 24px;
        font-family: inherit;
        font-weight: 700;
        font-size: 14.5px;
        opacity: 0.8;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-whatsapp:disabled {
        background: #25D366;
        color: white;
        border-color: #25D366;
        opacity: 0.8;
    }

    .whatsapp-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #e4f8eb;
        color: #1da851;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        flex-shrink: 0;
    }

    @media (max-width: 576px) {
        .help-title {
            font-size: 28px !important;
        }

        .help-card .card-body {
            padding: 22px !important;
        }

        .btn-whatsapp,
        .btn-custom-primary,
        .btn-custom-secondary {
            width: 100%;
        }
    }
</style>

<div class="help-wrap">

    {{-- JUDUL --}}
    <div class="mb-4 pb-2">
        <h2 class="help-title mb-2" style="font-size: 32px;">
            Pusat Bantuan
        </h2>

        <p class="text-secondary mb-0 fw-medium" style="font-size: 16px;">
            Temukan jawaban untuk pertanyaan seputar layanan rental GearCamp.
        </p>
    </div>

    {{-- KARTU INFORMASI --}}
    <div class="row g-4 mb-5">

        {{-- CARA RENTAL --}}
        <div class="col-12 col-md-4">
            <div class="card h-100 help-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-center mb-4 icon-circle"
                         style="background: var(--green-100); color: var(--green-700);">
                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                    </div>

                    <h6 class="fw-bold">Cara Rental</h6>

                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Pilih barang, masukkan ke keranjang, lalu tentukan tanggal rental saat checkout.
                    </p>
                </div>
            </div>
        </div>

        {{-- PEMBAYARAN --}}
        <div class="col-12 col-md-4">
            <div class="card h-100 help-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-center mb-4 icon-circle"
                         style="background: #fff3cd; color: #997404;">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                    </div>

                    <h6 class="fw-bold">Pembayaran</h6>

                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Periksa total biaya rental dan ikuti petunjuk pembayaran yang tersedia saat checkout.
                    </p>
                </div>
            </div>
        </div>

        {{-- PENGEMBALIAN --}}
        <div class="col-12 col-md-4">
            <div class="card h-100 help-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-center mb-4 icon-circle"
                         style="background: #d1e7dd; color: #146c43;">
                        <i class="fa-solid fa-box-open fa-lg"></i>
                    </div>

                    <h6 class="fw-bold">Pengembalian Barang</h6>

                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Kembalikan perlengkapan sesuai tanggal rental dan ketentuan penyewaan.
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- FAQ --}}
    <div class="card help-card mb-4">
        <div class="card-body p-4 p-md-5">

            <h5 class="fw-bold mb-2"
                style="font-family: 'Fraunces', serif; color: var(--green-900); font-size: 24px;">
                Pertanyaan yang Sering Diajukan
            </h5>

            <p class="text-secondary small mb-4">
                Berikut beberapa hal yang perlu kamu ketahui.
            </p>

            <div class="accordion faq-accordion" id="faqAccordion">

                {{-- FAQ 1 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-semibold"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq1"
                                aria-expanded="true"
                                aria-controls="faq1">
                            Bagaimana cara menyewa barang?
                        </button>
                    </h2>

                    <div id="faq1"
                         class="accordion-collapse collapse show"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Buka katalog, pilih perlengkapan camping yang kamu butuhkan,
                            lalu tambahkan barang ke keranjang. Saat checkout, tentukan
                            tanggal mulai dan tanggal selesai rental, kemudian periksa
                            total biaya sebelum melanjutkan pesanan.
                        </div>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq2"
                                aria-expanded="false"
                                aria-controls="faq2">
                            Bagaimana cara menghitung biaya rental?
                        </button>
                    </h2>

                    <div id="faq2"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Biaya dihitung berdasarkan harga sewa per hari, jumlah barang,
                            dan lama rental. Periksa rincian tagihan saat checkout untuk
                            mengetahui total biaya pesananmu.
                        </div>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq3"
                                aria-expanded="false"
                                aria-controls="faq3">
                            Bagaimana cara melihat status rental?
                        </button>
                    </h2>

                    <div id="faq3"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Buka menu Rental Saya untuk melihat informasi pesanan dan status
                            penyewaan yang tersedia pada akunmu.
                        </div>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq4"
                                aria-expanded="false"
                                aria-controls="faq4">
                            Apakah tanggal rental bisa diubah?
                        </button>
                    </h2>

                    <div id="faq4"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Perubahan tanggal mengikuti ketentuan pesanan dan ketersediaan
                            barang. Hubungi pengelola GearCamp untuk memastikan apakah
                            perubahan dapat dilakukan.
                        </div>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq5"
                                aria-expanded="false"
                                aria-controls="faq5">
                            Apa yang harus dilakukan jika mengalami kendala?
                        </button>
                    </h2>

                    <div id="faq5"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Siapkan informasi akun dan nomor pesanan jika tersedia,
                            lalu hubungi pengelola GearCamp melalui kontak resmi yang
                            disediakan pada website.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- BANTUAN WHATSAPP --}}
    <div class="card help-card mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center g-4">

                <div class="col-12 col-lg-8">
                    <div class="d-flex align-items-start gap-3">
                        <div class="whatsapp-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-2"
                                style="font-family: 'Fraunces', serif; color: var(--green-900); font-size: 22px;">
                                Masih membutuhkan bantuan?
                            </h5>

                            <p class="text-secondary mb-0"
                               style="font-size: 15px; line-height: 1.7;">
                                Punya pertanyaan atau mengalami kendala saat menggunakan
                                GearCamp? Hubungi tim kami melalui WhatsApp untuk
                                mendapatkan bantuan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 text-lg-end">
                    {{-- Tombol belum aktif karena nomor WhatsApp belum dimasukkan --}}
                    <button type="button"
                            class="btn-whatsapp"
                            disabled
                            aria-disabled="true"
                            title="Kontak WhatsApp belum tersedia">
                        <i class="fa-brands fa-whatsapp fa-lg"></i>
                        Hubungi WhatsApp
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- NAVIGASI TERPISAH --}}
    <div class="card help-card">
        <div class="card-body p-4 p-md-5">

            <h5 class="fw-bold mb-2"
                style="font-family: 'Fraunces', serif; color: var(--green-900); font-size: 22px;">
                Navigasi GearCamp
            </h5>

            <p class="text-secondary mb-4" style="font-size: 15px;">
                Kamu bisa melihat perlengkapan yang tersedia atau kembali ke dashboard.
            </p>

            <div class="d-flex flex-column flex-sm-row flex-wrap gap-2">
                <a href="{{ route('katalog.index') }}" class="btn-custom-primary">
                    <i class="fa-solid fa-store me-2"></i>
                    Buka Katalog
                </a>

                <a href="{{ route('user.dashboard') }}" class="btn-custom-secondary">
                    <i class="fa-solid fa-house me-2"></i>
                    Dashboard
                </a>
            </div>

        </div>
    </div>

</div>

@endsection
