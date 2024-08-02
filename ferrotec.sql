-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2024 a las 17:49:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
  `art_stock` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `art_id_categoria`, `art_nombre`, `art_marca`, `art_descripcion`, `art_precio`, `art_stock`) VALUES
(1, 1, 'ARTICULO NO ESPECIFICADO', 'MARCA BLANCA', 'DESCRIPCIÒN PARA ARTICULO', 0, 1),
(2, 1, 'Clavo_2mm_2cm', 'clavitos SA', 'clavos de 2mm de diametro por 2cm de largo', 2, 100),
(3, 1, 'Tornillo_Inox_3mm_3cm', 'Tornillo SA', 'Tornillo comun de acero inoxidable, de 3mm de diametro por 3 cm de largos. Phillips', 1, 100),
(5, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 50, 100),
(6, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 3, 98);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(4) NOT NULL,
  `cat_id_tipo` tinyint(4) NOT NULL DEFAULT 1,
  `cat_nombre` varchar(30) DEFAULT NULL,
  `cat_descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `cat_id_tipo`, `cat_nombre`, `cat_descripcion`) VALUES
(1, 1, 'SIN CATEGORIZAR', 'Elementos que no pertenecen a ninguna categoria'),
(3, 5, 'herramientas_jardin', 'herramientas para el jardin'),
(4, 1, 'maquinarias_jardin', 'nuevo nombre descripcion y tipo'),
(6, 5, 'acondicionadores_de_jardin', 'Elementos acondicionadores para el terreno del jardin'),
(8, 5, 'adornos_jardin', 'adornos para el jardin'),
(10, 1, 'Pinturas', 'Todo tipo de pinturas para cualquier superficie');

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
  `compras_fechahora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `compras_id_usuario`, `compras_id_modopago`, `compras_suc`, `compras_id_prov`, `compras_monto`, `compras_fechahora`) VALUES
(1, 2, 1, 1, 1, 1034, NULL),
(2, 2, 2, 1, 1, 54, '2024-08-02 12:28:15'),
(3, 2, 2, 1, 1, 38, '2024-08-02 12:28:55');

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
  `histart_fechahora` datetime DEFAULT current_timestamp(),
  `histart_id_art` int(6) DEFAULT NULL,
  `histart_accion` varchar(12) DEFAULT NULL,
  `histart_id_usu` int(5) DEFAULT NULL,
  `histart_id_categoria` tinyint(4) DEFAULT NULL,
  `histart_nombre` varchar(30) DEFAULT NULL,
  `histart_marca` varchar(30) DEFAULT NULL,
  `histart_descripcion` varchar(100) DEFAULT NULL,
  `histart_precio` float DEFAULT NULL,
  `histart_stock` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_articulos`
--

INSERT INTO `historial_articulos` (`id`, `histart_fechahora`, `histart_id_art`, `histart_accion`, `histart_id_usu`, `histart_id_categoria`, `histart_nombre`, `histart_marca`, `histart_descripcion`, `histart_precio`, `histart_stock`) VALUES
(2, '2024-06-27 17:03:22', 2, 'alta_art', 3, 1, 'Clavo_2mm_2cm', 'clavitos SA', 'clavos de 2mm de diametro por 2cm de largo', 2, 0),
(3, '2024-06-27 17:12:57', 3, 'alta_art', 3, 1, 'Tornillo_Inox_2mm_2cm', 'Tornillo SA', 'Tornillo comÃºn de acero inoxidable', 4, 0),
(4, '2024-06-27 17:20:36', 4, 'alta_art', 3, 0, 'w', 'w', 'w', 2, 0),
(5, '2024-06-27 17:43:09', 5, 'alta_art', 3, 1, 'a', 's', 'd', 3, 0),
(6, '2024-06-27 17:20:36', 4, 'borrar_art', 3, 0, 'w', 'w', 'w', 2, 0),
(7, NULL, 5, 'modif_art', 3, 1, 'a', 'a', 'a', 23, 0),
(8, NULL, 5, 'modif_art', 3, 1, 'Martillo pesado', 'Philips', 'Martillo pesado de 1kg de piedra', 50, 0),
(9, '2024-06-29 19:02:26', 6, 'alta_art', 3, 1, 'g', 'g', 'g', 3, 0),
(10, '2024-06-29 19:02:26', 6, 'modif_art', 3, 1, 'Precintos 10cm', 'Precintos SA', 'Precintos de 10 cm de largo color negros', 3, 0),
(11, '2024-07-18 12:19:23', 7, 'alta_art', 3, 3, 'cortasetosverde', 'GardenMaster', 'Cortasetos elÃ©ctrico con cuchillas de acero endurecido, mango telescÃ³pico ajustable', 75, 0),
(12, '2024-07-18 12:23:33', 7, 'borrar_art', 3, 3, 'cortasetosverde', 'GardenMaster', 'Cortasetos elÃ©ctrico con cuchillas de acero endurecido, mango telescÃ³pico ajustable', 75, 0),
(13, '2024-07-18 12:28:44', 3, 'modif_art', 3, 1, 'Tornillo_Inox_3mm_3cm', 'Tornillo SA', 'Tornillo comun de acero inoxidable, de 2mm de diametro por 3 cm de largos. Phillips', 1, 84);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_categorias`
--

