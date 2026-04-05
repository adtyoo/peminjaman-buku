@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">🎓 Data Jurusan</h5>

        <a href="{{ route('majors.create') }}" class="btn btn-primary">
            + Tambah Jurusan
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Jurusan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($majors as $index => $major)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $major->name }}</td>
                        <td>
                            <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('majors.destroy', $major->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection