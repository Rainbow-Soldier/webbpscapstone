<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPS Samarinda</title>
    <link rel="stylesheet" href="./style/indexstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" href="./img/logosolobps.png" type="image/png">

</head>

<body>

    <div class="navbar-wrapper">
        <nav class="navbar">
            <img src="./img/logobps.svg" alt="Logo BPS">
            <div class="nav-links">
            <a href="Beranda">Beranda</a>
            <a href="Profile">Profile</a>
            <a href="Layanan">Layanan</a>
            <a href="Berita">Berita</a>
            </div>
        </nav>
    </div>

    <div class="tambahanbanner"></div>

    <div class="banner-container">
        <img src="./img/bannerbps.svg" alt="Banner BPS" class="banner-bps">
        <div class="banner-text">
            <h2>Badan Pusat Statistik</h2>
            <p>Penyedia Data Penjualan Listrik Wilayah</p>
            <p>Kalimantan Timur Dan</p>
            <p>Samarinda Area Utara PLN</p>
        </div>
    </div>

    <div class="layanan-section">
        <div class="section-header">
            <h2>Layanan Statistik</h2>
            <a href="layanan.html" class="see-more">Lihat lebih banyak</a>
        </div>
        <hr class="separator">
        <div class="layanan-chart-container">
            <h3>Penjualan Listrik per Bulan</h3>
            <canvas id="myChart" style="max-height: 400px;"></canvas>
        </div>
    </div>



<?php
// Include file koneksi dan model
include './model/prosesberitaresmi.php';

$model = new BeritaResmiModel($conn);
$beritaList = $model->getRecentBerita(6); // Ambil 6 berita terbaru
?>

<div class="berita-section">
    <div class="section-header">
        <h2>Berita Terbaru</h2>
        <a href="berita.php" class="see-more">Lihat lebih banyak</a>
    </div>
    <hr class="separator">

    <!-- Slider -->
    <div class="slider-container">
        <div class="slider-track">
            <?php foreach ($beritaList as $berita): ?>
                <a href="detailberita.php?id=<?= (int)$berita['id_beritaresmi'] ?>" class="card" style="text-decoration: none; color: inherit;">
                    <div class="card-image">
                        <img src="./uploads/news/<?= htmlspecialchars($berita['file_gambar']) ?>" alt="Berita">
                    </div>
                    <div class="card-text">
                        <h3><?= htmlspecialchars($berita['judul']) ?></h3>
                        <div class="tanggal-wrapper">
                            <p class="tanggal"><?= date('d M Y', strtotime($berita['tgl_terbit'])) ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>






    <div class="banner-container">
        <img src="./img/bannerfooter.svg" alt="Banner BPS" class="banner-bps">
        
    </div>


    <div class="profile-section">
        <div class="section-header">
            <h2>Informasi Umum BPS</h2>
            <a href="profile.html" class="see-more">Lihat lebih banyak</a>
        </div>
        <hr class="separator">
        <div class="profile-text-container">
            <p>Badan Pusat Statistik adalah Lembaga Pemerintah Non Kementerian yang bertanggung jawab langsung kepada
                Presiden. Sebelumnya, BPS merupakan Biro Pusat Statistik, yang dibentuk berdasarkan UU Nomor 6 Tahun
                1960 tentang Sensus dan UU Nomer 7 Tahun 1960 tentang Statistik. Sebagai pengganti kedua UU tersebut
                ditetapkan UU Nomor 16 Tahun 1997 tentang Statistik. Berdasarkan UU ini yang ditindaklanjuti dengan
                peraturan perundangan dibawahnya, secara formal nama Biro Pusat Statistik diganti menjadi Badan Pusat
                Statistik.</p>

            <p>Materi yang merupakan muatan baru dalam UU Nomor 16 Tahun 1997, antara lain :</p>

            <ul>
                <li>Jenis statistik berdasarkan tujuan pemanfaatannya terdiri atas statistik dasar yang sepenuhnya
                    diselenggarakan oleh BPS, statistik sektoral yang dilaksanakan oleh instansi Pemerintah secara
                    mandiri atau bersama dengan BPS, serta statistik khusus yang diselenggarakan oleh lembaga,
                    organisasi, perorangan, dan atau unsur masyarakat lainnya secara mandiri atau bersama dengan BPS.
                </li>
                <li>Hasil statistik yang diselenggarakan oleh BPS diumumkan dalam Berita Resmi Statistik (BRS) secara
                    teratur dan transparan agar masyarakat dengan mudah mengetahui dan atau mendapatkan data yang
                    diperlukan.</li>
                <li>Sistem Statistik Nasional yang andal, efektif, dan efisien.</li>
                <li>Dibentuknya Forum Masyarakat Statistik sebagai wadah untuk menampung aspirasi masyarakat statistik,
                    yang bertugas memberikan saran dan pertimbangan kepada BPS.</li>
            </ul>

            <p>Berdasarkan undang-undang yang telah disebutkan di atas, peranan yang harus dijalankan oleh BPS adalah
                sebagai berikut :</p>

            <ul>
                <li>Menyediakan kebutuhan data bagi pemerintah dan masyarakat. Data ini didapatkan dari sensus atau
                    survey yang dilakukan sendiri dan juga dari departemen atau lembaga pemerintahan lainnya sebagai
                    data sekunder.</li>
                <li>Membantu kegiatan statistik di kementrian, lembaga pemerintah atau institusi lainnya, dalam
                    membangun sistem perstatistikan nasional.</li>
                <li>Mengembangkan dan mempromosikan standar teknik dan metodologi statistik, dan menyediakan pelayanan
                    pada bidang pendidikan dan pelatihan statistik.</li>
                <li>Membangun kerjasama dengan institusi internasional dan negara lain untuk kepentingan perkembangan
                    statistik Indonesia.</li>
            </ul>
        </div>
    </div>


