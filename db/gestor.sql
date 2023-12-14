-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2023 at 06:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestor`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `habitacion` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ubicacion` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(35) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `habitacion`, `ubicacion`, `telefono`) VALUES
('655f7c40ace300.46370359', 'Casa 15', '896655f73b18', '4245663456'),
('655f90e455e106.25504292', 'Casa 27', '334655e297b3', '424897132'),
('655fbde3002f79.17374311', 'Apartamento 45', '629655f5b453', '485452152485'),
('655fd5e4a31457.27080679', 'Casa 1', '930655e29545', '5484515'),
('655fd63250e4a7.58626094', 'fwenkjfnewikj', '457655fd6257', '584155585'),
('655fd7db4ecf99.74963468', 'gregregreg', '896655f73b18', '7845415');

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_cliente` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `metodo_pago` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_cliente`, `metodo_pago`, `monto`, `fecha`) VALUES
('5bf2b967a5839e205a0c8f95c4e4673c', '655fbde3002f79.17374311', 'Dolares', 47.339999999999996, '2023-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` varchar(120) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_cliente` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_pago` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `n_botellones` int NOT NULL,
  `estado_pedido` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `id_pago`, `fecha`, `n_botellones`, `estado_pedido`) VALUES
('3f9b328da7e55108310029520fd3ea3e', '655f7c40ace300.46370359', NULL, '2023-11-26', 5, 'En Espera'),
('8904d8a0fb158072b5ca19111683b45c', '655fbde3002f79.17374311', '5bf2b967a5839e205a0c8f95c4e4673c', '2023-11-26', 3, 'En Espera'),
('c4c87e15afd32ef339c94fd17aecb94e', '655fd5e4a31457.27080679', NULL, '2023-11-26', 5, 'Atendido');

-- --------------------------------------------------------

--
-- Table structure for table `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `esDe` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ubicacion` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `esDe`, `ubicacion`) VALUES
('334655e297b3', 'CLDBXSW', 'Calle 48'),
('457655fd6257', 'CPSMHMX', 'LALALAND'),
('629655f5b453', 'RRRWYDS', 'Torre 7-A'),
('896655f73b18', 'CLDBXSW', 'Calle 15'),
('930655e29545', 'CLDBXSW', 'Calle 35');

-- --------------------------------------------------------

--
-- Table structure for table `urbanizacion`
--

CREATE TABLE `urbanizacion` (
  `id` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `urbanizacion` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `urbanizacion`
--

INSERT INTO `urbanizacion` (`id`, `urbanizacion`) VALUES
('CLDBXSW', 'Urbanizacion Hacienda Yucatan'),
('CPSMHMX', 'Excelente'),
('HCKLEAG', 'Don Jesus'),
('RRRWYDS', 'Ali Primera');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contrasena` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`) VALUES
(1, 'test', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `ubicacion` (`ubicacion`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_pago` (`id_pago`);

--
-- Indexes for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `esDe` (`esDe`);

--
-- Indexes for table `urbanizacion`
--
ALTER TABLE `urbanizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`ubicacion`) REFERENCES `ubicaciones` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_pago`) REFERENCES `pagos` (`id_pago`) ON UPDATE CASCADE;

--
-- Constraints for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`esDe`) REFERENCES `urbanizacion` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
