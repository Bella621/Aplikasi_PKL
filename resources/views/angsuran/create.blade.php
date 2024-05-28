@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Bayar Angsuran</h1>
    </div>
    <hr/>
    <form action="{{ route('angsuran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama (Barang)</label>
            <select class="form-select" aria-label="Default select example" name="nama_id" id="nama_id">
                <option value="" selected disabled>Pilih Nama (Barang)</option>
                @foreach($pinjaman as $p)
                <option value="{{ $p['id'] }}" data-total="{{ $p['total'] }}" data-nik="{{ $p['nik'] }}">{{ $p['nama'] }} ({{ $p['barang'] }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" id="nik" readonly>
        </div>
        <div class="mb-3">
            <label for="sisa_angsuran" class="form-label">Sisa Angsuran</label>
            <input type="number" name="sisa_angsuran" class="form-control" id="sisa_angsuran" readonly>
        </div>
        <div class="mb-3">
            <label for="tgl_angsuran" class="form-label">Tgl Transaksi</label>
            <input type="date" name="tgl_angsuran" class="form-control" id="tgl_angsuran" placeholder="Masukkan tanggalnya">
        </div>
        <div class="mb-3">
            <label for="jml_bayar" class="form-label">Jumlah Bayar</label>
            <input type="number" name="jml_bayar" class="form-control" id="jml_bayar" placeholder="Masukkan jumlah bayar">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil elemen select
        var selectPinjaman = document.querySelector('select[name="nama_id"]');
        // Mendengarkan perubahan pada select
        selectPinjaman.addEventListener('change', function() {
            // Mengambil nilai total dari pinjaman yang dipilih
            var selectedOption = selectPinjaman.options[selectPinjaman.selectedIndex];
            var total = selectedOption.dataset.total;
            var nik = selectedOption.dataset.nik; // Menambahkan ini untuk mendapatkan nilai NIK
            // Mengisi nilai total ke dalam input sisa_angsuran
            document.getElementById('sisa_angsuran').value = total;
            document.getElementById('nik').value = nik; // Menambahkan nilai NIK ke input nik
        });
    });
</script>
@endsection
