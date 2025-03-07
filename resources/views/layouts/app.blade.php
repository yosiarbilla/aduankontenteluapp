<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	
	<!-- (Opsional) Bootstrap CSS untuk dropdown & utilitas seperti d-flex -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<!-- File CSS Anda -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<title>Aduan Konten TNI</title>
	<style>
    /* Nilai default (sidebar muncul) */
    #content {
      position: relative;
      left: 260px;
      width: calc(100% - 260px);
      transition: all .3s ease;
    }

    /* Kondisi hideSidebar => lebar penuh */
    @if(!empty($hideSidebar) && $hideSidebar === true)
    #content {
      left: 0 !important;
      width: 100% !important;
    }
    @endif
    </style>
</head>
<body>
	@php
        // Cek apakah ada $hideSidebar, jika tidak ada, default false
        $hideSidebar = $hideSidebar ?? false;
		$hideToggle = $hideToggle ?? false;
    @endphp
	@if(!$hideSidebar)
	<!-- SIDEBAR -->
<section 
  id="sidebar" 
  style="
    display: flex; 
    flex-direction: column; 
    height: 100vh; /* Agar sidebar memenuhi tinggi layar */
  "
>
  <div class="text-center" style="margin-bottom: 20px; padding-top: 15px;">
    <img 
      src="{{ asset('images/logo.png') }}" 
      alt="Logo TNI Siber" 
      class="logo img-fluid" 
      style="width: 80%; max-width: 150px; height: auto;"
    >
  </div>
  <ul 
    class="side-menu" 
    style="
      display: flex; 
      flex-direction: column; 
      padding: 0; 
      margin: 0;
      flex: 1; /* Biarkan ul melebar ke sisa ruang */
    "
  >
    <!-- Beranda -->
    <li>
      <a 
        href="{{ route('dashboard') }}" 
        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
        style="display: flex; align-items: center; padding: 12px 20px; justify-content: flex-start;"
      >
        <i class="fas fa-home icon" style="width: 20px; text-align: center; margin-right: 10px;"></i> 
        <span class="menu-text">Beranda</span>
      </a>
    </li>
    <!-- Aduan -->
    <li>
      <a 
        href="{{ route('aduan.index') }}" 
        class="nav-link {{ request()->routeIs('aduan.index') ? 'active' : '' }}"
        style="display: flex; align-items: center; padding: 12px 20px; justify-content: flex-start;"
      >
        <i class="fas fa-file-alt icon" style="width: 20px; text-align: center; margin-right: 10px;"></i> 
        <span class="menu-text">Aduan</span>
      </a>
    </li>
    <!-- Instansi -->
    <li>
      <a 
        href="{{ route('instansi') }}" 
        class="nav-link {{ request()->routeIs('instansi') ? 'active' : '' }}"
        style="display: flex; align-items: center; padding: 12px 20px; justify-content: flex-start;"
      >
        <i class="fas fa-building icon" style="width: 20px; text-align: center; margin-right: 10px;"></i> 
        <span class="menu-text">Instansi</span>
      </a>
    </li>
    <!-- Log Out di Bawah -->
    <li 
      style="
        margin-top: auto; 
        margin-bottom: 20px;
      "
    >
      <a 
        href="{{ route('logout') }}" 
        class="nav-link"
        style="
          display: flex; 
          align-items: center; 
          padding: 12px 20px;
          justify-content: flex-start;
        "
      >
        <i class="fas fa-sign-out-alt icon" style="width: 20px; text-align: center; margin-right: 10px;"></i> 
        <span class="menu-text">Keluar</span>
      </a>
    </li>
  </ul>
</section>
@endif
<!-- END SIDEBAR -->
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<!-- Tombol toggle sidebar -->
			@if(!$hideToggle)
			<i class='bx bx-menu toggle-sidebar'></i>
			@endif
			
			<!-- Judul Dashboard -->
			<h4 style="margin: 0; flex-grow: 1; color: #11A90C; font-family: 'Open Sans', sans-serif; font-size: 16px; font-weight:normal;">
				TNI SIBER DASHBOARD
			</h4>

			<!-- Snippet yang Anda minta (notifikasi + dropdown user) -->
			<div class="d-flex align-items-center">
				<!-- Ikon Notifikasi -->
				<a href="#" class="notification-icon me-3">
					<i class="fas fa-bell"></i>
				</a>
				
				<!-- Bagian Auth (hanya tampil jika user login) -->
				@auth
					<div class="dropdown">
						<button 
							class="btn dropdown-toggle user-dropdown" 
							type="button" 
							data-bs-toggle="dropdown"
							aria-expanded="false"
						>
							{{ Auth::user()->name }}
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="{{ route('profile.show') }}">
									Profile
								</a>
							</li>
							<li>
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<button type="submit" class="dropdown-item">
										Logout
									</button>
								</form>
							</li>
						</ul>
					</div>
				@endauth
			</div>
		</nav>
		<!-- END NAVBAR -->

		<!-- MAIN -->
		<main>
			@yield('isi')
		</main>
		<!-- END MAIN -->
	</section>
	<!-- END CONTENT -->

	<!-- (Opsional) Bootstrap JS untuk dropdown berfungsi -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	
	<!-- Apexcharts (jika diperlukan) -->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<!-- File JS Anda -->
	<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
