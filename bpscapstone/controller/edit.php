<?php

include '../model/prosesedit.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../controller/login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = (int) $_GET['id'];
} else {
    die("ID berita tidak valid.");
}


$model = new BeritaResmiModel($conn);
$berita = $model->getBeritaById($id);

if (!$berita) {
    die("Data berita tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        h1 {
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

        img {
            display: block;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button {
            flex: 1;
            padding: 12px;
            background-color: #27ae60;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1e8449;
        }

        .back-btn {
            flex: 1;
            text-align: center;
            padding: 12px;
            background-color: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .back-btn:hover {
            background-color: #1c5d8b;
        }
    </style>
</head>
<body>
 <h1>Edit Berita</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <label for="judul">Judul:</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($berita['judul']); ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" rows="5" required><?= htmlspecialchars($berita['deskripsi']); ?></textarea><br><br>

        <label for="tgl_terbit">Tanggal Terbit:</label>
        <input type="date" name="tgl_terbit" value="<?= $berita['tgl_terbit']; ?>" required><br><br>

        <label>Gambar Saat Ini:</label><br>
        <img src="../uploads/news/<?= htmlspecialchars($berita['file_gambar']); ?>" width="150"><br><br>

        <label for="file_gambar">Ganti Gambar (opsional):</label>
        <input type="file" name="file_gambar"><br><br>

        <div class="button-group">
            <button type="submit">Update</button>
            <a href="../admin/dashboardadmin.php" class="back-btn">Kembali</a>
        </div>
    </form>

</body>
</html>
