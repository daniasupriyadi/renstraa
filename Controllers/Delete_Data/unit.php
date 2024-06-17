<?php
session_start();
include('../../config.php'); // new

$unit_id = $_GET['unit_id'];
$query = "DELETE FROM unit WHERE unit_id = '$unit_id'";

if($connection->query($query)){
    $_SESSION['message'] = 'Data Unit Berhasil Dihapus !!!';
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