<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" branch_1-theme="theme-default" branch_1-assets-path="../assets/" branch_1-template="vertical-menu-template-free">

<head>
  <title>Instrument Renstra</title>
  <?php
  include 'Layout/head.php';
  ?>
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
                  <a href="./Form_Tambah/tambah_instrumen_renstra.php" type="button" class="btn btn-primary">
                    <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Data Instrument
                  </a>
                  <a href="../Controllers/Export_Data/ExportInstrument.php" class="btn btn-primary">
                    <span class="tf-icons bx bx-download"></span>&nbsp;Unduh Instrument
                  </a>
                </div>

                <div class="table-responsive text-nowrap">
                  <table style="width:100%; background-color: #F8FAFF; border: solid grey 2px; color: black;" class="table table-hover table-bordered">
                    <thead class="table-head">
                      <tr>
                        <th rowspan="2">Tujuan</th>
                        <th rowspan="2">Sasaran Kegiatan</th>
                        <th rowspan="2">Indikator Kinerja Kegiatan</th>
                        <th rowspan="2">Indikator Kinerja Sub Kegiatan</th>
                        <th colspan="3">Indikator Kinerja Unit Kerja</th>
                        <th rowspan="3">PIC/Unit</th>
                        <th rowspan="2" colspan="2">Aksi</th>
                      </tr>
                      <tr>
                        <th colspan="1">Kode</th>
                        <th colspan="1">IKUK</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      include('../config.php');
                      $tujuan = mysqli_query($connection, "SELECT
                                        DISTINCT(tujuan.tujuan_id), 
                                        isi_tujuan
                                      FROM 
                                        tujuan 
                                      INNER JOIN 
                                        sasaran_kegiatan ON tujuan.tujuan_id = sasaran_kegiatan.tujuan_id
                                      ORDER BY 
                                        tujuan.tujuan_id
                                    ");
                      while ($branch_1 = mysqli_fetch_array($tujuan)) {
                      ?>
                        <tr class="parent-row">
                          <td colspan="8" style="background-color: antiquewhite;">
                            <span class="toggle-row">[+]</span><?php echo $branch_1['isi_tujuan']; ?>
                          </td>
                        </tr>

                        <!-- Query Sasaran Kegiatan -->
                        <?php
                        $sasaran_kegiatan = mysqli_query($connection, "SELECT DISTINCT
                                                    (sasaran_kegiatan.sasaran_kegiatan_id) as sk_id, 
                                                    (isi_sasaran_kegiatan), 
                                                    unit.nama_unit as pic
                                                FROM 
                                                  sasaran_kegiatan
                                                INNER JOIN 
                                                  unit ON unit.unit_id = sasaran_kegiatan.unit_id
                                                WHERE 
                                                  tujuan_id = {$branch_1['tujuan_id']}
                                                ");
                        while ($branch_2 = mysqli_fetch_array($sasaran_kegiatan)) {
                        ?>
                          <tr class="">
                            <td colspan="1"></td>
                            <td colspan="6" style="background-color:  rgb(112, 228, 112);"><span class="toggle-row">[+]</span><?php echo $branch_2['isi_sasaran_kegiatan'] ?></td>
                            <td colspan="1" style="background-color:  rgb(112, 228, 112);"><?php echo $branch_2['pic'] ?></td>
                          </tr>

                          <!-- Child Ke Tiga -->
                          <?php
                          $ikk = mysqli_query($connection, "SELECT DISTINCT
                                        indikator_kinerja_kegiatan.indikator_kinerja_kegiatan_id as ikk_id, 
                                        isi_indikator_kinerja_kegiatan, 
                                        unit.nama_unit as unit
                                      FROM 
                                        indikator_kinerja_kegiatan
                                      LEFT JOIN  
                                        unit ON unit.unit_id = indikator_kinerja_kegiatan.unit_id
                                      WHERE  
                                        sasaran_kegiatan_id = {$branch_2['sk_id']}
                                      ");
                          while ($branch_3 = mysqli_fetch_array($ikk)) {
                          ?>
                            <tr class="child-row">
                              <td colspan="2"></td>
                              <td colspan="4" style="background-color: burlywood;"><span class="toggle-row">[+]</span><?php echo $branch_3['isi_indikator_kinerja_kegiatan'] ?></td>
                              <td colspan="2" style="background-color: burlywood;"><?php echo $branch_3['unit'] ?></td>
                            </tr>

                            <?php
                            $iksk = mysqli_query($connection, "SELECT DISTINCT
                                          indikator_kinerja_sub_kegiatan.indikator_kinerja_sub_kegiatan_id as iksk_id, 
                                          isi_indikator_kinerja_sub_kegiatan, 
                                          unit.nama_unit as unit
                                        FROM 
                                          indikator_kinerja_sub_kegiatan
                                        LEFT JOIN 
                                          unit ON indikator_kinerja_sub_kegiatan.unit_id = unit.unit_id
                                        WHERE 
                                          indikator_kinerja_kegiatan_id = {$branch_3['ikk_id']}
                                        ");
                            while ($branch_4 = mysqli_fetch_array($iksk)) {
                            ?>
                              <tr class="child-row">
                                <td colspan="3"></td>
                                <td colspan="4" style="background-color: aquamarine;"><span class="toggle-row">[+]</span><?php echo $branch_4['isi_indikator_kinerja_sub_kegiatan'] ?></td>
                                <td colspan="1"><?php echo $branch_4['unit'] ?></td>
                              </tr>
                              <?php
                              $ikuk = mysqli_query($connection, "SELECT DISTINCT
                                            indikator_kinerja_unit_kerja.indikator_kinerja_unit_kerja_id, 
                                            kode_ikuk, 
                                            isi_indikator_kinerja_unit_kerja, 
                                            unit.nama_unit as unit
                                          FROM 
                                            indikator_kinerja_unit_kerja
                                          LEFT JOIN 
                                            unit ON indikator_kinerja_unit_kerja.unit_id = unit.unit_id
                                          WHERE 
                                            indikator_kinerja_sub_kegiatan_id = {$branch_4['iksk_id']}
                                        ");
                              while ($branch_5 = mysqli_fetch_array($ikuk)) {
                              ?>
                                <tr class="child-row">
                                  <td colspan="4"></td>
                                  <td colspan="1" style="background-color: white;"><?php echo $branch_5['kode_ikuk'] ?></td>
                                  <td colspan="2" style="background-color: white;"><?php echo $branch_5['isi_indikator_kinerja_unit_kerja'] ?></td>
                                  <td colspan="" style="background-color: white;"><?php echo $branch_5['unit'] ?></td>
                                </tr>
                      <?php
                              }
                            }
                          }
                        }
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