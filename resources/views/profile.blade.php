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
                <a href="{{ route('profile') }}" class="profile-link active" style="display: flex; align-items: center; gap: 10px; padding: 8px 15px; background: #3d5a4a; border-radius: 25px;">
                    <img src="{{ asset(auth()->user()->foto_profil ?? 'default-avatar.png') }}" 
                         alt="Profile" 
                         style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
                    <span style="font-weight: 600; color: white;">{{ auth()->user()->nama }}</span>
                </a>
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
                            <img src="{{ asset(auth()->user()->foto_profil ?? 'default-avatar.png') }}" alt="Avatar" id="avatarImg">
                            <label for="uploadAvatar" class="avatar-edit">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="uploadAvatar" accept="image/*" style="display: none;">
                        </div>
                        <h3>{{ auth()->user()->nama }}</h3>
                        <p>{{ auth()->user()->email }}</p>
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
                    </div>
                </div>

                <!-- Content -->
                <div class="profile-content">
                    @if(session('success'))
                    <div class="alert alert-success" style="padding: 15px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-error" style="padding: 15px; background: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                    @endif

                    <!-- Informasi Profil -->
                    <div class="tab-content active" id="info">
                        <h2>Informasi Profil</h2>
                        <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ auth()->user()->nama }}" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Masukkan email" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="tel" name="no_telepon" value="{{ auth()->user()->no_telepon }}" placeholder="Masukkan nomor telepon">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="{{ auth()->user()->tanggal_lahir }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ auth()->user()->alamat }}</textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ auth()->user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ auth()->user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" value="{{ auth()->user()->pekerjaan }}" placeholder="Masukkan pekerjaan">
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
                            @forelse(auth()->user()->booking as $booking)
                            <div class="booking-card">
                                <div class="booking-image">
                                    <img src="{{ asset($booking->kamar->kost->foto_utama ?? 'kost-image1.png') }}" alt="Kost">
                                </div>
                                <div class="booking-info">
                                    <h3>{{ $booking->kamar->kost->nama_kost }} - {{ $booking->kamar->tipe_kamar }}</h3>
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $booking->kamar->kost->kecamatan }}, {{ $booking->kamar->kost->kota }}</p>
                                    <p><i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($booking->tanggal_checkin)) }} - {{ date('d M Y', strtotime($booking->tanggal_checkout)) }}</p>
                                    <span class="status-badge {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                                </div>
                                <div class="booking-price">
                                    <p>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                                    <a href="{{ route('detail-kost', $booking->kamar->kost->id) }}" class="btn-detail-small">Detail</a>
                                </div>
                            </div>
                            @empty
                            <div style="text-align: center; padding: 60px 20px; color: #999;">
                                <i class="fas fa-calendar-times" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
                                <h3 style="font-size: 20px; margin-bottom: 10px;">Belum Ada Booking</h3>
                                <p>Anda belum memiliki riwayat booking</p>
                                <a href="{{ route('cari-kost') }}" style="display: inline-block; margin-top: 20px; padding: 10px 30px; background: #3d5a4a; color: white; text-decoration: none; border-radius: 8px;">
                                    Cari Kost Sekarang
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Ubah Password -->
                    <div class="tab-content" id="password">
                        <h2>Ubah Password</h2>
                        <form action="{{ route('profile.password') }}" method="POST" class="profile-form">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="current_password" placeholder="Masukkan password lama" required>
                            </div>

                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password" placeholder="Masukkan password baru (min 6 karakter)" required>
                            </div>

                            <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru" required>
                            </div>

                            <button type="submit" class="btn-save">
                                <i class="fas fa-key"></i> Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Logout Section -->
            <div style="margin-top: 40px; text-align: center; padding: 30px; background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <h3 style="color: #2d4538; margin-bottom: 15px;">Keluar dari Akun</h3>
                <p style="color: #666; margin-bottom: 20px;">Anda akan keluar dari akun K.House</p>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout" style="background: #dc3545; color: white; padding: 12px 40px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-about">
                <h3><img src="{{ asset('logo-khouse.png') }}" alt="Logo" style="width: 40px; vertical-align: middle; margin-right: 10px;">K.HOUSE</h3>
                <p>Aplikasi inovatif penggelolaan Kost di Indonesia.</p>
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
        // Tab switching
        const menuItems = document.querySelectorAll('.menu-item');
        const tabContents = document.querySelectorAll('.tab-content');

        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                menuItems.forEach(i => i.classList.remove('active'));
                tabContents.forEach(t => t.classList.remove('active'));
                
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Upload avatar preview
        document.getElementById('uploadAvatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarImg').src = e.target.result;
                    // TODO: Upload ke server
                }
                reader.readAsDataURL(file);
            }
        });

        // Btn logout hover effect
        const btnLogout = document.querySelector('.btn-logout');
        if(btnLogout) {
            btnLogout.addEventListener('mouseover', function() {
                this.style.background = '#c82333';
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 5px 15px rgba(220, 53, 69, 0.4)';
            });
            btnLogout.addEventListener('mouseout', function() {
                this.style.background = '#dc3545';
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        }
    </script>
</body>
</html>