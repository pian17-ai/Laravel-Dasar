@extends('layouts.app')

@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('content')

    <a href="{{ route('anggota.create') }}" class="btn btn-success mb-3">
        Tambah Anggota
    </a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($anggota as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->nis }}</td>
                    <td>{{ $a->nama_lengkap }}</td>
                    <td>{{ $a->kelas }}</td>
                    <td>{{ $a->email }}</td>

                    <td>

                        <a href="{{ route('anggota.show', $a->id) }}" class="btn btn-info btn-sm">Detail</a>

                        <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">Hapus</button>

                        </form>

                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
