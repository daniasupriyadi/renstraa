<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<!-- new -->

<head>
  <title>Profile</title>
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
            <section class="section profile">
              <div class="row">
                <div class="col-xl-4">
                  <div class="card mb-4 mb-xl-0">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                      <img src="<?php echo $base_url ?>/assets/img/avatars/1.png" alt="Profile" class="rounded-circle mb-4">
                      <h4><?php echo $_SESSION['nama']; ?></h4>
                      <h6><?php echo $_SESSION['nama_unit']; ?></h6>
                    </div>
                  </div>
                </div>

                <div class="col-xl-8">
                  <div class="card">
                    <div class="card-body pt-3">
                      <!-- Bordered Tabs -->

                      <div class="tab-content pt-5">
                        <div class="" id="profile-overview">
                          <div class="d-flex align-items-center mb-4">
                            <div class="me-3">
                              <span class="card-title" style="font-size: 20px; font-weight: bold;">Detail Profil</span>
                            </div>

                            <?php if (isset($_SESSION['nama_unit']) && $_SESSION['nama_unit'] !== 'user') { ?>
                              <div class="">
                                <a href="Form_Edit/edit_profile.php">
                                  <i class='bx bxs-pencil' style="font-size: 22px;"></i>
                                </a>
                              </div>
                            <?php
                            }
                            ?>
                          </div>

                          <div class="row mt-2">
                            <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nama']; ?></div>
                          </div>

                          <div class="row mt-2">
                            <div class="col-lg-3 col-md-4 label ">NIP</div>
                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nip']; ?></div>
                          </div>

                          <div class="row mt-2">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email']; ?></div>
                          </div>

                          <div class="row mt-2">
                            <div class="col-lg-3 col-md-4 label">Password</div>
                            <div class="col-lg-9 col-md-8">******************</div>
                          </div>

                          <div class="row mt-2">
                            <div class="col-lg-3 col-md-4 label">Unit / PIC</div>
                            <div class="col-lg-9 col-md-8"><?php echo $_SESSION['nama_unit']; ?></div>
                          </div>

                        </div>
                      </div><!-- End Bordered Tabs -->
                    </div>
                  </div>
                </div>
              </div>
            </section>

          </div>
        </div>

        <!-- Core JS -->
        <?php
        include 'Layout/corejs.php';
        ?>
        <!-- /Core JS -->
</body>

</html>