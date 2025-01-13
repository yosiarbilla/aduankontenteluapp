@extends('layouts.guest')

@section('title', 'Login')

@push('scripts-head')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@section('content')
<div class="guest-card">
    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="TNI Siber" class="logo">
    </div>

    <h4 class="text-center mb-4">Masuk</h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
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
            <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
            @error('g-recaptcha-response')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Masuk</button>

        <div class="text-center">
            <a href="{{ route('password.request') }}" class="text-decoration-none text-muted small">
                Lupa Password?
            </a>
        </div>
    </form>

    <p class="help-text">
        Apabila terjadi masalah, laporkan ke 0811 2333 4441
    </p>
</div>
@endsection
