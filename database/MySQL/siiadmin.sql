-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2022 a las 03:39:43
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siiadmin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_llegada` time NOT NULL,
  `estatus_llegada` int(1) NOT NULL,
  `hora_salida` time NOT NULL,
  `horas_laboradas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_empleado`, `fecha`, `hora_llegada`, `estatus_llegada`, `hora_salida`, `horas_laboradas`) VALUES
(132, 1, '2022-04-04', '09:00:00', 1, '17:00:00', 7),
(133, 1, '2022-04-05', '10:15:00', 0, '17:30:00', 5.75),
(134, 1, '2022-04-06', '08:45:00', 1, '16:15:00', 6.25),
(135, 2, '2022-04-04', '07:30:00', 1, '15:30:00', 6.5),
(136, 2, '2022-04-05', '08:00:00', 1, '16:00:00', 7),
(137, 2, '2022-04-06', '07:45:00', 1, '16:00:00', 7),
(138, 3, '2022-04-04', '08:00:00', 1, '16:00:00', 7),
(139, 3, '2022-04-06', '08:00:00', 1, '16:00:00', 7),
(140, 4, '2022-04-05', '07:30:00', 1, '18:00:00', 7),
(141, 5, '2022-04-06', '10:00:00', 1, '17:00:00', 6),
(151, 4, '2022-06-22', '15:00:00', 0, '22:00:00', 6),
(153, 4, '2022-06-14', '13:15:00', 0, '22:15:00', 8),
(156, 6, '2022-07-24', '08:08:00', 0, '19:00:00', 6.8666666666667),
(157, 7, '2022-07-24', '13:00:00', 0, '22:00:00', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avancefectivo`
--

CREATE TABLE `avancefectivo` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_empleado` varchar(15) NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `avancefectivo`
--

INSERT INTO `avancefectivo` (`id`, `fecha`, `id_empleado`, `monto`) VALUES
(10, '2022-04-06', '1', 8),
(11, '2022-04-06', '2', 4),
(13, '2022-06-17', '3', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `sueldo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `cargo`, `sueldo`) VALUES
(1, 'Asistente Administrativo', '0.25'),
(3, 'Analista < 5 años', '0.40'),
(5, 'Gerente', '1.25'),
(7, 'Coordinador', '1'),
(8, 'Analista > 5 años', '0.75'),
(9, 'Analista < 1 año', '0.30'),
(10, 'Servicios Generales', '0.70'),
(15, 'Sin Cargo', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones`
--

CREATE TABLE `deducciones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `monto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deducciones`
--

INSERT INTO `deducciones` (`id`, `descripcion`, `monto`) VALUES
(5, 'IVSS 4%', '0.04'),
(7, 'Paro Forzoso 1%', '0.01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones2`
--

CREATE TABLE `deducciones2` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `monto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deducciones2`
--

INSERT INTO `deducciones2` (`id`, `descripcion`, `monto`) VALUES
(11, 'FAOV', '0.01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_horarios` int(11) NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `id_persona`, `id_cargo`, `id_horarios`, `estatus`) VALUES
(1, 1, 3, 4, 1),
(2, 5, 5, 3, 1),
(3, 2, 7, 2, 1),
(4, 3, 8, 2, 1),
(5, 4, 10, 6, 1),
(6, 6, 1, 2, 1),
(7, 7, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horarios` int(11) NOT NULL,
  `hora_llegada` time NOT NULL,
  `hora_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horarios`, `hora_llegada`, `hora_salida`) VALUES
(2, '08:00:00', '16:00:00'),
(4, '10:00:00', '18:00:00'),
(6, '11:00:00', '19:00:00'),
(12, '12:00:00', '20:00:00'),
(13, '00:00:00', '00:00:00'),
(14, '13:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `numero_contacto` varchar(100) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `cedula`, `nombres`, `apellidos`, `direccion`, `fecha_nacimiento`, `numero_contacto`, `genero`, `foto`, `fecha_ingreso`) VALUES
(1, '14450022', 'Willian', 'Cañizales', 'Cementerio', '1980-06-01', 'N/A', 'Masculino', 'avatar04.png', '2022-04-06'),
(2, '14452990', 'Dayurimare', 'Gonzalez', '23 de Enero', '1977-01-15', 'N/A', 'Femenino', 'avatar2.png', '2022-04-06'),
(3, '6304240', 'Giuseppe', 'Lodise', 'Propatria', '1952-12-12', 'N/A', 'Masculino', 'avatar5.png', '2022-04-06'),
(4, '16894094', 'Lurdes', 'Escalona', 'Parque Central', '1984-01-23', 'N/A', 'Femenino', 'avatar3.png', '2022-04-06'),
(5, '13127064', 'Yurvin', 'Boada', 'Macaracuay', '1976-08-05', 'N/A', 'Femenino', 'avatar3.png', '2022-04-06'),
(6, '27903883', 'Rafael', 'Rivero', 'San Pedro', '2000-12-28', '4241385808', 'Masculino', 'profile_rafael.jpg', '2022-07-24'),
(7, '11406782', 'Trina', 'Herrera', 'San Pedro', '1973-04-11', '4127256457', 'Femenino', 'avatar2.png', '2022-07-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasa_dolar`
--

CREATE TABLE `tasa_dolar` (
  `id` int(11) NOT NULL,
  `tasa_dolar` text NOT NULL,
  `observaciones` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tasa_dolar`
--

INSERT INTO `tasa_dolar` (`id`, `tasa_dolar`, `observaciones`) VALUES
(1, '5.8', 'Tasa oficial publicada por el Banco Central de Venezuela. La misma debe actualizarse al momento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiempoextra`
--

CREATE TABLE `tiempoextra` (
  `id` int(11) NOT NULL,
  `id_empleado` varchar(15) NOT NULL,
  `horas` double NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiempoextra`
--

INSERT INTO `tiempoextra` (`id`, `id_empleado`, `horas`, `monto`, `fecha`) VALUES
(14, '1', 2, 1, '2022-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contraseña` varchar(60) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_persona`, `usuario`, `contraseña`, `fecha_creacion`) VALUES
(1, 6, 'rafael.rivero', '$2y$10$Qkaq2xvF/qPB/gmKq2OUoeDGL9zUA4EUleNGbJaTZcz6/tdV4ALyy', '2022-02-20'),
(2, 0, 'admin', '$2y$10$Hh2bHimRjjFqklN95J/1xunijAk9Hqi8VwGoN11KRLLz.H5wgDEHO', '2022-02-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`id_empleado`);

--
-- Indices de la tabla `avancefectivo`
--
ALTER TABLE `avancefectivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`id_empleado`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

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
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horarios`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `employee_id` (`cedula`);

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `avancefectivo`
--
ALTER TABLE `avancefectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `deducciones2`
--
ALTER TABLE `deducciones2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tasa_dolar`
--
ALTER TABLE `tasa_dolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tiempoextra`
--
ALTER TABLE `tiempoextra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
