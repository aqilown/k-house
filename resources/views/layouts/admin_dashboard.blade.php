<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - K.House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('logo-khouse.png') }}" alt="K.House">
            </div>

            <nav class="menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kost') }}" class="menu-item">
                    <i class="fas fa-building"></i>
                    <span>Data Kost</span>
                </a>
                <a href="{{ route('admin.kamar') }}" class="menu-item">
                    <i class="fas fa-door-open"></i>
                    <span>Data Kamar</span>
                </a>
                <a href="{{ route('admin.booking') }}" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Data Booking</span>
                </a>
                <a href="{{ route('admin.users') }}" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Data User</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="#" class="menu-item logout" onclick="event.preventDefault(); if(confirm('Yakin ingin logout?')) window.location.href='{{ route('login') }}'">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="page-header">
                <h1>Dashboard</h1>
                <p>Selamat datang, Admin!</p>
            </div>

            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-text">
                        <h3>{{ $totalKost }}</h3>
                        <p>Total Kost</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-text">
                        <h3>{{ $totalKamar }}</h3>
                        <p>Total Kamar</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-text">
                        <h3>{{ $totalBooking }}</h3>
                        <p>Total Booking</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-text">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total User</p>
                    </div>
                </div>
            </div>

            <!-- Recent Data -->
            <div class="content-grid">
                <!-- Data Kost -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-building"></i> Data Kost Terbaru</h3>
                        <a href="{{ route('admin.kost') }}" class="btn-link">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentKost as $kost)
                                <tr>
                                    <td>{{ $kost->nama_kost }}</td>
                                    <td><span class="badge badge-{{ $kost->kategori }}">{{ ucfirst($kost->kategori) }}</span></td>
                                    <td>{{ $kost->kecamatan }}, {{ $kost->kota }}</td>
                                    <td>
                                        <i class="fas fa-star" style="color: #ffc107;"></i>
                                        {{ number_format($kost->rating, 1) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data kost</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Data Booking -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-calendar-check"></i> Booking Terbaru</h3>
                        <a href="{{ route('admin.booking') }}" class="btn-link">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Kost</th>
                                    <th>Check In</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBooking as $booking)
                                <tr>
                                    <td>{{ $booking->user->nama }}</td>
                                    <td>{{ $booking->kamar->kost->nama_kost }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->tanggal_checkin)) }}</td>
                                    <td>
                                        <span class="badge badge-status-{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada booking</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>