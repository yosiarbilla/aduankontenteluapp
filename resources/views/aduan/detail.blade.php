@extends('layouts.app')

@section('isi')
<style>
    .card {
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .card-header {
        background: #0D6EFD; /* Warna Biru Bootstrap */
        color: #fff;
        font-weight: bold;
        font-size: 18px;
        text-align: center;
        border-radius: 12px 12px 0 0;
    }

    .table th {
        width: 30%;
        text-align: left;
        font-weight: bold;
    }

    .table td {
        text-align: left;
    }

    img {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-aksi {
        margin-top: 20px;
        display: flex;
        justify-content: end;
        gap: 10px;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 14px;
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Detail Aduan - {{ $detailAduan->ticket_id }}
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Kategori</th>
                    <td>{{ $detailAduan->kategori }}</td>
                </tr>
                <tr>
                    <th>Prioritas</th>
                    <td>
                        <span class="badge 
                            @if($detailAduan->prioritas == 'High') bg-danger 
                            @elseif($detailAduan->prioritas == 'Urgent') bg-warning 
                            @else bg-info @endif">
                            {{ $detailAduan->prioritas }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $detailAduan->nomor_surat }}</td>
                </tr>
                <tr>
                    <th>Instansi</th>
                    <td>{{ $detailAduan->instansi }}</td>
                </tr>
                <tr>
                    <th>Surat Permintaan</th>
                    <td>
                        @if($detailAduan->surat_permintaan)
                            <a href="{{ asset('storage/'.$detailAduan->surat_permintaan) }}" target="_blank" class="btn btn-sm btn-primary">
                                Lihat Surat Permintaan
                            </a>
                        @else
                            <p class="text-muted">Tidak ada file</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Platform</th>
                    <td>{{ $detailAduan->platform ?? '-' }}</td>
                </tr>
                <tr>
                    <th>URL Link</th>
                    <td>
                        @if($detailAduan->url_link)
                            <a href="{{ $detailAduan->url_link }}" target="_blank">{{ $detailAduan->url_link }}</a>
                        @else
                            <p class="text-muted">Tidak ada link</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Screenshot</th>
                    <td>
                        @if ($detailAduan->screenshot)
                            <img src="{{ asset('storage/'.$detailAduan->screenshot) }}" alt="Screenshot" width="300">
                        @else
                            <p class="text-muted">Gambar tidak ditemukan</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi Konten</th>
                    <td>{{ $detailAduan->deskripsi_konten ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge badge-status
                            @if($detailAduan->status == 'pending') bg-warning
                            @elseif($detailAduan->status == 'draft') bg-secondary
                            @elseif($detailAduan->status == 'aktif') bg-primary
                            @else bg-success @endif">
                            {{ ucfirst($detailAduan->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            <div class="btn-aksi">
                @if($detailAduan->status == 'draft')
                    <a href="{{ route('aduan.edit', $detailAduan->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                @endif

                @if($detailAduan->status == 'draft')
                    <form action="{{ route('aduan.kirim', $detailAduan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-send"></i> Kirim
                        </button>
                    </form>
                @endif

                @if($detailAduan->status == 'pending')
                    <form action="{{ route('aduan.approve', $detailAduan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Disetujui
                        </button>
                    </form>
                @endif

                <a href="{{ route('aduan.export-pdf', $detailAduan->id) }}" class="btn btn-info">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>

                <a href="{{ route('aduan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection