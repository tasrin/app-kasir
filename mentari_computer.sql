-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2017 at 04:23 AM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mentari_computer`
--

-- --------------------------------------------------------

--
-- Table structure for table `pj_akses`
--

CREATE TABLE IF NOT EXISTS `pj_akses` (
`id_akses` tinyint(1) unsigned NOT NULL,
  `label` varchar(10) NOT NULL,
  `level_akses` varchar(15) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_akses`
--

INSERT INTO `pj_akses` (`id_akses`, `label`, `level_akses`) VALUES
(1, 'admin', 'Administrator'),
(2, 'kasir', 'Staff Kasir'),
(3, 'inventory', 'Staff Inventory'),
(4, 'keuangan', 'Staff Keuangan');

-- --------------------------------------------------------

--
-- Table structure for table `pj_barang`
--

CREATE TABLE IF NOT EXISTS `pj_barang` (
`id_barang` int(1) unsigned NOT NULL,
  `kd_barang` varchar(40) NOT NULL,
  `nama_barang` varchar(60) NOT NULL,
  `jumlah_barang` mediumint(1) unsigned NOT NULL,
  `harga_satuan` decimal(10,0) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_barang`
--

INSERT INTO `pj_barang` (`id_barang`, `kd_barang`, `nama_barang`, `jumlah_barang`, `harga_satuan`, `foto`) VALUES
(1, '0001', 'laptop asus core i3', 8, '3200000', 'file_1511705444.jpg'),
(2, '0002', 'chargin laptop acer', 2, '350000', ''),
(3, '0003', 'audio usb', 12, '35000', ''),
(4, '0004', 'kabel data', 10, '20000', ''),
(5, '0005', 'flashdisk', 18, '60000', ''),
(9, '0009', 'printer canon', 12, '2000000', ''),
(11, '00010', 'lenovo core i3', 1, '4800000', ''),
(12, '00011', 'mouse', 20, '20000', ''),
(13, '00012', 'notebook asus', 7, '2800000', ''),
(14, '00013', 'laptop acer aspire', 7, '4200000', 'file_1511705628.jpg'),
(16, '00018', 'lenovo core i5', 4, '6100000', 'file_1511705762.jpg'),
(27, '0012', 'printer cnon 2770', 6, '1800000', '');

-- --------------------------------------------------------

--
-- Table structure for table `pj_pelanggan`
--

CREATE TABLE IF NOT EXISTS `pj_pelanggan` (
`id_pelanggan` mediumint(1) unsigned NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` text,
  `telp` varchar(40) DEFAULT NULL,
  `info_tambahan` text,
  `kode_unik` varchar(30) NOT NULL,
  `waktu_input` datetime NOT NULL,
  `dihapus` enum('tidak','ya') NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_pelanggan`
--

INSERT INTO `pj_pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`, `info_tambahan`, `kode_unik`, `waktu_input`, `dihapus`) VALUES
(34, 'muh. ali', 'bau-bau', '08134505433', 'pelanggan', '1511958140', '2017-11-29 19:22:20', 'tidak'),
(26, 'mahesa dirga', 'buton mawasangka', '082325507930', 'pelanggan mawasangka', '1511794601', '2017-11-27 21:56:41', 'tidak'),
(25, 'ali', 'buton', '0813838', 'pelanggan dekat', '151168782713', '2017-11-26 16:17:07', 'tidak'),
(24, 'tasrin adiputra', 'jl.rappocini raya lorong 4 no.29 makassar', '082325507930', 'pelanggan terbaik', '15116332702', '2017-11-26 01:07:50', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `pj_penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `pj_penjualan_detail` (
`id_penjualan_d` int(1) unsigned NOT NULL,
  `id_penjualan_m` int(1) unsigned NOT NULL,
  `id_barang` int(1) NOT NULL,
  `jumlah_beli` smallint(1) unsigned NOT NULL,
  `harga_satuan` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_penjualan_detail`
--

INSERT INTO `pj_penjualan_detail` (`id_penjualan_d`, `id_penjualan_m`, `id_barang`, `jumlah_beli`, `harga_satuan`, `total`) VALUES
(49, 34, 8, 1, '999999', '999999'),
(48, 33, 2, 1, '120000', '120000'),
(47, 32, 8, 1, '999999', '999999'),
(46, 31, 13, 1, '3000', '3000'),
(75, 51, 2, 4, '350000', '1400000'),
(65, 46, 13, 1, '3000', '3000'),
(43, 28, 4, 11, '35000', '385000'),
(42, 27, 2, 1, '120000', '120000'),
(74, 50, 2, 1, '350000', '350000'),
(68, 48, 4, 1, '20000', '20000'),
(51, 36, 2, 1, '120000', '120000'),
(52, 37, 11, 1, '30000', '30000'),
(53, 38, 13, 1, '3000', '3000'),
(54, 39, 13, 1, '3000', '3000'),
(67, 48, 5, 2, '60000', '120000'),
(62, 44, 5, 1, '550000', '550000'),
(61, 44, 4, 1, '35000', '35000'),
(73, 50, 1, 1, '3200000', '3200000'),
(59, 42, 2, 1, '120000', '120000'),
(60, 43, 3, 1, '350000', '350000'),
(72, 50, 4, 5, '20000', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `pj_penjualan_master`
--

CREATE TABLE IF NOT EXISTS `pj_penjualan_master` (
`id_penjualan_m` int(1) unsigned NOT NULL,
  `nomor_nota` varchar(40) NOT NULL,
  `tanggal` datetime NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `keterangan_lain` text,
  `id_pelanggan` mediumint(1) unsigned DEFAULT NULL,
  `id_user` mediumint(1) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_penjualan_master`
--

INSERT INTO `pj_penjualan_master` (`id_penjualan_m`, `nomor_nota`, `tanggal`, `grand_total`, `bayar`, `keterangan_lain`, `id_pelanggan`, `id_user`) VALUES
(51, '5A1EE0078D89F1', '2017-11-29 17:27:51', '1400000', '1400000', 'test pelanggan', 26, 1),
(50, '5A1EA9DDB34A11', '2017-11-29 13:36:45', '3650000', '3700000', '', NULL, 1),
(46, '5A1A865FBCA9A13', '2017-11-26 10:16:15', '3000', '5000', 'bagus', 25, 2),
(48, '5A1ACF353ECEB2', '2017-11-26 15:27:01', '140000', '150000', 'langganan', 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id_user` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_akses` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `id_akses`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'centini', 1),
(2, 'tasrin', '1423496d4228b732b5dbe44d02ab07ac', 'fiarni', 2),
(5, 'fikom', '4b97899f8d7aedd313f87027d3c22fcc', 'tasrin adiputra', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pj_akses`
--
ALTER TABLE `pj_akses`
 ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `pj_barang`
--
ALTER TABLE `pj_barang`
 ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pj_pelanggan`
--
ALTER TABLE `pj_pelanggan`
 ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pj_penjualan_detail`
--
ALTER TABLE `pj_penjualan_detail`
 ADD PRIMARY KEY (`id_penjualan_d`);

--
-- Indexes for table `pj_penjualan_master`
--
ALTER TABLE `pj_penjualan_master`
 ADD PRIMARY KEY (`id_penjualan_m`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pj_akses`
--
ALTER TABLE `pj_akses`
MODIFY `id_akses` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pj_barang`
--
ALTER TABLE `pj_barang`
MODIFY `id_barang` int(1) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `pj_pelanggan`
--
ALTER TABLE `pj_pelanggan`
MODIFY `id_pelanggan` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `pj_penjualan_detail`
--
ALTER TABLE `pj_penjualan_detail`
MODIFY `id_penjualan_d` int(1) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `pj_penjualan_master`
--
ALTER TABLE `pj_penjualan_master`
MODIFY `id_penjualan_m` int(1) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
