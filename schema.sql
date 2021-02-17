-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-02-2021 a las 17:00:04
-- Versión del servidor: 10.0.38-MariaDB-0+deb8u1
-- Versión de PHP: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `terecasillas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_blog_entries`
--

CREATE TABLE `vkye_blog_entries` (
  `id_entry` bigint(20) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `cover` text COLLATE utf8_unicode_ci NOT NULL,
  `id_website_user` bigint(20) NOT NULL,
  `popular_blog` int(11) DEFAULT NULL,
  `popular_home` int(11) DEFAULT NULL,
  `id_location` bigint(20) DEFAULT NULL,
  `seo_keywords` text COLLATE utf8_unicode_ci,
  `seo_description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_comments`
--

CREATE TABLE `vkye_comments` (
  `id_comment` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_general_configurations`
--

CREATE TABLE `vkye_general_configurations` (
  `id_configuration` bigint(20) NOT NULL,
  `about_us` text COLLATE utf8_unicode_ci,
  `buy_process` text COLLATE utf8_unicode_ci,
  `contact_us` text COLLATE utf8_unicode_ci,
  `cover_home` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_about` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_property` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_buy` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_blog` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_contact` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_general_configurations`
--

INSERT INTO `vkye_general_configurations` (`id_configuration`, `about_us`, `buy_process`, `contact_us`, `cover_home`, `cover_about`, `cover_property`, `cover_buy`, `cover_blog`, `cover_contact`) VALUES
(1, '{\"es\":\"&lt;p&gt;Insertar texto&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Insert text&lt;\\/p&gt;\"}', '{\"es\":\"&lt;p&gt;Insertar texto&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Insert text&lt;\\/p&gt;\"}', '{\"phone\":\"+52 1 (999) 9999999\",\"email\":\"info@propiedadesventatulum.com\",\"address\":\"Direcci\\u00f3n \"}', '{\"background\":\"ZDmGUD3hNp5Rry8VqZNU1wZBdZfpSHmD.png\",\"title_es\":\"BIENVENIDO A\",\"title_en\":\"WELCOME TO\",\"subtitle_es\":\"TU NUEVA VIDA!\",\"subtitle_en\":\"YOUR NEW LIFE!\"}', '{\"background_about\":\"JAkbrODCRAmzIKgL4gBt7RXvTJVoyftR.png\",\"title_about_es\":\"CONOCENOS\",\"title_about_en\":\"ABOUT US\",\"subtitle_about_es\":\"NOSOTROS VIVIMOS TULUM!!!\",\"subtitle_about_en\":\"WE ARE LIVING TULUM!!!\"}', '{\"background_property_1\":\"t0vsqconnVyzAlasBPgaa9FIiDk0zmKM.png\",\"background_property_2\":\"ki5xr5cpG1mC9hJOOf7EZK4Zrg8GGtDi.png\",\"background_property_3\":\"058bdBnNnlMnFkv0hDlmWS1py54xUvcG.png\",\"background_property_4\":\"NMSXQhtOMSF9ZgLEYajMhqnZdvMP0dIK.png\",\"title_property_es\":\"PROPIEDADES\",\"title_property_en\":\"PROPERTIES\",\"subtitle_property_es\":\"LA CASA DE TUS SUE\\u00d1OS TE ESPERA!!!\",\"subtitle_property_en\":\"YOUR DREAM HOME AWAITS!!!\"}', '{\"background_buy\":\"yPmiZaufH3ARXXy3RD363cyreUjNptma.png\",\"title_buy_es\":\"PROCESO DE COMPRA \",\"title_buy_en\":\"BUYING PROCESS \",\"subtitle_buy_es\":\"COMPRAR EN MEXICO ES MUY SIMPLE!!!\",\"subtitle_buy_en\":\"TO BUY IN MEXICO IS VERY SIMPLE !!!\"}', '{\"background_blog\":\"wLdkeB4gM18q6hSkpf7BrELNcBSTlCIx.png\",\"title_blog_es\":\"TULUM CON OTRA MIRADA\",\"title_blog_en\":\"TULUM FROM ANOTHER VIEW\",\"subtitle_blog_es\":\"RESCATAMOS LOS MEJORES SITIOS DE TULUM!!!\",\"subtitle_blog_en\":\"WE RESCUE THE BEST SPOTS OF TULUM!!!\"}', '{\"background_contact\":\"5hA2FelDfPF30IUjqvCYGoWrl3Ld7KYq.png\",\"title_contact_es\":\"CONTACTANOS\",\"title_contact_en\":\"CONTACT US\",\"subtitle_contact_es\":\"PARA RECIBIR M\\u00c1S INFORMACI\\u00d3N SOBRE NUESTRAS PROPIEDADES\",\"subtitle_contact_en\":\"TO RECEIVE MORE INFORMATION ABOUT OUR PROPERTIES\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_metadata`
--

CREATE TABLE `vkye_metadata` (
  `id_metadata` bigint(20) NOT NULL,
  `description` text,
  `keywords` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vkye_metadata`
--

INSERT INTO `vkye_metadata` (`id_metadata`, `description`, `keywords`) VALUES
(1, 'Real Estate Tulum Find in our listings the best properties homes, houses, condos, apartments, developments, land, lots for sale in Tulum Mexico Experts in Tulum Real Estate property investment. Agencia bienes raí­ces Tulum, Inmobiliarias en Tulum, Terrenos Tulum Propiedades departamentos, casas, villas, lotes en venta', 'tulum real estate, tulum mexico real estate, real estate tulum, real estate tulum mexico, homes for sale in tulum, terrenos en tulum, tulum property for sale, bienes raíces tulum quintana roo, agencias inmobiliarias en tulum, houses apartments land lots condos for sale tulum, tulum properties for sale, casas en venta en tulum, desarrollos inmobiliarios tulum, propiedades tulum, inmuebles en tulum, tulum real estate agency, tulum real estate agent, tulum realty, tulum brokers, tulum experts, real estate experts, tulum realtors, aldea zama, aldea zama tulum, region 15 tulum, terrenos region 15 tulum, hectáreas tulum, condos region 15 tulum, region 8 tulum, terrenos region 8 tulum, hectáreas region 15 tulum, condo aldea zama, lifestyle tulum, estilo de vida tulum, living in tulum'),
(2, 'Real Estate Tulum Find in our listings the best properties homes, houses, condos, apartments, developments, land, lots for sale in Tulum Mexico Experts in Tulum Real Estate property investment. Agencia bienes raÃ­ces Tulum, Inmobiliarias en Tulum, Terrenos Tulum Propiedades departamentos, casas, villas, lotes en venta', 'tulum real estate, tulum mexico real estate, real estate tulum, real estate tulum mexico, homes for sale in tulum, terrenos en tulum, tulum property for sale, bienes raÃ­ces tulum quintana roo, agencias inmobiliarias en tulum, houses apartments land lots condos for sale tulum, tulum properties for sale, casas en venta en tulum, desarrollos inmobiliarios tulum, propiedades tulum, inmuebles en tulum, tulum real estate agency, tulum real estate agent, tulum realty, tulum brokers, tulum experts, real estate experts, tulum realtors, aldea zama, aldea zama tulum, region 15 tulum, terrenos region 15 tulum, hectÃ¡reas tulum, condos region 15 tulum, region 8 tulum, terrenos region 8 tulum, hectÃ¡reas region 15 tulum, condo aldea zama, lifestyle tulum, estilo de vida tulum, living in tulum');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties`
--

CREATE TABLE `vkye_properties` (
  `id_property` bigint(20) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL,
  `price` double DEFAULT NULL,
  `coin` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery` text COLLATE utf8_unicode_ci,
  `rooms` text COLLATE utf8_unicode_ci,
  `rooms_number_min` int(11) DEFAULT NULL,
  `rooms_number_max` int(11) DEFAULT NULL,
  `m2` text COLLATE utf8_unicode_ci,
  `teaser` text COLLATE utf8_unicode_ci,
  `type` set('1','2') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1-venta, 2-renta',
  `status` set('1','2','3','4') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1-disponible, 2-vendido, 3-rentado, 4-apartado',
  `pdf` text COLLATE utf8_unicode_ci,
  `cover` text COLLATE utf8_unicode_ci NOT NULL,
  `multiple` tinyint(1) DEFAULT NULL,
  `id_location` bigint(20) DEFAULT NULL,
  `id_category` bigint(20) DEFAULT NULL,
  `subcategory` enum('1','2','3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_property_parent` bigint(20) DEFAULT NULL,
  `popular` int(11) DEFAULT NULL,
  `seo_keywords` text COLLATE utf8_unicode_ci,
  `seo_description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties`
--

INSERT INTO `vkye_properties` (`id_property`, `title`, `description`, `date`, `price`, `coin`, `delivery`, `rooms`, `rooms_number_min`, `rooms_number_max`, `m2`, `teaser`, `type`, `status`, `pdf`, `cover`, `multiple`, `id_location`, `id_category`, `subcategory`, `id_property_parent`, `popular`, `seo_keywords`, `seo_description`) VALUES
(1, 'Prueba', '{\"es\":\"&lt;p&gt;Texto de prueba&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Test text&lt;\\/p&gt;\"}', '2021-02-11', 100, 'mxn', '{\"es\":\"Se entrega en diciembre del 2021\",\"en\":\"AA\"}', '', 0, 0, '', '{\"es\":\"Ultimas 5 unidades disponibles\",\"en\":\"BB\"}', '1', '1', NULL, 'dZaJH8SXjqODjEXXm2l6BqwzgSCT33b8.png', 0, 1, NULL, '1', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_categories`
--

CREATE TABLE `vkye_properties_categories` (
  `id_category` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_features`
--

CREATE TABLE `vkye_properties_features` (
  `id_feature` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` set('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `icon` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties_features`
--

INSERT INTO `vkye_properties_features` (`id_feature`, `title`, `type`, `icon`) VALUES
(1, '{\"es\":\"Aire Acondicionado\",\"en\":\"Air Conditioning\"}', '1', '<i class=\"material-icons\">ac_unit</i>'),
(2, '{\"es\":\"Wifi\",\"en\":\"Wifi\"}', '2', '<i class=\"material-icons\">wifi</i>'),
(3, '{\"es\":\"Piscina\",\"en\":\"Swimming Pool\"}', '2', '<i class=\"material-icons\">pool</i>'),
(4, '{\"es\":\"Jacuzzi\",\"en\":\"Jacuzzi\"}', '2', '<i class=\"material-icons\">hot_tub</i>'),
(5, '{\"es\":\"Club de Playa\",\"en\":\"Beach Club\"}', '2', '<i class=\"material-icons\">beach_access</i>'),
(6, '{\"es\":\"Seguridad 24\\/7\",\"en\":\"Security 24\\/7\"}', '2', '<i class=\"material-icons\">pan_tool</i>'),
(7, '{\"es\":\"Centro de Negocios\",\"en\":\"Business Center\"}', '2', '<i class=\"material-icons\">business_center</i>'),
(8, '{\"es\":\"Transporte Aeropuerto\",\"en\":\"Airport Shuttle\"}', '2', '<i class=\"material-icons\">airport_shuttle</i>'),
(9, '{\"es\":\"Ni\\u00f1os Bienvenidos\",\"en\":\"Child Friendly\"}', '1', '<i class=\"material-icons\">child_friendly</i>'),
(10, '{\"es\":\"Gimnasio\",\"en\":\"Gym\"}', '2', '<i class=\"material-icons\">fitness_center</i>'),
(11, '{\"es\":\"Campo de Golf\",\"en\":\"Golf Course\"}', '2', '<i class=\"material-icons\">golf_course</i>'),
(12, '{\"es\":\"SPA\",\"en\":\"SPA\"}', '2', '<i class=\"material-icons\">spa</i>'),
(13, '{\"es\":\"Estacionamiento\",\"en\":\"Parking\"}', '2', '<i class=\"material-icons\">time_to_leave</i>'),
(14, '{\"es\":\"Restaurante\",\"en\":\"Restaurant\"}', '2', '<i class=\"material-icons\">restaurant_menu</i>'),
(15, '{\"es\":\"Bicicletas\",\"en\":\"Bikes\"}', '2', '<i class=\"material-icons\">directions_bike</i>'),
(16, '{\"es\":\"Embarcadero\",\"en\":\"Pier\"}', '2', '<i class=\"material-icons\">directions_boat</i>'),
(17, '{\"es\":\"Mascotas Bienvenidas\",\"en\":\"Pet Friendly\"}', '1', '<i class=\"material-icons\">pets</i>'),
(18, '{\"es\":\"Accesible\",\"en\":\"Accessible\"}', '1', '<i class=\"material-icons\">accessible</i>'),
(19, '{\"es\":\"Jardines\",\"en\":\"Gardens\"}', '2', '<i class=\"material-icons\">nature</i>'),
(20, '{\"es\":\"Bar\",\"en\":\"Bar\"}', '2', '<i class=\"material-icons\">local_bar</i>'),
(21, '{\"es\":\"Concierge\",\"en\":\"Concierge\"}', '2', '<i class=\"material-icons\">room_service</i>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_features_fk`
--

CREATE TABLE `vkye_properties_features_fk` (
  `id_fk` bigint(20) NOT NULL,
  `id_property` bigint(20) NOT NULL,
  `id_feature` bigint(20) NOT NULL,
  `type` set('1','2') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties_features_fk`
--

INSERT INTO `vkye_properties_features_fk` (`id_fk`, `id_property`, `id_feature`, `type`) VALUES
(29, 1, 1, '1'),
(30, 1, 9, '1'),
(31, 1, 2, '2'),
(32, 1, 3, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_images`
--

CREATE TABLE `vkye_properties_images` (
  `id_image` bigint(20) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `id_property` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties_images`
--

INSERT INTO `vkye_properties_images` (`id_image`, `title`, `id_property`) VALUES
(2, 'pwkxG397ap8MGCFcDfPQr3jjkbYK88pL.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_interested`
--

CREATE TABLE `vkye_properties_interested` (
  `id_interested` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `observations` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `id_property` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_locations`
--

CREATE TABLE `vkye_properties_locations` (
  `id_location` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `properties` tinyint(4) NOT NULL DEFAULT '0',
  `blog` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties_locations`
--

INSERT INTO `vkye_properties_locations` (`id_location`, `title`, `properties`, `blog`) VALUES
(1, 'Tulum', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_services`
--

CREATE TABLE `vkye_services` (
  `id_service` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_slider_home`
--

CREATE TABLE `vkye_slider_home` (
  `id_image` bigint(20) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_slider_home`
--

INSERT INTO `vkye_slider_home` (`id_image`, `title`) VALUES
(2, 'qmbTqV4tOLDrBFZYhsir34hHLT5W8bnl.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_subscriptions`
--

CREATE TABLE `vkye_subscriptions` (
  `id_subscription` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_website_users`
--

CREATE TABLE `vkye_website_users` (
  `id_website_user` bigint(20) NOT NULL,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` set('1','2','3','4','5','6','7','8','9','10') COLLATE utf8_unicode_ci NOT NULL,
  `media` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_website_users`
--

INSERT INTO `vkye_website_users` (`id_website_user`, `username`, `password`, `email`, `level`, `media`) VALUES
(1, 'terecasillas', '1f00a9fd943ed87b69c047e8437c96f4b76d26db:skE6oXQ1vidRC7N4bXyxSKLmVCloibCbOLmB0md37Q1Ohrz7kzcmkwpltRsBnDn8', 'webmaster@localhost', '10', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vkye_blog_entries`
--
ALTER TABLE `vkye_blog_entries`
  ADD PRIMARY KEY (`id_entry`),
  ADD KEY `id_website_user` (`id_website_user`),
  ADD KEY `vkye_blog_entries` (`id_location`);

--
-- Indices de la tabla `vkye_comments`
--
ALTER TABLE `vkye_comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indices de la tabla `vkye_general_configurations`
--
ALTER TABLE `vkye_general_configurations`
  ADD PRIMARY KEY (`id_configuration`);

--
-- Indices de la tabla `vkye_metadata`
--
ALTER TABLE `vkye_metadata`
  ADD PRIMARY KEY (`id_metadata`);

--
-- Indices de la tabla `vkye_properties`
--
ALTER TABLE `vkye_properties`
  ADD PRIMARY KEY (`id_property`),
  ADD KEY `id_location` (`id_location`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `vkye_properties_categories`
--
ALTER TABLE `vkye_properties_categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `vkye_properties_features`
--
ALTER TABLE `vkye_properties_features`
  ADD PRIMARY KEY (`id_feature`);

--
-- Indices de la tabla `vkye_properties_features_fk`
--
ALTER TABLE `vkye_properties_features_fk`
  ADD PRIMARY KEY (`id_fk`),
  ADD KEY `id_property` (`id_property`),
  ADD KEY `id_feature` (`id_feature`);

--
-- Indices de la tabla `vkye_properties_images`
--
ALTER TABLE `vkye_properties_images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_property` (`id_property`);

--
-- Indices de la tabla `vkye_properties_interested`
--
ALTER TABLE `vkye_properties_interested`
  ADD PRIMARY KEY (`id_interested`),
  ADD KEY `id_property` (`id_property`);

--
-- Indices de la tabla `vkye_properties_locations`
--
ALTER TABLE `vkye_properties_locations`
  ADD PRIMARY KEY (`id_location`);

--
-- Indices de la tabla `vkye_services`
--
ALTER TABLE `vkye_services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indices de la tabla `vkye_slider_home`
--
ALTER TABLE `vkye_slider_home`
  ADD PRIMARY KEY (`id_image`);

--
-- Indices de la tabla `vkye_subscriptions`
--
ALTER TABLE `vkye_subscriptions`
  ADD PRIMARY KEY (`id_subscription`);

--
-- Indices de la tabla `vkye_website_users`
--
ALTER TABLE `vkye_website_users`
  ADD PRIMARY KEY (`id_website_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vkye_blog_entries`
--
ALTER TABLE `vkye_blog_entries`
  MODIFY `id_entry` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_comments`
--
ALTER TABLE `vkye_comments`
  MODIFY `id_comment` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_general_configurations`
--
ALTER TABLE `vkye_general_configurations`
  MODIFY `id_configuration` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vkye_metadata`
--
ALTER TABLE `vkye_metadata`
  MODIFY `id_metadata` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vkye_properties`
--
ALTER TABLE `vkye_properties`
  MODIFY `id_property` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_categories`
--
ALTER TABLE `vkye_properties_categories`
  MODIFY `id_category` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_features`
--
ALTER TABLE `vkye_properties_features`
  MODIFY `id_feature` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_features_fk`
--
ALTER TABLE `vkye_properties_features_fk`
  MODIFY `id_fk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_images`
--
ALTER TABLE `vkye_properties_images`
  MODIFY `id_image` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_interested`
--
ALTER TABLE `vkye_properties_interested`
  MODIFY `id_interested` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_locations`
--
ALTER TABLE `vkye_properties_locations`
  MODIFY `id_location` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vkye_services`
--
ALTER TABLE `vkye_services`
  MODIFY `id_service` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_slider_home`
--
ALTER TABLE `vkye_slider_home`
  MODIFY `id_image` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vkye_subscriptions`
--
ALTER TABLE `vkye_subscriptions`
  MODIFY `id_subscription` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_website_users`
--
ALTER TABLE `vkye_website_users`
  MODIFY `id_website_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vkye_blog_entries`
--
ALTER TABLE `vkye_blog_entries`
  ADD CONSTRAINT `vkye_blog_entries` FOREIGN KEY (`id_location`) REFERENCES `vkye_properties_locations` (`id_location`),
  ADD CONSTRAINT `vkye_blog_entries_ibfk_1` FOREIGN KEY (`id_website_user`) REFERENCES `vkye_website_users` (`id_website_user`);

--
-- Filtros para la tabla `vkye_properties`
--
ALTER TABLE `vkye_properties`
  ADD CONSTRAINT `vkye_properties_ibfk_1` FOREIGN KEY (`id_location`) REFERENCES `vkye_properties_locations` (`id_location`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vkye_properties_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `vkye_properties_categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vkye_properties_features_fk`
--
ALTER TABLE `vkye_properties_features_fk`
  ADD CONSTRAINT `vkye_properties_features_fk_ibfk_1` FOREIGN KEY (`id_property`) REFERENCES `vkye_properties` (`id_property`),
  ADD CONSTRAINT `vkye_properties_features_fk_ibfk_2` FOREIGN KEY (`id_feature`) REFERENCES `vkye_properties_features` (`id_feature`);

--
-- Filtros para la tabla `vkye_properties_images`
--
ALTER TABLE `vkye_properties_images`
  ADD CONSTRAINT `vkye_properties_images_ibfk_1` FOREIGN KEY (`id_property`) REFERENCES `vkye_properties` (`id_property`);

--
-- Filtros para la tabla `vkye_properties_interested`
--
ALTER TABLE `vkye_properties_interested`
  ADD CONSTRAINT `vkye_properties_interested_ibfk_1` FOREIGN KEY (`id_property`) REFERENCES `vkye_properties` (`id_property`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