CREATE TABLE `historial_categorias` (
  `id` int(6) NOT NULL,
  `histcat_fechahora` datetime DEFAULT current_timestamp(),
  `histcat_id_cat` tinyint(4) DEFAULT NULL,
  `histcat_accion` varchar(12) DEFAULT NULL,
  `histcat_id_usu` int(5) DEFAULT NULL,
  `histcat_id_tipos` tinyint(4) DEFAULT NULL,
  `histcat_nombre` varchar(30) DEFAULT NULL,
  `histcat_descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_categorias`
--

INSERT INTO `historial_categorias` (`id`, `histcat_fechahora`, `histcat_id_cat`, `histcat_accion`, `histcat_id_usu`, `histcat_id_tipos`, `histcat_nombre`, `histcat_descripcion`) VALUES
(1, '2024-05-24 10:00:26', 3, 'alta_categor', 3, NULL, 'herramientas_jardin', 'herramientas para el jardin'),
(2, '2024-05-24 10:34:50', 7, 'alta_categor', 3, 5, 'adornos_jardin', 'Adornos para el jardÃ­n'),
(3, '2024-05-24 11:22:09', 8, 'alta_categor', 3, 5, 'adornos_jardin', 'Adornos de jardin'),
(4, '2024-05-24 10:20:14', 4, 'modif_catego', 3, NULL, 'maquinarias_jardin', 'nuevo nombre descripcion y tipo'),
(5, '2024-05-24 11:22:09', 8, 'modif_catego', 3, 0, 'adornos_de_jardin', 'prueba'),
(6, '2024-05-24 11:22:09', 8, 'modif_catego', 3, 0, 'adornos_jardin', 'prueba2'),
(7, '2024-05-24 11:22:09', 8, 'modif_catego', 3, 5, 'adornos_jardin', 'adornos para el jardin'),
(8, '2024-07-18 13:53:50', 9, 'alta_categor', 3, 5, 'limpieza_jardin', 'Elementos de orden y limpieza para el jardin'),
(9, '2024-07-18 13:57:55', 9, 'borrar_categ', 3, NULL, 'limpieza_jardin', 'Elementos de orden y limpieza para el jardin'),
(10, '2024-07-18 14:08:26', 10, 'alta_cat', 3, 12, 'asdsa', 'adsfasdf'),
(11, '2024-07-18 14:14:45', 10, 'modif_cat', 3, 1, 'Pinturas', 'Todo tipo de pinturas para cualquier superficie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_login`
--

CREATE TABLE `historial_login` (
  `id` int(10) NOT NULL,
  `histlogin_fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `histlogin_usu_id` int(5) NOT NULL DEFAULT 1,
  `histlogin_in_out` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `historial_login`
--

INSERT INTO `historial_login` (`id`, `histlogin_fecha`, `histlogin_usu_id`, `histlogin_in_out`) VALUES
(90, '2024-05-16 09:45:53', 3, 'in'),
(91, '2024-05-17 09:24:40', 3, 'in'),
(92, '2024-05-17 13:58:09', 3, 'in'),
(93, '2024-05-20 11:33:34', 3, 'in'),
(94, '2024-05-20 11:59:36', 3, 'out'),
(95, '2024-05-20 12:01:27', 3, 'in'),
(97, '2024-05-23 10:53:04', 3, 'in'),
(98, '2024-05-24 09:00:21', 3, 'in'),
(99, '2024-06-27 08:36:51', 3, 'in'),
(100, '2024-06-27 15:22:18', 3, 'out'),
(101, '2024-06-27 15:22:32', 3, 'in'),
(102, '2024-06-27 15:36:28', 3, 'out'),
(103, '2024-06-27 15:36:42', 3, 'in'),
(104, '2024-06-27 15:43:50', 3, 'out'),
(105, '2024-06-27 15:44:00', 3, 'in'),
(106, '2024-06-27 15:44:11', 3, 'out'),
(108, '2024-06-27 15:44:42', 3, 'in'),
(109, '2024-06-27 15:46:36', 3, 'out'),
(110, '2024-06-27 15:46:48', 3, 'in'),
(111, '2024-06-27 15:52:47', 3, 'out'),
(112, '2024-06-27 15:53:04', 3, 'in'),
(113, '2024-06-27 16:44:41', 3, 'out'),
(114, '2024-06-27 16:44:51', 3, 'in'),
(115, '2024-06-27 16:49:58', 3, 'out'),
(116, '2024-06-27 16:50:09', 3, 'in'),
(117, '2024-06-27 17:02:11', 3, 'out'),
(118, '2024-06-27 17:02:20', 3, 'in'),
(119, '2024-06-27 17:35:13', 3, 'out'),
(120, '2024-06-27 17:35:23', 3, 'in'),
(121, '2024-06-27 17:42:38', 3, 'out'),
(122, '2024-06-27 17:42:48', 3, 'in'),
(123, '2024-06-29 18:10:18', 3, 'in'),
(124, '2024-06-29 19:11:30', 3, 'out'),
(125, '2024-06-29 19:13:50', 3, 'in'),
(126, '2024-06-29 19:18:13', 3, 'out'),
(127, '2024-06-29 19:18:25', 3, 'in'),
(128, '2024-06-29 19:27:20', 3, 'out'),
(129, '2024-06-29 19:27:30', 3, 'in'),
(130, '2024-06-29 19:54:04', 3, 'out'),
(131, '2024-06-29 19:58:02', 3, 'in'),
(132, '2024-06-29 19:58:52', 3, 'out'),
(133, '2024-06-29 19:59:19', 3, 'in'),
(134, '2024-06-30 03:30:05', 3, 'in'),
(135, '2024-07-17 10:26:47', 3, 'in'),
(136, '2024-07-17 10:26:52', 3, 'out'),
(137, '2024-07-17 13:19:11', 3, 'in'),
(138, '2024-07-18 11:11:25', 2, 'in'),
(139, '2024-07-18 11:11:27', 2, 'out'),
(140, '2024-07-18 11:11:38', 3, 'in'),
(141, '2024-07-18 11:12:01', 3, 'out'),
(142, '2024-07-18 11:44:35', 3, 'in'),
(143, '2024-07-19 08:05:46', 3, 'in'),
(144, '2024-08-02 12:20:39', 2, 'in'),
(145, '2024-08-02 12:21:12', 2, 'out'),
(146, '2024-08-02 12:21:23', 2, 'in'),
(147, '2024-08-02 12:22:45', 2, 'out'),
(148, '2024-08-02 12:22:49', 2, 'in'),
(149, '2024-08-02 12:40:40', 2, 'out'),
(150, '2024-08-02 12:40:51', 3, 'in'),
(151, '2024-08-02 12:46:20', 3, 'out'),
(152, '2024-08-02 12:46:51', 74, 'ree'),
(153, '2024-08-02 12:48:11', 74, 'in');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_proveedores`
--

CREATE TABLE `historial_proveedores` (
  `id` int(5) NOT NULL,
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
  `histprov_cuit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_proveedores`
--

INSERT INTO `historial_proveedores` (`id`, `histprov_fechahora`, `histprov_accion`, `histprov_id_usu`, `histprov_id_prov`, `histprov_nombre`, `histprov_descripcion`, `histprov_direccion`, `histprov_localidad`, `histprov_provincia`, `histprov_tel1`, `histprov_tel2`, `histprov_email`, `histprov_cuit`) VALUES
(1, '2024-05-20 11:42:03', 'alta_prov', 3, 1, 'Tornillete', 'Tornillete SA - Proveedor de tornillos varios', 'Lamas  1242', 'Santa Fe', 'Santa Fe', 342, 342, 'tornillete@tornillete.com', 35),
(2, '2024-07-19 08:08:08', 'alta_prov', 3, 2, ' El Martillo S.A.', 'El Martillo S.A. es una empresa dedicada a la venta de productos y materiales de ferreterÃ­a.', 'Av. Libertador 1234', 'Capital Federal', 'Buenos Aires', 0, 0, 'info@ferreteriaelmartillo.com', 30),
(3, '2024-07-19 08:09:23', 'alta_prov', 3, 3, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
(4, '2024-07-19 08:21:33', 'baja_prov', 3, 3, 'a', 'a', 'a', 'a', 'a', 0, 0, '', 0),
(5, '2024-07-19 08:23:24', 'alta_prov', 3, 4, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
(6, '2024-07-19 08:23:56', 'baja_prov', 3, 4, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
(7, '2024-07-19 08:27:50', 'alta_prov', 3, 5, 'a', 'a', 'a', 'a', 'a', 0, 0, 'a', 0),
(8, '2024-07-19 10:27:54', 'modif_prov', 3, 5, 'b', 'b', 'b', 'b', 'b', 0, 0, 'b', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_tipos`
--

CREATE TABLE `historial_tipos` (
  `id` tinyint(4) NOT NULL,
  `histtipos_fechahora` datetime NOT NULL DEFAULT current_timestamp(),
  `histtipos_accion` varchar(12) DEFAULT NULL,
  `histtipos_id_usu` int(5) DEFAULT NULL,
  `histtipos_id_tipos` int(5) DEFAULT NULL,
  `histtipos_nombre` varchar(20) DEFAULT NULL,
  `histtipos_descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_tipos`
--

INSERT INTO `historial_tipos` (`id`, `histtipos_fechahora`, `histtipos_accion`, `histtipos_id_usu`, `histtipos_id_tipos`, `histtipos_nombre`, `histtipos_descripcion`) VALUES
(3, '2024-05-23 10:46:55', 'alta_tipo', 3, 5, 'Jar', 'Articulos para el jardin y de jardineria'),
(4, '2024-05-23 10:46:55', 'alta_tipo', 3, 6, 'prueba', 'prueb'),
(5, '2024-05-23 10:55:29', 'alta_tipo', 3, 7, '2', '222'),
(6, '2024-05-23 11:21:56', 'alta_tipo', 3, 8, '3', '333'),
(7, '2024-05-23 11:22:40', 'borrar_tipo', 3, 8, NULL, NULL),
(8, '2024-05-23 11:25:26', 'alta_tipo', 3, 9, '4', '4444'),
(9, '2024-05-23 11:26:35', 'alta_tipo', 3, 10, '5', '555'),
(10, '2024-05-23 11:26:41', 'borrar_tipo', 3, 10, '5', '555'),
(11, '2024-05-23 11:28:37', 'alta_tipo', 3, 11, '7', '7777'),
(12, '2024-05-23 11:55:11', 'alta_tipo', 3, 12, '9', '999'),
(13, '2024-05-23 12:00:06', 'modif_tipo', 3, 0, '', ''),
(14, '2024-05-23 12:17:18', 'modif_tipo', 3, 12, 'Tipo_renombrado', 'Es el tipo renombrado para probar la funcion de renombre'),
(15, '2024-07-19 10:46:06', 'alta_tipo', 3, 13, 'a', 'aa'),
(16, '2024-07-19 11:27:27', 'modif_tipo', 3, 13, 'b', 'bb'),
(17, '2024-07-19 11:28:55', 'borrar_tipo', 3, 13, 'b', 'bb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_usuarios`
--

CREATE TABLE `historial_usuarios` (
  `id` tinyint(4) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_usuarios`
--

INSERT INTO `historial_usuarios` (`id`, `histusu_fechahora`, `histusu_accion`, `histusu_id_usu`, `histusu_id_usumodif`, `histusu_id_permisos`, `histusu_nombre`, `histusu_apellido`, `histusu_direccion`, `histusu_password`, `histusu_cod_verif`, `histusu_id_suc`, `histusu_email`) VALUES
(3, '2024-05-16 11:54:15', 'modif_usu', NULL, NULL, 1, '', NULL, '', '', 0, 1, ''),
(4, '2024-05-16 11:54:15', 'modif_usu', 3, NULL, 1, '', NULL, '', '', 0, 1, ''),
(5, '2024-05-16 11:54:15', 'modif_usu', 3, 65, 1, '', NULL, '', '', 0, 1, ''),
(6, '2024-05-16 11:56:04', 'modif_usu', 3, 65, 1, 'monica', 'monday', 'flac', '', 0, 1, 'gdol'),
(7, '2024-05-16 12:19:54', 'alta_usu', 3, 70, 2, 'Miguel', 'Mandini', 'Lacalle Pou 5656', '', 0, 1, 'mguelman@fibercorp.com'),
(8, '2024-05-16 12:42:23', 'borrar_usu', 3, 63, 3, 'nn', 'aa', 'dd', '', 0, 1, 'sd'),
(9, '2024-05-16 12:53:06', 'alta_usu', 3, 71, 1, 'gabriel', 'andres', 'pap', '', 0, 1, 'dsod'),
(10, '2024-05-16 13:04:31', 'borrar_usu', 3, 58, 4, '', '', '', '', 0, 1, ''),
(11, '2024-05-16 13:06:22', 'borrar_usu', 3, 56, 1, '', '', '', '', 0, 1, ''),
(12, '2024-05-16 13:08:12', 'alta_usu', 3, 72, 4, 'a', 'a', 'a', '', 0, 1, 'a'),
(13, '2024-05-16 13:08:24', 'borrar_usu', 3, 72, 4, 'a', 'a', 'a', '', 0, 1, 'a'),
(14, '2024-05-16 13:24:57', 'alta_usu', 3, 73, 4, 'b', 'b', 'b', '', 0, 1, 'b'),
(15, '2024-05-16 13:25:16', 'borrar_usu', 3, 73, 4, 'b', 'b', 'b', '', 0, 1, 'b'),
(16, '2024-07-17 13:19:47', 'baja_usu', 3, 66, 2, 'Prueba', 'Aprueba', 'Dprueba', '', 0, 1, 'eprueba@live.com.ar'),
(17, '2024-07-17 13:24:33', 'baja_usu', 3, 66, 1, 'Prueba', 'Aprueba', 'Dprueba', '', 0, 1, 'eprueba@live.com.ar'),
(18, '2024-07-17 13:24:46', 'baja_usu', 3, 66, 1, 'Prueba', 'Aprueba', 'Dprueba', '', 0, 1, 'eprueba@live.com.ar'),
(19, '2024-07-18 11:11:51', 'baja_usu', 3, 2, 3, '2', '', '2]', '', 0, 1, '2'),
(20, '2024-08-02 12:40:38', 'alta_usu', 2, 74, 4, '3', '3', '3', '', 0, 1, '3'),
(21, '2024-08-02 12:41:07', 'baja_usu', 3, 74, 4, '3', '3', '3', '', 0, 1, '3');

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
  `prov_cuit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `prov_nombre`, `prov_descripcion`, `prov_direccion`, `prov_localidad`, `prov_provincia`, `prov_tel1`, `prov_tel2`, `prov_email`, `prov_cuit`) VALUES
(1, 'Tornillete', 'Tornillete SA - Proveedor de tornillos varios', 'Lamas  1242', 'Santa Fe', 'Santa Fe', 342, 342, 'tornillete@tornillete.com', 35),
(2, ' El Martillo S.A.', 'El Martillo S.A. es una empresa dedicada a la venta de productos y materiales de ferreterÃ­a.', 'Av. Libertador 1234', 'Capital Federal', 'Buenos Aires', 0, 0, 'info@ferreteriaelmartillo.com', 30),
(5, 'b', 'b', 'b', 'b', 'b', 0, 0, 'b', 0);

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
  `tipos_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `tipos_nombre`, `tipos_descripcion`) VALUES
(1, 'SIN', 'tipos no especificado'),
(5, 'Jardin', 'Articulos para el jardin y de jardineria'),
(12, 'Tipo_renombrado', 'Es el tipo renombrado para probar la funcion de renombre');

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
  `usu_id_suc` tinyint(4) NOT NULL DEFAULT 1,
  `usu_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usu_id_permisos`, `usu_username`, `usu_nombre`, `usu_apellido`, `usu_direccion`, `usu_password`, `usu_cod_verif`, `usu_id_suc`, `usu_email`) VALUES
(1, 1, 'USER-SIN-PER', 'USER-SIN-PERMISOS', '', 'San Martin 101', 'ferrotec', '0', 1, 'ferrotec@ferrotec.com.ar'),
(2, 0, '2', '2', '', '2]', '2', '2', 1, '2'),
(3, 3, 'fabrign', 'Fabricio', 'Gallina', 'Castellanos 2360', 'fabrign', '0', 1, 'fabrign@live.com'),
(65, 1, 'f', 'monica', 'monday', 'flac', '', 'OLu9g,.F', 1, 'gdol'),
(66, 1, 'Prueba1', 'Prueba', 'Aprueba', 'Dprueba', '', '(63?Rq<I', 1, 'eprueba@live.com.ar'),
(67, 1, 'NOMBUSU', 'pepe', 'gomez', 'casa', '', 'nU{usiu{', 1, 'emailemail'),
(68, 2, 'mariopg', 'Mario', 'Pergolini', 'Calafate 1122', '', 'd>8Lu]fu', 1, 'mario_pg@gmail.com'),
(69, 2, 'jerodlp', 'Jeronimo', 'De La Puente', 'Azul 4522', '', 'x!$zizG6', 1, 'jero_delp@live.com'),
(70, 2, 'miguelman', 'Miguel', 'Mandini', 'Lacalle Pou 5656', '', 'U5Aeuv@]', 1, 'mguelman@fibercorp.com'),
(71, 1, 'gabi', 'gabriel', 'andres', 'pap', '', '0D1Oj$^0', 1, 'dsod'),
(74, 0, '3', '3', '3', '3', 'Fabrign89-', '', 1, 'fabrign@live.com');

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
(23, 3, 3, '2024-07-12', '14:33:26', 4, 1),
(24, 3, 0, '2024-07-19', '12:11:39', 200, 1),
(25, 3, 0, '2024-07-19', '12:14:20', 0, 1),
(26, 3, 0, '2024-07-19', '12:21:01', 0, 1),
(27, 3, 0, '2024-07-19', '12:21:14', 0, 1),
(28, 3, 0, '2024-07-19', '12:22:14', 0, 1),
(29, 3, 0, '2024-07-19', '12:22:21', 0, 1),
(30, 3, 0, '2024-07-19', '12:22:50', 0, 1),
(31, 3, 1, '2024-07-19', '12:27:08', 0, 1),
(32, 3, 0, '2024-07-19', '12:56:11', 50, 1),
(33, 3, 1, '2024-07-19', '13:52:23', 50, 1),
(34, 2, 1, '2024-08-02', '12:21:56', 80, 1);

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
(8, 23, 2, 'Clavo_2mm_2cm', 1, NULL),
(9, 24, 5, 'Martillo pesado', 4, 200),
(10, 26, 5, 'Martillo pesado', 0, 0),
(11, 32, 5, 'Martillo pesado', 1, 50),
(12, 33, 5, 'Martillo pesado', 1, 50),
(13, 34, 5, 'Martillo pesado', 1, 50),
(14, 34, 2, 'Clavo_2mm_2cm', 15, 30);

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
-- Indices de la tabla `historial_login`
--
ALTER TABLE `historial_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_usu_id` (`histlogin_usu_id`);

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
-- Indices de la tabla `modopago`
--
ALTER TABLE `modopago`
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_articulos`
--
ALTER TABLE `historial_articulos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `historial_categorias`
--
ALTER TABLE `historial_categorias`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `historial_login`
--
ALTER TABLE `historial_login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `historial_proveedores`
--
ALTER TABLE `historial_proveedores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historial_tipos`
--
ALTER TABLE `historial_tipos`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `modopago`
--
ALTER TABLE `modopago`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Filtros para la tabla `historial_login`
--
ALTER TABLE `historial_login`
  ADD CONSTRAINT `historial_login_ibfk_1` FOREIGN KEY (`histlogin_usu_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
