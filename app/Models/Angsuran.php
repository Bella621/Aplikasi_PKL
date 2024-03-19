<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;
    protected $fillabel =[
        'nama', 
        'sisa_angsuran',
        'tgl_angsuran',
        'jml_bayar',
       
    ];
}
