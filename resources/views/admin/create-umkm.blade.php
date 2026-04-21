<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">
    <h2 class="text-2xl font-bold text-red-600 mb-6">Tambah Data UMKM</h2>

    <form action="{{ route('umkm.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama Usaha</label>
            <input type="text" name="nama_usaha" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Pemilik</label>
            <input type="text" name="pemilik" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Bidang Usaha</label>
            <select name="bidang_usaha" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Bidang Usaha --</option>
                <option value="Kuliner">Kuliner</option>
                <option value="Fashion">Fashion</option>
                <option value="Kerajinan">Kerajinan</option>
                <option value="Jasa">Jasa</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Desa / Kelurahan</label>
            <select name="desa" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Wilayah --</option>
                <option value="Sutojayan">Sutojayan</option>
                <option value="Kalipang">Kalipang</option>
                <option value="Kedungbunder">Kedungbunder</option>
                <option value="Kembangarum">Kembangarum</option>
                <option value="Jegu">Jegu</option>
                <option value="Sukorejo">Sukorejo</option>
                <option value="Jingglong">Jingglong</option>
                <option value="Kaulon">Kaulon</option>
                <option value="Sumberjo">Sumberjo</option>
                <option value="Bacem">Bacem</option>
                <option value="Pandanarum">Pandanarum</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Alamat</label>
            <textarea name="alamat" class="w-full border p-2 rounded" rows="3"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Status Potensi</label>
            <select name="status_potensi" class="w-full border p-2 rounded" required>
                <option value="tinggi">Tinggi</option>
                <option value="sedang">Sedang</option>
                <option value="rendah">Rendah</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-1 font-medium">Latitude</label>
                <input type="text" name="latitude" class="w-full border p-2 rounded" placeholder="-8.1724563">
            </div>
            <div>
                <label class="block mb-1 font-medium">Longitude</label>
                <input type="text" name="longitude" class="w-full border p-2 rounded" placeholder="112.2122597">
            </div>
        </div>

        <div class="mb-6 text-sm text-gray-500">
            Isi latitude dan longitude agar titik UMKM bisa tampil di peta.
        </div>

        <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Simpan
        </button>

        <a href="{{ route('admin.data.umkm') }}"
           class="ml-2 bg-gray-300 px-4 py-2 rounded inline-block">
           Batal
        </a>
    </form>
</div>

</body>
</html>
