<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
?>


<?php
include('../../../config.php');
// new
if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    if (isset($_GET['indikator_kinerja_unit_kerja_id'])) {
        $indikator_kinerja_unit_kerja_id = $_GET['indikator_kinerja_unit_kerja_id'];

        $query_ikuk = "SELECT 
                        indikator_kinerja_unit_kerja.indikator_kinerja_unit_kerja_id as ikuk_id,
                        indikator_kinerja_unit_kerja.isi_indikator_kinerja_unit_kerja as ikuk, 
                        indikator_kinerja_unit_kerja.unit_id, 
                        indikator_kinerja_unit_kerja.kode_ikuk, 
                        indikator_kinerja_unit_kerja.target_ikuk,
                        tikuk.realisasi_ikuk
                    FROM    
                        indikator_kinerja_unit_kerja
                    LEFT JOIN transaksi_ikuk tikuk ON tikuk.indikator_kinerja_unit_kerja_id = indikator_kinerja_unit_kerja.indikator_kinerja_unit_kerja_id
                    WHERE 
                        indikator_kinerja_unit_kerja.indikator_kinerja_unit_kerja_id = '$indikator_kinerja_unit_kerja_id'
                    ";
        $fetch_query = mysqli_query($connection, $query_ikuk);
        $data_ikuk = mysqli_fetch_array($fetch_query);
    }
    
}
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <title>Tambah Unit/PIC</title>
    <?php
    include('../../Layout/head.php');
    ?>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu Sidebar-->
            <?php
            include "../../Layout/sidebar.php";
            ?>
            <!-- / Menu Sidebar-->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php
                include '../../Layout/navbar.php';
                ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <div class="d-flex flex-row align-items-center back-menu">
                                <a href="../../instrument_renstra.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                                <span class="me-3" style="font-size: 20px;">Edit Data - Instrument Indikator Kinerja Unit Kerja</span>
                            </div>

                            <div class="card-body">

                                <!-- Form Ikuk -->
                                <form action="../../../Controllers/Update_Data/instrument_renstra.php?indikator_kinerja_unit_kerja_id" method="POST" id="nestedForm">
                                    <!-- Indikator Kinerja Unit Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-start">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="ikuk_id" id="kode_ikuk" placeholder="Kode IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['ikuk_id']; ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Kode IKUK</label>
                                                        <input type="text" class="form-control" colspan="2" name="kode_ikuk" id="kode_ikuk" placeholder="Kode IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['kode_ikuk']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Indikator Kinerja Unit Kerja</label>
                                                        <textarea type="text" class="form-control " name="isi_indikator_kinerja_unit_kerja" id="isi_indikator_kinerja_unit_kerja" placeholder="Masukkan Indikator Kinerja Unit Kerja....." aria-describedby="defaultFormControlHelp" value=""><?php echo $data_ikuk['ikuk']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_ikuk" id="unit_id_ikuk">
                                                            <?php
                                                            $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                                                            while ($data = mysqli_fetch_array($query)) {
                                                                $selected = in_array($data['unit_id'], $data_ikuk) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?php echo $data['unit_id']; ?>" <?php echo $selected; ?>><?php echo $data['nama_unit']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Target IKUK</label>
                                                        <input type="number" class="form-control" name="target_ikuk" id="target_ikuk" placeholder="Target IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['target_ikuk'] ?>"></input>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Realisasi IKUK</label>
                                                        <input type="number" class="form-control" name="realisasi_ikuk" id="realisasi_ikuk" placeholder="Realisasi IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['realisasi_ikuk'] ?>"></input>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>
                                <!-- Form IKUK -->

                            </div>


                        </div>
                    </div>
                </div>

                <!-- Core JS -->
                <?php
                include '../../Layout/corejs.php';
                ?>
                <!-- /Core Js -->

                <!-- script add form -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('addIKUK').addEventListener('click', function() {
                            var ikukTemplate = document.querySelector('.ikuk-template').cloneNode(true);
                            var ikukFields = document.querySelector('.ikuk-fields');
                            ikukFields.appendChild(ikukTemplate);
                        });

                    });
                </script>
</body>

</html>