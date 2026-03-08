@extends('layouts.app')

@section('title', 'Detail Anggota')
@section('page-title', 'Detail Anggota')

@section('content')

    <table class="table">

        <tr>
            <th>NIS</th>
            <td>{{ $anggota->nis }}</td>
        </tr>

        <tr>
            <th>Nama</th>
            <td>{{ $anggota->nama_lengkap }}</td>
        </tr>

        <tr>
            <th>Kelas</th>
            <td>{{ $anggota->kelas }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $anggota->email }}</td>
        </tr>

    </table>

@endsection
