<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AmikomEventHub</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #475569;
            --primary: #0f766e;
            --danger: #b91c1c;
            --border: #dbe4ee;
            --soft: #ecfeff;
        }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: linear-gradient(180deg, #eff6ff 0%, var(--bg) 38%);
            color: var(--text);
        }
        .layout {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px 40px;
        }
        .hero, .panel, .table-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }
        .hero {
            padding: 28px;
            margin-bottom: 20px;
        }
        h1, h2 { margin-top: 0; }
        .meta { color: var(--muted); margin-bottom: 14px; }
        .message {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
            border: 1px solid transparent;
        }
        .message.success { background: #ecfdf5; color: #166534; border-color: #bbf7d0; }
        .message.error { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
        .grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 20px;
        }
        .panel, .table-card { padding: 24px; }
        label {
            display: block;
            font-weight: 700;
            margin: 12px 0 8px;
        }
        input, textarea {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 14px;
            font: inherit;
            background: #fff;
        }
        textarea { min-height: 120px; resize: vertical; }
        .hint { font-size: 0.92rem; color: var(--muted); margin-top: 6px; }
        .errors {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #fff1f2;
            color: #9f1239;
        }
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
        }
        button, .logout-btn {
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            cursor: pointer;
            font-weight: 700;
        }
        button {
            background: var(--primary);
            color: #fff;
        }
        .logout-btn {
            background: var(--danger);
            color: #fff;
        }
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border-bottom: 1px solid var(--border);
            text-align: left;
            padding: 12px 10px;
            vertical-align: top;
        }
        th { background: #f8fafc; }
        .poster {
            width: 90px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #f8fafc;
        }
        .empty {
            padding: 18px;
            border: 1px dashed var(--border);
            border-radius: 12px;
            color: var(--muted);
            background: #fcfcfd;
        }
        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="layout">
        <section class="hero">
            <h1>Dashboard Admin</h1>
            <p class="meta">Selamat datang, {{ auth()->user()->name }} (Role: {{ auth()->user()->role }})</p>
            <p>Halaman ini digunakan untuk menambahkan event baru, mengunggah poster ke storage/app/public/posters, dan memvalidasi harga tiket.</p>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </section>

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        <section class="grid">
            <div class="panel">
                <h2>Form Input Event</h2>
                <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                    @csrf

                    <label for="title">Nama Event</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required>

                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>

                    <label for="ticket_price">Harga Tiket</label>
                    <input id="ticket_price" type="number" name="ticket_price" value="{{ old('ticket_price') }}" min="0" required>
                    <div class="hint">Validasi min:0 mencegah input harga negatif seperti -5.</div>

                    <label for="poster">Poster Event</label>
                    <input id="poster" type="file" name="poster" accept="image/*" required>
                    <div class="hint">File akan disimpan otomatis ke folder public/posters melalui storage Laravel.</div>

                    @if ($errors->any())
                        <div class="errors">
                            <strong>Terjadi kesalahan validasi:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="actions">
                        <button type="submit">Simpan Event</button>
                    </div>
                </form>
            </div>

            <div class="table-card">
                <h2>Penjelasan Uji</h2>
                <p class="meta">Coba masukkan nilai <strong>-5</strong> pada harga tiket. Sistem akan menolak karena aturan validasi <strong>min:0</strong>.</p>
                <p class="meta">Setelah upload berhasil, cek folder <strong>storage/app/public/posters</strong> atau akses file melalui <strong>/storage/posters</strong> jika storage link sudah dibuat.</p>
                <p class="meta">Nama file poster akan digenerate otomatis oleh Laravel sehingga tidak sama dengan nama asli upload.</p>
            </div>
        </section>

        <section class="table-card" style="margin-top: 20px;">
            <h2>Daftar Event Tersimpan</h2>
            @if ($events->count())
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Nama Event</th>
                                <th>Deskripsi</th>
                                <th>Harga Tiket</th>
                                <th>Poster Path</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>
                                        <img class="poster" src="{{ asset('storage/' . $event->poster_path) }}" alt="Poster {{ $event->title }}">
                                    </td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description ?? '-' }}</td>
                                    <td>Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</td>
                                    <td>{{ $event->poster_path }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty">Belum ada event yang tersimpan. Silakan isi form di atas untuk membuat event pertama.</div>
            @endif
        </section>
    </main>
</body>
</html>
