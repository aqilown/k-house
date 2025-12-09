<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kost - K.House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/cari-kost.css') }}">
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

    <!-- Hero Search Section -->
    <section class="hero-search">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOMEPAGE</a>
                <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                <span>CARI KOST</span>
            </div>
            <h1>Cari Kost</h1>
            <p>Segera cari tempat yang ingin anda inap, atur jadwal checkin dan checkout</p>

            <!-- Search Box - AKTIF -->
            <form action="{{ route('cari-kost') }}" method="GET" class="search-box">
                <div class="search-field">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="search-field-content">
                        <div class="search-field-label">Pilih kota yang dituju</div>
                        <input type="text" name="lokasi" placeholder="Cari lokasi kost..." value="{{ request('lokasi') }}">
                    </div>
                </div>

                <div class="search-field">
                    <i class="fas fa-home"></i>
                    <div class="search-field-content">
                        <div class="search-field-label">Jenis Kost</div>
                        <select name="kategori" style="border: none; outline: none; font-size: 14px; width: 100%; color: #333; font-weight: 500; background: transparent; cursor: pointer;">
                            <option value="">Semua</option>
                            <option value="putra" {{ request('kategori') == 'putra' ? 'selected' : '' }}>Putra</option>
                            <option value="putri" {{ request('kategori') == 'putri' ? 'selected' : '' }}>Putri</option>
                            <option value="campur" {{ request('kategori') == 'campur' ? 'selected' : '' }}>Campur</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-search">Cari</button>
            </form>
        </div>
    </section>

    <!-- Results Section -->
    <section class="results-section">
        <div class="container">
            <div class="results-header">
                <div class="results-count">
                    Menampilkan <strong>{{ $kosts->total() }}</strong> kost tersedia
                    @if(request('kategori'))
                        <span style="color: #666;"> ({{ ucfirst(request('kategori')) }})</span>
                    @endif
                    @if(request('lokasi'))
                        <span style="color: #666;"> di "{{ request('lokasi') }}"</span>
                    @endif
                </div>
                @if(request('kategori') || request('lokasi'))
                <a href="{{ route('cari-kost') }}" style="color: #3d5a4a; text-decoration: none; font-size: 14px;">
                    <i class="fas fa-times"></i> Reset Filter
                </a>
                @endif
            </div>

            <!-- Kost Grid - DINAMIS -->
            <div class="kost-grid">
                @forelse($kosts as $kost)
                <div class="kost-card" data-kategori="{{ $kost->kategori }}">
                    <div class="kost-image">
                        @if($kost->foto_utama)
                            <img src="{{ asset($kost->foto_utama) }}" alt="{{ $kost->nama_kost }}">
                        @else
                            <img src="{{ asset('kost-image1.png') }}" alt="{{ $kost->nama_kost }}">
                        @endif
                        <span class="badge-overlay badge-{{ $kost->kategori }}">{{ ucfirst($kost->kategori) }}</span>
                    </div>
                    <div class="kost-content">
                        <div class="kost-header">
                            <div class="kost-rating">
                                @if($kost->rating > 0)
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <span style="color: #333; font-weight: 600;">{{ number_format($kost->rating, 1) }}/5</span>
                                </div>
                                <span class="rating-text">({{ $kost->jumlah_review }} reviews)</span>
                                @else
                                <div class="stars">
                                    <i class="fas fa-star" style="color: #ddd;"></i>
                                    <span style="color: #999; font-weight: 600;">Belum ada review</span>
                                </div>
                                @endif
                            </div>
                            <h3 class="kost-title">{{ $kost->nama_kost }}</h3>
                            <div class="kost-location">
                                <i class="fas fa-map-marker-alt" style="color: #3d5a4a; margin-right: 5px;"></i>
                                <span>{{ $kost->kecamatan }}, {{ $kost->kota }}</span>
                            </div>
                            
                            @if($kost->fasilitas->count() > 0)
                            <div class="kost-badges">
                                @foreach($kost->fasilitas->take(4) as $fasilitas)
                                <span class="badge">{{ $fasilitas->nama_fasilitas }}</span>
                                @endforeach
                                @if($kost->fasilitas->count() > 4)
                                <span class="badge" style="background: #e9ecef; color: #666;">+{{ $kost->fasilitas->count() - 4 }} lainnya</span>
                                @endif
                            </div>
                            @endif
                        </div>

                        @if($kost->kamar->count() > 0)
                        <div class="kost-rooms">
                            @foreach($kost->kamar->take(3) as $kamar)
                            <div class="room-item">
                                <span class="room-type">{{ $kamar->tipe_kamar }}</span>
                                <span class="room-price">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                            @if($kost->kamar->count() > 3)
                            <div class="room-item" style="border: none; padding-top: 5px;">
                                <span style="color: #666; font-size: 13px;">+{{ $kost->kamar->count() - 3 }} tipe kamar lainnya</span>
                            </div>
                            @endif
                        </div>
                        @else
                        <div style="padding: 15px; text-align: center; color: #999; font-size: 14px;">
                            Kamar belum tersedia
                        </div>
                        @endif

                        <div class="kost-footer">
                            <a href="{{ route('detail-kost', $kost->id) }}" class="btn-detail">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Empty State -->
                <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px;">
                    <i class="fas fa-search" style="font-size: 64px; color: #ddd; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 24px; color: #666; margin-bottom: 10px;">Kost Tidak Ditemukan</h3>
                    <p style="color: #999; margin-bottom: 20px;">
                        @if(request('lokasi') || request('kategori'))
                            Coba ubah kata kunci atau filter pencarian Anda
                        @else
                            Belum ada kost yang tersedia saat ini
                        @endif
                    </p>
                    @if(request('lokasi') || request('kategori'))
                    <a href="{{ route('cari-kost') }}" style="display: inline-block; background: #3d5a4a; color: white; padding: 10px 30px; border-radius: 8px; text-decoration: none;">
                        Lihat Semua Kost
                    </a>
                    @endif
                </div>
                @endforelse
            </div>

            <!-- Pagination - AKTIF -->
            @if($kosts->hasPages())
            <div class="pagination">
                {{-- Previous Page Link --}}
                @if ($kosts->onFirstPage())
                    <span class="disabled">«</span>
                @else
                    <a href="{{ $kosts->previousPageUrl() }}" rel="prev">«</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($kosts->getUrlRange(1, $kosts->lastPage()) as $page => $url)
                    @if ($page == $kosts->currentPage())
                        <a href="#" class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($kosts->hasMorePages())
                    <a href="{{ $kosts->nextPageUrl() }}" rel="next">»</a>
                @else
                    <span class="disabled">»</span>
                @endif
            </div>
            @endif
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