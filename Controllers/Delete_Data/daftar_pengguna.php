<?php
session_start();
include('../../config.php'); // new

$user_id = $_GET['user_id'];
$query = "DELETE FROM user WHERE user_id = '$user_id'";

if ($connection->query($query)) {
    $_SESSION['message'] = 'Data User Berhasil Dihapus !!!';
    $_SESSION['message_type'] = 'success';
    header("Location: ../../Views/daftar_user.php");
    exit();
} else {
    $_SESSION['message'] = 'Terjadi kesalahan: ' . mysqli_error($connection);
    $_SESSION['message_type'] = 'error';
    header("Location: ../../Views/daftar_user.php");
    exit();
}
