<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Aduan {{ $aduan->ticket_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #04AA6D;
            padding-bottom: 10px;
        }
        .ticket-id {
            font-size: 18px;
            font-weight: bold;
            color: #04AA6D;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .detail-table th {
            background-color: #04AA6D;
            color: white;
            padding: 10px;
            text-align: left;
            width: 25%;
        }
        .detail-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 8px;
            margin-top: 20px;
            font-weight: bold;
        }
        .document-link {
            color: #0066cc;
            text-decoration: underline;
        }
        .url-section {
            margin-top: 25px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            background-color: #f0ad4e;
            color: white;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .pasal-list {
            margin: 5px 0;
            padding-left: 20px;
        }
        .dokumen-list {
            margin: 5px 0;
            padding-left: 20px;
        }
        .image-container {
            text-align: center;
            margin: 10px 0;
        }
        .image-container img {
            max-width: 90%;
            max-height: 300px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN ADUAN</h2>
        <div class="ticket-id">Ticket ID: {{ $aduan->ticket_id }}</div>
        <div>Tanggal Dibuat: {{ $aduan->created_at->format('d-m-Y H:i') }}</div>
        @if($aduan->user)
        <div>Dibuat oleh: {{ $aduan->user->name ?? 'Tidak diketahui' }}</div>
        @endif
    </div>

    <div class="section-title">INFORMASI DASAR</div>
    <table class="detail-table">
        <tr>
            <th>Kategori</th>
            <td>{{ $aduan->kategori }}</td>
        </tr>
        <tr>
            <th>Prioritas</th>
            <td>{{ $aduan->prioritas }}</td>
        </tr>
        <tr>
            <th>Nomor Surat</th>
            <td>{{ $aduan->nomor_surat }}</td>
        </tr>
        <tr>
            <th>Instansi</th>
            <td>{{ $aduan->instansi }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td><div class="status">{{ strtoupper($aduan->status) }}</div></td>
        </tr>
        <tr>
            <th>Catatan Tambahan</th>
            <td>{{ $aduan->catatan_tambahan ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">SURAT PERMINTAAN</div>
    <table class="detail-table">
        <tr>
            <th>Dokumen</th>
            <td>
                @if(!empty($aduan->surat_permintaan))
                    <a href="{{ url('storage/' . $aduan->surat_permintaan) }}" class="document-link" target="_blank">
                        {{ basename($aduan->surat_permintaan) }}
                    </a>
                @else
                    <p>Tidak ada surat permintaan</p>
                @endif
            </td>
        </tr>
    </table>

    @if(!empty($aduan->dokumen_pendukung))
    <div class="section-title">DOKUMEN PENDUKUNG</div>
    @php
        $dokumen = json_decode($aduan->dokumen_pendukung);
    @endphp
    @if(is_array($dokumen) && count($dokumen) > 0)
        <table class="detail-table">
        @foreach($dokumen as $doc)
            <tr>
                <th>{{ basename($doc) }}</th>
                <td>
                    @php
                        $extension = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                        $path = storage_path('app/public/' . $doc);
                    @endphp
                    
                    @if($isImage && file_exists($path))
                        <div class="image-container">
                            @php
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            @endphp
                            <img src="{{ $base64 }}" alt="{{ basename($doc) }}">
                        </div>
                    @else
                        <a href="{{ url('storage/' . $doc) }}" class="document-link" target="_blank">
                            Lihat Dokumen
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </table>
    @else
        <p>Tidak ada dokumen pendukung</p>
    @endif
    @endif

    @if(!empty($aduan->url_data))
    <div class="section-title">DATA URL</div>
    @php
        $urlData = json_decode($aduan->url_data, true);
    @endphp
    @foreach($urlData as $index => $url)
        <div class="url-section">
            <h3>URL #{{ $index + 1 }}</h3>
            <table class="detail-table">
                <tr>
                    <th>Platform</th>
                    <td>{{ $url['platform'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td>
                        @if(!empty($url['url_link']))
                            <a href="{{ $url['url_link'] }}" class="document-link" target="_blank">
                                {{ $url['url_link'] }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi Konten</th>
                    <td>{{ $url['deskripsi_konten'] ?? '-' }}</td>
                </tr>
                @if(!empty($url['pasal']))
                <tr>
                    <th>Pasal Terkait</th>
                    <td>
                        <ul class="pasal-list">
                        @foreach((array)$url['pasal'] as $pasal)
                            <li>{{ $pasal }}</li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
                @endif
                @if(!empty($url['screenshot']))
                <tr>
                    <th>Screenshot</th>
                    <td>
                        @php
                            $extension = strtolower(pathinfo($url['screenshot'], PATHINFO_EXTENSION));
                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                            $path = storage_path('app/public/' . $url['screenshot']);
                        @endphp
                        
                        @if($isImage && file_exists($path))
                            <div class="image-container">
                                @php
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                @endphp
                                <img src="{{ $base64 }}" alt="Screenshot">
                            </div>
                        @else
                            <a href="{{ url('storage/' . $url['screenshot']) }}" class="document-link" target="_blank">
                                Lihat Screenshot
                            </a>
                        @endif
                    </td>
                </tr>
                @endif
            </table>
        </div>
    @endforeach
    @endif

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis pada {{ date('d-m-Y H:i:s') }}</p>
        <p>Catatan: Anda memerlukan akses internet untuk membuka tautan dokumen</p>
    </div>
</body>
</html>