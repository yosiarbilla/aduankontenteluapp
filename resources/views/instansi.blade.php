@extends('layouts.app')

@section('isi')
<style>
  /* Navigation Tabs Styles */
  .nav-tabs {
    border-bottom: none;
    background-color: white;
    width: 360px;
    padding: 8px 16px;
    border-radius: 10px;
    display: inline-flex;
    gap: 15px;
    margin: 0;
  }
  .nav-tabs .nav-link {
    border: none;
    padding: 6px 12px;
    margin-left: 10px;
    margin-right: 20px;
    text-align: center;
    display: inline-block;
    min-width: 120px;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    
  }
  .nav-link:hover {
  background-color: #10C20A;
  color: white;
}
  .nav-link {
  color: #11A90C; /* Warna default untuk link */
}

.nav-link.btn-instansi {
  color: white !important; /* Warna putih ketika active */
}
  .btn-instansi {
    background-color: #11A90C !important;
    color: white !important;
    min-width: 120px;
  }
  .btn-instansi:hover {
    background-color: #10C20A !important;
    color: white !important;
  }
  .btn-tentang-kami {
    background-color: #11A90C;
    color: #11A90C !important;
    border: 1px solid #dee2e6;
  }
  .btn-tentang-kami:hover {
    background-color: #10C20A;
    color: white !important;
  }
  .btn-tentang-kami.active {
  background-color: #11A90C !important;
  color: white !important;
}
  .active {
    box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
  }

  /* Content & Card Styles */
  .detail-label {
    font-weight: 500;
    color: #333;
  }
  .logo-container {
    width: 150px;
    height: 150px;
    margin-bottom: 1rem;
  }
  .logo-container img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
  .card {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    box-shadow: none;
    width: 100%;
    margin: 0;
  }
  .card-body {
    padding: 2rem;
  }
</style>

<div class="container-fluid mt-4 px-0">
  <!-- Navigation Tabs -->
  <div class="nav nav-tabs mb-4" style="border-bottom: none; ">
    <a href="javascript:void(0)" id="tabInstansi" class="nav-link " style="text-decoration: none;">
      Instansi
    </a>
    <a href="javascript:void(0)" id="tabTentangKami" class="nav-link btn-tentang-kami" style="text-decoration: none;">
      Tentang Kami
    </a>
  </div>

  <!-- Konten Instansi -->
  <div id="instansiContent">
    <h4 class="mb-4 px-3">Instansi</h4>
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Nama Instansi</span>
          </div>
          <div class="col-md-9">
            Pusat Sandi dan Siber TNI AD
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Logo</span>
          </div>
          <div class="col-md-9">
            <div class="logo-container">
              <img src="{{ asset('images/logo.png') }}" alt="Logo Instansi" class="img-fluid">
            </div>
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
            <span class="detail-label">Kota</span>
          </div>
          <div class="col-md-9">
            Jakarta Pusat, DKI Jakarta
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Nomor Telepon</span>
          </div>
          <div class="col-md-9">
            0812 4812 1994
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <span class="detail-label">Website</span>
          </div>
          <div class="col-md-9">
            <a href="http://www.pusansiad.tni-ad.mil.id" target="_blank">www.pusansiad.tni-ad.mil.id</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Konten Tentang Kami (disembunyikan default) -->
  <div id="tentangkamiContent" style="display: none;">
    <h4 class="mb-4 px-3">Tentang Kami</h4>
    <div class="card">
      <div class="card-body">
        <p>Ini adalah konten Tentang Kami. SOON.</p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const tabInstansi = document.getElementById("tabInstansi");
  const tabTentangKami = document.getElementById("tabTentangKami");
  const instansiContent = document.getElementById("instansiContent");
  const tentangKamiContent = document.getElementById("tentangkamiContent");

  function showInstansi() {
    // Tambah class active dan btn-instansi ke tab Instansi
    tabInstansi.classList.add("active", "btn-instansi");
    // Hapus class active dari tab Tentang Kami
    tabTentangKami.classList.remove("active");
    // Hapus class btn-instansi dari tab Tentang Kami jika ada
    tabTentangKami.classList.remove("btn-instansi");
    instansiContent.style.display = "block";
    tentangKamiContent.style.display = "none";
    localStorage.setItem("activeTab", "instansi");
  }

  function showTentangKami() {
    // Hapus class active dan btn-instansi dari tab Instansi
    tabInstansi.classList.remove("active", "btn-instansi");
    // Tambah class active ke tab Tentang Kami
    tabTentangKami.classList.add("active", "btn-instansi");
    instansiContent.style.display = "none";
    tentangKamiContent.style.display = "block";
    localStorage.setItem("activeTab", "tentangkami");
  }

  // Check localStorage for active tab
  const savedTab = localStorage.getItem("activeTab");
  if (savedTab === "tentangkami") {
    showTentangKami();
  } else {
    showInstansi();
  }

  tabInstansi.addEventListener("click", showInstansi);
  tabTentangKami.addEventListener("click", showTentangKami);
});
</script>
@endsection
