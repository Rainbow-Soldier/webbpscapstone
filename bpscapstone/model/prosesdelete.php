<?php
session_start();
include 'prosesberitaresmi.php';

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // Redirect ke login jika tidak memiliki akses
    header("Location: ../controller/login.php");
    exit();
}

// Validasi CSRF token untuk melindungi dari CSRF
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }

    // Validasi dan sanitasi id yang diterima melalui POST
    if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
        $id = (int) $_POST['id']; // Pastikan id adalah integer yang valid

        // Gunakan model untuk menghapus berita
        $model = new BeritaResmiModel($conn);
        $deleteSuccess = $model->deleteBerita($id);

        // Cek apakah penghapusan berhasil
        if ($deleteSuccess) {
            // Redirect ke halaman dashboard setelah berhasil
            header("Location: ../admin/dashboardadmin.php");
            exit();
        } else {
            // Tampilkan error jika penghapusan gagal
            echo "Gagal menghapus berita.";
        }
    } else {
        // Jika id tidak valid, tampilkan error
        echo "ID berita tidak valid.";
    }
} else {
    // Jika akses bukan POST, tampilkan error
    echo "Metode tidak valid.";
}
?>
