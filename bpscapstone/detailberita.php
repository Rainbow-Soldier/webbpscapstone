<?php
// Menghubungkan ke database dan memproses data berita
include './model/prosesberitaresmi.php'; // Memastikan file ini dimuat untuk mengambil data berita

// Menangkap ID dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$model = new BeritaResmiModel($conn);
$berita = $model->getBeritaById($id);

// Jika berita tidak ditemukan, redirect ke halaman berita
if (!$berita) {
    header("Location: berita.php");
    exit;
}

// ✅ Ambil 5 berita random selain yang sedang dibuka
$saranBerita = $model->getRandomBerita($id, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="/bpscapstone/style/detailberitastyle.css">
    <link rel="icon" href="/bps/img/logosolobps.png" type="image/png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' data:; script-src 'self'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">

    <title><?= htmlspecialchars($berita['judul']) ?> - Detail Berita</title>
</head>
<body>

<div class="navbar-wrapper">
    <nav class="navbar">
        <img src="/bpscapstone/img/logobps.svg" alt="Logo BPS">
        <div class="nav-links">
                <a href="/bpscapstone/Beranda">Beranda</a>
                <a href="/bpscapstone/Profile">Profile</a>
                <a href="/bpscapstone/Layanan">Layanan</a>
                <a href="/bpscapstone/Berita">Berita</a>
        </div>
    </nav>
</div>

<div class="berita-wrapper">

    <!-- ✅ Berita Resmi Kiri -->
    <div class="detail-berita-section">
    <div class="section-header">
        <h2><?= htmlspecialchars($berita['judul']) ?></h2>
    </div>
    <hr class="separator">

    <div class="detail-berita-container">
        <!-- Bungkus gambar + teks -->
        <div class="konten-berita">
            <!-- Gambar -->
            <div class="image-container">
                <img src="/bpscapstone/uploads/news/<?= htmlspecialchars($berita['file_gambar']) ?>" alt="Gambar Berita">
            </div>

            <!-- Teks -->
            <div class="text-container">
                <p class="tanggal">Tanggal Terbit: <?= date('d M Y', strtotime($berita['tgl_terbit'])) ?></p>
                <p class="deskripsi">Deskripsi: </p>
                <p class="isi-deskripsi"><?= nl2br(htmlspecialchars($berita['deskripsi'])) ?></p>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <a href="/bpscapstone/Berita" class="back-button">Kembali ke Berita</a>
    </div>
</div>

    <!-- ✅ Saran Berita Kanan -->
    <div class="saran-section">
        <div class="section-header">
            <h2>Berita Lainnya</h2>
        </div>
        <hr class="separator">

        <div class="saran-cards-container">
            <?php foreach ($saranBerita as $saran): ?>
                <a href="/bpscapstone/DetailBerita/<?= (int)$saran['id_beritaresmi'] ?>" class="saran-card-link">

                    <div class="saran-card">
                        <div class="saran-card-image">
                            <img src="/bpscapstone/uploads/news/<?= htmlspecialchars($saran['file_gambar']) ?>" alt="<?= htmlspecialchars($saran['judul']) ?>">
                        </div>
                        <div class="saran-card-text">
                            <p>
                                <?php 
                                $judul = htmlspecialchars($saran['judul']);
                                echo mb_strlen($judul) > 100 
                                    ? mb_substr($judul, 0, 100) . '... <a href="/bpscapstone/DetailBerita/<?=' . (int)$saran['id_beritaresmi'] . '" style="color:#007bff;">Selengkapnya</a>' 
                                    : $judul;
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div> 

    <div class="footer-container">
        <footer class="footer">
            <div class="footer-content">
                <!-- Kiri: Logo & Alamat -->
                <div class="footer-left">
                    <img src="/bpscapstone/img/logobps.svg" alt="Logo BPS" class="footer-logo">
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

<script src="/bpscapstone/js/detailberitascript.js"></script>

</body>
</html>
