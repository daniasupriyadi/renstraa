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
                <span class="" style="font-size: 20px;">Tambah Data - Instrument Renstra</span>
              </div>
              <div class="card-body">
                <form action="../../Controllers/Tambah_Data/unit.php" method="POST">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama Unit / PIC</label>
                    <input type="text" name="nama_unit" class="form-control" id="basic-default-fullname" placeholder="Masukkan Nama Unit" />
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
        <!-- /Core Js -->
</body>

</html>