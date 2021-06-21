-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2021 a las 19:36:08
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `imagen` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(1, 'Mujeres', 'Ropar para dama', 'women.jpg'),
(2, 'Hombres', 'Ropa para hombre', 'men.jpg'),
(3, 'Niños', 'Ropa para niños', 'children.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colore`
--

CREATE TABLE `colore` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `codigo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colore`
--

INSERT INTO `colore` (`id`, `color`, `codigo`) VALUES
(1, 'red', '#f00'),
(2, 'blue', '#05F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `fecha_vencimiento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cupones`
--

INSERT INTO `cupones` (`id`, `codigo`, `status`, `tipo`, `valor`, `fecha_vencimiento`) VALUES
(1, '24418', 'utilizado', 'moneda', '100', '2020-07-29'),
(2, '65342', 'activo', 'moneda', '200', '2020-07-28'),
(3, '36150', 'utilizado', 'porcentaje', '10', '2020-07-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id_envio` int(11) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`id_envio`, `pais`, `company`, `direccion`, `estado`, `cp`, `id_venta`) VALUES
(1, '4', 'asd', 'asdasd', '123', '123', 14),
(2, '4', 'asd', '', 'asd', '123', 15),
(3, '7', 'asd', 'asdsad', 'asdasd', 'asdasd', 16),
(4, '3', 'asd', 'asdas', 'asdasd', '123', 17),
(5, '3', '222', 'calle', 'asdasd', '123', 18),
(6, '4', '', 'PaquimÃ© #2302', 'Chihuahua', '31770', 19),
(7, '1', '', '', '', '', 20),
(8, '1', '', '', '', '', 21),
(9, '6', 'ad', 'asda', 'asd', '123', 22),
(10, '2', 'asd', 'asd', 'asd', '123', 23),
(11, '3', 'dasdsad', 'PaquimÃ© #2302', 'Chihuahua', '31770', 24),
(12, '3', 'qwe', 'qwe', '3qwe', '1', 25),
(13, '7', 'asd', 'asd', 'Chihuahua', '111', 26),
(14, '2', 'asd', 'asd', 'asd', '123', 27),
(15, '2', 'asd', 'asd', 'asd', '123', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `metodo`, `id_venta`) VALUES
(1, 'paypal', 22),
(2, 'mercado_pago', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `inventario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `talla` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `inventario`, `id_categoria`, `talla`, `color`) VALUES
(1, 'Tank Top', 'Finding perfect t-shirt', 60, 'cloth_1.jpg', 30, 3, 'XL', 'white'),
(2, 'Corater', 'Finding perfect products', 20, 'shoe_1.jpg', 3, 2, '25.5', 'blue'),
(3, 'Producto 0', 'Esta es la descripcion', 844, 'cloth_1.jpg', 76, 1, 'XL', 'Blue'),
(4, 'Producto 1', 'Esta es la descripcion', 513, 'cloth_1.jpg', 83, 1, 'XL', 'Blue'),
(5, 'Producto 2', 'Esta es la descripcion', 132, 'cloth_1.jpg', 78, 1, 'XL', 'Blue'),
(6, 'Producto 3', 'Esta es la descripcion', 317, 'cloth_1.jpg', 70, 1, 'XL', 'Blue'),
(7, 'Producto 4', 'Esta es la descripcion', 70, 'cloth_1.jpg', 88, 1, 'XL', 'Blue'),
(8, 'Producto 5', 'Esta es la descripcion', 732, 'cloth_1.jpg', 7, 1, 'XL', 'Blue'),
(9, 'Producto 6', 'Esta es la descripcion', 85, 'cloth_1.jpg', 87, 1, 'XL', 'Blue'),
(10, 'Producto 7', 'Esta es la descripcion', 843, 'cloth_1.jpg', 38, 1, 'XL', 'Blue'),
(11, 'Producto 8', 'Esta es la descripcion', 36, 'cloth_1.jpg', 31, 1, 'XL', 'Blue'),
(12, 'Producto 9', 'Esta es la descripcion', 106, 'cloth_1.jpg', 66, 1, 'XL', 'Blue'),
(13, 'Producto 10', 'Esta es la descripcion', 763, 'cloth_1.jpg', 25, 1, 'XL', 'Blue'),
(14, 'Producto 11', 'Esta es la descripcion', 856, 'cloth_1.jpg', 47, 1, 'XL', 'Blue'),
(15, 'Producto 12', 'Esta es la descripcion', 815, 'cloth_1.jpg', 91, 1, 'XL', 'Blue'),
(16, 'Producto 13', 'Esta es la descripcion', 91, 'cloth_1.jpg', 96, 1, 'XL', 'Blue'),
(17, 'Producto 14', 'Esta es la descripcion', 33, 'cloth_1.jpg', 5, 1, 'XL', 'Blue'),
(18, 'Producto 15', 'Esta es la descripcion', 315, 'cloth_1.jpg', 79, 1, 'XL', 'Blue'),
(19, 'Producto 16', 'Esta es la descripcion', 417, 'cloth_1.jpg', 70, 1, 'XL', 'Blue'),
(20, 'Producto 17', 'Esta es la descripcion', 122, 'cloth_1.jpg', 8, 1, 'XL', 'Blue'),
(21, 'Producto 18', 'Esta es la descripcion', 665, 'cloth_1.jpg', 25, 1, 'XL', 'Blue'),
(22, 'Producto 19', 'Esta es la descripcion', 175, 'cloth_1.jpg', 77, 1, 'XL', 'Blue'),
(23, 'Producto 20', 'Esta es la descripcion', 276, 'cloth_1.jpg', 9, 1, 'XL', 'Blue'),
(24, 'Producto 21', 'Esta es la descripcion', 593, 'cloth_1.jpg', 45, 1, 'XL', 'Blue'),
(25, 'Producto 22', 'Esta es la descripcion', 359, 'cloth_1.jpg', 17, 1, 'XL', 'Blue'),
(26, 'Producto 23', 'Esta es la descripcion', 795, 'cloth_1.jpg', 5, 1, 'XL', 'Blue'),
(27, 'Producto 24', 'Esta es la descripcion', 867, 'cloth_1.jpg', 51, 1, 'XL', 'Blue'),
(28, 'Producto 25', 'Esta es la descripcion', 56, 'cloth_1.jpg', 69, 1, 'XL', 'Blue'),
(29, 'Producto 26', 'Esta es la descripcion', 114, 'cloth_1.jpg', 14, 1, 'XL', 'Blue'),
(30, 'Producto 27', 'Esta es la descripcion', 192, 'cloth_1.jpg', 98, 1, 'XL', 'Blue'),
(31, 'Producto 28', 'Esta es la descripcion', 909, 'cloth_1.jpg', 45, 1, 'XL', 'Blue'),
(32, 'Producto 29', 'Esta es la descripcion', 409, 'cloth_1.jpg', 78, 1, 'XL', 'Blue'),
(33, 'Producto 30', 'Esta es la descripcion', 936, 'cloth_1.jpg', 4, 1, 'XL', 'Blue'),
(34, 'Producto 31', 'Esta es la descripcion', 603, 'cloth_1.jpg', 3, 1, 'XL', 'Blue'),
(35, 'Producto 32', 'Esta es la descripcion', 160, 'cloth_1.jpg', 35, 1, 'XL', 'Blue'),
(36, 'Producto 33', 'Esta es la descripcion', 262, 'cloth_1.jpg', 92, 1, 'XL', 'Blue'),
(37, 'Producto 34', 'Esta es la descripcion', 961, 'cloth_1.jpg', 4, 1, 'XL', 'Blue'),
(38, 'Producto 35', 'Esta es la descripcion', 50, 'cloth_1.jpg', 75, 1, 'XL', 'Blue'),
(39, 'Producto 36', 'Esta es la descripcion', 862, 'cloth_1.jpg', 37, 1, 'XL', 'Blue'),
(40, 'Producto 37', 'Esta es la descripcion', 908, 'cloth_1.jpg', 43, 1, 'XL', 'Blue'),
(41, 'Producto 38', 'Esta es la descripcion', 134, 'cloth_1.jpg', 40, 1, 'XL', 'Blue'),
(42, 'Producto 39', 'Esta es la descripcion', 228, 'cloth_1.jpg', 16, 1, 'XL', 'Blue'),
(43, 'Producto 40', 'Esta es la descripcion', 536, 'cloth_1.jpg', 38, 1, 'XL', 'Blue'),
(44, 'Producto 41', 'Esta es la descripcion', 291, 'cloth_1.jpg', 0, 1, 'XL', 'Blue'),
(45, 'Producto 42', 'Esta es la descripcion', 922, 'cloth_1.jpg', 62, 1, 'XL', 'Blue'),
(46, 'Producto 43', 'Esta es la descripcion', 956, 'cloth_1.jpg', 43, 1, 'XL', 'Blue'),
(47, 'Producto 44', 'Esta es la descripcion', 462, 'cloth_1.jpg', 62, 1, 'XL', 'Blue'),
(48, 'Producto 45', 'Esta es la descripcion', 889, 'cloth_1.jpg', 19, 1, 'XL', 'Blue'),
(49, 'Producto 46', 'Esta es la descripcion', 339, 'cloth_1.jpg', 30, 1, 'XL', 'Blue'),
(50, 'Producto 47', 'Esta es la descripcion', 187, 'cloth_1.jpg', 90, 1, 'XL', 'Blue'),
(51, 'Producto 48', 'Esta es la descripcion', 259, 'cloth_1.jpg', 39, 1, 'XL', 'Blue'),
(52, 'Producto 49', 'Esta es la descripcion', 109, 'cloth_1.jpg', 4, 1, 'XL', 'Blue'),
(53, 'asdasd', 'est aes la acti', 123, '1593837877.png', 0, 2, '12', 'ads'),
(54, 'aasd', '123', 123, '1593838107.png', 0, 1, '1', 'asd'),
(55, 'aasd', '123', 123, '1593838143.png', 0, 1, '1', 'asd'),
(56, 'aasd', '123', 123, '1593838156.png', -1, 1, '1', 'asd'),
(57, 'aasd12', '123', 123, '1593926291.png', -2, 1, '12', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_venta`
--

CREATE TABLE `productos_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_venta`
--

INSERT INTO `productos_venta` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio`, `subtotal`) VALUES
(1, 1, 3, 7, 40, 280),
(2, 1, 2, 30, 20, 600),
(3, 2, 3, 1, 40, 40),
(4, 2, 2, 1, 20, 20),
(5, 3, 2, 1, 20, 20),
(6, 4, 3, 1, 40, 40),
(7, 6, 3, 1, 40, 40),
(8, 7, 2, 1, 20, 20),
(9, 7, 1, 1, 60, 60),
(10, 8, 1, 1, 60, 60),
(11, 9, 1, 1, 60, 60),
(12, 11, 1, 1, 60, 60),
(13, 12, 1, 1, 60, 60),
(14, 13, 2, 1, 20, 20),
(15, 14, 2, 1, 20, 20),
(16, 15, 1, 1, 60, 60),
(17, 16, 1, 6, 60, 360),
(18, 17, 52, 2, 109, 218),
(19, 17, 3, 3, 844, 2532),
(20, 18, 52, 2, 109, 218),
(21, 18, 44, 3, 291, 873),
(22, 19, 51, 1, 259, 259),
(23, 20, 52, 1, 109, 109),
(24, 21, 57, 3, 123, 369),
(25, 22, 52, 1, 109, 109),
(26, 23, 53, 1, 123, 123),
(27, 24, 56, 2, 123, 246),
(28, 24, 48, 2, 889, 1778),
(29, 25, 55, 1, 123, 123),
(30, 25, 45, 1, 922, 922),
(31, 26, 54, 1, 123, 123),
(32, 27, 52, 5, 109, 545),
(33, 27, 50, 1, 187, 187),
(34, 28, 51, 1, 259, 259);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_perfil` varchar(300) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `telefono`, `email`, `password`, `img_perfil`, `nivel`) VALUES
(16, 'Luis Alberto Romero', '123123', 'grijalvaromero@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'admin'),
(21, 'Luis Alberto Romero', '+526361167434', 'grijalvaromero@gmail.com', '994b579fe9db3e4b8b4642b13f126b407c1d11e2', 'default.jpg', 'cliente'),
(22, 'qwe qw', '123', 'test@gmail.ccom', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'cliente'),
(23, '12 123', '123', 'grijalvaromero@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'cliente'),
(24, 'asd asd', '123', 'test@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', 'default.jpg', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_cupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `total`, `fecha`, `status`, `id_pago`, `id_cupon`) VALUES
(1, 1, 880, '2019-10-27 13:10:30', 'preparacion', 0, 0),
(2, 1, 60, '2020-06-03 12:06:53', 'preparacion', 0, 0),
(3, 1, 20, '2020-06-03 12:06:12', 'preparacion', 0, 0),
(4, 1, 40, '2020-06-03 12:06:37', 'preparacion', 0, 0),
(5, 2, 0, '2020-06-03 12:06:49', 'preparacion', 0, 0),
(6, 3, 40, '2020-06-03 12:06:36', 'preparacion', 0, 0),
(7, 4, 80, '2020-06-03 13:06:29', 'preparacion', 0, 0),
(8, 5, 60, '2020-06-03 14:06:42', 'preparacion', 0, 0),
(9, 6, 60, '2020-06-04 10:06:06', 'preparacion', 0, 0),
(10, 7, 0, '2020-06-04 10:06:07', 'preparacion', 0, 0),
(11, 8, 60, '2020-06-04 10:06:27', 'preparacion', 0, 0),
(12, 9, 60, '2020-06-04 08:06:53', 'preparacion', 0, 0),
(13, 10, 20, '2020-06-19 13:06:16', 'preparacion', 0, 0),
(14, 11, 20, '2020-06-19 13:06:42', 'preparacion', 0, 0),
(15, 12, 60, '2020-06-19 16:06:11', 'preparacion', 0, 0),
(16, 13, 360, '2020-06-19 16:06:14', 'preparacion', 0, 0),
(17, 14, 2750, '2020-06-26 13:06:03', 'preparacion', 0, 0),
(18, 15, 1091, '2020-06-26 16:06:44', 'preparacion', 0, 0),
(19, 16, 259, '2020-06-29 13:06:56', 'preparacion', 0, 0),
(20, 17, 109, '2020-07-10 17:07:55', '', 0, 0),
(21, 18, 369, '2020-07-10 17:07:18', '', 0, 0),
(22, 19, 109, '2020-07-20 17:07:55', '', 0, 0),
(23, 20, 123, '2020-07-21 07:07:50', '', 0, 0),
(24, 21, 2024, '2020-07-21 13:07:32', '', 0, 0),
(25, 22, 1045, '2020-07-21 13:07:56', '', 0, 3),
(26, 23, 123, '2020-07-21 14:07:42', '', 0, 0),
(27, 24, 732, '2020-07-21 15:07:57', '', 0, 0),
(28, 24, 259, '2020-07-21 15:07:49', '', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colore`
--
ALTER TABLE `colore`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id_envio`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `colore`
--
ALTER TABLE `colore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cupones`
--
ALTER TABLE `cupones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `productos_venta`
--
ALTER TABLE `productos_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
