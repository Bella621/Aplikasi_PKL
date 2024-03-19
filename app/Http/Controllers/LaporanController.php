<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pinjamen = Pinjaman::all();
        $jml_pinjaman = 0;
        $jml_peminjam = 0;

        if (!empty($request->input('date_start')) && !empty($request->input('date_end'))) {
            $jml_pinjaman = DB::table('pinjamen')->whereBetween('created_at', [
                $request->input('date_start').' 00:00:00',
                $request->input('date_end').' 23:59:59'
            ])->sum('pinjamen.total');

            $jml_peminjam = DB::table('pinjamen')->whereBetween('created_at', [
                $request->input('date_start').' 00:00:00',
                $request->input('date_end').' 23:59:59'
            ])->count('*');

            // dd($jml_peminjam);
        } else {
            $jml_pinjaman = DB::table('pinjamen')->sum('pinjamen.total');
            $jml_peminjam = DB::table('pinjamen')->count('*');
        }

        return view('laporan.index', [
            'pinjamen'=>$pinjamen,
            'request'=> $request,
            'jml_pinjaman' => $jml_pinjaman,
            'jml_peminjam' => $jml_peminjam,
        ]);
    }
    public function total_angsuran(Request $request)
    {
        
        $jml_pengansur = 0;
        $jml_bayar = 0;
        $angsurans = Angsuran::all();

        if (!empty($request->input('date_start')) && !empty($request->input('date_end'))) {
            $jml_bayar = DB::table('angsurans')->whereBetween('created_at', [
                $request->input('date_start').' 00:00:00',
                $request->input('date_end').' 23:59:59'
            ])->sum('angsurans.jml_bayar');

            $jml_pengansur = DB::table('angsurans')->whereBetween('created_at', [
                $request->input('date_start').' 00:00:00',
                $request->input('date_end').' 23:59:59'
            ])->count('*');

            // dd($jml_peminjam);
        } else {
            $jml_bayar = DB::table('angsurans')->sum('angsurans.jml_bayar');
            $jml_pengansur = DB::table('angsurans')->count('*');
        }



        return view('laporan.total_angsuran', [
            'angsurans' =>$angsurans,
            'request'=> $request,
            'jml_pengansur' => $jml_pengansur,
            'jml_bayar' => $jml_bayar,
        ]);
    }
    
}