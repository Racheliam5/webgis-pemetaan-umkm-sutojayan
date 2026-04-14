<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">
    <h2 class="text-2xl font-bold text-red-600 mb-6">Tambah Data UMKM</h2>

    <form action="{{ route('umkm.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label>Nama Usaha</label>
            <input type="text" name="nama_usaha" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Bidang Usaha</label>
            <input type="text" name="bidang_usaha" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Desa</label>
            <input type="text" name="desa" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Status Potensi</label>
            <select name="status_potensi" class="w-full border p-2 rounded">
                <option value="Tinggi">Tinggi</option>
                <option value="Sedang">Sedang</option>
                <option value="Berkembang">Berkembang</option>
                <option value="Potensial">Potensial</option>
            </select>
        </div>

        <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Simpan
        </button>

        <a href="{{ route('admin.data.umkm') }}"
           class="ml-2 bg-gray-300 px-4 py-2 rounded">
           Batal
        </a>
    </form>
</div>

</body>
</html>
