-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 23:13:12
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `id` int(11) NOT NULL,
  `cantidad_pacientes` int(11) NOT NULL,
  `pacientes_atendidos` int(11) NOT NULL,
  `nombre_especialista` varchar(100) NOT NULL,
  `tipo_consulta` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`id`, `cantidad_pacientes`, `pacientes_atendidos`, `nombre_especialista`, `tipo_consulta`, `estado`) VALUES
(17, 34, 13, '1', 'Urgencia', 'Desocupada'),
(18, 45, 4, '2', 'Pediatría', 'Desocupada'),
(19, 45, 6, '2', 'Pediatría', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialistas`
--

CREATE TABLE `especialistas` (
  `id_especialistas` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especialistas`
--

INSERT INTO `especialistas` (`id_especialistas`, `nombre`) VALUES
(1, 'Leonel Fuentes Rivas'),
(2, 'Carlos Lopez Ríos'),
(3, 'Juan Idalgo Fuentes'),
(4, 'Marcelo Olmedo Caceres'),
(5, 'Valeria Miranda Reyes'),
(6, 'Daniel Perez Olguin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `numero_historia_clinica` int(11) NOT NULL,
  `prioridad` varchar(200) NOT NULL,
  `riesgo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `id`, `nombre`, `edad`, `numero_historia_clinica`, `prioridad`, `riesgo`) VALUES
(24, 17, 'luis barraza', 40, 23, '2.75', '1.1'),
(25, 17, 'Marcelo Rodriguez', 15, 34, '40', '6'),
(26, 17, 'Pablo Contreras', 16, 21, '3', '0.48'),
(27, 17, 'Roberto Segura', 16, 33, '3', '0.48'),
(28, 17, 'Renato Paredes', 12, 55, '61', '7.32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `panciano`
--

CREATE TABLE `panciano` (
  `id_panciano` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `tiene_dieta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `panciano`
--

INSERT INTO `panciano` (`id_panciano`, `id_paciente`, `tiene_dieta`) VALUES
(4, 6, NULL),
(9, 11, 0),
(10, 12, 0),
(13, 15, NULL),
(22, 24, NULL),
(23, 25, NULL),
(24, 26, NULL),
(25, 27, NULL),
(26, 28, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pjoven`
--

CREATE TABLE `pjoven` (
  `id_pjoven` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fumador` int(1) DEFAULT NULL,
  `anos_de_fumador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pjoven`
--

INSERT INTO `pjoven` (`id_pjoven`, `id_paciente`, `fumador`, `anos_de_fumador`) VALUES
(9, 11, 2, NULL),
(10, 12, 2, NULL),
(13, 15, 2, NULL),
(22, 24, 1, 3),
(23, 25, 2, 0),
(24, 26, 1, 4),
(25, 27, 1, 4),
(26, 28, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pnino`
--

CREATE TABLE `pnino` (
  `id_pnino` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `relacion_peso` int(11) NOT NULL,
  `estatura` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pnino`
--

INSERT INTO `pnino` (`id_pnino`, `id_paciente`, `relacion_peso`, `estatura`) VALUES
(4, 6, 45, '0'),
(9, 11, 45, '0'),
(10, 12, 56, '0'),
(13, 15, 56, '0'),
(22, 24, 0, ''),
(23, 25, 40, '1,56'),
(24, 26, 0, ''),
(25, 27, 0, ''),
(26, 28, 60, '1,60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `avatar` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `clave`, `avatar`) VALUES
(1, 'demo', 'demo@demo.cl', '$2y$10$yC0jXVgjklt/x0LXffNeMe8WtPT1SXfyQ0sBa8eAGzg3.vYOjJD.i', '/app/libs/script/uploads/1668093127_2.png'),
(2, 'prueba', 'prueba@prueba.cl', '$2y$10$OF/p6W80GnLivpLHrUBuxuOr41PyuN/sHOJGKP644bsMNZR52uqd.', '/app/libs/script/uploads/1668176907_2.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD PRIMARY KEY (`id_especialistas`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `panciano`
--
ALTER TABLE `panciano`
  ADD PRIMARY KEY (`id_panciano`);

--
-- Indices de la tabla `pjoven`
--
ALTER TABLE `pjoven`
  ADD PRIMARY KEY (`id_pjoven`);

--
-- Indices de la tabla `pnino`
--
ALTER TABLE `pnino`
  ADD PRIMARY KEY (`id_pnino`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  MODIFY `id_especialistas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `panciano`
--
ALTER TABLE `panciano`
  MODIFY `id_panciano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pjoven`
--
ALTER TABLE `pjoven`
  MODIFY `id_pjoven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pnino`
--
ALTER TABLE `pnino`
  MODIFY `id_pnino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
