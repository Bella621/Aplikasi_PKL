<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\DB;

class HomePublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjamen = Pinjaman::all();
        return view('homePublic',compact('pinjamen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $pinjamen = Pinjaman::where('nama', 'LIKE', "%$keyword%")
                        ->orWhere('tgl_ambil', 'LIKE', "%$keyword%")
                        ->orWhere('harga_barang', 'LIKE', "%$keyword%")
                        ->orWhere('bunga', 'LIKE', "%$keyword%")
                        ->orWhere('total', 'LIKE', "%$keyword%")
                        ->orWhere('jml_angsuran', 'LIKE', "%$keyword%")
                        ->orWhere('angsuran', 'LIKE', "%$keyword%")
                        ->get();

    return view('homePublic', compact('pinjamen'));
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
        //
    }
}
