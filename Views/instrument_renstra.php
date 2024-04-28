<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  branch_1-theme="theme-default"
  branch_1-assets-path="../assets/"
  branch_1-template="vertical-menu-template-free"
>
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
                <button type="button" class="btn btn-primary">
                    <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Data Instrument
                </button>
                <a href="../Controllers/Export_branch_1/ExportInstrument.php" class="btn btn-primary">
                    <span class="tf-icons bx bx-download"></span>&nbsp;Unduh Instrument
                </a>
                </div>

                <div class="table-responsive text-nowrap">
                <table style="width:100%; background-color: white; border: solid grey 2px; color: black;"  class="table table-hover table-bordered">
                  <thead class="table-head">
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
                        while($branch_1 = mysqli_fetch_array($tujuan)){
                        ?>
                        <tr class="parent-row">
                          <td colspan="8" style="background-color: antiquewhite;">
                            <span class="toggle-row">[+]</span><?php echo $branch_1['isi_tujuan'];?>
                          </td>
                        </tr>

                        <!-- Query Sasaran Kegiatan -->
                        <?php
                        $sasaran_kegiatan = mysqli_query($connection, "SELECT DISTINCT
                                                                          (isi_sasaran_kegiatan), 
                                                                          unit.nama_unit as pic
                                                                      FROM 
                                                                        sasaran_kegiatan
                                                                      INNER JOIN 
                                                                        unit ON unit.unit_id = sasaran_kegiatan.unit_id
                                                                      WHERE 
                                                                        tujuan_id = {$branch_1['tujuan_id']}
                                                                      ");
                        while($branch = mysqli_fetch_array($sasaran_kegiatan)){
                          ?>
                          <tr class="child-row">
                            <td colspan="1"></td>
                            <td colspan="6" style="background-color:  rgb(112, 228, 112);"><span class="toggle-row">[+]</span><?php echo $branch['isi_sasaran_kegiatan'] ?></td>
                            <td colspan="1" style="background-color:  rgb(112, 228, 112);"><?php echo $branch['pic'] ?></td>
                          </tr>

                          <!-- Child Ke Tiga -->
                          <!-- <tr class="child-row-1">
                            <td>test</td>
                          </tr> -->
                          <?php
                        }      
                        ?>           
                      <?php
                        }
                       ?>
                      </tbody>

                      <!-- branch_1 Dummy -->
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
                      <!-- branch_1 Dummy -->
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
    $(document).ready(function(){
        $(".toggle-row").click(function(){
            $(this).closest('tr').nextUntil('.parent-row').toggle();
            var text = $(this).text() === '[+]' ? '[-]' : '[+]';
            $(this).text(text);
        });
    });
</script>

    
    <!-- /Core JS -->
  </body>
</html>