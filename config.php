<?php
// Koneksi db

$dbHost = 'localhost:3308';
$dbName = 'renstraami';
$dbUsername = 'root';
$dbPassword = '';

$connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// if($connection) {
//     echo "Koneksi Berhasil";
// } else {
//     echo "Koneksi Gagal". mysqli_connect_error();
// }
?> 