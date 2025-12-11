<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - K.House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="contact-info">
                <span><i class="fas fa-envelope"></i> k.house@gmail.com</span>
                <span><i class="fas fa-phone"></i> (+62) 812 3456 7890</span>
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
                
                @auth
                    <!-- Foto profil saja, tanpa nama -->
                    <a href="{{ route('profile') }}" class="profile-link" style="display: flex; align-items: center; padding: 5px; background: #f0f4f2; border-radius: 50%; transition: all 0.3s;" title="{{ auth()->user()->nama }}">
                        <img src="{{ asset(auth()->user()->foto_profil ?? 'default-avatar.png') }}" 
                            alt="Profile" 
                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #3d5a4a;">
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-get-started">GET STARTED</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-about">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOMEPAGE</a>
                <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                <span>ABOUT US</span>
            </div>
            <h1>Tentang <span>Kami</span></h1>
            <p>Sewa Kost Impian Anda, Ruang Nyaman, Hidup Bahagia. Temukan Tempat Terbaik di Indonesia Bersama Kami!</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <div class="mission-header">
                <span class="section-tag">TUJUAN KAMI</span>
                <h2>Berikan Layanan & Tempat Terbaik<br>Sesuai Impian Pengunjung</h2>
                <p>Layanan dan Tempat Kost Terbaik, Sesuai Impian Anda. Rasakan kenyamanan istimewa di hunian kami.</p>
            </div>

            <div class="mission-grid">
                <div class="mission-card">
                    <h3 style="font-size: 22px; margin-bottom: 30px;">Misi Kami</h3>
                    
                    <div class="mission-item">
                        <div class="mission-number">01</div>
                        <div class="mission-content">
                            <h3>Menghadirkan Kemewahan Berkualitas Tinggi</h3>
                            <p>Menyediakan layanan dan tempat kost terbaik</p>
                        </div>
                    </div>

                    <div class="mission-item">
                        <div class="mission-number">02</div>
                        <div class="mission-content">
                            <h3>Memenuhi Harapan Setiap Pengunjung</h3>
                            <p>memenuhi kebutuhan serta harapan setiap pengunjung</p>
                        </div>
                    </div>

                    <div class="mission-item">
                        <div class="mission-number">03</div>
                        <div class="mission-content">
                            <h3>Menciptakan Pengalaman Tak Terlupakan</h3>
                            <p>memberikan pengalaman tinggal tak terlupakan</p>
                        </div>
                    </div>
                </div>
                <div class="mission-card">
                    <h3 style="font-size: 22px; margin-bottom: 30px;">Visi Kami</h3>
                <div class="quote-card">
                    <p>K.house berkomitmen untuk menyediakan hunian kost yang nyaman, aman, dan transparan dengan menghadirkan informasi kamar yang lengkap, proses booking yang cepat, serta dukungan layanan yang responsif sehingga penghuni dapat merasakan pengalaman tinggal yang modern, praktis, dan sesuai kebutuhan hidup urban.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="steps-section">
        <div class="container">
            <div class="steps-header">
                <span class="section-tag">BAGAIMANA CARA KERJA LAYANAN KAMI</span>
                <h2>Kami Memberikan Langkah<br>Kerja Yang Mudah</h2>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">01</div>
                    <h3>Check In</h3>
                    <p>Set tanggal check-in dan check-out sesuai keinginan</p>
                </div>

                <div class="step-card">
                    <div class="step-number">02</div>
                    <h3>Pilih Tempat</h3>
                    <p>Pilih tempat kost terbaik sesuai keinginan anda</p>
                </div>

                <div class="step-card">
                    <div class="step-number">03</div>
                    <h3>Bayar Tempat</h3>
                    <p>Lakukan pembayaran sesudah anda set tanggal check-in & check-out</p>
                </div>

                <div class="step-card">
                    <div class="step-number">04</div>
                    <h3>Download Bukti</h3>
                    <p>Kami akan segera kirimkan tiket/sewa kost anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-about">
                <h3><img src="{{ asset('logo-khouse.png') }}" alt="Logo" style="width: 40px; vertical-align: middle; margin-right: 10px;">K.HOUSE</h3>
                <p>Aplikasi inovatif penggelolaan Kost di Indonesia.</p>
            </div>
            
             <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('cari-kost') }}">Cari Kost</a></li>
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