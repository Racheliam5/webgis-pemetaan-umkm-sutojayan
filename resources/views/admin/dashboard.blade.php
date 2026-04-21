<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - WebGIS UMKM Sutojayan</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const adminMapElement = document.getElementById('adminMap');
        if (!adminMapElement) return;

        const adminMap = L.map('adminMap').setView([-8.1690904, 112.211385], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(adminMap);

        const umkmData = @json($mapUmkms);

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
        }).addTo(adminMap);

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
            ).addTo(adminMap);

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
            adminMap.fitBounds(bounds, { padding: [20, 20] });
        } else {
            adminMap.fitBounds(polygon.getBounds(), { padding: [20, 20] });
        }

        setTimeout(() => {
            adminMap.invalidateSize();
        }, 300);
    });
</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-primary-800 text-white flex flex-col">
            <div class="px-6 py-5 border-b border-primary-700">
                <h1 class="text-lg font-bold leading-snug">
                    Admin WebGIS UMKM
                </h1>
                <p class="text-sm text-red-200 mt-1">Kecamatan Sutojayan</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-3 rounded-lg bg-primary-700 hover:bg-primary-600 transition font-medium">
                    Dashboard
                </a>

                <a href="{{ route('admin.data.umkm') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-primary-700 transition font-medium">
                        Data UMKM
                </a>

                <a href="{{ route('admin.map.umkm') }}"
                    class="block px-4 py-3 rounded-xl hover:bg-red-700 font-semibold">
                        Peta UMKM
                </a>

                <a href="{{ route('logout') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-red-700 transition font-medium">
                    Logout
                </a>
        </aside>

        <!-- Main Area -->
        <div class="flex-1 flex flex-col">

            <!-- Topbar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-primary-700">
                            Sistem Informasi Pemetaan UMKM Kecamatan Sutojayan
                        </h2>
                        <p class="text-sm text-gray-500">
                            Dashboard Admin
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">
                                {{ session('user_name') ?? 'Admin' }}
                            </p>
                            <p class="text-sm text-gray-500">Pengelola Sistem</p>
                        </div>
                        <div class="w-11 h-11 rounded-full bg-primary-600 text-white flex items-center justify-center font-bold text-lg">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6">

                <!-- Heading -->
                <main class="flex-1 bg-gray-100 p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-red-700">Ringkasan Dashboard</h2>
        <p class="text-gray-600 mt-2">
            Monitoring awal data UMKM sebagai alat bantu analisis dan pengambilan keputusan.
        </p>
    </div>

    <!-- Card Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-3xl p-8 shadow border border-red-100">
            <p class="text-sm uppercase tracking-wide text-red-400">Total UMKM</p>
            <h3 class="text-5xl font-bold text-slate-800 mt-3">{{ $totalUmkm }}</h3>
            <p class="text-gray-500 mt-3">Jumlah keseluruhan UMKM terdata</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow border border-red-100">
            <p class="text-sm uppercase tracking-wide text-red-400">UMKM Aktif</p>
            <h3 class="text-5xl font-bold text-slate-800 mt-3">{{ $umkmAktif }}</h3>
            <p class="text-gray-500 mt-3">UMKM yang aktif menjalankan usaha</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow border border-red-100">
            <p class="text-sm uppercase tracking-wide text-red-400">Total Desa/Kelurahan</p>
            <h3 class="text-5xl font-bold text-slate-800 mt-3">{{ $totalWilayah }}</h3>
            <p class="text-gray-500 mt-3">Wilayah administrasi yang terdata</p>
        </div>
    </div>

    <!-- Modul -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('admin.data.umkm') }}"
           class="block bg-red-600 text-white rounded-3xl p-8 shadow-md hover:bg-red-700 transition">
            <h3 class="text-2xl font-bold mb-4">Modul Data UMKM</h3>
            <p class="text-lg leading-relaxed">
                Kelola data UMKM, tambah data, ubah data, dan hapus data.
            </p>
        </a>

        <a href="{{ route('admin.map.umkm') }}"
           class="block bg-red-800 text-white rounded-3xl p-8 shadow-md hover:bg-red-900 transition">
            <h3 class="text-2xl font-bold mb-4">Modul Peta UMKM</h3>
            <p class="text-lg leading-relaxed">
                Lihat persebaran lokasi UMKM dan analisis spasial berbasis WebGIS.
            </p>
        </a>
    </div>

    <!-- Statistik per Sektor -->
    <div class="bg-white rounded-3xl p-8 shadow border border-red-100 mb-8">
        <h3 class="text-2xl font-bold text-red-700 mb-6">Statistik UMKM per Sektor</h3>
        <div class="h-[400px]">
            <canvas id="sektorChart"></canvas>
        </div>
    </div>

    <!-- Komposisi UMKM -->
    <div class="bg-white rounded-3xl p-8 shadow border border-red-100">
        <h3 class="text-2xl font-bold text-red-700 mb-6">Komposisi UMKM</h3>
        <div class="h-[400px] flex items-center justify-center">
            <canvas id="komposisiChart"></canvas>
        </div>
    </div>
</main>
        </div>
    </div>

<script>
    const komposisiLabels = @json($komposisiLabels);
    const komposisiData = @json($komposisiData);

    const komposisiCtx = document.getElementById('komposisiChart').getContext('2d');

    new Chart(komposisiCtx, {
        type: 'doughnut',
        data: {
            labels: komposisiLabels,
            datasets: [{
                data: komposisiData,
                backgroundColor: [
                    '#16a34a', // tinggi
                    '#f59e0b', // sedang
                    '#dc2626'  // rendah
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '58%',
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>

    <script>
    const sektorLabels = @json($sektorLabels);
    const sektorData = @json($sektorData);

    const sektorCtx = document.getElementById('sektorChart').getContext('2d');

    new Chart(sektorCtx, {
        type: 'bar',
        data: {
            labels: sektorLabels,
            datasets: [{
                label: 'Jumlah UMKM',
                data: sektorData,
                backgroundColor: [
                    '#ef4444',
                    '#f87171',
                    '#fca5a5',
                    '#dc2626',
                    '#991b1b',
                    '#b91c1c',
                    '#fb7185',
                    '#f43f5e'
                ],
                borderRadius: 10,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
