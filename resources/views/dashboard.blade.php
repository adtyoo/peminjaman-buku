<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2>Dashboard</h2>

    <p style="color: green;">
        ✅ Login berhasil!
    </p>

    <p>
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>
    </p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>
