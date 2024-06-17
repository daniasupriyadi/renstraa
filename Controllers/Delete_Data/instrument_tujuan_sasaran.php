<?php
session_start();
include('../../config.php'); // commit

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['tujuan_id'])) {
        $tujuan_id = $_GET['tujuan_id'];
        $delete_tujuan = "DELETE FROM tujuan WHERE tujuan_id = '$tujuan_id'";

        if ($connection->query($delete_tujuan) === TRUE) {
            $_SESSION['message'] = 'Data Instrument Tujuan Sasaran Berhasil Dihapus !!!';
            $_SESSION['message_type'] = 'success';
            header("location: ../../Views/instrument_tujuan_sasaran.php");
            exit();
        } else {
            $_SESSION['message'] = 'Terjadi kesalahan: ' . mysqli_error($connection);
            $_SESSION['message_type'] = 'error';
            header("location: ../../Views/instrument_tujuan_sasaran.php");
            exit();
        }
    } elseif (isset($_GET['sasaran_kegiatan_id'])) {
        $sasaran_kegiatan_id = $_GET['sasaran_kegiatan_id'];
        $delete_sasaran_kegiatan = "DELETE FROM sasaran_kegiatan WHERE sasaran_kegiatan_id = '$sasaran_kegiatan_id'";

        if ($connection->query($delete_sasaran_kegiatan) === TRUE) {
            $_SESSION['message'] = 'Data Instrument Tujuan Sasaran Berhasil Dihapus !!!';
            $_SESSION['message_type'] = 'success';
            header("location: ../../Views/instrument_tujuan_sasaran.php");
            exit();
        } else {
            $_SESSION['message'] = 'Terjadi kesalahan: ' . mysqli_error($connection);
            $_SESSION['message_type'] = 'error';
            header("location: ../../Views/instrument_tujuan_sasaran.php");
            exit();
        }
    }
}
