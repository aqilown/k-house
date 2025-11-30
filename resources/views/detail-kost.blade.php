<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kost - K.House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/detail-kost.css') }}">
</head>
<body>
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

    <!-- Main Content -->
    <div class="detail-container">
        <div class="container">
            <!-- Header Section -->
            <div class="kost-header">
                <div class="header-left">
                    <h1>Kost 1</h1>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <span class="rating-score">4.3/5</span>
                        <span class="rating-reviews">Superb (20+ reviews)</span>
                    </div>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> Jakarta Pusat</p>
                </div>
            </div>

            <!-- Description -->
            <div class="kost-description">
                <p>Selamat datang di "Kost 1" Kost mewah di tengah jantung kota yang menawarkan pengalaman tinggal yang serba modern dan penuh kenyamanan.</p>
                
                <p>Dengan desain interior yang elegan, setiap kamar apartemen kami dirancang untuk memadukan keindahan estetika dengan fungsionalitas yang optimal.</p>
                
                <p>Dari dapur berdesain mutakhir hingga kamar tidur yang dilengkapi dengan teknologi terbaru, "Puncak Harmoni Residence" memanjakan penghuninya dengan gaya hidup modern yang tanpa kompromi.</p>
            </div>

            <!-- Facilities Grid -->
            <div class="facilities-section">
                <h3>Fasilitas Terbaik</h3>
                <div class="facilities-grid">
                    <div class="facility-item">
                        <i class="fas fa-door-open"></i>
                        <span>Kemewahan ruangan</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-snowflake"></i>
                        <span>Ruangan Ber AC</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-wifi"></i>
                        <span>WiFi Cepat</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-concierge-bell"></i>
                        <span>Layanan Tiap Saat</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-briefcase"></i>
                        <span>Kebersihan Profesional</span>
                    </div>
                </div>
            </div>

            <!-- Booking Section -->
            <div class="booking-section">
                <h2>Atur Jadwal mu disini..</h2>
                
                <!-- Booking Form -->
                <div class="booking-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-calendar"></i> Tanggal Mulai</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar-check"></i> Durasi (Bulan)</label>
                            <div class="counter">
                                <button class="btn-minus" onclick="decreaseDuration()">−</button>
                                <input type="text" id="duration" value="1" readonly>
                                <button class="btn-plus" onclick="increaseDuration()">+</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Orang</label>
                            <div class="counter">
                                <button class="btn-minus" onclick="decreasePerson()">−</button>
                                <input type="text" id="person" value="1" readonly>
                                <button class="btn-plus" onclick="increasePerson()">+</button>
                            </div>
                        </div>
                        <button class="btn-harga" onclick="calculatePrice()">Harga</button>
                    </div>
                    <p class="note">Hanya diperlukan: Tata letak, furniture, dan teknologi ruangan Anda mungkin berbeda dari yang ditampilkan di sini.</p>
                </div>

                <!-- Room Options -->
                <div class="rooms-section">
                    <div class="room-card">
                        <img src="{{ asset('kost-image3.png') }}" alt="Single Room">
                        <div class="room-info">
                            <h3>Single Room</h3>
                            <div class="room-specs">
                                <span><i class="fas fa-bed"></i> 1 Tempat tidur</span>
                                <span><i class="fas fa-users"></i> 1 Penghitung</span>
                                <span><i class="fas fa-shower"></i> 1 Kamar mandi</span>
                            </div>
                            <div class="room-facilities">
                                <p><strong>Tersedia Fasilitas :</strong></p>
                                <ul>
                                    <li>• Twin bed</li>
                                    <li>• Cable TV</li>
                                    <li>• Air Conditioning</li>
                                </ul>
                            </div>
                        </div>
                        <div class="room-price">
                            <h3>Rp. 1.000.000</h3>
                            <p>Harga malam</p>
                            <button class="btn-book">Tentukan tanggal</button>
                        </div>
                    </div>

                    <div class="room-card">
                        <img src="{{ asset('kost-image4.png') }}" alt="Double Room">
                        <div class="room-info">
                            <h3>Double Room</h3>
                            <div class="room-specs">
                                <span><i class="fas fa-bed"></i> 2 Bedroom</span>
                                <span><i class="fas fa-users"></i> 2-3 Guest</span>
                                <span><i class="fas fa-shower"></i> 1 Bathroom</span>
                            </div>
                            <div class="room-facilities">
                                <p><strong>Tersedia Fasilitas :</strong></p>
                                <ul>
                                    <li>• Twin bed</li>
                                    <li>• Cable TV</li>
                                    <li>• Air Conditioning</li>
                                </ul>
                            </div>
                        </div>
                        <div class="room-price">
                            <h3>Rp. 500.000</h3>
                            <p>Harga malam</p>
                            <button class="btn-book">Tentukan tanggal</button>
                        </div>
                    </div>

                    <button class="btn-show-more">Lihat Lainnya</button>
                </div>
            </div>

            <!-- Facilities Detail Section -->
            <div class="facilities-detail">
                <h2>Fasilitas pada Hotel Indonesia</h2>

                <!-- Building Photos -->
                <div class="building-photos">
                    <img src="{{ asset('kost-image1.png') }}" alt="Building 1">
                    <img src="{{ asset('kost-image2.png') }}" alt="Building 2">
                </div>

                <!-- Area Facilities -->
                <div class="area-facilities">
                    <h3>Fasilitas Pada Area Bangunan</h3>
                    <div class="area-grid">
                        <div class="area-item">
                            <i class="fas fa-snowflake"></i>
                            <p>Ruangan Ber AC</p>
                        </div>
                        <div class="area-item">
                            <i class="fas fa-baby"></i>
                            <p>Penitipan Anak</p>
                        </div>
                        <div class="area-item">
                            <i class="fas fa-door-closed"></i>
                            <p>Elevator</p>
                        </div>
                        <div class="area-item">
                            <i class="fas fa-concierge-bell"></i>
                            <p>Tersedia Layanan</p>
                        </div>
                        <div class="area-item">
                            <i class="fas fa-box"></i>
                            <p>Penitipan Barang</p>
                        </div>
                        <div class="area-item">
                            <i class="fas fa-utensils"></i>
                            <p>Pemanas ruangan dan ruang kerja</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <h2>Peta map</h2>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.82493!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1234567890" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="location-info">
                    <h3>Hotel Indonesia</h3>
                    <p>Selamat datang di "Hotel Indonesia" Hotel mewah di tengah jantung kota yang menawarkan pengalaman tinggal yang serba modern dan penuh kenyamanan.</p>
                    
                    <div class="location-details">
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Alamat</h4>
                                <p>Jakarta Pusat, no.201</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-bus"></i>
                            <div>
                                <h4>Publik Transit</h4>
                                <p>Area strategis dekat dengan transportasi masyarakat</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-map"></i>
                            <div>
                                <h4>Peta</h4>
                                <p>Memudahkan anda menemukan alamat lewat G-Maps</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-parking"></i>
                            <div>
                                <h4>Tempat parkir</h4>
                                <p>Tersedia area parkir yang luas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-about">
                <img src="{{ asset('logo-khouse.png') }}" alt="Logo" class="footer-logo">
                <h3>K.HOUSE</h3>
                <p>Aplikasi terbaik layanan penginapan di seluruh Kost di Indonesia</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
            
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Layanan</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h4>Tetap bersama kami</h4>
                <p><i class="fas fa-map-marker-alt"></i> Malang, Indonesia</p>
                <p><i class="fas fa-envelope"></i> Khouse@Email.com</p>
                <p><i class="fas fa-phone"></i> (+62) 857 816 809 00</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>COPYRIGHT K.HOUSE®</p>
        </div>
    </footer>
    <script>
    function decreaseDuration() {
        let duration = document.getElementById('duration');
        let value = parseInt(duration.value);
        if (value > 1) {
            duration.value = value - 1;
        }
    }

    function increaseDuration() {
        let duration = document.getElementById('duration');
        let value = parseInt(duration.value);
        duration.value = value + 1;
    }

    function decreasePerson() {
        let person = document.getElementById('person');
        let value = parseInt(person.value);
        if (value > 1) {
            person.value = value - 1;
        }
    }

    function increasePerson() {
        let person = document.getElementById('person');
        let value = parseInt(person.value);
        person.value = value + 1;
    }

    function calculatePrice() {
        let duration = document.getElementById('duration').value;
        let basePrice = 500000; // Sesuaikan dengan harga kamar
        let totalPrice = basePrice * duration;
        alert('Total Harga: Rp ' + totalPrice.toLocaleString('id-ID') + '\nDurasi: ' + duration + ' bulan');
    }
    </script>
</body>
</html>