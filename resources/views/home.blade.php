<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Home</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: #f5f7fb;
            color: #1f2937;
        }
        .container {
            max-width: 720px;
            margin: 72px auto;
            background: #ffffff;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }
        h1 { margin-top: 0; }
        .alert {
            background: #fef2f2;
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
        a.button {
            display: inline-block;
            text-decoration: none;
            background: #0f766e;
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <main class="container">
        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        <h1>Beranda AmikomEventHub</h1>
        <p>Silakan login sebagai admin untuk mengakses dashboard.</p>
        <a class="button" href="{{ route('admin.login') }}">Masuk ke Login Admin</a>
    </main>
</body>
</html>
