<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kost->nama_kost }} - K.House</title>
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
                
                @auth
                    <!-- Jika sudah login - Tampil foto profil -->
                    <a href="{{ route('profile') }}" class="profile-link" style="display: flex; align-items: center; gap: 10px; padding: 8px 15px; background: #f0f4f2; border-radius: 25px; transition: all 0.3s;">
                        <img src="{{ asset(auth()->user()->foto_profil ?? 'default-avatar.png') }}" 
                            alt="Profile" 
                            style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid #3d5a4a;">
                        <span style="font-weight: 600; color: #2d4538;">{{ auth()->user()->nama }}</span>
                    </a>
                @else
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="btn-get-started">GET STARTED</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="detail-container">
        <div class="container">
            <!-- Header Section - DINAMIS -->
            <div class="kost-header">
                <div class="header-left">
                    <h1>{{ $kost->nama_kost }}</h1>
                    <div class="rating">
                        @if($avgRating > 0)
                        <i class="fas fa-star"></i>
                        <span class="rating-score">{{ number_format($avgRating, 1) }}/5</span>
                        <span class="rating-reviews">
                            @if($avgRating >= 4.5) Luar Biasa
                            @elseif($avgRating >= 4.0) Sangat Baik
                            @elseif($avgRating >= 3.5) Baik
                            @elseif($avgRating >= 3.0) Cukup
                            @else Perlu Peningkatan
                            @endif
                            ({{ $totalReview }} reviews)
                        </span>
                        @else
                        <i class="fas fa-star" style="color: #ddd;"></i>
                        <span class="rating-reviews">Belum ada review</span>
                        @endif
                    </div>
                    <p class="location">
                        <i class="fas fa-map-marker-alt"></i> 
                        {{ $kost->kecamatan }}, {{ $kost->kota }}
                    </p>
                    <span class="badge-kategori" style="display: inline-block; background: #3d5a4a; color: white; padding: 5px 15px; border-radius: 20px; font-size: 13px; margin-top: 10px;">
                        {{ ucfirst($kost->kategori) }}
                    </span>
                </div>
            </div>

            <!-- Description - DINAMIS -->
            <div class="kost-description">
                @if($kost->deskripsi)
                    {!! nl2br(e($kost->deskripsi)) !!}
                @else
                    <p>Selamat datang di {{ $kost->nama_kost }}. Kost modern yang menawarkan kenyamanan tinggal terbaik untuk Anda.</p>
                @endif
            </div>

            <!-- Facilities Grid - DINAMIS -->
            @if($kost->fasilitas->count() > 0)
            <div class="facilities-section">
                <h3>Fasilitas Terbaik</h3>
                <div class="facilities-grid">
                    @foreach($kost->fasilitas as $fasilitas)
                    <div class="facility-item">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ $fasilitas->nama_fasilitas }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Room Options - DINAMIS -->
            @if($kost->kamar->count() > 0)
            <div class="booking-section">
                <h2>Pilihan Kamar Tersedia</h2>
                
                <div class="rooms-section">
                    @foreach($kost->kamar as $kamar)
                    <div class="room-card">
                        @if($kamar->foto_kamar)
                            <img src="{{ asset($kamar->foto_kamar) }}" alt="{{ $kamar->tipe_kamar }}">
                        @else
                            <img src="{{ asset('kost-image3.png') }}" alt="{{ $kamar->tipe_kamar }}">
                        @endif
                        
                        <div class="room-info">
                            <h3>{{ $kamar->tipe_kamar }}</h3>
                            <div class="room-specs">
                                @if($kamar->ukuran)
                                <span><i class="fas fa-ruler-combined"></i> {{ $kamar->ukuran }}</span>
                                @endif
                                <span><i class="fas fa-door-open"></i> {{ $kamar->jumlah_tersedia }} kamar tersedia</span>
                            </div>
                            @if($kamar->deskripsi)
                            <div class="room-facilities">
                                <p><strong>Deskripsi:</strong></p>
                                <p style="font-size: 14px; color: #666;">{{ $kamar->deskripsi }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="room-price">
                            <h3>Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</h3>
                            <p>Per bulan</p>
                            @if($kamar->jumlah_tersedia > 0)
                            <button class="btn-book" onclick="alert('Fitur booking akan segera hadir!')">Booking Sekarang</button>
                            @else
                            <button class="btn-book" style="background: #ccc; cursor: not-allowed;" disabled>Tidak Tersedia</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Location Section - DINAMIS -->
            <div class="map-section">
                <h2>Lokasi</h2>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.82493!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2s{{ urlencode($kost->kota) }}%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1234567890" 
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="location-info">
                    <h3>{{ $kost->nama_kost }}</h3>
                    <div class="location-details">
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Alamat Lengkap</h4>
                                <p>{{ $kost->alamat }}, {{ $kost->kecamatan }}, {{ $kost->kota }}</p>
                            </div>
                        </div>
                        @if($kost->peraturan)
                        <div class="detail-item">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <h4>Peraturan Kost</h4>
                                <p>{{ $kost->peraturan }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Reviews Section - DINAMIS + FORM -->
            <div class="reviews-section" style="margin-top: 60px; padding: 40px; background: white; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <div class="reviews-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h2 style="color: #2d4538; font-size: 28px;">Review Pengunjung</h2>
                    <button class="btn-write-review" onclick="toggleReviewForm()" style="background: #3d5a4a; color: white; padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                        <i class="fas fa-pen"></i> Tulis Review
                    </button>
                </div>

                @if($totalReview > 0)
                <!-- Rating Summary -->
                <div class="reviews-stats" style="display: grid; grid-template-columns: 200px 1fr; gap: 40px; margin-bottom: 40px; padding-bottom: 30px; border-bottom: 2px solid #f0f0f0;">
                    <div class="rating-summary" style="text-align: center;">
                        <div class="rating-score-large" style="font-size: 64px; font-weight: bold; color: #3d5a4a;">{{ number_format($avgRating, 1) }}</div>
                        <div class="rating-stars" style="color: #ffc107; font-size: 20px; margin: 10px 0;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($avgRating))
                                    <i class="fas fa-star"></i>
                                @elseif($i == ceil($avgRating) && $avgRating - floor($avgRating) >= 0.5)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="total-reviews" style="color: #666;">Berdasarkan {{ $totalReview }} reviews</p>
                    </div>

                    <div class="rating-breakdown">
                        @php
                            $ratingCounts = $kost->review->groupBy('rating')->map->count();
                        @endphp
                        @for($i = 5; $i >= 1; $i--)
                        <div class="rating-bar-item" style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                            <span style="width: 50px; color: #666;">{{ $i }} <i class="fas fa-star" style="color: #ffc107; font-size: 14px;"></i></span>
                            <div class="progress-bar" style="flex: 1; height: 8px; background: #e9ecef; border-radius: 10px; overflow: hidden;">
                                @php
                                    $count = $ratingCounts->get($i, 0);
                                    $percentage = $totalReview > 0 ? ($count / $totalReview) * 100 : 0;
                                @endphp
                                <div class="progress-fill" style="width: {{ $percentage }}%; height: 100%; background: #ffc107;"></div>
                            </div>
                            <span class="rating-count" style="width: 40px; text-align: right; color: #666;">{{ $count }}</span>
                        </div>
                        @endfor
                    </div>
                </div>
                @endif

                <!-- Form Write Review -->
                <div id="reviewForm" style="display: none; background: #f8f9fa; padding: 30px; border-radius: 12px; margin-bottom: 30px;">
                    <h3 style="color: #2d4538; margin-bottom: 20px;">Tulis Review Anda</h3>
                    
                    @guest
                    <div style="padding: 20px; background: #fff3cd; border-radius: 8px; margin-bottom: 20px; color: #856404;">
                        <i class="fas fa-exclamation-triangle"></i> Anda harus <a href="{{ route('login') }}" style="color: #3d5a4a; font-weight: 600;">login</a> terlebih dahulu untuk memberikan review.
                    </div>
                    @else
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kost_id" value="{{ $kost->id }}">
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #555;">Rating</label>
                            <div class="star-rating" style="font-size: 32px; cursor: pointer;">
                                <i class="far fa-star" data-rating="1"></i>
                                <i class="far fa-star" data-rating="2"></i>
                                <i class="far fa-star" data-rating="3"></i>
                                <i class="far fa-star" data-rating="4"></i>
                                <i class="far fa-star" data-rating="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating" required>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #555;">Komentar</label>
                            <textarea name="komentar" rows="4" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; font-family: inherit;" placeholder="Ceritakan pengalaman Anda..."></textarea>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="submit" style="background: #3d5a4a; color: white; padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                <i class="fas fa-paper-plane"></i> Kirim Review
                            </button>
                            <button type="button" onclick="toggleReviewForm()" style="background: #6c757d; color: white; padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                Batal
                            </button>
                        </div>
                    </form>
                    @endguest
                </div>

                <!-- Reviews List - DINAMIS -->
                <div class="reviews-list">
                    @forelse($kost->review()->latest()->get() as $review)
                    <div class="review-card" style="padding: 25px; border: 1px solid #e9ecef; border-radius: 12px; margin-bottom: 20px;">
                        <div class="review-header" style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                            <div class="reviewer-info" style="display: flex; gap: 15px;">
                                <div class="reviewer-avatar" style="width: 50px; height: 50px; background: #3d5a4a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 600;">
                                    {{ strtoupper(substr($review->user->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 style="color: #2d4538; margin-bottom: 5px;">{{ $review->user->nama }}</h4>
                                    <p class="review-date" style="font-size: 13px; color: #999;">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="review-rating" style="color: #ffc107; font-size: 16px;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="review-text" style="color: #555; line-height: 1.6;">{{ $review->komentar }}</p>
                    </div>
                    @empty
                    <div style="text-align: center; padding: 60px 20px; color: #999;">
                        <i class="fas fa-comments" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
                        <h3 style="font-size: 20px; margin-bottom: 10px;">Belum Ada Review</h3>
                        <p>Jadilah yang pertama memberikan review untuk kost ini!</p>
                    </div>
                    @endforelse
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
        // Toggle Review Form
        function toggleReviewForm() {
            const form = document.getElementById('reviewForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        // Star Rating System
        const stars = document.querySelectorAll('.star-rating i');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;
                
                // Update star display
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                        s.style.color = '#ffc107';
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                        s.style.color = '#ddd';
                    }
                });
            });

            // Hover effect
            star.addEventListener('mouseover', function() {
                const rating = this.getAttribute('data-rating');
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.style.color = '#ffc107';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });

        // Reset on mouse leave
        document.querySelector('.star-rating').addEventListener('mouseleave', function() {
            const currentRating = ratingInput.value;
            stars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                if (currentRating && starRating <= currentRating) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
    </script>
</body>
</html>