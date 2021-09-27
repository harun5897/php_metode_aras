-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 07:09 PM
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
(3, 895678, 'Joko', 'Agama', 'Guru Kelas'),
(79, 121212, 'Raisa', 'IT', 'wali_kelas'),
(80, 1212, 'Sukma', 'IT', 'wali_kelas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_history`
--

CREATE TABLE `tb_history` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `date` date NOT NULL,
  `peringkat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_history`
--

INSERT INTO `tb_history` (`id`, `id_guru`, `id_session`, `nilai`, `date`, `peringkat`) VALUES
(103, 79, 1, 0.905, '2021-09-27', 1),
(104, 2, 1, 0.895, '2021-09-27', 2),
(105, 3, 1, 0.844, '2021-09-27', 3),
(106, 1, 1, 0.818, '2021-09-27', 4),
(107, 80, 1, 0.643, '2021-09-27', 5),
(108, 79, 2, 0.905, '2021-09-30', 1),
(109, 2, 2, 0.895, '2021-09-30', 2),
(110, 3, 2, 0.844, '2021-09-30', 3),
(111, 1, 2, 0.818, '2021-09-30', 4),
(112, 80, 2, 0.643, '2021-09-30', 5);

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
(11, 'Absensi', 30, 'benefit', 0, 100),
(12, 'Antusias Siswa', 20, 'benefit', 0, 100),
(13, 'Prestasi', 20, 'benefit', 0, 100),
(14, 'Pendidikan', 15, 'cost', 0, 10),
(15, 'Kepribadian', 15, 'cost', 0, 10);

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
(80, 1, 11, 80),
(81, 1, 12, 75),
(82, 1, 13, 66),
(83, 1, 14, 6),
(84, 1, 15, 6),
(85, 2, 11, 90),
(86, 2, 12, 76),
(87, 2, 13, 75),
(88, 2, 14, 6),
(89, 2, 15, 7),
(90, 3, 11, 70),
(91, 3, 12, 80),
(92, 3, 13, 85),
(93, 3, 14, 7),
(94, 3, 15, 7),
(95, 79, 11, 70),
(96, 79, 12, 95),
(97, 79, 13, 90),
(98, 79, 14, 6),
(99, 79, 15, 7),
(100, 80, 11, 60),
(101, 80, 12, 66),
(102, 80, 13, 50),
(103, 80, 14, 8),
(104, 80, 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(9) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `role`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '12345'),
(2, 'guru1', 'guru1@gmail.com', 'guru', '12345'),
(3, 'guru2', 'guru2@gmail.com', 'guru', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_history`
--
ALTER TABLE `tb_history`
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
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tb_history`
--
ALTER TABLE `tb_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
