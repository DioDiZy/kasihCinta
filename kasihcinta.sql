-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 07:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasihcinta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id_Admin` int(5) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donatur`
--

CREATE TABLE `donatur` (
  `Id_Donatur` int(5) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Alamat` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `No_Telepon` varchar(15) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donatur`
--

INSERT INTO `donatur` (`Id_Donatur`, `Nama`, `Alamat`, `Username`, `Email`, `No_Telepon`, `Password`, `otp_code`, `is_verified`) VALUES
(7, 'Novi', 'Banyumas', 'pil', 'novi@cinta.com', '081325165507', '$2y$10$jFyxLWXbyxX2mlKM5mStbevDaxKs8pofEwykNJytaIYyCwTe8JU2K', NULL, 0),
(8, 'aghisna', 'gsaas', 'aghisnaaulia', 'aghisnaaulia@gmail.com', '089', '$2y$10$20v34D97K9TVaseyTTQhs.ZAdclKdtO3nia3HUFRaqO.s1mZiisWe', NULL, 0),
(9, 'aghisna', 'hahsah', 'aghisnaaulia', 'aghisnaauliaaa@gmail.com', '089', '$2y$10$Rz/09TLfmOs.wvPwmrMfsOEd2zksp7B/UHdKIZ6hTpcqfrtx87QHK', NULL, 0),
(10, 'bruce wayne', 'banyumas', 'wayneganteng', 'waynegantengbgt@gmail.com', '000', '$2y$10$U.0YKlZkI6pOxCWhK8di3eFMj1.j8RnDjiDjeqmFZXISrtF1avDPS', NULL, 0),
(11, 'deadpool', 'banyumas', 'deadpoolgtg', 'deadpoolgtg@gmail.com', '000', '$2y$10$Lc/5RB2H6hqif7HGlufF.O/TdaOMhN2Ei/zyAVfskHB1CWJIWOR8q', NULL, 0),
(12, 'ana', 'purwokerto', 'ana123', 'ana123@gmail.com', '08576842021', '$2y$10$IeFe/vjnt9A2qqYk0GHC6uhXSndFyS988Hurg0fj5wI7559WZIS02', NULL, 0),
(13, 'Muhammad Baekhyun', 'purwokerto', 'baekhyun', '2211102325@ittelkom-pwt.ac.id', '081238967780', '$2y$10$j6Ns2uJ2GhGPbIS7FlAYa.tJ9MZsLFlT5sRmIGSQfvzfO6NG3bWfu', NULL, 0),
(14, 'fazaabiyyu', 'kalimanah', 'fazzaabiyyu', 'fazaabiyyu20@gmail.com', '081577181817', '$2y$10$fCRwb.wyFGLZg3Tgmssxk.r/K254.h7aCqxCAQIsqqrZQNQgKik.6', NULL, 0),
(15, 'muhammad ahmes maulana', 'gor satria', 'amesagah1', 'amesagah123@gmail.com', '081427172276', '$2y$10$n5V0ag6dMijhRWEYAztKT.qqlMbVKmve0FdzqVc1Z5HFZVUEm/AXu', NULL, 0),
(16, 'Ojan1@gmail.com', 'manado', 'Ojan', 'Ojan1@gmail.com', '0812345678', '$2y$10$6tQyzCvKcIceAiTrlUrPO.WV23HE7o1Wh9WLRBG7BTRmUzIZnWSAG', NULL, 0),
(24, 'Fairuz Afif', 'Purwokerto', 'afif', 'fairuzafifherdanto@gmail.com', '085290343300', '$2y$10$1cJ.hG38WnVyPckk7v6ht.lMQN.XjJcoy0A1c55eJV0NEOFKT6k52', '638146', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donee`
--

CREATE TABLE `donee` (
  `Id_Donee` int(5) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Alamat` varchar(30) NOT NULL,
  `Deksripsi` text NOT NULL,
  `Foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_donatur` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','success','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_donatur`, `metode_pembayaran`, `jumlah`, `status`, `created_at`) VALUES
(1, 24, 'bank_transfer', 10000.00, 'pending', '2024-12-07 14:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id_Transaksi` int(5) NOT NULL,
  `Id_Donatur` int(5) NOT NULL,
  `Id_Donee` int(5) NOT NULL,
  `Tanggal` date NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Bukti` blob NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_Admin`);

--
-- Indexes for table `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`Id_Donatur`);

--
-- Indexes for table `donee`
--
ALTER TABLE `donee`
  ADD PRIMARY KEY (`Id_Donee`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id_Transaksi`),
  ADD KEY `Id_Donatur` (`Id_Donatur`),
  ADD KEY `Id_Donee` (`Id_Donee`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donatur`
--
ALTER TABLE `donatur`
  MODIFY `Id_Donatur` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`Id_Donatur`) REFERENCES `donatur` (`Id_Donatur`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`Id_Donee`) REFERENCES `donee` (`Id_Donee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
