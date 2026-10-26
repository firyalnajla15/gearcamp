
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog GearCamp')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9f7;
            color: #26352b;
        }

        main {
            min-height: 80vh;
            padding-top: 35px;
            padding-bottom: 35px;
        }
    </style>
</head>
<body>

            {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg" style="background:#1f4d3a; padding:15px 0;">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center gap-2"
                href="{{ url('/') }}"
                style="color:white; font-weight:bold; font-size:24px;">
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </a>

            <div class="ms-auto d-flex align-items-center gap-2 flex-wrap">

                <a href="{{ url('/katalog') }}" class="btn-cart">
                    <i class="fa-solid fa-store me-1"></i>
                    Katalog
                </a>

                @php
                    $jumlahKeranjangNavbar = collect(session('cart', []))
                        ->sum(function ($item) {
                            return (int) ($item['jumlah'] ?? $item['quantity'] ?? $item['qty'] ?? 0);
                        });
                @endphp

                <a href="{{ route('cart.index') }}" class="btn-cart">
                    <i class="fa-solid fa-cart-shopping me-1"></i>
                    Keranjang

                    @if ($jumlahKeranjangNavbar > 0)
                        <span class="badge bg-success ms-1">
                            {{ $jumlahKeranjangNavbar }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('login.user') }}" class="btn-cart">
                    <i class="fa-solid fa-user me-1"></i>
                    Masuk
                </a>

            </div>
        </div>
    </nav>

    <style>
        .btn-cart {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            background: white;
            color: #1f4d3a;
            border: 1px solid rgba(255,255,255,.5);
            border-radius: 8px;
            padding: 9px 15px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s ease;
        }

        .btn-cart:hover {
            background: #eaf2ed;
            color: #163b2c;
            transform: translateY(-1px);
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 20px !important;
            }

            .btn-cart {
                padding: 8px 10px;
                font-size: 12px;
            }
        }
    </style>

    {{-- Pengunjung belum login: tidak ada navbar dan sidebar --}}
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="text-white py-4" style="background:#1f4d3a;">
        <div class="container text-center">
            <strong><i class="fa-solid fa-mountain-sun me-2"></i>GearCamp</strong>
            <p class="mb-0 mt-2">Rental perlengkapan camping untuk petualanganmu.</p>
            <small>© {{ date('Y') }} GearCamp. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
