<?php
// Koneksi db

// ini database localhost
$dbHost = 'localhost:3306';
$dbName = 'renstra_ami';
$dbUsername = 'root';
$dbPassword = 'Okokokdalll1';

// ini database server
// $dbHost = 'kanade.kawaiihost.net';
// $dbName = 'qtsdwmbb_renstra_ami';
// $dbUsername = 'qtsdwmbb_dania';
// $dbPassword = 'daniasupriyadi';


$connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// if($connection) {
//     echo "Koneksi Berhasil";
// } else {
//     echo "Koneksi Gagal". mysqli_connect_error();
// }
?> 