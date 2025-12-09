<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K.House - Temukan Kost Impian Anda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <img src="{{ asset('logo-khouse.png') }}" alt="K.House Logo" class="logo">
                <span class="logo-text">K.HOUSE</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}">HOME</a>
                <a href="{{ route('about') }}">ABOUT US</a>
                <a href="{{ route('cari-kost') }}">CARI KOST</a>
                
                @auth
                    <!-- Jika sudah login -->
                    <div class="user-dropdown" style="position: relative;">
                        <a href="#" class="btn-get-started" style="display: flex; align-items: center; gap: 8px;">
                            <img src="{{ asset(auth()->user()->foto_profil ?? 'default-avatar.png') }}" 
                                style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                            {{ auth()->user()->nama }}
                            <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
                        </a>
                        <div class="dropdown-menu" style="display: none; position: absolute; top: 100%; right: 0; background: white; box-shadow: 0 5px 20px rgba(0,0,0,0.15); border-radius: 8px; min-width: 200px; margin-top: 10px;">
                            <a href="{{ route('profile') }}" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; border-bottom: 1px solid #f0f0f0;">
                                <i class="fas fa-user"></i> Profil Saya
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: left; padding: 12px 20px; border: none; background: none; color: #dc3545; cursor: pointer; font-size: 14px;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="btn-get-started">GET STARTED</a>
                @endauth
            </div>

            <script>
            // Dropdown toggle
            document.addEventListener('DOMContentLoaded', function() {
                const dropdown = document.querySelector('.user-dropdown');
                if(dropdown) {
                    dropdown.addEventListener('click', function(e) {
                        e.preventDefault();
                        const menu = this.querySelector('.dropdown-menu');
                        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
                    });

                    // Close dropdown when click outside
                    document.addEventListener('click', function(e) {
                        if (!dropdown.contains(e.target)) {
                            dropdown.querySelector('.dropdown-menu').style.display = 'none';
                        }
                    });
                }
            });
            </script>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Ayo, <span class="highlight">Cari</span> Kost<br>Impian <span class="highlight">Anda</span> Disini..</h1>
            <p>Kost impian Anda hanya sekali klik jauhnya. Temukan kenyamanan dalam Semua Kost di Indonesia.</p>
            <div class="hero-buttons">
                @auth
                    <a href="{{ route('cari-kost') }}" class="btn-primary">LIHAT SELENGKAPNYA</a>
                    <a href="{{ route('cari-kost') }}" class="btn-secondary">COBA SEKARANG</a>
                @else
                    <a href="{{ route('cari-kost') }}" class="btn-primary">LIHAT SELENGKAPNYA</a>
                    <a href="{{ route('login') }}" class="btn-secondary">COBA SEKARANG</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stat-item">
                <h3>{{ \App\Models\Kost::count() }}+</h3>
                <p>Kost Terbaik</p>
            </div>
            <div class="stat-item">
                <h3>10</h3>
                <p>Partner Kami</p>
            </div>
            <div class="stat-item">
                <h3>{{ \App\Models\User::where('role', 'user')->count() }}+</h3>
                <p>Customer</p>
            </div>
            <div class="stat-item">
                <h3>02th+</h3>
                <p>Pengalaman Terbaik</p>
            </div>
        </div>
    </section>

    <!-- Featured Section - DINAMIS -->
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
                    @forelse($kosts->take(4) as $kost)
                    <div class="featured-image">
                        <a href="{{ route('detail-kost', $kost->id) }}">
                            @if($kost->foto_utama)
                                <img src="{{ asset($kost->foto_utama) }}" alt="{{ $kost->nama_kost }}">
                            @else
                                <img src="{{ asset('kost-image1.png') }}" alt="{{ $kost->nama_kost }}">
                            @endif
                            <div class="image-overlay">
                                <h4>{{ $kost->nama_kost }}</h4>
                                <p><i class="fas fa-map-marker-alt"></i> {{ $kost->kecamatan }}, {{ $kost->kota }}</p>
                            </div>
                        </a>
                    </div>
                    @empty
                    <!-- Fallback jika belum ada data -->
                    <div class="featured-image">
                        <img src="{{ asset('kost-image1.png') }}" alt="Kost 1">
                    </div>
                    <div class="featured-image">
                        <img src="{{ asset('kost-image2.png') }}" alt="Kost 2">
                    </div>
                    <div class="featured-image">
                        <img src="{{ asset('kost-image3.png') }}" alt="Kost 3">
                    </div>
                    <div class="featured-image">
                        <img src="{{ asset('kost-image4.png') }}" alt="Kost 4">
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Kost List Section - BARU (Tampil semua kost) -->
    <section class="kost-list" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <p class="section-tag">PILIHAN TERBAIK</p>
                <h2 class="section-title">Kost Terbaru Untuk Anda</h2>
            </div>

            <div class="kost-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                @forelse($kosts as $kost)
                <div class="kost-item" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: all 0.3s;">
                    <div class="kost-image" style="height: 220px; overflow: hidden; position: relative;">
                        @if($kost->foto_utama)
                            <img src="{{ asset($kost->foto_utama) }}" alt="{{ $kost->nama_kost }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <img src="{{ asset('kost-image1.png') }}" alt="{{ $kost->nama_kost }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                        <span class="badge-kategori" style="position: absolute; top: 15px; right: 15px; background: #3d5a4a; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                            {{ ucfirst($kost->kategori) }}
                        </span>
                    </div>
                    <div class="kost-content" style="padding: 20px;">
                        <h3 style="font-size: 20px; margin-bottom: 10px; color: #2d4538;">{{ $kost->nama_kost }}</h3>
                        <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
                            <i class="fas fa-map-marker-alt" style="color: #3d5a4a;"></i> 
                            {{ $kost->kecamatan }}, {{ $kost->kota }}
                        </p>
                        
                        @if($kost->rating > 0)
                        <div style="display: flex; align-items: center; gap: 5px; margin-bottom: 15px;">
                            <i class="fas fa-star" style="color: #ffc107;"></i>
                            <strong style="color: #333;">{{ number_format($kost->rating, 1) }}</strong>
                            <span style="color: #999; font-size: 13px;">({{ $kost->jumlah_review }} reviews)</span>
                        </div>
                        @endif

                        @if($kost->fasilitas->count() > 0)
                        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 15px;">
                            @foreach($kost->fasilitas->take(3) as $fasilitas)
                            <span style="background: #f0f4f2; color: #3d5a4a; padding: 5px 12px; border-radius: 15px; font-size: 12px;">
                                {{ $fasilitas->nama_fasilitas }}
                            </span>
                            @endforeach
                        </div>
                        @endif

                        @if($kost->kamar->count() > 0)
                        <div style="margin-bottom: 15px;">
                            <strong style="color: #3d5a4a; font-size: 18px;">Mulai Rp {{ number_format($kost->kamar->min('harga_bulanan'), 0, ',', '.') }}</strong>
                            <span style="color: #999; font-size: 13px;">/bulan</span>
                        </div>
                        @endif

                        <a href="{{ route('detail-kost', $kost->id) }}" style="display: block; text-align: center; background: #2d4538; color: white; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #999;">
                    <i class="fas fa-home" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
                    <h3 style="font-size: 24px; margin-bottom: 10px;">Belum Ada Kost</h3>
                    <p>Data kost akan muncul setelah admin menambahkan dari dashboard.</p>
                </div>
                @endforelse
            </div>

            @if($kosts->count() > 0)
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('cari-kost') }}" style="display: inline-block; background: #3d5a4a; color: white; padding: 12px 40px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                    Lihat Semua Kost <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endif
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
                <a href="{{ route('cari-kost') }}">LIHAT SELENGKAPNYA →</a>
            </div>
            <div class="service-card">
                <div class="icon"><i class="fas fa-building"></i></div>
                <h3>Ruangan Modern</h3>
                <p>Memberikan kamar yang modern dan dengan dengan yang mudah</p>
                <a href="{{ route('cari-kost') }}">LIHAT SELENGKAPNYA →</a>
            </div>
            <div class="service-card">
                <div class="icon"><i class="fas fa-wifi"></i></div>
                <h3>Fasilitas Lengkap</h3>
                <p>Menyediakan semua fasilitas yang dapat membantu anda</p>
                <a href="{{ route('cari-kost') }}">LIHAT SELENGKAPNYA →</a>
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