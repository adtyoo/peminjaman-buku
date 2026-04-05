@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

{{-- HEADER --}}
<div class="card-header">
    <h5 class="mb-0">✏️ Edit Kelas</h5>
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

    <form action="{{ route('classes.update', $class->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NAMA KELAS --}}
        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   value="{{ old('name', $class->name) }}" 
                   placeholder="Contoh: XII RPL 1"
                   required>
        </div>

        {{-- BUTTON --}}
        <div class="mt-3">
            <button class="btn btn-success">💾 Update</button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

    </form>

</div>

</div>

@endsection
