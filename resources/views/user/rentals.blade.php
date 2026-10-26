@extends('user.layouts.app')

@section('title', 'Rental Saya')
@section('page-title', 'Rental Saya')

@section('content')

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-2">Rental Saya</h2>
        <p class="text-secondary mb-0">
            Pantau status dan riwayat penyewaan perlengkapan camping kamu.
        </p>
    </div>

    {{-- FILTER STATUS --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button type="button" class="btn btn-success">
            Semua Rental
        </button>

        <button type="button" class="btn btn-outline-success">
            Menunggu
        </button>

        <button type="button" class="btn btn-outline-success">
            Diproses
        </button>

        <button type="button" class="btn btn-outline-success">
            Selesai
        </button>

        <button type="button" class="btn btn-outline-success">
            Dibatalkan
        </button>
    </div>

    {{-- KONTEN RENTAL KOSONG --}}
    <div class="card border-0 shadow-sm"
         style="border-radius: 15px;">
        <div class="card-body text-center py-5 px-3">

            <div class="d-flex align-items-center justify-content-center mx-auto mb-4"
                 style="width: 90px; height: 90px; border-radius: 50%; background: #e5eee8; color: #1f4d3a;">
                <i class="fa-solid fa-campground fa-3x"></i>
            </div>

            <h4 class="fw-bold mb-2">Belum Ada Rental</h4>

            <p class="text-secondary mx-auto mb-4"
               style="max-width: 450px;">
                Kamu belum memiliki penyewaan perlengkapan camping.
                Yuk, pilih perlengkapan yang kamu butuhkan untuk petualangan berikutnya!
            </p>

            <a href="{{ route('katalog.index') }}"
               class="btn text-white px-4 py-2"
               style="background: #1f4d3a; border-radius: 9px;">
                <i class="fa-solid fa-store me-2"></i>
                Jelajahi Katalog
            </a>

        </div>
    </div>

    {{-- INFORMASI --}}
    <div class="alert mt-4 border-0"
         style="background: #eaf2ed; color: #1f4d3a; border-radius: 12px;">
        <i class="fa-solid fa-circle-info me-2"></i>
        Riwayat rental akan ditampilkan di sini setelah kamu melakukan pemesanan.
    </div>

@endsection