<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - K.House Admin</title>
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
                <a href="{{ route('admin.booking') }}" class="menu-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Data Booking</span>
                </a>
                <a href="{{ route('admin.users') }}" class="menu-item active">
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
                <h1>Data User</h1>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari user..." id="searchInput" onkeyup="searchUser()">
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <table class="data-table" id="userTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Pekerjaan</th>
                                <th>Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <div class="user-info">
                                        <img src="{{ asset($user->foto_profil ?? 'default-avatar.png') }}" alt="Avatar" class="user-avatar">
                                        <strong>{{ $user->nama }}</strong>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->no_telepon ?? '-' }}</td>
                                <td>{{ $user->pekerjaan ?? '-' }}</td>
                                <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    <button class="btn-action btn-view" onclick="viewUser({{ $user->id }})" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteUser({{ $user->id }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data user</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Detail User -->
    <div id="userModal" class="modal">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h3>Detail User</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="userContent">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function viewUser(id) {
            const modal = document.getElementById('userModal');
            const content = document.getElementById('userContent');
            
            // Fetch user detail with AJAX
            fetch(`/admin/users/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    content.innerHTML = `
                        <div class="user-detail">
                            <div class="user-profile-center">
                                <img src="${data.foto_profil || '/default-avatar.png'}" alt="Avatar" class="user-avatar-large">
                                <h3>${data.nama}</h3>
                                <p>${data.email}</p>
                            </div>
                            
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <strong>No. Telepon:</strong>
                                    <p>${data.no_telepon || '-'}</p>
                                </div>
                                <div class="detail-item">
                                    <strong>Tanggal Lahir:</strong>
                                    <p>${data.tanggal_lahir || '-'}</p>
                                </div>
                                <div class="detail-item">
                                    <strong>Jenis Kelamin:</strong>
                                    <p>${data.jenis_kelamin || '-'}</p>
                                </div>
                                <div class="detail-item">
                                    <strong>Pekerjaan:</strong>
                                    <p>${data.pekerjaan || '-'}</p>
                                </div>
                                <div class="detail-item full-width">
                                    <strong>Alamat:</strong>
                                    <p>${data.alamat || '-'}</p>
                                </div>
                                <div class="detail-item">
                                    <strong>Bergabung:</strong>
                                    <p>${new Date(data.created_at).toLocaleDateString('id-ID')}</p>
                                </div>
                                <div class="detail-item">
                                    <strong>Total Booking:</strong>
                                    <p><strong>${data.total_booking || 0} booking</strong></p>
                                </div>
                            </div>

                            ${data.bookings && data.bookings.length > 0 ? `
                                <div class="booking-history">
                                    <h4>Riwayat Booking</h4>
                                    <table class="simple-table">
                                        <thead>
                                            <tr>
                                                <th>Kost</th>
                                                <th>Kamar</th>
                                                <th>Check In</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${data.bookings.map(b => `
                                                <tr>
                                                    <td>${b.kamar.kost.nama_kost}</td>
                                                    <td>${b.kamar.tipe_kamar}</td>
                                                    <td>${new Date(b.tanggal_checkin).toLocaleDateString('id-ID')}</td>
                                                    <td><span class="badge badge-status-${b.status}">${b.status}</span></td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            ` : ''}
                        </div>
                    `;
                    modal.style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail user');
                });
        }

        function deleteUser(id) {
            if (confirm('Yakin ingin menghapus user ini? Semua data booking user akan ikut terhapus.')) {
                fetch(`/admin/users/${id}`, {
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

        function searchUser() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('userTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        const txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                tr[i].style.display = found ? '' : 'none';
            }
        }

        function closeModal() {
            document.getElementById('userModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('userModal');
            if (event.target === modal) closeModal();
        }
    </script>
</body>
</html>