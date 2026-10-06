<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GearCamp - Rental Perlengkapan Camping</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8faf9;
            color: #1f2933;
        }

        /* ================= NAVBAR ================= */

        .navbar {
            background: #ffffff;
            padding: 18px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-size: 25px;
            font-weight: 700;
            color: #183b2b !important;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .nav-link {
            color: #374151 !important;
            font-weight: 500;
            margin-left: 20px;
        }

        .nav-link:hover {
            color: #2f6b4f !important;
        }

        .btn-login {
            border: 1px solid #2f6b4f;
            color: #2f6b4f;
            border-radius: 8px;
            padding: 9px 20px;
            margin-left: 20px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-login:hover {
            background: #2f6b4f;
            color: white;
        }

        /* ================= HERO ================= */

        .hero {
            min-height: 600px;

            display: flex;
            align-items: center;

            background-image:
                linear-gradient(
                    rgba(12, 35, 24, 0.68),
                    rgba(12, 35, 24, 0.68)
                ),
                url("https://www.beyondthetent.com/wp-content/uploads/2023/09/outdoor-photos-2-1024x683.jpeg");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            color: white;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero h1 {
            font-size: 58px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 19px;
            line-height: 1.7;
            color: #e5e7eb;
            margin-bottom: 30px;
        }

        .btn-primary-custom {
            background: #d49a4a;
            border: none;
            color: white;
            padding: 13px 28px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-primary-custom:hover {
            background: #b77e35;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 1px solid white;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }

        .btn-outline-custom:hover {
            background: white;
            color: #183b2b;
        }

        /* ================= SECTION ================= */

        .section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 700;
            color: #183b2b;
        }

        .section-title p {
            color: #6b7280;
            margin-top: 10px;
        }

        /* ================= FEATURES ================= */

        .feature-card {
            background: white;
            padding: 35px 25px;
            border-radius: 15px;
            text-align: center;
            height: 100%;
            border: 1px solid #e5e7eb;
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .feature-icon {
            width: 65px;
            height: 65px;
            background: #e8f1ec;
            color: #2f6b4f;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 25px;
        }

        .feature-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.6;
        }

        /* ================= ABOUT ================= */

        .about {
            background: white;
        }

        .about-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 18px;
        }

        .about-content {
            padding-left: 30px;
        }

        .about-content h2 {
            color: #183b2b;
            font-weight: 700;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .about-content p {
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* ================= CTA ================= */

        .cta {
            background: #183b2b;
            color: white;
            text-align: center;
            padding: 70px 20px;
        }

        .cta h2 {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .cta p {
            color: #d1d5db;
            margin-bottom: 30px;
        }

        /* ================= FOOTER ================= */

        footer {
            background: #10271c;
            color: white;
            padding: 35px 0;
        }

        .footer-brand {
            font-size: 22px;
            font-weight: 700;
        }

        .footer-text {
            color: #9ca3af;
            margin-top: 8px;
        }

        .social a {
            color: white;
            margin-left: 15px;
            font-size: 18px;
            text-decoration: none;
        }

        .social a:hover {
            color: #d49a4a;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {

            .hero {
                min-height: 550px;
            }

            .hero h1 {
                font-size: 40px;
            }

            .hero p {
                font-size: 16px;
            }

            .btn-outline-custom {
                margin-left: 0;
                margin-top: 10px;
            }

            .about-content {
                padding-left: 0;
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg sticky-top">

        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-mountain-sun"></i>
                GearCamp
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">
                            Tentang
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#keunggulan">
                            Keunggulan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">
                            Kontak
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="btn-login">
                            Login
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- ================= HERO ================= -->

    <section class="hero">

        <div class="container">

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

                <a
                    href="{{ url('/katalog') }}"
                    class="btn-primary-custom">

                    <i class="fa-solid fa-campground"></i>
                    Lihat Katalog

                </a>

                <a
                    href="#tentang"
                    class="btn-outline-custom">

                    Tentang GearCamp

                </a>

            </div>

        </div>

    </section>


    <!-- ================= KEUNGGULAN ================= -->

    <section class="section" id="keunggulan">

        <div class="container">

            <div class="section-title">

                <h2>
                    Kenapa GearCamp?
                </h2>

                <p>
                    Semua yang kamu butuhkan untuk perjalanan camping
                    yang lebih nyaman.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="feature-card">

                        <div class="feature-icon">

                            <i class="fa-solid fa-campground"></i>

                        </div>

                        <h5>
                            Perlengkapan Lengkap
                        </h5>

                        <p>
                            Berbagai perlengkapan camping tersedia
                            untuk memenuhi kebutuhan perjalananmu.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="feature-card">

                        <div class="feature-icon">

                            <i class="fa-solid fa-tags"></i>

                        </div>

                        <h5>
                            Harga Terjangkau
                        </h5>

                        <p>
                            Nikmati pengalaman camping tanpa harus
                            membeli perlengkapan yang mahal.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="feature-card">

                        <div class="feature-icon">

                            <i class="fa-solid fa-shield-heart"></i>

                        </div>

                        <h5>
                            Peralatan Berkualitas
                        </h5>

                        <p>
                            Setiap perlengkapan diperiksa agar tetap
                            layak dan nyaman digunakan.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= ABOUT ================= -->

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

                        <h2>
                            Siap untuk Petualanganmu?
                        </h2>

                        <p>
                            GearCamp hadir untuk membantu kamu menikmati
                            kegiatan outdoor dengan lebih mudah.
                        </p>

                        <p>
                            Tidak perlu membeli banyak perlengkapan camping.
                            Cukup pilih peralatan yang kamu butuhkan,
                            lakukan pemesanan, dan nikmati perjalananmu.
                        </p>

                        <a
                            href="{{ url('/katalog') }}"
                            class="btn-primary-custom">

                            Jelajahi Katalog

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= CTA ================= -->

    <section class="cta" id="kontak">

        <div class="container">

            <h2>
                Mulai Petualanganmu
            </h2>

            <p>
                Temukan perlengkapan camping yang sesuai
                dengan kebutuhanmu.
            </p>

            <a
                href="{{ url('/katalog') }}"
                class="btn-primary-custom">

                Lihat Katalog

            </a>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->

    <footer>

        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <div class="footer-brand">

                        <i class="fa-solid fa-mountain-sun"></i>
                        GearCamp

                    </div>

                    <div class="footer-text">

                        Rental perlengkapan camping
                        untuk petualanganmu.

                    </div>

                </div>


                <div class="col-md-6 text-md-end mt-3 mt-md-0">

                    <div class="social">

                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>

                    </div>

                </div>

            </div>

            <hr style="border-color: #294334;">

            <div class="text-center footer-text">

                © {{ date('Y') }} GearCamp.
                All Rights Reserved.

            </div>

        </div>

    </footer>


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>