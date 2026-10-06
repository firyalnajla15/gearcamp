<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $barang->nama_barang }} - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background: #f5f7f9;
            font-family: Arial, sans-serif;
            color: #1f2937;
        }

        .navbar {
            background: #0c2318;
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,.85) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        .detail-section {
            padding: 120px 0 70px;
        }

        .detail-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        .product-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .no-image {
            height: 500px;
            background: #e9eeeb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #6b7280;
        }

        .no-image i {
            font-size: 70px;
            margin-bottom: 15px;
        }

        .product-content {
            padding: 40px;
        }

        .category {
            display: inline-block;
            background: #e7f0eb;
            color: #0c2318;
            padding: 7px 15px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .product-title {
            font-size: 36px;
            font-weight: 700;
            color: #0c2318;
            margin-bottom: 15px;
        }

        .price {
            font-size: 28px;
            font-weight: 700;
            color: #0c2318;
            margin-bottom: 25px;
        }

        .price span {
            font-size: 15px;
            font-weight: 400;
            color: #6b7280;
        }

        .description-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .description {
            color: #6b7280;
            line-height: 1.8;
        }

        .stock {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f5f7f9;
            padding: 15px;
            border-radius: 12px;
            margin: 25px 0;
        }

        .stock i {
            color: #0c2318;
        }

        .stock strong {
            color: #0c2318;
        }

        .btn-rental {
            background: #0c2318;
            color: white;
            border: none;
            padding: 13px 25px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-rental:hover {
            background: #183d2a;
            color: white;
        }

        .btn-back {
            color: #0c2318;
            border: 1px solid #d1d5db;
            padding: 13px 25px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #f1f3f2;
        }

        @media (max-width: 768px) {
            .detail-section {
                padding: 100px 15px 50px;
            }

            .product-image,
            .no-image {
                height: 300px;
            }

            .product-content {
                padding: 25px;
            }

            .product-title {
                font-size: 28px;
            }

            .price {
                font-size: 24px;
            }

            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .action-buttons a,
            .action-buttons button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        <a class="navbar-brand" href="/">
            <i class="fa-solid fa-campground me-2"></i>
            GearCamp
        </a>

        <button class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="/katalog">
                        Katalog
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/login">
                        Login
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>


<section class="detail-section">

    <div class="container">

        <div class="mb-4">
            <a href="{{ route('katalog.show', $barang->id) }}"
               class="text-decoration-none">
            </a>

            <a href="/katalog"
               class="text-decoration-none text-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali ke Katalog
            </a>
        </div>

        <div class="detail-card">

            <div class="row g-0">

                {{-- FOTO BARANG --}}
                <div class="col-lg-6">

                    @if($barang->foto)

                        <img
                            src="{{ asset('storage/' . $barang->foto) }}"
                            alt="{{ $barang->nama_barang }}"
                            class="product-image"
                        >

                    @else

                        <div class="no-image">

                            <i class="fa-solid fa-campground"></i>

                            <span>
                                Foto belum tersedia
                            </span>

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

                            <span>
                                / hari
                            </span>

                        </div>


                        <div class="description-title">
                            Deskripsi
                        </div>

                        <p class="description">

                            {{ $barang->deskripsi ?? 'Belum ada deskripsi untuk barang ini.' }}

                        </p>


                        <div class="stock">

                            <i class="fa-solid fa-box"></i>

                            <div>
                                <strong>Stok Tersedia</strong>
                                <br>

                                <span>
                                    {{ $barang->stok }} barang
                                </span>
                            </div>

                        </div>


                        <div class="action-buttons d-flex gap-2">

                            <a href="/katalog"
                               class="btn btn-back">

                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Kembali

                            </a>

                            @if($barang->stok > 0)

                                <button class="btn btn-rental">

                                    <i class="fa-solid fa-cart-plus me-2"></i>
                                    Tambah ke Keranjang

                                </button>

                            @else

                                <button class="btn btn-secondary" disabled>

                                    <i class="fa-solid fa-ban me-2"></i>
                                    Stok Habis

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