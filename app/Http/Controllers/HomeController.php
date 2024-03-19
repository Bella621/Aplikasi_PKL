<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Anggota;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request )
    {
        $jml_peminjam = DB::table('pinjamen')->count('*');
        $jml_anggota = DB::table('anggotas')->count('*');
        $anggotas = Anggota::all();

        return view('home', [
            'jml_peminjam' => $jml_peminjam,
            'jml_anggotas' => $jml_anggota,
            'anggotas' => $anggotas,
        ]);

    }
}
