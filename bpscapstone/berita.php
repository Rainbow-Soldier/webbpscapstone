<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/beritastyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="/bpscapstone/img/logosolobps.png" type="image/png">
    <title>Berita BPS</title>
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

<?php
include './model/prosesberitaresmi.php';

$model = new BeritaResmiModel($conn);
$beritaList = $model->getAllBerita();
?>

<div class="beritaresmi-section">
    <div class="section-header">
        <h2>Berita Resmi</h2>
    </div>
    <hr class="separator">

    <div class="beritaresmi-content">

        <div class="sidebar-search">
            <input type="text" id="searchInput" placeholder="Cari Berita..." />
            <button type="button" id="searchButton">Cari</button>
        </div>

        <div class="beritaresmi-cards-container">
            <?php if (empty($beritaList)): ?>
                <p style="font-size:16px; color:#555;">Berita Resmi yang anda cari tidak ada, silahkan masukkan kata kunci lain.</p>
            <?php else: ?>
                <?php foreach ($beritaList as $berita): ?>
    <a href="Berita/<?= (int)$berita['id_beritaresmi'] ?>" class="card-link" style="text-decoration: none; color: inherit;">

        <div class="card">
            <div class="card-image">
                <img src="./uploads/news/<?= htmlspecialchars($berita['file_gambar']) ?>" alt="Berita">
            </div>
            <div class="card-text">
                <h3><?= htmlspecialchars($berita['judul']) ?></h3>
                <p class="card-description">
                    <?= strlen($berita['deskripsi']) > 150 
                    ? substr(htmlspecialchars($berita['deskripsi']), 0, 150) . '... <a href="Berita/' . (int)$berita['id_beritaresmi'] . '">Selengkapnya</a>' 
                    : htmlspecialchars($berita['deskripsi']) ?>

                </p>
                <div class="tanggal-wrapper">
                    <p class="tanggal"><?= date('d M Y', strtotime($berita['tgl_terbit'])) ?></p>
                </div>
            </div>
        </div>
    </a>
<?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<div class="footer-container">
        <footer class="footer">
            <div class="footer-content">

                <div class="footer-left">
                    <img src="./img/logobps.svg" alt="Logo BPS" class="footer-logo">
                    <p>Badan Pusat Statistik Kota Samarinda (Statistics Samarinda)<br>
                        Jl. KH Ahmad Dahlan No. 33 Samarinda 75117<br>
                        Telp. 0541-743661 Fax 0541-735762<br>
                        E-mail: bps6472@bps.go.id</p>
                </div>

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


<script src="./js/beritascript.js"></script>
</body>
</html>