<?php
session_start();
include ('../../config.php');

$nama_unit = $_POST['nama_unit'];
$query = "INSERT INTO unit(nama_unit) VALUES ('$nama_unit')";

if($connection->query($query)) {
    $_SESSION['success_message'] = "Data Berhasil Disimpan";
    header("location: ../../Views/daftar_unit.php?success=1");
    exit();
} else {
    echo "Data gagal disimpan";
}
?>