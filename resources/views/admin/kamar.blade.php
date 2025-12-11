<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar - K.House Admin</title>
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
                <a href="{{ route('admin.kamar') }}" class="menu-item active">
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
                <h1>Data Kamar</h1>
                <button class="btn-add" onclick="openModal('add')">
                    <i class="fas fa-plus"></i> Tambah Kamar
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
                                <th>Tipe Kamar</th>
                                <th>Harga/Bulan</th>
                                <th>Ukuran</th>
                                <th>Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kamars as $index => $kamar)
                            <tr>
                                <td>{{ $kamars->firstItem() + $index }}</td>
                                <td>{{ $kamar->kost->nama_kost }}</td>
                                <td><strong>{{ $kamar->tipe_kamar }}</strong></td>
                                <td>Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                                <td>{{ $kamar->ukuran ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $kamar->jumlah_tersedia > 0 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $kamar->jumlah_tersedia }} kamar
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="openModal('edit', {{ $kamar->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="deleteKamar({{ $kamar->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data kamar</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $kamars->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Add/Edit -->
    <div id="kamarModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Kamar</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <form id="kamarForm" action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="kamarId">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Kost *</label>
                        <select name="kost_id" id="kost_id" required>
                            <option value="">-- Pilih Kost --</option>
                            @foreach(\App\Models\Kost::all() as $kost)
                            <option value="{{ $kost->id }}">{{ $kost->nama_kost }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipe Kamar *</label>
                        <input type="text" name="tipe_kamar" id="tipe_kamar" placeholder="Contoh: Kamar Mandi Dalam" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Harga/Bulan *</label>
                            <input type="number" name="harga_bulanan" id="harga_bulanan" placeholder="1000000" required>
                        </div>
                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" name="ukuran" id="ukuran" placeholder="3x4 m">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Tersedia *</label>
                        <input type="number" name="jumlah_tersedia" id="jumlah_tersedia" value="0" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Kamar</label>
                        <input type="file" name="foto_kamar" id="foto_kamar" accept="image/*">
                        <input type="hidden" name="remove_foto" id="remove_foto" value="0">
                        <div id="imagePreview" style="margin-top: 10px; display: none;">
                            <img src="" alt="Preview" id="previewImg" style="max-width: 200px; border-radius: 8px;">
                            <button type="button" class="btn-remove-image" onclick="removeImage()" style="display: block; margin-top: 10px; background: #dc3545; color: white; padding: 5px 15px; border: none; border-radius: 5px; cursor: pointer;">
                                <i class="fas fa-times"></i> Hapus Foto
                            </button>
                        </div>
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
        // Simple file preview
        const fileInput = document.getElementById('foto_kamar');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeFotoInput = document.getElementById('remove_foto');

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                    removeFotoInput.value = '0';
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        function removeImage() {
            fileInput.value = '';
            previewImg.src = '';
            imagePreview.style.display = 'none';
            removeFotoInput.value = '1';
        }

        function openModal(mode, id = null) {
            const modal = document.getElementById('kamarModal');
            const form = document.getElementById('kamarForm');
            const title = document.getElementById('modalTitle');
            
            if (mode === 'add') {
                title.textContent = 'Tambah Kamar';
                form.reset();
                removeImage();
                form.action = '{{ route("admin.kamar.store") }}';
                document.getElementById('formMethod').value = 'POST';
                modal.style.display = 'flex';
            } else {
                title.textContent = 'Edit Kamar';
                modal.style.display = 'flex';
                
                // Fetch data kamar untuk edit
                fetch(`/admin/kamar/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate form
                        document.getElementById('kamarId').value = data.id;
                        document.getElementById('kost_id').value = data.kost_id || '';
                        document.getElementById('tipe_kamar').value = data.tipe_kamar || '';
                        document.getElementById('harga_bulanan').value = data.harga_bulanan || '';
                        document.getElementById('ukuran').value = data.ukuran || '';
                        document.getElementById('jumlah_tersedia').value = data.jumlah_tersedia || 0;
                        document.getElementById('deskripsi').value = data.deskripsi || '';
                        
                        // Show existing photo
                        if (data.foto_kamar) {
                            previewImg.src = '/' + data.foto_kamar;
                            imagePreview.style.display = 'block';
                            removeFotoInput.value = '0';
                        } else {
                            removeImage();
                        }
                        
                        form.action = `/admin/kamar/${id}`;
                        document.getElementById('formMethod').value = 'PUT';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data kamar');
                    });
            }
        }

        function closeModal() {
            document.getElementById('kamarModal').style.display = 'none';
        }

        function deleteKamar(id) {
            if (confirm('Yakin ingin menghapus kamar ini?')) {
                fetch(`/admin/kamar/${id}`, {
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

        window.onclick = function(event) {
            const modal = document.getElementById('kamarModal');
            if (event.target === modal) closeModal();
        }
    </script>
</body>
</html>