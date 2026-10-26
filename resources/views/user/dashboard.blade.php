@extends('user.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- SAPAAN --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-2" style="font-size: 26px;">
            Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }}!
        </h2>

        <p class="text-secondary mb-0">
            Selamat datang di akun GearCamp. Siap merencanakan petualanganmu?
        </p>
    </div>

    {{-- RINGKASAN --}}
    <div class="row g-4 mb-4">

        {{-- KERANJANG --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm"
                 style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="text-secondary mb-2">Barang di Keranjang</p>
                            <h2 class="fw-bold mb-0">
                                {{ $jumlahKeranjang ?? 0 }}
                            </h2>
                        </div>

                        <div class="d-flex align-items-center justify-content-center"
                             style="width: 55px; height: 55px; background: #e5eee8; color: #1f4d3a; border-radius: 14px;">
                            <i class="fa-solid fa-cart-shopping fa-xl"></i>
                        </div>
                    </div>

                    <a href="{{ route('cart.index') }}"
                       class="text-decoration-none fw-semibold"
                       style="color: #1f4d3a;">
                        Lihat Keranjang
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- RENTAL --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm"
                 style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="text-secondary mb-2">Rental Saya</p>
                            <h2 class="fw-bold mb-0">—</h2>
                        </div>

                        <div class="d-flex align-items-center justify-content-center"
                             style="width: 55px; height: 55px; background: #e5eee8; color: #1f4d3a; border-radius: 14px;">
                            <i class="fa-solid fa-campground fa-xl"></i>
                        </div>
                    </div>

                    <a href="{{ route('user.rentals') }}"
                       class="text-decoration-none fw-semibold"
                       style="color: #1f4d3a;">
                        Lihat Rental
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- TRANSAKSI --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm"
                 style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="text-secondary mb-2">Transaksi</p>
                            <h2 class="fw-bold mb-0">—</h2>
                        </div>

                        <div class="d-flex align-items-center justify-content-center"
                             style="width: 55px; height: 55px; background: #e5eee8; color: #1f4d3a; border-radius: 14px;">
                            <i class="fa-solid fa-receipt fa-xl"></i>
                        </div>
                    </div>

                    <a href="{{ route('user.transactions') }}"
                       class="text-decoration-none fw-semibold"
                       style="color: #1f4d3a;">
                        Lihat Transaksi
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- AKSI CEPAT --}}
    <div class="card border-0 shadow-sm mb-4"
         style="border-radius: 15px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-1">Mulai Petualanganmu</h5>

            <p class="text-secondary mb-4">
                Temukan perlengkapan camping yang sesuai dengan kebutuhanmu.
            </p>

            <div class="d-flex flex-wrap gap-3">

                <a href="{{ route('katalog.index') }}"
                   class="btn text-white px-4 py-2"
                   style="background: #1f4d3a; border-radius: 9px;">
                    <i class="fa-solid fa-store me-2"></i>
                    Jelajahi Katalog
                </a>

                <a href="{{ route('cart.index') }}"
                   class="btn btn-outline-success px-4 py-2"
                   style="border-radius: 9px;">
                    <i class="fa-solid fa-cart-shopping me-2"></i>
                    Buka Keranjang
                </a>

            </div>
        </div>
    </div>

    {{-- INFORMASI AKUN --}}
    <div class="card border-0 shadow-sm"
         style="border-radius: 15px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-start gap-3">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width: 45px; height: 45px; background: #e5eee8; color: #1f4d3a; border-radius: 12px;">
                    <i class="fa-solid fa-circle-info fa-lg"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-2">Informasi GearCamp</h5>

                    <p class="text-secondary mb-3">
                        Pilih barang dari katalog, masukkan ke keranjang,
                        lalu tentukan tanggal rental saat checkout.
                    </p>

                    <a href="{{ route('user.help') }}"
                       class="text-decoration-none fw-semibold"
                       style="color: #1f4d3a;">
                        Butuh bantuan?
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection