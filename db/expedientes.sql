-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2019 a las 03:43:31
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `expedientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientesbase`
--

CREATE TABLE `expedientesbase` (
  `id_expediente` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tema` varchar(20) NOT NULL,
  `fojas` int(11) NOT NULL,
  `iniciador` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `caratula` varchar(250) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_oficina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Volcado de datos para la tabla `expedientesbase`
--

INSERT INTO `expedientesbase` (`id_expediente`, `tipo`, `numero`, `anio`, `fecha`, `tema`, `fojas`, `iniciador`, `direccion`, `caratula`, `id_usuario`, `id_oficina`) VALUES
(1, 2, 25412, 2019, '0000-00-00', 'algo', 3, 'edesur', 'villegas 4574', 'apertura en lasdjkas', 23, 1),
(2, 0, 15451, 2200, '0000-00-00', 'infraccion', 0, 'telefonica', 'mirte 1564', 'poste ', 24, 2),
(3, 1, 2555, 2019, '0000-00-00', 'oficio', 11, 'edesur', 'villegas 4561', 'apertura en vereda', 25, 1),
(4, 0, 123434, 12, '2019-10-09', '23324342', 23443342, '234234234', '', '423234342', 23, 2),
(5, 0, 123465, 2019, '2019-10-25', 'temaaaa', 32, 'habilitac', '', 'habilitacion kiosco', 24, 1),
(6, 1, 123123, 2011, '2019-10-02', 'temamammama', 33, 'via publica', '', 'apertura en calzada', 27, 2);

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
(321, 21, 'qwerty', 'salchicha', 'marron', 6, 200),
(323, 2, 'pepiro', 'cimarron', 'gris', 12, 100),
(324, 1, 'juanfelipq', 'can', 'verde', 22, 200);

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
  `tipo` int(11) NOT NULL,
  `id_oficina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `mail`, `password`, `nombre`, `apellido`, `tipo`, `id_oficina`) VALUES
(1, '1', '1', 'roberto', 'carlos', 1, 0),
(2, 'rruben@gmail.com', '111111', 'ricardo', 'ruben', 2, 0),
(3, 'mrod@gmail.com', '111111', 'micaela', 'rodriguez', 2, 0),
(4, 'mlett@gmail.com', '111111', 'mario', 'mazzeo', 2, 0),
(5, '2', '2', '2', '2', 2, 0),
(7, 'pepitop@hotmail.com', '111111', 'pepe', 'torres', 2, 0),
(9, 'cacho@gmail.com', '111111', 'cacho', 'castacha', 2, 0),
(15, '3', '3', 'Juan', 'Pablo', -3, 0),
(21, 'nuevo@gmail.com', '2', 'nuevo', 'cliente', 2, 0),
(23, '0', '1', '0', '0', 0, 0),
(24, '11', '1', '0', '0', 11, 1),
(25, '12', '1', '0', '0', 12, 1),
(26, '21', '1', '0', '0', 21, 2),
(27, '22', '1', '0', '0', 22, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `expedientesbase`
--
ALTER TABLE `expedientesbase`
  ADD PRIMARY KEY (`id_expediente`);

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
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `expedientesbase`
--
ALTER TABLE `expedientesbase`
  MODIFY `id_expediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
