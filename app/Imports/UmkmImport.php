<?php

namespace App\Imports;

use App\Models\Umkm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UmkmImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Umkm([
            'nama_usaha'      => $row['nama_usaha'] ?? null,
            'pemilik'         => $row['pemilik'] ?? null,
            'bidang_usaha'    => $row['bidang_usaha'] ?? null,
            'desa'            => $row['desa'] ?? null,
            'alamat'          => $row['alamat'] ?? null,
            'status_potensi'  => strtolower($row['status_potensi'] ?? 'rendah'),
            'latitude'        => $row['latitude'] ?? null,
            'longitude'       => $row['longitude'] ?? null,
            'gambar'          => $row['gambar'] ?? null,
        ]);
    }
}
