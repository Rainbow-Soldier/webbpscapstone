<?php
session_start();
include '../model/db.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
}

if (!isset($_SESSION['dev_role']) || $_SESSION['dev_role'] != 'developer') {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['setujui'])) {
    $id_setujui = (int)$_GET['setujui'];

    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Token CSRF tidak valid.");
    }

    $stmt = $conn->prepare("UPDATE user SET status='sudah_login' WHERE id_user=?");
    $stmt->bind_param("i", $id_setujui);
    $stmt->execute();

    unset($_SESSION['csrf_token']);

    header("Location: dashboarddeveloper.php");
    exit();
}

$result = $conn->query("SELECT * FROM user WHERE role='admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Developer Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f7fa;
        }

        a {
            background-color: #28a745;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #218838;
        }

        .approved {
            color: #6c757d;
            font-weight: bold;
        }

        .container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
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
    </style>
</head>
<body>

    <h2>👋 Selamat Datang, Developer <?php echo htmlspecialchars($_SESSION['dev_username']); ?>!</h2>
    <h3>📄 Daftar Admin</h3>

    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_user']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo ucfirst(str_replace('_', ' ', htmlspecialchars($row['status']))); ?></td>
                <td>
                    <?php if ($row['status'] != 'sudah_login') { ?>
                        <a href="dashboarddeveloper.php?setujui=<?php echo (int)$row['id_user']; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" onclick="return confirm('Setujui admin ini?')">✅ Setujui</a>
                    <?php } else { ?>
                        <span class="approved">✔️ Disetujui</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>

<?php $conn->close(); ?>
