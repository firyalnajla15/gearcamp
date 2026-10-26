<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --green: #1f4d3a;
            --green-hover: #2d634b;
            --background: #f7f9f7;
            --text: #26352b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 255px;
            background: var(--green);
            color: white;
            padding: 24px 16px;
            overflow-y: auto;
            z-index: 1050;
            transition: transform .3s ease, width .3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.18);
            margin-bottom: 22px;
            color: white;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.14);
            border-radius: 12px;
            font-size: 21px;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 700;
            margin: 0;
        }

        .menu-label {
            color: rgba(255,255,255,.6);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 0 12px;
            margin: 20px 0 10px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            color: rgba(255,255,255,.82);
            text-decoration: none;
            border-radius: 9px;
            font-size: 14px;
            transition: background .2s;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,.16);
            color: white;
        }

        .sidebar-menu a.active {
            font-weight: 700;
        }

        .sidebar-bottom {
            margin-top: 28px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,.18);
        }

        /* AREA KONTEN */
        .main-content {
            margin-left: 255px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        .topbar {
            min-height: 76px;
            padding: 16px 30px;
            background: white;
            border-bottom: 1px solid #e8ede8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .page-title {
            font-size: 21px;
            font-weight: 700;
            margin: 0;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5eee8;
            color: var(--green);
            border-radius: 50%;
        }

        .page-content {
            padding: 30px;
        }

        .menu-toggle {
            display: none;
            background: var(--green);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 9px 12px;
        }

        .sidebar-overlay {
            display: none;
        }

        /* SIDEBAR DESKTOP DIPERKECIL */
        body.sidebar-collapsed .sidebar {
            width: 80px;
        }

        body.sidebar-collapsed .main-content {
            margin-left: 80px;
        }

        body.sidebar-collapsed .brand-name,
        body.sidebar-collapsed .menu-label,
        body.sidebar-collapsed .sidebar-menu a span {
            display: none;
        }

        body.sidebar-collapsed .brand {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        body.sidebar-collapsed .sidebar-menu a {
            justify-content: center;
        }

        /* TABLET DAN HP */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                width: 255px !important;
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .main-content,
            body.sidebar-collapsed .main-content {
                margin-left: 0;
            }

            body.sidebar-collapsed .brand-name,
            body.sidebar-collapsed .menu-label,
            body.sidebar-collapsed .sidebar-menu a span {
                display: initial;
            }

            body.sidebar-collapsed .brand {
                justify-content: flex-start;
            }

            body.sidebar-collapsed .sidebar-menu a {
                justify-content: flex-start;
            }

            .menu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.4);
                z-index: 1040;
            }

            .topbar {
                padding: 15px 18px;
            }

            .page-content {
                padding: 20px 16px;
            }
        }

        @media (min-width: 992px) {
            .desktop-toggle {
                display: inline-flex;
                background: transparent;
                border: 1px solid #e0e7e1;
                color: var(--green);
                border-radius: 8px;
                padding: 8px 11px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">

        <a href="{{ route('user.dashboard') }}" class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-campground"></i>
            </div>
            <span class="brand-name">GearCamp</span>
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="sidebar-menu">
            <a href="{{ route('user.dashboard') }}"
               class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('katalog.index') }}">
                <i class="fa-solid fa-tent"></i>
                <span>Katalog Barang</span>
            </a>

            <a href="{{ route('cart.index') }}"
               class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Keranjang</span>
            </a>
        </nav>

        <div class="menu-label">AKUN SAYA</div>

        <nav class="sidebar-menu">
            <a href="{{ route('user.rentals') }}"
               class="{{ request()->routeIs('user.rentals') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i>
                <span>Rental Saya</span>
            </a>

            <a href="{{ route('user.transactions') }}"
               class="{{ request()->routeIs('user.transactions') ? 'active' : '' }}">
                <i class="fa-solid fa-receipt"></i>
                <span>Transaksi</span>
            </a>

            <a href="{{ route('user.profile') }}"
               class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span>Profil Saya</span>
            </a>

            <a href="{{ route('user.help') }}"
               class="{{ request()->routeIs('user.help') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-question"></i>
                <span>Bantuan</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <nav class="sidebar-menu">
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Website</span>
                </a>

                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- KONTEN UTAMA --}}
    <main class="main-content">

        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="menu-toggle" id="mobileToggle" aria-label="Buka menu">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <button class="desktop-toggle d-none d-lg-inline-flex"
                        id="desktopToggle" aria-label="Perkecil sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="user-chip">
                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="d-none d-sm-block">
                    <div class="fw-bold small">
                        {{ Auth::user()->name ?? 'Pengguna' }}
                    </div>
                    <div class="text-secondary" style="font-size: 12px;">
                        Member GearCamp
                    </div>
                </div>
            </div>
        </header>

        <section class="page-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const mobileToggle = document.getElementById('mobileToggle');
        const desktopToggle = document.getElementById('desktopToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (mobileToggle) {
            mobileToggle.addEventListener('click', function () {
                document.body.classList.toggle('sidebar-open');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function () {
                document.body.classList.remove('sidebar-open');
            });
        }

        if (desktopToggle) {
            desktopToggle.addEventListener('click', function () {
                document.body.classList.toggle('sidebar-collapsed');
            });
        }

        window.addEventListener('resize', function () {
            if (window.innerWidth > 991) {
                document.body.classList.remove('sidebar-open');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>