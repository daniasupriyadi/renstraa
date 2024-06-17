<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">
<!-- new -->
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
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <div class="row mb-3 d-flex align-items-center">
                                        <div class="col-lg-12">
                                            <div class="tujuan-container">
                                                <div class="tujuan">
                                                    <label for="tujuan" class="form-label">Tujuan</label>
                                                    <select class="form-select tujuan-input" name="isi_tujuan" id="isi_tujuan" aria-describedby="defaultFormControlHelp">
                                                        <option value="">Pilih Tujuan</option>
                                                        <?php
                                                        $sql = "SELECT * FROM tujuan";
                                                        $tujuan_result = mysqli_query($connection, $sql);
                                                        if ($tujuan_result->num_rows > 0) {
                                                            while ($row = $tujuan_result->fetch_assoc()) {
                                                                echo '<option value="' . $row['tujuan_id'] . '">' . $row['isi_tujuan'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">Tujuan tidak tersedia</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- sasaran kegiatan -->
                                    <div class="row mb-3 d-flex align-align-items-start justify-content-end">
                                        <div class="" style="width: 70%;">
                                            <div class="sasaran-container">
                                                <label for="sasaran" class="form-label">Sasaran Kegiatan</label>
                                                <select class="form-select sasaran-input" name="isi_sasaran_kegiatan" id="isi_sasaran_kegiatan" aria-describedby="defaultFormControlHelp">
                                                    <option value="">Pilih Sasaran Kegiatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="" style="width: 15%;">
                                            <div class="sasaran-container">
                                                <label for="target_sasaran" class="form-label">Target</label>
                                                <input type="text" class="form-control sasaran-input" name="target_sasaran" id="target_sasaran" placeholder="Target Sasaran......" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                        </div>

                                        <!-- <div class="" style="width: 10%;">
                                            <div class="sasaran-container">
                                                <label for="target_sasaran" class="form-label">Realisasi</label>
                                                <input type="text" class="form-control sasaran-input" name="target_sasaran" id="target_sasaran" placeholder="Target Sasaran......" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                        </div> -->
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
                                    <!-- </div> -->
                                    <hr>

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

                                    <!-- Indikator Kinerja Kegiatan -->
                                    <div class="row mb-3 d-flex align-align-items-start justify-content-end">
                                        <div class="" style="width: 10%;">
                                            <div class="">
                                                <label for="" class="form-label">Kode IKK</label>
                                                <input type="text" class="form-control" name="kode_ikk" id="kode_ikk" placeholder="Kode IKK...." aria-describedby="defaultFormControlHelp" />
                                            </div>
                                        </div>
                                        <div class="" style="width: 50%;">
                                            <div class="">
                                                <label for="indikator_kinerja_kegiatan" class="form-label">Indikator Kinerja Kegiatan</label>
                                                <input type="text" class="form-control" name="isi_indikator_kinerja_kegiatan" id="isi_indikator_kinerja_kegiatan" placeholder="Masukkan Indikator Kinerja Kegiatan......" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                        </div>
                                        <div class="" style="width: 10%;">
                                            <div class="pic-container">
                                                <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                <select class="form-select" name="unit_id_ikk" id="unit_id_ikk">
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
                                        <div class="" style="width: 10%;">
                                            <div class="">
                                                <label for="target" class="form-label">Target IKK</label>
                                                <input type="number" class="form-control" name="target_ikk" id="target_ikk" placeholder="Target...." aria-describedby="defaultFormControlHelp"></input>
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center" style="width: 15%;">
                                            <div class="">
                                                <button type="button" class="btn rounded-pill btn-primary" id="addIKSK">
                                                    <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah IKSK
                                                </button>
                                            </div>
                                        </div>
                                        <!-- <div class="" style="width: 10%;">
                                            <div class="">
                                                <label for="target" class="form-label">Realisasi IKK</label>
                                                <input type="number" class="form-control" name="target_ikk" id="target_ikk" placeholder="Target...." aria-describedby="defaultFormControlHelp"></input>
                                            </div>
                                        </div> -->
                                    </div>
                                    <hr>

                                    <!-- Indikator Kinerja SUB Kegiatan -->
                                    <div class="iksk-fields">
                                        <div class="row mb-3 d-flex align-align-items-center justify-content-end iksk-template">
                                            <div class="" style="width: 10%;" class="">
                                                <div class="">
                                                    <label for="" class="form-label">Kode IKSK</label>
                                                    <input type="text" class="form-control" name="kode_iksk" id="kode_iksk" placeholder="Kode IKSK...." aria-describedby="defaultFormControlHelp" />
                                                </div>
                                            </div>
                                            <div class="" style="width: 62%;">
                                                <div>
                                                    <label for="" class="form-label">Indikator Kinerja Sub Kegiatan</label>
                                                    <input type="text" class="form-control " name="isi_indikator_kinerja_sub_kegiatan" id="isi_indikator_kinerja_sub_kegiatan" placeholder="Masukkan Isi Indikator Kinerja Sub Kegiatan....." aria-describedby="defaultFormControlHelp" />
                                                </div>
                                            </div>
                                            <div class="" style="width: 10%;">
                                                <div class="pic-container">
                                                    <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                    <select class="form-select" name="unit_id_iksk" id="unit_id_iksk">
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
                                            <div class="" style="width: 10%;">
                                                <div class="">
                                                    <label for="" class="form-label">Target IKSK</label>
                                                    <input type="number" class="form-control" name="target_iksk" id="target_iksk" placeholder="Target IKSK...." aria-describedby="defaultFormControlHelp"></input>
                                                </div>
                                            </div>
                                            <!-- <div class="" style="width: 10%;">
                                            <div class="">
                                                <label for="" class="form-label">Realisasi IKSK</label>
                                                <input type="number" class="form-control" name="target_iksk" id="target_iksk" placeholder="Target IKSK...." aria-describedby="defaultFormControlHelp"></input>
                                            </div>
                                        </div> -->

                                        </div>
                                    </div>
                                    <hr>

                                    <!-- Indikator Kinerja Unit Kegiatan -->
                                    <div class="ikuk-fields">
                                        <div class="d-flex align-items-center justify-content-between mb-3" style="margin-left: 0%; margin-top: 12px; margin-bottom: 12px;">
                                            <span style="font-size: 18px;">Indikator Kinerja Unit Kerja</span>
                                            <button type="button" class="btn rounded-pill btn-primary" id="addIKUK">
                                                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah IKUK
                                            </button>
                                        </div>
                                        <div class="ikuk-template">
                                            <div class="row mb-4 d-flex align-align-items-start justify-content-end">

                                                <div class="" style="width: 10%;">
                                                    <div class="sasaran-container">
                                                        <label for="" class="form-label">Kode IKUK</label>
                                                        <input type="text" class="form-control" name="kode_ikuk[]" id="kode_ikuk" placeholder="Kode IKUK...." aria-describedby="defaultFormControlHelp" />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 60%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Indikator Kinerja Unit Kerja</label>
                                                        <input type="text" class="form-control " name="isi_indikator_kinerja_unit_kerja[]" id="isi_indikator_kinerja_unit_kerja" placeholder="Masukkan Indikator Kinerja Unit Kerja....." aria-describedby="defaultFormControlHelp" />
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="pic-container">
                                                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                                        <select class="form-select" name="unit_id_ikuk[]" id="unit_id_ikuk">
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
                                                <div class="" style="width: 10%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Target IKUK</label>
                                                        <input type="number" class="form-control" name="target_ikuk[]" id="target_ikuk" placeholder="Target IKUK...." aria-describedby="defaultFormControlHelp"></input>
                                                    </div>
                                                </div>
                                                <div class="" style="width: 10%;">
                                                    <div class="">
                                                        <label for="" class="form-label">Realisasi IKUK</label>
                                                        <input type="number" class="form-control" name="realisasi_ikuk[]" id="realisasi_ikuk" placeholder="Realisasi IKUK...." aria-describedby="defaultFormControlHelp"></input>
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
                        document.getElementById('addIKSK').addEventListener('click', function() {
                            var ikskTemplate = document.querySelector('.iksk-template').cloneNode(true);
                            var ikskFields = document.querySelector('.iksk-fields');
                            ikskTemplate.querySelectorAll('input').forEach(input => input.value = '');
                            ikskTemplate.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
                            ikskFields.appendChild(ikskTemplate);
                        });
                    });
                </script>
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