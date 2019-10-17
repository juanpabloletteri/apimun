-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2018 a las 03:59:52
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcial2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL,
  `id_duenio` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `raza` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `color` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `id_duenio`, `nombre`, `raza`, `color`, `edad`, `tipo`) VALUES
(301, 2, 'michifus', 'persa', 'marron claro', 3, 100),
(302, 2, 'felipe', 'siames', 'gris', 12, 100),
(303, 3, 'adolfo', 'pastor aleman', 'marron y negro', 12, 200),
(304, 3, 'porqueria', 'caniche toy', 'blanco', 1, 200),
(305, 4, 'vaya', 'beagle', 'marron claro', 6, 200),
(306, 4, 'rodolfo', 'persa', 'gris', 4, 100),
(307, 7, 'luca', 'boxer', 'blanco y marron', 11, 200),
(310, 7, 'michy', 'siames', 'gris', 1, 100),
(321, 21, 'qwerty', 'salchicha', 'marron', 6, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_turno` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` varchar(200) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id_turno`, `id_mascota`, `fecha`, `observaciones`) VALUES
(2, 302, '2018-06-14 10:00:00', 'pulgas'),
(3, 301, '2018-06-14 10:30:00', 'pulgas'),
(6, 310, '2018-06-26 11:15:00', 'castracion'),
(7, 310, '2018-06-22 12:00:00', 'castracion'),
(8, 305, '2018-07-12 11:10:00', 'moquillo'),
(9, 307, '2018-06-28 12:33:00', 'ojos llorosos'),
(10, 306, '2018-07-12 14:40:00', 'pata lastimada'),
(11, 301, '2018-07-11 15:00:00', 'castracion'),
(12, 304, '2018-07-19 15:20:00', 'castracion'),
(13, 303, '2018-08-17 15:50:00', 'desparasitacion'),
(23, 321, '2018-06-28 16:10:00', 'castracion'),
(24, 302, '2018-06-16 15:30:00', 'pulgas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `mail` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `mail`, `password`, `nombre`, `apellido`, `tipo`) VALUES
(1, '1', '1', 'roberto', 'carlos', 1),
(2, 'rruben@gmail.com', '111111', 'ricardo', 'ruben', 2),
(3, 'mrod@gmail.com', '111111', 'micaela', 'rodriguez', 2),
(4, 'mlett@gmail.com', '111111', 'mario', 'mazzeo', 2),
(5, '2', '2', '2', '2', 2),
(7, 'pepitop@hotmail.com', '111111', 'pepe', 'torres', 2),
(9, 'cacho@gmail.com', '111111', 'cacho', 'castacha', 2),
(21, 'nuevo@gmail.com', '2', 'nuevo', 'cliente', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `id_duenio` (`id_duenio`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_turno`),
  ADD KEY `id_mascota` (`id_mascota`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`id_duenio`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
