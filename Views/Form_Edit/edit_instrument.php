<?php
// include('../../config.php');

// if ($_SERVER['REQUEST_METHOD'] == "GET"){
    
//     if(isset($_GET['tujuan_id']));
//     $select_tujuan = "SELECT "
// }
// ?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <title>Tambah Unit/PIC</title>
    <?php
    include '../Layout/head.php';
    include('../../config.php');
    ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu Sidebar-->
            <?php
            include '../Layout/sidebar.php';
            ?>
            <!-- / Menu Sidebar-->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php
                include '../Layout/navbar.php';
                ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <div class="d-flex flex-row align-items-center back-menu">
                                <a href="../instrument_renstra.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                                <span class="me-3" style="font-size: 20px;">Tambah Data - Instrument Rencana Strategis</span>


                            </div>

                            <div class="card-body">
                                <form action="../../Controllers/Tambah_Data/instrument_renstra.php" method="POST" id="nestedForm">
                                    <!-- tujuan -->
                                    <div class="row mb-3 d-flex align-items-center">
                                        <div class="col-lg-12">
                                            <div class="tujuan-container">
                                                <div class="tujuan">
                                                    <label for="tujuan" class="form-label">Tujuan</label>
                                                    <textarea type="text" class="form-control tujuan-input" name="isi_tujuan" id="isi_tujuan" placeholder="Masukkan Tujuan....." aria-describedby="defaultFormControlHelp"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- sasaran kegiatan -->
                                    <div class="row mb-3 d-flex align-align-items-start justify-content-end">
                                        <div class="" style="width: 75%;">
                                            <div class="sasaran-container">
                                                <label for="sasaran" class="form-label">Isi Sasaran Kegiatan</label>
                                                <input type="text" class="form-control sasaran-input" name="isi_sasaran_kegiatan" id="isi_sasaran_kegiatan" placeholder="Masukkan Sasaran Kegiatan....." aria-describedby="defaultFormControlHelp" />
                                            </div>
                                        </div>
                                        <div class="" style="width: 10%;">
                                            <div class="sasaran-container">
                                                <label for="sasaran" class="form-label">Target</label>
                                                <input type="text" class="form-control sasaran-input" name="target_sasaran" id="target_sasaran" placeholder="Target Sasaran......" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                        </div>
                                        <div class="" style="width: 13%;">
                                            <div class="pic-container">
                                                <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                <select class="form-select" name="unit_id_sasaran" id="unit_id_sasaran">
                                                    <option>PIC/Unit</option>
                                                    <?php
                                                    $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                                                    while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <option value="<?php echo $data['unit_id']; ?>"><?php echo $data['nama_unit']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Core JS -->
                <?php
                include '../Layout/corejs.php';
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