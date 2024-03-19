<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $fillabel =[
        'nik',
        'nama',
        'alamat',
        'no_hp',
    ];

}
