
@extends('user.layouts.app')

@section('title', 'Bantuan')
@section('page-title', 'Bantuan')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-2" style="font-size: 25px;">Pusat Bantuan</h2>
    <p class="text-secondary mb-0">
        Temukan jawaban untuk pertanyaan seputar layanan rental GearCamp.
    </p>
</div>

{{-- KARTU INFORMASI --}}
<div class="row g-3 mb-4">

    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-center mb-3"
                     style="width: 48px; height: 48px; background: #e5eee8; color: #1f4d3a; border-radius: 12px;">
                    <i class="fa-solid fa-cart-shopping fa-lg"></i>
                </div>
                <h6 class="fw-bold">Cara Rental</h6>
                <p class="text-secondary small mb-0">
                    Pilih barang, masukkan ke keranjang, lalu tentukan tanggal rental saat checkout.
                </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-center mb-3"
                     style="width: 48px; height: 48px; background: #fff3cd; color: #997404; border-radius: 12px;">
                    <i class="fa-solid fa-credit-card fa-lg"></i>
                </div>
                <h6 class="fw-bold">Pembayaran</h6>
                <p class="text-secondary small mb-0">
                    Periksa total biaya rental dan ikuti petunjuk pembayaran yang tersedia saat checkout.
                </p>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-center mb-3"
                     style="width: 48px; height: 48px; background: #d1e7dd; color: #146c43; border-radius: 12px;">
                    <i class="fa-solid fa-box-open fa-lg"></i>
                </div>
                <h6 class="fw-bold">Pengembalian Barang</h6>
                <p class="text-secondary small mb-0">
                    Kembalikan perlengkapan sesuai tanggal rental dan ketentuan penyewaan.
                </p>
            </div>
        </div>
    </div>

</div>

{{-- FAQ --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
    <div class="card-body p-4">

        <h5 class="fw-bold mb-1">Pertanyaan yang Sering Diajukan</h5>
        <p class="text-secondary small mb-4">
            Berikut beberapa hal yang perlu kamu ketahui.
        </p>

        <div class="accordion" id="faqAccordion">

            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-semibold"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1"
                            aria-expanded="true">
                        Bagaimana cara menyewa barang?
                    </button>
                </h2>
                <div id="faq1"
                     class="accordion-collapse collapse show"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Buka katalog, pilih perlengkapan camping yang kamu butuhkan,
                        lalu tambahkan barang ke keranjang. Saat checkout, tentukan
                        tanggal mulai dan tanggal selesai rental, kemudian periksa
                        total biaya sebelum melanjutkan pesanan.
                    </div>
                </div>
            </div>

            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2">
                        Bagaimana cara menghitung biaya rental?
                    </button>
                </h2>
                <div id="faq2"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Biaya dihitung berdasarkan harga sewa per hari, jumlah barang,
                        dan lama rental. Periksa rincian tagihan saat checkout untuk
                        mengetahui total biaya pesananmu.
                    </div>
                </div>
            </div>

            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3">
                        Bagaimana cara melihat status rental?
                    </button>
                </h2>
                <div id="faq3"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Buka menu Rental Saya untuk melihat informasi pesanan dan status
                        penyewaan yang tersedia pada akunmu.
                    </div>
                </div>
            </div>

            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq4">
                        Apakah tanggal rental bisa diubah?
                    </button>
                </h2>
                <div id="faq4"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Perubahan tanggal mengikuti ketentuan pesanan dan ketersediaan
                        barang. Hubungi pengelola GearCamp untuk memastikan apakah
                        perubahan dapat dilakukan.
                    </div>
                </div>
            </div>

            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-semibold"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq5">
                        Apa yang harus dilakukan jika mengalami kendala?
                    </button>
                </h2>
                <div id="faq5"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Siapkan informasi akun dan nomor pesanan jika tersedia,
                        lalu hubungi pengelola GearCamp melalui kontak resmi yang
                        disediakan pada website.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- AKSI --}}
<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body p-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h5 class="fw-bold mb-1">Masih membutuhkan bantuan?</h5>
                <p class="text-secondary mb-0">
                    Kamu bisa melihat perlengkapan yang tersedia atau kembali ke dashboard.
                </p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('katalog.index') }}"
                   class="btn text-white px-3 py-2"
                   style="background: #1f4d3a; border-radius: 9px;">
                    <i class="fa-solid fa-store me-2"></i>
                    Buka Katalog
                </a>

                <a href="{{ route('user.dashboard') }}"
                   class="btn btn-outline-secondary px-3 py-2"
                   style="border-radius: 9px;">
                    Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
