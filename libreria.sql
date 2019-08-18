-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 09:35 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libreria`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_dosparametro` (IN `xeditorial` VARCHAR(30), IN `xprecio` DECIMAL)  NO SQL
UPDATE libro SET precio=precio+(precio*(xprecio/100))  WHERE editorial= xeditorial$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_unparametro` (IN `xeditorial` VARCHAR(300))  MODIFIES SQL DATA
UPDATE libro SET precio=precio+(precio*0.10)  WHERE editorial= xeditorial$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `editorial` varchar(20) NOT NULL,
  `precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `autor`, `editorial`, `precio`) VALUES
(6, 'Con Stendhal', 'Simon Leys', 'Acantilado', '475.49'),
(29, 'Java', 'Jorge Cardenes', 'RAMA', '50.57'),
(30, 'HTML', 'Jesus Bobadilla', 'Rama', '21.29'),
(31, 'CSS', 'CRISTORFER AUBRY', 'ENI', '45.38'),
(32, 'PROGRAMACION ESTRUCTURADA', 'EDGAR DOMINGUEZ', 'MARCOMBO', '27.99');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nombre` varchar(20) NOT NULL DEFAULT '',
  `nick` varchar(20) NOT NULL DEFAULT '',
  `contrasenia` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `Nombre`, `nick`, `contrasenia`) VALUES
(00000000001, 'fanny', 'fannyrojas', '6c5a7323ae4aaab4a5dc'),
(00000000002, 'fanny', 'fanny.rojas', '5e9cb1018fed6ee1ea8b'),
(00000000003, 'prueba', 'prueba.prueba', '8ac9398a371fb3cd2da5'),
(00000000004, 'pruebauno', 'prueba.uno', '8ac9398a371fb3cd2da5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
