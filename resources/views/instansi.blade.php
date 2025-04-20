@extends('layouts.app')

@section('isi')
<style>
  /* Navigation Tabs Styles */
  .nav-tabs {
    border-bottom: none;
    background-color: white;
    width: 100%;
    max-width: 360px;
    padding: 8px 16px;
    border-radius: 10px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin: 0 auto;
  }
  .nav-tabs .nav-link {
    border: none;
    padding: 10px 15px;
    margin: 0;
    text-align: center;
    display: inline-block;
    min-width: 120px;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  .nav-link:hover {
    background-color: #10C20A;
    color: white;
  }
  .nav-link {
    color: #11A90C; /* Warna default untuk link */
    font-weight: 500;
    background-color: transparent;
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
    color: #11A90C !important;
    background-color: transparent;
    border: none;
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
  <div class="nav nav-tabs mb-4" style="border-bottom: none; display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center;">
    <a href="javascript:void(0)" id="tabInstansi" class="nav-link" style="text-decoration: none;">
      Instansi
    </a>
    <a href="javascript:void(0)" id="tabTentangKami" class="nav-link" style="text-decoration: none;">
      Tentang Kami
    </a>
  </div>

  <!-- Konten Instansi -->
  <div id="instansiContent">
    <h4 class="mb-4 px-3">Instansi</h4>
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-3 col-sm-4 mb-2 mb-md-0">
            <span class="detail-label">Nama Instansi</span>
          </div>
          <div class="col-md-9 col-sm-8">
            Pusat Sandi dan Siber TNI AD
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 col-sm-4 mb-2 mb-md-0">
            <span class="detail-label">Logo</span>
          </div>
          <div class="col-md-9 col-sm-8">
            <div class="logo-container">
              <img src="{{ asset('images/logo.png') }}" alt="Logo Instansi" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 col-sm-4 mb-2 mb-md-0">
            <span class="detail-label">Alamat</span>
          </div>
          <div class="col-md-9 col-sm-8">
            Jl. Veteran No.5, Gambir, Jakarta Pusat
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 col-sm-4 mb-2 mb-md-0">
            <span class="detail-label">Kota</span>
          </div>
          <div class="col-md-9 col-sm-8">
            Jakarta Pusat, DKI Jakarta
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 col-sm-4 mb-2 mb-md-0">
            <span class="detail-label">Nomor Telepon</span>
          </div>
          <div class="col-md-9 col-sm-8">
            0812 4812 1994
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 col-sm-4 mb-2 mb-md-0">
            <span class="detail-label">Website</span>
          </div>
          <div class="col-md-9 col-sm-8">
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
        <!-- TNI Siber Section -->
        <div class="mb-4">
          <h5 class="fw-bold mb-3">Tentang Siber TNI</h5>
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-3">
              <img src="{{ asset('images/tnilayar.jpeg') }}" alt="TNI Siber Command Center" class="img-fluid rounded" style="width: 100%;">
            </div>
            <div class="col-lg-8 col-md-6">
              <p style="line-height: 1.5; text-align: justify; margin-bottom: 8px;">
                Satuan Siber Tentara Nasional Indonesia (Satsiber TNI) bertugas menyelenggarakan kegiatan dan operasi siber di lingkungan TNI dalam rangka mendukung tugas pokok TNI. Satsiber TNI dipimpin oleh Komandan Satsiber TNI (Dansatsiber TNI) berkedudukan di bawah dan bertanggung jawab kepada Panglima TNI dalam pelaksanaan tugas sehari-hari dikoordinasikan oleh Kasum TNI.
              </p>
              <p class="text-muted fst-italic" style="font-size: 0.8rem; margin-bottom: 0;">Via Wikipedia</p>
            </div>
          </div>
        </div>
        
        <!-- Divider between sections -->
        <hr class="my-4">
        
        <!-- Sejarah Section -->
        <div>
          <h5 class="fw-bold mb-3">Sejarah Siber TNI</h5>
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-3">
              <img src="{{ asset('images/tnittd.jpeg') }}" alt="Sejarah TNI Siber" class="img-fluid rounded" style="width: 100%;">
            </div>
            <div class="col-lg-8 col-md-6">
              <p style="line-height: 1.5; text-align: justify; margin-bottom: 8px;">
                Rencana pembentukan Angkatan Siber Tentara Nasional Indonesia (TNI) kembali mengemuka setelah terjadinya berbagai serangan siber di Indonesia, termasuk ransomware server Pusat Data Nasional (PDN). Salah satu serangan ke server PDN berdampak pada data milk Badan Intelijen Strategis (BAIS) TNI yang diretas dan diperjualbelikan di dark web. Sebelumnya, usulan untuk membentuk Angkatan Siber TNI muncul dari mantan gubernur Lembaga Ketahanan Nasional (Lemhannas), Andi Widjajanto, yang menekankan bahwa invasi atau penyerangan ke suatu negara tidak lagi selalu melalui armada perang dan persenjataan, tetapi melalui peperangan siber (cyber warfare).
              </p>
            
              <p class="text-muted fst-italic" style="font-size: 0.8rem; margin-top: 0.3rem; margin-bottom: 0;">Via Berita DPR RI</p>
            </div>
          </div>
        </div>
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
    // Ubah tampilan tab Instansi menjadi aktif
    tabInstansi.classList.add("active", "btn-instansi");
    tabInstansi.style.backgroundColor = "#11A90C";
    tabInstansi.style.color = "white";
    
    // Kembalikan tampilan tab Tentang Kami ke default
    tabTentangKami.classList.remove("active", "btn-instansi");
    tabTentangKami.style.backgroundColor = "transparent";
    tabTentangKami.style.color = "#11A90C";
    
    // Tampilkan konten Instansi, sembunyikan Tentang Kami
    instansiContent.style.display = "block";
    tentangKamiContent.style.display = "none";
    
    // Simpan state di local storage
    localStorage.setItem("activeTab", "instansi");
  }

  function showTentangKami() {
    // Kembalikan tampilan tab Instansi ke default
    tabInstansi.classList.remove("active", "btn-instansi");
    tabInstansi.style.backgroundColor = "transparent";
    tabInstansi.style.color = "#11A90C";
    
    // Ubah tampilan tab Tentang Kami menjadi aktif
    tabTentangKami.classList.add("active", "btn-instansi");
    tabTentangKami.style.backgroundColor = "#11A90C";
    tabTentangKami.style.color = "white";
    
    // Tampilkan konten Tentang Kami, sembunyikan Instansi
    instansiContent.style.display = "none";
    tentangKamiContent.style.display = "block";
    
    // Simpan state di local storage
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
