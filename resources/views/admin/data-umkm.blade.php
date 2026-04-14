<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data UMKM - WebGIS UMKM Sutojayan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-md border-b border-red-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-primary-700">
                    Modul Data UMKM
                </h1>
                <p class="text-sm text-gray-500">
                    Sistem Informasi Pemetaan UMKM Kecamatan Sutojayan
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-lg font-semibold transition">
                Kembali ke Dashboard
            </a>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6 md:p-8">

            <!-- Judul -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-primary-700">Tabel Data UMKM</h2>
                <p class="text-gray-600 mt-1">
                    Modul ini digunakan untuk mengelola data UMKM secara terstruktur, cepat, dan terintegrasi dengan peta WebGIS.
                </p>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-primary-700 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama Usaha</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Pemilik</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Bidang Usaha</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Desa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status Potensi</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach ($umkms as $umkm)
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium">{{ $umkm->nama_usaha }}</td>
                            <td class="px-4 py-3">{{ $umkm->pemilik }}</td>
                            <td class="px-4 py-3">{{ $umkm->bidang_usaha }}</td>
                            <td class="px-4 py-3">{{ $umkm->desa }}</td>
                            <td class="px-4 py-3">
                        <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
                            {{ $umkm->status_potensi }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2">
                        <a href="{{ route('umkm.edit', $umkm->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm inline-block">
                            Edit
                        </a>

                    <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                        Hapus
                    </button>
                    </form>
                </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
                </table>
            </div>

            <!-- Tombol bawah -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('umkm.create') }}"
                class="bg-red-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-700 transition">
                    Tambah UMKM
                </a>

                <button class="bg-white border border-primary-300 text-primary-700 hover:bg-primary-50 px-6 py-3 rounded-lg font-semibold shadow-sm transition">
                    Import Excel
                </button>

                <button class="bg-white border border-primary-300 text-primary-700 hover:bg-primary-50 px-6 py-3 rounded-lg font-semibold shadow-sm transition">
                    Export Data
                </button>
            </div>
        </div>
    </main>

</body>
</html>
