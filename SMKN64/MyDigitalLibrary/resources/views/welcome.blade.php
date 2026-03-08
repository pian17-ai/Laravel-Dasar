@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title')
Dashboard
@endsection

@section('content')

<div class="row">

    <div class="col-md-3 mb-4">
        <div class="card card-dashboard bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-book"></i> Total Buku
                </h5>
                <h2>120</h2>
                <p class="mb-0">Buku tersedia</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-dashboard bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-people"></i> Anggota
                </h5>
                <h2>45</h2>
                <p class="mb-0">Anggota terdaftar</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-dashboard bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-arrow-left-right"></i> Peminjaman
                </h5>
                <h2>32</h2>
                <p class="mb-0">Total peminjaman</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-dashboard bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-clock-history"></i> Terlambat
                </h5>
                <h2>5</h2>
                <p class="mb-0">Belum dikembalikan</p>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">
            <i class="bi bi-info-circle"></i> Selamat Datang
        </h5>
        <p>
            Selamat datang di sistem <b>MyDigitalLibrary</b>.  
            Gunakan menu di sebelah kiri untuk mengelola data buku, anggota,
            peminjaman, dan laporan perpustakaan.
        </p>
    </div>
</div>

@endsection
