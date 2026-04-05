@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    
<div class="card-header">
    <h5 class="mb-0">✏️ Edit Buku</h5>
</div>

<div class="card-body">

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- KIRI --}}
            <div class="col-md-8">

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $book->title) }}">
                </div>

                {{-- PENULIS --}}
                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="author" class="form-control"
                           value="{{ old('author', $book->author) }}">
                </div>

                {{-- PENERBIT --}}
                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="publisher" class="form-control"
                           value="{{ old('publisher', $book->publisher) }}">
                </div>

                {{-- TAHUN --}}
                <div class="mb-3">
                    <label>Tahun</label>
                    <input type="number" name="year" class="form-control"
                           value="{{ old('year', $book->year) }}">
                </div>

                {{-- JUMLAH HALAMAN --}}
                <div class="mb-3">
                    <label>Jumlah Halaman</label>
                    <input type="number" name="pages" class="form-control"
                           value="{{ old('pages', $book->pages) }}" min="1">
                </div>

                {{-- ISBN --}}
                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control"
                           value="{{ old('isbn', $book->isbn) }}">
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $book->description) }}</textarea>
                    <small id="charCount" class="text-muted">0 karakter</small>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SUBKATEGORI --}}
                <div class="mb-3">
                    <label>Subkategori</label>
                    <select name="subcategory_id" id="subcategory" class="form-control">
                        <option value="">-- Pilih Subkategori --</option>
                        @foreach($subcategories as $sub)
                            <option 
                                value="{{ $sub->id }}"
                                data-category="{{ $sub->category_id }}"
                                {{ old('subcategory_id', $book->subcategory_id) == $sub->id ? 'selected' : '' }}>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STOK --}}
                <div class="mb-3">
                    <label>Stok Total</label>
                    <input type="number" name="stock_total" class="form-control"
                           value="{{ old('stock_total', $book->stock_total) }}">
                </div>

                <div class="mb-3">
                    <label>Stok Tersedia</label>
                    <input type="number" name="stock_available" class="form-control"
                           value="{{ old('stock_available', $book->stock_available) }}">
                </div>

            </div>

            {{-- KANAN (GAMBAR) --}}
            <div class="col-md-4 text-center">

                <label class="mb-2">Gambar Buku</label>

                <div class="mb-3">
                    @if($book->image)
                        <img id="preview"
                             src="{{ asset('storage/' . $book->image) }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height:200px;">
                    @else
                        <img id="preview"
                             src="{{ asset('images/no-image.png') }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height:200px;">
                    @endif
                </div>

                <input type="file" name="image" class="form-control" id="imageInput">

            </div>

        </div>

        {{-- BUTTON --}}
        <div class="mt-3">
            <button class="btn btn-success">💾 Update</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

    </form>

</div>

</div>

{{-- SCRIPT --}}

<script>
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');

    function filterSubcategories() {
        const selectedCategory = categorySelect.value;

        Array.from(subcategorySelect.options).forEach(option => {
            if (option.value === "") return;

            if (option.getAttribute('data-category') === selectedCategory) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    }

    categorySelect.addEventListener('change', function () {
        subcategorySelect.value = "";
        filterSubcategories();
    });

    document.addEventListener('DOMContentLoaded', function () {
        filterSubcategories();
    });

    // PREVIEW GAMBAR
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });

    // COUNTER DESKRIPSI
    const desc = document.querySelector('[name="description"]');
    const counter = document.getElementById('charCount');

    function updateCounter() {
        counter.innerText = desc.value.length + ' karakter';
    }

    desc.addEventListener('input', updateCounter);
    document.addEventListener('DOMContentLoaded', updateCounter);
</script>

@endsection
