@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Anggota</h1>
    <hr>
    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" value="{{ $anggota->nik }}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ $anggota->nama }}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $anggota->alamat }}">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="number" name="no_hp" class="form-control" id="no_hp" value="{{ $anggota->no_hp }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
