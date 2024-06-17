<?php
session_start();
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $unit_id = $_POST['unit_id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $confirm_password = hash('sha256', $_POST['confirm_password']);

    if($password == $confirm_password){
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);

        if(!$result->num_rows > 0){
            $sql = "INSERT INTO user (unit_id, nama, nip, email, password)
                    VALUES('$unit_id', '$nama', '$nip', '$email', '$password')";

            $result = mysqli_query($connection, $sql);
            if ($result){
                $_SESSION['message'] = 'Data User Berhasil Ditambahkan !!!';
                $_SESSION['message_type'] = 'success';
                header("Location: ../../Views/daftar_user.php");
                exit();
                
            } else {
                $_SESSION['message'] = 'Terjadi kesalahan: ' . mysqli_error($connection);
                $_SESSION['message_type'] = 'error';
                header("Location: ../../Views/daftar_user.php");
                exit();
            }
        } else {
            $_SESSION['message'] = 'Email Anda Sudah Terdaftar !!!';
            $_SESSION['message_type'] = 'error';
            header("Location: ../../Views/daftar_user.php");
            exit();
        }
    } else {
        $_SESSION['message'] = 'Password Yang Anda Masukkan Tidak Sesuai !!!';
        $_SESSION['message_type'] = 'error';
        header("Location: ../../Views/daftar_user.php");
        exit();
    }
}
?>

