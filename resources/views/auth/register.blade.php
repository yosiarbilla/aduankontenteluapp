@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="guest-card">
    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="TNI Siber" class="logo">
    </div>

    <h4 class="text-center mb-4">Daftar</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <input type="text" 
                   name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   placeholder="Nama"
                   value="{{ old('name') }}" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input type="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Email"
                   value="{{ old('email') }}" 
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" 
                   name="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   placeholder="Password" 
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" 
                   name="password_confirmation" 
                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                   placeholder="Konfirmasi Password" 
                   required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Daftar</button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none text-muted small">
                Sudah punya akun? Masuk
            </a>
        </div>
    </form>

    <p class="help-text">
        Apabila terjadi masalah, laporkan ke 0811 2333 4441
    </p>
</div>
@endsection