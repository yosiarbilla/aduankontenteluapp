@extends('layouts.app')

@section('isi')
@php
    // Set variable di sini
    $hideSidebar = true;
    $hideToggle = true;

    // Decode url_data JSON menjadi array
    $urlData = json_decode($aduan->url_data, true);
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
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        position: relative;
        left: 0;
        right: 0;
        border-radius: 5px;
    }

    .form-footer .btn {
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        margin-left: 10px;
    }

    .form-footer .btn:first-child {
        margin-left: 0;
    }

    .form-footer .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }

    .form-footer .btn-success:hover {
        background-color: #218838;
    }

    .form-footer .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
    }

    .form-footer .btn-primary:hover {
        background-color: #0069d9;
    }

    .form-footer .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
        margin-left: 0;
    }

    .form-footer .btn-secondary:hover {
        background-color: #5a6268;
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
    
    .platform-section {
        border: 1px solid #e3e3e3;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #fafafa;
    }
    
    .platform-section h6 {
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }
    
    .pasal-item {
        margin-bottom: 10px;
    }
    
    .existing-file {
        background-color: #f8f8f8;
        padding: 8px 12px;
        border-radius: 4px;
        margin-bottom: 10px;
        display: block;
    }
    
    .existing-file span {
        display: block;
        word-break: break-all;
        overflow-wrap: break-word;
    }
    
    .existing-file a {
        color: #28a745;
        text-decoration: none;
        word-break: break-all;
        overflow-wrap: break-word;
        display: inline-block;
        max-width: 100%;
    }
    
    .existing-file a:hover {
        text-decoration: underline;
    }
    
    .row-gap {
        row-gap: 15px;
    }

    /* Mengatur tampilan preview screenshot */
    img[alt="Screenshot"] {
        max-width: 100%;
        object-fit: contain;
        max-height: 200px;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: block;
    }
</style>

<div class="content">
    <div class="container mt-4">
        <a href="{{ route('aduan.show', $aduan->id) }}" class="back-button">
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

        <form id="editForm" action="{{ route('aduan.update', $aduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Kategori -->
            <div class="card">
                <h5 style="font-weight: bold;">Kategori</h5>
                <div class="row row-gap">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control form-control-select @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Konten Negatif" {{ old('kategori', $aduan->kategori) == 'Konten Negatif' ? 'selected' : '' }}>Konten Negatif</option>
                            <option value="Penipuan" {{ old('kategori', $aduan->kategori) == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                            <option value="Terorisme" {{ old('kategori', $aduan->kategori) == 'Terorisme' ? 'selected' : '' }}>Terorisme</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="prioritas" class="form-label">Prioritas</label>
                        <select id="prioritas" name="prioritas" class="form-control form-control-select @error('prioritas') is-invalid @enderror" required>
                            <option value="Normal" {{ old('prioritas', $aduan->prioritas) == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Urgent" {{ old('prioritas', $aduan->prioritas) == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="High" {{ old('prioritas', $aduan->prioritas) == 'High' ? 'selected' : '' }}>High</option>
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
                    <div class="col-12 col-md-6">
                        <label for="nomorSurat" class="form-label">Nomor Surat</label>
                        <input type="text" id="nomorSurat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Nomor Surat" value="{{ old('nomor_surat', $aduan->nomor_surat) }}" required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="suratPermintaan" class="form-label">Surat Permintaan</label>
                        @if($aduan->surat_permintaan)
                            <div class="existing-file">
                                <span>File saat ini: <a href="{{ asset('storage/' . $aduan->surat_permintaan) }}" target="_blank">{{ basename($aduan->surat_permintaan) }}</a></span>
                            </div>
                        @endif
                        <input type="file" id="suratPermintaan" name="surat_permintaan" class="form-control @error('surat_permintaan') is-invalid @enderror">
                        @error('surat_permintaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row row-gap">
                    <div class="col-12 col-md-6">
                        <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                        <div id="dokumenPendukungContainer">
                            @if($aduan->dokumen_pendukung)
                                @php
                                    $dokumenPendukung = json_decode($aduan->dokumen_pendukung, true);
                                @endphp
                                @foreach($dokumenPendukung as $doc)
                                    <div class="existing-file">
                                        <span>File: <a href="{{ asset('storage/' . $doc) }}" target="_blank">{{ basename($doc) }}</a></span>
                                    </div>
                                @endforeach
                            @endif
                            <input type="file" id="dokumenPendukung" name="dokumen_pendukung[]" class="form-control @error('dokumen_pendukung.*') is-invalid @enderror">
                        </div>
                        <button type="button" id="tambahDokumen" class="btn btn-add mt-2">
                            <i class="fas fa-plus"></i> Tambah Dokumen
                        </button>
                        <small class="text-muted d-block mt-1">Maksimal 10 dokumen berukuran 2 MB, format: jpg, png, doc, pdf</small>
                        @error('dokumen_pendukung.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                        <textarea id="catatanTambahan" name="catatan_tambahan" class="form-control @error('catatan_tambahan') is-invalid @enderror" rows="5">{{ old('catatan_tambahan', $aduan->catatan_tambahan) }}</textarea>
                        @error('catatan_tambahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Platform -->
            <div class="card">
                <h5 style="font-weight: bold;">Platform</h5>
                @if(isset($urlData) && is_array($urlData) && count($urlData) > 0)
                    @foreach($urlData as $index => $url)
                        <div class="platform-section">
                            <h6>URL {{ $index + 1 }}</h6>
                            <div class="row row-gap">
                                <div class="col-12 col-md-6">
                                    <label for="platform{{ $index }}" class="form-label">Platform</label>
                                    <select id="platform{{ $index }}" name="platform[]" class="form-control form-control-select @error('platform.' . $index) is-invalid @enderror">
                                        <option value="">Pilih Platform</option>
                                        <option value="Facebook" {{ old('platform.' . $index, $url['platform'] ?? '') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="Instagram" {{ old('platform.' . $index, $url['platform'] ?? '') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                        <option value="Twitter" {{ old('platform.' . $index, $url['platform'] ?? '') == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                        <option value="TikTok" {{ old('platform.' . $index, $url['platform'] ?? '') == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                                        <option value="YouTube" {{ old('platform.' . $index, $url['platform'] ?? '') == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                                    </select>
                                    @error('platform.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="urlLink{{ $index }}" class="form-label">URL Link</label>
                                    <input type="url" id="urlLink{{ $index }}" name="url_link[]" class="form-control @error('url_link.' . $index) is-invalid @enderror" placeholder="URL Link" value="{{ old('url_link.' . $index, $url['url_link'] ?? '') }}">
                                    @error('url_link.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row row-gap">
                                <div class="col-12 col-md-6">
                                    <label for="screenshot{{ $index }}" class="form-label">Screenshot</label>
                                    @if(isset($url['screenshot']))
                                        <div class="existing-file">
                                            <span>Screenshot saat ini:</span>
                                        </div>
                                        <img src="{{ asset('storage/' . $url['screenshot']) }}" alt="Screenshot" class="mt-2 mb-3" style="width: 100%; max-height: 150px; border-radius: 4px;">
                                    @endif
                                    <input type="file" id="screenshot{{ $index }}" name="screenshot[]" class="form-control @error('screenshot.' . $index) is-invalid @enderror">
                                    @error('screenshot.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="deskripsiKonten{{ $index }}" class="form-label">Deskripsi Konten</label>
                                    <textarea id="deskripsiKonten{{ $index }}" name="deskripsi_konten[]" class="form-control @error('deskripsi_konten.' . $index) is-invalid @enderror" rows="5">{{ old('deskripsi_konten.' . $index, $url['deskripsi_konten'] ?? '') }}</textarea>
                                    @error('deskripsi_konten.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row row-gap">
                                <div class="col-12">
                                    <label for="pasal{{ $index }}" class="form-label">Pasal</label>
                                    <div id="pasalContainer{{ $index }}">
                                        @if(isset($url['pasal']) && is_array($url['pasal']))
                                            @foreach($url['pasal'] as $pasalIndex => $pasalValue)
                                                <div class="pasal-item">
                                                    <select name="pasal[{{ $index }}][]" class="form-control form-control-select">
                                                        <option value="">Pilih Pasal</option>
                                                        <option value="Pasal 27 Ayat 3" {{ $pasalValue == 'Pasal 27 Ayat 3' ? 'selected' : '' }}>Pasal 27 Ayat 3</option>
                                                        <option value="Pasal 28 Ayat 2" {{ $pasalValue == 'Pasal 28 Ayat 2' ? 'selected' : '' }}>Pasal 28 Ayat 2</option>
                                                        <option value="Pasal 45 Ayat 1" {{ $pasalValue == 'Pasal 45 Ayat 1' ? 'selected' : '' }}>Pasal 45 Ayat 1</option>
                                                    </select>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="pasal-item">
                                                <select name="pasal[{{ $index }}][]" class="form-control form-control-select">
                                                    <option value="">Pilih Pasal</option>
                                                    <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                                                    <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                                                    <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-add tambah-pasal mt-2" data-index="{{ $index }}">
                                        <i class="fas fa-plus"></i> Tambah Pasal
                                    </button>
                                    <small class="text-muted d-block mt-1">Maksimal 10 pasal</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Tidak ada data platform. Silakan simpan dahulu untuk menambahkan data platform.</p>
                @endif
            </div>

            <!-- Footer Buttons -->
            <div class="form-footer">
               
                <div class="ms-auto">
                    <button type="submit" name="action" value="save" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle form select styling
        const selectElements = document.querySelectorAll('.form-control-select');
        
        selectElements.forEach(select => {
            select.addEventListener('focus', function() {
                this.classList.add('select-active');
            });
            
            select.addEventListener('blur', function() {
                this.classList.remove('select-active');
            });
        });
        
        // Handle tambah dokumen functionality
        const tambahDokumenBtn = document.getElementById('tambahDokumen');
        if (tambahDokumenBtn) {
            tambahDokumenBtn.addEventListener('click', function () {
                const container = document.getElementById('dokumenPendukungContainer');
                const existingInputs = container.querySelectorAll('input[type="file"]');
                if (existingInputs.length < 10) {
                    const newInput = document.createElement('input');
                    newInput.type = 'file';
                    newInput.name = 'dokumen_pendukung[]';
                    newInput.className = 'form-control mt-2';
                    container.appendChild(newInput);
                    if (existingInputs.length + 1 >= 10) {
                        tambahDokumenBtn.disabled = true;
                    }
                } else {
                    alert('Maksimal 10 dokumen pendukung.');
                }
            });
        }

        // Handle tambah pasal functionality
        document.querySelectorAll('.tambah-pasal').forEach(button => {
            button.addEventListener('click', function () {
                const index = this.dataset.index;
                const container = document.getElementById(`pasalContainer${index}`);
                const existingPasals = container.querySelectorAll('.pasal-item');
                if (existingPasals.length < 10) {
                    const pasalItem = document.createElement('div');
                    pasalItem.classList.add('pasal-item');
                    pasalItem.innerHTML = `
                        <select name="pasal[${index}][]" class="form-control form-control-select">
                            <option value="">Pilih Pasal</option>
                            <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                            <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                            <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                        </select>
                    `;
                    container.appendChild(pasalItem);
                    
                    // Add event listeners to the new select element
                    const newSelect = pasalItem.querySelector('select');
                    newSelect.addEventListener('focus', function() {
                        this.classList.add('select-active');
                    });
                    
                    newSelect.addEventListener('blur', function() {
                        this.classList.remove('select-active');
                    });
                    
                    if (existingPasals.length + 1 >= 10) {
                        this.disabled = true;
                    }
                } else {
                    alert('Maksimal 10 pasal.');
                }
            });
        });

        // Confirm before submitting
        document.getElementById('editForm').addEventListener('submit', function(e) {
            // If needed, add custom submission logic here
        });
    });
</script>
@endsection