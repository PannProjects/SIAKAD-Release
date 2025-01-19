<?php
include 'koneksi.php';

// Cek apakah ID mapel tersedia
if (isset($_GET['id_mapel'])) {
    $id_mapel = $_GET['id_mapel'];

    // Query untuk mendapatkan detail mapel
    $mapel_query = "SELECT * FROM mapel WHERE id_mapel = $id_mapel";
    $mapel_result = $conn->query($mapel_query);

    // Pastikan mapel ditemukan
    if ($mapel_result->num_rows > 0) {
        $mapel = $mapel_result->fetch_assoc();
    } else {
        echo "<script>
                alert('Mata pelajaran tidak ditemukan!'); 
                window.location='nilai.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID mata pelajaran tidak valid!'); 
            window.location='nilai.php';
          </script>";
    exit;
}

// Query untuk mendapatkan daftar siswa
$siswa_query = "SELECT * FROM user WHERE role = 'siswa'";
$siswa_result = $conn->query($siswa_query);

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_siswa = $_POST['id'];
    $tugas = $_POST['tugas'];
    $uh = $_POST['uh'];
    $pts = $_POST['pts'];
    $uas = $_POST['uas'];

    // Hitung nilai akhir
    $nilai_akhir = round(($tugas + $uh + $pts + $uas) / 4, 2);

    // Query untuk insert nilai
    $insert_query = "INSERT INTO nilai 
                     (id_siswa, id_mapel, tugas, uh, pts, uas, nilai_akhir) 
                     VALUES 
                     ($id_siswa, $id_mapel, $tugas, $uh, $pts, $uas, $nilai_akhir)";

    // Eksekusi query
    if ($conn->query($insert_query) === TRUE) {
        echo "<script>
                alert('Nilai berhasil ditambahkan!'); 
                window.location='nilai.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan nilai: " . $conn->error . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link rel="stylesheet" href="css/tambah_nilai.css">
</head>

<body>
    <h1>Tambah Nilai untuk Mata Pelajaran: <?= $mapel['nama_mapel'] ?></h1>

    <form method="POST">
        <table>
            <tr>
                <td>Pilih Siswa:</td>
                <td>
                    <select name="id" required>
                        <option value="">Pilih Siswa</option>
                        <?php while ($siswa = $siswa_result->fetch_assoc()) { ?>
                            <option value="<?= $siswa['id'] ?>">
                                <?= $siswa['absen'] . " - " . $siswa['nama'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nilai Tugas:</td>
                <td><input type="number" name="tugas" min="0" max="100" required></td>
            </tr>
            <tr>
                <td>Nilai UH:</td>
                <td><input type="number" name="uh" min="0" max="100" required></td>
            </tr>
            <tr>
                <td>Nilai PTS:</td>
                <td><input type="number" name="pts" min="0" max="100" required></td>
            </tr>
            <tr>
                <td>Nilai UAS:</td>
                <td><input type="number" name="uas" min="0" max="100" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Simpan Nilai">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>