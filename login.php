<?php 
session_start();
require 'koneksi.php';

if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if(isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Username atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 350px;">
        <h3 class="text-center mb-3">Login</h3> 
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
            <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Login</button>
            <div class="text-center">
                <small>Belum punya akun? <a href="register.php">Register</a></small>
            </div>
        </form>
    </div>
</body>
</html>