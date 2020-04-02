-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 25-03-2020 a las 16:08:03
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `faunaideas`
--
CREATE DATABASE IF NOT EXISTS `faunaideas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `faunaideas`;

-- --------------------------------------------------------


CREATE TABLE `user` (
  `nuserid` int(11) NOT NULL COMMENT 'PK of User Table.',
  `sname` varchar(100) NOT NULL COMMENT 'User name.',
  `sfatherlastname` varchar(50) NOT NULL COMMENT 'Fathers lastname.',
  `smotherlastname` varchar(50) DEFAULT NULL COMMENT 'Mothers lastname.',
  `semail` varchar(50) DEFAULT NULL COMMENT 'User email.',
  `spassword` varchar(100) DEFAULT NULL COMMENT 'User password.',
  `remember_token` varchar(100) NULL COMMENT 'Token remember session',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'User status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL COMMENT 'User create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'User modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the user',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Table.';


--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`nuserid`, `sname`, `sfatherlastname`, `smotherlastname`, `semail`, `spassword`, `remember_token`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 'Bryan', 'Amado', 'Miranda', 'eamadom2@gmail.com', '$2y$10$Xxu9VrbcXuyu0xjc8SPx4evaT/MRmjhnnlMlLuA1IoerXo4iMnFq2', NULL, 'A', now(), NULL, 1, NULL),
(2, 'Angello', 'Del Carpio', 'Bravo', 'angellomijail10@gmail.com', '$2y$10$Xxu9VrbcXuyu0xjc8SPx4evaT/MRmjhnnlMlLuA1IoerXo4iMnFq2', NULL, 'A', now(), NULL, 1, NULL);



--
-- Estructura de tabla para la tabla `parameters`
--

CREATE TABLE `parameters` (
  `nparameterid` int(11) NOT NULL COMMENT 'PK of “Parameters” Table.',
  `sname` varchar(100) NOT NULL COMMENT 'Parameter name.',
  `scode` varchar(20) NOT NULL COMMENT 'Parameter short code.',
  `svalue` varchar(20) NOT NULL COMMENT 'Parameter value.',
  `sdescription` varchar(100) DEFAULT NULL COMMENT 'Parameter description.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Parameter status. A=Active, N=Inactive',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Parameter create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Parameter modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the parameter',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the parameter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameter Table.';

--
-- Volcado de datos para la tabla `parameters`
--

INSERT INTO `parameters` (`nparameterid`, `sname`, `scode`, `svalue`, `sdescription`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 'Nombre Sitio', 'SITENAME', 'Fauna & Ideas', 'Nombre largo del sitio', 'A', now(), NULL, 1, NULL);



-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `ncategoryid` int(11) NOT NULL COMMENT 'PK of “Categories” Table.',
  `ncategoryparent` int(11) NOT NULL DEFAULT '0' COMMENT 'Category parent id, in case exists.',
  `sname` varchar(100) NOT NULL COMMENT 'Category name.',
  `sshortdescription` varchar(20) NOT NULL COMMENT 'Category short description.',
  `sdescription` varchar(100) DEFAULT NULL COMMENT 'Category description.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Category status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='“Categories” Table.';

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`ncategoryid`, `ncategoryparent`, `sname`, `sshortdescription`, `sdescription`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 0, 'Agendas', 'AGENDA-H', 'Agendas para hombres', 'A', '2020-03-20 15:37:01', NULL, NULL, NULL),
(2, 1, 'Agenda Mujer 3', 'AGENDA-M3', 'Agenda para mujeres 3', 'A', '2020-03-20 17:59:40', NULL, 1, NULL),
(3, 1, 'Agendas unisex', 'AGENDA-U', 'Agendas para ambos sexos', 'A', '2020-03-20 18:13:45', NULL, 1, NULL),
(4, 1, 'Agenda Niños', 'AGENDA-N', 'Agenda para niños', 'A', '2020-03-20 18:25:17', NULL, 1, NULL),
(5, 1, 'Agenda 3ra edad', 'AGENDA-3RA', 'Agenda para la tercera edad', 'A', '2020-03-20 18:27:47', NULL, 1, NULL),
(6, 1, 'Agenda oficina', 'AGENDA-O', 'Agenda para oficina', 'A', '2020-03-20 18:30:11', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `nproductid` int(11) NOT NULL COMMENT 'PK of “Products” Table.',
  `sname` varchar(128) NOT NULL COMMENT 'Product name.',
  `sdescription` varchar(2000) DEFAULT NULL COMMENT 'Product description.',
  `sthumbnail` varchar(256) NOT NULL COMMENT 'Product thumbnail.',
  `sfullimage` varchar(256) NOT NULL COMMENT 'Product full image.',
  `ncategoryid` int(11) NOT NULL COMMENT 'Category id.',
  `nsellerid` int(11) NOT NULL COMMENT 'Seller id.',
  `scategoryname` varchar(100) NOT NULL COMMENT 'Categoryname',
  `nmasterprice` decimal(10,2) NOT NULL COMMENT 'Product master price.',
  `nprice` decimal(10,2) NOT NULL,
  `ssku` varchar(64) NOT NULL COMMENT 'Product sku.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Product status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='“Products” Table.';

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`nproductid`, `sname`, `sdescription`, `sthumbnail`, `sfullimage`, `ncategoryid`, `nsellerid`, `scategoryname`, `nmasterprice`, `nprice`, `ssku`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 'Producto Prueba 1', 'Descripcion', 'https://in.canon/media/image/2018/05/03/642e7bbeae5741e3b872e082626c0151_eos6d-mkii-ef-24-70m-l.png', 'https://in.canon/media/image/2018/05/03/642e7bbeae5741e3b872e082626c0151_eos6d-mkii-ef-24-70m-l.png', 3, 1, 'Agendas unisex', '900.00', '100.00', 'AGND-1', 'A', '2020-03-20 12:04:18', NULL, NULL, NULL),
(2, 'Producto Prueba 2', 'Descripcion', 'https://in.canon/media/image/2018/05/03/642e7bbeae5741e3b872e082626c0151_eos6d-mkii-ef-24-70m-l.png', 'https://in.canon/media/image/2018/05/03/642e7bbeae5741e3b872e082626c0151_eos6d-mkii-ef-24-70m-l.png', 1, 1, '-', '10.20', '10.20', '-', 'A', '2020-03-20 12:05:06', NULL, NULL, NULL),
(3, 'Agenda mujer Fauna 1', 'Agenda mujer Fauna 1', 'https://in.canon/media/image/2018/05/03/642e7bbeae5741e3b872e082626c0151_eos6d-mkii-ef-24-70m-l.png', 'https://in.canon/media/image/2018/05/03/642e7bbeae5741e3b872e082626c0151_eos6d-mkii-ef-24-70m-l.png', 2, 1, 'Agenda Mujer 3', '100.00', '90.00', 'AGNM-1', 'A', '2020-03-23 15:50:23', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_attribute`
--

