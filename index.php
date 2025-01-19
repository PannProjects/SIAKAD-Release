<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nama']) && isset($_POST['password'])) {
        $nama = $conn->real_escape_string($_POST['nama']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE nama = '$nama'";
        $query = $conn->query($sql);

        if ($query) {
            $user = $query->fetch_assoc();

            if ($user) {
                if ($password === $user['password']) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['absen'] = $user['absen'];

                    // Redirect berdasarkan role
                    if ($user['role'] == 'guru') {
                        header('Location: nilai.php');
                        exit();
                    } elseif ($user['role'] == 'siswa') {
                        header('Location: dashboard_siswa.php');
                        exit();
                    }
                } else {
                    // Password salah
                    $error = "Password salah!";
                }
            } else {
                // User tidak ditemukan
                $error = "User tidak ditemukan!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Login</header>
            <form method="post">
                <input type="text" placeholder="Nama" name="nama">
                <input type="password" placeholder="Password" name="password">
                <input type="submit" class="button" value="Login">
            </form>
            <div class="signup">
                <span class="signup">Belum punya akun?
                    <a href="register.php">Daftar</a>
                </span>
            </div>
        </div>
    </div>
</body>

</html>