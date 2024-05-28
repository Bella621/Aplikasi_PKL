@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Data Pinjaman</h1>
        <form action="{{ route('homePublic.search') }}" method="GET" class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <hr />
    @if(!empty($pinjamen))
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
                <td>Rp {{ number_format($pinjaman->harga_barang, 0, ',', '.') }}</td>
                <td>{{ $pinjaman->bunga }}</td>
                <td>Rp {{ number_format($pinjaman->total, 0, ',', '.') }}</td>
                <!-- <td>{{ $pinjaman->total }}</td> -->
                <td>{{ $pinjaman->jml_angsuran }}</td>
                <td>Rp {{ number_format($pinjaman->angsuran, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($pinjaman->sisa_angsuran , 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Silahkan masukkan NIK untuk melakukan pencarian.</p>
    @endif
</div>
@endsection
