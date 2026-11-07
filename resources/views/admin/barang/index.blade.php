@extends('admin.layouts.app')

@section('title', 'Kelola Barang')
@section('page-heading', 'Kelola Barang')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .barang-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    /* Form Input & Select */
    .barang-filter {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        background-color: #fafbfa;
        transition: all 0.3s ease;
    }

    .barang-filter:focus {
        border-color: #1f4d3a;
        box-shadow: 0 0 0 4px rgba(31, 77, 58, .1);
        background-color: white;
    }

    /* Tombol Tambah */
    .btn-tambah {
        background: #1f4d3a;
        color: white;
        border-radius: 10px;
        padding: 11px 20px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: all 0.28s ease;
        box-shadow: 0 4px 12px -4px rgba(31, 77, 58, 0.5);
    }

    .btn-tambah:hover {
        background: #10271c;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -6px rgba(16, 39, 28, 0.8);
    }

    /* Tombol Cari & Reset */
    .btn-search {
        background: #1f4d3a;
        color: white;
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .btn-search:hover {
        background: #10271c;
        color: white;
    }

    /* Card Kustom */
    .custom-card {
        border: 1px solid #edf1ed;
        border-radius: 16px;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
        background: white;
    }

    /* Tabel */
    .barang-table {
        margin-bottom: 0;
    }
    
    .barang-table thead {
        background-color: #f7f9f7;
        border-bottom: 1px solid #e5e7eb;
    }

    .barang-table th {
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #7b887e;
        font-weight: 700;
        padding: 16px 20px;
        white-space: nowrap;
        border: none;
    }

    .barang-table td {
        font-size: 14px;
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #edf1ed;
        color: #26352b;
    }

    .barang-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .barang-table tbody tr:hover {
        background-color: #fafbfa;
    }

    /* Foto Barang */
    .foto-barang {
        width: 60px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #edf1ed;
        display: block;
        background: #f7f9f7;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    /* Kustomisasi Badge Stok */
    .badge-stok {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 11.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-stok-habis {
        background-color: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
    }

    .badge-stok-menipis {
        background-color: #fef3c7;
        color: #b45309;
        border: 1px solid #fcd34d;
    }

    .badge-stok-aman {
        background-color: #eaf2ed;
        color: #1f4d3a;
        border: 1px solid #a7f3d0;
    }

    /* Tombol Aksi (Ikon) */
    .barang-action {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-size: 13px;
    }

    .barang-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: #eaf2ed;
        color: #10271c;
        border-color: #1f4d3a;
    }

    .pagination .active .page-link {
        background: #1f4d3a;
        border-color: #1f4d3a;
        color: white;
        box-shadow: 0 4px 10px -4px rgba(31, 77, 58, 0.5);
    }

    .pagination .disabled .page-link {
        color: #adb8b1;
        background-color: #fafbfa;
        border-color: #e5e7eb;
    }

    /* =========================================
       MODAL KONFIRMASI HAPUS (DIPERCANTIK)
       ========================================= */
    .hapus-modal .modal-content {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, .25);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .hapus-modal .modal-body {
        padding: 40px 30px 30px;
        text-align: center;
    }

    .hapus-icon {
        width: 85px;
        height: 85px;
        margin: 0 auto 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fee2e2;
        color: #dc3545;
        border-radius: 50%;
        font-size: 32px;
        box-shadow: 0 8px 20px -5px rgba(220, 53, 69, 0.3);
        animation: pulseDanger 2s infinite;
    }

    @keyframes pulseDanger {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
        70% { box-shadow: 0 0 0 15px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }

    .hapus-modal-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .hapus-modal-desc {
        color: #6b7280;
        font-size: 14.5px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .hapus-modal .modal-footer {
        border-top: 1px solid #edf1ed;
        padding: 20px 30px 30px;
        justify-content: center;
        gap: 12px;
    }

    .btn-batal-hapus {
        background: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 28px;
        font-size: 14.5px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-batal-hapus:hover {
        background: #e5e7eb;
        color: #111827;
    }

    .btn-konfirmasi-hapus {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-size: 14.5px;
        font-weight: 700;
        transition: all 0.28s ease;
        box-shadow: 0 8px 20px -8px rgba(220, 53, 69, 0.6);
    }

    .btn-konfirmasi-hapus:hover {
        background: #b02a37;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -8px rgba(176, 42, 55, 0.8);
    }
</style>

<div class="barang-wrap container-fluid px-0">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-2" style="font-family: 'Fraunces', serif; font-size: 28px; color: #10271c;">
                Data Barang
            </h4>
            <p class="text-muted mb-0 fw-medium">
                Kelola seluruh barang rental GearCamp.
            </p>
        </div>

        <a href="{{ route('admin.barang.create') }}" class="btn btn-tambah">
            <i class="fas fa-plus me-2"></i>Tambah Barang
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4" style="background-color: #eaf2ed; color: #1f4d3a;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER --}}
    <div class="custom-card mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.barang.index') }}" method="GET" class="row g-3 align-items-end">

                <div class="col-md-5">
                    <label class="form-label fw-bold small text-muted">Kategori Barang</label>
                    <select name="kategori" class="form-select barang-filter" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $itemKategori)
                            <option value="{{ $itemKategori }}" {{ request('kategori') == $itemKategori ? 'selected' : '' }}>
                                {{ $itemKategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-bold small text-muted">Cari Barang</label>
                    <input type="text"
                           name="search"
                           class="form-control barang-filter"
                           placeholder="Cari nama atau kategori barang..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-search flex-grow-1 py-2">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admin.barang.index') }}" class="btn btn-light border py-2" style="border-radius: 10px;" title="Reset filter">
                        <i class="fas fa-sync-alt text-muted"></i>
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- INFORMASI HASIL --}}
    <div class="d-flex justify-content-between align-items-center mb-3 px-1">
        <div class="text-muted small fw-medium">
            Menampilkan <strong>{{ $barang->firstItem() ?? 0 }}</strong>
            - <strong>{{ $barang->lastItem() ?? 0 }}</strong>
            dari <strong>{{ $barang->total() }}</strong> barang
        </div>

        @if(request('kategori'))
            <span class="badge" style="background-color: #eaf2ed; color: #1f4d3a; font-size: 12px; padding: 6px 12px;">
                <i class="fa-solid fa-filter me-1"></i> Kategori: {{ request('kategori') }}
            </span>
        @endif
    </div>

    {{-- TABEL --}}
    <div class="custom-card overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle barang-table">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga / Hari</th>
                        <th>Status Stok</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barang as $item)
                        @php
                            $foto = $item->foto;
                            $fotoUrl = null;

                            if ($foto) {
                                if (\Illuminate\Support\Str::startsWith($foto, ['http://', 'https://'])) {
                                    $fotoUrl = $foto;
                                } else {
                                    $foto = ltrim(str_replace('storage/', '', $foto), '/');
                                    $fotoUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($foto);
                                }
                            }
                        @endphp

                        <tr>
                            <td class="ps-4 fw-semibold text-muted">
                                {{ $barang->firstItem() + $loop->index }}
                            </td>

                            <td>
                                @if($fotoUrl)
                                    <img src="{{ $fotoUrl }}" alt="{{ $item->nama_barang }}" class="foto-barang" loading="lazy" onerror="this.onerror=null; this.src='https://placehold.co/100x100?text=No+Image';">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px;height:50px;border:1px dashed #d1d5db;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>

                            <td class="fw-bold" style="color: #10271c;">
                                {{ $item->nama_barang }}
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border" style="font-weight: 600; padding: 6px 10px;">
                                    {{ $item->kategori }}
                                </span>
                            </td>

                            <td class="fw-bold" style="color: #1f4d3a;">
                                Rp{{ number_format($item->harga_per_hari, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($item->stok == 0)
                                    <span class="badge-stok badge-stok-habis">
                                        <i class="fa-solid fa-circle-xmark"></i> Habis
                                    </span>
                                @elseif($item->stok <= 5)
                                    <span class="badge-stok badge-stok-menipis">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Sisa {{ $item->stok }}
                                    </span>
                                @else
                                    <span class="badge-stok badge-stok-aman">
                                        <i class="fa-solid fa-circle-check"></i> {{ $item->stok }} Tersedia
                                    </span>
                                @endif
                            </td>

                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.barang.show', $item->id) }}" class="btn btn-sm btn-outline-secondary barang-action" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.barang.edit', $item->id) }}" class="btn btn-sm btn-outline-primary barang-action" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" class="form-hapus-barang" data-nama="{{ $item->nama_barang }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger barang-action btn-buka-modal-hapus" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                <h6 class="fw-bold text-dark mb-1">Barang Tidak Ditemukan</h6>
                                <p class="text-muted mb-0 small">Coba sesuaikan kata kunci pencarian atau filter Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($barang->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-4 border-top" style="border-color: #edf1ed !important;">
                <small class="text-muted fw-medium">
                    Halaman <strong>{{ $barang->currentPage() }}</strong> dari <strong>{{ $barang->lastPage() }}</strong>
                </small>
                {{ $barang->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>

<!-- MODAL KONFIRMASI HAPUS YANG SUDAH DIPERCANTIK -->
<div class="modal fade hapus-modal" id="modalHapusBarang" tabindex="-1" aria-labelledby="modalHapusBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="hapus-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>

                <h5 class="hapus-modal-title" id="modalHapusBarangLabel">
                    Hapus Barang?
                </h5>

                <p class="hapus-modal-desc">
                    Apakah kamu yakin ingin menghapus barang <br>
                    <strong id="namaBarangHapus" style="color:#10271c; font-size: 16px;"></strong>? <br>
                    <span style="font-size: 13px; color: #9ca3af; margin-top: 5px; display: block;">Data yang sudah dihapus tidak dapat dikembalikan.</span>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-batal-hapus" data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="button" class="btn btn-konfirmasi-hapus" id="btnKonfirmasiHapus">
                    <i class="fas fa-trash-alt me-2"></i>Ya, Hapus Barang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('modalHapusBarang');
    const modalHapus = new bootstrap.Modal(modalElement);

    const namaBarang = document.getElementById('namaBarangHapus');
    const tombolKonfirmasi = document.getElementById('btnKonfirmasiHapus');

    let formYangAkanDihapus = null;

    document.querySelectorAll('.btn-buka-modal-hapus').forEach(function (button) {
        button.addEventListener('click', function () {
            formYangAkanDihapus = this.closest('.form-hapus-barang');

            const nama = formYangAkanDihapus.dataset.nama;

            namaBarang.textContent = '"' + nama + '"';

            modalHapus.show();
        });
    });

    tombolKonfirmasi.addEventListener('click', function () {
        if (formYangAkanDihapus) {
            formYangAkanDihapus.submit();
        }
    });

    modalElement.addEventListener('hidden.bs.modal', function () {
        formYangAkanDihapus = null;
    });
});
</script>

@endsection