CREATE TABLE `product_attribute` (
  `nproductattributeid` int(11) NOT NULL COMMENT 'PK of “Product attribute” Table.',
  `nproductid` int(11) NOT NULL COMMENT 'FK of “Product” Table.',
  `sname` varchar(45) NOT NULL COMMENT 'Product name.',
  `svalue` varchar(45) NOT NULL COMMENT 'Product value.',
  `ntypeid` varchar(45) NOT NULL COMMENT 'Type id.',
  `stypename` varchar(45) NOT NULL COMMENT 'Type name.',
  `sflagdescriptive` varchar(45) NOT NULL DEFAULT 'Y' COMMENT 'Flag of description.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Product status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product_attribute`
--

INSERT INTO `product_attribute` (`nproductattributeid`, `nproductid`, `sname`, `svalue`, `ntypeid`, `stypename`, `sflagdescriptive`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 1, 'Marca', 'Canon', '18', 'Descriptivo', '0', 'A', '2020-03-24 15:02:44', NULL, 1, NULL),
(2, 1, 'Año', '2019', '18', 'Descriptivo', '0', 'A', '2020-03-24 15:03:11', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types`
--

CREATE TABLE `types` (
  `ntypeid` int(11) NOT NULL COMMENT 'PK of “Types” Table.',
  `ntypeparentid` int(11) NOT NULL DEFAULT '0' COMMENT 'Parent type id, in case exists.',
  `sname` varchar(50) NOT NULL COMMENT 'Type name.',
  `sdescription` varchar(200) DEFAULT NULL COMMENT 'Type description.',
  `sextension` varchar(15) NOT NULL DEFAULT '-' COMMENT 'Type extension, in case exists.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Product status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `types`
--

INSERT INTO `types` (`ntypeid`, `ntypeparentid`, `sname`, `sdescription`, `sextension`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 0, 'Archivos', 'Archivos y/o documentos subidos al servidor.', '-', 'A', '2020-03-24 12:48:35', NULL, 1, NULL),
(2, 0, 'Imágenes', 'Archivos de imagen', '-', 'A', '2020-03-24 12:52:04', NULL, 1, NULL),
(3, 0, 'Audios', 'Archivos de audios', '-', 'A', '2020-03-24 12:52:37', NULL, 1, NULL),
(4, 0, 'Atributos de productos', 'Atributos de los productos creados', '-', 'A', '2020-03-24 12:55:58', NULL, 1, NULL),
(5, 1, 'PDF', 'Archivo de tipo PDF', '.pdf', 'A', '2020-03-24 12:59:40', NULL, 1, NULL),
(6, 1, 'DOC', 'Archivo de tipo DOC', '.doc', 'A', '2020-03-24 13:00:12', NULL, 1, NULL),
(7, 1, 'EXCEL', 'Archivo de tipo EXCEL', '.xls', 'A', '2020-03-24 13:00:43', NULL, 1, NULL),
(8, 1, 'PPT', 'Archivo de tipo PPT', '.ppt', 'A', '2020-03-24 13:01:24', NULL, 1, NULL),
(9, 1, 'TEXTO', 'Archivo de tipo texto plano', '.txt', 'A', '2020-03-24 13:01:45', NULL, 1, NULL),
(10, 1, 'LOG', 'Archivo de tipo LOG', '.log', 'A', '2020-03-24 13:02:00', NULL, 1, NULL),
(11, 1, 'CSV', 'Archivo de tipo CSV', '.csv', 'A', '2020-03-24 13:02:13', NULL, 1, NULL),
(12, 1, 'ZIP', 'Archivo de tipo ZIP', '.zip', 'A', '2020-03-24 13:07:16', NULL, 1, NULL),
(13, 1, 'RAR', 'Archivo de tipo RAR', '.rar', 'A', '2020-03-24 13:07:31', NULL, 1, NULL),
(14, 2, 'JPG', 'Archivo de tipo JPG', '.jpg', 'A', '2020-03-24 13:07:51', NULL, 1, NULL),
(15, 2, 'JPEG', 'Archivo de tipo JPEG', '.jpeg', 'A', '2020-03-24 13:08:01', NULL, 1, NULL),
(16, 2, 'PNG', 'Archivo de tipo PNG', '.png', 'A', '2020-03-24 13:08:14', NULL, 1, NULL),
(17, 0, 'Videos', 'Archivos de video', '-', 'A', '2020-03-24 13:10:28', NULL, 1, NULL),
(18, 4, 'Descriptivo', 'Tipo de valor descriptivo', '-', 'A', '2020-03-24 13:12:13', NULL, 1, NULL),
(19, 4, 'Definición', 'Tipo de valor de definición', '-', 'A', '2020-03-24 13:12:38', NULL, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nuserid`);

--
-- Indices de la tabla `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`nparameterid`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ncategoryid`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`nproductid`);

--
-- Indices de la tabla `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`nproductattributeid`),
  ADD KEY `dsd_idx` (`nproductid`);


-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `nuserid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “User” Table.';

--
-- AUTO_INCREMENT de la tabla `parameters`
--
ALTER TABLE `parameters`
  MODIFY `nparameterid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Parameter” Table.';


-- Indices de la tabla `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`ntypeid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `ncategoryid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Categories” Table.', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `nproductid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Products” Table.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `nproductattributeid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Product attribute” Table.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `types`
--
ALTER TABLE `types`
  MODIFY `ntypeid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Types” Table.', AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `nproductid_fk` FOREIGN KEY (`nproductid`) REFERENCES `products` (`nproductid`) ON DELETE CASCADE ON UPDATE CASCADE;