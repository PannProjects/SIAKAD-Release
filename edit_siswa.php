<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';

    $id_siswa = $_POST['id'];
    $absen = $_POST['absen'];
    $nama_siswa = $_POST['nama'];

    mysqli_query($conn, "UPDATE user SET absen='$absen', nama='$nama_siswa' where id='$id_siswa'");

    echo "<script>alert('Data siswa berhasil diperbarui!'); window.location='siswa.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/edit_siswa.css">
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
        <h1>Edit Siswa</h1>
        <div class="data">
            <?php
            include 'koneksi.php';
            $id_siswa = $_GET['id'];
            $siakad = mysqli_query($conn, "SELECT * FROM user WHERE id='$id_siswa'");
            while ($d = mysqli_fetch_array($siakad)) {
            ?>
                <form method="post" action="edit_siswa.php">
                    <table>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                <input type="number" name="absen" value="<?php echo $d['absen']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Absen</td>
                            <td>
                                <input type="text" name="nama" value="<?php echo $d['nama']; ?>">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" name="id" value="<?php echo $d['id']; ?>">Simpan Perubahan</button>
                </form>
            <?php
            }
            ?>
        </div>
    </main>

</body>

</html>