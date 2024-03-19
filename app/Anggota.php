<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    //

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'no_hp',
        'homebase'
    ];
}
