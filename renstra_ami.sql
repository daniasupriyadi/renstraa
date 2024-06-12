<<<<<<< HEAD
-- Drop Database  
DROP DATABASE renstra_ami;
=======
-- Drop Database jika ada 
DROP DATABASE renstraami;
>>>>>>> c6efee1e49c50da7622374cb7380c345d073e27e

-- Membuat Database AMI
CREATE DATABASE renstraami;

USE renstraami;

-- Buat Data Master ---------------------------------------------------------
CREATE TABLE unit(
	unit_id INT AUTO_INCREMENT, 
	nama_unit VARCHAR(256) NOT NULL UNIQUE, 
	PRIMARY KEY(unit_id)
);

CREATE TABLE tujuan(
	tujuan_id INT AUTO_INCREMENT, 
	isi_tujuan VARCHAR(256), 
	primary key(tujuan_id)	
);

CREATE TABLE sasaran_kegiatan(
	sasaran_kegiatan_id INT AUTO_INCREMENT, 
	tujuan_id INT NOT NULL,
	unit_id INT NOT NULL,
	isi_sasaran_kegiatan LONGTEXT, 
	target_sasaran INT,
	PRIMARY KEY(sasaran_kegiatan_id),
	CONSTRAINT FK_TUJUAN 
		FOREIGN KEY(tujuan_id) 
		REFERENCES tujuan(tujuan_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE, 
	CONSTRAINT FK_UNIT_1
		FOREIGN KEY(unit_id)
		REFERENCES unit(unit_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);


CREATE TABLE indikator_kinerja_kegiatan(
	indikator_kinerja_kegiatan_id INT AUTO_INCREMENT, 
	sasaran_kegiatan_id INT NOT NULL,
	unit_id INT,
	kode_ikk VARCHAR(128), 
	isi_indikator_kinerja_kegiatan LONGTEXT, 
	target_ikk INT,  
	PRIMARY KEY(indikator_kinerja_kegiatan_id),
	CONSTRAINT FK_SASARAN_KEGIATAN 
		FOREIGN KEY(sasaran_kegiatan_id) 
		REFERENCES sasaran_kegiatan(sasaran_kegiatan_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT FK_UNIT_2
		FOREIGN KEY(unit_id)
		REFERENCES unit(unit_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE indikator_kinerja_sub_kegiatan(
	indikator_kinerja_sub_kegiatan_id INT AUTO_INCREMENT, 
	indikator_kinerja_kegiatan_id INT NOT NULL, 
	unit_id INT,
	kode_iksk VARCHAR(128), 
	isi_indikator_kinerja_sub_kegiatan LONGTEXT, 
	target_iksk INT,  
	PRIMARY KEY(indikator_kinerja_sub_kegiatan_id), 
	CONSTRAINT FK_IKK 
		FOREIGN KEY(indikator_kinerja_kegiatan_id) 
		REFERENCES indikator_kinerja_kegiatan(indikator_kinerja_kegiatan_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT FK_UNIT_3
		FOREIGN KEY(unit_id) REFERENCES unit(unit_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE indikator_kinerja_unit_kerja(
	indikator_kinerja_unit_kerja_id INT AUTO_INCREMENT, 
	indikator_kinerja_sub_kegiatan_id INT NOT NULL, 
	unit_id INT,
	kode_ikuk VARCHAR(128), 
	isi_indikator_kinerja_unit_kerja LONGTEXT, 
	target_ikuk INT,  
	PRIMARY KEY(indikator_kinerja_unit_kerja_id), 
	CONSTRAINT FK_IKSK 
		FOREIGN KEY(indikator_kinerja_sub_kegiatan_id) 
		REFERENCES indikator_kinerja_sub_kegiatan(indikator_kinerja_sub_kegiatan_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT FK_UNIT_4
		FOREIGN KEY(unit_id)
		REFERENCES unit(unit_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

-- Data Transaksi ----------------------------------------------------------
CREATE TABLE waktu_pelaksanaan(
	waktu_pelaksanaan_id INT AUTO_INCREMENT, 
	tahun YEAR NOT NULL, 
	tanggal_pembukaan DATE, 
	tanggal_penutupan DATE,
	PRIMARY KEY(waktu_pelaksanaan_id)
);

CREATE TABLE transaksi_sasaran_kegiatan(
	transaksi_sasaran_kegiatan_id INT AUTO_INCREMENT, 
	sasaran_kegiatan_id INT,
	waktu_pelaksanaan_id INT, 
	realisasi_sasaran_kegiatan INT,
	PRIMARY KEY(transaksi_sasaran_kegiatan_id), 
	CONSTRAINT FK_WAKTU_PELAKSANAAN
		FOREIGN KEY(waktu_pelaksanaan_id)
		REFERENCES waktu_pelaksanaan(waktu_pelaksanaan_id), 
	CONSTRAINT FK_SKK_IDD
		FOREIGN KEY(sasaran_kegiatan_id)
		REFERENCES sasaran_kegiatan(sasaran_kegiatan_id)
);

CREATE TABLE transaksi_ikk(
	transaksi_ikk_id INT AUTO_INCREMENT,  
	waktu_pelaksanaan_id INT,
	indikator_kinerja_kegiatan_id INT,
	realisasi_ikk INT, 
	PRIMARY KEY (transaksi_ikk_id),
	CONSTRAINT FK_IKK_ID
		FOREIGN KEY(indikator_kinerja_kegiatan_id)
		REFERENCES indikator_kinerja_kegiatan(indikator_kinerja_kegiatan_id),
	CONSTRAINT FK_WAKTU_PELAKSANAAN_IKK
		FOREIGN KEY(waktu_pelaksanaan_id)
		REFERENCES waktu_pelaksanaan(waktu_pelaksanaan_id)
);


CREATE TABLE transaksi_iksk(
	transaksi_iksk_id INT AUTO_INCREMENT,
	indikator_kinerja_sub_kegiatan_id INT,
	waktu_pelaksanaan_id INT, 
	realisasi_iksk INT, 
	PRIMARY KEY(transaksi_iksk_id), 
	CONSTRAINT FK_IKSK_id
		FOREIGN KEY(indikator_kinerja_sub_kegiatan_id)
		REFERENCES indikator_kinerja_sub_kegiatan(indikator_kinerja_sub_kegiatan_id), 
	CONSTRAINT FK_WAKTU_PELAKSANAAN_IKSK
		FOREIGN KEY(waktu_pelaksanaan_id)
		REFERENCES waktu_pelaksanaan(waktu_pelaksanaan_id)
);

CREATE TABLE transaksi_ikuk(
	transaksi_ikuk_id INT AUTO_INCREMENT,  
	indikator_kinerja_unit_kerja_id INT, 
	waktu_pelaksanaan_id INT, 
	realisasi_ikuk INT, 
	PRIMARY KEY(transaksi_ikuk_id), 
	CONSTRAINT FK_IKUK
		FOREIGN KEY(indikator_kinerja_unit_kerja_id)
		REFERENCES  indikator_kinerja_unit_kerja(indikator_kinerja_unit_kerja_id),
	CONSTRAINT FK_WAKTU_PELAKSANAAN_IKUK
		FOREIGN KEY(waktu_pelaksanaan_id)
		REFERENCES waktu_pelaksanaan(waktu_pelaksanaan_id)
);
	

-- Buat Data Auth -----------------------------------------------------------


CREATE TABLE user(
	user_id INT AUTO_INCREMENT, 
	unit_id INT NOT NULL,
	nama VARCHAR(128) NOT NULL, 
	email VARCHAR(128) NOT NULL UNIQUE, 
	password VARCHAR(64) NOT NULL, 
	PRIMARY KEY(user_id),
	CONSTRAINT FK_UNIT_ROLE 
		FOREIGN KEY(unit_id)
		REFERENCES unit(unit_id)
);


-- Insert Data Master Unit
INSERT INTO unit (nama_unit) values ('Direktur'); -- 1
INSERT INTO unit (nama_unit) values ('Wadir 1'); -- 2
INSERT INTO unit (nama_unit) values ('Wadir 2'); -- 3
INSERT INTO unit (nama_unit) values ('Wadir 3'); -- 4
INSERT INTO unit (nama_unit) values ('Wadir 4');-- 5
INSERT INTO unit (nama_unit) values ('Departemen');-- 6
INSERT INTO unit (nama_unit) values ('Prodi');-- 7
INSERT INTO unit (nama_unit) values ('Ukarni');-- 8
INSERT INTO unit (nama_unit) values ('Minat Bakat');-- 9
INSERT INTO unit (nama_unit) values ('Penalaran');-- 10


-- Insert Data Master Tujuan
INSERT INTO tujuan(isi_tujuan) VALUES ('Terwujudnya kualitas sumber daya manusia untuk menghasilkan lulusan yang berdaya saing global');
INSERT INTO tujuan(isi_tujuan) VALUES ('Meningkatnya kualitas dosen pendidikan tinggi');

-- Insert Data Master Sasaran Kegiatan
INSERT INTO sasaran_kegiatan (tujuan_id, unit_id, isi_sasaran_kegiatan,target_sasaran) VALUES (1, 1, 'Meningkatnya kualitas lulusan pendidikan tinggi',100);
-- INSERT INTO sasaran_kegiatan (tujuan_id, unit_id, isi_sasaran_kegiatan) VALUES (1, 1, 'Meningkatnya kualitas dosen pendidikan tinggi');

-- Insert Data Master Indikator Kinerja Kegiatan
INSERT INTO indikator_kinerja_kegiatan (sasaran_kegiatan_id, unit_id, kode_ikk, isi_indikator_kinerja_kegiatan, target_ikk) VALUES (1, NULL, 'IKU 1.1', 'Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi atau menjadi wiraswasta', 55);
-- INSERT INTO indikator_kinerja_kegiatan (sasaran_kegiatan_id, unit_id, kode_ikk, isi_indikator_kinerja_kegiatan, target_ikk) VALUES (1, NULL, 'IKU 1.2', ' Persentase mahasiswa S1 dan D4/D3/D2 yang menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus; atau meraih prestasi paling rendah tingkat nasional', 10);


-- Insert Data Master Indikator Kinerja Sub Kegiatan
INSERT INTO indikator_kinerja_sub_kegiatan (indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES (1, 5, 'iksk 1.1.1', 'Jumlah lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan', 80);
INSERT INTO indikator_kinerja_sub_kegiatan (indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES (1, 2, 'iksk 1.1.2', 'Jumlah lulusan S1 dan D4/D3/D2 yang berhasil melanjutkan studi', 90);
INSERT INTO indikator_kinerja_sub_kegiatan (indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES (1, 5, 'iksk 1.1.3', 'Jumlah lulusan S1 dan D4/D3/D2 yang berhasil menjadi wirausaha', 100);
-- 
-- INSERT INTO indikator_kinerja_sub_kegiatan (indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES (2, 2, 'iksk 1.2.1', 'Jumlah mahasiswa S1 dan D4/D3/D2 yang menghabiskan hingga 20 (dua puluh) sks di luar kampus', NULL);
-- INSERT INTO indikator_kinerja_sub_kegiatan (indikator_kinerja_kegiatan_id, unit_id, kode_iksk, isi_indikator_kinerja_sub_kegiatan, target_iksk) VALUES (2, 4, 'iksk 1.2.2', 'Jumlah mahasiswa S1 dan D4/D3/D2 yang meraih prestasi paling rendah tingkat nasional', NULL);

-- Insert Data Master Indikator Kinerja Unit Kerja
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (1, 8, 'U11.1', 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP', 80);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (1, 8, 'U11.2', 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP', 100);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (1, 8, 'U11.3', 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP', 100);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (1, 8, 'U11.4', 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP', 100);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (2, 6, 'U11.5', 'Jumlah lulusan prodi yang melanjutkan studi ke jenjang berikutnya', NULL);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (3, 8, 'U11.6', 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP', 80);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (3, 8, 'U11.7', 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP', 80);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (3, 8, 'U11.8', 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP', 80);
INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (3, 8, 'U11.9', 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP', 80);
-- 
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.1', 'Jumlah mahasiswa D4/D3 yang menjalankan kegiatan pembelajaran di luar program studi sebesar 20 SKS', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.2', 'Jumlah mahasiswa D4/D3 yang menjalankan kegiatan pembelajaran di luar program studi sebesar 10 SKS', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.3', 'Jumlah mahasiswa D4/D3 yang menjalankan kegiatan magang wajib di luar program studi sebesar 20 SKS', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.4', 'Jumlah mahasiswa D4/D3 yang menjalankan kegiatan magang wajib di luar program studi sebesar 10 SKS', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.5', 'Jumlah mahasiswa inbound D4/D3 yang diterima dalam program pertukaran mahasiswa sebesar 20 SKS', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.6', 'Jumlah mahasiswa inbound D4/D3 yang diterima dalam program pertukaran mahasiswa sebesar 10 SKS', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (4, 6, 'U12.7', 'Jumlah mahasiswa inbound D4/D3 yang diterima dalam program pertukaran mahasiswa sebesar 10 SKS', NULL);
-- 
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 10, 'U12.8', 'Jumlah mahasiswa berprestasi juara 1 bidang akademik tingkat internasional', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 9, 'U12.9', 'Jumlah mahasiswa berprestasi juara 1 bidang non akademik tingkat internasional', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 10, 'U12.10', 'Jumlah mahasiswa berprestasi juara 2 bidang akademik tingkat internasional', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 9, 'U12.11', 'Jumlah mahasiswa berprestasi juara 2 bidang non akademik tingkat internasional', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 10, 'U12.12', 'Jumlah mahasiswa berprestasi juara 3  bidang akademik tingkat internasional', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 9, 'U12.13', 'Jumlah mahasiswa berprestasi juara 3 bidang non akademik tingkat internasional', NULL);
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 10, 'U12.14', 'Jumlah mahasiswa berprestasi juara 1  bidang akademik tingkat nasional', NULL);
<<<<<<< HEAD
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 9, 'U12.15', 'Jumlah mahasiswa berprestasi juara 1 bidang non akademik tingkat nasional', NULL);

=======
-- INSERT INTO indikator_kinerja_unit_kerja (indikator_kinerja_sub_kegiatan_id, unit_id, kode_ikuk, isi_indikator_kinerja_unit_kerja, target_ikuk) VALUES (5, 9, 'U12.15', 'Jumlah mahasiswa berprestasi juara 1 bidang non akademik tingkat nasional', NULL);
>>>>>>> c6efee1e49c50da7622374cb7380c345d073e27e
