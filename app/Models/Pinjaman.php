<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $fillabel =[
        'nama',
        'tgl_ambil',
        'harga_barang',
        'bunga',
        'total',
        'jml_angsuran',
        'angsuran',
    ];
}
