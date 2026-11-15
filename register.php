<?php 
    session_start();
    require 'koneksi.php';

    $error = '';
    $success = '';

    if (isset($_POST['register'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {
            // Cek apakah username sudah dipakai
            $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            if (mysqli_num_rows($cek) > 0) {
                $error = "Username sudah digunakan, silahkan pakai yang lain!";
            } else {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
                
                if (mysqli_query($conn, $query)) {
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Gagal register!";
                }
            }
        } else {
            $error = "Semua data harus diisi!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 350px;">
        <h3 class="text-center mb-3">Register</h3>
        <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="admin" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="........." required>
            </div>
            <button type="submit" name="register" class="btn btn-success w-100 mb-3">Register</button>
            <div class="text-center">
                <small>Sudah punya akun? <a href="login.php">Login</a></small>
            </div>
        </form>
    </div>
</body>
</html>