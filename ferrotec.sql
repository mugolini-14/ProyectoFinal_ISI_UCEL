-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2024 a las 19:36:28
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(5) NOT NULL,
  `art_id_categoria` tinyint(4) NOT NULL DEFAULT 1,
  `art_nombre` varchar(30) DEFAULT NULL,
  `art_marca` varchar(30) DEFAULT NULL,
  `art_descripcion` varchar(100) DEFAULT NULL,
  `art_precio` float DEFAULT NULL,
  `art_stock` int(6) DEFAULT NULL,
  `art_fechaalta` datetime DEFAULT NULL,
  `art_usuarioalta` int(5) DEFAULT NULL,
  `art_fechabaja` datetime DEFAULT NULL,
  `art_usuariobaja` int(5) DEFAULT NULL,
  `art_activo` char(1) DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `art_id_categoria`, `art_nombre`, `art_marca`, `art_descripcion`, `art_precio`, `art_stock`, `art_fechaalta`, `art_usuarioalta`, `art_fechabaja`, `art_usuariobaja`, `art_activo`) VALUES
(1, 1, 'ARTICULO NO ESPECIFICADO', 'MARCA BLANCA', 'DESCRIPCIÒN PARA ARTICULO', 0, 1, NULL, 1, NULL, NULL, 'S'),
(2, 1, 'Clavo_2mm_2cm', 'clavitos SA', 'clavos de 2mm de diametro por 2cm de largo', 2, 31, '2024-06-27 17:03:22', 3, NULL, NULL, 'S'),
(3, 1, 'Tornillo_Inox_2mm_2cm', 'Tornillo SA', 'Tornillo comÃºn de acero inoxidable', 4, 84, '2024-06-27 17:12:57', 3, NULL, NULL, 'S'),
(5, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 50, 69, '2024-06-27 17:43:09', 3, NULL, NULL, 'S'),
(6, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 3, 98, '2024-06-29 19:02:26', 3, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(4) NOT NULL,
  `cat_id_tipo` tinyint(4) NOT NULL DEFAULT 1,
  `cat_nombre` varchar(30) DEFAULT NULL,
  `cat_descripcion` varchar(100) DEFAULT NULL,
  `cat_fechaalta` datetime DEFAULT NULL,
  `cat_usuarioalta` int(5) DEFAULT NULL,
  `cat_fechabaja` datetime DEFAULT NULL,
  `cat_usuariobaja` int(5) DEFAULT NULL,
  `cat_activo` char(1) DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `cat_id_tipo`, `cat_nombre`, `cat_descripcion`, `cat_fechaalta`, `cat_usuarioalta`, `cat_fechabaja`, `cat_usuariobaja`, `cat_activo`) VALUES
