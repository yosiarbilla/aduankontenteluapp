<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AduanController extends Controller
{
    public function index()
    {
        $apiToken = session('api_token'); // Ambil token dari session

    try {
        // Panggil API eksternal untuk mendapatkan data aduan
        $response = Http::withToken($apiToken)
            ->timeout(60)
            ->get('https://instansi.aduankonten.id/api/v01/aduan');

        if ($response->successful()) {
            $data = $response->json();

            // Akses key '_items' untuk mendapatkan daftar aduan
            $aduan = $data['_items'] ?? [];

            // Mapping data untuk memastikan semua field ada
            $aduan = array_map(function ($item) {
                return [
                    'tiket_id' => $item['_id'] ?? '-',
                    'kategori' => $item['kategori'] ?? 'Tidak Diketahui',
                    'prioritas' => $item['prioritas'] ?? 'Tidak Diketahui',
                    'nomor_surat' => $item['nomor_surat'] ?? '-',
                    'instansi' => $item['instansi'] ?? '-',
                    'submit' => $item['submit'] ?? '-',
                    'update' => $item['update'] ?? '-',
                ];
            }, $aduan);

            // Kirim data ke view
            return view('aduan.index', compact('aduan'));
        }

        return back()->withErrors(['error' => 'Gagal mengambil data aduan dari API.']);
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Terjadi kesalahan saat menghubungi API: ' . $e->getMessage()]);
    }
    }
    

    public function create()
    {
        return view('aduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required',
            'prioritas' => 'required|in:Normal,Urgent,High',
            'nomor_surat' => 'required',
            'surat_permintaan' => 'required|file|max:5120',
            'dokumen_pendukung.*' => 'nullable|file|max:5120',
            'platform' => 'nullable',
            'url_link' => 'nullable|url',
            'screenshot' => 'nullable|image|max:5120',
            'deskripsi_konten' => 'nullable'
        ]);

        // Handle file uploads
        if ($request->hasFile('surat_permintaan')) {
            $validated['surat_permintaan'] = $request->file('surat_permintaan')
                ->store('surat_permintaan', 'public');
        }

        if ($request->hasFile('dokumen_pendukung')) {
            $dokumen = [];
            foreach ($request->file('dokumen_pendukung') as $file) {
                $dokumen[] = $file->store('dokumen_pendukung', 'public');
            }
            $validated['dokumen_pendukung'] = json_encode($dokumen);
        }

        if ($request->hasFile('screenshot')) {
            $validated['screenshot'] = $request->file('screenshot')
                ->store('screenshots', 'public');
        }

        Aduan::create($validated);

        return redirect()->route('aduan.index')
            ->with('success', 'Aduan berhasil dibuat.');
    }
}