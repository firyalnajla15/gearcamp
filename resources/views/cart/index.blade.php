<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Font Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-900: #10271c;
            --green-800: #183b2b;
            --green-700: #1f4d3a;
            --green-100: #eaf2ed;
            --gold-500: #d49a4a;
            --ink-900: #26352b;
            --ink-500: #6b7280;
            --line: #e5e7eb;
        }

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: #f7f9f7;
            color: var(--ink-900);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            color: var(--gold-500);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            margin: 0 8px;
            font-weight: 500;
        }

        .btn-cart {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 9px 16px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-cart:hover {
            background: white;
            color: var(--green-800);
            border-color: white;
            transform: translateY(-2px);
        }

        .btn-cart .badge {
            background-color: var(--gold-500) !important;
            color: white;
            font-size: 11px;
            padding: 4px 6px;
            border-radius: 6px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--green-100) 0%, #f4f8f5 100%);
            padding: 60px 0;
            text-align: center;
            border-bottom: 1px solid rgba(31, 77, 58, 0.05);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(var(--green-700) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.05;
            pointer-events: none;
        }

        .page-header h1 {
            font-family: 'Fraunces', serif;
            color: var(--green-800);
            font-weight: 700;
            font-size: 38px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        /* Content */
        .cart-section {
            padding: 50px 0 80px;
            flex: 1;
        }

        /* Card Barang */
        .cart-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--line);
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cart-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px -15px rgba(16, 39, 28, 0.15);
        }

        .cart-image {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 12px;
        }

        .no-image {
            width: 110px;
            height: 110px;
            background: var(--green-100);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9aa9a0;
        }

        .product-name {
            font-family: 'Fraunces', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--green-900);
            line-height: 1.3;
            margin-bottom: 5px;
        }

        .product-category {
            display: inline-block;
            background: var(--green-100);
            color: var(--green-800);
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .price {
            font-weight: 800;
            color: var(--green-700);
            font-size: 16px;
        }

        /* Tombol Kuantitas */
        .quantity-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8faf9;
            padding: 5px;
            border-radius: 10px;
            border: 1px solid var(--line);
            width: fit-content;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: white;
            border-radius: 8px;
            color: var(--green-700);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: var(--green-100);
            color: var(--green-900);
        }

        .quantity {
            min-width: 25px;
            text-align: center;
            font-weight: 700;
            font-size: 15px;
        }

        /* Ringkasan (Summary) */
        .summary-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px -15px rgba(16, 39, 28, 0.1);
            border: 1px solid var(--line);
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-family: 'Fraunces', serif;
            color: var(--green-900);
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .total {
            font-family: 'Fraunces', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--green-700);
        }

        .btn-checkout {
            background: var(--green-700);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.28s cubic-bezier(.22, .61, .36, 1);
            box-shadow: 0 8px 20px -8px rgba(31, 77, 58, 0.6);
        }

        .btn-checkout:hover {
            background: var(--green-900);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(12, 35, 24, 0.8);
        }

        .btn-delete {
            color: #dc3545;
            background: #fee2e2;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background: #fca5a5;
            color: #7f1d1d;
        }

        /* Empty Cart */
        .empty-cart {
            background: white;
            border-radius: 24px;
            padding: 80px 20px;
            text-align: center;
            box-shadow: 0 10px 30px -15px rgba(16, 39, 28, 0.1);
            border: 1px solid var(--line);
        }

        .empty-cart i {
            color: var(--green-100);
            margin-bottom: 25px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .empty-cart h3 {
            font-family: 'Fraunces', serif;
            color: var(--green-800);
            font-weight: 700;
            font-size: 28px;
        }

        /* Footer */
        footer {
            background: var(--green-900);
            color: white;
            padding: 40px 0 30px;
            border-top: 4px solid var(--gold-500);
        }

        footer strong {
            font-family: 'Fraunces', serif;
            font-size: 24px;
        }

        footer strong i {
            color: var(--gold-500);
            margin-right: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-image, .no-image {
                width: 80px;
                height: 80px;
            }
            .cart-card {
                padding: 15px;
            }
            .product-name {
                font-size: 18px;
            }
            .page-header h1 {
                font-size: 30px;
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

            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="{{ url('/katalog') }}" class="btn-cart">
                    <i class="fa-solid fa-store"></i>
                    Katalog
                </a>

                <a href="{{ route('cart.index') }}" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang
                    <span class="badge">
                        {{ count($cart) }}
                    </span>
                </a>
            </div>
        </div>
    </nav>


    <!-- HEADER -->
    <section class="page-header">
        <div class="container position-relative z-1">
            <h1>
                <i class="fa-solid fa-cart-shopping me-2" style="color: var(--gold-500);"></i>
                Keranjang Rental
            </h1>
            <p class="text-muted mb-0 fw-medium">
                Periksa perlengkapan yang ingin kamu rental.
            </p>
        </div>
    </section>


    <!-- CONTENT -->
    <section class="cart-section">
        <div class="container">

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 shadow-sm" style="background-color: var(--green-100); color: var(--green-800);">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR --}}
            @if (session('error'))
                <div class="alert alert-danger border-0 rounded-4 shadow-sm" style="background-color: #fee2e2; color: #991b1b;">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ session('error') }}
                </div>
            @endif


            @if (count($cart) > 0)

                <div class="row g-4">

                    <!-- BARANG -->
                    <div class="col-lg-8">
                        @php
                            $total = 0;
                            $totalItem = 0;
                        @endphp

                        @foreach ($cart as $item)
                            @php
                                $subtotal = $item['harga_per_hari'] * $item['jumlah'];
                                $total += $subtotal;
                                $totalItem += $item['jumlah'];
                            @endphp

                            <div class="cart-card">
                                <div class="row align-items-center g-3">

                                    <!-- IMAGE -->
                                    <div class="col-3 col-md-2">
                                        @if ($item['foto'])
                                            <img src="{{ asset('storage/' . $item['foto']) }}" class="cart-image"
                                                alt="{{ $item['nama_barang'] }}">
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
                                            <small class="text-muted fw-normal" style="font-size: 13px;">
                                                / hari
                                            </small>
                                        </div>
                                    </div>

                                    <!-- JUMLAH -->
                                    <div class="col-6 col-md-3">
                                        <small class="text-muted d-block mb-2 fw-semibold" style="font-size: 12px;">
                                            JUMLAH
                                        </small>
                                        <div class="quantity-box">
                                            <form action="{{ route('cart.decrease', $item['id']) }}" method="POST">
                                                @csrf
                                                <button class="quantity-btn" type="submit">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                            </form>

                                            <span class="quantity">
                                                {{ $item['jumlah'] }}
                                            </span>

                                            <form action="{{ route('cart.increase', $item['id']) }}" method="POST">
                                                @csrf
                                                <button class="quantity-btn" type="submit">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- SUBTOTAL -->
                                    <div class="col-6 col-md-2 text-md-end">
                                        <small class="text-muted d-block fw-semibold" style="font-size: 12px;">
                                            SUBTOTAL
                                        </small>
                                        <strong class="price" style="font-size: 17px;">
                                            Rp{{ number_format($subtotal, 0, ',', '.') }}
                                        </strong>
                                    </div>

                                    <!-- DELETE -->
                                    <div class="col-12 col-md-1 text-md-end mt-3 mt-md-0">
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete ms-auto"
                                                onclick="return confirm('Hapus barang dari keranjang?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        <!-- CLEAR CART -->
                        <div class="text-end mt-2">
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 fw-semibold px-3 py-2"
                                    onclick="return confirm('Kosongkan semua keranjang?')">
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

                            <div class="d-flex justify-content-between mb-3 text-secondary">
                                <span class="fw-medium">Total Item</span>
                                <strong class="text-dark">{{ $totalItem }} barang</strong>
                            </div>

                            <hr style="border-color: var(--line);">

                            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                                <span class="fw-semibold">Total</span>
                                <span class="total">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ route('checkout') }}"
                                class="btn-checkout d-block text-center text-decoration-none">
                                <i class="fa-solid fa-arrow-right me-2"></i>
                                Lanjut ke Checkout
                            </a>

                            <a href="{{ url('/katalog') }}" class="btn btn-outline-secondary w-100 mt-3 py-2 rounded-3 fw-semibold border-2">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Kembali ke Katalog
                            </a>
                        </div>
                    </div>

                </div>
            @else
                <!-- EMPTY CART -->
                <div class="empty-cart">
                    <i class="fa-solid fa-cart-shopping fa-4x" style="color: var(--green-700); opacity: 0.2;"></i>
                    <h3>Keranjang Masih Kosong</h3>
                    <p class="text-secondary mb-4">
                        Yuk pilih perlengkapan camping yang ingin kamu rental.
                    </p>
                    <a href="{{ url('/katalog') }}" class="btn btn-checkout mx-auto" style="max-width: 220px;">
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