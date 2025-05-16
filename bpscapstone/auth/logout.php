<?php
session_start();
include '../model/db.php';

if (isset($_SESSION['admin_id_user'])) {
    $id_user = $_SESSION['admin_id_user'];
    $conn->query("UPDATE user SET status='belum_login' WHERE id_user=$id_user");
}

session_destroy();
header("Location: login.php");
exit;
?>
