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
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Klik untuk upload atau drag & drop</p>
                                <small>JPG, PNG (Max 2MB)</small>
                            </div>
                            <div class="image-preview" id="imagePreview" style="display: none;">
                                <img src="" alt="Preview" id="previewImg">
                                <button type="button" class="btn-remove-image" onclick="removeImage()">
                                    <i class="fas fa-times"></i> Hapus Foto
                                </button>
                            </div>
                            <input type="file" name="foto_utama" id="foto_utama" accept="image/*" style="display: none;">
                            <input type="hidden" name="remove_foto" id="remove_foto" value="0">
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
        // Upload Area functionality
        const uploadArea = document.getElementById('uploadArea');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const fileInput = document.getElementById('foto_utama');
        const removeFotoInput = document.getElementById('remove_foto');

        uploadArea.addEventListener('click', function(e) {
            if (!e.target.closest('.btn-remove-image')) {
                fileInput.click();
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.style.borderColor = '#3d5a4a';
            uploadArea.style.background = '#f0f4f2';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.style.borderColor = '#ddd';
            uploadArea.style.background = 'white';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.style.borderColor = '#ddd';
            uploadArea.style.background = 'white';
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                handleFileSelect(this.files[0]);
            }
        });

        function handleFileSelect(file) {
            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    uploadPlaceholder.style.display = 'none';
                    imagePreview.style.display = 'block';
                    removeFotoInput.value = '0';
                }
                reader.readAsDataURL(file);
            } else {
                alert('File harus berupa gambar!');
            }
        }

        function removeImage() {
            fileInput.value = '';
            previewImg.src = '';
            uploadPlaceholder.style.display = 'flex';
            imagePreview.style.display = 'none';
            removeFotoInput.value = '1';
        }

        function openModal(mode, id = null) {
            const modal = document.getElementById('kostModal');
            const form = document.getElementById('kostForm');
            const title = document.getElementById('modalTitle');
            
            if (mode === 'add') {
                title.textContent = 'Tambah Kost';
                form.reset();
                removeImage();
                form.action = '{{ route("admin.kost.store") }}';
                document.getElementById('formMethod').value = 'POST';
                modal.style.display = 'flex';
            } else {
                title.textContent = 'Edit Kost';
                
                // Show loading
                const modalBody = document.querySelector('.modal-body');
                const originalContent = modalBody.innerHTML;
                modalBody.innerHTML = '<div style="text-align: center; padding: 40px;"><i class="fas fa-spinner fa-spin" style="font-size: 32px; color: #3d5a4a;"></i><p style="margin-top: 15px; color: #666;">Memuat data...</p></div>';
                modal.style.display = 'flex';
                
                // Fetch data kost
                fetch(`/admin/kost/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Restore original form
                        modalBody.innerHTML = originalContent;
                        
                        // Populate form dengan data yang ada
                        document.getElementById('kostId').value = data.id;
                        document.getElementById('nama_kost').value = data.nama_kost || '';
                        document.getElementById('kategori').value = data.kategori || '';
                        document.getElementById('kota').value = data.kota || '';
                        document.getElementById('kecamatan').value = data.kecamatan || '';
                        document.getElementById('alamat').value = data.alamat || '';
                        document.getElementById('deskripsi').value = data.deskripsi || '';
                        document.getElementById('peraturan').value = data.peraturan || '';
                        
                        // Show existing photo
                        if (data.foto_utama) {
                            const previewImg = document.getElementById('previewImg');
                            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
                            const imagePreview = document.getElementById('imagePreview');
                            
                            previewImg.src = '/' + data.foto_utama;
                            uploadPlaceholder.style.display = 'none';
                            imagePreview.style.display = 'block';
                            document.getElementById('remove_foto').value = '0';
                        } else {
                            removeImage();
                        }
                        
                        // Set form action untuk update
                        form.action = `/admin/kost/${id}`;
                        document.getElementById('formMethod').value = 'PUT';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        modalBody.innerHTML = originalContent;
                        alert('Gagal memuat data kost. Silakan coba lagi.');
                        closeModal();
                    });
            }
        }

        function closeModal() {
            document.getElementById('kostModal').style.display = 'none';
        }

        function deleteKost(id) {
            if (confirm('Yakin ingin menghapus kost ini?')) {
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

        window.onclick = function(event) {
            const modal = document.getElementById('kostModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>