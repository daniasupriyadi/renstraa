<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <title>Tambah Unit/PIC</title>
    <?php
    include '../Layout/head.php';
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
                                <span class="" style="font-size: 20px;">Tambah Data - Instrument Rencana Strategis</span>
                            </div>
                            <div class="card-body">
                            <form action="../../Controllers/Tambah_Data/instrument_renstra.php" method="POST" id="nestedForm">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="tujuan-container">
                <div class="tujuan">
                    <label for="tujuanFormControlInput" class="form-label">Tujuan</label>
                    <input type="text" class="form-control tujuan-input" name="tujuan[]" placeholder="Masukkan Tujuan....." aria-describedby="defaultFormControlHelp" />
                </div>
            </div>
        </div>
    </div>
    <div class="sasaran-fields">
        <!-- Template sasaran -->
        <div class="sasaran-template" style="display: none;">
            <div class="row mb-3 align-items-end">
                <div class="col-md-6">
                    <div class="sasaran-container">
                        <label for="sasaranFormControlInput" class="form-label">Isi Sasaran Kegiatan</label>
                        <input type="text" class="form-control sasaran-input" name="sasaran[]" placeholder="Masukkan Sasaran Kegiatan" aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="pic-container">
                        <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                        <select class="form-select pic-select" name="pic[]">
                            <option>PIC/Unit</option>
                            <option value="1">Wadir</option>
                            <option value="2">Direktur</option>
                            <option value="3">Ukarni</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger delete-sasaran">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary add-sasaran">Tambah Sasaran</button>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
</form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Core JS -->
                <?php
                include '../Layout/corejs.php';
                ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addSasaranBtn = document.querySelector(".add-sasaran");
        const sasaranFields = document.querySelector(".sasaran-fields");
        const sasaranTemplate = document.querySelector(".sasaran-template");

        addSasaranBtn.addEventListener("click", function() {
            const newSasaranField = sasaranTemplate.cloneNode(true);
            newSasaranField.style.display = "block";
            sasaranFields.appendChild(newSasaranField);
        });

        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("delete-sasaran")) {
                event.target.closest(".row").remove();
            }
        });
    });
</script>

                <!-- /Core Js -->
</body>

</html>