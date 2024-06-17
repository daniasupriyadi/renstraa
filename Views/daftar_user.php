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
                            <h3 class="card-header">Daftar User - Pengguna</h3>
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between mb-4 demo-inline-spacing">
                                    <div>
                                        <a type="button" class="btn btn-primary text-white" href="Form_Tambah/tambah_user.php">
                                            <span class="tf-icons bx bx-plus text-white"></span>&nbsp;Tambah Data
                                        </a>
                                        <a type="button" href="../Controllers/Export_Data/ExportUnit.php" class="btn btn-primary text-white">
                                            <span class="tf-icons bx bx-download text-white"></span>&nbsp;Unduh .pdf
                                        </a>
                                    </div>
                                    
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
                                                <th style="align-items: center !important;">Nama Pengguna</th>
                                                <th class="" style="align-items: center !important;">Email</th>
                                                <th class="">PIC/UNIT</th>
                                                <th class="">Edit</th>
                                                <th class="">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('../config.php');
                                            $no = 1;
                                            $query = mysqli_query(
                                                $connection,
                                                "SELECT 
                                                                                    user_id, 
                                                                                    nama, 
                                                                                    email, 
                                                                                    unit.nama_unit as unit 
                                                                                FROM 
                                                                                    user
                                                                                INNER JOIN 
                                                                                    unit ON user.unit_id = unit.unit_id
                                                                                ORDER BY unit.unit_id"
                                            );
                                            while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td class="small_column"><?php echo $no++ ?></td>
                                                    <td><?php echo $data['nama'] ?></td>
                                                    <td><?php echo $data['email'] ?></td>
                                                    <td><?php echo $data['unit'] ?></td>
                                                    <td><a href="Form_Edit/daftar_user.php?user_id=<?php echo $data['user_id']; ?>"><i class='bx bx-pencil'></i></a></td>
                                                    <td><a href="../Controllers/Delete_Data/daftar_pengguna.php?user_id=<?php echo $data['user_id']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus User  <?php echo $data['nama'] ?>')"><i class='bx bxs-trash-alt'></i></a></td>
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