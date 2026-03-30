@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-3">
        <div class="card shadow text-center">
            <div class="card-body">
                <h5>Total Buku</h5>
                <h3>120</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow text-center">
            <div class="card-body">
                <h5>Total Peminjaman</h5>
                <h3>35</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow text-center">
            <div class="card-body">
                <h5>Belum Dikembalikan</h5>
                <h3>8</h3>
            </div>
        </div>
    </div>

</div>

@endsection
