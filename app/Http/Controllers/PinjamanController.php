<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjamen = Pinjaman::all();
        return view('pinjaman.index',compact('pinjamen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pinjaman.create', ['anggota'=>Anggota::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = Anggota::where('id', $request->nama_id)->value('nama');
        // Buat dan simpan anggota baru
        $pinjamen = new Pinjaman();
        $pinjamen->nama = $nama;
        $pinjamen->tgl_ambil = $request->tgl_ambil;
        $pinjamen->harga_barang = $request->harga_barang;
        $pinjamen->bunga = $request->bunga;
        $pinjamen->total = $request->total;
        $pinjamen->jml_angsuran = $request->jml_angsuran;
        $pinjamen->angsuran = $request->angsuran;
        // Tambahkan atribut lainnya sesuai kebutuhan
        $pinjamen->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('pinjaman')->with('success', 'Data berhasil ditambahkan.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Cari Data berdasarkan ID
            $pinjaman = Pinjaman::findOrFail($id);
            $anggota = Anggota::all();
            // Tampilkan view dengan data yang akan diedit
            return view('pinjaman.edit', compact('pinjaman', 'anggota'));
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->route('pinjaman')->with('error', 'Gagal menampilkan formulir edit: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
        $nama = Anggota::where('id', $request->nama_id)->value('nama');
            // Cari anggota berdasarkan ID
            $pinjaman = Pinjaman::findOrFail($id);
            
                 $pinjaman = Pinjaman::findOrFail($id);
                 $pinjaman->nama = $nama;
                 $pinjaman->tgl_ambil = $request->tgl_ambil;
                 $pinjaman->harga_barang = $request->harga_barang;
                 $pinjaman->bunga = $request->bunga;
                 $pinjaman->total = $request->total;
                 $pinjaman->jml_angsuran = $request->jml_angsuran;
                 $pinjaman->angsuran = $request->angsuran;
    
            // Update data anggota berdasarkan data yang diterima dari request
            $pinjaman->update();
    
            // Redirect kembali ke halaman index dengan pesan sukses
            return redirect()->route('pinjaman')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->route('pinjaman')->with('error', 'Gagal memperbarui data : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Cari anggota berdasarkan ID
            $pinjaman = Pinjaman::findOrFail($id);
            
            // Hapus anggota
            $pinjaman->delete();
    
            // Redirect kembali ke halaman index dengan pesan sukses
            return redirect()->route('pinjaman')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->route('pinjaman')->with('error', 'Gagal menghapus Data: ' . $e->getMessage());
        }
    }
}
