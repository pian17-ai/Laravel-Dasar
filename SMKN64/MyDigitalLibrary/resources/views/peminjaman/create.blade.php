@extends('layouts.app')

@section('title', 'Tambah Peminjaman')
@section('page-title', 'Tambah Peminjaman')

@section('content')

    <form action="{{ route('peminjaman.store') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label>Buku</label>

            <select name="id_buku" class="form-control">

                @foreach ($buku as $b)
                    <option value="{{ $b->id }}">{{ $b->judul }}</option>
                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Anggota</label>

            <select name="id_anggota" class="form-control">

                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}">{{ $a->nama_lengkap }}</option>
                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Tanggal Pinjam</label>

            <input type="date" name="tanggal_pinjam" class="form-control">

        </div>

        <div class="mb-3">

            <label>Jatuh Tempo</label>

            <input type="date" name="tanggal_jatuh_tempo" class="form-control">

        </div>

        <button class="btn btn-primary">Simpan</button>

    </form>

@endsection