<div class="dokumentasi-section">
    <div class="section-header">
        <h2>Dokumentasi Statistik</h2>
        <a href="dokumentasi.html" class="see-more">Lihat lebih banyak</a>
    </div>
    <hr class="separator">

    <div class="dokumentasi-cards-container">
        <div class="card-dokumentasi">
            <div class="card-dokumentasi-container">
                <div class="card-dokumentasi-image">
                    <img src="./img/dokumentasi1.jpg" alt="Dokumentasi 1">
                </div>
                <div class="card-dokumentasi-text">
                    <p>Mas Zeksal nanya data BPS (bertanya dengan nada sopan)</p>
                </div>
            </div>
        </div>
        <div class="card-dokumentasi">
            <div class="card-dokumentasi-container">
                <div class="card-dokumentasi-image">
                    <img src="./img/dokumentasi2.jpg" alt="Dokumentasi 2">
                </div>
                <div class="card-dokumentasi-text">
                    <p>Alpin berbincang-bincang dengan mba mba Pegawai BPS</p>
                </div>
            </div>
        </div>
        <div class="card-dokumentasi">
            <div class="card-dokumentasi-container">
                <div class="card-dokumentasi-image">
                    <img src="./img/dokumentasi3.jpg" alt="Dokumentasi 3">
                </div>
                <div class="card-dokumentasi-text">
                    <p>Kunjungan ke BPS Samarinda bersama teman teman ganteng🌈</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="video-section">
        <div class="section-header">
            <h2>Video Badan Pusat Statistik</h2>
        </div>
        <hr class="separator">
        <div class="video-container">
            <div class="responsive-video">
                <iframe src="https://www.youtube.com/embed/fL8ZjaTncoA?si=5iogzmVtIq0pfX_A" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>

    <div class="footer-container">
        <footer class="footer">
            <div class="footer-content">
                <!-- Kiri: Logo & Alamat -->
                <div class="footer-left">
                    <img src="./img/logobps.svg" alt="Logo BPS" class="footer-logo">
                    <p>Badan Pusat Statistik Kota Samarinda (Statistics Samarinda)<br>
                        Jl. KH Ahmad Dahlan No. 33 Samarinda 75117<br>
                        Telp. 0541-743661 Fax 0541-735762<br>
                        E-mail: bps6472@bps.go.id</p>
                </div>

                <!-- Kanan: Tentang Kelompok -->
                <div class="footer-right">
                    <h4>Anggota Kelompok Kami</h4>
                    <ul>
                        <li>Ikmul😎🫰</li>
                        <li>Luntang🥵</li>
                        <li>Wawan😓🥀💔</li>
                        <li>Zaksal🥰</li>
                        <li>ASSnan💩</li>
                        <li>Pipin🤓☝️</li>
                    </ul>
                </div>
            </div>

            <!-- Garis Pemisah -->
            <hr class="footer-divider">

            <!-- Teks Hak Cipta -->
            <div class="footer-bottom">
                <p>Hak Cipta © 2023 Badan Pusat Statistik</p>
            </div>
        </footer>
    </div>



    <script src="indexscript.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>

</html>
