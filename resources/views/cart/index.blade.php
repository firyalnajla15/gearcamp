<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9f7;
            color: #26352b;
        }

        .navbar {
            background: #1f4d3a;
            padding: 15px 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            margin: 0 8px;
        }

        .btn-cart {
            background: white;
            color: #1f4d3a;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            text-decoration: none;
        }

        .page-header {
            background: #eaf2ed;
            padding: 60px 0;
            text-align: center;
        }

        .page-header h1 {
            color: #1f4d3a;
            font-weight: 700;
        }

        .cart-section {
            padding: 50px 0;
        }

        .cart-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
        }

        .cart-image {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
        }

        .no-image {
            width: 110px;
            height: 110px;
            background: #edf2ef;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9aa9a0;
        }

        .product-name {
            font-size: 19px;
            font-weight: 700;
            color: #1f4d3a;
        }

        .product-category {
            display: inline-block;
            background: #e6f1eb;
            color: #1f4d3a;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .price {
            font-weight: 700;
            color: #1f4d3a;
        }

        .quantity-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 34px;
            height: 34px;
            border: 1px solid #dce4df;
            background: white;
            border-radius: 7px;
            color: #1f4d3a;
        }

        .quantity {
            min-width: 25px;
            text-align: center;
            font-weight: 700;
        }

        .summary-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 20px;
        }

        .summary-title {
            color: #1f4d3a;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .total {
            font-size: 24px;
            font-weight: 700;
            color: #1f4d3a;
        }

        .btn-checkout {
            background: #1f4d3a;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 13px;
            font-weight: 600;
            width: 100%;
        }

        .btn-checkout:hover {
            background: #163b2c;
            color: white;
        }

        .btn-delete {
            color: #dc3545;
            background: none;
            border: none;
            font-size: 14px;
        }

        .btn-delete:hover {
            color: #a71d2a;
        }

        .empty-cart {
            background: white;
            border-radius: 15px;
            padding: 80px 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .empty-cart i {
            color: #aab6ae;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            color: #1f4d3a;
            font-weight: 700;
        }

        footer {
            background: #1f4d3a;
            color: white;
            padding: 35px 0 20px;
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .cart-image,
            .no-image {
                width: 80px;
                height: 80px;
            }

            .cart-card {
                padding: 15px;
            }

            .product-name {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </a>

            <div class="ms-auto">

                <a href="{{ url('/katalog') }}" class="btn-cart me-2">
                    <i class="fa-solid fa-store"></i>
                    Katalog
                </a>

                <a href="{{ route('cart.index') }}" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang
                    <span class="badge bg-success ms-1">
                        {{ count($cart) }}
                    </span>
                </a>

            </div>

        </div>

    </nav>


    <!-- HEADER -->
    <section class="page-header">

        <div class="container">

            <h1>
                <i class="fa-solid fa-cart-shopping me-2"></i>
                Keranjang Rental
            </h1>

            <p class="text-muted mb-0">
                Periksa perlengkapan yang ingin kamu rental.
            </p>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="cart-section">

        <div class="container">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERROR --}}
            @if(session('error'))

                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ session('error') }}
                </div>

            @endif


            @if(count($cart) > 0)

                <div class="row g-4">

                    <!-- BARANG -->
                    <div class="col-lg-8">

                        @php
                            $total = 0;
                            $totalItem = 0;
                        @endphp


                        @foreach($cart as $item)

                            @php
                                $subtotal = $item['harga_per_hari'] * $item['jumlah'];
                                $total += $subtotal;
                                $totalItem += $item['jumlah'];
                            @endphp


                            <div class="cart-card">

                                <div class="row align-items-center g-3">

                                    <!-- IMAGE -->
                                    <div class="col-3 col-md-2">

                                        @if($item['foto'])

                                            <img
                                                src="{{ asset('storage/' . $item['foto']) }}"
                                                class="cart-image"
                                                alt="{{ $item['nama_barang'] }}"
                                            >

                                        @else

                                            <div class="no-image">

                                                <i class="fa-solid fa-campground fa-2x"></i>

                                            </div>

                                        @endif

                                    </div>


                                    <!-- INFO -->
                                    <div class="col-9 col-md-4">

                                        <span class="product-category">
                                            {{ $item['kategori'] }}
                                        </span>

                                        <div class="product-name">
                                            {{ $item['nama_barang'] }}
                                        </div>

                                        <div class="price mt-1">

                                            Rp{{ number_format($item['harga_per_hari'], 0, ',', '.') }}

                                            <small class="text-muted fw-normal">
                                                / hari
                                            </small>

                                        </div>

                                    </div>


                                    <!-- JUMLAH -->
                                    <div class="col-6 col-md-3">

                                        <small class="text-muted d-block mb-2">
                                            Jumlah
                                        </small>

                                        <div class="quantity-box">

                                            <form
                                                action="{{ route('cart.decrease', $item['id']) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button class="quantity-btn" type="submit">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>

                                            </form>


                                            <span class="quantity">
                                                {{ $item['jumlah'] }}
                                            </span>


                                            <form
                                                action="{{ route('cart.increase', $item['id']) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button class="quantity-btn" type="submit">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </div>


                                    <!-- SUBTOTAL -->
                                    <div class="col-6 col-md-2 text-md-end">

                                        <small class="text-muted d-block">
                                            Subtotal
                                        </small>

                                        <strong class="price">

                                            Rp{{ number_format($subtotal, 0, ',', '.') }}

                                        </strong>

                                    </div>


                                    <!-- DELETE -->
                                    <div class="col-12 col-md-1 text-md-end">

                                        <form
                                            action="{{ route('cart.remove', $item['id']) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-delete"
                                                onclick="return confirm('Hapus barang dari keranjang?')"
                                            >

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach


                        <!-- CLEAR CART -->
                        <div class="text-end">

                            <form
                                action="{{ route('cart.clear') }}"
                                method="POST"
                                class="d-inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Kosongkan semua keranjang?')"
                                >

                                    <i class="fa-solid fa-trash-can me-1"></i>
                                    Kosongkan Keranjang

                                </button>

                            </form>

                        </div>

                    </div>


                    <!-- SUMMARY -->
                    <div class="col-lg-4">

                        <div class="summary-card">

                            <h4 class="summary-title">
                                Ringkasan Rental
                            </h4>

                            <div class="d-flex justify-content-between mb-3">

                                <span>
                                    Total Item
                                </span>

                                <strong>
                                    {{ $totalItem }} barang
                                </strong>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <span>
                                    Total
                                </span>

                                <span class="total">

                                    Rp{{ number_format($total, 0, ',', '.') }}

                                </span>

                            </div>


                            <button
                                type="button"
                                class="btn-checkout"
                                onclick="alert('Checkout akan kita buat setelah Cart selesai.')"
                            >

                                <i class="fa-solid fa-arrow-right me-2"></i>
                                Lanjut ke Checkout

                            </button>


                            <a
                                href="{{ url('/katalog') }}"
                                class="btn btn-outline-secondary w-100 mt-2"
                            >

                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Kembali ke Katalog

                            </a>

                        </div>

                    </div>

                </div>

            @else

                <!-- EMPTY CART -->
                <div class="empty-cart">

                    <i class="fa-solid fa-cart-shopping fa-4x"></i>

                    <h3>
                        Keranjang Masih Kosong
                    </h3>

                    <p class="text-muted">
                        Yuk pilih perlengkapan camping yang ingin kamu rental.
                    </p>

                    <a
                        href="{{ url('/katalog') }}"
                        class="btn btn-checkout mt-3"
                        style="max-width: 220px;"
                    >

                        <i class="fa-solid fa-store me-2"></i>
                        Lihat Katalog

                    </a>

                </div>

            @endif

        </div>

    </section>


    <!-- FOOTER -->
    <footer>

        <div class="container text-center">

            <strong>
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </strong>

            <p class="mb-0 mt-2 text-white-50">
                Rental perlengkapan camping dengan mudah.
            </p>

        </div>

    </footer>

</body>

</html>