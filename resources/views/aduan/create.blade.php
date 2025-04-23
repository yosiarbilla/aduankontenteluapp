@extends('layouts.app')

@section('isi')
@php
    // Set variable di sini
    $hideSidebar = true;
    $hideToggle = true; 
@endphp
<style>
    .container {
        max-width: 100%;
        padding: 0 15px;
    }

    @media (min-width: 768px) {
        .container {
            padding-left: 30px;
            padding-right: 30px;
        }
    }

    @media (min-width: 992px) {
        .container {
            padding-left: 60px;
            padding-right: 60px;
        }
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
    
    /* Custom styles for dropdown search */
    .kategori-search {
        border-radius: 5px;
        border: 1px solid #ced4da;
        margin: 8px;
        width: calc(100% - 16px);
    }
    
    .kategori-search:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        outline: none;
    }
    
    .dropdown-item-highlight {
        background-color: #e9ecef;
    }
    
    .dropdown-menu {
        max-height: 350px;
        overflow-y: auto;
        width: 100%;
    }
    
    .dropdown-options {
        margin-top: 8px;
    }
    
    .dropdown-item {
        padding: 8px 16px;
        cursor: pointer;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    
    .no-results {
        padding: 8px 16px;
        color: #6c757d;
        font-style: italic;
    }
    
    .select-dropdown {
        position: relative;
    }
    
    .select-dropdown .dropdown-menu {
        margin-top: 0;
        width: 100%;
        border-radius: 0 0 5px 5px;
    }

    /* Styles for select dropdowns with search */
    .select-dropdown {
        position: relative;
    }
    
    .select-dropdown select {
        cursor: pointer;
    }
    
    .select-dropdown select.select-active {
        border-color: #7367f0;
    }
    
    .kategori-search {
        margin: 8px;
        width: calc(100% - 16px);
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 6px 10px;
    }
    
    .dropdown-menu {
        position: absolute;
        width: 100%;
        max-height: 300px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    
    .dropdown-options {
        max-height: 250px;
        overflow-y: auto;
    }
    
    .dropdown-item {
        padding: 8px 16px;
        cursor: pointer;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    
    .dropdown-item-highlight {
        background-color: #f0f0f0;
    }
    
    .no-results {
        padding: 10px;
        text-align: center;
        color: #6c757d;
        font-style: italic;
    }

    /* Custom Dropdown Styling */
    .custom-dropdown {
        position: relative;
        width: 100%;
    }

    .custom-select {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        appearance: none;
        cursor: pointer;
    }

    .custom-select.selected {
        color: #212529;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        width: 100%;
        max-height: 300px;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: 0.25rem;
        overflow-y: auto;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .kategori-search {
        width: calc(100% - 1rem);
        margin: 0 0.5rem 0.5rem;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .kategori-search:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .dropdown-item {
        display: block;
        width: 100%;
        padding: 0.25rem 1rem;
        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
        cursor: pointer;
    }

    .dropdown-item:hover, .dropdown-item:focus {
        color: #16181b;
        text-decoration: none;
        background-color: #f8f9fa;
    }

    .no-results {
        padding: 0.5rem 1rem;
        color: #6c757d;
        font-style: italic;
        text-align: center;
    }

    @media (max-width: 768px) {
        .dropdown-menu {
            max-height: 250px;
        }
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
                    <div class="col-12 col-md-6">
                        <label for="kategori" class="form-label">Kategori Aduan *</label>
                        <div class="select-dropdown">
                            <select class="form-control" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Pelanggaran Hak atas Kekayaan Intelektual (HKI)">Pelanggaran Hak atas Kekayaan Intelektual (HKI)</option>
                                <option value="Terorisme/Radikalisme">Terorisme/Radikalisme</option>
                                <option value="Provokasi SARA">Provokasi SARA</option>
                                <option value="Penyebaran berita bohong (hoax)">Penyebaran berita bohong (hoax)</option>
                                <option value="Konten bermuatan asusila">Konten bermuatan asusila</option>
                                <option value="Pornografi Anak">Pornografi Anak</option>
                                <option value="Penghinaan, pencemaran nama baik">Penghinaan, pencemaran nama baik</option>
                                <option value="Perjudian">Perjudian</option>
                                <option value="Penipuan online">Penipuan online</option>
                                <option value="Penyalahgunaan data pribadi">Penyalahgunaan data pribadi</option>
                                <option value="Kerentanan sistem">Kerentanan sistem</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="prioritas" class="form-label">Prioritas</label>
                        <select id="prioritas" class="form-control form-control-select" disabled>
                            <option value="Normal">Normal</option>
                            <option value="Urgent">Urgent</option>
                            <option value="High">High</option>
                        </select>
                        <input type="hidden" name="prioritas" id="prioritasHidden" value="Normal">
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
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <label for="nomorSurat" class="form-label">Nomor Surat *</label>
                        <input type="text" id="nomorSurat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Nomor Surat" value="{{ old('nomor_surat') }}">
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="suratPermintaan" class="form-label">Surat Permintaan *</label>
                        <input type="file" id="suratPermintaan" name="surat_permintaan" class="form-control @error('surat_permintaan') is-invalid @enderror">
                        <small class="text-muted">Maksimal berukuran 1 MB, format: pdf</small>
                        @error('surat_permintaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Tambahkan div container untuk dokumen pendukung -->
                <div class="row row-gap mt-3">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
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
                    <div class="col-12 col-md-6">
                        <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                        <textarea id="catatanTambahan" name="catatan_tambahan" class="form-control @error('catatan_tambahan') is-invalid @enderror" rows="5">{{ old('catatan_tambahan') }}</textarea>
                        @error('catatan_tambahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card">
    <h5 style="font-weight: bold;">Platform *</h5>
    <label for="platform" class="form-label">URL 1</label>
    <div class="row">
        <div class="col-md-6">
            <label for="platform" class="form-label">Platform *</label>
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
            <label for="urlLink" class="form-label">URL Link *</label>
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
    <label for="pasal" class="form-label">Pasal</label>
            <div id="pasalContainer">
                <div class="pasal-item">
                    <input type="text" id="pasal" name="pasal[]" class="form-control @error('pasal') is-invalid @enderror" placeholder="Masukkan Pasal">
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
                    <input type="text" id="pasal2" name="pasal2[]" class="form-control" placeholder="Masukkan Pasal">
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
document.addEventListener('DOMContentLoaded', function() {
    // Setup for kategori dropdown
    const selectElement = document.querySelector('select[name="kategori"]');
    const prioritasElement = document.getElementById('prioritas');
    const prioritasHidden = document.getElementById('prioritasHidden');
    
    // Set prioritas based on kategori selection
    if (selectElement && prioritasElement && prioritasHidden) {
        selectElement.addEventListener('change', function() {
            if (this.value === 'Terorisme/Radikalisme') {
                prioritasElement.value = 'Urgent';
                prioritasHidden.value = 'Urgent';
            } else {
                prioritasElement.value = 'Normal';
                prioritasHidden.value = 'Normal';
            }
        });
        
        // Initialize prioritas based on initial kategori value
        if (selectElement.value === 'Terorisme/Radikalisme') {
            prioritasElement.value = 'Urgent';
            prioritasHidden.value = 'Urgent';
        } else if (selectElement.value) {
            prioritasElement.value = 'Normal';
            prioritasHidden.value = 'Normal';
        }
    }
    
    // Setup for kategori dropdown
    if (!selectElement) return;
    
    // Create custom dropdown elements
    const customDropdown = document.createElement('div');
    customDropdown.className = 'custom-dropdown';
    
    const customSelect = document.createElement('div');
    customSelect.className = 'custom-select';
    customSelect.textContent = 'Pilih Kategori';
    
    const dropdownMenu = document.createElement('div');
    dropdownMenu.className = 'dropdown-menu';
    
    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.className = 'kategori-search';
    searchInput.placeholder = 'Cari kategori...';
    
    // Insert the custom dropdown
    selectElement.parentNode.insertBefore(customDropdown, selectElement);
    customDropdown.appendChild(customSelect);
    customDropdown.appendChild(dropdownMenu);
    dropdownMenu.appendChild(searchInput);
    
    // Hide the original select
    selectElement.style.display = 'none';
    
    // Get all options
    const options = Array.from(selectElement.options);
    
    // Function to populate dropdown options
    function populateOptions(filter = '') {
        // Clear existing options
        const items = dropdownMenu.querySelectorAll('.dropdown-item');
        items.forEach(item => item.remove());
        
        // Remove previous no-results message if any
        const noResults = dropdownMenu.querySelector('.no-results');
        if (noResults) noResults.remove();
        
        // Filter options based on search input
        const lowerFilter = filter.toLowerCase();
        const filteredOptions = options.filter(option => 
            option.textContent.toLowerCase().includes(lowerFilter)
        );
        
        // Display message if no results
        if (filteredOptions.length === 0) {
            const noResultsMsg = document.createElement('div');
            noResultsMsg.className = 'no-results';
            noResultsMsg.textContent = 'Tidak ada hasil yang cocok';
            dropdownMenu.appendChild(noResultsMsg);
            return;
        }
        
        // Add filtered options to dropdown
        filteredOptions.forEach(option => {
            const item = document.createElement('div');
            item.className = 'dropdown-item';
            item.textContent = option.textContent;
            item.dataset.value = option.value;
            
            item.addEventListener('click', function() {
                // Update the original select
                selectElement.value = option.value;
                
                // Update custom select display
                customSelect.textContent = option.textContent;
                customSelect.classList.add('selected');
                
                // Close dropdown
                dropdownMenu.style.display = 'none';
                
                // Trigger change event on select
                const event = new Event('change');
                selectElement.dispatchEvent(event);
            });
            
            dropdownMenu.appendChild(item);
        });
    }
    
    // Toggle dropdown on click
    customSelect.addEventListener('click', function(e) {
        e.stopPropagation();
        
        const isVisible = dropdownMenu.style.display === 'block';
        dropdownMenu.style.display = isVisible ? 'none' : 'block';
        
        if (!isVisible) {
            searchInput.focus();
            populateOptions();
        }
    });
    
    // Filter options on search input
    searchInput.addEventListener('input', function() {
        populateOptions(this.value);
    });
    
    // Prevent clicks inside dropdown from closing it
    dropdownMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        dropdownMenu.style.display = 'none';
    });
    
    // Set initial selection if there's a value
    if (selectElement.value) {
        const selectedOption = options.find(option => option.value === selectElement.value);
        if (selectedOption) {
            customSelect.textContent = selectedOption.textContent;
            customSelect.classList.add('selected');
        }
    }
    
    // Handle adding more pasal fields
    const tambahPasalBtn = document.getElementById('tambahPasal');
    const pasalContainer = document.getElementById('pasalContainer');
    
    if (tambahPasalBtn && pasalContainer) {
        tambahPasalBtn.addEventListener('click', function() {
            // Check if we've reached the maximum of 10 pasal
            const pasalItems = pasalContainer.querySelectorAll('.pasal-item');
            if (pasalItems.length >= 10) {
                alert('Maksimal penambahan adalah 10 pasal');
                return;
            }
            
            // Create a new pasal input
            const newPasalItem = document.createElement('div');
            newPasalItem.className = 'pasal-item mt-2';
            
            const newPasalInput = document.createElement('div');
            newPasalInput.className = 'd-flex';
            
            newPasalInput.innerHTML = `
                <input type="text" name="pasal[]" class="form-control" placeholder="Masukkan Pasal">
                <button type="button" class="btn btn-danger ms-2 hapus-pasal">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            newPasalItem.appendChild(newPasalInput);
            pasalContainer.appendChild(newPasalItem);
            
            // Add event listener to remove button
            const removeBtn = newPasalInput.querySelector('.hapus-pasal');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    pasalContainer.removeChild(newPasalItem);
                });
            }
        });
    }
    
    // Handle adding more pasal fields for URL 2
    const tambahPasalBtn2 = document.getElementById('tambahPasal2');
    const pasalContainer2 = document.getElementById('pasalContainer2');
    
    if (tambahPasalBtn2 && pasalContainer2) {
        tambahPasalBtn2.addEventListener('click', function() {
            // Check if we've reached the maximum of 10 pasal
            const pasalItems = pasalContainer2.querySelectorAll('.pasal-item');
            if (pasalItems.length >= 10) {
                alert('Maksimal penambahan adalah 10 pasal');
                return;
            }
            
            // Create a new pasal input
            const newPasalItem = document.createElement('div');
            newPasalItem.className = 'pasal-item mt-2';
            
            const newPasalInput = document.createElement('div');
            newPasalInput.className = 'd-flex';
            
            newPasalInput.innerHTML = `
                <input type="text" name="pasal2[]" class="form-control" placeholder="Masukkan Pasal">
                <button type="button" class="btn btn-danger ms-2 hapus-pasal">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            newPasalItem.appendChild(newPasalInput);
            pasalContainer2.appendChild(newPasalItem);
            
            // Add event listener to remove button
            const removeBtn = newPasalInput.querySelector('.hapus-pasal');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    pasalContainer2.removeChild(newPasalItem);
                });
            }
        });
    }
    
    // Handle URL and CSV container toggle
    const tambahUrlBtn = document.getElementById('tambahUrlBtn');
    const tambahUrlOptions = document.getElementById('tambahUrlOptions');
    const tambahUrlManual = document.getElementById('tambahUrlManual');
    const tambahUrlCsv = document.getElementById('tambahUrlCsv');
    const url2Container = document.getElementById('url2Container');
    const csvContainer = document.getElementById('csvContainer');
    
    if (tambahUrlBtn && tambahUrlOptions) {
        tambahUrlBtn.addEventListener('click', function(e) {
            e.preventDefault();
            tambahUrlOptions.style.display = tambahUrlOptions.style.display === 'block' ? 'none' : 'block';
        });
        
        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!tambahUrlBtn.contains(e.target) && !tambahUrlOptions.contains(e.target)) {
                tambahUrlOptions.style.display = 'none';
            }
        });
        
        // Handle dropdown options
        if (tambahUrlManual && tambahUrlCsv) {
            tambahUrlManual.addEventListener('click', function(e) {
                e.preventDefault();
                url2Container.style.display = 'block';
                csvContainer.style.display = 'none';
                tambahUrlOptions.style.display = 'none';
            });
            
            tambahUrlCsv.addEventListener('click', function(e) {
                e.preventDefault();
                url2Container.style.display = 'none';
                csvContainer.style.display = 'block';
                tambahUrlOptions.style.display = 'none';
            });
        }
    }
});
</script>