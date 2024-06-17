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

    if (isset($_GET['indikator_kinerja_sub_kegiatan_id'])) {
        $indikator_kinerja_sub_kegiatan_id = $_GET['indikator_kinerja_sub_kegiatan_id'];
        $query_iksk = "SELECT 
                        indikator_kinerja_sub_kegiatan_id as iksk_id,
                        indikator_kinerja_sub_kegiatan.unit_id, 
                        kode_iksk, 
                        isi_indikator_kinerja_sub_kegiatan,
                        target_iksk
                    FROM    
                        indikator_kinerja_sub_kegiatan
                    WHERE 
                        indikator_kinerja_sub_kegiatan_id = '$indikator_kinerja_sub_kegiatan_id'
                    ";
        $fetch_query = mysqli_query($connection, $query_iksk);
        $data_iksk = mysqli_fetch_array($fetch_query);

        // Query Cabang IKUK 
        $query_ikuk = "SELECT 
                            indikator_kinerja_unit_kerja_id as ikuk_id, 
                            indikator_kinerja_unit_kerja.unit_id, 
                            kode_ikuk, 
                            isi_indikator_kinerja_unit_kerja, 
                            target_ikuk
                        FROM 
                            indikator_kinerja_sub_kegiatan
                        INNER JOIN  
                            indikator_kinerja_unit_kerja ON indikator_kinerja_sub_kegiatan.indikator_kinerja_sub_kegiatan_id = indikator_kinerja_unit_kerja.indikator_kinerja_sub_kegiatan_id
                        WHERE 
                            indikator_kinerja_sub_kegiatan.indikator_kinerja_sub_kegiatan_id = '$indikator_kinerja_sub_kegiatan_id'
                    ";
        $fetch_child_query = mysqli_query($connection, $query_ikuk);
    }
    
}
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <title>Tambah Unit/PIC</title>
    <?php
    include ('../../Layout/head.php');
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
                                <span class="me-3" style="font-size: 20px;">Edit Data - Instrument Indikator Kinerja Sub Kegiatan</span>
                            </div>

                            <div class="card-body">

                                <!-- Form Ikuk -->
                                <form action="../../../Controllers/Update_Data/instrument_renstra.php?indikator_kinerja_sub_kegiatan_id" method="POST" id="nestedForm">

                                    <!-- Indikator Kinerja SUB Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-start">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="iksk_id" id="iksk_id" placeholder="Kode IKSK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['iksk_id'] ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Kode IKSK</label>
                                                        <input type="text" class="form-control" colspan="2" name="kode_iksk" id="kode_iksk" placeholder="Kode IKSK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['kode_iksk']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Indikator Kinerja Sub Kegiatan</label>
                                                        <textarea type="text" class="form-control " name="isi_indikator_kinerja_sub_kegiatan" id="isi_indikator_kinerja_sub_kegiatan" placeholder="Masukkan Indikator Kinerja Sub Kegiatan....." aria-describedby="defaultFormControlHelp" value=""><?php echo $data_iksk['isi_indikator_kinerja_sub_kegiatan'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 15%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_iksk" id="unit_id_iksk">
                                                            <?php
                                                            $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                                                            while ($data = mysqli_fetch_array($query)) {
                                                                $selected = in_array($data['unit_id'], $data_iksk) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?php echo $data['unit_id']; ?>" <?php echo $selected; ?>><?php echo $data['nama_unit']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 15%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Target IKSK</label>
                                                        <input type="number" class="form-control" name="target_iksk" id="target_iksk" placeholder="Target IKSK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['target_iksk'] ?>"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Indikator Kinerja Sub Kegiatan -->
                                    <hr>


                                    <!-- Indikator Kinerja Unit kerja -->
                                    <?php 
                                    while($data_ikuk = mysqli_fetch_array($fetch_child_query)){
                                        ?>
                                        <!-- test -->
                                        <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-end">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="ikuk_id" id="kode_ikuk" placeholder="Kode IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['ikuk_id']; ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Kode IKUK</label>
                                                        <input type="text" class="form-control" colspan="2" name="kode_ikuk" id="kode_ikuk" placeholder="Kode IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['kode_ikuk']; ?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Indikator Kinerja Unit Kerja</label>
                                                        <input type="text" class="form-control " name="isi_indikator_kinerja_unit_kerja" id="isi_indikator_kinerja_unit_kerja" placeholder="Masukkan Indikator Kinerja Unit Kerja....." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['isi_indikator_kinerja_unit_kerja']; ?> " disabled>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_ikuk" id="unit_id_ikuk" disabled>
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
                                                        <input type="number" class="form-control" name="target_ikuk" id="target_ikuk" placeholder="Target IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikuk['target_ikuk'] ?>" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <!-- Indikator Kinerja Unit Kerja -->
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