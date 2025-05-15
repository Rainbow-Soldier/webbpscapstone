<?php
session_start();
include '../model/db.php';

// Pastikan session admin_id_user ada dan valid
if (isset($_SESSION['admin_id_user'])) {
    // Pastikan ID user adalah integer untuk mencegah SQL Injection
    $id_user = (int)$_SESSION['admin_id_user'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user); // Bind parameter sebagai integer
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Pastikan status user sesuai
        if ($user['status'] == 'sudah_login') {
            $_SESSION['admin_username'] = htmlspecialchars($user['username']); // Gunakan htmlspecialchars untuk mencegah XSS
            $_SESSION['admin_role'] = htmlspecialchars($user['role']); // Gunakan htmlspecialchars untuk mencegah XSS
            $_SESSION['admin_id_user'] = $user['id_user'];
            $_SESSION['role'] = $user['role']; // Sinkronisasi role untuk memastikan session konsisten
            echo "sudah_login"; // Pastikan echo-nya konsisten
        } else {
            echo htmlspecialchars($user['status']); // Mencegah XSS, misalnya "meminta_akses"
        }
    } else {
        // Tangani error jika user tidak ditemukan
        echo "User tidak ditemukan";
    }
} else {
    echo "belum_login";
}

// Tutup koneksi setelah penggunaan
$conn->close();
?>
