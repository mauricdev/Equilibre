-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2020 a las 02:51:28
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_equilibre`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `categoriacol` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `estado`, `categoriacol`) VALUES
(1, 'Camillas', 'Esta son camillas full power', 1, NULL),
(2, 'Pelotas', 'Estos son pelotas kinesiologicas muy full', 1, NULL),
(3, 'Pesas', 'Pesas para kinesiologia', 1, NULL),
(4, 'vendas', 'vendas venditas', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `ingreso_idingreso` int(11) NOT NULL,
  `producto_idproducto` bigint(255) NOT NULL,
  `cantidad` float NOT NULL,
  `precio_compra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`ingreso_idingreso`, `producto_idproducto`, `cantidad`, `precio_compra`) VALUES
(1, 780431289642, 10, 10000),
(54, 7, 1, 1),
(54, 8, 1, 1),
(55, 780431289642, 1, 1),
(57, 7, 1, 1),
(58, 7, 1, 1),
(58, 8, 1, 1),
(60, 7, 1, 1),
(61, 7, 1, 1),
(62, 7, 2, 2),
(62, 8, 2, 2),
(65, 7, 2, 2),
(65, 8, 2, 2),
(66, 780431289642, 3, 3),
(67, 780431289642, 2, 5000),
(68, 780431289642, 1, 1),
(70, 12345678978, 10, 5000),
(70, 780432874121, 3, 6000);

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN
     UPDATE producto SET stock = stock + NEW.cantidad
        WHERE producto.idproducto =NEW.producto_idproducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `producto_idproducto` bigint(50) NOT NULL,
  `cantidad` float NOT NULL,
  `precio_unitario` float NOT NULL,
  `precio_total` float NOT NULL,
  `venta_idventa` int(11) NOT NULL,
  `venta_persona_rut` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`producto_idproducto`, `cantidad`, `precio_unitario`, `precio_total`, `venta_idventa`, `venta_persona_rut`, `descripcion`) VALUES
