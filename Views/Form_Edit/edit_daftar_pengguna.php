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
            include '../../config.php';
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
                                <a href="../daftar_user.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
                                <span class="" style="font-size: 20px;">Edit Data Pengguna - </span>
                            </div>
                            <!-- Account -->
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="<?php echo $base_url ?>/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload Foto Terbaru</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
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
                                <form id="DataUserForm" method="POST" onsubmit="return false">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">Nama Lengkap</label>
                                            <input class="form-control" type="text" placeholder="Masukkan Nama Lengkap......" id="name" name="name" value="" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">NIP</label>
                                            <input class="form-control" type="text" id="nip" name="nip" placeholder="Masukkan NIP....." />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="text" id="email" name="email" placeholder="Masukkan Email...." />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="picSelect" class="form-label">Pilih PIC/Unit</label>
                                            <select class="form-select" name="unit_id" id="unit_id">
                                                <option>PIC/Unit</option>
                                                <?php
                                                $query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $data['unit_id']; ?>"><?php echo $data['nama_unit']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Password</label>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan Password..." />
                                            <span id="password_error" style="color: red; display: none">Password do not
                                                match.</span>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" clas s="form-label">Password</label>
                                            <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Masukkan Konfirmasi Password...." />
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Edit Data</button>
                                    </div>
                                </form>

                                <script>
                                    function validatePasswords() {
                                        var password = document.getElementById('password').value;
                                        var confirmPassword = document.getElementById('confirm_password').value;
                                        var passwordError = document.getElementById('password_error');

                                        if (password !== confirmPassword) {
                                            passwordError.style.display = 'block';
                                            document.getElementById('password').style.borderColor = 'red';
                                            document.getElementById('confirm_password').style.borderColor = 'red';
                                        } else {
                                            passwordError.style.display = 'none';
                                            document.getElementById('password').style.borderColor = '';
                                            document.getElementById('confirm_password').style.borderColor = '';
                                        }
                                    }

                                    document.getElementById('DataUserForm').addEventListener('submit', function(event) {
                                        var password = document.getElementById('password').value;
                                        var confirmPassword = document.getElementById('confirm_password').value;
                                        var passwordError = document.getElementById('password_error');

                                        if (password !== confirmPassword) {
                                            passwordError.style.display = 'block';
                                            document.getElementById('password').style.borderColor = 'red';
                                            document.getElementById('confirm_password').style.borderColor = 'red';
                                            event.preventDefault();
                                        } else {
                                            passwordError.style.display = 'none';
                                            document.getElementById('password').style.borderColor = '';
                                            document.getElementById('confirm_password').style.borderColor = '';
                                        }
                                    });

                                    document.getElementById('password').addEventListener('input', validatePasswords);
                                    document.getElementById('confirm_password').addEventListener('input', validatePasswords);
                                </script>
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