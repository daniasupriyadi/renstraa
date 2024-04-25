<?php
// Koneksi db

$dbHost = 'localhost';
$dbName = 'renstra_ami';
$dbUsername = 'root';
$dbPassword = 'Okokokdalll1';

$connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// if($connection) {
//     echo "Koneksi Berhasil";
// } else {
//     echo "Koneksi Gagal". mysqli_connect_error();
// }
// ?> 