-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 10:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renstraami`
--

-- --------------------------------------------------------

--
-- Table structure for table `indikator_kinerja_kegiatan`
--

CREATE TABLE `indikator_kinerja_kegiatan` (
  `Indikator_Kinerja_Kegiatan_ID` int(11) NOT NULL,
  `Sasaran_Kegiatan_ID` int(11) DEFAULT NULL,
  `Unit` int(11) DEFAULT NULL,
  `Kode_IKK` varchar(255) DEFAULT NULL,
  `Isi_Indikator_Kinerja_Kegiatan` text DEFAULT NULL,
  `Satuan_IKK` varchar(50) DEFAULT NULL,
  `Target_IKK` decimal(10,2) DEFAULT NULL,
  `Realisasi_IKK` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator_kinerja_sub_kegiatan`
--

CREATE TABLE `indikator_kinerja_sub_kegiatan` (
  `Indikator_Kinerja_Sub_Kegiatan_ID` int(11) NOT NULL,
  `Indikator_Kinerja_Kegiatan_ID` int(11) DEFAULT NULL,
  `Isi_Indikator_Kinerja_Sub_Kegiatan` text DEFAULT NULL,
  `Target_IKSK` varchar(50) DEFAULT NULL,
  `Realisasi_IKSK` decimal(10,2) DEFAULT NULL,
  `Satuan_IKSK` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator_kinerja_unit_kerja`
--

CREATE TABLE `indikator_kinerja_unit_kerja` (
  `indikator_kinerja_unit_kerja_id` int(11) NOT NULL,
  `indikator_kinerja_sub_kegiatan_id` int(11) DEFAULT NULL,
  `kode_ikuk` varchar(255) DEFAULT NULL,
  `isi_indikator_kinerja_unit_kerja` text DEFAULT NULL,
  `target_ikuk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `Pengguna_ID` int(11) NOT NULL,
  `Role_ID` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Role_ID` int(11) NOT NULL,
  `Nama_Role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sasaran_kegiatan`
--

CREATE TABLE `sasaran_kegiatan` (
  `Sasaran_Kegiatan_ID` int(11) NOT NULL,
  `Tujuan_ID` int(11) DEFAULT NULL,
  `Isi_Sasaran_Kegiatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `Tujuan_ID` int(11) NOT NULL,
  `Isi_Tujuan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `indikator_kinerja_kegiatan`
--
ALTER TABLE `indikator_kinerja_kegiatan`
  ADD PRIMARY KEY (`Indikator_Kinerja_Kegiatan_ID`),
  ADD KEY `Sasaran_Kegiatan_ID` (`Sasaran_Kegiatan_ID`);

--
-- Indexes for table `indikator_kinerja_sub_kegiatan`
--
ALTER TABLE `indikator_kinerja_sub_kegiatan`
  ADD PRIMARY KEY (`Indikator_Kinerja_Sub_Kegiatan_ID`),
  ADD KEY `Indikator_Kinerja_Kegiatan_ID` (`Indikator_Kinerja_Kegiatan_ID`);

--
-- Indexes for table `indikator_kinerja_unit_kerja`
--
ALTER TABLE `indikator_kinerja_unit_kerja`
  ADD PRIMARY KEY (`indikator_kinerja_unit_kerja_id`),
  ADD KEY `indikator_kinerja_sub_kegiatan_id` (`indikator_kinerja_sub_kegiatan_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`Pengguna_ID`),
  ADD KEY `Role_ID` (`Role_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Role_ID`);

--
-- Indexes for table `sasaran_kegiatan`
--
ALTER TABLE `sasaran_kegiatan`
  ADD PRIMARY KEY (`Sasaran_Kegiatan_ID`),
  ADD KEY `Tujuan_ID` (`Tujuan_ID`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`Tujuan_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `indikator_kinerja_kegiatan`
--
ALTER TABLE `indikator_kinerja_kegiatan`
  ADD CONSTRAINT `indikator_kinerja_kegiatan_ibfk_1` FOREIGN KEY (`Sasaran_Kegiatan_ID`) REFERENCES `sasaran_kegiatan` (`Sasaran_Kegiatan_ID`);

--
-- Constraints for table `indikator_kinerja_sub_kegiatan`
--
ALTER TABLE `indikator_kinerja_sub_kegiatan`
  ADD CONSTRAINT `indikator_kinerja_sub_kegiatan_ibfk_1` FOREIGN KEY (`Indikator_Kinerja_Kegiatan_ID`) REFERENCES `indikator_kinerja_kegiatan` (`Indikator_Kinerja_Kegiatan_ID`);

--
-- Constraints for table `indikator_kinerja_unit_kerja`
--
ALTER TABLE `indikator_kinerja_unit_kerja`
  ADD CONSTRAINT `indikator_kinerja_unit_kerja_ibfk_1` FOREIGN KEY (`indikator_kinerja_sub_kegiatan_id`) REFERENCES `indikator_kinerja_sub_kegiatan` (`Indikator_Kinerja_Sub_Kegiatan_ID`);

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`Role_ID`) REFERENCES `role` (`Role_ID`);

--
-- Constraints for table `sasaran_kegiatan`
--
ALTER TABLE `sasaran_kegiatan`
  ADD CONSTRAINT `sasaran_kegiatan_ibfk_1` FOREIGN KEY (`Tujuan_ID`) REFERENCES `tujuan` (`Tujuan_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
