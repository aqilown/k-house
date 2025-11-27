<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kost - K.House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Header */
        .top-bar {
            background: #3d5a4a;
            color: white;
            padding: 10px 0;
            font-size: 13px;
        }

        .top-bar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
        }

        .top-bar .contact-info {
            display: flex;
            gap: 30px;
        }

        .top-bar .social-links {
            display: flex;
            gap: 15px;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
        }

        /* Navbar */
        nav {
            background: #2d4538;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        nav .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            width: 50px;
        }

        .logo-text {
            color: white;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #d4a574;
        }

        .btn-get-started {
            background: #d4a574;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-get-started:hover {
            background: #c49564;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Hero Section */
        .hero-search {
            background: linear-gradient(rgba(45, 69, 56, 0.7), rgba(45, 69, 56, 0.7)), url('{{ asset("background-kost.jpg") }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 20px 60px;
        }

        .hero-search .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .breadcrumb a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb span {
            color: rgba(255,255,255,0.7);
        }

        .hero-search h1 {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .hero-search p {
            font-size: 16px;
            line-height: 1.8;
            max-width: 700px;
            color: rgba(255,255,255,0.9);
        }

        /* Search Box */
        .search-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50px;
            padding: 15px 20px;
            margin-top: 40px;
            display: flex;
            gap: 15px;
            align-items: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 900px;
        }

        .search-field {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 15px;
            border-right: 1px solid #d0d0d0;
        }

        .search-field:last-of-type {
            border-right: none;
        }

        .search-field i {
            color: #3d5a4a;
            font-size: 22px;
        }

        .search-field-content {
            flex: 1;
        }

        .search-field-label {
            font-size: 14px;
            color: #555;
            margin-bottom: 0;
            font-weight: 500;
        }

        .search-field input,
        .search-field select {
            border: none;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: #333;
            font-weight: 500;
            background: transparent;
            cursor: pointer;
        }

        .btn-search {
            background: #3d5a4a;
            color: white;
            padding: 15px 45px;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
        }

        .btn-search:hover {
            background: #2d4538;
            transform: scale(1.05);
        }

        /* Results Section */
        .results-section {
            padding: 60px 20px;
            background: #F3ECDC;
        }

        .results-section .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .results-count {
            font-size: 18px;
            color: #666;
        }

        .filter-buttons {
            display: flex;
            gap: 15px;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: #3d5a4a;
            background: #3d5a4a;
            color: white;
        }

        /* Kost Cards */
        .kost-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .kost-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            display: grid;
            grid-template-columns: 280px 1fr;
        }

        .kost-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }

        .kost-image {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .kost-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .kost-content {
            padding: 25px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kost-header {
            margin-bottom: 15px;
        }

        .kost-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .stars {
            color: #ffa500;
            font-size: 14px;
        }

        .rating-text {
            color: #666;
            font-size: 13px;
        }

        .kost-title {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .kost-location {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .kost-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .badge {
            background: #f0f0f0;
            color: #666;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .kost-rooms {
            margin-bottom: 20px;
        }

        .room-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .room-item:last-child {
            border-bottom: none;
        }

        .room-type {
            color: #666;
            font-size: 14px;
        }

        .room-price {
            font-weight: bold;
            color: #3d5a4a;
            font-size: 15px;
        }

        .kost-footer {
            display: flex;
            justify-content: flex-end;
            padding-top: 15px;
        }

        .btn-detail {
            background: #3d5a4a;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-detail:hover {
            background: #2d4538;
            transform: scale(1.05);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
        }

        .pagination a:hover,
        .pagination a.active {
            background: #3d5a4a;
            color: white;
            border-color: #3d5a4a;
        }

        /* Footer */
        footer {
            background: #2d4538;
            color: white;
            padding: 60px 20px 30px;
        }

        footer .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 50px;
            margin-bottom: 40px;
        }

        .footer-about h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer-about p {
            color: rgba(255,255,255,0.8);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-social {
            display: flex;
            gap: 15px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: #d4a574;
        }

        .footer-links h4 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 12px;
        }

        .footer-links ul li a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links ul li a:hover {
            color: #d4a574;
        }

        .footer-contact {
            color: rgba(255,255,255,0.8);
        }

        .footer-contact h4 {
            color: white;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-contact p {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .search-box {
                flex-direction: column;
                border-radius: 15px;
            }

            .search-field {
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
                padding-bottom: 15px;
            }

            .kost-grid {
                grid-template-columns: 1fr;
            }

            footer .container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="contact-info">
                <span><i class="fas fa-envelope"></i> k.house@gmail.com</span>
                <span><i class="fas fa-phone"></i> (+62) 812 3456 7890</span>
            </div>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('logo-khouse.png') }}" alt="K.House Logo" class="logo">
                <span class="logo-text">K.HOUSE</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}">HOME</a>
                <a href="{{ route('about') }}">ABOUT US</a>
                <a href="{{ route('cari-kost') }}">CARI KOST</a>
                <a href="{{ route('login') }}" class="btn-get-started">GET STARTED</a>
            </div>
        </div>
    </nav>

    <!-- Hero Search Section -->
    <section class="hero-search">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOMEPAGE</a>
                <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                <span>CARI KOST</span>
            </div>
            <h1>Cari Kost atau Apartemen</h1>
            <p>Segera cari tempat yang ingin anda inap, atur jadwal checkin dan checkout</p>

            <!-- Search Box -->
            <div class="search-box">
                <div class="search-field">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="search-field-content">
                        <div class="search-field-label">Pilih kota yang dituju</div>
                        <input type="text" placeholder="Cari lokasi kost...">
                    </div>
                </div>

                <div class="search-field">
                    <i class="fas fa-home"></i>
                    <div class="search-field-content">
                        <div class="search-field-label">Jenis Kost</div>
                        <select style="border: none; outline: none; font-size: 14px; width: 100%; color: #333; font-weight: 500; background: transparent; cursor: pointer;">
                            <option value="">Semua</option>
                            <option value="putra">Putra</option>
                            <option value="putri">Putri</option>
                            <option value="campur">Campur</option>
                        </select>
                    </div>
                </div>

                <button class="btn-search">Cari</button>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="results-section">
        <div class="container">
            <div class="results-header">
                <div class="results-count">
                    Menampilkan <strong>3</strong> kost tersedia
                </div>
            </div>

            <!-- Kost Grid -->
            <div class="kost-grid">
                <!-- Kost Card 1 -->
                <div class="kost-card">
                    <div class="kost-image">
                        <img src="{{ asset('kost-image1.png') }}" alt="Kost 1">
                    </div>
                    <div class="kost-content">
                        <div class="kost-header">
                            <div class="kost-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <span style="color: #333; font-weight: 600;">4.3/5</span>
                                </div>
                                <span class="rating-text">(199+ reviews)</span>
                            </div>
                            <h3 class="kost-title">Kost 1</h3>
                            <div class="kost-location">
                                <span>Lowokwaru, Malang</span>
                            </div>
                            <div class="kost-badges">
                                <span class="badge">Unit Laundry</span>
                                <span class="badge">Perlengkapan Dapur</span>
                                <span class="badge">Putra</span>
                            </div>
                        </div>
                        <div class="kost-rooms">
                            <div class="room-item">
                                <span class="room-type">Kamar Mandi Dalam</span>
                                <span class="room-price">Mulai Rp 1000K</span>
                            </div>
                            <div class="room-item">
                                <span class="room-type">Dapur Dalam</span>
                                <span class="room-price">Mulai Rp 1200K</span>
                            </div>
                            <div class="room-item">
                                <span class="room-type">Dapur dan Kamar Mandi Dalam</span>
                                <span class="room-price">Mulai Rp 1500K</span>
                            </div>
                        </div>
                        <div class="kost-footer">
                            <a href="#" class="btn-detail">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Kost Card 2 -->
                <div class="kost-card">
                    <div class="kost-image">
                        <img src="{{ asset('kost-image2.png') }}" alt="Kost 2">
                    </div>
                    <div class="kost-content">
                        <div class="kost-header">
                            <div class="kost-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <span style="color: #333; font-weight: 600;">3.8/5</span>
                                </div>
                                <span class="rating-text">(239 reviews)</span>
                            </div>
                            <h3 class="kost-title">Kost 2</h3>
                            <div class="kost-location">
                                <span>Singosari, Malang</span>
                            </div>
                            <div class="kost-badges">
                                <span class="badge">Ruangan luas</span>
                                <span class="badge">Ruangan ber AC</span>
                                <span class="badge">Putri</span>
                            </div>
                        </div>
                        <div class="kost-rooms">
                            <div class="room-item">
                                <span class="room-type">Room 1</span>
                                <span class="room-price">Mulai Rp 800K</span>
                            </div>
                        </div>
                        <div class="kost-footer">
                            <a href="#" class="btn-detail">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Kost Card 3 -->
                <div class="kost-card">
                    <div class="kost-image">
                        <img src="{{ asset('kost-image3.png') }}" alt="Kost 3">
                    </div>
                    <div class="kost-content">
                        <div class="kost-header">
                            <div class="kost-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <span style="color: #333; font-weight: 600;">New</span>
                                </div>
                                <span class="rating-text">to Spotter</span>
                            </div>
                            <h3 class="kost-title">Kost 3</h3>
                            <div class="kost-location">
                                <span>Araya, Malang</span>
                            </div>
                            <div class="kost-badges">
                                <span class="badge">Unit Laundry</span>
                                <span class="badge">Perlengkapan Dapur</span>
                                <span class="badge">Ruangan Fitness</span>
                                <span class="badge">Ruangan ber AC</span>
                                <span class="badge">Campur</span>
                            </div>
                        </div>
                        <div class="kost-rooms">
                            <div class="room-item">
                                <span class="room-type">Mezzanine</span>
                                <span class="room-price">Mulai Rp 2000K</span>
                            </div>
                            <div class="room-item">
                                <span class="room-type">1 Tempat Tidur</span>
                                <span class="room-price">Mulai Rp 1500K</span>
                            </div>
                            <div class="room-item">
                                <span class="room-type">2 Tempat Tidur</span>
                                <span class="room-price">Mulai Rp 2000K</span>
                            </div>
                        </div>
                        <div class="kost-footer">
                            <a href="#" class="btn-detail">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">...</a>
                <a href="#">5</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-about">
                <h3><img src="{{ asset('logo-khouse.png') }}" alt="Logo" style="width: 40px; vertical-align: middle; margin-right: 10px;">K.HOUSE</h3>
                <p>Aplikasi inovatif penggelolaan dari Kost di Indonesia.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Cari Kost</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h4>Tetap bersama kami</h4>
                <p><i class="fas fa-map-marker-alt"></i> Malang, Indonesia</p>
                <p><i class="fas fa-envelope"></i> khouse@Email.com</p>
                <p><i class="fas fa-phone"></i> (+62) 812 3456 7890</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>COPYRIGHT © K.HOUSE</p>
        </div>
    </footer>
</body>
</html>