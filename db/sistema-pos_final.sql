-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2020 a las 08:15:43
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema-pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Equipos Electromecánicos', '2017-12-21 23:29:27'),
(2, 'Taladros', '2017-12-21 22:56:23'),
(3, 'Andamios', '2017-12-21 22:56:46'),
(4, 'Generadores de energía', '2017-12-21 22:56:58'),
(7, 'Equipos para construcción', '2017-12-21 23:40:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(1, 'Daniel Urresti', 12345678, 'bejaranoaliaga94@gmail.com', '(964) 546-541', 'km. 10.5 Victor Malazquez', '1991-12-05', 9, '2020-07-12 18:18:26', '2020-07-12 23:18:26'),
(2, 'Amir Asan', 2147483647, 'amir@gmail.com', '(974) 153-143', 'km 105', '1965-02-21', 16, '2020-07-30 01:08:52', '2020-07-30 06:08:52'),
(3, 'Ashely marcelita', 2147483647, 'ashely@gmail.com', '(201) 020-105', 'calle las orquideas', '2005-12-03', 7, '2020-07-30 01:14:01', '2020-07-30 06:14:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(18, 2, '201', 'Martillo Demoledor de Piso 110V', '', 20, 5600, 7840, 0, '2020-05-31 20:01:42'),
(19, 2, '202', 'Muela o cincel martillo demoledor piso', '', 20, 9600, 13440, 0, '2020-05-31 20:01:42'),
(20, 2, '203', 'Taladro Demoledor de muro 110V', '', 20, 3850, 5390, 0, '2020-05-31 20:01:42'),
(21, 2, '204', 'Muela o cincel martillo demoledor muro', '', 20, 9600, 13440, 0, '2020-05-31 20:01:42'),
(22, 2, '205', 'Taladro Percutor de 1/2 pulg Madera y Metal', '', 20, 8000, 11200, 0, '2020-06-01 02:12:03'),
(23, 2, '206', 'Taladro Percutor SDS Plus 110V', '', 20, 3900, 5460, 0, '2020-05-31 20:01:42'),
(24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', '', 20, 4600, 6440, 0, '2020-05-31 20:01:42'),
(25, 3, '301', 'Andamio colgante', '', 20, 1440, 2016, 0, '2020-05-31 20:01:42'),
(26, 3, '302', 'Distanciador andamio colgante', '', 20, 1600, 2240, 0, '2020-05-31 20:01:42'),
(27, 3, '303', 'Marco andamio modular ', '', 20, 900, 1260, 0, '2020-05-31 20:01:42'),
(28, 3, '304', 'Marco andamio tijera', '', 20, 100, 140, 0, '2020-05-31 20:01:42'),
(29, 3, '305', 'Tijera para andamio', '', 20, 162, 226.8, 0, '2020-05-31 20:01:42'),
(30, 3, '306', 'Escalera interna para andamio', '', 20, 270, 378, 0, '2020-05-31 20:01:42'),
(31, 3, '307', 'Pasamanos de seguridad', '', 20, 75, 105, 0, '2020-05-31 20:01:42'),
(32, 3, '308', 'Rueda giratoria para andamio', '', 19, 168, 235.2, 2, '2020-07-27 18:48:35'),
(33, 3, '309', 'Arnes de seguridad', '', 19, 1750, 2450, 2, '2020-07-27 18:48:35'),
(34, 3, '310', 'Eslinga para arnes', '', 20, 175, 245, 0, '2020-05-31 20:01:42'),
(35, 3, '311', 'Plataforma Met?lica', '', 20, 420, 588, 0, '2020-05-31 20:01:42'),
(36, 4, '401', 'Planta Electrica Diesel 6 Kva', '', 20, 3500, 4900, 0, '2020-05-31 20:01:42'),
(37, 4, '402', 'Planta Electrica Diesel 10 Kva', '', 20, 3550, 4970, 0, '2020-05-31 20:01:42'),
(38, 4, '403', 'Planta Electrica Diesel 20 Kva', '', 20, 3600, 5040, 0, '2020-05-31 20:01:42'),
(39, 4, '404', 'Planta Electrica Diesel 30 Kva', '', 20, 3650, 5110, 0, '2020-05-31 20:01:42'),
(40, 4, '405', 'Planta Electrica Diesel 60 Kva', '', 20, 3700, 5180, 0, '2020-05-31 20:01:42'),
(41, 4, '406', 'Planta Electrica Diesel 75 Kva', '', 20, 3750, 5250, 0, '2020-05-31 20:01:42'),
(42, 4, '407', 'Planta Electrica Diesel 100 Kva', '', 20, 3800, 5320, 0, '2020-05-31 20:01:42'),
(43, 4, '408', 'Planta Electrica Diesel 120 Kva', '', 20, 3850, 5390, 0, '2020-05-31 20:01:42'),
(44, 5, '501', 'Escalera de Tijera Aluminio ', '', 20, 350, 490, 0, '2020-05-31 20:01:42'),
(45, 5, '502', 'Extension Electrica ', '', 20, 370, 518, 0, '2020-05-31 20:01:42'),
(46, 5, '503', 'Gato tensor', '', 20, 380, 532, 0, '2020-05-31 20:01:42'),
(47, 5, '504', 'Lamina Cubre Brecha ', '', 20, 380, 532, 0, '2020-05-31 20:01:42'),
(48, 5, '505', 'Llave de Tubo', '', 20, 480, 672, 0, '2020-05-31 20:01:42'),
(49, 5, '506', 'Manila por Metro', '', 20, 600, 840, 0, '2020-05-31 20:01:42'),
(50, 5, '507', 'Polea 2 canales', '', 20, 900, 1260, 0, '2020-05-31 20:01:42'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '2020-05-31 20:01:42'),
(52, 5, '509', 'Bascula ', '', 20, 130, 182, 0, '2020-05-31 20:01:42'),
(53, 5, '510', 'Bomba Hidrostatica', '', 16, 770, 1078, 4, '2020-07-12 23:18:26'),
(54, 5, '511', 'Chapeta', '', 17, 660, 924, 3, '2020-07-12 23:19:03'),
(55, 5, '512', 'Cilindro muestra de concreto', '', 15, 400, 560, 5, '2020-07-12 23:19:03'),
(56, 5, '513', 'Cizalla de Palanca', '', 18, 450, 630, 2, '2020-07-30 06:14:01'),
(57, 5, '514', 'Cizalla de Tijera', '', 17, 580, 812, 3, '2020-07-30 06:14:01'),
(58, 5, '515', 'Coche llanta neumatica', '', 20, 420, 588, 0, '2020-05-31 20:01:42'),
(59, 5, '516', 'Cono slump', '', 17, 140, 196, 3, '2020-07-30 06:14:01'),
(60, 5, '517', 'Cortadora de Baldosin', 'vistas/img/productos/517/194.jpg', 18, 930, 1302, 2, '2020-07-13 04:56:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Administrador', 'vistas/img/usuarios/admin/595.jpg', 1, '2020-07-30 01:08:23', '2020-07-30 06:08:23'),
(4, 'Damian', 'damian', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Especial', 'vistas/img/usuarios/damian/396.jpg', 1, '2020-07-13 01:17:58', '2020-07-13 06:17:58'),
(5, 'Ana', 'ana', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Vendedor', 'vistas/img/usuarios/ana/396.jpg', 1, '2020-07-13 00:44:57', '2020-07-13 05:44:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuestos` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuestos`, `neto`, `total`, `metodo_pago`, `fecha`, `estado`) VALUES
(1, 100001, 1, 1, '[{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"4200\",\"total\":\"4200\"}]', 756, 4200, 4956, 'Efectivo', '2020-06-25 12:25:41', 0),
(2, 100002, 1, 1, '[{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"2156\",\"total\":\"4312\"}]', 1784.16, 9912, 11696.2, 'TC-2653156481', '2020-07-08 23:57:31', 1),
(3, 100003, 2, 1, '[{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"3\",\"stock\":\"17\",\"precio\":\"1540\",\"total\":\"4620\"}]', 831.6, 4620, 5451.6, 'Efectivo', '2020-07-09 22:08:50', 1),
(4, 100004, 2, 5, '[{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"812\",\"total\":\"812\"},{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"630\",\"total\":\"630\"},{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"560\",\"total\":\"1120\"}]', 461.16, 2562, 3023.16, 'Efectivo', '2020-07-12 23:17:32', 1),
(5, 100005, 1, 4, '[{\"id\":\"54\",\"descripcion\":\"Chapeta\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"924\",\"total\":\"924\"},{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"560\",\"total\":\"560\"},{\"id\":\"53\",\"descripcion\":\"Bomba Hidrostatica\",\"cantidad\":\"4\",\"stock\":\"16\",\"precio\":\"1078\",\"total\":\"4312\"}]', 1043.28, 5796, 6839.28, 'TC-15654165341865', '2020-07-12 23:18:26', 1),
(6, 100006, 2, 4, '[{\"id\":\"54\",\"descripcion\":\"Chapeta\",\"cantidad\":\"2\",\"stock\":\"17\",\"precio\":\"924\",\"total\":\"1848\"},{\"id\":\"55\",\"descripcion\":\"Cilindro muestra de concreto\",\"cantidad\":\"2\",\"stock\":\"15\",\"precio\":\"560\",\"total\":\"1120\"},{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"1302\",\"total\":\"2604\"},{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"196\",\"total\":\"196\"}]', 1038.24, 5768, 6806.24, 'Efectivo', '2020-07-12 23:19:03', 1),
(7, 100007, 3, 1, '[{\"id\":\"33\",\"descripcion\":\"Arnes de seguridad\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2450\",\"total\":\"2450\"},{\"id\":\"32\",\"descripcion\":\"Rueda giratoria para andamio\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"235.2\",\"total\":\"235.2\"}]', 483.336, 2685.2, 3168.54, 'Efectivo', '2020-07-27 18:47:52', 1),
(8, 100007, 3, 1, '[{\"id\":\"33\",\"descripcion\":\"Arnes de seguridad\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2450\",\"total\":\"2450\"},{\"id\":\"32\",\"descripcion\":\"Rueda giratoria para andamio\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"235.2\",\"total\":\"235.2\"}]', 483.336, 2685.2, 3168.54, 'Efectivo', '2020-07-27 18:48:35', 1),
(9, 100008, 2, 1, '[{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"812\",\"total\":\"812\"}]', 181.44, 1008, 1189.44, 'TC-15343854685', '2020-07-30 06:08:52', 1),
(10, 100009, 3, 1, '[{\"id\":\"59\",\"descripcion\":\"Cono slump\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"196\",\"total\":\"196\"},{\"id\":\"57\",\"descripcion\":\"Cizalla de Tijera\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"812\",\"total\":\"812\"},{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"630\",\"total\":\"630\"}]', 294.84, 1638, 1932.84, 'Efectivo', '2020-07-30 06:14:01', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
