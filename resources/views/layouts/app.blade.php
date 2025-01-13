<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TNI Siber Dashboard') }} - @yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Navbar */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .navbar {
            background-color: #f8f9fa;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-title {
            font-weight: bold;
            font-size: 24px;
            color: #28a745;
        }
        .notification-icon {
            margin-right: 20px;
            font-size: 18px;
            color: #6c757d;
        }
        .notification-icon:hover {
            color: #28a745;
        }
        .dropdown-toggle::after {
            margin-left: 0.5rem;
        }
        .user-dropdown {
            font-size: 16px;
        }



        /* Responsiveness */

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <span class="navbar-title">TNI Siber Dashboard</span>
        <div class="d-flex align-items-center">
            <!-- Notification Icon -->
            <a href="#" class="notification-icon">
                <i class="fas fa-bell"></i>
            </a>
            <!-- User Dropdown -->
            @auth
            <div class="dropdown">
                <button class="btn dropdown-toggle user-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>



    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
