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

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `art_id_categoria`, `art_nombre`, `art_marca`, `art_descripcion`, `art_precio`, `art_stock`, `art_activo`) VALUES
(1, 1, 'Tornillo_Inox_3mm_3cm', 'Tornillo SA', 'Tornillo común de acero inoxidable, de 3mm de diámetro por 3cm de largo. Phillips', 600, 500, 1),
(2, 1, 'Tornillo_Acero_5mm_5cm', 'Tornillos XYZ', 'Tornillo de acero de 5mm de diámetro por 5cm de largo. Cabeza hexagonal', 1000, 300, 1),
(3, 2, 'Clavo_Acero_2mm_5cm', 'Clavos SA', 'Clavo de acero, 2mm de diámetro por 5cm de largo', 750, 700, 1),
(4, 2, 'Clavo_Galvanizado_4mm_10cm', 'Clavos Pro', 'Clavo galvanizado de 4mm de diámetro por 10cm de largo', 600, 400, 1),
(5, 3, 'Perno_Acero_M12', 'Pernos Master', 'Perno de acero con diámetro de 12mm, alta resistencia', 1500, 200, 1),
(6, 3, 'Bulon_Galvanizado_8mm_12cm', 'Bulones Pro', 'Bulón galvanizado de 8mm de diámetro por 12cm de largo', 1600, 150, 1),
(7, 4, 'Martillo_Carpintero', 'Herramientas Martínez', 'Martillo de carpintero con mango de madera', 30000, 100, 1),
(8, 4, 'Martillo_Demolicion_5kg', 'Herramientas Heavy', 'Martillo de demolición de 5kg con mango de fibra', 63000, 50, 1),
(9, 5, 'Alicate_Corte_7pulgadas', 'Herramientas Pro', 'Alicate de corte de 7 pulgadas para trabajos de precisión', 78000, 120, 1),
(10, 6, 'Llave_Inglesa_12pulgadas', 'Llaves Premium', 'Llave inglesa de 12 pulgadas ajustable', 89000, 75, 0),
(11, 7, 'Cemento_Portland_50kg', 'Cemex', 'Saco de cemento Portland de 50kg', 11000, 200, 0),
(12, 8, 'Ladrillo_Hueco', 'Ladrillos SA', 'Ladrillo hueco estándar para construcción', 240, 1000, 0);


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categorias`
--
INSERT INTO `categorias` (`id`, `cat_id_tipo`, `cat_nombre`, `cat_descripcion`, `cat_activo`) VALUES
(1, 3, 'Tornillos', 'Artículos para fijación mediante roscas', 1),
(2, 3, 'Clavos', 'Clavos de diferentes tamaños y formas para fijaciones', 1),
(3, 3, 'Pernos y bulones', 'Elementos de fijación de alta resistencia', 1),
(4, 1, 'Martillos', 'Herramientas manuales para golpear y clavar', 1),
(5, 1, 'Alicates', 'Herramientas manuales para sujetar y cortar', 1),
(6, 1, 'Llaves inglesas', 'Herramientas manuales para ajuste de tornillos y pernos', 1),
(7, 2, 'Cemento', 'Materiales para unión en construcción', 1),
(8, 2, 'Ladrillos', 'Bloques de arcilla o cerámicos para construcción', 1),
(9, 6, 'Articulos de electricidad', 'Articulos varios de electricidad', 0),
(10, 1, 'Herramientas electricas', 'Herramientas electricas de AC o DC', 0),
(11, 1, 'Destornilladores', 'Herramientas manuales para destornillar', 0);

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

INSERT INTO `tipos` (`id`, `tipos_nombre`, `tipos_descripcion`, `tipos_activo`) VALUES
(1, 'Herramientas', 'Herramientas y artículos para la construcción', 1),
(2, 'Materiales de construcción', 'Materiales necesarios para la construcción de estructuras y viviendas', 1),
(3, 'Fijaciones', 'Artículos para unir y fijar piezas', 1),
(4, 'Abrasivos', 'Materiales abrasivos y de corte', 1),
(5, 'Accesorios', 'Accesorios y complementos para la construcción', 0),
(6, 'Electricidad', 'Elementos de electricidad', 0);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id_permisos`, `usu_username`, `usu_nombre`, `usu_apellido`, `usu_direccion`, `usu_password`, `usu_cod_verif`, `usu_id_suc`, `usu_email`) VALUES
(4, 'fabrign', 'Fabricio', 'Gallina', 'Castellanos 2360', 'fabrign', '0', 1, 'fabrign@live.com'),
(4, 'mg.ugolini', 'Mauricio', 'Ugolini', 'Ituzaingo 21 Bis 9 C', 'mgu-031992', '0', 1, 'mugolini@gmail.com'),
(3, 'garcial', 'Leandro', 'Garcia', 'Alem 950', 'Lobo4marco', '0', 1, 'lea_garcia@live.com'),
(2, 'lopezm', 'Marcia', 'Lopez', 'San Lorenzo 1245', '23145aN12', '0', 1, 'marc_lo_1245@yahoo.com'),
(1, 'userSinPer', 'Usuario', 'Sin Permisos', 'Dirección S/N', 'ferrotec', '0', 1, 'ferrotec-noresponder@outlook.com');
(4, 'admin', 'Admin', 'Admin', 'S/D', 'ferrotec', '0', 1, 'ferrotec-noresponder@outlook.com'),

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas`
--
INSERT INTO `historial_ventas` (`id`, `histventas_id_usuario`, `histventas_id_modopago`, `histventas_fechahora`, `histventas_monto`, `histventas_suc`) VALUES
(1, 1, 2, '2024-06-01 13:43:53', 64500, 1),
(3, 1, 2, '2024-06-02 15:51:51', 67000, 1),
(4, 1, 1, '2024-06-04 17:22:33', 227000, 1);
--
-- Volcado de datos para la tabla `historial_ventas_detalle`
--
INSERT INTO `historial_ventas_detalle` (`id`, `histvendet_id_venta`, `histvendet_id_art`, `histvendet_cantidad`, `histvendet_monto`) VALUES
(1, 1, 1, 20, 12000),
(2, 1, 3, 30, 22500),
(3, 1, 7, 1, 30000),
(6, 3, 12, 50, 12000),
(7, 3, 11, 5, 55000),
(8, 4, 1, 20, 12000),
(9, 4, 10, 1, 89000),
(10, 4, 8, 2, 126000);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas_detalle_eliminados`
--
INSERT INTO `historial_ventas_detalle_eliminados` (`id`, `histvendetelim_id_venta`, `histvendetelim_id_art`, `histvendetelim_cantidad`, `histvendetelim_monto`) VALUES
(1, 2, 9, 2, 156000),
(2, 2, 7, 3, 90000);
-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `historial_ventas_eliminados`
--
INSERT INTO `historial_ventas_eliminados` (`id`, `histventaselim_userid`, `histventaselim_fechahora`, `histventas_id`, `histventas_id_usuario`, `histventas_id_modopago`, `histventas_fechahora`, `histventas_monto`, `histventas_suc`) VALUES
(1, 1, '2024-06-01 14:33:11', 2, 1, 3, '2024-06-01 14:23:53', 246000, 1);
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