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
    // Validate input
    $validatedData = $request->validate([
        'nik' => 'required|digits:16|unique:anggotas',
        'nama' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required|regex:/^62\d+$/', // Ensure no_hp starts with '62'
    ], [
        'nik.digits' => 'NIK harus terdiri dari 16 angka.',
        'nik.unique' => 'NIK sudah terdaftar, tidak bisa input data karena NIK sudah ada.',
        'no_hp.regex' => 'No HP harus diawali dengan 62.',
    ]);

    try {
        // Create and save new anggota
        $anggota = new Anggota();
        $anggota->nik = $request->nik;
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->no_hp = $request->no_hp;
        $anggota->save();

        // Redirect to appropriate page with success message
        return redirect()->route('anggota')->with('success', 'Anggota berhasil ditambahkan.');
    } catch (\Exception $e) {
        // Handle error, maybe log it
        return redirect()->route('anggota.create')->with('error', 'Gagal menambahkan anggota: ' . $e->getMessage());
    }
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
