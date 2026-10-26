
@extends(
    Auth::check() && Auth::user()->role === 'user'
        ? 'user.layouts.app'
        : 'layouts.katalog-public'
)

@section('title', 'Katalog GearCamp')

@section('page-title', 'Katalog Barang')

@section('content')
<style>
    .catalog-header {
        background: #eaf2ed;
        padding: 35px 25px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .catalog-header h2 {
        font-weight: 700;
        color: #1f4d3a;
    }

    .filter-box, .product-card, .empty-box {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,.05);
    }

    .filter-box {
        padding: 22px;
        margin-bottom: 30px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #dce4df;
    }

    .product-card {
        border: none;
        overflow: hidden;
        height: 100%;
        transition: .3s;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,.09);
    }

    .product-image, .no-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .no-image {
        background: #edf2ef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9aa9a0;
    }

    .product-body {
        padding: 20px;
    }

    .category-badge {
        display: inline-block;
        background: #e6f1eb;
        color: #1f4d3a;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .product-title {
        font-size: 18px;
        font-weight: 700;
        color: #26352b;
    }

    .product-description {
        color: #727d76;
        font-size: 14px;
        min-height: 42px;
    }

    .product-price {
        color: #1f4d3a;
        font-size: 19px;
        font-weight: 700;
    }

    .product-price small {
        color: #7b857e;
        font-size: 12px;
        font-weight: normal;
    }

    .stock {
        font-size: 13px;
        color: #66736b;
        margin: 12px 0;
    }

    .btn-detail, .btn-add-cart, .btn-filter {
        border-radius: 8px;
        padding: 10px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
    }

    .btn-detail {
        border: 1px solid #1f4d3a;
        color: #1f4d3a;
    }

    .btn-detail:hover {
        background: #1f4d3a;
        color: white;
    }

    .btn-add-cart, .btn-filter {
        background: #1f4d3a;
        color: white;
        border: none;
    }

    .btn-add-cart:hover, .btn-filter:hover {
        background: #163b2c;
        color: white;
    }

    .btn-add-cart:disabled {
        background: #adb8b1;
    }

    .empty-box {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-box i {
        color: #aab6ae;
        margin-bottom: 20px;
    }

    .empty-box h4 {
        color: #1f4d3a;
        font-weight: 700;
    }
</style>

<div class="catalog-header">
    <h2>Temukan Perlengkapan Camping</h2>
    <p class="text-secondary mb-0">
        Pilih perlengkapan yang kamu butuhkan untuk petualangan berikutnya.
    </p>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="filter-box">
    <form action="{{ url('/katalog') }}" method="GET">
        <div class="row g-3">
            <div class="col-md-8">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari perlengkapan camping..."
                >
            </div>

            <div class="col-md-4">
                <select name="kategori" class="form-select"
                    onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>

                    @foreach ($kategori as $itemKategori)
                        <option value="{{ $itemKategori }}"
                            {{ request('kategori') == $itemKategori ? 'selected' : '' }}>
                            {{ $itemKategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-filter">
                    <i class="fa-solid fa-magnifying-glass me-1"></i>
                    Cari Barang
                </button>
            </div>
        </div>
    </form>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-1">
            {{ request('kategori') ? 'Kategori: '.request('kategori') : 'Perlengkapan Camping' }}
        </h4>
        <p class="text-secondary mb-0">
            Pilih perlengkapan yang sesuai dengan kebutuhanmu.
        </p>
    </div>

    <span class="text-secondary">{{ $barang->count() }} barang</span>
</div>

<div class="row g-4">
    @forelse ($barang as $item)
        <div class="col-lg-4 col-md-6">
            <div class="product-card h-100">
                @if ($item->foto)
                    <img
                        src="{{ asset('storage/'.$item->foto) }}"
                        class="product-image"
                        alt="{{ $item->nama_barang }}"
                    >
                @else
                    <div class="no-image">
                        <i class="fa-solid fa-campground fa-4x"></i>
                    </div>
                @endif

                <div class="product-body">
                    <span class="category-badge">{{ $item->kategori }}</span>

                    <h5 class="product-title">{{ $item->nama_barang }}</h5>

                    <p class="product-description">
                        {{ $item->deskripsi ?? 'Perlengkapan camping berkualitas dari GearCamp.' }}
                    </p>

                    <div class="product-price">
                        Rp{{ number_format($item->harga_per_hari, 0, ',', '.') }}
                        <small>/ hari</small>
                    </div>

                    <div class="stock">
                        @if ($item->stok > 0)
                            <i class="fa-solid fa-box"></i>
                            Stok tersedia: <strong>{{ $item->stok }}</strong>
                        @else
                            <span class="text-danger">
                                <i class="fa-solid fa-circle-xmark"></i> Stok habis
                            </span>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('katalog.show', $item->id) }}"
                            class="btn-detail flex-fill">
                            <i class="fa-solid fa-eye me-1"></i> Detail
                        </a>

                        <form action="{{ route('cart.add', $item->id) }}"
                            method="POST" class="flex-fill">
                            @csrf
                            <button type="submit"
                                class="btn-add-cart w-100"
                                {{ $item->stok <= 0 ? 'disabled' : '' }}>
                                <i class="fa-solid fa-cart-plus"></i> Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-box">
                <i class="fa-solid fa-box-open fa-4x"></i>
                <h4>Barang Tidak Ditemukan</h4>
                <p class="text-secondary">
                    Coba ubah kata pencarian atau pilih kategori lain.
                </p>
                <a href="{{ url('/katalog') }}" class="btn btn-filter">
                    Tampilkan Semua Barang
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection
