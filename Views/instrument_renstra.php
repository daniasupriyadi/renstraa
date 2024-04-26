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
        th{
          text-align: center;
          vertical-align: middle;
        }
        table{
          color: black;
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
                  <h3 class="card-header">Tabel Rencana Strategis</h3>  
                <div class="card-body">
                
                <div class="d-flex flex-row mb-4 demo-inline-spacing"> 
                <button type="button" class="btn btn-primary">
                    <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Data
                </button>
                <a href="../Controllers/Export_Data/ExportInstrument.php" class="btn btn-primary">
                    <span class="tf-icons bx bx-download"></span>&nbsp;Unduh Data
                </a>
                </div>

                <div class="table-responsive text-nowrap">
                <table style="width:100%; background-color: white; border: solid grey 2px; color: black;"  class="table table-hover table-bordered">
                  <thead style="background-color: yellowgreen; color: black;">
                  <tr>
                    <th  rowspan="2">Tujuan</th>
                    <th rowspan="2" >Sasaran Kegiatan</th>
                    <th rowspan="2" >Indikator Kinerja Kegiatan</th>
                    <th rowspan="2">Indikator Kinerja Sub Kegiatan</th>
                    <th colspan="3" >Indikator Kinerja Unit Kerja</th>
                    <th rowspan="3" >PIC/Unit</th>
                  </tr>
                        <tr>
                          <th colspan="1">Kode</th>
                          <th colspan="1">IKUK</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                       include('../config.php');
                       $query = mysqli_query($connection, "SELECT 
                                                              tujuan.tujuan_id, 
                                                              isi_tujuan, 
                                                              isi_sasaran_kegiatan
                                                            FROM 
                                                              tujuan
                                                            INNER JOIN 
                                                              sasaran_kegiatan ON tujuan.tujuan_id = sasaran_kegiatan.tujuan_id
                                                            ORDER BY 
                                                              tujuan.tujuan_id
                                            ");
                        while($data = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                          <td colspan="8" style="background-color: antiquewhite;"><?php echo $data['isi_tujuan']; ?></td>
                        </tr>

                        <!-- Query Sasaran Kegiatan -->
                        <?php
                        $sasaran_kegiatan = mysqli_query($connection, "SELECT DISTINCT
                                                                          (isi_sasaran_kegiatan)
                                                                      FROM 
                                                                        sasaran_kegiatan
                                                                      WHERE 
                                                                        tujuan_id = {$data['tujuan_id']}
                                                                      ");
                        while($branch = mysqli_fetch_array($sasaran_kegiatan)){
                          ?>
                          <tr>
                            <td colspan="1"></td>
                            <td colspan="7" style="background-color:  rgb(112, 228, 112);"><?php echo $branch['isi_sasaran_kegiatan'] ?></td>
                          </tr>
                          <?php
                        }      
                        ?>           

                      <?php
                        }
                       ?>
                      </tbody>

                      <!-- Data Dummy -->
                      <!-- <tbody>
                          <tr style="background-color: antiquewhite;">
                              <td colspan="8">1. Terwujudnya kualitas sumber daya manusia untuk menghasilkan lulusan yang berdaya saing global</td>
                          </tr>
                          <tr>
                              <td colspan="1"></td>
                              <td colspan="6" style="background-color: rgb(112, 228, 112);">1. Terwujudnya kualitas sumber daya manusia untuk menghasilkan lulusan yang berdaya saing global</td>
                              <td colspan="1"  style="background-color: rgb(112, 228, 112);">Direktur</td>
                          </tr>
                          <tr>
                              <td colspan="2"></td>
                              <td colspan="5" style="background-color: rgb(224, 196, 159);">[IKU 1.1] Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi; atau menjadi wiraswasta</td>
                              <td colspan="1"  style="background-color:  rgb(224, 196, 159);"></td>
                          </tr>
                          <tr>
                              <td colspan="3"></td>
                              <td colspan="4" style="background-color: rgb(218, 218, 236);">[IKU 1.1] Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi; atau menjadi wiraswasta</td>
                              <td colspan="1"  style="background-color:  rgb(218, 218, 236);">Wadir 4</td>
                          </tr>
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="1" style="background-color: white;">U11.1</td>
                              <td colspan="2" style="background-color: white;">Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
                              <td colspan="1" style="background-color: white;">Ukarni</td>
                          </tr>
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="1" style="background-color: white;">U11.1</td>
                              <td colspan="2" style="background-color: white;">Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
                              <td colspan="1" style="background-color: white;">Ukarni</td>
                          </tr>
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="1" style="background-color: white;">U11.1</td>
                              <td colspan="2" style="background-color: white;">Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
                              <td colspan="1" style="background-color: white;">Ukarni</td>
                          </tr>
                      </tbody> -->
                      <!-- Data Dummy -->
                   </table>
                  </div>
                  </div>
                </div>
              </div>
          </div>
          </div>
   
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