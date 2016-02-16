-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2016 a las 17:11:59
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `login_perfiles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action`
--

CREATE TABLE IF NOT EXISTS `action` (
`id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `action`
--

INSERT INTO `action` (`id`, `menu_name`, `url`, `parent_id`, `visible`) VALUES
(1, 'Administración', '#', NULL, 1),
(2, 'Usuarios', '#', 1, 1),
(3, 'Crear usuario', '/login_perfiles/users/create_view.php', 2, 1),
(4, 'Ver usuarios', '/login_perfiles/users/list_view.php', 2, 1),
(5, 'Ejemplo padre', '#', 1, 1),
(6, 'Ejemplo hijo', 'ejemplo.php', 5, 1),
(7, 'Actualizar Usuario', '/login_perfiles/users/update_view.php', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `profile_action` (
  `profile_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profile_action`
--

INSERT INTO `profile_action` (`profile_id`, `action_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4),
(3, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `profile_id`) VALUES
(1, 'aplicaciones', 'f2773d2e02a83bb41e8e51387684b11d', 'Juan Pérez', 1),
(5, 'diegolas', '25d55ad283aa400af464c76d713c07ad', 'Diegol', 3);

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
 ADD PRIMARY KEY (`profile_id`,`action_id`), ADD KEY `fk_profile_has_action_action1_idx` (`action_id`), ADD KEY `fk_profile_has_action_profile1_idx` (`profile_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`,`profile_id`), ADD KEY `fk_user_profile_idx` (`profile_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `action`
--
ALTER TABLE `action`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
