<style>
    /* Sidebar */
    .sidebar {
        background-color: #f8f9fa;
        height: 100vh;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 60px;
        left: 0;
        width: 220px;
        overflow-y: auto;
        z-index: 999;
    }

    .sidebar .logo {
        max-width: 120px;
        margin: 0 auto 20px auto;
        display: block;
    }

    .sidebar .nav-link {
        font-size: 16px;
        margin-bottom: 15px;
        color: #343a40;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        color: #28a745;
        font-weight: bold;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 18px;
    }

    /* Card Customization */
    .card {
        position: relative;
        border: none;
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
    .content {
        margin-left: 110px;
        margin-top: 20px;
        padding: 20px;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .sidebar {
            position: relative;
            height: auto;
            width: 100%;
            top: 0;
        }

        .content {
            margin-left: 0;
            margin-top: 60px;
        }
    }
</style>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.sidebar')

<div class="content">

    <!-- Informasi Umum -->
    <h5>Informasi Umum</h5>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/laptop.jpg') }}" alt="Tata Cara Pengisian Aduan">
                <div class="card-title">Tata Cara Pengisian Aduan</div>
                <div class="card-overlay">
                    <a href="#" class="card-link">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/laptop2.jpg') }}" alt="Pemberitahuan Hari Ini">
                <div class="card-title">Pemberitahuan Hari Ini</div>
                <div class="card-overlay">
                    <a href="#" class="card-link">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/laptop3.jpg') }}" alt="Kenali Lebih Dalam TNI Siber">
                <div class="card-title">Kenali Lebih Dalam TNI Siber</div>
                <div class="card-overlay">
                    <a href="#" class="card-link">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Aduan Terakhir -->
    <div class="card-header d-flex justify-content-between">
            <h5>Aduan Terakhir</h5>
            <a href="#" class="text-success" style = "text-decoration: none; font-weight:bold;">Lihat Lebih</a>
        </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
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
@endsection
