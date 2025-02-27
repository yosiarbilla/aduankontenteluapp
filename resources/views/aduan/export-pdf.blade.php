<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>

        <th>
            {{ $aduan->ticket_id }}
        </th>
        <tr>
            <td>
                {{ $aduan->kategori }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->prioritas }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->nomor_surat }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->instansi }}
            </td>
        </tr>
        <tr>
            <td>
                @php
                    $path = public_path('uploads/' . $aduan->surat_permintaan); // Gabungkan path dengan titik (.)
                    if (file_exists($path)) {
                        // Cek apakah file ada atau tidak
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $img = 'data:image/' . $type . ';base64,' . base64_encode($data); // Gabungkan string dengan titik (.)
                    } else {
                        $img = '';
                    }
                @endphp

                @if ($img != '')
                    <img src="{{ $img }}" alt="Surat Permintaan" width="300">
                @else
                    <p>Gambar tidak ditemukan</p>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->dokumen }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->catatan_tambahan }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->platform }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->url_link }}
            </td>
        </tr>
        <tr>
            <td>
                @php
                    $path = public_path('uploads/' . $aduan->screenshot); // Gabungkan path dengan titik (.)
                    if (file_exists($path)) {
                        // Cek apakah file ada atau tidak
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $img = 'data:image/' . $type . ';base64,' . base64_encode($data); // Gabungkan string dengan titik (.)
                    } else {
                        $img = '';
                    }
                @endphp

                @if ($img != '')
                    <img src="{{ $img }}" alt="Screenshot" width="300">
                @else
                    <p>Gambar tidak ditemukan</p>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->deskripsi_konten }}
            </td>
        </tr>
        <tr>
            <td>
                {{ $aduan->status }}
            </td>
        </tr>
    </table>
</body>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        background-color: #04AA6D;
        color: white;
    }
</style>

</html>
