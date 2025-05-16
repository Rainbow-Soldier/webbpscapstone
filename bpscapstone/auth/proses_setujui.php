<?php
session_start();
include '../model/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'developer') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['setujui'])) {
    $id_user = $_GET['setujui'];
    $conn->query("UPDATE user SET status='sudah_login' WHERE id_user=$id_user");

    header("Location: ../admin/dashboarddeveloper.php");
    exit();
}

$conn->close();
?>
