-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2016 a las 16:39:14
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE sorteo;

USE sorteo;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sorteo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `action`
--

INSERT INTO `action` (`id`, `menu_name`, `url`, `parent_id`, `visible`) VALUES
(1, 'Administración', '#', NULL, 1),
(2, 'Usuarios', '#', 1, 1),
(3, 'Crear usuario', '/sorteo/users/create_view.php', 2, 1),
(4, 'Ver usuarios', '/sorteo/users/list_view.php', 2, 1),
(5, 'Editar Datos Usuario', '#', 2, 1),
(7, 'Actualizar Usuario', '/sorteo/users/update_view.php', 2, 0),
(8, 'Tokens', '#', NULL, 1),
(9, 'Listar tokens', '/sorteo/tokens/list_view.php', 8, 1),
(10, 'Crear Token', '/sorteo/tokens/create_view.php', 8, 1),
(12, 'Canjear Token', '/sorteo/canjear.php', 8, 1),
(13, 'Nuevo sorteo', '/sorteo/sorteo/create_view.php', 14, 1),
(14, 'Sorteos', '#', NULL, 1),
(15, 'Ver sorteos anteriores', '/sorteo/sorteo/list_view.php', 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`id`, `name`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Guest');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile_action`
--

CREATE TABLE `profile_action` (
  `profile_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profile_action`
--

INSERT INTO `profile_action` (`profile_id`, `action_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 13),
(1, 14),
(1, 15),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(3, 8),
(3, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteo`
--

CREATE TABLE `sorteo` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ganador` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sorteo`
--

INSERT INTO `sorteo` (`id`, `fecha`, `ganador`, `nombre`) VALUES
(10, '2016-02-17 15:30:16', '012345', 'NO CANJEADO'),
(11, '2016-02-17 15:38:18', 'asdfgh', 'NO CANJEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `codigo` varchar(50) NOT NULL,
  `canjeado` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`codigo`, `canjeado`, `user_id`) VALUES
('012345', 0, NULL),
('123456', 0, NULL),
('asdfgh', 0, NULL),
('okmijn', 0, NULL),
('qwerty', 0, NULL),
('sfdgsdfgdfgsdfg', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `profile_id`) VALUES
(1, 'aplicaciones', 'f2773d2e02a83bb41e8e51387684b11d', 'Juan Pérez', 1),
(5, 'diegolas', '25d55ad283aa400af464c76d713c07ad', 'Diegol', 3),
(6, 'asdqwe', '96f0f08c0188ba04898ce8cc465c19c4', 'asd qwe', 3),
(7, 'qwe', 'efe6398127928f1b2e9ef3207fb82663', 'asd', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profile_action`
--
ALTER TABLE `profile_action`
  ADD PRIMARY KEY (`profile_id`,`action_id`),
  ADD KEY `fk_profile_has_action_action1_idx` (`action_id`),
  ADD KEY `fk_profile_has_action_profile1_idx` (`profile_id`);

--
-- Indices de la tabla `sorteo`
--
ALTER TABLE `sorteo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`profile_id`),
  ADD KEY `fk_user_profile_idx` (`profile_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `action`
--
ALTER TABLE `action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sorteo`
--
ALTER TABLE `sorteo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profile_action`
--
ALTER TABLE `profile_action`
  ADD CONSTRAINT `fk_profile_has_action_action1` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_has_action_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
