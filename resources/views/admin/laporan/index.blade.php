@extends('admin.layouts.app')

@section('title', 'Laporan & Statistik')
@section('page-heading', 'Laporan & Statistik')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .laporan-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    /* Kartu Statistik (Dibuat lebih ringkas) */
    .report-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.03);
        transition: all 0.35s cubic-bezier(.22, .61, .36, 1);
        position: relative;
        overflow: hidden;
    }

    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -15px rgba(16, 39, 28, 0.12);
        border-color: transparent;
    }

    /* Ikon Kotak (Dikecilkan sedikit) */
    .report-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .report-card:hover .report-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .report-label {
        color: #6b7a70;
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 6px;
        letter-spacing: 0.02em;
        line-height: 1.3;
    }

    .report-value {
        color: #10271c;
        font-family: 'Fraunces', serif;
        font-size: 26px;
        font-weight: 700;
        line-height: 1.2;
    }

    /* Card Filter */
    .filter-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.03);
    }

    .filter-card h6 {
        font-family: 'Fraunces', serif;
        font-size: 20px;
        color: #10271c;
    }

    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 14px;
        background-color: #fafbfa;
        color: #1f2937;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1f4d3a;
        box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
        background-color: white;
    }

    /* Tabel */
    .report-table {
        margin-bottom: 0;
    }

    .report-table thead {
        background-color: #f7f9f7;
        border-bottom: 1px solid #e5e7eb;
    }

    .report-table th {
        color: #7b887e;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        padding: 16px 20px;
        white-space: nowrap;
        border: none;
    }

    .report-table td {
        padding: 16px 20px;
        vertical-align: middle;
        font-size: 14px;
        color: #26352b;
        border-bottom: 1px solid #edf1ed;
    }

    .report-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .report-table tbody tr:hover {
        background-color: #fafbfa;
    }

    /* Badge Status */
    .status-label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .status-menunggu { background: #fef3c7; color: #b45309; border: 1px solid #fcd34d; }
    .status-selesai { background: #eaf2ed; color: #1f4d3a; border: 1px solid #a7f3d0; }
    .status-dibatalkan { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
    .status-lain { background: #f3f4f6; color: #4b5563; border: 1px solid #d1d5db; }

    /* Tombol Aksi */
    .btn-filter-custom {
        background: #1f4d3a;
        color: white;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: all 0.28s ease;
        box-shadow: 0 4px 12px -4px rgba(31, 77, 58, 0.5);
    }

    .btn-filter-custom:hover {
        background: #10271c;
        color: white;
        transform: translateY(-2px);
    }

    .btn-export {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 20px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.28s ease;
        box-shadow: 0 4px 12px -4px rgba(220, 53, 69, 0.4);
    }

    .btn-export:hover {
        background: #b02a37;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -6px rgba(176, 42, 55, 0.6);
    }

    /* Pagination */
    .pagination {
        margin-bottom: 0;
        gap: 6px;
    }

    .pagination .page-link {
        font-size: 13px;
        padding: 8px 14px;
        border-radius: 8px !important;
        color: #1f4d3a;
        border: 1px solid #e5e7eb;
        font-weight: 600;
    }

    .pagination .active .page-link {
        background: #1f4d3a;
        border-color: #1f4d3a;
        color: white;
    }
</style>

<div class="laporan-wrap">

    {{-- KARTU STATISTIK ATAS (5 KOTAK SEJAJAR) --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">

        {{-- 1. Total Transaksi --}}
        <div class="col">
            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="report-label">Total Transaksi</div>
                    <div class="report-icon" style="background:#eaf2ed;color:#1f4d3a;">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
                <div class="report-value">{{ number_format($totalTransaksi) }}</div>
            </div>
        </div>

        {{-- 2. Total Pendapatan Lunas --}}
        <div class="col">
            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="report-label">Total Pendapatan Lunas</div>
                    <div class="report-icon" style="background:#eaf2ed;color:#1f4d3a;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="report-value" style="font-size:22px;">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>
            </div>
        </div>

        {{-- 3. Transaksi Menunggu --}}
        <div class="col">
            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="report-label">Transaksi Menunggu</div>
                    <div class="report-icon" style="background:#fff4d8;color:#a66b00;">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="report-value">{{ number_format($transaksiMenunggu) }}</div>
            </div>
        </div>

        {{-- 4. Transaksi Selesai --}}
        <div class="col">
            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="report-label">Transaksi Selesai</div>
                    <div class="report-icon" style="background:#eaf2ed;color:#1f4d3a;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="report-value">{{ number_format($transaksiSelesai) }}</div>
            </div>
        </div>

        {{-- 5. Transaksi Dibatalkan (Dipindah ke sini) --}}
        <div class="col">
            <div class="report-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="report-label">Transaksi Dibatalkan</div>
                    <div class="report-icon" style="background:#fee2e2;color:#b91c1c;">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>
                <div class="report-value">{{ number_format($transaksiDibatalkan) }}</div>
            </div>
        </div>

    </div>

    {{-- FILTER LAPORAN --}}
    <div class="filter-card mb-4">
        <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
            <i class="fa-solid fa-filter" style="color:#d49a4a;"></i>
            Filter Laporan
        </h6>

        <form action="{{ route('admin.laporan.index') }}" method="GET">
            <div class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Tanggal Mulai Rental</label>
                    <input type="date"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ request('tanggal_mulai') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Tanggal Selesai Rental</label>
                    <input type="date"
                           name="tanggal_selesai"
                           class="form-control"
                           value="{{ request('tanggal_selesai') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Status Transaksi</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu" @selected(request('status') == 'menunggu')>Menunggu</option>
                        <option value="diproses" @selected(request('status') == 'diproses')>Diproses</option>
                        <option value="disewa" @selected(request('status') == 'disewa')>Sedang Disewa</option>
                        <option value="selesai" @selected(request('status') == 'selesai')>Selesai</option>
                        <option value="dibatalkan" @selected(request('status') == 'dibatalkan')>Dibatalkan</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-filter-custom flex-grow-1">
                        <i class="fa-solid fa-search me-1"></i> Terapkan
                    </button>

                    <a href="{{ route('admin.laporan.index') }}"
                       class="btn btn-light border py-2"
                       style="border-radius: 10px;"
                       title="Reset filter">
                        <i class="fa-solid fa-sync-alt text-muted"></i>
                    </a>
                </div>

            </div>
        </form>
    </div>

    {{-- TABEL RIWAYAT TRANSAKSI --}}
    <div class="custom-card overflow-hidden" style="background: white; border-radius: 18px; border: 1px solid #edf1ed; box-shadow: 0 4px 15px -8px rgba(0,0,0,0.03);">
        <div class="p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-3" style="border-color: #edf1ed !important;">
            <div>
                <h5 class="fw-bold mb-1" style="font-family: 'Fraunces', serif; color: #10271c;">Riwayat Transaksi Rental</h5>
                <p class="text-muted small mb-0 fw-medium">
                    Daftar transaksi berdasarkan filter yang dipilih.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="badge" style="background: #eaf2ed; color: #1f4d3a; font-size: 12px; padding: 8px 12px; border-radius: 8px;">
                    <i class="fa-solid fa-database me-1"></i> {{ $laporan->total() }} Data
                </span>

                <a href="{{ route('admin.laporan.export-pdf', request()->query()) }}" class="btn-export">
                    <i class="fa-solid fa-file-pdf me-2"></i> Export PDF
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table report-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Kode Rental</th>
                        <th>Penyewa</th>
                        <th>Tanggal Rental</th>
                        <th>Durasi</th>
                        <th>Total Harga</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th class="pe-4">Barang</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($laporan as $index => $item)
                        <tr>
                            <td class="ps-4 fw-semibold text-muted">{{ $laporan->firstItem() + $index }}</td>

                            <td>
                                <strong style="color: #1f4d3a;">{{ $item->kode_rental }}</strong>
                            </td>

                            <td class="fw-semibold">{{ $item->user->name ?? '-' }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}
                                <br>
                                <small class="text-muted fw-medium" style="font-size: 11.5px;">
                                    s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                </small>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border">{{ $item->total_hari }} Hari</span>
                            </td>

                            <td class="fw-bold" style="color: #1f4d3a;">
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="status-label {{ $item->status_pembayaran == 'lunas' ? 'status-selesai' : 'status-menunggu' }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status_pembayaran)) }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $statusClass = match($item->status) {
                                        'menunggu' => 'status-menunggu',
                                        'selesai' => 'status-selesai',
                                        'dibatalkan' => 'status-dibatalkan',
                                        default => 'status-lain',
                                    };
                                @endphp

                                <span class="status-label {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td class="pe-4" style="min-width: 180px;">
                                @foreach($item->details as $detail)
                                    <div class="small mb-1" style="font-weight: 600; color: #374151;">
                                        <i class="fa-solid fa-box fa-xs me-1" style="color: #9ca3af;"></i>
                                        {{ $detail->barang->nama_barang ?? 'Barang dihapus' }}
                                        <span class="text-muted fw-normal" style="font-size: 12px;">
                                            ({{ $detail->jumlah }}x)
                                        </span>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fa-solid fa-file-circle-xmark fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                <h6 class="fw-bold text-dark mb-1">Belum ada data</h6>
                                <p class="text-muted mb-0 small">Tidak ada data transaksi rental yang sesuai dengan filter Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($laporan->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-4 border-top" style="border-color: #edf1ed !important;">
                <small class="text-muted fw-medium">
                    Halaman <strong>{{ $laporan->currentPage() }}</strong> dari <strong>{{ $laporan->lastPage() }}</strong>
                </small>
                {{ $laporan->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>

@endsection