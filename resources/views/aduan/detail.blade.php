@extends('layouts.app')

@section('isi')
    @php
        // Decode url_data JSON menjadi array
        $urlData = json_decode($detailAduan->url_data, true);
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
            font-size: 14px;
            line-height: 22px;
            color: var(--primary-color);
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .info-value a {
            display: inline-block;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            word-wrap: break-word;
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
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Updated button styles */
        .btn-aksi {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            width: 100%;
            margin-top: 24px;
            padding: 15px 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-aksi form {
            margin: 0;
            display: inline-block;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            height: 38px;
            text-align: center;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn:first-child {
            margin-left: 0;
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

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Media query untuk mengatur tombol menjadi vertikal di mobile */
        @media (max-width: 767px) {
            .btn-aksi {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .btn-aksi form {
                display: block;
                width: 100%;
            }

            .btn {
                width: 100%;
                margin-left: 0;
                margin-bottom: 8px;
            }

            .info-row,
            .info-row-multiline {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-label,
            .info-label-multiline {
                width: 100%;
            }
        }

        .badge {
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }

        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529;
        }

        .bg-danger {
            background-color: #dc3545 !important;
            color: white;
        }

        .bg-success {
            background-color: #28a745 !important;
            color: white;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
            color: white;
        }
    </style>

    <div class="container">
        <a href="{{ route('aduan.index') }}" class="back-button">
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
                    <div class="info-value">
                        <span
                            class="badge {{ $detailAduan->prioritas == 'High' ? 'bg-orange' : ($detailAduan->prioritas == 'Urgent' ? 'bg-danger' : 'bg-success') }}"
                            style="font-size: 14px; padding: 5px 10px;">
                            {{ $detailAduan->prioritas }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Surat Permintaan dan Dokumen Pendukung -->
        <div class="detail-card">
            <h6 class="card-title">Surat Permintaan dan Dokumen Pendukung</h6>
            <div class="section">
                <div class="info-row">
                    <div class="info-label">Instansi</div>
                    <div class="info-value">{{ $detailAduan->instansi }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nomor Surat</div>
                    <div class="info-value">{{ $detailAduan->nomor_surat }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Surat Permintaan</div>
                    <div class="info-value">
                        @if ($detailAduan->surat_permintaan)
                            <a href="{{ asset('storage/' . $detailAduan->surat_permintaan) }}" target="_blank">
                                {{ basename($detailAduan->surat_permintaan) }}
                            </a>
                        @else
                            Tidak ada surat permintaan.
                        @endif
                    </div>
                </div>
                <div class="info-row-multiline">
                    <div class="info-label-multiline">Dokumen Pendukung</div>
                    <div class="info-value">
                        @if ($detailAduan->dokumen_pendukung)
                            @php
                                $dokumenPendukung = json_decode($detailAduan->dokumen_pendukung, true);
                            @endphp
                            @if (is_array($dokumenPendukung))
                                @foreach ($dokumenPendukung as $doc)
                                    <a href="{{ asset('storage/' . $doc) }}" target="_blank">
                                        {{ basename($doc) }}
                                    </a><br>
                                @endforeach
                            @else
                                <a href="{{ asset('storage/' . $detailAduan->dokumen_pendukung) }}" target="_blank">
                                    {{ basename($detailAduan->dokumen_pendukung) }}
                                </a>
                            @endif
                        @else
                            Tidak ada dokumen pendukung.
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
                @if (isset($urlData) && is_array($urlData) && count($urlData) > 0)
                    @foreach ($urlData as $index => $url)
                        <div class="info-row">
                            <div class="info-label">Platform {{ $index + 1 }}</div>
                            <div class="info-value">{{ $url['platform'] ?? '-' }}</div>
                        </div>
                        <div class="info-row-multiline">
                            <div class="info-label">URL Link</div>
                            <div class="info-value">
                                @if (isset($url['url_link']))
                                    <a href="{{ $url['url_link'] }}" target="_blank">{{ $url['url_link'] }}</a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="info-row-multiline">
                            <div class="info-label">Screenshot</div>
                            <div class="info-value">
                                @if (isset($url['screenshot']))
                                    <img src="{{ asset('storage/' . $url['screenshot']) }}" alt="Screenshot"
                                        class="screenshot-image">
                                @else
                                    <img src="{{ asset('img/placeholder.jpg') }}" alt="Placeholder"
                                        class="screenshot-image">
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Pasal</div>
                            <div class="info-value">
                                @if (isset($url['pasal']) && is_array($url['pasal']))
                                    {{ implode(', ', $url['pasal']) }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="info-row-multiline">
                            <div class="info-label-multiline">Deskripsi Konten</div>
                            <div class="info-value">{{ $url['deskripsi_konten'] ?? '-' }}</div>
                        </div>
                        <div class="divider"></div>
                    @endforeach
                @else
                    <div class="info-row">
                        <div class="info-label">Platform</div>
                        <div class="info-value">Tidak ada data platform.</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="btn-aksi">
            <!-- Button Kembali untuk semua user -->


            <!-- Button Edit hanya muncul jika status draft dan user adalah pemilik aduan -->
            @if ($detailAduan->status == 'draft' && Auth::id() == $detailAduan->user_id)
                <a href="{{ route('aduan.edit', $detailAduan->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
            @endif

            <!-- Button Kirim hanya muncul jika status draft dan user adalah pemilik aduan -->
            @if ($detailAduan->status == 'draft' && Auth::id() == $detailAduan->user_id)
                <form action="{{ route('aduan.kirim', $detailAduan->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
                </form>
            @endif

            <!-- Button Review hanya muncul untuk petugas (role_id=3) dan jika status pending -->
            @if ($detailAduan->status == 'pending' && Auth::user()->role->id == 3)
                <form action="{{ route('aduan.review-accept', $detailAduan->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Review Diterima
                    </button>
                </form>

                <form action="{{ route('aduan.review-reject', $detailAduan->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-times"></i> Review Ditolak
                    </button>
                </form>
            @endif

            <!-- Button Disetujui hanya muncul untuk manager dan jika status onreview -->
            @if ($detailAduan->status == 'onreview' && Auth::user()->role->id == 2)
                <form action="{{ route('aduan.approve', $detailAduan->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Disetujui
                    </button>
                </form>

                <!-- Button Ditolak hanya muncul untuk manager dan jika status onreview -->
                <form action="{{ route('aduan.reject', $detailAduan->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle"></i> Ditolak
                    </button>
                </form>
            @endif

            @if ($detailAduan->status == 'active' && Auth::user()->role_id == 3)
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#apiSendModal">
                    <i class="fas fa-paper-plane"></i> Kirim ke API
                </button>

                <!-- Modal for API Send Confirmation -->
                <div class="modal fade" id="apiSendModal" tabindex="-1" aria-labelledby="apiSendModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="apiSendModalLabel">Konfirmasi Pengiriman ke API</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda yakin ingin mengirim aduan ini ke API?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('aduan.send-to-api', $detailAduan->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Button Export PDF untuk semua user -->
            <a href="{{ route('aduan.export-pdf', $detailAduan->id) }}" class="btn btn-info">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
@endsection
