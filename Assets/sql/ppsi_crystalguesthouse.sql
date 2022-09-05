-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 04:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppsi_crystalguesthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_reservasi`
--

CREATE TABLE `history_reservasi` (
  `ID_HISTORY_RESERVASI` varchar(10) NOT NULL,
  `HISTORY_NAMA_PEMESAN` varchar(255) DEFAULT NULL,
  `HISTORY_TANGGAL_PEMESANAN` datetime DEFAULT NULL,
  `HISTORY_TANGGAL_CHECK_IN` date DEFAULT NULL,
  `HISTORY_TANGGAL_CHECK_OUT` date DEFAULT NULL,
  `TOTAL_PEMBAYARAN` decimal(65,0) DEFAULT NULL,
  `STATUS_RESERVASI` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_reservasi`
--

INSERT INTO `history_reservasi` (`ID_HISTORY_RESERVASI`, `HISTORY_NAMA_PEMESAN`, `HISTORY_TANGGAL_PEMESANAN`, `HISTORY_TANGGAL_CHECK_IN`, `HISTORY_TANGGAL_CHECK_OUT`, `TOTAL_PEMBAYARAN`, `STATUS_RESERVASI`) VALUES
('CXGCQ58569', 'Laptop Agus', '2021-06-22 13:57:40', '2021-06-22', '2021-06-25', '300000', 'gagal'),
('GCLOM23604', 'ANEKA TAMBANG TPK', '2021-06-27 20:39:20', '2021-06-15', '2021-06-30', '3513630', 'masuk'),
('HAYGQ01288', 'asd', '2021-06-22 13:39:37', '2021-06-23', '2021-06-26', '702726', 'gagal'),
('LIHFR95162', 'Danar', '2021-06-22 13:54:56', '2021-06-22', '2021-06-25', '300000', 'gagal'),
('MPRAO85108', 'Charmanty', '2021-06-22 22:43:35', '2021-06-22', '2021-06-25', '702726', 'masuk'),
('NFUSY62609', 'Laptop Agus', '2021-06-22 13:25:52', '2021-06-22', '2021-06-24', '200000', 'gagal'),
('PTSTE61326', 'Laptop Agus', '2021-06-22 21:27:24', '2021-06-22', '2021-06-23', '100000', 'masuk'),
('SBIBX72100', 'Danar', '2021-06-27 20:33:18', '2021-06-27', '2021-06-29', '468484', 'masuk'),
('SLUEK04111', 'Laptop Agus', '2021-06-22 13:50:51', '2021-06-22', '2021-06-24', '468484', 'gagal'),
('UMZFT74834', 'Laptop Agus', '2021-06-22 21:10:45', '2021-06-22', '2021-06-23', '234242', 'gagal'),
('XYEDP56691', 'Laptop Agus', '2021-06-22 13:41:07', '2021-06-22', '2021-06-24', '200000', 'gagal');

-- --------------------------------------------------------

--
-- Table structure for table `history_tamu`
--

