<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K.House - Temukan Kost Impian Anda</title>
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
        .hero {
            background: linear-gradient(rgba(45, 69, 56, 0.7), rgba(45, 69, 56, 0.7)), url('background-kost.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 20px;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero h1 .highlight {
            color: #d4a574;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn-primary {
            background: #3d5a4a;
            color: white;
            padding: 15px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #2d4538;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            padding: 15px 35px;
            border: 2px solid white;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: white;
            color: #3d5a4a;
        }

        /* Stats Section */
        .stats {
            background: #2d4538;
            padding: 40px 20px;
        }

        .stats .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            text-align: center;
            color: white;
        }

        .stat-item h3 {
            font-size: 42px;
            margin-bottom: 10px;
            color: #d4a574;
        }

        .stat-item p {
            font-size: 14px;
        }

        /* Featured Section */
        .featured {
            padding: 80px 20px;
            background: #f8f5f0;
        }

        .featured .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-tag {
            color: #3d5a4a;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .section-title {
            font-size: 36px;
            margin: 15px 0;
            color: #1a1a1a;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
        }

        .featured-card {
            background: #3d5a4a;
            color: white;
            padding: 40px;
            border-radius: 20px;
            position: relative;
        }

        .featured-card .quote-icon {
            font-size: 48px;
            color: rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }

        .featured-card p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .featured-card .author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .featured-card .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #d4a574;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
        }

        .featured-images {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .featured-image {
            border-radius: 15px;
            overflow: hidden;
            height: 200px;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .featured-image:hover img {
            transform: scale(1.1);
        }

        /* Services Section */
        .services {
            padding: 80px 20px;
            background: white;
        }

        .services .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-image {
            max-width: 500px;
            margin: 0 auto 50px;
            border-radius: 20px;
            overflow: hidden;
        }

        .service-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .customer-badge {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: #3d5a4a;
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .customer-badge h4 {
            font-size: 36px;
            margin-bottom: 5px;
        }

        .customer-badge p {
            font-size: 14px;
        }

        .service-content {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 50px;
        }

        .service-content h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .service-content p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .service-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .service-card {
            background: white;
            border: 2px solid #e0e0e0;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
        }

        .service-card:hover {
            border-color: #3d5a4a;
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .service-card .icon {
            width: 80px;
            height: 80px;
            background: #3d5a4a;
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
        }

        .service-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #1a1a1a;
        }

        .service-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .service-card a {
            color: #3d5a4a;
            font-weight: 600;
            text-decoration: none;
        }

        /* Testimonial Section */
        .testimonials {
            padding: 80px 20px;
            background: #2d4538;
            color: white;
        }

        .testimonials .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }

        .testimonials .section-tag {
            color: #d4a574;
        }

        .testimonials .section-title {
            color: white;
            text-align: left;
        }

        .testimonials .see-all {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background: white;
            color: #333;
            padding: 30px;
            border-radius: 15px;
        }

        .rating {
            color: #ffa500;
            margin-bottom: 15px;
        }

        .testimonial-card p {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 20px;
            color: #666;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .testimonial-author-info h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .testimonial-author-info p {
            font-size: 13px;
            color: #999;
            margin: 0;
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

            .stats .container {
                grid-template-columns: repeat(2, 1fr);
            }

            .featured-grid,
            .testimonial-grid {
                grid-template-columns: 1fr;
            }

            .service-cards {
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
                <img src="logo-khouse.png" alt="K.House Logo" class="logo">
                <span class="logo-text">K.HOUSE</span>
            </div>
            <div class="nav-links">
                <a href="#home">HOME</a>
                <a href="#about">ABOUT US</a>
                <a href="#check-in">CHECK IN, CHECK OUT</a>
                <a href="#blog">BLOG</a>
                <a href="login.blade.php" class="btn-get-started">GET STARTED</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Ayo, <span class="highlight">Cari</span> Kost<br>Impian <span class="highlight">Anda</span> Disini..</h1>
            <p>Kost impian Anda hanya sekali klik jauhnya. Temukan kenyamanan dalam Semua Kost di Indonesia.</p>
            <div class="hero-buttons">
                <a href="#" class="btn-primary">LIHAT SELENGKAPNYA</a>
                <a href="#" class="btn-secondary">COBA SEKARANG</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stat-item">
                <h3>100+</h3>
                <p>Kost Terbaik</p>
            </div>
            <div class="stat-item">
                <h3>26</h3>
                <p>Partner Kami</p>
            </div>
            <div class="stat-item">
                <h3>12K+</h3>
                <p>Customer anda</p>
            </div>
            <div class="stat-item">
                <h3>07th+</h3>
                <p>Pengalaman Terbaik</p>
            </div>
        </div>
    </section>

    <!-- Featured Section -->
    <section class="featured">
        <div class="container">
            <div class="section-header">
                <p class="section-tag">LAYANAN KAMI</p>
                <h2 class="section-title">Kost impian dan ruangan yang<br>modern.</h2>
            </div>
            <div class="featured-grid">
                <div class="featured-card">
                    <div class="quote-icon">"</div>
                    <p>"Kenyamanan kost paling terbaik di Indonesia, Suka banget!"</p>
                    <div class="author">
                        <div class="author-avatar">A</div>
                        <div>
                            <strong>Mr. Aqilla Umara</strong>
                        </div>
                    </div>
                </div>
                <div class="featured-images">
                    <div class="featured-image">
                        <img src="kost-image1.png" alt="Kost 1">
                    </div>
                    <div class="featured-image">
                        <img src="kost-image2.png" alt="Kost 2">
                    </div>
                    <div class="featured-image">
                        <img src="kost-image3.png" alt="Kost 3">
                    </div>
                    <div class="featured-image">
                        <img src="kost-image4.png" alt="Kost 4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="service-image" style="position: relative;">
                <img src="lobby-image.jpg" alt="Lobby Kost">
                <div class="customer-badge">
                    <h4>99+</h4>
                    <p>Customer Suka</p>
                </div>
            </div>
            
            <div class="service-content">
                <p class="section-tag">LAYANAN TERBAIK</p>
                <h2>Kami Berikan Tempat dan<br>Layanan Terbaik</h2>
                <p>Memberikan layanan terbaik dengan tempat yang nyaman untuk anda menempati yang tentunya dengan dengan dengan anda</p>
                <p><i class="fas fa-check-circle" style="color: #3d5a4a;"></i> No. 1* Layanan Kost Terbaik Di Indonesia</p>
                <p><i class="fas fa-check-circle" style="color: #3d5a4a;"></i> 7 Tahun Lebih kita Berada Untuk Anda</p>
            </div>

            <div class="service-cards">
                <div class="service-card">
                    <div class="icon"><i class="fas fa-home"></i></div>
                    <h3>Kost Terbaik</h3>
                    <p>Memberikan kost kost terbaik di seluruh Indonesia</p>
                    <a href="#">LIHAT SELENGKAPNYA →</a>
                </div>
                <div class="service-card">
                    <div class="icon"><i class="fas fa-building"></i></div>
                    <h3>Ruangan Modern</h3>
                    <p>Memberikan kamar yang modern dan dengan dengan yang mudah</p>
                    <a href="#">LIHAT SELENGKAPNYA →</a>
                </div>
                <div class="service-card">
                    <div class="icon"><i class="fas fa-wifi"></i></div>
                    <h3>Fasilitas Lengkap</h3>
                    <p>Menyediakan semua fasilitas yang dapat membantu anda</p>
                    <a href="#">LIHAT SELENGKAPNYA →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <div>
                    <p class="section-tag">APA YANG MEREKA KATAKAN</p>
                    <h2 class="section-title">Testimoni Pengunjung Kami</h2>
                </div>
                <a href="#" class="see-all">SEE ALL REVIEWS →</a>
            </div>
            
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"Suka banget sama layanan disini, tempatnya bagus find super akses"</p>
                    <div class="testimonial-author">
                        <img src="https://via.placeholder.com/50" alt="Author">
                        <div class="testimonial-author-info">
                            <h4>Mr. Aqilla Umara</h4>
                            <p>CEO of GOOGLE</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"Senang sekali dapat menemukan kost disini, pokonya the best banget pokok nya"</p>
                    <div class="testimonial-author">
                        <img src="https://via.placeholder.com/50" alt="Author">
                        <div class="testimonial-author-info">
                            <h4>Mr. Mardiyanto Yuste</h4>
                            <p>CEO of Apple</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-about">
                <h3><img src="logo-khouse.png" alt="Logo" style="width: 40px; vertical-align: middle; margin-right: 10px;">K.HOUSE</h3>
                <p>Aplikasi inovatif dalam pengelolaanm dan dalam penggelolaan dari Kost di Indonesia.</p>
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
                    <li><a href="#">Check in Check out</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h4>Site Links</h4>
                <ul>
                    <li><a href="#">Disclaimer</a></li>
                    <li><a href="#">Perlindungan Kami</a></li>
                    <li><a href="#">Syarat Pemesanan</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h4>Tetap bersama kami</h4>
                <p><i class="fas fa-map-marker-alt"></i> Malang, Indonesia</p>
                <p><i class="fas fa-envelope"></i> khouseinofficial.com</p>
                <p><i class="fas fa-phone"></i> (+62) 812 3456 7890</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>COPYRIGHT © K.HOUSE</p>
        </div>
    </footer>
</body>
</html>