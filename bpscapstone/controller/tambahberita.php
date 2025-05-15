<?php
session_start();

// Cek apakah CSRF token sudah ada, jika belum buat token baru
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate token CSRF
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Tambah Berita Resmi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button {
            flex: 1;
            padding: 12px;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .back-btn {
            flex: 1;
            text-align: center;
            padding: 12px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .back-btn:hover {
            background-color: #1a242f;
        }
    </style>

</head>
<body>

    <h2>Tambah Berita Resmi</h2>
    <form method="post" action="../model/prosestambahberita.php" enctype="multipart/form-data">
        <!-- CSRF Token untuk melindungi dari serangan CSRF -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <label>Judul Berita:</label>
        <input type="text" name="judul" required>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" rows="4" required></textarea>

        <label>Tanggal Terbit:</label>
        <input type="date" name="tgl_terbit" required>

        <label>Upload Gambar:</label>
        <input type="file" name="file_gambar" accept="image/*" required>

        <!-- Tombol sejajar -->
        <div class="button-group">
            <button type="submit" name="submit">Tambah Berita</button>
            <a href="../admin/dashboardadmin.php" class="back-btn">Kembali</a>
        </div>
    </form>

</body>
</html>