CREATE TABLE `history_tamu` (
  `ID_HISTORY_TAMU` varchar(10) NOT NULL,
  `ID_KAMAR` varchar(10) DEFAULT NULL,
  `ID_HISTORY_RESERVASI` varchar(10) NOT NULL,
  `HISTORY_NAMA_TAMU` varchar(255) DEFAULT NULL,
  `HISTORY_NIK` varchar(16) DEFAULT NULL,
  `HISTORY_NOMOR_TELEPON` varchar(15) DEFAULT NULL,
  `HISTORY_TANGGAL_CHECK_IN` date DEFAULT NULL,
  `HISTORY_TANGGAL_CHECK_OUT` date DEFAULT NULL,
  `HISTORY_DENDA` decimal(65,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_tamu`
--

INSERT INTO `history_tamu` (`ID_HISTORY_TAMU`, `ID_KAMAR`, `ID_HISTORY_RESERVASI`, `HISTORY_NAMA_TAMU`, `HISTORY_NIK`, `HISTORY_NOMOR_TELEPON`, `HISTORY_TANGGAL_CHECK_IN`, `HISTORY_TANGGAL_CHECK_OUT`, `HISTORY_DENDA`) VALUES
('FNRXV30832', 'KM001', 'MPRAO85108', 'Charmanty', '2222222222222222', '083831701929', '2021-06-22', '2021-06-23', '234242'),
('KORQS08981', 'KM002', 'PTSTE61326', 'Laptop Agus', '2222222222222222', '+6283831701929', '2021-06-22', '2021-06-23', '100000'),
('MJLOE38726', 'KM001', 'GCLOM23604', 'ANEKA TAMBANG TPK', '2222222222222222', '083831701929', '2021-06-15', '2021-06-30', '0'),
('PREAP51087', 'KM001', 'SBIBX72100', 'Danar', '2222222222222222', '+6283831701929', '2021-06-27', '2021-06-29', '0');

-- --------------------------------------------------------

--
-- Table structure for table `master_kamar`
--

CREATE TABLE `master_kamar` (
  `ID_KAMAR` varchar(10) NOT NULL,
  `ID_TIPE_KAMAR` varchar(10) DEFAULT NULL,
  `NOMOR_KAMAR` int(11) DEFAULT NULL,
  `DESKRIPSI_KAMAR` varchar(255) DEFAULT NULL,
  `AVAILABILITY` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_kamar`
--

INSERT INTO `master_kamar` (`ID_KAMAR`, `ID_TIPE_KAMAR`, `NOMOR_KAMAR`, `DESKRIPSI_KAMAR`, `AVAILABILITY`) VALUES
('KM001', 'TP00000002', 1, 'di dalam banyak tomcat nya mas', 'A'),
('KM002', 'TP00000001', 2, 'asdafd', 'A'),
('KM003', 'TP00000001', 3, 'di dalam banyak kucing nya mas', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `master_keluhan`
--

CREATE TABLE `master_keluhan` (
  `ID_KELUHAN` varchar(10) NOT NULL,
  `ID_KAMAR` varchar(10) DEFAULT NULL,
  `NAMA_TAMU` varchar(255) DEFAULT NULL,
  `TANGGAL_KELUHAN` date DEFAULT NULL,
  `KELUHAN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_tipe_kamar`
--

CREATE TABLE `master_tipe_kamar` (
  `ID_TIPE_KAMAR` varchar(10) NOT NULL,
  `TIPE_KAMAR` varchar(255) DEFAULT NULL,
  `HARGA_PER_MALAM` decimal(65,0) DEFAULT NULL,
  `DESKRIPSI_TIPE_KAMAR` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_tipe_kamar`
--

INSERT INTO `master_tipe_kamar` (`ID_TIPE_KAMAR`, `TIPE_KAMAR`, `HARGA_PER_MALAM`, `DESKRIPSI_TIPE_KAMAR`) VALUES
('TP00000001', 'Reguler', '100000', 'Nyoba'),
('TP00000002', 'Super Reguler', '234242', 'fsadfasdf'),
('TP00000003', 'Deluxe', '200000', 'Orang nya ngegay');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_sekarang`
--

CREATE TABLE `reservasi_sekarang` (
  `ID_RESERVASI` varchar(10) NOT NULL,
  `ID_USER_GUESTHOUSE` varchar(15) DEFAULT NULL,
  `ID_TIPE_KAMAR` varchar(10) DEFAULT NULL,
  `NAMA_PEMESAN` varchar(255) DEFAULT NULL,
  `NOMOR_TELEPON` varchar(15) DEFAULT NULL,
  `NIK_RESERVASI` varchar(16) DEFAULT NULL,
  `TANGGAL_PEMESANAN` datetime DEFAULT NULL,
  `TANGGAL_CHECK_IN` date DEFAULT NULL,
  `TANGGAL_CHECK_OUT` date DEFAULT NULL,
  `TENGGAT_PEMBAYARAN` datetime DEFAULT NULL,
  `TOTAL_PEMBAYARAN` decimal(65,0) DEFAULT NULL,
  `STATUS_DP` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tamu_sekarang`
--

CREATE TABLE `tamu_sekarang` (
  `ID_TAMU` varchar(10) NOT NULL,
  `ID_HISTORY_RESERVASI` varchar(10) NOT NULL,
  `ID_KAMAR` varchar(10) DEFAULT NULL,
  `NAMA_TAMU` varchar(255) DEFAULT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `NOMOR_TELEPON` varchar(15) DEFAULT NULL,
  `TANGGAL_CHECK_IN` date DEFAULT NULL,
  `TANGGAL_CHECK_OUT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_USER_GUESTHOUSE` varchar(15) NOT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `JABATAN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_USER_GUESTHOUSE`, `PASSWORD`, `JABATAN`) VALUES
('admin', 'admin', 'ADMIN'),
('Danar', 'danar', 'ADMIN'),
('Lila', 'lila', 'ADMIN'),
('Seoyoung', 'seoyoung', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_reservasi`
--
ALTER TABLE `history_reservasi`
  ADD PRIMARY KEY (`ID_HISTORY_RESERVASI`);

--
-- Indexes for table `history_tamu`
--
ALTER TABLE `history_tamu`
  ADD PRIMARY KEY (`ID_HISTORY_TAMU`),
  ADD KEY `FK_HISTORY__HISTORY_N_MASTER_K` (`ID_KAMAR`),
  ADD KEY `FK_HISTORY__TELAH_MEN_HISTORY_` (`ID_HISTORY_RESERVASI`);

--
-- Indexes for table `master_kamar`
--
ALTER TABLE `master_kamar`
  ADD PRIMARY KEY (`ID_KAMAR`),
  ADD KEY `FK_MASTER_K_TIPE_KAMA_MASTER_T` (`ID_TIPE_KAMAR`);

--
-- Indexes for table `master_keluhan`
--
ALTER TABLE `master_keluhan`
  ADD PRIMARY KEY (`ID_KELUHAN`),
  ADD KEY `FK_MASTER_K_RELATIONS_MASTER_K` (`ID_KAMAR`);

--
-- Indexes for table `master_tipe_kamar`
--
ALTER TABLE `master_tipe_kamar`
  ADD PRIMARY KEY (`ID_TIPE_KAMAR`);

--
-- Indexes for table `reservasi_sekarang`
--
ALTER TABLE `reservasi_sekarang`
  ADD PRIMARY KEY (`ID_RESERVASI`),
  ADD KEY `FK_RESERVAS_MENANGANI_USERS` (`ID_USER_GUESTHOUSE`),
  ADD KEY `FK_RESERVAS_PESAN_TIP_MASTER_T` (`ID_TIPE_KAMAR`);

--
-- Indexes for table `tamu_sekarang`
--
ALTER TABLE `tamu_sekarang`
  ADD PRIMARY KEY (`ID_TAMU`),
  ADD KEY `FK_TAMU_SEK_NOMOR_KAM_MASTER_K` (`ID_KAMAR`),
  ADD KEY `FK_TAMU_SEK_RELATIONS_HISTORY_` (`ID_HISTORY_RESERVASI`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER_GUESTHOUSE`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_tamu`
--
ALTER TABLE `history_tamu`
  ADD CONSTRAINT `FK_HISTORY__HISTORY_N_MASTER_K` FOREIGN KEY (`ID_KAMAR`) REFERENCES `master_kamar` (`ID_KAMAR`),
  ADD CONSTRAINT `FK_HISTORY__TELAH_MEN_HISTORY_` FOREIGN KEY (`ID_HISTORY_RESERVASI`) REFERENCES `history_reservasi` (`ID_HISTORY_RESERVASI`);

--
-- Constraints for table `master_kamar`
--
ALTER TABLE `master_kamar`
  ADD CONSTRAINT `FK_MASTER_K_TIPE_KAMA_MASTER_T` FOREIGN KEY (`ID_TIPE_KAMAR`) REFERENCES `master_tipe_kamar` (`ID_TIPE_KAMAR`);

--
-- Constraints for table `master_keluhan`
--
ALTER TABLE `master_keluhan`
  ADD CONSTRAINT `FK_MASTER_K_RELATIONS_MASTER_K` FOREIGN KEY (`ID_KAMAR`) REFERENCES `master_kamar` (`ID_KAMAR`);

--
-- Constraints for table `reservasi_sekarang`
--
ALTER TABLE `reservasi_sekarang`
  ADD CONSTRAINT `FK_RESERVAS_MENANGANI_USERS` FOREIGN KEY (`ID_USER_GUESTHOUSE`) REFERENCES `users` (`ID_USER_GUESTHOUSE`),
  ADD CONSTRAINT `FK_RESERVAS_PESAN_TIP_MASTER_T` FOREIGN KEY (`ID_TIPE_KAMAR`) REFERENCES `master_tipe_kamar` (`ID_TIPE_KAMAR`);

--
-- Constraints for table `tamu_sekarang`
--
ALTER TABLE `tamu_sekarang`
  ADD CONSTRAINT `FK_TAMU_SEK_NOMOR_KAM_MASTER_K` FOREIGN KEY (`ID_KAMAR`) REFERENCES `master_kamar` (`ID_KAMAR`),
  ADD CONSTRAINT `FK_TAMU_SEK_RELATIONS_HISTORY_` FOREIGN KEY (`ID_HISTORY_RESERVASI`) REFERENCES `history_reservasi` (`ID_HISTORY_RESERVASI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
