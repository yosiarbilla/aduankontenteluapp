<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Parameter request yang lebih jelas
        $perPage = $request->input('per_page', 10); // Jumlah item per halaman
        $currentPage = $request->input('page', 1);  // Halaman saat ini
        
        // Buat query dasar berdasarkan peran pengguna
        if (Auth::user()->role_id == 3) { // Jika user biasa (role_id 3)
            // Ambil data dari API endpoint /aduan
            $aduan = $this->getAduanFromApi($perPage, $currentPage);
        } else {
            // Untuk admin dan peran lainnya, ambil semua aduan dari database lokal
            $query = Aduan::query();
            
            // Dapatkan aduan terbaru dengan paginasi
            $aduan = $query->orderBy('created_at', 'desc')
                          ->paginate($perPage)
                          ->withQueryString();
        }
        
        return view('dashboard', compact('aduan'));
    }
    
    /**
     * Mengambil data aduan dari API endpoint
     *
     * @param int $perPage
     * @param int $currentPage
     * @return LengthAwarePaginator
     */
    private function getAduanFromApi($perPage, $currentPage)
    {
        // Ambil token API menggunakan data user yang sedang login
        $token = $this->getApiToken();
        // Jika token tidak berhasil didapatkan, kembalikan koleksi kosong
        if (!$token) {
            return new LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
        
        // Buat signature berdasarkan format yang diberikan (md5 dari token + "List")
        $stringToHash = $token . 'List';
        $signature = md5($stringToHash);
        
        try {
            // Kirim request ke endpoint /aduan dengan parameter yang sesuai
            $response = Http::withToken($token)
                ->timeout(60)
                ->get('https://instansi.aduankonten.id/api/v01/aduan', [
                    'signature' => $signature,
                    'page' => $currentPage,
                    'max_results' => $perPage,
                ]);
            
            // Periksa apakah request berhasil
            if ($response->successful()) {
                // Parse response JSON
                $data = $response->json();
                
                // Transformasi data dari API ke format yang diharapkan view
                $items = collect($data['_items'] ?? [])->map(function ($item) {
                    // Mendekode kategori jika berupa ID atau format khusus
                    $kategori = $this->decodeKategori($item['kategori'] ?? '');
                    
                    // Mendekode instansi jika berupa ID
                    $instansi = $this->decodeInstansi($item['instansi_id'] ?? '');
                    
                    // Menentukan prioritas yang lebih mudah dibaca
                    $prioritas = $this->decodePrioritas($item['prioritas'] ?? '');
                    
                    // Format nomor surat
                    $nomorSurat = $item['no_permintaan'] ?? '';
                    if (empty($nomorSurat)) {
                        // Jika nomor surat kosong, gunakan format default
                        $nomorSurat = 'S-500/SWI/' . date('Y');
                    }
                    
                    return (object) [
                        'id' => $item['_id'] ?? '',
                        'ticket_id' => $item['ticket_num'] ?? '',
                        'kategori' => $kategori,
                        'prioritas' => $prioritas,
                        'nomor_surat' => $nomorSurat,
                        'instansi' => $instansi,
                        'created_at' => \Carbon\Carbon::parse($item['_created'] ?? now()),
                        'updated_at' => \Carbon\Carbon::parse($item['_updated'] ?? now()),
                    ];
                });
                
                $total = $data['_meta']['total'] ?? 0;
                
                // Buat LengthAwarePaginator untuk format yang sama dengan Eloquent pagination
                return new LengthAwarePaginator(
                    $items,
                    $total,
                    $perPage,
                    $currentPage,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            }
        } catch (\Exception $e) {
            // Log error jika perlu
            Log::error('API Request Error: ' . $e->getMessage());
        }
        
        // Return empty paginator jika terjadi error
        return new LengthAwarePaginator(
            collect([]),
            0,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
    
    /**
     * Mendapatkan API token untuk autentikasi menggunakan user saat ini
     *
     * @return string|null
     */
    private function getApiToken()
    {
        $user = Auth::user();
        // Base URL untuk API
        $baseUrl = 'https://instansi.aduankonten.id/api/v01';
        
        try {
            // Buat request ke endpoint auth menggunakan email dan password user yang login
            $response = Http::post($baseUrl . '/auth', [
                'email' => $user->email,
                'password' => 'Password123!', // Catatan: Ini mungkin perlu disesuaikan
            ]);
            
            // Jika autentikasi berhasil
            if ($response->successful()) {
                $data = $response->json();
                
                // Cek apakah respons sesuai dengan yang diharapkan
                if (isset($data['token'])) {
                    return $data['token'];
                }
                
                // Cek struktur respons seperti contoh di gambar
                if (isset($data['account']) && isset($data['account']['token'])) {
                    return $data['account']['token'];
                }
            }
        } catch (\Exception $e) {
            // Log error jika perlu
            Log::error('API Authentication Error: ' . $e->getMessage());
        }
        
        return null;
    }
    
    /**
     * Mendekode kode kategori menjadi nama yang lebih mudah dibaca
     *
     * @param string $kategoriCode
     * @return string
     */
    private function decodeKategori($kategoriCode)
    {
        // Mapping kategori kode ke nama yang mudah dibaca
        $kategoriMap = [
            '5a5948261029980e496b8ac2' => 'Konten Berbahaya',
            '5a5948261029980e496b8ac3' => 'Pencemaran Nama Baik',
            '5a5948261029980e496b8abf' => 'Informasi Palsu',
            // Tambahkan mapping lain sesuai kebutuhan
        ];
        
        return $kategoriMap[$kategoriCode] ?? 'Kategori Lainnya';
    }
    
    /**
     * Mendekode kode instansi menjadi nama yang lebih mudah dibaca
     *
     * @param string $instansiCode
     * @return string
     */
    private function decodeInstansi($instansiCode)
    {
        // Mapping instansi kode ke nama yang mudah dibaca
        $instansiMap = [
            '61566d5de21bc43757fb3678' => 'TNI AD',
            '61567cb869391963fb3681' => 'Polda Metro Jaya',
            '61566d9cb32d00cd03fb367a' => 'Kementerian Pertahanan',
            '61566cd32a3dd91a5efb3679' => 'Kementerian Komunikasi',
            // Tambahkan mapping lain sesuai kebutuhan
        ];
        
        return $instansiMap[$instansiCode] ?? 'Instansi Lainnya';
    }
    
    /**
     * Mendekode kode prioritas menjadi status yang lebih mudah dibaca
     *
     * @param string $prioritasCode
     * @return string
     */
    private function decodePrioritas($prioritasCode)
    {
        // Mapping prioritas kode ke nama yang mudah dibaca
        $prioritasMap = [
            '5a5948261029980e496b8ab2' => 'Normal',
            '5a5948261029980e496b8ab3' => 'Urgent',
            '5a5948261029980e496b8ab1' => 'Low',
            '5a5948261029980e496b8ab4' => 'High',
            '5a5948261029980e496b8ab5' => 'Medium',
        ];
        
        return $prioritasMap[$prioritasCode] ?? 'Normal';
    }
}