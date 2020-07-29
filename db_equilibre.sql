-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 05:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_equilibre`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `categoriacol` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `estado`, `categoriacol`) VALUES
(1, 'Camillas', 'Esta son camillas full power', 1, NULL),
(2, 'Pelotas', 'Estos son pelotas kinesiologicas muy full', 1, NULL),
(3, 'Pesas', 'Pesas para kinesiologia', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `ingreso_idingreso` int(11) NOT NULL,
  `ingreso_proveedor_idproveedor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_idproducto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_categoria_idcategoria` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio_compra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Triggers `detalle_ingreso`
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
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `producto_idproducto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` float NOT NULL,
  `precio_unitario` float NOT NULL,
  `precio_total` float NOT NULL,
  `venta_idventa` int(11) NOT NULL,
  `venta_persona_rut` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`producto_idproducto`, `cantidad`, `precio_unitario`, `precio_total`, `venta_idventa`, `venta_persona_rut`) VALUES
('780431289642', 2, 500000, 1000000, 1, '18821824-5');

-- --------------------------------------------------------

--
-- Table structure for table `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `fechaHora` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `tipoComprobante` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `numeroComprobante` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `proveedor_idproveedor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
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
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`rut`, `nombre`, `apellidos`, `correo`, `direccion`, `ciudad`, `telefono`) VALUES
('18821824-5', 'Mauricio ', 'Gutierrez Sanhueza', 'Mauric.gutierr1995@gmail.com', 'Mi casa', 'Coronel', '952429788'),
('188218245', 'asdqasd', 'qwasd', 'asd@gmail.com', 'asdasd', 'asdasd', '123123'),
('19677005-4', 'Jorge', 'Troncoso Irribarra', 'j.troncosoi@gmail.com', 'Mi casa', 'Tomé', '912345678');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idproducto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
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
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `unidad_medida`, `precio_compra`, `precio_venta`, `precio_descuento`, `stock`, `stock_critico`, `descuento`, `imagen`, `Estado`, `categoria_idcategoria`) VALUES
('780431289642', 'Pesas 12 kgs', 'Gramos', 50000, 70000, 70000, 75.5, 100, 0, 'pesa.jpg', 0, 3),
('780432874121', 'Pelota morada', 'Unidad', 10000, 20000, 20000, 100, 20, 0, 'pelota_morada.jpg', 0, 1),
('780784574845', 'Camilla tipo 1', 'Unidad', 100000, 200000, 200000, 100, 20, 0, 'camilla.jpg', 0, 1),
('780987256314', 'Camilla para masajes', 'Unidad', 150000, 250000, 250000, 20, 5, 0, 'camilla-de-masaje.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
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
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `razonsocial`, `direccion`, `ciudad`, `pais`, `telefono`, `correo`, `descripcion`, `Estado`) VALUES
('1', 'Razón social de provedor 12312323', 'La direccion del proveedor', 'Ciudad del proveedor', 'Pais del proveedor', '+569123456789', 'Proveedor@proveedor.com', 'Esto es una descrioción larga del proveedor', 1),
('18821824-5', 'asdasdad2', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 1),
('2', 'Esta es una razón social de proveedores 2', 'La direccion del proveedor	', 'Ciudad del proveedor', 'Pais del proveedor', '+569123456789', 'Proveedor2@proveedor.com', 'Esto es una descrioción larga del proveedor', 1),
('3', 'Razón social de proveedores', 'asdasd', 'asdas', 'asd', 'asdas', 'asdasd', 'asdasda', 0),
('4', 'RODRIGUEZ SANDOVAL', 'Lejos', 'Taiwan', 'China', '+86 123456789', 'mauric.gutierr1995@gmail.com', 'Esto es una descripción', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mauricio Gutierrez', 'mauric.gutierr1995@gmail.com', '$2y$10$5MZzvxQsJ2top09H0Tqh7.vcYZYgOH2OBvtlew0JKCLn.s8U58t5y', 'LG7A1o42W1UiEeKnG8Ebd6FGka8gyVFG5sBTFKpyyFdrG7dWzmOSYZTINwzV', '2020-07-28 00:59:57', '2020-07-28 19:13:14'),
(2, 'Juanito', 'Juanito1@gmail.com', '$2y$10$hsR454MBlUwaJojMBB6KdOM6jiuBVBVV5dOOUlMfGSFPAL6lg3/Ay', NULL, '2020-07-28 01:53:07', '2020-07-28 01:59:07'),
(3, 'koke', 'koke@gmail.com', '123456', NULL, '2020-07-29 15:28:45', '2020-07-29 15:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `total_venta` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaHora` datetime(6) NOT NULL,
  `Estado` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `persona_rut1` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`idventa`, `total_venta`, `fechaHora`, `Estado`, `persona_rut1`) VALUES
(1, '1000000', '2020-07-28 13:53:00.000000', '1', '18821824-5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indexes for table `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`ingreso_idingreso`,`ingreso_proveedor_idproveedor`,`producto_idproducto`,`producto_categoria_idcategoria`),
  ADD KEY `fk_detalle_ingreso_ingreso1_idx` (`ingreso_idingreso`,`ingreso_proveedor_idproveedor`),
  ADD KEY `fk_detalle_ingreso_producto1_idx` (`producto_idproducto`,`producto_categoria_idcategoria`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`producto_idproducto`,`venta_idventa`,`venta_persona_rut`),
  ADD KEY `fk_venta_has_producto_producto1_idx` (`producto_idproducto`),
  ADD KEY `fk_detalle_venta_venta1_idx` (`venta_idventa`,`venta_persona_rut`);

--
-- Indexes for table `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`,`proveedor_idproveedor`),
  ADD KEY `fk_ingreso_proveedor1_idx` (`proveedor_idproveedor`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`rut`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`,`categoria_idcategoria`),
  ADD KEY `fk_producto_categoria1_idx` (`categoria_idcategoria`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`,`persona_rut1`),
  ADD KEY `fk_venta_persona1_idx` (`persona_rut1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso_ingreso1` FOREIGN KEY (`ingreso_idingreso`,`ingreso_proveedor_idproveedor`) REFERENCES `ingreso` (`idingreso`, `proveedor_idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_producto1` FOREIGN KEY (`producto_idproducto`,`producto_categoria_idcategoria`) REFERENCES `producto` (`idproducto`, `categoria_idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_venta1` FOREIGN KEY (`venta_idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_has_producto_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_proveedor1` FOREIGN KEY (`proveedor_idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_persona1` FOREIGN KEY (`persona_rut1`) REFERENCES `persona` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
