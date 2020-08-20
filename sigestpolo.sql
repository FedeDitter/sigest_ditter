-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2020 a las 02:05:34
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sigestpolo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_carrera_persona`
--

CREATE TABLE `alumnos_carrera_persona` (
  `alumno_id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnos_carrera_persona`
--

INSERT INTO `alumnos_carrera_persona` (`alumno_id`, `id_persona`, `id_carrera`) VALUES
(1, 1, 1),
(3, 5, 2),
(6, 7, 1),
(7, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `carrera` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `carrera`) VALUES
(1, 'Mecatronica'),
(2, 'Programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `persona_id` int(11) NOT NULL,
  `persona_ape_nom` varchar(100) NOT NULL,
  `persona_cuil` bigint(20) NOT NULL,
  `persona_edad` int(3) NOT NULL,
  `persona_localidad` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`persona_id`, `persona_ape_nom`, `persona_cuil`, `persona_edad`, `persona_localidad`) VALUES
(1, 'Ditter ', 20433303092, 19, 'Formosa'),
(2, 'Silva Edit', 20433303092, 17, 'Formosa'),
(7, 'Elmo Sanbique', 20433303092, 19, 'Formosa'),
(9, 'Aldo Basatra', 20433303092, 25, 'Formosa'),
(10, 'Pablito Clavo un clavito', 20433303092, 22, 'Formosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  `contraseña_usuario` varchar(250) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo_usuario`, `contraseña_usuario`, `persona_id`) VALUES
(1, 'fededitter@hotmail.com', '9450476b384b32d8ad8b758e76c98a69', 1),
(5, 'roberto@gmail.com', '9450476b384b32d8ad8b758e76c98a69', 2),
(6, 'aldocrespo@gmail.com', '31725adf9794499951d70d880ff22d7e', 5),
(7, 'elmo@hotmail.com', '9450476b384b32d8ad8b758e76c98a69', 7),
(8, 'elrobotitus@gmail.com', '9450476b384b32d8ad8b758e76c98a69', 9),
(9, 'pablobasilio@gmail.com', '9450476b384b32d8ad8b758e76c98a69', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos_carrera_persona`
--
ALTER TABLE `alumnos_carrera_persona`
  ADD PRIMARY KEY (`alumno_id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`persona_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos_carrera_persona`
--
ALTER TABLE `alumnos_carrera_persona`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `persona_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
