@extends('layouts.app')

@section('isi')
<style>
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
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 20px;
    }
    .table-borderless th,
    .table-borderless td {
        border: none;
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
        min-width: 100px;
    }
    @media (max-width: 768px) {
       
        .card {
            margin-bottom: 20px; /* Beri jarak antar kartu */
            padding: 15px; /* Tambahkan padding agar lebih rapi */
        }

        .col-md-3 {
            width: 100%; /* Buat setiap card menjadi full width agar tidak kecil */
        }
    }
</style>


<div class="container-fluid mt-6">
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


    <!-- Statistik Aduan -->
    <h5 style="margin-bottom: 20px;">Statistik Aduan</h5>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-warning"><i class="fas fa-clock"></i></h5>
                <h2 class="card-text">{{ $jumlahPending }}</h2>
                <p class="text-muted">Aduan Pending</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fas fa-clipboard-check"></i></h5>
                <h2 class="card-text">{{ $jumlahAktif }}</h2>
                <p class="text-muted">Aduan Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-success"><i class="fas fa-check-circle"></i></h5>
                <h2 class="card-text">{{ $jumlahSelesai }}</h2>
                <p class="text-muted">Aduan Selesai</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-secondary"><i class="fas fa-file-alt"></i></h5>
                <h2 class="card-text">{{ $jumlahDraft }}</h2>
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
                                        <td class="text-primary">{{ $item->ticket_id }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->prioritas == 'High' ? 'danger' : 'success' }}">
                                                {{ ucfirst($item->prioritas) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->nomor_surat ?? '-' }}</td>
                                        <td>{{ $item->instansi ?? '-' }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') ?? '-' }}</td>
                                        <td>{{ $item->updated_at->format('d-m-Y') ?? '-' }}</td>
                                        <td>
                                            <a href="{{route('aduan.show', $item->id)}}" class="btn btn-outline-success btn-sm">Detail</a>
                                            <a href="{{route('aduan.export-pdf', $item->id)}}" target="_blank" class="btn btn-outline-success btn-sm">Unduh</a>
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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK',
        showCloseButton: true, // Menampilkan tombol X untuk menutup alert
        timer: 3000
    });
    @endif
</script>
@endsection

