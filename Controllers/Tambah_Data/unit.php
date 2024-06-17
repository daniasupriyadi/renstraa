<?php
session_start();
include ('../../config.php'); // new

$nama_unit = $_POST['nama_unit'];
$query = "INSERT INTO unit(nama_unit) VALUES ('$nama_unit')";

if($connection->query($query)) {
    $_SESSION['message'] = 'Data Unit Berhasil Ditambahkan !!!';
    $_SESSION['message_type'] = 'success';
    header("location: ../../Views/daftar_unit.php");
    exit();
} else {
    $_SESSION['message'] = 'Terjadi kesalahan: ' . mysqli_error($connection);
    $_SESSION['message_type'] = 'error';
    header("location: ../../Views/daftar_unit.php");
    exit();
}
?>