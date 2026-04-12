<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog UMKM - WebGIS UMKM Sutojayan</title>

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
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-primary-700">
                    Modul Katalog UMKM
                </h1>
                <p class="text-sm text-gray-500">
                    Sistem Informasi Pemetaan UMKM Kecamatan Sutojayan
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <select id="filterKategori"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option value="Semua">Semua Kategori</option>
                    <option value="Kuliner">Kuliner</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Kerajinan">Kerajinan</option>
                    <option value="Jasa">Jasa</option>
                </select>

                <input type="text" id="searchInput"
                    placeholder="Cari nama UMKM..."
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">

                <a href="{{ route('home') }}"
                   class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-lg font-semibold transition text-center">
                    Kembali
                </a>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-primary-700">Katalog UMKM Kecamatan Sutojayan</h2>
            <p class="text-gray-600 mt-2">
                Daftar UMKM ditampilkan dalam bentuk katalog untuk mendukung promosi usaha lokal dan memudahkan pencarian informasi oleh masyarakat umum.
            </p>
        </div>

        <!-- Grid Card -->
        <div id="katalogGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1 -->
            <div class="umkm-card bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden"
                 data-kategori="Kuliner"
                 data-nama="UMKM Maju Jaya">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80"
                     alt="UMKM Maju Jaya"
                     class="w-full h-56 object-cover">
                <div class="p-5">
                    <span class="inline-block bg-red-100 text-primary-700 text-sm px-3 py-1 rounded-full mb-3">
                        Kuliner
                    </span>
                    <h3 class="text-xl font-bold text-gray-800">UMKM Maju Jaya</h3>
                    <p class="text-gray-600 mt-2">Usaha makanan tradisional khas daerah.</p>

                    <button onclick="showDetail('UMKM Maju Jaya', 'Kuliner', 'Budi Santoso', 'Sutojayan', 'Usaha makanan tradisional khas daerah dengan produk unggulan jajanan pasar dan katering rumahan.')"
                            class="mt-5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="umkm-card bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden"
                 data-kategori="Fashion"
                 data-nama="Batik Kreatif">
                <img src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80"
                     alt="Batik Kreatif"
                     class="w-full h-56 object-cover">
                <div class="p-5">
                    <span class="inline-block bg-red-100 text-primary-700 text-sm px-3 py-1 rounded-full mb-3">
                        Fashion
                    </span>
                    <h3 class="text-xl font-bold text-gray-800">Batik Kreatif</h3>
                    <p class="text-gray-600 mt-2">Produksi batik lokal dengan motif khas.</p>

                    <button onclick="showDetail('Batik Kreatif', 'Fashion', 'Siti Aminah', 'Bacem', 'UMKM batik lokal yang memproduksi kain dan pakaian batik dengan ciri khas daerah.')"
                            class="mt-5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="umkm-card bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden"
                 data-kategori="Kerajinan"
                 data-nama="Kerajinan Lokal">
                <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80"
                     alt="Kerajinan Lokal"
                     class="w-full h-56 object-cover">
                <div class="p-5">
                    <span class="inline-block bg-red-100 text-primary-700 text-sm px-3 py-1 rounded-full mb-3">
                        Kerajinan
                    </span>
                    <h3 class="text-xl font-bold text-gray-800">Kerajinan Lokal</h3>
                    <p class="text-gray-600 mt-2">Kerajinan tangan berbahan lokal.</p>

                    <button onclick="showDetail('Kerajinan Lokal', 'Kerajinan', 'Ahmad Fauzi', 'Kedungbunder', 'UMKM yang bergerak di bidang kerajinan tangan berbasis bahan lokal dan produk souvenir.')"
                            class="mt-5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="umkm-card bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden"
                 data-kategori="Jasa"
                 data-nama="Servis Mandiri">
                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=900&q=80"
                     alt="Servis Mandiri"
                     class="w-full h-56 object-cover">
                <div class="p-5">
                    <span class="inline-block bg-red-100 text-primary-700 text-sm px-3 py-1 rounded-full mb-3">
                        Jasa
                    </span>
                    <h3 class="text-xl font-bold text-gray-800">Servis Mandiri</h3>
                    <p class="text-gray-600 mt-2">Layanan servis elektronik rumah tangga.</p>

                    <button onclick="showDetail('Servis Mandiri', 'Jasa', 'Dedi Hartono', 'Sutojayan', 'UMKM jasa servis peralatan elektronik rumah tangga dengan layanan perbaikan dan konsultasi.')"
                            class="mt-5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="umkm-card bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden"
                 data-kategori="Kuliner"
                 data-nama="Dapur Sari Rasa">
                <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=900&q=80"
                     alt="Dapur Sari Rasa"
                     class="w-full h-56 object-cover">
                <div class="p-5">
                    <span class="inline-block bg-red-100 text-primary-700 text-sm px-3 py-1 rounded-full mb-3">
                        Kuliner
                    </span>
                    <h3 class="text-xl font-bold text-gray-800">Dapur Sari Rasa</h3>
                    <p class="text-gray-600 mt-2">Olahan makanan rumahan dan katering.</p>

                    <button onclick="showDetail('Dapur Sari Rasa', 'Kuliner', 'Rina Wulandari', 'Bacem', 'UMKM kuliner yang menyediakan makanan rumahan, snack box, dan katering acara.')"
                            class="mt-5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="umkm-card bg-white rounded-2xl shadow-md border border-red-100 overflow-hidden"
                 data-kategori="Fashion"
                 data-nama="Hijab Cantika">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=900&q=80"
                     alt="Hijab Cantika"
                     class="w-full h-56 object-cover">
                <div class="p-5">
                    <span class="inline-block bg-red-100 text-primary-700 text-sm px-3 py-1 rounded-full mb-3">
                        Fashion
                    </span>
                    <h3 class="text-xl font-bold text-gray-800">Hijab Cantika</h3>
                    <p class="text-gray-600 mt-2">Produk hijab dan busana muslim lokal.</p>

                    <button onclick="showDetail('Hijab Cantika', 'Fashion', 'Nur Aisyah', 'Kedungbunder', 'UMKM fashion lokal yang memproduksi hijab, gamis, dan busana muslim modern.')"
                            class="mt-5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

        </div>

        <p id="emptyMessage" class="hidden text-center text-gray-500 mt-10">
            Data UMKM tidak ditemukan.
        </p>
    </main>

    <!-- Modal Detail -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black/50 z-50 items-center justify-center px-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 relative">
            <button onclick="closeDetail()"
                    class="absolute top-3 right-4 text-gray-500 hover:text-red-600 text-2xl">
                &times;
            </button>

            <h3 id="detailNama" class="text-2xl font-bold text-primary-700 mb-3"></h3>
            <div class="space-y-2 text-gray-700">
                <p><strong>Bidang Usaha:</strong> <span id="detailKategori"></span></p>
                <p><strong>Pemilik:</strong> <span id="detailPemilik"></span></p>
                <p><strong>Wilayah:</strong> <span id="detailWilayah"></span></p>
                <p><strong>Deskripsi:</strong></p>
                <p id="detailDeskripsi" class="text-gray-600 leading-relaxed"></p>
            </div>
        </div>
    </div>

    <script>
        const filterKategori = document.getElementById('filterKategori');
        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.umkm-card');
        const emptyMessage = document.getElementById('emptyMessage');

        function filterCards() {
            const kategori = filterKategori.value.toLowerCase();
            const keyword = searchInput.value.toLowerCase();
            let visibleCount = 0;

            cards.forEach(card => {
                const cardKategori = card.dataset.kategori.toLowerCase();
                const cardNama = card.dataset.nama.toLowerCase();

                const matchKategori = kategori === 'semua' || cardKategori === kategori;
                const matchSearch = cardNama.includes(keyword);

                if (matchKategori && matchSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            emptyMessage.classList.toggle('hidden', visibleCount !== 0);
        }

        filterKategori.addEventListener('change', filterCards);
        searchInput.addEventListener('input', filterCards);

        function showDetail(nama, kategori, pemilik, wilayah, deskripsi) {
            document.getElementById('detailNama').textContent = nama;
            document.getElementById('detailKategori').textContent = kategori;
            document.getElementById('detailPemilik').textContent = pemilik;
            document.getElementById('detailWilayah').textContent = wilayah;
            document.getElementById('detailDeskripsi').textContent = deskripsi;

            const modal = document.getElementById('detailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDetail() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>
