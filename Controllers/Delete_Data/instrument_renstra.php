<?php
include('../../config.php'); // commit

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['tujuan_id'])) {
        $tujuan_id = $_GET['tujuan_id'];
        $delete_tujuan = "DELETE FROM tujuan WHERE tujuan_id = '$tujuan_id'";

        if ($connection->query($delete_tujuan) === TRUE) {
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal Dihapus";
        }
    } elseif (isset($_GET['sasaran_kegiatan_id'])) {
        $sasaran_kegiatan_id = $_GET['sasaran_kegiatan_id'];
        $delete_sasaran_kegiatan = "DELETE FROM sasaran_kegiatan WHERE sasaran_kegiatan_id = '$sasaran_kegiatan_id'";

        if ($connection->query($delete_sasaran_kegiatan) === TRUE) {
            header('location: ../../Views/instrument_renstra.php');
        } else {
            echo "Data Gagal Dihapus";
        }
    } elseif (isset($_GET['indikator_kinerja_kegiatan_id'])) {
        $indikator_kinerja_kegiatan_id = $_GET['indikator_kinerja_kegiatan_id'];
        $dataIKK = $connection->query("SELECT * FROM indikator_kinerja_kegiatan WHERE indikator_kinerja_kegiatan_id = '$indikator_kinerja_kegiatan_id'")->fetch_assoc();

        $delete_query_ikk = "DELETE FROM indikator_kinerja_kegiatan WHERE indikator_kinerja_kegiatan_id = '$indikator_kinerja_kegiatan_id'";

        if ($connection->query($delete_query_ikk) === TRUE) {
            updateAll($dataIKK['sasaran_kegiatan_id'], 'indikator_kinerja_kegiatan_id');
            header("location: ../../Views/instrument_renstra.php");
        } else {
            echo "Data Gagal Dihapus";
        }
    } elseif (isset($_GET['indikator_kinerja_sub_kegiatan_id'])) {

        $indikator_kinerja_sub_kegiatan_id = $_GET['indikator_kinerja_sub_kegiatan_id'];
        $dataIKSK = $connection->query("SELECT * FROM indikator_kinerja_sub_kegiatan WHERE indikator_kinerja_sub_kegiatan_id = '$indikator_kinerja_sub_kegiatan_id'")->fetch_assoc();

        $delete_query_iksk = "DELETE FROM indikator_kinerja_sub_kegiatan WHERE indikator_kinerja_sub_kegiatan_id = '$indikator_kinerja_sub_kegiatan_id'";

        if ($connection->query($delete_query_iksk) === TRUE) {
            updateAll($dataIKSK["indikator_kinerja_kegiatan_id"], "indikator_kinerja_sub_kegiatan_id");
            header("location: ../../Views/instrument_renstra.php");
        } else {
            echo "Data Gagal Dihapus";
        }
    } elseif (isset($_GET['indikator_kinerja_unit_kerja_id'])) {

        $indikator_kinerja_unit_kerja_id = $_GET['indikator_kinerja_unit_kerja_id'];
        $dataIKUK = $connection->query("SELECT * FROM indikator_kinerja_unit_kerja WHERE indikator_kinerja_unit_kerja_id = '$indikator_kinerja_unit_kerja_id'")->fetch_assoc();
        $delete_query_ikuk = "DELETE FROM indikator_kinerja_unit_kerja WHERE indikator_kinerja_unit_kerja_id = '$indikator_kinerja_unit_kerja_id'";

        if ($connection->query($delete_query_ikuk) === TRUE) {
            updateAll($dataIKUK["indikator_kinerja_sub_kegiatan_id"], "indikator_kinerja_unit_kerja_id");
            header("location: ../../Views/instrument_renstra.php");
        } else {
            echo "Data Gagal Dihapus";
        }
    }
}

