<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="bg-dark text-white p-3 vh-100" style="width:250px">
        <h4 class="text-center">Perpustakaan</h4>
        <hr>

        <p class="small">Login sebagai:</p>
        <b>{{ auth()->user()->name }}</b>
        <hr>

        {{-- MENU ADMIN --}}
        @if(auth()->user()->role == 'admin')

            <a href="#" class="text-white d-block mb-2">📚 Data Buku</a>
            <a href="#" class="text-white d-block mb-2">🏷 Kategori</a>
            <a href="#" class="text-white d-block mb-2">📖 Peminjaman</a>
            <a href="#" class="text-white d-block mb-2">✅ Pengembalian</a>

        @endif


        {{-- MENU USER --}}
        @if(auth()->user()->role == 'user')

            <a href="#" class="text-white d-block mb-2">📚 Lihat Buku</a>
            <a href="#" class="text-white d-block mb-2">📖 Peminjaman Saya</a>
            <a href="#" class="text-white d-block mb-2">📜 Riwayat</a>

        @endif

        <hr>

        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button class="btn btn-danger w-100">Logout</button>
        </form>
    </div>


    {{-- CONTENT --}}
    <div class="flex-grow-1">

        {{-- NAVBAR --}}
        <nav class="navbar bg-light shadow-sm px-3">
            <h5 class="mb-0">{{ $title ?? 'Dashboard' }}</h5>
        </nav>

        <div class="p-4">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
