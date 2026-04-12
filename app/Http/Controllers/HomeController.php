<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUmkm = 676;

        // Data awal statis untuk landing page
        // Nanti bisa diganti query database
        $sektorTerbanyak = 'Kuliner';
        $totalPotensiEkonomi = 'Rp 12,5 Miliar / tahun';

        return view('home', compact('totalUmkm', 'sektorTerbanyak', 'totalPotensiEkonomi'));
    }
}
