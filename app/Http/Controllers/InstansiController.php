<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function instansi()
    {
        return view('instansi');
    }
    public function tentangkami()
    {
        return view('tentangkami');
    }
}
