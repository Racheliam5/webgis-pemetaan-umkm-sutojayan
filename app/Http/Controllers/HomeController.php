<?php

namespace App\Http\Controllers;

use App\Models\Umkm;

class HomeController extends Controller
{
    public function index()
    {
        $totalUmkm = Umkm::count();

        $sektorCounts = Umkm::whereNotNull('bidang_usaha')
            ->selectRaw('bidang_usaha, COUNT(*) as total')
            ->groupBy('bidang_usaha')
            ->pluck('total', 'bidang_usaha');

        $sektorDominan = $sektorCounts->sortDesc()->keys()->first() ?? '-';
        $jumlahSektorDominan = $sektorCounts->sortDesc()->first() ?? 0;

        return view('home', compact(
            'totalUmkm',
            'sektorDominan',
            'jumlahSektorDominan'
        ));
    }
}
