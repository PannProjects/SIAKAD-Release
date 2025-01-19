<?php
include 'koneksi.php';

$id_nilai = $_GET['id'];

mysqli_query($conn,"DELETE FROM nilai WHERE id_nilai = $id_nilai");

header("location: nilai.php");

?>
