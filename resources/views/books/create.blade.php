@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

<div class="card-header">
    <h5 class="mb-0">➕ Tambah Buku</h5>
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

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- KIRI --}}
            <div class="col-md-8">

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>

                {{-- PENULIS --}}
                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                </div>

                {{-- PENERBIT --}}
                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}">
                </div>

                {{-- TAHUN --}}
                <div class="mb-3">
                    <label>Tahun</label>
                    <input type="number" name="year" class="form-control" value="{{ old('year') }}">
                </div>

                {{-- JUMLAH HALAMAN --}}
                <div class="mb-3">
                    <label>Jumlah Halaman</label>
                    <input type="number" name="pages" class="form-control" 
                           value="{{ old('pages') }}" min="1" placeholder="Contoh: 120">
                </div>

                {{-- ISBN --}}
                <div class="mb-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" 
                              class="form-control" 
                              rows="4"
                              placeholder="Masukkan deskripsi buku...">{{ old('description') }}</textarea>
                    <small id="charCount" class="text-muted">0 karakter</small>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SUBKATEGORI --}}
                <div class="mb-3">
                    <label>Subkategori</label>
                    <select name="subcategory_id" id="subcategory" class="form-control" disabled>
                        <option value="">-- Pilih Subkategori --</option>
                        @foreach($subcategories as $sub)
                            <option 
                                value="{{ $sub->id }}" 
                                data-category="{{ $sub->category_id }}"
                                {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}
                            >
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STOK --}}
                <div class="mb-3">
                    <label>Stok Total</label>
                    <input type="number" name="stock_total" class="form-control" value="{{ old('stock_total') }}">
                </div>

            </div>

            {{-- KANAN (GAMBAR) --}}
            <div class="col-md-4 text-center">

                <label class="mb-2">Gambar Buku</label>

                <div class="mb-3">
                    <img id="preview" 
                         src="{{ asset('images/no-image.png') }}" 
                         class="img-fluid rounded shadow-sm"
                         style="max-height:200px;">
                </div>

                <input type="file" name="image" class="form-control" id="imageInput">

            </div>

        </div>

        {{-- BUTTON --}}
        <div class="mt-3">
            <button class="btn btn-success">💾 Simpan</button>
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

        subcategorySelect.disabled = true;

        Array.from(subcategorySelect.options).forEach(option => {
            if (option.value === "") return;

            if (option.getAttribute('data-category') === selectedCategory) {
                option.style.display = 'block';
                subcategorySelect.disabled = false;
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
        if (categorySelect.value !== "") {
            filterSubcategories();
        }
    });

    // PREVIEW GAMBAR
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
        } else {
            preview.src = "{{ asset('images/no-image.png') }}";
        }
    });

    // COUNTER DESKRIPSI
    const desc = document.querySelector('[name="description"]');
    const counter = document.getElementById('charCount');

    desc.addEventListener('input', function() {
        counter.innerText = desc.value.length + ' karakter';
    });
</script>

@endsection
