@extends('layouts.app')

@section('title', 'Form Aduan')

@section('content')
<style>
<<<<<<< HEAD
    .content{
        margin-top:120px;
    }
=======
    .content {
        margin-top: 120px;
    }

>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
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
<<<<<<< HEAD
        background-color: white!important;
=======
        background-color: white !important;
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
        color: #28a745;
        border-radius: 5px;
        padding: 8px 16px;
        text-align: center;
    }

    .btn-upload:hover {
<<<<<<< HEAD
        background-color: #e9ecef!important;
=======
        background-color: #e9ecef !important;
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
    }

    .btn-add {
        border: 1px solid #28a745;
<<<<<<< HEAD
         background-color: white;
=======
        background-color: white;
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
        color: #28a745;
        border-radius: 5px;
        padding: 8px 16px;
        text-align: center;
    }

    .btn-add:hover {
<<<<<<< HEAD
        background-color: #e9ecef!important;
    }

    .section-title {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .btn-footer {
        margin-top: 20px;
        padding: 20px 0;
    }

    .row-gap {
        row-gap: 20px;
    }
 
    .upload-placeholder {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .upload-placeholder input[type="file"] {
        display: none;
    }

    .upload-placeholder .btn-upload {
        flex-grow: 1;
        border: 1px solid #28a745;
        color: #28a745;
        text-align: center;
        background-color: #f8f9fa;
        padding: 10px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .upload-placeholder .file-name {
        flex-grow: 2;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px 12px;
        background-color: #f8f9fa;
        color: #555;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .upload-placeholder .file-name:empty::after {
        content: "Pilih file...";
        color: #aaa;
    }
    /* Tambahkan arrow untuk dropdown */
.form-control-select {
    position: relative;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: #fff;
    background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"%3E%3Cpath fill="gray" d="M10 12l-6-6h12l-6 6z"/%3E%3C/svg%3E');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px 16px;
    padding-right: 30px; /* Tambahkan padding agar panah tidak menutupi teks */
    border: 1px solid #ddd;
    border-radius: 5px;
}
.btn-dropdown {
    border: 1px solid #28a745;
    color: #28a745;
    background-color: white;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 5px;
    position: relative;
}

.btn-dropdown:hover {
    background-color: #e9ecef;
}

/* Dropdown menu */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    overflow: hidden;
    z-index: 1000;
    margin-top: 5px;
}

.dropdown-menu .dropdown-item {
    padding: 10px 15px;
    font-size: 14px;
    color: #333;
    text-decoration: none;
    display: block;
}

.dropdown-menu .dropdown-item:hover {
    background-color: #f2f2f2;
    color: #28a745;
}
.row-gap {
    row-gap: 10px; /* Kurangi jarak vertikal antar elemen */
}

#pasalContainer {
    margin-top: 0px; /* Kurangi jarak atas pada container Pasal */
}

.upload-placeholder {
    margin-bottom: 5px; /* Kurangi jarak bawah pada elemen Screenshot */
}
.form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Pastikan sejajar ke kiri */
}

.tambah-pasal-container {
    display: inline-block; /* Agar tetap dalam satu baris dengan form lainnya */
    text-align: left; /* Teks sejajar ke kiri */
    margin-top: 10px; /* Tambahkan jarak atas jika diperlukan */
}

.penambahan-info {
    display: block; /* Pastikan teks berada di bawah tombol */
    margin-top: 5px; /* Jarak antara tombol dan teks */
}

.btn-add {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 15px;
    border: 1px solid #28a745;
    background-color: white;
    color: #28a745;
    border-radius: 5px;
    cursor: pointer;
}

.btn-add:hover {
    background-color: #f8f9fa;
}
.back-button {
    margin-bottom: 30px; /* Atur jarak vertikal */
    text-decoration: none;
    color: black;
    display: block; /* Pastikan tombol memiliki blok sendiri */
}
.form-footer {
    max-width: 100%; /* Lebar penuh layar */
    background-color: #fff; /* Latar belakang putih */
    box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.1); /* Bayangan pembatas */
    padding: 10px 20px; /* Padding untuk ruang dalam */
    display: flex;
    justify-content: flex-end; /* Posisi tombol di kanan */
    gap: 10px; /* Jarak antar tombol */
    margin-top: 20px; /* Jarak dari elemen sebelumnya */
    position: relative; /* Agar sesuai dengan alur dokumen */
    left: 0;
    right: 0;
}

