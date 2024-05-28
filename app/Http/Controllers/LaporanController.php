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
        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');
    
        $pinjamen = Pinjaman::query();
    
        if ($dateStart && $dateEnd) {
            // Filter berdasarkan rentang tanggal
            $pinjamen->whereBetween('tgl_ambil', [$dateStart, $dateEnd]);
        }
    
        $pinjamen = $pinjamen->get();
    
        // Hitung jumlah pinjaman dan jumlah peminjam berdasarkan data yang difilter
        $jml_pinjaman = $pinjamen->sum('total');
        $jml_peminjam = $pinjamen->count();
    
        return view('laporan.index', [
            'pinjamen' => $pinjamen,
            'request' => $request,
            'jml_pinjaman' => $jml_pinjaman,
            'jml_peminjam' => $jml_peminjam,
        ]);
    }

    public function total_angsuran(Request $request)
{
    $dateStart = $request->input('date_start');
    $dateEnd = $request->input('date_end');

    $angsurans = Angsuran::query();

    if ($dateStart && $dateEnd) {
        // Filter berdasarkan rentang tanggal
        $angsurans->whereBetween('created_at', [
            $dateStart . ' 00:00:00',
            $dateEnd . ' 23:59:59'
        ]);
    }

    $angsurans = $angsurans->get();

    // Hitung jumlah pengansur dan total bayar berdasarkan data yang difilter
    $jml_pengansur = $angsurans->count();
    $jml_bayar = $angsurans->sum('jml_bayar');

    return view('laporan.total_angsuran', [
        'angsurans' => $angsurans,
        'request' => $request,
        'jml_pengansur' => $jml_pengansur,
        'jml_bayar' => $jml_bayar,
    ]);
}
    
    public function printIndex(Request $request)
    {
        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');
    
        $pinjamen = Pinjaman::query();
    
        if ($dateStart && $dateEnd) {
            // Filter berdasarkan rentang tanggal
            $pinjamen->whereBetween('tgl_ambil', [$dateStart, $dateEnd]);
        }
    
        $pinjamen = $pinjamen->get();
    
        // Hitung jumlah pinjaman dan jumlah peminjam berdasarkan data yang difilter
        $jml_pinjaman = $pinjamen->sum('total');
        $jml_peminjam = $pinjamen->count();
    
        return view('laporan.printIndex', [
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'pinjamen' => $pinjamen,
            'request' => $request,
            'jml_pinjaman' => $jml_pinjaman,
            'jml_peminjam' => $jml_peminjam,
        ]);
    }
    
    public function printTotalAngsuran(Request $request)
    {
        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');
    
        $angsurans = Angsuran::query();
    
        if ($dateStart && $dateEnd) {
            // Filter berdasarkan rentang tanggal
            $angsurans->whereBetween('created_at', [
                $dateStart . ' 00:00:00',
                $dateEnd . ' 23:59:59'
            ]);
        }
    
        $angsurans = $angsurans->get();
    
        // Hitung jumlah pengansur dan total bayar berdasarkan data yang difilter
        $jml_pengansur = $angsurans->count();
        $jml_bayar = $angsurans->sum('jml_bayar');
    
        return view('laporan.printTotalAngsuran', [
            'angsurans' => $angsurans,
            'request' => $request,
            'jml_pengansur' => $jml_pengansur,
            'jml_bayar' => $jml_bayar,
        ]);
    }

}