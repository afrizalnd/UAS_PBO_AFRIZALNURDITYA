-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 06:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti_1d_afrizalnurditya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` decimal(10,2) NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(150) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) DEFAULT NULL,
  `dana_saku_subsidi` decimal(10,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(155) DEFAULT NULL,
  `minimal_ipk_bersyarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_bersyarat`) VALUES
(1, 'Afrizal Nur Ditya', '250102001', 2, '4500000.00', 'Mandiri', 'Golongan 4', 'Slamet Utomo', NULL, NULL, NULL, NULL),
(2, 'Budi Setiawan', '250102002', 2, '5000000.00', 'Mandiri', 'Golongan 5', 'Joko Susilo', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', '250102003', 4, '4500000.00', 'Mandiri', 'Golongan 4', 'Ahmad Dani', NULL, NULL, NULL, NULL),
(4, 'Dimas Pratama', '250102004', 2, '3500000.00', 'Mandiri', 'Golongan 3', 'Heri Cahyono', NULL, NULL, NULL, NULL),
(5, 'Eka Wahyuni', '250102005', 6, '5500000.00', 'Mandiri', 'Golongan 6', 'Supriyanto', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugroho', '250102006', 4, '3500000.00', 'Mandiri', 'Golongan 3', 'Bambang Tejo', NULL, NULL, NULL, NULL),
(7, 'Gita Permata', '250102007', 2, '4500000.00', 'Mandiri', 'Golongan 4', 'Mulyono', NULL, NULL, NULL, NULL),
(8, 'Hendra Wijaya', '250102008', 2, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2026-0091', '700000.00', NULL, NULL),
(9, 'Indah Cahyani', '250102009', 4, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2024-0312', '700000.00', NULL, NULL),
(10, 'Joko Tingkir', '250102010', 2, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2026-1145', '750000.00', NULL, NULL),
(11, 'Kevin Sanjaya', '250102011', 6, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2023-0054', '700000.00', NULL, NULL),
(12, 'Lestari Putri', '250102012', 4, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2024-0982', '700000.00', NULL, NULL),
(13, 'Muhammad Rizky', '250102013', 2, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2026-5521', '750000.00', NULL, NULL),
(14, 'Nadia Utami', '250102014', 2, '0.00', 'Bidikmisi', NULL, NULL, 'KIPK-2026-0711', '700000.00', NULL, NULL),
(15, 'Oki Dermawan', '250102015', 4, '1500000.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Beasiswa Plus', '3.30'),
(16, 'Putri Rahayu', '250102016', 2, '1000000.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa BI (Bank Indonesia)', '3.50'),
(17, 'Qori Ananda', '250102017', 2, '1200000.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', '3.25'),
(18, 'Rizka Amelia', '250102018', 6, '1500000.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Beasiswa Plus', '3.30'),
(19, 'Setyo Nugraha', '250102019', 4, '1000000.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa BI (Bank Indonesia)', '3.50'),
(20, 'Taufik Hidayat', '250102020', 2, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Penuh Pemprov Jateng', '3.40'),
(21, 'Utari Mega', '250102021', 4, '1200000.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', '3.25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
