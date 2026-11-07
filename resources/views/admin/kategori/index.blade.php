@extends('admin.layouts.app')

@section('title', 'Kelola Kategori - GearCamp')
@section('page-heading', 'Kelola Kategori')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .kategori-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .kategori-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    /* Card Kustom */
    .custom-card {
        border: 1px solid #edf1ed;
        border-radius: 16px;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
        background: white;
    }

    /* Tabel */
    .kategori-table {
        margin-bottom: 0;
    }

    .kategori-table thead {
        background-color: #f7f9f7;
        border-bottom: 1px solid #e5e7eb;
    }

    .kategori-table th {
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #7b887e;
        font-weight: 700;
        padding: 16px 20px;
        white-space: nowrap;
        border: none;
    }

    .kategori-table td {
        font-size: 14px;
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #edf1ed;
        color: #26352b;
    }

    .kategori-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .kategori-table tbody tr:hover {
        background-color: #fafbfa;
    }

    /* Badge Kategori */
    .kategori-badge {
        background: #eaf2ed;
        color: #1f4d3a;
        padding: 7px 14px;
        border-radius: 50px;
        font-size: 12.5px;
        font-weight: 700;
        display: inline-block;
    }

    /* Tombol Tambah */
    .btn-tambah {
        background: #1f4d3a;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.28s ease;
        box-shadow: 0 4px 12px -4px rgba(31, 77, 58, 0.5);
    }

    .btn-tambah:hover {
        background: #10271c;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -6px rgba(16, 39, 28, 0.8);
    }

    /* Tombol Aksi (Edit & Hapus) - Diperbaiki agar sejajar ke samping */
    .aksi-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px; /* Jarak antar tombol */
    }

    .btn-aksi {
        width: 34px;
        height: 34px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        border: none;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 13px;
    }

    .btn-aksi:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-edit {
        background: #edf3fa;
        color: #4775a9;
    }

    .btn-hapus {
        background: #fceaea;
        color: #c34d4d;
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

    /* Alert Custom */
    .alert {
        border-radius: 12px;
        border: none;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .alert-success { background-color: #eaf2ed; color: #1f4d3a; }
    .alert-danger { background-color: #fee2e2; color: #991b1b; }

    /* =========================================
       MODAL KONFIRMASI HAPUS (DIPERKECIL MAKSIMAL)
       ========================================= */
    .hapus-modal .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 50px -10px rgba(0, 0, 0, .3);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .hapus-modal .modal-body {
        padding: 24px 20px 20px;
        text-align: center;
    }

    /* Ikon dikecilkan jadi 50px saja */
    .hapus-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fee2e2;
        color: #dc3545;
        border-radius: 50%;
        font-size: 20px;
        box-shadow: 0 4px 10px -2px rgba(220, 53, 69, 0.3);
    }

    .hapus-modal-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .hapus-modal-desc {
        color: #6b7280;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .hapus-modal .modal-footer {
        border-top: 1px solid #edf1ed;
        padding: 12px 20px 20px;
        justify-content: center;
        gap: 8px;
    }

    .btn-batal-hapus {
        background: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px 20px;
        font-size: 13px;
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
        border-radius: 8px;
        padding: 8px 20px;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.28s ease;
        box-shadow: 0 4px 10px -4px rgba(220, 53, 69, 0.6);
    }

    .btn-konfirmasi-hapus:hover {
        background: #b02a37;
        color: white;
    }
</style>

<div class="kategori-wrapper">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="kategori-title mb-2">Daftar Kategori Barang</h4>
            <p class="text-muted mb-0 fw-medium">
                Kelola kategori perlengkapan camping GearCamp.
            </p>
        </div>

        <a href="{{ route('admin.kategori.create') }}" class="btn-tambah">
            <i class="fa-solid fa-plus me-2"></i> Tambah Kategori
        </a>
    </div>

    {{-- TABEL --}}
    <div class="custom-card overflow-hidden">
        <div class="table-responsive">
            <table class="table kategori-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4" width="70">No.</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th width="130">Jumlah Barang</th>
                        <th width="120" class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kategori as $index => $item)
                        <tr>
                            <td class="ps-4 text-muted fw-semibold">
                                {{ $kategori->firstItem() + $index }}
                            </td>

                            <td>
                                <span class="kategori-badge">
                                    {{ $item->nama_kategori }}
                                </span>
                            </td>

                            <td class="text-muted">
                                {{ $item->deskripsi ?: '-' }}
                            </td>

                            <td>
                                <span class="fw-bold" style="color: #1f4d3a;">
                                    {{ $item->barang_count }}
                                </span>
                                <small class="text-muted fw-medium">barang</small>
                            </td>

                            {{-- AKSI EDIT & HAPUS DIBUAT SEJAJAR KE SAMPING --}}
                            <td class="text-center pe-4">
                                <div class="aksi-group">
                                    <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                       class="btn-aksi btn-edit"
                                       title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.kategori.destroy', $item->id) }}"
                                          method="POST"
                                          class="m-0 form-hapus-kategori"
                                          data-nama="{{ $item->nama_kategori }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn-aksi btn-hapus btn-buka-modal-hapus"
                                                title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fa-solid fa-tags fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                <h6 class="fw-bold text-dark mb-1">Belum ada kategori</h6>
                                <p class="text-muted mb-0 small">
                                    Tambahkan kategori barang pertama kamu.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($kategori->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-4 border-top" style="border-color: #edf1ed !important;">
                <small class="text-muted fw-medium">
                    Halaman <strong>{{ $kategori->currentPage() }}</strong> dari <strong>{{ $kategori->lastPage() }}</strong>
                </small>
                {{ $kategori->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>

<!-- MODAL KONFIRMASI HAPUS KATEGORI (UKURAN KECIL) -->
<div class="modal fade hapus-modal" id="modalHapusKategori" tabindex="-1" aria-labelledby="modalHapusKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="hapus-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>

                <h5 class="hapus-modal-title" id="modalHapusKategoriLabel">
                    Hapus Kategori?
                </h5>

                <p class="hapus-modal-desc">
                    Yakin ingin menghapus <br>
                    <strong id="namaKategoriHapus" style="color:#10271c; font-size: 14px;"></strong>? <br>
                    <span style="font-size: 12px; color: #9ca3af; margin-top: 4px; display: block;">Data tidak dapat dikembalikan.</span>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-batal-hapus" data-bs-dismiss="modal">
                    Batal
                </button>

                <button type="button" class="btn btn-konfirmasi-hapus" id="btnKonfirmasiHapus">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('modalHapusKategori');
    const modalHapus = new bootstrap.Modal(modalElement);

    const namaKategori = document.getElementById('namaKategoriHapus');
    const tombolKonfirmasi = document.getElementById('btnKonfirmasiHapus');

    let formYangAkanDihapus = null;

    document.querySelectorAll('.btn-buka-modal-hapus').forEach(function (button) {
        button.addEventListener('click', function () {
            formYangAkanDihapus = this.closest('.form-hapus-kategori');

            const nama = formYangAkanDihapus.dataset.nama;

            namaKategori.textContent = '"' + nama + '"';

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