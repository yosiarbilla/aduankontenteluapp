<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade as PDF;

class AduanController extends Controller{
    public function index()
    {
        // $apiToken = session('api_token');
        // $stringToHash = $apiToken . 'List';
        // $signature = md5($stringToHash);

        // try {
        //     $response = Http::withToken($apiToken)
        //         ->timeout(60)
        //         ->get('https://instansi.aduankonten.id/api/v01/aduan', [
        //             'signature' => $signature,
        //             'page' => 1,
        //             'max_results' => 10,
        //         ]);

        //     if ($response->successful()) {
        //         $data = $response->json();
        //         $aduan = $data['_items'] ?? [];
        //         $kategoriMap = $this->fetchKategoriMap($apiToken);
        //         $aduan = array_map(function ($item) use ($kategoriMap) {
        //             return [
        //                 'tiket_id' => $item['ticket_num'] ?? '-',
        //                 'kategori' => $kategoriMap[$item['kategori']] ?? 'Tidak Diketahui',
        //                 'prioritas' => $item['prioritas'] ?? 'Tidak Diketahui',
        //                 'nomor_surat' => $item['nomor_surat'] ?? '-',
        //                 'instansi' => $item['instansi_id'] ?? '-',
        //                 'submit' => $item['_created'] ?? '-',
        //                 'update' => $item['_updated'] ?? '-',
        //             ];
        //         }, $aduan);

        //         return view('aduan.index', compact('aduan'));
        //     }

        //     return back()->withErrors(['error' => 'Gagal mengambil data aduan dari API.']);
        // } catch (\Exception $e) {
        //     return back()->withErrors(['error' => 'Terjadi kesalahan saat menghubungi API: ' . $e->getMessage()]);
        // }

        $aduan = Aduan::orderBy('created_at', 'desc')->get();
        $jumlahAktif = Aduan::where('status', 'active')->count();
        $jumlahSelesai = Aduan::where('status', 'selesai')->count();
        $jumlahDraft = Aduan::where('status', 'draft')->count();
        $jumlahPending = Aduan::where('status', 'pending')->count();
        
        return view('aduan.index', compact('aduan', 'jumlahAktif', 'jumlahSelesai', 'jumlahDraft', 'jumlahPending'));
    }

    private function fetchKategoriMap($apiToken)
    {
        $response = Http::withToken($apiToken)
            ->timeout(60)
            ->get('https://instansi.aduankonten.id/api/v01/category');
    
        if ($response->successful()) {
            $data = $response->json();
            return collect($data['_items'] ?? [])->pluck('name', '_id')->toArray();
        }
    
        return [];
    }
    public function create()
    {
        return view('aduan.create');
    }

