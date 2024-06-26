@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Tambah Data</h1>
    </div>
    <hr />
    <form action="{{ route('pinjaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <select class="form-select" aria-label="Default select example" name="nama_id" id="nama_id">
                <option value="" selected disabled>Pilih Nama</option>
                @foreach($anggota as $a)
                <option value="{{ $a->id }}" data-nik="{{ $a->nik }}">{{ $a->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" readonly>
        </div>
        <div class="mb-3">
            <label for="barang" class="form-label">Nama Barang</label>
            <input type="text" name="barang" class="form-control" id="barang" placeholder="Masukkan nama barang">
        </div>

        <div class="mb-3">
            <label for="tgl_ambil" class="form-label">Tgl Ambil</label>
            <input type="date" name="tgl_ambil" class="form-control" id="tgl_ambil" placeholder="Masukkan tanggal ambil">
        </div>
        <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga Barang</label>
            <input type="number" name="harga_barang" class="form-control" id="harga_barang"
                placeholder="Masukkan jumlah harga barang">
        </div>
        <div class="mb-3">
            <label for="bunga" class="form-label">Bunga</label>
            <input type="number" name="bunga" class="form-control" id="bunga" placeholder="" value="25" readonly>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" class="form-control" id="total" placeholder="" readonly>
        </div>
        <div class="mb-3">
            <label for="jml_angsuran" class="form-label">JML Angsur</label>
            <input type="number" name="jml_angsuran" class="form-control" id="jml_angsuran" placeholder="">
        </div>
        <div class="mb-3">
            <label for="angsuran" class="form-label">Angsuran</label>
            <input type="number" name="angsuran" class="form-control" id="angsuran" placeholder="" readonly>
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
        const namaSelect = document.querySelector('[name="nama_id"]');
        const nikInput = document.querySelector('[name="nik"]');

        namaSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            nikInput.value = selectedOption.getAttribute('data-nik');
        });

        // Mengambil elemen input tanggal
        var inputTanggal = document.getElementById('tgl_ambil');
        // Mendapatkan tanggal hari ini
        var today = new Date().toISOString().slice(0, 10);
        // Mengatur nilai default input tanggal menjadi hari ini
        inputTanggal.value = today;

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
