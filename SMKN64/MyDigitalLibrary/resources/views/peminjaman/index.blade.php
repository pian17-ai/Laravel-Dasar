@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')

@section('content')

    <a href="{{ route('peminjaman.create') }}" class="btn btn-success mb-3">
        Tambah Peminjaman
    </a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($peminjaman as $p)
                <tr>

                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->anggota->nama_lengkap }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->status }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
