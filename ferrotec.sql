-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2024 a las 21:54:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferrotec`
--

/*
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/
-- 1 / / CREACIÓN DE TABLAS - PRIMARY KEYS - AUTO INCREMENTOS / /
/*
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `art_id_categoria` tinyint(4) NOT NULL DEFAULT 1,
  `art_nombre` varchar(30) DEFAULT NULL,
  `art_marca` varchar(30) DEFAULT NULL,
  `art_descripcion` varchar(100) DEFAULT NULL,
  `art_precio` float DEFAULT NULL,
  `art_stock` int(6) DEFAULT NULL,
  `art_activo` int(1) DEFAULT NULL,
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `cat_id_tipo` tinyint(4) NOT NULL DEFAULT 1,
  `cat_nombre` varchar(30) DEFAULT NULL,
  `cat_descripcion` varchar(100) DEFAULT NULL,
  `cat_activo` int(1) DEFAULT NULL,
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_compras`
--

CREATE TABLE `historial_compras` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histcompras_id_usuario` int(5) NOT NULL DEFAULT 1,
  `histcompras_id_modopago` tinyint(4) NOT NULL DEFAULT 1,
  `histcompras_suc` tinyint(4) DEFAULT 1,
  `histcompras_id_prov` int(5) DEFAULT 1,
  `histcompras_monto` float NOT NULL,
  `histcompras_fechahora` datetime DEFAULT current_timestamp()
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Estructura de tabla para la tabla `historial_compras_detalle`
--

CREATE TABLE `historial_compras_detalle` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histcomdet_id_compra` int(10) NOT NULL,
  `histcomdet_id_art` int(6) NOT NULL,
  `histcomdet_cantidad` int(10) NOT NULL,
  `histcomdet_monto` float NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Estructura de tabla para la tabla `historial_compras_eliminados`
--

CREATE TABLE `historial_compras_eliminados` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histcompraselim_userid` int(5) DEFAULT NULL,
  `histcompraselim_fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `histcompras_id` int(5) NOT NULL,
  `histcompras_id_usuario` int(5) DEFAULT NULL,
  `histcompras_id_modopago` tinyint(4) DEFAULT NULL,
  `histcompras_suc` tinyint(4) DEFAULT NULL,
  `histcompras_id_prov` int(5) DEFAULT NULL,
  `histcompras_monto` float DEFAULT NULL,
  `histcompras_fechahora` datetime DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Estructura de tabla para la tabla `historial_compras_detalle_eliminados`
--

CREATE TABLE `historial_compras_detalle_eliminados` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histcomdetelim_id_compra` int(10) DEFAULT NULL,
  `histcomdetelim_id_art` int(6) DEFAULT NULL,
  `histcomdetelim_cantidad` int(10) DEFAULT NULL,
  `histcomdetelim_monto` float DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Estructura de tabla para la tabla `historial_articulos`
--

CREATE TABLE `historial_articulos` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histart_fechahora` datetime DEFAULT current_timestamp(),
  `histart_id_art` int(6) DEFAULT NULL,
  `histart_accion` varchar(12) DEFAULT NULL,
  `histart_id_usu` int(5) DEFAULT NULL,
  `histart_id_categoria` tinyint(4) DEFAULT NULL,
  `histart_nombre` varchar(30) DEFAULT NULL,
  `histart_marca` varchar(30) DEFAULT NULL,
  `histart_descripcion` varchar(100) DEFAULT NULL,
  `histart_precio` float DEFAULT NULL,
  `histart_activo` int(1) DEFAULT NULL,
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_categorias`
--

CREATE TABLE `historial_categorias` (
  `id` int(6) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histcat_fechahora` datetime DEFAULT current_timestamp(),
  `histcat_id_cat` tinyint(4) DEFAULT NULL,
  `histcat_accion` varchar(12) DEFAULT NULL,
  `histcat_id_usu` int(5) DEFAULT NULL,
  `histcat_id_tipos` tinyint(4) DEFAULT NULL,
  `histcat_nombre` varchar(30) DEFAULT NULL,
  `histcat_descripcion` varchar(100) DEFAULT NULL
  `histcat_activo` int(1) DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_login`
--

CREATE TABLE `historial_login` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histlogin_fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `histlogin_usu_id` int(5) NOT NULL DEFAULT 1,
  `histlogin_in_out` varchar(3) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Estructura de tabla para la tabla `historial_proveedores`
--

CREATE TABLE `historial_proveedores` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histprov_fechahora` datetime DEFAULT current_timestamp(),
  `histprov_accion` varchar(12) DEFAULT NULL,
  `histprov_id_usu` int(5) DEFAULT NULL,
  `histprov_id_prov` int(5) DEFAULT NULL,
  `histprov_nombre` varchar(30) DEFAULT NULL,
  `histprov_descripcion` varchar(100) DEFAULT NULL,
  `histprov_direccion` varchar(30) DEFAULT NULL,
  `histprov_localidad` varchar(30) DEFAULT NULL,
  `histprov_provincia` varchar(30) DEFAULT NULL,
  `histprov_tel1` int(20) DEFAULT NULL,
  `histprov_tel2` int(20) DEFAULT NULL,
  `histprov_email` varchar(50) DEFAULT NULL,
  `histprov_cuit` int(11) DEFAULT NULL,
  `histprov_activo` int(1) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_tipos`
--

CREATE TABLE `historial_tipos` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histtipos_fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `histtipos_accion` varchar(12) DEFAULT NULL,
  `histtipos_id_usu` int(5) DEFAULT NULL,
  `histtipos_id_tipos` int(5) DEFAULT NULL,
  `histtipos_nombre` varchar(20) DEFAULT NULL,
  `histtipos_descripcion` varchar(100) DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_usuarios`
