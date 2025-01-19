<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';

    $id_mapel = $_POST['id_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $nama_guru = $_POST['nama_guru'];

    mysqli_query($conn, "UPDATE mapel SET nama_mapel='$nama_mapel', nama_guru='$nama_guru' where id_mapel='$id_mapel'");

    echo "<script>alert('Data mapel berhasil diperbarui!'); window.location='mapel.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/edit_mapel.css">
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
        <h1>Edit Mapel</h1>
        <div class="data">
            <?php
            include 'koneksi.php';
            $id_mapel = $_GET['id'];
            $siakad = mysqli_query($conn, "SELECT * FROM mapel WHERE id_mapel='$id_mapel'");
            while ($d = mysqli_fetch_array($siakad)) {
            ?>
                <form method="post" action="edit_mapel.php">
                    <table>
                        <tr>
                            <td>Nama Mapel</td>
                            <td>
                                <input type="hidden" name="id_mapel" value="<?php echo $d['id_mapel']; ?>">
                                <input type="text" name="nama_mapel" value="<?php echo $d['nama_mapel']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Guru</td>
                            <td>
                                <input type="text" name="nama_guru" value="<?php echo $d['nama_guru']; ?>">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" name="id_mapel" value="<?php echo $d['id_mapel']; ?>">Simpan Perubahan</button>
                </form>
            <?php
            }
            ?>
        </div>
    </main>

</body>

</html>