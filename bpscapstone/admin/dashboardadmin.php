<?php 

include '../auth/proses_dashboardadmin.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Berita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        .top-buttons {
            margin-bottom: 20px;
        }

        .button {
            padding: 8px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button.delete {
            background: #e74c3c;
        }

        .button.delete:hover {
            background: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        td:nth-child(3), th:nth-child(3) {
            width: 40%;
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
            text-align: center;
        }

        td:nth-child(2), th:nth-child(2) {
            width: 20%;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f7fa;
        }

        img {
            border-radius: 5px;
            width: 100px;
        }

        .empty {
            font-style: italic;
            color: #7f8c8d;
        }
    </style>
</head>

<body>

    <h1>📄 Dashboard Admin - Berita Resmi</h1>

    <div class="top-buttons">
        <a href="../controller/tambahberita.php" class="button">➕ Tambah Berita Baru</a>
        <a href="../auth/logout.php" class="button delete">🚪 Logout</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal Terbit</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($beritaList) > 0): ?>
            <?php $no = 1; foreach ($beritaList as $berita): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($berita['judul']) ?></td>
                <td><?= nl2br(htmlspecialchars($berita['deskripsi'])) ?></td>
                <td><?= date('d M Y', strtotime($berita['tgl_terbit'])) ?></td>
                <td>
                    <?php if (!empty($berita['file_gambar'])): ?>
                    <img src="../uploads/news/<?= htmlspecialchars($berita['file_gambar']) ?>" alt="Gambar Berita">
                    <?php else: ?>
                    <span class="empty">Tidak ada gambar</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="../controller/edit.php?id=<?= (int)$berita['id_beritaresmi'] ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>" class="button">✏️ Edit</a>

                    <form method="POST" action="../model/prosesdelete.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= (int)$berita['id_beritaresmi']; ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <button type="submit" class="button delete" onclick="return confirm('Yakin ingin hapus?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="6" class="empty">Belum ada berita resmi yang ditambahkan.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>