--

CREATE TABLE `historial_usuarios` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histusu_fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `histusu_accion` varchar(12) DEFAULT NULL,
  `histusu_id_usu` int(5) DEFAULT NULL,
  `histusu_id_usumodif` int(5) DEFAULT NULL,
  `histusu_id_permisos` tinyint(2) NOT NULL DEFAULT 1,
  `histusu_nombre` varchar(30) NOT NULL,
  `histusu_apellido` varchar(20) DEFAULT NULL,
  `histusu_direccion` varchar(30) NOT NULL,
  `histusu_password` varchar(30) NOT NULL,
  `histusu_cod_verif` int(6) NOT NULL,
  `histusu_id_suc` tinyint(4) NOT NULL DEFAULT 1,
  `histusu_email` varchar(50) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `modopago`
--

CREATE TABLE `modopago` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `modpa_nombre` varchar(20) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `prov_nombre` varchar(30) NOT NULL,
  `prov_descripcion` varchar(100) DEFAULT NULL,
  `prov_direccion` varchar(30) DEFAULT NULL,
  `prov_localidad` varchar(30) DEFAULT NULL,
  `prov_provincia` varchar(30) DEFAULT NULL,
  `prov_tel1` int(20) DEFAULT NULL,
  `prov_tel2` int(20) DEFAULT NULL,
  `prov_email` varchar(50) NOT NULL,
  `prov_cuit` int(11) NOT NULL,
  `prov_activo` int(1) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `perm_descripcion` varchar(30) NULL 
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `sucs_nombre` varchar(30) NOT NULL,
  `sucs_direccion` varchar(30) NOT NULL,
  `sucs_tel1` int(30) NOT NULL,
  `sucs_tel2` int(30) DEFAULT NULL,
  `sucs_email` varchar(50) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `tipos_nombre` varchar(20) NOT NULL,
  `tipos_descripcion` varchar(100) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `usu_id_permisos` tinyint(2) NOT NULL DEFAULT 1,
  `usu_username` varchar(12) NOT NULL,
  `usu_nombre` varchar(30) NOT NULL,
  `usu_apellido` varchar(30) NOT NULL,
  `usu_direccion` varchar(30) NOT NULL,
  `usu_password` varchar(30) NOT NULL,
  `usu_cod_verif` varchar(8) NOT NULL,
  `usu_id_suc` tinyint(4) NOT NULL DEFAULT 1,
  `usu_email` varchar(50) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_ventas`
--

CREATE TABLE `historial_ventas` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histventas_id_usuario` int(5) NOT NULL DEFAULT 1,
  `histventas_id_modopago` tinyint(4) NOT NULL DEFAULT 1,
  `histventas_fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `histventas_monto` float NOT NULL,
  `histventas_suc` tinyint(4) NOT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_ventas_detalle`
--

CREATE TABLE `historial_ventas_detalle` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histvendet_id_venta` int(10) NOT NULL,
  `histvendet_id_art` int(6) NOT NULL DEFAULT 1,
  `histvendet_cantidad` int(10) DEFAULT NULL,
  `histvendet_monto` float DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_ventas_eliminados`
--

CREATE TABLE `historial_ventas_eliminados` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histventaselim_userid` int(5) NOT NULL,
  `histventaselim_fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `histventas_id` int(5) NOT NULL,
  `histventas_id_usuario` int(5) DEFAULT NULL,
  `histventas_id_modopago` tinyint(4) DEFAULT NULL,
  `histventas_fechahora` datetime DEFAULT NULL,
  `histventas_monto` float DEFAULT NULL,
  `histventas_suc` tinyint(4) DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `historial_ventas_detalle_eliminados`
--

