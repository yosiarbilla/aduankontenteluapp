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
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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

          /* Override styles for logout button */
          .logout-button {
            background: transparent !important;
            color: #000 !important;
          }
          .logout-button:hover {
            background: #11A90C !important;
            color: white !important;
          }
          li.active .logout-button {
            background: transparent !important;
            color: #000 !important;
          }
          
          /* New sidebar styles to match design */
          #sidebar {
            background-color: white !important;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
          }
          
          .side-menu li {
            margin-bottom: 5px;
          }
          
          .side-menu a.nav-link,
          .side-menu button.nav-link {
            color: #000 !important;
            border-radius: 0 !important;
            position: relative;
            transition: all 0.3s;
            font-weight: normal;
          }
          
          .side-menu a.nav-link:hover,
          .side-menu button.nav-link:hover {
            background-color: rgba(17, 169, 12, 0.05) !important;
            color: #11A90C !important;
          }
          
          .side-menu a.nav-link.active,
          .side-menu a.nav-link.active:hover {
            background-color: white !important;
            color: #11A90C !important;
            font-weight: 500;
          }
          
          .side-menu a.nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #11A90C;
          }
          
          .side-menu i.icon {
            color: #000;
          }
          
          .side-menu a.nav-link.active i.icon,
          .side-menu a.nav-link:hover i.icon {
            color: #11A90C;
          }
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
          <section id="sidebar" style="
          display: flex; 
          flex-direction: column; 
          height: 100vh; /* Agar sidebar memenuhi tinggi layar */
          background-color: white;
          box-shadow: 0 0 10px rgba(0,0,0,0.05);
          width: 260px;
          ">
          <div class="text-center" style="margin-bottom: 30px; padding-top: 20px;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo TNI Siber" class="logo img-fluid"
            style="width: 80%; max-width: 120px; height: auto;">
          </div>
          <ul class="side-menu" style="
            display: flex; 
            flex-direction: column; 
            padding: 0; 
            margin: 0;
            flex: 1; /* Biarkan ul melebar ke sisa ruang */
          ">
            <!-- Beranda -->
            <li>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
              style="display: flex; align-items: center; padding: 14px 20px; justify-content: flex-start;">
              <i class="fas fa-home icon" style="width: 24px; text-align: center; margin-right: 10px;"></i>
              <span class="menu-text">Beranda</span>
            </a>
            </li>
            <!-- Aduan -->
            <li>
            <a href="{{ route('aduan.index') }}" class="nav-link {{ request()->routeIs('aduan.index') || request()->routeIs('aduan.*') ? 'active' : '' }}"
              style="display: flex; align-items: center; padding: 14px 20px; justify-content: flex-start;">
              <i class="fas fa-file-alt icon" style="width: 24px; text-align: center; margin-right: 10px;"></i>
              <span class="menu-text">Aduan</span>
            </a>
            </li>
            <!-- Instansi -->
            <li>
            <a href="{{ route('instansi') }}" class="nav-link {{ request()->routeIs('instansi') ? 'active' : '' }}"
              style="display: flex; align-items: center; padding: 14px 20px; justify-content: flex-start;">
              <i class="fas fa-building icon" style="width: 24px; text-align: center; margin-right: 10px;"></i>
              <span class="menu-text">Instansi</span>
            </a>
            </li>
            @if (auth()->user()->role_id == 1)
                          {{-- Hanya admin --}}
                          <li class="nav-item">
                              <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}" 
                              style="display: flex; align-items: center; padding: 14px 20px; justify-content: flex-start;">
                                <i class="fas fa-users icon" style="width: 24px; text-align: center; margin-right: 10px;"></i>
                                <span class="menu-text">Manajemen User</span>
                              </a>
                          </li>
                      @endif
            <!-- Log Out di Bawah -->
            <li style="
            margin-top: auto; 
            margin-bottom: 20px;
            ">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="nav-link logout-button"
              style="display: flex; align-items: center; padding: 14px 20px; justify-content: flex-start; background: none; border: none; width: 100%; text-align: left;">
              <i class="fas fa-sign-out-alt icon" style="width: 24px; text-align: center; margin-right: 10px;"></i>
              <span class="menu-text">Keluar</span>
              </button>
            </form>
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
            <h4
              style="margin: 0; flex-grow: 1; color: #11A90C; font-family: 'Open Sans', sans-serif; font-size: 16px; font-weight:normal;">
              TNI SIBER DASHBOARD
            </h4>

            <!-- Snippet yang Anda minta (notifikasi + dropdown user) -->
            <div class="d-flex align-items-center">
              <!-- Ikon Notifikasi -->
              <a href="#" class="notification-icon me-3 position-relative" id="notificationIcon">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  3
                </span>
              </a>
              
              <!-- Dropdown Notifikasi -->
              <div class="notification-dropdown" id="notificationDropdown" style="display: none; position: fixed; top: 60px; right: 70px; width: 320px; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); z-index: 9999;">
                <div class="p-3 border-bottom">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Notifikasi</h6>
                    <a href="#" class="text-decoration-none small">Tandai semua dibaca</a>
                  </div>
                </div>
                <div style="max-height: 320px; overflow-y: auto;">
                  <!-- Notifikasi 1 -->
                  <div class="p-3 border-bottom notification-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div style="width: 40px; height: 40px; background-color: #e9f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                          <i class="fas fa-file-alt text-success"></i>
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <p class="mb-1 small"><strong>Aduan Baru</strong></p>
                        <p class="small text-muted mb-1">Ada aduan baru yang perlu ditinjau</p>
                        <p class="small text-muted mb-0">2 menit yang lalu</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Notifikasi 2 -->
                  <div class="p-3 border-bottom notification-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div style="width: 40px; height: 40px; background-color: #e9f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                          <i class="fas fa-check-circle text-success"></i>
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <p class="mb-1 small"><strong>Aduan Disetujui</strong></p>
                        <p class="small text-muted mb-1">Aduan #12345 telah disetujui</p>
                        <p class="small text-muted mb-0">1 jam yang lalu</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Notifikasi 3 -->
                  <div class="p-3 notification-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div style="width: 40px; height: 40px; background-color: #e9f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                          <i class="fas fa-user-plus text-success"></i>
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <p class="mb-1 small"><strong>Pengguna Baru</strong></p>
                        <p class="small text-muted mb-1">Ada pengguna baru yang terdaftar</p>
                        <p class="small text-muted mb-0">Kemarin</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="p-2 border-top text-center">
                  <a href="#" class="text-decoration-none small">Lihat semua notifikasi</a>
                </div>
              </div>

              <!-- Bagian Auth (hanya tampil jika user login) -->
              @auth
            <div class="dropdown">
              <button class="btn dropdown-toggle user-dropdown" type="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ route('profile.show') }}">
                Profil
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
        <script src="{{ asset('js/script.js') }}"></script>
        
        <!-- Notification Dropdown Script -->
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const notificationIcon = document.getElementById('notificationIcon');
            const notificationDropdown = document.getElementById('notificationDropdown');
            
            // Toggle notification dropdown
            if (notificationIcon && notificationDropdown) {
              notificationIcon.addEventListener('click', function(e) {
                e.preventDefault();
                notificationDropdown.style.display = 
                  notificationDropdown.style.display === 'none' ? 'block' : 'none';
              });
              
              // Close dropdown when clicking elsewhere
              document.addEventListener('click', function(e) {
                if (notificationDropdown.style.display === 'block' && 
                    !notificationDropdown.contains(e.target) && 
                    !notificationIcon.contains(e.target)) {
                  notificationDropdown.style.display = 'none';
                }
              });
            }
            
            // Highlight notification items on hover
            const notificationItems = document.querySelectorAll('.notification-item');
            notificationItems.forEach(item => {
              item.addEventListener('mouseover', function() {
                this.style.backgroundColor = '#f8f9fa';
              });
              item.addEventListener('mouseout', function() {
                this.style.backgroundColor = 'transparent';
              });
            });
          });
        </script>
        <!-- END CONTENT -->
      </body>

      </html>