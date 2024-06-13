<?php
include('../../../config.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    if (isset($_GET['tujuan_id'])) {
        $tujuan_id = $_GET['tujuan_id'];
        $query_tujuan = "SELECT 
                        tujuan_id,
                        isi_tujuan, 
                    FROM    
                        tujuan
                    WHERE 
                        tujuan_id = '$tujuan_id'
                    ";
        $fetch_query = mysqli_query($connection, $query_tujuan);
        $data_tujuan = mysqli_fetch_array($fetch_query);

        // Query Cabang IKUK 
        $query_sasaran_kegiatan = "SELECT 
                            sasaran_kegiatan_id, 
                            tujuan_id, 
                            unit_id, 
                            isi_sasaran_kegiatan, 
                            target_sasaran
                        FROM 
                            sasaran_kegiatan
                        WHERE 
                            tujuan_id = '$tujuan_id'
                    ";
        $fetch_child_query = mysqli_query($connection, $query_sasaran_kegiatan);
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
                                <a href="../../instrument_tujuan_sasaran.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                                <span class="me-3" style="font-size: 20px;">Edit Data - Instrument Tujuan</span>
                            </div>

                            <div class="card-body">

                                <!-- Form Ikuk -->
                                <form action="../../../Controllers/Update_Data/InstrumentTujuanSasaran.php?tujuan_id" method="POST" id="nestedForm">

                                    <!-- Indikator Kinerja SUB Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-start">
                                                <!-- id ikuk -->
                                                <input type="hidden" class="form-control" name="tujuan_id" id="tujuan_id" placeholder="Masukkan Tujuan...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_tujuan['tujuan_id'] ?>" />
                                                <!-- id ikuk -->
                                                <div class="" style="width: 20%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Tujuan ID</label>
                                                        <input type="text" class="form-control" colspan="2" name="tujuan_id" id="tujuan_id" placeholder="Tujuan ID...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_tujuan['tujuan_id']; ?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 50%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Isi Tujuan</label>
                                                        <textarea type="text" class="form-control " name="isi_tujuan" id="isi_tujuan" placeholder="Masukkan Isi Tujuan....." aria-describedby="defaultFormControlHelp" value=""><?php echo $data_tujuan['isi_tujuan'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Indikator Kinerja Sub Kegiatan -->
                                    <hr>


                                    <!-- Indikator Kinerja Unit kerja -->
                                    <?php
                                    while ($data_sasaran = mysqli_fetch_array($fetch_child_query)) {
                                    ?>
                                        <!-- test -->
                                        <div class="ikuk-fields">
                                            <div class="ikuk-template">
                                                <div class="row mb-4 d-flex align-align-items-start justify-content-end">
                                                    <!-- id ikuk -->
                                                    <input type="hidden" class="form-control" name="sasaran_kegiatan_id" id="sasaran_kegiatan_id" placeholder="Masukkan ID Sasaran Kegiatan...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_sasaran['sasaran_kegiatan_id']; ?>" />
                                                    <!-- id ikuk -->
                                                    <div class="" style="width: 50%;">
                                                        <div class="">
                                                            <label for="" class="form-label">Isi Sasaran Kegiatan</label>
                                                            <input type="text" class="form-control " name="isi_sasaran_kegiatan" id="isi_sasaran_kegiatan" placeholder="Masukkan Sasaran Kegiatan....." aria-describedby="defaultFormControlHelp" value="<?php echo $data_sasaran['isi_sasaran_kegiatan']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="" style="width: 10%;">
                                                        <div class="pic-container">
                                                            <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                            <select class="form-select" name="unit_id_sasaran" id="unit_id_sasaran" disabled>
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
                                                    <div class="" style="width: 10%;">
                                                        <div class="">
                                                            <label for="" class="form-label">Target Sasaran</label>
                                                            <input type="number" class="form-control" name="target_sasaran" id="target_sasaran" placeholder="Target Sasaran...." aria-describedby="defaultFormControlHelp" value="<?php echo $data_sasaran['target_sasaran'] ?>" disabled>
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