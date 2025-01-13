<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TNI Siber Dashboard - Maintenance</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 100, 0, 0.8), rgba(0, 100, 0, 0.8)),
                        url('/images/background.jpg') center/cover no-repeat;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .maintenance-card {
            background: white;
            padding: 2.5rem;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            width: 120px;
            margin-bottom: 1.5rem;
        }
        .maintenance-title {
            color: #28a745;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .maintenance-message {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .estimated-time {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }
        .refresh-button {
            background-color: #28a745;
            border-color: #28a745;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 500;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s;
        }
        .refresh-button:hover {
            background-color: #218838;
            border-color: #218838;
            color: white;
        }
    </style>
</head>
<body>
    <div class="maintenance-card">
        <img src="/images/logo.png" alt="Logo" class="logo">
        <h1 class="maintenance-title">System Maintenance</h1>
        <p class="maintenance-message">
            We're currently performing scheduled maintenance to improve our services.
            We apologize for any inconvenience this may cause.
        </p>
        <div class="estimated-time">
            <p class="mb-0">
                <strong>Please check back later</strong><br>
                Our system is being updated to serve you better
            </p>
        </div>
        <a href="/" class="refresh-button">
            Refresh Page
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>