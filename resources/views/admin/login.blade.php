<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AmikomEventHub</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #ecfeff, #f8fafc);
            color: #1f2937;
        }
        .card {
            max-width: 420px;
            margin: 60px auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.1);
        }
        h1 { margin: 0 0 18px; font-size: 24px; }
        label { display: block; margin: 10px 0 6px; font-weight: 600; }
        input {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }
        .error {
            margin-top: 12px;
            background: #fef2f2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
        }
        button {
            margin-top: 16px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #0f766e;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Login Admin</h1>
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
    </main>
</body>
</html>
