@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Edit Data Pinjaman</h1>
    </div>
    <hr />
    <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <select class="form-select" aria-label="Default select example" name="nama_id">
                @foreach($anggota as $a)
                <option value="{{ $a->id }}" {{ $a->nama == $pinjaman->nama ? 'selected' : '' }}>{{ $a->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tgl_ambil" class="form-label">Tgl Ambil</label>
            <input type="date" name="tgl_ambil" class="form-control" id="tgl_ambil" placeholder="Masukkan tanggal ambil"
                value="{{ $pinjaman->tgl_ambil }}">
        </div>
        <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga Barang</label>
            <input type="interger" name="harga_barang" class="form-control" id="harga_barang"
                placeholder="Masukkan jumlah harga barang" value="{{ $pinjaman->harga_barang }}">
        </div>
        <div class="mb-3">
            <label for="bunga" class="form-label">Bunga</label>
            <input type="decimal" name="bunga" class="form-control" id="bunga" placeholder=""
                value="{{ $pinjaman->bunga }}" readonly>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="interger" name="total" class="form-control" id="total" placeholder=""
                value="{{ $pinjaman->total }}" readonly>
        </div>
        <div class="mb-3">
            <label for="jml_angsuran" class="form-label">JML Angsur</label>
            <input type="interger" name="jml_angsuran" class="form-control" id="jml_angsuran" placeholder=""
                value="{{ $pinjaman->jml_angsuran }}">
        </div>
        <div class="mb-3">
            <label for="angsuran" class="form-label">Angsuran</label>
            <input type="interger" name="angsuran" class="form-control" id="angsuran" placeholder=""
                value="{{ $pinjaman->angsuran }}" readonly>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('[name="harga_barang"]').addEventListener('input', function () {
            const harga_barang = Number(document.querySelector('[name="harga_barang"]').value);
            const bunga = Number(document.querySelector('[name="bunga"]').value);
            document.querySelector('[name="total"]').value = harga_barang + (harga_barang * bunga / 100);
        });

        document.querySelector('[name="jml_angsuran"]').addEventListener('input', function () {
            const jml_angsuran = Number(document.querySelector('[name="jml_angsuran"]').value);
            const total = Number(document.querySelector('[name="total"]').value);
            document.querySelector('[name="angsuran"]').value = total / jml_angsuran;
        });
    });
</script>
@endsection