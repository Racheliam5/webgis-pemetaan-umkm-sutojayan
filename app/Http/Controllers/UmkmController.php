<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::all();
        return view('admin.data-umkm', compact('umkms'));
    }

    public function create()
    {
        return view('admin.create-umkm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'pemilik' => 'required',
            'bidang_usaha' => 'required',
            'desa' => 'required',
            'status_potensi' => 'required',
        ]);

        Umkm::create([
            'nama_usaha' => $request->nama_usaha,
            'pemilik' => $request->pemilik,
            'bidang_usaha' => $request->bidang_usaha,
            'desa' => $request->desa,
            'status_potensi' => $request->status_potensi,
        ]);

        return redirect()->route('admin.data.umkm')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.edit-umkm', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'pemilik' => 'required',
            'bidang_usaha' => 'required',
            'desa' => 'required',
            'status_potensi' => 'required',
        ]);

        $umkm = Umkm::findOrFail($id);

        $umkm->update([
            'nama_usaha' => $request->nama_usaha,
            'pemilik' => $request->pemilik,
            'bidang_usaha' => $request->bidang_usaha,
            'desa' => $request->desa,
            'status_potensi' => $request->status_potensi,
        ]);

        return redirect()->route('admin.data.umkm')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect()->route('admin.data.umkm')->with('success', 'Data berhasil dihapus');
    }
}
