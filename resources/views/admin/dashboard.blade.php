<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - WebGIS UMKM Sutojayan</title>

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

                <a href="#"
                   class="block px-4 py-3 rounded-lg hover:bg-primary-700 transition font-medium">
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
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-primary-700">Ringkasan Dashboard</h3>
                    <p class="text-gray-600 mt-1">
                        Monitoring awal data UMKM sebagai alat bantu analisis dan pengambilan keputusan.
                    </p>
                </div>

                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6">
                        <p class="text-sm uppercase tracking-wide text-primary-600">Total UMKM</p>
                        <h4 class="text-4xl font-bold mt-3 text-gray-800">676</h4>
                        <p class="text-gray-500 mt-2">Jumlah keseluruhan UMKM terdata</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6">
                        <p class="text-sm uppercase tracking-wide text-primary-600">UMKM Aktif</p>
                        <h4 class="text-4xl font-bold mt-3 text-gray-800">648</h4>
                        <p class="text-gray-500 mt-2">UMKM yang aktif menjalankan usaha</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6">
                        <p class="text-sm uppercase tracking-wide text-primary-600">Total Desa/Kelurahan</p>
                        <h4 class="text-4xl font-bold mt-3 text-gray-800">11</h4>
                        <p class="text-gray-500 mt-2">Wilayah administrasi yang terdata</p>
                    </div>
                </div>

                <!-- Shortcut -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <a href="#"
                       class="bg-primary-600 hover:bg-primary-700 text-white rounded-2xl p-6 shadow-md transition">
                        <h4 class="text-xl font-bold">Modul Data UMKM</h4>
                        <p class="mt-2 text-red-50">
                            Kelola data UMKM, tambah data, ubah data, dan hapus data.
                        </p>
                    </a>

                    <a href="#"
                       class="bg-primary-700 hover:bg-primary-800 text-white rounded-2xl p-6 shadow-md transition">
                        <h4 class="text-xl font-bold">Modul Peta UMKM</h4>
                        <p class="mt-2 text-red-50">
                            Lihat persebaran lokasi UMKM dan analisis spasial berbasis WebGIS.
                        </p>
                    </a>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6">
                        <h4 class="text-lg font-bold text-primary-700 mb-4">
                            Statistik UMKM per Sektor
                        </h4>
                        <div class="h-80">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6">
                        <h4 class="text-lg font-bold text-primary-700 mb-4">
                            Komposisi UMKM
                        </h4>
                        <div class="h-80 flex items-center justify-center">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        const barCtx = document.getElementById('barChart');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Kuliner', 'Fashion', 'Kerajinan', 'Jasa', 'Perdagangan'],
                datasets: [{
                    label: 'Jumlah UMKM',
                    data: [240, 120, 95, 110, 111],
                    backgroundColor: [
                        '#dc2626',
                        '#ef4444',
                        '#f87171',
                        '#b91c1c',
                        '#991b1b'
                    ],
                    borderRadius: 8
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

        const pieCtx = document.getElementById('pieChart');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Aktif', 'Belum Verifikasi', 'Tidak Aktif'],
                datasets: [{
                    data: [648, 18, 10],
                    backgroundColor: ['#dc2626', '#f87171', '#7f1d1d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
