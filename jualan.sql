-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2018 at 09:05 PM
-- Server version: 5.7.21-0ubuntu0.17.10.1
-- PHP Version: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_produk`, `jumlah`) VALUES
(1, 1, 2),
(1, 2, 3),
(2, 1, 2),
(3, 1, 1),
(4, 1, 1),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pria Dewasa'),
(2, 'Pria Anaka-anak'),
(3, 'Wanita Dewasa'),
(4, 'Wanita Anak-anak');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_member` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_transaksi` int(11) NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_transaksi`, `bukti`) VALUES
(4, 'Screenshot-from-2018-03-01-19-01-19.png'),
(4, 'Screenshot-from-2018-02-26-07:53:55.png'),
(4, 'Screenshot-from-2018-02-26-07:53:55.png'),
(3, 'Screenshot-from-2018-03-01-19-01-19.png'),
(1, 'Screenshot-from-2018-03-08-02-52-08.png'),
(5, 'Screenshot-from-2018-03-08-09-54-31.png');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(30) NOT NULL,
  `password_member` varchar(64) NOT NULL,
  `email_member` varchar(30) NOT NULL,
  `nohp_member` varchar(15) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `password_member`, `email_member`, `nohp_member`, `tgl_daftar`) VALUES
(2, 'Noval Habibi', '467bae90b19ee6eb379a749cb924f726', 'noval@gmail.com', '086714214', '2018-03-04'),
(3, 'Alghi', '202cb962ac59075b964b07152d234b70', 'algi@gmail.com', '1111111', '2018-03-07'),
(4, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '2018-03-13'),
(5, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '2018-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Banten', 20000),
(2, 'Jakarta', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `ringkasan_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `size_produk` int(11) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `id_kategori`, `ringkasan_produk`, `deskripsi_produk`, `harga_produk`, `foto_produk`, `size_produk`, `merk`, `tgl_input`) VALUES
(1, 'Ecosole', 1, 'Ini sepatu bagus', 'akhdajkdbasnsaofsmnxzncss sks', 300000, 'IMG-20180227-WA0009.jpg', 21, 'Adidas', '2018-03-04'),
(2, 'Adidas MEn', 2, 'ini sepati adidas', 'kjfbkjbvnv bvfwegvEgerg\r\nergerg\r\ner\r\nge\r\ng\r\ne\r\ng\r\nerrgerger\r\nergeg', 200000, 'IMG_20180227_091547.jpg', 30, 'Adidas', '2018-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `alamat_kirim` text NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_member`, `alamat_kirim`, `total_bayar`, `tanggal`, `id_ongkir`, `status`) VALUES
(1, 2, 'Rangkas kencana', 1200000, '2018-03-08', 0, 'sudah konfirmasi'),
(2, 2, 'Rangkkkanananna', 600000, '2018-03-08', 0, 'pesan'),
(3, 2, 'wfrwefwgwfwefwe', 300000, '2018-03-08', 0, 'sudah konfirmasi'),
(4, 2, 'bbbbbbbb', 300000, '2018-03-08', 0, 'sudah konfirmasi'),
(5, 2, 'wdwdwdwdwd', 200000, '2018-03-08', 2, 'sudah konfirmasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
