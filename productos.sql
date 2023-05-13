-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2023 a las 20:19:07
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jabones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `productoID` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `peso` float NOT NULL,
  `precio` float NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productoID`, `nombre`, `descripcion`, `peso`, `precio`, `imagen`) VALUES
(1, 'Vainilla', 'Jabón con aroma natural a vainilla, hecho artesanalmente.', 15, 3, 'ocho.jpg'),
(2, 'Suave', 'Jabón artesanal para el cuidado de la piel con un frescor relajante.', 9, 2, 'seis.jpg'),
(3, 'Pasion', 'Jabón intímo, conuna suavidad y un aroma inigualables.', 12, 3, 'dos.jpg'),
(4, 'Spa', 'Jabones con aromas afrutados, hecho a mano con aceites esenciales.', 12, 3, 'siete.jpg'),
(5, 'Té', 'Jabón enriquecidos con té verde que te proporcionaran un efecto de paz a la piel.', 20, 4, 'uno.jpg'),
(6, 'Basic', 'Jabones para todo tipo de piel, aroma natural, hecho a mano.', 10, 1, 'cinco.jpg'),
(7, 'Purific', 'Jabón exfoliante, elimina las impurezas y las pieles muertas.', 16, 2, 'cuatro.jpg'),
(8, 'Termal', 'Jabón de alta calidad hecho con los mejores aceites esenciales, aromatizado con perfume de primera calidad.', 20, 5, 'tres.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productoID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
