<?php
include 'koneksi.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $absen = $_POST['absen'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO user (nama, absen, password, role) VALUES ('$nama', '$absen', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {

        header("Location: index.php");
        exit();
    } else {
        $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="login form">
            <header>Register</header>
            <form method="post">
                <input type="text" placeholder="Nama" name="nama">
                <input type="number" placeholder="Absen (Siswa Saja)" name="absen">
                <input type="password" placeholder="Password" name="password">

                <select name="role" id="role">
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
                <button type="submit">Register</button>
            </form>
            <div class="signup">
                <span class="signup">Sudah punya akun?
                    <a href="index.php">Login</a>
                </span>
            </div>
        </div>
    </div>
</body>

</html>