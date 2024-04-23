<?php
// Koneksi db

$dbHost = 'localhost';
$dbName = 'renstra_ami';
$dbUsername = 'root';
$dbPassword = 'Okokokdalll1';

$mysql = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$mysql) {
    die('Connection Error: ' . mysqli_connect_error());
} else {
    echo 'Koneksi berhasil';
}
?> #