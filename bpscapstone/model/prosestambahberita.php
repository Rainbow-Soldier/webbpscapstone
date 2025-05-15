<?php
include 'db.php';

// Validasi dan sanitasi CSRF Token untuk melindungi dari serangan CSRF
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }
    
    // Sanitasi inputan untuk menghindari XSS dan SQL Injection
    $judul = htmlspecialchars(trim($_POST['judul']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
    $tgl_terbit = htmlspecialchars(trim($_POST['tgl_terbit']));

    // Validasi format tanggal
    if (!strtotime($tgl_terbit)) {
        die("Format tanggal tidak valid.");
    }

    // Validasi gambar
    if (isset($_FILES['file_gambar'])) {
        $targetDir = "../uploads/news/";
        $fileName = basename($_FILES["file_gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Tipe file yang diizinkan
        $allowTypes = array('jpg', 'png', 'jpeg', 'svg');
        
        // Validasi ekstensi file
        if (in_array(strtolower($fileType), $allowTypes)) {
            // Batasi ukuran file max 2MB
            if ($_FILES['file_gambar']['size'] > 2 * 1024 * 1024) {
                die("Ukuran file gambar terlalu besar. Maksimal 2MB.");
            }
            
            // Memindahkan file ke server
            if (move_uploaded_file($_FILES["file_gambar"]["tmp_name"], $targetFilePath)) {
                // Simpan data berita ke database
                $stmt = $conn->prepare("INSERT INTO beritaresmi (judul, deskripsi, tgl_terbit, file_gambar) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $judul, $deskripsi, $tgl_terbit, $fileName);
                
                if ($stmt->execute()) {
                    echo "<script>alert('Berita berhasil ditambahkan!'); window.location='../admin/dashboardadmin.php';</script>";
                } else {
                    echo "Error saat menyimpan data: " . $conn->error;
                }
            } else {
                die("Gagal mengupload gambar.");
            }
        } else {
            die("Tipe file gambar tidak valid. Hanya JPG, PNG, JPEG, dan SVG yang diperbolehkan.");
        }
    } else {
        die("File gambar tidak ditemukan.");
    }
} else {
    // Kalau akses langsung tanpa submit
    header("Location: ../admin/dashboardadmin.php");
}
?>
