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
  `sprofilepicture` varchar(400) NULL DEFAULT 'images/img_5ea9e9ffdc7b1.png' COMMENT 'User profile picture',
  `sbiography` varchar(4000) NULL COMMENT 'User biography',
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

INSERT INTO `user` (`nuserid`, `sname`, `sfatherlastname`, `smotherlastname`,`sprofilepicture`,`sbiography`, `semail`, `spassword`, `remember_token`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 'Bryan', 'Amado', 'Miranda', null,null, 'eamadom2@gmail.com', '$2y$10$Xxu9VrbcXuyu0xjc8SPx4evaT/MRmjhnnlMlLuA1IoerXo4iMnFq2', NULL, 'A', now(), NULL, 1, NULL),
(2, 'Angello', 'Del Carpio', 'Bravo', null, null, 'angellomijail10@gmail.com', '$2y$10$Xxu9VrbcXuyu0xjc8SPx4evaT/MRmjhnnlMlLuA1IoerXo4iMnFq2', NULL, 'A', now(), NULL, 1, NULL);



--
-- Estructura de tabla para la tabla `parameters`
--

CREATE TABLE `parameters` (
  `nparameterid` int(11) NOT NULL COMMENT 'PK of “Parameters” Table.',
  `sname` varchar(100) NOT NULL COMMENT 'Parameter name.',
  `scode` varchar(20) NOT NULL COMMENT 'Parameter short code.',
  `svalue` varchar(150) NOT NULL COMMENT 'Parameter value.',
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
(1, 'Nombre Sitio', 'SITENAME', 'Fauna & Ideas', 'Nombre largo del sitio', 'A', now(), NULL, 1, NULL),
(2, 'Logo', 'LOGO', 'https://preview.oklerthemes.com/porto/8.0.0/img/logo-flat.png', 'Logo del sitio', 'A', now(), NULL, 1, NULL),
(3, 'Twitter', 'TWITTER', 'http://twitter.com/', 'Enlace a Twitter', 'A', now(), NULL, 1, NULL),
(4, 'Facebook', 'FACEBOOK', 'https://www.facebook.com/', 'Enlace a Facebook', 'A', now(), NULL, 1, NULL);



-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `ncategoryid` int(11) NOT NULL COMMENT 'PK of “Categories” Table.',
  `ncategoryparent` int(11) NOT NULL DEFAULT '0' COMMENT 'Category parent id, in case exists.',
  `sname` varchar(100) NOT NULL COMMENT 'Category name.',
  `sshortdescription` varchar(20) NOT NULL COMMENT 'Category short description.',
  `sdescription` varchar(100) DEFAULT NULL COMMENT 'Category description.',
  `sfullimage` varchar(400) NOT NULL COMMENT 'Category full image.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Category status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='“Categories” Table.';

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`ncategoryid`, `ncategoryparent`, `sname`, `sshortdescription`, `sdescription`, `sfullimage`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 0, 'Agendas', 'AGENDA-H', 'Agendas para hombres', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-03-20 15:37:01', NULL, NULL, NULL),
(2, 1, 'Agenda Mujer 3', 'AGENDA-M3', 'Agenda para mujeres 3', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-03-20 17:59:40', NULL, 1, NULL),
(3, 1, 'Agendas unisex', 'AGENDA-U', 'Agendas para ambos sexos', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-03-20 18:13:45', NULL, 1, NULL),
(4, 1, 'Agenda Niños', 'AGENDA-N', 'Agenda para niños', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-03-20 18:25:17', NULL, 1, NULL),
(5, 1, 'Agenda 3ra edad', 'AGENDA-3RA', 'Agenda para la tercera edad', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-03-20 18:27:47', NULL, 1, NULL),
(6, 1, 'Agenda oficina', 'AGENDA-O', 'Agenda para oficina', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-03-20 18:30:11', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `nproductid` int(11) NOT NULL COMMENT 'PK of “Products” Table.',
  `sname` varchar(128) NOT NULL COMMENT 'Product name.',
  `sdescription` varchar(2000) DEFAULT NULL COMMENT 'Product description.',
  `slongdescription` varchar(4000) DEFAULT NULL COMMENT 'Product long description.',
  `sthumbnail` varchar(256) NOT NULL COMMENT 'Product thumbnail.',
  `sfullimage` varchar(256) NOT NULL COMMENT 'Product full image.',
  `ncategoryid` int(11) NOT NULL COMMENT 'Category id.',
  `nsellerid` int(11) NOT NULL COMMENT 'Seller id.',
  `scategoryname` varchar(100) NOT NULL COMMENT 'Categoryname',
  `nmasterprice` decimal(10,2) NOT NULL COMMENT 'Product master price.',
  `nprice` decimal(10,2) NOT NULL,
  `ssku` varchar(64) NOT NULL COMMENT 'Product sku.',
  `shighlighted` char(1) NOT NULL DEFAULT 'N' COMMENT 'Product highlight. Y=Yes, N=No',
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
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `nfileid` int(11) NOT NULL COMMENT 'PK of “Files” Table.',
  `ntypeid` int(11) NOT NULL DEFAULT '0' COMMENT 'Type ID. FK of Types table.',
  `sname` varchar(100) NOT NULL COMMENT 'File name.',
  `sshortdescription` varchar(50) DEFAULT NULL COMMENT 'File short description',
  `sdescription` varchar(400) DEFAULT NULL COMMENT 'File description.',
  `spath` varchar(100) NOT NULL DEFAULT '-' COMMENT 'File relative path.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'File status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'File create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'File modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the file',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the file'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(19, 4, 'Definición', 'Tipo de valor de definición', '-', 'A', '2020-03-24 13:12:38', NULL, 1, NULL),
(20, 0, 'Objetos Slider', 'Objetos que pueden aparecer en el slider principal', '-', 'A', now(), NULL, 1, NULL),
(21, 20, 'Producto', 'Producto', '-', 'A', now(), NULL, 1, NULL),
(22, 20, 'Categoría', 'Categoría', '-', 'A', now(), NULL, 1, NULL),
(23, 20, 'Catálogo', 'Catálogo', '-', 'A', now(), NULL, 1, NULL);


--
-- Estructura de tabla para la tabla `catalog`
--

CREATE TABLE `catalog` (
  `ncatalogid` int(11) NOT NULL COMMENT 'PK of “Catalog” Table.',
  `sname` varchar(50) NOT NULL COMMENT 'Catalog name.',
  `sdescription` varchar(200) NOT NULL DEFAULT '-' COMMENT 'Catalog description.',
  `sfullimage` varchar(256) NOT NULL COMMENT 'Catalog full image.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Catalog status. A=Active, N=Inactive, M=Modified, E=Exported',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Catalog create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Catalog modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the catalog',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the catalog'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Volcado de datos para la tabla `catalog`
--

INSERT INTO `catalog` (`ncatalogid`, `sname`, `sdescription`, `sfullimage`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 'Catálogo 1', 'Primer catálogo', 'http://localhost/Fauna-Ideas/public/portal/images/banners/home-banner1.jpg','A', now(), NULL, 1, NULL),
(2, 'Catálogo 2', 'Segundo catálogo', 'http://localhost/Fauna-Ideas/public/portal/images/banners/home-banner2.jpg','A', now(), NULL, 1, NULL),
(3, 'Catálogo 3', 'Tercer catálogo', 'http://localhost/Fauna-Ideas/public/portal/images/banners/home-banner3.jpg','A', now(), NULL, 1, NULL),
(4, 'Catálogo 4', 'Cuarto catálogo', 'http://localhost/Fauna-Ideas/public/portal/images/banners/home-banner4.jpg','A', now(), NULL, 1, NULL);




CREATE TABLE `catalog_product` (
  `ncatalogproductid` int(11) NOT NULL COMMENT 'PK of “Catalog product” Table.',
  `ncatalogid` int(11) NOT NULL COMMENT 'FK of “Catalog” Table.',
  `nproductid` int(11) NOT NULL COMMENT 'FK of “Product” Table.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Product status. A=Active, N=Inactive',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Category create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Category modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the category',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `slides`
--

CREATE TABLE `slides` (
  `nslideid` int(11) NOT NULL COMMENT 'PK of Slides Table.',
  `nobjecttype` int(11) NOT NULL DEFAULT '0' COMMENT 'Type ID. FK of Types table.',
  `nobjectid` int(11) NOT NULL DEFAULT '0' COMMENT 'Object ID',
  `smaintext` varchar(50) NOT NULL DEFAULT '-' COMMENT 'Slide main text.',
  `ssecondarytext` varchar(50) NOT NULL DEFAULT '-' COMMENT 'Slide secondary text.',
  `sbuttontext` varchar(50) NOT NULL DEFAULT '-' COMMENT 'Slide button text.',
  `sfullimage` varchar(256) NOT NULL COMMENT 'Slide full image.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Slide status. A=Active, N=Inactive',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Slide create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Slide modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the slide',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the slide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `blog_categories`
--

CREATE TABLE `blog_categories` (
  nblogcategoryid INT NOT NULL AUTO_INCREMENT COMMENT 'PK of Blog categories table.',
  nblogcategoryparentid INT(11) NOT NULL DEFAULT '0' COMMENT 'Blog category parent id, in case exists.',
  sname VARCHAR(100) NOT NULL COMMENT 'Blog category name.',
  sshortdescription VARCHAR(20) NOT NULL COMMENT 'Blog category short description.',
  sdescription VARCHAR(100) NULL DEFAULT NULL COMMENT 'Blog category description.',
  sfullimage VARCHAR(400) NOT NULL COMMENT 'Blog category full image.',
  sstatus CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Blog category status. A=Active, N=Inactive, M=Modified, E=Exported.',
  dcreatedon DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Blog category create date.',
  dmodifiedon DATETIME NULL DEFAULT NULL COMMENT 'Blog category modify date.',
  ncreatedby INT(11) NULL DEFAULT NULL COMMENT 'User who creates the blog category.',
  nmodifiedby INT(11) NULL DEFAULT NULL COMMENT 'User who modifies the blog category.',
  PRIMARY KEY (nblogcategoryid));

--
-- Volcado de datos para la tabla `blog_categories`
--

INSERT INTO `blog_categories` (`nblogcategoryid`, `nblogcategoryparentid`, `sname`, `sshortdescription`, `sdescription`, `sfullimage`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`) VALUES
(1, 0, 'Categoria Prueba Nivel 1', 'CAT-PRB-1', 'Categoria Prueba Nivel 1', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-04-21 20:50:16', NULL, 1, NULL),
(2, 1, 'Categoria Prueba Nivel 2', 'CAT-PRB-2', 'Categoria Prueba Nivel 2', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-04-21 20:50:16', NULL, 1, NULL),
(3, 2, 'Categoria Prueba Nivel 3', 'CAT-PRB-3', 'Categoria Prueba Nivel 3', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-04-21 20:50:16', NULL, 1, NULL);




--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `npostid` int(11) NOT NULL COMMENT 'PK of Post table.',
  `stitle` varchar(100) NOT NULL COMMENT 'Post title.',
  `nblogcategoryid` int(11) NOT NULL COMMENT 'FK of Blog Category table.',
  `stags` varchar(400) DEFAULT NULL COMMENT 'Post tags.',
  `sauthor` varchar(200) DEFAULT NULL COMMENT 'Post author.',
  `scontent` text NOT NULL COMMENT 'Post content.',
  `simage1` varchar(400) DEFAULT NULL COMMENT 'Post image 1.',
  `simage2` varchar(400) DEFAULT NULL COMMENT 'Post image 2.',
  `simage3` varchar(400) DEFAULT NULL COMMENT 'Post image 3.',
  `sstatus` char(1) NOT NULL DEFAULT 'A' COMMENT 'Post status. A=Active, N=Inactive.',
  `dcreatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Post create date.',
  `dmodifiedon` datetime DEFAULT NULL COMMENT 'Post modify date.',
  `ncreatedby` int(11) DEFAULT NULL COMMENT 'User who creates the post.',
  `nmodifiedby` int(11) DEFAULT NULL COMMENT 'User who modifies the post.',
  `sdescription` varchar(300) NOT NULL DEFAULT 'Sin descripción' COMMENT 'Post description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`npostid`, `stitle`, `nblogcategoryid`, `stags`, `sauthor`, `scontent`, `simage1`, `simage2`, `simage3`, `sstatus`, `dcreatedon`, `dmodifiedon`, `ncreatedby`, `nmodifiedby`, `sdescription`) VALUES
(1, 'Título Prueba 1', 1, 'test', 'Edgar Amado', '<p>Prueba:</p>  <ol>  <li>One</li>  <li>Two</li>  <li>Three</li> </ol>', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-02-21 23:13:20', NULL, 1, NULL, 'Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.'),
(2, 'Título Prueba 2', 2, 'test', 'Angello Del Carpio', '<p>Prueba:</p>\n\n<ol>\n <li>One</li>\n  <li>Two</li>\n  <li>Three</li>\n</ol>', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-04-15 00:03:01', NULL, 1, NULL, 'Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.'),
(3, 'Titulo Prueba 3', 3, 'test', 'Edgar Amado', '<p>Prueba:</p>  <ol>  <li>One</li>  <li>Two</li>  <li>Three</li> </ol>', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', 'A', '2020-04-04 00:03:01', NULL, 1, NULL, 'Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.'),
(4, 'Titulo Prueba 4', 1, 'test', 'Bryan Amado', '<p><strong>Plan de Pase a Producci&oacute;n:</strong></p>\n\n<p>Motivo:</p>\n\n<p>Habilitar opci&oacute;n de tipo de despacho &ldquo;Retiro cercano&rdquo; en los correos del Servicio de Pago Efectivo.</p>\n\n<p><strong>DBA:</strong></p>\n\n<p><strong>Ejecuci&oacute;n de Scripts</strong></p>\n\n<p>Los datos asociados a los scripts a ejecutar</p>\n\n<ul>\n  <li>\n  <p>Endpoint: <a href=\"http://dbcorpsgoprd.cxcwstwehnpi.ca-central-1.rds.amazonaws.com\"><strong>dbcorpsgoprd.cxcwstwehnpi.ca-central-1.rds.amazonaws.com</strong></a></p>\n  </li>\n <li>\n  <p>Schema: <strong>CORP_RDSADMSGO</strong></p>\n  </li>\n <li>\n  <p>Scripts se encuentran adjuntos en el presente RDC</p>\n  </li>\n</ul>\n\n<p>Los pasos a ejecutar son:</p>\n\n<ol>\n  <li>\n  <p>Actualizar el Package &quot;<strong>PKG_PAGO_EFECTIVO</strong>&quot; con los scripts cuyo owner debe ser: &quot;<strong>CORP_RDSADMSGO</strong>&quot;.</p>\n </li>\n <li>\n  <p>Brindar, o validar si existen, permisos de ejecuci&oacute;n del Package &ldquo;<strong>PKG_PAGO_EFECTIVO</strong>&rdquo; al usuario &ldquo;<strong>CORP_RDSUSERSGO</strong>&rdquo;.</p>\n  </li>\n <li>\n  <p>Crear, o validar si existen, sin&oacute;nimos de los siguientes objetos:</p>\n\n <ol>\n    <li>\n    <p>Package &ldquo;<strong>PKG_PAGO_EFECTIVO</strong>&ldquo; &rarr; actualizada en el punto 1.</p>\n   </li>\n </ol>\n </li>\n</ol>', 'https://www.portotheme.com/wordpress/porto/shop3/wp-content/uploads/sites/22/2019/03/product-89-2-300x300.jpg', NULL, NULL, 'A', '2020-04-23 12:46:00', '2020-04-23 17:58:40', 1, 1, 'Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.');


--
-- Estructura de tabla para la tabla `post_comments`
--

CREATE TABLE faunaideas.post_comments (
  nposcommenttid INT NOT NULL AUTO_INCREMENT COMMENT 'PK of Post Comments table.',
  npostid INT NOT NULL COMMENT 'FK of Post table.',
  sname VARCHAR(100) NOT NULL COMMENT 'Name of person who commented.',
  semail VARCHAR(100) NULL COMMENT 'Email of person who commenteds.',
  smobile VARCHAR(20) NULL COMMENT 'Mobile of person who commented.',
  scomment VARCHAR(2000) NULL COMMENT 'Comment of person who commented.',
  smac VARCHAR(20) NULL COMMENT 'MAC computer of person who commented.',
  saddresspublic VARCHAR(15) NULL COMMENT 'Address public of person who commented.',
  sreviewstatus CHAR(1) NOT NULL DEFAULT 'P' COMMENT 'Post comment review status. P=Pending, A=Approved. R=Rejected.',
  sstatus CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Post comment registerstatus. A=Active, N=Inactive.',
  dcreatedon DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Post comment create date.',
  dmodifiedon DATETIME NULL DEFAULT NULL COMMENT 'Post comment modify date.',
  ncreatedby INT(11) NULL DEFAULT NULL COMMENT 'User who creates the comment.',
  nmodifiedby INT(11) NULL DEFAULT NULL COMMENT 'User who modifies the comment.',
  PRIMARY KEY (nposcommenttid));



--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nuserid`);

--
-- Indices de la tabla `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`nslideid`);

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



-- Indices de la tabla `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`ntypeid`);


-- Indices de la tabla `types`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`ncatalogid`);


--
-- Indices de la tabla `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD PRIMARY KEY (`ncatalogproductid`),
  ADD KEY `dcp_idx` (`ncatalogid`);


--
-- AUTO_INCREMENT de las tablas volcadas
--

-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `nuserid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “User” Table.';


-- AUTO_INCREMENT de la tabla `slides`
--
ALTER TABLE `slides`
  MODIFY `nslideid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Slides” Table.';

--
-- AUTO_INCREMENT de la tabla `parameters`
--
ALTER TABLE `parameters`
  MODIFY `nparameterid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Parameter” Table.';


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
-- AUTO_INCREMENT de la tabla `catalog`
--
ALTER TABLE `catalog`
  MODIFY `ncatalogid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Catalog” Table.', AUTO_INCREMENT=20;


--
-- AUTO_INCREMENT de la tabla `catalog_product`
--
ALTER TABLE `catalog_product`
  MODIFY `ncatalogproductid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Catalog product” Table.', AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `nproductid_fk` FOREIGN KEY (`nproductid`) REFERENCES `products` (`nproductid`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Filtros para la tabla `product_attribute`
--
ALTER TABLE `catalog_product`
  ADD CONSTRAINT `ncatalogid_fk` FOREIGN KEY (`ncatalogid`) REFERENCES `catalog` (`ncatalogid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Indices de la tabla `product_attribute`
-- AUTO_INCREMENT de la tabla `product_attribute`
--
ALTER TABLE `faunaideas`.`files` 
CHANGE COLUMN `nfileid` `nfileid` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of “Files” Table.' ,
ADD PRIMARY KEY (`nfileid`);
