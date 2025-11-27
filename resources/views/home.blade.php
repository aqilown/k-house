<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K.House - Temukan Kost Impian Anda</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                <a href="{{ route('about') }}">ABOUT US</a>
                <a href="{{ route('cari-kost') }}" >CARI KOST</a>
                <a href="{{ route('login') }}" class="btn-get-started">GET STARTED</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Ayo, <span class="highlight">Cari</span> Kost<br>Impian <span class="highlight">Anda</span> Disini..</h1>
            <p>Kost impian Anda hanya sekali klik jauhnya. Temukan kenyamanan dalam Semua Kost di Indonesia.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn-primary">LIHAT SELENGKAPNYA</a>
                <a href="{{ route('login') }}" class="btn-secondary">COBA SEKARANG</a>
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
                <h3>10</h3>
                <p>Partner Kami</p>
            </div>
            <div class="stat-item">
                <h3>12K+</h3>
                <p>Customer anda</p>
            </div>
            <div class="stat-item">
                <h3>02th+</h3>
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
            
            <div class="service-content">
                <p class="section-tag">LAYANAN YANG KAMI BERIKAN</p>
                <h2>Layanan Yang Mendukung</h2>
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
                    <p>"Suka banget sama layanan disini, tempatnya bagus dan mudah di akses"</p>
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
                    <li><a href="#">Check in Check out</a></li>
                    <li><a href="#">Blog</a></li>
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