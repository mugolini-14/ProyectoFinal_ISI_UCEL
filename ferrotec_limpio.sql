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
  `art_activo` int(1) DEFAULT NULL
) AUTO_INCREMENT=1 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `cat_id_tipo` tinyint(4) NOT NULL DEFAULT 1,
  `cat_nombre` varchar(30) DEFAULT NULL,
  `cat_descripcion` varchar(100) DEFAULT NULL,
  `cat_activo` int(1) DEFAULT NULL
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
  `histart_activo` int(1) DEFAULT NULL
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
  `histcat_descripcion` varchar(100) DEFAULT NULL,
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
  `histprov_activo` int(1) DEFAULT NULL
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
  `histtipos_descripcion` varchar(100) DEFAULT NULL,
  `histtipos_activo` int(1) DEFAULT NULL
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
  `prov_activo` int(1) DEFAULT NULL
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
  `tipos_descripcion` varchar(100) NOT NULL,
  `tipos_activo` int(1) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `categorias`
--


-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_compras`
--


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_compras_detalle_eliminados`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_compras_eliminados`
--



-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_articulos`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_categorias`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_login`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_proveedores`
--


-- --------------------------------------------------------

-- 
-- Volcado de datos para la tabla `historial_tipos`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_usuarios`
--

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

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id_permisos`, `usu_username`, `usu_nombre`, `usu_apellido`, `usu_direccion`, `usu_password`, `usu_cod_verif`, `usu_id_suc`, `usu_email`) VALUES
(3, 'fabrign', 'Fabricio', 'Gallina', 'Castellanos 2360', 'fabrign', '0', 1, 'fabrign@live.com');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas`
--

--
-- Volcado de datos para la tabla `historial_ventas_detalle`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas_detalle_eliminados`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas_eliminados`
--

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