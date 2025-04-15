@extends('layouts.guest')

@section('title', '403 - Akses Ditolak')

@section('content')
    <div class="guest-card">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="TNI Siber" class="logo">
        </div>

        <h4 class="text-center mb-4">403 - Akses Ditolak</h4>
        
        <div class="alert alert-warning mb-4">
            <p class="mb-0 text-center">Anda tidak diizinkan untuk mengakses halaman ini.</p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Kembali ke Dashboard</a>

        <p class="help-text">
            Apabila terjadi masalah, laporkan ke 0811 2333 4441
        </p>
    </div>
@endsection