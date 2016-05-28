-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2016 at 07:24 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `backup`
--

-- --------------------------------------------------------

--
-- Table structure for table `sendingbanklist`
--

CREATE TABLE IF NOT EXISTS `sendingbanklist` (
  `bank_ID` int(11) NOT NULL AUTO_INCREMENT,
  `banklist` varchar(100) NOT NULL,
  `Database` varchar(100) NOT NULL,
  PRIMARY KEY (`bank_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `sendingbanklist`
--

INSERT INTO `sendingbanklist` (`bank_ID`, `banklist`, `Database`) VALUES
(1, 'ACCESS BANK NIGERIA', ''),
(2, 'CHAMS', ''),
(3, 'CORPORETTI', ''),
(4, 'DIAMOND BANK LTD', ''),
(5, 'E-TRANZACT', ''),
(6, 'EARTHOLEUM (QIK QIK)', ''),
(7, 'ECOBANK PLC', ''),
(8, 'ECOBANKMONEY', ''),
(9, 'ENTERPRISE BANK LIMITED', ''),
(10, 'EQUITORIAL TRUST BANK', ''),
(11, 'FBN M-MONEY', ''),
(12, 'FETS (MY WALLET)', ''),
(13, 'FIDELITY BANK PLC', ''),
(14, 'FIRST BANK OF NIGERIA', ''),
(15, 'FIRST CITY MONUMENT', ''),
(16, 'FORTIS MICROFINANCE', ''),
(17, 'GT MOBILE MONEY', ''),
(41, 'GUARANTY TRUST BANK PLC', 'jmtrax'),
(19, 'INTERCONTINENTAL BANK', ''),
(20, 'KEYSTONE BANK LTD', ''),
(21, 'M-KUDI', ''),
(22, 'MAINSTREET BANK LIMITED', ''),
(23, 'MONETIZE', ''),
(24, 'NIGERIA INTL BANK LTD', ''),
(25, 'PARKWAY (READY CASH)', ''),
(26, 'PAYCOM (PAYCOM)', ''),
(27, 'SKYE BANK PLC', ''),
(28, 'STANBIC IBTC', ''),
(29, 'STANBICMONEY', ''),
(30, 'STANDARD CHARTERED BANK', ''),
(31, 'STERLING BANK', ''),
(32, 'U-MO', ''),
(33, 'UBA PLC', ''),
(34, 'UNION BANK', ''),
(35, 'UNITY BANK', ''),
(36, 'WEMA BANK', ''),
(37, 'ZENITH BANK', ''),
(38, 'CITIBANK', ''),
(39, 'HERITAGE BANK', ''),
(42, 'GUARANTY TRUST BANK PLC', 'jmtrax'),
(43, 'ACCESS BANK NIGERIA', 'jmtrax');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
