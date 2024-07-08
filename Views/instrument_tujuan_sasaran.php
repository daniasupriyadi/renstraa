<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" branch_1-theme="theme-default" branch_1-assets-path="../assets/" branch_1-template="vertical-menu-template-free">
<!-- new -->

<head>
  <title>Instrument Renstra</title>
  <?php
  include 'Layout/head.php';
  ?>
  <!-- <style>
    .parent-row,
    .child-row {
      white-space: pre-line;
      word-wrap: break-word;
      text-align: justify;
      color: black;
    }

    .table-responsive {
      position: relative;
      overflow-x: auto;
    }

    .table-responsive .tbody-container {
      max-height: 500px;
      overflow-y: auto;
    }

    .table-responsive .table-head {
      position: sticky;
      top: 0;
      background-color: #FFC000;
      z-index: 1;
    }

    .table-responsive table {
      width: 100%;
    }

    .vertical-role {
      display: inline-block;
      margin: 0 5px;
      height: 100%;
      border-left: 1px solid #333;
      padding-left: 5px;
      padding-right: 5px;
    }
  </style> -->
  <style>
    .parent-row,
    .child-row {
      margin-bottom: 20px;
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
              <h3 class="card-header">Tabel Instrument Tujuan Sasaran</h3>
              <div class="card-body">
                <div class="d-flex flex-row justify-content-between mb-2">
                  <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                    <div>
                      <a href="./Form_Tambah/tambah_instrument_tujuan_sasaran.php" type="button" class="btn btn-primary me-3">
                        <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Tujuan Sasaran
                      </a>
                    </div>
                  <?php
                  }
                  ?>
                  <!-- Success Message -->
                  <?php
                  if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
                    $message_type = isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'success' ? 'alert-primary' : 'alert-danger';
                  ?>
                    <div id="flash-message" class="alert <?= $message_type ?>" role="alert">
                      <?= $_SESSION['message'] ?>
                    </div>
                  <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                  }
                  ?>
                  <!-- End Success Message -->
                </div>
                <div class="table-responsive text-nowrap" style="max-height: 640px;">
                  <table style="width:100%; background-color:#FFFF; border:solid grey 2px; color: black;" class="table table-hover table-bordered">
                    <thead class="table-head" style="height: 48px;">
                      <tr>
                        <th rowspan="">Tujuan</th>
                        <th rowspan="">Sasaran Kegiatan</th>
                        <th rowspan="">Unit</th>
                        <th rowspan="">Target</th>
                        <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                          <th rowspan="" colspan="">Edit</th>
                          <th rowspan="" colspan="">Hapus</th>
                        <?php
                        }
                        ?>
                      </tr>

                    </thead>

                    <div class="tbody-container">
                      <tbody class="scrollable-body" style="max-height: 600px; overflow-y: auto; ">
                        <?php
                        include('../config.php');
                        $tujuan = mysqli_query($connection, "SELECT
                                        DISTINCT(tujuan.tujuan_id) as tujuan_id, 
                                        isi_tujuan
                                      FROM 
                                        tujuan 
                                      LEFT JOIN 
                                        sasaran_kegiatan ON tujuan.tujuan_id = sasaran_kegiatan.tujuan_id
                                      ORDER BY 
                                        tujuan.tujuan_id
                                    ");
                        $no_parent = 1;
                        while ($branch_1 = mysqli_fetch_array($tujuan)) {
                        ?>
                          <tr class="parent-row">
                            <td colspan="4" style="background-color: aquamarine;">
                              <span class="toggle-row">[+]</span><?php echo $no_parent++ . '. ' . $branch_1['isi_tujuan']; ?>
                            </td>
                            <?php if(isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                            <td style="background-color: aquamarine;">
                              <a href="Form_Edit/InstrumentTujuanSasaran/tujuan.php?tujuan_id=<?php echo $branch_1['tujuan_id']; ?>"><span class="tf-icons bx bx-pencil text-center"></span></a>
                            </td>
                            <td style="background-color: aquamarine;">
                              <a href="../Controllers/Delete_Data/instrument_tujuan_sasaran.php?tujuan_id=<?php echo $branch_1['tujuan_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tujuan <?php echo $branch_1['tujuan_id'] . ' : ' . $branch_1['isi_tujuan'] . ', dan Beserta Dengan Turunannya' ?> ')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
                            </td>
                            <?php 
                            }
                            ?>
                          </tr>

                          <!-- Query Sasaran Kegiatan -->
                          <?php
                          $sasaran_kegiatan = mysqli_query($connection, "SELECT DISTINCT
                                                    (sasaran_kegiatan.sasaran_kegiatan_id) as sk_id, 
                                                    (isi_sasaran_kegiatan), 
                                                    unit.nama_unit as pic, 
                                                    target_sasaran
                                                FROM 
                                                  sasaran_kegiatan
                                                INNER JOIN 
                                                  unit ON unit.unit_id = sasaran_kegiatan.unit_id
                                                WHERE 
                                                  tujuan_id = {$branch_1['tujuan_id']}
                                                ");
                          $no_child = 1;
                          while ($branch_2 = mysqli_fetch_array($sasaran_kegiatan)) {
                          ?>

                            <!-- Child Ke Dua -->
                            <tr class="child-row">
                              <!-- <td colspan="1"></td> -->
                              <td colspan="2" style="background-color: white; padding-left: 12px;">
                                <ul style="list-style-type: none; padding-left: 4rem; margin: 0;">
                                  <li><?php echo $no_child++ . '.) ' . $branch_2['isi_sasaran_kegiatan']; ?></li>
                                </ul>
                              </td>

                              <td colspan="1" style="background-color: white;"><?php echo $branch_2['pic']; ?></td>
                              <td colspan="1" style="background-color: white;"><?php echo $branch_2['target_sasaran']; ?></td>
                              <?php if(isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                              <td style="background-color: white;">
                                <a href="Form_Edit/InstrumentTujuanSasaran/sasaran.php?sasaran_kegiatan_id=<?php echo $branch_2['sk_id']; ?>"><span class="tf-icons bx bx-pencil text-center"></span></a>
                              </td>
                              <td style="background-color: white;">
                                <a href="../Controllers/Delete_Data/instrument_tujuan_sasaran.php?sasaran_kegiatan_id=<?php echo $branch_2['sk_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Sasaran <?php echo $branch_2['sk_id'] . ' : ' . $branch_2['isi_sasaran_kegiatan'] . '' ?> ')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
                              </td>
                              <?php
                              }
                              ?>
                            </tr>
                        <?php
                          }
                        }
                        ?>
                      </tbody>
                    </div>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Core JS -->
      <?php
      include 'Layout/corejs.php'
      ?>
      <script>
        $(document).ready(function() {
          $(".toggle-row").click(function() {
            var $parentRow = $(this).closest('tr');
            var $childRows = $parentRow.nextAll('tr');

            var numChildRowsToHide = $childRows.length - 1; // Exclude the parent row itself
            $childRows.slice(0, numChildRowsToHide).toggle();
            var text = $parentRow.is(':visible') ? '[-]' : '[+]';
            $(this).text(text);
          });
        });
      </script>
      <!-- /Core JS -->
</body>

</html>