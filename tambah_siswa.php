<?php

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $absen = $_POST['absen'];
    $nama_siswa = $_POST['nama_siswa'];

    // Specify the exact columns you're inserting into
    $query = "INSERT INTO siswa (absen, nama_siswa) VALUES ('$absen', '$nama_siswa')";

    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/tambah_siswa.css">
</head>

<body>
    <header>
        <h1>Dashboard Guru</h1>
        <nav>
            <ul>
                <li><a href="mapel.php">Mapel</a></li>
                <li><a href="nilai.php">Nilai</a></li>
                <li><a href="siswa.php">Siswa</a></li>
                <li><a href="index.php">Keluar</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Tambah Siswa</h1>
        <div class="data">
            <form method="post" action="tambah_siswa.php">
                <table>
                    <tr>
                        <td>Absen</td>
                        <td><input type="number" name="absen"></td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td><input type="text" name="nama_siswa"></td>
                    </tr>
                </table>
                <button type="submit" value="SIMPAN">Simpan</button>
            </form>
        </div>
    </main>

</body>

</html>