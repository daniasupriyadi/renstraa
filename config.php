<?php
// Koneksi db

$dbHost = 'localhost';
$dbName = 'renstraami';
$dbUsername = 'root';
$dbPassword = '';

$mysql = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$mysql) {
    die('Connection Error: ' . mysqli_connect_error());
} else {
    echo 'Koneksi berhasil';
}
?> #