    public function store(Request $request)
    {
        // Separate validation for non-file inputs
        $basicRules = [
            'kategori' => 'required',
            'prioritas' => 'required|in:Normal,Urgent,High',
            'nomor_surat' => 'required',
            'catatan_tambahan' => 'nullable',
            'platform' => 'nullable',
            'url_link' => 'nullable|url',
            'deskripsi_konten' => 'nullable',
        ];
        
        // File validation rules
        $fileRules = [
            'surat_permintaan' => 'required|file|mimes:pdf|max:5120',
            'dokumen_pendukung.*' => 'nullable|file|mimes:jpg,jpeg,png,doc,pdf|max:5120',
            'screenshot' => 'nullable|file|mimes:pdf,png|max:5120',
        ];
        
        // Validate basic inputs first
        $validator = \Validator::make($request->all(), $basicRules);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Now validate files with custom error messages
        $fileValidator = \Validator::make($request->all(), $fileRules, [
            'surat_permintaan.mimes' => 'Format surat permintaan harus PDF.',
            'surat_permintaan.max' => 'Ukuran surat permintaan maksimal 5MB.',
            'dokumen_pendukung.*.mimes' => 'Format dokumen pendukung harus JPG, PNG, DOC, atau PDF.',
            'dokumen_pendukung.*.max' => 'Ukuran dokumen pendukung maksimal 5MB.',
            'screenshot.mimes' => 'Format screenshot harus PDF atau PNG.',
            'screenshot.max' => 'Ukuran screenshot maksimal 5MB.',
        ]);
        
        if ($fileValidator->fails()) {
            // Return with specific file error messages and preserve input
            return back()->withErrors($fileValidator)->withInput();
        }
        
        // Set default status
        $status = 'draft';
        
        // Check which button was clicked
        if ($request->input('action') == 'pending') {
            $status = 'pending';
        }
        
        // Create new Aduan instance
        $aduan = new Aduan();
        $aduan->kategori = $request->kategori;
        $aduan->prioritas = $request->prioritas;
        $aduan->nomor_surat = $request->nomor_surat;
        $aduan->catatan_tambahan = $request->catatan_tambahan;
        $aduan->platform = $request->platform;
        $aduan->url_link = $request->url_link;
        $aduan->deskripsi_konten = $request->deskripsi_konten;
        $aduan->status = $status;
        
        // Upload Surat Permintaan
        if ($request->hasFile('surat_permintaan')) {
            $aduan->surat_permintaan = $request->file('surat_permintaan')->store('surat_permintaan', 'public');
        }

        // Upload Dokumen Pendukung
        if ($request->hasFile('dokumen_pendukung')) {
            $dokumen = [];
            foreach ($request->file('dokumen_pendukung') as $file) {
                $dokumen[] = $file->store('dokumen_pendukung', 'public');
            }
            $aduan->dokumen_pendukung = $dokumen; // Will be cast to JSON by model
        }

        // Upload Screenshot
        if ($request->hasFile('screenshot')) {
            $aduan->screenshot = $request->file('screenshot')->store('screenshots', 'public');
        }

        // Save to database
        $aduan->save();

        return redirect()->route('aduan.index')->with('success', 'Laporan berhasil disimpan.');
    }

    public function exportPdf($id){
        $aduan = Aduan::findOrFail($id);
    
        $pdf = Pdf::setOptions(['isRemoteEnabled' => true]) // Gunakan 'Facades\Pdf'
                ->loadView('aduan.export-pdf', compact('aduan'))
                ->setPaper('a4', 'landscape');
    
        return $pdf->stream("{$aduan->tiket_id}.pdf", ['Attachment' => 0]); // Pastikan variabelnya benar
    }
    

    public function show($id){
        $detailAduan = Aduan::findOrFail($id);
        return view('aduan.detail', compact('detailAduan'));
    }

    public function edit(Aduan $aduan)
    {
        if ($aduan->status == 'pending') {
            return redirect()->route('aduan.index')->with('error', 'Data tidak bisa diedit!');
        }

        return view('aduan.edit', compact('aduan'));
    }

    public function kirim($id)
    {
        $aduan = Aduan::findOrFail($id);
        
        // Pastikan hanya aduan dengan status draft yang bisa dikirim
        if ($aduan->status != 'draft') {
            return redirect()->route('aduan.index')
                ->with('error', 'Hanya aduan dengan status draft yang dapat dikirim!');
        }
        
        // Update status menjadi pending
        $aduan->status = 'pending';
        $aduan->save();
        
        // Logika tambahan jika diperlukan (notifikasi, log, dll)
        
        return redirect()->route('aduan.index')
            ->with('success', 'Aduan berhasil dikirim dan status diubah menjadi pending.');
    }

