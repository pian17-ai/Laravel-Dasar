@extends('layouts.app')

@section('title','Tambah Anggota')
@section('page-title','Tambah Anggota')

@section('content')

<form action="{{ route('anggota.store') }}" method="POST">
@csrf

<div class="mb-3">
<label>NIS</label>
<input type="text" name="nis" class="form-control">
</div>

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama_lengkap" class="form-control">
</div>

<div class="mb-3">
<label>Kelas</label>
<input type="text" name="kelas" class="form-control">
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>
<select name="jenis_kelamin" class="form-control">
<option value="L">Laki-laki</option>
<option value="P">Perempuan</option>
</select>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<button class="btn btn-primary">Simpan</button>

</form>

@endsection
