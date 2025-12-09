<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - K.House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
                <a href="{{ route('profile') }}" class="active">PROFIL</a>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="profile-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">HOMEPAGE</a>
                <i class="fas fa-chevron-right"></i>
                <span>PROFIL</span>
            </div>

            <div class="profile-container">
                <!-- Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{ asset('default-avatar.png') }}" alt="Avatar" id="avatarImg">
                            <label for="uploadAvatar" class="avatar-edit">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="uploadAvatar" accept="image/*" style="display: none;">
                        </div>
                        <h3>John Doe</h3>
                        <p>johndoe@email.com</p>
                    </div>

                    <div class="profile-menu">
                        <a href="#" class="menu-item active" data-tab="info">
                            <i class="fas fa-user"></i> Informasi Profil
                        </a>
                        <a href="#" class="menu-item" data-tab="booking">
                            <i class="fas fa-calendar-check"></i> Riwayat Booking
                        </a>
                        <a href="#" class="menu-item" data-tab="password">
                            <i class="fas fa-lock"></i> Ubah Password
                        </a>
                        <a href="#" class="menu-item logout">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="profile-content">
                    <!-- Informasi Profil -->
                    <div class="tab-content active" id="info">
                        <h2>Informasi Profil</h2>
                        <form class="profile-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" value="John Doe" placeholder="Masukkan nama lengkap">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="johndoe@email.com" placeholder="Masukkan email">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="tel" value="081234567890" placeholder="Masukkan nomor telepon">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" value="1995-01-15">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea rows="3" placeholder="Masukkan alamat lengkap">Jl. Contoh No. 123, Malang, Jawa Timur</textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select>
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" value="Mahasiswa" placeholder="Masukkan pekerjaan">
                                </div>
                            </div>

                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    <!-- Riwayat Booking -->
                    <div class="tab-content" id="booking">
                        <h2>Riwayat Booking</h2>
                        <div class="booking-list">
                            <div class="booking-card">
                                <div class="booking-image">
                                    <img src="{{ asset('kost-image1.png') }}" alt="Kost">
                                </div>
                                <div class="booking-info">
                                    <h3>Kost 1 - Kamar Mandi Dalam</h3>
                                    <p><i class="fas fa-map-marker-alt"></i> Lowokwaru, Malang</p>
                                    <p><i class="fas fa-calendar"></i> 15 Des 2024 - 15 Jan 2025</p>
                                    <span class="status-badge active">Aktif</span>
                                </div>
                                <div class="booking-price">
                                    <p>Rp 1.000.000</p>
                                    <a href="#" class="btn-detail-small">Detail</a>
                                </div>
                            </div>

                            <div class="booking-card">
                                <div class="booking-image">
                                    <img src="{{ asset('kost-image2.png') }}" alt="Kost">
                                </div>
                                <div class="booking-info">
                                    <h3>Kost 2 - Room 1</h3>
                                    <p><i class="fas fa-map-marker-alt"></i> Singosari, Malang</p>
                                    <p><i class="fas fa-calendar"></i> 01 Nov 2024 - 01 Des 2024</p>
                                    <span class="status-badge completed">Selesai</span>
                                </div>
                                <div class="booking-price">
                                    <p>Rp 800.000</p>
                                    <a href="#" class="btn-detail-small">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ubah Password -->
                    <div class="tab-content" id="password">
                        <h2>Ubah Password</h2>
                        <form class="profile-form">
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" placeholder="Masukkan password lama">
                            </div>

                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" placeholder="Masukkan password baru">
                            </div>

                            <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" placeholder="Konfirmasi password baru">
                            </div>

                            <button type="submit" class="btn-save">
                                <i class="fas fa-key"></i> Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('cari-kost') }}">Cari Kost</a></li>
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
        // Tab switching
        const menuItems = document.querySelectorAll('.menu-item:not(.logout)');
        const tabContents = document.querySelectorAll('.tab-content');

        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class
                menuItems.forEach(i => i.classList.remove('active'));
                tabContents.forEach(t => t.classList.remove('active'));
                
                // Add active class
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Upload avatar
        document.getElementById('uploadAvatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarImg').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Logout confirmation
        document.querySelector('.logout').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = '{{ route("login") }}';
            }
        });
    </script>
</body>
</html>