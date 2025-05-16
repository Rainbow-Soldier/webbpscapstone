<?php
session_start();
include 'prosesberitaresmi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../controller/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }

    $model = new BeritaResmiModel($conn);

    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $id = (int) $_GET['id'];
        $berita = $model->getBeritaById($id);

        if (!$berita) {
            die("Data berita tidak ditemukan.");
        }
    } else {
        die("ID berita tidak valid.");
    }

    $judul = htmlspecialchars(trim($_POST['judul']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
    $tgl_terbit = $_POST['tgl_terbit'];

    if (!strtotime($tgl_terbit)) {
        die("Format tanggal tidak valid.");
    }

    $file_gambar = $berita['file_gambar'];
    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {
        $namaFile = basename($_FILES['file_gambar']['name']);
        $targetDir = '../uploads/news/';
        $targetFile = $targetDir . $namaFile;

        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        $fileExtension = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $validExtensions)) {
            die("Format gambar tidak valid. Hanya JPG, JPEG, PNG, GIF, SVG yang diperbolehkan.");
        }

        $newFileName = uniqid('news_', true) . '.' . $fileExtension;
        $targetFile = $targetDir . $newFileName;

        if (!move_uploaded_file($_FILES['file_gambar']['tmp_name'], $targetFile)) {
            die("Gagal mengupload gambar.");
        }

        if (!in_array($fileExtension, ['svg'])) {
            if (!getimagesize($targetFile)) {
                die("File gambar tidak valid.");
            }
        }

        $file_gambar = $newFileName;
    }

    $updateSuccess = $model->updateBerita($id, $judul, $deskripsi, $tgl_terbit, $file_gambar);

    if ($updateSuccess) {
        header("Location: ../admin/dashboardadmin.php");
        exit();
    } else {
        die("Gagal memperbarui data berita.");
    }
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
