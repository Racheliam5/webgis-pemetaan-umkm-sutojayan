<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'nama_umkm',
        'pemilik',
        'alamat',
        'sektor_usaha',
        'deskripsi',
        'latitude',
        'longitude',
        'omzet',
        'kontak',
    ];
}
