<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kost - K.House Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('logo-khouse.png') }}" alt="K.House">
                <h2>K.HOUSE ADMIN</h2>
            </div>

            <nav class="menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kost') }}" class="menu-item active">
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
            <div class="page-header">
                <h1>Data Kost</h1>
                <button class="btn-add" onclick="openModal('add')">
                    <i class="fas fa-plus"></i> Tambah Kost
                </button>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kost</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Rating</th>
                                <th>Jumlah Kamar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kosts as $index => $kost)
                            <tr>
                                <td>{{ $kosts->firstItem() + $index }}</td>
                                <td><strong>{{ $kost->nama_kost }}</strong></td>
                                <td><span class="badge badge-{{ $kost->kategori }}">{{ ucfirst($kost->kategori) }}</span></td>
                                <td>{{ $kost->kecamatan }}, {{ $kost->kota }}</td>
                                <td>
                                    <i class="fas fa-star" style="color: #ffc107;"></i>
                                    {{ number_format($kost->rating, 1) }} ({{ $kost->jumlah_review }})
                                </td>
                                <td>{{ $kost->kamar_count ?? 0 }} kamar</td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="openModal('edit', {{ $kost->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteKost({{ $kost->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data kost</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $kosts->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Add/Edit -->
    <div id="kostModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Kost</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <form id="kostForm" action="{{ route('admin.kost.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="kostId">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kost *</label>
                        <input type="text" name="nama_kost" id="nama_kost" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select name="kategori" id="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="putra">Putra</option>
                                <option value="putri">Putri</option>
                                <option value="campur">Campur</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kota *</label>
                            <input type="text" name="kota" id="kota" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan">
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap *</label>
                        <textarea name="alamat" id="alamat" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Peraturan</label>
                        <textarea name="peraturan" id="peraturan" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Utama</label>
                        <input type="file" name="foto_utama" id="foto_utama" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(mode, id = null) {
            const modal = document.getElementById('kostModal');
            const form = document.getElementById('kostForm');
            const title = document.getElementById('modalTitle');
            
            if (mode === 'add') {
                title.textContent = 'Tambah Kost';
                form.reset();
                form.action = '{{ route("admin.kost.store") }}';
                document.getElementById('formMethod').value = 'POST';
            } else {
                title.textContent = 'Edit Kost';
                // Fetch data dan populate form (implement with AJAX)
                form.action = `/admin/kost/${id}`;
                document.getElementById('formMethod').value = 'PUT';
            }
            
            modal.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('kostModal').style.display = 'none';
        }

        function deleteKost(id) {
            if (confirm('Yakin ingin menghapus kost ini?')) {
                // Implement delete with AJAX or form
                fetch(`/admin/kost/${id}`, {
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

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('kostModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>