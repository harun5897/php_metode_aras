-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 02:32 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aras`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int(9) NOT NULL,
  `nip` int(8) DEFAULT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id`, `nip`, `nama_guru`, `bidang`, `jabatan`) VALUES
(1, 112233, 'Budi', 'TIK', 'wali_kelas'),
(2, 321435, 'Novi', 'TIK', 'Kepla Sekolah'),
(3, 895678, 'Joko', 'Agama', 'Guru Kelas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id` int(9) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` int(9) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `nilai_min` int(11) NOT NULL,
  `nilai_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id`, `nama_kriteria`, `bobot`, `jenis`, `nilai_min`, `nilai_max`) VALUES
(11, 'Disiplin', 20, 'benefit', 50, 90),
(12, 'Prestasi', 20, 'benefit', 1, 4),
(13, 'Pendidikan Terakhir', 25, 'benefit', 1, 3),
(14, 'Kompetensi', 15, 'benefit', 10, 90),
(15, 'Kepribadian', 10, 'cost', 10, 90);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id` int(9) NOT NULL,
  `id_guru` int(9) NOT NULL,
  `id_kriteria` int(9) NOT NULL,
  `nilai` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id`, `id_guru`, `id_kriteria`, `nilai`) VALUES
(54, 1, 11, 80),
(55, 1, 12, 4),
(56, 1, 13, 2),
(57, 1, 14, 67),
(58, 2, 11, 80),
(59, 3, 11, 90),
(60, 1, 15, 90),
(61, 3, 12, 4),
(62, 2, 12, 4),
(63, 2, 13, 2),
(64, 2, 14, 80),
(65, 2, 15, 80),
(66, 3, 14, 90),
(67, 3, 15, 90),
(68, 3, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(9) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
