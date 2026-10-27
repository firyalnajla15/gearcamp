<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog GearCamp')</title>

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
        }

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: #f7f9f7;
            color: #26352b;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            min-height: 80vh;
            padding-top: 45px;
            padding-bottom: 60px;
        }

        /* Navbar Custom */
        .navbar-public {
            background: var(--green-800);
            padding: 18px 0;
            box-shadow: 0 4px 20px -10px rgba(16, 39, 28, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand-custom {
            color: white;
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 26px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: opacity .2s ease;
        }

        .navbar-brand-custom:hover {
            color: white;
            opacity: 0.9;
        }

        .navbar-brand-custom i {
            color: var(--gold-500);
        }

        /* Tombol Navigasi */
        .btn-cart {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-cart:hover {
            background: white;
            color: var(--green-800);
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -8px rgba(0, 0, 0, 0.2);
        }

        .btn-cart .badge {
            background-color: var(--gold-500) !important;
            color: white;
            font-size: 11px;
            padding: 4px 6px;
            border-radius: 6px;
        }

        /* Footer Custom */
        .footer-public {
            background: var(--green-900);
            color: white;
            padding: 50px 0 30px;
            border-top: 4px solid var(--gold-500);
        }

        .footer-public strong {
            font-family: 'Fraunces', serif;
            font-size: 24px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .footer-public strong i {
            color: var(--gold-500);
        }

        .footer-public p {
            color: #d1d5db;
            font-size: 15px;
        }

        .footer-public small {
            color: #9ca3af;
            font-size: 13.5px;
            display: block;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .navbar-public {
                padding: 15px 0;
            }

            .navbar-brand-custom {
                font-size: 22px;
            }

            .btn-cart {
                padding: 8px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR PUBLIK --}}
    <nav class="navbar navbar-expand-lg navbar-public">
        <div class="container">

            <a class="navbar-brand-custom" href="{{ url('/') }}">
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </a>

            <div class="ms-auto d-flex align-items-center gap-2 flex-wrap">

                {{-- TOMBOL HOME --}}
                <a href="{{ url('/') }}" class="btn-cart">
                    <i class="fa-solid fa-house"></i>
                    Home
                </a>

                {{-- JUMLAH KERANJANG --}}
                @php
                    $jumlahKeranjangNavbar = collect(session('cart', []))
                        ->sum(function ($item) {
                            return (int) ($item['jumlah'] ?? $item['quantity'] ?? $item['qty'] ?? 0);
                        });
                @endphp

                {{-- TOMBOL KERANJANG --}}
                <a href="{{ route('cart.index') }}" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang

                    @if ($jumlahKeranjangNavbar > 0)
                        <span class="badge">
                            {{ $jumlahKeranjangNavbar }}
                        </span>
                    @endif
                </a>

                {{-- TOMBOL MASUK --}}
                <a href="{{ route('login.user') }}" class="btn-cart">
                    <i class="fa-solid fa-user"></i>
                    Masuk
                </a>

            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER PUBLIK --}}
    <footer class="footer-public">
        <div class="container text-center">
            <strong>
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </strong>

            <p class="mb-0 mt-3">
                Rental perlengkapan camping untuk petualanganmu.
            </p>

            <small>
                © {{ date('Y') }} GearCamp. All Rights Reserved.
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>