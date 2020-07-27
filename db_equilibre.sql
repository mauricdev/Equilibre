-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 01:25 AM
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
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Camillas', 'Esta son camillas full power', 1),
(2, 'Pelotas', 'Estos son pelotas kinesiologicas muy full', 1),
(4, 'Pesas', 'Pesas para kinesiologia', 1),
(5, 'Pesas', 'Estas son pesas full bacanes 2', 0),
(6, 'sad', 'asdasd', 0),
(7, 'asdasd', 'asdasd', 0),
(8, 'asdasd', 'asdasd', 0),
(9, 'asdasd', 'asdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `idventa` int(11) NOT NULL,
  `Persona_rut` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `idproducto` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` float DEFAULT NULL,
  `precio_unitario` float DEFAULT NULL,
  `precio_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`idventa`, `Persona_rut`, `idproducto`, `cantidad`, `precio_unitario`, `precio_total`) VALUES
(2, '19677005-4', '780431289642', 2, 500000, 1000000);

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

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mauric.gutierr1995@gmail.com', 'ad0d1f855f9d69769091a4bbd3b587e7bc2fd37be364e83fe1b8e455aa3646dd', '2020-07-27 21:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `rut` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`rut`, `nombre`, `apellidos`, `correo`, `direccion`, `ciudad`, `telefono`) VALUES
('18821824-5', 'Mauricio ', 'Gutierrez Sanhueza', 'Mauric.gutierr1995@gmail.com', 'Mi casa', 'Coronel', 952429788),
('188218245', 'asdqasd', 'qwasd', 'asd@gmail.com', 'asdasd', 'asdasd', 123123),
('19677005-4', 'Jorge', 'Troncoso Irribarra', 'j.troncosoi@gmail.com', 'Mi casa', 'Tomé', 912345678);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idproducto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `unidad_medida` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio_compra` float DEFAULT NULL,
  `precio_venta` float DEFAULT NULL,
  `precio_descuento` float DEFAULT NULL,
  `stock` float DEFAULT NULL,
  `stock_critico` float DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `imagen` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  `Proveedor_idProveedor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Estado` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `unidad_medida`, `precio_compra`, `precio_venta`, `precio_descuento`, `stock`, `stock_critico`, `descuento`, `imagen`, `categoria_idcategoria`, `Proveedor_idProveedor`, `Estado`) VALUES
('780431289642', 'Pesas 12 kgs', 'Gramos', 50000, 70000, 70000, 75.5, 100, 0, 'pesa.jpg', 4, '2', 'Activo'),
('780432874121', 'Pelota morada', 'Unidad', 10000, 20000, 20000, 100, 20, 0, 'pelota_morada.jpg', 1, '1', 'Activo'),
('780784574845', 'Camilla tipo 1', 'Unidad', 100000, 200000, 200000, 100, 20, 0, 'camilla.jpg', 1, '1', 'Activo'),
('780987256314', 'Camilla para masajes', 'Unidad', 150000, 250000, 250000, 20, 5, 0, 'camilla-de-masaje.jpg', 1, '1', 'Inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `razonsocial` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pais` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `razonsocial`, `direccion`, `ciudad`, `pais`, `telefono`, `correo`, `descripcion`, `Estado`) VALUES
('1', 'Razón social de provedor 12312323', 'La direccion del proveedor', 'Ciudad del proveedor', 'Pais del proveedor', '+569123456789', 'Proveedor@proveedor.com', 'Esto es una descrioción larga del proveedor', 1),
('18821824-5', 'asdasdad2', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 1),
('2', 'Esta es una razón social de proveedores 2', 'La direccion del proveedor	', 'Ciudad del proveedor', 'Pais del proveedor', '+569123456789', 'Proveedor2@proveedor.com', 'Esto es una descrioción larga del proveedor', 1),
('3', 'Razón social de proveedores', 'asdasd', 'asdas', 'asd', 'asdas', 'asdasd', 'asdasda', 1),
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
(1, 'Mauricio Gutierrez', 'mauric.gutierr1995@gmail.com', '$2y$10$5MZzvxQsJ2top09H0Tqh7.vcYZYgOH2OBvtlew0JKCLn.s8U58t5y', 'hLJoSosRsl2T5aUcY8ppu7eGKwfo6ATymTELctqFwbb9o0DqensChAJLdnTW', '2020-07-27 20:59:57', '2020-07-27 23:18:54'),
(2, 'Juanito', 'Juanito1@gmail.com', '$2y$10$hsR454MBlUwaJojMBB6KdOM6jiuBVBVV5dOOUlMfGSFPAL6lg3/Ay', NULL, '2020-07-27 21:53:07', '2020-07-27 21:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `total_venta` float DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `Persona_rut` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Estado` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`idventa`, `total_venta`, `fecha`, `Persona_rut`, `Estado`) VALUES
(1, 500000, '2020-07-27 14:45:34', '18821824-5', 1),
(2, 200000, '2020-07-27 14:47:34', '19677005-4', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`idventa`,`Persona_rut`,`idproducto`),
  ADD KEY `fk_dventa_producto_idx` (`idproducto`);

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
  ADD PRIMARY KEY (`idproducto`,`categoria_idcategoria`,`Proveedor_idProveedor`),
  ADD KEY `fk_producto_categoria1_idx` (`categoria_idcategoria`),
  ADD KEY `fk_producto_Proveedor1_idx` (`Proveedor_idProveedor`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

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
  ADD PRIMARY KEY (`idventa`,`Persona_rut`),
  ADD KEY `fk_venta_Persona_idx` (`Persona_rut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_dventa_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dventa_venta` FOREIGN KEY (`idventa`,`Persona_rut`) REFERENCES `venta` (`idventa`, `Persona_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_proveedor1` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_Persona` FOREIGN KEY (`Persona_rut`) REFERENCES `persona` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
