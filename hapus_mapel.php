<?php
include 'koneksi.php';

$id_mapel = $_GET['id'];

mysqli_query($conn,"DELETE FROM mapel WHERE id_mapel = $id_mapel");

header("location: mapel.php");

?>
