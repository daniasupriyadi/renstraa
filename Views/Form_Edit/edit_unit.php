<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}
?>


<?php
include('../../config.php');
// new
$unit_id = $_GET['unit_id'];
$query = "SELECT unit_id, nama_unit FROM unit WHERE unit_id = $unit_id";
$hasil = mysqli_query($connection, $query);
$data = mysqli_fetch_array($hasil);
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
  <title>Beranda</title>
  <?php
  include '../Layout/head.php';
  ?>
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
              <div class="d-flex flex-row align-items-center back-menu">
                <a class="me-2" href="../daftar_unit.php"><i class='bx bx-left-arrow-alt text-black' style="font-size: 26px;"></i></a>
                <span class="" style="font-size: 20px;">Edit Data - Unit</span>
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
        <?php
        include '../Layout/corejs.php';
        ?>
        <!-- /Core Js -->
</body>

</html>