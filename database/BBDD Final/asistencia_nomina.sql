-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2022 a las 02:07:49
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia_nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'rafael.rivero', '$2y$10$nF.kFQzSKgl9ZXFTj676fuUgdJkgRgbcJ.NeOg9pmur4C.mOS2BrC', 'Rafael', 'Rivero', 'profile_rafael.jpg', '2022-02-20'),
(2, 'admin', '$2y$10$Hh2bHimRjjFqklN95J/1xunijAk9Hqi8VwGoN11KRLLz.H5wgDEHO', 'Administrador', 'Principal', 'avatar5.png', '2022-02-20'),
(3, 'julio.contreras', '$2y$10$UeyUmqvnvIKUFUYKgALTQ.mlfGujkaYR7sYXLZLNJyeZC.yySg3iC', 'Julio', 'Contreras', 'avatar5.png', '2022-02-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(132, 40, '2022-04-04', '09:00:00', 1, '17:00:00', 7),
(133, 40, '2022-04-05', '10:15:00', 0, '17:30:00', 5.75),
(134, 40, '2022-04-06', '08:45:00', 1, '16:15:00', 6.25),
(135, 42, '2022-04-04', '07:30:00', 1, '15:30:00', 6.5),
(136, 42, '2022-04-05', '08:00:00', 1, '16:00:00', 7),
(137, 42, '2022-04-06', '07:45:00', 1, '16:00:00', 7),
(138, 39, '2022-04-04', '08:00:00', 1, '16:00:00', 7),
(139, 39, '2022-04-06', '08:00:00', 1, '16:00:00', 7),
(140, 38, '2022-04-05', '07:30:00', 1, '18:00:00', 7),
(141, 41, '2022-04-06', '10:00:00', 1, '17:00:00', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avancefectivo`
--

CREATE TABLE `avancefectivo` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `avancefectivo`
--

INSERT INTO `avancefectivo` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(10, '2022-04-06', '42', 8),
(11, '2022-04-06', '40', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `position_id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`position_id`, `description`, `rate`) VALUES
(1, 'Asistente Administrativo', '0.25'),
(3, 'Analista < 5 años', '0.40'),
(5, 'Gerente', '1.25'),
(7, 'Coordinador', '1'),
(8, 'Analista > 5 años', '0.60'),
(9, 'Analista < 1 año', '0.30'),
(10, 'Servicios Generales', '0.70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones`
--

CREATE TABLE `deducciones` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deducciones`
--

INSERT INTO `deducciones` (`id`, `description`, `amount`) VALUES
(5, 'IVSS 4%', '0.04'),
(7, 'Paro Forzoso 1%', '0.01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones2`
--

CREATE TABLE `deducciones2` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deducciones2`
--

INSERT INTO `deducciones2` (`id`, `description`, `amount`) VALUES
(1, 'FAOV 1%', '0.01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `employee_id`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`) VALUES
(38, '14450022', 'Willian', 'Cañizales', 'Calle 1ro de Mayo, Casa N°546. Cementerio, Caracas.', '1980-06-01', 'N/A', 'Male', 5, 3, 'avatar04.png', '2022-04-06'),
(39, '14452990', 'Dayurimare', 'Gonzalez', '23 de Enero', '1977-01-15', 'N/A', 'Female', 7, 2, 'avatar2.png', '2022-04-06'),
(40, '6304240', 'Giuseppe', 'Lodise', 'Propatria', '1952-12-12', 'N/A', 'Male', 8, 3, 'avatar5.png', '2022-04-06'),
(41, '16894094', 'Lurdes', 'Escalona', 'Parque Central', '1984-01-23', 'N/A', 'Female', 3, 4, 'avatar3.png', '2022-04-06'),
(42, '13127064', 'Yurvin', 'Boada', 'Macaracuay', '1976-08-05', 'N/A', 'Female', 8, 2, 'avatar3.png', '2022-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `schedule_id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`schedule_id`, `time_in`, `time_out`) VALUES
(2, '08:00:00', '16:00:00'),
(3, '09:00:00', '17:00:00'),
(4, '10:00:00', '18:00:00'),
(6, '11:00:00', '19:00:00'),
(12, '12:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasa_dolar`
--

CREATE TABLE `tasa_dolar` (
  `id` int(11) NOT NULL,
  `rate_dolar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tasa_dolar`
--

INSERT INTO `tasa_dolar` (`id`, `rate_dolar`) VALUES
(1, '4.5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempoextra`
--

CREATE TABLE `tiempoextra` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiempoextra`
--

INSERT INTO `tiempoextra` (`id`, `employee_id`, `hours`, `rate`, `date_overtime`) VALUES
(14, '40', 2, 0.9, '2022-04-06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indices de la tabla `avancefectivo`
--
ALTER TABLE `avancefectivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`position_id`);

--
-- Indices de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deducciones2`
--
ALTER TABLE `deducciones2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indices de la tabla `tasa_dolar`
--
ALTER TABLE `tasa_dolar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiempoextra`
--
ALTER TABLE `tiempoextra`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `avancefectivo`
--
ALTER TABLE `avancefectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `deducciones2`
--
ALTER TABLE `deducciones2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tasa_dolar`
--
ALTER TABLE `tasa_dolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tiempoextra`
--
ALTER TABLE `tiempoextra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
