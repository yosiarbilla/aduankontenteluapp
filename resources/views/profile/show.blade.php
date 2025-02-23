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
            John Asep
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Jabatan</span>
          </div>
          <div class="col-md-9">
            Kolonel
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Foto</span>
          </div>
          <div class="col-md-9">
            <div class="logo-container">
              <img src="{{ asset('images/logo.png') }}" alt="Logo Instansi" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Nomor Telepon</span>
          </div>
          <div class="col-md-9">
            08512345678
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Alamat</span>
          </div>
          <div class="col-md-9">
            Jl. Veteran No.5, Gambir, Jakarta Pusat
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Email</span>
          </div>
          <div class="col-md-9">
            Johndoe@gmail.com
          </div>
        </div>
      </div>
      <div class="edit-profile-container">
                    <a href="#" class="edit-profile-btn">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
    </div>
  </div>
</div>
@endsection
