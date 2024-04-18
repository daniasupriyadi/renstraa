<?php
// Ambil nilai dari form
$tujuan = $_POST['tujuan'];
$sasaran = $_POST['sasaran_kegiatan'];
$indikator_kegiatan = $_POST['indikator_kinerja_kegiatan'];
$indikator_sub_kegiatan = $_POST['indikator_kinerja_sub_kegiatan'];
$kode = $_POST['kode'];
$indikator_unit_kerja = $_POST['indikator_kinerja_unit_kerja'];
$pic = $_POST['pic'];
$target = $_POST['target'];
$realisasi = $_POST['realisasi'];

// Disimpan dalam struktur data sederhana
$data = array(
    'tujuan' => $tujuan,
    'sasaran_kegiatan' => $sasaran_kegiatan,
    'indikator_kinerja_kegiatan' => $indikator_kinerja_kegiatan,
    'indikator_kinerja_sub_kegiatan' => $indikator_kinerja_sub_kegiatan,
    'kode' => $kode,
    'indikator_kinerja_unit_kerja' => $indikator_kinerja_unit_kerja,
    'pic' => $pic,
    'target' => $target,
    'realisasi' => $realisasi
);

// Simpan data ke dalam sesi atau database, sesuai kebutuhan

// Mengirimkan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
