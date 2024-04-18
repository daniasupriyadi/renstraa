<?php
// Lakukan koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "renstraami");

// Periksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari database
$query = "SELECT * FROM tabel_treegrid";
$result = mysqli_query($koneksi, $query);

// Buat array untuk menyimpan data
$data = array();

// Loop melalui hasil query dan tambahkan data ke array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Ubah array menjadi format JSON
echo json_encode($data);

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
