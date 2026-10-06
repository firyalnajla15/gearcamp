<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Katalog - GearCamp</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9f7;
            color: #26352b;
        }

        /* Navbar */
        .navbar {
            background: #1f4d3a;
            padding: 15px 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            margin: 0 8px;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
        }

        .btn-cart {
            background: white;
            color: #1f4d3a;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-cart:hover {
            background: #e9f3ed;
            color: #1f4d3a;
        }

        /* Header */
        .catalog-header {
            background: #eaf2ed;
            padding: 70px 0;
            text-align: center;
        }

        .catalog-header h1 {
            font-weight: 700;
            color: #1f4d3a;
            margin-bottom: 15px;
        }

        .catalog-header p {
            color: #66736b;
            margin-bottom: 0;
        }

        /* Filter */
        .filter-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-top: -30px;
            position: relative;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #dce4df;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1f4d3a;
            box-shadow: 0 0 0 0.2rem rgba(31, 77, 58, 0.1);
        }

        /* Product Card */
        .product-card {
            background: white;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 240px;
            background: #edf2ef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9aa9a0;
        }

        .product-body {
            padding: 22px;
        }

        .category-badge {
            display: inline-block;
            background: #e6f1eb;
            color: #1f4d3a;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #26352b;
        }

        .product-description {
            color: #727d76;
            font-size: 14px;
            min-height: 42px;
            margin-bottom: 15px;
        }

        .product-price {
            color: #1f4d3a;
            font-size: 20px;
            font-weight: 700;
        }

        .product-price small {
            font-size: 13px;
            color: #7b857e;
            font-weight: normal;
        }

        .stock {
            font-size: 14px;
            color: #66736b;
            margin-bottom: 18px;
        }

        .btn-detail {
            border: 1px solid #1f4d3a;
            color: #1f4d3a;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
        }

        .btn-detail:hover {
            background: #1f4d3a;
            color: white;
        }

        .btn-add-cart {
            background: #1f4d3a;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-add-cart:hover {
            background: #163b2c;
            color: white;
        }

        .btn-add-cart:disabled {
            background: #adb8b1;
            cursor: not-allowed;
        }

        /* Empty */
        .empty-box {
            background: white;
            border-radius: 15px;
            padding: 70px 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .empty-box i {
            color: #aab6ae;
            margin-bottom: 20px;
        }

        .empty-box h4 {
            color: #1f4d3a;
            font-weight: 700;
        }

        .empty-box p {
            color: #7b857e;
        }

        /* Footer */
        footer {
            background: #1f4d3a;
            color: white;
            margin-top: 80px;
            padding: 50px 0 25px;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        footer p {
            color: rgba(255, 255, 255, 0.75);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.65);
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/katalog') }}">
                            Katalog
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#tentang') }}">
                            Tentang
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#kontak') }}">
                            Kontak
                        </a>
                    </li>

                </ul>

                <a href="#" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang
                    <span class="badge bg-success ms-1">0</span>
                </a>

            </div>

        </div>
    </nav>


    <!-- ================= HEADER ================= -->
    <section class="catalog-header">

        <div class="container">

            <h1>Katalog GearCamp</h1>

            <p>
                Temukan berbagai perlengkapan camping berkualitas
                untuk menemani perjalanan outdoor kamu.
            </p>

        </div>

    </section>


    <!-- ================= FILTER ================= -->
    <div class="container">

        <div class="filter-box">

            <div class="row g-3">

                <div class="col-md-8">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>

                        <input type="text" class="form-control" placeholder="Cari perlengkapan camping...">

                    </div>

                </div>

                <div class="col-md-4">

                    <select class="form-select">

                        <option selected>
                            Semua Kategori
                        </option>

                        <option>
                            Tenda
                        </option>

                        <option>
                            Tas & Carrier
                        </option>

                        <option>
                            Sleeping Bag
                        </option>

                        <option>
                            Peralatan Masak
                        </option>

                        <option>
                            Peralatan Outdoor
                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= CATALOG ================= -->
    <section class="py-5">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold mb-1">
                        Perlengkapan Camping
                    </h3>

                    <p class="text-muted mb-0">
                        Pilih perlengkapan yang kamu butuhkan.
                    </p>

                </div>

                <span class="text-muted">
                    {{ $barang->count() }} barang
                </span>

            </div>


            <div class="row g-4">

                @forelse($barang as $item)
                    <div class="col-lg-4 col-md-6">

                        <div class="product-card">

                            <!-- FOTO BARANG -->
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="product-image"
                                    alt="{{ $item->nama_barang }}">
                            @else
                                <div class="no-image">

                                    <i class="fa-solid fa-campground fa-4x"></i>

                                </div>
                            @endif


                            <!-- DETAIL BARANG -->
                            <div class="product-body">

                                <span class="category-badge">
                                    {{ $item->kategori }}
                                </span>

                                <h5 class="product-title">
                                    {{ $item->nama_barang }}
                                </h5>

                                <p class="product-description">
                                    {{ $item->deskripsi ?? 'Perlengkapan camping berkualitas dari GearCamp.' }}
                                </p>

                                <div class="product-price">

                                    Rp{{ number_format($item->harga_per_hari, 0, ',', '.') }}

                                    <small>
                                        / hari
                                    </small>

                                </div>

                                <div class="stock">

                                    @if ($item->stok > 0)
                                        <i class="fa-solid fa-box"></i>
                                        Stok tersedia:
                                        <strong>{{ $item->stok }}</strong>
                                    @else
                                        <span class="text-danger">

                                            <i class="fa-solid fa-circle-xmark"></i>
                                            Stok habis

                                        </span>
                                    @endif

                                </div>


                                <!-- BUTTON -->
                                <div class="d-flex gap-2">

                                    <a href="{{ route('katalog.show', $item->id) }}" class="btn btn-outline-dark">
                                        <i class="fa-solid fa-eye me-1"></i>
                                        Lihat Detail
                                    </a>

                                    <button type="button" class="btn-add-cart flex-fill"
                                        {{ $item->stok <= 0 ? 'disabled' : '' }}>

                                        <i class="fa-solid fa-cart-plus"></i>
                                        Add to Cart

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- JIKA DATABASE MASIH KOSONG -->
                    <div class="col-12">

                        <div class="empty-box">

                            <i class="fa-solid fa-box-open fa-4x"></i>

                            <h4>
                                Belum Ada Barang
                            </h4>

                            <p>
                                Saat ini belum ada perlengkapan camping
                                yang tersedia di katalog.
                            </p>

                        </div>

                    </div>
                @endforelse

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->
    <footer>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <h5>
                        <i class="fa-solid fa-mountain-sun"></i>
                        GearCamp
                    </h5>

                    <p>
                        Solusi mudah untuk menyewa perlengkapan
                        camping berkualitas dengan harga terjangkau.
                    </p>

                </div>

                <div class="col-md-3">

                    <h5>Menu</h5>

                    <p class="mb-2">
                        <a href="{{ url('/') }}" class="text-white text-decoration-none">
                            Home
                        </a>
                    </p>

                    <p class="mb-2">
                        <a href="{{ url('/katalog') }}" class="text-white text-decoration-none">
                            Katalog
                        </a>
                    </p>

                </div>

                <div class="col-md-3">

                    <h5>Kontak</h5>

                    <p class="mb-2">
                        <i class="fa-solid fa-phone"></i>
                        08xxxxxxxxxx
                    </p>

                    <p class="mb-2">
                        <i class="fa-solid fa-envelope"></i>
                        gearcamp@gmail.com
                    </p>

                </div>

            </div>


            <div class="footer-bottom">

                © {{ date('Y') }} GearCamp.
                All Rights Reserved.

            </div>

        </div>

    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
