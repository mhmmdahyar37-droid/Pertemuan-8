<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AmikomEventHub</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: #f8fafc;
            color: #111827;
        }
        .layout {
            max-width: 760px;
            margin: 64px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(2, 6, 23, 0.1);
            padding: 24px;
        }
        h1 { margin-top: 0; }
        .meta {
            color: #374151;
            margin-bottom: 20px;
        }
        button {
            border: none;
            border-radius: 8px;
            background: #b91c1c;
            color: white;
            padding: 10px 14px;
            cursor: pointer;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <main class="layout">
        <h1>Dashboard Admin</h1>
        <p class="meta">Selamat datang, {{ auth()->user()->name }} (Role: {{ auth()->user()->role }})</p>
        <p>Area ini hanya dapat diakses oleh pengguna dengan role admin.</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </main>
</body>
</html>
