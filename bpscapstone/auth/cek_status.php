<?php
session_start();
include '../model/db.php';

if (isset($_SESSION['admin_id_user'])) {
    $id_user = (int)$_SESSION['admin_id_user'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if ($user['status'] == 'sudah_login') {
            $_SESSION['admin_username'] = htmlspecialchars($user['username']);
            $_SESSION['admin_role'] = htmlspecialchars($user['role']);
            $_SESSION['admin_id_user'] = $user['id_user'];
            $_SESSION['role'] = $user['role'];
            echo "sudah_login";
        } else {
            echo htmlspecialchars($user['status']);
        }
    } else {
        echo "User tidak ditemukan";
    }
} else {
    echo "belum_login";
}

$conn->close();
?>
