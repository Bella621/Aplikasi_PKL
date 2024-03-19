<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $anggotas = Anggota::all();
    return view('anggota.index', compact('anggotas'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nik' => 'required|unique:anggotas', // Sesuaikan dengan aturan validasi yang diperlukan
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Buat dan simpan anggota baru
        $anggota = new Anggota();
        $anggota->nik = $request->nik;
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->no_hp = $request->no_hp;
        // Tambahkan atribut lainnya sesuai kebutuhan
        $anggota->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('anggota')->with('success', 'Anggota berhasil ditambahkan.');
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
        // Cari anggota berdasarkan ID
        $anggota = Anggota::findOrFail($id);
        // Tampilkan view dengan data anggota yang akan diedit
        return view('anggota.edit', compact('anggota'));
    } catch (\Exception $e) {
        // Tangani jika terjadi kesalahan
        return redirect()->route('anggota')->with('error', 'Gagal menampilkan formulir edit: ' . $e->getMessage());
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
        // Cari anggota berdasarkan ID
        $anggota = Anggota::findOrFail($id);
        
             $anggota = Anggota::findOrFail($id);
             $anggota->nik = $request->nik;
             $anggota->nama = $request->nama;
             $anggota->alamat = $request->alamat;
             $anggota->no_hp = $request->no_hp;

        // Update data anggota berdasarkan data yang diterima dari request
        $anggota->update();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('anggota')->with('success', 'Data anggota berhasil diperbarui.');
    } catch (\Exception $e) {
        // Tangani jika terjadi kesalahan
        return redirect()->route('anggota')->with('error', 'Gagal memperbarui data anggota: ' . $e->getMessage());
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
        $anggota = Anggota::findOrFail($id);
        
        // Hapus anggota
        $anggota->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('anggota')->with('success', 'Anggota berhasil dihapus.');
    } catch (\Exception $e) {
        // Tangani jika terjadi kesalahan
        return redirect()->route('anggota')->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
    }
}

}
