@extends('layouts.app')

@section('title', 'Form Aduan')

@section('content')
<style>
    .content {
        margin-top: 120px;
    }

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
</style>

<div class="content">
    <div class="container mt-4">
        <a href="{{ route('dashboard') }}" class="back-button"><i class="fas fa-arrow-left"></i> Kembali</a>

        <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Kategori -->
            <div class="card">
                <div class="row row-gap">
                    <h5 style="font-weight: bold;">Kategori</h5>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control form-control-select">
                            <option value="">Pilih Kategori</option>
                            <option value="Platform 1">Platform 1</option>
                            <option value="Platform 2">Platform 2</option>
                            <option value="Platform 3">Platform 3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="prioritas" class="form-label">Prioritas</label>
                        <select id="prioritas" name="prioritas" class="form-control form-control-select">
                            <option value="Normal">Normal</option>
                            <option value="Urgent">Urgent</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Surat Permintaan dan Dokumen Pendukung -->
            <div class="card">
                <h5 style="font-weight: bold;">Surat Permintaan dan Dokumen Pendukung</h5>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="nomorSurat" class="form-label">Nomor Surat</label>
                        <input type="text" id="nomorSurat" name="nomor_surat" class="form-control" placeholder="Nomor Surat">
                    </div>
                    <div class="col-md-6">
                        <label for="suratPermintaan" class="form-label">Surat Permintaan</label>
                        <input type="file" id="suratPermintaan" name="surat_permintaan" class="form-control">
                    </div>
                </div>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                        <input type="file" id="dokumenPendukung" name="dokumen_pendukung[]" class="form-control" multiple>
                        <small class="text-muted">Maksimal 10 dokumen, format: jpg, png, doc, pdf</small>
                    </div>
                    <div class="col-md-6">
                        <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                        <textarea id="catatanTambahan" name="catatan_tambahan" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <!-- Platform dan URL -->
            <div class="card">
                <h5 style="font-weight: bold;">Platform</h5>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="platform" class="form-label">Platform</label>
                        <input type="text" id="platform" name="platform" class="form-control" placeholder="Platform">
                    </div>
                    <div class="col-md-6">
                        <label for="urlLink" class="form-label">URL Link</label>
                        <input type="url" id="urlLink" name="url_link" class="form-control" placeholder="Masukkan URL">
                    </div>
                </div>
            </div>

            <!-- Screenshot -->
            <div class="card">
                <h5 style="font-weight: bold;">Screenshot</h5>
                <div class="row row-gap">
                    <div class="col-md-6">
                        <label for="screenshot" class="form-label">Unggah Screenshot</label>
                        <input type="file" id="screenshot" name="screenshot" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsiKonten" class="form-label">Deskripsi Konten</label>
                        <textarea id="deskripsiKonten" name="deskripsi_konten" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="form-footer">
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                <button type="submit" class="btn btn-success">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    document.getElementById('tambahDokumen').addEventListener('click', function () {
        const container = document.getElementById('dokumenPendukungContainer');
        if (container.children.length < 10) {
            const dokumenContainer = document.createElement('div');
            dokumenContainer.classList.add('upload-placeholder', 'mb-2');
            dokumenContainer.innerHTML = `
                <input type="text" class="form-control file-name" placeholder="Pilih file..." readonly>
                        <button type="button" class="btn-upload" onclick="triggerFileInput(this)">Upload</button>
                        <input type="file" class="file-input" style="display: none;" onchange="updateFileName(this)">
            `;
            container.appendChild(dokumenContainer);
        } else {
            alert('Maksimal 10 dokumen pendukung.');
        }
    });
    document.getElementById('tambahPasal').addEventListener('click', function () {
    const container = document.getElementById('pasalContainer');
    if (container.children.length < 10) {
        const pasalItem = document.createElement('div');
        pasalItem.classList.add('pasal-item', 'mb-2');
        pasalItem.innerHTML = `
            <select class="form-control form-control-select">
                <option>Pasal 27 Ayat 3</option>
                <option>Pasal 28 Ayat 2</option>
                <option>Pasal 45 Ayat 1</option>
            </select>
        `;
        container.appendChild(pasalItem);
    } else {
        alert('Maksimal 10 pasal.');
    }
});

    function triggerFileInput(button) {
    // Memastikan hanya satu elemen input file yang dipicu
    const fileInput = button.nextElementSibling; // Ambil elemen input file terkait
    fileInput.click();
}

function updateFileName(input) {
    // Mengupdate nama file ke elemen input text
    const fileName = input.files[0]?.name || "Pilih file...";
    const textInput = input.previousElementSibling.previousElementSibling; // Input teks terkait
    textInput.value = fileName;
}


document.getElementById('dropdownButton').addEventListener('click', function () {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.style.display =
        dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', function (e) {
    const button = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');
    if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = 'none';
    }
});


</script>
