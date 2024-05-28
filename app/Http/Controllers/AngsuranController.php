<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $angsurans = Angsuran::all();
        return view('angsuran.index', compact('angsurans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $p = Pinjaman::all()->toArray();
        foreach ($p as $key => $value) {
            $p[$key]['total'] -= DB::table('angsurans')->where('nama', $value['nama'])->sum('angsurans.jml_bayar');
        }
        return view ('angsuran.create', ['pinjaman' => $p]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = Pinjaman::where('id', $request->nama_id)->value('nama');
        $nik = Pinjaman::where('id', $request->nama_id)->value('nik');
        $barang = Pinjaman::where('id', $request->nama_id)->value('barang');
    
        // Buat dan simpan data angsuran baru
        $angsuran = new Angsuran();
        $angsuran->nama = $nama;
        $angsuran->nik = $nik;
        $angsuran->barang = $barang;
        $angsuran->tgl_angsuran = $request->tgl_angsuran;
        $angsuran->jml_bayar = $request->jml_bayar;
        $angsuran->sisa_angsuran = $request->sisa_angsuran;
        // Tambahkan atribut lainnya sesuai kebutuhan
        $angsuran->save();
    
        // Update sisa angsuran pada pinjaman terkait
        $pinjaman = Pinjaman::findOrFail($request->nama_id);
        $pinjaman->sisa_angsuran -= $request->jml_bayar;
        $pinjaman->save();
    
        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('angsuran')->with('success', 'Data berhasil ditambahkan.');
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
        //
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
        //
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
            // Cari angsuran berdasarkan ID
            $angsuran = Angsuran::findOrFail($id);
            
            // Hapus angsuran
            $angsuran->delete();
    
            // Redirect kembali ke halaman index dengan pesan sukses
            return redirect()->route('angsuran')->with('success', 'Angsuran berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan
            return redirect()->route('angsuran')->with('error', 'Gagal menghapus data angsuran: ' . $e->getMessage());
        }
    
    }
}
