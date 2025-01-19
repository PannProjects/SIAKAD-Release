<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/mapel.css">
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
        <h1>Daftar Mapel</h1>
        <div class="data">
            <table>
                <ul>
                    <li> <a href="tambah_mapel.php">+ Tambah Mapel</a> </li>
                </ul>
                <tr>
                    <th>Id Mapel</th>
                    <th>Mapel</th>
                    <th>Guru</th>
                    <th>Opsi</th>
                </tr>
                <?php
                include 'koneksi.php';
                $siakad = mysqli_query($conn, "SELECT * FROM mapel");
                while ($d = mysqli_fetch_array($siakad)) {
                ?>
                    <tr>
                        <td><?php echo $d['id_mapel']; ?></td>
                        <td><?php echo $d['nama_mapel']; ?></td>
                        <td><?php echo $d['nama_guru']; ?></td>
                        <td>
                            <a href="edit_mapel.php?id=<?php echo $d['id_mapel']; ?>">Edit</a>
                            <a href="hapus_mapel.php?id=<?php echo $d['id_mapel']; ?>" onclick="return confirm('Apakah yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>