@extends('admin.layouts.app')

@section('title', 'Kelola Transaksi')
@section('page-heading', 'Kelola Transaksi')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .transaksi-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .transaksi-title {
        font-family: 'Fraunces', serif;
        font-size: 28px;
        color: #10271c;
        font-weight: 700;
    }

    /* Kartu Statistik Atas */
    .stat-card {
        background: white;
        border: 1px solid #edf1ed;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 4px 15px -8px rgba(0,0,0,.03);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .stat-number {
        font-family: 'Fraunces', serif;
        font-size: 26px;
        font-weight: 700;
        color: #10271c;
    }

    .stat-label {
        font-size: 12.5px;
        color: #6b7a70;
        font-weight: 600;
    }

    /* Card Kustom */
    .custom-card {
        background: white;
        border: 1px solid #edf1ed;
        border-radius: 16px;
        box-shadow: 0 4px 15px -8px rgba(0,0,0,.05);
    }

    /* Form Filter */
    .transaksi-filter {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        background: #fafbfa;
        transition: all 0.3s ease;
    }

    .transaksi-filter:focus {
        border-color: #1f4d3a;
        box-shadow: 0 0 0 4px rgba(31,77,58,.1);
        background: white;
    }

    .btn-search {
        background: #1f4d3a;
        color: white;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-search:hover {
        background: #10271c;
        color: white;
    }

    /* Tabel */
    .transaksi-table {
        margin-bottom: 0;
    }

    .transaksi-table thead {
        background: #f7f9f7;
        border-bottom: 1px solid #e5e7eb;
    }

    .transaksi-table th {
        color: #7b887e;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
        padding: 16px 20px;
        white-space: nowrap;
        border: none;
    }

    .transaksi-table td {
        padding: 16px 20px;
        font-size: 14px;
        vertical-align: middle;
        border-bottom: 1px solid #edf1ed;
    }

    .transaksi-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .transaksi-table tbody tr:hover {
        background: #fafbfa;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu { background: #fef3c7; color: #b45309; border: 1px solid #fcd34d; }
    .status-diproses { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .status-disewa { background: #ede9fe; color: #6d28d9; border: 1px solid #ddd6fe; }
    .status-selesai { background: #eaf2ed; color: #1f4d3a; border: 1px solid #a7f3d0; }
    .status-dibatalkan, .status-ditolak { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }

    /* Tombol Detail */
    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #eaf2ed;
        color: #1f4d3a;
        border: 1px solid #cce0d4;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-detail:hover {
        background: #1f4d3a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Pagination */
    .pagination { gap: 6px; margin-bottom: 0; }
    .pagination .page-link {
        border-radius: 8px !important;
        color: #1f4d3a;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid #e5e7eb;
    }
    .pagination .active .page-link {
        background: #1f4d3a;
        border-color: #1f4d3a;
        color: white;
    }
</style>

<div class="transaksi-wrap container-fluid px-0">

    {{-- JUDUL --}}
    <div class="mb-4 pb-2">
        <h4 class="transaksi-title mb-2">Data Transaksi Rental</h4>
        <p class="text-muted small mb-0 fw-medium">
            Pantau dan kelola seluruh aktivitas penyewaan barang GearCamp.
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label">Total Transaksi</span>
                    <div class="stat-icon" style="background:#eaf2ed;color:#1f4d3a;">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $totalTransaksi }}</div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label">Menunggu</span>
                    <div class="stat-icon" style="background:#fef3c7;color:#b45309;">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $menunggu }}</div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label">Diproses</span>
                    <div class="stat-icon" style="background:#dbeafe;color:#1d4ed8;">
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $diproses }}</div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label">Sedang Disewa</span>
                    <div class="stat-icon" style="background:#ede9fe;color:#6d28d9;">
                        <i class="fa-solid fa-tent"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $sedangDisewa }}</div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="stat-label">Selesai</span>
                    <div class="stat-icon" style="background:#eaf2ed;color:#1f4d3a;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $selesai }}</div>
            </div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="custom-card mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.transaksi.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-6">
                        <label class="form-label small fw-bold text-muted">Cari Transaksi</label>
                        <input type="text" name="search" class="form-control transaksi-filter" placeholder="Cari kode rental, nama, atau email penyewa..." value="{{ request('search') }}">
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label small fw-bold text-muted">Filter Status</label>
                        <select name="status" class="form-select transaksi-filter">
                            <option value="">Semua Status</option>
                            <option value="menunggu" @selected(request('status') == 'menunggu')>Menunggu</option>
                            <option value="diproses" @selected(request('status') == 'diproses')>Diproses</option>
                            <option value="disewa" @selected(request('status') == 'disewa')>Sedang Disewa</option>
                            <option value="selesai" @selected(request('status') == 'selesai')>Selesai</option>
                            <option value="ditolak" @selected(request('status') == 'ditolak')>Ditolak</option>
                            <option value="dibatalkan" @selected(request('status') == 'dibatalkan')>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-lg-2 d-flex gap-2">
                        <button type="submit" class="btn btn-search flex-grow-1 py-2">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-light border py-2" style="border-radius:10px;" title="Reset filter">
                            <i class="fa-solid fa-rotate-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- INFORMASI --}}
    <div class="d-flex justify-content-between align-items-center mb-3 px-1">
        <div class="text-muted small fw-medium">
            Menampilkan <strong>{{ $transaksi->firstItem() ?? 0 }}</strong> - <strong>{{ $transaksi->lastItem() ?? 0 }}</strong> dari <strong>{{ $transaksi->total() }}</strong> transaksi
        </div>
    </div>

    {{-- TABEL --}}
    <div class="custom-card overflow-hidden">
        <div class="table-responsive">
            <table class="table transaksi-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Kode Rental</th>
                        <th>Penyewa</th>
                        <th>Tanggal Rental</th>
                        <th>Durasi</th>
                        <th>Total Biaya</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $item)
                        @php
                            $status = strtolower($item->status);
                            $statusClass = 'status-' . $status;
                            $statusLabel = [
                                'menunggu' => 'Menunggu',
                                'diproses' => 'Diproses',
                                'disewa' => 'Sedang Disewa',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                                'dibatalkan' => 'Dibatalkan',
                            ][$status] ?? ucfirst($status);
                        @endphp
                        <tr>
                            <td class="ps-4 fw-semibold text-muted">{{ $transaksi->firstItem() + $loop->index }}</td>
                            <td><span class="fw-bold" style="color:#1f4d3a;">{{ $item->kode_rental }}</span></td>
                            <td>
                                <div class="fw-bold" style="color:#10271c;">{{ $item->user->name ?? 'Pengguna' }}</div>
                                <small class="text-muted">{{ $item->user->email ?? '-' }}</small>
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</div>
                                <small class="text-muted">s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</small>
                            </td>
                            <td>{{ $item->total_hari }} hari</td>
                            <td class="fw-bold" style="color:#1f4d3a;">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status_pembayaran == 'lunas')
                                    <span class="status-badge status-selesai">Lunas</span>
                                @else
                                    <span class="status-badge status-menunggu">Belum Bayar</span>
                                @endif
                            </td>
                            <td><span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                            <td class="text-center pe-4">
                                <a href="{{ route('admin.transaksi.show', $item->id) }}" class="btn-detail" title="Lihat Detail Transaksi">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fa-solid fa-receipt fa-3x text-muted mb-3" style="opacity:.3;"></i>
                                <h6 class="fw-bold text-dark mb-1">Transaksi Tidak Ditemukan</h6>
                                <p class="text-muted small mb-0">Belum ada transaksi atau data tidak sesuai pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($transaksi->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-4 border-top" style="border-color: #edf1ed !important;">
                <small class="text-muted fw-medium">
                    Halaman <strong>{{ $transaksi->currentPage() }}</strong> dari <strong>{{ $transaksi->lastPage() }}</strong>
                </small>
                {{ $transaksi->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

@endsection