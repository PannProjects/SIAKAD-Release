<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_nilai = $_GET['id'];
    $query = "
        SELECT 
            nilai.*, user.absen, user.nama AS nama_siswa, mapel.nama_mapel 
        FROM nilai 
        JOIN user ON nilai.id_siswa = user.id
        JOIN mapel ON nilai.id_mapel = mapel.id_mapel
        WHERE nilai.id_nilai = $id_nilai";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $nilai = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data nilai tidak ditemukan!'); window.location='siswa.php';</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tugas = $_POST['tugas'];
    $uh = $_POST['uh'];
    $pts = $_POST['pts'];
    $uas = $_POST['uas'];

    $update_query = "
        UPDATE nilai SET 
            tugas = '$tugas', 
            uh = '$uh', 
            pts = '$pts', 
            uas = '$uas' 
        WHERE id_nilai = $id_nilai";

    if ($conn->query($update_query) === TRUE) {
        echo "<script>alert('Rekap nilai berhasil diperbarui!'); window.location='nilai.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui nilai: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="css/edit_nilai.css">
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
        <h1>Edit Nilai</h1>
        <div class="data">
            <form method="POST" action="">
                <table>
                    <tr>
                        <td>Absen:</td>
                        <td>
                            <input type="number" value="<?= $nilai['absen']; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama:</td>
                        <td>
                            <input type="text" value="<?= $nilai['nama_siswa']; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Mata Pelajaran:</td>
                        <td>
                            <input type="text" value="<?= $nilai['nama_mapel']; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Tugas :</td>
                        <td>
                            <input type="number" name="tugas" min="0" max="100" value="<?= $nilai['tugas']; ?>"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai UH:</td>
                        <td>
                            <input type="number" name="uh" min="0" max="100" value="<?= $nilai['uh']; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai PTS:</td>
                        <td>
                            <input type="number" name="pts" min="0" max="100" value="<?= $nilai['pts']; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai UAS:</td>
                        <td>
                            <input type="number" name="uas" min="0" max="100" value="<?= $nilai['uas']; ?>" required>
                        </td>
                    </tr>
                </table>
                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </main>

</body>

</html>