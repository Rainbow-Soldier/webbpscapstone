<?php
session_start();
include '../model/db.php';

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Token CSRF tidak valid.");
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    if ($password === $user['password']) {
        session_regenerate_id();
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'];
        $_SESSION['admin_id_user'] = $user['id_user'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'developer') {
            $_SESSION['dev_role'] = $user['role'];
            $_SESSION['dev_username'] = $user['username'];
            echo "developer";
            exit();
        }

        unset($_SESSION['csrf_token']);

        if ($user['status'] == 'sudah_login') {
            echo "sukses";
        } else {
            if ($user['status'] == 'belum_login') {
                $id_user = $user['id_user'];
                $conn->query("UPDATE user SET status='meminta_akses' WHERE id_user=$id_user");
            }
            echo "menunggu";
        }

    } else {
        echo "gagal";
    }

} else {
    echo "gagal";
}

$conn->close();
?>
