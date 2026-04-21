<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Potensi Ekonomi UMKM - Sutojayan</title>

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
<body class="bg-gray-100 text-gray-800 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-md border-b border-red-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-primary-700">
                    Dashboard Potensi Ekonomi UMKM
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Sistem Informasi Pemetaan UMKM Kecamatan Sutojayan
                </p>
            </div>

            <a href="{{ route('home') }}"
               class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-lg font-semibold transition text-center">
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl shadow-md border border-red-100 p-6 md:p-8">

            <div class="mb-6">
                <h2 class="text-3xl font-bold text-primary-700">Visualisasi Potensi Ekonomi UMKM</h2>
                <p class="text-gray-600 mt-2">
                    Halaman ini menampilkan grafik dan diagram untuk membantu analisis jumlah UMKM per Kelurahan/Desa dan sektor usaha dominan di Kecamatan Sutojayan.
                </p>
            </div>

            <!-- Area Grafik -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 border border-red-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-primary-700 mb-4">
                        Grafik Jumlah UMKM per Kelurahan/Desa
                    </h3>
                    <div class="h-80">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <div class="bg-gray-50 border border-red-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-primary-700 mb-4">
                        Diagram Sektor Usaha Dominan
                    </h3>
                    <div class="h-80 flex items-center justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Ringkasan singkat -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="bg-primary-50 border border-primary-100 rounded-2xl p-5">
                    <p class="text-sm uppercase tracking-wide text-primary-600">Total UMKM</p>
                    <h4 class="text-3xl font-bold mt-2 text-gray-800">{{ $totalUmkm }}</h4>
                    <p class="text-sm text-gray-600 mt-2">Jumlah keseluruhan UMKM terdata.</p>
                </div>

            <div class="bg-primary-50 border border-primary-100 rounded-2xl p-5">
                <p class="text-sm uppercase tracking-wide text-primary-600">Kelurahan/Desa Dominan</p>
                <h4 class="text-3xl font-bold mt-2 text-gray-800">{{ $wilayahDominan }}</h4>
                <p class="text-sm text-gray-600 mt-2">
                        Wilayah dengan jumlah UMKM terbanyak ({{ $jumlahDominan }} UMKM).
                </p>
            </div>

            <div class="bg-primary-50 border border-primary-100 rounded-2xl p-5">
                <p class="text-sm uppercase tracking-wide text-primary-600">Sektor Dominan</p>
                <h4 class="text-3xl font-bold mt-2 text-gray-800">{{ $sektorDominan }}</h4>
                <p class="text-sm text-gray-600 mt-2">
                        Sektor usaha paling banyak dijalankan ({{ $jumlahSektorDominan }} UMKM).
                </p>
            </div>
        </div>

            <!-- Tombol Export -->
            <div class="flex flex-wrap justify-end gap-4">
                <button
                    class="bg-white border border-primary-300 text-primary-700 hover:bg-primary-50 px-5 py-3 rounded-lg font-semibold transition">
                    Download PDF
                </button>

                <button
                    class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-3 rounded-lg font-semibold transition">
                    Export Excel
                </button>
            </div>

        </div>
    </main>

<script>
    const barCtx = document.getElementById('barChart');

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: [
                'Kembangarum',
                'Sutojayan',
                'Kalipang',
                'Bacem',
                'Kedungbunder',
                'Jingglong',
                'Sukorejo',
                'Sumberjo',
                'Jegu',
                'Pandanarum',
                'Kaulon'
            ],
            datasets: [{
                label: 'Jumlah UMKM',
                data: [60, 20, 33, 56, 5, 4, 5, 6, 127, 256],
                backgroundColor: [
                    '#f87171', // Kembangarum
                    '#ef4444', // Sutojayan
                    '#dc2626', // Kalipang
                    '#f43f5e', // Bacem
                    '#fecaca', // Kedungbunder
                    '#fca5a5', // Jingglong
                    '#fee2e2', // Sukorejo
                    '#fda4af', // Sumberjo
                    '#b91c1c', // Jegu
                    '#7f1d1d',  // Pandanarum (paling gelap = dominan)
                    '#991b1b' // Kaulon
                ],
                borderRadius: 8,
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
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
