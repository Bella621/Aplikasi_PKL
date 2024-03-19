@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Data Angsuran</h1>
        <a href="{{ route('angsuran.create') }}" class="btn btn-primary">Bayar</a>
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
                <th>Action</th>
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
                <td>                 
                    <form action="{{ route('angsuran.destroy', $angsuran->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this angsuran?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
