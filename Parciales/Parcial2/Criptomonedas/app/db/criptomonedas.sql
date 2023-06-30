-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-03-2021 a las 21:21:28
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pqElWX5WY2`
--
-- --------------------------------------------------------
-- --------------------------------------------------------
-- Creamos la base de datos
-- 
CREATE SCHEMA IF NOT EXISTS `comanda_db`;

--
-- Estructura de tabla para la tabla `users`
--
DROP TABLE IF EXISTS `users`;

CREATE TABLE
  `users` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `user_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--
INSERT INTO
  `users` (`user_name`, `password`, `user_type`)
VALUES
  ('franco', 'asd1234', 'ADMIN'),
  ('pedro', 'asd1234', 'CLIENT'),
  ('jorge', 'asd1234', 'CLIENT');

--
-- Estructura de tabla para la tabla `coins`
--
DROP TABLE IF EXISTS `coins`;

CREATE TABLE
  `coins` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `origin` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `price` decimal(10, 2) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `coins`
--
INSERT INTO
  `coins` (`name`, `origin`, `image`, `price`)
VALUES
  ('Ethereum', 'USA', './images/ethereum.png', 100),
  ('Bitcoin', 'Japan', './images/ethereum.png', 200);


--
-- Estructura de tabla para la tabla `sales`
--
DROP TABLE IF EXISTS `sales`;

CREATE TABLE
  `sales` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `dateTimeString` DATETIME NOT NULL,
    `id_coin` int(11) NOT NULL,
    `id_user` int(11) NOT NULL,
    `quantity` int(3) NOT NULL,
    `subtotal` decimal(10, 2) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sales`

INSERT INTO
  `sales` (`dateTimeString`, `id_coin`,  `id_user`,`quantity`, `subtotal`)
VALUES
  ('2023-06-18 11:11:11', '3', 2, '30', 300),
  ('2023-06-18 11:11:11', '4', 2, '20', 300);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;