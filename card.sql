-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2023 a las 19:19:25
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
-- Base de datos: `card`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `precio` double NOT NULL,
  `cantidadPedida` int(11) NOT NULL,
  `subTotal` double NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(9, 'Inicio'),
(10, 'Televisores'),
(12, 'Camaras'),
(13, 'Impresoras'),
(14, 'Laptop'),
(15, 'Monitores'),
(16, 'Phones'),
(17, 'Tablet'),
(18, 'Audifonos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_tarjeta` int(11) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `ubicacion` varchar(45) NOT NULL,
  `id_Empre` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_tarjeta`, `nombre`, `apellido`, `sexo`, `correo`, `contraseña`, `ubicacion`, `id_Empre`) VALUES
(10, NULL, 'Juan ', 'Figueroa Vela', 'Masculino', 'iji@hotmail.com', '753753', 'Mz 15 cerca del rio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `id_venta` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `Totalvendidos` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_Empre` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_Empre`, `nombre`) VALUES
(1, 'TechBox');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_Empre` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio_normal`, `precio_rebajado`, `cantidad`, `imagen`, `id_categoria`, `id_Empre`) VALUES
(21, 'SAMSUNG GALAXY S23', 'El doble de almacenamiento sin pagar más. Llévate un Galaxy S23+ 512GB a precio regular de 256GB\r\nAplican T&C*', 1000.00, 800.00, 3, '20231019070230.jpg', 16, 1),
(22, 'SAMSUNG GALAXY S22', 'Tiene una pantalla increíble, rendimiento sólido y batería de larga duración. Un smartphone Android lindo, cómodo y con capacidad que parece potente.', 5000.00, 4599.00, 8, '20231019070415.jpg', 16, 1),
(23, 'SAMSUNG GALAXY S20', 'Tamaño (Pantalla principa). 158.3mm (6.2\" pantalla completa) / 154.1mm (6.1\" incluye esquinas redondeadas)', 2000.00, 1759.00, 4, '20231019070627.jpg', 16, 1),
(24, 'SAMSUNG GALAXY BUNDLE ZFLIP5', 'Comienza a usar el Galaxy Z Flip5 con el paquete que incluye todo lo que necesitas. Incluye la funda Clear Gadget', 200.00, 159.00, 3, '20231019070732.jpg', 16, 1),
(25, 'SAMSUNG GALAXY A34', 'La pantalla Super AMOLED de 1000 nits del Galaxy A34 5G garantiza una visualización nítida, incluso en exteriores.', 1500.00, 1249.00, 5, '20231019070849.jpg', 16, 1),
(26, 'IPHONE 13 6.1_ 128GB', 'Apple iPhone 13 Dual Sim 95%/128/256 GB 512\" Super Retina OLED A15 Face ID NFC Libre iPhone13 5G - 6.1', 2600.00, 2583.16, 10, '20231019071110.jpg', 16, 1),
(27, 'CELULAR MOTOROLA G53', '¡El nuevo celular de Motorola está en Tienda Claro! Adquiere el Moto G53 5G y navega con uno de los dispositivos más recomendados de la marca. ', 800.00, 669.00, 7, '20231019071316.jpg', 16, 1),
(28, 'APPLE IPHONE 14', 'Capture detalles increíbles con una cámara principal de 48MP. Experimenta el iPhone de una manera completamente nueva con Dynamic Island y la pantalla siempre activa.', 6399.00, 5699.90, 8, '20231019071501.jpg', 16, 1),
(29, 'IMPRESORA BROTHER MULTIFUNCIONAL', 'El multifuncional de inyección de tinta a color DCP-T520W de la serie InkBenefit Tank ofrece calidad de impresión', 1100.00, 779.00, 10, '20231019233249.jpg', 13, 1),
(30, 'IMPRESORA LÁSER BROTHER DCP-1602 MULTIFUNCIONAL MONOCROMÁTICA USB', 'Impresora Láser Brother DCP-1602, Multifuncional, USB, Monocromática (Imprime solo en negro)', 740.00, 569.00, 9, '20231019233453.jpg', 13, 1),
(31, 'IMPRESORA MULTIFUNCIONAL BROTHER DCPT720DW', 'La impresora viene con un CD de instalación, que si o si, hay que utilizarlo, porque la pág. web de Brother, NO tiene el modelo de esta impresora. ', 869.00, 849.00, 10, '20231019233713.jpg', 13, 1),
(32, 'IMPRESORA MULTIFUNCIONAL CANON G2160 BK', 'La impresora multifuncional PIXMA G2160 de Canon ofrece impresión, copiado y escaneo de alto volumen y de bajo costo', 789.00, 349.00, 3, '20231020001526.jpg', 13, 1),
(33, 'IMPRESORA MULTIFUNCIONAL HP DESKJET INK ADVANTAGE 2775', 'Diseñada para ayudarlo a mantenerse conectado. Wi-Fi® de doble banda con restauración propia permite un mejor rango y conexiones más rápidas y confiables.', 359.00, 229.00, 15, '20231020001718.jpg', 13, 1),
(35, 'IMPRESORA MULTIFUNCIÓN HP SMART TANK 720', 'Ideal para imprimir grandes cantidades y a bajo costo. La caja incluye tinta original HP para imprimir por hasta tres años.', 1500.00, 1200.00, 13, '20231020002057.jpg', 13, 1),
(36, 'IMPRESORA HP INK TANK WIRELESS 415', 'La impresora HP Ink Tank Wireless 415 es la solución perfecta para tus necesidades de impresión. ', 799.00, 599.00, 14, '20231020002210.jpg', 13, 1),
(37, 'IMPRESORA EPSON ECOTANK L1250 WIFI', 'Impresora inalámbrica económica para familias y estudiantes. Ofrece costos de impresión ultra bajos gracias al sistema EcoTank de Epson', 574.00, 559.00, 18, '20231020002311.jpg', 13, 1),
(38, 'APPLE MACBOOK AIR M2 15', 'La más grande en peso ligero. La nueva MacBook Air de 15 pulgadas tiene una gran pantalla Liquid Retina con espacio de sobra para todo lo que te gusta hacer. ', 1999.00, 1899.00, 12, '20231020003609.jpg', 14, 1),
(39, 'LAPTOP ACER ASPIRE 3 15.6', 'Marca	ACER - Peso (kg)	1.8 - Tipo de Producto	Laptops - Modelo	A315-58-51CG', 1799.00, 1599.00, 17, '20231020003745.jpg', 14, 1),
(41, 'LAPTOP APPLE MACBOOK AIR 13.3', 'Disfruta de toda la potencia y elegancia de la nueva Macbook Air, equipada con el poderoso Chip M1, el primero de una estirpe de procesadores diseñados específicamente para tus productos Apple', 5799.00, 4899.00, 14, '20231020010531.jpg', 14, 1),
(42, 'LAPTOP ASUS VIVOBOOK 14', 'Con colores sobresalientes y una tecla Enter que bloquea el color, ASUS VivoBook 14 agrega estilo y dinamismo a la informática diaria.', 5799.00, 4999.00, 13, '20231020010735.jpg', 14, 1),
(43, 'LAPTOP HP 250 G9 HD 15.6', 'Obtenga la combinación excepcional de rendimiento, conectividad y velocidad con gran capacidad de respuesta gracias al procesador Intel® Core™ de 12.ª', 2551.00, 1914.00, 12, '20231020010901.jpg', 14, 1),
(44, 'Laptop Lenovo Intel Core i3.png', 'Marca: LENOVO | Peso (kg) = 4 Modelo | Lenovo V15 G3 IAP | Cámara (mp)	Sí | Procesador: ntel Core i3', 1740.00, 1450.00, 18, '20231020011155.jpg', 14, 1),
(45, 'LAPTOP LENOVO LEGION 15IAH7 15.6', 'La Laptop Lenovo Legion 5 15IAH7 (82RC00C8LM) con núcleos verdaderamente revolucionarios en rendimiento y eficiencia, los procesadores Intel® Core™ de 12va', 5000.00, 4797.00, 15, '20231020011355.jpg', 14, 1),
(46, 'Laptop Lenovo Ideapad Gaming 3', 'Ya puedes disfrutar de los videojuegos de élite en una laptop delgada y liviana con una duración de la batería increíble gracias a los nuevos procesadores', 4599.00, 3999.00, 17, '20231020011937.jpg', 14, 1),
(47, 'GALAXY TAB A8', 'La pantalla de 10.5\" de ancho y su bisel simétrico de tan solo 10.2 mm te permiten una inmersión completa en tu pantalla.', 999.00, 949.00, 13, '20231020012809.jpg', 17, 1),
(48, 'HONOR PAD 8', 'La primera pantalla HONOR FullView 2K de 12 pulgadas, con un área visual un tercio más grande en comparación con otras tablets tradicionales', 1499.00, 1099.00, 15, '20231020013355.jpg', 17, 1),
(49, 'IPAD AIR BLANCO', 'La pantalla Liquid Retina de 10,9 pulgadas te sumerge de lleno en todo lo que haces. Viene con tecnologías avanzadas', 3500.00, 3199.00, 11, '20231020013733.jpg', 17, 1),
(50, 'IPAD PRO 12.9 6TA GENERACIÓN ', 'Un rendimiento extraordinario, pantallas increíblemente avanzadas, conexión inalámbrica ultrarrápida Consultar ', 7000.00, 6499.00, 9, '20231020014202.jpg', 17, 1),
(51, 'Tab Lenovo P11', 'Pantalla 11.5\" 2K 2000 x 1200, IPS, 400 nits, 10 puntos Procesador MediaTek Helio G99 Octa-core 2.2 Ghz', 1899.00, 1699.00, 16, '20231020014455.jpg', 17, 1),
(52, 'XIAOMI REDMI PAD 10.6', 'El Xiaomi Redmi Pad es el primer tablet Android de la serie Redmi. Con una pantalla de 10.6 pulgadas con refresco de 90Hz', 1599.00, 899.00, 17, '20231020014636.jpg', 17, 1),
(53, 'XIAOMI REDMI PAD SE4', 'Plataforma móvil Snapdragon® 680 4GTecnología de proceso profesional de 6 nmCPU: 8 núcleos, hasta 2,4 GHzGPU: Qualcomm® Adreno™', 749.00, 699.00, 18, '20231020014958.jpg', 17, 1),
(54, 'MONITOR CURVO 27_ SAMSUNG LC27R500FHLXPE', 'DESCRIPCION MARCA SAMSUNG PART NUMBER LC27R500FHLXPE PANTALLA TAMAÑO 27 PULG TIPO CURVED LED', 800.00, 676.00, 10, '20231020021842.jpg', 15, 1),
(55, 'MONITOR CURVO LENOVO L24E-30 23.8 FHD', 'Si eres amante de los videojuegos, complementa tu computadora con el monitor gaming 66BCKAC2LA', 919.00, 499.00, 10, '20231020021953.jpg', 15, 1),
(56, 'MONITOR FHD DE 22_ CON ENTRADA HDMI Y VGA', 'Experimente la imagen completa y vívida de 178° desde cualquier lugar, incluso en las esquinas. Ya sea que esté de pie,', 459.00, 349.00, 15, '20231020022100.jpg', 15, 1),
(57, 'MONITOR HP V22I G5 22 FULL HD', 'Marca: HP Modelo: V22i G5 Numero de parte: 6D8G8AA Tamaño: 22\" Pulgadas Resolución: Full HD (1920 x 1080)', 430.00, 369.00, 10, '20231020022201.jpg', 15, 1),
(58, 'MONITOR LG 24MQ400-B 23.8', 'TAMAÑO. 23.8 PULG TIPO: IPS PROPORCION: WIDE RESOLUCION MAX: 1920 x 1080', 600.00, 587.00, 10, '20231020022354.jpg', 15, 1),
(59, 'MONITOR PLANO HP M22F 21.5', 'Extiende tus aplicaciones, disfruta tus series favoritas y haz un impacto positivo en el medio ambiente, todo esto al utilizar el monitor HP', 899.00, 699.00, 13, '20231020183509.jpg', 15, 1),
(60, 'MONITOR PLANO SAMSUNG LS24C310EALXPE 24_ LED', 'Diseño minimalista, máxima concentración. La pantalla sin borde en 3 lados aporta una estética limpia y moderna a cualquier entorno de trabajo.', 999.00, 439.00, 12, '20231020183627.jpg', 15, 1),
(61, 'MONITOR SAMSUNG LS24R35AFHNXZA', 'MARCA SAMSUNG - PART NUMBER LS24R35AFHNXZA - PANTALLA TIPO IPS - PROPORCION WIDE - CONTRASTE 1 000:1', 750.00, 600.00, 10, '20231020183759.jpg', 15, 1),
(62, 'BLACKLINE LED 32_ HD SMART TV', 'Incluye: 1.5G DDR +8G EMMC Bluetooth Built in 2.4G/5G(802.11n/ac), 2T2R - Modelo	32D2090', 799.00, 549.00, 10, '20231020183954.jpg', 10, 1),
(63, 'TELEVISOR BLACKLINE LED 43\' FHD SMART TV 43D2090', 'Control remoto	Smart Control - Diseño de pantalla	Plana - Funcionalidad	Smart TV', 1299.00, 719.00, 10, '20231020184101.jpg', 10, 1),
(64, 'TELEVISOR BLACKLINE LED 43\' FHD SMART TV 43D2090', 'Rango pulgadas	40-49 pulgadas - Resolución de imagen	FHD - Resolución de pantalla	Full HD\r\n', 1500.00, 1399.00, 10, '20231020184341.jpg', 10, 1),
(65, 'LG LED 4K UHD THINQ AI SMART 43', 'Los televisores UHD de LG mejoran tu experiencia visual. Disfruta de colores vivos y detalles impresionantes con un 4K real.', 1999.00, 1349.00, 15, '20231020184451.jpg', 10, 1),
(66, 'MIRAY LED SMART 40', 'Smart TV: Sí | Alto (con/sin base): 1 | Conexión Bluetooth: Sí | Ancho: 1 | Marca: MIRAY | Profundidad: 1 | Entradas VGA: Sin entradas', 1099.00, 849.00, 11, '20231020184637.jpg', 10, 1),
(67, 'SMART TV SAMSUNG 55\'', 'Poderoso escalado 4K que garantiza una resolución de hasta 4K para el contenido que te gusta.', 5000.00, 4599.00, 9, '20231020184857.jpg', 10, 1),
(68, 'TV LG LED SMART TV 4K', 'Disfruta todos los detalles LG UHD TV tiene HDR10, experimenta un mayor nivel de brillo, visualiza colores vivos y detalles increíbles.', 1699.00, 1589.00, 8, '20231020185109.jpg', 10, 1),
(69, 'TV SAMSUNG SMART 65', 'Tamaño de la pantalla: 65 pulgadas | Tecnología: UHD | Conexión Bluetooth: Sí | Entradas USB: 1', 1999.00, 1749.00, 12, '20231020185447.jpg', 10, 1),
(70, 'CÁMARA PARA EXTERIOR CON ROTACIÓN 360° TAPO C500 - TP-LINK', 'Detección de personas y seguimiento de movimiento: La IA inteligente identifica a una persona mientras sigue el movimiento con rotación de alta velocidad', 250.00, 205.00, 19, '20231020185723.jpg', 12, 1),
(71, 'CÁMARA INALÁMBRICA WIFI EXTERIOR 2K  TAPO 310 - TPLINK', 'Detección de movimiento y notificaciones: le notifica cuando la cámara detecta movimiento. Alarma de luz y sonido', 229.00, 175.00, 20, '20231020185951.jpg', 12, 1),
(72, 'CÁMARA DE SEGURIDAD WI-FI TAPO C225 GIRATORIA 360° 2K', 'Detecion Inteligente: Identifica y diferencia entre personas, mascotas, vehículos y sonidos extraños, notificando a los usuarios según sea necesario', 679.00, 459.00, 15, '20231020190249.jpg', 12, 1),
(73, 'CÁMARA DE SEGURIDAD WI-FI 360º TAPO C200 - TP-LINK', 'Intrusos en  casa es lo que queremos prevenir. Instala una cámara Tapo C200 apuntando a la entrada de tu casa, garaje o sótano, asegurando la seguridad de tu familia y de tu hogar.', 190.00, 119.00, 11, '20231020190403.jpg', 12, 1),
(74, 'CÁMARA DE SEGURIDAD WIFI FULL HD TAPO C100 - TP-LINK', 'Con la cámara Tapo C100 mantente seguro cuando y donde sea. Recibe una notificación siempre que la cámara detecta un movimiento.', 149.00, 109.00, 17, '20231020190547.jpg', 12, 1),
(75, 'CÁMARA DE SEGURIDAD WIFI PARA INTERIORES IPC-A22 - IMOU', 'La ranger 2 full hd de imou es la mejor opciòn para mantener tu hogar o negocio vigilado 24/7 desde cualquier lugar que te encuentres.', 200.00, 149.00, 20, '20231020190815.jpg', 12, 1),
(76, 'CÁMARA DE SEGURIDAD 360° FULL HD MI HOME SECURITY - XIAOMI', 'La resolución de la cámara Xiaomi es Full HD con visión nocturna, detección de movimiento, envío de notificaciones y comunicación bidireccional a través de micrófono ', 180.00, 159.00, 15, '20231020190945.jpg', 12, 1),
(77, 'CÁMARA INALÁMBRICA WIFI 360º C6N FULL HD - EZVIZ', 'La C6N de EZVIZ incluye una función IR inteligente que utiliza luz infrarroja (IR) avanzada para capturar más detalles con baja luminosidad.', 219.00, 155.00, 18, '20231020191108.jpg', 12, 1),
(78, 'GALAXY TAB S6 LITE S PEN 2022 ', 'Galaxy Tab S6 Lite es tu mejor compañera para tomar notas. Cuenta con un diseño delgado y liviano, una pantalla de 10.4\", One UI 2 en Android', 1599.00, 999.00, 13, '20231020191823.jpg', 17, 1),
(79, 'HEADPHONE T500 WIR ON-EAR BLACK CON MICRÓFONO', 'Los JBL TUNE500 ofrecen un sonido potente y de calidad para darle vida a tu día a día.', 129.00, 79.00, 13, '20231020193454.jpg', 18, 1),
(80, 'AURICULARES INALÁMBRICOS JBL TUNE 510BT', 'La batería dura 40 h. Modo manos libres incluido.. Asistentes de voz integrados: Siri y Google Assistant.\r\n\r\n', 200.00, 179.00, 18, '20231020193536.jpg', 18, 1),
(81, 'AUDÍFONOS ON EAR CON MICRÓFONO BLUETOOTH 5.0', 'Tipo: Roller, Material principal: Poliéster, Largo: 210 cm, Estilo: Black out, Composición: 50% Poliester, 50% Acrílico, Ancho: 160 cm', 229.00, 89.00, 17, '20231020193606.jpg', 18, 1),
(82, 'AUDÍFONOS INALÁMBRICOS CON NOISE CANCELLING', 'El procesador de Noise Cancelling HD QN1 te permite escuchar sin distracciones. Audio inalámbrico de alta calidad con tecnología BLUETOOTH® y LDAC', 1499.00, 849.00, 16, '20231020193706.jpg', 18, 1),
(83, 'AUDÍFONOS BLUETOOTH SONY CON NOISE CANCELLING', 'Calidad de sonido excepcional con una unidad de diafragma de 30 mm especialmente diseñada. El mejor noise cancelling3 con 2 procesadores', 1299.00, 999.90, 14, '20231020193753.jpg', 18, 1),
(84, 'AUDÍFONOS BLUETOOTH ON EAR BLACK SHEEP TUNE', 'Los Tune ANC son ligeros, tienen hasta 12 horas de batería y vienen con almohadillas de espuma viscoelástica que se amoldan suavemente alrededor de tus oídos', 369.00, 229.00, 14, '20231020193820.jpg', 18, 1),
(85, 'AUDIFONO BLUETOOTH LENOVO LP40 PRO TWS INALAMBRICO - NEGRO', 'Unidad de bobina móvil grande de doble frecuencia de 13mm, diafragma dual compuesto, análisis de alta frecuencia', 139.00, 89.00, 8, '20231020193908.jpg', 18, 1),
(86, 'SONY AUDIFONOS BLUETOOTH 5.2 NOISE CANCELLING 35HRS WH-CH720N', 'La tecnología DSEE restaura los sonidos de alta frecuencia y los fundidos suaves que se pierden durante la compresión.', 700.00, 399.00, 14, '20231020194028.jpg', 18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `id_tarjeta` int(11) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tarjeta`
--

INSERT INTO `tarjeta` (`id_tarjeta`, `numero`, `monto`) VALUES
(1, '123456789', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_Empre` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `id_Empre`) VALUES
(1, 'admin', 'TechBox', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `fk_carrito_productos1_idx` (`id`),
  ADD KEY `fk_carrito_Cliente1_idx` (`id_cliente`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_Cliente_tarjeta1_idx` (`id_tarjeta`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_detalleVenta_carrito1_idx` (`id_carrito`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_Empre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `fk_productos_Empresa1_idx` (`id_Empre`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`id_tarjeta`),
  ADD UNIQUE KEY `numero_UNIQUE` (`numero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_Empresa1_idx` (`id_Empre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_Cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carrito_productos1` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Cliente_tarjeta1` FOREIGN KEY (`id_tarjeta`) REFERENCES `tarjeta` (`id_tarjeta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `fk_detalleVenta_carrito1` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_Empresa1` FOREIGN KEY (`id_Empre`) REFERENCES `empresa` (`id_Empre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_Empresa1` FOREIGN KEY (`id_Empre`) REFERENCES `empresa` (`id_Empre`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
