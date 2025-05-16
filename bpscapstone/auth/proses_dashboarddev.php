<?php
session_start();
include '../model/db.php';

if (!isset($_SESSION['dev_role']) || $_SESSION['dev_role'] != 'developer') {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['setujui'])) {
    $id_setujui = (int)$_GET['setujui'];

    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }

    $stmt = $conn->prepare("UPDATE user SET status='sudah_login' WHERE id_user=?");
    $stmt->bind_param("i", $id_setujui);
    $stmt->execute();

    unset($_SESSION['csrf_token']);
    header("Location: dashboarddeveloper.php");
    exit();
}

$result = $conn->query("SELECT * FROM user WHERE role='admin'");

$conn->close();
?>
