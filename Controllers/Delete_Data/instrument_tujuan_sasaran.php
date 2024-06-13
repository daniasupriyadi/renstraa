<?php
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['tujuan_id'])) {
        $tujuan_id = $_GET['tujuan_id'];
        $delete_tujuan = "DELETE FROM tujuan WHERE tujuan_id = '$tujuan_id'";

        if ($connection->query($delete_tujuan) === TRUE) {
            header('location: ../../Views/instrument_tujuan_sasaran.php');
        } else {
            echo "Data Gagal Dihapus";
        }
    } elseif (isset($_GET['sasaran_kegiatan_id'])) {
        $sasaran_kegiatan_id = $_GET['sasaran_kegiatan_id'];
        $delete_sasaran_kegiatan = "DELETE FROM sasaran_kegiatan WHERE sasaran_kegiatan_id = '$sasaran_kegiatan_id'";

        if ($connection->query($delete_sasaran_kegiatan) === TRUE) {
            header('location: ../../Views/instrument_tujuan_sasaran.php');
        } else {
            echo "Data Gagal Dihapus";
        }
    }
}
