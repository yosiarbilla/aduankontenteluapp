
<style>
.sidebar {
        background-color: #f8f9fa;
        height: 100vh;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 60px;
        left: 0;
        width: 220px;
        overflow-y: auto;
        z-index: 999;
    }

    .sidebar .logo {
        max-width: 120px;
        margin: 0 auto 20px auto;
        display: block;
    }

    .sidebar .nav-link {
        font-size: 16px;
        margin-bottom: 15px;
        color: #343a40;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        color: #28a745;
        font-weight: bold;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 18px;
    }
</style>
<div class="sidebar">
    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo TNI Siber" class="logo img-fluid">
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Beranda
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('aduan.index') }}" class="nav-link {{ request()->routeIs('aduan.index') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Aduan
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-building"></i> Instansi
            </a>
        </li>
    </ul>
</div>


