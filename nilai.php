<?php
include 'koneksi.php';

if (isset($_SESSION['id'])) {
    header('location index.php');
    exit();
}

$mapel_query = "SELECT * FROM mapel";
$mapel_result = $conn->query($mapel_query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/dashboard_guru.css">
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
        <div class="data">
            <?php
            while ($mapel = $mapel_result->fetch_assoc()) {
                $mapel_id = $conn->real_escape_string($mapel['id_mapel']);
                $nilai_query = "
                    SELECT 
                        nilai.id_nilai, 
                        `user`.absen, 
                        `user`.nama, 
                        mapel.nama_mapel, 
                        mapel.nama_guru,
                        nilai.tugas, 
                        nilai.uh, 
                        nilai.pts, 
                        nilai.uas, 
                        ROUND((nilai.tugas + nilai.uh + nilai.pts + nilai.uas) / 4) AS nilai_akhir
                    FROM nilai 
                    JOIN `user` ON nilai.id_siswa = `user`.id 
                    JOIN mapel ON nilai.id_mapel = mapel.id_mapel
                    WHERE nilai.id_mapel = '$mapel_id' 
                    ORDER BY `user`.absen";

                $nilai_result = $conn->query($nilai_query);

                if (!$nilai_result) {
                    echo "Query Error: " . $conn->error;
                    continue;
                }
            ?>
                <h3><?= htmlspecialchars($mapel['nama_mapel']); ?> - <?= htmlspecialchars($mapel['nama_guru']); ?></h3>
                <ul>
                    <li><a href="tambah_nilai.php?id_mapel=<?= $mapel['id_mapel']; ?>">+ Tambah Nilai</a></li>
                </ul>
                <table border="1">
                    <tr>
                        <th>No</th>
                        <th>Absen</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>UH</th>
                        <th>PTS</th>
                        <th>UAS</th>
                        <th>NA (Nilai Akhir)</th>
                        <th>Opsi</th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = $nilai_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['absen']); ?></td>
                            <td style="text-align: left;"><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['tugas']); ?></td>
                            <td><?= htmlspecialchars($row['uh']); ?></td>
                            <td><?= htmlspecialchars($row['pts']); ?></td>
                            <td><?= htmlspecialchars($row['uas']); ?></td>
                            <td><?= htmlspecialchars($row['nilai_akhir']); ?></td>
                            <td>
                                <a href="edit_nilai.php?id=<?= $row['id_nilai']; ?>">Edit</a>
                                <a href="hapus_nilai.php?id=<?= $row['id_nilai']; ?>"
                                    onclick="return confirm('Apakah yakin ingin menghapus data nilai?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
            <?php } ?>
        </div>
    </main>
</body>

</html>