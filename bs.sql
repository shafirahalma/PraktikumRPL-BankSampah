-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.9.2-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bs
DROP DATABASE IF EXISTS `bs`;
CREATE DATABASE IF NOT EXISTS `bs` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bs`;

-- Dumping structure for table bs.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `notelepon` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bs.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`username`, `nama`, `notelepon`, `password`) VALUES
	('arneizha', 'Arneizha', '081805285406', 'arn123'),
	('shafira', 'Shafira', '081234567890', 'sha123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table bs.nasabah
DROP TABLE IF EXISTS `nasabah`;
CREATE TABLE IF NOT EXISTS `nasabah` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table bs.nasabah: ~2 rows (approximately)
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;
REPLACE INTO `nasabah` (`username`, `nama`, `alamat`, `telepon`, `email`, `password`, `saldo`) VALUES
	('adam', 'adam', 'Merjosari', '087884273699', 'adambadruzs@gmail.com', '123', 71000),
	('piraa', 'piraa', 'Arumdalu', '087884273699', 'shafira@gmail.com', '123', 190000);
/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;

-- Dumping structure for table bs.sampah
DROP TABLE IF EXISTS `sampah`;
CREATE TABLE IF NOT EXISTS `sampah` (
  `ID_sampah` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(50) NOT NULL DEFAULT '',
  `satuan` varchar(50) NOT NULL DEFAULT '',
  `harga` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID_sampah`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table bs.sampah: ~7 rows (approximately)
/*!40000 ALTER TABLE `sampah` DISABLE KEYS */;
REPLACE INTO `sampah` (`ID_sampah`, `jenis`, `satuan`, `harga`) VALUES
	(1, 'Kaleng', 'Kg', 5000),
	(2, 'Kertas', 'Kg', 2500),
	(3, 'Sampah Plastik', 'Kg', 3000),
	(4, 'Botol Kaca', 'Kg', 5000),
	(5, 'Kaca', 'Kg', 7000),
	(6, 'Besi', 'Kg', 10000),
	(7, 'Logam', 'Kg', 10000);
/*!40000 ALTER TABLE `sampah` ENABLE KEYS */;

-- Dumping structure for table bs.t_setor
DROP TABLE IF EXISTS `t_setor`;
CREATE TABLE IF NOT EXISTS `t_setor` (
  `ID_setor` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ID_sampah` int(11) NOT NULL DEFAULT 0,
  `berat` int(11) NOT NULL DEFAULT 0,
  `saldopendapatan` int(11) NOT NULL DEFAULT 0,
  `admin` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_setor`),
  KEY `FK_t_setor_sampah` (`ID_sampah`),
  KEY `FK_t_setor_nasabah` (`username`),
  KEY `FK_t_setor_admin` (`admin`),
  CONSTRAINT `FK_t_setor_admin` FOREIGN KEY (`admin`) REFERENCES `admin` (`username`),
  CONSTRAINT `FK_t_setor_nasabah` FOREIGN KEY (`username`) REFERENCES `nasabah` (`username`),
  CONSTRAINT `FK_t_setor_sampah` FOREIGN KEY (`ID_sampah`) REFERENCES `sampah` (`ID_sampah`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table bs.t_setor: ~5 rows (approximately)
/*!40000 ALTER TABLE `t_setor` DISABLE KEYS */;
REPLACE INTO `t_setor` (`ID_setor`, `tanggal`, `username`, `ID_sampah`, `berat`, `saldopendapatan`, `admin`) VALUES
	(1, '2023-06-10', 'adam', 1, 10, 50000, 'arneizha'),
	(2, '2023-06-10', 'adam', 2, 10, 25000, 'shafira'),
	(3, '2023-06-16', 'piraa', 4, 10, 50000, 'arneizha'),
	(4, '2023-06-09', 'piraa', 1, 10, 50000, 'arneizha'),
	(5, '2023-06-10', 'piraa', 6, 10, 100000, 'shafira');
/*!40000 ALTER TABLE `t_setor` ENABLE KEYS */;

-- Dumping structure for table bs.t_tarik
DROP TABLE IF EXISTS `t_tarik`;
CREATE TABLE IF NOT EXISTS `t_tarik` (
  `ID_tarik` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `saldoawal` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `sisa` int(11) DEFAULT NULL,
  `admin` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_tarik`),
  KEY `FK_t_tarik_nasabah` (`username`),
  KEY `FK_t_tarik_admin` (`admin`),
  CONSTRAINT `FK_t_tarik_admin` FOREIGN KEY (`admin`) REFERENCES `admin` (`username`),
  CONSTRAINT `FK_t_tarik_nasabah` FOREIGN KEY (`username`) REFERENCES `nasabah` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table bs.t_tarik: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_tarik` DISABLE KEYS */;
REPLACE INTO `t_tarik` (`ID_tarik`, `tanggal`, `username`, `saldoawal`, `jumlah`, `sisa`, `admin`) VALUES
	(2, '2023-06-12', 'piraa', 198000, 4000, 194000, 'arneizha'),
	(3, '2023-06-10', 'piraa', 190000, 2000, 188000, 'shafira');
/*!40000 ALTER TABLE `t_tarik` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
