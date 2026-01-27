<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

{{-- ERROR VALIDASI / LOGIN --}}
@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{{-- PESAN SUKSES (dari register) --}}
@if (session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<form action="{{ route('login.post') }}" method="POST">
    @csrf

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>

</body>
</html>
