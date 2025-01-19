<?php
include 'koneksi.php';

$id_siswa = $_GET['id'];

mysqli_query($conn, "DELETE FROM user WHERE id = $id_siswa");

header("location: siswa.php");
