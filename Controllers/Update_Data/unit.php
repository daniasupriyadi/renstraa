<?php
include('../../config.php');

// get data
$unit_id = $_POST['unit_id'];
$nama_unit = $_POST['nama_unit'];

//query update
$query = "UPDATE unit SET nama_unit = '$nama_unit' WHERE unit_id = '$unit_id'";

if($connection->query($query)){
    header("location: ../../Views/daftar_unit.php");
} else {
    echo "Data Gagal Di Update";
}

?>