<?php
include('../../../config.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    if (isset($_GET['indikator_kinerja_kegiatan_id'])) {
        $indikator_kinerja_kegiatan_id = $_GET['indikator_kinerja_kegiatan_id'];
        $query_ikk = "SELECT 
                        indikator_kinerja_kegiatan.indikator_kinerja_kegiatan_id as ikk_id,
                        indikator_kinerja_kegiatan.unit_id, 
                        kode_ikk, 
                        isi_indikator_kinerja_kegiatan,
                        target_ikk
                    FROM    
                        indikator_kinerja_kegiatan
                    WHERE 
                        indikator_kinerja_kegiatan.indikator_kinerja_kegiatan_id = '$indikator_kinerja_kegiatan_id'";
        $fetch_query_ikk = mysqli_query($connection, $query_ikk);
        $data_ikk = mysqli_fetch_array($fetch_query_ikk);

        
        // Query Cabang IKSK
        $query_iksk = "SELECT 
                            indikator_kinerja_sub_kegiatan.indikator_kinerja_kegiatan_id as iksk_id, 
                            indikator_kinerja_sub_kegiatan.unit_id, 
                            kode_iksk, 
                            isi_indikator_kinerja_sub_kegiatan, 
                            target_iksk
                        FROM 
                            indikator_kinerja_kegiatan
                        INNER JOIN 
                            indikator_kinerja_sub_kegiatan ON indikator_kinerja_sub_kegiatan.indikator_kinerja_kegiatan_id = indikator_kinerja_kegiatan.indikator_kinerja_kegiatan_id
                        WHERE 
                            indikator_kinerja_kegiatan.indikator_kinerja_kegiatan_id = '$indikator_kinerja_kegiatan_id'
                        ";
        $fetch_query_iksk = mysqli_query($connection, $query_iksk);
        // $data_iksk = mysqli_fetch_array($fetch_query_iksk);

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
                                <form action="../../../Controllers/Update_Data/instrument_renstra.php?indikator_kinerja_kegiatan_id" method="POST" id="nestedForm">

                                    <!-- Indikator Kinerja SUB Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-start">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="ikk_id" id="ikk_id" placeholder="Kode IKK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikk['ikk_id'] ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Kode IKK</label>
                                                        <input type="text" class="form-control" colspan="2" name="kode_ikk" id="kode_ikk" placeholder="Kode IKK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikk['kode_ikk']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Indikator Kinerja Kegiatan</label>
                                                        <textarea type="text" class="form-control " name="isi_indikator_kinerja_kegiatan" id="isi_indikator_kinerja_kegiatan" placeholder="Masukkan Indikator Kinerja Kegiatan....." aria-describedby="defaultFormControlHelp" value=""><?php echo $data_ikk['isi_indikator_kinerja_kegiatan'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 15%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_ikk" id="unit_id_ikk">
                                                            <?php
                                                            $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                                                            while ($data = mysqli_fetch_array($query)) {
                                                                $selected = in_array($data['unit_id'], $data_ikk) ? 'selected' : '';
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
                                                        <label for="" class="form-label">Target IKK</label>
                                                        <input type="number" class="form-control" name="target_ikk" id="target_ikk" placeholder="Target IKK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_ikk['target_ikk'] ?>"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Indikator Kinerja Sub Kegiatan -->
                                    <hr>


                                    <!-- Indikator Kinerja Unit kerja -->
                                    <?php 
                                    while($data_iksk = mysqli_fetch_array($fetch_query_iksk)){
                                        ?>
                                        <!-- test -->
                                        <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-end">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="ikuk_id" id="iksk_id" placeholder="Kode IKSK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['iksk_id']; ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Kode IKSK</label>
                                                        <input type="text" class="form-control" colspan="2" name="kode_iksk" id="kode_iksk" placeholder="Kode IKSK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['kode_iksk']; ?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Indikator Kinerja Sub Kegiatan</label>
                                                        <input type="text" class="form-control " name="isi_indikator_kinerja_sub_kegiatan" id="isi_indikator_kinerja_sub_kegiatan" placeholder="Masukkan Indikator Kinerja Sub Kegiatan...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['isi_indikator_kinerja_sub_kegiatan']; ?> " disabled>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_iksk" id="unit_id_iksk" disabled>
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
                                                <div class="" style="width: 10%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Target IKUK</label>
                                                        <input type="number" class="form-control" name="target_ikuk" id="target_ikuk" placeholder="Target IKUK...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_iksk['target_iksk'] ?>" disabled>
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