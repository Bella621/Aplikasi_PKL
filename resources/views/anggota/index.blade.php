@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Data Anggota</h1>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary">Tambah Anggota</a>
    </div>
    <hr />
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No.hp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotas as $key => $anggota)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $anggota->nik }}</td>
                <td>{{ $anggota->nama }}</td>
                <td>{{ $anggota->alamat }}</td>
                <td>{{ $anggota->no_hp }}</td>
                <td>
                    <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-sm btn-primary">Edit</a>                   
                    <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" style="display: inline;">
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
