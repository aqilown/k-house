<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking - K.House Admin</title>
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
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
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
                <a href="{{ route('admin.booking') }}" class="menu-item active">
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
            <div class="page-header">
                <h1>Data Booking</h1>
                <div class="filter-group">
                    <select class="filter-select" onchange="filterStatus(this.value)">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Kost</th>
                                <th>Kamar</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $index => $booking)
                            <tr>
                                <td>{{ $bookings->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $booking->user->nama }}</strong><br>
                                    <small>{{ $booking->user->email }}</small>
                                </td>
                                <td>{{ $booking->kamar->kost->nama_kost }}</td>
                                <td>{{ $booking->kamar->tipe_kamar }}</td>
                                <td>{{ date('d/m/Y', strtotime($booking->tanggal_checkin)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($booking->tanggal_checkout)) }}</td>
                                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-status-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-action btn-view" onclick="viewDetail({{ $booking->id }})" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($booking->status === 'pending')
                                    <button class="btn-action btn-success" onclick="updateStatus({{ $booking->id }}, 'aktif')" title="Konfirmasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @endif
                                    <button class="btn-action btn-delete" onclick="deleteBooking({{ $booking->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data booking</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="modal">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h3>Detail Booking</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function viewDetail(id) {
            const modal = document.getElementById('detailModal');
            const content = document.getElementById('detailContent');
            
            // Fetch booking detail with AJAX
            fetch(`/admin/booking/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    content.innerHTML = `
                        <div class="detail-grid">
                            <div class="detail-item">
                                <strong>Nama User:</strong>
                                <p>${data.user.nama}</p>
                            </div>
                            <div class="detail-item">
                                <strong>Email:</strong>
                                <p>${data.user.email}</p>
                            </div>
                            <div class="detail-item">
                                <strong>No. Telepon:</strong>
                                <p>${data.user.no_telepon || '-'}</p>
                            </div>
                            <div class="detail-item">
                                <strong>Nama Kost:</strong>
                                <p>${data.kamar.kost.nama_kost}</p>
                            </div>
                            <div class="detail-item">
                                <strong>Tipe Kamar:</strong>
                                <p>${data.kamar.tipe_kamar}</p>
                            </div>
                            <div class="detail-item">
                                <strong>Harga/Bulan:</strong>
                                <p>Rp ${data.kamar.harga_bulanan.toLocaleString('id-ID')}</p>
                            </div>
                            <div class="detail-item">
                                <strong>Durasi:</strong>
                                <p>${data.durasi_bulan} bulan</p>
                            </div>
                            <div class="detail-item">
                                <strong>Total Harga:</strong>
                                <p><strong>Rp ${data.total_harga.toLocaleString('id-ID')}</strong></p>
                            </div>
                            <div class="detail-item full-width">
                                <strong>Catatan:</strong>
                                <p>${data.catatan || '-'}</p>
                            </div>
                        </div>
                    `;
                    modal.style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail booking');
                });
        }

        function updateStatus(id, status) {
            if (confirm('Konfirmasi booking ini?')) {
                fetch(`/admin/booking/${id}/status`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function deleteBooking(id) {
            if (confirm('Yakin ingin menghapus booking ini?')) {
                fetch(`/admin/booking/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function filterStatus(status) {
            window.location.href = `{{ route('admin.booking') }}?status=${status}`;
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) closeModal();
        }
    </script>
</body>
</html>