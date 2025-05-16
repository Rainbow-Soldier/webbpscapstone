<?php
include 'db.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }

    $judul = htmlspecialchars(trim($_POST['judul']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
    $tgl_terbit = htmlspecialchars(trim($_POST['tgl_terbit']));

    if (!strtotime($tgl_terbit)) {
        die("Format tanggal tidak valid.");
    }

    if (isset($_FILES['file_gambar'])) {
        $targetDir = "../uploads/news/";
        $fileName = basename($_FILES["file_gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'svg');

        if (in_array(strtolower($fileType), $allowTypes)) {

            if ($_FILES['file_gambar']['size'] > 2 * 1024 * 1024) {
                die("Ukuran file gambar terlalu besar. Maksimal 2MB.");
            }

            if (move_uploaded_file($_FILES["file_gambar"]["tmp_name"], $targetFilePath)) {
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
    header("Location: ../admin/dashboardadmin.php");
}
?>
