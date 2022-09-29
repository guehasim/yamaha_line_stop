-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2022 at 10:55 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yamaha_stop_line`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_kategori`
--

CREATE TABLE `detail_kategori` (
  `ID_DetailKategori` int(11) NOT NULL,
  `ID_Kategori` int(11) DEFAULT NULL,
  `NamaDetailKategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_kategori`
--

INSERT INTO `detail_kategori` (`ID_DetailKategori`, `ID_Kategori`, `NamaDetailKategori`) VALUES
(1, 4, 'Material Non Delay'),
(3, 4, 'Material Delay'),
(4, 1, 'Salah Kirim'),
(5, 1, 'Salah Ambil'),
(6, 1, 'Salah'),
(7, 6, 'WW Rusak'),
(8, 6, 'Hand Lamnate Rusak'),
(9, 3, 'Tidak Sesuai'),
(10, 3, 'Sesuai'),
(11, 8, 'Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `import_user_temp`
--

CREATE TABLE `import_user_temp` (
  `ID_User_Temp` int(11) NOT NULL,
  `NikUser_Temp` varchar(255) DEFAULT NULL,
  `NamaUser_Temp` varchar(255) DEFAULT NULL,
  `DeptUser_Temp` varchar(255) DEFAULT NULL,
  `Username_Temp` varchar(255) DEFAULT NULL,
  `PassUser_Temp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `import_user_temp`
--

INSERT INTO `import_user_temp` (`ID_User_Temp`, `NikUser_Temp`, `NamaUser_Temp`, `DeptUser_Temp`, `Username_Temp`, `PassUser_Temp`) VALUES
(13, '1234', 'hasan1', 'gudang', 'hasan1', 'adcd7048512e64b48da55b027577886ee5a36350'),
(14, '1235', 'hasan2', 'produksi', 'hasan2', 'adcd7048512e64b48da55b027577886ee5a36350'),
(15, '1236', 'hasan3', 'coloring', 'hasan3', 'adcd7048512e64b48da55b027577886ee5a36350'),
(16, '1237', 'hasan4', 'packing', 'hasan4', 'adcd7048512e64b48da55b027577886ee5a36350'),
(17, '1238', 'hasan5', 'finishing', 'hasan5', 'adcd7048512e64b48da55b027577886ee5a36350'),
(18, '1239', 'hasan6', 'eksport', 'hasan6', 'adcd7048512e64b48da55b027577886ee5a36350'),
(19, '1240', 'hasan7', 'eksport', 'hasan7', 'adcd7048512e64b48da55b027577886ee5a36350'),
(20, '1241', 'hasan8', 'coloring', 'hasan8', 'adcd7048512e64b48da55b027577886ee5a36350'),
(21, '1242', 'hasan9', 'gudang', 'hasan9', 'adcd7048512e64b48da55b027577886ee5a36350'),
(22, '1243', 'hasan10', 'packing', 'hasan10', 'adcd7048512e64b48da55b027577886ee5a36350'),
(23, '1244', 'hasan11', 'produksi', 'hasan11', 'adcd7048512e64b48da55b027577886ee5a36350'),
(24, '1245', 'hasan12', 'finishing', 'hasan12', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `ID_Kategori` int(11) NOT NULL,
  `NamaKategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`ID_Kategori`, `NamaKategori`) VALUES
(1, 'Man'),
(3, 'Methode'),
(4, 'Material'),
(6, 'Machine'),
(8, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `ID_User` int(11) NOT NULL,
  `NikUser` varchar(255) DEFAULT NULL,
  `NamaUser` varchar(255) DEFAULT NULL,
  `DeptUser` varchar(255) DEFAULT NULL,
  `StatusUser` int(11) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `PassUser` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`ID_User`, `NikUser`, `NamaUser`, `DeptUser`, `StatusUser`, `Username`, `PassUser`) VALUES
(1, '12345', 'administrator', 'administrator', 0, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad'),
(2, NULL, 'hasan', NULL, 0, 'hasan', 'cb081d8c1974f172090dadf5b9a10364072decfd'),
(16, '1234', 'hasan1', 'gudang', 1, 'hasan1', 'adcd7048512e64b48da55b027577886ee5a36350'),
(17, '1235', 'hasan2', 'produksi', 1, 'hasan2', 'adcd7048512e64b48da55b027577886ee5a36350'),
(18, '1236', 'hasan3', 'coloring', 1, 'hasan3', 'adcd7048512e64b48da55b027577886ee5a36350'),
(19, '1237', 'hasan4', 'packing', 1, 'hasan4', 'adcd7048512e64b48da55b027577886ee5a36350'),
(20, '1238', 'hasan5', 'finishing', 1, 'hasan5', 'adcd7048512e64b48da55b027577886ee5a36350'),
(21, '1239', 'hasan6', 'eksport', 1, 'hasan6', 'adcd7048512e64b48da55b027577886ee5a36350'),
(22, '1240', 'hasan7', 'eksport', 1, 'hasan7', 'adcd7048512e64b48da55b027577886ee5a36350'),
(23, '1241', 'hasan8', 'coloring', 1, 'hasan8', 'adcd7048512e64b48da55b027577886ee5a36350'),
(24, '1242', 'hasan9', 'gudang', 1, 'hasan9', 'adcd7048512e64b48da55b027577886ee5a36350'),
(25, '1243', 'hasan10', 'packing', 1, 'hasan10', 'adcd7048512e64b48da55b027577886ee5a36350'),
(26, '1244', 'hasan11', 'produksi', 1, 'hasan11', 'adcd7048512e64b48da55b027577886ee5a36350'),
(27, '1245', 'hasan12', 'finishing', 1, 'hasan12', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `TglNow` date DEFAULT NULL,
  `TglBegin` date DEFAULT NULL,
  `TglAfter` date DEFAULT NULL,
  `ID_User` int(11) DEFAULT NULL,
  `ID_DetailKategori` int(11) DEFAULT NULL,
  `Deskripsi` text,
  `DocBegin` text,
  `Action` text,
  `DocAfter` text,
  `TransStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`ID_Transaksi`, `TglNow`, `TglBegin`, `TglAfter`, `ID_User`, `ID_DetailKategori`, `Deskripsi`, `DocBegin`, `Action`, `DocAfter`, `TransStatus`) VALUES
(7, '2022-09-20', '2022-09-20', '2022-09-21', 27, 3, 'test1', 'ad11a3fa91466d14e03a4af0770f6079.pdf', NULL, NULL, 0),
(8, '2022-09-21', '2022-09-22', '2022-09-23', 26, 9, 'test2', '0fadd6fa08a23043d8fa8d5926e54616.xlsx', NULL, NULL, 0),
(9, '2022-09-18', '2022-09-18', '2022-09-20', 25, 3, 'test3', 'be8f5dc286b3ec705d7b37bab6802af8.pdf', 'okke2', 'e25faf7eacb3018e254ad03a8fb9d50f.xlsx', 1),
(10, '2022-09-19', '2022-09-20', '2022-09-22', 23, 4, 'test4', '5a737a7c7fb6ad11de0f6dacf72f410e.xlsx', NULL, NULL, 0),
(11, '2022-09-20', '2022-09-20', '2022-09-28', 22, 1, 'test5', '61daaf931256d0f4389800d366fc2509.pdf', 'oke1', 'acfd491d2375cca9966f6fb8150da24f.pdf', 1),
(13, '2022-09-25', '2022-09-25', '2022-09-30', 19, 3, 'test', 'fb7aa63a6a9a5dacd6598b4d9127c554.pdf', NULL, NULL, 0),
(14, '2022-09-24', '2022-09-24', '2022-09-29', 20, 8, 'laporan 1', 'f62c65eeb5d3ceed1f4ed186eaf14a6d.pdf', 'sudah ada laporan', 'a379441362ad3ce5854057efac2a1471.xls', 1),
(15, '2022-09-25', '2022-09-27', '2022-10-05', 17, 5, 'laporan salah', '2c29c6ade13a70381693a7a6baf805ee.xls', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_kategori`
--
ALTER TABLE `detail_kategori`
  ADD PRIMARY KEY (`ID_DetailKategori`) USING BTREE;

--
-- Indexes for table `import_user_temp`
--
ALTER TABLE `import_user_temp`
  ADD PRIMARY KEY (`ID_User_Temp`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`ID_Kategori`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_kategori`
--
ALTER TABLE `detail_kategori`
  MODIFY `ID_DetailKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `import_user_temp`
--
ALTER TABLE `import_user_temp`
  MODIFY `ID_User_Temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `ID_Kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
