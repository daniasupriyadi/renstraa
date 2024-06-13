<?php
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_GET['tujuan_id'])) {
        $tujuan_id = $_POST['tujuan_id'];
        $isi_tujuan = $_POST['isi_tujuan'];

        $update_tujuan = "UPDATE tujuan
                        SET 
                            isi_tujuan = '$isi_tujuan'
                        WHERE 
                            tujuan_id = '$tujuan_id'
                        ";

        if ($connection->query($update_tujuan)) {
            header('location: ../../Views/instrument_tujuan_sasaran.php');
        } else {
            echo "Data Gagal di update";
        }
    } elseif (isset($_GET['sasaran_kegiatan_id'])) {
        $sasaran_kegiatan_id = $_POST['sasaran_kegiatan_id'];
        $isi_sasaran_kegiatan = $_POST['isi_sasaran_kegiatan'];
        $unit_id_sasaran = $_POST['unit_id_sasaran'];
        $target_sasaran = $_POST['target_sasaran'];

        $update_sasaran = "UPDATE sasaran_kegiatan
                        SET 
                            sasaran_kegiatan_id = '$sasaran_kegiatan_id',
                            isi_sasaran_kegiatan = '$isi_sasaran_kegiatan',
                            unit_id = '$unit_id_sasaran',
                            target_sasaran = '$target_sasaran'
                        WHERE 
                            sasaran_kegiatan_id = '$sasaran_kegiatan_id'
                        ";

        if ($connection->query($update_sasaran)) {
            header('location: ../../Views/instrument_tujuan_sasaran.php');
        } else {
            echo "Data Gagal di update";
        }
    }
}
