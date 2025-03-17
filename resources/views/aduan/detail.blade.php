@extends('layouts.app')

@section('isi')
@php
    // Set variable di sini
    $hideSidebar = true;
    $hideToggle = true; 
@endphp
<style>
    :root {
        --primary-font: 'Plus Jakarta Sans', sans-serif;
        --primary-color: #3D3D3D;
        --border-color: #E3E3E3;
        --bg-color: #F8F9FA;
        --card-padding: 32px;
        --gap-standard: 24px;
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
        box-sizing: border-box;
        width: 100%;
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        padding: var(--card-padding);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: var(--gap-standard);
    }
    
    .card-title {
        width: 100%;
        font-weight: 700;
        font-size: 16px;
        line-height: 24px;
        color: var(--primary-color);
        margin: 0;
    }
    
    .section {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: var(--section-gap);
    }
    
    .info-row {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0;
        gap: var(--row-gap);
    }
    
    .info-row-multiline {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0;
        gap: var(--row-gap);
    }
    
    .info-label {
        width: 120px;
        height: 22px;
        font-weight: 700;
        font-size: 14px;
        line-height: 22px;
        color: var(--primary-color);
    }
    
    .info-label-multiline {
        width: 120px;
        height: auto;
        font-weight: 700;
        font-size: 14px;
        line-height: 22px;
        color: var(--primary-color);
    }
    
    .info-value {
        flex-grow: 1;
        font-weight: 500;
        font-size: 14px;
        line-height: 22px;
        color: var(--primary-color);
    }
    
    .divider {
        width: 100%;
        height: 0;
        border: 1px solid var(--border-color);
        margin: 0;
    }
    
    .screenshot-image {
        width: 163px;
        height: 173px;
        object-fit: cover;
        border: 1px solid var(--border-color);
    }
    
    .back-button {
        display: flex;
        align-items: center;
        color: var(--primary-color);
        text-decoration: none;
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    .back-button i {
        margin-right: 8px;
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
    
    /* Updated button styles */
    .btn-aksi {
        display: flex;
        gap: 12px;
        margin-top: 16px;
        justify-content: flex-end;
        width: 100%;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
        min-width: 140px;
        text-align: center;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn i {
        margin-right: 8px;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
    }
    
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    
    .btn-success:hover {
        background-color: #218838;
    }
    
    .btn-info {
        background-color: #17a2b8;
        color: white;
    }
    
    .btn-info:hover {
        background-color: #138496;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
        .container {
            margin-top: 80px;
        }
        
        .detail-card {
            padding: 24px 16px;
        }
        
        .info-row, .info-row-multiline {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .info-label, .info-label-multiline {
            width: 100%;
            margin-bottom: 4px;
        }
        
        .info-value {
            width: 100%;
        }
        
        .btn-aksi {
            flex-wrap: wrap;
        }
        
        .btn {
            flex: 1 0 calc(50% - 10px);
            min-width: unset;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            margin-top: 60px;
        }
        
        .btn-aksi {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
        
        .screenshot-image {
            width: 100%;
            height: auto;
        }
    }
</style>

<div class="container">
    <a href="{{ route('dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- Informasi Utama -->
    <div class="detail-card">
        <h6 class="card-title">Informasi Utama</h6>
        <div class="section">
            <div class="info-row">
                <div class="info-label">Kategori</div>
                <div class="info-value">{{ $detailAduan->kategori }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Tiket ID</div>
                <div class="info-value">{{ $detailAduan->ticket_id }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Submit</div>
                <div class="info-value">{{ $detailAduan->created_at->format('d/m/Y') }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Status</div>
                <div class="info-value">{{ $detailAduan->status }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Prioritas</div>
                <div class="info-value">{{ $detailAduan->prioritas }}</div>
            </div>
        </div>
    </div>

    <!-- Surat Permintaan dan Dokumen Pendukung -->
    <div class="detail-card">
        <h6 class="card-title">Surat Permintaan dan Dokumen Pendukung</h6>
        <div class="section">
            <div class="info-row">
                <div class="info-label">Narasumber</div>
                <div class="info-value">{{ $detailAduan->narasumber ?? 'John Doe' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Instansi</div>
                <div class="info-value">{{ $detailAduan->instansi }}</div>
            </div>
            
            <div class="divider"></div>
            
            <div class="info-row">
                <div class="info-label">Nomor Surat</div>
                <div class="info-value">{{ $detailAduan->nomor_surat }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Surat Permintaan</div>
                <div class="info-value">
                    @if($detailAduan->surat_permintaan)
                        <a href="{{ asset('storage/'.$detailAduan->surat_permintaan) }}" target="_blank">
                            {{ basename($detailAduan->surat_permintaan) }}
                        </a>
                    @else
                        surat-permintaan.pdf
                    @endif
                </div>
            </div>
            
            <div class="info-row-multiline">
                <div class="info-label-multiline">Dokumen Pendukung</div>
                <div class="info-value">
                @if($detailAduan->dokumen_pendukung ?? false)
                    @if(is_array($detailAduan->dokumen_pendukung))
                        <a href="{{ asset('storage/'.($detailAduan->dokumen_pendukung[0] ?? '')) }}" target="_blank">
                            {{ basename($detailAduan->dokumen_pendukung[0] ?? '') }}
                        </a>
                    @else
                        <a href="{{ asset('storage/'.$detailAduan->dokumen_pendukung) }}" target="_blank">
                            {{ basename($detailAduan->dokumen_pendukung) }}
                        </a>
                    @endif
                @else
                    document.pdf
                @endif
                </div>
            </div>
            
            <div class="info-row-multiline">
                <div class="info-label-multiline">Catatan Tambahan</div>
                <div class="info-value">{{ $detailAduan->catatan_tambahan ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Platform -->
    <div class="detail-card">
        <h6 class="card-title">Platform</h6>
        <div class="section">
            <div class="info-row">
                <div class="info-label">Platform</div>
                <div class="info-value">{{ $detailAduan->platform ?? 'Tiktok' }}</div>
            </div>
            
            <div class="info-row-multiline">
                <div class="info-label">URL Link</div>
                <div class="info-value">
                    @if($detailAduan->url_link)
                        <a href="{{ $detailAduan->url_link }}" target="_blank">{{ $detailAduan->url_link }}</a>
                    @else
                        https://www.tiktok.com/@cintaabdinegara2988/video/7336798845914959110?q=tn&t=1722879229009
                    @endif
                </div>
            </div>
            
            <div class="info-row-multiline">
                <div class="info-label">Screenshot</div>
                <div class="info-value">
                    @if ($detailAduan->screenshot)
                        <img src="{{ asset('storage/'.$detailAduan->screenshot) }}" alt="Screenshot" class="screenshot-image">
                    @else
                        <img src="{{ asset('img/placeholder.jpg') }}" alt="Screenshot" class="screenshot-image">
                    @endif
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Pasal</div>
                <div class="info-value">{{ $detailAduan->pasal ?? 'Pasal 27 Ayat 3' }}</div>
            </div>
            
            <div class="info-row-multiline">
                <div class="info-label-multiline">Deskripsi Konten</div>
                <div class="info-value">{{ $detailAduan->deskripsi_konten ?? 'Konten mengandung perbuatan yang tidak senonoh terhadap TNI Indonesia, karena itu perlu adanya tindakan dari KOMINFO terhadap kasus tersebut.' }}</div>
            </div>
        </div>
    </div>

    <div class="btn-aksi">
        @if($detailAduan->status == 'draft')
            <a href="{{ route('aduan.edit', $detailAduan->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        @endif

        @if($detailAduan->status == 'draft')
            <form action="{{ route('aduan.kirim', $detailAduan->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send"></i> Kirim
                </button>
            </form>
        @endif

        @if($detailAduan->status == 'pending')
            <form action="{{ route('aduan.approve', $detailAduan->id) }}" method="POST" style="display: inline;">
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

@endsection