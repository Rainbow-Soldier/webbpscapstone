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

    if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
        $id = (int) $_POST['id'];

        $model = new BeritaResmiModel($conn);
        $deleteSuccess = $model->deleteBerita($id);

        if ($deleteSuccess) {
            header("Location: ../admin/dashboardadmin.php");
            exit();
        } else {
            echo "Gagal menghapus berita.";
        }
    } else {
        echo "ID berita tidak valid.";
    }
} else {
    echo "Metode tidak valid.";
}
?>
