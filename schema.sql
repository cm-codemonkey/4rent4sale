-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-03-2021 a las 03:11:50
-- Versión del servidor: 10.3.27-MariaDB-0+deb10u1
-- Versión de PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4rent4sale`
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
  `seo_keywords` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_blog_entries`
--

INSERT INTO `vkye_blog_entries` (`id_entry`, `title`, `date`, `description`, `cover`, `id_website_user`, `popular_blog`, `popular_home`, `id_location`, `seo_keywords`, `seo_description`) VALUES
(1, '{\"es\":\"Hola mundo\",\"en\":\"Hello World\"}', '2021-02-28', '{\"es\":\"&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere&lt;\\/p&gt;\"}', 'bMZOXTOrKmCtSulTWYN48KRSaxNmt9SL.png', 1, 1, 1, 1, 'hello,world', 'Hello world'),
(2, '{\"es\":\"WHY INVEST IN THE RIVIERA MAYA?\",\"en\":\"WHY INVEST IN THE RIVIERA MAYA?\"}', '2021-03-01', '{\"es\":\"<div class=\\\"page\\\" title=\\\"Page 2\\\">\\n<div class=\\\"section\\\">\\n<div class=\\\"layoutArea\\\">\\n<div class=\\\"column\\\">\\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p>\\n<\\/div>\\n<\\/div>\\n<\\/div>\\n<\\/div>\",\"en\":\"<div class=\\\"page\\\" title=\\\"Page 2\\\">\\n<div class=\\\"section\\\">\\n<div class=\\\"layoutArea\\\">\\n<div class=\\\"column\\\">\\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p>\\n<\\/div>\\n<\\/div>\\n<\\/div>\\n<\\/div>\"}', 'Mlrz7PaC9KEPpXE2R6et96qpG1s6dgQF.png', 1, 2, 2, 1, '', ''),
(3, '{\"es\":\"The Time is NOW! Tulum Investments.\",\"en\":\"The Time is NOW! Tulum Investments.\"}', '2021-03-01', '{\"es\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p>\",\"en\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p>\"}', 'qiS8AFJKPO4mXvpIZOCYyCx1V0ub31Xs.png', 1, 3, 3, 1, '', '');

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
  `about_us` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `buy_process` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_us` text COLLATE utf8_unicode_ci DEFAULT NULL,
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
(1, '{\"es\":\"&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.&lt;\\/p&gt;\"}', '{\"es\":\"&lt;blockquote&gt;\\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.&lt;\\/p&gt;\\n&lt;\\/blockquote&gt;\",\"en\":\"&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.&lt;\\/p&gt;\"}', '{\"phone\":\"+52 (123) 4567890\",\"email\":\"info@4rent4sale.com\",\"address\":\"Tulum Quintana roo M\\u00e9xico\"}', '{\"background\":\"Ifrmm46GnbGQTYHWJsNCLb4pSoBCFwsl.png\",\"title_es\":\"BIENVENIDO A\",\"title_en\":\"WELCOME TO\",\"subtitle_es\":\"TU NUEVA VIDA!\",\"subtitle_en\":\"YOUR NEW LIFE!\"}', '{\"background_about\":\"JAkbrODCRAmzIKgL4gBt7RXvTJVoyftR.png\",\"title_about_es\":\"ACERCA DE\",\"title_about_en\":\"ABOUT\",\"subtitle_about_es\":\"NOSOTROS VIVIMOS TULUM!!!\",\"subtitle_about_en\":\"WE ARE LIVING TULUM!!!\"}', '{\"background_property_1\":\"t0vsqconnVyzAlasBPgaa9FIiDk0zmKM.png\",\"background_property_2\":\"ki5xr5cpG1mC9hJOOf7EZK4Zrg8GGtDi.png\",\"background_property_3\":\"058bdBnNnlMnFkv0hDlmWS1py54xUvcG.png\",\"background_property_4\":\"NMSXQhtOMSF9ZgLEYajMhqnZdvMP0dIK.png\",\"title_property_es\":\"PROPIEDADES\",\"title_property_en\":\"PROPERTIES\",\"subtitle_property_es\":\"LA CASA DE TUS SUE\\u00d1OS TE ESPERA!!!\",\"subtitle_property_en\":\"YOUR DREAM HOME AWAITS!!!\"}', '{\"background_buy\":\"yPmiZaufH3ARXXy3RD363cyreUjNptma.png\",\"title_buy_es\":\"PROCESO DE COMPRA \",\"title_buy_en\":\"BUYING PROCESS \",\"subtitle_buy_es\":\"COMPRAR EN MEXICO ES MUY SIMPLE!!!\",\"subtitle_buy_en\":\"TO BUY IN MEXICO IS VERY SIMPLE !!!\"}', '{\"background_blog\":\"wLdkeB4gM18q6hSkpf7BrELNcBSTlCIx.png\",\"title_blog_es\":\"BLOG\",\"title_blog_en\":\"BLOG\",\"subtitle_blog_es\":\"RESCATAMOS LOS MEJORES SITIOS DE TULUM!!!\",\"subtitle_blog_en\":\"WE RESCUE THE BEST SPOTS OF TULUM!!!\"}', '{\"background_contact\":\"5hA2FelDfPF30IUjqvCYGoWrl3Ld7KYq.png\",\"title_contact_es\":\"CONTACTO\",\"title_contact_en\":\"CONTACT\",\"subtitle_contact_es\":\"PARA RECIBIR M\\u00c1S INFORMACI\\u00d3N SOBRE NUESTRAS PROPIEDADES\",\"subtitle_contact_en\":\"TO RECEIVE MORE INFORMATION ABOUT OUR PROPERTIES\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_metadata`
--

