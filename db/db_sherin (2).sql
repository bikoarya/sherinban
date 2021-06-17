-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2021 at 06:07 AM
-- Server version: 10.4.10-MariaDB-log
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sherin`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_barang`
--

CREATE TABLE `t_barang` (
  `kode_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(125) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `spek` text NOT NULL,
  `harga_jual` bigint(100) NOT NULL,
  `harga_beli` bigint(100) NOT NULL,
  `stok_min` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  `type_exp` enum('0','1') NOT NULL,
  `del` int(1) NOT NULL,
  `q_1` double NOT NULL,
  `pot_1` double NOT NULL,
  `q_2` double NOT NULL,
  `pot_2` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_barang`
--

INSERT INTO `t_barang` (`kode_barang`, `nama_barang`, `id_satuan`, `id_kategori`, `spek`, `harga_jual`, `harga_beli`, `stok_min`, `aktif`, `type_exp`, `del`, `q_1`, `pot_1`, `q_2`, `pot_2`) VALUES
('BR0001', 'test', 17, 6, 'test', 40000, 30000, 1, 'Y', '1', 1, 2, 500, 4, 1500),
('BR0002', 'test2', 17, 6, 'test2', 150000, 50000, 1, 'Y', '0', 1, 2, 10000, 0, 0),
('BR0003', 'kampas kijang korola', 19, 6, 'kampas 16 kijang', 60000, 50000, 1, 'Y', '0', 1, 0, 0, 0, 0),
('BR0004', 'mobil ini warna merah', 17, 6, 'merah mobil ini warna nya gak jelas', 150000, 50000, 1, 'Y', '1', 1, 2, 1500, 4, 5000),
('BR0005', 'mobil ini berwarna merah', 19, 6, 'ini berwarna merah mobil', 600000, 50000, 1, 'Y', '1', 0, 0, 0, 0, 0),
('BR0006', 'kampas kopling belakang', 17, 6, '89238298', 700000, 600000, 1, 'Y', '1', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_jasa`
--

CREATE TABLE `t_jasa` (
  `id_jasa` int(11) NOT NULL,
  `Jasa` varchar(128) NOT NULL,
  `Harga_jasa` int(15) NOT NULL,
  `q_1` double NOT NULL,
  `pot_1` double NOT NULL,
  `q_2` double NOT NULL,
  `pot_2` double NOT NULL,
  `del` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_jasa`
--

INSERT INTO `t_jasa` (`id_jasa`, `Jasa`, `Harga_jasa`, `q_1`, `pot_1`, `q_2`, `pot_2`, `del`) VALUES
(1, 'Cuci mobil', 35000, 0, 0, 2, 3000, 1),
(2, 'Sporing (diskon 50%)', 75000, 1, 500, 0, 0, 1),
(3, 'Cuci ban', 50000, 2, 10000, 0, 0, 1),
(4, 'Cuci karpet', 50000, 2, 10000, 0, 0, 1),
(5, 'test', 50000, 3, 5000, 5, 23400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_kasir`
--

CREATE TABLE `t_kasir` (
  `id_kasir` int(11) NOT NULL,
  `tanggal_kasir` datetime NOT NULL DEFAULT current_timestamp(),
  `no_nota` int(11) NOT NULL,
  `total_pembayaran` bigint(100) NOT NULL,
  `jumlah_uang` bigint(100) NOT NULL,
  `kembalian` bigint(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kode_pelanggan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kasir`
--

INSERT INTO `t_kasir` (`id_kasir`, `tanggal_kasir`, `no_nota`, `total_pembayaran`, `jumlah_uang`, `kembalian`, `keterangan`, `kode_pelanggan`) VALUES
(1, '2020-12-28 14:36:42', 2012280001, 300000, 0, 0, '1', 'PEL0001'),
(2, '2020-12-28 14:38:02', 2012280002, 594000, 0, 0, '1', 'PEL0003'),
(3, '2020-12-28 14:48:25', 2012280003, 594000, 0, 0, '1', 'PEL0003'),
(4, '2020-12-28 14:51:26', 2012280004, 594000, 0, 0, '1', 'PEL0001'),
(5, '2020-12-29 12:46:59', 2012290005, 40000, 0, 0, '1', 'PEL0001'),
(6, '2020-12-29 12:51:38', 2012290006, 150000, 0, 0, '1', 'PEL0001'),
(7, '2020-12-29 12:54:11', 2012290007, 2030000, 0, 0, '1', 'PEL0001');

-- --------------------------------------------------------

--
-- Table structure for table `t_katagori`
--

CREATE TABLE `t_katagori` (
  `id_katagori` int(11) NOT NULL,
  `nama_katagori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_katagori`
--

INSERT INTO `t_katagori` (`id_katagori`, `nama_katagori`) VALUES
(6, 'ban');

-- --------------------------------------------------------

--
-- Table structure for table `t_level`
--

CREATE TABLE `t_level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_level`
--

INSERT INTO `t_level` (`id_level`, `nama_level`) VALUES
(1, 'dev'),
(2, 'superadmin'),
(3, 'mekanik'),
(4, 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `t_mekanik`
--

CREATE TABLE `t_mekanik` (
  `kode_mekanik` varchar(11) NOT NULL,
  `nama_mekanik` varchar(125) NOT NULL,
  `jabatan_mekanik` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_mekanik`
--

INSERT INTO `t_mekanik` (`kode_mekanik`, `nama_mekanik`, `jabatan_mekanik`) VALUES
('M0001', 'UMUM', '-'),
('M0002', 'Saryo', 'Mekanik');

-- --------------------------------------------------------

--
-- Table structure for table `t_nota`
--

CREATE TABLE `t_nota` (
  `id_nota` int(11) NOT NULL,
  `nama_perusahan` varchar(125) NOT NULL,
  `alamat` text NOT NULL,
  `notlpn` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_nota`
--

INSERT INTO `t_nota` (`id_nota`, `nama_perusahan`, `alamat`, `notlpn`) VALUES
(1, 'sherin', 'jl raya', '0');

-- --------------------------------------------------------

--
-- Table structure for table `t_notif_kasir`
--

CREATE TABLE `t_notif_kasir` (
  `id_notif_kasir` int(11) NOT NULL,
  `kode_pelanggan` varchar(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_exp` datetime NOT NULL DEFAULT current_timestamp(),
  `baca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_notif_kasir`
--

INSERT INTO `t_notif_kasir` (`id_notif_kasir`, `kode_pelanggan`, `keterangan`, `tanggal_exp`, `baca`) VALUES
(32, 'PEL0002', 'Servis berkala', '2020-12-25 18:42:28', 0),
(33, 'PEL0002', 'Servis berkala', '2020-12-25 18:42:35', 0),
(34, 'PEL0002', 'Servis berkala', '2020-12-25 18:51:50', 0),
(35, 'PEL0002', 'Servis berkala', '2020-12-27 09:41:56', 0),
(36, 'PEL0003', 'Servis berkala', '2020-12-27 09:44:47', 0),
(37, 'PEL0001', 'Servis berkala', '2021-01-03 14:25:56', 0),
(38, 'PEL0004', 'Servis berkala', '2021-01-07 11:37:09', 0),
(39, 'PEL0005', 'Servis berkala', '2021-01-07 11:40:13', 0),
(40, 'PEL0001', 'Servis berkala', '2021-01-08 11:52:24', 0),
(41, 'PEL0001', 'Servis berkala', '2021-01-10 14:24:53', 0),
(42, 'PEL0001', 'Servis berkala', '2021-01-10 14:25:01', 0),
(43, 'PEL0003', 'Servis berkala', '2021-01-10 14:25:06', 0),
(44, 'PEL0003', 'Servis berkala', '2021-01-14 14:13:46', 0),
(45, 'PEL0001', 'Servis berkala', '2021-01-26 08:21:51', 0),
(46, 'PEL0001', 'Servis berkala', '2021-01-26 09:28:11', 0),
(47, 'PEL0001', 'Servis berkala', '2021-01-26 09:36:45', 0),
(48, 'PEL0001', 'Servis berkala', '2021-01-26 09:56:06', 0),
(49, 'PEL0001', 'Servis berkala', '2021-01-28 14:36:41', 0),
(50, 'PEL0003', 'Servis berkala', '2021-01-28 14:38:02', 0),
(51, 'PEL0003', 'Servis berkala', '2021-01-28 14:48:25', 0),
(52, 'PEL0001', 'Servis berkala', '2021-01-28 14:51:26', 0),
(53, 'PEL0001', 'Servis berkala', '2021-01-29 12:46:59', 0),
(54, 'PEL0001', 'Servis berkala', '2021-01-29 12:51:38', 0),
(55, 'PEL0001', 'Servis berkala', '2021-01-29 12:54:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggan`
--

CREATE TABLE `t_pelanggan` (
  `kode_pelanggan` varchar(11) NOT NULL,
  `nama_pelanggan` varchar(125) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `telepon_pelanggan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pelanggan`
--

INSERT INTO `t_pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `telepon_pelanggan`) VALUES
('PEL0001', 'UMUM', 'jl', '0'),
('PEL0002', 'Insinyur', 'Jln kembang', '089680641487'),
('PEL0003', 'PT. Sumber ABADI BERSAMA', 'jl', '0893434343'),
('PEL0004', 'PT. SINARMAS ABADI', 'jln raya kamboja', '0893434334'),
('PEL0005', 'AHMAD (FORTUNER)', 'jln raya', '0839483984398');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `kode_supplier` varchar(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `kode_produksi_pem` varchar(10) NOT NULL,
  `indikator` varchar(4) NOT NULL,
  `exp` varchar(4) NOT NULL,
  `masa_aktif` varchar(10) NOT NULL,
  `hrg_jual` bigint(100) NOT NULL,
  `hrg_beli` bigint(100) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`id_pembelian`, `tgl_pembelian`, `no_faktur`, `kode_supplier`, `kode_barang`, `kode_produksi_pem`, `indikator`, `exp`, `masa_aktif`, `hrg_jual`, `hrg_beli`, `qty`) VALUES
(1, '2020-12-26', '1321321', 'SUP0001', 'BR0004', '2420', '2550', '2624', '6', 150000, 50000, 50),
(5, '2020-12-28', 'MN232', 'SUP0001', 'BR0004', '2420', '2450', '2524', '5', 150000, 50000, 10),
(6, '2020-12-28', 'Mn 123', 'SUP0001', 'BR0004', '5120', '2477', '2551', '5', 150000, 50000, 16),
(7, '2020-12-29', 'MN 123', 'SUP0001', 'BR0001', '5220', '2478', '2552', '5', 40000, 30000, 20),
(8, '2020-12-29', 'MN 123', 'SUP0001', 'BR0004', '4420', '2470', '2544', '5', 150000, 50000, 6);

--
-- Triggers `t_pembelian`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `t_pembelian` FOR EACH ROW INSERT INTO t_stok SET
kode_barang = NEW.kode_barang,kode_produksi_pem= NEW.kode_produksi_pem, stok = NEW.qty
ON DUPLICATE KEY UPDATE stok = stok + NEW.qty
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `kode_pelanggan` varchar(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `no_faktur` varchar(125) NOT NULL,
  `kode_mekanik` varchar(11) NOT NULL,
  `jumlah_jual` int(20) NOT NULL,
  `kode_produksi_pen` varchar(10) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `harga_jual` bigint(100) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `potongan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`id_penjualan`, `no_nota`, `tgl_penjualan`, `kode_pelanggan`, `kode_barang`, `no_faktur`, `kode_mekanik`, `jumlah_jual`, `kode_produksi_pen`, `no_polisi`, `harga_jual`, `id_jasa`, `potongan`) VALUES
(1, 2012280001, '2020-12-28', 'PEL0001', 'BR0004', '1321321', 'M0002', 1, '2420', 'MN 122', 150000, 0, 0),
(2, 2012280001, '2020-12-28', 'PEL0001', 'BR0004', 'Mn 123', 'M0002', 1, '5120', 'MN 122', 150000, 0, 0),
(3, 2012280002, '2020-12-28', 'PEL0003', 'BR0004', '1321321', 'M0002', 2, '2420', 'MNN', 150000, 0, 1500),
(4, 2012280002, '2020-12-28', 'PEL0003', 'BR0004', 'Mn 123', 'M0002', 2, '5120', 'MNN', 150000, 0, 1500),
(5, 2012280003, '2020-12-28', 'PEL0003', 'BR0004', '1321321', 'M0002', 2, '2420', 'MN 222', 150000, 0, 1500),
(6, 2012280003, '2020-12-28', 'PEL0003', 'BR0004', 'Mn 123', 'M0002', 2, '5120', 'MN 222', 150000, 0, 1500),
(7, 2012280004, '2020-12-28', 'PEL0001', 'BR0004', '1321321', 'M0001', 2, '2420', 'NNNNNN', 150000, 0, 1500),
(8, 2012280004, '2020-12-28', 'PEL0001', 'BR0004', 'Mn 123', 'M0001', 2, '5120', 'NNNNNN', 150000, 0, 1500),
(9, 2012290005, '2020-12-29', 'PEL0001', 'BR0001', 'MN 123', 'M0001', 1, '5220', 'N 023 AS', 40000, 0, 0),
(10, 2012290006, '2020-12-29', 'PEL0001', 'BR0004', 'MN 123', 'M0001', 1, '4420', 'N 333 AS', 150000, 0, 0),
(11, 2012290007, '2020-12-29', 'PEL0001', 'BR0004', 'MN 123', 'M0001', 5, '4420', 'MN AS 333', 150000, 0, 5000),
(12, 2012290007, '2020-12-29', 'PEL0001', 'BR0004', 'Mn 123', 'M0001', 9, '5120', 'MN AS 333', 150000, 0, 5000);

--
-- Triggers `t_penjualan`
--
DELIMITER $$
CREATE TRIGGER `batalpesan` AFTER DELETE ON `t_penjualan` FOR EACH ROW UPDATE t_stok set stok = stok + OLD.jumlah_jual WHERE kode_barang = OLD.kode_barang AND kode_produksi_pem = OLD.kode_produksi_pen
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER INSERT ON `t_penjualan` FOR EACH ROW UPDATE t_stok set stok = stok - NEW.jumlah_jual WHERE kode_barang = NEW.kode_barang AND kode_produksi_pem = NEW.kode_produksi_pen
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualanpending`
--

CREATE TABLE `t_penjualanpending` (
  `id_penjualanpending` int(11) NOT NULL,
  `nofaktur` varchar(11) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(125) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kode_produksi` varchar(5) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `kode_pelanggan` varchar(11) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `kode_mekanik` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_print`
--

CREATE TABLE `t_print` (
  `id_print` int(11) NOT NULL,
  `apikey` varchar(20) NOT NULL,
  `port` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_print`
--

INSERT INTO `t_print` (`id_print`, `apikey`, `port`) VALUES
(1, '1234567890', '1811');

-- --------------------------------------------------------

--
-- Table structure for table `t_retur_pembelian`
--

CREATE TABLE `t_retur_pembelian` (
  `id_retur_pembelian` int(11) NOT NULL,
  `kode_supplier` varchar(11) DEFAULT NULL,
  `tgl_retur` date DEFAULT NULL,
  `no_faktur` varchar(20) DEFAULT NULL,
  `kode_barang` varchar(11) DEFAULT NULL,
  `kode_produksi_pem` varchar(10) DEFAULT NULL,
  `jumlah_retur` double DEFAULT NULL,
  `catatan_retur` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_retur_pembelian`
--

INSERT INTO `t_retur_pembelian` (`id_retur_pembelian`, `kode_supplier`, `tgl_retur`, `no_faktur`, `kode_barang`, `kode_produksi_pem`, `jumlah_retur`, `catatan_retur`) VALUES
(6, 'SUP0001', '2020-12-10', '2222', 'BR0001', '3020', 1, 'wegah'),
(7, 'SUP0001', '2020-12-11', 'MN343', 'BR0004', '4420', 5, 'testing'),
(9, 'SUP0001', '2020-12-19', 'MN343', 'BR0003', '0', 2, 'awdsad'),
(10, 'SUP0001', '2020-12-22', '12343545', 'BR0001', '4120', 10, 'rusak');

-- --------------------------------------------------------

--
-- Table structure for table `t_retur_pengembalian`
--

CREATE TABLE `t_retur_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tgl_pengembalian` date NOT NULL DEFAULT current_timestamp(),
  `id_retur_pembelian` int(11) DEFAULT NULL,
  `kode_supplier` varchar(11) NOT NULL,
  `no_notapembelian` varchar(50) DEFAULT NULL,
  `kode_barang` varchar(11) DEFAULT NULL,
  `kode_produksi` varchar(10) DEFAULT NULL,
  `jumlah_pembelian` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_retur_pengembalian`
--

INSERT INTO `t_retur_pengembalian` (`id_pengembalian`, `tgl_pengembalian`, `id_retur_pembelian`, `kode_supplier`, `no_notapembelian`, `kode_barang`, `kode_produksi`, `jumlah_pembelian`) VALUES
(2, '2020-12-16', 7, 'SUP0001', 'MN343', 'BR0004', '4420', 1),
(3, '2020-12-16', 7, 'SUP0001', 'MN343', 'BR0004', '4420', 2),
(6, '2020-12-19', 7, 'SUP0001', 'MN343', 'BR0004', '4420', 2),
(15, '2020-12-19', 9, 'SUP0001', 'MN343', 'BR0003', '0', 1),
(18, '2020-12-19', 9, 'SUP0001', 'MN343', 'BR0003', '0', 1),
(19, '2020-12-19', 6, 'SUP0001', '2222', 'BR0001', '3020', 1),
(20, '2020-12-22', 10, 'SUP0001', '12343545', 'BR0001', '4120', 5),
(21, '2020-12-22', 10, 'SUP0001', '12343545', 'BR0001', '4120', 5);

-- --------------------------------------------------------

--
-- Table structure for table `t_satuan`
--

CREATE TABLE `t_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_satuan`
--

INSERT INTO `t_satuan` (`id_satuan`, `nama_satuan`) VALUES
(17, 'Pcs'),
(19, 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `t_standart`
--

CREATE TABLE `t_standart` (
  `id_standart` int(11) NOT NULL,
  `nama_standart` varchar(125) NOT NULL,
  `ring_standart` text NOT NULL,
  `bandepan` text NOT NULL,
  `banbelakang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_standart`
--

INSERT INTO `t_standart` (`id_standart`, `nama_standart`, `ring_standart`, `bandepan`, `banbelakang`) VALUES
(66, 'coba', '', 'coba', 'coba');

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `kode_barang` varchar(11) NOT NULL,
  `kode_produksi_pem` varchar(10) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`kode_barang`, `kode_produksi_pem`, `stok`) VALUES
('BR0001', '5220', 19),
('BR0004', '2420', 53),
('BR0004', '4420', 0),
('BR0004', '5120', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_supplier`
--

CREATE TABLE `t_supplier` (
  `kode_supplier` varchar(11) NOT NULL,
  `nama_supplier` varchar(125) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `telepon` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_supplier`
--

INSERT INTO `t_supplier` (`kode_supplier`, `nama_supplier`, `alamat_supplier`, `telepon`) VALUES
('SUP0001', 'Default', 'jln', '0');

-- --------------------------------------------------------

--
-- Table structure for table `t_tmppembelian`
--

CREATE TABLE `t_tmppembelian` (
  `id_tmppembelian` int(11) NOT NULL,
  `kode_barangtmp` varchar(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `price` double NOT NULL,
  `qty` int(20) NOT NULL,
  `kode_produksi` varchar(4) NOT NULL,
  `masa_aktif` varchar(10) NOT NULL,
  `harga_jual` double NOT NULL,
  `satuan` varchar(125) NOT NULL,
  `katagori` varchar(125) NOT NULL,
  `indikator` varchar(125) NOT NULL,
  `exp` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_tmppenjualan`
--

CREATE TABLE `t_tmppenjualan` (
  `id_tmppenjualan` int(11) NOT NULL,
  `nofaktur` varchar(11) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(125) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kode_produksi` varchar(5) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `q_1` double NOT NULL,
  `pot_1` double NOT NULL,
  `q_2` double NOT NULL,
  `pot_2` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `t_tmppenjualan`
--
DELIMITER $$
CREATE TRIGGER `kembalistok` AFTER DELETE ON `t_tmppenjualan` FOR EACH ROW UPDATE t_stok set stok = stok + OLD.qty WHERE kode_barang = OLD.kode_barang AND kode_produksi_pem = OLD.kode_produksi
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatestok` AFTER INSERT ON `t_tmppenjualan` FOR EACH ROW UPDATE t_stok set stok = stok - NEW.qty WHERE kode_barang = NEW.kode_barang AND kode_produksi_pem = NEW.kode_produksi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `nama_lengkap`, `username`, `password`, `id_level`) VALUES
(15, 'superadmin', 'superadmin', '$2y$10$7Aj9VxB3SWWI6wPH3rM7JOo6VHNYcNfOrYeABOPw6gh2rsqxa9vY6', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_vi`
--

CREATE TABLE `t_vi` (
  `id_vi` int(11) NOT NULL,
  `vi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_vi`
--

INSERT INTO `t_vi` (`id_vi`, `vi`) VALUES
(1, 0.5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kasir`
-- (See below for the actual view)
--
CREATE TABLE `v_kasir` (
`no_nota` int(11)
,`tgl_penjualan` date
,`kode_pelanggan` varchar(11)
,`kode_mekanik` varchar(11)
,`no_polisi` varchar(10)
,`keterangan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kdprduksihsl`
-- (See below for the actual view)
--
CREATE TABLE `v_kdprduksihsl` (
`id_pembelian` int(11)
,`tgl_pembelian` date
,`no_faktur` varchar(50)
,`kode_supplier` varchar(11)
,`kode_barang` varchar(11)
,`kode_produksi_pem` varchar(10)
,`indikator` varchar(4)
,`exp` varchar(4)
,`masa_aktif` varchar(10)
,`hrg_jual` bigint(100)
,`hrg_beli` bigint(100)
,`qty` int(20)
,`Stok` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kdproduksi`
-- (See below for the actual view)
--
CREATE TABLE `v_kdproduksi` (
`id_pembelian` int(11)
,`tgl_pembelian` date
,`no_faktur` varchar(50)
,`kode_supplier` varchar(11)
,`kode_barang` varchar(11)
,`kode_produksi_pem` varchar(10)
,`masa_aktif` varchar(10)
,`hrg_jual` bigint(100)
,`hrg_beli` bigint(100)
,`qty` int(20)
,`kdproduksithn` varchar(2)
,`kdproduksimngu` varchar(2)
,`kodeproduksi` varchar(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kdproduksijmlh`
-- (See below for the actual view)
--
CREATE TABLE `v_kdproduksijmlh` (
`id_pembelian` int(11)
,`tgl_pembelian` date
,`no_faktur` varchar(50)
,`kode_supplier` varchar(11)
,`kode_barang` varchar(11)
,`kode_produksi_pem` varchar(10)
,`masa_aktif` varchar(10)
,`hrg_jual` bigint(100)
,`hrg_beli` bigint(100)
,`qty` int(20)
,`kdproduksithn` varchar(2)
,`kdproduksimngu` varchar(2)
,`kodeproduksi` varchar(4)
,`Jumlahkdprd` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kode_produksi`
-- (See below for the actual view)
--
CREATE TABLE `v_kode_produksi` (
`id_pembelian` int(11)
,`tgl_pembelian` date
,`no_faktur` varchar(50)
,`kode_supplier` varchar(11)
,`kode_barang` varchar(11)
,`kode_produksi_pem` varchar(10)
,`masa_aktif` varchar(10)
,`hrg_jual` bigint(100)
,`hrg_beli` bigint(100)
,`qty` int(20)
,`kdproduksithn` varchar(2)
,`kdproduksimngu` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_listpenjualan`
-- (See below for the actual view)
--
CREATE TABLE `v_listpenjualan` (
`id_penjualan` int(11)
,`no_nota` int(11)
,`tgl_penjualan` date
,`kode_pelanggan` varchar(11)
,`kode_barang` varchar(11)
,`no_faktur` varchar(125)
,`kode_mekanik` varchar(11)
,`jumlah_jual` int(20)
,`kode_produksi_pen` varchar(10)
,`no_polisi` varchar(10)
,`harga_jual` bigint(100)
,`id_jasa` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sisa_retur`
-- (See below for the actual view)
--
CREATE TABLE `v_sisa_retur` (
`id_retur` int(11)
,`tgl_pengembalian` date
,`id_pengembalian` int(11)
,`no_notapembelian` varchar(50)
,`kode_barang` varchar(11)
,`kode_produksi` varchar(10)
,`kode_supplier` varchar(11)
,`jumlah_brg_retur` double
,`jumlah_brg_kembali` double
,`Sisa` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tmppembelian`
-- (See below for the actual view)
--
CREATE TABLE `v_tmppembelian` (
`id_tmppembelian` int(11)
,`kode_barangtmp` varchar(11)
,`name` varchar(125)
,`price` double
,`qty` int(20)
,`kode_produksi` varchar(4)
,`masa_aktif` varchar(10)
,`harga_jual` double
,`satuan` varchar(125)
,`katagori` varchar(125)
,`indikator` varchar(125)
,`exp` varchar(125)
,`jmlhqty` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tmppenjualan`
-- (See below for the actual view)
--
CREATE TABLE `v_tmppenjualan` (
`id_tmppenjualan` int(11)
,`nofaktur` varchar(11)
,`kode_barang` varchar(11)
,`nama_barang` varchar(125)
,`satuan` varchar(50)
,`kategori` varchar(50)
,`kode_produksi` varchar(5)
,`harga_jual` int(20)
,`id_jasa` int(11)
,`qty` decimal(32,0)
,`q_1` double
,`q_2` double
,`pot_1` double
,`pot_2` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tmppenjualpot`
-- (See below for the actual view)
--
CREATE TABLE `v_tmppenjualpot` (
`id_tmppenjualan` int(11)
,`nofaktur` varchar(11)
,`kode_barang` varchar(11)
,`nama_barang` varchar(125)
,`satuan` varchar(50)
,`kategori` varchar(50)
,`kode_produksi` varchar(5)
,`harga_jual` int(20)
,`id_jasa` int(11)
,`qty` decimal(32,0)
,`q_1` double
,`q_2` double
,`pot_1` double
,`pot_2` double
,`potongan` double
);

-- --------------------------------------------------------

--
-- Structure for view `v_kasir`
--
DROP TABLE IF EXISTS `v_kasir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kasir`  AS  select `t_penjualan`.`no_nota` AS `no_nota`,`t_penjualan`.`tgl_penjualan` AS `tgl_penjualan`,`t_penjualan`.`kode_pelanggan` AS `kode_pelanggan`,`t_penjualan`.`kode_mekanik` AS `kode_mekanik`,`t_penjualan`.`no_polisi` AS `no_polisi`,`t_kasir`.`keterangan` AS `keterangan` from (`t_penjualan` left join `t_kasir` on(`t_penjualan`.`no_nota` = `t_kasir`.`no_nota`)) group by `t_penjualan`.`no_nota` ;

-- --------------------------------------------------------

--
-- Structure for view `v_kdprduksihsl`
--
DROP TABLE IF EXISTS `v_kdprduksihsl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kdprduksihsl`  AS  select `t_pembelian`.`id_pembelian` AS `id_pembelian`,`t_pembelian`.`tgl_pembelian` AS `tgl_pembelian`,`t_pembelian`.`no_faktur` AS `no_faktur`,`t_pembelian`.`kode_supplier` AS `kode_supplier`,`t_pembelian`.`kode_barang` AS `kode_barang`,`t_pembelian`.`kode_produksi_pem` AS `kode_produksi_pem`,`t_pembelian`.`indikator` AS `indikator`,`t_pembelian`.`exp` AS `exp`,`t_pembelian`.`masa_aktif` AS `masa_aktif`,`t_pembelian`.`hrg_jual` AS `hrg_jual`,`t_pembelian`.`hrg_beli` AS `hrg_beli`,`t_pembelian`.`qty` AS `qty`,`t_stok`.`stok` AS `Stok` from (`t_pembelian` join `t_stok`) where `t_stok`.`kode_barang` = `t_pembelian`.`kode_barang` and `t_stok`.`kode_produksi_pem` = `t_pembelian`.`kode_produksi_pem` and `t_stok`.`stok` > 0 and `t_pembelian`.`kode_produksi_pem` <> 0 group by `t_pembelian`.`kode_barang`,`t_pembelian`.`kode_produksi_pem` order by `t_pembelian`.`exp` ;

-- --------------------------------------------------------

--
-- Structure for view `v_kdproduksi`
--
DROP TABLE IF EXISTS `v_kdproduksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kdproduksi`  AS  select `v_kode_produksi`.`id_pembelian` AS `id_pembelian`,`v_kode_produksi`.`tgl_pembelian` AS `tgl_pembelian`,`v_kode_produksi`.`no_faktur` AS `no_faktur`,`v_kode_produksi`.`kode_supplier` AS `kode_supplier`,`v_kode_produksi`.`kode_barang` AS `kode_barang`,`v_kode_produksi`.`kode_produksi_pem` AS `kode_produksi_pem`,`v_kode_produksi`.`masa_aktif` AS `masa_aktif`,`v_kode_produksi`.`hrg_jual` AS `hrg_jual`,`v_kode_produksi`.`hrg_beli` AS `hrg_beli`,`v_kode_produksi`.`qty` AS `qty`,`v_kode_produksi`.`kdproduksithn` AS `kdproduksithn`,`v_kode_produksi`.`kdproduksimngu` AS `kdproduksimngu`,concat(`v_kode_produksi`.`kdproduksithn`,`v_kode_produksi`.`kdproduksimngu`) AS `kodeproduksi` from `v_kode_produksi` ;

-- --------------------------------------------------------

--
-- Structure for view `v_kdproduksijmlh`
--
DROP TABLE IF EXISTS `v_kdproduksijmlh`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kdproduksijmlh`  AS  select `v_kdproduksi`.`id_pembelian` AS `id_pembelian`,`v_kdproduksi`.`tgl_pembelian` AS `tgl_pembelian`,`v_kdproduksi`.`no_faktur` AS `no_faktur`,`v_kdproduksi`.`kode_supplier` AS `kode_supplier`,`v_kdproduksi`.`kode_barang` AS `kode_barang`,`v_kdproduksi`.`kode_produksi_pem` AS `kode_produksi_pem`,`v_kdproduksi`.`masa_aktif` AS `masa_aktif`,`v_kdproduksi`.`hrg_jual` AS `hrg_jual`,`v_kdproduksi`.`hrg_beli` AS `hrg_beli`,`v_kdproduksi`.`qty` AS `qty`,`v_kdproduksi`.`kdproduksithn` AS `kdproduksithn`,`v_kdproduksi`.`kdproduksimngu` AS `kdproduksimngu`,`v_kdproduksi`.`kodeproduksi` AS `kodeproduksi`,`v_kdproduksi`.`kodeproduksi` + `v_kdproduksi`.`masa_aktif` AS `Jumlahkdprd` from `v_kdproduksi` ;

-- --------------------------------------------------------

--
-- Structure for view `v_kode_produksi`
--
DROP TABLE IF EXISTS `v_kode_produksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kode_produksi`  AS  select `t_pembelian`.`id_pembelian` AS `id_pembelian`,`t_pembelian`.`tgl_pembelian` AS `tgl_pembelian`,`t_pembelian`.`no_faktur` AS `no_faktur`,`t_pembelian`.`kode_supplier` AS `kode_supplier`,`t_pembelian`.`kode_barang` AS `kode_barang`,`t_pembelian`.`kode_produksi_pem` AS `kode_produksi_pem`,`t_pembelian`.`masa_aktif` AS `masa_aktif`,`t_pembelian`.`hrg_jual` AS `hrg_jual`,`t_pembelian`.`hrg_beli` AS `hrg_beli`,`t_pembelian`.`qty` AS `qty`,right(`t_pembelian`.`kode_produksi_pem`,2) AS `kdproduksithn`,left(`t_pembelian`.`kode_produksi_pem`,2) AS `kdproduksimngu` from `t_pembelian` ;

-- --------------------------------------------------------

--
-- Structure for view `v_listpenjualan`
--
DROP TABLE IF EXISTS `v_listpenjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_listpenjualan`  AS  select `t_penjualan`.`id_penjualan` AS `id_penjualan`,`t_penjualan`.`no_nota` AS `no_nota`,`t_penjualan`.`tgl_penjualan` AS `tgl_penjualan`,`t_penjualan`.`kode_pelanggan` AS `kode_pelanggan`,`t_penjualan`.`kode_barang` AS `kode_barang`,`t_penjualan`.`no_faktur` AS `no_faktur`,`t_penjualan`.`kode_mekanik` AS `kode_mekanik`,`t_penjualan`.`jumlah_jual` AS `jumlah_jual`,`t_penjualan`.`kode_produksi_pen` AS `kode_produksi_pen`,`t_penjualan`.`no_polisi` AS `no_polisi`,`t_penjualan`.`harga_jual` AS `harga_jual`,`t_penjualan`.`id_jasa` AS `id_jasa` from `t_penjualan` where `t_penjualan`.`tgl_penjualan` = cast(current_timestamp() as date) ;

-- --------------------------------------------------------

--
-- Structure for view `v_sisa_retur`
--
DROP TABLE IF EXISTS `v_sisa_retur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sisa_retur`  AS  select `t_retur_pengembalian`.`id_retur_pembelian` AS `id_retur`,`t_retur_pengembalian`.`tgl_pengembalian` AS `tgl_pengembalian`,`t_retur_pengembalian`.`id_pengembalian` AS `id_pengembalian`,`t_retur_pengembalian`.`no_notapembelian` AS `no_notapembelian`,`t_retur_pengembalian`.`kode_barang` AS `kode_barang`,`t_retur_pengembalian`.`kode_produksi` AS `kode_produksi`,`t_retur_pembelian`.`kode_supplier` AS `kode_supplier`,`t_retur_pembelian`.`jumlah_retur` AS `jumlah_brg_retur`,sum(`t_retur_pengembalian`.`jumlah_pembelian`) AS `jumlah_brg_kembali`,`t_retur_pembelian`.`jumlah_retur` - sum(`t_retur_pengembalian`.`jumlah_pembelian`) AS `Sisa` from (`t_retur_pembelian` join `t_retur_pengembalian` on(`t_retur_pembelian`.`id_retur_pembelian` = `t_retur_pengembalian`.`id_retur_pembelian`)) group by `t_retur_pengembalian`.`id_retur_pembelian` ;

-- --------------------------------------------------------

--
-- Structure for view `v_tmppembelian`
--
DROP TABLE IF EXISTS `v_tmppembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tmppembelian`  AS  select `t_tmppembelian`.`id_tmppembelian` AS `id_tmppembelian`,`t_tmppembelian`.`kode_barangtmp` AS `kode_barangtmp`,`t_tmppembelian`.`name` AS `name`,`t_tmppembelian`.`price` AS `price`,`t_tmppembelian`.`qty` AS `qty`,`t_tmppembelian`.`kode_produksi` AS `kode_produksi`,`t_tmppembelian`.`masa_aktif` AS `masa_aktif`,`t_tmppembelian`.`harga_jual` AS `harga_jual`,`t_tmppembelian`.`satuan` AS `satuan`,`t_tmppembelian`.`katagori` AS `katagori`,`t_tmppembelian`.`indikator` AS `indikator`,`t_tmppembelian`.`exp` AS `exp`,sum(`t_tmppembelian`.`qty`) AS `jmlhqty` from `t_tmppembelian` group by `t_tmppembelian`.`kode_barangtmp`,`t_tmppembelian`.`kode_produksi` ;

-- --------------------------------------------------------

--
-- Structure for view `v_tmppenjualan`
--
DROP TABLE IF EXISTS `v_tmppenjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tmppenjualan`  AS  select `t_tmppenjualan`.`id_tmppenjualan` AS `id_tmppenjualan`,`t_tmppenjualan`.`nofaktur` AS `nofaktur`,`t_tmppenjualan`.`kode_barang` AS `kode_barang`,`t_tmppenjualan`.`nama_barang` AS `nama_barang`,`t_tmppenjualan`.`satuan` AS `satuan`,`t_tmppenjualan`.`kategori` AS `kategori`,`t_tmppenjualan`.`kode_produksi` AS `kode_produksi`,`t_tmppenjualan`.`harga_jual` AS `harga_jual`,`t_tmppenjualan`.`id_jasa` AS `id_jasa`,sum(`t_tmppenjualan`.`qty`) AS `qty`,`t_tmppenjualan`.`q_1` AS `q_1`,`t_tmppenjualan`.`q_2` AS `q_2`,`t_tmppenjualan`.`pot_1` AS `pot_1`,`t_tmppenjualan`.`pot_2` AS `pot_2` from `t_tmppenjualan` group by `t_tmppenjualan`.`kode_barang`,`t_tmppenjualan`.`kode_produksi` ;

-- --------------------------------------------------------

--
-- Structure for view `v_tmppenjualpot`
--
DROP TABLE IF EXISTS `v_tmppenjualpot`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tmppenjualpot`  AS  select `v_tmppenjualan`.`id_tmppenjualan` AS `id_tmppenjualan`,`v_tmppenjualan`.`nofaktur` AS `nofaktur`,`v_tmppenjualan`.`kode_barang` AS `kode_barang`,`v_tmppenjualan`.`nama_barang` AS `nama_barang`,`v_tmppenjualan`.`satuan` AS `satuan`,`v_tmppenjualan`.`kategori` AS `kategori`,`v_tmppenjualan`.`kode_produksi` AS `kode_produksi`,`v_tmppenjualan`.`harga_jual` AS `harga_jual`,`v_tmppenjualan`.`id_jasa` AS `id_jasa`,`v_tmppenjualan`.`qty` AS `qty`,`v_tmppenjualan`.`q_1` AS `q_1`,`v_tmppenjualan`.`q_2` AS `q_2`,`v_tmppenjualan`.`pot_1` AS `pot_1`,`v_tmppenjualan`.`pot_2` AS `pot_2`,if(`v_tmppenjualan`.`q_2` = 0,if(`v_tmppenjualan`.`qty` >= `v_tmppenjualan`.`q_1`,`v_tmppenjualan`.`pot_1`,0),if(`v_tmppenjualan`.`qty` >= `v_tmppenjualan`.`q_2`,`v_tmppenjualan`.`pot_2`,if(`v_tmppenjualan`.`qty` >= `v_tmppenjualan`.`q_1`,`v_tmppenjualan`.`pot_1`,0))) AS `potongan` from `v_tmppenjualan` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `t_jasa`
--
ALTER TABLE `t_jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `t_kasir`
--
ALTER TABLE `t_kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `t_katagori`
--
ALTER TABLE `t_katagori`
  ADD PRIMARY KEY (`id_katagori`);

--
-- Indexes for table `t_level`
--
ALTER TABLE `t_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `t_mekanik`
--
ALTER TABLE `t_mekanik`
  ADD PRIMARY KEY (`kode_mekanik`);

--
-- Indexes for table `t_nota`
--
ALTER TABLE `t_nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `t_notif_kasir`
--
ALTER TABLE `t_notif_kasir`
  ADD PRIMARY KEY (`id_notif_kasir`);

--
-- Indexes for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `t_penjualanpending`
--
ALTER TABLE `t_penjualanpending`
  ADD PRIMARY KEY (`id_penjualanpending`);

--
-- Indexes for table `t_print`
--
ALTER TABLE `t_print`
  ADD PRIMARY KEY (`id_print`);

--
-- Indexes for table `t_retur_pembelian`
--
ALTER TABLE `t_retur_pembelian`
  ADD PRIMARY KEY (`id_retur_pembelian`);

--
-- Indexes for table `t_retur_pengembalian`
--
ALTER TABLE `t_retur_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `t_satuan`
--
ALTER TABLE `t_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `t_standart`
--
ALTER TABLE `t_standart`
  ADD PRIMARY KEY (`id_standart`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`kode_barang`,`kode_produksi_pem`);

--
-- Indexes for table `t_supplier`
--
ALTER TABLE `t_supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `t_tmppembelian`
--
ALTER TABLE `t_tmppembelian`
  ADD PRIMARY KEY (`id_tmppembelian`);

--
-- Indexes for table `t_tmppenjualan`
--
ALTER TABLE `t_tmppenjualan`
  ADD PRIMARY KEY (`id_tmppenjualan`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `t_vi`
--
ALTER TABLE `t_vi`
  ADD PRIMARY KEY (`id_vi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_jasa`
--
ALTER TABLE `t_jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_kasir`
--
ALTER TABLE `t_kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_katagori`
--
ALTER TABLE `t_katagori`
  MODIFY `id_katagori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_level`
--
ALTER TABLE `t_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_nota`
--
ALTER TABLE `t_nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_notif_kasir`
--
ALTER TABLE `t_notif_kasir`
  MODIFY `id_notif_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_penjualanpending`
--
ALTER TABLE `t_penjualanpending`
  MODIFY `id_penjualanpending` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_print`
--
ALTER TABLE `t_print`
  MODIFY `id_print` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_retur_pembelian`
--
ALTER TABLE `t_retur_pembelian`
  MODIFY `id_retur_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_retur_pengembalian`
--
ALTER TABLE `t_retur_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_standart`
--
ALTER TABLE `t_standart`
  MODIFY `id_standart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `t_tmppembelian`
--
ALTER TABLE `t_tmppembelian`
  MODIFY `id_tmppembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `t_tmppenjualan`
--
ALTER TABLE `t_tmppenjualan`
  MODIFY `id_tmppenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=786;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `t_vi`
--
ALTER TABLE `t_vi`
  MODIFY `id_vi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
