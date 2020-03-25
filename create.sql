-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 20-03-2020 a las 03:03:00
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

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `nuserid` int(11) NOT NULL COMMENT 'PK of User Table.',
  `sname` varchar(100) NOT NULL COMMENT 'User name.',
  `sfatherlastname` varchar(50) NOT NULL COMMENT 'Fathers lastname.',
  `smotherlastname` varchar(50) DEFAULT NULL COMMENT 'Mothers lastname.',
  `semail` varchar(50) DEFAULT NULL COMMENT 'User email.',
  `spassword` varchar(100) DEFAULT NULL COMMENT 'User password.',
  `dbirthdate` date NULL COMMENT 'User birth date.',
  `remember_token` varchar(100) NULL COMMENT 'Token remember session',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'User status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL COMMENT 'User create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'User modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the user',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Table.';

-- --------------------------------------------------------

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
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `ncategoryid` int(11) NOT NULL COMMENT 'PK of “Categories” Table.',
  `ncategoryparent` int(11) NOT NULL DEFAULT '0' COMMENT 'Category parent, in case exists.',
  `sname` varchar(100) NOT NULL COMMENT 'Category name.',
  `sshortdescription` varchar(20) NOT NULL COMMENT 'Category short description.',
  `sdescription` varchar(100) DEFAULT NULL COMMENT 'Category description.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Category status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='“Categories” Table.';

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
  `dcreatedon` datetime NOT NULL COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='“Products” Table.';

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `nuserid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “User” Table.';

--
-- AUTO_INCREMENT de la tabla `parameters`
--
ALTER TABLE `parameters`
  MODIFY `nparameterid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Parameter” Table.';

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `ncategoryid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Categories” Table.';

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `nproductid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Products” Table.';



-- INSERTS INICIALES

insert into user values (null,'Bryan','Amado','Miranda','eamadom2@gmail.com','123456',null,null,'A',now(),null,1,null);