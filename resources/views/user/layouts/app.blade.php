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
            --green-light: #e5eee8;
            --background: #f7f9f7;
            --text: #26352b;
            --muted: #829087;
            --border: #e8ede8;
            --sidebar-width: 255px;
            --sidebar-small: 80px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            text-decoration: none;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-width);
            padding: 22px 15px 18px;
            background: var(--green);
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: width .25s ease, transform .25s ease;
        }

        .brand {
            min-height: 57px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 9px 19px;
            margin-bottom: 21px;
            border-bottom: 1px solid rgba(255, 255, 255, .16);
            color: #fff;
            white-space: nowrap;
        }

        .brand:hover {
            color: #fff;
        }

        .brand-icon {
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .13);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 12px;
            font-size: 21px;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .menu-label {
            padding: 0 12px;
            margin: 8px 0 11px;
            color: rgba(255, 255, 255, .55);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            white-space: nowrap;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-menu a {
            position: relative;
            min-height: 45px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 11px 12px;
            border-radius: 9px;
            color: rgba(255, 255, 255, .78);
            font-size: 13.5px;
            font-weight: 500;
            white-space: nowrap;
            transition: background .2s ease, color .2s ease;
        }

        .sidebar-menu a i {
            flex: 0 0 20px;
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, .09);
            color: #fff;
        }

        .sidebar-menu a.active {
            background: rgba(255, 255, 255, .16);
            color: #fff;
            font-weight: 700;
        }

        .sidebar-menu a.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 10px;
            bottom: 10px;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: #fff;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, .16);
        }

        .sidebar-bottom .sidebar-menu a {
            font-size: 13px;
        }

        .sidebar-menu a.logout-link:hover {
            background: rgba(255, 255, 255, .13);
            color: #fff;
        }

        /* KONTEN UTAMA */
        .main-content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: margin-left .25s ease;
        }

        .topbar {
            min-height: 76px;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .topbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-title {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
            color: var(--text);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .user-avatar {
            flex: 0 0 41px;
            width: 41px;
            height: 41px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--green-light);
            color: var(--green);
            font-size: 16px;
        }

        .user-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 13px;
            color: var(--text);
        }

        .user-role {
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
        }

        .page-content {
            padding: 30px;
        }

        .menu-toggle,
        .desktop-toggle {
            width: 39px;
            height: 39px;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            cursor: pointer;
        }

        .menu-toggle {
            display: none;
            background: var(--green);
            color: #fff;
            border: 1px solid var(--green);
        }

        .menu-toggle:hover {
            background: var(--green-hover);
        }

        .desktop-toggle {
            display: inline-flex;
            background: #fff;
            color: var(--green);
            border: 1px solid #e0e7e1;
        }

        .desktop-toggle:hover {
            background: var(--green-light);
        }

        .sidebar-overlay {
            display: none;
        }

        /* SIDEBAR DESKTOP DIPERKECIL */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-small);
            padding-left: 12px;
            padding-right: 12px;
        }

        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-small);
        }

        body.sidebar-collapsed .brand {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        body.sidebar-collapsed .brand-name,
        body.sidebar-collapsed .menu-label,
        body.sidebar-collapsed .sidebar-menu a span {
            display: none;
        }

        body.sidebar-collapsed .sidebar-menu a {
            justify-content: center;
            padding-left: 8px;
            padding-right: 8px;
        }

        body.sidebar-collapsed .sidebar-menu a i {
            flex-basis: 22px;
            font-size: 17px;
        }

        body.sidebar-collapsed .sidebar-menu a.active::before {
            left: -12px;
        }

        /* TABLET DAN HP */
        @media (max-width: 991.98px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: translateX(-100%);
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .main-content,
            body.sidebar-collapsed .main-content {
                margin-left: 0;
            }

            body.sidebar-collapsed .sidebar {
                width: var(--sidebar-width);
                padding-left: 15px;
                padding-right: 15px;
            }

            body.sidebar-collapsed .brand {
                justify-content: flex-start;
                padding-left: 9px;
                padding-right: 9px;
            }

            body.sidebar-collapsed .brand-name,
            body.sidebar-collapsed .menu-label,
            body.sidebar-collapsed .sidebar-menu a span {
                display: initial;
            }

            body.sidebar-collapsed .sidebar-menu a {
                justify-content: flex-start;
                padding: 11px 12px;
            }

            body.sidebar-collapsed .sidebar-menu a.active::before {
                left: 0;
            }

            .menu-toggle {
                display: inline-flex;
            }

            .desktop-toggle {
                display: none !important;
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 1040;
                background: rgba(18, 30, 22, .45);
            }

            .topbar {
                padding: 14px 18px;
            }

            .page-content {
                padding: 22px 18px;
            }
        }

        @media (max-width: 575.98px) {
            .topbar {
                min-height: 68px;
                gap: 10px;
            }

            .topbar-left {
                gap: 10px;
            }

            .page-title {
                font-size: 18px;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
                flex-basis: 36px;
            }

            .page-content {
                padding: 20px 14px;
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

        <nav class="sidebar-menu" aria-label="Menu utama">

            <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('katalog.index') }}" class="{{ request()->routeIs('katalog.*') ? 'active' : '' }}">
                <i class="fa-solid fa-tent"></i>
                <span>Jelajahi Katalog</span>
            </a>

            <a href="{{ route('user.rentals') }}" class="{{ request()->routeIs('user.rentals*') ? 'active' : '' }}">
                <i class="fa-solid fa-box-open"></i>
                <span>Rental Saya</span>
            </a>

            <a href="{{ route('user.transactions') }}"
                class="{{ request()->routeIs('user.transactions*') ? 'active' : '' }}">
                <i class="fa-solid fa-credit-card"></i>
                <span>Pembayaran</span>
            </a>

        </nav>

        <div class="menu-label">AKUN SAYA</div>

        <nav class="sidebar-menu" aria-label="Menu akun">

            <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile*') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span>Profil Saya</span>
            </a>

            <a href="{{ route('user.help') }}" class="{{ request()->routeIs('user.help*') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-question"></i>
                <span>Bantuan</span>
            </a>

        </nav>

        <div class="sidebar-bottom">
            <nav class="sidebar-menu" aria-label="Keluar akun">

                <a href="#" class="logout-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
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
            <div class="topbar-left">
                <button type="button" class="menu-toggle" id="mobileToggle" aria-label="Buka menu"
                    aria-controls="sidebar" aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <button type="button" class="desktop-toggle" id="desktopToggle"
                    aria-label="Perkecil atau perbesar sidebar" title="Perkecil atau perbesar sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="user-chip">
                <div class="user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="d-none d-sm-block">
                    <div class="user-name fw-bold">
                        {{ Auth::user()->name ?? 'Pengguna' }}
                    </div>
                    <div class="user-role">Member GearCamp</div>
                </div>
            </div>
        </header>

        <section class="page-content">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @yield('content')

        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileToggle');
            const desktopToggle = document.getElementById('desktopToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function closeMobileSidebar() {
                document.body.classList.remove('sidebar-open');

                if (mobileToggle) {
                    mobileToggle.setAttribute('aria-expanded', 'false');
                }
            }

            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    const isOpen = document.body.classList.toggle('sidebar-open');
                    mobileToggle.setAttribute('aria-expanded', String(isOpen));
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeMobileSidebar);
            }

            if (desktopToggle) {
                desktopToggle.addEventListener('click', function() {
                    document.body.classList.toggle('sidebar-collapsed');
                });
            }

            // Tutup sidebar mobile setelah menu dipilih.
            document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991) {
                        closeMobileSidebar();
                    }
                });
            });

            // Reset sidebar mobile ketika layar kembali ke desktop.
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991) {
                    closeMobileSidebar();
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
