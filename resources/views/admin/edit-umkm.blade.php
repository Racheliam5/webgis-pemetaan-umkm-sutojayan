<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-red-600 mb-6">Edit Data UMKM</h2>

        <form action="{{ route('umkm.update', $umkm->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Nama Usaha</label>
                <input type="text" name="nama_usaha" value="{{ $umkm->nama_usaha }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Pemilik</label>
                <input type="text" name="pemilik" value="{{ $umkm->pemilik }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Bidang Usaha</label>
                <input type="text" name="bidang_usaha" value="{{ $umkm->bidang_usaha }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Desa</label>
                <input type="text" name="desa" value="{{ $umkm->desa }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Status Potensi</label>
                <input type="text" name="status_potensi" value="{{ $umkm->status_potensi }}" class="w-full border p-2 rounded">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('admin.data.umkm') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
