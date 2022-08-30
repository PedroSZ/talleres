-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2021 at 09:16 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taller`
--

-- --------------------------------------------------------

--
-- Table structure for table `asistencias`
--

CREATE TABLE `asistencias` (
  `estudiante` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cambio`
--

CREATE TABLE `cambio` (
  `No` int(11) NOT NULL,
  `taller_actual` int(11) NOT NULL,
  `taller_elegido` int(11) DEFAULT NULL,
  `estudiante` varchar(20) DEFAULT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cambio`
--


--
-- Table structure for table `docente_supervisor`
--

CREATE TABLE `docente_supervisor` (
  `rfc` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellidos` varchar(30) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `telefono` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente_supervisor`
--


--
-- Table structure for table `estudiante`
--

CREATE TABLE `estudiante` (
  `curp` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellidos` varchar(30) DEFAULT NULL,
  `carrera` varchar(50) DEFAULT NULL,
  `grado` int(11) DEFAULT NULL,
  `grupo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estudiante`
--

--
-- Table structure for table `estudiante_por_taller`
--

CREATE TABLE `estudiante_por_taller` (
  `id` int(11) NOT NULL,
  `estudiante` varchar(20) DEFAULT NULL,
  `taller` int(11) DEFAULT NULL,
  `total_asistencias` int(11) DEFAULT NULL,
  `evaluacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estudiante_por_taller`
--



--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `clave` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellidos` varchar(30) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `telefono` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--



--
-- Table structure for table `reporte`
--

CREATE TABLE `reporte` (
  `clave` int(20) NOT NULL,
  `titulo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `autor` varchar(20) DEFAULT NULL,
  `reportado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reporte`
--


--
-- Table structure for table `taller`
--

CREATE TABLE `taller` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `area` varchar(30) DEFAULT NULL,
  `horario` varchar(20) DEFAULT NULL,
  `instructor` varchar(20) DEFAULT NULL,
  `supervisor` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taller`
--


--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `user_name` varchar(20) NOT NULL,
  `pasword` varchar(200) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`user_name`, `pasword`, `tipo`) VALUES

('admin', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`estudiante`);

--
-- Indexes for table `cambio`
--
ALTER TABLE `cambio`
  ADD PRIMARY KEY (`No`),
  ADD KEY `estudiante` (`estudiante`);

--
-- Indexes for table `docente_supervisor`
--
ALTER TABLE `docente_supervisor`
  ADD PRIMARY KEY (`rfc`);

--
-- Indexes for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`curp`);

--
-- Indexes for table `estudiante_por_taller`
--
ALTER TABLE `estudiante_por_taller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante` (`estudiante`),
  ADD KEY `taller` (`taller`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`clave`);

--
-- Indexes for table `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `reportado` (`reportado`),
  ADD KEY `autor` (`autor`);

--
-- Indexes for table `taller`
--
ALTER TABLE `taller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor` (`instructor`),
  ADD KEY `supervisor` (`supervisor`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cambio`
--
ALTER TABLE `cambio`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `estudiante_por_taller`
--
ALTER TABLE `estudiante_por_taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `reporte`
--
ALTER TABLE `reporte`
  MODIFY `clave` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `taller`
--
ALTER TABLE `taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cambio`
--
ALTER TABLE `cambio`
  ADD CONSTRAINT `cambio_ibfk_1` FOREIGN KEY (`estudiante`) REFERENCES `estudiante_por_taller` (`estudiante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `docente_supervisor`
--
ALTER TABLE `docente_supervisor`
  ADD CONSTRAINT `docente_supervisor_ibfk_1` FOREIGN KEY (`rfc`) REFERENCES `usuario` (`user_name`);

--
-- Constraints for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`curp`) REFERENCES `usuario` (`user_name`);

--
-- Constraints for table `estudiante_por_taller`
--
ALTER TABLE `estudiante_por_taller`
  ADD CONSTRAINT `estudiante_por_taller_ibfk_1` FOREIGN KEY (`estudiante`) REFERENCES `estudiante` (`curp`),
  ADD CONSTRAINT `estudiante_por_taller_ibfk_2` FOREIGN KEY (`taller`) REFERENCES `taller` (`id`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`clave`) REFERENCES `usuario` (`user_name`);

--
-- Constraints for table `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`reportado`) REFERENCES `estudiante` (`curp`),
  ADD CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`autor`) REFERENCES `docente_supervisor` (`rfc`);

--
-- Constraints for table `taller`
--
ALTER TABLE `taller`
  ADD CONSTRAINT `taller_ibfk_1` FOREIGN KEY (`instructor`) REFERENCES `instructor` (`clave`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taller_ibfk_2` FOREIGN KEY (`supervisor`) REFERENCES `docente_supervisor` (`rfc`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
