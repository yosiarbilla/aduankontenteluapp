@extends('layouts.app')

@section('title', 'Aduan')

@section('content')
@include('layouts.sidebar')
<style>
    .content{
        margin-left: 110px;
        margin-top: 20px;
        padding: 20px;
    }
    /* General Styling */
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .card .card-title {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .card .card-text {
        font-weight: bold;
        font-size: 24px;
    }

    .card .text-muted {
        font-size: 14px;
    }

    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .table-borderless th,
    .table-borderless td {
        border: none;
    }

    /* Buttons */
    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-outline-success {
        border: 1px solid #28a745;
        color: #28a745;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: #fff;
    }
    .form-label {
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 14px;
}

.form-control {
    margin-bottom: 10px;
}

.text-end button {
    min-width: 100px; /* Ukuran tombol konsisten */
}
</style>

<div class="content">
<div class="container-fluid mt-6">
  
    <!-- Statistik Aduan -->
    <h5 style= "margin-bottom: 20px;">Statistik Aduan</h5>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-clipboard-check"></i></h5>
                    <h2 class="card-text">120</h2>
                    <p class="text-muted">Aduan Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-check-circle"></i></h5>
                    <h2 class="card-text">80</h2>
                    <p class="text-muted">Aduan Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-file-alt"></i></h5>
                    <h2 class="card-text">5</h2>
                    <p class="text-muted">Draf Aduan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Semua Aduan -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <h5>Semua Aduan</h5>
            <a href="{{ route('aduan.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Buat Aduan</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Detail Pencarian -->
                     <h5 style = "font-size: 16px; color: grey;">Detail Pencarian</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="searchInput" class="form-label">Pencarian</label>
                            <input type="text" id="searchInput" class="form-control" placeholder="Kata Kunci Pencarian">
                        </div>
                        <div class="col-md-3">
                            <label for="categorySelect" class="form-label">Kategori</label>
                            <select id="categorySelect" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <option value="negatif">Konten Negatif</option>
                                <option value="perjudian">Perjudian</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select id="statusSelect" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="startDate" class="form-label">Periode Awal</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate" class="form-label">Periode Akhir</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-outline-secondary me-2">Reset</button>
                            <button class="btn btn-success">Cari</button>
                        </div>
                    </div>



                    <!-- Tabel Aduan -->
                    <div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr class="text-muted">
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
            @forelse ($aduan as $item)
                <tr>
                    <td class="text-primary">{{ $item['tiket_id'] }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>
                        <span class="badge bg-{{ $item['prioritas'] == 'High' ? 'danger' : 'success' }}">
                            {{ ucfirst($item['prioritas']) }}
                        </span>
                    </td>
                    <td>{{ $item['nomor_surat'] ?? '-' }}</td>
                    <td>{{ $item['instansi'] ?? '-' }}</td>
                    <td>{{ $item['submit_date'] ?? '-' }}</td>
                    <td>{{ $item['update_date'] ?? '-' }}</td>
                    <td>
                        <a href="#" class="btn btn-outline-success btn-sm">Unduh</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data aduan tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
