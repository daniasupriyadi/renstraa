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
    $realisasi_ikuk = $_POST['realisasi_ikuk'];

    // $insert_tujuan = "INSERT INTO tujuan (isi_tujuan) VALUES ('$isi_tujuan')";
    // if ($connection->query($insert_tujuan) === TRUE) {
    //     $tujuan_id = $connection->insert_id;
    // }

    // $insert_sasaran_kegiatan = "INSERT INTO sasaran_kegiatan (tujuan_id,unit_id,isi_sasaran_kegiatan,target_sasaran) VALUES ('$tujuan_id', '$unit_id_sasaran', '$isi_sasaran_kegiatan','$target_sasaran')";
    // if ($connection->query($insert_sasaran_kegiatan) === TRUE) {
    //     $sasaran_kegiatan_id = $connection->insert_id;
    // }

    $tujuan_id = $isi_tujuan;
    $sasaran_kegiatan_id = $isi_sasaran_kegiatan;

    $insert_indikator_kinerja_kegiatan = "INSERT INTO indikator_kinerja_kegiatan(sasaran_kegiatan_id,unit_id,kode_ikk,isi_indikator_kinerja_kegiatan,target_ikk) VALUES ('$sasaran_kegiatan_id','$unit_id_ikk','$kode_ikk','$isi_indikator_kinerja_kegiatan','$target_ikk')";
    if ($connection->query($insert_indikator_kinerja_kegiatan) === TRUE) {
        $indikator_kinerja_kegiatan_id = $connection->insert_id;
    }

    $insert_indikator_kinerja_sub_kegiatan = "INSERT INTO indikator_kinerja_sub_kegiatan(indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES ('$indikator_kinerja_kegiatan_id', '$unit_id_iksk', '$kode_iksk', '$isi_indikator_kinerja_sub_kegiatan', '$target_iksk')";
    if ($connection->query($insert_indikator_kinerja_sub_kegiatan) === TRUE) {
        $indikator_kinerja_sub_kegiatan_id = $connection->insert_id;
    }

    $realisasiIKSK = 0;

    foreach ($isi_indikator_kinerja_unit_kerja as $key => $ikuk) {
        $unit_id = $unit_id_ikuk[$key];
        $kode_ikukk = $kode_ikuk[$key];
        $target_ikukk = $target_ikuk[$key];
        $realisasi_ikukk = $realisasi_ikuk[$key];
        $insert_indikator_kinerja_unit_kerja = "INSERT INTO indikator_kinerja_unit_kerja(indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES ('$indikator_kinerja_sub_kegiatan_id', '$unit_id', '$kode_ikukk', '$ikuk', '$target_ikukk')";


        if ($connection->query($insert_indikator_kinerja_unit_kerja) === TRUE) {
            // $_SESSION['success_message'] = "Data Instrument Renstra Berhasil Disimpan";
            // header("location: ../../Views/instrument_renstra.php");
            $ikukId = $connection->insert_id;
        }

        $connection->query("INSERT INTO transaksi_ikuk(indikator_kinerja_unit_kerja_id,  realisasi_ikuk) VALUES ('$ikukId', $realisasi_ikukk)");

        $realisasiIKSK += $target_ikukk * $realisasi_ikukk;
    }

    $realisasiIKSK = $realisasiIKSK / 600 * 100;

    $connection->query("INSERT INTO transaksi_iksk(indikator_kinerja_sub_kegiatan_id, realisasi_iksk) VALUES ($indikator_kinerja_sub_kegiatan_id, $realisasiIKSK)");

    if ($connection->query("INSERT INTO transaksi_ikk(indikator_kinerja_kegiatan_id, realisasi_ikk) VALUES ($indikator_kinerja_kegiatan_id, $realisasiIKSK)") === TRUE) {
        echo "INSERT DONE";
    }

    $selectQuery = "SELECT transaksi_ikk.*, ikk.target_ikk
                    FROM transaksi_ikk
                    INNER JOIN indikator_kinerja_kegiatan ikk ON ikk.indikator_kinerja_kegiatan_id = transaksi_ikk.indikator_kinerja_kegiatan_id
                    WHERE ikk.indikator_kinerja_kegiatan_id = $indikator_kinerja_kegiatan_id";

    $result = $connection->query($selectQuery);

    $realisasiSasaran = 0;

    if ($result->num_rows > 0) {
        echo 'TATA';
        while ($row = $result->fetch_assoc()) {
            if ($row['realisasi_ikk'] >= $row['target_ikk']) {
                $realisasiSasaran += 1;
            }
        }
        $realisasiSasaran = $realisasiSasaran / $result->num_rows * 100;

        $querySasaran = "SELECT tsk.transaksi_sasaran_kegiatan_id from transaksi_sasaran_kegiatan tsk INNER JOIN sasaran_kegiatan on tsk.sasaran_kegiatan_id =  sasaran_kegiatan.sasaran_kegiatan_id";

        $res = $connection->query($querySasaran);


        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $transaksi_sasaran_kegiatan_id = $row['transaksi_sasaran_kegiatan_id'];
            echo 'TATA';

            if ($connection->query("UPDATE transaksi_sasaran_kegiatan SET realisasi_sasaran_kegiatan = $realisasiSasaran WHERE transaksi_sasaran_kegiatan_id = $transaksi_sasaran_kegiatan_id") === TRUE) {
                echo 'TATA';
                header("location: ../../Views/instrument_renstra.php");
            }
        } else {
            if ($connection->query("INSERT INTO transaksi_sasaran_kegiatan(sasaran_kegiatan_id, realisasi_sasaran_kegiatan) VALUES ($sasaran_kegiatan_id, $realisasiSasaran)") === TRUE) {
                echo 'TATA';
                header("location: ../../Views/instrument_renstra.php");
            }
        }
    }
} else {
    echo "Error: " . $sql_tujuan . "<br>" . $connection->error;
}