.form-footer .btn {
    padding: 8px 20px; /* Ukuran tombol */
    border-radius: 5px; /* Sudut melengkung */
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
<div class = "content">
<div class="container mt-4">
<a href="{{ route('dashboard') }}" class="back-button"><i class="fas fa-arrow-left"></i> Kembali</a>


    <!-- Kategori -->
    <div class="card">
        <div class="row row-gap">
        <h5 style = "font-weight: bold;">Kategori</h5>
            <div class="col-md-6">
                
            <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" class="form-control form-control-select">
                    <option>Pilih Kategori</option>
                    <option>Platform 1</option>
                    <option>Platform 2</option>
                    <option>Platform 3</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="prioritas" class="form-label">Prioritas</label>
                <input type="text" id="prioritas" class="form-control" placeholder="Prioritas akan ditentukan secara otomatis">
            </div>
        </div>
    </div>

    <!-- Surat Permintaan dan Dokumen Pendukung -->
    <div class="card">
        <h5 style = "font-weight: bold;">Surat Permintaan dan Dokumen Pendukung</h5>
        <div class="row row-gap">
            <div class="col-md-6">
                <label for="nomorSurat" class="form-label">Nomor Surat</label>
                <input type="text" id="nomorSurat" class="form-control" placeholder="Nomor Surat">
                <small class="text-muted">Nomor surat sesuai ketentuan yang ada</small>
            </div>
            <div class="col-md-6">
                <label for="suratPermintaan" class="form-label">Surat Permintaan</label>
                <div class="upload-placeholder mb-2">
                        <input type="text" class="form-control file-name" placeholder="Pilih file..." readonly>
                        <button type="button" class="btn-upload" onclick="triggerFileInput(this)">Upload</button>
                        <input type="file" class="file-input" style="display: none;" onchange="updateFileName(this)">
                    </div>
            </div>
        </div>
        <div class="row row-gap">
            <div class="col-md-6">
                <label class="form-label">Dokumen Pendukung</label>
                <div id="dokumenPendukungContainer">
                    <div class="upload-placeholder mb-2">
                        <input type="text" class="form-control file-name" placeholder="Pilih file..." readonly>
                        <button type="button" class="btn-upload" onclick="triggerFileInput(this)">Upload</button>
                        <input type="file" class="file-input" style="display: none;" onchange="updateFileName(this)">
                    </div>
                </div>
                <small class="text-muted">File berupa jpg, jpeg, png, doc,docx,  xls, xlsx, dan pdf</small>
                <button class="btn-add mt-2" id="tambahDokumen"><i class="fas fa-plus"></i> Tambah Dokumen</button>
                <small class="text-muted mt-1" style = " display:block;">Maksimal penambahan adalah 10 dokumen</small>
            </div>
            <div class="col-md-6">
                <label for="catatanTambahan" class="form-label">Catatan Tambahan</label>
                <textarea id="catatanTambahan" class="form-control" rows="5"></textarea>
            </div>
        </div>
    </div>

    <!-- Platform -->
    <div class="card">
        <h5 style="font-weight:bold;">Platform</h5>
        <div class="row row-gap">
        <h5 style = "font-size: 16px; color: grey; margin-top:20px;">URL 1</h5>
            <div class="col-md-6">
                <label for="platform" class="form-label">Platform</label>
                <select id="platform" class="form-control form-control-select">
                    <option>Pilih Platform</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="urlLink" class="form-label">URL Link</label>
                <input type="text" id="urlLink" class="form-control" placeholder="Masukkan URL">
            </div>
        </div>
        <div class="row row-gap">
            <div class="col-md-6">
                <label for="screenshot" class="form-label">Screenshot</label>
                    <div class="upload-placeholder mb-2">   
                            <input type="text" class="form-control file-name" placeholder="Pilih file..." readonly>
                            <button type="button" class="btn-upload" onclick="triggerFileInput(this)">Upload</button>
                            <input type="file" class="file-input" style="display: none;" onchange="updateFileName(this)">                 
                        </div>          

                </div>
                
           
            
        </div>
        <div class="row row-gap">
    <div class="col-md-6">
        <label for="pasal" class="form-label">Pasal</label>
        <div id="pasalContainer">
            <div class="pasal-item mb-2">
                <select id="pasal" class="form-control form-control-select">
                    <option>Pasal 27 Ayat 3</option>
                    <option>Pasal 28 Ayat 2</option>
                    <option>Pasal 45 Ayat 1</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="tambah-pasal-container">
                <button class="btn-add" id="tambahPasal">
                    <i class="fas fa-plus"></i> Tambah Pasal
                </button>
                <small class="text-muted penambahan-info">Maksimal penambahan adalah 10 pasal</small>
            </div>
        </div>

    </div>
     <div class="col-md-6">
                
                <label for="deskripsiKonten" class="form-label">Deskripsi Konten</label>
                <textarea id="deskripsiKonten" class="form-control" rows="5"></textarea>
            </div>
</div>
<div class="dropdown">
    <button class="btn-dropdown mt-2" id="dropdownButton">Tambah URL <i class="fas fa-caret-down"></i></button>
    <div class="dropdown-menu" id="dropdownMenu">
        <a href="#" class="dropdown-item">CSV</a>
        <a href="#" class="dropdown-item">Manual</a>
    </div>
    <small class="text-muted">Penambahan URL dapat berupa CSV atau manual</small>
    </div>
</div>
    <!-- Footer Buttons -->
    <div class="form-footer">
        <button class="btn btn-outline-secondary">Simpan Draf</button>
        <button class="btn btn-success">Kirim</button>
    </div>

</div>
=======
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
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160

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
<<<<<<< HEAD
@endsection
=======
>>>>>>> c34b33e0997faa774a11c8df40efcfc11e0c7160
