@extends('layouts.app')
<style>
    body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0; /* Menghilangkan margin default */
            
        }
    .card {
        position: relative;
        border: none !important;
        height: 250px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        
    }

    .card img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        filter: brightness(0.35); /* Mencerahkan gambar */
    opacity: 0.5; /* Transparansi pada gambar */
    background-color:green!important;
     
    }

    .card-title {
        position: absolute;
        top: 10px;
        left: 15px;
        font-size: 18px;
        font-weight: bold;
        color: white!important;
        text-align: center!important;
        padding: 3px;
      
    }

    .card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 30%; /* Overlay hanya 50% dari bawah */
        background: rgba(0, 128, 0, 0.7); /* Overlay hijau */
        color: white;
        padding: 15px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .card-link {
        font-size: 12px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        text-align: right;
    }

    .card-link:hover {
        color: #d4edda;
    }

    /* Konten Utama */
    .table-borderless th,
    .table-borderless td {
        border: none;
    }

    /* Modal overlay style fix - stronger styling */
    .modal-backdrop {
        opacity: 0.7 !important;
        background-color: #000 !important;
        z-index: 1040 !important;
    }
    
    /* Pastikan modal tampil di atas semua elemen */
    .modal {
        z-index: 9999 !important;
    }
    
    /* Custom overlay for manual implementation */
    #custom-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9000;
        display: none;
    }
    
    /* Mobile spacing for cards */
    @media (max-width: 768px) {
        .card-container {
            margin-bottom: 20px;
        }
    }
</style>



@section('isi')


    <!-- Informasi Umum -->
    <h5>Informasi Umum</h5>
    <div class="row mb-4">
        <div class="col-md-4 card-container mb-3">
            <div class="card">
                <img src="{{ asset('images/laptop.jpg') }}" alt="Tata Cara Pengisian Aduan">
                <div class="card-title">Tata Cara Pengisian Aduan</div>
                <div class="card-overlay">
                <a href="#" class="card-link modal-trigger" data-content="aduan">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 card-container mb-3">
            <div class="card">
                <img src="{{ asset('images/laptop2.jpg') }}" alt="Pemberitahuan Hari Ini">
                <div class="card-title">Pemberitahuan Hari Ini</div>
                <div class="card-overlay">
                <a href="#" class="card-link modal-trigger" data-content="pemberitahuan">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 card-container mb-3">
            <div class="card">
                <img src="{{ asset('images/laptop3.jpg') }}" alt="Kenali Lebih Dalam TNI Siber">
                <div class="card-title">Kenali Lebih Dalam TNI Siber</div>
                <div class="card-overlay">
                <a href="#" class="card-link modal-trigger" data-content="tni-siber">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Aduan Terakhir -->
    <div class="card-header d-flex justify-content-between">
            <h5>Aduan Terakhir</h5>
            <a href="{{ route('aduan.index') }}" class="text-success" style = "text-decoration: none; font-weight:bold;">Lihat Lebih</a>
        </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive table-borderless">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Tiket ID</th>
                            <th>Kategori</th>
                            <th>Prioritas</th>
                            <th>Nomor Surat</th>
                            <th>Instansi</th>
                            <th>Submit</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-primary">FHRY674J7D</td>
                            <td>Konten Negatif</td>
                            <td><span class="badge bg-success">Normal</span></td>
                            <td>R/106/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>02/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        <tr>
                            <td class="text-primary">AHS983KJF7</td>
                            <td>Perjudian</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>R/105/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>01/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        <tr>
                            <td class="text-primary">AHS983KJF7</td>
                            <td>Perjudian</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>R/105/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>01/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        <tr>
                            <td class="text-primary">AHS983KJF7</td>
                            <td>Perjudian</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>R/105/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>01/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        <tr>
                            <td class="text-primary">AHS983KJF7</td>
                            <td>Perjudian</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>R/105/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>01/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        <tr>
                            <td class="text-primary">AHS983KJF7</td>
                            <td>Perjudian</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>R/105/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>01/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        <tr>
                            <td class="text-primary">AHS983KJF7</td>
                            <td>Perjudian</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>R/105/VI/2024</td>
                            <td>Siber TNI AD</td>
                            <td>01/08/2024</td>
                            <td>2 Weeks Ago</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom overlay element -->
<div id="custom-modal-overlay"></div>

<!-- Modal with enhanced structure -->
<div class="modal" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Tata Cara Pengisian Aduan</h5>
                <button type="button" class="btn-close close-modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('images/pelajariselengkapnya-tulis.jpeg') }}" alt="Tata Cara" class="img-fluid mb-3">
                <ol>
                    <li>1.  Buka menu Aduan</li>
                    <li>2. Pilih Buat Aduan</li>
                    <li>3. Isi form sesuai informasi yang ada</li>
                    <li>4. Pastikan seluruh informasi telah benar</li>
                    <li>5. Pilih Simpan Draft untuk berhenti mengisi sementara, atau pilih Kirim untuk menyelesaikan pembuatan aduan</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success close-modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Enhanced modal controls with vanilla JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('infoModal');
        const customOverlay = document.getElementById('custom-modal-overlay');
        const modalTriggers = document.querySelectorAll('.modal-trigger');
        const closeButtons = document.querySelectorAll('.close-modal');
        
        // Function to open modal
        function openModal() {
            // Show the custom overlay
            customOverlay.style.display = 'block';
            
            // Show the modal with a slight delay for the overlay
            setTimeout(() => {
                modalElement.style.display = 'block';
                document.body.classList.add('modal-open');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }, 50);
        }
        
        // Function to close modal
        function closeModal() {
            // Hide modal
            modalElement.style.display = 'none';
            
            // Hide overlay
            customOverlay.style.display = 'none';
            
            // Restore scrolling
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            
            // Clean up any Bootstrap modal remnants
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => {
                backdrop.parentNode.removeChild(backdrop);
            });
        }
        
        // Event listeners for opening modal
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
            });
        });
        
        // Event listeners for closing modal
        closeButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });
        
        // Close when clicking outside modal
        customOverlay.addEventListener('click', closeModal);
        
        // Close when pressing ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalElement.style.display === 'block') {
                closeModal();
            }
        });
    });
</script>
@endsection
