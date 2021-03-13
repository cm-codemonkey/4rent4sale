-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-07-2020 a las 02:31:00
-- Versión del servidor: 5.5.65-MariaDB
-- Versión de PHP: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin_pitaya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact`
--

CREATE TABLE `contact` (
  `id_contact` bigint(20) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `social_media` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contact`
--

INSERT INTO `contact` (`id_contact`, `email`, `phone`, `social_media`) VALUES
(1, 'info@tierrapitaya.com', '+52 (1) 984 163 9956 ', '{\"facebook\":\"https:\\/\\/www.facebook.com\\/tierrapitaya\",\"instagram\":\"https:\\/\\/www.instagram.com\\/tierrapitaya\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery_image` bigint(20) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `id_property` bigint(20) DEFAULT NULL,
  `id_magazine_article` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `magazine`
--

CREATE TABLE `magazine` (
  `id_magazine_article` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `background` text NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `magazine`
--

INSERT INTO `magazine` (`id_magazine_article`, `name`, `description`, `date`, `background`, `id_user`, `priority`) VALUES
(1, '{\"es\":\"\\u00bfPorque invertir en Tul\\u00fam?\",\"en\":\"Why invest in Tul\\u00fam?\"}', '{\"es\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p>\",\"en\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p>\"}', '2020-07-28', 'article_1.png', 1, 1),
(2, '{\"es\":\"Vivir en Tul\\u00fam es vivir el placer\",\"en\":\"Living in Tul\\u00fam is living pleasure\"}', '{\"es\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p>\",\"en\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p>\"}', '2020-07-28', 'article_2.png', 1, 2),
(3, '{\"es\":\"Tul\\u00fam, un para\\u00edso a la orilla del mar\",\"en\":\"Tul\\u00fam, a paradise by the sea\"}', '{\"es\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p>\",\"en\":\"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p>\"}', '2020-07-28', 'article_3.png', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties`
--

CREATE TABLE `properties` (
  `id_property` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `type` enum('multiple','simple') NOT NULL,
  `details` text NOT NULL,
  `map` text,
  `id_property_category` bigint(20) NOT NULL,
  `id_property_location` bigint(20) NOT NULL,
  `background` text,
  `pdf` text,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `properties`
--

INSERT INTO `properties` (`id_property`, `name`, `description`, `type`, `details`, `map`, `id_property_category`, `id_property_location`, `background`, `pdf`, `priority`) VALUES
(1, '{\"es\":\"Villaggio\",\"en\":\"Villaggio\"}', '{\"es\":\"<p style=\\\"text-align: left;\\\"><strong>Tu nuevo departamento te est&aacute; esperando.<\\/strong><\\/p>\\r\\n<p style=\\\"text-align: justify;\\\">Ubicado en Aldea Zam&aacute;, una de las zonas m&aacute;s exclusivas de Tulum. Villaggio es el lugar donde mereces vivir y disfrutar de los momentos m&aacute;s incre&iacute;bles y placenteros de la vida. Pensado para tus necesidades, las amenidades han sido dise&ntilde;adas para que vivas el m&aacute;ximo comfort rodeado de un verdadero para&iacute;so.<\\/p>\\r\\n<p style=\\\"text-align: justify;\\\">Vivir en Villaggio tiene sus ventajas. A tan s&oacute;lo unos pasos de la exclusiva zona comercial de Aldea Zam&aacute;, 10 minutos del Mar Caribe y a 5 minutos del centro de Tulum &iexcl;Villaggio tiene todo a su alcance para disfrutar Tulum!<\\/p>\\r\\n<p style=\\\"text-align: justify;\\\">Desde $240,000 USD<\\/p>\",\"en\":\"<p style=\\\"text-align: left;\\\"><strong>Your new condo is waiting for you<\\/strong><\\/p>\\r\\n<p style=\\\"text-align: justify;\\\">Located in Aldea Zam&aacute;, one of the most exclusive zones in Tulum. Villaggio is the place where you deserve to live and enjoy the most incredible and pleasant moments of life. Thinking on your necessities, the amenities have been designed for you to live the maximum comfort surrounded by a real paradise.<\\/p>\\r\\n<p style=\\\"text-align: justify;\\\">Living in Villaggio has its benefits. Only a few steps away from the exclusive commercial area of Aldea Zam&aacute;, 10 minutes away from the Mexican Caribbean Sea and 5 minutes away from Tulum downtown, Villaggio has everything at it \\u0301s reach to enjoy Tulum!<\\/p>\\r\\n<p style=\\\"text-align: justify;\\\">Desde $240,000 USD<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"240000\",\"dimensions\":{\"es\":\"x\",\"en\":\"x\"},\"characteristics\":[],\"amenities\":[{\"es\":\"Piscina\",\"en\":\"Pool\"},{\"es\":\"Lobby\",\"en\":\"Lobby\"},{\"es\":\"Wi-Fi en \\u00e1reas com\\u00fanes\",\"en\":\"Wi-Fi in common areas\"}],\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.201047\",\"lng\":\"-87.461981\"}', 1, 2, 'FVEovoU6zYMyt4fz.jpeg', 'KyZSjusAL6dAgJuVD9ifx3HPEb0v7qIq.pdf', 3),
(3, '{\"es\":\"El Canto Tulum\",\"en\":\"El Canto Tulum\"}', '{\"es\":\"<p>&iexcl;&Uacute;ltimos lotes disponibles!<\\/p>\\n<p>El Canto Tulum es un desarrollo de dos manzanas en la zona de mayor crecimiento de Tulum que ofrece tierras con urbanizaci&oacute;n y abundante &aacute;rea verde.<\\/p>\\n<p>Los lotes se entregan urbanizados, con banquetas, iluminaci&oacute;n en calles y calles blancas tipo Sacb&eacute; (t&eacute;cnica maya)<\\/p>\\n<p>&nbsp;<\\/p>\",\"en\":\"<p>Last lots available !&nbsp;<\\/p>\\n<p>El Canto Tulum is a development of two blocks in the fastest growing area of Tulum that offers land with urbanization and abundant green area.<\\/p>\\n<p>The lots are delivered urbanized, with sidewalks, street ligthing, Sacb&eacute; white streets (mayan technique).<\\/p>\\n<p>&nbsp;<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"81200\",\"dimensions\":{\"es\":\"x\",\"en\":\"x\"},\"characteristics\":\"[]\",\"amenities\":\"[]\",\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.195186\",\"lng\":\"-87.478070\"}', 2, 5, 'a2TOP31yflgvbbJk.png', 'VsOzunuFYkkIyUnyPF9kxLvi7Rs2zIqi.pdf', 5),
(5, '{\"es\":\"Arun\\u00e5\",\"en\":\"Arun\\u00e5\"}', '{\"es\":\"<div class=\\\"page\\\" title=\\\"Page 8\\\">\\r\\n<div class=\\\"layoutArea\\\">\\r\\n<div class=\\\"column\\\">\\r\\n<p><strong>Estudios disponibles desde 48m2<\\/strong> para compartir en pareja hasta unidades de dos reca\\u0301maras con roof garden y piscina privada con espacios ideales para disfrutar entre familia y amigos. Recinto perfecto para disfrutar del balance entre relajacio\\u0301n y actividades recreativas con su Shambala yoga, terraza para eventos, escritorio de negocios, piscina con disen\\u0303o vanguardista rodeada de naturaleza, hamacas y terrazas<\\/p>\\r\\n<p>Desde&nbsp; &nbsp;48 m2&nbsp; $125,000 USD&nbsp; &nbsp;\\/&nbsp; 176 m2 $270,000 USD.<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\",\"en\":\"<p><strong>Studies available starting from 48 m2.<\\/strong> to be shared in couple, to 2 bedrooms units with roof garden and private pool to be shared with friends and family. The perfect place to enjoy the balance between relaxation and recreational activites with its Shambala Yoga, Rooftop Terrace, Business Desk and Pool surrounded by nature, hammocks and terraces.<\\/p>\\r\\n<p>Desde&nbsp; &nbsp;49 m2&nbsp; $125,000&nbsp; &nbsp;USD&nbsp; \\/&nbsp; 176 m2 $270,000&nbsp; USD.<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"125000\",\"dimensions\":{\"es\":\"x\",\"en\":\"x\"},\"characteristics\":[],\"amenities\":[],\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.193221\",\"lng\":\"-87.471281\"}', 1, 5, 'oI7znZ632dzyAgWP.png', 'HaHjaZnqolyyuX9rDJI4FGfF2zAqrqTW.pdf', 1),
(17, '{\"es\":\"Selva Maya\",\"en\":\"Selva Maya\"}', '{\"es\":\"<p>Vivir en \\\"<strong>Selva Maya\\\"<\\/strong> es encontrarte conectado con la naturaleza que te rodea. Tulum, Quintana Roo es una de las zonas con mayor crecimiento y demanda actual debido a su cercan&iacute;a con el mar turquesa del Caribe Mexicano y su conexi&oacute;n con la mayor red de r&iacute;os subterr&aacute;neos del mundo. El abanico de opciones para actividades al aire libre, opciones gastron&oacute;micas, spas, entre otras es inmenso y por eso te invitamos a conocerlo.<\\/p>\",\"en\":\"<p>Living in <strong>&ldquo;Selva Maya&rdquo;<\\/strong> is finding yourself connected with the nature around you. Tulum, Quintana Roo is one of the zones with more growth and actual demand due to its proximity to the turquoise sea of the Mexican Caribbean Sea and its connection to the biggest underground rivers network of the world. The options for nature activities, gastronomical places, spas, among others is huge and that \\u0301s why we invite you to get to know it.<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"103109.50\",\"dimensions\":{\"es\":\"14.49 x 49.45 m.\",\"en\":\"14.49 x 49.45 m.\"},\"characteristics\":[{\"es\":\"$145 USD \\/m2\",\"en\":\"$145 USD \\/ m2.\"}],\"amenities\":[],\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.189620\",\"lng\":\"-87.470602\"}', 2, 5, 'qAZkaTwEEWnR4wPQ.jpeg', NULL, 11),
(43, '{\"es\":\"Villa Ch\\u00e9rie\",\"en\":\"Villa Ch\\u00e9rie\"}', '{\"es\":\"<p>Hermosa villa ecol&oacute;gica en uno de los rincones m&aacute;s incre&iacute;bles de Tulum. La colonia Holistika es Sin&oacute;nimo de tranquilidad y paz interior, elegida por muchos centros de yoga como espacio de Meditaci&oacute;n y paz donde puedes retirarte de la rutina.<\\/p>\\n<ul>\\n<li>4 Rec&aacute;maras (equipadas con mini splits)<\\/li>\\n<li>4 Ba&ntilde;os completos<\\/li>\\n<li>Piscina<\\/li>\\n<li>Acabados de Chukum, cemento pulido y piedra regional de mamposter&iacute;a<\\/li>\\n<li>Piso de cemento gris pulido<\\/li>\\n<li>Carpinter&iacute;ade Tzalam<\\/li>\\n<li>5 Patios (2 privados y 3 sociales)<\\/li>\\n<li>Todas las &aacute;reas incluyen arie acondicionado con mini split y ventiladores de techo<\\/li>\\n<\\/ul>\",\"en\":\"<p>Beautiful ecofriendly villa in one of the most amazing corners of Tulum. The Holistika neighborhood is synonymous of tranquility and interior peace, chosen by many Yoga centers as a space of meditation and peace where you can withdraw from the routine.<\\/p>\\n<ul>\\n<li>4 Bedrooms (equipped with mini splits)<\\/li>\\n<li>4 Full bathrooms<\\/li>\\n<li>Finishes of Chukum, polished cement and regional masonry stone<\\/li>\\n<li>Tzalam wood carpentry<\\/li>\\n<li>5 Patios (2 private and 3 social)<\\/li>\\n<li>All areas include air conditioning, mini split and ceiling fans<\\/li>\\n<\\/ul>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"480000\",\"dimensions\":{\"es\":\"323 m2 de terreno, 229 m2 de construcci\\u00f3n\",\"en\":\"323 square meters lot size, 229 square meters building area\"},\"characteristics\":\"[{\\\"es\\\":\\\"4 rec\\u00e1maras equipadas con mini splits\\\",\\\"en\\\":\\\"4 bedrooms equipped with mini splits\\\"},{\\\"es\\\":\\\"4 ba\\u00f1os completos\\\",\\\"en\\\":\\\"4 full bathrooms\\\"},{\\\"es\\\":\\\"Piscina\\\",\\\"en\\\":\\\"Pool\\\"},{\\\"es\\\":\\\"Piso de cemento pulido\\\",\\\"en\\\":\\\"Floorings of polished cement\\\"},{\\\"es\\\":\\\"Carpinter\\u00eda de madera de Tzalam\\\",\\\"en\\\":\\\"Tzalam wood carpentry\\\"},{\\\"es\\\":\\\"5 patios (2 privados y 3 sociales)\\\",\\\"en\\\":\\\"5 patios (2 private, 3 social)\\\"},{\\\"es\\\":\\\"Todas las \\u00e1reas incluyen aire acondicionado\\\",\\\"en\\\":\\\"All areas include air conditioner\\\"}]\",\"amenities\":\"[{\\\"es\\\":\\\"Acceso a Holistika\\\",\\\"en\\\":\\\"Access to Holistika\\\"}]\",\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.196725\",\"lng\":\"-87.480887\"}', 3, 9, 'so9sCvdgIBdxPljX.png', 'QVfUy3hcWoc9kpup8qI4EUwrFlliK3hn.pdf', 10),
(48, '{\"es\":\"Casa Boheme\",\"en\":\"Casa Boheme\"}', '{\"es\":\"<p>La naturaleza de Boheme consiste en su conexi&oacute;n con el entorno que lo rodea, la armon&iacute;a de vivir en un lugar donde la naturaleza se hace presente en cada momento, en las melod&iacute;as de las aves de la selva, en las plantas que la habitan y en la paz que se ha impreso en la arquitectura de la casa.<\\/p>\",\"en\":\"<p>Boheme \\u0301s nature consists on it \\u0301s connection with its surround, the harmony of living in a place where nature shows itself at every moment, the melodies of the singing jungle birds, the plants that inhabit it and the peace that has been printed on the house \\u0301s architecture are indescribable.<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"325000\",\"dimensions\":{\"es\":\"301 M2.\",\"en\":\"987 sq ft\"},\"characteristics\":\"\\\"[{\\\\\\\"es\\\\\\\":\\\\\\\"Acceso a Holistika\\\\\\\",\\\\\\\"en\\\\\\\":\\\\\\\"Access to Holistika\\\\\\\"},{\\\\\\\"es\\\\\\\":\\\\\\\"Piscina\\\\\\\",\\\\\\\"en\\\\\\\":\\\\\\\"Pool\\\\\\\"},{\\\\\\\"es\\\\\\\":\\\\\\\"Acabados de Chukum y Piedra\\\\\\\",\\\\\\\"en\\\\\\\":\\\\\\\"Chukum and stone finishes\\\\\\\"},{\\\\\\\"es\\\\\\\":\\\\\\\"Piso de m\\u00e1rmol travertino\\\\\\\",\\\\\\\"en\\\\\\\":\\\\\\\"Travertine marble floor\\\\\\\"}]\\\"\",\"amenities\":\"\\\"[]\\\"\",\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.201192\",\"lng\":\"-87.479631\"}', 3, 7, 'z7X6jEIg4lGVF4gh.jpeg', 'QfHObcFTxn8V6B1bdfnp6i1AL1p7PCKe.pdf', 4),
(51, '{\"es\":\"Surenna\",\"en\":\"Surenna\"}', '{\"es\":\"<div class=\\\"page\\\" title=\\\"Page 8\\\">\\r\\n<div class=\\\"layoutArea\\\">\\r\\n<div class=\\\"column\\\">\\r\\n<p>Surenna es un proyecto de <strong>49 casas<\\/strong> habitacionales construidas en lotes desde 250 m2 de 3 y 4 habitaciones, con un gran paisaje y jardines exuberantes disen\\u0303ados para disfrutar del entorno.<\\/p>\\r\\n<p>Este desarrollo preserva el valor de tu inversio\\u0301n y te da la oportunidad de tener un activo con los mejores retornos del mercado que adema\\u0301s puedes disfrutar las cuatro estaciones del an\\u0303o<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\",\"en\":\"<div class=\\\"page\\\" title=\\\"Page 8\\\">\\r\\n<div class=\\\"layoutArea\\\">\\r\\n<div class=\\\"column\\\">\\r\\n<p>Surenna, is a project of <strong>49 houses<\\/strong> built in an area of 250 square meters. It has 3 and 4 bedroom options, a large landscape and lush gardens designed to indulge nature.<\\/p>\\r\\n<p>This development preserves the value of your investment and gives you the opportunity to have an asset with the best returns in the market that you can enjoy throughout the year.<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"195000\",\"dimensions\":{\"es\":\"154 m2.\",\"en\":\"154 m2.\"},\"characteristics\":\"[{\\\"es\\\":\\\"Casas con 154 m2 de construcci\\u00f3n \\\",\\\"en\\\":\\\"154 m2 construction area houses\\\"},{\\\"es\\\":\\\"Terrenos desde 250 m2. \\\",\\\"en\\\":\\\"Lots from 250 m2.\\\"},{\\\"es\\\":\\\"Cuarto extra opcional\\\",\\\"en\\\":\\\"Extra room optional\\\"}]\",\"amenities\":\"[]\",\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.218112\",\"lng\":\"-87.480647\"}', 3, 8, 'KtkC0l8PdFHIXCHH.jpeg', NULL, 2),
(60, '{\"es\":\"SELVA MAYA 161\",\"en\":\"SELVA MAYA 161\"}', '{\"es\":\"<p>12 Lotes ubicados en la Regi&oacute;n 15 de Tulum, a unas cuadras de la Avenida Kukulc&aacute;n (pr&oacute;ximo acceso a la playa). Urbanizados y listos para desarrollar. Cuentan con : Banquetas \\/ Guarniciones \\/ Iluminaci&oacute;n \\/ Electricidad Subterr&aacute;nea&nbsp;<\\/p>\\r\\n<p>Lotes desde 429 m2&nbsp;<\\/p>\\r\\n<p>&iexcl;Agenda un tour hoy mismo!<\\/p>\",\"en\":\"<p>12 Lots located on Region 15, a few blocks away from Av. Kukulc&aacute;n (Beach Access, Next to be opened). Urbanized and ready to build. Counts with: Sidewalks \\/ Garrisons \\/ Lighting \\/ Underground Electricity<\\/p>\\r\\n<p>Starting from 1,407 sq. ft.<\\/p>\\r\\n<p>Book a tour today!<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"62209\",\"dimensions\":{\"es\":\"x\",\"en\":\"y\"},\"characteristics\":\"[]\",\"amenities\":\"[]\",\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":\"20.189620 \",\"lng\":\"-87.470602\"}', 2, 5, 'IpbYR4blZxp5N3JV.png', NULL, 9),
(61, '{\"es\":\"C\\u00e9spedes\",\"en\":\"C\\u00e9spedes\"}', '{\"es\":\"<p>El condo C&eacute;spedes se enuentra en &ldquo;La Veleta&rdquo;, zona de mayor crecimiento en Tulum. La cercan&iacute;a con la Avenida Tulum (Carretera Federal Canc&uacute;n - Chetumal) lo hace un punto estrat&eacute;gico para la accesibilidad y el desplazamiento en la zona. A 15 minutos de las playas de Tulum y de la zona arqueol&oacute;gica y a 5 minutos del centro. Un gran atractivo de C&eacute;spedes son sus amenidades y caracter&iacute;sticas dimensionales, que brindan la mayor comodidad.<\\/p>\",\"en\":\"<p>C&eacute;spedes is located in \\\"La Veleta\\\", growth zone in Tulum. The short distance towards Av. Tulum turns it into a strategic location due to accessibility. 15 minutes away from Tulum Beach and archaeological zone and 5 minutes away from downtown. C&eacute;spedes great features are its amenities and dimensional characteristics that bring the biggest comfort to your lifestyle.&nbsp;<\\/p>\"}', 'simple', '[{\"position\":1,\"name\":null,\"price\":\"160000\",\"dimensions\":{\"es\":\"x\",\"en\":\"y\"},\"characteristics\":[{\"es\":\"1 Rec\\u00e1mara\",\"en\":\"1 Bedroom\"},{\"es\":\"1 Ba\\u00f1o\",\"en\":\"1 Bathroom\"},{\"es\":\"Piscina Privada\",\"en\":\"Private Pool\"},{\"es\":\"Seguridad\",\"en\":\"Security\"},{\"es\":\"Equipado \\/ Amueblado\",\"en\":\"Equipped \\/ Furnished\"},{\"es\":\"Estufa con horno el\\u00e9ctrico\",\"en\":\"Stove with electric oven\"},{\"es\":\"Pisos de m\\u00e1rmol\",\"en\":\"Marble floors\"},{\"es\":\"Lavasecadora\",\"en\":\"Drywasher\"},{\"es\":\"Mini splits\",\"en\":\"Mini splits\"},{\"es\":\"B\\u00f3iler el\\u00e9ctrico\",\"en\":\"Electric Boiler\"},{\"es\":\"Dentro de condominio\",\"en\":\"Inside a condo complex\"}],\"amenities\":[],\"available\":true,\"type\":\"sale\",\"background\":null}]', '{\"lat\":null,\"lng\":null}', 1, 1, 'HG3maB9oio4X3Bh4.jpeg', NULL, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties_categories`
--

CREATE TABLE `properties_categories` (
  `id_property_category` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `background` text NOT NULL,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `properties_categories`
--

INSERT INTO `properties_categories` (`id_property_category`, `name`, `background`, `priority`) VALUES
(1, '{\"es\":\".\",\"en\":\".\"}', 'category_1.png', 3),
(2, '{\"es\":\".\",\"en\":\".\"}', 'category_2.png', 1),
(3, '{\"es\":\".\",\"en\":\".\"}', 'category_3.png', 2),
(4, '{\"es\":\".\",\"en\":\".\"}', 'category_4.png', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `properties_locations`
--

CREATE TABLE `properties_locations` (
  `id_property_location` bigint(20) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `properties_locations`
--

INSERT INTO `properties_locations` (`id_property_location`, `name`) VALUES
(1, '{\"es\":\"La Veleta\",\"en\":\"La Veleta\"}'),
(2, '{\"es\":\"Aldea Zamá\",\"en\":\"Aldea Zamá\"}'),
(4, '{\"es\":\"Una Luna\",\"en\":\"Una Luna\"}'),
(5, '{\"es\":\"Región 15\",\"en\":\"Región 15\"}'),
(6, '{\"es\":\"El Canto\",\"en\":\"El Canto\"}'),
(7, '{\"es\":\"Holistika\",\"en\":\"Holistika\"}'),
(8, '{\"es\":\"Regi\\u00f3n 11\",\"en\":\"Region 11\"}'),
(9, '{\"es\":\"Regi\\u00f3n 12 \",\"en\":\"Region 12 \"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id_setting` bigint(20) NOT NULL,
  `titles` text NOT NULL,
  `backgrounds` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id_setting`, `titles`, `backgrounds`) VALUES
(1, '{\"home\":{\"es\":\"Tierra Pitaya\",\"en\":\"Tierra Pitaya\"},\"home_subtitle\":{\"es\":\"Tulum Real Estate\",\"en\":\"Tulum Real Estate\"},\"properties\":{\"es\":\"Propiedades\",\"en\":\"Properties\"},\"magazine\":{\"es\":\"Tipi Magazine\",\"en\":\"Tipi Magazine\"},\"contact\":{\"es\":\"Contactanos\",\"en\":\"Contact us\"}}', '{\"slideshows\":[\"slideshow_1.png\",\"slideshow_2.png\",\"slideshow_3.png\",\"slideshow_4.png\"],\"backgrounds\":{\"subscribe\":\"background_subscription.png\",\"properties\":\"background_properties.png\",\"magazine\":\"background_magazines.png\",\"contact_us\":\"background_contact_us.png\"}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id_subscription` bigint(20) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_user_level` bigint(20) NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `fullname`, `email`, `username`, `password`, `id_user_level`, `avatar`, `status`) VALUES
(1, 'Tierra Pitaya', 'contacto@tierrapitaya.com', 'tierrapitaya', 'f548d38c46d170154af3e930fd866a4ac81e2662:ik2dqc9feXukUVJxlq3fxN5IxHihhj8TxU7xAXeI81pjvY9Tzj9ceUuP8j6UXboC', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_levels`
--

CREATE TABLE `users_levels` (
  `id_user_level` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_levels`
--

INSERT INTO `users_levels` (`id_user_level`, `name`, `code`) VALUES
(1, 'Super Administrador', '{superadministrator}'),
(2, 'Administrador', '{administrator}'),
(3, 'Editor', '{editor}');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indices de la tabla `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery_image`),
  ADD KEY `id_property` (`id_property`),
  ADD KEY `id_article` (`id_magazine_article`);

--
-- Indices de la tabla `magazine`
--
ALTER TABLE `magazine`
  ADD PRIMARY KEY (`id_magazine_article`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id_property`),
  ADD KEY `id_property_category` (`id_property_category`),
  ADD KEY `id_property_location` (`id_property_location`);

--
-- Indices de la tabla `properties_categories`
--
ALTER TABLE `properties_categories`
  ADD PRIMARY KEY (`id_property_category`);

--
-- Indices de la tabla `properties_locations`
--
ALTER TABLE `properties_locations`
  ADD PRIMARY KEY (`id_property_location`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indices de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id_subscription`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_level` (`id_user_level`);

--
-- Indices de la tabla `users_levels`
--
ALTER TABLE `users_levels`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery_image` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `magazine`
--
ALTER TABLE `magazine`
  MODIFY `id_magazine_article` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `properties`
--
ALTER TABLE `properties`
  MODIFY `id_property` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `properties_categories`
--
ALTER TABLE `properties_categories`
  MODIFY `id_property_category` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `properties_locations`
--
ALTER TABLE `properties_locations`
  MODIFY `id_property_location` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id_subscription` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users_levels`
--
ALTER TABLE `users_levels`
  MODIFY `id_user_level` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`id_property`) REFERENCES `properties` (`id_property`),
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`id_magazine_article`) REFERENCES `magazine` (`id_magazine_article`);

--
-- Filtros para la tabla `magazine`
--
ALTER TABLE `magazine`
  ADD CONSTRAINT `magazine_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`id_property_category`) REFERENCES `properties_categories` (`id_property_category`),
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`id_property_location`) REFERENCES `properties_locations` (`id_property_location`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `users_levels` (`id_user_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