function updateAll($id, $type)
{
    include('../../config.php'); // commit
    $queryID = '';

    if ($type === "indikator_kinerja_kegiatan_id") {
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
                    RIGHT JOIN 
                        indikator_kinerja_sub_kegiatan iksk on iksk.indikator_kinerja_sub_kegiatan_id = ikuk.indikator_kinerja_sub_kegiatan_id
                    LEFT JOIN 
                        transaksi_iksk tiksk on tiksk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
                    RIGHT JOIN 
                        indikator_kinerja_kegiatan ikk on ikk.indikator_kinerja_kegiatan_id = iksk.indikator_kinerja_kegiatan_id
                    LEFT JOIN 
                        transaksi_ikk tikk on tikk.indikator_kinerja_kegiatan_id = ikk.indikator_kinerja_kegiatan_id
                    RIGHT JOIN 
                        sasaran_kegiatan sk on sk.sasaran_kegiatan_id = ikk.sasaran_kegiatan_id
                    LEFT JOIN 
                        transaksi_sasaran_kegiatan tsk on tsk.sasaran_kegiatan_id = sk.sasaran_kegiatan_id
                    WHERE 
                        sk.sasaran_kegiatan_id = '$id'";
    } else if ($type === "indikator_kinerja_sub_kegiatan_id") {
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
                        RIGHT JOIN 
                            indikator_kinerja_sub_kegiatan iksk on iksk.indikator_kinerja_sub_kegiatan_id = ikuk.indikator_kinerja_sub_kegiatan_id
                        LEFT JOIN 
                            transaksi_iksk tiksk on tiksk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
                        RIGHT JOIN 
                            indikator_kinerja_kegiatan ikk on ikk.indikator_kinerja_kegiatan_id = iksk.indikator_kinerja_kegiatan_id
                        LEFT JOIN 
                            transaksi_ikk tikk on tikk.indikator_kinerja_kegiatan_id = ikk.indikator_kinerja_kegiatan_id
                        RIGHT JOIN 
                            sasaran_kegiatan sk on sk.sasaran_kegiatan_id = ikk.sasaran_kegiatan_id
                        LEFT JOIN 
                            transaksi_sasaran_kegiatan tsk on tsk.sasaran_kegiatan_id = sk.sasaran_kegiatan_id
                        WHERE 
                            ikk.indikator_kinerja_kegiatan_id = '$id'";
    } else if ($type === "indikator_kinerja_unit_kerja_id") {
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
                    RIGHT JOIN 
                        indikator_kinerja_sub_kegiatan iksk on iksk.indikator_kinerja_sub_kegiatan_id = ikuk.indikator_kinerja_sub_kegiatan_id
                    LEFT JOIN 
                        transaksi_iksk tiksk on tiksk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
                    RIGHT JOIN 
                        indikator_kinerja_kegiatan ikk on ikk.indikator_kinerja_kegiatan_id = iksk.indikator_kinerja_kegiatan_id
                    LEFT JOIN 
                        transaksi_ikk tikk on tikk.indikator_kinerja_kegiatan_id = ikk.indikator_kinerja_kegiatan_id
                    RIGHT JOIN 
                        sasaran_kegiatan sk on sk.sasaran_kegiatan_id = ikk.sasaran_kegiatan_id
                    LEFT JOIN 
                        transaksi_sasaran_kegiatan tsk on tsk.sasaran_kegiatan_id = sk.sasaran_kegiatan_id
                    WHERE 
                        iksk.indikator_kinerja_sub_kegiatan_id = '$id'";
    }

    $idData = $connection->query($queryID)->fetch_assoc();

    $transaksi_ikuk_id = $idData["transaksi_ikuk_id"];
    $ikuk_id = $idData["ikuk_id"];
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
                                    WHERE iksk.indikator_kinerja_sub_kegiatan_id = '$iksk_id'");
    // Realisasi IKSK
    $realisasiIKSK = 0;
    while ($row = $listIKUK->fetch_assoc()) {
        $realisasiIKSK += $row['realisasi_ikuk'] * $row['target_ikuk'];
    }
    $realisasiIKSK = $realisasiIKSK / 600 * 100;

    if ($transaksi_iksk_id !== null) {
        $connection->query("UPDATE transaksi_iksk
                            SET realisasi_iksk = $realisasiIKSK
                            WHERE transaksi_iksk_id = '$transaksi_iksk_id'");
    }

    // Realisasi IKK
    $realisasiIKK = 0;
    $listIKSK = $connection->query(
        "SELECT tiksk.*
        FROM indikator_kinerja_kegiatan ikk
        INNER JOIN indikator_kinerja_sub_kegiatan iksk ON iksk.indikator_kinerja_kegiatan_id = ikk.indikator_kinerja_kegiatan_id
        LEFT JOIN transaksi_iksk tiksk ON tiksk.indikator_kinerja_sub_kegiatan_id = iksk.indikator_kinerja_sub_kegiatan_id
        WHERE ikk.indikator_kinerja_kegiatan_id = '$ikk_id'"
    );

    while ($row = $listIKSK->fetch_assoc()) {
        if ($row["realisasi_iksk"]) {
            $realisasiIKK += $row["realisasi_iksk"];
        }
        $realisasiIKK += 0;
    }

    if ($transaksi_ikk_id !== null) {
        $connection->query(
            "UPDATE transaksi_ikk SET realisasi_ikk = $realisasiIKK WHERE transaksi_ikk_id = '$transaksi_ikk_id'"
        );
    }

    // Realisasi Sasaran
    $selectQuery = "SELECT transaksi_ikk.*, ikk.target_ikk
    FROM transaksi_ikk
    INNER JOIN indikator_kinerja_kegiatan ikk ON ikk.indikator_kinerja_kegiatan_id = transaksi_ikk.indikator_kinerja_kegiatan_id
    WHERE ikk.indikator_kinerja_kegiatan_id = '$ikk_id'";

    $result = $connection->query($selectQuery);
    $realisasiSasaran = 0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['realisasi_ikk'] >= $row['target_ikk']) {
                $realisasiSasaran += 1;
            }
        }
        $realisasiSasaran = $realisasiSasaran / $result->num_rows * 100;

        if ($transaksi_sasaran_kegiatan_id !== null) {
            if ($connection->query("UPDATE transaksi_sasaran_kegiatan SET realisasi_sasaran_kegiatan = $realisasiSasaran WHERE transaksi_sasaran_kegiatan_id = '$transaksi_sasaran_kegiatan_id'") === TRUE) {
            }
        }
    }
}
