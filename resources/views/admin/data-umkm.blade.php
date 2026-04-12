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
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3">1</td>
                            <td class="px-4 py-3 font-medium">UMKM Maju Jaya</td>
                            <td class="px-4 py-3">Budi Santoso</td>
                            <td class="px-4 py-3">Kuliner</td>
                            <td class="px-4 py-3">Sutojayan</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
                                    Tinggi
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                        Edit
                                    </button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3">2</td>
                            <td class="px-4 py-3 font-medium">Batik Kreatif</td>
                            <td class="px-4 py-3">Siti Aminah</td>
                            <td class="px-4 py-3">Fashion</td>
                            <td class="px-4 py-3">Bacem</td>
                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">
                                    Sedang
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                        Edit
                                    </button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3">3</td>
                            <td class="px-4 py-3 font-medium">Kerajinan Lokal</td>
                            <td class="px-4 py-3">Ahmad Fauzi</td>
                            <td class="px-4 py-3">Kerajinan</td>
                            <td class="px-4 py-3">Kedungbunder</td>
                            <td class="px-4 py-3">
                                <span class="bg-purple-100 text-purple-700 text-sm px-3 py-1 rounded-full">
                                    Berkembang
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                        Edit
                                    </button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3">4</td>
                            <td class="px-4 py-3 font-medium">Servis Mandiri</td>
                            <td class="px-4 py-3">Dedi Hartono</td>
                            <td class="px-4 py-3">Jasa</td>
                            <td class="px-4 py-3">Sutojayan</td>
                            <td class="px-4 py-3">
                                <span class="bg-orange-100 text-orange-700 text-sm px-3 py-1 rounded-full">
                                    Potensial
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                        Edit
                                    </button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol bawah -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <button class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold shadow-sm transition">
                    Tambah UMKM
                </button>

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
