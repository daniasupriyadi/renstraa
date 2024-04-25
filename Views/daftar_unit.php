<?php
session_start(); // Mulai session

// Cek apakah ada pesan sukses dalam session saat halaman dimuat
if(isset($_SESSION['success_message'])) {
    // Simpan pesan sukses dalam variabel JavaScript
    $success_message = $_SESSION['success_message'];
    // Hapus pesan sukses dari session agar tidak ditampilkan lagi saat refresh halaman
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
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
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>
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
        include 'Layout/sidebar.php';
        ?>
        <!-- / Menu Sidebar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <?php
          include 'Layout/navbar.php';
          ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
              <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4> -->

              <div class="card">
                <h3 class="card-header">Daftar Tabel Unit</h3>
                <div class="card-body">
                <div class="d-flex flex-row mb-4 demo-inline-spacing"> 
                <a type="button" class="btn btn-primary text-white" href="Form_Tambah/tambah_unit.php">
                    <span class="tf-icons bx bx-plus text-white"></span>&nbsp;Tambah Data
                </a>
                <a type="button" href="../Controllers/Export_Data/ExportUnit.php" class="btn btn-primary text-white">
                    <span class="tf-icons bx bx-download text-white"></span>&nbsp;Unduh .pdf
               </a>
                

                </div>
                  <div class="table-responsive text-nowrap">
                  <table id="table" class="table table-hover">
                      <thead>
                          <tr>
                              <th class="small_column">No</th>
                              <th>Nama Unit / PIC</th>
                              <th class="small_column">Edit</th>
                              <th class="small_column">Hapus</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                          include('../config.php');
                          $no = 1;
                          $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                          while($data = mysqli_fetch_array($query)){
                        ?>
                          <tr>
                              <td class="small_column"><?php echo $no++ ?></td>
                              <td><?php echo $data['nama_unit'] ?></td>
                              <td><a href="Form_Edit/edit_unit.php?unit_id=<?php echo $data['unit_id']; ?>"><i class='bx bx-pencil'></i></a></td>
                              <td><a href="../Controllers/Delete_Data/unit.php?unit_id=<?php echo $data['unit_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Unit  <?php echo $data['nama_unit']?>')"><i class='bx bxs-trash-alt'></i></a></td>
                          </tr>
                          <?php 
                          }
                          ?>
                      </tbody>
                  </table>
                  </div>
                  </div>
                </div>
              </div>
          </div>
          </div>


    <!-- Script fungsi tammpil data berhasil Ditambahkan -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
    
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <script>
       $(document).ready( function () {
       $('#table').DataTable();
      } );
    </script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
