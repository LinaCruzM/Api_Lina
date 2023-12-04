-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2023 a las 15:48:03
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `use_id` int(11) NOT NULL,
  `use_mail` varchar(150) NOT NULL,
  `use_pass` varchar(150) NOT NULL,
  `use_dataCreate` varchar(150) NOT NULL,
  `us_identifier` varchar(255) NOT NULL,
  `us_key` varchar(255) NOT NULL,
  `us_status` varchar(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`use_id`, `use_mail`, `use_pass`, `use_dataCreate`, `us_identifier`, `us_key`, `us_status`, `date`) VALUES
(1, 'a@a', '123', '0', '0', '0', '1', '2023-11-16 19:16:08'),
(2, 'a@b', '321', '0', '0', '0', '1', '2023-11-16 19:16:10'),
(3, 'cguasca@uniempresarial.edu.co', '81dc9bdb52d04dc20036dbd8313ed055', '17/11/2023', '00HlBJE8PeMss', '00wJsgHCKHE0U', '1', '2023-11-17 13:51:12'),
(4, 'cguasca2@uniempresarial.edu.co', '81dc9bdb52d04dc20036dbd8313ed055', '17/11/2023', '00sdvXl8OW97Y', '00wJsgHCKHE0U', '1', '2023-11-17 13:51:09'),
(5, 'cguasca3@uniempresarial.edu.co', '81dc9bdb52d04dc20036dbd8313ed055', '17/11/2023', '00KA9EqO.XRng', '00wJsgHCKHE0U', '1', '2023-11-17 14:15:31'),
(6, 'cguas333ca3@uniempresarial.edu.co', '81dc9bdb52d04dc20036dbd8313ed055', '18/10/2023', '00XPwXxYTwgTo', '00wJsgHCKHE0U', '0', '2023-11-17 14:45:06'),
(7, 'cgua@uniempresarial.edu.co', '81dc9bdb52d04dc20036dbd8313ed055', '18/10/2023', '00To.yyJyGgbs', '00wJsgHCKHE0U', '0', '2023-11-17 14:46:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
