<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $barang->nama_barang }} - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Font Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-900: #0c2318;
            --green-800: #183d2a;
            --green-700: #1f4d3a;
            --green-100: #e7f0eb;
            --gold-500: #d49a4a;
            --ink-900: #1f2937;
            --ink-500: #6b7280;
            --line: #e5e7eb;
        }

        body {
            background: #f5f7f9;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            color: var(--ink-900);
            -webkit-font-smoothing: antialiased;
        }
        
        /* Navbar */
        .navbar {
            background: var(--green-700);
            padding: 16px 0;
            box-shadow: 0 4px 20px -10px rgba(16, 39, 28, 0.3);
        }

        .navbar-brand {
            color: white !important;
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            margin-right: 0;
            color: var(--gold-500);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            margin: 0 8px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white !important;
        }

        .btn-cart {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: white;
            color: var(--green-800);
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-cart:hover {
            background: var(--green-100);
            color: var(--green-900);
            transform: translateY(-2px);
        }

        .btn-cart .badge {
            background-color: var(--gold-500) !important;
            color: white;
        }

        /* Section Detail */
        .detail-section {
            padding: 60px 0 90px; /* Dikurangi karena navbar tidak fixed */
        }

        .detail-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 40px -20px rgba(0, 0, 0, .1);
            border: 1px solid var(--line);
        }

        /* Gambar */
        .product-image {
            width: 100%;
            height: 100%;
            min-height: 500px;
            object-fit: cover;
        }

        .no-image {
            height: 100%;
            min-height: 500px;
            background: var(--green-100);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: var(--green-700);
        }

        .no-image i {
            font-size: 70px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Konten Kanan */
        .product-content {
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .category {
            display: inline-block;
            background: var(--green-100);
            color: var(--green-900);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            align-self: flex-start;
            letter-spacing: 0.02em;
        }

        .product-title {
            font-family: 'Fraunces', serif;
            font-size: 38px;
            font-weight: 700;
            color: var(--green-900);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .price {
            font-size: 32px;
            font-weight: 800;
            color: var(--green-700);
            margin-bottom: 30px;
            display: flex;
            align-items: baseline;
            gap: 5px;
        }

        .price span {
            font-size: 16px;
            font-weight: 500;
            color: var(--ink-500);
        }

        .description-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--ink-900);
        }

        .description {
            color: var(--ink-500);
            line-height: 1.8;
            font-size: 15.5px;
            margin-bottom: 30px;
        }

        /* Box Stok */
        .stock {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f8faf9;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 35px;
            border: 1px solid var(--line);
        }

        .stock i {
            color: var(--gold-500);
            font-size: 24px;
        }

        .stock strong {
            color: var(--green-900);
            font-size: 15px;
            display: block;
            margin-bottom: 2px;
        }
        
        .stock span {
            color: var(--ink-500);
            font-size: 14.5px;
        }

        /* Tombol Aksi */
        .action-buttons {
            margin-top: auto;
        }

        .btn-rental {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--green-700);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.28s ease;
            box-shadow: 0 8px 20px -10px rgba(31, 77, 58, 0.6);
        }

        .btn-rental:hover {
            background: var(--green-900);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -10px rgba(12, 35, 24, 0.8);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--green-900);
            background: transparent;
            border: 1px solid var(--line);
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-back:hover {
            background: #f1f3f2;
            color: var(--green-900);
            border-color: #d1d5db;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .product-image, .no-image {
                min-height: 350px;
                max-height: 400px;
            }
            .product-content {
                padding: 35px;
            }
        }

        @media (max-width: 768px) {
            .detail-section {
                padding: 40px 15px;
            }

            .product-image,
            .no-image {
                min-height: 250px;
            }

            .product-content {
                padding: 25px;
            }

            .product-title {
                font-size: 30px;
            }

            .price {
                font-size: 26px;
            }

            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .action-buttons a,
            .action-buttons form,
            .action-buttons button {
                width: 100%;
            }
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

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/katalog') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#tentang') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#kontak') }}">Kontak</a>
                    </li>
                </ul>

                <a href="{{ route('cart.index') }}" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang
                    <span class="badge">
                        {{ count(session('cart', [])) }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <section class="detail-section">
        <div class="container">

            <div class="mb-4">
                <a href="{{ route('katalog.show', $barang->id) }}" class="text-decoration-none"></a>

                <a href="/katalog" class="text-decoration-none fw-semibold" style="color: var(--green-700);">
                    <i class="fa-solid fa-arrow-left me-2"></i>
                    Kembali ke Katalog
                </a>
            </div>

            <div class="detail-card">
                <div class="row g-0">

                    {{-- FOTO BARANG --}}
                    <div class="col-lg-6 position-relative">
                        @if ($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}"
                                class="product-image">
                        @else
                            <div class="no-image">
                                <i class="fa-solid fa-campground"></i>
                                <span class="fw-semibold">Foto belum tersedia</span>
                            </div>
                        @endif
                    </div>

                    {{-- DETAIL BARANG --}}
                    <div class="col-lg-6">
                        <div class="product-content">

                            <span class="category">
                                {{ $barang->kategori }}
                            </span>

                            <h1 class="product-title">
                                {{ $barang->nama_barang }}
                            </h1>

                            <div class="price">
                                Rp{{ number_format($barang->harga_per_hari, 0, ',', '.') }}
                                <span>/ hari</span>
                            </div>

                            <div class="description-title">Deskripsi</div>

                            <p class="description">
                                {{ $barang->deskripsi ?? 'Belum ada deskripsi untuk barang ini.' }}
                            </p>

                            <div class="stock">
                                <i class="fa-solid fa-box"></i>
                                <div>
                                    <strong>Stok Tersedia</strong>
                                    <span>{{ $barang->stok }} barang</span>
                                </div>
                            </div>

                            <div class="action-buttons d-flex gap-3">
                                <a href="/katalog" class="btn btn-back flex-fill">
                                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                                </a>

                                @if ($barang->stok > 0)
                                    <form action="{{ route('cart.add', $barang->id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-rental w-100">
                                            <i class="fa-solid fa-cart-plus me-2"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary flex-fill py-3 rounded-3" disabled>
                                        <i class="fa-solid fa-ban me-2"></i> Stok Habis
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>