-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 10:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asah_otak`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_kata`
--

CREATE TABLE `master_kata` (
  `id` int(11) NOT NULL,
  `kata` varchar(255) NOT NULL,
  `clue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_kata`
--

INSERT INTO `master_kata` (`id`, `kata`, `clue`) VALUES
(1, 'LEMARI', 'Tempat menyimpan pakaian'),
(2, 'KASUR', 'Tempat tidur yang nyaman'),
(3, 'PISANG', 'Buah berwarna kuning'),
(4, 'KOMPUTER', 'Alat untuk bekerja atau bermain game'),
(5, 'MEJA', 'Tempat untuk menulis atau bekerja'),
(6, 'TELEVISI', 'Alat untuk menonton berbagai acara'),
(7, 'PENSIL', 'Alat untuk menulis'),
(8, 'BUKU', 'Kumpulan lembaran kertas berisi tulisan'),
(9, 'JENDELA', 'Alat untuk melihat keluar ruangan'),
(10, 'KIPAS', 'Alat untuk menghasilkan angin');

-- --------------------------------------------------------

--
-- Table structure for table `point_game`
--

CREATE TABLE `point_game` (
  `id_point` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `total_point` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `point_game`
--

INSERT INTO `point_game` (`id_point`, `nama_user`, `total_point`) VALUES
(1, 'Axel', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_kata`
--
ALTER TABLE `master_kata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_game`
--
ALTER TABLE `point_game`
  ADD PRIMARY KEY (`id_point`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_kata`
--
ALTER TABLE `master_kata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `point_game`
--
ALTER TABLE `point_game`
  MODIFY `id_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
