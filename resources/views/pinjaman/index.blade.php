@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Data Pinjaman</h1>
        <a href="{{ route('pinjaman.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>
    <hr />
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nama Barang</th>
                <th>Tgl Ambil</th>
                <th>Harga Barang</th>
                <th>Bunga</th>
                <th>Total</th>
                <th>Jml Angsuran</th>
                <th>Angsuran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pinjamen as $key => $pinjaman)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $pinjaman->nama }}</td>
                <td>{{ $pinjaman->barang }}</td>
                <td>{{ $pinjaman->tgl_ambil }}</td>
                <td> Rp {{ number_format($pinjaman->harga_barang , 0, ',', '.') }}</td>
                <td>{{ $pinjaman->bunga }}</td>
                <td>Rp {{ number_format($pinjaman->total , 0, ',', '.') }}</td>
                <td>{{ $pinjaman->jml_angsuran }}</td>
                <td>Rp {{ number_format($pinjaman->angsuran , 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('pinjaman.edit', $pinjaman->id) }}" class="btn btn-sm btn-primary">Edit</a>                   
                    <form action="{{ route('pinjaman.destroy', $pinjaman->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this anggota?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
