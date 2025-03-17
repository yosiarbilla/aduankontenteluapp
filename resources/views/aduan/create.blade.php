@extends('layouts.app')

@section('isi')
@php
    // Set variable di sini
    $hideSidebar = true;
    $hideToggle = true; 
@endphp
<style>
    .container {
        padding-left: 120px;
        padding-right: 100px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .form-control {
        border-radius: 5px;
    }
    .form-control-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 12px;
        padding-right: 2.5rem;
    }

    .form-control-select:focus {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2328a745' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    }
    
    /* Kelas yang ditambahkan saat dropdown aktif/terbuka */
    .select-active {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2328a745' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 4.86 2.451 10.342C1.885 10.987 2.345 12 3.204 12h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z'/%3E%3C/svg%3E") !important;
    }

    .btn-upload {
        border: 1px solid #28a745;
        background-color: white !important;
        color: #28a745;
        border-radius: 5px;
        padding: 8px 16px;
        text-align: center;
    }

    .btn-upload:hover {
        background-color: #e9ecef !important;
    }

    .btn-add {
        border: 1px solid #28a745;
        background-color: white;
        color: #28a745;
        border-radius: 5px;
        padding: 8px 16px;
        text-align: center;
    }

    .btn-add:hover {
        background-color: #e9ecef !important;
    }

    .form-footer {
        max-width: 100%;
        background-color: #fff;
        box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.1);
        padding: 10px 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        position: relative;
        left: 0;
        right: 0;
    }

    .form-footer .btn {
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
    }

    .form-footer .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }

    .form-footer .btn-success:hover {
        background-color: #218838;
    }

    .form-footer .btn-outline-secondary {
        border: 1px solid #6c757d;
        color: #6c757d;
        background-color: #fff;
    }

    .form-footer .btn-outline-secondary:hover {
        background-color: #f8f9fa;
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
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
    
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #dc3545;
    }
    
    /* Styling for pasal container */

    
    .pasal-item {
        margin-bottom: 10px;
    }
</style>

