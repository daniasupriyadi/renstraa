<?php
include('../../../config.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    if (isset($_GET['sasaran_kegiatan_id'])) {
        $sasaran_kegiatan_id = $_GET['sasaran_kegiatan_id'];

        $query_sasaran = "SELECT 
                        sasaran_kegiatan_id as id,
                        tujuan_id, 
                        unit_id as unit, 
                        isi_sasaran_kegiatan as sasaran, 
                        target_sasaran
                    FROM    
                        sasaran_kegiatan
                    WHERE 
                        sasaran_kegiatan_id = '$sasaran_kegiatan_id'
                    ";
        $fetch_query = mysqli_query($connection, $query_sasaran);
        $data_sasaran = mysqli_fetch_array($fetch_query);
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
                                <a href="../../instrument_tujuan_sasaran.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                                <span class="me-3" style="font-size: 20px;">Edit Data - Instrument Sasaran</span>
                            </div>

                            <div class="card-body">

                                <!-- Form Ikuk -->
                                <form action="../../../Controllers/Update_Data/instrument_tujuan_sasaran.php?sasaran_kegiatan_id" method="POST" id="nestedForm">
                                    <!-- Indikator Kinerja Unit Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-start">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="sasaran_kegiatan_id" id="sasaran_kegiatan_id" placeholder="Kode sasaran...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_sasaran['id']; ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="tujuan-container">
                                                        <label for="" class="form-label">Sasaran ID</label>
                                                        <input type="text" class="form-control" colspan="2" name="sasaran_kegiatan_id" id="sasaran_kegiatan_id" placeholder="Tujuan Id........" aria-describedby="defaultFormControlHelp" value="<?php echo $data_sasaran['id']; ?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for= "" class="form-label">Sasaran Kegiatan</label>
                                                        <textarea type="text" class="form-control " name="isi_sasaran_kegiatan" id="isi_sasaran_kegiatan" placeholder="Masukkan Sasaran Kegiatan....." aria-describedby="defaultFormControlHelp" value=""><?php echo $data_sasaran['sasaran']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 15%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_sasaran" id="unit_id_sasaran">
                                                            <?php
                                                            $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                                                            while ($data = mysqli_fetch_array($query)) {
                                                                $selected = in_array($data['unit_id'], $data_sasaran) ? 'selected' : '';
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
                                                        <label for="" class="form-label">Target Sasaran</label>
                                                        <input type="number" class="form-control" name="target_sasaran" id="target_sasaran" placeholder="Target Sasaran...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_sasaran['target_sasaran'] ?>"></input>
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