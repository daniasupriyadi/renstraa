<!-- get_sasaran.php -->
<?php
    include('../../config.php');

if (isset($_POST['tujuan_id'])) {
    $tujuan_id = $_POST['tujuan_id'];
    $sql = "SELECT * FROM sasaran_kegiatan WHERE tujuan_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $tujuan_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sasaran_options = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sasaran_options .= '<option value="' . $row['sasaran_kegiatan_id'] . '">' . $row['isi_sasaran_kegiatan'] . '</option>';
        }
    } else {
        $sasaran_options = '<option value="">Sasaran tidak tersedia</option>';
    }

    echo $sasaran_options;
}
?>
