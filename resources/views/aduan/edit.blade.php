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

    .file-preview {
        margin-top: 10px;
        padding: 10px;
        border: 1px dashed #ddd;
        border-radius: 8px;
    }

    .file-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
    }
</style>

<div class="content">
    <div class="container mt-4">
        <a href="{{ route('aduan.index') }}" class="back-button">
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

        <form action="{{ route('aduan.update', $aduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Kategori -->
            <div class="card">
                <div class="row row-gap">
                    <h5 style="font-weight: bold;">Kategori</h5>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="kategori" name="kategori" class="form-control form-control-select @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Konten Negatif" {{ $aduan->kategori == 'Konten Negatif' ? 'selected' : '' }}>Konten Negatif</option>
                            <option value="Pelanggaran Hak Cipta" {{ $aduan->kategori == 'Pelanggaran Hak Cipta' ? 'selected' : '' }}>Pelanggaran Hak Cipta</option>
                            <option value="Penipuan Online" {{ $aduan->kategori == 'Penipuan Online' ? 'selected' : '' }}>Penipuan Online</option>
                            <option value="Penyebaran Hoax" {{ $aduan->kategori == 'Penyebaran Hoax' ? 'selected' : '' }}>Penyebaran Hoax</option>
                            <option value="Lainnya" {{ $aduan->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="prioritas" class="form-label">Prioritas <span class="text-danger">*</span></label>
                        <select id="prioritas" name="prioritas" class="form-control form-control-select @error('prioritas') is-invalid @enderror" required>
                            <option value="Normal" {{ $aduan->prioritas == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="High" {{ $aduan->prioritas == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Urgent" {{ $aduan->prioritas == 'Urgent' ? 'selected' : '' }}>Urgent</option>
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
                        <label for="nomor_surat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Nomor Surat" value="{{ $aduan->nomor_surat }}" required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="suratPermintaan" class="form-label">Surat Permintaan <span class="text-danger">*</span></label>
                        <input type="file" id="suratPermintaan" name="surat_permintaan" class="form-control @error('surat_permintaan') is-invalid @enderror">
                        <small class="text-muted">Maksimal berukuran 5 MB, format: pdf</small>
                        @error('surat_permintaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($aduan->surat_permintaan)
                            <div class="file-preview">
                                <p>File saat ini: 
                                    <a href="{{ asset('storage/'.$aduan->surat_permintaan) }}" target="_blank">Lihat Surat Permintaan</a>
                                    <small class="text-muted">(Unggah file baru untuk mengganti)</small>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                        <input type="file" id="dokumenPendukung" name="dokumen_pendukung[]" class="form-control @error('dokumen_pendukung.*') is-invalid @enderror" multiple>
                        <small class="text-muted">Maksimal 10 dokumen berukuran 5 MB, format: jpg, png, doc, pdf</small>
                        @error('dokumen_pendukung.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(!empty($aduan->dokumen_pendukung))
                            <div class="file-preview">
                                <p>File saat ini:</p>
                                <ul>
                                    @foreach($aduan->dokumen_pendukung as $dokumen)
                                        <li>
                                            <a href="{{ asset('storage/'.$dokumen) }}" target="_blank">
                                                {{ basename($dokumen) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <small class="text-muted">(Unggah file baru untuk mengganti semua dokumen pendukung)</small>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                        <textarea id="catatanTambahan" name="catatan_tambahan" class="form-control @error('catatan_tambahan') is-invalid @enderror" rows="5">{{ $aduan->catatan_tambahan }}</textarea>
                        @error('catatan_tambahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Platform dan URL -->
            <div class="card">
                <h5 style="font-weight: bold;">Platform</h5>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="platform" class="form-label">Platform</label>
                        <input type="text" id="platform" name="platform" class="form-control @error('platform') is-invalid @enderror" placeholder="Platform" value="{{ $aduan->platform }}">
                        @error('platform')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="urlLink" class="form-label">URL Link</label>
                        <input type="url" id="urlLink" name="url_link" class="form-control @error('url_link') is-invalid @enderror" placeholder="Masukkan URL" value="{{ $aduan->url_link }}">
                        @error('url_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Screenshot -->
            <div class="card">
                <h5 style="font-weight: bold;">Screenshot</h5>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="screenshot" class="form-label">Unggah Screenshot</label>
                        <input type="file" id="screenshot" name="screenshot" class="form-control @error('screenshot') is-invalid @enderror">
                        <small class="text-muted">Maksimal berukuran 5 MB, format: pdf, png</small>
                        @error('screenshot')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($aduan->screenshot)
                            <div class="file-preview">
                                <p>File saat ini:</p>
                                <img src="{{ asset('storage/'.$aduan->screenshot) }}" alt="Screenshot" width="200">
                                <small class="text-muted">(Unggah file baru untuk mengganti)</small>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsiKonten" class="form-label">Deskripsi Konten</label>
                        <textarea id="deskripsiKonten" name="deskripsi_konten" class="form-control @error('deskripsi_konten') is-invalid @enderror" rows="5">{{ $aduan->deskripsi_konten }}</textarea>
                        @error('deskripsi_konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="form-footer">
                <a href="{{ route('aduan.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" name="action" value="draft" class="btn btn-warning">
                    <i class="fas fa-save"></i> Simpan sebagai Draft
                </button>
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
    const formElement = document.querySelector('form[action*="aduan.update"]');
    
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
});
</script>