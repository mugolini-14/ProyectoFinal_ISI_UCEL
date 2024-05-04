-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2024 a las 19:23:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12
-- Modificación: 04-05-2024 - Mauricio Germán Ugolini (MGU) - Se agregan campos a las tablas

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
  `id` int(6) NOT NULL,
  --`art_id_tipo` tinyint(4) NOT NULL DEFAULT 1, 		-- 04-05-2024 - MGU
  `art_id_categoria` tinyint(4) NOT NULL DEFAULT 1,		-- 04-05-2024 - MGU
  --`art_nombre` varchar(20) NOT NULL,					-- 04-05-2024 - MGU
  --`art_marca` varchar(20) NOT NULL,					-- 04-05-2024 - MGU
  `art_nombre` varchar(30) NULL,						-- 04-05-2024 - MGU
  `art_marca` varchar(30) NULL,							-- 04-05-2024 - MGU
  --`art_detalle` varchar(100) NOT NULL,				-- 04-05-2024 - MGU
  `art_descripcion` varchar(100) NULL,					-- 04-05-2024 - MGU
  `art_precio` float NULL,
  `art_stock` int(6) NULL,
  `art_fechaalta` datetime NULL,						-- 04-05-2024 - MGU
  `art_usuarioalta` int(5) NULL,						-- 04-05-2024 - MGU
  `art_fechabaja` datetime NULL,						-- 04-05-2024 - MGU
  `art_usuariobaja` int(5) NULL,						-- 04-05-2024 - MGU
  `art_activo` char(1) NULL DEFAULT 'S',				-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

--INSERT INTO `articulos` (`id`, `art_id_tipo`, `art_nombre`, `art_detalle`, `art_precio`, `art_stock`) VALUES
--(1, 1, 'ARTICULO NO ESPECIFICADO', 'Entrada para articulo no especificado', 0, 0);

INSERT INTO `articulos` (`id`, `art_id_categoria`, `art_nombre`, `art_marca`, `art_descripcion`, `art_precio`, `art_stock`, `art_fechaalta`, 
`art_usuarioalta`, `art_fechabaja`, `art_usuariobaja`, `art_activo`) 
VALUES
(1, 1, 'ARTICULO NO ESPECIFICADO', 'MARCA BLANCA', 'DESCRIPCIÒN PARA ARTICULO',0, 1, GETDATE(),1,NULL,NULL,'S');

-- --------------------------------------------------------
-- 04-05-2024 - MGU
-- Estructura de tabla para la tabla `historial_articulos`
--

