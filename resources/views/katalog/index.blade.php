@extends(
    Auth::check() && Auth::user()->role === 'user'
        ? 'user.layouts.app'
        : 'layouts.katalog-public'
)

@section('title', 'Katalog GearCamp')

@section('page-title', 'Katalog Barang')

@section('content')
<style>
    /* Import Font yang sama dengan halaman utama */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap');

    /* Variabel Warna (Senada dengan Home) */
    :root {
        --green-900: #10271c;
        --green-800: #183b2b;
        --green-700: #2f6b4f;
        --green-100: #e8f1ec;
        --gold-500: #d49a4a;
        --gold-600: #b77e35;
        --ink-900: #1f2933;
        --ink-500: #6b7280;
        --line: #e5e7eb;
        --paper: #f8faf9;
    }

    /* Base Font */
    body {
        font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        color: var(--ink-900);
    }

    /* Header Katalog */
    .catalog-header {
        background: linear-gradient(135deg, var(--green-100) 0%, #f4f8f5 100%);
        padding: 45px 35px;
        border-radius: 20px;
        margin-bottom: 35px;
        border: 1px solid rgba(47, 107, 79, 0.1);
        position: relative;
        overflow: hidden;
    }

    .catalog-header::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(var(--green-700) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.05;
        pointer-events: none;
    }

    .catalog-header h2 {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        color: var(--green-800);
        font-size: 32px;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .catalog-header p {
        font-size: 16px;
        position: relative;
        z-index: 1;
    }

    /* Filter Box */
    .filter-box, .product-card, .empty-box {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 30px -12px rgba(16, 39, 28, 0.08);
        border: 1px solid var(--line);
    }

    .filter-box {
        padding: 25px;
        margin-bottom: 35px;
    }

    /* Form Input */
    .form-control, .form-select {
        border-radius: 10px;
        padding: 14px 18px;
        border: 1px solid var(--line);
        font-size: 15px;
        color: var(--ink-900);
        transition: all 0.3s ease;
        background-color: var(--paper);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--green-700);
        box-shadow: 0 0 0 4px rgba(47, 107, 79, 0.1);
        background-color: white;
    }

    /* Product Card */
    .product-card {
        border: 1px solid var(--line);
        overflow: hidden;
        height: 100%;
        transition: all 0.35s cubic-bezier(.22, .61, .36, 1);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -20px rgba(16, 39, 28, 0.25);
        border-color: transparent;
    }

    .product-image, .no-image {
        width: 100%;
        height: 230px;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(.22, .61, .36, 1);
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .no-image {
        background: var(--green-100);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9aa9a0;
    }

    .product-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    /* Category Badge */
    .category-badge {
        display: inline-block;
        background: var(--green-100);
        color: var(--green-800);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 15px;
        align-self: flex-start;
        letter-spacing: 0.02em;
    }

    /* Typography */
    .product-title {
        font-family: 'Fraunces', serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--ink-900);
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .product-description {
        color: var(--ink-500);
        font-size: 14.5px;
        line-height: 1.6;
        min-height: 45px;
        margin-bottom: 15px;
    }

    .product-price {
        color: var(--green-700);
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .product-price small {
        color: var(--ink-500);
        font-size: 13px;
        font-weight: 500;
    }

    .stock {
        font-size: 13.5px;
        color: var(--ink-500);
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px dashed var(--line);
    }

    .stock strong {
        color: var(--ink-900);
    }

    /* Buttons */
    .btn-detail, .btn-add-cart, .btn-filter {
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        font-size: 14.5px;
        transition: all 0.28s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-detail {
        border: 1px solid var(--green-700);
        color: var(--green-700);
        background: transparent;
    }

    .btn-detail:hover {
        background: var(--green-100);
        color: var(--green-800);
        border-color: var(--green-800);
    }

    .btn-add-cart, .btn-filter {
        background: var(--gold-500);
        color: white;
        border: none;
        box-shadow: 0 4px 12px -4px rgba(212, 154, 74, 0.6);
    }

    .btn-add-cart:hover, .btn-filter:hover {
        background: var(--gold-600);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px -6px rgba(183, 126, 53, 0.8);
    }

    .btn-add-cart:disabled {
        background: #adb8b1;
        box-shadow: none;
        transform: none;
    }

    /* Empty State */
    .empty-box {
        padding: 80px 20px;
        text-align: center;
    }

    .empty-box i {
        color: var(--green-100);
        margin-bottom: 25px;
        text-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .empty-box h4 {
        font-family: 'Fraunces', serif;
        color: var(--green-800);
        font-weight: 700;
        font-size: 24px;
    }
    
    /* Alert Custom */
    .alert {
        border-radius: 12px;
        border: none;
        font-weight: 500;
    }
    .alert-success { background-color: var(--green-100); color: var(--green-800); }
    .alert-danger { background-color: #fee2e2; color: #991b1b; }

    /* Responsive */
    @media (max-width: 768px) {
        .catalog-header {
            padding: 30px 20px;
        }
        .catalog-header h2 {
            font-size: 26px;
        }
        .product-image, .no-image {
            height: 200px;
        }
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
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
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

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-filter w-100 w-md-auto px-4 py-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Cari Barang
                </button>
            </div>
        </div>
    </form>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 mt-2">
    <div>
        <h4 class="fw-bold mb-1" style="font-family: 'Fraunces', serif; color: var(--green-800); font-size: 24px;">
            {{ request('kategori') ? 'Kategori: '.request('kategori') : 'Perlengkapan Camping' }}
        </h4>
        <p class="text-secondary mb-0" style="font-size: 15px;">
            Pilih perlengkapan yang sesuai dengan kebutuhanmu.
        </p>
    </div>

    <span class="text-secondary fw-medium bg-white px-3 py-2 rounded-pill shadow-sm" style="border: 1px solid var(--line);">
        <i class="fa-solid fa-box me-1" style="color: var(--gold-500);"></i>
        {{ $barang->count() }} barang
    </span>
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

                    <div class="mt-auto"> <!-- Mendorong konten ke bawah agar sejajar -->
                        <div class="product-price">
                            Rp{{ number_format($item->harga_per_hari, 0, ',', '.') }}
                            <small>/ hari</small>
                        </div>

                        <div class="stock">
                            @if ($item->stok > 0)
                                <i class="fa-solid fa-box" style="color: var(--green-700);"></i>
                                Stok tersedia: <strong>{{ $item->stok }}</strong>
                            @else
                                <span class="text-danger fw-semibold">
                                    <i class="fa-solid fa-circle-xmark"></i> Stok habis
                                </span>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('katalog.show', $item->id) }}"
                                class="btn-detail flex-fill">
                                Detail
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
        </div>
    @empty
        <div class="col-12">
            <div class="empty-box">
                <i class="fa-solid fa-box-open fa-4x" style="color: var(--gold-500); opacity: 0.5;"></i>
                <h4>Barang Tidak Ditemukan</h4>
                <p class="text-secondary mb-4">
                    Coba ubah kata pencarian atau pilih kategori lain.
                </p>
                <a href="{{ url('/katalog') }}" class="btn btn-add-cart px-4 py-2">
                    Tampilkan Semua Barang
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection