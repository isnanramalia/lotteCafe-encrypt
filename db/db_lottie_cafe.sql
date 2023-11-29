-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2023 at 03:54 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lottie_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nm_karyawan` varchar(30) DEFAULT NULL,
  `noTlp` varchar(15) DEFAULT NULL,
  `jabatan` enum('Admin','Kasir') DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nm_karyawan`, `noTlp`, `jabatan`, `username`, `pass`) VALUES
(1, 'Cakra', '081272176833', 'Admin', 'cakra', '2a7d24a81b94a7d9d998d25994128c93'),
(2, 'Rizkia', '081677899013', 'Admin', 'rizkia', '11477926f44f4a85199b3c8b03cb481f'),
(3, 'Mamat', '081677899011', 'Kasir', 'mamat', '24b65fcef95d94b6d41ecaa85a70e46f'),
(6, 'Ishkhan', '081677899011', 'Kasir', 'ishkhan', '7e41a02dafdfddf0ee8189f75ccf7e3a'),
(9, 'Jasmine', '081677899013', 'Kasir', 'jasmine', 'f21c0d3e564c7db5ccf73c095a0b9371');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nm_menu` varchar(20) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nm_menu`, `harga`, `deskripsi`, `stok`, `tgl_input`) VALUES
(2, 'Green Tea', 10000, 'Teh hijau', 8, '2022-07-14 05:40:11'),
(5, 'Pisang goreng', 8000, 'Rasa cokelat keju', 34, '2022-07-14 05:41:04'),
(6, 'Roti bakar', 15000, 'Rasa cokelat enak', 39, '2022-07-14 05:41:51'),
(7, 'Nachos', 25000, 'Nachos keripik jagung', 27, '2022-07-14 05:42:37'),
(8, 'Espresso', 12000, 'Kopi pahit', 35, '2022-07-15 11:37:53'),
(9, 'Macchiato', 15000, 'Kopi espresso + susu', 50, '2022-07-15 11:38:37'),
(10, 'Latte', 15000, 'Kopi foam dengan susu', 38, '2022-07-15 11:39:17'),
(11, 'Cappucino', 14000, 'Kopi espresso dengan susu dan froth susu', 25, '2022-07-15 11:41:23'),
(12, 'Mocca', 25000, 'Kopi dengan campuran espresso, susu, dan coklat', 56, '2022-07-15 11:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `invoice` varchar(15) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `nm_karyawan` varchar(30) DEFAULT NULL,
  `nm_pelanggan` varchar(30) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `nm_menu` varchar(30) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `invoice`, `tgl`, `nm_karyawan`, `nm_pelanggan`, `id_menu`, `nm_menu`, `harga`, `jumlah`, `total`) VALUES
(2, 'INV/20220712560', '2022-07-15 04:06:04', 'Cakra', 'Aldi', 6, 'Roti bakar', 15000, 2, 30000),
(5, 'INV/20220712374', '2022-07-15 10:52:57', 'Jasmine', 'Habib', 7, 'Nachos', 25000, 2, 50000),
(12, 'INV/20220714051', '2022-07-15 11:31:32', 'Jasmine', 'Adara', 2, 'Green Tea', 10000, 1, 10000),
(21, 'INV/20220714081', '2022-07-15 11:26:25', 'Ishkhan', 'Wira', 2, 'Green Tea', 10000, 1, 10000),
(24, 'INV/20220715031', '2022-07-15 11:25:42', 'Ishkhan', 'Tiraa', 6, 'Roti bakar', 15000, 1, 15000),
(25, 'INV/20220715062', '2022-07-15 04:05:39', 'Cakra', 'Tiara', 7, 'Nachos', 25000, 2, 50000),
(29, 'INV/20220721030', '2022-07-21 07:18:08', 'Cakra', 't', 5, 'Pisang goreng', 8000, 1, 8000);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok_menu` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
	UPDATE menu SET stok = stok - NEW.jumlah
    WHERE id_menu = NEW.id_menu;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_karyawan` (`nm_karyawan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
