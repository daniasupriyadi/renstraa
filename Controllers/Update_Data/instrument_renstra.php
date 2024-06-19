<?php
include('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { // new

    if (isset($_GET['indikator_kinerja_kegiatan_id'])) {
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

        if ($connection->query($update_ikk)) {
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal di update";
        }
    } elseif (isset($_GET['indikator_kinerja_sub_kegiatan_id'])) {
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
        if ($connection->query($update_iksk)) {
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal di update";
        }
    } elseif (isset($_GET['indikator_kinerja_unit_kerja_id'])) {
        $ikuk_id = $_POST['ikuk_id'];
        $kode_ikuk = $_POST['kode_ikuk'];
        $isi_indikator_kinerja_unit_kerja = $_POST['isi_indikator_kinerja_unit_kerja'];
        $unit_id_ikuk = $_POST['unit_id_ikuk'];
        $target_ikuk = $_POST['target_ikuk'];
        $realisasi_ikuk = $_POST['realisasi_ikuk'];

        $update_ikuk = "UPDATE indikator_kinerja_unit_kerja
                    SET 
                        unit_id = '$unit_id_ikuk', 
                        kode_ikuk = '$kode_ikuk', 
                        isi_indikator_kinerja_unit_kerja = '$isi_indikator_kinerja_unit_kerja', 
                        target_ikuk = '$target_ikuk'
                    WHERE 
                        indikator_kinerja_unit_kerja_id = '$ikuk_id'";

        if ($connection->query($update_ikuk)) {
            $queryID = "SELECT 
                            ikuk.indikator_kinerja_unit_kerja_id as ikuk_id,
                            tikuk.transaksi_ikuk_id,
                            iksk.indikator_kinerja_sub_kegiatan_id as iksk_id,
                            tiksk.transaksi_iksk_id,
                            ikk.indikator_kinerja_kegiatan_id as ikk_id,
                            tikk.transaksi_ikk_id,
                            sk.sasaran_kegiatan_id as sasaran_id,
                            tsk.transaksi_sasaran_kegiatan_id
                        FROM 
                            indikator_kinerja_unit_kerja ikuk
                        LEFT JOIN 
                            transaksi_ikuk tikuk on tikuk.indikator_kinerja_unit_kerja_id = ikuk.indikator_kinerja_unit_kerja_id
                        INNER JOIN 
                            indikator_kinerja_sub_kegiatan iksk on iksk.indikator_kinerja_sub_kegiatan_id = ikuk.indikator_kinerja_sub_kegiatan_id
                        LEFT JOIN 
                            transaksi_iksk tiksk on tiksk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
                        INNER JOIN 
                            indikator_kinerja_kegiatan ikk on ikk.indikator_kinerja_kegiatan_id = iksk.indikator_kinerja_kegiatan_id
                        LEFT JOIN 
                            transaksi_ikk tikk on tikk.indikator_kinerja_kegiatan_id = ikk.indikator_kinerja_kegiatan_id
                        INNER JOIN 
                            sasaran_kegiatan sk on sk.sasaran_kegiatan_id = ikk.sasaran_kegiatan_id
                        LEFT JOIN 
                            transaksi_sasaran_kegiatan tsk on tsk.sasaran_kegiatan_id = sk.sasaran_kegiatan_id
                        WHERE 
                            ikuk.indikator_kinerja_unit_kerja_id = '$ikuk_id'";
            $idData = $connection->query($queryID)->fetch_assoc();

            // ID LIST
            $iksk_id = $idData["iksk_id"];
            $transaksi_iksk_id = $idData["transaksi_iksk_id"];
            $ikk_id = $idData["ikk_id"];
            $transaksi_ikk_id = $idData["transaksi_ikk_id"];
            $transaksi_sasaran_kegiatan_id = $idData['transaksi_sasaran_kegiatan_id'];
            $sasaran_id = $idData['sasaran_id'];

            $listIKUK = $connection->query("SELECT tikuk.*, ikuk.target_ikuk
                                            FROM indikator_kinerja_sub_kegiatan iksk
                                            INNER JOIN indikator_kinerja_unit_kerja ikuk on ikuk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
                                            LEFT JOIN transaksi_ikuk tikuk ON tikuk.indikator_kinerja_unit_kerja_id = ikuk.indikator_kinerja_unit_kerja_id
                                            WHERE iksk.indikator_kinerja_sub_kegiatan_id = '$idIKSK'")->fetch_assoc();
            // Realisasi IKSK
            $realisasiIksk = 0;
            while ($row = $listIKUK) {
                $realisasiIksk += $row['realisasi_ikuk'] * $row['target_ikuk'];
            }
            $realisasiIKSK = $realisasiIKSK / 600 * 100;

            if ($idData['transaksi_iksk_id']) {
                // EDIT YANG ADA
                $connection->query("UPDATE transaksi_iksk
                                    SET realisasi_iksk = $realisasiIKSK
                                    WHERE transaksi_iksk_id = $transaksi_iksk_id");
            } else {
                // CREATE KOLOM Baru
                $connection->query("INSERT INTO transaksi_iksk(indikator_kinerja_sub_kegiatan_id, realisasi_iksk) VALUES ($iksk_id, $realisasiIKSK)");
            }

            // Realisasi IKK
            // SUM OF IKSK

            // TODO: CEK INFINITE LOOPING
            $realisasiIKK = 0;
            while ($row = $connection->query(
                "SELECT tiksk.*
                FROM indikator_kinerja_kegiatan ikk
                INNER JOIN indikator_kinerja_sub_kegiatan iksk ON iksk.indikator_kinerja_kegiatan_id = ikk.indikator_kinerja_kegiatan_id
                LEFT JOIN transaksi_iksk tiksk ON tiksk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
                WHERE ikk.indikator_kinerja_kegiatan_id = $ikk_id"
            )->fetch_assoc()) {
                $realisasiIKK += $row["realisasi_iksk"];
            }

            if ($idData['transaksi_iksk_id']) {
                $connection->query(
                    "UPDATE transaksi_ikk SET realisasi_ikk = $realisasiIKK WHERE transaksi_ikk_id = $transaksi_ikk_id"
                );
            } else {
                $connection->query(
                    "INSERT INTO transaksi_ikk(indikator_kinerja_kegiatan_id, realisasi_ikk) VALUES ($ikk_id, $realisasiIKK)"
                );
            }

            // Realisasi Sasaran
            $selectQuery = "SELECT transaksi_ikk.*, ikk.target_ikk
            FROM transaksi_ikk
            INNER JOIN indikator_kinerja_kegiatan ikk ON ikk.indikator_kinerja_kegiatan_id = transaksi_ikk.indikator_kinerja_kegiatan_id
            WHERE ikk.indikator_kinerja_kegiatan_id = $indikator_kinerja_kegiatan_id";

            $result = $connection->query($selectQuery);

            $realisasiSasaran = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['realisasi_ikk'] >= $row['target_ikk']) {
                        $realisasiSasaran += 1;
                    }
                }
                $realisasiSasaran = $realisasiSasaran / $result->num_rows * 100;

                if ($transaksi_sasaran_kegiatan_id) {
                    if ($connection->query("UPDATE transaksi_sasaran_kegiatan SET realisasi_sasaran_kegiatan = $realisasiSasaran WHERE transaksi_sasaran_kegiatan_id = $transaksi_sasaran_kegiatan_id") === TRUE) {
                        header("location: ../../Views/instrument_renstra.php");
                    }
                } else {
                    if ($connection->query("INSERT INTO transaksi_sasaran_kegiatan(sasaran_kegiatan_id, realisasi_sasaran_kegiatan) VALUES ($sasaran_id, $realisasiSasaran)") === TRUE) {
                        header("location: ../../Views/instrument_renstra.php");
                    }
                }
            }


            // header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal di update";
        }
    }
}
