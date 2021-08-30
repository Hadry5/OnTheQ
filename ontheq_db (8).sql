-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2021 a las 20:18:30
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ontheq_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `adminusername` varchar(100) NOT NULL,
  `adminpassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `adminusername`, `adminpassword`) VALUES
(1, 'nfakeye@gmail.com', '$2y$10$VT7VYJd.i8kUNjEBdkolreOyllfBO96QLmby4CdjLc8gKO7ShtlQS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attributes`
--

CREATE TABLE `attributes` (
  `DeskID` int(11) NOT NULL,
  `Monitor` tinyint(1) NOT NULL,
  `DockingStation` tinyint(1) NOT NULL,
  `AdjustableHeight` tinyint(1) NOT NULL,
  `Wheelchair` tinyint(1) NOT NULL,
  `Privacy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `CreatedAt` date NOT NULL DEFAULT current_timestamp(),
  `EmailValidated` tinyint(1) NOT NULL DEFAULT 0,
  `Hash` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `Surname`, `Email`, `Password`, `Location`, `CreatedAt`, `EmailValidated`, `Hash`) VALUES
(1, 'Adrian', 'Lozano', 'adrygoleador@gmail.com', 'a256e6b336afdc38c564789c399b516c', 'Albacete', '2021-07-13', 0, ''),
(2, 'Marisol', 'Carretero', 'text@example.com', '9fc90958c18e30aa2cc4111bb965f1aa', 'Xample', '2021-07-13', 0, ''),
(3, 'Xample', 'Xample', 'Xample@xample.com', '9fc90958c18e30aa2cc4111bb965f1aa', 'Xample', '2021-07-13', 0, ''),
(9, 'va', 'va', 'si@si.es', '8054da645a387dbfb06654d69f0d0201', 'sisi', '2021-07-13', 0, ''),
(10, 'ahora siii', 'quesi', 'de@si.com', 'ac5585d98646d255299c359140537783', 'aquesi', '2021-07-13', 0, ''),
(11, 'Adrian', 'Lozano', 'va@quesi.uclm', '43b1cc1db7be63d899dd4280f578691a', 'vaaaa', '2021-07-13', 0, ''),
(12, 'asdfasdf', 'asdfas', 'asd@gmail.com', '$2y$10$LeofOSP5g14sfHGEeuKzv.t.tkwXUMMxT5n5xsCYJDQ8kAzZPQYB2', 'final', '2021-07-13', 0, ''),
(13, 'Xampling', 'Here', 'xampling@OnTheQ.es', '$2y$10$nChOZynAUwk8j/XxzLj7nu2NtoTnbcBAv/nXLz2qXYspMHAMBhhOa', 'OnTheQ', '2021-07-13', 0, ''),
(14, 'Adrian', 'Lozano', 'Xample@xample.es', '$2y$10$SQ52P2feU3YiSTJB4Xg3lOl7pt5xer.WGagDgNqDbn9g1UOYoTSGO', 'Albacete', '2021-07-16', 1, ''),
(15, 'Marisol', 'Carretero', 'sol_adr_i@hotmail.com', '$2y$10$ybs4.FSkcv.m/dmn3MnxuOKCipJfgKe91M7e1q0EK1ifMb16ox.UG', 'Albacete', '2021-07-21', 0, ''),
(16, 'Adrian', 'Lozano', 'hadrianusrl@gmail.com', '$2y$10$iNCFtiS02F2qYYp/vKYQBuDT3ZaTinR6VYBeGnRRDAmJAXQ./Kjtq', 'Albacete', '2021-08-30', 1, '854d6fae5ee42911677c739ee1734486');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desk`
--

CREATE TABLE `desk` (
  `TypeID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `WorkspaceID` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `desk`
--

INSERT INTO `desk` (`TypeID`, `Name`, `RoomID`, `WorkspaceID`, `Price`, `Description`) VALUES
(12, 'Bohemio', 9, 4, 20, 'Hard');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iptries`
--

CREATE TABLE `iptries` (
  `address` char(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `iptries`
--

INSERT INTO `iptries` (`address`, `timestamp`) VALUES
('::1', '2021-08-30 17:08:09'),
('::1', '2021-08-30 17:08:11'),
('::1', '2021-08-30 17:08:14'),
('::1', '2021-08-30 17:08:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CheckIN` datetime NOT NULL,
  `CheckOUT` datetime NOT NULL,
  `Type` varchar(255) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `Price` float NOT NULL,
  `BookStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`BookingID`, `CustomerID`, `CheckIN`, `CheckOUT`, `Type`, `TypeID`, `Price`, `BookStatus`) VALUES
(1, 14, '2021-07-20 20:27:42', '2021-07-21 20:27:42', 'Desk', 12, 20, 'Completed');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password_temp`
--

CREATE TABLE `reset_password_temp` (
  `key` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `CustomerID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `Review` text NOT NULL,
  `Rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room`
--

CREATE TABLE `room` (
  `WorkSpaceID` int(11) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `room`
--

INSERT INTO `room` (`WorkSpaceID`, `TypeID`, `Name`, `price`, `Description`) VALUES
(4, 9, 'Room Rinoceronte', 200, 'Salvaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workspace`
--

CREATE TABLE `workspace` (
  `TypeID` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `workspace`
--

INSERT INTO `workspace` (`TypeID`, `Price`, `Name`, `Description`) VALUES
(4, 2000, 'Redpiso', 'Inmobiliaria');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`DeskID`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indices de la tabla `desk`
--
ALTER TABLE `desk`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indices de la tabla `reset_password_temp`
--
ALTER TABLE `reset_password_temp`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indices de la tabla `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `desk`
--
ALTER TABLE `desk`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `room`
--
ALTER TABLE `room`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `workspace`
--
ALTER TABLE `workspace`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
