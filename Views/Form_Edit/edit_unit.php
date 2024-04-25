<?php
include ('../../config.php');

$unit_id = $_GET['unit_id'];
$query = "SELECT unit_id, nama_unit FROM unit WHERE unit_id = $unit_id";
$hasil = mysqli_query($connection, $query);
$data = mysqli_fetch_array($hasil);
?>


<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Beranda</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <script src="../../assets/js/config.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <style>
        .small_column{
          width: 50px;
        }
    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu Sidebar -->
        <?php
        include '../Layout/sidebar.php';
        ?>
        <!-- / Menu Sidebar -->

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
              <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

              <div class="card">
                <div class="d-flex flex-row">
                    <h3 class="card-header"><a href="../daftar_unit.php"><i class='bx bx-left-arrow-alt text-black mr-1' style="font-size: 28px;"></i></a> Edit Data - Unit</h3>
                </div>
                <div class="card-body">
                <form action="../../Controllers/Update_Data/unit.php" method="POST">
                        <div class="mb-3">
                          <input type="hidden" name="unit_id" value="<?php echo $data['unit_id'] ?>" class="form-control" id="basic-default-fullname" placeholder="ID" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nama Unit / PIC</label>
                          <input type="text" name="nama_unit" value="<?php echo $data['nama_unit'] ?>" class="form-control" id="basic-default-fullname" placeholder="Masukkan Nama Unit" />
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                      </form>
                </div>
              </div>
          </div>
          </div>
   
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
    
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <script>
       $(document).ready( function () {
       $('#table').DataTable();
      } );
    </script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
