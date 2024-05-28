@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Bayar Angsuran</h1>
    </div>
    <hr/>
    <form id="angsuranForm" action="{{ route('angsuran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <select class="form-select" aria-label="Default select example" name="nama_id" id="nama_id">
                <option value="" disabled selected>Pilih Nama Pelanggan</option> <!-- Teks default -->
                @foreach($pinjaman as $a)
                    <option value="{{ $a['id'] }}" data-total="{{ $a['total'] }}">{{ $a['nama'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sisa_angsuran" class="form-label">Sisa Angsuran</label>
            <input type="text" name="sisa_angsuran" class="form-control" id="sisa_angsuran" readonly>
        </div>
        <div class="mb-3">
            <label for="tgl_ambil" class="form-label">Tgl Transaksi</label>
            <input type="date" name="tgl_angsuran" class="form-control" id="tgl_angsuran" placeholder="Masukkan tanggalnya">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Jumlah Bayar</label>
            <input type="number" name="jml_bayar" class="form-control" id="jml_bayar" placeholder="Masukkan jumlah bayar">
        </div>
        <div class="mb-3 text-danger" id="error-message" style="display: none;">
            Sisa angsuran tidak boleh kurang dari 0.
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
            </div>
        </div> 
    </form>
</div> 
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil elemen input tanggal
        var inputTanggal = document.getElementById('tgl_angsuran');
        // Mendapatkan tanggal hari ini
        var today = new Date().toISOString().slice(0, 10);
        // Mengatur nilai default input tanggal menjadi hari ini
        inputTanggal.value = today;

        // Mengambil elemen-elemen yang diperlukan
        var selectPinjaman = document.querySelector('select[name="nama_id"]');
        var inputSisaAngsuran = document.getElementById('sisa_angsuran');
        var inputJumlahBayar = document.getElementById('jml_bayar');
        var errorMessage = document.getElementById('error-message');
        var submitBtn = document.getElementById('submit-btn');
        var initialTotal = 0;

        // Mendengarkan perubahan pada select
        selectPinjaman.addEventListener('change', function() {
            // Mengambil nilai total dari pinjaman yang dipilih
            var selectedOption = selectPinjaman.options[selectPinjaman.selectedIndex];
            var total = parseFloat(selectedOption.dataset.total);
            initialTotal = total;
            // Mengisi nilai total ke dalam input sisa_angsuran
            inputSisaAngsuran.value = total.toFixed(2);
            validateForm();
        });

        // Mendengarkan perubahan pada input jumlah bayar
        inputJumlahBayar.addEventListener('input', function() {
            // Mengambil nilai jumlah bayar
            var jumlahBayar = parseFloat(inputJumlahBayar.value);
            // Validasi nilai jumlah bayar agar tidak NaN
            if (isNaN(jumlahBayar)) {
                jumlahBayar = 0;
            }
            // Menghitung dan menetapkan nilai sisa angsuran setelah pembayaran
            var sisaSetelahBayar = initialTotal - jumlahBayar;
            // Menetapkan nilai sisa angsuran ke dalam input sisa_angsuran
            inputSisaAngsuran.value = sisaSetelahBayar.toFixed(2);
            validateForm();
        });

        function validateForm() {
            var sisaAngsuran = parseFloat(inputSisaAngsuran.value);
            if (sisaAngsuran < 0) {
                errorMessage.style.display = 'block';
                submitBtn.disabled = true;
            } else {
                errorMessage.style.display = 'none';
                submitBtn.disabled = false;
            }
        }

        // Menambahkan validasi ketika form akan disubmit
        document.getElementById('angsuranForm').addEventListener('submit', function(event) {
            if (parseFloat(inputSisaAngsuran.value) < 0) {
                event.preventDefault();
                errorMessage.style.display = 'block';
            }
        });
    });
</script>
@endsection
