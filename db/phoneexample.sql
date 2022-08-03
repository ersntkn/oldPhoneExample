-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 03 Ağu 2022, 13:15:11
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `phoneexample`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `key`
--

DROP TABLE IF EXISTS `key`;
CREATE TABLE IF NOT EXISTS `key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyName` varchar(255) NOT NULL,
  `keyValue` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `key`
--

INSERT INTO `key` (`id`, `keyName`, `keyValue`) VALUES
(1, 'A', '21'),
(2, 'B', '22'),
(3, 'C', '23'),
(4, 'D', '31'),
(5, 'E', '32'),
(6, 'F', '33'),
(7, 'G', '41'),
(8, 'H', '42'),
(9, 'I', '43'),
(10, 'J', '51'),
(11, 'K', '52'),
(12, 'L', '53'),
(13, 'M', '61'),
(14, 'N', '62'),
(15, 'O', '63'),
(16, 'P', '71'),
(17, 'Q', '72'),
(18, 'R', '73'),
(19, 'S', '74'),
(20, 'T', '81'),
(21, 'U', '82'),
(22, 'V', '83'),
(23, 'W', '91'),
(24, 'X', '92'),
(25, 'Y', '93'),
(26, 'Z', '94');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
