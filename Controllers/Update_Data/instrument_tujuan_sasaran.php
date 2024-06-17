<?php
session_start();
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { // new

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
            $_SESSION['message'] = 'Data Instrument Tujuan Sasaran Berhasil Diperbarui !!!';
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
            $_SESSION['message'] = 'Data Instrument Tujuan Sasaran Berhasil Diperbarui !!!';
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
