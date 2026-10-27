<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GearCamp - Rental Perlengkapan Camping</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green-900: #10271c;
            --green-800: #183b2b;
            --green-700: #2f6b4f;
            --green-100: #e8f1ec;
            --gold-500: #d49a4a;
            --gold-600: #b77e35;
            --ink-900: #1f2933;
            --ink-500: #6b7280;
            --line: #e5e7eb;
            --paper: #f8faf9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: var(--paper);
            color: var(--ink-900);
            -webkit-font-smoothing: antialiased;
            line-height: 1.65;
        }

        /* NAVBAR - Transparan di atas Hero */
        .navbar {
            background: transparent;
            padding: 24px 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all .3s ease;
        }

        .navbar-brand {
            font-family: 'Fraunces', serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -.02em;
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            color: var(--gold-500);
            transition: transform .4s ease;
        }

        .navbar-brand:hover i {
            transform: translateY(-2px) rotate(-6deg);
        }

        .nav-link {
            color: rgba(255, 255, 255, .85) !important;
            font-weight: 500;
            font-size: 15px;
            margin-left: 8px;
            padding: 8px 12px !important;
            transition: color .25s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff !important;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid rgba(255, 255, 255, .4);
            color: #fff;
            background: transparent;
            border-radius: 50px;
            padding: 10px 28px;
            margin-left: 16px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: all .3s ease;
        }

        .btn-login:hover, .btn-login[aria-expanded="true"] {
            background: #fff;
            color: var(--green-800);
            border-color: #fff;
        }

        .cart-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .cart-link i {
            color: var(--gold-500);
        }

        .dropdown-menu {
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 18px 40px -20px rgba(16, 39, 28, .45);
            margin-top: 12px;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14.5px;
            font-weight: 500;
            color: var(--ink-900);
            transition: background .2s ease, color .2s ease;
        }

        .dropdown-item:hover {
            background: var(--green-100);
            color: var(--green-800);
        }

        /* HERO */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image:
                linear-gradient(to bottom, rgba(12, 35, 24, .55) 0%, rgba(12, 35, 24, .35) 50%, rgba(12, 35, 24, .85) 100%),
                url("https://www.beyondthetent.com/wp-content/uploads/2023/09/outdoor-photos-2-1024x683.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            padding-top: 100px;
            padding-bottom: 40px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            animation: riseIn .9s cubic-bezier(.22, .61, .36, 1) both;
        }

        @keyframes riseIn {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero h1 {
            font-family: 'Fraunces', serif;
            font-size: 64px;
            font-weight: 400;
            line-height: 1.1;
            letter-spacing: -.01em;
            margin-bottom: 24px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, .3);
        }

        .hero p {
            font-size: 17px;
            line-height: 1.6;
            color: #e9efe9;
            margin-bottom: 36px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 2px 10px rgba(0, 0, 0, .3);
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--gold-500);
            border: none;
            color: white;
            padding: 16px 36px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .02em;
            text-decoration: none;
            box-shadow: 0 8px 24px -8px rgba(212, 154, 74, .7);
            transition: all .28s cubic-bezier(.22, .61, .36, 1);
        }

        .btn-primary-custom:hover {
            background: var(--gold-600);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -8px rgba(183, 126, 53, .8);
        }

        .btn-outline-custom {
            display: none;
        }

        /* 4 Kotak Fitur di Bawah Hero */
        .hero-features {
            width: 100%;
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .hero-feature-box {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 24px 20px;
            text-align: left;
            transition: transform .3s ease, background .3s ease;
        }

        .hero-feature-box:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-4px);
        }

        .hero-feature-box h6 {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-feature-box h6 i {
            color: var(--gold-500);
            font-size: 18px;
        }

        .hero-feature-box p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 12.5px;
            margin: 0;
            line-height: 1.5;
        }

        /* SECTION */
        .section {
            padding: 92px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 56px;
        }

        .section-title h2 {
            position: relative;
            display: inline-block;
            font-family: 'Fraunces', serif;
            font-size: 38px;
            font-weight: 700;
            letter-spacing: -.02em;
            color: var(--green-800);
            padding-bottom: 16px;
        }

        .section-title h2::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 56px;
            height: 3px;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--gold-500), #e8c48f);
        }

        .section-title p {
            color: var(--ink-500);
            margin-top: 14px;
            font-size: 16px;
        }

        /* FEATURES */
        .feature-card {
            position: relative;
            background: white;
            padding: 40px 28px 34px;
            border-radius: 18px;
            text-align: center;
            height: 100%;
            border: 1px solid var(--line);
            overflow: hidden;
            transition: transform .35s cubic-bezier(.22, .61, .36, 1), box-shadow .35s ease, border-color .35s ease;
        }

        .feature-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--green-700), var(--gold-500));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .4s cubic-bezier(.22, .61, .36, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 48px -24px rgba(16, 39, 28, .35);
            border-color: transparent;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 68px;
            height: 68px;
            background: linear-gradient(180deg, #f1f7f3, var(--green-100));
            color: var(--green-700);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            font-size: 26px;
            box-shadow: inset 0 0 0 1px rgba(47, 107, 79, .1);
            transition: transform .4s cubic-bezier(.22, .61, .36, 1), background .3s ease, color .3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: translateY(-3px) scale(1.05);
            background: linear-gradient(180deg, var(--green-700), var(--green-800));
            color: #fff;
        }

        .feature-card h5 {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 12px;
            color: var(--ink-900);
        }

        .feature-card p {
            color: var(--ink-500);
            line-height: 1.7;
            font-size: 15px;
        }

        /* ABOUT */
        .about {
            background: white;
        }

        .about-img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 30px 60px -30px rgba(16, 39, 28, .45);
            transition: transform .6s cubic-bezier(.22, .61, .36, 1);
        }

        .about-img:hover {
            transform: scale(1.015);
        }

        .about-content {
            padding-left: 34px;
        }

        .about-content h2 {
            font-family: 'Fraunces', serif;
            color: var(--green-800);
            font-weight: 700;
            font-size: 38px;
            letter-spacing: -.02em;
            margin-bottom: 20px;
        }

        .about-content p {
            color: var(--ink-500);
            line-height: 1.85;
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* CTA */
        .cta {
            position: relative;
            background:
                radial-gradient(circle at 15% 20%, rgba(212, 154, 74, .14), transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(47, 107, 79, .35), transparent 50%),
                var(--green-800);
            color: white;
            text-align: center;
            padding: 82px 20px;
            overflow: hidden;
        }

        .cta::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, .05) 1px, transparent 1px);
            background-size: 26px 26px;
            opacity: .5;
            pointer-events: none;
        }

        .cta .container {
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-family: 'Fraunces', serif;
            font-size: 40px;
            font-weight: 700;
            letter-spacing: -.02em;
            margin-bottom: 15px;
        }

        .cta p {
            color: #d1d5db;
            margin-bottom: 30px;
            font-size: 16.5px;
        }

        /* FOOTER */
        footer {
            background: var(--green-900);
            color: white;
            padding: 40px 0 32px;
        }

        .footer-brand {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -.01em;
            display: inline-flex;
            align-items: center;
            gap: 9px;
        }

        .footer-brand i {
            color: var(--gold-500);
        }

        .footer-text {
            color: #9ca3af;
            margin-top: 8px;
            font-size: 14.5px;
        }

        .social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            color: white;
            margin-left: 8px;
            font-size: 17px;
            text-decoration: none;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .08);
            transition: all .28s ease;
        }

        .social a:hover {
            color: var(--green-900);
            background: var(--gold-500);
            border-color: var(--gold-500);
            transform: translateY(-3px);
            box-shadow: 0 12px 22px -12px rgba(212, 154, 74, .9);
        }

        hr {
            opacity: .12;
            margin: 28px 0 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .navbar {
                background: var(--green-800);
                padding: 16px 0;
            }
            
            .navbar-collapse {
                background: var(--green-800);
                padding: 16px;
                border-radius: 12px;
                margin-top: 12px;
                border: 1px solid rgba(255,255,255,.1);
            }

            .nav-link {
                margin-left: 0;
                padding: 10px 8px !important;
            }

            .btn-login {
                margin: 12px 0 0;
                width: 100%;
            }

            .navbar-nav {
                padding-top: 14px;
                gap: 2px;
            }
            
            .hero-features {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-content {
                padding-left: 0;
                margin-top: 34px;
            }

            .about-img {
                height: 340px;
            }
        }

        @media (max-width: 768px) {
            .section {
                padding: 64px 0;
            }

            .hero h1 {
                font-size: 44px;
            }

            .hero p {
                font-size: 16px;
            }
            
            .hero-features {
                grid-template-columns: 1fr;
            }

            .section-title h2,
            .about-content h2 {
                font-size: 30px;
            }

            .cta h2 {
                font-size: 32px;
            }
        }

        @media (max-width: 400px) {
            .hero h1 {
                font-size: 36px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR PUBLIK --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false"
                aria-label="Buka navigasi">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/katalog') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#keunggulan') }}">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#tentang') }}">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#kontak') }}">Kontak</a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link cart-link me-lg-2" href="{{ route('cart.index') }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Keranjang
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <button type="button" class="btn-login"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Login
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('/login/user') }}">
                                    <i class="fa-solid fa-user me-2"></i>Login User
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/login/admin') }}">
                                    <i class="fa-solid fa-user-shield me-2"></i>Login Admin
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-content">
            <h1>
                Explore More,<br>
                Worry Less.
            </h1>

            <p>
                Sewa perlengkapan camping berkualitas untuk menemani
                perjalanan outdoor kamu. Pilih perlengkapan yang kamu
                butuhkan dan mulai petualanganmu bersama GearCamp.
            </p>

            <a href="{{ url('/katalog') }}" class="btn-primary-custom">
                Lihat Katalog
            </a>

            <a href="#tentang" class="btn-outline-custom">
                Tentang GearCamp
            </a>
        </div>

        <div class="hero-features d-none d-md-grid">
            <div class="hero-feature-box">
                <h6><i class="fa-solid fa-campground"></i> Perlengkapan Lengkap</h6>
                <p>Berbagai perlengkapan camping tersedia untuk memenuhi kebutuhan perjalananmu.</p>
            </div>
            <div class="hero-feature-box">
                <h6><i class="fa-solid fa-tags"></i> Harga Terjangkau</h6>
                <p>Nikmati pengalaman camping tanpa harus membeli perlengkapan yang mahal.</p>
            </div>
            <div class="hero-feature-box">
                <h6><i class="fa-solid fa-shield-heart"></i> Peralatan Berkualitas</h6>
                <p>Setiap perlengkapan diperiksa agar tetap layak dan nyaman digunakan.</p>
            </div>
            <div class="hero-feature-box">
                <h6><i class="fa-solid fa-leaf"></i> Ramah Lingkungan</h6>
                <p>Bantu kurangi limbah dengan menyewa perlengkapan alih-alih membeli baru.</p>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN / CARA KERJA (Diubah isinya agar tidak double) --}}
    <section class="section" id="keunggulan">
        <div class="container">

            <div class="section-title">
                <h2>Bagaimana Cara Kerjanya?</h2>
                <p>Tiga langkah mudah untuk memulai petualangan camping impianmu.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <h5>1. Pilih Perlengkapan</h5>
                        <p>
                            Jelajahi katalog kami dan pilih tenda, tas, atau
                            perlengkapan camping lain yang kamu butuhkan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <h5>2. Tentukan Tanggal</h5>
                        <p>
                            Tentukan tanggal sewa dan lakukan pemesanan
                            secara online dengan cepat dan aman.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fa-solid fa-person-hiking"></i>
                        </div>
                        <h5>3. Mulai Petualangan</h5>
                        <p>
                            Ambil perlengkapanmu atau tunggu diantar, lalu
                            nikmati pengalaman outdoor yang tak terlupakan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- TENTANG --}}
    <section class="section about" id="tentang">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <img
                        src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=1000&q=80"
                        class="about-img"
                        alt="Camping GearCamp">
                </div>

                <div class="col-md-6">
                    <div class="about-content">
                        <h2>Siap untuk Petualanganmu?</h2>

                        <p>
                            GearCamp hadir untuk membantu kamu menikmati
                            kegiatan outdoor dengan lebih mudah.
                        </p>

                        <p>
                            Tidak perlu membeli banyak perlengkapan camping.
                            Cukup pilih peralatan yang kamu butuhkan,
                            lakukan pemesanan, dan nikmati perjalananmu.
                        </p>

                        <a href="{{ url('/katalog') }}" class="btn-primary-custom">
                            Jelajahi Katalog
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta" id="kontak">
        <div class="container">
            <h2>Mulai Petualanganmu</h2>

            <p>
                Temukan perlengkapan camping yang sesuai dengan kebutuhanmu.
            </p>

            <a href="{{ url('/katalog') }}" class="btn-primary-custom">
                Lihat Katalog
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <div class="footer-brand">
                        <i class="fa-solid fa-mountain-sun"></i>
                        GearCamp
                    </div>

                    <div class="footer-text">
                        Rental perlengkapan camping untuk petualanganmu.
                    </div>
                </div>

                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="social">
                        <a href="#" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" aria-label="Facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="#" aria-label="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

            </div>

            <hr style="border-color: #294334;">

            <div class="text-center footer-text">
                © {{ date('Y') }} GearCamp. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>