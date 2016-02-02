-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2016 a las 10:41:47
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `projects`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leader`
--

CREATE TABLE IF NOT EXISTS `leader` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `leader`
--

INSERT INTO `leader` (`id`, `name`, `lastname`, `department`) VALUES
(1, 'Rene', 'Alanis', 'Gerencia'),
(2, 'Fernando', 'Quitl Tiro', 'Ventas'),
(3, 'Laura', 'Navarro', 'Recursos Materiales'),
(4, 'Israel', 'Ramirez', 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `cost` float(10,2) DEFAULT NULL,
  `status` enum('En Proceso','Terminado','Abandonado') DEFAULT NULL,
  `leader_id1` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `project`
--

INSERT INTO `project` (`id`, `name`, `start_date`, `end_date`, `days`, `cost`, `status`, `leader_id1`) VALUES
(1, 'Demo', '2016-02-02', '2016-02-12', 10, 6256.75, 'En Proceso', 1),
(2, 'MyDemo2', '2016-02-08', '2016-02-10', 2, 2454.83, 'Terminado', 2),
(3, 'Pedidos', '2016-01-30', '2016-02-13', 14, 7564.43, 'En Proceso', 3),
(4, 'Inventario', '2016-02-04', '2016-02-29', 25, 954.68, 'En Proceso', 4),
(5, 'Promosion de micas', '2016-02-10', '2016-02-16', 6, 2846.37, 'Terminado', 2),
(6, 'inventario de armazones', '2016-02-16', '2016-02-20', 4, 2350.00, 'En Proceso', 4),
(7, 'Pedidos de armazon', '2016-02-15', '2016-02-19', 4, 5340.00, 'En Proceso', 3),
(8, 'Feria de opticas', '2016-02-24', '2016-02-29', 5, 8450.00, 'En Proceso', 1),
(9, 'Promotor', '2016-02-02', '2016-02-29', 27, 3500.00, 'En Proceso', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `theprojects`
--
CREATE TABLE IF NOT EXISTS `theprojects` (
`name_project` varchar(45)
,`name` varchar(91)
,`days` int(11)
,`end_date` date
,`cost` float(10,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `the_projects`
--
CREATE TABLE IF NOT EXISTS `the_projects` (
`name_project` varchar(45)
,`name` varchar(91)
,`days` int(11)
,`end_date` date
,`cost` float(10,2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `theprojects`
--
DROP TABLE IF EXISTS `theprojects`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `theprojects` AS select `project`.`name` AS `name_project`,concat(`leader`.`name`,' ',`leader`.`lastname`) AS `name`,`project`.`days` AS `days`,`project`.`end_date` AS `end_date`,`project`.`cost` AS `cost` from (`leader` join `project` on((`project`.`leader_id1` = `leader`.`id`))) where (`project`.`end_date` >= curdate());

-- --------------------------------------------------------

--
-- Estructura para la vista `the_projects`
--
DROP TABLE IF EXISTS `the_projects`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `the_projects` AS select `project`.`name` AS `name_project`,concat(`leader`.`name`,' ',`leader`.`lastname`) AS `name`,`project`.`days` AS `days`,`project`.`end_date` AS `end_date`,`project`.`cost` AS `cost` from (`project` join `leader`) where ((`project`.`end_date` >= curdate()) and (`project`.`leader_id1` = `leader`.`id`));

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `leader`
--
ALTER TABLE `leader`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`,`leader_id1`), ADD KEY `fk_project_leader1_idx` (`leader_id1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `leader`
--
ALTER TABLE `leader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `project`
--
ALTER TABLE `project`
ADD CONSTRAINT `fk_project_leader1` FOREIGN KEY (`leader_id1`) REFERENCES `leader` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
