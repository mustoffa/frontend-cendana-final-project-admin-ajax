-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2016 at 07:47 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
  `nim` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_grade`, `id_matkul`, `nim`) VALUES
(1, 1, 1, 1),
(2, 3, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 1, 1, 5),
(6, 1, 1, 6),
(7, 1, 1, 7),
(8, 1, 1, 8),
(9, 1, 1, 9),
(10, 1, 1, 10),
(11, 1, 1, 11),
(12, 1, 1, 12),
(13, 1, 2, 1),
(14, 1, 2, 2),
(15, 1, 2, 3),
(16, 1, 2, 4),
(17, 1, 2, 5),
(18, 1, 2, 6),
(19, 1, 2, 7),
(20, 1, 2, 8),
(21, 1, 2, 9),
(22, 1, 2, 10),
(23, 1, 2, 11),
(24, 1, 2, 12),
(25, 2, 3, 1),
(26, 2, 4, 1),
(27, 1, 1, 16),
(28, 2, 2, 16),
(29, 3, 3, 16),
(30, 4, 4, 16);

-- --------------------------------------------------------

--
-- Stand-in structure for view `show_matkul`
--
CREATE TABLE IF NOT EXISTS `show_matkul` (
`id_matkul` int(10) unsigned
,`matkul` varchar(50)
,`kelas` varchar(50)
,`ruang` varchar(50)
,`sks` int(1)
,`nip` int(11)
,`nama` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `show_nilai`
--
CREATE TABLE IF NOT EXISTS `show_nilai` (
`id_nilai` int(10) unsigned
,`id_grade` int(11)
,`id_matkul` int(11)
,`nim` int(11)
,`nama_mhs` varchar(50)
,`matkul` varchar(50)
,`kelas` varchar(50)
,`ruang` varchar(50)
,`sks` int(1)
,`grade` char(2)
,`nama_dosen` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama_user`) VALUES
(1, 'admin', 'admin', 'Mustofa');

-- --------------------------------------------------------

--
-- Structure for view `show_matkul`
--
DROP TABLE IF EXISTS `show_matkul`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `show_matkul` AS select `matkul`.`id_matkul` AS `id_matkul`,`matkul`.`matkul` AS `matkul`,`matkul`.`kelas` AS `kelas`,`matkul`.`ruang` AS `ruang`,`matkul`.`sks` AS `sks`,`matkul`.`nip` AS `nip`,`dosen`.`nama` AS `nama` from (`matkul` join `dosen`) where (`matkul`.`nip` = `dosen`.`nip`);

-- --------------------------------------------------------

--
-- Structure for view `show_nilai`
--
DROP TABLE IF EXISTS `show_nilai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `show_nilai` AS select `nilai`.`id_nilai` AS `id_nilai`,`nilai`.`id_grade` AS `id_grade`,`nilai`.`id_matkul` AS `id_matkul`,`nilai`.`nim` AS `nim`,`mahasiswa`.`nama` AS `nama_mhs`,`matkul`.`matkul` AS `matkul`,`matkul`.`kelas` AS `kelas`,`matkul`.`ruang` AS `ruang`,`matkul`.`sks` AS `sks`,`grade`.`grade` AS `grade`,`dosen`.`nama` AS `nama_dosen` from ((((`nilai` join `mahasiswa`) join `matkul`) join `grade`) join `dosen`) where ((`nilai`.`nim` = `mahasiswa`.`nim`) and (`nilai`.`id_matkul` = `matkul`.`id_matkul`) and (`nilai`.`id_grade` = `grade`.`id_grade`) and (`matkul`.`nip` = `dosen`.`nip`));

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
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

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
MODIFY `nim` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
MODIFY `id_matkul` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
MODIFY `id_nilai` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
