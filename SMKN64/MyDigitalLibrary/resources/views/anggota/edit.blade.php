@extends('layouts.app')

@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('content')

    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="nis" value="{{ $anggota->nis }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama_lengkap" value="{{ $anggota->nama_lengkap }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" value="{{ $anggota->kelas }}" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>

    </form>

@endsection
