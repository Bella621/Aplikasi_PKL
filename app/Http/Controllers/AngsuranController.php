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
        // Validasi input
        // $validatedData = $request->validate([
        //     'nama' => 'required', // 
        //     'tgl_angsuran' => 'required',
        //     'jml_bayar' => 'required',
        //     'sisa_angsuran' => 'required',
        //     // Tambahkan validasi lainnya sesuai kebutuhan
        // ]);
        $nama = Pinjaman::where('id', $request->nama_id)->value('nama');
        $total = Pinjaman::where('id')->value('total');

        // Buat dan simpan 
        $angsurans = new Angsuran();
        $angsurans->nama = $nama;
        $angsurans->tgl_angsuran = $request->tgl_angsuran;
        $angsurans->jml_bayar = $request->jml_bayar;
        $angsurans->sisa_angsuran = $request->sisa_angsuran;
        // Tambahkan atribut lainnya sesuai kebutuhan
        $angsurans->save();

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
