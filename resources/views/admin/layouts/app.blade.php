<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Admin') - GearCamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --green: #1f4d3a;
            --green-hover: #2d634b;
            --green-light: #e5eee8;
            --green-dark: #10271c;
            --gold: #d49a4a;
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
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
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
            background: var(--green-dark);
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: width .25s ease, transform .25s ease;
            box-shadow: 4px 0 24px -10px rgba(16, 39, 28, .3);
        }

        .brand {
            min-height: 57px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 9px 19px;
            margin-bottom: 21px;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            color: #fff;
            white-space: nowrap;
            font-family: 'Fraunces', serif;
            font-size: 22px;
            font-weight: 700;
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
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 12px;
            font-size: 20px;
            color: var(--gold);
        }

        .menu-label {
            padding: 0 12px;
            margin: 8px 0 11px;
            color: rgba(255, 255, 255, .5);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            white-space: nowrap;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-menu a {
            position: relative;
            min-height: 45px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 11px 14px;
            border-radius: 10px;
            color: rgba(255, 255, 255, .75);
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            transition: all .25s ease;
        }

        .sidebar-menu a i {
            flex: 0 0 20px;
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, .08);
            color: #fff;
            transform: translateX(3px);
        }

        .sidebar-menu a.active {
            background: rgba(255, 255, 255, .15);
            color: #fff;
            font-weight: 700;
        }

        .sidebar-menu a.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 10px;
            bottom: 10px;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: var(--gold);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, .12);
        }

        .sidebar-menu a.logout-link:hover {
            background: rgba(220, 53, 69, .2);
            color: #ffb3b8;
        }

        /* MAIN CONTENT */
        .main-content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: margin-left .25s ease;
        }

        /* TOPBAR */
        .topbar {
            min-height: 76px;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: rgba(255, 255, 255, .85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .topbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-title {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: var(--green-dark);
            font-family: 'Fraunces', serif;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 16px 6px 6px;
            background: #f8faf9;
            border: 1px solid var(--border);
            border-radius: 50px;
        }

        .user-avatar {
            flex: 0 0 38px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--green);
            color: #fff;
            font-size: 16px;
        }

        .user-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 14px;
            color: var(--green-dark);
        }

        .user-role {
            margin-top: 1px;
            color: var(--muted);
            font-size: 11.5px;
            font-weight: 500;
        }

        .page-content {
            padding: 35px 30px;
        }

        /* TOGGLE */
        .menu-toggle,
        .desktop-toggle {
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .menu-toggle {
            display: none;
            background: var(--green);
            color: #fff;
            border: none;
        }

        .desktop-toggle {
            display: inline-flex;
            background: #fff;
            color: var(--green);
            border: 1px solid var(--border);
        }

        .sidebar-overlay {
            display: none;
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
            border: none;
            font-weight: 500;
        }

        .alert-success {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* SIDEBAR COLLAPSED */
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
                padding: 11px 14px;
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
                background: rgba(16, 39, 28, .6);
            }

            .topbar {
                padding: 14px 20px;
            }

            .page-content {
                padding: 24px 20px;
            }
        }

        @media (max-width: 575.98px) {
            .topbar {
                min-height: 68px;
                gap: 10px;
                padding: 12px 15px;
            }

            .topbar-left {
                gap: 10px;
            }

            .page-title {
                font-size: 19px;
            }

            .user-chip {
                padding: 4px;
                border: none;
                background: transparent;
            }

            .page-content {
                padding: 20px 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR ADMIN --}}
    <aside class="sidebar" id="sidebar">

        <a href="{{ route('admin.dashboard') }}" class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-mountain-sun"></i>
            </div>
            <span class="brand-name">GearCamp</span>
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="sidebar-menu" aria-label="Menu utama">
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </nav>

        <div class="menu-label">MANAJEMEN</div>

        <nav class="sidebar-menu" aria-label="Menu manajemen">
            <a href="{{ route('admin.barang.index') }}">
                <i class="fas fa-box"></i>
                <span>Kelola Barang</span>
            </a>

            <a href="#" class="{{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i>
                <span>Kelola Kategori</span>
            </a>

            <a href="#" class="{{ request()->routeIs('admin.transaksi*') ? 'active' : '' }}">
                <i class="fa-solid fa-receipt"></i>
                <span>Kelola Transaksi</span>
            </a>

            <a href="#" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Kelola Pengguna</span>
            </a>
        </nav>

        <div class="menu-label">INFORMASI</div>

        <nav class="sidebar-menu" aria-label="Menu informasi">
            <a href="#" class="{{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Laporan & Statistik</span>
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

                <h1 class="page-title">
                    @yield('page-heading', 'Dashboard Admin')
                </h1>

            </div>

            <div class="user-chip">
                <div class="user-avatar">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <div class="d-none d-sm-block pe-2">
                    <div class="user-name fw-bold">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </div>
                    <div class="user-role">Admin GearCamp</div>
                </div>
            </div>

        </header>

        <section class="page-content">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            {{-- ISI HALAMAN DASHBOARD DAN HALAMAN ADMIN LAINNYA --}}
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

            document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991) {
                        closeMobileSidebar();
                    }
                });
            });

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