<div class="content">
    <div class="container mt-4">
        <a href="{{ route('dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <!-- SweetAlert for file upload errors -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Kategori -->
            <div class="card">
                <div class="row row-gap">
                    <h5 style="font-weight: bold;">Kategori</h5>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control form-control-select @error('kategori') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Konten Negatif" {{ old('kategori') == 'Konten Negatif' ? 'selected' : '' }}>Konten Negatif</option>
                            <option value="Penipuan" {{ old('kategori') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                            <option value="Terorisme" {{ old('kategori') == 'Terorisme' ? 'selected' : '' }}>Terorisme</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="prioritas" class="form-label">Prioritas</label>
                        <select id="prioritas" name="prioritas" class="form-control form-control-select @error('prioritas') is-invalid @enderror">
                            <option value="Normal" {{ old('prioritas') == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Urgent" {{ old('prioritas') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="High" {{ old('prioritas') == 'High' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('prioritas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Surat Permintaan dan Dokumen Pendukung -->
            <div class="card">
                <h5 style="font-weight: bold;">Surat Permintaan dan Dokumen Pendukung</h5>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="nomorSurat" class="form-label">Nomor Surat</label>
                        <input type="text" id="nomorSurat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Nomor Surat" value="{{ old('nomor_surat') }}">
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="suratPermintaan" class="form-label">Surat Permintaan</label>
                        <input type="file" id="suratPermintaan" name="surat_permintaan" class="form-control @error('surat_permintaan') is-invalid @enderror">
                        <small class="text-muted">Maksimal berukuran 1 MB, format: pdf</small>
                        @error('surat_permintaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Tambahkan div container untuk dokumen pendukung -->
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                        <div id="dokumenPendukungContainer">
                            <input type="file" id="dokumenPendukung" name="dokumen_pendukung[]" class="form-control @error('dokumen_pendukung.*') is-invalid @enderror">
                        </div>
                        <div class="dokumen-wrapper">
                            <button type="button" id="tambahDokumen" class="btn btn-add mt-2">
                                <i class="fas fa-plus"></i> Tambah Dokumen
                            </button>
                            <small class="text-muted d-block mt-1">Maksimal 10 dokumen berukuran 2 MB, format: jpg, png, doc, pdf</small>
                        </div>
                        @error('dokumen_pendukung.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                        <textarea id="catatanTambahan" name="catatan_tambahan" class="form-control @error('catatan_tambahan') is-invalid @enderror" rows="5">{{ old('catatan_tambahan') }}</textarea>
                        @error('catatan_tambahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card">
    <h5 style="font-weight: bold;">Platform</h5>
    <label for="platform" class="form-label">URL 1</label>
    <div class="row">
        <div class="col-md-6">
            <label for="platform" class="form-label">Platform</label>
            <select id="platform" name="platform" class="form-control form-control-select @error('platform') is-invalid @enderror">
                <option value="">Pilih Platform</option>
                <option value="Facebook" {{ old('platform') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="Instagram" {{ old('platform') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="Twitter" {{ old('platform') == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                <option value="TikTok" {{ old('platform') == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                <option value="YouTube" {{ old('platform') == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                <option value="WhatsApp" {{ old('platform') == 'WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                <option value="Telegram" {{ old('platform') == 'Telegram' ? 'selected' : '' }}>Telegram</option>
                <option value="Website" {{ old('platform') == 'Website' ? 'selected' : '' }}>Website</option>
                <option value="Lainnya" {{ old('platform') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            @error('platform')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="urlLink" class="form-label">URL Link</label>
            <input type="url" id="urlLink" name="url_link" class="form-control @error('url_link') is-invalid @enderror" placeholder="URL Link">
            @error('url_link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-6">
            <label for="screenshot" class="form-label">Screenshot</label>
            <div class="input-group">
                <input type="file" id="screenshot" name="screenshot" class="form-control @error('screenshot') is-invalid @enderror">

            </div>
            <small class="text-muted">File berupa jpg, png, dan pdf dengan maksimum ukuran 5MB</small>
            @error('screenshot')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
    <div class="col-md-6">
    <label for="screenshot" class="form-label">Pasal</label>
            <div id="pasalContainer">
                <div class="pasal-item">
                    <select id="pasal" name="pasal[]" class="form-control form-control-select @error('pasal') is-invalid @enderror">
                        <option value="">Pilih Pasal</option>
                        <option value="Pasal 27 Ayat 3" {{ old('pasal.0') == 'Pasal 27 Ayat 3' ? 'selected' : '' }}>Pasal 27 Ayat 3</option>
                        <option value="Pasal 28 Ayat 2" {{ old('pasal.0') == 'Pasal 28 Ayat 2' ? 'selected' : '' }}>Pasal 28 Ayat 2</option>
                        <option value="Pasal 45 Ayat 1" {{ old('pasal.0') == 'Pasal 45 Ayat 1' ? 'selected' : '' }}>Pasal 45 Ayat 1</option>
                    </select>
                </div>
            </div>
            <button type="button" id="tambahPasal" class="btn btn-add mt-2">
                                <i class="fas fa-plus"></i> Tambah Pasal
                            </button>
            <small class="text-muted d-block">Maksimal penambahan adalah 10 pasal</small>
            @error('pasal.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-3">
            <div class="dropdown">
                <button id="tambahUrlBtn" type="button" class="btn btn-add">
                    <i class="fas fa-plus"></i> Tambah URL
                </button>
                <div id="tambahUrlOptions" class="dropdown-menu">
                    <a href="#" class="dropdown-item" id="tambahUrlManual">Manual</a>
                    <a href="#" class="dropdown-item" id="tambahUrlCsv">CSV</a>
                </div>
            </div>
        </div>
            
        </div>
        <div class="col-md-6">
        <label for="platform" class="form-label">Deskripsi Konten</label>
            <textarea id="deskripsiKonten" name="deskripsi_konten" class="form-control @error('deskripsi_konten') is-invalid @enderror" style="height: 100px;" placeholder="Deskripsi Konten"></textarea>
            @error('deskripsi_konten')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- Tambahkan div untuk URL 2 (awalnya disembunyikan) -->
<div id="url2Container" style="display: none;" class="mt-3">
<label for="platform" class="form-label">URL 2</label>
    <div class="row">
        <div class="col-md-6">
            <label for="platform2" class="form-label">Platform</label>
            <select id="platform2" name="platform2" class="form-control form-control-select">
                <option value="">Pilih Platform</option>
                <option value="Facebook">Facebook</option>
                <option value="Instagram">Instagram</option>
                <option value="Twitter">Twitter</option>
                <option value="TikTok">TikTok</option>
                <option value="YouTube">YouTube</option>
                <option value="WhatsApp">WhatsApp</option>
                <option value="Telegram">Telegram</option>
                <option value="Website">Website</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="urlLink2" class="form-label">URL Link</label>
            <input type="url" id="urlLink2" name="url_link2" class="form-control" placeholder="URL Link">
        </div>
    </div>
    
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="screenshot2" class="form-label">Screenshot</label>
            <div class="input-group">
                <input type="file" id="screenshot2" name="screenshot2" class="form-control">
            </div>
            <small class="text-muted">File berupa jpg, png, dan pdf dengan maksimum ukuran 5MB</small>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <label for="pasal2" class="form-label">Pasal</label>
            <div id="pasalContainer2">
                <div class="pasal-item">
                    <select id="pasal2" name="pasal2[]" class="form-control form-control-select">
                        <option value="">Pilih Pasal</option>
                        <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                        <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                        <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                    </select>
                </div>
            </div>
            <button type="button" id="tambahPasal2" class="btn btn-add mt-2">
                <i class="fas fa-plus"></i> Tambah Pasal
            </button>
            <small class="text-muted d-block">Maksimal penambahan adalah 10 pasal</small>
        </div>
        <div class="col-md-6">
            <label for="deskripsiKonten2" class="form-label">Deskripsi Konten</label>
            <textarea id="deskripsiKonten2" name="deskripsi_konten2" class="form-control" style="height: 100px;" placeholder="Deskripsi Konten"></textarea>
        </div>
    </div>
</div>

<!-- Tambahkan div untuk CSV upload (awalnya disembunyikan) -->
<div id="csvContainer" style="display: none;" class="mt-3">
    <h5 style="font-weight: bold;">Upload CSV</h5>
    <div class="row">
        <div class="col-md-6">
            <label for="csvFile" class="form-label">File CSV</label>
            <input type="file" id="csvFile" name="csv_file" class="form-control" accept=".csv">
            <small class="text-muted">Upload file CSV dengan format yang sesuai</small>
        </div>
       
    </div>
</div>

            <!-- Footer Buttons -->
            <div class="form-footer">
                <button type="submit" name="action" value="draft" class="btn btn-warning">Simpan sebagai Draft</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                <button type="submit" name="action" value="pending" class="btn btn-success">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Display SweetAlert for file upload errors
    document.addEventListener('DOMContentLoaded', function() {
    
    // Menangani reset button
    const resetButton = document.querySelector('button[type="reset"]');
    const formElement = document.querySelector('form[action*="aduan.store"]');
    
    if (resetButton && formElement) {
        resetButton.addEventListener('click', function(event) {
            // Mencegah perilaku default
            event.preventDefault();
            
            // Konfirmasi reset form
            Swal.fire({
                title: 'Reset form?',
                text: "Semua data yang telah diisi akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, reset',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Reset form dengan pendekatan berbeda
                    
                    // Reset semua input text, textarea, dan select
                    const textInputs = formElement.querySelectorAll('input[type="text"], input[type="url"], textarea');
                    textInputs.forEach(input => {
                        input.value = '';
                    });
                    
                    // Reset semua select ke opsi default
                    const selectElements = formElement.querySelectorAll('select');
                    selectElements.forEach(select => {
                        select.selectedIndex = 0;
                    });
                    
                    // Reset file inputs dengan cara khusus
                    const fileInputs = formElement.querySelectorAll('input[type="file"]');
                    fileInputs.forEach(fileInput => {
                        // Membuat element file input baru untuk menggantikan yang lama
                        const newFileInput = document.createElement('input');
                        newFileInput.type = 'file';
                        newFileInput.className = fileInput.className;
                        newFileInput.name = fileInput.name;
                        newFileInput.id = fileInput.id;
                        if (fileInput.multiple) newFileInput.multiple = true;
                        
                        // Mengganti file input lama dengan yang baru
                        fileInput.parentNode.replaceChild(newFileInput, fileInput);
                    });
                    
                    // Reset validasi visual
                    const invalidFields = formElement.querySelectorAll('.is-invalid');
                    invalidFields.forEach(field => {
                        field.classList.remove('is-invalid');
                    });
                    
                    // Sembunyikan pesan error
                    const errorMessages = formElement.querySelectorAll('.invalid-feedback');
                    errorMessages.forEach(message => {
                        message.style.display = 'none';
                    });
                    
                    // Sembunyikan alert error jika ada
                    const alertError = document.querySelector('.alert-danger');
                    if (alertError) {
                        alertError.style.display = 'none';
                    }

                    // Reset pasal container to a single item
                    const pasalContainer = document.getElementById('pasalContainer');
                    if (pasalContainer) {
                        pasalContainer.innerHTML = `
                            <div class="pasal-item">
                                <select name="pasal[]" class="form-control form-control-select">
                                    <option value="">Pilih Pasal</option>
                                    <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                                    <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                                    <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                                </select>
                            </div>
                        `;
                    }
                    
                    Swal.fire(
                        'Reset',
                        'Form berhasil direset',
                        'success'
                    );
                }
            });
        });
    }
    
    // SweetAlert untuk error file upload
    @if($errors->has('surat_permintaan') || $errors->has('dokumen_pendukung.*') || $errors->has('screenshot'))
        Swal.fire({
            icon: 'error',
            title: 'Format File Tidak Sesuai',
            text: 'Beberapa file yang Anda unggah tidak sesuai format atau melebihi ukuran yang ditentukan.',
            confirmButtonText: 'OK',
        });
    @endif

    // Your existing JavaScript remains here
    const tambahDokumenBtn = document.getElementById('tambahDokumen');
    if (tambahDokumenBtn) {
        tambahDokumenBtn.addEventListener('click', function() {
            const container = document.getElementById('dokumenPendukungContainer');
            
            // Hitung jumlah input file yang sudah ada
            const existingInputs = container.querySelectorAll('input[type="file"]');
            
            // Batas maksimal 10 dokumen
            if (existingInputs.length < 10) {
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'dokumen_pendukung[]';
                newInput.className = 'form-control mt-2';
                container.appendChild(newInput);
                
                // Tampilkan pesan jika mencapai batas maksimal
                if (existingInputs.length + 1 >= 10) {
                    tambahDokumenBtn.disabled = true;
                }
            } else {
                alert('Maksimal 10 dokumen pendukung.');
            }
        });
    }
    
    // Handle tambah pasal functionality
    const tambahPasalBtn = document.getElementById('tambahPasal');
    if (tambahPasalBtn) {
        tambahPasalBtn.addEventListener('click', function() {
            const container = document.getElementById('pasalContainer');
            
            // Count existing pasal items
            const existingPasals = container.querySelectorAll('.pasal-item');
            
            // Maximum 10 pasal items
            if (existingPasals.length < 10) {
                const pasalItem = document.createElement('div');
                pasalItem.classList.add('pasal-item', 'mt-2');
                
                pasalItem.innerHTML = `
                    <select name="pasal[]" class="form-control form-control-select">
                        <option value="">Pilih Pasal</option>
                        <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                        <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                        <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                    </select>
                `;
                
                container.appendChild(pasalItem);
                
                // Add select-active event listeners to the new select
                const newSelect = pasalItem.querySelector('select');
                if (newSelect) {
                    // Event saat dropdown dibuka
                    newSelect.addEventListener('focus', function() {
                        this.classList.add('select-active');
                    });
                    
                    // Event saat dropdown ditutup
                    newSelect.addEventListener('blur', function() {
                        this.classList.remove('select-active');
                    });
                    
                    // Event saat dropdown berubah
                    newSelect.addEventListener('change', function() {
                        // Flash effect - hapus dahulu kelas active
                        this.classList.remove('select-active');
                        // Tunda sedikit untuk efek visual
                        setTimeout(() => {
                            this.blur(); // Tutup dropdown setelah memilih
                        }, 100);
                    });
                }
                
                // Disable the button if maximum reached
                if (existingPasals.length + 1 >= 10) {
                    tambahPasalBtn.disabled = true;
                }
            } else {
                alert('Maksimal 10 pasal.');
            }
        });
    }

    function triggerFileInput(button) {
        // Memastikan hanya satu elemen input file yang dipicu
        const fileInput = button.nextElementSibling; // Ambil elemen input file terkait
        if (fileInput) {
            fileInput.click();
        }
    }

    function updateFileName(input) {
        // Mengupdate nama file ke elemen input text
        if (input && input.files && input.files[0]) {
            const fileName = input.files[0].name || "Pilih file...";
            const textInput = input.previousElementSibling?.previousElementSibling;
            if (textInput) {
                textInput.value = fileName;
            }
        }
    }

    // Dropdown handler
    const dropdownButton = document.getElementById('dropdownButton');
    if (dropdownButton) {
        dropdownButton.addEventListener('click', function () {
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu) {
                dropdownMenu.style.display =
                    dropdownMenu.style.display === 'block' ? 'none' : 'block';
            }
        });

        document.addEventListener('click', function (e) {
            const button = document.getElementById('dropdownButton');
            const menu = document.getElementById('dropdownMenu');
            if (button && menu && !button.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    }

    const selectElements = document.querySelectorAll('.form-control-select');
    
    // Menambahkan event listener untuk masing-masing elemen select
    selectElements.forEach(function(select) {
        // Event saat dropdown dibuka
        select.addEventListener('focus', function() {
            this.classList.add('select-active');
        });
        
        // Event saat dropdown ditutup
        select.addEventListener('blur', function() {
            this.classList.remove('select-active');
        });
        
        // Event saat dropdown berubah
        select.addEventListener('change', function() {
            // Flash effect - hapus dahulu kelas active
            this.classList.remove('select-active');
            // Tunda sedikit untuk efek visual
            setTimeout(() => {
                this.blur(); // Tutup dropdown setelah memilih
            }, 100);
       
        });
    });

    // NEW CODE FOR TAMBAH URL BUTTON
    // Get reference to the button and dropdown elements
    const tambahUrlBtn = document.getElementById('tambahUrlBtn');
    const tambahUrlOptions = document.getElementById('tambahUrlOptions');
    const tambahUrlManual = document.getElementById('tambahUrlManual');
    const tambahUrlCsv = document.getElementById('tambahUrlCsv');
    const url2Container = document.getElementById('url2Container');
    const csvContainer = document.getElementById('csvContainer');
    
    // Show dropdown when clicking the "Tambah URL" button
    if (tambahUrlBtn) {
        tambahUrlBtn.addEventListener('click', function(e) {
            e.preventDefault();
            tambahUrlOptions.style.display = tambahUrlOptions.style.display === 'block' ? 'none' : 'block';
        });
    }
    
    // Handle "Manual" option
    if (tambahUrlManual) {
    tambahUrlManual.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Update the URL2 container to include card class if it doesn't have it
        if (url2Container && !url2Container.classList.contains('card')) {
            url2Container.classList.add('card');
        }
        
        url2Container.style.display = 'block';
        csvContainer.style.display = 'none';
        tambahUrlOptions.style.display = 'none';
    });
}
    
    // Handle "CSV" option
    if (tambahUrlCsv) {
    tambahUrlCsv.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Ensure card class is applied
        if (csvContainer && !csvContainer.classList.contains('card')) {
            csvContainer.classList.add('card');
        }
        
        csvContainer.style.display = 'block';
        url2Container.style.display = 'none';
        tambahUrlOptions.style.display = 'none';
    });
}
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (tambahUrlBtn && tambahUrlOptions && 
            !tambahUrlBtn.contains(e.target) && 
            !tambahUrlOptions.contains(e.target)) {
            tambahUrlOptions.style.display = 'none';
        }
    });
    
    // Handle "Tambah Pasal" in URL 2 section
    const tambahPasal2Btn = document.getElementById('tambahPasal2');
    if (tambahPasal2Btn) {
        tambahPasal2Btn.addEventListener('click', function() {
            const container = document.getElementById('pasalContainer2');
            
            // Count existing pasal items
            const existingPasals = container.querySelectorAll('.pasal-item');
            
            // Maximum 10 pasal items
            if (existingPasals.length < 10) {
                const pasalItem = document.createElement('div');
                pasalItem.classList.add('pasal-item', 'mt-2');
                
                pasalItem.innerHTML = `
                    <select name="pasal2[]" class="form-control form-control-select">
                        <option value="">Pilih Pasal</option>
                        <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                        <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                        <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                    </select>
                `;
                
                container.appendChild(pasalItem);
                
                // Add select-active event listeners to the new select
                const newSelect = pasalItem.querySelector('select');
                if (newSelect) {
                    // Event when dropdown opens
                    newSelect.addEventListener('focus', function() {
                        this.classList.add('select-active');
                    });
                    
                    // Event when dropdown closes
                    newSelect.addEventListener('blur', function() {
                        this.classList.remove('select-active');
                    });
                    
                    // Event when dropdown value changes
                    newSelect.addEventListener('change', function() {
                        // Flash effect - remove active class
                        this.classList.remove('select-active');
                        // Slight delay for visual effect
                        setTimeout(() => {
                            this.blur(); // Close dropdown after selection
                        }, 100);
                    });
                }
                
                // Disable the button if maximum reached
                if (existingPasals.length + 1 >= 10) {
                    tambahPasal2Btn.disabled = true;
                }
            } else {
                alert('Maksimal 10 pasal.');
            }
        });
    }
    
    // Handle CSV template download
    const downloadTemplate = document.getElementById('downloadTemplate');
    if (downloadTemplate) {
        downloadTemplate.addEventListener('click', function(e) {
            e.preventDefault();
            // Here you would typically trigger a download
            // This is a placeholder - you would need server-side code to actually generate the CSV
            alert('Template CSV akan diunduh.');
            // Alternatively, you could create a simple CSV on the fly:
            /*
 const csvContent = "data:text/csv;charset=utf-8,platform,url_link,pasal,deskripsi_konten\nFacebook,https://facebook.com/example,Pasal 27 Ayat 3,Deskripsi konten\n";
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "template_url.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            */
        });
    }
    
    // Also reset URL 2 and CSV containers when form is reset
    if (resetButton && formElement) {
        const originalResetHandler = resetButton.onclick;
        resetButton.addEventListener('click', function() {
            if (url2Container) {
                url2Container.style.display = 'none';
            }
            
            if (csvContainer) {
                csvContainer.style.display = 'none';
            }
            
            // Reset pasal container2 to a single item
            const pasalContainer2 = document.getElementById('pasalContainer2');
            if (pasalContainer2) {
                pasalContainer2.innerHTML = `
                    <div class="pasal-item">
                        <select name="pasal2[]" class="form-control form-control-select">
                            <option value="">Pilih Pasal</option>
                            <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                            <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                            <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                        </select>
                    </div>
                `;
            }
            
            // Re-enable tambah pasal buttons
            if (tambahPasalBtn) {
                tambahPasalBtn.disabled = false;
            }
            
            if (tambahPasal2Btn) {
                tambahPasal2Btn.disabled = false;
            }
        });
    }
});
</script>