    // Tambahkan juga method update jika belum ada
    public function update(Request $request, Aduan $aduan)
    {
        // Pastikan hanya aduan dengan status draft yang bisa diedit
        if ($aduan->status != 'draft') {
            return redirect()->route('aduan.index')
                ->with('error', 'Data tidak bisa diedit!');
        }
        
        // Validasi input
        $basicRules = [
            'kategori' => 'required',
            'prioritas' => 'required|in:Normal,Urgent,High',
            'nomor_surat' => 'required',
            'catatan_tambahan' => 'nullable',
            'platform' => 'nullable',
            'url_link' => 'nullable|url',
            'deskripsi_konten' => 'nullable',
        ];
        
        // File validation rules - hanya validasi jika ada file baru
        $fileRules = [];
        
        if ($request->hasFile('surat_permintaan')) {
            $fileRules['surat_permintaan'] = 'file|mimes:pdf|max:5120';
        }
        
        if ($request->hasFile('dokumen_pendukung')) {
            $fileRules['dokumen_pendukung.*'] = 'file|mimes:jpg,jpeg,png,doc,pdf|max:5120';
        }
        
        if ($request->hasFile('screenshot')) {
            $fileRules['screenshot'] = 'file|mimes:pdf,png|max:5120';
        }
        
        // Gabungkan validasi
        $rules = array_merge($basicRules, $fileRules);
        
        $validator = \Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Update data
        $aduan->kategori = $request->kategori;
        $aduan->prioritas = $request->prioritas;
        $aduan->nomor_surat = $request->nomor_surat;
        $aduan->catatan_tambahan = $request->catatan_tambahan;
        $aduan->platform = $request->platform;
        $aduan->url_link = $request->url_link;
        $aduan->deskripsi_konten = $request->deskripsi_konten;
        
        // Upload Surat Permintaan jika ada
        if ($request->hasFile('surat_permintaan')) {
            // Hapus file lama jika ada
            if ($aduan->surat_permintaan) {
                Storage::disk('public')->delete($aduan->surat_permintaan);
            }
            $aduan->surat_permintaan = $request->file('surat_permintaan')->store('surat_permintaan', 'public');
        }

        // Upload Dokumen Pendukung jika ada
        if ($request->hasFile('dokumen_pendukung')) {
            // Hapus file lama jika ada
            if (!empty($aduan->dokumen_pendukung)) {
                foreach ($aduan->dokumen_pendukung as $doc) {
                    Storage::disk('public')->delete($doc);
                }
            }
            
            $dokumen = [];
            foreach ($request->file('dokumen_pendukung') as $file) {
                $dokumen[] = $file->store('dokumen_pendukung', 'public');
            }
            $aduan->dokumen_pendukung = $dokumen;
        }

        // Upload Screenshot jika ada
        if ($request->hasFile('screenshot')) {
            // Hapus file lama jika ada
            if ($aduan->screenshot) {
                Storage::disk('public')->delete($aduan->screenshot);
            }
            $aduan->screenshot = $request->file('screenshot')->store('screenshots', 'public');
        }

        // Set status berdasarkan tombol yang diklik
        if ($request->input('action') == 'pending') {
            $aduan->status = 'pending';
        }

        // Simpan perubahan
        $aduan->save();

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil diperbarui.');
    }

    public function destroy(Aduan $aduan)
    {
        // Pastikan hanya aduan dengan status tertentu yang bisa dihapus
        if ($aduan->status != 'draft') {
            return redirect()->route('aduan.index')
                ->with('error', 'Hanya aduan dengan status draft yang dapat dihapus!');
        }
        
        // Hapus file-file terkait
        if ($aduan->surat_permintaan) {
            Storage::disk('public')->delete($aduan->surat_permintaan);
        }
        
        if (!empty($aduan->dokumen_pendukung)) {
            foreach ($aduan->dokumen_pendukung as $doc) {
                Storage::disk('public')->delete($doc);
            }
        }
        
        if ($aduan->screenshot) {
            Storage::disk('public')->delete($aduan->screenshot);
        }
        
        // Hapus data
        $aduan->delete();
        
        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil dihapus.');
    }

    // Method baru untuk approval
    public function approve(Aduan $aduan)
    {
        // Pastikan hanya aduan dengan status pending yang bisa disetujui
        if ($aduan->status != 'pending') {
            return redirect()->route('aduan.index')
                ->with('error', 'Hanya aduan dengan status pending yang dapat disetujui!');
        }
        
        // Update status menjadi active
        $aduan->status = 'active';
        $aduan->save();
        
        return redirect()->route('aduan.index')
            ->with('success', 'Aduan berhasil disetujui dan status diubah menjadi active.');
    }
}