CREATE TABLE `historial_ventas_detalle_eliminados` (
  `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `histvendetelim_id_venta` int(10) DEFAULT NULL,
  `histvendetelim_id_art` int(6) DEFAULT NULL,
  `histvendetelim_cantidad` int(10) DEFAULT NULL,
  `histvendetelim_monto` float DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------------------------------------------------

/*
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/
-- 2 / / INSERTAR REGISTROS NUEVOS / /
/*
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/

START TRANSACTION;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`art_id_categoria`, `art_nombre`, `art_marca`, `art_descripcion`, `art_precio`, `art_stock`) VALUES
(1, 'ARTICULO NO ESPECIFICADO', 'MARCA BLANCA', 'DESCRIPCIÒN PARA ARTICULO', 0, 1),
(3, 'Clavo_2mm_2cm', 'clavitos SA', 'clavos de 2mm de diametro por 2cm de largo', 4, 73),
(3, 'Tornillo_Inox_3mm_3cm', 'Tornillo SA', 'Tornillo comun de acero inoxidable, de 3mm de diametro por 3 cm de largos. Phillips', 2, 500),
(1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 50, 460),
(1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 8, 100);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_id_tipo`, `cat_nombre`, `cat_descripcion`) VALUES
(1, 'SIN CATEGORIZAR', 'Elementos que no pertenecen a ninguna categoria'),
(5, 'herramientas_jardin', 'herramientas para el jardin'),
(1, 'maquinarias_jardin', 'nuevo nombre descripcion y tipo'),
(5, 'acondicionadores_de_jardin', 'Elementos acondicionadores para el terreno del jardin'),
(5, 'adornos_jardin', 'adornos para el jardin'),
(1, 'Pinturas', 'Todo tipo de pinturas para cualquier superficie');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_compras`
--

INSERT INTO `historial_compras` (`histcompras_id_usuario`, `histcompras_id_modopago`, `histcompras_suc`, `histcompras_id_prov`, `histcompras_monto`, `histcompras_fechahora`) VALUES
(2, 2, 1, 1, 54, '2024-08-02 12:28:15'),
(2, 2, 1, 1, 38, '2024-08-02 12:28:55'),
(3, 1, 1, 1, 800, '2024-08-07 07:36:20');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_compras_detalle_eliminados`
--

INSERT INTO `historial_compras_detalle_eliminados` (`histcomdetelim_id_compra`, `histcomdetelim_id_art`, `histcomdetelim_cantidad`, `histcomdetelim_monto`) VALUES
(7, 5, 100, 100),
(8, 6, 400, 800),
(8, 3, 200, 200),
(8, 5, 100, 2500),
(9, 5, 40, 200),
(9, 2, 7, 7);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_compras_eliminados`
--

INSERT INTO `historial_compras_eliminados` (`histcompraselim_userid`, `histcompraselim_fechahora`, `histcompras_id`, `histcompras_id_usuario`, `histcompras_id_modopago`, `histcompras_suc`, `histcompras_id_prov`, `histcompras_monto`, `histcompras_fechahora`) VALUES
(3, '2024-08-09 11:01:28', 4, 3, 1, 1, NULL, 4, '2024-08-07 07:30:00'),
(3, '2024-08-09 11:06:53', 5, 3, 2, 1, 1, 800, '2024-08-07 07:35:17'),
(3, '2024-08-09 11:28:07', 7, 3, 2, 1, 1, 100, '2024-08-07 07:38:23'),
(3, '2024-08-09 11:30:12', 8, 3, 3, 1, 1, 3500, '2024-08-07 07:55:18'),
(3, '2024-08-09 11:50:22', 9, 3, 2, 1, 1, 207, '2024-08-09 10:14:49');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_articulos`
--

