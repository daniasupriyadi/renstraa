<?php
session_start();
include('../../config.php'); // new

// get data
$unit_id = $_POST['unit_id'];
$nama_unit = $_POST['nama_unit'];

//query update
$query = "UPDATE unit SET nama_unit = '$nama_unit' WHERE unit_id = '$unit_id'";

if($connection->query($query)){
    $_SESSION['message'] = 'Data Unit Berhasil DiPerbarui !!!';
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