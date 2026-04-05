@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>Data Subkategori</h4>
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">
        + Tambah Subkategori
    </a>
</div>

{{-- NOTIF --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Subkategori</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($subcategories as $index => $sub)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $sub->name }}</td>
            <td>{{ $sub->category->name ?? '-' }}</td>
            <td>
                <a href="{{ route('subcategories.edit', $sub->id) }}" 
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('subcategories.destroy', $sub->id) }}" 
                      method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Belum ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection