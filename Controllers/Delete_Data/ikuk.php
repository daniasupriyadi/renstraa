<?php
include('../../config.php');

$indikator_kinerja_unit_kerja_id = $_GET['indikator_kinerja_unit_kerja_id'];
$query = "DELETE FROM indikator_kinerja_unit_kerja WHERE indikator_kinerja_unit_kerja_id = '$indikator_kinerja_unit_kerja_id'";

if($connection->query($query)){
    header("location: ../../../Views/instrument_renstra.php");
} else {
    echo "Data Gagal Dihapus";
}
?>