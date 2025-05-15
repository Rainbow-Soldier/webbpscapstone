<?php
session_start();
include '../model/db.php';

// Kalau admin yang logout
if (isset($_SESSION['admin_id_user'])) {
    $id_user = $_SESSION['admin_id_user'];
    $conn->query("UPDATE user SET status='belum_login' WHERE id_user=$id_user");
}

// Hancurkan semua session
session_destroy();
header("Location: login.php");
exit;
?>
