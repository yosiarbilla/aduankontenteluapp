<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TNI Siber Dashboard') }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('scripts-head')
    <style>
        body {
            background: linear-gradient(rgba(0, 100, 0, 0.8), rgba(0, 100, 0, 0.8)),
                        url('{{ asset("images/background.jpg") }}') center/cover no-repeat;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .guest-card {
            background: white;
            padding: 2.5rem;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo {
            width: 120px;
            margin-bottom: 1.5rem;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            width: 100%;
            padding: 0.75rem;
            color: white;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #218838;
        }
        .form-control {
            padding: 0.75rem;
            margin-bottom: 1rem;
        }
        .help-text {
            color: #6c757d;
            font-size: 0.875rem;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
