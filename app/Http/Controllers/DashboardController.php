<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $aduan = Aduan::orderBy('created_at', 'desc')->take(8)->get();
        return view('dashboard', compact('aduan'));
    }
}