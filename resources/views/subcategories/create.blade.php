@extends('layouts.app')

@section('content')

<div class="container">
    <h4 class="mb-4">Tambah Subkategori</h4>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('subcategories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Subkategori</label>
                    <input type="text" 
                           name="name" 
                           class="form-control"
                           placeholder="Masukkan subkategori"
                           required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button class="btn btn-primary">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection