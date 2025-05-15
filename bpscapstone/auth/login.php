<?php
session_start();

// Cek apakah token CSRF sudah ada di session, jika belum buat token baru
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate token CSRF
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border: 1px solid #3498db;
            outline: none;
        }
        button {
            background: #3498db;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background: #2980b9;
        }
        #pesan {
            margin-top: 15px;
            color: #e74c3c;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <!-- Menyertakan token CSRF dalam form -->
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

            <button type="submit">Login</button>
        </form>
        <p id="pesan"></p>
    </div>

    <script>
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'proses_login.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == 'sukses') {
                    window.location.href = '../admin/dashboardadmin.php';
                } else if (res == 'developer') {
                    window.location.href = '../admin/dashboarddeveloper.php';
                } else if (res == 'menunggu') {
                    $('#pesan').text('Menunggu persetujuan developer...');
                    cekStatus(); // Mulai cek status
                } else {
                    $('#pesan').text('Username atau password salah!');
                }
            }
        });
    });

    function cekStatus() {
        setInterval(function() {
            $.ajax({
                url: '../auth/cek_status.php',
                method: 'GET',
                success: function(res) {
                    if (res == 'sudah_login') {
                        window.location.href = '../admin/dashboardadmin.php';
                    }
                }
            });
        }, 3000); // Cek setiap 3 detik
    }
    </script>
</body>
</html>