CREATE TABLE `vkye_metadata` (
  `id_metadata` bigint(20) NOT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vkye_metadata`
--

INSERT INTO `vkye_metadata` (`id_metadata`, `description`, `keywords`) VALUES
(1, 'Real Estate Tulum Find in our listings the best properties homes, houses, condos, apartments, developments, land, lots for sale in Tulum Mexico Experts in Tulum Real Estate property investment. Agencia bienes raí­ces Tulum, Inmobiliarias en Tulum, Terrenos Tulum Propiedades departamentos, casas, villas, lotes en venta', 'tulum real estate, tulum mexico real estate, real estate tulum, real estate tulum mexico, homes for sale in tulum, terrenos en tulum, tulum property for sale, bienes raíces tulum quintana roo, agencias inmobiliarias en tulum, houses apartments land lots condos for sale tulum, tulum properties for sale, casas en venta en tulum, desarrollos inmobiliarios tulum, propiedades tulum, inmuebles en tulum, tulum real estate agency, tulum real estate agent, tulum realty, tulum brokers, tulum experts, real estate experts, tulum realtors, aldea zama, aldea zama tulum, region 15 tulum, terrenos region 15 tulum, hectáreas tulum, condos region 15 tulum, region 8 tulum, terrenos region 8 tulum, hectáreas region 15 tulum, condo aldea zama, lifestyle tulum, estilo de vida tulum, living in tulum'),
(3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.'),
(4, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties`
--

CREATE TABLE `vkye_properties` (
  `id_property` bigint(20) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `price` double DEFAULT NULL,
  `coin` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rooms` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rooms_number_min` int(11) DEFAULT NULL,
  `rooms_number_max` int(11) DEFAULT NULL,
  `m2` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `teaser` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` set('1','2') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1-venta, 2-renta',
  `status` set('1','2','3','4') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1-disponible, 2-vendido, 3-rentado, 4-apartado',
  `pdf` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` text COLLATE utf8_unicode_ci NOT NULL,
  `multiple` tinyint(1) DEFAULT NULL,
  `id_location` bigint(20) DEFAULT NULL,
  `id_category` bigint(20) DEFAULT NULL,
  `subcategory` enum('1','2','3') COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_property_parent` bigint(20) DEFAULT NULL,
  `popular` int(11) DEFAULT NULL,
  `seo_keywords` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties`
--

INSERT INTO `vkye_properties` (`id_property`, `title`, `description`, `date`, `price`, `coin`, `delivery`, `rooms`, `rooms_number_min`, `rooms_number_max`, `m2`, `teaser`, `type`, `status`, `pdf`, `cover`, `multiple`, `id_location`, `id_category`, `subcategory`, `id_property_parent`, `popular`, `seo_keywords`, `seo_description`) VALUES
(5, 'ÚNICO CONDO PET FRIENDLY con habitaciones y servicios para mascotas (ID A 389)', '{\"es\":\"&lt;p&gt;Este es un proyecto para aquellas personas que aman viajar con sus mascotas, sienten que pueden estar c&amp;oacute;modos en diferentes &amp;aacute;reas de desarrollo y tienen acceso al lujo y la comodidad en uno de los mejores destinos de M&amp;eacute;xico, Tulum. Viaja con tu mascota.&lt;\\/p&gt;\\n&lt;p&gt;El mercado de los viajes de mascotas est&amp;aacute; en auge cada vez m&amp;aacute;s, por lo que estamos seguros de que este nuevo concepto no s&amp;oacute;lo es una gran opci&amp;oacute;n, sino que tambi&amp;eacute;n ser&amp;aacute; un proyecto ic&amp;oacute;nico en Tulum con un concepto original. Imagine planear sus vacaciones, armar sus bolsos y traer a su familia y mascotas para que ellos tambi&amp;eacute;n puedan tener sus propias vacaciones. Rodeado de naturaleza, con amplio espacio para moverse, un lugar especial para su ba&amp;ntilde;o, comida apropiada al tama&amp;ntilde;o y tipo de animal, entretenimiento y cuidados como la est&amp;eacute;tica, ba&amp;ntilde;os y masajes. . . ahora es posible. Porque como miembros de la familia, merecen disfrutar y ser mimados por igual, merecen un espacio, un lugar en nuestras vidas y vacaciones. Su mascota, como usted, ha soportado suficiente tiempo encerrado en la ciudad, disfrutando de unos d&amp;iacute;as fuera de la rutina para respirar aire limpio. Ofrecemos muchas plantas y &amp;aacute;reas recreativas para jugar. Servicios&lt;\\/p&gt;\\n&lt;p&gt;El proyecto est&amp;aacute; dise&amp;ntilde;ado para acomodar mascotas de todos los tama&amp;ntilde;os, con juegos exclusivos y &amp;aacute;reas de estancia. Nuestras mascotas nos dan su lealtad, amor y alegr&amp;iacute;a todos los d&amp;iacute;as, es hora de devolverles un poco de amor. Piscina&lt;\\/p&gt;\\n&lt;p&gt;Piscina de mascotas&lt;\\/p&gt;\\n&lt;p&gt;Jacuzzi&lt;\\/p&gt;\\n&lt;p&gt;Aparcamiento&lt;\\/p&gt;\\n&lt;p&gt;Terraza&lt;\\/p&gt;\\n&lt;p&gt;Sundeck&lt;\\/p&gt;\\n&lt;p&gt;Programa Pet-it&lt;\\/p&gt;\\n&lt;p&gt;Platos Gourmet&lt;\\/p&gt;\\n&lt;p&gt;Spa con tratamientos capilares seleccionados exclusivamente para el cuidado de la piel. Aromaterapia, masajes relajantes, m&amp;uacute;sica especial de relajaci&amp;oacute;n&lt;\\/p&gt;\\n&lt;p&gt;Sesiones de fotos con mascotas para aquellos que les gusta tener un valioso recuerdo de sus vacaciones&lt;\\/p&gt;\\n&lt;p&gt;Servicio de canguro&lt;\\/p&gt;\\n&lt;p&gt;Conserje de perros&lt;\\/p&gt;\\n&lt;p&gt;M&amp;oacute;dulo de juegos de mascotas&lt;\\/p&gt;\\n&lt;p&gt;Soluciones ecol&amp;oacute;gicas&lt;\\/p&gt;\\n&lt;p&gt;Soluciones ecol&amp;oacute;gicas para mimar tanto a los clientes como a las mascotas. Acondicionadores de aire con inversor&lt;\\/p&gt;\\n&lt;p&gt;Calentadores solares&lt;\\/p&gt;\\n&lt;p&gt;Recolecci&amp;oacute;n de agua de lluvia para las zonas verdes&lt;\\/p&gt;\\n&lt;p&gt;Luces LED (de bajo consumo)&lt;\\/p&gt;\\n&lt;p&gt;Tratamiento de aguas negras con Bio-Digestores&lt;\\/p&gt;\\n&lt;p&gt;El condominio&lt;br \\/&gt;El proyecto est&amp;aacute; dise&amp;ntilde;ado para acomodar mascotas de todos los tama&amp;ntilde;os, con juegos exclusivos y &amp;aacute;reas de estancia.&lt;br \\/&gt;Espacios que permiten la sana convivencia e interacci&amp;oacute;n entre las mascotas, as&amp;iacute; como la libertad para que corran y salten sin correa, reduciendo los niveles de estr&amp;eacute;s que se generan en su vida cotidiana de vivir en grandes ciudades y departamentos.&lt;\\/p&gt;\\n&lt;p&gt;Ubicaci&amp;oacute;n&lt;br \\/&gt;Tulum, La Veleta, M&amp;eacute;xico&lt;\\/p&gt;\",\"en\":\"\"}', '2021-03-01', 104000, 'usd', '{\"es\":\"ENTREGA DICIEMBRE 2021\",\"en\":\"DELIVERY DECEMBER 2021\"}', '', 0, 0, '', '', '1', '1', NULL, 'yI7NitQCiJ1zFDb1ewCsoYWAydB3vLUL.png', 0, 1, NULL, '1', NULL, NULL, '', ''),
(6, 'Condos UNICOS a 300 metros de la playa con beach club privado (ID A 377)', '{\"es\":\"&lt;p&gt;Es un concepto de inversion innovador,un increible proyecto con unidades disenadas tipo resort y operados bajo un modelo de Condo Hotel por la Cadena WYNDHAM HOTELS. (unas de las mejores cadenas hoteleras del mundo)&lt;br \\/&gt;Ha sido disenado para ofrecer solo 64 departamentos funcionales de diferentes tamanos dentro del area de 7.500 m2 de vegetacion extensa,ideales para vivr esta experiencia magica que es Tulum.&lt;br \\/&gt;Ubicado a solo 300 metros de la playa de Tulum,contara con club de playa privado y servicio de shuttle directo a la playa.&lt;br \\/&gt;La arquitectura cotempla un estilo minimalista contemporaneo ofreciendo un ambiente calido y casual.&lt;br \\/&gt;Cuenta de varios modelos,de 1 o 2 recamaras y tambien de suite de hotel,todos con amplias terrazas y alturas interiores.&lt;br \\/&gt;Las unidades se entregan completamente LLAVES EN MANO (equipadas,amuebladas y decoradas)&lt;\\/p&gt;\\n&lt;p&gt;La fecha de entrega es para DIciembre 2020&lt;\\/p&gt;\\n&lt;p&gt;AMENIDADES:&lt;\\/p&gt;\\n&lt;p&gt;&amp;ndash; Servicio de concierge y reception&lt;br \\/&gt;&amp;ndash; Gimnasio&lt;br \\/&gt;&amp;ndash; Spa&lt;br \\/&gt;&amp;ndash; Piscina&lt;br \\/&gt;&amp;ndash; Restaurante&lt;br \\/&gt;&amp;ndash; Exclusivo Club de Playa&lt;br \\/&gt;&amp;ndash; Shuttle Exclusivo&lt;br \\/&gt;&amp;ndash; Seguridad 24h&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Es un concepto de inversion innovador,un increible proyecto con unidades disenadas tipo resort y operados bajo un modelo de Condo Hotel por la Cadena WYNDHAM HOTELS. (unas de las mejores cadenas hoteleras del mundo)&lt;br \\/&gt;Ha sido disenado para ofrecer solo 64 departamentos funcionales de diferentes tamanos dentro del area de 7.500 m2 de vegetacion extensa,ideales para vivr esta experiencia magica que es Tulum.&lt;br \\/&gt;Ubicado a solo 300 metros de la playa de Tulum,contara con club de playa privado y servicio de shuttle directo a la playa.&lt;br \\/&gt;La arquitectura cotempla un estilo minimalista contemporaneo ofreciendo un ambiente calido y casual.&lt;br \\/&gt;Cuenta de varios modelos,de 1 o 2 recamaras y tambien de suite de hotel,todos con amplias terrazas y alturas interiores.&lt;br \\/&gt;Las unidades se entregan completamente LLAVES EN MANO (equipadas,amuebladas y decoradas)&lt;\\/p&gt;\\n&lt;p&gt;La fecha de entrega es para DIciembre 2020&lt;\\/p&gt;\\n&lt;p&gt;AMENIDADES:&lt;\\/p&gt;\\n&lt;p&gt;&amp;ndash; Servicio de concierge y reception&lt;br \\/&gt;&amp;ndash; Gimnasio&lt;br \\/&gt;&amp;ndash; Spa&lt;br \\/&gt;&amp;ndash; Piscina&lt;br \\/&gt;&amp;ndash; Restaurante&lt;br \\/&gt;&amp;ndash; Exclusivo Club de Playa&lt;br \\/&gt;&amp;ndash; Shuttle Exclusivo&lt;br \\/&gt;&amp;ndash; Seguridad 24h&lt;\\/p&gt;\"}', '2021-03-01', 73000, 'usd', '{\"es\":\"\",\"en\":\"\"}', '', 0, 0, '', '', '1', '1', NULL, 'h99RP15d5gvkKIRp4WGU036LcpdqAzUr.png', 0, 1, NULL, '1', NULL, NULL, '', ''),
(7, 'Studio en la calle principal del Pueblo Magico (ID A 225)', '{\"es\":\"&lt;p&gt;Este nuevo desarrollo es un proyecto &amp;uacute;nico en su tipo por calidad y precio.Localizado en Av.Coba, se sit&amp;uacute;a en la &amp;uacute;nica avenida que lleva a las playas de Tulum y a los mejores Clubs de playa y hoteles del mundo. Con amenidades integradas al estilo de vida de Tulum, tambi&amp;eacute;n cuenta con un programa de cliente frecuente para ofrecer experiencias personalizadas.&lt;\\/p&gt;\\n&lt;p&gt;El proyecto est&amp;aacute; conformado por 78 departamentos y 3 locales comerciales, distribuidos en 2 torres. Cuenta con unidades de una y dos rec&amp;aacute;maras, estudios y Penthouse con alberca privada.&lt;\\/p&gt;\\n&lt;p&gt;AMENIDADES&lt;\\/p&gt;\\n&lt;p&gt;Alberca&lt;\\/p&gt;\\n&lt;p&gt;2 Splash Pool&lt;\\/p&gt;\\n&lt;p&gt;Gimnasio&lt;\\/p&gt;\\n&lt;p&gt;Solarium con camastros&lt;\\/p&gt;\\n&lt;p&gt;Spa \\/ Vapor&lt;\\/p&gt;\\n&lt;p&gt;Lavanderia&lt;\\/p&gt;\\n&lt;p&gt;Bicicletas&lt;\\/p&gt;\\n&lt;p&gt;Elevador&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Este nuevo desarrollo es un proyecto &amp;uacute;nico en su tipo por calidad y precio.Localizado en Av.Coba, se sit&amp;uacute;a en la &amp;uacute;nica avenida que lleva a las playas de Tulum y a los mejores Clubs de playa y hoteles del mundo. Con amenidades integradas al estilo de vida de Tulum, tambi&amp;eacute;n cuenta con un programa de cliente frecuente para ofrecer experiencias personalizadas.&lt;\\/p&gt;\\n&lt;p&gt;El proyecto est&amp;aacute; conformado por 78 departamentos y 3 locales comerciales, distribuidos en 2 torres. Cuenta con unidades de una y dos rec&amp;aacute;maras, estudios y Penthouse con alberca privada.&lt;\\/p&gt;\\n&lt;p&gt;AMENIDADES&lt;\\/p&gt;\\n&lt;p&gt;Alberca&lt;\\/p&gt;\\n&lt;p&gt;2 Splash Pool&lt;\\/p&gt;\\n&lt;p&gt;Gimnasio&lt;\\/p&gt;\\n&lt;p&gt;Solarium con camastros&lt;\\/p&gt;\\n&lt;p&gt;Spa \\/ Vapor&lt;\\/p&gt;\\n&lt;p&gt;Lavanderia&lt;\\/p&gt;\\n&lt;p&gt;Bicicletas&lt;\\/p&gt;\\n&lt;p&gt;Elevador&lt;\\/p&gt;\"}', '2021-03-01', 96000, 'usd', '{\"es\":\"\",\"en\":\"\"}', '', 0, 0, '', '', '1', '1', NULL, 'T0H6wdiLM44gRGF0ukyrluxIKUvfvhEK.png', 0, 1, NULL, '1', NULL, NULL, '', ''),
(8, 'Departamento en condo Eco Friendly (ID A 359)', '{\"es\":\"&lt;p&gt;Rodeado de plantas y del sonido de la naturaleza, vivir&amp;aacute;s lo que es estar inmerso en ella con lujo y confort; sus acaba dos de madera, con sus p&amp;eacute;rgolas y celos&amp;iacute;as, hacen que la energ&amp;iacute;a del sol penetre tenue y c&amp;aacute;lidamente mientras disfrutas de ser y estar, de vivir y disfrutar de su energ&amp;iacute;a en el mejor lugar de la Riviera Maya.&lt;\\/p&gt;\\n&lt;p&gt;Son 24 departamentos de una y dos rec&amp;aacute;maras, distribuidos en cuatro niveles y un roof garden. Cuenta con estacionamientos en el s&amp;oacute;tano y seguridad las 24 horas.&lt;\\/p&gt;\\n&lt;p&gt;En este lujoso proyecto no solo vivir&amp;aacute;s en la naturaleza, aqu&amp;iacute; convivir&amp;aacute;s con ella gracias a la tecnolog&amp;iacute;a eco friendly con la que fueron pensadas sus instalaciones y servicios. Es por ello que cuenta con:&lt;\\/p&gt;\\n&lt;p&gt;Paneles solares&lt;br \\/&gt;Generadores e&amp;oacute;licos&lt;br \\/&gt;Aprovechamiento de agua de lluvia&lt;br \\/&gt;Generador de agua purificada&lt;br \\/&gt;Biodigestores para las aguas residuales&lt;br \\/&gt;Innovador sistema de ahorro de agua en la ducha&lt;br \\/&gt;Reutilizaci&amp;oacute;n de aguas grises en inodoros&lt;\\/p&gt;\\n&lt;p&gt;Cuenta con amenidades:&lt;\\/p&gt;\\n&lt;p&gt;Servicio de concierge&lt;br \\/&gt;&amp;Aacute;rea para yoga&lt;br \\/&gt;Alberca&lt;br \\/&gt;Lock-off en departamentos 2 rec&amp;aacute;maras&lt;br \\/&gt;Estacionamiento subterr&amp;aacute;neo&lt;br \\/&gt;&amp;Aacute;rea de BBQ&lt;\\/p&gt;\\n&lt;p&gt;Fecha de entrega: Diciembre del 2020&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Rodeado de plantas y del sonido de la naturaleza, vivir&amp;aacute;s lo que es estar inmerso en ella con lujo y confort; sus acaba dos de madera, con sus p&amp;eacute;rgolas y celos&amp;iacute;as, hacen que la energ&amp;iacute;a del sol penetre tenue y c&amp;aacute;lidamente mientras disfrutas de ser y estar, de vivir y disfrutar de su energ&amp;iacute;a en el mejor lugar de la Riviera Maya.&lt;\\/p&gt;\\n&lt;p&gt;Son 24 departamentos de una y dos rec&amp;aacute;maras, distribuidos en cuatro niveles y un roof garden. Cuenta con estacionamientos en el s&amp;oacute;tano y seguridad las 24 horas.&lt;\\/p&gt;\\n&lt;p&gt;En este lujoso proyecto no solo vivir&amp;aacute;s en la naturaleza, aqu&amp;iacute; convivir&amp;aacute;s con ella gracias a la tecnolog&amp;iacute;a eco friendly con la que fueron pensadas sus instalaciones y servicios. Es por ello que cuenta con:&lt;\\/p&gt;\\n&lt;p&gt;Paneles solares&lt;br \\/&gt;Generadores e&amp;oacute;licos&lt;br \\/&gt;Aprovechamiento de agua de lluvia&lt;br \\/&gt;Generador de agua purificada&lt;br \\/&gt;Biodigestores para las aguas residuales&lt;br \\/&gt;Innovador sistema de ahorro de agua en la ducha&lt;br \\/&gt;Reutilizaci&amp;oacute;n de aguas grises en inodoros&lt;\\/p&gt;\\n&lt;p&gt;Cuenta con amenidades:&lt;\\/p&gt;\\n&lt;p&gt;Servicio de concierge&lt;br \\/&gt;&amp;Aacute;rea para yoga&lt;br \\/&gt;Alberca&lt;br \\/&gt;Lock-off en departamentos 2 rec&amp;aacute;maras&lt;br \\/&gt;Estacionamiento subterr&amp;aacute;neo&lt;br \\/&gt;&amp;Aacute;rea de BBQ&lt;\\/p&gt;\\n&lt;p&gt;Fecha de entrega: Diciembre del 2020&lt;\\/p&gt;\"}', '2021-03-01', 97000, 'usd', '{\"es\":\"\",\"en\":\"\"}', '', 0, 0, '', '', '1', '1', NULL, 'rzEyx4gTH1l9o5nbp4An4RelEkh0aB8e.png', 0, 1, NULL, '1', NULL, NULL, '', ''),
(9, 'Departamentos en Aldea Zama (ID A 261)', '{\"es\":\"&lt;p&gt;Este proyecto es una promoci&amp;oacute;n ubicada en Aldea Zam&amp;aacute;, con 84 unidades divididas en dos lujosas torres, un edificio con todas las comodidades exclusivas y acabados de alta calidad, para que nuestros hu&amp;eacute;spedes puedan disfrutar de su estancia en el m&amp;aacute;gico Caribe.&lt;\\/p&gt;\\n&lt;p&gt;Amenidades:&lt;\\/p&gt;\\n&lt;p&gt;Lobby&lt;br \\/&gt;Recepci&amp;oacute;n&lt;br \\/&gt;Ascensor&lt;br \\/&gt;Conserje&lt;br \\/&gt;Club de playa&lt;br \\/&gt;Cine&lt;br \\/&gt;Centro de negocios&lt;br \\/&gt;SPA&lt;br \\/&gt;Sala de masajes&lt;br \\/&gt;Sauna&lt;br \\/&gt;Jacuzzi&lt;br \\/&gt;Centro de Yoga&lt;br \\/&gt;Sala de meditaci&amp;oacute;n&lt;br \\/&gt;Sky Bar&lt;br \\/&gt;Zona de estar&lt;br \\/&gt;Piscina puente que conecta las dos torres&lt;br \\/&gt;Estacionamiento&lt;\\/p&gt;\\n&lt;p&gt;El Condo cuenta con diferentes tipos de unidades, desde $99,000 USD, como estudios, apartamentos de una rec&amp;aacute;mara, apartamentos de dos rec&amp;aacute;maras y penthouses de tres rec&amp;aacute;maras; todas estas unidades est&amp;aacute;n creadas con un revolucionario concepto de modelo de negocio llamado &amp;ldquo;lock off&amp;rdquo;; para aumentar a&amp;uacute;n m&amp;aacute;s la rentabilidad del alquiler vacacional, por lo que todas nuestras unidades cuentan con un retorno de la inversi&amp;oacute;n garantizado, que ninguna otra empresa puede ofrecer en toda Norteam&amp;eacute;rica; y podemos hacerlo gracias a la ubicaci&amp;oacute;n de primera calidad de todos nuestros desarrollos: la exclusiva Aldea Zam&amp;aacute;.&lt;br \\/&gt;La planta baja&amp;nbsp; es una plaza comercial, que contar&amp;aacute; con diferentes restaurantes, bares, tiendas y boutiques de alta gama. Haz del tuyo uno de los espacios comerciales para crear tu propio negocio exitoso en medio del turismo de Tulum.&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Este proyecto es una promoci&amp;oacute;n ubicada en Aldea Zam&amp;aacute;, con 84 unidades divididas en dos lujosas torres, un edificio con todas las comodidades exclusivas y acabados de alta calidad, para que nuestros hu&amp;eacute;spedes puedan disfrutar de su estancia en el m&amp;aacute;gico Caribe.&lt;\\/p&gt;\\n&lt;p&gt;Amenidades:&lt;\\/p&gt;\\n&lt;p&gt;Lobby&lt;br \\/&gt;Recepci&amp;oacute;n&lt;br \\/&gt;Ascensor&lt;br \\/&gt;Conserje&lt;br \\/&gt;Club de playa&lt;br \\/&gt;Cine&lt;br \\/&gt;Centro de negocios&lt;br \\/&gt;SPA&lt;br \\/&gt;Sala de masajes&lt;br \\/&gt;Sauna&lt;br \\/&gt;Jacuzzi&lt;br \\/&gt;Centro de Yoga&lt;br \\/&gt;Sala de meditaci&amp;oacute;n&lt;br \\/&gt;Sky Bar&lt;br \\/&gt;Zona de estar&lt;br \\/&gt;Piscina puente que conecta las dos torres&lt;br \\/&gt;Estacionamiento&lt;\\/p&gt;\\n&lt;p&gt;El Condo cuenta con diferentes tipos de unidades, desde $99,000 USD, como estudios, apartamentos de una rec&amp;aacute;mara, apartamentos de dos rec&amp;aacute;maras y penthouses de tres rec&amp;aacute;maras; todas estas unidades est&amp;aacute;n creadas con un revolucionario concepto de modelo de negocio llamado &amp;ldquo;lock off&amp;rdquo;; para aumentar a&amp;uacute;n m&amp;aacute;s la rentabilidad del alquiler vacacional, por lo que todas nuestras unidades cuentan con un retorno de la inversi&amp;oacute;n garantizado, que ninguna otra empresa puede ofrecer en toda Norteam&amp;eacute;rica; y podemos hacerlo gracias a la ubicaci&amp;oacute;n de primera calidad de todos nuestros desarrollos: la exclusiva Aldea Zam&amp;aacute;.&lt;br \\/&gt;La planta baja&amp;nbsp; es una plaza comercial, que contar&amp;aacute; con diferentes restaurantes, bares, tiendas y boutiques de alta gama. Haz del tuyo uno de los espacios comerciales para crear tu propio negocio exitoso en medio del turismo de Tulum.&lt;\\/p&gt;\"}', '2021-03-01', 99000, 'usd', '{\"es\":\"\",\"en\":\"\"}', '', 0, 0, '', '', '1', '1', NULL, 'g1QtoJCXuGoHMIUjeaM4xcKT59VZRnA5.png', 0, 1, NULL, '1', NULL, NULL, '', ''),
(10, 'Condos en el corazon de Aldea Zama (ID A 379)', '{\"es\":\"&lt;p&gt;Ubicado en la zona m&amp;aacute;s vendida y con mayor crecimiento en Tulum, Aldea Zama, y a tan solo 2 cuadras de donde estar&amp;aacute; la nueva Quinta Avenida, rodeada de restaurantes, cafeter&amp;iacute;as y con tan solo una milla de los restaurantes del centro y a cinco minutos en bicicleta de la hermosa playa de Tulum.&lt;br \\/&gt;Totalmente dise&amp;ntilde;ado para generar una excelente oportunidad con un 13% de Retorno de Inversi&amp;oacute;n anual garantizado por contrato, esto har&amp;aacute; que recuperes tu inversi&amp;oacute;n en un cerrar de ojos, sin olvidar que al momento de re-vender tu unidad la estar&amp;aacute;s revalorizando al precio del mercado por un 30% sobre el precio que la adquiriste.&lt;\\/p&gt;\\n&lt;p&gt;Cuando hablamos de retorno neto, quiere decir que el cliente no tiene pagar ningun gasto de mantenimiento del departamento, y mucho menos gastos de electricidad, agua, internet, etc&amp;hellip;&lt;\\/p&gt;\\n&lt;p&gt;Con el programa de Retorno de Inversi&amp;oacute;n garantizado a 5 a&amp;ntilde;os, ganas cada a&amp;ntilde;o 12,870 USD ( Aproximadamente 145,000 MXN) con pagos trimestrales, para recuperar en 5 a&amp;ntilde;os un total de 64,350 USD (Aproximadamente 1,220,000 MXN), por el 65% del valor de compra del departamento.&lt;\\/p&gt;\\n&lt;p&gt;Proyecto de 50 unidades totalmente equipadas, con incre&amp;iacute;bles comodidades que satisfacen las expectativas del nuevo mercado inmobiliario, haci&amp;eacute;ndolo una inversi&amp;oacute;n inteligente.&lt;br \\/&gt;Ofrece lo mejor de ambos mundos, ya que cuenta con un espacio amplio y c&amp;oacute;modo con ventanas corredizas de piso a techo que se abren hacia una terraza privada, creando una espl&amp;eacute;ndida sala de estar interior-exterior rodeada de vistas a la jungla.&lt;\\/p&gt;\\n&lt;p&gt;Amenidades :&lt;\\/p&gt;\\n&lt;p&gt;-Beach Club&lt;br \\/&gt;-Concierge&lt;br \\/&gt;-Seguridad 24\\/7&lt;br \\/&gt;-Traslado a la Playa&lt;br \\/&gt;-Pool Bar&lt;br \\/&gt;-Elevador&lt;br \\/&gt;-Rooftop&lt;br \\/&gt;-Alberca Infinity&lt;br \\/&gt;-Gimnasio&lt;br \\/&gt;entre otras.&lt;\\/p&gt;\\n&lt;p&gt;Precios desde $99,000 usd con 38.52 m2 Hasta $264,000 usd con 146.78 m2&lt;\\/p&gt;\",\"en\":\"&lt;p&gt;Ubicado en la zona m&amp;aacute;s vendida y con mayor crecimiento en Tulum, Aldea Zama, y a tan solo 2 cuadras de donde estar&amp;aacute; la nueva Quinta Avenida, rodeada de restaurantes, cafeter&amp;iacute;as y con tan solo una milla de los restaurantes del centro y a cinco minutos en bicicleta de la hermosa playa de Tulum.&lt;br \\/&gt;Totalmente dise&amp;ntilde;ado para generar una excelente oportunidad con un 13% de Retorno de Inversi&amp;oacute;n anual garantizado por contrato, esto har&amp;aacute; que recuperes tu inversi&amp;oacute;n en un cerrar de ojos, sin olvidar que al momento de re-vender tu unidad la estar&amp;aacute;s revalorizando al precio del mercado por un 30% sobre el precio que la adquiriste.&lt;\\/p&gt;\\n&lt;p&gt;Cuando hablamos de retorno neto, quiere decir que el cliente no tiene pagar ningun gasto de mantenimiento del departamento, y mucho menos gastos de electricidad, agua, internet, etc&amp;hellip;&lt;\\/p&gt;\\n&lt;p&gt;Con el programa de Retorno de Inversi&amp;oacute;n garantizado a 5 a&amp;ntilde;os, ganas cada a&amp;ntilde;o 12,870 USD ( Aproximadamente 145,000 MXN) con pagos trimestrales, para recuperar en 5 a&amp;ntilde;os un total de 64,350 USD (Aproximadamente 1,220,000 MXN), por el 65% del valor de compra del departamento.&lt;\\/p&gt;\\n&lt;p&gt;Proyecto de 50 unidades totalmente equipadas, con incre&amp;iacute;bles comodidades que satisfacen las expectativas del nuevo mercado inmobiliario, haci&amp;eacute;ndolo una inversi&amp;oacute;n inteligente.&lt;br \\/&gt;Ofrece lo mejor de ambos mundos, ya que cuenta con un espacio amplio y c&amp;oacute;modo con ventanas corredizas de piso a techo que se abren hacia una terraza privada, creando una espl&amp;eacute;ndida sala de estar interior-exterior rodeada de vistas a la jungla.&lt;\\/p&gt;\\n&lt;p&gt;Amenidades :&lt;\\/p&gt;\\n&lt;p&gt;-Beach Club&lt;br \\/&gt;-Concierge&lt;br \\/&gt;-Seguridad 24\\/7&lt;br \\/&gt;-Traslado a la Playa&lt;br \\/&gt;-Pool Bar&lt;br \\/&gt;-Elevador&lt;br \\/&gt;-Rooftop&lt;br \\/&gt;-Alberca Infinity&lt;br \\/&gt;-Gimnasio&lt;br \\/&gt;entre otras.&lt;\\/p&gt;\\n&lt;p&gt;Precios desde $99,000 usd con 38.52 m2 Hasta $264,000 usd con 146.78 m2&lt;\\/p&gt;\"}', '2021-03-01', 99000, 'usd', '{\"es\":\"DICIEMBRE 2020\",\"en\":\"DICIEMBRE 2020\"}', '', 0, 0, '', '', '1', '1', NULL, 'roVWJmsdTtVkRw3h2RMEvCNLkRY8wOFa.png', 0, 1, NULL, '1', NULL, NULL, '', '');

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
(10, 'KYu9uwqoH87b76kQ6yKhA9ZnUVSHVzuu.png', 5),
(11, '867jJS8MekcMTgEKAJPI82svT0lI26sk.png', 6),
(12, 'whPZH95zO6ovAyTLZz9sdbFAlQzoCXpI.png', 7),
(13, '0gm2wr7qeIlLeev5Uf2kXBjh9moXrrgJ.png', 9),
(14, 'vqCcK81wZNwgIGI8zOTM67OxSMTc2WE9.png', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vkye_properties_interested`
--

CREATE TABLE `vkye_properties_interested` (
  `id_interested` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `properties` tinyint(4) NOT NULL DEFAULT 0,
  `blog` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_properties_locations`
--

INSERT INTO `vkye_properties_locations` (`id_location`, `title`, `properties`, `blog`) VALUES
(1, 'Tulum', 1, 1),
(2, 'Playa del Carmen', 1, 1),
(4, 'Puerto Aventuras', 1, 1),
(6, 'Mahahual', 1, 1);

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
(3, 'w5BdqRxFgKS1mGbdrPhQXMyVq4Y4bX27.png');

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
  `media` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vkye_website_users`
--

INSERT INTO `vkye_website_users` (`id_website_user`, `username`, `password`, `email`, `level`, `media`) VALUES
(1, 'admin', '1f00a9fd943ed87b69c047e8437c96f4b76d26db:skE6oXQ1vidRC7N4bXyxSKLmVCloibCbOLmB0md37Q1Ohrz7kzcmkwpltRsBnDn8', 'admin@localhost', '10', '');

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
  MODIFY `id_entry` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_metadata` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vkye_properties`
--
ALTER TABLE `vkye_properties`
  MODIFY `id_property` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id_fk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_images`
--
ALTER TABLE `vkye_properties_images`
  MODIFY `id_image` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_interested`
--
ALTER TABLE `vkye_properties_interested`
  MODIFY `id_interested` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_properties_locations`
--
ALTER TABLE `vkye_properties_locations`
  MODIFY `id_location` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vkye_services`
--
ALTER TABLE `vkye_services`
  MODIFY `id_service` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vkye_slider_home`
--
ALTER TABLE `vkye_slider_home`
  MODIFY `id_image` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
