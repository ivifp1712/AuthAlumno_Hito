-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2022 a las 20:50:07
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
-- Base de datos: `alumno`
--
CREATE DATABASE IF NOT EXISTS `alumno` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `alumno`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobar` (IN `user` VARCHAR(50))  select * from usuarios WHERE username = user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobarEmail` (IN `mail` VARCHAR(50))  select * from usuarios where email = mail$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fechaHoyLogin` (IN `user` VARCHAR(255))  update usuarios set fechainicio = NOW() where username = user$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `fechainicio` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 0,
  `fechaip` datetime NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(500) NOT NULL DEFAULT 'imgs/perfil.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `password`, `email`, `ip`, `fechainicio`, `id`, `rol`, `fechaip`, `nombre`, `avatar`) VALUES
('cervecitas', '$2y$15$5Ul3oQuuCoqyhpJmsmmEm.9sVa8wgzCIyb/aBe4O3779l.F/y1zuO', 'ivi1712@hotmail.es', '', '2022-02-24 10:54:11', 4, 1, '0000-00-00 00:00:00', 'Javier Martin aka Cervecitas', 'https://i.pinimg.com/originals/03/a9/5b/03a95b5e6c367f7f65f9b16d92eed622.jpg'),
('sanchez', '$2y$05$eqgPs6fcVehdLZQdfwGhvu5JpjAJB5g2YbqAIAL/MI4Ru/71ppDZi', 'caca@hola.com', '', '2022-02-24 11:46:24', 7, 0, '0000-00-00 00:00:00', 'El Sanchez', 'https://i.pinimg.com/474x/a4/7f/8e/a47f8eb1e918a5dd5a943a4e11804577--emojis.jpg'),
('ivi', '$2y$15$uqWBchyAJ9g8BaGtgmcIP.WlM6VZ9FcDEAT/4Yihg.7PFXAvpbsfK', 'ivan.gonzalez@hola.com', '', '2022-02-24 14:33:08', 8, 1, '0000-00-00 00:00:00', 'Ivan Gonzalez', 'https://i.pinimg.com/originals/03/a9/5b/03a95b5e6c367f7f65f9b16d92eed622.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
