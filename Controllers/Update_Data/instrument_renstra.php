<?php
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_GET['indikator_kinerja_kegiatan_id'])){
        $ikk_id = $_POST['ikk_id'];
        $kode_ikk = $_POST['kode_ikk'];
        $isi_indikator_kinerja_kegiatan = $_POST['isi_indikator_kinerja_kegiatan'];
        $target_ikk = $_POST['target_ikk'];
        $unit_id_ikk = $_POST['unit_id_ikk'];

        $update_ikk = "UPDATE indikator_kinerja_kegiatan
                        SET 
                            kode_ikk = '$kode_ikk',
                            isi_indikator_kinerja_kegiatan = '$isi_indikator_kinerja_kegiatan',
                            target_ikk = '$target_ikk',
                            unit_id = '$unit_id_ikk'
                        WHERE 
                            indikator_kinerja_kegiatan_id = '$ikk_id'
                        ";

        if ($connection->query($update_ikk)){
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal di update";
        }

    }elseif(isset($_GET['indikator_kinerja_sub_kegiatan_id'])){
        $iksk_id = $_POST['iksk_id'];
        $kode_iksk = $_POST['kode_iksk'];
        $isi_indikator_kinerja_sub_kegiatan = $_POST['isi_indikator_kinerja_sub_kegiatan'];
        $target_iksk = $_POST['target_iksk'];
        $unit_id_iksk = $_POST['unit_id_iksk'];
        
        $update_iksk = "UPDATE indikator_kinerja_sub_kegiatan
                        SET 
                            unit_id = '$unit_id_iksk', 
                            kode_iksk = '$kode_iksk', 
                            isi_indikator_kinerja_sub_kegiatan = '$isi_indikator_kinerja_sub_kegiatan', 
                            target_iksk = '$target_iksk'
                        WHERE 
                            indikator_kinerja_sub_kegiatan_id = '$iksk_id'
                            ";
        if ($connection->query($update_iksk)){
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal di update";
        }


    }elseif (isset($_GET['indikator_kinerja_unit_kerja_id'])) {
        $ikuk_id = $_POST['ikuk_id'];
        $kode_ikuk = $_POST['kode_ikuk'];
        $isi_indikator_kinerja_unit_kerja = $_POST['isi_indikator_kinerja_unit_kerja'];
        $unit_id_ikuk = $_POST['unit_id_ikuk'];
        $target_ikuk = $_POST['target_ikuk'];

        $update_ikuk = "UPDATE indikator_kinerja_unit_kerja
                    SET 
                        unit_id = '$unit_id_ikuk', 
                        kode_ikuk = '$kode_ikuk', 
                        isi_indikator_kinerja_unit_kerja = '$isi_indikator_kinerja_unit_kerja', 
                        target_ikuk = '$target_ikuk'
                    WHERE 
                        indikator_kinerja_unit_kerja_id = '$ikuk_id'";

        if ($connection->query($update_ikuk)) {
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal di update";
        }
    }
}
