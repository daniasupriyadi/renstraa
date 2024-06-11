<?php
// Koneksi db
include 'config.php';

// Fungsi untuk mengambil dan menampilkan data hirarki dalam format JSON
function ambilDataHirarkiJSON($mysql, $parent = 0) {
    $data = array();

    // Query untuk mengambil data berdasarkan parent
    $sql = "SELECT * FROM tujuan WHERE tujuan_id = $parent";
    $result = mysqli_query($mysql, $sql);

    // Jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Iterasi melalui setiap baris hasil
        while($row = mysqli_fetch_assoc($result)) {
            // Rekursif untuk mengambil anak-anaknya
            $row['children'] = ambilDataHirarkiJSON($mysql, $row['Tujuan_ID']);
            $data[] = $row;
        }
    }

    return $data;
}

// Panggil fungsi untuk mengambil data hirarki dalam format JSON
$dataJSON = ambilDataHirarkiJSON($mysql);


// Keluarkan hasil sebagai JSON
header('Content-Type: application/json');
echo json_encode($dataJSON, JSON_PRETTY_PRINT);
?>
