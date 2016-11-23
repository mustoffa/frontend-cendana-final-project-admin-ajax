-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2016 at 10:02 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cendana_mustofa_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
`nip` int(10) unsigned NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenkel` enum('Pria','Wanita') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `jenkel`, `tgl_lahir`, `alamat`) VALUES
(1, 'Mas Yuri', 'Pria', '1989-12-13', 'Malang'),
(2, 'Mas Toni', 'Pria', '1989-12-13', 'Malang');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`id_grade` int(10) unsigned NOT NULL,
  `grade` char(2) NOT NULL,
  `nilai` decimal(3,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id_grade`, `grade`, `nilai`) VALUES
(1, 'A+', '9.50'),
(2, 'A', '9.00'),
(3, 'B+', '8.50'),
(4, 'B', '8.00'),
(5, 'C+', '7.50'),
(6, 'C', '7.00'),
(7, 'D', '6.00'),
(8, 'E', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
`nim` int(10) unsigned NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenkel` enum('Pria','Wanita') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  `jml_sks` int(5) DEFAULT NULL,
  `ipk` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jenkel`, `tgl_lahir`, `alamat`, `jml_sks`, `ipk`) VALUES
(1, 'Mustofa', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(2, 'Tholqha', 'Pria', '1989-12-13', 'Kepanjen', 7, '4.50'),
(3, 'Wawan', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(4, 'Samsul', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(5, 'Dodi', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(6, 'Iksan', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(7, 'Aufar', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(8, 'Hafiz', 'Pria', '1989-12-13', 'Kepanjen', 7, '3.80'),
(9, 'Faiq', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(10, 'Antoni', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(11, 'Redika', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(12, 'Rizal', 'Pria', '1989-12-13', 'Kepanjen', 6, '4.00'),
(16, 'Mukidi', 'Pria', '1990-11-09', 'Surabaya', 14, '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE IF NOT EXISTS `matkul` (
`id_matkul` int(10) unsigned NOT NULL,
  `matkul` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `sks` int(1) NOT NULL,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `matkul`, `kelas`, `ruang`, `sks`, `nip`) VALUES
(1, 'Backend', 'B1', 'Harvard 1', 3, 2),
(2, 'Frontend', 'F1', 'Harvard 2', 3, 1),
(3, 'PHP', 'P1', 'Dortmund', 4, 2),
(4, 'JavaScript', 'J1', 'Turin', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
`id_nilai` int(10) unsigned NOT NULL,
  `id_grade` int(11) NOT NULL DEFAULT '8',
  `id_matkul` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_grade`, `id_matkul`, `nim`, `nip`) VALUES
(1, 1, 1, 1, 2),
(2, 3, 1, 2, 2),
(3, 1, 1, 3, 2),
(4, 1, 1, 4, 2),
(5, 1, 1, 5, 2),
(6, 1, 1, 6, 2),
(7, 1, 1, 7, 2),
(8, 1, 1, 8, 2),
(9, 1, 1, 9, 2),
(10, 1, 1, 10, 2),
(11, 1, 1, 11, 2),
(12, 1, 1, 12, 2),
(13, 1, 2, 1, 1),
(14, 1, 2, 2, 1),
(15, 1, 2, 3, 1),
(16, 1, 2, 4, 1),
(17, 1, 2, 5, 1),
(18, 1, 2, 6, 1),
(19, 1, 2, 7, 1),
(20, 1, 2, 8, 1),
(21, 1, 2, 9, 1),
(22, 1, 2, 10, 1),
(23, 1, 2, 11, 1),
(24, 1, 2, 12, 1),
(25, 2, 3, 1, 2),
(26, 2, 4, 1, 1),
(27, 1, 1, 16, 2),
(28, 2, 2, 16, 1),
(29, 3, 3, 16, 2),
(30, 4, 4, 16, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
 ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`id_grade`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
 ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
 ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD PRIMARY KEY (`id_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
MODIFY `nip` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `id_grade` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
MODIFY `nim` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
MODIFY `id_matkul` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
MODIFY `id_nilai` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
