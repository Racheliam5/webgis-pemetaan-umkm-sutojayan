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
            min-height: 500px;
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
                        <option value="Perdagangan">Perdagangan</option>
                        <option value="Industri/Produksi">Industri/Produksi</option>
                        <option value="Jasa">Jasa</option>
                        <option value="Kecantikan">Kecantikan</option>
                        <option value="Lainnya">Lainnya</option>
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
                        <option value="Kalipang">Kalipang</option>
                        <option value="Kembangarum">Kembangarum</option>
                        <option value="Kedungbunder">Kedungbunder</option>
                        <option value="Jingglong">Jingglong</option>
                        <option value="Jegu">Jegu</option>
                        <option value="Bacem">Bacem</option>
                        <option value="Pandanarum">Pandanarum</option>
                        <option value="Kaulon">Kaulon</option>
                        <option value="Sukorejo">Sukorejo</option>
                        <option value="Sumberjo">Sumberjo</option>
                    </select>
                </div>

                <div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status Potensi
                    </label>
                    <select id="filterStatus"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="semua">Semua Potensi</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
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

<script>
    const umkmData = @json($umkms);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([-8.1690904, 112.211385], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const umkmData = @json($umkms);

        umkmData.forEach(item => {
            if (!item.latitude || !item.longitude) return;

            let color = 'red';
            const status = (item.status_potensi || '').toLowerCase();

            if (status === 'tinggi') color = 'green';
            else if (status === 'sedang') color = 'orange';

            const icon = L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            L.marker([parseFloat(item.latitude), parseFloat(item.longitude)], { icon })
                .addTo(map)
                .bindPopup(`
                    <strong>${item.nama_usaha}</strong><br>
                    Pemilik: ${item.pemilik ?? '-'}<br>
                    Bidang: ${item.bidang_usaha ?? '-'}<br>
                    Desa/Kelurahan: ${item.desa ?? '-'}<br>
                    Potensi: ${item.status_potensi ?? '-'}
                `);
        });
    });
</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const sutojayanCenter = [-8.1690904, 112.211385];

    const map = L.map('map').setView(sutojayanCenter, 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const wilayahSutojayan = [
        { lat: -8.1728046, lng: 112.2311303, jenis: "Desa" },
        { lat: -8.1788382, lng: 112.2091866, jenis: "Kelurahan" },
        { lat: -8.17702, lng: 112.2170105, jenis: "Kelurahan" },
        { lat: -8.1943179, lng: 112.2348146, jenis: "Desa" },
        { lat: -8.1814695, lng: 112.2451082, jenis: "Desa" },
        { lat: -8.1726077, lng: 112.2337362, jenis: "Kelurahan" },
        { lat: -8.1691309, lng: 112.2123175, jenis: "Kelurahan" },
        { lat: -8.1588429, lng: 112.2122, jenis: "Kelurahan" },
        { lat: -8.1679415, lng: 112.2086582, jenis: "Kelurahan" },
        { lat: -8.1581743, lng: 112.2784052, jenis: "Desa" },
        { lat: -8.1489265, lng: 112.2371909, jenis: "Kelurahan" }
    ];

    const batasKecamatan = [
        [-8.1560, 112.1950],
        [-8.1485, 112.2140],
        [-8.1490, 112.2400],
        [-8.1560, 112.2785],
        [-8.1730, 112.2795],
        [-8.1955, 112.2460],
        [-8.2010, 112.2240],
        [-8.1880, 112.1980],
        [-8.1730, 112.1930]
    ];

    // Garis batas kecamatan
    L.polygon(batasKecamatan, {
        color: '#ef4444',
        weight: 3,
        dashArray: '10, 8',
        fillOpacity: 0
    }).addTo(map);

    setTimeout(() => {
        map.invalidateSize();
    }, 300);
});
</script>
</body>
</html>
