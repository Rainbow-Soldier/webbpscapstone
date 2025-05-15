<?php
session_start();
include 'prosesberitaresmi.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../controller/login.php");
    exit();
}

// Validasi CSRF Token untuk menghindari serangan CSRF
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }

    $model = new BeritaResmiModel($conn);

    // Validasi ID dari URL
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $id = (int) $_GET['id']; // Pastikan ID adalah integer yang valid
        $berita = $model->getBeritaById($id);

        if (!$berita) {
            die("Data berita tidak ditemukan.");
        }
    } else {
        die("ID berita tidak valid.");
    }

    // Ambil dan sanitasi inputan dari form
    $judul = htmlspecialchars(trim($_POST['judul']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
    $tgl_terbit = $_POST['tgl_terbit'];

    // Validasi format tanggal
    if (!strtotime($tgl_terbit)) {
        die("Format tanggal tidak valid.");
    }

    // Proses gambar
    // Validasi gambar
    $file_gambar = $berita['file_gambar']; // Gunakan gambar lama jika tidak diubah
        if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {
            $namaFile = basename($_FILES['file_gambar']['name']);
            $targetDir = '../uploads/news/';
            $targetFile = $targetDir . $namaFile;

            // Validasi ekstensi file gambar
            $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
            $fileExtension = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

            // Validasi ekstensi file
            if (!in_array($fileExtension, $validExtensions)) {
                die("Format gambar tidak valid. Hanya JPG, JPEG, PNG, GIF, SVG yang diperbolehkan.");
            }

            // Menghasilkan nama file baru yang unik
            $newFileName = uniqid('news_', true) . '.' . $fileExtension;
            $targetFile = $targetDir . $newFileName;

            // Cek apakah file berhasil diupload
            if (!move_uploaded_file($_FILES['file_gambar']['tmp_name'], $targetFile)) {
                die("Gagal mengupload gambar.");
            }

            // Jika format gambar bukan SVG, lakukan pemeriksaan dengan getimagesize
            if (!in_array($fileExtension, ['svg'])) {
                if (!getimagesize($targetFile)) {
                    die("File gambar tidak valid.");
                }
            }

            $file_gambar = $newFileName; // Update nama gambar jika berhasil
        }

    // Update data berita (judul, deskripsi, tanggal, gambar)
    $updateSuccess = $model->updateBerita($id, $judul, $deskripsi, $tgl_terbit, $file_gambar);

    if ($updateSuccess) {
        header("Location: ../admin/dashboardadmin.php");
        exit();
    } else {
        die("Gagal memperbarui data berita.");
    }
}

// Generate CSRF token untuk form
$_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Token CSRF untuk perlindungan
?>
