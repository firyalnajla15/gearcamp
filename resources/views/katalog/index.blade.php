<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Katalog - GearCamp</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8faf9;
            color: #1f2933;
        }

        /* NAVBAR */
        .navbar {
            background: #ffffff;
            padding: 17px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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

        /* CART */
        .cart-btn {
            margin-left: 20px;
            border: 1px solid #2f6b4f;
            color: #2f6b4f;
            border-radius: 8px;
            padding: 8px 17px;
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }

        .cart-btn:hover {
            background: #2f6b4f;
            color: white;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #d49a4a;
            color: white;
            font-size: 11px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* HEADER */
        .catalog-header {
            background: #183b2b;
            padding: 65px 20px;
            color: white;
            text-align: center;
        }

        .catalog-header h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .catalog-header p {
            color: #d1d5db;
            margin: 0;
            font-size: 17px;
        }

        /* FILTER */
        .filter-section {
            padding: 35px 0 10px;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #6b7280;
        }

        .search-box input {
            padding-left: 42px;
            height: 46px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .category-select {
            height: 46px;
            border-radius: 8px;
        }

        /* PRODUCT CARD */
        .product-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            height: 100%;
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.09);
        }

        .product-image {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        .product-content {
            padding: 20px;
        }

        .product-category {
            font-size: 12px;
            color: #2f6b4f;
            background: #e8f1ec;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .product-name {
            font-size: 20px;
            font-weight: 700;
            color: #183b2b;
            margin-bottom: 8px;
        }

        .product-description {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            min-height: 45px;
            margin-bottom: 15px;
        }

        .product-price {
            color: #183b2b;
            font-size: 19px;
            font-weight: 700;
        }

        .product-price span {
            font-size: 13px;
            font-weight: 400;
            color: #6b7280;
        }

        .stock {
            font-size: 13px;
            color: #6b7280;
        }

        .product-actions {
            display: flex;
            gap: 8px;
            margin-top: 18px;
        }

        .btn-detail {
            flex: 1;
            border: 1px solid #2f6b4f;
            color: #2f6b4f;
            padding: 9px;
            border-radius: 7px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-detail:hover {
            background: #e8f1ec;
            color: #183b2b;
        }

        .btn-cart {
            flex: 1;
            border: none;
            background: #2f6b4f;
            color: white;
            padding: 9px;
            border-radius: 7px;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-cart:hover {
            background: #24543e;
        }

        /* FOOTER */
        footer {
            background: #10271c;
            color: white;
            margin-top: 80px;
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

        @media (max-width: 768px) {

            .catalog-header h1 {
                font-size: 34px;
            }

            .cart-btn {
                margin-left: 0;
                margin-top: 10px;
            }

            .nav-link {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">

    <div class="container">

        <a class="navbar-brand" href="/">
            <i class="fa-solid fa-mountain-sun"></i>
            GearCamp
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/katalog">
                        Katalog
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Kontak
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="cart-btn">

                        <i class="fa-solid fa-cart-shopping"></i>
                        Cart

                        <span class="cart-badge">
                            0
                        </span>

                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>


<!-- HEADER -->
<section class="catalog-header">

    <div class="container">

        <h1>Katalog GearCamp</h1>

        <p>
            Temukan perlengkapan camping yang kamu butuhkan
            untuk perjalananmu.
        </p>

    </div>

</section>


<!-- FILTER -->
<section class="filter-section">

    <div class="container">

        <div class="row g-3">

            <div class="col-md-8">

                <div class="search-box">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari perlengkapan camping...">

                </div>

            </div>

            <div class="col-md-4">

                <select class="form-select category-select">

                    <option selected>Semua Kategori</option>
                    <option>Tenda</option>
                    <option>Tas & Carrier</option>
                    <option>Sleeping Bag</option>
                    <option>Peralatan Masak</option>
                    <option>Peralatan Outdoor</option>

                </select>

            </div>

        </div>

    </div>

</section>


<!-- PRODUCTS -->
<section class="py-4">

    <div class="container">

        <div class="row g-4">


            <!-- PRODUCT 1 -->
            <div class="col-lg-4 col-md-6">

                <div class="product-card">

                    <img
                        src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=900&q=80"
                        class="product-image"
                        alt="Tenda Dome 4 Orang">

                    <div class="product-content">

                        <div class="product-category">
                            Tenda
                        </div>

                        <div class="product-name">
                            Tenda Dome 4 Orang
                        </div>

                        <div class="product-description">
                            Tenda nyaman untuk camping bersama
                            teman atau keluarga.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="product-price">
                                Rp75.000
                                <span>/ hari</span>
                            </div>

                            <div class="stock">
                                Stok: 5
                            </div>

                        </div>

                        <div class="product-actions">

                            <a href="#" class="btn-detail">
                                Detail
                            </a>

                            <button class="btn-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PRODUCT 2 -->
            <div class="col-lg-4 col-md-6">

                <div class="product-card">

                    <img
                        src="https://m.media-amazon.com/images/I/81ROCYp2DwL._AC_SL1050_.jpg"
                        class="product-image"
                        alt="Sleeping Bag">

                    <div class="product-content">

                        <div class="product-category">
                            Sleeping Bag
                        </div>

                        <div class="product-name">
                            Sleeping Bag Outdoor
                        </div>

                        <div class="product-description">
                            Sleeping bag hangat dan nyaman
                            untuk menemani malam di alam.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="product-price">
                                Rp25.000
                                <span>/ hari</span>
                            </div>

                            <div class="stock">
                                Stok: 8
                            </div>

                        </div>

                        <div class="product-actions">

                            <a href="#" class="btn-detail">
                                Detail
                            </a>

                            <button class="btn-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PRODUCT 3 -->
            <div class="col-lg-4 col-md-6">

                <div class="product-card">

                    <img
                        src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=900&q=80"
                        class="product-image"
                        alt="Carrier 60 Liter">

                    <div class="product-content">

                        <div class="product-category">
                            Tas & Carrier
                        </div>

                        <div class="product-name">
                            Carrier 60L
                        </div>

                        <div class="product-description">
                            Carrier dengan kapasitas besar
                            untuk perjalanan hiking dan camping.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="product-price">
                                Rp35.000
                                <span>/ hari</span>
                            </div>

                            <div class="stock">
                                Stok: 4
                            </div>

                        </div>

                        <div class="product-actions">

                            <a href="#" class="btn-detail">
                                Detail
                            </a>

                            <button class="btn-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PRODUCT 4 -->
            <div class="col-lg-4 col-md-6">

                <div class="product-card">

                    <img
                        src="https://enviostore.com/media/product/452/product_image_6-1686985973.jpg"
                        class="product-image"
                        alt="Kompor Camping">

                    <div class="product-content">

                        <div class="product-category">
                            Peralatan Masak
                        </div>

                        <div class="product-name">
                            Kompor Camping
                        </div>

                        <div class="product-description">
                            Kompor portable yang praktis untuk
                            memasak selama camping.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="product-price">
                                Rp20.000
                                <span>/ hari</span>
                            </div>

                            <div class="stock">
                                Stok: 6
                            </div>

                        </div>

                        <div class="product-actions">

                            <a href="#" class="btn-detail">
                                Detail
                            </a>

                            <button class="btn-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PRODUCT 5 -->
            <div class="col-lg-4 col-md-6">

                <div class="product-card">

                    <img
                        src="https://down-id.img.susercontent.com/file/id-11134207-7rasg-m5tvbzper1na94"
                        class="product-image"
                        alt="Matras Camping">

                    <div class="product-content">

                        <div class="product-category">
                            Peralatan Outdoor
                        </div>

                        <div class="product-name">
                            Matras Camping
                        </div>

                        <div class="product-description">
                            Matras ringan untuk memberikan
                            kenyamanan saat beristirahat.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="product-price">
                                Rp15.000
                                <span>/ hari</span>
                            </div>

                            <div class="stock">
                                Stok: 10
                            </div>

                        </div>

                        <div class="product-actions">

                            <a href="#" class="btn-detail">
                                Detail
                            </a>

                            <button class="btn-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PRODUCT 6 -->
            <div class="col-lg-4 col-md-6">

                <div class="product-card">

                    <img
                        src="https://www.bhphotovideo.com/images/images2000x2000/nitecore_nu43_rechargeable_led_headlamp_1740777.jpg"
                        class="product-image"
                        alt="Headlamp">

                    <div class="product-content">

                        <div class="product-category">
                            Peralatan Outdoor
                        </div>

                        <div class="product-name">
                            Headlamp Outdoor
                        </div>

                        <div class="product-description">
                            Lampu kepala praktis untuk aktivitas
                            outdoor pada malam hari.
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="product-price">
                                Rp10.000
                                <span>/ hari</span>
                            </div>

                            <div class="stock">
                                Stok: 12
                            </div>

                        </div>

                        <div class="product-actions">

                            <a href="#" class="btn-detail">
                                Detail
                            </a>

                            <button class="btn-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>


<!-- FOOTER -->
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

                <div class="footer-text">
                    © {{ date('Y') }} GearCamp. All Rights Reserved.
                </div>

            </div>

        </div>

    </div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
