-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2019 at 05:11 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

DELIMITER$$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sto_tambahProduk` (`proid` varchar(40),`pronama` VARCHAR(200), `proharga` FLOAT, `projumlah` BIGINT, `protanggal` DATETIME, `prosupplier` VARCHAR(200))  BEGIN
	insert into produk (proid,pronama,proharga,projumlah,protanggal,prosupplier) values (proid,pronama,proharga,projumlah,protanggal,prosupplier);
    END $$

DELIMITER ;

-- drop procedure `sto_tambahProduk`;
-- CALL sto_tambahProduk('ff',120,120,'2021-10-22 20:23:51','dsd');
-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `proid` varchar(40) NOT NULL,
  `pronama` varchar(200) DEFAULT NULL,
  `projumlah` bigint(20) DEFAULT NULL,
  `proharga` float DEFAULT NULL,
  `protanggal` datetime DEFAULT NULL,
  `prosupplier` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- drop table `produk`;
--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`proid`, `pronama`, `projumlah`, `proharga`, `protanggal`, `prosupplier`) VALUES
(2, 'Keyboard Logitech', 6, 100000, '2021-10-22 12:20:01', 'logitech'),
(3, 'Layar', 2, 500000, '2021-10-23 12:20:02', 'sinarmas'),
(4, 'Mouse Baru', 10, 100000, '2021-10-24 12:20:03', 'rexus');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `trafaktur` varchar(200) NOT NULL,
  `tratanggal` date DEFAULT NULL,
  `trapelanggan` varchar(200) DEFAULT NULL,
  `tratotal` float DEFAULT NULL,
  `userid` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`trafaktur`, `tratanggal`, `trapelanggan`, `tratotal`, `userid`) VALUES
('TRA0001', '2019-03-02', 'saif alikhan', 600000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `tdid` varchar(40) NOT NULL,
  `trafaktur` varchar(200) DEFAULT NULL,
  `proid` varchar(40) DEFAULT NULL,
  `tdjumlah` bigint(20) DEFAULT NULL,
  `tdharga` float DEFAULT NULL,
  `tdsubtotal` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- drop table `transaksi_detail`;
--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`tdid`, `trafaktur`, `proid`, `tdjumlah`, `tdharga`, `tdsubtotal`) VALUES
('TDIDc9944ba0dba641724f6a28e850dc5882', 'TRA0001', 2, 1, 100000, 100000),
('TDIDc9944ba0dba641724f6a28v850rc5882', 'TRA0001', 3, 1, 500000, 500000);

--
-- Triggers `transaksi_detail`
--
DELIMITER $$
CREATE TRIGGER `tg_order` AFTER INSERT ON `transaksi_detail` FOR EACH ROW BEGIN
	update produk set projumlah=projumlah-new.tdjumlah where proid=new.proid;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` bigint(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `userpass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `userpass`) VALUES
(1, 'admin', 'admin'),
(2, 'a', 'a');

-- --------------------------------------------------------
--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`proid`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`trafaktur`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`tdid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--

--
-- AUTO_INCREMENT for table `transaksi_detail`
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Tiap Mingguan
SELECT DAY(tratanggal) AS hari, SUM(tratotal) AS omset
FROM transaksi
WHERE YEARWEEK(tratanggal)=YEARWEEK(NOW())
GROUP BY DAY(tratanggal)
ORDER BY hari;

-- Tiap Bulanan
SELECT DAY(tratanggal) AS hari, SUM(tratotal) AS omset
FROM transaksi
WHERE MONTH(tratanggal)=MONTH(NOW())
GROUP BY DAY(tratanggal)
ORDER BY hari;

-- Satu Tahun
SELECT MONTH(tratanggal) AS bulan, SUM(tratotal) AS omset
FROM transaksi
WHERE YEAR(tratanggal)=YEAR(NOW())
GROUP BY MONTH(tratanggal)
ORDER BY bulan;


select sum(tratotal) from transaksi t where month (tratanggal) = 10 and year(tratanggal) = 2021

TRUNCATE TABLE produk;
TRUNCATE TABLE transaksi;
TRUNCATE TABLE transaksi_detail;