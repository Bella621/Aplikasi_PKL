<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Total Pinjaman</title>
</head>
<body>
    <h3 style="text-align: center">Cetak Laporan Total Pinjaman</h3>
    <h5 style="text-align: center">Tanggal: {{ $date_start }} sampai {{ $date_end }}</h5>
    <table class="table table-bordered text-center" border="1" style="text-align:center;" width="100%">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tgl Ambil</th>
                <th>Harga Barang</th>
                <th>Bunga</th>
                <th>Total</th>
                <th>Jml Angsuran</th>
                <th>Angsuran</th>
            </tr>
        </thead>
        <tbody>
            @php
            $n = 1;
            @endphp
            @forelse($pinjamen as $key => $pinjaman)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $pinjaman->nama }}</td>
                    <td>{{ $pinjaman->tgl_ambil }}</td>
                    <td>Rp {{ number_format($pinjaman->harga_barang, 0, ',', '.') }}</td>
                    <td>{{ $pinjaman->bunga }}</td>
                    <td>Rp {{ number_format($pinjaman->total, 0, ',', '.') }}</td>
                    <td>{{ $pinjaman->jml_angsuran }}</td>
                    <td>Rp {{ number_format($pinjaman->angsuran, 0, ',', '.') }}</td>
                </tr>
                @php
                $n++;
                @endphp
            @empty
                <tr>
                    <td colspan="8" class="fw-bold text-center">Data tidak ditemukan!</td>
                </tr>
            @endforelse

            @if($jml_peminjam !== 0)
                <tr>
                    <td colspan="4">Total Peminjam</td>
                    <td>{{ $jml_peminjam }}</td>
                </tr>
                <tr>
                    <td colspan="4">Total Pinjaman</td>
                    <td>Rp. {{ number_format($jml_pinjaman, 0, ',', '.') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>