INSERT INTO `historial_articulos` (`histart_fechahora`, `histart_id_art`, `histart_accion`, `histart_id_usu`, `histart_id_categoria`, `histart_nombre`, `histart_marca`, `histart_descripcion`, `histart_precio`) VALUES
('2024-06-27 17:03:22', 2, 'alta_art', 3, 1, 'Clavo_2mm_2cm', 'clavitos SA', 'clavos de 2mm de diametro por 2cm de largo', 2),
('2024-06-27 17:12:57', 3, 'alta_art', 3, 1, 'Tornillo_Inox_2mm_2cm', 'Tornillo SA', 'Tornillo comÃºn de acero inoxidable', 4),
('2024-06-27 17:20:36', 4, 'alta_art', 3, 0, 'w', 'w', 'w', 2),
('2024-06-27 17:43:09', 5, 'alta_art', 3, 1, 'a', 's', 'd', 3),
('2024-06-27 17:20:36', 4, 'borrar_art', 3, 0, 'w', 'w', 'w', 2),
(NULL, 5, 'modif_art', 3, 1, 'a', 'a', 'a', 23),
(NULL, 5, 'modif_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 50),
('2024-06-29 19:02:26', 6, 'alta_art', 3, 1, 'g', 'g', 'g', 3, 0),
('2024-06-29 19:02:26', 6, 'modif_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 3),
('2024-07-18 12:19:23', 7, 'alta_art', 3, 3, 'cortasetosverde', 'GardenMaster', 'Cortasetos elÃ©ctrico con cuchillas de acero endurecido, mango telescÃ³pico ajustable', 75),
('2024-07-18 12:23:33', 7, 'borrar_art', 3, 3, 'cortasetosverde', 'GardenMaster', 'Cortasetos elÃ©ctrico con cuchillas de acero endurecido, mango telescÃ³pico ajustable', 75),
('2024-07-18 12:28:44', 3, 'modif_art', 3, 1, 'Tornillo_Inox_3mm_3cm', 'Tornillo SA', 'Tornillo comun de acero inoxidable, de 2mm de diametro por 3 cm de largos. Phillips', 1),
('2024-08-07 16:10:50', 1, 'modifpre_art', 3, 1, 'ARTICULO NO ESPECIFICADO', 'MARCA BLANCA', 'DESCRIPCIÒN PARA ARTICULO', 0),
('2024-08-07 16:10:50', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 153.015),
('2024-08-07 16:10:50', 6, 'modifpre_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 6.1206),
('2024-08-07 16:14:30', 1, 'modifpre_art', 3, 1, 'ARTICULO NO ESPECIFICADO', 'MARCA BLANCA', 'DESCRIPCIÒN PARA ARTICULO', 0),
('2024-08-07 16:14:30', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 5),
('2024-08-07 16:14:30', 6, 'modifpre_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 1),
('2024-08-07 16:20:06', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 10),
('2024-08-07 16:21:57', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 12),
('2024-08-07 16:22:15', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 15.6),
('2024-08-07 16:22:16', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 20.28),
('2024-08-07 16:24:44', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 26.364),
('2024-08-07 16:24:46', 5, 'modifpre_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 34.2732),
('2024-08-07 16:48:14', 6, 'modifpre_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 2),
('2024-08-07 16:50:07', 6, 'modifpre_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 8),

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_categorias`
--

INSERT INTO `historial_categorias` (`histcat_fechahora`, `histcat_id_cat`, `histcat_accion`, `histcat_id_usu`, `histcat_id_tipos`, `histcat_nombre`, `histcat_descripcion`) VALUES
('2024-05-24 10:00:26', 3, 'alta_categor', 3, NULL, 'herramientas_jardin', 'herramientas para el jardin'),
('2024-05-24 10:34:50', 7, 'alta_categor', 3, 5, 'adornos_jardin', 'Adornos para el jardÃ­n'),
('2024-05-24 11:22:09', 8, 'alta_categor', 3, 5, 'adornos_jardin', 'Adornos de jardin'),
('2024-05-24 10:20:14', 4, 'modif_catego', 3, NULL, 'maquinarias_jardin', 'nuevo nombre descripcion y tipo'),
('2024-05-24 11:22:09', 8, 'modif_catego', 3, 0, 'adornos_de_jardin', 'prueba'),
('2024-05-24 11:22:09', 8, 'modif_catego', 3, 0, 'adornos_jardin', 'prueba2'),
('2024-05-24 11:22:09', 8, 'modif_catego', 3, 5, 'adornos_jardin', 'adornos para el jardin'),
('2024-07-18 13:53:50', 9, 'alta_categor', 3, 5, 'limpieza_jardin', 'Elementos de orden y limpieza para el jardin'),
('2024-07-18 13:57:55', 9, 'borrar_categ', 3, NULL, 'limpieza_jardin', 'Elementos de orden y limpieza para el jardin'),
('2024-07-18 14:08:26', 10, 'alta_cat', 3, 12, 'asdsa', 'adsfasdf'),
('2024-07-18 14:14:45', 10, 'modif_cat', 3, 1, 'Pinturas', 'Todo tipo de pinturas para cualquier superficie');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_login`
--

INSERT INTO `historial_login` (`histlogin_fecha`, `histlogin_usu_id`, `histlogin_in_out`) VALUES
('2024-05-16 09:45:53', 3, 'in'),
('2024-05-17 09:24:40', 3, 'in'),
('2024-05-17 13:58:09', 3, 'in'),
('2024-05-20 11:33:34', 3, 'in'),
('2024-05-20 11:59:36', 3, 'out'),
('2024-05-20 12:01:27', 3, 'in'),
('2024-05-23 10:53:04', 3, 'in'),
('2024-05-24 09:00:21', 3, 'in'),
('2024-06-27 08:36:51', 3, 'in'),
('2024-06-27 15:22:18', 3, 'out'),
('2024-06-27 15:22:32', 3, 'in'),
('2024-06-27 15:36:28', 3, 'out'),
('2024-06-27 15:36:42', 3, 'in'),
('2024-06-27 15:43:50', 3, 'out'),
('2024-06-27 15:44:00', 3, 'in'),
('2024-06-27 15:44:11', 3, 'out'),
('2024-06-27 15:44:42', 3, 'in'),
('2024-06-27 15:46:36', 3, 'out'),
('2024-06-27 15:46:48', 3, 'in'),
('2024-06-27 15:52:47', 3, 'out'),
('2024-06-27 15:53:04', 3, 'in'),
('2024-06-27 16:44:41', 3, 'out'),
('2024-06-27 16:44:51', 3, 'in'),
('2024-06-27 16:49:58', 3, 'out'),
('2024-06-27 16:50:09', 3, 'in'),
('2024-06-27 17:02:11', 3, 'out'),
('2024-06-27 17:02:20', 3, 'in'),
('2024-06-27 17:35:13', 3, 'out'),
('2024-06-27 17:35:23', 3, 'in'),
('2024-06-27 17:42:38', 3, 'out'),
('2024-06-27 17:42:48', 3, 'in'),
('2024-06-29 18:10:18', 3, 'in'),
('2024-06-29 19:11:30', 3, 'out'),
('2024-06-29 19:13:50', 3, 'in'),
('2024-06-29 19:18:13', 3, 'out'),
('2024-06-29 19:18:25', 3, 'in'),
('2024-06-29 19:27:20', 3, 'out'),
('2024-06-29 19:27:30', 3, 'in'),
('2024-06-29 19:54:04', 3, 'out'),
('2024-06-29 19:58:02', 3, 'in'),
('2024-06-29 19:58:52', 3, 'out'),
('2024-06-29 19:59:19', 3, 'in'),
('2024-06-30 03:30:05', 3, 'in'),
('2024-07-17 10:26:47', 3, 'in'),
('2024-07-17 10:26:52', 3, 'out'),
('2024-07-17 13:19:11', 3, 'in'),
('2024-07-18 11:11:25', 2, 'in'),
('2024-07-18 11:11:27', 2, 'out'),
('2024-07-18 11:11:38', 3, 'in'),
('2024-07-18 11:12:01', 3, 'out'),
('2024-07-18 11:44:35', 3, 'in'),
('2024-07-19 08:05:46', 3, 'in'),
('2024-08-02 12:20:39', 2, 'in'),
('2024-08-02 12:21:12', 2, 'out'),
('2024-08-02 12:21:23', 2, 'in'),
('2024-08-02 12:22:45', 2, 'out'),
('2024-08-02 12:22:49', 2, 'in'),
('2024-08-02 12:40:40', 2, 'out'),
('2024-08-02 12:40:51', 3, 'in'),
('2024-08-02 12:46:20', 3, 'out'),
('2024-08-06 08:50:46', 3, 'in'),
('2024-08-06 10:31:41', 3, 'in'),
('2024-08-07 07:26:00', 3, 'in'),
('2024-08-08 09:44:32', 3, 'in'),
('2024-08-09 10:12:31', 3, 'in'),
('2024-08-09 16:50:06', 3, 'out'),
('2024-08-09 16:50:11', 3, 'in'),
('2024-08-09 16:50:16', 3, 'out'),
('2024-08-09 16:50:18', 3, 'in'),
('2024-08-09 16:50:21', 3, 'out'),
('2024-08-09 16:50:23', 3, 'in'),
('2024-08-09 16:50:26', 3, 'out'),
('2024-08-09 16:50:27', 3, 'in'),
('2024-08-09 16:50:29', 3, 'out'),
('2024-08-09 16:50:30', 3, 'in'),
('2024-08-09 16:50:34', 3, 'out'),
('2024-08-09 16:50:35', 3, 'in'),
('2024-08-09 16:50:40', 3, 'out'),
('2024-08-09 16:52:45', 3, 'in');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_proveedores`
--

INSERT INTO `historial_proveedores` (`histprov_fechahora`, `histprov_accion`, `histprov_id_usu`, `histprov_id_prov`, `histprov_nombre`, `histprov_descripcion`, `histprov_direccion`, `histprov_localidad`, `histprov_provincia`, `histprov_tel1`, `histprov_tel2`, `histprov_email`, `histprov_cuit`) VALUES
('2024-05-20 11:42:03', 'alta_prov', 3, 1, 'Tornillete', 'Tornillete SA - Proveedor de tornillos varios', 'Lamas  1242', 'Santa Fe', 'Santa Fe', 342, 342, 'tornillete@tornillete.com', 35),
('2024-07-19 08:08:08', 'alta_prov', 3, 2, ' El Martillo S.A.', 'El Martillo S.A. es una empresa dedicada a la venta de productos y materiales de ferreterÃ­a.', 'Av. Libertador 1234', 'Capital Federal', 'Buenos Aires', 0, 0, 'info@ferreteriaelmartillo.com', 30),
('2024-07-19 08:09:23', 'alta_prov', 3, 3, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
('2024-07-19 08:21:33', 'baja_prov', 3, 3, 'a', 'a', 'a', 'a', 'a', 0, 0, '', 0),
('2024-07-19 08:23:24', 'alta_prov', 3, 4, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
('2024-07-19 08:23:56', 'baja_prov', 3, 4, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
('2024-07-19 08:27:50', 'alta_prov', 3, 5, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
('2024-07-19 10:27:54', 'modif_prov', 3, 5, 'b', 'b', 'b', 'b', 'b', 0, 0, 'b', 0);

-- --------------------------------------------------------

-- 
-- Volcado de datos para la tabla `historial_tipos`
--

INSERT INTO `historial_tipos` (`histtipos_fechahora`, `histtipos_accion`, `histtipos_id_usu`, `histtipos_id_tipos`, `histtipos_nombre`, `histtipos_descripcion`) VALUES
('2024-05-23 10:46:55', 'alta_tipo', 3, 5, 'Jar', 'Articulos para el jardin y de jardineria'),
('2024-05-23 10:46:55', 'alta_tipo', 3, 6, 'prueba', 'prueb'),
('2024-05-23 10:55:29', 'alta_tipo', 3, 7, '2', '222'),
('2024-05-23 11:21:56', 'alta_tipo', 3, 8, '3', '333'),
('2024-05-23 11:22:40', 'borrar_tipo', 3, 8, NULL, NULL),
('2024-05-23 11:25:26', 'alta_tipo', 3, 9, '4', '4444'),
('2024-05-23 11:26:35', 'alta_tipo', 3, 10, '5', '555'),
('2024-05-23 11:26:41', 'borrar_tipo', 3, 10, '5', '555'),
('2024-05-23 11:28:37', 'alta_tipo', 3, 11, '7', '7777'),
('2024-05-23 11:55:11', 'alta_tipo', 3, 12, '9', '999'),
('2024-05-23 12:00:06', 'modif_tipo', 3, 0, '', ''),
('2024-05-23 12:17:18', 'modif_tipo', 3, 12, 'Tipo_renombrado', 'Es el tipo renombrado para probar la funcion de renombre'),
('2024-07-19 10:46:06', 'alta_tipo', 3, 13, 'a', 'aa'),
('2024-07-19 11:27:27', 'modif_tipo', 3, 13, 'b', 'bb'),
('2024-07-19 11:28:55', 'borrar_tipo', 3, 13, 'b', 'bb');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_usuarios`
--

INSERT INTO `historial_usuarios` (`histusu_fechahora`, `histusu_accion`, `histusu_id_usu`, `histusu_id_usumodif`, `histusu_id_permisos`, `histusu_nombre`, `histusu_apellido`, `histusu_direccion`, `histusu_password`, `histusu_cod_verif`, `histusu_id_suc`, `histusu_email`) VALUES
('2024-05-16 11:54:15', 'modif_usu', NULL, NULL, 1, '', NULL, '', '', 0, 1, ''),
('2024-05-16 11:54:15', 'modif_usu', 3, NULL, 1, '', NULL, '', '', 0, 1, ''),
('2024-05-16 11:54:15', 'modif_usu', 3, 65, 1, '', NULL, '', '', 0, 1, ''),
('2024-05-16 11:56:04', 'modif_usu', 3, 65, 1, 'monica', 'monday', 'flac', '', 0, 1, 'gdol'),
('2024-05-16 12:19:54', 'alta_usu', 3, 70, 2, 'Miguel', 'Mandini', 'Lacalle Pou 5656', '', 0, 1, 'mguelman@fibercorp.com'),
('2024-05-16 12:42:23', 'borrar_usu', 3, 63, 3, 'nn', 'aa', 'dd', '', 0, 1, 'sd'),
('2024-05-16 12:53:06', 'alta_usu', 3, 71, 1, 'gabriel', 'andres', 'pap', '', 0, 1, 'dsod'),
('2024-05-16 13:04:31', 'borrar_usu', 3, 58, 4, '', '', '', '', 0, 1, ''),
('2024-05-16 13:06:22', 'borrar_usu', 3, 56, 1, '', '', '', '', 0, 1, ''),
('2024-05-16 13:08:12', 'alta_usu', 3, 72, 4, 'a', 'a', 'a', '', 0, 1, 'a'),
('2024-05-16 13:08:24', 'borrar_usu', 3, 72, 4, 'a', 'a', 'a', '', 0, 1, 'a'),
('2024-05-16 13:24:57', 'alta_usu', 3, 73, 4, 'b', 'b', 'b', '', 0, 1, 'b'),
('2024-05-16 13:25:16', 'borrar_usu', 3, 73, 4, 'b', 'b', 'b', '', 0, 1, 'b'),
('2024-07-17 13:19:47', 'baja_usu', 3, 66, 2, 'Prueba', 'Aprueba', 'Dprueba', '', 0, 1, 'eprueba@live.com.ar'),
('2024-07-17 13:24:33', 'baja_usu', 3, 66, 1, 'Prueba', 'Aprueba', 'Dprueba', '', 0, 1, 'eprueba@live.com.ar'),
('2024-07-17 13:24:46', 'baja_usu', 3, 66, 1, 'Prueba', 'Aprueba', 'Dprueba', '', 0, 1, 'eprueba@live.com.ar'),
('2024-07-18 11:11:51', 'baja_usu', 3, 2, 3, '2', '', '2]', '', 0, 1, '2'),
('2024-08-02 12:40:38', 'alta_usu', 2, 74, 4, '3', '3', '3', '', 0, 1, '3'),
('2024-08-02 12:41:07', 'baja_usu', 3, 74, 4, '3', '3', '3', '', 0, 1, '3');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `modopago`
--

INSERT INTO `modopago` (`modpa_nombre`) VALUES
('Pago No Especificado'),
('Efectivo'),
('Débito'),
('Crédito');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`prov_nombre`, `prov_descripcion`, `prov_direccion`, `prov_localidad`, `prov_provincia`, `prov_tel1`, `prov_tel2`, `prov_email`, `prov_cuit`) VALUES
('Tornillete', 'Tornillete SA - Proveedor de tornillos varios', 'Lamas  1242', 'Santa Fe', 'Santa Fe', 342, 342, 'tornillete@tornillete.com', 35),
(' El Martillo S.A.', 'El Martillo S.A. es una empresa dedicada a la venta de productos y materiales de ferreterÃ­a.', 'Av. Libertador 1234', 'Capital Federal', 'Buenos Aires', 0, 0, 'info@ferreteriaelmartillo.com', 30),
('b', 'b', 'b', 'b', 'b', 0, 0, 'b', 0);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`perm_descripcion`) VALUES
('Sin Permisos'),
('Vendedor'),
('Supervisor'),
('Administrador');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`sucs_nombre`, `sucs_direccion`, `sucs_tel1`, `sucs_tel2`, `sucs_email`) VALUES
('CASA CENTRAL', 'San Martin 100', 341, 341, 'casa_central@ferrotec.com.ar');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`tipos_nombre`, `tipos_descripcion`) VALUES
('SIN', 'tipos no especificado'),
('Jardin', 'Articulos para el jardin y de jardineria'),
('Tipo_renombrado', 'Es el tipo renombrado para probar la funcion de renombre');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id_permisos`, `usu_username`, `usu_nombre`, `usu_apellido`, `usu_direccion`, `usu_password`, `usu_cod_verif`, `usu_id_suc`, `usu_email`) VALUES
(1, 'USER-SIN-PER', 'USER-SIN-PERMISOS', '', 'San Martin 101', 'ferrotec', '0', 1, 'ferrotec@ferrotec.com.ar'),
(0, '2', '2', '', '2]', '2', '2', 1, '2'),
(3, 'fabrign', 'Fabricio', 'Gallina', 'Castellanos 2360', 'fabrign', '0', 1, 'fabrign@live.com'),
(1, 'f', 'monica', 'monday', 'flac', '', 'OLu9g,.F', 1, 'gdol'),
(1, 'Prueba1', 'Prueba', 'Aprueba', 'Dprueba', '', '(63?Rq<I', 1, 'eprueba@live.com.ar'),
(1, 'NOMBUSU', 'pepe', 'gomez', 'casa', '', 'nU{usiu{', 1, 'emailemail'),
(2, 'mariopg', 'Mario', 'Pergolini', 'Calafate 1122', '', 'd>8Lu]fu', 1, 'mario_pg@gmail.com'),
(2, 'jerodlp', 'Jeronimo', 'De La Puente', 'Azul 4522', '', 'x!$zizG6', 1, 'jero_delp@live.com'),
(2, 'miguelman', 'Miguel', 'Mandini', 'Lacalle Pou 5656', '', 'U5Aeuv@]', 1, 'mguelman@fibercorp.com'),
(1, 'gabi', 'gabriel', 'andres', 'pap', '', '0D1Oj$^0', 1, 'dsod'),
(0, '3', '3', '3', '3', 'Fabrign89-', '', 1, 'fabrign@live.com');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas`
--

INSERT INTO `historial_ventas` (`histventas_id_usuario`, `histventas_id_modopago`, `histventas_fechahora`, `histventas_monto`, `histventas_suc`) VALUES
(10, 5, '2024-07-12 00:00:00', 100, 1),
(10, 5, '2024-07-12 00:00:00', 16, 1),
(3, 0, '2024-07-12 00:00:00', 50, 1),
(3, 3, '2024-07-12 00:00:00', 2, 1),
(3, 3, '2024-07-12 00:00:00', 2, 1),
(3, 1, '2024-07-12 00:00:00', 0, 1),
(3, 2, '2024-07-12 00:00:00', 6, 1),
(3, 1, '2024-07-12 00:00:00', 4, 1),
(3, 1, '2024-07-12 00:00:00', 4, 1),
(3, 2, '2024-07-12 00:00:00', 4, 1),
(3, 1, '2024-07-12 00:00:00', 4, 1),
(3, 3, '2024-07-12 00:00:00', 2, 1),
(3, 3, '2024-07-12 00:00:00', 2, 1),
(3, 0, '2024-07-19 00:00:00', 0, 1),
(3, 0, '2024-07-19 00:00:00', 0, 1),
(3, 0, '2024-07-19 00:00:00', 0, 1),
(3, 0, '2024-07-19 00:00:00', 0, 1),
(3, 1, '2024-07-19 00:00:00', 0, 1),
(3, 0, '2024-07-19 00:00:00', 50, 1),
(3, 1, '2024-07-19 00:00:00', 50, 1),
(3, 1, '2024-08-08 15:39:24', 162, 1),
(3, 1, '2024-08-08 15:42:23', 566, 1),
(3, 1, '2024-08-08 15:44:15', 16, 1),
(3, 3, '2024-08-08 15:45:06', 540, 1),
(3, 1, '2024-08-08 15:48:52', 500, 1),
(3, 1, '2024-08-08 15:49:14', 250, 1),
(3, 3, '2024-08-08 15:53:00', 258, 1),
(3, 2, '2024-08-08 15:56:41', 282, 1),
(3, 1, '2024-08-08 15:59:50', 2532, 1),
(3, 1, '2024-08-08 16:02:52', 508, 1);

--
-- Volcado de datos para la tabla `historial_ventas_detalle`
--

INSERT INTO `historial_ventas_detalle` (`histvendet_id_venta`, `histvendet_id_art`, `histvendet_cantidad`, `histvendet_monto`) VALUES
(20, 5, 1, NULL),
(20, 2, 2, NULL),
(21, 2, 1, NULL),
(22, 2, 2, NULL),
(23, 2, 1, NULL),
(23, 2, 1, NULL),
(24, 5, 4, 200),
(26, 5, 0, 0),
(32, 5, 1, 50),
(33, 5, 1, 50),
(34, 5, 1, 50),
(34, 2, 15, 30),
(45, 2, 5, 20),
(45, 5, 10, 500),
(46, 5, 5, 250),
(46, 2, 7, 28),
(47, 2, 3, 12),
(47, 5, 10, 500),
(48, 2, 3, 12),
(48, 5, 10, 500);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas_detalle_eliminados`
--

INSERT INTO `historial_ventas_detalle_eliminados` (`histvendetelim_id_venta`, `histvendetelim_id_art`, `histvendetelim_cantidad`, `histvendetelim_monto`) VALUES
(48, 2, 3, 12),
(48, 5, 10, 500),
(49, 2, 3, 12),
(49, 5, 10, 500),
(50, 2, 3, 12),
(50, 5, 10, 500);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas_eliminados`
--

INSERT INTO `historial_ventas_eliminados` (`histventaselim_userid`, `histventaselim_fechahora`, `histventas_id` , `histventas_id_usuario`, `histventas_id_modopago`, `histventas_fechahora`, `histventas_monto`, `histventas_suc`) VALUES
(3, '2024-08-08 11:38:16', 0, 3, 0, '2024-07-12 00:00:00', 2, 1),
(3, '2024-08-08 11:53:33', 6, 3, 0, '2024-07-12 00:00:00', 50, 1),
(3, '2024-08-08 11:56:25', 18, 3, 1, '2024-07-12 00:00:00', 200, 1),
(3, '2024-08-08 12:03:06', 19, 3, 1, '2024-07-12 00:00:00', 200, 1),
(3, '2024-08-08 14:58:09', 20, 3, 1, '2024-07-12 00:00:00', 54, 1),
(3, '2024-08-08 15:10:01', 21, 3, 3, '2024-07-12 00:00:00', 2, 1),
(3, '2024-08-08 15:22:49', 22, 3, 1, '2024-07-12 00:00:00', 4, 1),
(3, '2024-08-08 15:24:44', 23, 3, 3, '2024-07-12 00:00:00', 4, 1),
(3, '2024-08-08 15:30:42', 24, 3, 0, '2024-07-19 00:00:00', 200, 1),
(3, '2024-08-08 15:32:10', 25, 3, 0, '2024-07-19 00:00:00', 0, 1),
(3, '2024-08-08 15:32:18', 26, 3, 0, '2024-07-19 00:00:00', 0, 1),
(3, '2024-08-08 15:38:22', 34, 2, 1, '2024-08-02 00:00:00', 80, 1),
(3, '2024-08-08 16:12:33', 45, 3, 3, '2024-08-08 16:09:27', 520, 1),
(3, '2024-08-08 16:14:44', 46, 3, 1, '2024-08-08 16:14:12', 278, 1),
(3, '2024-08-08 16:21:42', 47, 3, 1, '2024-08-08 16:20:32', 512, 1),
(3, '2024-08-08 16:32:37', 48, 3, 1, '2024-08-08 16:31:42', 512, 1),
(3, '2024-08-08 16:34:43', 49, 3, 1, '2024-08-08 16:34:32', 512, 1),
(3, '2024-08-08 16:44:49', 50, 3, 1, '2024-08-08 16:44:11', 512, 1);

-- --------------------------------------------------------

/*
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/
-- 3 / / CLAVES FORÁNEAS Y FILTROS / /
/*
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `historial_compras`
  ADD CONSTRAINT `histcompras_ibfk_1` FOREIGN KEY (`histcompras_id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `histcompras_ibfk_2` FOREIGN KEY (`histcompras_id_prov`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `histcompras_ibfk_4` FOREIGN KEY (`histcompras_id_modopago`) REFERENCES `modopago` (`id`);

--
-- Filtros para la tabla `historial_login`
--
ALTER TABLE `historial_login`
  ADD CONSTRAINT `historial_login_ibfk_1` FOREIGN KEY (`histlogin_usu_id`) REFERENCES `usuarios` (`id`);
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;