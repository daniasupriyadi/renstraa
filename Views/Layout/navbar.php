<!-- Membuat Relatif Path untuk mengarahkan ke folder root -->
<?php
include 'base_url.php';
?>
<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->


      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-online me-3">
              <img src="<?php echo $base_url ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
            </div>
            <div class="flex-grow-1 me-3">
              <span class="fw-semibold d-block">John Doe</span>
              <small class="text-muted">PJM</small>
            </div>
            <div>
              <i class='bx bx-chevron-down'></i>
            </div>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="<?php echo $base_url ?>/Views/profile.php">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">Profil</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="<?php echo $base_url ?>/Views/Auth/login.php">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Keluar</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>
<!-- Navbar -->