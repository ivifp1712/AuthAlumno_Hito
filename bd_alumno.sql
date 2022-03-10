-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2022 a las 09:20:25
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

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
('ivi', '$2y$05$wC0NmENtC1OjLgzVN2m95O8Cr8Y70Rp1zP/W7.7U51dm.wclbPnw2', 'ivi@hotmail.com', '', '2022-03-08 14:35:35', 45, 1, '0000-00-00 00:00:00', 'Ivan Gonzalez', 'imgs/perfil.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
