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
            <h1>Cari Kost</h1>
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
                    Menampilkan <strong id="kost-count">3</strong> kost tersedia
                </div>
            </div>

            <!-- Kost Grid -->
            <div class="kost-grid">
                <!-- Kost Card 1 -->
                <div class="kost-card" data-kategori="putra">
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
                                <span class="badge badge-kategori">Putra</span>
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
                            <a href="{{ route('detail-kost', 1) }}" class="btn-detail">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Kost Card 2 -->
                <div class="kost-card" data-kategori="putri">
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
                                <span class="badge badge-kategori">Putri</span>
                            </div>
                        </div>
                        <div class="kost-rooms">
                            <div class="room-item">
                                <span class="room-type">Room 1</span>
                                <span class="room-price">Mulai Rp 800K</span>
                            </div>
                        </div>
                        <div class="kost-footer">
                            <a href="{{ route('detail-kost', 2) }}" class="btn-detail">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Kost Card 3 -->
                <div class="kost-card" data-kategori="campur">
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
                                <span class="badge badge-kategori">Campur</span>
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
                            <a href="{{ route('detail-kost', 3) }}" class="btn-detail">Lihat Selengkapnya</a>
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
    <script>
        // Fungsi untuk tombol Cari
        document.querySelector('.btn-search').addEventListener('click', function() {
            const selectElement = document.querySelector('.search-field select');
            const selectedKategori = selectElement.value;
            
            filterKost(selectedKategori === '' ? 'semua' : selectedKategori);
        });

        // Fungsi filter kost
        function filterKost(kategori) {
            const kostCards = document.querySelectorAll('.kost-card');
            let visibleCount = 0;

            kostCards.forEach(card => {
                const cardKategori = card.getAttribute('data-kategori');
                
                if (kategori === 'semua' || cardKategori === kategori) {
                    card.style.display = 'grid';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('kost-count').textContent = visibleCount;
        }
    </script>
</body>
</html>