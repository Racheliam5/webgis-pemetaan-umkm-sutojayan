<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta UMKM - WebGIS Sutojayan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

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

    <style>
        html, body {
            height: 100%;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 14px;
        }

        .leaflet-popup-content {
            margin: 14px 16px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="h-screen flex">

        <!-- Sidebar Filter -->
        <aside class="w-72 bg-white border-r border-red-100 shadow-md flex flex-col">
            <div class="bg-primary-700 text-white px-6 py-5">
                <h1 class="text-xl font-bold">Filter Peta UMKM</h1>
                <p class="text-sm text-red-100 mt-1">Kecamatan Sutojayan</p>
            </div>

            <div class="p-6 space-y-5 overflow-y-auto">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Usaha
                    </label>
                    <select id="filterKategori"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="semua">Semua Kategori</option>
                        <option value="Kuliner">Kuliner</option>
                        <option value="Fashion">Fashion</option>
                        <option value="Kerajinan">Kerajinan</option>
                        <option value="Jasa">Jasa</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Wilayah
                    </label>
                    <select id="filterWilayah"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="semua">Semua Wilayah</option>
                        <option value="Sutojayan">Sutojayan</option>
                        <option value="Bacem">Bacem</option>
                        <option value="Kedungbunder">Kedungbunder</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status Data
                    </label>
                    <select id="filterStatus"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="semua">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Belum Verifikasi">Belum Verifikasi</option>
                    </select>
                </div>

                <div class="pt-2 space-y-3">
                    <button id="btnFilter"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white py-3 rounded-xl font-semibold transition">
                        Terapkan Filter
                    </button>

                    <button id="btnReset"
                        class="w-full bg-white border border-primary-300 text-primary-700 hover:bg-primary-50 py-3 rounded-xl font-semibold transition">
                        Reset Filter
                    </button>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <h3 class="font-bold text-primary-700 mb-3">Informasi Modul</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Halaman ini digunakan untuk menampilkan persebaran UMKM secara geografis.
                        Pengguna dapat memfilter data berdasarkan kategori usaha, wilayah, dan status data,
                        lalu melihat detail setiap titik UMKM melalui pop-up marker pada peta.
                    </p>
                </div>

                <div class="pt-4">
                    <a href="{{ route('home') }}"
                       class="block text-center bg-primary-700 hover:bg-primary-800 text-white py-3 rounded-xl font-semibold transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </aside>

        <!-- Area Peta -->
        <main class="flex-1 p-5 bg-gray-100">
            <div class="h-full bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-primary-700">Modul Peta Interaktif UMKM</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Visualisasi persebaran UMKM berbasis lokasi di Kecamatan Sutojayan
                        </p>
                    </div>
                    <div class="text-sm text-gray-500">
                        Leaflet WebGIS
                    </div>
                </div>

                <div class="h-[calc(100%-81px)]">
                    <div id="map"></div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const sutojayanCoords = [-8.0985, 112.1680];

        const map = L.map('map').setView(sutojayanCoords, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const umkmData = [
            {
                nama: "UMKM Maju Jaya",
                kategori: "Kuliner",
                wilayah: "Sutojayan",
                status: "Aktif",
                deskripsi: "Usaha makanan tradisional khas daerah.",
                pemilik: "Budi Santoso",
                lat: -8.0985,
                lng: 112.1680
            },
            {
                nama: "Batik Kreatif",
                kategori: "Fashion",
                wilayah: "Bacem",
                status: "Aktif",
                deskripsi: "Usaha batik lokal dengan motif khas.",
                pemilik: "Siti Aminah",
                lat: -8.1020,
                lng: 112.1725
            },
            {
                nama: "Kerajinan Lokal",
                kategori: "Kerajinan",
                wilayah: "Kedungbunder",
                status: "Belum Verifikasi",
                deskripsi: "Kerajinan tangan berbahan lokal.",
                pemilik: "Ahmad Fauzi",
                lat: -8.0948,
                lng: 112.1642
            },
            {
                nama: "Servis Mandiri",
                kategori: "Jasa",
                wilayah: "Sutojayan",
                status: "Aktif",
                deskripsi: "Layanan servis elektronik rumah tangga.",
                pemilik: "Dedi Hartono",
                lat: -8.1060,
                lng: 112.1708
            }
        ];

        let markerLayer = L.layerGroup().addTo(map);

        function renderMarkers(data) {
            markerLayer.clearLayers();

            if (data.length === 0) {
                alert('Data tidak ditemukan sesuai filter.');
                return;
            }

            data.forEach(item => {
                const marker = L.marker([item.lat, item.lng]);

                marker.bindPopup(`
                    <div class="min-w-[220px]">
                        <h3 style="font-size:16px; font-weight:700; color:#b91c1c; margin-bottom:8px;">
                            ${item.nama}
                        </h3>
                        <p style="margin:4px 0;"><strong>Kategori:</strong> ${item.kategori}</p>
                        <p style="margin:4px 0;"><strong>Wilayah:</strong> ${item.wilayah}</p>
                        <p style="margin:4px 0;"><strong>Status:</strong> ${item.status}</p>
                        <p style="margin:8px 0 4px 0;"><strong>Pemilik:</strong> ${item.pemilik}</p>
                        <p style="margin:4px 0; color:#4b5563;">${item.deskripsi}</p>
                    </div>
                `);

                markerLayer.addLayer(marker);
            });
        }

        renderMarkers(umkmData);

        document.getElementById('btnFilter').addEventListener('click', function () {
            const kategori = document.getElementById('filterKategori').value;
            const wilayah = document.getElementById('filterWilayah').value;
            const status = document.getElementById('filterStatus').value;

            const filtered = umkmData.filter(item => {
                const matchKategori = kategori === 'semua' || item.kategori === kategori;
                const matchWilayah = wilayah === 'semua' || item.wilayah === wilayah;
                const matchStatus = status === 'semua' || item.status === status;

                return matchKategori && matchWilayah && matchStatus;
            });

            renderMarkers(filtered);
        });

        document.getElementById('btnReset').addEventListener('click', function () {
            document.getElementById('filterKategori').value = 'semua';
            document.getElementById('filterWilayah').value = 'semua';
            document.getElementById('filterStatus').value = 'semua';

            renderMarkers(umkmData);
        });
    </script>
</body>
</html>
