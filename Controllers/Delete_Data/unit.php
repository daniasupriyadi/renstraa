<?php
include('../../config.php');

$unit_id = $_GET['unit_id'];
$query = "DELETE FROM unit WHERE unit_id = '$unit_id'";

if($connection->query($query)){
    header("location: ../../Views/daftar_unit.php");
} else {
    echo "Data Gagal Dihapus";
}
?>