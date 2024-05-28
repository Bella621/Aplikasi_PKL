@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Laporan Total Pinjaman</h1>
        <div>
            <a href="{{ route('laporan.total_angsuran') }}" class="btn btn-primary">Total Pembayaran Angsuran</a>
            <a href="{{ route('laporan') }}" class="btn btn-primary ml-2" href="#" role="button">Total Pinjaman</a>
        </div>
    </div>
    <form method="GET" class="row mb-3">
        <div class="col-sm-6 col-md-3">
            <label>Date Start</label>
            <input type="date" class="form-control" placeholder="col-form-label" name="date_start"
                value="{{ $request->input('date_start') ?? '' }}">
        </div>
        <div class="col-sm-6 col-md-3">
            <label>Date End</label>
            <input type="date" class="form-control" placeholder="col-form-label" name="date_end"
                value="{{ $request->input('date_end') ?? '' }}">
        </div>
        <div class="col-sm-6 col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    @if($jml_peminjam !== 0)
    <form action="{{ route('laporan.printIndex') }}" method="POST" enctype="multipart/form-data" target="_blank">
        @csrf
        @method('POST')
        <input type="hidden" name="date_start" value="{{ $request->input('date_start') ?? '' }}">
        <input type="hidden" name="date_end" value="{{ $request->input('date_end') ?? '' }}">
        <button type="submit" class="btn btn-primary btn-sm mt-2"><i class="fas fa-print"></i> Cetak Laporan</button>
    </form>
    @endif
 
    <div class="container">
        <hr />
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tgl Ambil</th>
                    <th>Harga Barang</th>
                    <th>Bunga</th>
                    <th>Total</th>
                    <th>Jml Angsuran</th>
                    <th>Angsuran per minggu</th>
                    <th>Sisa Angsuran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjamen as $key => $pinjaman)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $pinjaman->nama }}</td>
                    <td>{{ $pinjaman->tgl_ambil }}</td>
                    <td> Rp {{ number_format($pinjaman->harga_barang , 0, ',', '.') }}</td>
                    <td>{{ $pinjaman->bunga }}</td>
                    <td>Rp {{ number_format($pinjaman->total , 0, ',', '.') }}</td>
                    <td>{{ $pinjaman->jml_angsuran }}</td>
                    <td>Rp {{ number_format($pinjaman->angsuran , 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pinjaman->sisa_angsuran , 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mb-3">
        <!-- <label for="colFormLabel" class="col-sm-2 col-form-label">Jumlah Peminjam: {{ $jml_peminjam }}</label> -->
        <td>Jumlah Peminjam: {{ $jml_peminjam }}</td>
        <div class="col-sm-2">
        </div>
    </div>
    <div class="row mb-3">
        <!-- <label for="colFormLabel" class="col-sm-2 col-form-label"></label> -->
        <td>Jumlah Pinjaman: Rp {{ number_format($jml_pinjaman, 0, ',', '.') }}</td>
    </div>
    
</div>
@endsection
