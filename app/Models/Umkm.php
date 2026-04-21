<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $fillable = [
    'nama_usaha',
    'pemilik',
    'bidang_usaha',
    'desa',
    'alamat',
    'status_potensi',
    'latitude',
    'longitude',
    'gambar',

    ];
}
