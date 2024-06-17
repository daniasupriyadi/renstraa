<?php
session_start();
if (isset($_SESSION['nama']) && isset($_SESSION['email'])) {
  header('Location: beranda.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <title>Login - Renstra</title>
  <?php
  include 'Layout/head.php';
  ?>
  <link rel="stylesheet" href="<?php echo $base_url ?>/assets/vendor/css/pages/page-auth.css" />
</head>

<body>
  <!-- Content -->
  <div class="container-xxl">
    <div class="position-absolute top-0 end-0 p-3 col-lg-4">
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

    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">

          <div class="card-body">

            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <div class="d-flex flex-column">
                  <img src="<?php echo $base_url ?>/assets/img/pjm.jpg" alt="">
                </div>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Selamat Datang di Renstra!</h4>
            <p class="mb-4">Silahkan login menggunakan akun anda</p>

            <form id="" class="mb-3" action="../Controllers/Authenticate/login_controller.php" method="POST">

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email....." autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Password...." aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" name="submit" type="submit">Login</button>
              </div>
            </form>


          </div>

        </div>


        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->
  <!-- Core JS -->
  <?php
  include 'Layout/corejs.php';
  ?>
  <!-- /Core Js -->
</body>

</html>