@extends('layouts.app')

@section('isi')
@php
    $hideSidebar = true;  // Menyembunyikan sidebar
    $hideToggle = true;   // Menyembunyikan ikon toggle
@endphp

<style>
    .container {
        max-width: 900px; /* Biar tidak terlalu lebar */
        margin: 20px auto;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 20px;
    }
     .profile-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .card-body {
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 20px;
        color:#555;
    }
    /* Foto profil di kiri */
    .img-fluid {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }
    /* Tiap baris info */
    .profile-info {
        margin-bottom: 8px;
    }
    .detail-label {
        font-weight: bold;
        margin-right: 5px;
       color:black;
    }
    /* Garis pemisah */
    .divider {
        border-top: 1px solid #ddd;
        margin: 20px 0;
    }
    /* Tombol Kembali */
    .back-button {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        margin-bottom: 20px;
        display: inline-block;
    }
    .back-button i {
        margin-right: 4px;
    }
    /* Tombol Edit Profil di pojok kanan bawah card */
    .edit-profile-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 8px 16px;
        text-decoration: none;
    }
    .edit-profile-btn:hover {
        background-color: #218838;
        color: #fff;
    }
    /* Letakkan tombol di kanan bawah */
    .edit-profile-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }
</style>

<div class="container">
    <!-- Tombol Kembali -->
    <a href="{{ route('dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- Card Profil -->
    <div id="instansiContent">
    <div class="card">
    <div class="profile-title">Profil Pengguna</div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Nama Lengkap</span>
          </div>
          <div class="col-md-9">
            {{ $user->name }}
          </div>
        </div>
        @if($user->pangkat)
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Pangkat</span>
          </div>
          <div class="col-md-9">
            {{ $user->pangkat }}
          </div>
        </div>
        @endif
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Role</span>
          </div>
          <div class="col-md-9">
            <span class="badge bg-{{ $user->role_id == 1 ? 'danger' : ($user->role_id == 2 ? 'warning' : ($user->role_id == 3 ? 'info' : 'secondary')) }}">
                {{ $user->role->name ?? 'Tidak Ada Role' }}
            </span>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Foto</span>
          </div>
          <div class="col-md-9">
            <div class="foto-container">
              @if($user->foto)
                <img src="{{ asset('storage/profile/' . $user->foto) }}" alt="Foto Profil" class="img-fluid">
              @else
                <img src="{{ asset('images/logo.png') }}" alt="Default Logo" class="img-fluid">
              @endif
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Email</span>
          </div>
          <div class="col-md-9">
            {{ $user->email }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Nomor Telepon</span>
          </div>
          <div class="col-md-9">
            {{ $user->phone ?? '-' }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Terdaftar Sejak</span>
          </div>
          <div class="col-md-9">
            {{ $user->created_at->format('d F Y') }}
          </div>
        </div>
      </div>
      <div class="edit-profile-container">
        <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
            <i class="fas fa-edit"></i> Edit Profil
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Sweet Alert untuk notifikasi sukses
    @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      timer: 3000,
      showConfirmButton: false
    });
    @endif
  });
</script>
@endsection
