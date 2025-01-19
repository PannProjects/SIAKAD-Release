<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/siswa.css">
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
        <h1>Daftar Siswa</h1>
        <div class="data">
            <table>
                <ul>
                    <li> <a href="tambah_siswa.php">+ Tambah Siswa</a> </li>
                </ul>
                <tr>
                    <th>Id Siswa</th>
                    <th>Absen</th>
                    <th>Nama Siswa</th>
                    <th>Opsi</th>
                </tr>
                <?php
                include 'koneksi.php';
                $siakad = mysqli_query($conn, "SELECT * FROM user WHERE role = 'siswa'");
                while ($d = mysqli_fetch_array($siakad)) {
                ?>
                    <tr>
                        <td><?php echo $d['id']; ?></td>
                        <td><?php echo $d['absen']; ?></td>
                        <td><?php echo $d['nama']; ?></td>
                        <td>
                            <a href="edit_siswa.php?id=<?php echo $d['id']; ?>">Edit</a>
                            <a href="hapus_siswa.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Apakah yakin ingin menghapus data siswa?')">Hapus</a>
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