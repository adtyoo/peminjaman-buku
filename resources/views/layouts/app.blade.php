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
        <h4 class="text-center">📚 Perpustakaan</h4>
        <hr>

        <p class="small">Login sebagai:</p>
        <b>{{ auth()->user()->name }}</b>
        <hr>

        {{-- ================= ADMIN ================= --}}
        @if(auth()->user()->role == 'admin')

            <a href="/admin/dashboard" 
               class="text-white d-block mb-2 {{ request()->is('admin/dashboard') ? 'fw-bold text-warning' : '' }}">
               🏠 Dashboard
            </a>

            <a href="/books" 
               class="text-white d-block mb-2 {{ request()->is('books*') ? 'fw-bold text-warning' : '' }}">
               📚 Buku
            </a>

            <a href="/categories" 
               class="text-white d-block mb-2 {{ request()->is('categories*') ? 'fw-bold text-warning' : '' }}">
               🏷 Kategori
            </a>

            <a href="/subcategories" 
               class="text-white d-block mb-2 {{ request()->is('subcategories*') ? 'fw-bold text-warning' : '' }}">
               📂 Subkategori
            </a>

            <a href="/borrowings" 
               class="text-white d-block mb-2 {{ request()->is('borrowings*') ? 'fw-bold text-warning' : '' }}">
               📖 Peminjaman
            </a>

            <a href="/returns" 
               class="text-white d-block mb-2 {{ request()->is('returns*') ? 'fw-bold text-warning' : '' }}">
               ✅ Pengembalian
            </a>
            
            <a href="/classes" 
               class="text-white d-block mb-2 {{ request()->is('classes*') ? 'fw-bold text-warning' : '' }}">
               🏫 Kelas
            </a>

            <a href="/majors" 
               class="text-white d-block mb-2 {{ request()->is('majors*') ? 'fw-bold text-warning' : '' }}">
               🎓 Jurusan
            </a>

            <a href="/admin/users" 
               class="text-white d-block mb-2 {{ request()->is('users*') ? 'fw-bold text-warning' : '' }}">
               👤 User (Tambah Siswa)
            </a>

        @endif


        {{-- ================= USER ================= --}}
        @if(auth()->user()->role == 'user')

            <a href="/user/dashboard" 
               class="text-white d-block mb-2 {{ request()->is('user/dashboard') ? 'fw-bold text-warning' : '' }}">
               🏠 Dashboard
            </a>

            <a href="/books" 
               class="text-white d-block mb-2 {{ request()->is('books*') ? 'fw-bold text-warning' : '' }}">
               📚 Lihat Buku
            </a>

            <a href="/my-borrowings" 
               class="text-white d-block mb-2 {{ request()->is('my-borrowings') ? 'fw-bold text-warning' : '' }}">
               📖 Peminjaman Saya
            </a>

        @endif

        <hr>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
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