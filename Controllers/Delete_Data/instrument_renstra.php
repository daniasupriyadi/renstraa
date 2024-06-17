<?php
include('../../config.php'); // commit

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if(isset($_GET['tujuan_id'])){
        $tujuan_id = $_GET['tujuan_id'];
        $delete_tujuan = "DELETE FROM tujuan WHERE tujuan_id = '$tujuan_id'";

        if ($connection->query($delete_tujuan) === TRUE){
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal Dihapus";
        }

    }elseif(isset($_GET['sasaran_kegiatan_id'])){
        $sasaran_kegiatan_id = $_GET['sasaran_kegiatan_id'];
        $delete_sasaran_kegiatan = "DELETE FROM sasaran_kegiatan WHERE sasaran_kegiatan_id = '$sasaran_kegiatan_id'";

        if ($connection->query($delete_sasaran_kegiatan) === TRUE){
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal Dihapus";
        }

    }elseif (isset($_GET['indikator_kinerja_kegiatan_id'])) {
        $indikator_kinerja_kegiatan_id = $_GET['indikator_kinerja_kegiatan_id'];
        $delete_query_ikk = "DELETE FROM indikator_kinerja_kegiatan WHERE indikator_kinerja_kegiatan_id = '$indikator_kinerja_kegiatan_id'";

        if ($connection->query($delete_query_ikk) === TRUE){
            header("location: ../../Views/instrument_renstra.php");
        } else {
            echo "Data Gagal Dihapus";
        }
        
    } elseif (isset($_GET['indikator_kinerja_sub_kegiatan_id'])) {

        $indikator_kinerja_sub_kegiatan_id = $_GET['indikator_kinerja_sub_kegiatan_id'];
        $delete_query_iksk = "DELETE FROM indikator_kinerja_sub_kegiatan WHERE indikator_kinerja_sub_kegiatan_id = '$indikator_kinerja_sub_kegiatan_id'";

        if ($connection->query($delete_query_iksk) === TRUE) {
            header("location: ../../Views/instrument_renstra.php");
        } else {
            echo "Data Gagal Dihapus";
        }
    } elseif (isset($_GET['indikator_kinerja_unit_kerja_id'])) {

        $indikator_kinerja_unit_kerja_id = $_GET['indikator_kinerja_unit_kerja_id'];
        $delete_query_ikuk = "DELETE FROM indikator_kinerja_unit_kerja WHERE indikator_kinerja_unit_kerja_id = '$indikator_kinerja_unit_kerja_id'";

        if ($connection->query($delete_query_ikuk) === TRUE) {
            header("location: ../../Views/instrument_renstra.php");
        } else {
            echo "Data Gagal Dihapus";
        }
    }
}
