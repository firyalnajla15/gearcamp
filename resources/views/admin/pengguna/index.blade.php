@extends('admin.layouts.app')

@section('title', 'Kelola Pengguna')
@section('page-heading', 'Kelola Pengguna')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .user-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .user-title {
        font-family: 'Fraunces', serif;
        color: #10271c;
        font-weight: 700;
        font-size: 28px;
    }

    /* Card Kustom */
    .custom-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 16px;
        box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05) !important;
    }

    /* Form Input & Select */
    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        background-color: #fafbfa;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1f4d3a;
        box-shadow: 0 0 0 4px rgba(31, 77, 58, 0.1);
        background-color: white;
    }

    /* Tabel */
    .user-table {
        margin-bottom: 0;
    }

    .user-table thead {
        background-color: #f7f9f7;
        border-bottom: 1px solid #e5e7eb;
    }

    .user-table th {
        color: #7b887e;
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        padding: 16px 20px;
        white-space: nowrap;
        border: none;
    }

    .user-table td {
        padding: 16px 20px;
        vertical-align: middle;
        font-size: 14px;
        color: #26352b;
        border-bottom: 1px solid #edf1ed;
    }

    .user-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .user-table tbody tr:hover {
        background-color: #fafbfa;
    }

    /* Avatar Inisial */
    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #eaf2ed;
        color: #1f4d3a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        box-shadow: inset 0 0 0 2px white, 0 2px 6px rgba(0,0,0,0.05);
    }

    /* Badge Status */
    .status-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .status-aktif {
        background: #eaf2ed;
        color: #1f4d3a;
        border: 1px solid #a7f3d0;
    }

    .status-diblokir {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
    }

    /* Tombol Aksi (Ikon) */
    .btn-action {
        width: 34px;
        height: 34px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #1f4d3a;
        background: white;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        background: #1f4d3a;
        color: white;
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
    }

    .pagination .active .page-link {
        background: #1f4d3a;
        border-color: #1f4d3a;
        color: white;
    }
</style>

<div class="user-wrap">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" style="background-color: #eaf2ed; color: #1f4d3a;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" style="background-color: #fee2e2; color: #991b1b;">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="user-title mb-2">Daftar Pengguna</h4>
            <p class="text-muted mb-0 fw-medium">
                Kelola data pelanggan dan status akun GearCamp.
            </p>
        </div>
    </div>

    <div class="custom-card p-4">

        {{-- FILTER --}}
        <form action="{{ route('admin.pengguna.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-5">
                <label class="form-label fw-bold small text-muted">Pencarian</label>
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari nama, email, atau nomor HP..."
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold small text-muted">Status Akun</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="diblokir" {{ request('status') == 'diblokir' ? 'selected' : '' }}>Diblokir</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn w-100 text-white fw-semibold py-2" style="background:#1f4d3a; border-radius: 10px;">
                    <i class="fa-solid fa-search me-1"></i> Cari
                </button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('admin.pengguna.index') }}" class="btn btn-light border w-100 py-2" style="border-radius: 10px;">
                    Reset
                </a>
            </div>
        </form>

        {{-- TABEL --}}
        <div class="table-responsive">
            <table class="table user-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4" width="70">No</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pengguna as $index => $user)
                        <tr>
                            <td class="ps-4 fw-semibold text-muted">{{ $pengguna->firstItem() + $index }}</td>

                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <strong style="color: #10271c;">{{ $user->name }}</strong>
                                </div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->phone ?: '-' }}</td>

                            <td>
                                <span class="status-badge {{ $user->status == 'aktif' ? 'status-aktif' : 'status-diblokir' }}">
                                    <i class="fa-solid {{ $user->status == 'aktif' ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>

                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.pengguna.show', $user->id) }}" class="btn-action" title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn-action" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.pengguna.status', $user->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="{{ $user->status == 'aktif' ? 'diblokir' : 'aktif' }}">
                                        <button type="submit" class="btn-action" title="{{ $user->status == 'aktif' ? 'Blokir' : 'Aktifkan' }}">
                                            <i class="fa-solid {{ $user->status == 'aktif' ? 'fa-ban' : 'fa-unlock' }}"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fa-solid fa-users fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                <h6 class="fw-bold text-dark mb-1">Belum ada data pengguna</h6>
                                <p class="text-muted mb-0 small">Data pengguna akan muncul di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($pengguna->hasPages())
            <div class="mt-4">
                {{ $pengguna->links() }}
            </div>
        @endif
    </div>

</div>

@endsection