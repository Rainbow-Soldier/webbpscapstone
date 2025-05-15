<?php
session_start();
include '../model/db.php';

// Memastikan token CSRF valid
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Token CSRF tidak valid.");
}

// Ambil username dan password dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memverifikasi kredensial pengguna
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    // Verifikasi password (plain text comparison)
    if ($password === $user['password']) { // Bandingkan password secara langsung
        session_regenerate_id(); // Mengganti ID session setiap kali login
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'];
        $_SESSION['admin_id_user'] = $user['id_user'];
        $_SESSION['role'] = $user['role'];

        // Menambahkan penanganan untuk developer
        if ($user['role'] == 'developer') {
            $_SESSION['dev_role'] = $user['role'];  // Menambahkan session untuk developer
            $_SESSION['dev_username'] = $user['username'];  // Menambahkan dev_username untuk developer
            echo "developer";
            exit();  // Keluar dari proses lebih lanjut jika developer
        }

        // Hapus token CSRF setelah login berhasil
        unset($_SESSION['csrf_token']);  // Menghapus token CSRF dari session

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
