<?php
include '../../config.php';
session_start();


if (isset($_SESSION['nama'])) {
  header("Location: ../../Views/beranda.php");
  exit();
}

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = hash('sha256', $_POST['password']);
  // TODO: TAMBAH kolom NIP di DB kalo perlu
  
  $sql = "SELECT 
                nama, 
                email, 
                -- nip, 
                unit.unit_id as unit_id, 
                unit.nama_unit as nama_unit
            FROM
                user
            INNER JOIN 
                unit ON user.unit_id = unit.unit_id
            WHERE 
                email='$email' AND password='$password'";
  $result = mysqli_query($connection, $sql);

  if ($result->num_rows > 0) {

    $row = mysqli_fetch_assoc($result);
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['email'] = $row['email'];
    // $_SESSION['nip'] = $row['nip'];
    $_SESSION['unit_id'] = $row['unit_id'];
    $_SESSION['nama_unit'] = $row['nama_unit'];
 

    header("Location: ../../Views/beranda.php");
    exit();
  } else {
    $_SESSION['message'] = 'Email dan Password Anda Salah !!!';
    $_SESSION['message_type'] = 'error';
    header("Location: ../../Views/index.php");
    exit();
  }
}
?>