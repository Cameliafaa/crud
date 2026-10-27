-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2026 at 12:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`id_dosen`, `nidn`, `nama_dosen`, `jenis_kelamin`, `alamat`, `no_telp`) VALUES
(1, '001001', 'Budi Santoso, M.Kom', 'L', 'Tangerang', '081234567890'),
(2, '001002', 'Siti Aminah, M.Kom', 'P', 'Jakarta', '081234567891'),
(3, '001003', 'Andi Wijaya, M.Kom', 'L', 'Depok', '081234567892'),
(5, '001004', 'Camelia, S.Kom, M.Kom', 'P', 'Tangerang', '085555555555');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_dosen`, `id_matkul`, `id_semester`, `hari`, `jam_mulai`, `jam_selesai`, `ruangan`) VALUES
(1, 1, 1, 1, 'Senin', '08:00:00', '10:30:00', 'Ruang 101'),
(2, 2, 2, 1, 'Selasa', '09:00:00', '11:30:00', 'Lab Komputer 1'),
(3, 3, 3, 1, 'Rabu', '10:00:00', '12:30:00', 'Lab Komputer 2'),
(4, 1, 4, 1, 'Kamis', '13:00:00', '15:30:00', 'Ruang 102');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_krs`
--

CREATE TABLE `tbl_krs` (
  `id_krs` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tanggal_krs` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_krs`
--

INSERT INTO `tbl_krs` (`id_krs`, `id_mahasiswa`, `id_jadwal`, `tanggal_krs`) VALUES
(1, 1, 1, '2026-09-01'),
(2, 1, 2, '2026-09-01'),
(3, 2, 1, '2026-09-02'),
(4, 2, 3, '2026-09-02'),
(5, 3, 2, '2026-09-03'),
(6, 3, 4, '2026-09-03'),
(7, 4, 1, '2026-09-04'),
(8, 4, 4, '2026-09-04'),
(9, 5, 4, '2026-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`id_mahasiswa`, `nim`, `nama_mahasiswa`, `jenis_kelamin`, `alamat`, `no_telp`) VALUES
(1, '231001', 'Ahmad Fauzi', 'L', 'Tangerang', '081111111111'),
(2, '231002', 'Dewi Lestari', 'P', 'Jakarta', '082222222222'),
(3, '231003', 'Rizky Pratama', 'L', 'Depok', '083333333333'),
(4, '231004', 'Putri Amelia', 'P', 'Bogor', '084444444444'),
(5, '231005', 'Camelia F', 'P', 'Jakarta', '085555555555');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_matkul`
--

CREATE TABLE `tbl_matkul` (
  `id_matkul` int(11) NOT NULL,
  `kode_matkul` varchar(20) NOT NULL,
  `nama_matkul` varchar(100) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_matkul`
--

INSERT INTO `tbl_matkul` (`id_matkul`, `kode_matkul`, `nama_matkul`, `sks`) VALUES
(1, 'MK001', 'Basis Data', 3),
(2, 'MK002', 'Pemrograman Web', 3),
(3, 'MK003', 'Algoritma dan Pemrograman', 3),
(4, 'MK004', 'Jaringan Komputer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester`
--

CREATE TABLE `tbl_semester` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_semester`
--

INSERT INTO `tbl_semester` (`id_semester`, `nama_semester`, `tahun_ajaran`) VALUES
(1, 'Ganjil', '2026/2027'),
(2, 'Genap', '2026/2027');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','dosen','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'dosen01', 'dosen123', 'dosen'),
(3, 'mhs01', 'mhs123', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `nidn` (`nidn`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_jadwal_dosen` (`id_dosen`),
  ADD KEY `fk_jadwal_matkul` (`id_matkul`),
  ADD KEY `fk_jadwal_semester` (`id_semester`);

--
-- Indexes for table `tbl_krs`
--
ALTER TABLE `tbl_krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `fk_krs_mahasiswa` (`id_mahasiswa`),
  ADD KEY `fk_krs_jadwal` (`id_jadwal`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `tbl_matkul`
--
ALTER TABLE `tbl_matkul`
  ADD PRIMARY KEY (`id_matkul`),
  ADD UNIQUE KEY `kode_matkul` (`kode_matkul`);

--
-- Indexes for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_krs`
--
ALTER TABLE `tbl_krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_matkul`
--
ALTER TABLE `tbl_matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `fk_jadwal_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `tbl_dosen` (`id_dosen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `tbl_matkul` (`id_matkul`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_semester` FOREIGN KEY (`id_semester`) REFERENCES `tbl_semester` (`id_semester`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_krs`
--
ALTER TABLE `tbl_krs`
  ADD CONSTRAINT `fk_krs_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `tbl_jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_krs_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
