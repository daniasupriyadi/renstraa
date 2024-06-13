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
                                <a href="../instrument_tujuan_sasaran.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                                <span class="me-3" style="font-size: 20px;">Tambah Data - Instrument Tujuan & Sasaran Kegiatan</span>
                            </div>

                            <div class="card-body">

                                <form action="../../Controllers/Tambah_Data/instrument_tujuan_sasaran.php" method="POST" id="nestedForm">
                                    <!-- tujuan -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                    <!-- sasaran kegiatan -->
                                    
                                    <script>
                                        $(document).ready(function() {
                                            $('#isi_tujuan').on('change', function() {
                                                var tujuan_id = $(this).val();
                                                console.log(tujuan_id);
                                                if (tujuan_id) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'get_sasaran.php', // The PHP file created to fetch sasaran
                                                        data: 'tujuan_id=' + tujuan_id,
                                                        success: function(response) {
                                                            console.log(response);
                                                            $('#isi_sasaran_kegiatan').html(response);
                                                        }
                                                    });
                                                } else {
                                                    $('#isi_sasaran_kegiatan').html('<option value="">Pilih Sasaran Kegiatan</option>');
                                                }
                                            });
                                        });
                                    </script>

                                   
                                    <!-- Indikator Kinerja SUB Kegiatan -->
                                    <div class="row mb-3 d-flex align-align-items-center justify-content-end">
                                        <div class="" style="width: 80%;">
                                            <div class="">
                                                <label for="" class="form-label">Tujuan Kegiatan</label>
                                                <textarea type="text" class="form-control " name="isi_tujuan" id="isi_tujuan" placeholder="Masukkan Tujuan Kegiatan....." aria-describedby="defaultFormControlHelp" ></textarea>
                                            </div>
                                        </div>
                                       
                                        <div class="d-flex align-items-center" style="width: 20%;">
                                            <button type="button" class="btn rounded-pill btn-primary" id="addIKUK">
                                                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Sasaran
                                            </button>
                                        </div>

                                    </div>
                                    <hr>

                                    <!-- Indikator Kinerja Unit Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-end justify-content-end">
                                                <div class="" style="width: 75%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Sasaran Kegiatan</label>
                                                        <input type="text" class="form-control " name="isi_sasaran_kegiatan[]" id="isi_sasaran_kegiatan[]" placeholder="Masukkan Sasaran Kegiatan....." aria-describedby="defaultFormControlHelp" />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_sasaran[]" id="unit_id_sasaran">
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
                                                <div class="" style="width: 15%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Target Sasaran</label>
                                                        <input type="number" class="form-control" name="target_sasaran[]" id="target_sasaran" placeholder="Target Sasaran...." aria-describedby="defaultFormControlHelp"></input>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Tambah Data</button>
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