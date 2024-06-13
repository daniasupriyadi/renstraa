<?php
session_start();
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isi_tujuan = $_POST["isi_tujuan"];
    $isi_sasaran_kegiatan = $_POST['isi_sasaran_kegiatan'];
    $unit_id_sasaran = $_POST['unit_id_sasaran'];
    $target_sasaran = $_POST['target_sasaran'];

    $insert_tujuan = "INSERT INTO tujuan (isi_tujuan) VALUES ('$isi_tujuan')";
    if ($connection->query($insert_tujuan) === TRUE) {
        $tujuan_id = $connection->insert_id;
    }

    foreach ($isi_sasaran_kegiatan as $key => $sasaran) {
        $unit_id = $unit_id_sasaran[$key];
        $target_sasarann = $target_sasaran[$key];
        $insert_sasaran_kegiatan = "INSERT INTO sasaran_kegiatan
                                                    (
                                                    tujuan_id, 
                                                    unit_id, 
                                                    isi_sasaran_kegiatan, 
                                                    target_sasaran
                                                    ) 
                                                    VALUES 
                                                    (
                                                    '$tujuan_id', 
                                                    '$unit_id', 
                                                    '$sasaran',
                                                    '$target_sasarann' 
                                                    )";


        if ($connection->query($insert_sasaran_kegiatan) === TRUE) {
            $_SESSION['success_message'] = "Data Instrument Renstra Berhasil Disimpan";
            header("location: ../../Views/instrument_tujuan_sasaran.php");
        }
    }
} else {
    echo "Error: " . $sql_tujuan . "<br>" . $connection->error;
}
