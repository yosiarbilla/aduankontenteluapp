@extends('layouts.guest')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
    <div class="guest-card">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="TNI Siber" class="logo">
        </div>

        <h4 class="text-center mb-4">404 - Halaman Tidak Ditemukan</h4>

        <div class="alert alert-danger mb-4">
            <p class="mb-0 text-center">Halaman yang anda cari tidak ditemukan.</p>
        </div>

        <a href="{{ route('dashboard') }}"class="btn btn-primary mb-3">Kembali ke Dashboard</a>

        <p class="help-text">
            Apabila terjadi masalah, laporkan ke 0811 2333 4441
        </p>
    </div>

@endsection