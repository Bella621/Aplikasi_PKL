@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Laporan Total Pembayaran Angsuran</h1>
    <div>
        <a href="{{ route('laporan.total_angsuran') }}" class="btn btn-primary">Total Pembayaran Angsuran</a>  
        <a href="{{ route('laporan') }}" class="btn btn-primary ml-2" href="#" role="button">Total Pinjaman</a>
    </div>
</div>

    <hr/>

        <form method="GET" class="row mb-3">
            <div class="col-sm-6 col-md-3">
                <label>Date Start</label>
                <input type="date" class="form-control" placeholder="col-form-label" name="date_start" value="{{ $request->input('date_start') ?? '' }}">
            </div>
            <div class="col-sm-6 col-md-3">
                <label>Date End</label>
                <input type="date" class="form-control" placeholder="col-form-label" name="date_end"  value="{{ $request->input('date_end') ?? '' }}">
            </div>
            <div class="col-sm-6 col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Data Angsuran</h1>
    </div>
    <hr />
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Sisa Angsuran</th>
                <th>Tgl Transaksi</th>
                <th>Jml Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angsurans as $key => $angsuran)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $angsuran->nama }}</td>
                <td>Rp {{ number_format($angsuran->sisa_angsuran  , 0, ',', '.') }}</td>
                <td>{{ $angsuran->tgl_angsuran }}</td>
                <td> Rp {{ number_format($angsuran->jml_bayar , 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="row md-3">
    <label for="colFormLabel" class="col-sm-3 col-form-label">Jumlah Pengangsur: {{ $jml_pengansur }}</label>
</div>
<div class="row md-3">
    <label for="colFormLabel" class="col-sm-3 col-form-label">Jumlah Bayar Angsuran: Rp {{ number_format($jml_bayar, 0, ',', '.') }}</label>
</div>
</div>
        
@endsection