(780431289642, 4, 70000, 280000, 1, '19677005-4', ''),
(780431289642, 1, 56000, 56000, 3, '7002352-0', ''),
(780431289642, 2, 56000, 112000, 4, '19677005-4', ''),
(780432874121, 2, 20000, 40000, 1, '19677005-4', ''),
(780432874121, 2, 20000, 40000, 2, '10192512-9', 'falta almenos 2 de stock para poder completar el pedido de este producto'),
(780432874121, 1, 20000, 20000, 3, '7002352-0', ''),
(780784574845, 1, 200000, 200000, 1, '19677005-4', '');

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `Str_actualizarStockventa` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
     UPDATE producto SET stock = stock - NEW.cantidad
        WHERE producto.idproducto =NEW.producto_idproducto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `fechaHora` datetime(6) NOT NULL,
  `tipoComprobante` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `numeroComprobante` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `proveedor_idproveedor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `fechaHora`, `tipoComprobante`, `numeroComprobante`, `proveedor_idproveedor`, `Estado`) VALUES
(1, '2020-07-29 16:23:04.000000', 'Boleta', '123456789', '18821824-5', 1),
(6, '2020-07-30 10:19:12.000000', 'Boleta', '1', '1', 1),
(7, '2020-07-30 10:19:18.000000', 'Boleta', '1', '1', 1),
(8, '2020-07-30 10:19:48.000000', 'Factura', '123123123123', '4', 1),
(21, '2020-07-30 11:21:28.000000', 'Boleta', '87987987987', '1', 1),
(23, '2020-07-30 12:24:44.000000', 'Boleta', '123123', '1', 1),
(24, '2020-07-30 12:24:53.000000', 'Boleta', '123123', '1', 1),
(25, '2020-07-30 12:25:46.000000', 'Boleta', '1', '1', 1),
(26, '2020-07-30 12:27:24.000000', 'Boleta', '123123', '1', 1),
(27, '2020-07-30 13:32:55.000000', 'Boleta', '123123', '1', 1),
(28, '2020-07-30 13:42:53.000000', 'Boleta', '123123', '1', 1),
(29, '2020-07-30 13:43:30.000000', 'Boleta', '123', '1', 1),
(30, '2020-07-30 13:45:33.000000', 'Boleta', '123', '1', 1),
(31, '2020-07-30 13:45:59.000000', 'Boleta', '12', '1', 1),
(32, '2020-07-30 13:46:28.000000', 'Boleta', '10', '1', 1),
(33, '2020-07-30 13:47:27.000000', 'Boleta', '123', '1', 1),
(34, '2020-07-30 13:48:04.000000', 'Boleta', '569', '1', 1),
(36, '2020-07-30 13:49:40.000000', 'Boleta', '123', '1', 1),
(37, '2020-07-30 13:51:17.000000', 'Boleta', '1', '1', 1),
(38, '2020-07-30 13:52:37.000000', 'Factura', '12', '1', 1),
(39, '2020-07-30 13:53:47.000000', 'Boleta', '12', '1', 1),
(42, '2020-07-30 13:55:50.000000', 'Factura', '123', '1', 1),
(43, '2020-07-30 13:56:03.000000', 'Factura', '987', '1', 1),
(46, '2020-07-30 14:23:07.000000', 'Boleta', '54', '1', 1),
(47, '2020-07-30 14:23:27.000000', 'Factura', '12345678', '1', 1),
(49, '2020-07-30 14:25:51.000000', 'Factura', '3789462378346', '1', 1),
(50, '2020-07-30 14:26:02.000000', 'Boleta', '3434343', '1', 1),
(51, '2020-07-30 14:27:09.000000', 'Boleta', '3', '1', 1),
(52, '2020-07-30 14:27:50.000000', 'Boleta', '1', '1', 1),
(54, '2020-07-30 14:45:52.000000', 'Boleta', '1', '1', 1),
(55, '2020-07-30 14:49:09.000000', 'Boleta', '1', '1', 1),
(57, '2020-07-30 14:51:11.000000', 'Boleta', '1', '1', 1),
(58, '2020-07-30 14:51:21.000000', 'Boleta', '1', '1', 1),
(60, '2020-07-30 14:52:37.000000', 'Boleta', '1', '1', 1),
(61, '2020-07-30 14:52:45.000000', 'Boleta', '1', '1', 1),
(62, '2020-07-30 14:53:07.000000', 'Boleta', '2', '1', 1),
(65, '2020-07-30 14:56:27.000000', 'Boleta', '2', '1', 1),
(66, '2020-07-30 14:56:35.000000', 'Boleta', '3', '1', 1),
(67, '2020-07-30 15:44:45.000000', 'Factura', '123', '4', 1),
(68, '2020-07-30 15:45:48.000000', 'Boleta', '1', '1', 1),
(70, '2020-08-21 20:44:23.000000', 'Factura', '123456789456', '19677005-4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `rut` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`rut`, `nombre`, `apellidos`, `correo`, `direccion`, `ciudad`, `telefono`) VALUES
('10192512-9', 'Jorge', 'Troncoso Iturra', 'correoprueba@gmail.com', 'Edmundo Witting 503', 'Tomé', '988776655'),
('18529988-0', 'alejandro', 'Troncoso', 'alejandro@gmail.com', 'edmundo witin 503', 'tome', '912345678'),
('18821824-5', 'Mauricio ', 'Gutierrez Sanhueza', 'Mauric.gutierr1995@gmail.com', 'Mi casa', 'Coronel', '952429788'),
('19677005-4', 'Jorge', 'Troncoso', 'j.troncosoi97@gmail.com', 'Edmundo Witting 505', 'Tomé', '912345678'),
('7002352-0', 'Jorge', 'Troncoso', 'j.troncosoi97@gmail.com', 'Calle nueva 321', 'concepcion', '123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(50) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `unidad_medida` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `precio_descuento` float NOT NULL,
  `stock` float NOT NULL,
  `stock_critico` float NOT NULL,
  `descuento` float NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Estado` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `unidad_medida`, `precio_compra`, `precio_venta`, `precio_descuento`, `stock`, `stock_critico`, `descuento`, `imagen`, `Estado`, `categoria_idcategoria`) VALUES
