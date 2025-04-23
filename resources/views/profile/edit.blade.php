@extends('layouts.app')

@section('isi')
@php
    $hideSidebar = true;  // Menyembunyikan sidebar
    $hideToggle = true;   // Menyembunyikan ikon toggle
@endphp

<style>
    .container {
        max-width: 900px;
        margin: 20px auto;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 20px;
    }
    .profile-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .back-button {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        margin-bottom: 20px;
        display: inline-block;
    }
    .back-button i {
        margin-right: 4px;
    }
    .form-label {
        font-weight: 600;
        color: #333;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 8px 12px;
        margin-bottom: 5px;
    }
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    .form-control.is-invalid ~ .invalid-feedback {
        display: block;
    }
    .btn-cancel {
        background-color: #fff;
        border: 1px solid #28a745;
        color: #28a745;
        border-radius: 5px;
        padding: 8px 24px;
    }
    .btn-save {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 8px 24px;
    }
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
    .upload-btn {
        background-color: #fff;
        border: 1px solid #28a745;
        color: #28a745;
        font-size: 14px;
        padding: 4px 8px;
        border-radius: 5px;
    }
    .foto-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .foto-filename {
        color: #666;
        font-size: 14px;
    }
    .foto-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 10px;
        border: 1px solid #ddd;
    }
    /* Modal Konfirmasi */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background-color: white;
        width: 400px;
        max-width: 90%;
        border-radius: 10px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .modal-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .modal-body {
        margin-bottom: 20px;
        color: #555;
    }
    .modal-footer {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .btn-modal-cancel {
        background-color: #fff;
        border: 1px solid #28a745;
        color: #28a745;
        border-radius: 5px;
        padding: 8px 24px;
    }
    .btn-modal-confirm {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 8px 24px;
    }
</style>

<div class="container">
    <!-- Tombol Kembali -->
    <a href="{{ route('profile.show') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- Card Profil -->
    <div class="card">
        <div class="profile-title">Profil Pengguna</div>
        
        <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            
            <!-- Add hidden field for password update -->
            <input type="hidden" name="password_update" id="password_update" value="false">
            
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="name" class="form-label">Nama Lengkap *</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required oninvalid="this.setCustomValidity('Nama lengkap tidak boleh kosong')" oninput="setCustomValidity('')">
                    <div class="invalid-feedback">
                        Nama lengkap tidak boleh kosong
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="pangkat" class="form-label">Pangkat</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control" id="pangkat" name="pangkat">
                        <option value="">Pilih Pangkat</option>
                        <!-- Pangkat TNI AD Perwira -->
                        <optgroup label="Perwira Tinggi">
                            <option value="Jenderal" {{ old('pangkat', $user->pangkat) == 'Jenderal' ? 'selected' : '' }}>Jenderal TNI</option>
                            <option value="Letnan Jenderal" {{ old('pangkat', $user->pangkat) == 'Letnan Jenderal' ? 'selected' : '' }}>Letnan Jenderal TNI</option>
                            <option value="Mayor Jenderal" {{ old('pangkat', $user->pangkat) == 'Mayor Jenderal' ? 'selected' : '' }}>Mayor Jenderal TNI</option>
                            <option value="Brigadir Jenderal" {{ old('pangkat', $user->pangkat) == 'Brigadir Jenderal' ? 'selected' : '' }}>Brigadir Jenderal TNI</option>
                        </optgroup>
                        <optgroup label="Perwira Menengah">
                            <option value="Kolonel" {{ old('pangkat', $user->pangkat) == 'Kolonel' ? 'selected' : '' }}>Kolonel</option>
                            <option value="Letnan Kolonel" {{ old('pangkat', $user->pangkat) == 'Letnan Kolonel' ? 'selected' : '' }}>Letnan Kolonel</option>
                            <option value="Mayor" {{ old('pangkat', $user->pangkat) == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                        </optgroup>
                        <optgroup label="Perwira Pertama">
                            <option value="Kapten" {{ old('pangkat', $user->pangkat) == 'Kapten' ? 'selected' : '' }}>Kapten</option>
                            <option value="Letnan Satu" {{ old('pangkat', $user->pangkat) == 'Letnan Satu' ? 'selected' : '' }}>Letnan Satu</option>
                            <option value="Letnan Dua" {{ old('pangkat', $user->pangkat) == 'Letnan Dua' ? 'selected' : '' }}>Letnan Dua</option>
                        </optgroup>
                        <!-- Pangkat TNI AD Bintara -->
                        <optgroup label="Bintara Tinggi">
                            <option value="Pembantu Letnan Satu" {{ old('pangkat', $user->pangkat) == 'Pembantu Letnan Satu' ? 'selected' : '' }}>Pembantu Letnan Satu</option>
                            <option value="Pembantu Letnan Dua" {{ old('pangkat', $user->pangkat) == 'Pembantu Letnan Dua' ? 'selected' : '' }}>Pembantu Letnan Dua</option>
                        </optgroup>
                        <optgroup label="Bintara">
                            <option value="Sersan Mayor" {{ old('pangkat', $user->pangkat) == 'Sersan Mayor' ? 'selected' : '' }}>Sersan Mayor</option>
                            <option value="Sersan Kepala" {{ old('pangkat', $user->pangkat) == 'Sersan Kepala' ? 'selected' : '' }}>Sersan Kepala</option>
                            <option value="Sersan Satu" {{ old('pangkat', $user->pangkat) == 'Sersan Satu' ? 'selected' : '' }}>Sersan Satu</option>
                            <option value="Sersan Dua" {{ old('pangkat', $user->pangkat) == 'Sersan Dua' ? 'selected' : '' }}>Sersan Dua</option>
                        </optgroup>
                        <!-- Pangkat TNI AD Tamtama -->
                        <optgroup label="Tamtama">
                            <option value="Kopral Kepala" {{ old('pangkat', $user->pangkat) == 'Kopral Kepala' ? 'selected' : '' }}>Kopral Kepala</option>
                            <option value="Kopral Satu" {{ old('pangkat', $user->pangkat) == 'Kopral Satu' ? 'selected' : '' }}>Kopral Satu</option>
                            <option value="Kopral Dua" {{ old('pangkat', $user->pangkat) == 'Kopral Dua' ? 'selected' : '' }}>Kopral Dua</option>
                            <option value="Prajurit Kepala" {{ old('pangkat', $user->pangkat) == 'Prajurit Kepala' ? 'selected' : '' }}>Prajurit Kepala</option>
                            <option value="Prajurit Satu" {{ old('pangkat', $user->pangkat) == 'Prajurit Satu' ? 'selected' : '' }}>Prajurit Satu</option>
                            <option value="Prajurit Dua" {{ old('pangkat', $user->pangkat) == 'Prajurit Dua' ? 'selected' : '' }}>Prajurit Dua</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="foto" class="form-label">Foto</label>
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center mb-2">
                        @if($user->foto)
                            <img src="{{ asset('storage/profile/' . $user->foto) }}" alt="Foto Profil" class="foto-preview">
                        @else
                            <img src="{{ asset('images/logo.png') }}" alt="Default Logo" class="foto-preview">
                        @endif
                    </div>
                    <div class="foto-container">
                        <span class="foto-filename">{{ $user->foto ?? 'Belum ada foto' }}</span>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto').click()">Upload</button>
                        <input type="file" id="foto" name="foto" style="display: none;">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="email" class="form-label">Email *</label>
                </div>
                <div class="col-md-9">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required oninvalid="this.setCustomValidity('Email tidak boleh kosong dan harus dalam format yang benar')" oninput="setCustomValidity('')">
                    <div class="invalid-feedback">
                        Email tidak boleh kosong dan harus dalam format yang benar
                    </div>
                </div>
            </div>
            
            <!-- Password Fields -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password">
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="password" class="form-label">Password Baru</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password">
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted">Password minimal 8 karakter</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('profile.show') }}" class="btn btn-cancel">Batalkan</a>
                <button type="button" id="btnSave" class="btn btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="konfirmasiModal" class="modal">
    <div class="modal-content">
        <div class="modal-title">Konfirmasi Perubahan Profil</div>
        <div class="modal-body">
            Perubahan profil akan mengubah seluruh data sebelumnya, apakah anda ingin melanjutkan perubahan data?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" id="btnKembali">Kembali</button>
            <button type="button" class="btn-modal-confirm" id="btnLanjutkan">Lanjutkan</button>
        </div>
    </div>
</div>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script untuk menampilkan nama file saat dipilih dan preview foto
        document.getElementById('foto').addEventListener('change', function() {
            // Update nama file
            const fileName = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih';
            document.querySelector('.foto-filename').textContent = fileName;
            
            // Preview foto
            const preview = document.querySelector('.foto-preview');
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Sweet Alert saat berhasil update profil
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
        @endif

        @if(session('status') === 'profile-updated')
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Profil berhasil diperbarui',
            timer: 3000,
            showConfirmButton: false
        });
        @endif

        // Script untuk modal konfirmasi
        const modal = document.getElementById('konfirmasiModal');
        const btnSave = document.getElementById('btnSave');
        const btnKembali = document.getElementById('btnKembali');
        const btnLanjutkan = document.getElementById('btnLanjutkan');
        const profileForm = document.getElementById('profileForm');

        // Tampilkan modal
        function showModal() {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Mencegah scroll
        }

        // Sembunyikan modal
        function hideModal() {
            modal.style.display = 'none';
            document.body.style.overflow = ''; // Kembalikan scroll
        }

        // Validasi form sebelum menampilkan modal
        btnSave.onclick = function(e) {
            console.log('Tombol Simpan diklik');
            // Cek validasi form
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            let isValid = true;
            
            // Reset validasi
            nameInput.classList.remove('is-invalid');
            emailInput.classList.remove('is-invalid');
            
            // Validasi nama
            if (!nameInput.value.trim()) {
                nameInput.classList.add('is-invalid');
                isValid = false;
                console.log('Nama tidak valid');
            }
            
            // Validasi email
            if (!emailInput.value.trim() || !isValidEmail(emailInput.value)) {
                emailInput.classList.add('is-invalid');
                isValid = false;
                console.log('Email tidak valid');
            }
            
            // Check password fields
            const currentPassword = document.getElementById('current_password');
            const newPassword = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            
            // Validasi password (jika diisi)
            if (currentPassword.value || newPassword.value || confirmPassword.value) {
                // Jika ada salah satu field password yang diisi, maka semua field harus diisi
                if (!currentPassword.value) {
                    currentPassword.classList.add('is-invalid');
                    isValid = false;
                }
                
                if (!newPassword.value) {
                    newPassword.classList.add('is-invalid');
                    isValid = false;
                }
                
                if (!confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');
                    isValid = false;
                }
                
                // Validasi konfirmasi password
                if (newPassword.value && confirmPassword.value && newPassword.value !== confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');
                    isValid = false;
                    // Tambahkan pesan error
                    let errorMsg = document.createElement('div');
                    errorMsg.className = 'invalid-feedback';
                    errorMsg.style.display = 'block';
                    errorMsg.innerHTML = 'Konfirmasi password tidak cocok';
                    
                    // Hapus pesan error sebelumnya jika ada
                    const prevError = confirmPassword.nextElementSibling;
                    if (prevError && prevError.className === 'invalid-feedback') {
                        prevError.remove();
                    }
                    
                    confirmPassword.parentNode.appendChild(errorMsg);
                }
                
                // Set flag untuk update password
                document.getElementById('password_update').value = 'true';
            }
            
            // Jika form valid, tampilkan modal konfirmasi
            if (isValid) {
                console.log('Form valid, menampilkan modal');
                showModal();
            }
        };
        
        // Fungsi untuk validasi format email
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Display password update status messages
        @if(session('status') === 'password-updated')
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Password berhasil diperbarui',
            timer: 3000,
            showConfirmButton: false
        });
        @endif

        // Tutup modal saat klik tombol kembali
        btnKembali.onclick = function() {
            hideModal();
        };

        // Submit form saat klik tombol lanjutkan
        btnLanjutkan.onclick = function() {
            hideModal();
            profileForm.submit();
        };

        // Tutup modal saat klik di luar modal
        window.onclick = function(event) {
            if (event.target == modal) {
                hideModal();
            }
        };
    });
</script>
@endsection
