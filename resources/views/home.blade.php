<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pemetaan UMKM</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
            color: #222;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 16px;
        }

        /* NAVBAR */
        .navbar {
            background: #fff;
            border-bottom: 1px solid #d9d9d9;
            height: 78px;
            display: flex;
            align-items: center;
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #de2b23;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
        }

        .brand-text h1 {
            font-size: 15px;
            color: #cf241d;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 3px;
        }

        .brand-text p {
            font-size: 12px;
            color: #6f6f6f;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 28px;
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .menu a.active {
            color: #d62a22;
        }

        /* HERO */
        .hero {
            position: relative;
            min-height: 420px;
            overflow: hidden;
            border-top: 1px solid #ddd;
            background:
                linear-gradient(rgba(169, 18, 18, 0.78), rgba(169, 18, 18, 0.78)),
                url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=1600&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(146, 12, 12, 0.55) 0%, rgba(186, 30, 30, 0.30) 55%, rgba(192, 39, 39, 0.18) 100%);
            pointer-events: none;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            gap: 26px;
            align-items: center;
            padding: 16px 0 24px;
        }

        .hero-left {
            color: #fff;
            padding-top: 20px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-size: 13px;
            padding: 10px 16px;
            border-radius: 24px;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .hero-left h2 {
            font-size: 44px;
            line-height: 1.05;
            font-weight: 800;
            margin-bottom: 18px;
            max-width: 560px;
        }

        .hero-left p {
            font-size: 16px;
            line-height: 1.8;
            max-width: 560px;
            color: #ffe8e8;
        }

        .hero-map-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 16px;
            padding: 12px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.15);
            margin-top: 8px;
        }

        .hero-map-title {
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 10px;
            padding-left: 4px;
        }

        #heroMap {
            width: 100%;
            height: 292px;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.45);
        }

        /* CTA */
        .cta-section {
            background: #fff;
            padding: 46px 0 22px;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .btn-red {
            background: #e1261c;
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 14px 22px;
            min-width: 112px;
            box-shadow: 0 6px 14px rgba(225, 38, 28, 0.22);
            transition: .2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-red:hover {
            background: #c91d15;
        }

        /* STATS */
        .stats-section {
            padding: 32px 0 52px;
            text-align: center;
        }

        .stats-section h3 {
            font-size: 26px;
            font-weight: 800;
            color: #dd2119;
            margin-bottom: 8px;
        }

        .stats-section .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 34px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            text-align: left;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 18px;
            min-height: 118px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: 1px solid #f0dede;
        }

        .card-red {
            background: linear-gradient(180deg, #de1f18 0%, #c71616 100%);
            color: #fff;
            border: none;
            box-shadow: 0 8px 20px rgba(199, 22, 22, 0.18);
        }

        .card-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .3px;
            margin-bottom: 12px;
            color: inherit;
            opacity: 0.95;
        }

        .card-white .card-label {
            color: #e15f56;
            font-weight: 700;
        }

        .card-value {
            font-size: 22px;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 8px;
        }

        .card-desc {
            font-size: 15px;
            line-height: 1.55;
            color: inherit;
            opacity: 0.95;
        }

        .card-white .card-value {
            color: #1d2a39;
        }

        .card-white .card-desc {
            color: #67707a;
        }

        /* FOOTER */
        footer {
            background: #a91414;
            color: #fff;
            padding: 20px 0 18px;
            text-align: center;
            margin-top: 8px;
        }

        footer .footer-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        footer .footer-sub {
            font-size: 15px;
            margin-bottom: 10px;
        }

        footer .footer-copy {
            font-size: 14px;
            opacity: 0.95;
        }

        @media (max-width: 992px) {
            .hero-content {
                grid-template-columns: 1fr;
            }

            .hero-left h2 {
                font-size: 36px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                height: auto;
                padding: 14px 0;
            }

            .navbar-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .menu {
                gap: 16px;
                flex-wrap: wrap;
            }

            .hero-left h2 {
                font-size: 30px;
            }

            .hero-left p {
                font-size: 15px;
            }

            #heroMap {
                height: 260px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container navbar-inner">
            <div class="brand">
                <div class="brand-icon">U</div>
                <div class="brand-text">
                    <h1>Sistem Informasi Pemetaan UMKM</h1>
                    <p>Kecamatan Sutojayan</p>
                </div>
            </div>

            <div class="menu">
                <a href="{{ url('/') }}" class="active">Beranda</a>
                <a href="{{ url('/login') }}">Login</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <div class="hero-badge">WebGIS UMKM Kecamatan Sutojayan</div>

                    <h2>Sistem Informasi<br>Pemetaan UMKM<br>Kecamatan Sutojayan</h2>

                    <p>
                        Platform berbasis WebGIS untuk mendukung pemetaan, pendataan, dan
                        analisis potensi UMKM di Kecamatan Sutojayan secara interaktif,
                        informatif, dan terintegrasi.
                    </p>
                </div>

                <div class="hero-right">
                    <div class="hero-map-card">
                        <div class="hero-map-title">Ilustrasi Peta Kecamatan Sutojayan</div>
                        <div id="heroMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-buttons">
                <a href="{{ url('/peta-umkm') }}" class="btn-red">Lihat Peta UMKM</a>
                <a href="{{ url('/dashboard-potensi') }}" class="btn-red">Dashboard Potensi</a>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <h3>Statistik Ringkas UMKM</h3>
            <p class="subtitle">Gambaran awal kondisi UMKM di Kecamatan Sutojayan</p>

            <div class="cards">
    <div class="card card-red">
        <div class="card-label">Jumlah UMKM</div>
        <div class="card-value">{{ $totalUmkm }}</div>
        <div class="card-desc">Total keseluruhan UMKM terdata di Kecamatan Sutojayan</div>
    </div>

    <div class="card card-white">
        <div class="card-label">Sektor Usaha Terbanyak</div>
        <div class="card-value">{{ $sektorDominan }}</div>
        <div class="card-desc">
            Sektor dominan yang paling banyak dijalankan pelaku UMKM
            ({{ $jumlahSektorDominan }} UMKM)
        </div>
    </div>

    <div class="card card-white">
        <div class="card-label">Total Potensi Ekonomi</div>
        <div class="card-value">Belum tersedia</div>
        <div class="card-desc">Estimasi kontribusi ekonomi UMKM terhadap wilayah</div>
    </div>
</div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-title">Sistem Informasi Pemetaan UMKM Kecamatan Sutojayan</div>
            <div class="footer-sub">Instansi Pengembang / Penelitian WebGIS UMKM</div>
            <div class="footer-copy">© 2026 - Semua Hak Dilindungi</div>
        </div>
    </footer>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('heroMap').setView([-8.1690904, 112.211385], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Garis batas Kecamatan Sutojayan
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

        // Titik tengah (kurang lebih tengah kecamatan)
        const centerPoint = [-8.172, 112.225];

        // Marker transparan hanya untuk label
        L.marker(centerPoint, {
        opacity: 0
        })
        .addTo(map)
        .bindTooltip("Kecamatan Sutojayan", {
            permanent: true,
            direction: "center",
            className: "label-kecamatan"
        });

        map.fitBounds(polygon.getBounds(), { padding: [20, 20] });

        setTimeout(() => {
            map.invalidaeSize();
        }, 300);
    });
</script>

<style>
    #heroMap {
    width: 100%;
    height: 360px;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.45);
}

.leaflet-popup-content {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
}
    #heroMap .leaflet-control-zoom a {
        width: 34px;
        height: 34px;
        line-height: 34px;
        font-size: 20px;
    }

    #heroMap .leaflet-popup-content-wrapper {
        border-radius: 12px;
    }

    #heroMap .leaflet-container {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

</body>
</html>
