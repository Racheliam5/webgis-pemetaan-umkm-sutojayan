<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta UMKM Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        html, body {
            height: 100%;
        }

        #map {
            width: 100%;
            height: 100%;
            min-height: 500px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-72 bg-red-800 text-white flex flex-col">
        <div class="px-6 py-6 border-b border-red-700">
            <h1 class="text-2xl font-bold">Admin WebGIS UMKM</h1>
            <p class="text-red-100 text-sm mt-1">Kecamatan Sutojayan</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-3">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-xl hover:bg-red-700 font-semibold">
                Dashboard
            </a>

            <a href="{{ route('admin.data.umkm') }}"
               class="block px-4 py-3 rounded-xl hover:bg-red-700 font-semibold">
                Data UMKM
            </a>

            <a href="{{ route('admin.map.umkm') }}"
               class="block px-4 py-3 rounded-xl bg-red-700 font-semibold">
                Peta UMKM
            </a>

            <a href="{{ route('logout') }}"
               class="block px-4 py-3 rounded-xl hover:bg-red-700 font-semibold">
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1">
        <div class="bg-white border-b border-gray-200 px-8 py-6">
            <h2 class="text-3xl font-bold text-red-700">Peta UMKM Admin</h2>
            <p class="text-gray-500 mt-1">Persebaran lokasi UMKM yang sudah diinput</p>
        </div>

        <div class="p-8">
            <div class="bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden">
                <div class="h-[650px]">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('map').setView([-8.1690904, 112.211385], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const umkmData = @json($umkms);

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

        const polygon = L.polygon(batasKecamatan, {
            color: '#ef4444',
            weight: 3,
            dashArray: '10, 8',
            fillOpacity: 0
        }).addTo(map);

        const bounds = [];

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

            const marker = L.marker(
                [parseFloat(item.latitude), parseFloat(item.longitude)],
                { icon: icon }
            ).addTo(map);

            marker.bindPopup(`
                <div style="min-width:220px">
                    <strong>${item.nama_usaha}</strong><br>
                    Pemilik: ${item.pemilik ?? '-'}<br>
                    Bidang: ${item.bidang_usaha ?? '-'}<br>
                    Wilayah: ${item.desa ?? '-'}<br>
                    Potensi: ${item.status_potensi ?? '-'}
                </div>
            `);

            bounds.push([parseFloat(item.latitude), parseFloat(item.longitude)]);
        });

        if (bounds.length > 0) {
            map.fitBounds(bounds, { padding: [20, 20] });
        } else {
            map.fitBounds(polygon.getBounds(), { padding: [20, 20] });
        }

        setTimeout(() => {
            map.invalidateSize();
        }, 300);
    });
</script>
</body>
</html>
