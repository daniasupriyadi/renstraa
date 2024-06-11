-- Query Database 

-- Untuk Melihat Daftar Database
SHOW DATABASES;

-- UNTUK Memilih Database Yang Akan Digunakan => USE nama_database
USE renstraami;

-- Tampil Data Unit 
SELECT unit_id, nama_unit
FROM unit 
ORDER by unit_id; 

-- Tampil Data Tujuan
SELECT tujuan_id, isi_tujuan
FROM tujuan
ORDER BY tujuan_id;

-- Tampil Data Sasaran Kegiatan
SELECT sasaran_kegiatan_id, tujuan_id, unit_id, isi_sasaran_kegiatan
FROM sasaran_kegiatan 
ORDER BY sasaran_kegiatan_id;

-- Tampil Data Indikator Kinerja kegiatan
SELECT sasaran_kegiatan_id, unit_id, kode_ikk, isi_indikator_kinerja_kegiatan, target_ikk
FROM indikator_kinerja_kegiatan 
ORDER BY indikator_kinerja_kegiatan_id;

-- Tampil Data Indikator Kinerja Sub Kegiatan
SELECT indikator_kinerja_sub_kegiatan_id, indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk
FROM indikator_kinerja_sub_kegiatan 
ORDER BY indikator_kinerja_sub_kegiatan_id;

-- Tampil Data Indikator Kinerja Unit Kerja 
SELECT indikator_kinerja_unit_kerja_id, indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk
FROM indikator_kinerja_unit_kerja ikuk 
ORDER BY indikator_kinerja_unit_kerja_id;

-- -------------------------------------------------------------------------------------------------------------------------------------------------------
-- Query Seluruh Data Database -> menggunakan 

SELECT 
	CONCAT('Id:',t.tujuan_id,' ',t.isi_tujuan) tujuan, 
	CONCAT('Id:',sk.sasaran_kegiatan_id,' ',sk.isi_sasaran_kegiatan) sasaran_kegiatan,
	CONCAT('Id:',ikk.indikator_kinerja_kegiatan_id,' ',ikk.isi_indikator_kinerja_kegiatan) indikator_kinerja_kegiatan, 
	CONCAT('Id:',iksk.indikator_kinerja_sub_kegiatan_id,' ',iksk.isi_indikator_kinerja_sub_kegiatan) indikator_kinerja_sub_kegiatan,
	CONCAT('Id:',ikuk.indikator_kinerja_unit_kerja_id,' ',ikuk.isi_indikator_kinerja_unit_kerja) ikuk
FROM 
	tujuan t
INNER JOIN 
	sasaran_kegiatan sk ON t.tujuan_id = sk.tujuan_id 
INNER JOIN 
	indikator_kinerja_kegiatan ikk ON sk.sasaran_kegiatan_id = ikk.sasaran_kegiatan_id
INNER JOIN 
	indikator_kinerja_sub_kegiatan iksk ON ikk.indikator_kinerja_kegiatan_id = iksk.indikator_kinerja_kegiatan_id 
INNER JOIN 
	indikator_kinerja_unit_kerja ikuk ON iksk.indikator_kinerja_sub_kegiatan_id = ikuk.indikator_kinerja_sub_kegiatan_id;



SELECT 
	isi_tujuan tujuan,
	sk.isi_sasaran_kegiatan sasaran_kegiatan
FROM 
	tujuan t
INNER JOIN 
	sasaran_kegiatan sk ON t.tujuan_id = sk.tujuan_id 
ORDER BY t.tujuan_id;