(1, 1, 'SIN CATEGORIZAR', 'Elementos que no pertenecen a ninguna categoria', NULL, 1, NULL, NULL, 'S'),
(3, 5, 'herramientas_jardin', 'herramientas para el jardin', '2024-05-24 10:00:26', 3, NULL, NULL, 'S'),
(4, 1, 'maquinarias_jardin', 'nuevo nombre descripcion y tipo', '2024-05-24 10:20:14', 3, NULL, NULL, 'S'),
(6, 5, 'acondicionadores_de_jardin', 'Elementos acondicionadores para el terreno del jardin', '2024-05-24 10:29:28', 3, NULL, NULL, 'S'),
(8, 5, 'adornos_jardin', 'adornos para el jardin', '2024-05-24 11:22:09', 3, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(5) NOT NULL,
  `compras_id_usuario` int(5) NOT NULL DEFAULT 1,
  `compras_id_modopago` tinyint(4) NOT NULL DEFAULT 1,
  `compras_suc` tinyint(4) DEFAULT 1,
  `compras_id_prov` int(5) DEFAULT 1,
  `compras_monto` float NOT NULL,
  `compras_fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `id` int(10) NOT NULL,
  `comdet_id_compra` int(10) NOT NULL,
  `comdet_id_art` int(6) NOT NULL,
  `comdet_art_nom` varchar(20) NOT NULL,
  `comdet_cantidad` int(10) NOT NULL,
  `comdet_monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_articulos`
--

CREATE TABLE `historial_articulos` (
  `id` int(5) NOT NULL,
  `histart_id_art` int(6) DEFAULT NULL,
  `histart_accion` varchar(12) DEFAULT NULL,
  `histart_id_usu` int(5) DEFAULT NULL,
  `histart_id_categoria` tinyint(4) DEFAULT NULL,
  `histart_nombre` varchar(30) DEFAULT NULL,
  `histart_marca` varchar(30) DEFAULT NULL,
  `histart_descripcion` varchar(100) DEFAULT NULL,
  `histart_precio` float DEFAULT NULL,
  `histart_stock` int(6) DEFAULT NULL,
  `histart_fechaalta` datetime DEFAULT NULL,
  `histart_usuarioalta` int(5) DEFAULT NULL,
  `histart_fechabaja` datetime DEFAULT NULL,
  `histart_usuariobaja` int(5) DEFAULT NULL,
  `histart_activo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_articulos`
--

INSERT INTO `historial_articulos` (`id`, `histart_id_art`, `histart_accion`, `histart_id_usu`, `histart_id_categoria`, `histart_nombre`, `histart_marca`, `histart_descripcion`, `histart_precio`, `histart_stock`, `histart_fechaalta`, `histart_usuarioalta`, `histart_fechabaja`, `histart_usuariobaja`, `histart_activo`) VALUES
(2, 2, 'alta_art', 3, 1, 'Clavo_2mm_2cm', 'clavitos SA', 'clavos de 2mm de diametro por 2cm de largo', 2, 0, '2024-06-27 17:03:22', 3, NULL, NULL, NULL),
(3, 3, 'alta_art', 3, 1, 'Tornillo_Inox_2mm_2cm', 'Tornillo SA', 'Tornillo comÃºn de acero inoxidable', 4, 0, '2024-06-27 17:12:57', 3, NULL, NULL, NULL),
(4, 4, 'alta_art', 3, 0, 'w', 'w', 'w', 2, 0, '2024-06-27 17:20:36', 3, NULL, NULL, NULL),
(5, 5, 'alta_art', 3, 1, 'a', 's', 'd', 3, 0, '2024-06-27 17:43:09', 3, NULL, NULL, NULL),
(6, 4, 'borrar_art', 3, 0, 'w', 'w', 'w', 2, 0, '2024-06-27 17:20:36', 3, '2024-06-29 18:11:44', 3, NULL),
(7, 5, 'modif_art', 3, 1, 'a', 'a', 'a', 23, 0, NULL, NULL, NULL, NULL, NULL),
(8, 5, 'modif_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 50, 0, NULL, NULL, NULL, NULL, NULL),
(9, 6, 'alta_art', 3, 1, 'g', 'g', 'g', 3, 0, '2024-06-29 19:02:26', 3, NULL, NULL, NULL),
(10, 6, 'modif_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 3, 0, '2024-06-29 19:02:26', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_categorias`
--

CREATE TABLE `historial_categorias` (
  `id` int(6) NOT NULL,
  `histcat_id_cat` tinyint(4) DEFAULT NULL,
  `histcat_accion` varchar(12) DEFAULT NULL,
  `histcat_id_usu` int(5) DEFAULT NULL,
  `histcat_id_tipos` tinyint(4) DEFAULT NULL,
  `histcat_nombre` varchar(30) DEFAULT NULL,
  `histcat_descripcion` varchar(100) DEFAULT NULL,
  `histcat_fechaalta` datetime DEFAULT NULL,
  `histcat_usuarioalta` int(5) DEFAULT NULL,
  `histcat_fechabaja` datetime DEFAULT NULL,
  `histcat_usuariobaja` int(5) DEFAULT NULL,
  `histcat_activo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_categorias`
--

INSERT INTO `historial_categorias` (`id`, `histcat_id_cat`, `histcat_accion`, `histcat_id_usu`, `histcat_id_tipos`, `histcat_nombre`, `histcat_descripcion`, `histcat_fechaalta`, `histcat_usuarioalta`, `histcat_fechabaja`, `histcat_usuariobaja`, `histcat_activo`) VALUES
(1, 3, 'alta_categor', 3, NULL, 'herramientas_jardin', 'herramientas para el jardin', '2024-05-24 10:00:26', NULL, NULL, NULL, 'S'),
(2, 7, 'alta_categor', 3, 5, 'adornos_jardin', 'Adornos para el jardÃ­n', '2024-05-24 10:34:50', NULL, NULL, NULL, 'S'),
(3, 8, 'alta_categor', 3, 5, 'adornos_jardin', 'Adornos de jardin', '2024-05-24 11:22:09', NULL, NULL, NULL, 'S'),
(4, 4, 'modif_catego', 3, NULL, 'maquinarias_jardin', 'nuevo nombre descripcion y tipo', '2024-05-24 10:20:14', 3, NULL, NULL, 'S'),
(5, 8, 'modif_catego', 3, 0, 'adornos_de_jardin', 'prueba', '2024-05-24 11:22:09', 3, NULL, NULL, 'S'),
(6, 8, 'modif_catego', 3, 0, 'adornos_jardin', 'prueba2', '2024-05-24 11:22:09', 3, NULL, NULL, 'S'),
(7, 8, 'modif_catego', 3, 5, 'adornos_jardin', 'adornos para el jardin', '2024-05-24 11:22:09', 3, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_proveedores`
--

CREATE TABLE `historial_proveedores` (
  `id` int(5) NOT NULL,
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
  `histprov_fechaalta` datetime DEFAULT NULL,
  `histprov_usuarioalta` int(5) DEFAULT NULL,
  `histprov_fechabaja` datetime DEFAULT NULL,
  `histprov_usuariobaja` int(5) DEFAULT NULL,
  `histprov_activo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_proveedores`
--

INSERT INTO `historial_proveedores` (`id`, `histprov_accion`, `histprov_id_usu`, `histprov_id_prov`, `histprov_nombre`, `histprov_descripcion`, `histprov_direccion`, `histprov_localidad`, `histprov_provincia`, `histprov_tel1`, `histprov_tel2`, `histprov_email`, `histprov_cuit`, `histprov_fechaalta`, `histprov_usuarioalta`, `histprov_fechabaja`, `histprov_usuariobaja`, `histprov_activo`) VALUES
(1, 'alta_prov', 3, 1, 'Tornillete', 'Tornillete SA - Proveedor de tornillos varios', 'Lamas  1242', 'Santa Fe', 'Santa Fe', 342, 342, 'tornillete@tornillete.com', 35, '2024-05-20 11:42:03', 3, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_tipos`
--

CREATE TABLE `historial_tipos` (
  `id` tinyint(4) NOT NULL,
  `histtipos_accion` varchar(12) DEFAULT NULL,
  `histtipos_id_usu` int(5) DEFAULT NULL,
  `histtipos_id_tipos` int(5) DEFAULT NULL,
  `histtipos_nombre` varchar(20) DEFAULT NULL,
  `histtipos_descripcion` varchar(100) DEFAULT NULL,
  `histtipos_fechaalta` datetime DEFAULT NULL,
  `histtipos_usuarioalta` int(5) DEFAULT NULL,
  `histtipos_fechabaja` datetime DEFAULT NULL,
  `histtipos_usuariobaja` int(5) DEFAULT NULL,
  `histtipos_activo` char(1) DEFAULT NULL,
  `histtipos_fechahora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_tipos`
--

INSERT INTO `historial_tipos` (`id`, `histtipos_accion`, `histtipos_id_usu`, `histtipos_id_tipos`, `histtipos_nombre`, `histtipos_descripcion`, `histtipos_fechaalta`, `histtipos_usuarioalta`, `histtipos_fechabaja`, `histtipos_usuariobaja`, `histtipos_activo`, `histtipos_fechahora`) VALUES
(3, 'alta_tipo', 3, 5, 'Jar', 'Articulos para el jardin y de jardineria', '2024-05-17 14:05:06', 0, NULL, 0, 'S', '2024-05-23 10:46:55'),
(4, 'alta_tipo', 3, 6, 'prueba', 'prueb', '2024-05-20 13:01:08', 0, NULL, 0, 'S', '2024-05-23 10:46:55'),
(5, 'alta_tipo', 3, 7, '2', '222', '2024-05-23 10:55:29', 0, NULL, 0, 'S', '2024-05-23 10:55:29'),
(6, 'alta_tipo', 3, 8, '3', '333', '2024-05-23 11:21:56', 0, NULL, 0, 'S', '2024-05-23 11:21:56'),
(7, 'borrar_tipo', 3, 8, NULL, NULL, NULL, 0, NULL, 0, NULL, '2024-05-23 11:22:40'),
(8, 'alta_tipo', 3, 9, '4', '4444', '2024-05-23 11:25:26', 0, NULL, 0, 'S', '2024-05-23 11:25:26'),
(9, 'alta_tipo', 3, 10, '5', '555', '2024-05-23 11:26:35', 0, NULL, 0, 'S', '2024-05-23 11:26:35'),
(10, 'borrar_tipo', 3, 10, '5', '555', '2024-05-23 11:26:35', 3, '0000-00-00 00:00:00', 0, NULL, '2024-05-23 11:26:41'),
(11, 'alta_tipo', 3, 11, '7', '7777', '2024-05-23 11:28:37', 0, NULL, 0, 'S', '2024-05-23 11:28:37'),
(12, 'alta_tipo', 3, 12, '9', '999', '2024-05-23 11:55:11', NULL, NULL, NULL, 'S', '2024-05-23 11:55:11'),
(13, 'modif_tipo', 3, 0, '', '', '2024-05-23 11:55:11', 3, NULL, NULL, NULL, '2024-05-23 12:00:06'),
(14, 'modif_tipo', 3, 12, 'Tipo_renombrado', 'Es el tipo renombrado para probar la funcion de renombre', '2024-05-23 11:55:11', 3, NULL, NULL, NULL, '2024-05-23 12:17:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_usuarios`
--

CREATE TABLE `historial_usuarios` (
  `id` tinyint(4) NOT NULL,
  `histusu_accion` varchar(12) DEFAULT NULL,
  `histusu_id_usu` int(5) DEFAULT NULL,
  `histusu_id_usumodif` int(5) DEFAULT NULL,
  `histusu_id_permisos` tinyint(2) NOT NULL DEFAULT 1,
  `histusu_nombre` varchar(30) NOT NULL,
  `histusu_apellido` varchar(20) DEFAULT NULL,
  `histusu_direccion` varchar(30) NOT NULL,
  `histusu_password` varchar(30) NOT NULL,
  `histusu_cod_verif` int(6) NOT NULL,
  `histusu_cod_verif_bool` tinyint(1) NOT NULL DEFAULT 0,
  `histusu_id_suc` tinyint(4) NOT NULL DEFAULT 1,
  `histusu_email` varchar(50) NOT NULL,
  `histusu_fechahora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_usuarios`
--

INSERT INTO `historial_usuarios` (`id`, `histusu_accion`, `histusu_id_usu`, `histusu_id_usumodif`, `histusu_id_permisos`, `histusu_nombre`, `histusu_apellido`, `histusu_direccion`, `histusu_password`, `histusu_cod_verif`, `histusu_cod_verif_bool`, `histusu_id_suc`, `histusu_email`, `histusu_fechahora`) VALUES
(3, 'modif_usu', NULL, NULL, 1, '', NULL, '', '', 0, 0, 1, '', '2024-05-16 11:54:15'),
(4, 'modif_usu', 3, NULL, 1, '', NULL, '', '', 0, 0, 1, '', '2024-05-16 11:54:15'),
(5, 'modif_usu', 3, 65, 1, '', NULL, '', '', 0, 0, 1, '', '2024-05-16 11:54:15'),
(6, 'modif_usu', 3, 65, 1, 'monica', 'monday', 'flac', '', 0, 0, 1, 'gdol', '2024-05-16 11:56:04'),
(7, 'alta_usu', 3, 70, 2, 'Miguel', 'Mandini', 'Lacalle Pou 5656', '', 0, 0, 1, 'mguelman@fibercorp.com', '2024-05-16 12:19:54'),
(8, 'borrar_usu', 3, 63, 3, 'nn', 'aa', 'dd', '', 0, 0, 1, 'sd', '2024-05-16 12:42:23'),
(9, 'alta_usu', 3, 71, 1, 'gabriel', 'andres', 'pap', '', 0, 0, 1, 'dsod', '2024-05-16 12:53:06'),
(10, 'borrar_usu', 3, 58, 4, '', '', '', '', 0, 0, 1, '', '2024-05-16 13:04:31'),
(11, 'borrar_usu', 3, 56, 1, '', '', '', '', 0, 0, 1, '', '2024-05-16 13:06:22'),
(12, 'alta_usu', 3, 72, 4, 'a', 'a', 'a', '', 0, 0, 1, 'a', '2024-05-16 13:08:12'),
(13, 'borrar_usu', 3, 72, 4, 'a', 'a', 'a', '', 0, 0, 1, 'a', '2024-05-16 13:08:24'),
(14, 'alta_usu', 3, 73, 4, 'b', 'b', 'b', '', 0, 0, 1, 'b', '2024-05-16 13:24:57'),
(15, 'borrar_usu', 3, 73, 4, 'b', 'b', 'b', '', 0, 0, 1, 'b', '2024-05-16 13:25:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_historial`
--

CREATE TABLE `login_historial` (
  `id` int(10) NOT NULL,
  `login_usu_id` int(5) NOT NULL DEFAULT 1,
  `login_in_out` varchar(3) NOT NULL,
  `login_fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `login_historial`
--

INSERT INTO `login_historial` (`id`, `login_usu_id`, `login_in_out`, `login_fecha`) VALUES
(90, 3, 'in', '2024-05-16 09:45:53'),
(91, 3, 'in', '2024-05-17 09:24:40'),
(92, 3, 'in', '2024-05-17 13:58:09'),
(93, 3, 'in', '2024-05-20 11:33:34'),
(94, 3, 'out', '2024-05-20 11:59:36'),
(95, 3, 'in', '2024-05-20 12:01:27'),
(97, 3, 'in', '2024-05-23 10:53:04'),
(98, 3, 'in', '2024-05-24 09:00:21'),
(99, 3, 'in', '2024-06-27 08:36:51'),
(100, 3, 'out', '2024-06-27 15:22:18'),
(101, 3, 'in', '2024-06-27 15:22:32'),
(102, 3, 'out', '2024-06-27 15:36:28'),
(103, 3, 'in', '2024-06-27 15:36:42'),
(104, 3, 'out', '2024-06-27 15:43:50'),
(105, 3, 'in', '2024-06-27 15:44:00'),
(106, 3, 'out', '2024-06-27 15:44:11'),
(108, 3, 'in', '2024-06-27 15:44:42'),
(109, 3, 'out', '2024-06-27 15:46:36'),
(110, 3, 'in', '2024-06-27 15:46:48'),
(111, 3, 'out', '2024-06-27 15:52:47'),
(112, 3, 'in', '2024-06-27 15:53:04'),
(113, 3, 'out', '2024-06-27 16:44:41'),
(114, 3, 'in', '2024-06-27 16:44:51'),
(115, 3, 'out', '2024-06-27 16:49:58'),
(116, 3, 'in', '2024-06-27 16:50:09'),
(117, 3, 'out', '2024-06-27 17:02:11'),
(118, 3, 'in', '2024-06-27 17:02:20'),
(119, 3, 'out', '2024-06-27 17:35:13'),
(120, 3, 'in', '2024-06-27 17:35:23'),
(121, 3, 'out', '2024-06-27 17:42:38'),
(122, 3, 'in', '2024-06-27 17:42:48'),
(123, 3, 'in', '2024-06-29 18:10:18'),
(124, 3, 'out', '2024-06-29 19:11:30'),
(125, 3, 'in', '2024-06-29 19:13:50'),
(126, 3, 'out', '2024-06-29 19:18:13'),
(127, 3, 'in', '2024-06-29 19:18:25'),
(128, 3, 'out', '2024-06-29 19:27:20'),
(129, 3, 'in', '2024-06-29 19:27:30'),
(130, 3, 'out', '2024-06-29 19:54:04'),
(131, 3, 'in', '2024-06-29 19:58:02'),
(132, 3, 'out', '2024-06-29 19:58:52'),
(133, 3, 'in', '2024-06-29 19:59:19'),
(134, 3, 'in', '2024-06-30 03:30:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modopago`
--

CREATE TABLE `modopago` (
  `id` tinyint(4) NOT NULL,
  `modpa_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modopago`
--

INSERT INTO `modopago` (`id`, `modpa_nombre`) VALUES
(1, 'PAGO NO ESPECIF.'),
(2, 'EFECTIVO'),
(3, 'DEBITO'),
(4, 'CREDITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` tinyint(2) NOT NULL,
  `permisos_nombre` varchar(30) DEFAULT NULL,
  `permisos_descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permisos_nombre`, `permisos_descripcion`) VALUES
(1, 'SIN PERMISOS', 'Entrada reservada para usuarios sin ningún tipo de permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(5) NOT NULL,
  `prov_nombre` varchar(30) NOT NULL,
  `prov_descripcion` varchar(100) DEFAULT NULL,
  `prov_direccion` varchar(30) DEFAULT NULL,
  `prov_localidad` varchar(30) DEFAULT NULL,
  `prov_provincia` varchar(30) DEFAULT NULL,
  `prov_tel1` int(20) DEFAULT NULL,
  `prov_tel2` int(20) DEFAULT NULL,
  `prov_email` varchar(50) NOT NULL,
  `prov_cuit` int(11) NOT NULL,
  `prov_fechaalta` datetime DEFAULT NULL,
  `prov_usuarioalta` int(5) DEFAULT NULL,
  `prov_fechabaja` datetime DEFAULT NULL,
  `prov_usuariobaja` int(5) DEFAULT NULL,
  `prov_activo` char(1) DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `prov_nombre`, `prov_descripcion`, `prov_direccion`, `prov_localidad`, `prov_provincia`, `prov_tel1`, `prov_tel2`, `prov_email`, `prov_cuit`, `prov_fechaalta`, `prov_usuarioalta`, `prov_fechabaja`, `prov_usuariobaja`, `prov_activo`) VALUES
(1, 'Tornillete', 'Tornillete SA - Proveedor de tornillos varios', 'Lamas  1242', 'Santa Fe', 'Santa Fe', 342, 342, 'tornillete@tornillete.com', 35, '2024-05-20 11:42:03', 3, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` tinyint(4) NOT NULL,
  `sucs_nombre` varchar(30) NOT NULL,
  `sucs_direccion` varchar(30) NOT NULL,
  `sucs_tel1` int(30) NOT NULL,
  `sucs_tel2` int(30) DEFAULT NULL,
  `sucs_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `sucs_nombre`, `sucs_direccion`, `sucs_tel1`, `sucs_tel2`, `sucs_email`) VALUES
(1, 'CASA CENTRAL', 'San Martin 100', 341, 341, 'casa_central@ferrotec.com.ar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` tinyint(4) NOT NULL,
  `tipos_nombre` varchar(20) NOT NULL,
  `tipos_descripcion` varchar(100) NOT NULL,
  `tipos_fechaalta` datetime DEFAULT NULL,
  `tipos_usuarioalta` int(5) DEFAULT NULL,
  `tipos_fechabaja` datetime DEFAULT NULL,
  `tipos_usuariobaja` int(5) DEFAULT NULL,
  `tipos_activo` char(1) DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `tipos_nombre`, `tipos_descripcion`, `tipos_fechaalta`, `tipos_usuarioalta`, `tipos_fechabaja`, `tipos_usuariobaja`, `tipos_activo`) VALUES
(1, 'SIN', 'tipos no especificado', NULL, NULL, NULL, NULL, 'S'),
(5, 'Jardin', 'Articulos para el jardin y de jardineria', '2024-05-17 14:05:06', 3, NULL, NULL, 'S'),
(12, 'Tipo_renombrado', 'Es el tipo renombrado para probar la funcion de renombre', '2024-05-23 11:55:11', 3, NULL, NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL,
  `usu_id_permisos` tinyint(2) NOT NULL DEFAULT 1,
  `usu_username` varchar(12) NOT NULL,
  `usu_nombre` varchar(30) NOT NULL,
  `usu_apellido` varchar(30) NOT NULL,
  `usu_direccion` varchar(30) NOT NULL,
  `usu_password` varchar(30) NOT NULL,
  `usu_cod_verif` varchar(8) NOT NULL,
  `usu_cod_verif_bool` tinyint(1) NOT NULL DEFAULT 1,
  `usu_id_suc` tinyint(4) NOT NULL DEFAULT 1,
  `usu_email` varchar(50) NOT NULL,
  `usu_fecha_creacion` date NOT NULL,
  `usu_fecha_modif` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usu_id_permisos`, `usu_username`, `usu_nombre`, `usu_apellido`, `usu_direccion`, `usu_password`, `usu_cod_verif`, `usu_cod_verif_bool`, `usu_id_suc`, `usu_email`, `usu_fecha_creacion`, `usu_fecha_modif`) VALUES
(1, 1, 'USER-SIN-PER', 'USER-SIN-PERMISOS', '', 'San Martin 101', 'ferrotec', '0', 0, 1, 'ferrotec@ferrotec.com.ar', '2024-05-16', '2024-05-16'),
(2, 1, '2', '2', '', '2]', '2', '2', 0, 1, '2', '2024-05-16', '2024-05-16'),
(3, 3, 'fabrign', 'Fabricio', 'Gallina', 'Castellanos 2360', 'fabrign', '0', 0, 1, 'fabrign@live.com', '2024-05-16', '2024-05-16'),
(65, 1, 'f', 'monica', 'monday', 'flac', '', 'OLu9g,.F', 0, 1, 'gdol', '2024-05-16', '2024-05-16'),
(66, 2, 'Prueba1', 'Prueba', 'Aprueba', 'Dprueba', '', '(63?Rq<I', 0, 1, 'eprueba@live.com.ar', '2024-05-16', '2024-05-16'),
(67, 1, 'NOMBUSU', 'pepe', 'gomez', 'casa', '', 'nU{usiu{', 0, 1, 'emailemail', '2024-05-16', '2024-05-16'),
(68, 2, 'mariopg', 'Mario', 'Pergolini', 'Calafate 1122', '', 'd>8Lu]fu', 0, 1, 'mario_pg@gmail.com', '2024-05-16', NULL),
(69, 2, 'jerodlp', 'Jeronimo', 'De La Puente', 'Azul 4522', '', 'x!$zizG6', 0, 1, 'jero_delp@live.com', '2024-05-16', NULL),
(70, 2, 'miguelman', 'Miguel', 'Mandini', 'Lacalle Pou 5656', '', 'U5Aeuv@]', 0, 1, 'mguelman@fibercorp.com', '2024-05-16', NULL),
(71, 1, 'gabi', 'gabriel', 'andres', 'pap', '', '0D1Oj$^0', 0, 1, 'dsod', '2024-05-16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) NOT NULL,
  `ventas_id_usuario` int(5) NOT NULL DEFAULT 1,
  `ventas_id_modopago` tinyint(4) NOT NULL DEFAULT 1,
  `ventas_fecha` date NOT NULL DEFAULT current_timestamp(),
  `ventas_hora` time NOT NULL DEFAULT current_timestamp(),
  `ventas_monto` float NOT NULL,
  `ventas_suc` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `ventas_id_usuario`, `ventas_id_modopago`, `ventas_fecha`, `ventas_hora`, `ventas_monto`, `ventas_suc`) VALUES
(1, 10, 5, '2024-07-12', '12:01:13', 100, 1),
(2, 10, 5, '2024-07-12', '12:02:39', 16, 1),
(3, 3, 5, '2024-07-12', '12:05:09', 50, 1),
(4, 3, 0, '2024-07-12', '12:26:39', 2, 1),
(5, 3, 0, '2024-07-12', '12:28:27', 100, 1),
(6, 3, 0, '2024-07-12', '12:29:38', 50, 1),
(7, 3, 0, '2024-07-12', '12:29:42', 50, 1),
(8, 3, 3, '2024-07-12', '12:42:49', 2, 1),
(9, 3, 3, '2024-07-12', '12:42:55', 2, 1),
(10, 3, 1, '2024-07-12', '12:44:11', 0, 1),
(11, 3, 2, '2024-07-12', '12:46:10', 6, 1),
(12, 3, 1, '2024-07-12', '12:53:39', 4, 1),
(13, 3, 1, '2024-07-12', '12:53:48', 4, 1),
(14, 3, 2, '2024-07-12', '12:55:40', 4, 1),
(15, 3, 1, '2024-07-12', '14:20:45', 4, 1),
(16, 3, 3, '2024-07-12', '14:23:31', 2, 1),
(17, 3, 3, '2024-07-12', '14:23:36', 2, 1),
(18, 3, 1, '2024-07-12', '14:25:17', 200, 1),
(19, 3, 1, '2024-07-12', '14:25:20', 200, 1),
(20, 3, 1, '2024-07-12', '14:26:52', 54, 1),
(21, 3, 3, '2024-07-12', '14:31:41', 2, 1),
(22, 3, 1, '2024-07-12', '14:33:00', 4, 1),
(23, 3, 3, '2024-07-12', '14:33:26', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(10) NOT NULL,
  `vendet_id_venta` int(10) NOT NULL,
  `vendet_id_art` int(6) NOT NULL DEFAULT 1,
  `vendet_nom_art` varchar(20) DEFAULT NULL,
  `vendet_cantidad` int(10) DEFAULT NULL,
  `vendet_monto` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `vendet_id_venta`, `vendet_id_art`, `vendet_nom_art`, `vendet_cantidad`, `vendet_monto`) VALUES
(1, 18, 5, 'Martillo pesado', 4, NULL),
(2, 19, 5, 'Martillo pesado', 4, NULL),
(3, 20, 5, 'Martillo pesado', 1, NULL),
(4, 20, 2, 'Clavo_2mm_2cm', 2, NULL),
(5, 21, 2, 'Clavo_2mm_2cm', 1, NULL),
(6, 22, 0, 'Clavo_2mm_2cm', 2, NULL),
(7, 23, 2, 'Clavo_2mm_2cm', 1, NULL),
(8, 23, 2, 'Clavo_2mm_2cm', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_ibfk_1` (`compras_id_usuario`),
  ADD KEY `compras_ibfk_2` (`compras_id_prov`),
  ADD KEY `compras_ibfk_4` (`compras_id_modopago`);

--
-- Indices de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comdet_id_compra` (`comdet_id_compra`),
  ADD KEY `comdet_id_art` (`comdet_id_art`);

--
-- Indices de la tabla `historial_articulos`
--
ALTER TABLE `historial_articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_categorias`
--
ALTER TABLE `historial_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_proveedores`
--
ALTER TABLE `historial_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_tipos`
--
ALTER TABLE `historial_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_historial`
--
ALTER TABLE `login_historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_usu_id` (`login_usu_id`);

--
-- Indices de la tabla `modopago`
--
ALTER TABLE `modopago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usu_id_permisos` (`usu_id_permisos`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_id_usuario` (`ventas_id_usuario`),
  ADD KEY `ventas_id_modopago` (`ventas_id_modopago`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendet_id_venta` (`vendet_id_venta`),
  ADD KEY `vendet_id_art` (`vendet_id_art`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_articulos`
--
ALTER TABLE `historial_articulos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial_categorias`
--
ALTER TABLE `historial_categorias`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historial_proveedores`
--
ALTER TABLE `historial_proveedores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_tipos`
--
ALTER TABLE `historial_tipos`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `login_historial`
--
ALTER TABLE `login_historial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `modopago`
--
ALTER TABLE `modopago`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`compras_id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`compras_id_prov`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `compras_ibfk_4` FOREIGN KEY (`compras_id_modopago`) REFERENCES `modopago` (`id`);

--
-- Filtros para la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD CONSTRAINT `compras_detalle_ibfk_1` FOREIGN KEY (`comdet_id_compra`) REFERENCES `compras` (`id`),
  ADD CONSTRAINT `compras_detalle_ibfk_2` FOREIGN KEY (`comdet_id_art`) REFERENCES `articulos` (`id`);

--
-- Filtros para la tabla `login_historial`
--
ALTER TABLE `login_historial`
  ADD CONSTRAINT `login_historial_ibfk_1` FOREIGN KEY (`login_usu_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
