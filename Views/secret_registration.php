<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Registration</title>

    <?php
    include './Layout/head.php';
    include('../config.php');
    ?>
</head>

<body>
    <div class="d-flex flex-row align-items-center mt-4" style="padding-left: 24px;">
        <a href="../index.php"><i class='bx bx-left-arrow-alt text-black me-2' style="font-size: 26px;"></i></a>
        <span class="" style="font-size: 24px;">This Is Secret Registration</span>
    </div>
    <div class="container mt-4">
        <form id="DataUserForm" method="POST" action="../Controllers/Tambah_Data/tambah_user.php">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" placeholder="Masukkan Nama Lengkap......" id="nama" name="nama" autofocus />
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
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan Password..." />
                    <span id="password_error" style="color: red; display: none">Password do not
                        match.</span>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="password" clas s="form-label">Password</label>
                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Masukkan Konfirmasi Password...." />
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Tambah Data</button>
            </div>
        </form>
    </div>

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
</body>

</html>