@extends('layouts.app')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Penulis</label>
                            <input type="text" name="penulis" class="form-control" value="{{ $buku->penulis }}">
                        </div>

                        <div class="mb-3">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}">
                        </div>

                        <div class="mb-3">
                            <label>Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control"
                                value="{{ $buku->tahun_terbit }}">
                        </div>

                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" value="{{ $buku->isbn }}">
                        </div>

                        <div class="mb-3">
                            <label>Jumlah Halaman</label>
                            <input type="number" name="jumlah_halaman" class="form-control"
                                value="{{ $buku->jumlah_halaman }}">
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" value="{{ $buku->kategori }}">
                        </div>

                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{ $buku->stok }}">
                        </div>

                        <div class="mb-3">
                            <label>Sinopsis</label>
                            <textarea name="sinopsis" class="form-control">{{ $buku->sinopsis }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Sampul Buku</label>
                            <input type="file" name="sampul" class="form-control">
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