(12345678978, 'Venda 1', 'unidad', 50000, 70000, 49000, 20, 10, 30, '555.png', 1, 1),
(780431289642, 'Pesas 12 kgs', 'Gramos', 50000, 70000, 56000, 90.5, 100, 20, 'pesa.jpg', 1, 1),
(780432874121, 'Pelota morada', 'Unidad', 10000, 20000, 20000, 12, 20, 0, 'pelota_morada.jpg', 1, 1),
(780784574845, 'Camilla tipo 1', 'Unidad', 100000, 200000, 200000, 88, 20, 0, 'camilla.jpg', 1, 1),
(780987256314, 'Camilla para masajes', 'Unidad', 150000, 250000, 250000, 19, 5, 0, 'camilla-de-masaje.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `razonsocial` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `razonsocial`, `direccion`, `ciudad`, `pais`, `telefono`, `correo`, `descripcion`, `Estado`) VALUES
('1', 'Razón social de provedor 12312323', 'La direccion del proveedor', 'Ciudad del proveedor', 'Pais del proveedor', '+569123456789', 'Proveedor@proveedor.com', 'Esto es una descrioción larga del proveedor', 1),
('18821824-5', 'asdasdad2', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 0),
('19677005-4', 'jorge co', 'hola mi casa', 'tome', 'chile', '452132123', 'correo@correo.cl', 'es la persona que me deja baratas la vendas', 1),
('2', 'Razón', 'La direccion del proveedor	', 'Ciudad del proveedor', 'Pais del proveedor', '+569123456789', 'Proveedor2@proveedor.com', 'Esto es una descrioción larga del proveedor', 0),
('3', 'Razón social de proveedores', 'asdasd', 'asdas', 'asd', 'asdas', 'asdasd', 'asdasda', 0),
('4', 'RODRIGUEZ SANDOVAL', 'Lejos', 'Taiwan', 'China', '+86 123456789', 'mauric.gutierr1995@gmail.com', 'Esto es una descripción', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mauricio Gutierrez S', 'mauric.gutierr1995@gmail.com', '$2y$10$UNPJ58foXdKAGk2Qz./jE.jpDrg.qDEwGzyJOxzkwSebZYSKNXrZS', 'YM0rD4KHsezBWMF1CVEjuKC2sZZYOg5MDb9PLSUOrpny7cor1CS7m3e0rrCS', '2020-07-28 00:59:57', '2020-07-30 19:21:45'),
(3, 'koke', 'koke@gmail.com', '$2y$10$eqrYWFdAAL1mAPa/xXYi9.dpYyVNvgUsPzMSlnZvgohA0XVTBtScq', '6KIgk7ttCoCG1XPAMHGzaWxgjUJhwgGJJSgKf5iM6p5JggYKEDSYZaEyfyLB', '2020-07-29 15:28:45', '2020-08-22 00:56:33'),
(4, 'Juan', 'Juan@gmail.com', '123456', NULL, '2020-07-30 19:34:03', '2020-07-30 19:34:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `total_venta` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaHora` datetime(6) NOT NULL,
  `Estado` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `persona_rut1` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `n_orden` int(11) NOT NULL,
  `token` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `ordencomercio` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `total_venta`, `fechaHora`, `Estado`, `persona_rut1`, `n_orden`, `token`, `descripcion`, `ordencomercio`) VALUES
(1, '520000', '2020-08-21 18:00:38.000000', '1', '19677005-4', 309724, 'A0DAE0725CC10876F3F597454F603185660D041P', '', 1426041023),
(2, '40000', '2020-08-21 18:00:46.000000', '0', '10192512-9', 309723, '3B723E6783A8DC94772E350FFFCA587C9438E47X', 'esta venta ya fue pagada pero falta stock de uno de los productos para poder completar el pedido', 666267174),
(3, '76000', '2020-08-21 20:30:04.000000', '1', '7002352-0', 309812, '99E1E9F1AC3E87580F124A538B47A88BA9CA19FF', '', 1559033621),
(4, '133280', '2020-08-24 20:48:39.000000', '1', '19677005-4', 311217, 'B9A59E6F60014C7D317EA7FCE8EC7938D3FB497V', '', 643523401);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`ingreso_idingreso`,`producto_idproducto`),
  ADD KEY `fk_detalle_ingreso_ingreso_idx` (`ingreso_idingreso`),
  ADD KEY `fk_detalle_ingreso_producto_idx` (`producto_idproducto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`producto_idproducto`,`venta_idventa`,`venta_persona_rut`) USING BTREE,
  ADD KEY `fk_venta_has_producto_producto1_idx` (`producto_idproducto`),
  ADD KEY `fk_detalle_venta_venta1_idx` (`venta_idventa`,`venta_persona_rut`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`,`proveedor_idproveedor`),
  ADD KEY `fk_ingreso_proveedor1_idx` (`proveedor_idproveedor`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_producto_categoria1` (`categoria_idcategoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`,`persona_rut1`),
  ADD KEY `fk_venta_persona1_idx` (`persona_rut1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_proveedor1` FOREIGN KEY (`proveedor_idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_persona1` FOREIGN KEY (`persona_rut1`) REFERENCES `persona` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
