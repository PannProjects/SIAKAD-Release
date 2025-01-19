<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'siswa') {
    echo "<script>
            alert('Anda harus login sebagai siswa!');
            window.location='login.php';
          </script>";
    exit;
}

$id_user = $_SESSION['id'];

$user_query = "SELECT * FROM user WHERE id = $id_user";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();

$nilai_query = "
    SELECT 
        mapel.nama_mapel, 
        mapel.nama_guru,
        nilai.tugas, 
        nilai.uh, 
        nilai.pts, 
        nilai.uas, 
        nilai.nilai_akhir
    FROM nilai 
    JOIN mapel ON nilai.id_mapel = mapel.id_mapel
    WHERE nilai.id_siswa = $id_user
    ORDER BY mapel.nama_mapel";

$nilai_result = $conn->query($nilai_query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="css/dashboard_siswa.css">
</head>

<body>
    <header>
        <h1>Dashboard Siswa</h1>
        <nav>
            <ul>
                <li><a href="index.php">Keluar</a></li>
            </ul>
        </nav>
    </header>

    <div class="user-info">
        <h2>Informasi Siswa</h2>
        <p>Nama: <?= htmlspecialchars($user['nama']) ?></p>
        <p>Absen: <?= htmlspecialchars($user['absen']) ?></p>
    </div>

    <main>
        <h1>Daftar Nilai</h1>
        <div class="data">
            <?php if ($nilai_result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Tugas</th>
                        <th>UH</th>
                        <th>PTS</th>
                        <th>UAS</th>
                        <th>Nilai Akhir</th>
                    </tr>
                    <?php while ($row = $nilai_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama_mapel']); ?></td>
                            <td><?= htmlspecialchars($row['nama_guru']); ?></td>
                            <td><?= htmlspecialchars($row['tugas']); ?></td>
                            <td><?= htmlspecialchars($row['uh']); ?></td>
                            <td><?= htmlspecialchars($row['pts']); ?></td>
                            <td><?= htmlspecialchars($row['uas']); ?></td>
                            <td><?= htmlspecialchars($row['nilai_akhir']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>