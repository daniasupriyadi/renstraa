<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <title>Daftar Unit</title>
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
              <h3 class="card-header">Daftar Tabel Unit</h3>
              <div class="card-body">
                <div class="d-flex flex-row justify-content-between mb-4 demo-inline-spacing">

                  <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                    <div>
                      <a type="button" class="btn btn-primary text-white" href="Form_Tambah/tambah_unit.php">
                        <span class="tf-icons bx bx-plus text-white"></span>&nbsp;Tambah Data
                      </a>
                      <a type="button" href="../Controllers/Export_Data/ExportUnit.php" class="btn btn-primary text-white">
                        <span class="tf-icons bx bx-download text-white"></span>&nbsp;Unduh .pdf
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
                <div class="table-responsive text-nowrap">
                  <table id="table" class="table table-hover">
                    <thead>
                      <tr>
                        <th class="small_column">No</th>
                        <th style="align-items: left !important;">Nama Unit / PIC</th>
                        <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                          <th class="small_column">Edit</th>
                          <th class="small_column">Hapus</th>
                        <?php
                        }
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include('../config.php');
                      $no = 1;
                      $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                          <td class="small_column"><?php echo $no++ ?></td>
                          <td><?php echo $data['nama_unit'] ?></td>
                          <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                            <td><a href="Form_Edit/edit_unit.php?unit_id=<?php echo $data['unit_id']; ?>"><i class='bx bx-pencil'></i></a></td>
                            <td><a href="../Controllers/Delete_Data/unit.php?unit_id=<?php echo $data['unit_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Unit  <?php echo $data['nama_unit'] ?>')"><i class='bx bxs-trash-alt'></i></a></td>
                          <?php
                          }
                          ?>
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

      <!-- Core JS -->
      <?php
      include 'Layout/corejs.php';
      ?>
      <!-- /Core Js -->
</body>

</html>