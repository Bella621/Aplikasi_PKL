@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Tambah Anggota</h1>
        </div>
    <hr/>
    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" id="nik" placeholder="Masukkan 16 angka NIK">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama anggota">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat sesuai KTP">
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="No Hp dengan awalan 62">
            </div>
            <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </div>
        </div>

        
    </form>
@endsection
