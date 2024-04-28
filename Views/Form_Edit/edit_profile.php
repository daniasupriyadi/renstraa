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
    <title>Profile</title>
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
          <div class="card mb-4">
                <div class="d-flex flex-row align-items-center back-menu">
                  <a href="../profile.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                  <span class="" style="font-size: 20px;">Tambah Data - Unit</span>
                </div>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="<?php echo $base_url ?>/assets/img/avatars/1.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload Foto Terbaru</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama Lengkap</label>
                            <input
                              class="form-control"
                              type="text"
                              placeholder="Masukkan Nama Lengkap......"
                              id="firstName"
                              name="firstName"
                              value="John"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">NIP</label>
                            <input class="form-control" type="text" name="email" id="emai" value="" placeholder="Masukkan Alamat Email......" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="john.doe@example.com"
                              placeholder="john.doe@example.com"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Password</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="john.doe@example.com"
                              placeholder="john.doe@example.com"
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">US (+1)</span>
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                                placeholder="202 555 0111"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Edit Data</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
          </div>
        </div>

    <!-- Core JS -->
    <?php
    include '../Layout/corejs.php';
    ?>
    <!-- /Core JS -->
  </body>
</html>
