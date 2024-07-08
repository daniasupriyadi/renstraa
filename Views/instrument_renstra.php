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
  <style>
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

                <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                  <div class="d-flex flex-row mb-2">
                    <a href="./Form_Tambah/tambah_instrumen_renstra.php" type="button" class="btn btn-primary me-3">
                      <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Data Instrument
                    </a>
                    <a href="../Controllers/Export_Data/ExportInstrument.php" class="btn btn-primary">
                      <span class="tf-icons bx bx-download"></span>&nbsp;Unduh Instrument
                    </a>
                  </div>
                <?php
                }
                ?>

                <div class="table-responsive text-nowrap" style="max-height: 640px;">
                  <table style="width:100%; background-color:#FFFF; border:solid grey 2px; color: black;" class="table table-hover table-bordered">
                    <thead class="table-head" style="height: 48px;">
                      <tr>
                        <th rowspan="2">Tujuan</th>
                        <th rowspan="2">Sasaran Kegiatan</th>
                        <th rowspan="2">Indikator Kinerja Kegiatan</th>
                        <th rowspan="2">Indikator Kinerja Sub Kegiatan</th>
                        <th colspan="3">Indikator Kinerja Unit Kerja</th>
                        <th rowspan="3">PIC/Unit</th>
                        <th rowspan="2" colspan="1">Target</th>
                        <th rowspan="2" colspan="1">Realisasi</th>

                        <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                          <th rowspan="2" colspan="1">Edit</th>
                          <th rowspan="2" colspan="1">Hapus</th>
                        <?php
                        }
                        ?>
                      </tr>
                      <tr>
                        <th colspan="1">Kode</th>
                        <th colspan="1">IKUK</th>
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
                                      INNER JOIN 
                                        sasaran_kegiatan ON tujuan.tujuan_id = sasaran_kegiatan.tujuan_id
                                      INNER JOIN 
                                        indikator_kinerja_kegiatan ON sasaran_kegiatan.sasaran_kegiatan_id = indikator_kinerja_kegiatan.sasaran_kegiatan_id
                                      ORDER BY 
                                        tujuan.tujuan_id
                                    ");
                        while ($branch_1 = mysqli_fetch_array($tujuan)) {
                        ?>
                          <tr class="parent-row">
                            <td colspan="10" style="background-color: antiquewhite;">
                              <span class="toggle-row">[+]</span><?php echo $branch_1['tujuan_id'] . '. ' . $branch_1['isi_tujuan']; ?>
                            </td>

                            <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                              <!-- <td style="background-color: antiquewhite;"></td> -->
                              <td style="background-color: antiquewhite;" class="">
                                <a href=""><span class="tf-icons bx bx-pencil text-center"></span></a>
                              </td>
                              <td style="background-color: antiquewhite;">
                                <a href="../Controllers/Delete_Data/instrument_renstra.php?tujuan_id=<?php echo $branch_1['tujuan_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tujuan :   <?php echo $branch_1['tujuan_id'] . ' => ' . $branch_1['isi_tujuan'] . ', dan Beserta Dengan Turunannya' ?> ')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
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
                                                    sasaran_kegiatan.target_sasaran, tsk.realisasi_sasaran_kegiatan as realisasi_sasaran
                                                FROM 
                                                  sasaran_kegiatan
                                                INNER JOIN 
                                                  unit ON unit.unit_id = sasaran_kegiatan.unit_id
                                                LEFT JOIN transaksi_sasaran_kegiatan tsk ON tsk.sasaran_kegiatan_id = sasaran_kegiatan.sasaran_kegiatan_id 
                                                LEFT JOIN                                                indikator_kinerja_kegiatan ON sasaran_kegiatan.sasaran_kegiatan_id = indikator_kinerja_kegiatan.sasaran_kegiatan_id
                                                WHERE 
                                                  tujuan_id = {$branch_1['tujuan_id']}
                                                ");
                          while ($branch_2 = mysqli_fetch_array($sasaran_kegiatan)) {
                          ?>
                            <tr class="">
                              <td colspan="1"></td>
                              <td colspan="6" style="background-color:  rgb(112, 228, 112);"><span class="toggle-row">[+]</span><?php echo '' . $branch_2['sk_id'] . '. ' . $branch_2['isi_sasaran_kegiatan'] ?></td>
                              <td colspan="1" style="background-color:  rgb(112, 228, 112); "><?php echo $branch_2['pic'] ?></td>
                              <td style="background-color:  rgb(112, 228, 112); "><?php echo $branch_2['target_sasaran']; ?></td>
                              <td style="background-color:  rgb(112, 228, 112); "><?php echo $branch_2['realisasi_sasaran']; ?></td>

                              <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                                <td style="background-color:  rgb(112, 228, 112);" class="">
                                  <a href=""><span class="tf-icons bx bx-pencil text-center"></span></a>
                                </td>
                                <td style="background-color:  rgb(112, 228, 112);">
                                  <a href="../Controllers/Delete_Data/instrument_renstra.php?sasaran_kegiatan_id=<?php echo $branch_2['sk_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Kode Sasaran Kegiatan :   <?php echo $branch_2['sk_id'] . ' => ' . $branch_2['isi_sasaran_kegiatan'] . ', dan Beserta Dengan Turunannya' ?> ')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
                                </td>
                              <?php
                              }
                              ?>
                            </tr>

                            <!-- Child Ke Tiga -->
                            <?php
                            $ikk = mysqli_query($connection, "SELECT DISTINCT
                                        indikator_kinerja_kegiatan.indikator_kinerja_kegiatan_id as ikk_id, 
                                        indikator_kinerja_kegiatan.kode_ikk as kode_ikk,
                                        isi_indikator_kinerja_kegiatan, 
                                        unit.nama_unit as unit, 
                                        target_ikk,
                                        tk.realisasi_ikk as realisasi_ikk
                                      FROM 
                                        indikator_kinerja_kegiatan
                                      LEFT JOIN transaksi_ikk tk ON tk.indikator_kinerja_kegiatan_id = indikator_kinerja_kegiatan. indikator_kinerja_kegiatan_id
                                      LEFT JOIN  
                                        unit ON unit.unit_id = indikator_kinerja_kegiatan.unit_id
                                      WHERE  
                                        sasaran_kegiatan_id = {$branch_2['sk_id']}
                                      ");
                            while ($branch_3 = mysqli_fetch_array($ikk)) {
                            ?>
                              <tr class="child-row">
                                <td colspan="2"></td>
                                <td colspan="5" style="background-color: burlywood;"><span class="toggle-row">[+]</span><?php echo '[' . $branch_3['kode_ikk'] . '] ' . $branch_3['isi_indikator_kinerja_kegiatan'] ?></td>
                                <td colspan="1" style="background-color: burlywood; width: 10px; white-space: pre-line; word-wrap: break-word; text-align: justify; color: black"><?php echo $branch_3['unit'] ?></td>
                                <td style="background-color: burlywood;"><?php echo $branch_3['target_ikk']; ?></td>
                                <td style="background-color: burlywood;"><?php echo $branch_3['realisasi_ikk']; ?></td>

                                <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                                  <td style="background-color: burlywood;" class="">
                                    <a href="Form_Edit/InstrumentRenstra/ikk.php?indikator_kinerja_kegiatan_id=<?php echo $branch_3['ikk_id']; ?>"><span class="tf-icons bx bx-pencil text-center"></span></a>
                                  </td>
                                  <td style="background-color: burlywood;">
                                    <a href="../Controllers/Delete_Data/instrument_renstra.php?indikator_kinerja_kegiatan_id=<?php echo $branch_3['ikk_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Kode IKK :   <?php echo $branch_3['kode_ikk'] . ' => ' . $branch_3['isi_indikator_kinerja_kegiatan'] . ', dan Beserta Dengan Turunannya' ?> ')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
                                  </td>
                                <?php
                                }
                                ?>
                              </tr>

                              <?php
                              $iksk = mysqli_query($connection, "SELECT DISTINCT
                                          indikator_kinerja_sub_kegiatan.indikator_kinerja_sub_kegiatan_id as iksk_id,
                                          kode_iksk, 
                                          isi_indikator_kinerja_sub_kegiatan, 
                                          unit.nama_unit as unit, 
                                          target_iksk,
                                          tiksk.realisasi_iksk as realisasi_iksk
                                        FROM 
                                          indikator_kinerja_sub_kegiatan
                                        LEFT JOIN transaksi_iksk tiksk ON tiksk.indikator_kinerja_sub_kegiatan_id =  indikator_kinerja_sub_kegiatan.indikator_kinerja_sub_kegiatan_id
                                        LEFT JOIN 
                                          unit ON indikator_kinerja_sub_kegiatan.unit_id = unit.unit_id
                                        WHERE 
                                          indikator_kinerja_kegiatan_id = {$branch_3['ikk_id']}
                                        ");
                              while ($branch_4 = mysqli_fetch_array($iksk)) {
                              ?>
                                <tr class="child-row">
                                  <td colspan="3" style="width: 10px;"></td>
                                  <td colspan="4" style="background-color: aquamarine;"><span class="toggle-row">[+]</span><?php echo '[' . $branch_4['kode_iksk'] . '] ' . $branch_4['isi_indikator_kinerja_sub_kegiatan'] ?></td>
                                  <td colspan="1" style="background-color: aquamarine;"><?php echo $branch_4['unit'] ?></td>
                                  <td style="background-color: aquamarine;"><?php echo $branch_4['target_iksk']; ?></td>
                                  <td style="background-color: aquamarine;"><?php echo $branch_4['realisasi_iksk']; ?></td>

                                  <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                                    <td style="background-color: aquamarine;" class="">
                                      <a href="Form_Edit/InstrumentRenstra/iksk.php?indikator_kinerja_sub_kegiatan_id=<?php echo $branch_4['iksk_id']; ?>"><span class="tf-icons bx bx-pencil text-center"></span></a>
                                    </td>
                                    <td style="background-color: aquamarine;">
                                      <a href="../Controllers/Delete_Data/instrument_renstra.php?indikator_kinerja_sub_kegiatan_id=<?php echo $branch_4['iksk_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Kode IKSK :   <?php echo $branch_4['kode_iksk'] . ' => ' . $branch_4['isi_indikator_kinerja_sub_kegiatan'] . ', dan Beserta Dengan Turunannya' ?> ')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
                                    </td>
                                  <?php
                                  }
                                  ?>
                                </tr>
                                <?php
                                $ikuk = mysqli_query($connection, "SELECT DISTINCT
                                            indikator_kinerja_unit_kerja.indikator_kinerja_unit_kerja_id, 
                                            kode_ikuk, 
                                            isi_indikator_kinerja_unit_kerja, 
                                            unit.nama_unit as unit, 
                                            target_ikuk,
                                            tikuk.realisasi_ikuk as realisasi_ikuk
                                          FROM 
                                            indikator_kinerja_unit_kerja
                                          LEFT JOIN transaksi_ikuk tikuk ON tikuk.indikator_kinerja_unit_kerja_id = indikator_kinerja_unit_kerja.indikator_kinerja_unit_kerja_id
                                          LEFT JOIN 
                                            unit ON indikator_kinerja_unit_kerja.unit_id = unit.unit_id
                                          WHERE 
                                            indikator_kinerja_sub_kegiatan_id = {$branch_4['iksk_id']}
                                        ");
                                while ($branch_5 = mysqli_fetch_array($ikuk)) {
                                ?>
                                  <tr class="child-row">
                                    <td colspan="4"></td>
                                    <td colspan="1" style="background-color: white; width: 10px; "><?php echo $branch_5['kode_ikuk'] ?></td>
                                    <td colspan="2" style="background-color: white;width: 24px; "><?php echo $branch_5['isi_indikator_kinerja_unit_kerja'] ?></td>
                                    <td colspan="" style="background-color: white; width: 10px;"><?php echo $branch_5['unit'] ?></td>
                                    <td colspan="" style="background-color: white; width: 10px;"><?php echo $branch_5['target_ikuk']; ?></td>
                                    <td><?php echo $branch_5['realisasi_ikuk']; ?></td>

                                    <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                                      <td class="">
                                        <a href="Form_Edit/InstrumentRenstra/ikuk.php?indikator_kinerja_unit_kerja_id=<?php echo $branch_5['indikator_kinerja_unit_kerja_id']; ?>"><span class="tf-icons bx bx-pencil text-center"></span></a>
                                      </td>
                                      <td>
                                        <a href="../Controllers/Delete_Data/instrument_renstra.php?indikator_kinerja_unit_kerja_id=<?php echo $branch_5['indikator_kinerja_unit_kerja_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus IKUK :   <?php echo $branch_5['kode_ikuk'] . ' => ' . $branch_5['isi_indikator_kinerja_unit_kerja'] ?>')"><span class="tf-icons bx bx-trash" style="color: red;"></span></a>
                                      </td>
                                    <?php
                                    }
                                    ?>
                                  </tr>
                        <?php
                                }
                              }
                            }
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