<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('role:admin,manager')->only(['approve']);
        $this->middleware('role:admin,manager,petugas')->only(['destroy']);
    }
    public function index()
    {
        $perPage = request('per_page', 10);

        if (auth()->user()->role_id == 4) {
            $query = Aduan::where('user_id', auth()->id());
        } else {
            $query = Aduan::query();
        }

        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                    ->orWhere('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('instansi', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('prioritas', 'like', "%{$search}%");
            });
        }

        if (request()->filled('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        if (request()->filled('date_from')) {
            $query->whereDate('created_at', '>=', request('date_from'));
        }

        if (request()->filled('date_to')) {
            $query->whereDate('created_at', '<=', request('date_to'));
        }

        $sortBy = request('sort_by');
        $sortDir = request('sort_dir', 'desc');

        $allowedSortColumns = ['ticket_id', 'kategori', 'prioritas', 'nomor_surat', 'instansi', 'created_at', 'updated_at'];

        if ($sortBy && in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $aduan = $query->paginate($perPage)->withQueryString();

        $statsQuery = Aduan::query();

        if (auth()->user()->role_id == 4) {
            $statsQuery->where('user_id', auth()->id());
        }

        if (request()->filled('search')) {
            $search = request('search');
            $statsQuery->where(function ($q) use ($search) {
                $q->where('ticket_id', 'like', "%{$search}%")
                    ->orWhere('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('instansi', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if (request()->filled('kategori')) {
            $statsQuery->where('kategori', request('kategori'));
        }

        if (request()->filled('date_from')) {
            $statsQuery->whereDate('created_at', '>=', request('date_from'));
        }

        if (request()->filled('date_to')) {
            $statsQuery->whereDate('created_at', '<=', request('date_to'));
        }

        $jumlahAktif = (clone $statsQuery)->where('status', 'active')->count();
        $jumlahSelesai = (clone $statsQuery)->where('status', 'selesai')->count();
        $jumlahDraft = (clone $statsQuery)->where('status', 'draft')->count();
        $jumlahPending = (clone $statsQuery)->where('status', 'pending')->count();

        return view('aduan.index', compact('aduan', 'jumlahAktif', 'jumlahSelesai', 'jumlahDraft', 'jumlahPending'));
    }

    private function fetchKategoriMap($apiToken)
    {
        $response = Http::withToken($apiToken)->timeout(60)->get('https://instansi.aduankonten.id/api/v01/category');

        if ($response->successful()) {
            $data = $response->json();
            return collect($data['_items'] ?? [])
                ->pluck('name', '_id')
                ->toArray();
        }

        return [];
    }
    public function create()
    {
        return view('aduan.create');
    }

    public function store(Request $request)
    {
        $basicRules = [
            'kategori' => 'required',
            'prioritas' => 'required|in:Normal,Urgent,High',
            'nomor_surat' => 'required',
            'catatan_tambahan' => 'nullable',
            'platform' => 'nullable',
            'url_link' => 'nullable|url',
            'deskripsi_konten' => 'nullable',
            'pasal' => 'nullable|array',
            'pasal.*' => 'nullable|string',
            'platform2' => 'nullable',
            'url_link2' => 'nullable|url',
            'deskripsi_konten2' => 'nullable',
            'pasal2' => 'nullable|array',
            'pasal2.*' => 'nullable|string',
        ];

        $fileRules = [
            'surat_permintaan' => 'required|file|mimes:pdf|max:5120',
            'dokumen_pendukung.*' => 'nullable|file|mimes:jpg,jpeg,png,doc,pdf|max:5120',
            'screenshot' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'screenshot2' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'csv_file' => 'nullable|file|mimes:csv,txt|max:5120',
        ];

        $validator = Validator::make($request->all(), $basicRules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $fileValidator = Validator::make($request->all(), $fileRules, [
            'surat_permintaan.mimes' => 'Format surat permintaan harus PDF.',
            'surat_permintaan.max' => 'Ukuran surat permintaan maksimal 5MB.',
            'dokumen_pendukung.*.mimes' => 'Format dokumen pendukung harus JPG, PNG, DOC, atau PDF.',
            'dokumen_pendukung.*.max' => 'Ukuran dokumen pendukung maksimal 5MB.',
            'screenshot.mimes' => 'Format screenshot harus JPG, PNG atau PDF.',
            'screenshot.max' => 'Ukuran screenshot maksimal 5MB.',
            'screenshot2.mimes' => 'Format screenshot URL 2 harus JPG, PNG atau PDF.',
            'screenshot2.max' => 'Ukuran screenshot URL 2 maksimal 5MB.',
            'csv_file.mimes' => 'Format file harus CSV.',
            'csv_file.max' => 'Ukuran file CSV maksimal 5MB.',
        ]);

        if ($fileValidator->fails()) {
            return back()->withErrors($fileValidator)->withInput();
        }

        $status = 'draft';

        if ($request->input('action') == 'pending') {
            $status = 'pending';
        }

        $aduan = new Aduan();
        $aduan->kategori = $request->kategori;
        $aduan->prioritas = $request->prioritas;
        $aduan->nomor_surat = $request->nomor_surat;
        $aduan->catatan_tambahan = $request->catatan_tambahan;
        $aduan->status = $status;
        $aduan->user_id = auth()->id();
        $urlData = [];

        if ($request->filled('platform') || $request->filled('url_link')) {
            $urlEntry = [
                'platform' => $request->platform,
                'url_link' => $request->url_link,
                'deskripsi_konten' => $request->deskripsi_konten,
                'pasal' => $request->pasal ?? [],
            ];

            if ($request->hasFile('screenshot')) {
                $urlEntry['screenshot'] = $request->file('screenshot')->store('screenshots', 'public');
            }

            $urlData[] = $urlEntry;
        }

        if ($request->filled('platform2') || $request->filled('url_link2')) {
            $urlEntry = [
                'platform' => $request->platform2,
                'url_link' => $request->url_link2,
                'deskripsi_konten' => $request->deskripsi_konten2,
                'pasal' => $request->pasal2 ?? [],
            ];

            if ($request->hasFile('screenshot2')) {
                $urlEntry['screenshot'] = $request->file('screenshot2')->store('screenshots', 'public');
            }

            $urlData[] = $urlEntry;
        }

        if ($request->hasFile('csv_file')) {
            $path = $request->file('csv_file')->getRealPath();
            $csvData = array_map('str_getcsv', file($path));

            $headers = array_shift($csvData);

            foreach ($csvData as $row) {
                $rowData = array_combine($headers, $row);

                if (!empty($rowData['platform']) || !empty($rowData['url_link'])) {
                    $pasalData = !empty($rowData['pasal']) ? explode(',', $rowData['pasal']) : [];

                    $urlEntry = [
                        'platform' => $rowData['platform'] ?? null,
                        'url_link' => $rowData['url_link'] ?? null,
                        'deskripsi_konten' => $rowData['deskripsi_konten'] ?? null,
                        'pasal' => $pasalData,
                    ];

                    $urlData[] = $urlEntry;
                }
            }
        }

        $aduan->url_data = json_encode($urlData);

        if ($request->hasFile('surat_permintaan')) {
            $aduan->surat_permintaan = $request->file('surat_permintaan')->store('surat_permintaan', 'public');
        }

        if ($request->hasFile('dokumen_pendukung')) {
            $dokumen = [];
            foreach ($request->file('dokumen_pendukung') as $file) {
                $dokumen[] = $file->store('dokumen_pendukung', 'public');
            }
            $aduan->dokumen_pendukung = json_encode($dokumen);
        }

        $aduan->save();

        return redirect()->route('aduan.index')->with('success', 'Laporan berhasil disimpan.');
    }

    public function exportPdf($id)
    {
        // Set unlimited execution time untuk function ini
        ini_set('max_execution_time', 300); // 5 menit
        ini_set('memory_limit', '512M'); // Tambah batas memori

        $aduan = Aduan::with('user')->findOrFail($id);

        $pdf = PDF::setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'defaultFont' => 'Arial',
            'dpi' => 72,
            'debugCss' => false,
        ])
            ->loadView('aduan.export-pdf', compact('aduan'))
            ->setPaper('a4', 'portrait'); // Changed to portrait for better readability

        return $pdf->stream("{$aduan->ticket_id}.pdf", ['Attachment' => 0]);
    }

    public function show($id)
    {
        $detailAduan = Aduan::findOrFail($id);
        $urlData = json_decode($detailAduan->url_data, true);

        return view('aduan.detail', compact('detailAduan', 'urlData'));
    }

    public function edit(Aduan $aduan)
    {
        // Cek kepemilikan data dan status
        if (auth()->user()->role_id != 1 && $aduan->user_id != auth()->id()) {
            return redirect()->route('aduan.index')->with('error', 'Anda tidak memiliki akses untuk mengedit aduan ini.');
        }

        if ($aduan->status == 'pending') {
            return redirect()->route('aduan.index')->with('error', 'Data tidak bisa diedit!');
        }

        // Decode url_data JSON menjadi array
        $urlData = json_decode($aduan->url_data, true);

        // Kirim data ke view
        return view('aduan.edit', compact('aduan', 'urlData'));
    }

    public function kirim($id)
    {
        $aduan = Aduan::findOrFail($id);

        // Pastikan hanya aduan dengan status draft yang bisa dikirim
        if ($aduan->status != 'draft') {
            return redirect()->route('aduan.index')->with('error', 'Hanya aduan dengan status draft yang dapat dikirim!');
        }

        // Update status menjadi pending
        $aduan->status = 'pending';
        $aduan->save();

        // Logika tambahan jika diperlukan (notifikasi, log, dll)

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil dikirim dan status diubah menjadi pending.');
    }

    // Tambahkan juga method update jika belum ada
    public function update(Request $request, Aduan $aduan)
    {
        // Log the entire request data for debugging
        Log::info('Request data:', $request->all());

        if (auth()->user()->role_id != 1 && $aduan->user_id != auth()->id()) {
            return redirect()->route('aduan.index')->with('error', 'Anda tidak memiliki akses untuk mengupdate aduan ini.');
        }

        // Verify the aduan status first
        if ($aduan->status != 'draft') {
            return redirect()->route('aduan.index')->with('error', 'Hanya aduan dengan status draft yang dapat diedit!');
        }

        // Validation rules
        $basicRules = [
            'kategori' => 'required',
            'prioritas' => 'required|in:Normal,Urgent,High',
            'nomor_surat' => 'required',
            'catatan_tambahan' => 'nullable',
        ];

        // File validation rules
        $fileRules = [];
        if ($request->hasFile('surat_permintaan')) {
            $fileRules['surat_permintaan'] = 'file|mimes:pdf|max:5120';
        }
        if ($request->hasFile('dokumen_pendukung')) {
            $fileRules['dokumen_pendukung.*'] = 'file|mimes:jpg,jpeg,png,doc,pdf|max:5120';
        }
        if ($request->hasFile('screenshot')) {
            $fileRules['screenshot.*'] = 'file|mimes:jpg,jpeg,png,pdf|max:5120';
        }

        // Combine validation rules
        $rules = array_merge($basicRules, $fileRules);

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update basic fields
        $aduan->kategori = $request->kategori;
        $aduan->prioritas = $request->prioritas;
        $aduan->nomor_surat = $request->nomor_surat;
        $aduan->catatan_tambahan = $request->catatan_tambahan;

        // Prepare URL data
        $urlData = [];

        // Handle platform data - ensure we're properly processing arrays
        if ($request->has('platform') && $request->has('url_link')) {
            $platforms = $request->platform;
            $urlLinks = $request->url_link;
            $deskripsis = $request->deskripsi_konten;
            $screenshots = $request->file('screenshot');

            // Make sure we're dealing with arrays
            if (!is_array($platforms)) {
                $platforms = [$platforms];
            }
            if (!is_array($urlLinks)) {
                $urlLinks = [$urlLinks];
            }
            if (!is_array($deskripsis)) {
                $deskripsis = [$deskripsis];
            }

            // Process each platform entry
            for ($i = 0; $i < count($platforms); $i++) {
                if (empty($platforms[$i]) && empty($urlLinks[$i])) {
                    continue;
                }

                $urlEntry = [
                    'platform' => $platforms[$i] ?? null,
                    'url_link' => $urlLinks[$i] ?? null,
                    'deskripsi_konten' => $deskripsis[$i] ?? null,
                    'pasal' => isset($request->pasal[$i]) ? $request->pasal[$i] : [],
                ];

                // Handle screenshot upload
                if ($screenshots && isset($screenshots[$i])) {
                    $urlEntry['screenshot'] = $screenshots[$i]->store('screenshots', 'public');
                } elseif (isset($urlData[$i]['screenshot'])) {
                    // Keep existing screenshot if available
                    $oldUrlData = json_decode($aduan->url_data, true);
                    if (isset($oldUrlData[$i]['screenshot'])) {
                        $urlEntry['screenshot'] = $oldUrlData[$i]['screenshot'];
                    }
                }

                $urlData[] = $urlEntry;
            }
        }

        // Update URL data
        $aduan->url_data = json_encode($urlData);

        // Handle file uploads
        if ($request->hasFile('surat_permintaan')) {
            // Delete old file if exists
            if ($aduan->surat_permintaan) {
                Storage::disk('public')->delete($aduan->surat_permintaan);
            }
            $aduan->surat_permintaan = $request->file('surat_permintaan')->store('surat_permintaan', 'public');
        }

        // Handle document uploads
        if ($request->hasFile('dokumen_pendukung')) {
            // Delete old documents
            if (!empty($aduan->dokumen_pendukung)) {
                $oldDocs = is_string($aduan->dokumen_pendukung) ? json_decode($aduan->dokumen_pendukung, true) : $aduan->dokumen_pendukung;

                if (is_array($oldDocs)) {
                    foreach ($oldDocs as $doc) {
                        Storage::disk('public')->delete($doc);
                    }
                }
            }

            // Store new documents
            $dokumen = [];
            foreach ($request->file('dokumen_pendukung') as $file) {
                $dokumen[] = $file->store('dokumen_pendukung', 'public');
            }
            $aduan->dokumen_pendukung = json_encode($dokumen);
        }

        // Set status based on clicked button
        $aduan->status = $request->input('action') == 'pending' ? 'pending' : 'draft';

        // Save changes with exception handling
        try {
            $aduan->save();
            return redirect()
                ->route('aduan.show', ['aduan' => $aduan->id])
                ->with('success', 'Aduan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Save error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy(Aduan $aduan)
    {
        if (auth()->user()->role_id != 1 && $aduan->user_id != auth()->id()) {
            return redirect()->route('aduan.index')->with('error', 'Anda tidak memiliki akses untuk menghapus aduan ini.');
        }
        // Pastikan hanya aduan dengan status tertentu yang bisa dihapus
        if ($aduan->status != 'draft') {
            return redirect()->route('aduan.index')->with('error', 'Hanya aduan dengan status draft yang dapat dihapus!');
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
        // Hanya admin dan manager yang bisa menyetujui aduan
        if (!in_array(auth()->user()->role_id, [1, 2])) {
            return redirect()->route('aduan.index')->with('error', 'Anda tidak memiliki akses untuk menyetujui aduan.');
        }

        // Pastikan hanya aduan dengan status onreview yang bisa disetujui
        if ($aduan->status != 'onreview') {
            return redirect()->route('aduan.index')->with('error', 'Hanya aduan dengan status onreview yang dapat disetujui!');
        }

        // Update status menjadi active
        $aduan->status = 'active';
        $aduan->save();

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil disetujui dan status diubah menjadi active.');
    }

    public function reject(Aduan $aduan)
    {
        $this->authorize('reject', $aduan); // Pastikan hanya manager yang bisa menolak aduan

        $aduan->update(['status' => 'ditolak']);

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil ditolak');
    }

    // Method untuk menerima review
    public function reviewAccept(Aduan $aduan)
    {
        // Hanya petugas yang bisa mereview aduan
        if (auth()->user()->role_id != 3) {
            return redirect()->route('aduan.index')->with('error', 'Anda tidak memiliki akses untuk mereview aduan.');
        }

        // Pastikan hanya aduan dengan status pending yang bisa direview
        if ($aduan->status != 'pending') {
            return redirect()->route('aduan.index')->with('error', 'Hanya aduan dengan status pending yang dapat direview!');
        }

        // Update status menjadi onreview
        $aduan->status = 'onreview';
        $aduan->save();

        return redirect()->route('aduan.index')->with('success', 'Review diterima dan status diubah menjadi onreview.');
    }

    // Method untuk menolak review
    public function reviewReject(Aduan $aduan)
    {
        // Hanya petugas yang bisa menolak review aduan
        if (auth()->user()->role_id != 3) {
            return redirect()->route('aduan.index')->with('error', 'Anda tidak memiliki akses untuk menolak review aduan.');
        }

        // Pastikan hanya aduan dengan status pending yang bisa ditolak reviewnya
        if ($aduan->status != 'pending') {
            return redirect()->route('aduan.index')->with('error', 'Hanya aduan dengan status pending yang dapat ditolak!');
        }

        // Update status kembali menjadi draft
        $aduan->status = 'draft';
        $aduan->save();

        return redirect()->route('aduan.index')->with('success', 'Review ditolak dan status dikembalikan menjadi draft.');
    }
}
