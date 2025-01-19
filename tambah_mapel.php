<?php

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_mapel = $_POST['nama_mapel'];
    $nama_guru = $_POST['nama_guru'];

    $query = "INSERT INTO mapel (nama_mapel, nama_guru) VALUES ('$nama_mapel', '$nama_guru')";

    mysqli_query($conn, $query);

    echo "<script>alert('Data mapel berhasil ditambahkan!'); window.location='mapel.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/tambah_mapel.css">
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
        <h1>Tambah Mapel</h1>
        <div class="data">
            <form method="post" action="">
                <table>
                    <tr>
                        <td>Nama Mapel</td>
                        <td><input type="text" name="nama_mapel"></td>
                    </tr>
                    <tr>
                        <td>Nama Guru</td>
                        <td><input type="text" name="nama_guru"></td>
                    </tr>
                </table>
                <button type="submit" value="SIMPAN">Simpan</button>
            </form>
        </div>
    </main>

</body>

</html>