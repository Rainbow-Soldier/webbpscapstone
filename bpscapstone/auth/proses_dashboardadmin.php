<?php
session_start();
include '../model/db.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['admin_username'])) {
    header('Location: ../auth/login.php');
    exit;
}

$username = $_SESSION['admin_username'];
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $user['role'] != 'admin' || $user['status'] != 'sudah_login') {
    header('Location: ../auth/login.php');
    exit;
}

include '../model/prosesberitaresmi.php';
$model = new BeritaResmiModel($conn);
$beritaList = $model->getAllBerita();

$conn->close();
?>
