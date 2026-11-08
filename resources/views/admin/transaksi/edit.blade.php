@extends('admin.layouts.app')

@section('title', 'Edit Transaksi')
@section('page-heading', 'Edit Transaksi')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .edit-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .edit-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    /* Card Kustom */
    .edit-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 18px;
        box-shadow: 0 4px 15px -8px rgba(0,0,0,.05);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .edit-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #edf1ed;
        background: #fafcfb;
    }

    .edit-card-header h6 {
        font-family: 'Fraunces', serif;
        font-size: 18px;
        color: #10271c;
    }

    .edit-card-body {
        padding: 25px;
    }

    /* Label & Input */
    .form-label {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 10px;
        padding: 13px 16px;
        border: 1px solid #e5e7eb;
        font-size: 14.5px;
        background-color: #fafbfa;
        transition: all 0.3s ease;
        color: #1f2937;
    }

    .form-control:focus {
        border-color: #1f4d3a;
        box-shadow: 0 0 0 4px rgba(31,77,58,.1);
        background-color: white;
    }

    .form-control[readonly] {
        background-color: #f3f4f6;
        color: #6b7280;
        cursor: not-allowed;
    }

    /* Info Box Durasi */
    .info-box {
        background: #eaf2ed;
        border: 1px solid #cce0d4;
        border-radius: 12px;
        padding: 16px 20px;
    }

    /* Tabel Barang */
    .table-items th {
        background: #f7f9f7;
        color: #7b887e;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        padding: 16px 20px;
        border: none;
    }

    .table-items td {
        font-size: 14px;
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #edf1ed;
    }

    .table-items tfoot td {
        background: #fafbfa;
        font-weight: 700;
        font-size: 15px;
        border-top: 2px solid #edf1ed;
    }

    /* Tombol Kustom */
    .btn-custom-secondary {
        background: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 14.5px;
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
        padding: 12px 28px;
        font-size: 14.5px;
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

@php
    $tanggalMulai = old('tanggal_mulai', \Carbon\Carbon::parse($rental->tanggal_mulai)->format('Y-m-d'));
    $tanggalSelesai = old('tanggal_selesai', \Carbon\Carbon::parse($rental->tanggal_selesai)->format('Y-m-d'));
@endphp

<div class="edit-wrapper">

    {{-- HEADER --}}
    <div class="mb-4 pb-2">
        <h4 class="edit-title mb-2">Edit Transaksi</h4>
        <p class="text-muted mb-0 fw-medium">Perbarui tanggal dan catatan penyewaan.</p>
    </div>

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" style="background-color: #fee2e2; color: #991b1b;">
            <strong><i class="fa-solid fa-circle-exclamation me-2"></i> Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ALERT STATUS --}}
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" style="background-color: #eaf2ed; color: #1f4d3a;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.transaksi.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- INFORMASI TRANSAKSI --}}
        <div class="edit-card">
            <div class="edit-card-header">
                <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-receipt" style="color:#d49a4a;"></i> Informasi Transaksi
                </h6>
            </div>

            <div class="edit-card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Kode Rental</label>
                        <input type="text" class="form-control" value="{{ $rental->kode_rental }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Penyewa</label>
                        <input type="text" class="form-control" value="{{ $rental->user->name ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai Rental</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}" min="{{ now()->toDateString() }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Selesai Rental</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ $tanggalSelesai }}" min="{{ $tanggalMulai }}" required>
                    </div>

                    <div class="col-12">
                        <div class="info-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small fw-bold text-dark">
                                    <i class="fa-solid fa-calendar-days me-2" style="color: #1f4d3a;"></i> Durasi Rental
                                </span>
                                <strong id="durasiRental" style="color:#1f4d3a; font-size: 16px;">
                                    {{ $rental->total_hari }} Hari
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Catatan Transaksi</label>
                        <textarea name="catatan" class="form-control" rows="4" placeholder="Masukkan catatan tambahan...">{{ old('catatan', $rental->catatan) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- DAFTAR BARANG --}}
        <div class="edit-card">
            <div class="edit-card-header">
                <h6 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-box-open" style="color:#d49a4a;"></i> Barang yang Disewa
                </h6>
                <small class="text-muted fw-medium">Barang dan jumlah tidak dapat diubah dari halaman ini.</small>
            </div>

            <div class="table-responsive">
                <table class="table table-items mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga / Hari</th>
                            <th class="text-end pe-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rental->details as $detail)
                            <tr>
                                <td class="ps-4 text-muted fw-semibold">{{ $loop->iteration }}</td>
                                <td class="fw-bold" style="color: #10271c;">{{ $detail->barang->nama_barang ?? 'Barang dihapus' }}</td>
                                <td>{{ $detail->jumlah }} unit</td>
                                <td>Rp{{ number_format($detail->harga_per_hari, 0, ',', '.') }}</td>
                                <td class="text-end pe-4 fw-bold" style="color: #1f4d3a;">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada detail barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end">Total Rental</td>
                            <td class="text-end pe-4" style="color:#1f4d3a;">Rp{{ number_format($rental->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="d-flex justify-content-end gap-3 flex-wrap mb-4">
            <a href="{{ route('admin.transaksi.show', $rental->id) }}" class="btn btn-custom-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
            <button type="submit" class="btn btn-custom-primary">
                <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mulai = document.getElementById('tanggal_mulai');
        const selesai = document.getElementById('tanggal_selesai');
        const durasi = document.getElementById('durasiRental');

        function hitungDurasi() {
            if (!mulai.value || !selesai.value) {
                durasi.textContent = '-';
                return;
            }
            const tanggalAwal = new Date(mulai.value + 'T00:00:00');
            const tanggalAkhir = new Date(selesai.value + 'T00:00:00');
            const selisih = Math.round((tanggalAkhir - tanggalAwal) / (1000 * 60 * 60 * 24));

            if (selisih < 0) {
                durasi.textContent = 'Tanggal tidak valid';
                return;
            }
            durasi.textContent = (selisih + 1) + ' Hari';
        }

        mulai.addEventListener('change', function () {
            selesai.min = mulai.value;
            if (selesai.value < mulai.value) {
                selesai.value = mulai.value;
            }
            hitungDurasi();
        });

        selesai.addEventListener('change', hitungDurasi);
        hitungDurasi();
    });
</script>

@endsection