CREATE TABLE `historial_articulos` (
  `id` int(8) NULL,
  `histart_id_art` int(6) NULL,
  `histart_accion` varchar(12) NULL,
  `histart_usu` int(5) NULL,
  `histart_id_categoria` tinyint(4) NULL,				
  `histart_nombre` varchar(30) NULL,						
  `histart_marca` varchar(30) NULL,							
  `histart_descripcion` varchar(100) NULL,					
  `histart_precio` float NULL,
  `histart_stock` int(6) NULL,
  `histart_fechaalta` datetime NULL,						
  `histart_usuarioalta` int(5) NULL,						
  `histart_fechabaja` datetime NULL,						
  `histart_usuariobaja` int(5) NULL,						
  `histart_activo` char(1) NULL,				
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 04-05-2024 - MGU
-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(4) NOT NULL,
  `cat_id_tipo` tinyint(4) NOT NULL DEFAULT 1,			-- 04-05-2024 - MGU
  `cat_nombre` varchar(30) NULL,
  --`cat_detalle` varchar(100) NOT NULL,				-- 04-05-2024 - MGU
  `cat_descripcion` varchar(100) NULL,					-- 04-05-2024 - MGU
  `cat_fechaalta` datetime NULL,						-- 04-05-2024 - MGU
  `cat_usuarioalta` int(5) NULL,						-- 04-05-2024 - MGU
  `cat_fechabaja` datetime NULL,						-- 04-05-2024 - MGU
  `cat_usuariobaja` int(5) NULL,						-- 04-05-2024 - MGU
  `cat_activo` char(1) NULL DEFAULT 'S',				-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

--INSERT INTO `categorias` (`id`, `cat_nombre`, `cat_detalle`) VALUES
--(1, 'SIN CATEGOR`cat_activo`IZAR', 'Elementos que no pertenecen a ninguna categoria');

INSERT INTO `categorias` (`id`, `cat_id_tipo`, `cat_nombre`, `cat_descripcion`, `cat_fechaalta`, `cat_usuarioalta`, `cat_fechabaja`, `cat_usuariobaja`, `cat_activo`) 
VALUES
(1, 1, 'SIN CATEGORIZAR', 'Elementos que no pertenecen a ninguna categoria',GETDATE(),1,NULL,NULL,'S');


--
-- Disparadores `categorias`
--
DELIMITER $$
CREATE TRIGGER `despues_borrar_categoria` AFTER DELETE ON `categorias` FOR EACH ROW BEGIN
    UPDATE tipo
    SET tipo_id_cat = '1'
    WHERE id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------
-- 04-05-2024 - MGU
-- Estructura de tabla para la tabla `historial_categorias`
--

CREATE TABLE `historial_categorias` (
  `id` int(6) NULL,
  `histcat_id_cat` tinyint(4) NULL,
  `histcat_accion` varchar(12) NULL,
  `histcat_id_usu` int(5) NULL,
  `histcat_id_tipo` tinyint(4) NULL,			
  `histcat_nombre` varchar(30) NULL,
  `histcat_descripcion` varchar(100) NULL,					
  `histcat_fechaalta` datetime NULL,						
  `histcat_usuarioalta` int(5) NULL,						
  `histcat_fechabaja` datetime NULL,						
  `histcat_usuariobaja` int(5) NULL,						
  `histcat_activo` char(1) NULL ,				
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 04-05-2024 - MGU
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(5) NOT NULL,
  `compras_id_usuario` int(5) NOT NULL DEFAULT 1,
  `compras_id_modopago` tinyint(4) NOT NULL DEFAULT 1,
  `compras_suc` tinyint(4) NULL DEFAULT 1,
  `compras_id_prov` int(5) NULL DEFAULT 1,
  `compras_monto` float NOT NULL,
  --`compras_fecha` date NOT NULL,					-- 04-05-2024 - MGU
  --`compras_hora` time NOT NULL					-- 04-05-2024 - MGU
  compras_fecha datetime NULL						-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `id` int(10) NOT NULL,
  --`comdet_id_compra` int(10) NOT NULL DEFAULT 1,	-- 04-05-2024 - MGU
  --`comdet_id_art` int(5) NOT NULL DEFAULT 1,		-- 04-05-2024 - MGU
  `comdet_id_compra` int(10) NOT NULL ,				-- 04-05-2024 - MGU
  `comdet_id_art` int(6) NOT NULL,					-- 04-05-2024 - MGU
  `comdet_art_nom` varchar(20) NOT NULL,
  `comdet_cantidad` int(10) NOT NULL,
  --`comdet_monto` int(10) NOT NULL					-- 04-05-2024 - MGU
  `comdet_monto` float NOT NULL						-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_historial`
--

CREATE TABLE `login_historial` (
  `id` int(10) NOT NULL,
  `login_usu_id` int(5) NOT NULL DEFAULT 1,
  `login_in_out` tinyint(1) NOT NULL,
  --`login_fecha` date NOT NULL,					-- 04-05-2024 - MGU
  --`login_hora` time NOT NULL						-- 04-05-2024 - MGU
  `login_fecha` datetime NOT NULL					-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modopago`
--

CREATE TABLE `modopago` (
  `id` tinyint(4) NOT NULL,
  `modpa_nombre` varchar(20) NOT NULL,  
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
  --`permisos_nombre` varchar(20) NOT NULL,				-- 04-05-2024 - MGU
  --`permisos_detalle` varchar(100) NOT NULL			-- 04-05-2024 - MGU
  `permisos_nombre` varchar(30) NULL,					-- 04-05-2024 - MGU
  `permisos_descripcion` varchar(100) NULL				-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permisos_nombre`, `permisos_detalle`) VALUES
(1, 'SIN PERMISOS', 'Entrada reservada para usuarios sin ningún tipo de permisos');

--
-- Disparadores `permisos`
--
DELIMITER $$
CREATE TRIGGER `despues_borrar_tipodepermiso` AFTER DELETE ON `permisos` FOR EACH ROW BEGIN
    UPDATE usuarios
    SET usu_id_permisos = '1'
    WHERE id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(5) NOT NULL,
  --`prov_nombre` varchar(20) NOT NULL,					-- 04-05-2024 - MGU
  --`prov_direccion` varchar(30) NOT NULL,				-- 04-05-2024 - MGU
  --`prov_localidad` varchar(20) NOT NULL,				-- 04-05-2024 - MGU
  --`prov_provincia` varchar(20) NOT NULL,				-- 04-05-2024 - MGU
  `prov_nombre` varchar(30) NOT NULL,					-- 04-05-2024 - MGU
  `prov_descripcion` varchar(100) NULL,
  `prov_direccion` varchar(30) NULL,					-- 04-05-2024 - MGU
  `prov_localidad` varchar(30) NULL,					-- 04-05-2024 - MGU
  `prov_provincia` varchar(30) NULL,					-- 04-05-2024 - MGU
  `prov_tel1` int(20) NULL,
  `prov_tel2` int(20) NULL,
  --`prov_email` varchar(30) NOT NULL,					-- 04-05-2024 - MGU
  `prov_email` varchar(50) NOT NULL,					-- 04-05-2024 - MGU
  `prov_cuit` int(11) NOT NULL,
  `prov_fechaalta` datetime NULL,						-- 04-05-2024 - MGU
  `prov_usuarioalta` int(5) NULL,						-- 04-05-2024 - MGU
  `prov_fechabaja` datetime NULL,						-- 04-05-2024 - MGU
  `prov_usuariobaja` int(5) NULL,						-- 04-05-2024 - MGU
  `prov_activo` char(1) NULL DEFAULT 'S',				-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- 04-05-2024 - MGU
-- Estructura de tabla para la tabla `historial_proveedores`
--
CREATE TABLE `historial_proveedores` (
  `id` int NOT NULL,
  `histprov_accion` varchar(12) NULL,
  `histprov_id_usu` int(5) NULL,
  `histprov_id_prov` int(5) NULL,  
  `histprov_nombre` varchar(30) NULL,					
  `histprov_descripcion` varchar(100) NULL,
  `histprov_direccion` varchar(30) NULL,					
  `histprov_localidad` varchar(30) NULL,					
  `histprov_provincia` varchar(30) NULL,					
  `histprov_tel1` int(20) NULL,
  `histprov_tel2` int(20) NULL,
  `histprov_email` varchar(50) NULL,					
  `histprov_cuit` int(11) NULL,
  `histprov_fechaalta` datetime NULL,						
  `histprov_usuarioalta` int(5) NULL,						
  `histprov_fechabaja` datetime NULL,						
  `histprov_usuariobaja` int(5) NULL,						
  `histprov_activo` char(1) NULL ,							
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` tinyint(4) NOT NULL,
  --`sucs_nombre` varchar(20) NOT NULL,					-- 04-05-2024 - MGU
  `sucs_nombre` varchar(30) NOT NULL,					-- 04-05-2024 - MGU
  `sucs_direccion` varchar(30) NOT NULL,
  `sucs_tel1` int(30) NOT NULL,
  `sucs_tel2` int(30) NULL,
  --`sucs_email` varchar(30) NOT NULL					-- 04-05-2024 - MGU
  `sucs_email` varchar(50) NOT NULL						-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `sucs_nombre`, `sucs_direccion`, `sucs_tel1`, `sucs_tel2`, `sucs_email`) VALUES
(1, 'CASA CENTRAL', 'San Martin 100', 341, 341, 'casa_central@ferrotec.com.ar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` tinyint(4) NOT NULL,
  `tipo_id_cat` tinyint(4) NOT NULL DEFAULT 1,
  --`tipo_nombre` varchar(20) NOT NULL,					-- 04-05-2024 - MGU
  --`tipo_detalle` varchar(100) NOT NULL				-- 04-05-2024 - MGU
  `tipo_nombre` varchar(3) NOT NULL,					-- 04-05-2024 - MGU
  `tipo_descripcion` varchar(100) NOT NULL,				-- 04-05-2024 - MGU
  `tipo_fechaalta` datetime NULL,						-- 04-05-2024 - MGU
  `tipo_usuarioalta` int(5) NULL,						-- 04-05-2024 - MGU
  `tipo_fechabaja` datetime NULL,						-- 04-05-2024 - MGU
  `tipo_usuariobaja` int(5) NULL,						-- 04-05-2024 - MGU
  `tipo_activo` char(1) NULL DEFAULT 'S',				-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo_id_cat`, `tipo_nombre`, `tipo_detalle`) VALUES
(1, 1, 'SIN TIPIFICAR', 'Tipo no especificado'),
(2, 1, '2', '2');

--
-- Disparadores `tipo`
--
DELIMITER $$
CREATE TRIGGER `despues_borrar_tipo` AFTER DELETE ON `tipo` FOR EACH ROW BEGIN
    UPDATE articulos
    SET art_id_tipo = '1'
    WHERE id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------
-- 04-05-2024 - MGU
-- Estructura de tabla para la tabla `historial_tipo`

CREATE TABLE `historial_tipo` (
  `id` int NOT NULL,
  `histtipo_accion` VARCHAR(12) NULL,
  `histtipo_id_usu` int(5) NULL,
  `histtipo_id_tipo` int(5) NULL,
  `histtipo_id_cat` tinyint(4) NULL,
  `histtipo_nombre` varchar(3) NULL,					
  `histtipo_descripcion` varchar(100) NULL,				
  `histtipo_fechaalta` datetime NULL,						
  `histtipo_usuarioalta` int(5) NULL,						
  `histtipo_fechabaja` datetime NULL,						
  `histtipo_usuariobaja` int(5) NULL,						
  `histtipo_activo` char(1) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- 04-05-2024 - MGU

--
-- Estructura de tabla para la tabla `tipo`
--

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL,
  `usu_id_permisos` tinyint(2) NOT NULL DEFAULT 1,
  `usu_username` varchar(12) NOT NULL,
  `usu_nombreyapellido` varchar(30) NOT NULL,
  `usu_direccion` varchar(30) NOT NULL,
  `usu_password` varchar(30) NOT NULL,
  `usu_cod_verif` int(6) NOT NULL,
  --`usu_cod_verif_bool` tinyint(1) NOT NULL DEFAULT 0,		-- 04-05-2024 - MGU
  `usu_cod_verif_bool` BOOLEAN NOT NULL DEFAULT FALSE,		-- 04-05-2024 - MGU
  `usu_id_suc` tinyint(4) NOT NULL DEFAULT 1,				-- 04-05-2024 - MGU
  --`usu_email` varchar(30) NOT NULL						-- 04-05-2024 - MGU
  `usu_email` varchar(50) NOT NULL							-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usu_id_permisos`, `usu_username`, `usu_nombreyapellido`, `usu_direccion`, `usu_password`, `usu_cod_verif`, `usu_cod_verif_bool`, `usu_id_suc`, `usu_email`) VALUES
(1, 1, 'USER-SIN-PER', 'USER-SIN-PERMISOS', 'San Martin 101', 'ferrotec', 0, 0, 1, 'ferrotec@ferrotec.com.ar'),
(2, 1, '2', '2', '2]', '2', 2, 0, 1, '2');

-- --------------------------------------------------------

-- --------------------------------------------------------
-- 04-05-2024 - MGU
-- Estructura de tabla para la tabla `historial_usuarios`
CREATE TABLE `historial_usuarios` (
  `id` int(5) NOT NULL,
  `histusu_accion` VARCHAR(12) NULL,
  `histusu_id_usu` int(5) NULL,
  `histusu_id_usumodif` int(5) NULL,
  `histusu_id_permisos` tinyint(2) NOT NULL DEFAULT 1,
  `histusu_username` varchar(12) NOT NULL,
  `histusu_nombreyapellido` varchar(30) NOT NULL,
  `histusu_direccion` varchar(30) NOT NULL,
  `histusu_password` varchar(30) NOT NULL,
  `histusu_cod_verif` int(6) NOT NULL,
  `histusu_cod_verif_bool` BOOLEAN NOT NULL DEFAULT FALSE,		
  `histusu_id_suc` tinyint(4) NOT NULL DEFAULT 1,				
  `histusu_email` varchar(50) NOT NULL							
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) NOT NULL,
  `ventas_id_usuario` int(5) NOT NULL DEFAULT 1,
  `ventas_id_modopago` tinyint(4) NOT NULL DEFAULT 1,
  `ventas_fecha` date NOT NULL,
  `ventas_hora` time NOT NULL,
  `ventas_monto` float NOT NULL,
  `ventas_suc` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(10) NOT NULL,
  `vendet_id_venta` int(10) NOT NULL,
  `vendet_id_art` int(6) NOT NULL DEFAULT 1,
  `vendet_nom_art` varchar(20) NULL,
  `vendet_cantidad` int(10) NULL,
  --`vendet_monto` int(10) NOT NULL				-- 04-05-2024 - MGU
  `vendet_monto` float NULL						-- 04-05-2024 - MGU
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),

-- 04-05-2024 - MGU
-- Indices de la tabla `hisotorial_articulos`
--
ALTER TABLE `historial_articulos`
  ADD PRIMARY KEY (`id`)
-- 04-05-2024 - MGU

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

-- 04-05-2024 - MGU
-- Indices de la tabla `hisotorial_categorias`
--
ALTER TABLE `historial_categorias`
  ADD PRIMARY KEY (`id`)
-- 04-05-2024 - MGU

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  --ADD KEY `compras_id_usuario` (`compras_id_usuario`),			-- 04-05-2024 - MGU
  --ADD KEY `compras_id_modopago` (`compras_id_modopago`),			-- 04-05-2024 - MGU
  --ADD KEY `compras_suc` (`compras_suc`),							-- 04-05-2024 - MGU
  --ADD KEY `compras_id_prov` (`compras_id_prov`);					-- 04-05-2024 - MGU

--
-- Indices de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comdet_id_compra` (`comdet_id_compra`),
  ADD KEY `comdet_id_art` (`comdet_id_art`);

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

-- 04-05-2024 - MGU
-- Indices de la tabla `historial_proveedores`
--
ALTER TABLE `historial_proveedores`
  ADD PRIMARY KEY (`id`)
-- 04-05-2024 - MGU

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`),
  --ADD KEY `tipo_id_cat` (`tipo_id_cat`);

-- 04-05-2024 - MGU
-- Indices de la tabla `historial_tipo`
--
ALTER TABLE `historial_tipo`
  ADD PRIMARY KEY (`id`)
-- 04-05-2024 - MGU

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usu_id_permisos` (`usu_id_permisos`);

-- 04-05-2024 - MGU
-- Indices de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
  ADD PRIMARY KEY (`id`)
-- 04-05-2024 - MGU

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- 04-05-2024 - MGU
-- AUTO_INCREMENT de la tabla `historial_articulos`
--
ALTER TABLE `historial_articulos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial_categorias`
--
ALTER TABLE `historial_articulos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `login_historial`
--
ALTER TABLE `login_historial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

-- 04-05-2024 - MGU
-- AUTO_INCREMENT de la tabla `historial_proveedores`
--
ALTER TABLE `historial_proveedores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  
-- 04-05-2024 - MGU
-- AUTO_INCREMENT de la tabla `historial_tipo`
--
ALTER TABLE `historial_tipo`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  
-- 04-05-2024 - MGU
-- AUTO_INCREMENT de la tabla `historial_usuarios`
--
ALTER TABLE `historial_usuarios`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

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
