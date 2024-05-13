<?php
session_start();
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isi_tujuan = $_POST["isi_tujuan"];
    $isi_sasaran_kegiatan = $_POST['isi_sasaran_kegiatan'];
    $unit_id_sasaran = $_POST['unit_id_sasaran'];
    $target_sasaran = $_POST['target_sasaran'];

    $kode_ikk = $_POST['kode_ikk'];
    $isi_indikator_kinerja_kegiatan = $_POST['isi_indikator_kinerja_kegiatan'];
    $unit_id_ikk = $_POST['unit_id_ikk'];
    $target_ikk = $_POST['target_ikk'];

    $kode_iksk = $_POST['kode_iksk'];
    $isi_indikator_kinerja_sub_kegiatan = $_POST['isi_indikator_kinerja_sub_kegiatan'];
    $unit_id_iksk = $_POST['unit_id_iksk'];
    $target_iksk = $_POST['target_iksk'];

    $kode_ikuk = $_POST['kode_ikuk'];
    $isi_indikator_kinerja_unit_kerja = $_POST['isi_indikator_kinerja_unit_kerja'];
    $unit_id_ikuk = $_POST['unit_id_ikuk'];
    $target_ikuk = $_POST['target_ikuk'];

    $insert_tujuan = "INSERT INTO tujuan (isi_tujuan) VALUES ('$isi_tujuan')";
    if ($connection->query($insert_tujuan) === TRUE) {
        $tujuan_id = $connection->insert_id;
    }

    $insert_sasaran_kegiatan = "INSERT INTO sasaran_kegiatan (tujuan_id,unit_id,isi_sasaran_kegiatan,target_sasaran) VALUES ('$tujuan_id', '$unit_id_sasaran', '$isi_sasaran_kegiatan','$target_sasaran')";
    if ($connection->query($insert_sasaran_kegiatan) === TRUE) {
        $sasaran_kegiatan_id = $connection->insert_id;
    }

    $insert_indikator_kinerja_kegiatan = "INSERT INTO indikator_kinerja_kegiatan(sasaran_kegiatan_id,unit_id,kode_ikk,isi_indikator_kinerja_kegiatan,target_ikk) VALUES ('$sasaran_kegiatan_id','$unit_id_ikk','$kode_ikk','$isi_indikator_kinerja_kegiatan','$target_ikk')";
    if ($connection->query($insert_indikator_kinerja_kegiatan) === TRUE) {
        $indikator_kinerja_kegiatan_id = $connection->insert_id;
    }

    $insert_indikator_kinerja_sub_kegiatan = "INSERT INTO indikator_kinerja_sub_kegiatan(indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES ('$indikator_kinerja_kegiatan_id', '$unit_id_iksk', '$kode_iksk', '$isi_indikator_kinerja_sub_kegiatan', '$target_iksk')";
    if ($connection->query($insert_indikator_kinerja_sub_kegiatan) === TRUE) {
        $indikator_kinerja_sub_kegiatan_id = $connection->insert_id;
    }

    foreach ($isi_indikator_kinerja_unit_kerja as $key => $ikuk) {
        $unit_id = $unit_id_ikuk[$key];
        $kode_ikukk = $kode_ikuk[$key];
        $target_ikukk = $target_ikuk[$key];
        $insert_indikator_kinerja_unit_kerja = "INSERT INTO indikator_kinerja_unit_kerja(indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES ('$indikator_kinerja_sub_kegiatan_id', '$unit_id', '$kode_ikukk', '$ikuk', '$target_ikukk' )";


        if ($connection->query($insert_indikator_kinerja_unit_kerja) === TRUE) {
            $_SESSION['success_message'] = "Data Instrument Renstra Berhasil Disimpan";
            header("location: ../../Views/instrument_renstra.php");
        }
    }
} else {
    echo "Error: " . $sql_tujuan . "<br>" . $connection->error;
}
