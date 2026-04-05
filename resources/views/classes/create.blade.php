@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    {{-- HEADER --}}
    <div class="card-header">
        <h5 class="mb-0">🏫 Tambah Kelas</h5>
    </div>

    {{-- BODY --}}
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('classes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Kelas</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: XII" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('classes.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </div>

</div>

@endsection