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
    :root {
        --primary-font: 'Plus Jakarta Sans', sans-serif;
        --primary-color: #3D3D3D;
        --border-color: #E3E3E3;
        --bg-color: #F8F9FA;
        --card-padding: 24px;
        --gap-standard: 16px;
        --section-gap: 20px;
        --row-gap: 12px;
    }
    body {
        background-color: var(--bg-color);
        font-family: var(--primary-font);
    }
    .container {
        position: relative;
        max-width: 800px;
        width: 100%;
        margin: 20px auto 20px;
        padding: 0 15px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 32px;
    }
    .detail-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: var(--card-padding);
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
    .btn-upload {
        border: 1px solid #28a745;
        background-color: white !important;
        color: #28a745;
        border-radius: 5px;
        padding: 8px 16px;
        text-align: center;
    }
    .btn-add {
        border: 1px solid #28a745;
        background-color: white;
        color: #28a745;
        border-radius: 5px;
        padding: 8px 16px;
        text-align: center;
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
    .form-footer .btn-primary {
        background-color: #0d6efd;
        border: none;
        color: #fff;
    }
    .form-footer .btn-primary:hover {
        background-color: #0b5ed7;
    }
</style>

<div class="container">
    <a href="{{ route('aduan.index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <form id="editForm" action="{{ route('aduan.update', $aduan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informasi Utama -->
        <div class="detail-card">
            <h5 style="font-weight: bold;">Informasi Utama</h5>
            <div class="row row-gap">
                <div class="col-md-6">
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
                <div class="col-md-6">
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
        <div class="detail-card">
            <h5 style="font-weight: bold;">Surat Permintaan dan Dokumen Pendukung</h5>
            <div class="row row-gap">
                <div class="col-md-6">
                    <label for="nomorSurat" class="form-label">Nomor Surat</label>
                    <input type="text" id="nomorSurat" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Nomor Surat" value="{{ old('nomor_surat', $aduan->nomor_surat) }}" required>
                    @error('nomor_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="suratPermintaan" class="form-label">Surat Permintaan</label>
                    <input type="file" id="suratPermintaan" name="surat_permintaan" class="form-control @error('surat_permintaan') is-invalid @enderror">
                    @if($aduan->surat_permintaan)
                        <small>File saat ini: <a href="{{ asset('storage/' . $aduan->surat_permintaan) }}" target="_blank">{{ basename($aduan->surat_permintaan) }}</a></small>
                    @endif
                    @error('surat_permintaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row row-gap">
                <div class="col-md-6">
                    <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                    <div id="dokumenPendukungContainer">
                        @if($aduan->dokumen_pendukung)
                            @php
                                $dokumenPendukung = json_decode($aduan->dokumen_pendukung, true);
                            @endphp
                            @foreach($dokumenPendukung as $doc)
                                <small><a href="{{ asset('storage/' . $doc) }}" target="_blank">{{ basename($doc) }}</a></small><br>
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
                <div class="col-md-6">
                    <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                    <textarea id="catatanTambahan" name="catatan_tambahan" class="form-control @error('catatan_tambahan') is-invalid @enderror" rows="5">{{ old('catatan_tambahan', $aduan->catatan_tambahan) }}</textarea>
                    @error('catatan_tambahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Platform -->
        <div class="detail-card">
            <h5 style="font-weight: bold;">Platform</h5>
            @if(isset($urlData) && is_array($urlData) && count($urlData) > 0)
                @foreach($urlData as $index => $url)
                    <div class="platform-section">
                        <h6>URL {{ $index + 1 }}</h6>
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="urlLink{{ $index }}" class="form-label">URL Link</label>
                                <input type="url" id="urlLink{{ $index }}" name="url_link[]" class="form-control @error('url_link.' . $index) is-invalid @enderror" placeholder="URL Link" value="{{ old('url_link.' . $index, $url['url_link'] ?? '') }}">
                                @error('url_link.' . $index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="screenshot{{ $index }}" class="form-label">Screenshot</label>
                                <input type="file" id="screenshot{{ $index }}" name="screenshot[]" class="form-control @error('screenshot.' . $index) is-invalid @enderror">
                                @if(isset($url['screenshot']))
                                    <img src="{{ asset('storage/' . $url['screenshot']) }}" alt="Screenshot" class="mt-2" style="width: 100%; max-height: 150px;">
                                @endif
                                @error('screenshot.' . $index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="pasal{{ $index }}" class="form-label">Pasal</label>
                                <div id="pasalContainer{{ $index }}">
                                    @if(isset($url['pasal']) && is_array($url['pasal']))
                                        @foreach($url['pasal'] as $pasalIndex => $pasalValue)
                                            <div class="pasal-item mt-2">
                                                <select name="pasal[{{ $index }}][]" class="form-control form-control-select">
                                                    <option value="">Pilih Pasal</option>
                                                    <option value="Pasal 27 Ayat 3" {{ $pasalValue == 'Pasal 27 Ayat 3' ? 'selected' : '' }}>Pasal 27 Ayat 3</option>
                                                    <option value="Pasal 28 Ayat 2" {{ $pasalValue == 'Pasal 28 Ayat 2' ? 'selected' : '' }}>Pasal 28 Ayat 2</option>
                                                    <option value="Pasal 45 Ayat 1" {{ $pasalValue == 'Pasal 45 Ayat 1' ? 'selected' : '' }}>Pasal 45 Ayat 1</option>
                                                </select>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="pasal-item mt-2">
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
                            <div class="col-md-6">
                                <label for="deskripsiKonten{{ $index }}" class="form-label">Deskripsi Konten</label>
                                <textarea id="deskripsiKonten{{ $index }}" name="deskripsi_konten[]" class="form-control @error('deskripsi_konten.' . $index) is-invalid @enderror" rows="5">{{ old('deskripsi_konten.' . $index, $url['deskripsi_konten'] ?? '') }}</textarea>
                                @error('deskripsi_konten.' . $index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada data platform.</p>
            @endif
        </div>

        <!-- Footer Buttons -->
        <div class="form-footer">
            <button type="submit" name="action" value="save" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                    pasalItem.classList.add('pasal-item', 'mt-2');
                    pasalItem.innerHTML = `
                        <select name="pasal[${index}][]" class="form-control form-control-select">
                            <option value="">Pilih Pasal</option>
                            <option value="Pasal 27 Ayat 3">Pasal 27 Ayat 3</option>
                            <option value="Pasal 28 Ayat 2">Pasal 28 Ayat 2</option>
                            <option value="Pasal 45 Ayat 1">Pasal 45 Ayat 1</option>
                        </select>
                    `;
                    container.appendChild(pasalItem);
                    if (existingPasals.length + 1 >= 10) {
                        this.disabled = true;
                    }
                } else {
                    alert('Maksimal 10 pasal.');
                }
            });
        });

        // Handle Kirim Button
        // const kirimButton = document.getElementById('kirimButton');
        // if (kirimButton) {
        //     kirimButton.addEventListener('click', function () {
        //         const form = document.getElementById('editForm');
        //         const actionInput = document.createElement('input');
        //         actionInput.type = 'hidden';
        //         actionInput.name = 'action';
        //         actionInput.value = 'kirim';
        //         form.appendChild(actionInput);
        //         form.submit();
        //     });
        // }
    });
</script>
@endsection