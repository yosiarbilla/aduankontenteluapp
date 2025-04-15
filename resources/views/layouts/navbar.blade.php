<nav>
  <!-- Tombol toggle sidebar -->
  <i class='bx bx-menu toggle-sidebar'></i>
  
  <!-- Judul Dashboard -->
  <h4 style="margin: 0; flex-grow: 1; color: #11A90C; font-family: 'Open Sans', sans-serif; font-size: 16px; font-weight:normal;">
    TNI SIBER DASHBOARD
  </h4>

  <!-- Snippet notifikasi + dropdown user -->
  <div class="d-flex align-items-center">
    <!-- Ikon Notifikasi -->
    <a href="#" class="notification-icon me-3">
      <i class="fas fa-bell"></i>
    </a>
    
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
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
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
