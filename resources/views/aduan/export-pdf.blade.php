<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Aduan {{ $aduan->ticket_id }}</title>
    <!-- Plus Jakarta Sans font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: white;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            height: 100px;
            margin-bottom: 10px;
        }
        .kominfo-header {
            color: #0d2185;
            text-align: center;
            line-height: 1.4;
        }
        .kominfo-header .title {
            font-weight: bold;
            font-size: 16px;
        }
        .kominfo-header .motto {
            color: #1a76bb;
            font-style: italic;
            font-size: 16px;
        }
        .kominfo-header .address {
            font-size: 12px;
        }
        .horizontal-line {
            border-top: 2px solid #0d6efd;
            margin: 10px 0;
        }
        .detail-title {
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            margin: 30px 0 20px;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .content-table tr {
            border-bottom: 1px solid #ddd;
        }
        .content-table tr:last-child {
            border-bottom: none;
        }
        .content-table td {
            padding: 8px 4px;
            vertical-align: top;
        }
        .content-table td:first-child {
            width: 150px;
            font-weight: normal;
        }
        .content-table td:nth-child(2) {
            width: 10px;
            text-align: center;
        }
        .screenshot-container {
            margin: 5px 0;
            text-align: left;
        }
        .screenshot-container img {
            max-width: 300px;
            border: 1px solid #000;
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
        @php
            // Coba cari logo di public folder
            $logoPath = public_path('images/logokomdigi2.png');
            $logoBase64 = '';
            
            // Jika ada di public folder
            if (file_exists($logoPath)) {
                $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                $logoData = file_get_contents($logoPath);
                $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($logoData);
            } else {
                // Coba cari di storage folder
                $logoStoragePath = storage_path('app/public/images/logokomdigi2.png');
                if (file_exists($logoStoragePath)) {
                    $type = pathinfo($logoStoragePath, PATHINFO_EXTENSION);
                    $logoData = file_get_contents($logoStoragePath);
                    $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($logoData);
                } else {
                    // Coba cari logokomdigi2.png sebagai alternatif
                    $logoAltPath = public_path('images/logokomdigi2.png');
                    if (file_exists($logoAltPath)) {
                        $type = pathinfo($logoAltPath, PATHINFO_EXTENSION);
                        $logoData = file_get_contents($logoAltPath);
                        $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($logoData);
                    }
                }
            }
        @endphp
        <img src="{{ $logoBase64 }}" alt="Logo Kominfo" class="logo">
        <div class="kominfo-header">
            <div class="title">KEMENTERIAN KOMUNIKASI DAN DIGITRAL RI</div>
            <div class="title">DIREKTORAT JENDERAL KOMUNIKASI PUBLIK DAN MEDIA</div>
        </div>
    </div>
    
    <div class="horizontal-line"></div>
    
    <h2 class="detail-title">DETAIL ADUAN</h2>
    
    <table class="content-table">
        <tr>
            <td>Ticket ID</td>
            <td>:</td>
            <td>{{ $aduan->ticket_id }}</td>
        </tr>
        <tr>
            <td>Waktu Pelaporan</td>
            <td>:</td>
            <td>{{ $aduan->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <td>Prioritas</td>
            <td>:</td>
            <td>{{ $aduan->prioritas }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $aduan->kategori }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $aduan->status }}</td>
        </tr>
        @if(isset($aduan->narahubung))
        <tr>
            <td>Narahubung</td>
            <td>:</td>
            <td>{{ $aduan->narahubung }}</td>
        </tr>
        @endif
        <tr>
            <td>Instansi</td>
            <td>:</td>
            <td>{{ $aduan->instansi }}</td>
        </tr>
        <tr>
            <td>No. Surat</td>
            <td>:</td>
            <td>{{ $aduan->nomor_surat }}</td>
        </tr>
        @if(!empty($aduan->catatan_tambahan))
        <tr>
            <td>Catatan Tambahan</td>
            <td>:</td>
            <td>{{ $aduan->catatan_tambahan }}</td>
        </tr>
        @endif
    </table>
    
    <div class="horizontal-line"></div>
    
    @if(!empty($aduan->surat_permintaan))
    <table class="content-table">
        <tr>
            <td>Surat Permintaan</td>
            <td>:</td>
            <td>
                <a href="{{ url('storage/' . $aduan->surat_permintaan) }}" class="document-link" target="_blank">
                    {{ basename($aduan->surat_permintaan) }}
                </a>
            </td>
        </tr>
    </table>
    <div class="horizontal-line"></div>
    @endif
    
    @if(!empty($aduan->dokumen_pendukung))
    @php
        $dokumen = json_decode($aduan->dokumen_pendukung);
    @endphp
    @if(is_array($dokumen) && count($dokumen) > 0)
        <table class="content-table">
            <tr>
                <td>Dokumen Pendukung</td>
                <td>:</td>
                <td>
                    @foreach($dokumen as $doc)
                        @php
                            $extension = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
                            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                            $path = storage_path('app/public/' . $doc);
                        @endphp
                        
                        <div style="margin-bottom: 10px;">
                            <div>{{ basename($doc) }}</div>
                            @if($isImage && file_exists($path))
                                <div class="image-container">
                                    @php
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        // Baca file dan reduksi ukurannya
                                        if(filesize($path) > 500000) { // Jika lebih dari 500KB
                                            $image = imagecreatefromstring(file_get_contents($path));
                                            // Reduksi ukuran gambar ke 50% dengan kualitas 70%
                                            $width = imagesx($image) * 0.5;
                                            $height = imagesy($image) * 0.5;
                                            $resized = imagecreatetruecolor($width, $height);
                                            imagecopyresampled($resized, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
                                            ob_start();
                                            imagejpeg($resized, null, 70);
                                            $data = ob_get_clean();
                                            imagedestroy($image);
                                            imagedestroy($resized);
                                        } else {
                                            $data = file_get_contents($path);
                                        }
                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    @endphp
                                    <img src="{{ $base64 }}" alt="{{ basename($doc) }}">
                                </div>
                            @else
                                <a href="{{ url('storage/' . $doc) }}" class="document-link" target="_blank">
                                    Lihat Dokumen
                                </a>
                            @endif
                        </div>
                    @endforeach
                </td>
            </tr>
        </table>
        <div class="horizontal-line"></div>
    @endif
    @endif
    
    @if(!empty($aduan->url_data))
    @php
        $urlData = json_decode($aduan->url_data, true);
    @endphp
    @foreach($urlData as $index => $url)
        <table class="content-table">
            <tr>
                <td>URL #{{ $index + 1 }} ({{ $url['platform'] ?? 'WEBSITE' }})</td>
                <td>:</td>
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
            @if(!empty($url['deskripsi_konten']))
            <tr>
                <td>Deskripsi Konten</td>
                <td>:</td>
                <td>{{ $url['deskripsi_konten'] }}</td>
            </tr>
            @endif
            @if(!empty($url['screenshot']))
            <tr>
                <td>Screenshot</td>
                <td>:</td>
                <td>
                    @php
                        $extension = strtolower(pathinfo($url['screenshot'], PATHINFO_EXTENSION));
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                        $path = storage_path('app/public/' . $url['screenshot']);
                    @endphp
                    
                    @if($isImage && file_exists($path))
                        <div class="screenshot-container">
                            @php
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                // Baca file dan reduksi ukurannya
                                if(filesize($path) > 500000) { // Jika lebih dari 500KB
                                    $image = imagecreatefromstring(file_get_contents($path));
                                    // Reduksi ukuran gambar ke 50% dengan kualitas 70%
                                    $width = imagesx($image) * 0.5;
                                    $height = imagesy($image) * 0.5;
                                    $resized = imagecreatetruecolor($width, $height);
                                    imagecopyresampled($resized, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
                                    ob_start();
                                    imagejpeg($resized, null, 70);
                                    $data = ob_get_clean();
                                    imagedestroy($image);
                                    imagedestroy($resized);
                                } else {
                                    $data = file_get_contents($path);
                                }
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
            @if(!empty($url['pasal']))
            <tr>
                <td>Dasar Hukum</td>
                <td>:</td>
                <td>
                    @foreach((array)$url['pasal'] as $index => $pasal)
                        {{ ($index + 1) }}. {{ $pasal }}{{ !$loop->last ? '<br>' : '' }}
                    @endforeach
                </td>
            </tr>
            @endif
        </table>
        <div class="horizontal-line"></div>
    @endforeach
    @endif
    
    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis pada {{ date('d-m-Y H:i:s') }}</p>
        <p>Catatan: Anda memerlukan akses internet untuk membuka tautan dokumen</p>
    </div>
</body>
</html>