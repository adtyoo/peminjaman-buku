@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp
@section('content')

<div class="card shadow-sm">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">📚 Data Buku</h5>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            ➕ Tambah Buku
        </a>
    </div>

    {{-- TABLE --}}
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Halaman</th> {{-- ✅ TAMBAHAN --}}
                        <th>ISBN</th>
                        <th>Kategori</th>
                        <th>Subkategori</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $index => $book)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>

                        {{-- GAMBAR --}}
                        <td class="text-center">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" 
                                    alt="{{ $book->title }}" 
                                    style="max-height:100px;" 
                                    class="img-fluid rounded">
                            @else
                                Kosong!
                            @endif
                        </td>

                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td class="text-center">{{ $book->year }}</td>

                        {{-- ✅ HALAMAN --}}
                        <td class="text-center">
                            <span class="badge bg-info">
                                {{ $book->pages }} hlm
                            </span>
                        </td>

                        <td>{{ $book->isbn }}</td>

                        <td>{{ $book->category->name ?? '-' }}</td>
                        <td>{{ $book->subcategory->name ?? '-' }}</td>
                        <td>{{ Str::limit($book->description, 50) ?? '-' }}</td>

                        {{-- STOK --}}
                        <td class="text-center">
                            <span class="badge bg-primary">
                                {{ $book->stock_available }} / {{ $book->stock_total }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <a href="{{ route('books.edit', $book->id) }}" 
                               class="btn btn-warning btn-sm">
                               ✏️
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Yakin hapus buku ini?')" 
                                        class="btn btn-danger btn-sm">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted"> {{-- ✅ disesuaikan --}}
                            📭 Data buku belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection