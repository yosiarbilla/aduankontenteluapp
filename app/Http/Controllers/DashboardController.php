<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai per_page dari request, default ke 10
        $perPage = $request->input('per_page', 10);
        
        // Buat query dasar berdasarkan peran pengguna
        if (Auth::user()->role_id == 4) { // Jika user biasa
            $query = Aduan::where('user_id', Auth::id());
        } else {
            // Untuk admin dan peran lainnya, ambil semua aduan
            $query = Aduan::query();
        }
        
        // Dapatkan aduan terbaru dengan paginasi
        $aduan = $query->orderBy('created_at', 'desc')
                      ->paginate($perPage)
                      ->withQueryString();
        
        return view('dashboard', compact('aduan'));
    }
}