-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2018 a las 21:37:16
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plataforma_dialogo`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_notificaciones_quincenales` ()  BEGIN

create temporary table propuestas_pendientes(
   solucion_id  int,
   problema_solucion varchar(500),
   fecha_registro date,
   estado_solucion varchar(100),
   dependencia varchar(100),
   institucion_id int

);


SET @curdt = CURDATE();

insert into propuestas_pendientes
SELECT s.id as solucion_id, propuesta_solucion,s.created_at as FECHA_REGISTRO, es.nombre_estado,
       case
   when tipo_actor = 1 then "RESPONSABLE" 
   when tipo_actor = 2 then "CORRESPONSABLE"
end as dependencia , acs.institucion_id
FROM `solucions` s, estado_solucion es,actor_solucion acs,  institucions i
WHERE s.estado_id = es.id
and   s.id = acs.solucion_id
and   acs.institucion_id = i.id
and   es.id in(1,2,3)
and not exists(select 1 from  notificacion_quincenal nq where nq.solucion_id = s.id and nq.estado =0 and fecha_creacion_not = @curdt)
order by es.nombre_estado;


insert into notificacion_quincenal
select pp.*, u.email, u.id,0,@curdt, ''
from propuestas_pendientes pp, users u, user_institucions ui
where pp.institucion_id = ui.institucion_id
and u.id = ui.user_id;


select * from notificacion_quincenal where estado = 0 and fecha_creacion_not = @curdt order by email_usuario;


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comentario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solucion_id` int(11) NOT NULL,
  `tipo_fuente` int(11) NOT NULL,
  `ejecutor_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `fecha_inicio`, `comentario`, `solucion_id`, `tipo_fuente`, `ejecutor_id`, `created_at`, `updated_at`) VALUES
(1, '2018-07-16 05:00:00', 'Prueba', 2696, 1, 1, '2018-07-16 15:43:54', '2018-07-16 15:43:54'),
(2, '2018-07-16 05:00:00', 'dsadsadasd', 2696, 1, 1, '2018-07-16 15:51:41', '2018-07-16 15:51:41'),
(3, '2018-08-22 05:00:00', 'Una prueba de nueva', 2855, 1, 3, '2018-08-22 17:30:41', '2018-08-22 17:30:41'),
(4, '2018-08-22 05:00:00', 'Una prueba de nueva', 2857, 1, 3, '2018-08-22 17:30:41', '2018-08-22 17:30:41'),
(5, '2018-08-22 05:00:00', 'Una prueba de nueva', 2861, 1, 3, '2018-08-22 17:30:41', '2018-08-22 17:30:41'),
(6, '2018-08-22 05:00:00', 'Prueba 3', 2855, 1, 3, '2018-08-22 17:32:52', '2018-08-22 17:32:52'),
(7, '2018-08-22 05:00:00', 'Prueba 3', 2857, 1, 3, '2018-08-22 17:32:52', '2018-08-22 17:32:52'),
(8, '2018-08-22 05:00:00', 'Prueba 3', 2861, 1, 3, '2018-08-22 17:32:52', '2018-08-22 17:32:52'),
(9, '2018-08-22 05:00:00', 'Prueba 6', 2855, 1, 3, '2018-08-22 17:37:38', '2018-08-22 17:37:38'),
(10, '2018-08-22 05:00:00', 'Prueba 6', 2857, 1, 3, '2018-08-22 17:37:38', '2018-08-22 17:37:38'),
(11, '2018-08-22 05:00:00', 'Prueba 6', 2861, 1, 3, '2018-08-22 17:37:38', '2018-08-22 17:37:38'),
(12, '2018-08-22 05:00:00', 'uno', 2867, 1, 3, '2018-08-22 17:56:37', '2018-08-22 17:56:37'),
(13, '2018-08-22 05:00:00', 'uno 333', 2867, 1, 3, '2018-08-22 18:09:57', '2018-08-22 18:09:57'),
(14, '2018-08-23 05:00:00', 'mas cosas q&nbsp;', 2867, 1, 3, '2018-08-23 17:20:54', '2018-08-23 17:20:54'),
(15, '2018-08-23 05:00:00', 'prueba 8', 2857, 1, 235, '2018-08-23 17:25:19', '2018-08-23 17:25:19'),
(16, '2018-08-23 05:00:00', 'prueba 8', 2855, 1, 235, '2018-08-23 17:25:19', '2018-08-23 17:25:19'),
(17, '2018-08-23 05:00:00', 'prueba 8', 2861, 1, 235, '2018-08-23 17:25:19', '2018-08-23 17:25:19'),
(18, '2018-08-23 05:00:00', 'otra prueba de q no se', 2857, 1, 251, '2018-08-23 17:25:54', '2018-08-23 17:25:54'),
(19, '2018-08-23 05:00:00', 'otra prueba de q no se', 2855, 1, 251, '2018-08-23 17:25:54', '2018-08-23 17:25:54'),
(20, '2018-08-23 05:00:00', 'otra prueba de q no se', 2861, 1, 251, '2018-08-23 17:25:54', '2018-08-23 17:25:54'),
(21, '2018-08-23 05:00:00', 'mas pruebas', 2857, 1, 237, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(22, '2018-08-23 05:00:00', 'mas pruebas', 2855, 1, 237, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(23, '2018-08-23 05:00:00', 'mas pruebas', 2861, 1, 237, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(24, '2018-08-23 05:00:00', 'prueba 1', 2871, 1, 3, '2018-08-23 17:28:53', '2018-08-23 17:28:53'),
(25, '2018-08-23 05:00:00', 'prueba 5', 2871, 1, 3, '2018-08-23 17:29:20', '2018-08-23 17:29:20'),
(26, '2018-08-23 17:47:04', 'unoooo', 2867, 1, 3, '2018-08-23 17:47:04', '2018-08-23 17:47:04'),
(27, '2018-08-23 05:00:00', 'qqqq', 2874, 1, 3, '2018-08-23 20:02:25', '2018-08-23 20:02:25'),
(28, '2018-08-23 20:02:42', 'finalizado', 2874, 1, 3, '2018-08-23 20:02:42', '2018-08-23 20:02:42'),
(29, '2018-08-23 05:00:00', 'finalizaso', 2878, 1, 3, '2018-08-23 20:04:30', '2018-08-23 20:04:30'),
(30, '2018-08-23 20:05:32', 'finalizado chch', 2878, 1, 3, '2018-08-23 20:05:32', '2018-08-23 20:05:32'),
(31, '2018-08-24 05:00:00', 'Prueba de mipro', 2973, 1, 3, '2018-08-24 20:43:23', '2018-08-24 20:43:23'),
(32, '2018-08-24 20:44:21', 'Propuesta finalizada', 2973, 1, 3, '2018-08-24 20:44:21', '2018-08-24 20:44:21'),
(45, '2018-08-30 19:30:13', 'lllllllllllllllllllllllll', 2979, 1, 3, '2018-08-30 19:30:13', '2018-08-30 19:30:13'),
(47, '2018-08-30 19:38:07', 'lllllllllllllllllllllllll', 2979, 1, 3, '2018-08-30 19:38:07', '2018-08-30 19:38:07'),
(48, '2018-08-30 05:00:00', 'puruebabababa<br />\r\na<br />\r\na<br />\r\na', 2975, 1, 3, '2018-08-30 19:39:18', '2018-08-30 19:39:18'),
(49, '2018-08-30 05:00:00', 'puruebabababa<br />\r\na<br />\r\na<br />\r\na', 2975, 1, 3, '2018-08-30 19:40:35', '2018-08-30 19:40:35'),
(50, '2018-08-30 19:41:46', 'las propuestas finaloizadsasss<br />\r\nson la q estan', 2975, 1, 3, '2018-08-30 19:41:46', '2018-08-30 19:41:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor_solucion`
--

CREATE TABLE `actor_solucion` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `institucion_id` int(11) NOT NULL,
  `solucion_id` int(11) NOT NULL,
  `tipo_actor` int(11) NOT NULL,
  `tipo_fuente` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actor_solucion`
--

INSERT INTO `actor_solucion` (`id`, `user_id`, `institucion_id`, `solucion_id`, `tipo_actor`, `tipo_fuente`, `created_at`, `updated_at`) VALUES
(1, 0, 253, 2970, 1, 0, '2018-08-24 19:41:17', '2018-08-24 19:41:17'),
(2, 0, 253, 2971, 1, 0, '2018-08-24 19:41:17', '2018-08-24 19:41:17'),
(3, 0, 253, 2972, 1, 0, '2018-08-24 19:56:34', '2018-08-24 19:56:34'),
(4, 0, 3, 2973, 1, 0, '2018-08-24 19:57:14', '2018-08-24 19:57:14'),
(5, 0, 290, 2974, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(6, 0, 251, 2974, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(7, 0, 331, 2974, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(8, 0, 3, 2975, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(9, 0, 251, 2975, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(10, 0, 235, 2975, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(11, 0, 237, 2975, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(12, 0, 232, 2976, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(13, 0, 3, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(14, 0, 1, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(15, 0, 2, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(16, 0, 251, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(17, 0, 290, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(18, 0, 240, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(19, 0, 241, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(20, 0, 287, 2976, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(21, 0, 251, 2977, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(22, 0, 306, 2977, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(23, 0, 240, 2977, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(24, 0, 237, 2978, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(25, 0, 3, 2979, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(26, 0, 234, 2980, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(27, 0, 251, 2980, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(28, 0, 232, 2980, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(29, 0, 253, 2981, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(30, 0, 251, 2981, 2, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(31, 0, 234, 2982, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(32, 0, 253, 2983, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(33, 0, 253, 2984, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(34, 0, 3, 2985, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(35, 0, 253, 2986, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(36, 0, 234, 2987, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(37, 0, 234, 2988, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(38, 0, 3, 2989, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(39, 0, 234, 2990, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(40, 0, 234, 2991, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(41, 0, 3, 2992, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(42, 0, 251, 2993, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(43, 0, 251, 2994, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(44, 0, 251, 2995, 1, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(45, 0, 253, 2996, 1, 0, '2018-08-30 17:48:17', '2018-08-30 17:48:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambits`
--

CREATE TABLE `ambits` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_ambit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ambits`
--

INSERT INTO `ambits` (`id`, `nombre_ambit`, `created_at`, `updated_at`) VALUES
(1, 'Atracción de la inversión extranjera directa', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(2, 'Crédito y financiamiento productivo', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(3, 'Cumplimiento de la transparencia fiscal', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(4, 'Fomento de la producción nacional', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(5, 'Fortalecimiento de la dolarización', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(6, 'Fortalecimiento del sector exportador', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(7, 'Generación de empleo', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(8, 'Impulso a las alianzas público privadas', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(9, 'Impulso al cambio de la matriz productiva', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(10, 'Inversión en iniciativas productivas nacionales', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(11, 'Optimización y simplificación tributaria', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(12, 'Otros', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(13, 'Promoción del consumo responsable', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(14, 'Simplificación de trámites', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(15, 'Atracción de capitales nacionales invertidos en el exterior', '2017-10-24 12:12:28', '2017-10-24 12:12:28'),
(16, 'nuevo ambito', '2017-12-18 22:16:34', '2017-12-18 22:16:34'),
(17, 'nuevo ambito 3', '2017-12-18 22:48:16', '2017-12-18 22:48:26'),
(18, 'Seguridad, regulación y control en la producción', '2018-01-06 02:53:33', '2018-01-06 02:53:33'),
(19, 'Mejora y control en la planificación y actividades de los gobiernos locales', '2018-01-06 02:53:46', '2018-01-06 02:53:46'),
(20, 'Buenas prácticas de gestión ambiental', '2018-01-06 03:06:43', '2018-01-06 03:06:43'),
(21, 'Necesidad de análisis, mejora o creación de políticas públicas, normativas, resoluciones u otra base legal existente', '2018-01-06 03:41:33', '2018-01-06 03:41:33'),
(22, 'Fortalecimiento del sector Agroindustrial', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(23, 'Economía Popular y Solidaria en la Compra Pública', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(24, 'Impulso de la Producción Nacional', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(25, 'Comercio Exterior, Inversión y Desarrollo', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(26, 'Interculturalidad y Derechos Humanos, movilidad humana', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(27, 'Justicia fiscal, Transnacionales y Derechos Humanos', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(28, 'Construcción de la paz', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(29, 'Cultura, Patrimonio y Turismo', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(30, 'Turismo', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(31, 'Interculturalidad y Derechos Humanos, movilidad humana', '2018-02-07 00:42:50', '2018-02-07 00:42:50'),
(32, 'Movilidad Humana', '2018-02-07 00:42:50', '2018-02-07 00:42:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_archivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `nombre_archivo`, `actividad_id`, `created_at`, `updated_at`) VALUES
(1, '', 16, '2018-08-23 17:25:19', '2018-08-23 17:25:19'),
(2, '', 17, '2018-08-23 17:25:19', '2018-08-23 17:25:19'),
(3, '1535045154_despliegue_2857_-_001-777-084150771.pdf', 18, '2018-08-23 17:25:54', '2018-08-23 17:25:54'),
(4, '1535045154_despliegue_2857_-_001-777-084150771.pdf', 19, '2018-08-23 17:25:55', '2018-08-23 17:25:55'),
(5, '1535045154_despliegue_2857_-_001-777-084150771.pdf', 20, '2018-08-23 17:25:55', '2018-08-23 17:25:55'),
(6, '1535045188_despliegue_2857_-_001-777-084150771 (1).pdf', 21, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(7, '1535045188_despliegue_2857_-_001-777-084150771.pdf', 21, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(8, '1535045188_despliegue_2857_-_001-777-086730149.pdf', 21, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(9, '1535045188_despliegue_2857_-_001-777-084150771 (1).pdf', 22, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(10, '1535045188_despliegue_2857_-_001-777-084150771.pdf', 22, '2018-08-23 17:26:28', '2018-08-23 17:26:28'),
(11, '1535045188_despliegue_2857_-_001-777-086730149.pdf', 22, '2018-08-23 17:26:29', '2018-08-23 17:26:29'),
(12, '1535045188_despliegue_2857_-_001-777-084150771 (1).pdf', 23, '2018-08-23 17:26:29', '2018-08-23 17:26:29'),
(13, '1535045188_despliegue_2857_-_001-777-084150771.pdf', 23, '2018-08-23 17:26:29', '2018-08-23 17:26:29'),
(14, '1535045188_despliegue_2857_-_001-777-086730149.pdf', 23, '2018-08-23 17:26:29', '2018-08-23 17:26:29'),
(15, '1535045333_despliegue_2871_-_!MJJ1_$UCNG_13703792_10172247.pdf', 24, '2018-08-23 17:28:53', '2018-08-23 17:28:53'),
(16, '1535045360_despliegue_2871_-_Informe Cotizacion Capeipi-Fase2.docx', 25, '2018-08-23 17:29:20', '2018-08-23 17:29:20'),
(17, '1535046424_despliegue_2867_-_Informe Cotizacion Capeipi-Fase2.docx', 26, '2018-08-23 17:47:04', '2018-08-23 17:47:04'),
(18, '1535143403_despliegue_2973_-_Informe Borrador -2 -3.docx', 31, '2018-08-24 20:43:23', '2018-08-24 20:43:23'),
(19, '', 48, '2018-08-30 19:40:35', '2018-08-30 19:40:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantons`
--

CREATE TABLE `cantons` (
  `id` int(10) UNSIGNED NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `nombre_canton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cantons`
--

INSERT INTO `cantons` (`id`, `provincia_id`, `nombre_canton`, `created_at`, `updated_at`, `zona_id`) VALUES
(1, 1, 'Cuenca', NULL, NULL, NULL),
(2, 1, 'Camilo Ponce Enríquez', NULL, NULL, NULL),
(3, 1, 'Chordeleg', NULL, NULL, NULL),
(4, 1, 'El Pan', NULL, NULL, NULL),
(5, 1, 'Girón', NULL, NULL, NULL),
(6, 1, 'Guachapala', NULL, NULL, NULL),
(7, 1, 'Gualaceo', NULL, NULL, NULL),
(8, 1, 'Nabón', NULL, NULL, NULL),
(9, 1, 'Oña', NULL, NULL, NULL),
(10, 1, 'Paute', NULL, NULL, NULL),
(11, 1, 'Pucará', NULL, NULL, NULL),
(12, 1, 'San Fernando', NULL, NULL, NULL),
(13, 1, 'Santa Isabel', NULL, NULL, NULL),
(14, 1, 'Sevilla de Oro', NULL, NULL, NULL),
(15, 1, 'Sígsig', NULL, NULL, NULL),
(16, 2, 'Guaranda', NULL, NULL, NULL),
(17, 2, 'Caluma', NULL, NULL, NULL),
(18, 2, 'Chillanes', NULL, NULL, NULL),
(19, 2, 'Chimbo', NULL, NULL, NULL),
(20, 2, 'Echeandía', NULL, NULL, NULL),
(21, 2, 'Las Naves', NULL, NULL, NULL),
(22, 2, 'San Miguel', NULL, NULL, NULL),
(23, 3, 'Azogues', NULL, NULL, NULL),
(24, 3, 'Biblián', NULL, NULL, NULL),
(25, 3, 'Cañar', NULL, NULL, NULL),
(26, 3, 'Déleg', NULL, NULL, NULL),
(27, 3, 'El Tambo', NULL, NULL, NULL),
(28, 3, 'La Troncal', NULL, NULL, NULL),
(29, 3, 'Suscal', NULL, NULL, NULL),
(30, 4, 'Tulcán', NULL, NULL, NULL),
(31, 4, 'Bolívar', NULL, NULL, NULL),
(32, 4, 'Espejo', NULL, NULL, NULL),
(33, 4, 'Mira', NULL, NULL, NULL),
(34, 4, 'Montúfar', NULL, NULL, NULL),
(35, 4, 'San Pedro de Huaca', NULL, NULL, NULL),
(36, 5, 'Riobamba', NULL, NULL, NULL),
(37, 5, 'Alausí', NULL, NULL, NULL),
(38, 5, 'Chambo', NULL, NULL, NULL),
(39, 5, 'Chunchi', NULL, NULL, NULL),
(40, 5, 'Colta', NULL, NULL, NULL),
(41, 5, 'Cumandá', NULL, NULL, NULL),
(42, 5, 'Guamote', NULL, NULL, NULL),
(43, 5, 'Guano', NULL, NULL, NULL),
(44, 5, 'Pallatanga', NULL, NULL, NULL),
(45, 5, 'Penipe', NULL, NULL, NULL),
(46, 6, 'Latacunga', NULL, NULL, NULL),
(47, 6, 'La Maná', NULL, NULL, NULL),
(48, 6, 'Pangua', NULL, NULL, NULL),
(49, 6, 'Pujilí', NULL, NULL, NULL),
(50, 6, 'Salcedo', NULL, NULL, NULL),
(51, 6, 'Saquisilí', NULL, NULL, NULL),
(52, 6, 'Sigchos', NULL, NULL, NULL),
(53, 7, 'Machala', NULL, NULL, NULL),
(54, 7, 'Arenillas', NULL, NULL, NULL),
(55, 7, 'Atahualpa', NULL, NULL, NULL),
(56, 7, 'Balsas', NULL, NULL, NULL),
(57, 7, 'Chilla', NULL, NULL, NULL),
(58, 7, 'El Guabo', NULL, NULL, NULL),
(59, 7, 'Huaquillas', NULL, NULL, NULL),
(60, 7, 'Las Lajas', NULL, NULL, NULL),
(61, 7, 'Marcabelí', NULL, NULL, NULL),
(62, 7, 'Pasaje', NULL, NULL, NULL),
(63, 7, 'Piñas', NULL, NULL, NULL),
(64, 7, 'Portovelo', NULL, NULL, NULL),
(65, 7, 'Santa Rosa', NULL, NULL, NULL),
(66, 7, 'Zaruma', NULL, NULL, NULL),
(67, 8, 'Esmeraldas', NULL, NULL, NULL),
(68, 8, 'Atacames', NULL, NULL, NULL),
(69, 8, 'Eloy Alfaro', NULL, NULL, NULL),
(70, 8, 'Muisne', NULL, NULL, NULL),
(71, 8, 'Quinindé', NULL, NULL, NULL),
(72, 8, 'Rioverde', NULL, NULL, NULL),
(73, 8, 'San Lorenzo', NULL, NULL, NULL),
(74, 9, 'San Cristóbal', NULL, NULL, NULL),
(75, 9, 'Isabela', NULL, NULL, NULL),
(76, 9, 'Santa Cruz', NULL, NULL, NULL),
(77, 10, 'Guayaquil', NULL, NULL, NULL),
(78, 10, 'Alfredo Baquerizo Moreno', NULL, NULL, NULL),
(79, 10, 'Balao', NULL, NULL, NULL),
(80, 10, 'Balzar', NULL, NULL, NULL),
(81, 10, 'Colimes', NULL, NULL, NULL),
(82, 10, 'Daule', NULL, NULL, NULL),
(83, 10, 'Durán', NULL, NULL, NULL),
(84, 10, 'El Empalme', NULL, NULL, NULL),
(85, 10, 'El Triunfo', NULL, NULL, NULL),
(86, 10, 'General Antonio Elizalde', NULL, NULL, NULL),
(87, 10, 'Isidro Ayora', NULL, NULL, NULL),
(88, 10, 'Lomas de Sargentillo', NULL, NULL, NULL),
(89, 10, 'Marcelino Maridueña', NULL, NULL, NULL),
(90, 10, 'Milagro', NULL, NULL, NULL),
(91, 10, 'Naranjal', NULL, NULL, NULL),
(92, 10, 'Naranjito', NULL, NULL, NULL),
(93, 10, 'Nobol', NULL, NULL, NULL),
(94, 10, 'Palestina', NULL, NULL, NULL),
(95, 10, 'Pedro Carbo', NULL, NULL, NULL),
(96, 10, 'Playas', NULL, NULL, NULL),
(97, 10, 'Salitre', NULL, NULL, NULL),
(98, 10, 'Samborondón', NULL, NULL, NULL),
(99, 10, 'Santa Lucía', NULL, NULL, NULL),
(100, 10, 'Simón Bolívar', NULL, NULL, NULL),
(101, 10, 'Yaguachi', NULL, NULL, NULL),
(102, 11, 'Ibarra', NULL, NULL, NULL),
(103, 11, 'Antonio Ante', NULL, NULL, NULL),
(104, 11, 'Cotacachi', NULL, NULL, NULL),
(105, 11, 'Otavalo', NULL, NULL, NULL),
(106, 11, 'Pimampiro', NULL, NULL, NULL),
(107, 11, 'San Miguel de Urcuquí', NULL, NULL, NULL),
(108, 12, 'Loja', NULL, NULL, NULL),
(109, 12, 'Calvas', NULL, NULL, NULL),
(110, 12, 'Catamayo', NULL, NULL, NULL),
(111, 12, 'Celica', NULL, NULL, NULL),
(112, 12, 'Chaguarpamba', NULL, NULL, NULL),
(113, 12, 'Espíndola', NULL, NULL, NULL),
(114, 12, 'Gonzanamá', NULL, NULL, NULL),
(115, 12, 'Macará', NULL, NULL, NULL),
(116, 12, 'Olmedo', NULL, NULL, NULL),
(117, 12, 'Paltas', NULL, NULL, NULL),
(118, 12, 'Pindal', NULL, NULL, NULL),
(119, 12, 'Puyango', NULL, NULL, NULL),
(120, 12, 'Quilanga', NULL, NULL, NULL),
(121, 12, 'Saraguro', NULL, NULL, NULL),
(122, 12, 'Sozoranga', NULL, NULL, NULL),
(123, 12, 'Zapotillo', NULL, NULL, NULL),
(124, 13, 'Babahoyo', NULL, NULL, NULL),
(125, 13, 'Baba', NULL, NULL, NULL),
(126, 13, 'Buena Fe', NULL, NULL, NULL),
(127, 13, 'Mocache', NULL, NULL, NULL),
(128, 13, 'Montalvo', NULL, NULL, NULL),
(129, 13, 'Palenque', NULL, NULL, NULL),
(130, 13, 'Puebloviejo', NULL, NULL, NULL),
(131, 13, 'Quevedo', NULL, NULL, NULL),
(132, 13, 'Quinsaloma', NULL, NULL, NULL),
(133, 13, 'Urdaneta', NULL, NULL, NULL),
(134, 13, 'Valencia', NULL, NULL, NULL),
(135, 13, 'Ventanas', NULL, NULL, NULL),
(136, 13, 'Vinces', NULL, NULL, NULL),
(137, 14, 'Portoviejo', NULL, NULL, NULL),
(138, 14, '24 de Mayo', NULL, NULL, NULL),
(139, 14, 'Bolívar', NULL, NULL, NULL),
(140, 14, 'Chone', NULL, NULL, NULL),
(141, 14, 'El Carmen', NULL, NULL, NULL),
(142, 14, 'Flavio Alfaro', NULL, NULL, NULL),
(143, 14, 'Jama', NULL, NULL, NULL),
(144, 14, 'Jaramijó', NULL, NULL, NULL),
(145, 14, 'Jipijapa', NULL, NULL, NULL),
(146, 14, 'Junín', NULL, NULL, NULL),
(147, 14, 'Manta', NULL, NULL, NULL),
(148, 14, 'Montecristi', NULL, NULL, NULL),
(149, 14, 'Olmedo', NULL, NULL, NULL),
(150, 14, 'Paján', NULL, NULL, NULL),
(151, 14, 'Pedernales', NULL, NULL, NULL),
(152, 14, 'Pichincha', NULL, NULL, NULL),
(153, 14, 'Puerto López', NULL, NULL, NULL),
(154, 14, 'Rocafuerte', NULL, NULL, NULL),
(155, 14, 'San Vicente', NULL, NULL, NULL),
(156, 14, 'Santa Ana', NULL, NULL, NULL),
(157, 14, 'Sucre', NULL, NULL, NULL),
(158, 14, 'Tosagua', NULL, NULL, NULL),
(159, 15, 'Morona', NULL, NULL, NULL),
(160, 15, 'Gualaquiza', NULL, NULL, NULL),
(161, 15, 'Huamboya', NULL, NULL, NULL),
(162, 15, 'Limón Indanza', NULL, NULL, NULL),
(163, 15, 'Logroño', NULL, NULL, NULL),
(164, 15, 'Pablo Sexto', NULL, NULL, NULL),
(165, 15, 'Palora', NULL, NULL, NULL),
(166, 15, 'San Juan Bosco', NULL, NULL, NULL),
(167, 15, 'Santiago de Méndez', NULL, NULL, NULL),
(168, 15, 'Sucúa', NULL, NULL, NULL),
(169, 15, 'Taisha', NULL, NULL, NULL),
(170, 15, 'Tiwintza', NULL, NULL, NULL),
(171, 16, 'Tena', NULL, NULL, NULL),
(172, 16, 'Archidona', NULL, NULL, NULL),
(173, 16, 'Carlos Julio Arosemena Tola', NULL, NULL, NULL),
(174, 16, 'El Chaco', NULL, NULL, NULL),
(175, 16, 'Quijos', NULL, NULL, NULL),
(176, 17, 'Francisco de Orellana', NULL, NULL, NULL),
(177, 17, 'Aguarico', NULL, NULL, NULL),
(178, 17, 'La Joya de los Sachas', NULL, NULL, NULL),
(179, 17, 'Loreto', NULL, NULL, NULL),
(180, 18, 'Pastaza', NULL, NULL, NULL),
(181, 18, 'Arajuno', NULL, NULL, NULL),
(182, 18, 'Mera', NULL, NULL, NULL),
(183, 18, 'Santa Clara', NULL, NULL, NULL),
(184, 19, 'Quito', NULL, NULL, NULL),
(185, 19, 'Cayambe', NULL, NULL, NULL),
(186, 19, 'Mejía', NULL, NULL, NULL),
(187, 19, 'Pedro Moncayo', NULL, NULL, NULL),
(188, 19, 'Pedro Vicente Maldonado', NULL, NULL, NULL),
(189, 19, 'Puerto Quito', NULL, NULL, NULL),
(190, 19, 'Rumiñahui', NULL, NULL, NULL),
(191, 19, 'San Miguel de los Bancos', NULL, NULL, NULL),
(192, 20, 'Santa Elena', NULL, NULL, NULL),
(193, 20, 'La Libertad', NULL, NULL, NULL),
(194, 20, 'Salinas', NULL, NULL, NULL),
(195, 21, 'Santo Domingo', NULL, NULL, NULL),
(196, 21, 'La Concordia', NULL, NULL, NULL),
(197, 22, 'Lago Agrio', NULL, NULL, NULL),
(198, 22, 'Cascales', NULL, NULL, NULL),
(199, 22, 'Cuyabeno', NULL, NULL, NULL),
(200, 22, 'Gonzalo Pizarro', NULL, NULL, NULL),
(201, 22, 'Putumayo', NULL, NULL, NULL),
(202, 22, 'Shushufindi', NULL, NULL, NULL),
(203, 22, 'Sucumbíos', NULL, NULL, NULL),
(204, 23, 'Ambato', NULL, NULL, NULL),
(205, 23, 'Baños', NULL, NULL, NULL),
(206, 23, 'Cevallos', NULL, NULL, NULL),
(207, 23, 'Mocha', NULL, NULL, NULL),
(208, 23, 'Patate', NULL, NULL, NULL),
(209, 23, 'Pelileo', NULL, NULL, NULL),
(210, 23, 'Quero', NULL, NULL, NULL),
(211, 23, 'Santiago de Píllaro', NULL, NULL, NULL),
(212, 23, 'Tisaleo', NULL, NULL, NULL),
(213, 24, 'Zamora', NULL, NULL, NULL),
(214, 24, 'Centinela del Cóndor', NULL, NULL, NULL),
(215, 24, 'Chinchipe', NULL, NULL, NULL),
(216, 24, 'El Pangui', NULL, NULL, NULL),
(217, 24, 'Nangaritza', NULL, NULL, NULL),
(218, 24, 'Palanda', NULL, NULL, NULL),
(219, 24, 'Paquisha', NULL, NULL, NULL),
(220, 24, 'Yacuambi', NULL, NULL, NULL),
(221, 24, 'Yantzaza', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_cifras_nacionales`
--

CREATE TABLE `cn_cifras_nacionales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_cifra_nacional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `año` int(11) NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_impuesto_id` int(10) UNSIGNED NOT NULL,
  `tipo_cifra_nacional_id` int(10) UNSIGNED NOT NULL,
  `tipo_empresa_id` int(10) UNSIGNED NOT NULL,
  `provincia_id` int(10) UNSIGNED NOT NULL,
  `ciiu_id` int(10) UNSIGNED NOT NULL,
  `tipo_fuente_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_ciius`
--

CREATE TABLE `cn_ciius` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo_ciiu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_ciiu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_poblacions`
--

CREATE TABLE `cn_poblacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_sexo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_area_geografica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `año` int(11) NOT NULL,
  `poblacion_economicamente_inactiva` int(11) NOT NULL,
  `poblacion_economicamente_activa` int(11) NOT NULL,
  `poblacion_desempleado` int(11) NOT NULL,
  `poblacion_empleado` int(11) NOT NULL,
  `poblacion_subempleado` int(11) NOT NULL,
  `tasa_empleo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tasa_desempleo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_fuente_id` int(10) UNSIGNED NOT NULL,
  `provincia_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_provincias`
--

CREATE TABLE `cn_provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_zona` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_tipo_cifra_nacionals`
--

CREATE TABLE `cn_tipo_cifra_nacionals` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_cifra_nacional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_tipo_empresas`
--

CREATE TABLE `cn_tipo_empresas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_tipo_fuentes`
--

CREATE TABLE `cn_tipo_fuentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_fuente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cn_tipo_impuestos`
--

CREATE TABLE `cn_tipo_impuestos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_impuesto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consejo_institucions`
--

CREATE TABLE `consejo_institucions` (
  `id` int(10) UNSIGNED NOT NULL,
  `consejo_id` int(10) UNSIGNED NOT NULL,
  `institucion_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consejo_institucions`
--

INSERT INTO `consejo_institucions` (`id`, `consejo_id`, `institucion_id`, `created_at`, `updated_at`) VALUES
(1, 1, 238, '2018-08-28 15:55:39', '2018-08-28 15:55:39'),
(2, 1, 244, '2018-08-28 15:57:11', '2018-08-28 15:57:11'),
(3, 1, 252, '2018-08-28 15:59:58', '2018-08-28 15:59:58'),
(4, 1, 245, '2018-08-28 16:00:23', '2018-08-28 16:00:23'),
(5, 1, 289, '2018-08-28 16:00:53', '2018-08-28 16:00:53'),
(6, 1, 236, '2018-08-28 16:13:25', '2018-08-28 16:13:25'),
(7, 1, 234, '2018-08-28 16:14:01', '2018-08-28 16:14:01'),
(8, 1, 201, '2018-08-28 16:14:18', '2018-08-28 16:14:18'),
(9, 1, 309, '2018-08-28 16:15:10', '2018-08-28 16:15:10'),
(10, 1, 290, '2018-08-28 16:15:47', '2018-08-28 16:15:47'),
(11, 1, 302, '2018-08-28 16:16:18', '2018-08-28 16:16:18'),
(12, 1, 301, '2018-08-28 16:17:14', '2018-08-28 16:17:14'),
(13, 1, 3, '2018-08-28 16:18:54', '2018-08-28 16:18:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consejo_sectorials`
--

CREATE TABLE `consejo_sectorials` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_consejo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consejo_sectorials`
--

INSERT INTO `consejo_sectorials` (`id`, `nombre_consejo`, `created_at`, `updated_at`) VALUES
(1, 'Consejo Sectorial Social', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(2, 'Consejo Sectorial de Hábitat, Infraestructura y Recursos Naturales', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(3, 'Consejo Sectorial de Seguridad', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(4, 'Consejo Sectorial Económico y Productivo', '2018-06-12 19:40:35', '2018-06-12 19:40:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_acciones_alertas`
--

CREATE TABLE `csp_acciones_alertas` (
  `id` int(10) UNSIGNED NOT NULL,
  `reporte_alerta_id` int(11) NOT NULL,
  `acciones` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `anexo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `periodo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_acciones_alertas`
--

INSERT INTO `csp_acciones_alertas` (`id`, `reporte_alerta_id`, `acciones`, `fecha`, `anexo`, `created_at`, `updated_at`, `periodo_id`) VALUES
(1, 2, 'Seguimiento a Oficio Nro. MIPRO-VIP-2018-0061-O del 02 de marzo de 2018 dirigido al presidente de la Junta de Política y Regulación Monetaria y Financiera en el cual se el Viceministro de Industrias y Productividad solicita su pronunciamiento sobre la viabilidad de la reforma regulatoria sobre el valor de los intangibles en las garantías de préstamos.', '2018-03-13 11:12:00', '000Ninguno', '2018-03-14 04:12:29', '2018-03-14 04:12:29', 1),
(2, 1, 'Mediante Oficio Nro. MIPRO-VIP-2018-0075-O, del 13 de marzo 2018 se solicita nuevamente la expedición del Reglamento en mención a la SENESCYT por parte del Viceministro de Industrias y Productividad.', '2018-03-13 11:13:00', '000Ninguno', '2018-03-14 04:13:40', '2018-03-14 04:13:40', 1),
(3, 2, 'Mediante oficio el señor Viceministro de Industrias y Productividad, solicitará la convocatoria a la Junta del Fideicomiso Nro. 4 del Fondo de Capital de Riesgo a la Corporación Financiera Nacional CFN, y entre los puntos de orden del día se considerará el siguiente: Conocimiento del estado de expedición del Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social.', '2018-03-21 08:03:00', '000Ninguno', '2018-03-22 01:03:15', '2018-03-22 01:03:15', 2),
(4, 1, 'Seguimiento al oficio nro. MIPRO-VIP-2018-0061-O del 02 de marzo de 2018, respecto del pronunciamiento requerido sobre la viabilidad de la reforma regulatoria sobre el valor de los intangibles en las garantías de préstamos, se encuentra en análisis por parte del Dr. Nelson Mateus, Asesor del Despacho del Ministerio de Economía y Finanzas,  para emisión de resolución.', '2018-03-21 08:03:00', '000Ninguno', '2018-03-22 01:03:42', '2018-03-22 01:03:42', 2),
(5, 4, 'Se han realizado dos reuniones con el SRI presentando la propuesta del texto a incluirse en el Reglamento, y será puesto a consideración del director del SRI por parte de su equipo técnico.', '2018-03-21 08:59:00', '1521665949-20180320 Informe alerta.docx', '2018-03-22 01:59:09', '2018-03-22 01:59:09', 2),
(6, 4, 'Dado que se han agotado las instancias de mandos medios es necesario el diálogo entre máximas autoridades para que la sugerencia del Mipro sea incorporada en la propuesta de Reglamento de la Ley de Reactivación Económica.', '2018-03-28 03:36:00', '1522251371-20180320 Informe alerta (2).docx', '2018-03-28 20:36:11', '2018-03-28 20:36:11', 3),
(7, 2, 'Mediante Oficio Nro. MIPRO-VIP-2018-0082-O, del 21 de marzo de 2018, el Señor Viceministro de Industrias y Productividad, solicitó la convocatoria a la Junta del Fideicomiso Nro. 4 del Fondo de Capital de Riesgo a la Corporación Financiera Nacional CFN. Entre los puntos de orden del día se considerará el siguiente: Conocimiento del estado de expedición del Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social.', '2018-03-21 03:45:00', '000Ninguno', '2018-03-28 20:45:18', '2018-03-28 20:45:18', 3),
(8, 1, 'Seguimiento al Dr. Nelson Mateus, Asesor del Despacho del Ministerio de Economía y Finanzas, para conocer el pronunciamiento acerca del procedimiento a seguir para una reforma para la aceptación de activos intangibles como colateral de crédito.', '2018-03-28 03:46:00', '000Ninguno', '2018-03-28 20:46:58', '2018-03-29 04:39:00', 3),
(9, 2, 'Considerando la celebración de la próxima Junta del Fideicomiso, en la cual se tratarán, entre otros puntos, el “Conocimiento del estado de expedición del Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social”, se han realizado tres reuniones de trabajo con la Senescyt para revisar y solventar las observaciones presentadas al Proyecto de Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social. Como resultado de las reuniones realizadas, la Senescyt ha remitido a su instancia pertinente para su análisis, el informe y la propuesta de dicho reglamento con las respectivas correcciones, modificaciones y aclaraciones según el caso, mediante memorando Nro. SENESCYT-SGCT-SITT-2018-0110-MI del 28 de marzo de 2018.', '2018-04-04 03:26:00', '000Ninguno', '2018-04-04 20:26:22', '2018-04-04 20:30:33', 4),
(10, 1, 'El Ministerio de Económica y Finanzas, se comprometió a remitir respuesta al oficio nro. MIPRO-VIP-2018-0061-O, hasta el 05 de abril de 2018, sobre la viabilidad de la reforma regulatoria sobre el valor de los intangibles en las garantías de préstamos, según conversación mantenida con el  Asesor del Despacho.', '2018-04-04 07:44:00', '000Ninguno', '2018-04-05 00:44:52', '2018-04-05 00:44:52', 4),
(11, 2, 'El 06 de abril de 2018 se realizó la Junta del Fideicomiso Nro. 4 del Fondo de Capital de Riesgo(de forma presencial), en la cual la SENESCYT dio a conocer el estado de expedición del Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social, indicando que una vez solventadas las observaciones planteadas al proyecto de reglamento por parte del área jurídica del Despacho de la Secretaría de la Senescyt, será remitido para su consideración.', '2018-04-11 01:37:00', '000Ninguno', '2018-04-11 18:37:06', '2018-04-11 18:37:06', 5),
(12, 1, 'Se obtuvo el pronunciamiento de la Junta de Política y Regulación Monetaria y Financiera, a través del Secretario Administrativo (E) Ab. Ricardo Mateus Vásquez mediante Oficio No. JPRMF-0174-2018 del 03 de abril de 2018, en donde su pronunciamiento determina que el Ministerio de Industrias y Productividad coordine acciones pertinentes con la Superintendencia de Bancos para la generación de normativa relacionada con el sector financiero, a fin de dar a conocer a ese cuerpo colegiado las propuestas emitidas en el marco de las políticas públicas vigentes.', '2018-04-11 01:39:00', '000Ninguno', '2018-04-11 18:39:28', '2018-04-11 18:39:28', 5),
(13, 18, 'Más de 200 productores arroceros de Samborondón, Taura y Daule trabajan con autoridades del MAG en temas como créditos y comercialización,', '2018-04-11 05:01:00', '1523484098-arroceros.jpg', '2018-04-11 22:01:38', '2018-04-11 22:01:38', 5),
(14, 18, 'Pago de más de un millón de dólares a la UNA EP, correspondiente a una deuda contraída, en 2012. Adicional se organizó una rueda de prensa para que, una vez más, el Ministro explique los avances alcanzados en la hoja de ruta.', '2018-04-11 05:02:00', '000Ninguno', '2018-04-11 22:02:42', '2018-04-11 22:02:42', 5),
(15, 19, 'Mantener informada a la ciudadanía, por medio de los distintos medios de comunicación convencionales y alternativos, del contenido y los beneficios del Acuerdo Interministerial 36.', '2018-04-11 05:13:00', '000Ninguno', '2018-04-11 22:13:14', '2018-04-11 22:13:14', 5),
(16, 20, 'Permanente seguimiento de las decisiones que se aprueben, y acercamientos con los productores para explicarles el avance en cada una de las mesas de trabajo.', '2018-04-11 05:19:00', '000Ninguno', '2018-04-11 22:19:50', '2018-04-11 22:19:50', 5),
(17, 21, 'El Ministerio informa permanentemente de las acciones que ejecuta a favor de los agricultores de todo el país, a través de la Gran Minga Nacional Agropecuaria, así como de las reuniones que mantiene con las diferentes asociaciones de productores.', '2018-04-11 05:23:00', '000Ninguno', '2018-04-11 22:23:18', '2018-04-11 22:23:18', 5),
(18, 22, 'Conjuntamente con los productores de banano se trabaja en una nueva ley del banano. Entre las propuestas constan eliminar las multas excesivas para el sector exportador, ya que estas en varias ocasiones terminan con la quiebra de las empresas; igualdad de condiciones entre productores y exportadores; legalización entre un 30% y 40% del mercado SPOT (fruta vendida sin respaldo de contrato); eliminar la reinscripción de predios y marcas periódicamente, salvo casos especiales.', '2018-04-11 05:25:00', '000Ninguno', '2018-04-11 22:25:31', '2018-04-11 22:25:31', 5),
(19, 23, 'Generar mayores contenidos, que reflejen todo el trabajo que realiza el Gobierno en el sector agropecuario del país.', '2018-04-11 05:29:00', '000Ninguno', '2018-04-11 22:29:34', '2018-04-11 22:29:34', 5),
(20, 24, 'Activación de todos los protocolos de seguridad en la frontera para evitar un eventual ingreso de ganado contagiado con fiebre aftosa.', '2018-04-11 05:32:00', '000Ninguno', '2018-04-11 22:32:02', '2018-04-11 22:32:02', 5),
(21, 2, 'El 17 de abril de 2018, mediante oficio Nro. SENESCYT-SGCT-SITT-2018-0141-CO, la Senescyt remite el Acuerdo No. SENESCYT-2018-024, del 13 de abril de 2018, vigente desde su fecha de expedición, mediante el cual el Secretario de Educación, Superior, Ciencia, Tecnología e Innovación expidió el Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social.', '2018-04-17 01:09:00', '000Ninguno', '2018-04-18 18:09:40', '2018-04-18 18:09:40', 6),
(22, 1, 'En base al pronunciamiento de la Junta de Política y Regulación Monetaria y Financiera mediante Oficio No. JPRMF-0174-2018 del 03 de abril de 2018, sobre el procedimiento a seguir para la reforma regulatoria sobre el valor de los intangibles en las garantías de préstamos, se determina que el Ministerio de Industrias y Productividad, deberá coordinar las acciones pertinentes con la Superintendencia de Bancos para la generación de normativa relacionada con el sector financiero, a fin de dar a conocer a ese cuerpo colegiado las propuestas emitidas en el marco de las políticas públicas vigentes, por tal motivo se procederá con las directrices emitidas por la Junta  Política y Regulación Monetaria y Financiera.', '2018-04-18 01:10:00', '000Ninguno', '2018-04-18 18:10:31', '2018-04-18 18:10:31', 6),
(23, 26, 'El Ministerio de Agricultura y Ganadería, junto al Ministerio de Comercio Exterior y la Empresa Pública Unidad Nacional de Almacenamiento concretaron la venta de 42 mil toneladas de arroz a Colombia. Respecto a la solicitud de reunión, el Ministro está abierto al diálogo, y como prueba de ello ha mantenido reuniones con más de cien dirigentes del sector arrocero.', '2018-04-18 04:07:00', '000Ninguno', '2018-04-18 21:07:14', '2018-04-18 21:07:14', 6),
(24, 27, 'A través del Proyecto de Reactivación de Café y Cacao el Ministerio de Agricultura y Ganadería apoya a los productores mediante la entrega de plantas, insumos. Entre mayo del año anterior y  marzo de este año se entregó 566.682 plantas de café robusta, se rehabilitaron y renovaron 8.593 hectáreas de café robusta y arábigo, 59.924 productores fueron capacitados, y 2.500 beneficiados con créditos.', '2018-04-18 04:09:00', '000Ninguno', '2018-04-18 21:09:18', '2018-04-18 21:09:18', 6),
(25, 28, 'Ejecución de acciones comunicacionales (boletines de prensa, mensajes redes sociales, microvídeos) para explicar en qué consiste la franja de precios. Además, en cada reunión los técnicos exponen la nueva modalidad.', '2018-04-18 04:12:00', '000Ninguno', '2018-04-18 21:12:19', '2018-04-18 21:12:19', 6),
(26, 29, 'Mantener reuniones con los productores para explicarles el mecanismo de fijación de precios, que no incide en pérdidas para el agricultor, sino que le da estabilidad.', '2018-04-18 04:17:00', '000Ninguno', '2018-04-18 21:17:49', '2018-04-18 21:17:49', 6),
(27, 31, 'Los dirigentes de las organizaciones sociales y campesinas fueron recibidos por el presidente Lenín Moreno, la vicepresidenta María Alejandra Vicuña, y los ministros de Agricultura y Ganadería, Rubén Flores, y de Política, Miguel Carvajal.', '2018-04-18 04:21:00', '000Ninguno', '2018-04-18 21:21:44', '2018-04-18 21:21:44', 6),
(28, 33, 'Monitoreo de las publicaciones en los medios y en redes. Difusión de información a través de los diferentes canales de comunicación.', '2018-04-25 01:16:00', '000Ninguno', '2018-04-25 18:16:36', '2018-04-25 18:16:36', 7),
(29, 17, 'Dado que se han agotado las instancias de mandos medios, se ha comunicado al Despacho Ministerial, para lo cual se ha entregado la ayuda memoria técnica respectiva para que se coordine una reunión entre máximas autoirdades.', '2018-04-25 01:53:00', '000Ninguno', '2018-04-25 18:53:17', '2018-04-25 18:53:17', 7),
(30, 34, 'Se trabaja en una nueva Ley del Banano, en conjunto con los productores de la fruta', '2018-04-25 02:06:00', '000Ninguno', '2018-04-25 19:06:45', '2018-04-25 19:06:45', 7),
(31, 2, 'Expedición del Reglamento de Incentivos Financieros, Tributarios y Administrativos a la Innovación Social por parte de la Senescyt el 13 de abril de 2018, con lo cual ya se mitiga el riesgo de la alerta.', '2018-04-13 02:13:00', '000Ninguno', '2018-04-25 19:13:09', '2018-04-25 19:13:09', 7),
(32, 35, 'Difusión de los resultados alcanzados, mediante la Gran Minga Nacional Agropecuaria, en sus diferentes ejes.', '2018-04-25 02:17:00', '000Ninguno', '2018-04-25 19:17:08', '2018-04-25 19:17:08', 7),
(33, 36, 'Conformación de equipos de trabajo en las coordinaciones zonales y en las direcciones provinciales, y evaluación para indemnizar mediante el Seguro Agrícola.', '2018-04-25 02:20:00', '000Ninguno', '2018-04-25 19:20:38', '2018-04-25 19:20:38', 7),
(34, 1, 'Mediante Oficio Nro. MIPRO-VIP-2018-0098-O del 17 de abril de 2018, el Ministerio de Industrias y Productividad (Mipro), solicita el pronunciamiento a la Superintendencia de Bancos sobre la \"Reforma regulatoria que permita la aplicación de los activos intangibles como colateral de crédito\" y a su vez pide un delegado para  coordinar las acciones pertinentes para la generación de la normativa relacionada con el sector financiero; acogiendo lo establecido por la Junta  Política y Regulación Monetaria y Financiera mediante Oficio JPRMF-O174-2018 del 3 de abril del 2018, dicha pronunciamiento  se encuentra en proceso a cargo de la Subdirectora de Riesgos Financieros de la Superintendencia de Bancos,  Ing. Verónica Lara quien gestionará la petición.', '2018-04-17 02:21:00', '000Ninguno', '2018-04-25 19:21:55', '2018-04-25 19:21:55', 7),
(35, 37, 'Como resultado de los diálogos en las mesas técnicas y consejos consultivos se establecieron franjas de precios para la cosecha de este año en arroz y maíz duro.', '2018-04-25 02:27:00', '000Ninguno', '2018-04-25 19:27:52', '2018-04-25 19:27:52', 7),
(36, 38, 'El Ministerio de Agricultura y Ganadería implementó en el país unidades de producción y conservación de forraje, para que los pequeños y medianos productores dispongan de alimento para sus animales en épocas de escasez de pasto, sequías y otros fenómenos naturales.\r\nCada Unidad de Producción y Conservación de Pastos y Forrajes tiene una máquina picadora de pasto, una segadora autopropulsada y una ensiladora.', '2018-04-25 02:31:00', '000Ninguno', '2018-04-25 19:31:22', '2018-04-25 19:31:22', 7),
(37, 39, 'El Acuerdo Ministerial 048, emitido el 11 de abril de 2018 establece que el precio mínimo de sustentación es 7,30 dólares. Para hacer respetar el pago se aplicará el artículo 308 del Código Orgánico integral Penal, que sanciona con uno a tres años de prisión a quien no pague el precio mínimo de sustentación.', '2018-04-25 02:35:00', '000Ninguno', '2018-04-25 19:35:14', '2018-04-25 19:35:14', 7),
(38, 40, 'Una de las propuestas es determinar los daños que sufrieron los cultivos para proceder a la indemnización respectiva, en caso de que el agricultor haya contratado el Seguro Agrícola implementado por el MAG.', '2018-04-25 02:37:00', '000Ninguno', '2018-04-25 19:37:56', '2018-04-25 19:37:56', 7),
(39, 41, 'El ministro Rubén Flores firmó un acuerdo profundizar  la lucha contra contrabando de lácteos y derivados; proteger la producción nacional; promover el consumo de leche; suspender la aplicación del acuerdo interinstitucional 036 hasta tener un instructivo consensuado con la comunidad; suspender la implementación del areteo, guías de movilización y prohibición de venta de leche cruda; impulsar la reactivación de la planta de Girón; impulsar ante la Senescyt la implementación de un instituto tecnológico de producción de leche.', '2018-04-25 02:40:00', '000Ninguno', '2018-04-25 19:40:09', '2018-04-25 19:40:09', 7),
(40, 1, 'Conforme la solicitud efectuada a la Superintendencia de Bancos respecto del pronunciamiento sobre la \"Reforma regulatoria que permita la aplicación de los activos intangibles como colateral de préstamo\", y de delegar una persona para continuar con la gestión inherente al proceso, se coordinó una reunión de trabajo para el día 03 de mayo de 2018 con el Señor Álvaro Troya, Intendente Nacional de Riesgos y Estudios, y la Ing. Verónica Lara, Subdirectora de Riesgos Financieros, de la Superintendencia de Bancos.', '2018-05-02 01:13:00', '000Ninguno', '2018-05-02 18:13:11', '2018-05-02 18:13:11', 8),
(41, 4, 'Dado que se han agotado las instancias de mandos medios, se ha comunicado al Despacho Ministerial, para lo cual se ha entregado la ayuda memoria técnica respectiva para que se coordine una reunión entre máximas autoridades.\r\nDel seguimiento realizado a Despacho, se nos informa que la coordinación de la reunión está a espera de respuesta del SRI. Se adjunta respaldos.', '2018-04-25 04:44:00', '000Ninguno', '2018-05-02 21:44:32', '2018-05-02 23:06:15', 8),
(42, 45, 'Socialización de los beneficios del sistema, con los productores de arroz; monitoreo de las publicaciones en los medios y en redes, así como difusión de información a través de los diferentes canales de comunicación.', '2018-05-02 05:43:00', '000Ninguno', '2018-05-02 22:43:25', '2018-05-02 22:43:25', 8),
(43, 44, 'Las personas que no pagan el precio mínimo de sustentación establecido serán sancionadas, trabajo que se coordina con la Gobernación, entidad que se comprometió a realizar los operativos de control.', '2018-05-02 05:43:00', '000Ninguno', '2018-05-02 22:43:51', '2018-05-02 22:43:51', 8),
(44, 43, 'Se realizó una evaluación de la afectación y se procedió a la declaración y cierre de los estados de alerta en correspondencia con la evolución de la amenaza. La Secretaría de Gestión de Riesgos (SGR) ha establecido tres estados de alerta: (i) Aviso de activación significativa de la amenaza, (ii) Aviso de preparación para un evento adverso inminente y (iii) Aviso de atención de la emergencia o del desastre. Se describió las actividades de respuesta que se realizarán en cada uno de los estados de alerta, con los responsables de dicha actividad, al igual que las unidades del MAG.', '2018-05-02 05:44:00', '000Ninguno', '2018-05-02 22:44:20', '2018-05-02 22:44:20', 8),
(45, 48, 'El ministro Rubén Flores  en reunión con los productores arroceros defendió la franja de precios y explicó que disponer de un precio piso garantiza al productor una rentabilidad. En cuanto al seguro agrícola, los técnicos del MAG realizan las inspecciones para determinar la afectación en los cultivos y establecer los montos de indemnización.', '2018-05-03 04:26:00', '000Ninguno', '2018-05-09 21:26:40', '2018-05-09 21:26:40', 9),
(46, 49, 'Se ha elaborado un informe técnico para que se indemnice inmediatamente a los beneficiarios del seguro agrícola.', '2018-05-07 04:34:00', '000Ninguno', '2018-05-09 21:34:06', '2018-05-09 21:34:06', 9),
(47, 50, 'Se trabaja en las mesas técnicas y el consejo consultivo del banano en una hoja de ruta sobre la sustentabilidad del banano, en un mediano y largo plazo.', '2018-05-08 04:47:00', '000Ninguno', '2018-05-09 21:47:50', '2018-05-09 21:47:50', 9),
(48, 48, 'El MAG continúa con la implementación de las actividades de la hoja de ruta de la cadena de arroz, las mismas que han sido asociadas con las diversas organizaciones de productores en los diferentes espacios de diálogo.', '2018-05-03 05:40:00', '000Ninguno', '2018-05-09 22:40:06', '2018-05-09 22:40:06', 9),
(49, 48, 'El MAG continúa con la implementación de las actividades de la hoja de ruta de la cadena de arroz, las mismas que han sido asociadas con las diversas organizaciones de productores en los diferentes espacios de diálogo.', '2018-05-03 05:40:00', '000Ninguno', '2018-05-09 22:40:08', '2018-05-09 22:40:08', 9),
(50, 4, 'Se ha sugerido a equipo técnico del SRI incorporar en el Reglamento a la Ley de Reactivación un texto que ratifique la obligatoriedad del registro RPN en el Mipro y así crear los medios para la aplicabilidad de los incentivos. Texto sugerido: “En cuanto a la verificación y a efectos de control de la aplicación de los incentivos a procesos productivos con valor agregado nacional, Mipro será el ente encargado de receptar la solicitud de registro conforme sus lineamientos”.\r\nDado que se han agotado las instancias de mandos medios se entregó a Despacho la solicitud de reunión, ayuda memoria técnica respectiva y se encuentra en el listado para coordinación de reunión entre máximas autoridades. \r\nDel seguimiento realizado a Despacho, se nos informa que la reunión prevista para el 09 de mayo ha sido trasladada preliminarmente para el lunes 14 de mayo de 2018.', '2018-05-09 08:02:00', '000Ninguno', '2018-05-10 01:02:20', '2018-05-10 01:02:20', 9),
(51, 1, 'El 03 de mayo de 2018 se realizó una reunión de trabajo con la Superintendencia de Bancos (SB) a fin de analizar la viabilidad de reforma regulatoria que permita la aplicación de los activos intangibles como colateral de préstamo, y conocer el pronunciamiento por parte de la SB respecto del tema. Como compromiso por parte de esta cartera de Estado, para el desarrollo del proyecto en mención, se remitirá la ayuda memoria y una hoja de ruta para consideración del ente de control del sistema financiero.', '2018-05-09 08:03:00', '000Ninguno', '2018-05-10 01:03:20', '2018-05-10 01:03:20', 9),
(52, 55, 'Los ministros de Agricultura y Ganadería, Rubén Flores, y del Ambiente, Tarsicio Granizo, firmaron el Acuerdo Interministerial 030, mediante el cual se creó el Comité Interinstitucional de Seguimiento de Palma Sostenible (CISPS), con el fin de fortalecer la producción de palma sostenible, que le permita al país competir en el mercado internacional presentando elevados niveles de producción con altos estándares sociales y ambientales.', '2018-05-16 04:55:00', '000Ninguno', '2018-05-16 21:55:25', '2018-05-16 21:55:25', 10),
(53, 56, 'La prefectura mantiene reuniones con el Ministerio de Agricultura y Ganadería, Senplades, Ministerio de Ambiente, Senagua y la Empresa Pública del Agua. Esta entidad considera que están preparados con las obras de infraestructura hidráulica que se tienen, tales como represas, sistemas de riego, albarradas, que “garantizarían un alivio en la sequía”. Entre el 2015 y el 2017 construyeron alrededor de 1.100 albarradas y 130 pozos profundos.', '2018-05-16 04:59:00', '000Ninguno', '2018-05-16 21:59:38', '2018-05-16 21:59:38', 10),
(54, 57, 'Diálogo continuo con los agricultores a través de mesas técnicas y la aplicación de hojas de ruta que atiendan sus requerimientos; además de la difusión por medios digitales y medios de comunicación de las acciones realizadas a través de la Gran Minga Agropecuaria.', '2018-05-11 05:04:00', '000Ninguno', '2018-05-16 22:04:28', '2018-05-16 22:04:28', 10),
(55, 58, 'Diálogo continuo con los agricultores a través de mesas técnicas y la aplicación de hojas de ruta que atiendan sus requerimientos; además de la difusión por medios digitales y medios de comunicación de las acciones realizadas a través de la Gran Minga Agropecuaria.', '2018-05-11 05:10:00', '000Ninguno', '2018-05-16 22:10:55', '2018-05-16 22:10:55', 10),
(56, 59, 'El ministro de Agricultura y Ganadería, Rubén Flores, envió cartas a los directivos de las industrias avícolas, piladoras de arroz y exportadoras de banano, informándoles que se realizará un control interinstitucional para hacer respetar los precios determinados en los acuerdos ministeriales respectivos, con la finalidad de garantizar la actividad de los productores agrícolas, sobre todo, de los pequeños. \r\nEn el caso del banano, se indicó que “exportador que no suscriba contrato con los productores y/o comercializadores, no podrá exportar el producto, al igual que el exportador que utilice los cupos en el mercado spot”.', '2018-05-14 05:15:00', '000Ninguno', '2018-05-16 22:15:07', '2018-05-16 22:15:07', 10),
(57, 59, 'El ministro de Agricultura y Ganadería, Rubén Flores, envió cartas a los directivos de las industrias avícolas, piladoras de arroz y exportadoras de banano, informándoles que se realizará un control interinstitucional para hacer respetar los precios determinados en los acuerdos ministeriales respectivos, con la finalidad de garantizar la actividad de los productores agrícolas, sobre todo, de los pequeños. \r\nEn el caso del banano, se indicó que “exportador que no suscriba contrato con los productores y/o comercializadores, no podrá exportar el producto, al igual que el exportador que utilice los cupos en el mercado spot”.', '2018-05-14 05:15:00', '000Ninguno', '2018-05-16 22:15:07', '2018-05-16 22:15:07', 10),
(58, 61, 'La Ministra de Industrias y Productividad remitió oficio a la Secretaría General Jurídica de la Presidencia de la República solicitando reforma al Decreto Ejecutivo 545 del 27 de septiembre de 2005.', '2018-05-16 06:26:00', '000Ninguno', '2018-05-16 23:26:07', '2018-05-16 23:26:07', 10),
(59, 61, 'Oficio MIPRO-MIPRO-2018-0354-OF del 18 de abril de 2018.', '2018-05-16 06:26:00', '000Ninguno', '2018-05-16 23:26:32', '2018-05-16 23:26:32', 10),
(60, 1, 'La Superintendencia de Bancos  analizó la viabilidad de efectuar una  reforma regulatoria que permita la aplicación de los activos intangibles como colateral de préstamo, y se conoció su pronunciamiento al respecto de mantener un trabajo coordinado, por lo que en este sentido esta cartera de Estado se encuentra desarrollando la respectiva hoja de ruta.', '2018-05-16 09:24:00', '000Ninguno', '2018-05-17 02:24:11', '2018-05-17 02:24:11', 10),
(61, 54, 'Mediante oficio Nro. MIPRO-CGSP-2018-0475-OF, del 14 de mayo de 2018, se realiza la solicitud de nueva convocatoria de la Junta del Fideicomiso Nro. 5 a la CFN para el día viernes 18 de mayo del año en curso,  en virtud de la suspensión de la Junta referida notificada por la Corporación Financiera Nacional B.P. (CFN), mediante oficio Nro. CFN-SGNF-2018-0240-O del 10 de mayo de 2018, a fin de tratar los siguientes puntos del orden del día: 1) Conocimiento y aprobación de la propuesta para que la Senescyt realice la gestión de selección y evaluación de los proyectos postulantes al Programa Emprendedores. 2) Conocimiento del estado de las propuestas presentadas respecto de que la Fiduciaria realice los procesos de contratación, y de la renegociación de los costos por honorarios de administración mensual del Fideicomiso, a fin de que los miembros del Fideicomiso conozcan y resuelvan al respecto.', '2018-05-16 09:26:00', '000Ninguno', '2018-05-17 02:26:21', '2018-05-17 02:26:21', 10),
(62, 4, 'Del seguimiento realizado a Despacho, se nos informa que la reunión prevista entre el Director del SRI y la señora Ministra está programada para el día lunes 21 de mayo de 2018 y se ha solicitado al Coordinador que en la reunión se trate también la urgencia de contar con la información requerida al SRI para efectos de aplicar la metodología de validación del VAN.', '2018-05-16 09:28:00', '000Ninguno', '2018-05-17 02:28:00', '2018-05-17 02:28:00', 10),
(63, 63, 'Para brindar una mejor atención a los productores, el Ministerio de Agricultura y Ganadería instaló  las Unidades de Asistencia Técnica (UAT),  que son espacios físicos desde donde se brinda servicios en al ámbito agrícola y pecuario a los productores en las diferentes parroquias. Tungurahua cuenta con 28 técnicos. \r\nPara facilitar la atención, en cada UAT se ha instalado  una cartelera dónde se detalla la información de contacto de los técnicos agrícola y pecuario con la finalidad de que puedan brindar una atención eficaz en territorio, además se informa la planificación semanal de actividades del equipo técnico y los sectores a intervenir. El horario de atención en oficina del 08h00 a 09h00 y visitas a fincas de productores y capacitaciones de 09:00 a 17:00.', '2018-05-23 01:22:00', '000Ninguno', '2018-05-23 18:22:44', '2018-05-23 18:22:44', 11),
(64, 64, 'Para potenciar el agro, el MAG ejecuta la Gran Minga Agropecuaria, a través de la intervención en el campo con servicios financieros y servicios no financieros.\r\nLa sostenibilidad del concepto minga se garantiza con la articulación del MAG con BanEcuador. Cada crédito es un auto empleo para 2,8 personas.\r\nEn el área de la mecanización el MAG ha aportado mediante la entrega de 1.942 motocultores, 94 tractores a las asociaciones y la creación de 55 centros de servicios integrados de mecanización agrícola. Se suma la dotación de 56 trilladoras de granos estacionarias, 200 sembradoras manuales, 730 bombas electrostáticas y 11 ensacadoras de granos, favoreciendo a más de 15 mil pequeños y medianos productores de arroz, maíz, caña de azúcar y cereales, quienes eran los más afectados por el déficit de maquinaria. A más de esto se da acompañamiento técnico por parte de la Dirección de Mecanización Agrícola del  MAG. En el caso de Loja, que hace referencia la nota, se ha entregado, desde mayo del 2017 a mayo del 2018, 381 motocultores que beneficiaron  a 960 productores de la provincia.', '2018-05-23 01:39:00', '000Ninguno', '2018-05-23 18:39:05', '2018-05-23 18:39:05', 11),
(65, 65, 'Se procedió a retirar el video de las redes sociales.', '2018-05-23 02:15:00', '000Ninguno', '2018-05-23 19:15:23', '2018-05-23 19:15:23', 11),
(66, 66, 'El Ministro Rubén Flores  envió  cartas a los directivos de las industrias avícolas, piladoras de arroz y exportadoras de banano, informándoles que se realizará un control interinstitucional para hacer respetar los precios determinados en los acuerdos ministeriales respectivos, con la finalidad de garantizar la actividad de los productores agrícolas, sobre todo, de los pequeños.', '2018-05-23 02:18:00', '000Ninguno', '2018-05-23 19:18:15', '2018-05-23 19:18:15', 11),
(67, 67, 'A través de los nueve ejes de la Gran Minga Nacional Agropecuaria se potencia al agro mediante créditos, asistencia técnica, capacitación, mecanización  y se facilita la comercialización de los productos directamente entre el productor y consumidor para que de esta manera obtengan mayores ganancias.\r\nEl Ministerio de Agricultura y Ganadería, BanEcuador, y la Secretaría de Educación Superior, Ciencia, Tecnología e Innovación (Senescyt), firmaron el convenio de cooperación interinstitucional ‘Sembrando conocimiento para el futuro’ lo que permitirá que estudiantes universitarios tengan la oportunidad de generar servicios para el desarrollo agropecuario y de esta forma puedan integrarse en el desarrollo agropecuario, implementando sus propios emprendimientos.', '2018-05-23 02:22:00', '000Ninguno', '2018-05-23 19:22:08', '2018-05-23 19:22:08', 11),
(68, 1, 'Se está coordinando internamente la hoja de ruta con el fin de determinar la viabilidad del proyecto Reforma regulatoria que permita la aplicación de los activos intangibles como colateral de préstamo para su envío a la Superintendencia de Bancos para su consideración.', '2018-05-23 04:50:00', '000Ninguno', '2018-05-23 21:50:40', '2018-05-23 21:50:40', 11),
(69, 54, 'Se está coordinando con la CFN la convocatoria a la Junta del Fideicomiso Nro. 5 para la última semana del mes de mayo de 2018, en virtud de que la CFN no cuenta con un pronunciamiento por parte de la Gerencia General a las propuestas remitidas por el Mipro, respecto de la renegociación de los costos por honorarios de administración mensual del Fideicomiso, y de que los procesos de contratación sean ejecutados por la Fiduciaria. Los puntos del orden del día planteados para tratamiento en la referida junta son los siguientes: 1) Conocimiento y aprobación de la propuesta para que la Senescyt realice la gestión de selección y evaluación de los proyectos postulantes al Programa Emprendedores. 2) Conocimiento del estado de las propuestas presentadas respecto de que la Fiduciaria realice los procesos de contratación, y de la renegociación de los costos por honorarios de administración mensual del Fideicomiso, a fin de que los miembros del Fideicomiso conozcan y resuelvan al respecto. En adición, CFN reportó el cambio del administrador del Fideicomiso Fondo de Capital de Riesgo a partir del 17 de mayo de 2018 mediante oficio Nro. CFN-GRNF--2018-0864-OF.', '2018-05-23 04:52:00', '000Ninguno', '2018-05-23 21:52:46', '2018-05-23 21:52:46', 11),
(70, 4, 'La reunión prevista entre el Director del SRI y la señora Ministra se desarrolló el día lunes 21 de mayo de 2018, por delegación de ambas autoridades asisitieron Galo Maldonado y Juan Francisco Ballén, respectivamente. Se informa que el reglamente está en la Secretaría General de la Presidencia  y que esta llamará a cada entidad para la incorporación de las sugerencias pertinentes.', '2018-05-23 05:00:00', '000Ninguno', '2018-05-23 22:00:30', '2018-05-23 22:00:30', 11),
(71, 9, 'de 2018.', '2018-05-22 04:27:00', '000Ninguno', '2018-05-24 21:27:19', '2018-05-24 21:31:21', 12),
(72, 69, 'El departamento de Estadística del ECU911 comparte a la Dirección de Riesgos de este Ministerio, el registro de eventos peligrosos que se suscitan y son una amenaza para el sector pesquero artesanal y acuícola. Esta información será analizada y se generarán los reportes correspondientes a marzo y abril de 2018.', '2018-05-22 04:30:00', '1527197449-Correo recibido ECU911 eventos maritimos.pdf', '2018-05-24 21:30:49', '2018-05-24 21:30:49', 12),
(73, 70, 'Difundir los logros alcanzados por la Gran Minga Agropecuaria como acciones realizadas por el ministro Rubén Flores, que demuestran que por su capacidad,  experiencia y trabajo, el Presidente de la República lo  mantiene al frente de la Cartera  de Agricultura y Ganadería.', '2018-05-30 01:09:00', '000Ninguno', '2018-05-30 18:09:11', '2018-05-30 18:09:11', 12),
(74, 71, 'Se han difundido los testimonios de los productores que mencionan la contribución del Ministerio de Agricultura y Ganadería al desarrollo agrario del país, allí expresan el respaldo a la gestión del Ministro Rubén Flores.', '2018-05-30 01:13:00', '000Ninguno', '2018-05-30 18:13:21', '2018-05-30 18:13:21', 12),
(75, 72, 'El Ministerio de Agricultura y Ganadería y el Ministerio de Trabajo  entregaron el Manual de Seguridad y Salud para la Industria Bananera a cientos de representantes y trabajadores del sector. Este insumo se elaboró en base a un consenso  entre Gobierno, empresa privada y sociedad civil para detectar necesidades del mercado, usuarios y trabajadores con los objetivos de cumplir con altos estándares de calidad que exige el sector bananero, además de precautelar los derechos humanos de los trabajadores y capacitar a más de 4 mil productores en la protección de sus trabajadores.', '2018-05-30 01:16:00', '000Ninguno', '2018-05-30 18:16:06', '2018-05-30 18:16:06', 12),
(76, 73, 'El MAG trabaja en el  “Plan Nacional de Lucha contra el contrabando\", en el que se articulan alrededor de 20 instituciones, formando un control de 24 horas en las fronteras, denominadas “Unidades Integradas de Control”.', '2018-05-30 01:20:00', '000Ninguno', '2018-05-30 18:20:03', '2018-05-30 18:20:03', 12),
(77, 68, 'El 28 de mayo del presente, la Ministra de Industrias y Productividad tuvo un acercamiento con el Ministro de Hidrocarburos para tratar, entre otros temas, sobre la notificación de terminación por mutuo Acuerdo del Convenio Marco entre SERCOP y Tenaris para la provisión de tubería petrolera.\r\n\r\nEl 29 de mayo del presente, el Subsecretario de Industrias Intermedias y Finales, mantuvo una reunión con los representantes de Tenaris, para preparar el encuentro entre las principales autoridades del MIPRO y el Ministerio de Hidrocarburos, que se daría en la segunda semana de junio del presente.', '2018-05-30 02:53:00', '000Ninguno', '2018-05-30 19:53:43', '2018-05-30 19:53:43', 12),
(78, 1, 'Conforme la reunión realizada el 03 de mayo de 2018 con la Superintendencia de Bancos (SB), y en virtud de lo dispuesto por la Junta de Política y Regulación Monetaria y Financiera de coordinar las acciones pertinentes con la SB para la generación de normativa relacionada con el sector financiero, la Directora de Financiamiento del MIPRO remite mediante correo electrónico a la Dirección Nacional de Riesgos de la SB el día 30.V.2018 la hoja de ruta del proyecto de reforma regulatoria que permita la aplicación de activos intangibles como colateral de préstamo para su consideración y revisión.', '2018-05-30 03:59:00', '000Ninguno', '2018-05-30 20:59:23', '2018-05-30 23:40:02', 12),
(79, 54, 'En virtud del pronunciamiento realizado por la Fiduciaria a la Directora de Financiamiento e Incentivos de esta Secretaría de Estado, en el sentido de que no es factible realizar la convocatoria para el día 30.05.2018, debido a que las propuestas presentadas por el Ministerio de Industrias y Productividad, para atender los puntos del orden del día planteados, se encuentran en análisis por parte de la Gerencia General de la Corporación Financiera Nacional B.P. (CFN), se está coordinando la convocatoria a la Junta del Fideicomiso Nro. 5 del Fondo de Capital de Riesgo para el día 5.06.2018 a las 15h00, a fin de tratar los dos puntos del orden del día planteados en las solicitudes anteriores en el caso de contar con toda la información correspondiente, o en su defecto se trate únicamente el primer punto del orden del día propuesto.', '2018-05-30 04:05:00', '000Ninguno', '2018-05-30 21:05:03', '2018-05-30 21:05:03', 12),
(80, 74, 'En base a la información proporcionada por el ECU911 sobre los eventos peligrosos para pescadores artesanales correspondientes al mes de marzo y abril de 2018, actualmente la Dirección de Riesgos Sectoriales está realizando un análisis de la información proporcionada y elaborando mapas de la distribución en base a la naturaleza de los mismos. Estos mapas son herramientas para la identificación de zonas críticas.\r\n\r\nCon base en la información resultante, se pondrá a disposición de los Gobernadores solicitando se convoque a los Comités de Seguridad para que se defina una planificación enfocada a reducir los índices de esta alerta.', '2018-05-29 04:24:00', '000Ninguno', '2018-05-30 21:24:33', '2018-05-30 21:24:33', 12),
(81, 4, 'Previamente se mantuvo diálogos con SRI, equipo técnico y máximas autoridades, solicitando la incorporación en el Reglamento a esta Ley un texto que ratifique la obligatoriedad del registro RPN en el MIPRO y así crear los medios para la aplicabilidad de los incentivos.\r\nTexto propuesto en reuniones técnicas: “En cuanto a la verificación y a efectos de control de la aplicación de los incentivos a procesos productivos con valor agregado nacional, Mipro será el ente encargado de receptar la solicitud de registro conforme sus lineamientos”.\r\nEn reunión desarrollada el 21 de mayo con la presencia de sus delegados, Galo Maldonado y Juan Francisco Ballén, respectivamente, se nos informa que el Reglamento a la Ley de Reactivación se encuentra en la Secretaría General de la Presidencia, la cual manifestó al SRI que llamarán a las distintas entidades relacionadas para que realicen sus aportes, por lo que se recomienda tomar contacto inmediato con el Francisco Rites.', '2018-05-30 06:45:00', '000Ninguno', '2018-05-30 23:45:05', '2018-05-30 23:45:05', 12),
(82, 4, 'De la reunión desarrollada entre el Director del SRI y la Sra. Ministra del MIPRO, el 21 de mayo con la presencia de sus delegados, Galo Maldonado y Juan Francisco Ballén, respectivamente, se nos informa que el SRI llamará a las distintas entidades relacionadas para que realicen sus aportes al Reglamento a la Ley de Reactivación.', '2018-05-30 07:40:00', '000Ninguno', '2018-05-31 00:40:16', '2018-05-31 00:40:16', 12),
(83, 68, '<p>El encuentro entre los representantes de la empresa TENARIS con las principales autoridades del MIPRO y el Ministerio de Hidrocarburos, preliminarmente se ha previsto realizar la tercera semana de junio del presente, acorde a la disponibilidad de la agenda del Ministro de Hidrocarburos.</p>', '2018-06-06 11:56:00', '000Ninguno', '2018-06-06 16:56:37', '2018-06-06 16:56:37', 13),
(84, 76, '<p>En base a la informaci&oacute;n proporcionada por el ECU911 sobre los eventos peligrosos para pescadores artesanales correspondientes a los meses de marzo y abril de 2018, la Direcci&oacute;n de Riesgos Sectoriales realiz&oacute; el an&aacute;lisis de la informaci&oacute;n proporcionada y elabor&oacute; los &ldquo;Mapas de eventos de inseguridad REPORTADOS POR EL ECU-911&rdquo; en las provincias de Esmeraldas, Guayas y El Oro; cabe indicar que estos mapas sirven de herramientas para la identificaci&oacute;n de zonas vulnerable en materia de seguridad.</p>\r\n\r\n<p>Con la informaci&oacute;n depurada y consolidada se prev&eacute; convocar a los Gobernadores y sus delegados a la reuni&oacute;n del Comit&eacute; de Seguridad para que se defina una planificaci&oacute;n enfocada a reducir los &iacute;ndices de esta alerta.</p>', '2018-06-06 03:07:00', '000Ninguno', '2018-06-06 20:07:49', '2018-06-06 20:07:49', 13),
(85, 62, '<p>Mediante correo electr&oacute;nico de 31 de mayo de 2018, &nbsp;el Subsecretario de MIPYMES y Artesan&iacute;as, como miembro del Comit&eacute; T&eacute;cnico del programa Exporta F&aacute;cil, conforme a lo se&ntilde;alado en el &quot;Reglamento para Comit&eacute; T&eacute;cnico para el servicio de exportaci&oacute;n por v&iacute;a postal denominado Exporta F&aacute;cil&quot;, aprobado el 16 de septiembre de 2016, en sus art&iacute;culos 3 y 4, expres&oacute; a la Gerente General de la Empresa P&uacute;blica Correos del Ecuador y a los se&ntilde;ores miembros del comit&eacute;, la preocupaci&oacute;n por la situaci&oacute;n actual del Programa, considerando que desde el a&ntilde;o 2015 se ha registrado un decrecimiento en las estad&iacute;sticas del mismo.</p>\r\n\r\n<p>Record&oacute; que como una de las estrategias para mejorar las cifras en exportaciones, el Comit&eacute; Interinstitucional del Exporta F&aacute;cil decidi&oacute; implementar mejoras en el portal y la plataforma para el efecto, las mismas que se llevaron a cabo con &eacute;xito y cuyo fin era socializarlas desde el a&ntilde;o 2017, entre usuarios que abandonaron el servicio y potenciales nuevos exportadores. Sin embargo, hasta la presente fecha no se ha podido iniciar con esta actividad debido a los constantes reclamos que se han recibido por los actuales usuarios, en relaci&oacute;n a las demoras por parte de Correos del Ecuador sobre los tiempos de tr&aacute;nsito, que oscilan entre 38 hasta 60 d&iacute;as en el servicio prioritario EMS Exporta F&aacute;cil, los mismos que superan incluso los plazos m&aacute;s amplios programados para el servicio Certificado Exporta F&aacute;cil.</p>\r\n\r\n<p>Adem&aacute;s, se&ntilde;al&oacute; casos puntuales como el de la se&ntilde;ora Luc&iacute;a Delgado (Otavalo) y del se&ntilde;or Javier Cevallos (Guayaquil), quienes al ser asesorados por esta Cartera de Estado en el funcionamiento de la plataforma del programa, han solicitado la intervenci&oacute;n del Ministerio de Industrias y Productividad para subsanar los inconvenientes presentados con los servicios de Correos del Ecuador, raz&oacute;n por la cual la Subsecretar&iacute;a de Mipymes y Artesan&iacute;as del Ministerio de Industrias y Productividad, dentro de los eventos, ferias, ruedas de negocios, etc. que organiza, ha asignado un stand para la Empresa P&uacute;blica Correos del Ecuador a fin de que se difunda el servicio Exporta F&aacute;cil; sin embargo, se ha evaluado limitar el inicio de las socializaciones masivas, mientras no se resuelvan los problemas operativos de Correos del Ecuador.</p>\r\n\r\n<p>Finalmente, solicit&oacute; al Ministerio de Comercio Exterior, en su calidad de Presidente, se convoque a una reuni&oacute;n extraordinaria del Comit&eacute; Interinstitucional del Exporta F&aacute;cil para que se informe sobre lo referido; y, se analicen las posibilidades de soluci&oacute;n.</p>', '2018-06-06 07:27:00', '1528331258-Asunto Correo Electrónico PROGRAMA EXPORTA FÁCIL.pdf', '2018-06-07 00:27:38', '2018-06-07 00:27:38', 13),
(86, 4, '<p style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\">Se remiti&oacute; a la CGJ mediante correo de fecha 31 de mayo de 2018, la propuesta de texto para el Reglamento de Ley de Reactivaci&oacute;n de la Econom&iacute;a y Fortalecimiento de la Dolarizaci&oacute;n. As&iacute; mismo, se remiti&oacute; a la CGSP mediante correo de fecha 28 de mayo de 2018, las observaciones y sugerencias a considerar en la propuesta de Ley Org&aacute;nica para el Fomento Productivo, Atracci&oacute;n de Inversiones, Generaci&oacute;n de Empleo, y Estabilidad y Equilibrio Fiscal.</p>', '2018-06-06 07:29:00', '000Ninguno', '2018-06-07 00:29:46', '2018-06-07 00:29:46', 13),
(87, 1, '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\">El 05.VI.2018 la Directora Nacional de Riesgos de la Superintendencia de Bancos comunic&oacute; mediante correo electr&oacute;nico a esta Secretar&iacute;a de Estado que se encuentran revisando el cronograma enviado, el cual incluye las acciones a ejecutar de forma conjunta a fin de viabilizar el proyecto de reforma regulatoria que permita la aplicaci&oacute;n de activos intangibles como colateral de pr&eacute;stamo, dichas&nbsp;observaciones ser&aacute;n remitidas el d&iacute;a 06. VI.2018.</span></p>', '2018-06-06 07:46:00', '000Ninguno', '2018-06-07 00:46:06', '2018-06-07 00:46:06', 13),
(88, 54, '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium;\">El Ministerio de Industrias y Productividad (Mipro) posterga la Junta del Fideicomiso Nro. 5 del Fondo de Capital de Riesgo con el prop&oacute;sito de poder incluir otros temas que permitan que el Fideicomiso inicie operaciones lo m&aacute;s pronto, tales como la aprobaci&oacute;n del presupuesto anual del Fideicomiso, as&iacute; como los temas administrativos correspondientes a los honorarios y compras gubernamentales a cargo de la Fiduciaria. En consecuencia el Mipro solicitar&aacute; a la CFN en los pr&oacute;ximos d&iacute;as la convocatoria a la Junta del Fideicomiso No. 5 del Fondo de Capital de Riesgo.</span></p>', '2018-06-06 07:47:00', '000Ninguno', '2018-06-07 00:47:12', '2018-06-07 00:47:12', 13),
(89, 80, '<p>La emisi&oacute;n de la Norma para Organismos Evaluadores de la Conformidad emitido por Setec fue revisada en la Segunda Sesi&oacute;n Ordinaria del Comit&eacute; realizada el 22 de mayo de 2018, en la misma que, despu&eacute;s de la exposici&oacute;n realizada por la Directora del SAE en dicha reuni&oacute;n, el Comit&eacute; acord&oacute; convocar a reuni&oacute;n de trabajo t&eacute;cnico con la presencia de la Directora del Servicio de Acreditaci&oacute;n Ecuatoriano a fin de que se reconsidere lo actuado por el Comit&eacute; en la Primera Sesi&oacute;n Ordinaria del 2018. Atendiendo entre otras normas, a lo dispuesto en el art&iacute;culo 37 del C&oacute;digo Org&aacute;nico de la Econom&iacute;a Social de los Conocimientos, Creatividad e Innovaci&oacute;n que dispone:</p>\r\n\r\n<p><em>&ldquo;Certificaci&oacute;n de cualificaciones profesionales. La certificaci&oacute;n de cualificaciones profesionales es el reconocimiento p&uacute;blico de los conocimientos, habilidades y destrezas adquiridas por las personas de manera formal o no formal, luego del correspondiente proceso de evaluaci&oacute;n. La obligatoriedad de la certificaci&oacute;n de cualificaciones profesionales ser&aacute; establecida por la autoridad rectora del &aacute;mbito laboral y los efectos acad&eacute;micos ser&aacute;n definidos en coordinaci&oacute;n con los entes rectores de cada nivel de formaci&oacute;n. Estar&aacute;n habilitados para otorgar esta certificaci&oacute;n todas las entidades que se encuentren debidamente acreditadas conforme a las normas establecidas en este C&oacute;digo y las normas que rigen el Sistema Ecuatoriano de la Calidad&quot;</em>.</p>\r\n\r\n<p>El particular mediante oficio del 30 de mayo de 2018 remitido por Mipro a Setec fue ratificado, y conforme revisi&oacute;n de Acta del Comit&eacute; este acuerdo de la reuni&oacute;n t&eacute;cnica no fue considerado dentro de las resoluciones por lo que se est&aacute; remitiendo oficialmente la observaci&oacute;n sobre este particular.</p>', '2018-06-07 09:55:00', '000Ninguno', '2018-06-07 14:55:46', '2018-06-07 14:55:46', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_agenda_territorials`
--

CREATE TABLE `csp_agenda_territorials` (
  `id` int(10) UNSIGNED NOT NULL,
  `institucion_id` int(11) NOT NULL,
  `canton_id` int(11) NOT NULL,
  `tipo_agenda_id` int(11) NOT NULL,
  `tipo_impacto_id` int(11) NOT NULL,
  `periodo_agenda_id` int(11) NOT NULL,
  `descripcion_tipo_agenda` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_tipo_impacto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_agenda` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_comunicacional` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_agenda_territorials`
--

INSERT INTO `csp_agenda_territorials` (`id`, `institucion_id`, `canton_id`, `tipo_agenda_id`, `tipo_impacto_id`, `periodo_agenda_id`, `descripcion_tipo_agenda`, `descripcion_tipo_impacto`, `responsable`, `fecha_agenda`, `created_at`, `updated_at`, `tipo_comunicacional`, `lugar`) VALUES
(1, 2, 1, 1, 1, 1, 'q', '3', 'uno', '2018-04-07 15:30:00', '2018-04-06 20:35:42', '2018-04-06 20:35:42', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_periodo_agendas`
--

CREATE TABLE `csp_periodo_agendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `año` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `semana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semana_anio` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_periodo_agendas`
--

INSERT INTO `csp_periodo_agendas` (`id`, `año`, `mes`, `semana`, `fecha_inicio`, `fecha_final`, `created_at`, `updated_at`, `semana_anio`) VALUES
(1, 2018, 1, 'Semana 1', '2018-01-01 00:00:00', '2018-01-07 23:59:59', NULL, NULL, 1),
(2, 2018, 1, 'Semana 2', '2018-01-08 00:00:00', '2018-01-14 23:59:59', NULL, NULL, 2),
(3, 2018, 1, 'Semana 3', '2018-01-15 00:00:00', '2018-01-21 23:59:59', NULL, NULL, 3),
(4, 2018, 1, 'Semana 4', '2018-01-22 00:00:00', '2018-01-28 23:59:59', NULL, NULL, 4),
(5, 2018, 1, 'Semana 5', '2018-01-29 00:00:00', '2018-02-04 23:59:59', NULL, NULL, 5),
(6, 2018, 2, 'Semana 1', '2018-02-05 00:00:00', '2018-02-11 23:59:59', NULL, NULL, 6),
(7, 2018, 2, 'Semana 2', '2018-02-12 00:00:00', '2018-02-18 23:59:59', NULL, NULL, 7),
(8, 2018, 2, 'Semana 3', '2018-02-19 00:00:00', '2018-02-25 23:59:59', NULL, NULL, 8),
(9, 2018, 2, 'Semana 4', '2018-02-26 00:00:00', '2018-03-04 23:59:59', NULL, NULL, 9),
(10, 2018, 3, 'Semana 1', '2018-03-05 00:00:00', '2018-03-11 23:59:59', NULL, NULL, 10),
(11, 2018, 3, 'Semana 2', '2018-03-12 00:00:00', '2018-03-18 23:59:59', NULL, NULL, 11),
(12, 2018, 3, 'Semana 3', '2018-03-19 00:00:00', '2018-03-25 23:59:59', NULL, NULL, 12),
(13, 2018, 3, 'Semana 4', '2018-03-26 00:00:00', '2018-04-01 23:59:59', NULL, NULL, 13),
(14, 2018, 4, 'Semana 1', '2018-04-02 00:00:00', '2018-04-08 23:59:59', NULL, NULL, 14),
(15, 2018, 4, 'Semana 2', '2018-04-09 00:00:00', '2018-04-15 23:59:59', NULL, NULL, 15),
(16, 2018, 4, 'Semana 3', '2018-04-16 00:00:00', '2018-04-22 23:59:59', NULL, NULL, 16),
(17, 2018, 4, 'Semana 4', '2018-04-23 00:00:00', '2018-04-29 23:59:59', NULL, NULL, 17),
(18, 2018, 4, 'Semana 5', '2018-04-30 00:00:00', '2018-05-06 23:59:59', NULL, NULL, 18),
(19, 2018, 5, 'Semana 1', '2018-05-07 00:00:00', '2018-05-13 23:59:59', NULL, NULL, 19),
(20, 2018, 5, 'Semana 2', '2018-05-14 00:00:00', '2018-05-20 23:59:59', NULL, NULL, 20),
(21, 2018, 5, 'Semana 3', '2018-05-21 00:00:00', '2018-05-27 23:59:59', NULL, NULL, 21),
(22, 2018, 5, 'Semana 4', '2018-05-28 00:00:00', '2018-06-03 23:59:59', NULL, NULL, 22),
(23, 2018, 6, 'Semana 1', '2018-06-04 00:00:00', '2018-06-10 23:59:59', NULL, NULL, 23),
(24, 2018, 6, 'Semana 2', '2018-06-11 00:00:00', '2018-06-17 23:59:59', NULL, NULL, 24),
(25, 2018, 6, 'Semana 3', '2018-06-18 00:00:00', '2018-06-24 23:59:59', NULL, NULL, 25),
(26, 2018, 6, 'Semana 4', '2018-06-25 00:00:00', '2018-07-01 23:59:59', NULL, NULL, 26),
(27, 2018, 7, 'Semana 1', '2018-07-02 00:00:00', '2018-07-08 23:59:59', NULL, NULL, 27),
(28, 2018, 7, 'Semana 2', '2018-07-09 00:00:00', '2018-07-15 23:59:59', NULL, NULL, 28),
(29, 2018, 7, 'Semana 3', '2018-07-16 00:00:00', '2018-07-22 23:59:59', NULL, NULL, 29),
(30, 2018, 7, 'Semana 4', '2018-07-23 00:00:00', '2018-07-29 23:59:59', NULL, NULL, 30),
(31, 2018, 7, 'Semana 5', '2018-07-30 00:00:00', '2018-08-05 23:59:59', NULL, NULL, 31),
(32, 2018, 8, 'Semana 1', '2018-08-06 00:00:00', '2018-08-12 23:59:59', NULL, NULL, 32),
(33, 2018, 8, 'Semana 2', '2018-08-13 00:00:00', '2018-08-19 23:59:59', NULL, NULL, 33),
(34, 2018, 8, 'Semana 3', '2018-08-20 00:00:00', '2018-08-26 23:59:59', NULL, NULL, 34),
(35, 2018, 8, 'Semana 4', '2018-08-27 00:00:00', '2018-09-02 23:59:59', NULL, NULL, 35),
(36, 2018, 9, 'Semana 1', '2018-09-03 00:00:00', '2018-09-09 23:59:59', NULL, NULL, 36),
(37, 2018, 9, 'Semana 2', '2018-09-10 00:00:00', '2018-09-16 23:59:59', NULL, NULL, 37),
(38, 2018, 9, 'Semana 3', '2018-09-17 00:00:00', '2018-09-23 23:59:59', NULL, NULL, 38),
(39, 2018, 9, 'Semana 4', '2018-09-24 00:00:00', '2018-09-30 23:59:59', NULL, NULL, 39),
(40, 2018, 10, 'Semana 1', '2018-10-01 00:00:00', '2018-10-07 23:59:59', NULL, NULL, 40),
(41, 2018, 10, 'Semana 2', '2018-10-08 00:00:00', '2018-10-14 23:59:59', NULL, NULL, 41),
(42, 2018, 10, 'Semana 3', '2018-10-15 00:00:00', '2018-10-21 23:59:59', NULL, NULL, 42),
(43, 2018, 10, 'Semana 4', '2018-10-22 00:00:00', '2018-10-28 23:59:59', NULL, NULL, 43),
(44, 2018, 10, 'Semana 5', '2018-10-29 00:00:00', '2018-11-04 23:59:59', NULL, NULL, 44),
(45, 2018, 11, 'Semana 1', '2018-11-05 00:00:00', '2018-11-11 23:59:59', NULL, NULL, 45),
(46, 2018, 11, 'Semana 2', '2018-11-12 00:00:00', '2018-11-18 23:59:59', NULL, NULL, 46),
(47, 2018, 11, 'Semana 3', '2018-11-19 00:00:00', '2018-11-25 23:59:59', NULL, NULL, 47),
(48, 2018, 11, 'Semana 4', '2018-11-26 00:00:00', '2018-12-02 23:59:59', NULL, NULL, 48),
(49, 2018, 12, 'Semana 1', '2018-12-03 00:00:00', '2018-12-09 23:59:59', NULL, NULL, 49),
(50, 2018, 12, 'Semana 2', '2018-12-10 00:00:00', '2018-12-16 23:59:59', NULL, NULL, 50),
(51, 2018, 12, 'Semana 3', '2018-12-17 00:00:00', '2018-12-23 23:59:59', NULL, NULL, 51),
(52, 2018, 12, 'Semana 4', '2018-12-24 00:00:00', '2018-12-30 23:59:59', NULL, NULL, 52),
(53, 2018, 12, 'Semana 5', '2018-12-31 00:00:00', '2019-01-06 23:59:59', NULL, NULL, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_periodo_reportes`
--

CREATE TABLE `csp_periodo_reportes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_periodo_reportes`
--

INSERT INTO `csp_periodo_reportes` (`id`, `nombre`, `fecha_inicio`, `fecha_final`, `created_at`, `updated_at`) VALUES
(1, 'Semana 11', '2018-03-08 00:00:00', '2018-03-14 23:59:59', NULL, NULL),
(2, 'Semana 12', '2018-03-15 00:00:00', '2018-03-21 23:59:59', NULL, NULL),
(3, 'Semana 13', '2018-03-22 00:00:00', '2018-03-28 23:59:59', NULL, NULL),
(4, 'Semana 14', '2018-03-29 00:00:00', '2018-04-04 23:59:59', NULL, NULL),
(5, 'Semana 15', '2018-04-05 00:00:00', '2018-04-11 23:59:59', NULL, NULL),
(6, 'Semana 16', '2018-04-12 00:00:00', '2018-04-18 23:59:59', NULL, NULL),
(7, 'Semana 17', '2018-04-19 00:00:00', '2018-04-25 23:59:59', NULL, NULL),
(8, 'Semana 18', '2018-04-26 00:00:00', '2018-05-02 23:59:59', NULL, NULL),
(9, 'Semana 19', '2018-05-03 00:00:00', '2018-05-09 23:59:59', NULL, NULL),
(10, 'Semana 20', '2018-05-10 00:00:00', '2018-05-16 23:59:59', NULL, NULL),
(11, 'Semana 21', '2018-05-17 00:00:00', '2018-05-23 23:59:59', NULL, NULL),
(12, 'Semana 22', '2018-05-24 00:00:00', '2018-05-30 23:59:59', NULL, NULL),
(13, 'Semana 23', '2018-05-31 00:00:00', '2018-06-06 23:59:59', NULL, NULL),
(14, 'Semana 24', '2018-06-07 00:00:00', '2018-06-13 23:59:59', NULL, NULL),
(15, 'Semana 25', '2018-06-14 00:00:00', '2018-06-20 23:59:59', NULL, NULL),
(16, 'Semana 26', '2018-06-21 00:00:00', '2018-06-27 23:59:59', NULL, NULL),
(17, 'Semana 27', '2018-06-28 00:00:00', '2018-07-04 23:59:59', NULL, NULL),
(18, 'Semana 28', '2018-07-05 00:00:00', '2018-07-11 23:59:59', NULL, NULL),
(19, 'Semana 29', '2018-07-12 00:00:00', '2018-07-18 23:59:59', NULL, NULL),
(20, 'Semana 30', '2018-07-19 00:00:00', '2018-07-25 23:59:59', NULL, NULL),
(21, 'Semana 31', '2018-07-26 00:00:00', '2018-08-01 23:59:59', NULL, NULL),
(22, 'Semana 32', '2018-08-02 00:00:00', '2018-08-08 23:59:59', NULL, NULL),
(23, 'Semana 33', '2018-08-09 00:00:00', '2018-08-15 23:59:59', NULL, NULL),
(24, 'Semana 34', '2018-08-16 00:00:00', '2018-08-22 23:59:59', NULL, NULL),
(25, 'Semana 35', '2018-08-23 00:00:00', '2018-08-29 23:59:59', NULL, NULL),
(26, 'Semana 36', '2018-08-30 00:00:00', '2018-09-05 23:59:59', NULL, NULL),
(27, 'Semana 37', '2018-09-06 00:00:00', '2018-09-12 23:59:59', NULL, NULL),
(28, 'Semana 38', '2018-09-13 00:00:00', '2018-09-19 23:59:59', NULL, NULL),
(29, 'Semana 39', '2018-09-20 00:00:00', '2018-09-26 23:59:59', NULL, NULL),
(30, 'Semana 40', '2018-09-27 00:00:00', '2018-10-03 23:59:59', NULL, NULL),
(31, 'Semana 41', '2018-10-04 00:00:00', '2018-10-10 23:59:59', NULL, NULL),
(32, 'Semana 42', '2018-10-11 00:00:00', '2018-10-17 23:59:59', NULL, NULL),
(33, 'Semana 43', '2018-10-18 00:00:00', '2018-10-24 23:59:59', NULL, NULL),
(34, 'Semana 44', '2018-10-25 00:00:00', '2018-10-31 23:59:59', NULL, NULL),
(35, 'Semana 45', '2018-11-01 00:00:00', '2018-11-07 23:59:59', NULL, NULL),
(36, 'Semana 46', '2018-11-08 00:00:00', '2018-11-14 23:59:59', NULL, NULL),
(37, 'Semana 47', '2018-11-15 00:00:00', '2018-11-21 23:59:59', NULL, NULL),
(38, 'Semana 48', '2018-11-22 00:00:00', '2018-11-28 23:59:59', NULL, NULL),
(39, 'Semana 49', '2018-11-29 00:00:00', '2018-12-05 23:59:59', NULL, NULL),
(40, 'Semana 50', '2018-12-06 00:00:00', '2018-12-12 23:59:59', NULL, NULL),
(41, 'Semana 51', '2018-12-13 00:00:00', '2018-12-19 23:59:59', NULL, NULL),
(42, 'Semana 52', '2018-12-20 00:00:00', '2018-12-26 23:59:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_reportes_alertas`
--

CREATE TABLE `csp_reportes_alertas` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado_reporte_id` int(11) NOT NULL,
  `institucion_id` int(11) NOT NULL,
  `fecha_atencion` datetime NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `riesgo_principal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anexo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `periodo_id` int(11) NOT NULL,
  `tipo_comunicacional` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solucion_propuesta` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_reportes_alertas`
--

INSERT INTO `csp_reportes_alertas` (`id`, `estado_reporte_id`, `institucion_id`, `fecha_atencion`, `tema`, `descripcion`, `riesgo_principal`, `fuente`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`, `solucion_propuesta`) VALUES
(1, 2, 3, '2018-01-01 11:10:00', 'Falta de normativa que permita que las IFIS acepten y viabilicen el uso de activos intangibles como colateral de crédito', 'Se requerie el pronunciamiento favorable por parte del Presidente de la Junta de Política y Regulación Monetaria y Financiera, sobre el procedimiento a seguir para la reforma regulatoria sobre el valor de los intangibles en las garantías de préstamos dada la normativa vigente.', 'Incertidumbre de la decisión de la Junta de Política y Regulación Monetaria y Financiera respecto de la aplicación de la reforma a la normativa propuesta, misma que permitiría acoger los intangibles como colaterales de préstamos.', 'Denis Zurita', '000Ninguno', '2018-03-14 04:10:03', '2018-03-14 04:10:03', 1, '', ''),
(2, 1, 3, '2017-12-06 11:11:00', 'Falta de normativa que permita que los recursos públicos destinados para los programas de capital semilla y capital de riesgo sean considerados por los entes de control como recursos con alta probabilidad de pérdida', 'Se requiere la expedición de un reglamento específico para la aplicación de lo prescrito en el Código Orgánico de la Economía Social de los Conocimientos, Creatividad e Innovación (COESCCI), respecto del capítulo de incentivos financieros para la innovación social, normando lo referente a la regulación y control, por los entes competentes, sobre la entrega de recursos públicos para los programas de financiamiento de capital semilla y capital de riesgo, o en su defecto que sea mediante Decreto Ejecutivo la expedición de la norma necesaria.', 'Responsabilidades de todos los funcionarios que participen en el proceso de entrega de fondos públicos sin el sustento normativo adecuado.', 'Denis Zurita', '000Ninguno', '2018-03-14 04:11:44', '2018-04-25 19:13:59', 1, '', ''),
(3, 2, 3, '2018-03-01 09:42:00', 'Gremios de transporte solicitan la liberación de 24.000 neumáticos', 'El 1° de marzo los titulares de las carteras de Economía y Finanzas, Transportes y Obras Públicas, e Industrias y Productividad, llevaron a cabo una reunión interinstitucional en la que acordaron tramitar el pedido de liberación de 24.000 neumáticos realizado por los gremios de transporte ante el pleno del COMEX. El pedido aún no ha sido atendido.', 'Los gremios de transporte podrían tomar nuevas medidas de presión.', 'Subsecretaría de Industrias Intermedias y Finales', '1521063767-MIPRO-SIIF-2018-0127-OF.pdf', '2018-03-15 02:42:47', '2018-03-15 02:42:47', 1, '', ''),
(4, 2, 3, '2018-03-21 08:33:00', 'Aplicación del valor agregado nacional para la Ley de reactivación', 'El Reglamento para la aplicación de la Ley de Reactivación Económica, en lo referente a procesos productivos con valor agregado nacional, requiere la aplicación del Registro de Producción Nacional (RPN) del Mipro para su aplicabilidad.\r\nSRI no tiene las facultades de realizar verificación de procesos productivos, el ente rector es el Mipro.', 'El no registro de la producción nacional para este caso implicaría incumplimiento de la normativa, y la falta de definición de mecanismos podría dificultar el uso de los incentivos y por ende reducir el margen de aplicabilidad deseado.', 'Coordinación General de Servicios, Denis Zurita', '000Ninguno', '2018-03-22 01:33:33', '2018-03-22 02:00:00', 2, '', 'Diálogo entre máximas autoridades Mipro-SRI, para lograr la incorporación en el Reglamento de la Ley de Reactivación Económica la obligatoriedad de aplicación del valor agregado nacional del Mipro.'),
(5, 2, 3, '2018-03-19 10:03:00', 'Gremios de transporte solicitan la liberación de 24.000 neumáticos', 'El 1° de marzo los titulares de las carteras de Economía y Finanzas, Transportes y Obras Públicas, e Industrias y Productividad, llevaron a cabo una reunión interinstitucional en la que acordaron tramitar el pedido de liberación de 24.000 neumáticos realizado por los gremios de transporte sector ante el pleno del COMEX. El pedido aún no ha sido atendido.', 'Los gremios de transporte podrían tomar nuevas medidas de presión.', 'Subsecretaría de Industrias Intermedias y Finales', '000Ninguno', '2018-03-22 03:03:07', '2018-03-22 03:03:07', 2, '', 'Solución Propuesta:\r\nLlevar a cabo una Mesa de Negociación con los gremios/federaciones de transporte y carteras de estado involucradas.\r\n\r\nAcciones emprendidas para solucionar esta alerta: \r\nSe han realizado acercamientos con el Ministerio y Viceministerio de Economía y Finanzas para dar solución a la alerta.\r\nPara la Mesa de Negociación, Contiental Tire considera que aún no participe el MIPRO, con el afán de iniciar y determinar la factibilidad de negocio con cada una de ellas. Posteriormente, a medida que avance el nivel de interés por llegar a un acuerdo, se formalizaría una petición de apoyo por parte del MIPRO para los\r\nefectos pertinentes.'),
(6, 2, 1, '2018-03-23 06:07:00', 'Asambleísta Héctor Yépez solicita comparecencia de MAG, UNA y BanEcuador a Asamblea', 'El asambleísta independiente Héctor Yépez consideró que, debido a los problemas que enfrenta el sector agrícola del país, deben comparecer ante la Asamblea el Ministro de Agricultura y Ganadería, Rubén Flores; el gerente de BanEcuador, Santiago Campos, y el gerente de la UNA-EP, Paulo Proaño. Pidió que la Asamblea no entre en la vacancia legislativa, sino que vaya el ministro Flores a explicar cómo se va a resolver la crisis de los arroceros.', 'Ya se acercan las nuevas cosechas del producto y si no se concreta el pago a los agricultores, éstos continuarán con manifestaciones y cierre de vías; además se debe verificar la capacidad física de almacenamiento para recibir la nueva cosecha del producto.', 'Los Desayunos de 24 Horas, Teleamazonas', '000Ninguno', '2018-03-28 23:07:25', '2018-03-28 23:08:57', 3, '', 'Permanecer alertas para conocer con exactitud a qué comisión sería llamado el Ministro, así como preparar toda la información respectiva para mostrar el trabajo efectuado.'),
(7, 2, 1, '2018-03-23 06:12:00', 'Aumenta producción de plátano y baja el precio', 'Los productores de plátano barraganete de exportación de El Carmen (Manabí) y de Santo Domingo de los Tsáchilas protestan porque se les compra a menor precio la caja de 52 libras. El año pasado les pagaban USD 8,30, pero desde enero bajó a entre USD 3 y 5, cuando el precio oficial es USD 7,30.', 'La falta de control de precios puede generar especulación así como insatisfacción hacia los productores.', 'http://www.elcomercio.com/actualidad/platano-sobreproduccion-precio-exportacion-ecuador.html', '000Ninguno', '2018-03-28 23:12:17', '2018-03-28 23:12:17', 3, '', 'Realizar operativos para verificar que los pagos sean los justos.'),
(8, 2, 1, '2018-03-27 06:15:00', 'Campesinos solicitan mayor atención en el sector agropecuario', 'El 27 de marzo de 2018, agricultores se congregaron en Guayaquil para exigir que el Ejecutivo pague la deuda que dicen que se mantiene con el agro. Abel Navas, productor de arroz, manifestó que los agricultores piden reunirse con el Presidente de la República', 'Cierre de vías de acceso y congestión para libre circulación vehicular particular y de comercio.', 'http://radiohuancavilca.com.ec/noticias/2018/03/26/audio-campesinos-solicitan-mayor-atencion-en-el-sector-agropecuario/', '000Ninguno', '2018-03-28 23:15:00', '2018-03-28 23:15:00', 3, '', 'Coordinar reuniones con los productores para explicarles el trabajo que se realiza desde el Ministerio de Agricultura y Ganadería, y BanEcuador.'),
(9, 2, 2, '2018-03-27 10:29:00', 'Delincuencia: Alto índice de delincuencia que afecta al sector camaronero y pesquero', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', 'Pescadores afectados no denuncien casos de robos, no permitiendo conocer la magnitud real del impacto de los ilícitos.', 'N/A', '000Ninguno', '2018-03-30 03:29:41', '2018-03-30 03:29:41', 4, '', 'Se ha definido una metodología de identificar los eventos antrópicos y naturales de los sectores acuícola y pesquero del país. Esta información será remitida cada fin de mes por parte del ECU 911, para que el MAP genere los mapas temáticos que faciliten el análisis de las variables identificadas.'),
(10, 2, 1, '2018-03-28 07:51:00', 'Sector lechero advierte con levantamiento', 'Productores lecheros de Azuay, Cañar, Tungurahua, Bolívar y Chimborazo desde ayer se declararon en sesión permanente hasta que el Gobierno atienda sus necesidades, como el alto costo de producción y el precio que reciben por cada litro de leche que venden. Exigen que se declare en emergencia nacional al sector productor lechero del país, porque afirman que enfrenta una crítica situación económica. Plantean al Ministro de Agricultura, Rubén Flores, la intervención inmediata y el control al sector industrial, centros de acopio y plantas procesadoras de lácteos en general. Exhortan a que se lidere un trabajo interinstitucional para que “se evidencie un control sobre el ingreso ilegal de leche y productos lácteos al Ecuador”.', 'Si no se realiza un acercamiento a los productores lecheros para buscar una solución a sus demandas, mas el malestar que los mismos han pronunciado respecto al supuesto contrabando de leche en polvo, fundamentalmente, que estaría ingresando ilegalmente al Ecuador, se presentarían situaciones de contrabando y especulación los cuales representarían una problemática para el sector productivo.', 'https://ww2.elmercurio.com.ec/2018/03/28/sector-lechero-advierte-con-levantamiento/', '000Ninguno', '2018-04-05 00:51:10', '2018-04-05 00:51:10', 4, '', 'Desde el Ministerio de Agricultura y Ganadería se impulsó un Acuerdo Interministerial para controlar y regular la producción de leche y derivados, incluido el suero de leche. Firmaron el documento, ante los medios de comunicación, los ministerios de Industrias y Productividad (Mipro); Agricultura y Ganadería (MAG); Salud Pública (MSP) y Defensa Nacional, además del Servicio de Aduana del Ecuador (Senae) y la Superintendencia de Control del Poder del Mercado'),
(11, 2, 1, '2018-03-29 07:56:00', 'Agricultores piden respuestas', 'Reunidos en el sector ‘La Seca’, del cantón Daule, provincia de Guayas, los productores manifestaron su preocupación por la sobreproducción de arroz, falta de control en las fronteras que permiten el ingreso de alimentos de otros países y la deuda que mantiene la Unidad Nacional de Almacenamiento (UNA EP) con los campesinos. La tarde del 28 de marzo, los agricultores brindaron una rueda de prensa en la que se evidenciaron distintas posturas: unos proponen radicalizar las medidas de protesta, mientras otros dicen que las movilizaciones desestabilizan al país', 'Sin un diálogo permanente para atender las demandas presentadas de los agricultores, podría continuar las protestas de los mismos; lo que ocasionaría movilizaciones que a su vez causarían cierre de vías y problemas para comercialización de productos y/o servicios.', 'Noticiero de Ecuavisa', '000Ninguno', '2018-04-05 00:56:53', '2018-04-05 00:56:53', 4, '', 'Hacer seguimiento para identificar los posibles focos de nuevas protestas y mantener las reuniones de las autoridades del MAG con los representantes de los diferentes sectores productivos para ir evaluando el cumplimiento de las hojas de rut'),
(12, 2, 1, '2018-03-29 08:00:00', 'El MAG adeuda desde 2014 casi 27 millones a la UNA EP', 'Esta deuda impediría que la UNA EP regularice el pago a los agricultores por la compra de arroz. Un grupo de agricultores de arroz de Daule (CNC –Eloy Alfaro), señala que están impagos desde hace dos meses. “Un aproximado de 27 millones de dólares. Lo que yo debo a los agricultores es un millón de dólares”, expresó Paulo Proaño, gerente de la UNA EP, quien agregó que la entidad tiene capacidad en sus silos para seguir almacenando el producto.', 'Ya se acercan las nuevas cosechas del producto y si no se concreta el pago a los agricultores, éstos continuarán con manifestaciones y cierre de vías; además se debe verificar la capacidad física de almacenamiento para recibir la nueva cosecha del producto.', 'Noticiero Telediario', '000Ninguno', '2018-04-05 01:00:39', '2018-04-05 01:00:39', 4, '', 'Cancelación inicial de más de un millón de dólares y acuerdo para un pago programado del resto. Cabe aclarar que es una deuda heredada, generada entre 2012 y 2013.\r\n\r\nHay acuerdo para realizar un pago programado, y solicitud a la UNA EP de una estrategia de comercialización para que venda las más de 42 mil toneladas de arroz pilado que tiene almacenado en sus bodegas.'),
(13, 2, 1, '2018-04-02 08:05:00', 'En Carchi, los papicultores están en crisis por los precios bajos', 'Productores de papa en la provincia del Carchi afirman que están vendiendo el quintal de papa entre 6 y 15 dólares. Hay días en los que han vendido hasta e 5 dólares. Indican que sembrar una hectárea con el tubérculo representa una inversión entre 4 y 5 mil dólares, por lo que consideran un precio óptimo es de 15 dólares. Están preocupados porque se acerca la cosecha en Colombia, lo que generaría más sobreoferta, con la consecuente caída del precio.', 'La falta de atención a esta problemática de los papicultores, podría derivar en causales de contrabando, así también en protestas y manifestaciones .', 'http://www.elnorte.ec/carchi/tulcan/72771-carchi-papicultores-crisis-bajos-precios-papa.html)', '000Ninguno', '2018-04-05 01:05:06', '2018-04-05 01:05:06', 4, '', 'Reunión con los productores de papa, supuestamente, afectados para conocer los pormenores y definir las áreas a intervenir.'),
(14, 2, 2, '2018-04-03 08:08:00', 'DELINCUENCIA', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Demora de la convocatoria de la mesa de seguridad por parte de la institución con competencia en materia de seguridad.', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '1522872527-Acciones Realizadas de la Alerta.docx', '2018-04-05 01:08:47', '2018-04-05 01:08:47', 4, '', 'Se ha definido una metodología de identificar los eventos antrópicos y naturales de los sectores acuícola y pesquero del país. Esta información será remitida cada fin de mes por parte del ECU 911, para que el MAP genere los mapas temáticos que faciliten el análisis de las variables identificadas.'),
(15, 2, 1, '2018-04-03 08:09:00', 'El cadmio amenaza al sector cacaotero', 'Europa abrió el año pasado su mercado a Ecuador al eliminar las barreras arancelarias, pero dos años después pondrá una barrera para detener a uno de sus productos emblema: el cacao. Lo hará en 2019, con una restricción sanitaria: exigir niveles bajos de cadmio, un metal pesado que provocaría problemas de salud en quienes lo consumen. Este mes, la ICCO y la Unión Europea analizarán esta norma técnica para poder ver cómo se la hace más “laxa y flexible”, resalta el ministro.', 'El cacao es un producto emblemático para nuestro país, por eso se debe continuar con el diálogo y negociaciones diplomáticas para evitar una barrera arancelaria al mismo.', 'http://www.expreso.ec/economia/comercio-cacao-agricultura-cadmio-exportaciones-LH2108904)', '000Ninguno', '2018-04-05 01:09:42', '2018-04-05 01:09:42', 4, '', 'Reunión con los actores involucrados en la cadena productiva de cacao para analizar la presencia del cadmio, así como preparar una estrategia conjunta para presentarla en la Conferencia Mundial del Cacao de ICCO.'),
(16, 2, 1, '2018-04-03 08:25:00', 'Organizaciones sociales anuncian movilizaciones hacia Carondelet', 'La Confederación de Nacionalidades Indígenas del Ecuador, la Coordinadora Campesina Eloy Alfaro, la Confederación Nacional de Organizaciones Campesinas, Indígenas y Negras anuncian que este mes efectuarán movilizaciones hacia el Palacio de Gobierno en reclamo a supuestos incumplimientos. Entre ellos constan pedidos para el sector agrícola y pecuario.', 'La falta de seguimiento a los compromisos concebidos, así como la falta de negociaciones a los pedidos de las organizaciones podrían causar alejamiento y falta de apoyo al gobierno por parte de las organizaciones y malestar a la ciudadanía respecto al cierre de vías, así como altercados entre los manifestantes y los cuerpos de orden.', 'http://www.teleradio.com.ec/organizaciones-se-encaminan-a-carondelet-para-pedir-al-gobierno-concreciones-con-respecto-a-los-ofrecimientos/', '000Ninguno', '2018-04-05 01:25:35', '2018-04-05 01:25:35', 4, '', 'Mantener reuniones con los dirigentes relacionados al sector agropecuario para analizar conjuntamente los avances de los compromisos.'),
(18, 2, 1, '2018-04-05 05:00:00', 'Arroceros levantan protesta en Tarifa', 'Con caballos y camiones, más de 200 productores de arroz en el sector de Tarifa, cantón Samborondón, protestaron por los bajos precios de la gramínea. Su objetivo era llegar hasta el puente de la Unidad Nacional para bloquear el paso de los vehículos. Los productores aseguran que en la actualidad el precio del arroz  fluctúa entre 20 y 27 dólares, cuando el precio mínimo de sustentación es de 35,50 dólares la saca de 200 libras. Afirman que hay agricultores endeudados con los bancos.', 'Multiplicación de protestas por parte de los productores.', 'https://www.eltelegrafo.com.ec/noticias/economia/4/arroceros-tarifa-dialogo-lenin-moreno', '000Ninguno', '2018-04-11 22:00:38', '2018-04-11 22:14:29', 5, '', 'El Ministerio de Agricultura y Ganadería organizó una mesa de diálogo con dirigentes agrícolas, a quienes se les explicó los procesos implementados para  que la UNA EP cumpla con el pago a los productores de arroz, así como una modificación al reglamento para ejercer mayor control a las piladoras.'),
(19, 2, 1, '2018-04-06 05:12:00', 'Lecheros insisten en la declaratoria de emergencia.', 'Delegados de las comunidades lecheras del Azuay y representantes de las provincias de El Oro, Chimborazo y Cañar se reunirán este 7 de abril,  en la casa comunal de Girón, para continuar con el proceso de declarar a su sector en estado de emergencia en todo el país. \r\nSantiago Malo, presidente de la Cámara de Agricultura III Zona y representante del sector lechero en la provincia, señaló que esta nueva convocatoria busca sensibilizar a las autoridades sobre la falta de centros de acopio y la negativa de las industrias de lácteos a recibirles la leche.\r\nIndicó que tienen reparos al acuerdo interministerial 36, para controlar el uso de suero, los que han sido entregados al Gobernador de la provincia.', 'El problema principal es que el mercado no absorba la producción de leche, generando dificultad en el acopio.', 'http://www.eltiempo.com.ec/noticias/region/12/432394/lecheros-insisten-en-la-declaratoria-de-emergencia', '000Ninguno', '2018-04-11 22:12:20', '2018-04-11 22:12:20', 5, '', 'Seis ministerios firmaron el Acuerdo Interministerial 36, para regular y controlar la producción de derivados lácteos, incluido el suero de leche.'),
(20, 2, 1, '2018-04-11 05:19:00', 'Agricultores se reúne hoy para analizar su situación actual', 'Los distintos gremios agrícolas se reúnen para exigir al Gobierno Nacional mejoras en las políticas públicas, dada la ausencia de apoyo al sector. Según los productores, están no solo olvidados sino a punto de quebrar sus negocios o empresas. El acto se realizará en la parroquia La Unión, perteneciente al cantón Quinindé, provincia de Esmeraldas. Participarán palmicultores, cacaoteros, arroceros, maiceros, bananeros y demás sectores. Entre los puntos que se tratarán está declarar persona no grata al actual ministro de agricultura, Rubén Flores, por haberle puesto, supuestamente, poco interés a su accionar como titular del Ministerio de Agricultura y Ganadería.', 'Desinformación en los sectores productivos, generando inestabilidad en el sector.', 'https://lahora.com.ec/losrios/noticia/1102148040/agricultores-se-reune-hoy-para-analizar-su-situacion-actual', '000Ninguno', '2018-04-11 22:19:28', '2018-04-11 22:19:28', 5, '', 'Con cada uno de los sectores están establecidas hojas de ruta, por lo que es necesario hacer un seguimiento de cada uno de ellos.'),
(21, 2, 1, '2018-04-08 05:22:00', 'Otro colectivo pide renuncia del Ministro de Agricultura', 'Tras la paralización del sector arrocero en la provincia del Guayas y Los Ríos, ahora el colectivo “Renovación Ciudadana” exige la renuncia del actual ministro de Agricultura y Ganadería, Rubén Flores. Este colectivo acoge a organizaciones sociales, políticas, campesinas y agrícolas del país. Este pedido lo realizan bajo el supuesto, no se ha visto un trabajo de territorio, y existen quejas de todos los sectores, como los productores de papa. Daniel Moreno, secretario de Renovación Ciudadana, dijo que el quintal de este tubérculo está a tres dólares, cuando la producción cuesta 10.', 'Inestabilidad en sector  productivo', 'https://fotos.lahora.com.ec/losrios/noticia/1102148329/otro-colectivo-pide-renuncia-del-ministro-de-agricultura#.WstYneV2Drs.whatsapp', '000Ninguno', '2018-04-11 22:22:49', '2018-04-11 22:22:49', 5, '', 'Reunión con los productores de papa, supuestamente, afectados para conocer los pormenores y definir las áreas a atacar.'),
(22, 2, 1, '2018-04-11 05:25:00', 'Para el 16 de abril agricultores anunciaron paro nacional', 'En caso de que las autoridades no cumplan sus demandas, representantes de gremios de diferentes provincias pertenecientes a diversas actividades agropecuarias, anunciaron que realizarán un paro nacional agropecuario el próximo lunes 16 de abril. \r\nAsí lo resolvieron el pasado 7 de abril en el Primer Foro Nacional Agropecuario del Ecuador, efectuado en Quinindé y estuvo presidido por Fausto Figueroa, presidente de la Asociación de Bananeros de Esmeraldas y Santo Domingo.\r\nEn el encuentro también participaron el subsecretario del MAG, José Carrera; la asambleísta por Esmeraldas, Roberta Zambrano; la directora Provincial de MAG de Esmeraldas, Margarita Montaño; el presidente de la Junta Parroquial de la Unión, Juan Carlos Quezada, entre otros. Critican una supuesta inacción en el sector bananero del país.', 'Consecución del paro nacional', 'https://www.diariocorreo.com.ec/index2.php?id=16319&seccion=ciudad&titulo=para-el-16-de-abril-agricultores-anunciaron-paro-nacional', '000Ninguno', '2018-04-11 22:25:01', '2018-04-11 22:25:01', 5, '', 'Para atender la demanda de los productores de banano, el Consejo Consultivo, realizado entre productores, exportadores y autoridades del MAG, establecieron una tabla promedio de precios; es decir, que el precio mínimo de sustentación promedio al año (52 semanas) debe ser USD 6.20 o superior, jamás inferior. \r\nComo ejemplo: si los productores venden a USD 12, USD 8, USD o 6 la caja de banano, en diversas semanas, el promedio al final del año deberá ser USD 6,20 o superior.'),
(23, 2, 1, '2018-04-09 05:29:00', 'Plan económico sin sector agrícola', 'El articulista de diario El Universo, Gonzalo Gómez, critica que el Gobierno no haya incluido medidas relacionadas con el sector agropecuario del país en el plan económico, presentado la semana anterior. Menciona que la agricultura es básica para la alimentación, genera fuentes de empleo.', 'Inestabilidad en el sector.', 'https://www.eluniverso.com/opinion/2018/04/09/nota/6705667/plan-economico-sector-agricola', '000Ninguno', '2018-04-11 22:29:12', '2018-04-11 22:29:12', 5, '', 'Remitir al articulista información de las acciones que ejecuta el MAG, a través de la Gran Minga Nacional Agropecuaria.'),
(24, 2, 1, '2018-04-11 05:31:00', 'Sacrifican en Colombia 15 bovinos llegados de Venezuela con fiebre aftosa', 'El gobierno colombiano notificó este 10 de abril de 2018, a la Organización Mundial de Sanidad Animal (OIE) que en el este del país fueron incautados quince bovinos, ingresados de manera ilegal desde Venezuela y que tenían fiebre aftosa, por lo que fueron sacrificados. \r\nEl ministro de Agricultura de Colombia, Juan Guillermo Zuluaga, citado en un comunicado del Instituto Colombiano Agropecuario (ICA) dijo que tras conocer el caso, presentado en el departamento de Arauca (fronterizo con Venezuela), se activaron “todos los protocolos sanitarios”.', 'Ganado en Ecuador se contagie de fiebre aftosa.', 'http://www.elcomercio.com/actualidad/mundo-sacrificio-colombia-bovinos-fiebreaftosa.html', '000Ninguno', '2018-04-11 22:31:35', '2018-04-11 22:31:35', 5, '', 'Solicitar al ICA de Colombia toda la información relacionada con el ingreso de ganado desde Venezuela hacia Colombia, así como las medidas que implementarán para evitar un eventual contagio.'),
(25, 2, 2, '2018-04-10 10:49:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', 'Se ha definido una metodología de identificar los eventos antrópicos y naturales de los sectores acuícola y pesquero del país. Esta información será remitida cada fin de mes por parte del ECU 911, para que el MAP genere los mapas temáticos que faciliten el análisis de las variables identificadas.', 'Demora de la convocatoria del Comité por  parte  de  la institución con competencia', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '000Ninguno', '2018-04-12 03:49:18', '2018-04-12 03:50:21', 5, '', 'Se ha definido una metodología de identificar los eventos antrópicos y naturales de los sectores acuícola y pesquero del país. Esta información será remitida cada fin de mes por parte del ECU 911, para que el MAP genere los mapas temáticos que faciliten el análisis de las variables identificadas.\r\nAcciones realizadas: \r\n\r\n•	En base al análisis de la información proporcionada     por     el Centro de Estadísticas del ECU911, se       generó documento (MAPA) de la distribución   de   eventos de robos que involucra a pescadores artesanales. Esta    información    será presentada al Comité de Seguridad    de    la    Vida Humana en el Mar para su       análisis       y       se propongan          acciones específicas.'),
(26, 2, 1, '2018-04-12 04:06:00', 'Agricultores se convocan para una asamblea', 'Pequeños y medianos agricultores de la provincia de Los Ríos se están convocando para una asamblea a efectuarse este sábado, a partir de las 13:00 en las instalaciones del local de la Unión Nacional de Educadores (UNE), frente al parque Central de Ventanas. \r\nEl dirigente campesino de Babahoyo, Ramón Flores, dijo que la intención es fijar una fecha para que el ministro de Agricultura y Ganadería, Rubén Flores, los pueda atender personalmente y así buscar una solución a los problemas de la comercialización de los diferentes productos agrícolas. Agregó que los agricultores aún venden la saca de arroz en cáscara de 240 libras, en 23 dólares a los comerciantes, y que en la UNA EP todavía tienen problemas para vender la gramínea, ya que hay arroz almacenado allí.', 'Inestabilidad en diferentes sectores productivos', 'https://fotos.lahora.com.ec/losrios/noticia/1102149276/agricultores-se-convocan-para-una-asamblea', '000Ninguno', '2018-04-18 21:06:38', '2018-04-18 21:06:38', 6, '', 'Designar a funcionarios del Ministerio de Agricultura y Ganadería para que se reúnan con los productores y les expliquen los avances efectuados para solucionar el inconveniente.'),
(27, 2, 1, '2018-04-18 04:08:00', 'Exportaciones de café cayeron 24,5% en 2017', 'Luego de tener un leve crecimiento en sus ventas en 2016, el panorama de las exportaciones del sector cafetalero del país cambió considerablemente en 2017. Datos de la Asociación Nacional de Exportadores de Café (Anecafé) indican que el año pasado se exportaron 695.144 sacos de café de 60 kilos (entre el tipo arábigo, robusta e industrializado). Dicha cifra representa una disminución del 24,5% con relación a 2016, cuando se enviaron al exterior 921.174 sacos. Anecafé señala que los 695.144 sacos exportados en 2017 representaron ingresos por 116’688.943 dólares, lo que significó 14’578.731 menos que los obtenidos en 2016, en que se llegó a 131’267.675 dólares. Una de las causas de esta crítica situación en el sector es la baja productividad de los cafetales.', 'Tendencia negativa en exportaciones de café.', 'https://www.eltelegrafo.com.ec/noticias/economia/4/exportaciones-cafe-bajaproductividad', '000Ninguno', '2018-04-18 21:08:53', '2018-04-18 21:08:53', 6, '', 'El Ministerio de Agricultura y Ganadería articula un trabajo coordinado con otras entidades públicas para buscar mercados, mientras que al interior del país se trabaja para que los productores obtengan certificaciones de origen del café.'),
(28, 2, 1, '2018-04-13 04:11:00', 'Nueva modalidad de pago crea incertidumbre entre productores', 'El Ministerio de Agricultura y Ganadería (MAG) presentó una nueva propuesta para fijar los precios del maíz duro y del arroz en cáscara. Se trata de una franja de precios que establece un precio piso y un precio techo. En el caso del arroz cáscara, la saca de 200 libras, con 20% de humedad y 5% de impurezas, tendrá un precio techo de 35,50 dólares y el precio piso de 32,30 dólares. En maíz amarillo  el  quintal de 45,36 kilogramos, con 13% de humedad y 1% de impurezas, se pagará como precio techo 17,20 dólares y como precio piso 13,50 dólares. \r\nAdemás, aprobó que el Precio Mínimo de Sustentación para la caja de plátano (Barraganete) de 50 libras se mantengan en 7,30 dólares. Carmen Zapatier, presidenta de la Federación de Maiceros del Empalme, indicó que los productores de este grano se reunirán hoy a las 14: 00 horas en Ventanas para hablar sobre las medidas que se tomarán al respecto, ya que consideran que esta nueva modalidad afecta los intereses de los productores.', 'Inestabilidad en sector arrocero, maicero y platanero.', 'http://elproductor.com/noticias/ultima-hora-nueva-modalidad-de-pago-crea-incertidumbre-entre-productores/', '000Ninguno', '2018-04-18 21:11:55', '2018-04-18 21:11:55', 6, '', 'Envío de información justificando que la franja de precios genera estabilidad de precios tanto para los productores, como para los industriales que adquieren los productos'),
(29, 2, 1, '2018-04-18 04:17:00', 'El clima y los precios afectan la agricultura', 'Julio Carchi, vicepresidente de la Junta de Usuarios de América Lomas, de Daule (Guayas), critica la fijación de precios mediante la modalidad de franja de precios. Dijo que los precios establecidos para el arroz no habrá ganancia alguna, lo que podría conducir a una situación solo de sobrevivencia y empobrecimiento rural.\r\n\r\nAgregó que otro factor que afecta la producción es el clima e indicó que el veranillo golpea y amenaza los cultivos, ya que algunas zonas de la Costa llevan 15 días sin que les caiga una sola gota de agua del cielo. “El arroz está en plena parición y si no llueve fuerte en estos días se arruinará el 90 % de la cosecha”, señaló Heitel Lozano, presidente de la Corporación Nacional de Arroceros.', 'Inestabilidad en sector agrícola', 'Página 7, sección Economía, diario Expreso', '000Ninguno', '2018-04-18 21:17:34', '2018-04-18 21:17:34', 6, '', 'Seguimiento permanente de la situación climática en los sectores que, presuntamente, resultarían afectados por la ausencia de lluvias, además de continuar explicando cómo funcionará el nuevo sistema de fijación de precios presentada.'),
(30, 2, 1, '2018-04-18 04:18:00', 'Arroceros y maiceros protestan en Guayaquil piden derogar sistema de franja de precios', 'Productores arroceros y maiceros se concentraron este martes 17 de abril en las instalaciones del Ministerio de Agricultura y Ganadería (MAG), al norte de Guayaquil, desde donde iniciaron una marcha hacia la Gobernación del Guayas, para protestar contra el sistema de franja de precios establecidos.\r\nSegún ese sistema, la saca de 200 libras de arroz en cáscara tiene un precio piso de 32,30 dólares y techo de 35,50 dólares; mientras que el quintal de maíz tiene un precio base de 13,50 y máximo de 17,20 dólares. \r\nLos productores exigen que hayan precios únicos: 14,90 para el maíz y 35,50 para el arroz. Bernardo Bravo, del Consejo Sectorial Campesino, es unas de las personas que dirige la movilización y exigió la dimisión del ministro de Agricultura, Rubén Flores. Una protesta similar se efectuó en Babahoyo, provincia de Los Ríos.', 'Inestabilidad en sector agrícola', 'https://www.eltelegrafo.com.ec/noticias/economia/4/arroceros-maiceros-marcha-guayaquil-precios', '000Ninguno', '2018-04-18 21:18:53', '2018-04-18 21:18:53', 6, '', 'Un equipo técnico del Ministerio de Agricultura y Ganadería se reunió con los productores de arroz y maíz para explicarles el sistema de franja de precios, establecido con base a análisis técnicos y objetivos.'),
(31, 2, 1, '2018-04-17 04:21:00', 'Desarrollo productivo de fronteras', 'Alejo Baque, dirigente de la Coordinadora Nacional Campesina Eloy Alfaro, advirtió que el problema de la frontera no se resolverá con la presencia militar, sino con desarrollo productivo, por lo que propuso  efectuar proyectos para el desarrollo agrícola, social,  económico, pero con la coparticipación de Colombia.', 'Falta de proyectos ara el desarrollo agrícola, social,  económico', 'EcuadorTV', '000Ninguno', '2018-04-18 21:21:30', '2018-04-18 21:21:30', 6, '', 'Iniciar un trabajo conjuntamente con las organizaciones para buscar los mecanismos que permitan implementar la propuesta, partiendo de un diagnóstico del sector agropecuario que está en la frontera.'),
(32, 1, 2, '2018-04-17 06:10:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Acciones realizadas: se mantiene información reportada\r\n•	En base al análisis de la información proporcionada por el Centro de Estadísticas del ECU911, se generó documento (MAPA) de la distribución de eventos de robos que involucra a pescadores artesanales. Esta    información    será presentada al Comité de Seguridad de la Vida Humana en el Mar para su análisis y se propongan acciones específicas.', 'Demora de la convocatoria del Comité  por parte de la institución con competencia', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '000Ninguno', '2018-04-18 23:10:38', '2018-04-18 23:10:38', 6, '', 'Solución propuesta: Se ha definido una metodología de identificar los eventos antrópicos y naturales de los sectores acuícola y pesquero del país. Esta información será remitida cada fin de mes por parte del ECU 911, para que el MAP genere los mapas temáticos que faciliten el análisis de las variables identificadas.'),
(33, 2, 1, '2018-04-19 01:14:00', 'ARROCEROS BLOQUEAN VÍAS EN VARIOS CANTONES DEL GUAYAS Y LOS RÍOS', 'Los productores de arroz reclaman por la vigencia de una franja de precios, que establece un precio techo de $ 35,50 y un precio piso de $ 32,30 para la saca de arroz de 200 libras, con 20% de humedad y 5% de impurezas. Los productores consideran que ese parámetro no es viable. Heitel Lozano, presidente de la Corporación Nacional de Arroceros, afirmó que el sector no está preparado para soportar una franja de precios sin mejorar la productividad. “Pedimos derogar ese acuerdo para suspender las medidas”. Afirman que cuando el precio era $ 35,50, no se cumplía, por ello temen que ahora con un precio piso, la industria pagará menos. Lozano afirma que el costo por hectárea es $ 1.800  o $ 2.000, de la que obtienen 60 sacos. “A $ 32 apenas alcanzan a cubrir los costos”.', 'Inestabilidad en el sector arrocero', 'https://www.eltelegrafo.com.ec/noticias/economia/4/arroceros-bloquean-vias-cantones-guayas', '000Ninguno', '2018-04-25 18:14:10', '2018-04-25 18:14:10', 7, '', 'Socialización de los beneficios del sistema, con los productores de arroz.'),
(34, 2, 1, '2018-04-19 02:06:00', 'Los bananeros se sumarían a los paros sistemáticos', 'En las instalaciones de la Asociación de Productores Bananeros del Ecuador (Aprobanec), ubicadas en Quevedo, se desarrolló una reunión para debatir sobre la situación actual del agro. No obstante, en lo particular se centraron en el pago mínimo de sustentación de la caja de banano que está en 6 dólares con 20 centavos, pero ese importe no estarían pagando la mayoría de las exportadoras. Su mayor petición es la renuncia del actual ministro de Agricultura y Ganadería, Rubén Flores. “Las manifestaciones que existen de los arroceros, palmeros, cacaoteros y ahora nosotros, es porque necesitamos apoyo, nosotros no somos industriales”. Puntualizó  Enríquez. (STG).', 'Inestabilidad del  Sector Agrícola.', 'https://lahora.com.ec/losrios/noticia/1102150787/los-bananeros-se-sumarian-a-los-paros-sistematicos-', '000Ninguno', '2018-04-25 19:06:25', '2018-04-25 19:06:25', 7, '', 'Continuar trabajando, porque también hay organizaciones de productores que apoyan las decisiones que se adoptan.'),
(35, 2, 1, '2018-04-20 02:16:00', 'Gremios Agrícolas declaran “persona no grata” al Ministro Rubén Flores', 'Representantes de varios sectores agrícolas, liderados por el Pueblo Montuvio del Ecuador, anunciaron que darán un plazo hasta el 25 de mayo próximo para que se concrete una reunión con el presidente Lenín Moreno para exponerle la problemática del agro y plantearle varias propuestas como la integración de consejos consultivos por productos.\r\nManuel Gonzaga, presidente del Pueblo Montuvio, dijo que esta unidad agropecuaria, que la integran, entre otros, organizaciones de maiceros, arroceros y bananeros, decidió deponer la paralización en tres provincias tras llegar a un acuerdo con los gobernadores del Guayas y Los Ríos para que se concrete el diálogo con el primer mandatario.\r\nGonzaga dijo que ante la ausencia de la creación de políticas públicas para el sector agropecuario decidieron declarar al ministro de Agricultura, Rubén Flores, persona no grata en el sector agrícola de la Costa.', 'Inestabilidad del agro en las provincias de Guayas y Los Ríos', 'https://www.eluniverso.com/noticias/2018/04/21/nota/6724023/gremios-agricolas-declaran-persona-no-grata-flores', '000Ninguno', '2018-04-25 19:16:18', '2018-04-25 19:16:18', 7, '', 'Explicar a los productores las acciones que ha ejecutado el Ministerio de Agricultura y Ganadería.'),
(36, 2, 1, '2018-04-21 02:20:00', 'La sequía comienza su recorrido por el campo', 'Guayas, Los Ríos y Manabí son las provincias más afectadas por la escasez de agua. El maíz comenzó a perderse en Pedro Carbo, Balzar y otras zonas. El panorama es devastador, indica Mario Lapo, ingeniero, quien tiene almacenes de insumos y asesora a productores de hortalizas.', 'Escacez del maíz', 'Diario Expreso', '000Ninguno', '2018-04-25 19:20:18', '2018-04-25 19:20:18', 7, '', 'Levantamiento de información para conocer con certeza los daños que ha causado la sequía, a qué tipo de productos, superficie.'),
(37, 2, 1, '2018-04-22 02:27:00', 'Precios políticos crearon la distorsión actual del mercado arrocero', 'El mercado arrocero soporta graves problemas de sobre oferta, altos inventarios, iliquidez y bajos precios, originados principalmente por el incremento del contrabando que en opinión de Javier Chong, presidente de la Corporación de Industriales Arroceros del Ecuador, comenzó hace cuatro años con la fijación de  precios de  sustentación elevados, “políticos,  que falseaban la realidad de mercado”. La cuestionada fijación de precios mínimo y máximo para la gramínea en cáscara, que ha motivado paros y el pedido de separar del cargo al Ministro de Agricultura, le parece en cambio conveniente porque permite comprar en una franja que se ajusta a las diferentes calidades y  categorías de arroz que se producen y comercializan en el país. “No es lo mismo un arroz grano largo que uno corto, un arroz que cocina bien a otro que no rinde, la exigencia del consumidor local es mayor”.', 'Inestabilidad en el sector arrocero', 'http://actoresproductivos.com/2018/04/20/precios-politicos-crearon-la-distorsion-actual-del-mercado-arrocero/', '000Ninguno', '2018-04-25 19:27:11', '2018-04-25 19:27:11', 7, '', 'Conjuntamente con los actores de las diferentes cadenas productivas, en las mesas técnicas y en los consejos consultivos, se analiza técnicamente el establecimiento de precios.'),
(38, 2, 1, '2018-04-22 02:31:00', 'Los ganaderos prevén una crisis alimenticia', 'Rubén Párraga, presidente de la Federación Nacional de Ganaderos (Fedegan), dijo que el gremio está preocupado debido a que la estación invernal ha sido “pobre” este año. Añadió que “así como va la cosa se prevé una crisis alimenticia desde que inicie septiembre”. Sostuvo que en los próximos días mantendrá una reunión con los titulares del Ministerio de Agricultura y Ganadería (MAG), para buscar estrategias y prepararse para lo que se viene. Dijo que algunos ganaderos que han tenido experiencia en sequías están almacenando alimentos para dar a sus animales en la “crisis que se aproxima”.', 'Crisis alimentaria a causa de sequías, sector ganadero.', 'http://www.eldiario.ec/noticias-manabi-ecuador/469564-los-ganaderos-preven-una-crisis-alimenticia/', '000Ninguno', '2018-04-25 19:31:02', '2018-04-25 19:31:02', 7, '', 'Equipos del Ministerio de Agricultura y Ganadería se reunirán con los ganaderos para definir estrategias de cómo enfrentar ese eventual problema.'),
(39, 2, 1, '2018-04-22 02:34:00', 'El precio de la caja de plátano sigue por el suelo', 'La cadena productiva del plátano empieza con quienes lo producen en el campo, a los que les pagan precios bajos y que han reclamado constantemente por el problema. Del plátano barraganete que produce El Carmen en sus cerca de 7 mil hectáreas, un 70% se exporta a mercados de Estados Unidos y Europa, mientras que el restante va a Colombia y al mercado nacional. Darwin Bravo, uno de los productores, manifestó que el precio por cada caja de exportación continúa descendiendo. Comentó que a inicios de marzo le pagaron las cajas a 3,70 dólares mientras que en las últimas tres semanas ha cobrado hasta 3,30 dólares cuando el valor determinado por las autoridades es de 7,30 dólares', 'Inestabilidad en el sector bananero', 'http://www.eldiario.ec/noticias-manabi-ecuador/469684-el-precio-dela-caja-de-platano-sigue-por-el-suelo/', '000Ninguno', '2018-04-25 19:34:58', '2018-04-25 19:34:58', 7, '', 'Se realizarán operativos de control para verificar que se pague el precio mínimo de sustentación, establecido mediante Acuerdo Ministerial 048, emitido el 11 de abril de 2018.'),
(40, 2, 1, '2018-04-24 02:37:00', 'La sequía malogró 49.000 hectáreas de maíz en Manabí', 'La falta de lluvias se evidencia desde mediados de marzo, por ello las plantas de este cereal no cumplieron su fase de desarrollo. Los productores están preocupados, especialmente de Jipijapa. Los agricultores de los cantones Jipijapa, 24 de Mayo, Paján, Tosagua, Junín, Bolívar y Chone, tienen problemas por la falta de agua para que el maíz alcance los niveles de desarrollo. Según Joffre Quimís, presidente de los maiceros de la provincia, la situación es alarmante. “De las 70.000 hectáreas que se sembraron en la provincia, el 70% (49.000) se estropeó, por el déficit hídrico”.', 'Inestabilidad sector maíz.', 'https://www.eltelegrafo.com.ec/noticias/regional/1/sequia-malogro-maiz-manabi-ecuador', '000Ninguno', '2018-04-25 19:37:35', '2018-04-25 19:37:35', 7, '', 'Equipos del MAG recorren los cultivos de maíz para evaluar los daños, y definir cómo se les indemnizará a los productores.'),
(41, 2, 1, '2018-04-25 02:39:00', 'Lecheros azuayos se quejan de pérdidas en sus negocios', 'Ganaderos de Tarqui, parroquia rural ubicada al sur de Cuenca, se quejan porque venden el litro de leche a 35 centavos cada uno, cuando el precio oficial fijado por el Gobierno es de 42. Ganaderos e intermediarios dicen que parte de la solución sería que el Gobierno suba el precio de la leche, pero en una reunión, el pasado 16 de abril, el ministro de Agricultura, Rubén Flores, dijo que eso no era posible porque nadie les pagaría más', 'Inestabilidad sector lechero.', 'https://www.eluniverso.com/noticias/2018/04/25/nota/6730701/lecheros-azuayos-se-quejan-perdidas-sus-negocios', '000Ninguno', '2018-04-25 19:39:38', '2018-04-25 19:39:38', 7, '', 'Con productores de las provincias de Azuay y Cañar se analizó los avances de las hojas de ruta en el sector ganadero'),
(42, 2, 2, '2018-04-24 02:58:00', 'Delincuencia', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Demora de la convocatoria del Comité por parte de la institución con competencia', 'N/A', '1524686342-MAP-DRS-2018-0029-O-1.pdf', '2018-04-25 19:58:06', '2018-04-25 19:59:02', 7, '', 'Se ha definido una metodología de identificar los eventos antrópicos y naturales de los sectores acuícola y pesquero del país. Esta información será remitida cada fin de mes por parte del ECU 911, para que el MAP genere los mapas temáticos que faciliten el análisis de las variables identificadas.'),
(43, 2, 1, '2018-04-26 04:58:00', 'LA SEQUÍA TAMBIÉN AFECTA A COTOPAXI', 'Los cultivos de maíz y de papa son los que más sufren debido a los cambios bruscos del clima. Las sequías prolongadas y las lluvias intensas provocan “estrés” en los cultivos, que tras estos cambios bruscos de clima no concluyen con normalidad su ciclo y generan pérdidas para los agricultores. Juan Pablo Narváez, ingeniero agrónomo de la prefectura de Cotopaxi, explicó que anteriormente existían seis meses de lluvias y seis de verano, basándose en eso los agricultores se guiaban para sembrar y cosechar; pero la situación hoy es diferente.', 'Si no se establecen directrices de contingencia y se  determinan estados de alertas para que se pueda controlar y actuar con prevención ante los riesgos generados por la situación climática, no se podrá hacer frente a las necesidades y emergencias que se presenten a los agricultores.', 'http://elproductor.com/noticias/la-sequia-tambien-afecta-a-cotopaxi/', '000Ninguno', '2018-05-02 21:58:52', '2018-05-02 21:58:52', 8, '', 'Elaborar planes  de contingencia específicos de cada una de las áreas de atención; levantar información de la ubicación y posible afectación de estos cultivos con la finalidad de realizar actividades que reduzcan los riesgos; dar a conocer a la Secretaría Nacional de Gestión de Riesgos, los informes y evaluaciones de daños,  los recursos disponibles, las necesidades y acciones a realizarse para hacer frente a la emergencia; realizar periódicamente la asistencia técnica en cada una de las parroquias de la provincia, además de canalizar recursos para atender las necesidades causadas por la época lluviosa, con la dotación de insumos y seguro agrícola.'),
(44, 2, 1, '2018-04-27 05:06:00', 'AGRICULTORES  PIDEN  PRECIOS  FIJOS Y NO REFERENCIALES', 'Representantes del sector bananero, maicero, y cafetero piden establecer  precios fijos a los productos y no referenciales, además del control en las casas comerciales.\r\n\r\nEdwin Enríquez, presidente de la Asociación de  Productores Bananeros del Ecuador, indicó que les están pagando 2 dólares la caja por lo que exigen establecer precios y que por lo menos se paguen los 6,20 USD por cada caja.\r\n\r\nAdemás la regulación de la oferta y la demanda en el Ecuador, por lo que necesitan recibir el respaldo del MAG y Proecuador para iniciar las exportaciones de banano.\r\n\r\nEn el tema del café, Vicente Cárdenas, aseguró que en la actualidad  el cultivo del café se encuentra en “total abandono y está por desaparecer del contexto internacional”. Sugirió que se reactive  la Ley  del sector cafetero y que requieren de la creación del Instituto Nacional del Café para que rija una política porque “hay 100 mil familias en el país las que nos quedamos sin alimentos sino se hace nada”.\r\n\r\nEn el tema maíz, Crisanto Carranza, miembro del Centro Agrícola del cantón             Mocache, insiste en la fijación de precio del quintal de la gramínea, porque los costos han variado. Cuestionó  la rueda de negocios  que se efectuó en Guayaquil porque  “un pequeño agricultor  no tiene la estabilidad para asistir”.\r\n\r\nSegún Carranza el precio referencial es 15,75 dólares, pero no hay precio fijo, lo cual es el objetivo de lucha para este sector.', 'La falta de control para el pago del precio de sustentación de los productos agrícolas puede generar inconformidades en los agricultores y su vez inestabilidad en los sectores productivos mencionados.', 'https://www.facebook.com/losriosecdigital/posts/974490329383370', '000Ninguno', '2018-05-02 22:06:57', '2018-05-02 22:06:57', 8, '', 'Buscar los mecanismos para la fijación de precios de los productos del agro para cambiar la palabra referencial a fijo.'),
(45, 2, 1, '2018-05-02 05:13:00', 'AGRICULTORES CIERRAN VÍA QUE UNE A GUAYAS Y MANABÍ', 'Organizaciones de arroceros y maiceros de los cantones Pedro Carbo y Daule cerraron este miércoles 2 de mayo, la vía que une a  las provincias  de Guayas y Manabí, en el km.63.\r\n\r\nLos agricultores insisten en la derogación de los acuerdos 046 y 047, que fija precios, pisos y techos, para las ventas de maíz duro y arroz.\r\n\r\nSolicitaron al presidente Lenín Moreno, la remoción del Ministro de Agricultura y Ganadería, Rubén Flores.', 'Se debe monitorear y controlar las acciones de protestas generadas en la vía para evitar que exista disturbios fuertes y para que se pueda abrir nuevamente el paso vehicular y comercial.', 'https://www.eltelegrafo.com.ec/noticias/economia/4/agricultores-guayas-via', '000Ninguno', '2018-05-02 22:13:27', '2018-05-02 22:13:27', 8, '', 'Revisión de la propuesta con los productores; continuar con  la socialización de los beneficios del sistema, con los productores de arroz; monitoreo de las publicaciones en los medios y en redes, así como difusión de información a través de los diferentes canales de comunicación.');
INSERT INTO `csp_reportes_alertas` (`id`, `estado_reporte_id`, `institucion_id`, `fecha_atencion`, `tema`, `descripcion`, `riesgo_principal`, `fuente`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`, `solucion_propuesta`) VALUES
(46, 2, 2, '2018-05-01 07:32:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Demora en convocatoria de reunión del Comité por parte de la institución con competencia', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '000Ninguno', '2018-05-03 00:32:42', '2018-05-03 00:32:42', 8, '', 'Solución propuesta (principal): Si bien la seguridad no es competencia del MAP, desde su perspectiva se busca evidenciar el problema mediante la recolección de información proveniente de entidades con competencia en materia de seguridad. Con esta acción se busca se analice y se propongan soluciones en las reuniones de los Comités de Seguridad provinciales.\r\n\r\nAcción realizada: Se remitió el análisis de información sobre eventos de piratería a la Gobernación de Manabí, como entidad encargada de convocar al Comité de Seguridad de la Vida Humana en el Mar de esta provincia.'),
(47, 2, 3, '2018-05-09 03:33:00', 'Ecuador ocupa puesto 82 de ranking de complejidad económica', 'El observatorio de complejidad económica del MIT, ubica al Ecuador en el puesto 82 en el ranking de complejidad económica (datos del 2016), entre 124 países en todo el mundo.\r\n\r\nEl Índice de Complejidad Económica (ICE) y el Índice de Complejidad de Producto (ICP) miden qué tan diversificada y compleja es la canasta de bienes exportados por un país, determinado por los conocimientos y las capacidades productivas acumuladas.\r\n\r\nReferencias:\r\n\r\nhttps://www.eltelegrafo.com.ec/noticias/economia/4/ecuador-ranking-complejidad-economica\r\n\r\nhttps://atlas.media.mit.edu/en/profile/country/ecu/', 'No existe riesgo, sin embargo, el ranking es elaborado y publicado por una institución reconocida a nivel mundial, MIT, lo cuál genera un alto nivel de difusión a nivel internacional, y es importante analizar y generar esfuerzos-estrategias para demostrar el trabajo que realiza el Gobierno Nacional en mejorar las variables analizadas por el MIT.', 'https://atlas.media.mit.edu/en/rankings/country/eci/', '000Ninguno', '2018-05-09 20:33:18', '2018-05-09 20:33:18', 9, '', 'Realizar un análisis de las variables consideradas para el ranking de complejidad económica y analizar estrategias para mejorar la posición del Ecuador en dichas variables. Identificar esfuerzos ya realizados y en ejecución que permitan tener un impacto positivo en el ranking. Se debería analizar la posibilidad de generar un boletín con los resultados del análisis.'),
(48, 2, 1, '2018-05-03 04:25:00', 'Agricultores protestaron en Pedro Carbo por precios y seguro agrícola', 'Productores maiceros y arroceros protestaron en el cantón Pedro Carbo para exigir la derogatoria de los acuerdos ministeriales 46 y 47 que fijan precios techo y piso para los sectores, y solicitaron agilidad en el seguro agrícola. Rugel Lirio Macías, maicero de la Ceiba, dijo que el sector siempre pierde. “El año pasado fue por el gusano y este año por la sequía”. Agregó que los créditos agrícolas los aprueban tarde y que Seguros Sucre no reconoce las pérdidas. Abel Navas llegó desde Daule para apoyar el paro y exigir que se oficialice el precio de $ 15,75 para el maíz y de $ 35,5 para el arroz', 'La falta de atención a las necesidades que presenten los productores maiceros y arroceros puede generar mas protestas por parte de los mismos.', 'https://www.eltelegrafo.com.ec/noticias/economia/4/agricultores-protesta-precios-seguroagricola-ecuador', '000Ninguno', '2018-05-09 21:25:20', '2018-05-09 21:25:20', 9, '', 'Continuar con la participación de los productores de arroz en mesas técnicas para tratar los diferentes problemas que tiene el sector y tomar resoluciones conjuntas en beneficio del mismo.'),
(49, 2, 1, '2018-05-07 04:33:00', 'La sequía acecha a la agricultura', 'En su propiedad, en la vía Manta-Rocafuerte, el agricultor Javier Balón López sembró con la esperanza de aumentar sus ingresos para mantener a su familia. Con su esposa Jenny María Ortega y su hijo pusieron manos a la obra. Sembraron 8 días antes de carnaval, en febrero. \r\n\r\n“En la primera y en la segunda lluvia que empapó estaba preparada la tierra”, contó. Después las lluvias se alejaron y, con ello, llegó la muerte para la plantación de maíz y unas cuantas plantas de sandía, melón y habas. Perdió todo el capital y, sin seguro agrícola, no puede recuperar parte de lo invertido.\r\n\r\n El sistema de riego por goteo instalado en su propiedad es mudo testigo de que la mayoría de los agricultores depende de que “San Pedro abra la llave” para producir. Este año, en el mismo período, las precipitaciones alcanzaron los 754,40 mm. Entonces, la preocupación tiene una base que obliga a un trabajo urgente coordinado desde el Ministerio de Agricultura y Ganadería (MAG).  \r\n\r\nEn abril, las oficinas del MAG empezaron a recibir a los agricultores que han perdido sus cultivos por  falta de agua, plagas, taponamientos y otras causas en las que, paradójicamente, hay casos de pérdidas por inundaciones. Son los avisos de siniestro para que el MAG envíe a inspeccionar, se elabore un informe y Seguros Sucre cancele el seguro en función de si la pérdida es total o parcial. Desde que presenta el aviso, el agricultor tiene 10 días para presentarse en las oficinas del MAG y máximo en 3 meses recibe la indemnización, informó Sandro Vera, director provincial del Ministerio de Agricultura. Señaló que hasta el 22 de abril habían recibido 6.355 avisos de siniestro que corresponden a 20.328,75 hectáreas afectadas, la mayoría de maíz.', 'La falta de preparación de los productores ante el impacto ambiental generado por la sequía desencadenaría en la perdida de los cultivos así como el daño en la tierra para sembrar.', 'http://www.eldiario.ec/noticias-manabi-ecuador/470975-la-sequia-acecha-a-la-agricultura', '000Ninguno', '2018-05-09 21:33:46', '2018-05-09 21:33:46', 9, '', 'Brindar asistencia técnica a los productores en el tratamiento de los cultivos ante afectaciones por plagas, producto de la sequía y entregar de kits  agrícolas que ayuden a proteger lo sembrado.'),
(50, 2, 1, '2018-05-08 04:47:00', 'CRISIS BANANERA CAUSARÁ UN MILLÓN DE DESEMPLEADOS', 'Ecuador es el primer exportador de banano en el mundo con 7 millones de cajas. Noboa con su marca Bonita es el más grande exportador, pero ahora el mundo bananero está pasando una crisis. Existe un precio oficial de 6,20 pero los especuladores y piratas quieren pagar 1,20 dólares. Si esto continúa en tres meses quiebra la industria bananera y habrá un millón  de desempleados. “Apelo al presidente de la República para que se controle y se ponga mano fuerte por este abuso que afecta tanto a productores como a exportadores” expresó Álvaro Noboa.', 'Se debe trabajar para proteger las exportaciones del banano, producto que ha encabezado las exportaciones de nuestro país; la falta de control a la especulación y a los precios podría desembocar en la quiebra de esta industria y  al desempleo de mas de un millón de personas.', 'https://www.facebok.com/AlvaroNoboaPonton/videos/203223710233392', '000Ninguno', '2018-05-09 21:47:37', '2018-05-09 21:47:37', 9, '', 'Ejercer un mayor control para que se cumpla con el precio oficial  de la caja de banano y se aplique las sanciones correspondientes. \r\nSe trabaja en una nueva Ley del Banano en conjunto con los productores de la fruta.'),
(51, 2, 1, '2018-05-09 04:58:00', '\"Impacto 173\" evitó el robo de productos de primera necesidad de la Unidad Nacional de Almacenamiento, en Quito', 'La Policía Nacional, a través de la Policía Judicial del Distrito Metropolitano de Quito, aprehendió a 20 ciudadanos por el presunto delito de robo a las bodegas de la Empresa Pública Unidad Nacional de Almacenamiento (UNA EP), donde se almacenan productos como arroz, leche en polvo, quinua, entre otros, que se adquiere de los pequeños agricultores para ser entregados a  los diferentes programas del Gobierno Nacional. \r\n\r\nEl operativo denominado “Impacto 173” se realizó en el Distrito Calderón la noche de ayer, luego de que fuentes alertaran sobre el hecho a agentes de la Policía Judicial, al observar que ingresaron tres camiones a las instalaciones de la empresa y que en el exterior estaba estacionado un vehículo que los esperaba. \r\n\r\nLa Policía Judicial realizó las respectivas labores de inteligencia, para verificar dicha información y al identificar a varias personas en actitud sospechosa, se implementaron vigilancias y se distribuyó al personal operativo en puntos estratégicos.\r\n\r\nLos efectivos policiales ingresaron a la bodega de almacenamiento y neutralizaron a todos los presuntos infractores de la ley, quienes se encontraban cargando sacos de quinua en los otros dos camiones que se encontraban al interior', 'De acuerdo a las investigaciones que actualmente se están realizado por parte de la Policía Nacional, se evidencia que la seguridad de la empresa puede verse vulnerada en otras bodegas y plantas.', 'http://radiosucre.com.ec/impacto-173-evito-el-robo-de-productos-de-primera-necesidad-de-la-unidad-nacional-de-almacenamiento-en-quito/', '1525911493-INFORME MARIANAS UNA EP.pdf', '2018-05-09 21:58:57', '2018-05-10 00:18:13', 9, '', 'Por parte de la Unidad Nacional de Almacenamiento se presentará escritos de impulso dentro de la causa, a fin de que se determinen los autores intelectuales y materiales del delito.\r\nAdicionalmente, dentro de la causa se solicitará la reparación integral por el hecho ilícito, por lo que se está llamando a rendir su versión sobre los hechos a todo el personal que laboraba en esas instalaciones a fin de determinar si están involucrados.\r\nEn lo que se refiere a las acciones administrativas internas, la UNA EP ha tomado las acciones correspondientes con las siguientes directrices:\r\n- Inventario de productos a nivel nacional, para verificar posibles faltantes sin justificar.\r\n- Monitoreo de las grabaciones de seguridad, por parte del área tecnológica de la UNA EP.\r\n- Mejorar la seguridad del proceso de custodia de productos y documentos.\r\n- Capacitación a personal custodio de bodega, en el que se dé a conocer las consecuencias que implica los hechos delictivos.\r\n- Terminación unilateral del Servicio de Seguridad Privada e inicio de las acciones que correspondan por incumplimiento de las cláusulas contractuales.\r\n- Separación inmediata de los funcionarios que laboran en esta bodega por no a ver efectuado las acciones que corresponden a su cargo.'),
(52, 2, 2, '2018-05-08 06:07:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Demora en convocatoria de la reunión del Comité de Seguridad de la vida Humana en el Mar por parte de las entidades con competencia.', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '1525908219-MAP-SRP-2018-1376-O Guayas.pdf', '2018-05-09 23:07:08', '2018-05-09 23:23:39', 9, '', 'Solución propuesta (principal): Si bien la seguridad no es competencia del MAP, desde su perspectiva se busca evidenciar el problema mediante la recolección de información proveniente de entidades con competencia en materia de seguridad. Con esta acción se busca se analice y se propongan soluciones en las reuniones de los Comités de Seguridad provinciales.\r\n\r\nAcción realizada: Se generó documento de análisis de eventos de amenazas y riesgos sobre el sector pesquero y acuícola, mismo que fue enviado a los Gobernadores de las provincias de El Oro y Guayas para que promuevan reunión de Comités de Seguridad.'),
(53, 2, 1, '2018-05-09 07:35:00', 'PRODUCTORES AMENAZAN CON PARALIZACIÓN', 'Arroceros advirtieron con un nuevo paro en el caso de que el Gobierno no derogue el Decreto que fija el precio del arroz, que establece que la saca de 200 libras tendrá un precio techo de $35,50 y un piso de $32,30. Ese rango garantiza un precio mínimo al agricultor y planificar su siembra, afirmó el Ministro. Los productores dicen tener un costo de inversión de $29,50 por cada saca de 200 libras en producción.  El Gobierno debe trabajar en reducir los costos de inversión para solicitarnos que se mantengan con esos rangos manifestaron. Otro inconveniente que enfrenta este sector  es el contrabando den la frontera sur, para lo cual exigen controles.  Aseguraron que esperarán 15 días para verificar los cambios, si no se paralizarán.', 'Paralización del sector arrocero', 'Tc Televisión', '000Ninguno', '2018-05-10 00:35:44', '2018-05-10 00:35:44', 9, '', 'El MAG continúa con la implementación de las actividades de la Hoja de Ruta de la cadena de arroz, las mismas que han sido socializadas con las diversas organizaciones de productores en los diferentes espacios de diálogo . El MAG trabaja en la emisión de un Decreto Ejecutivo que regulará y controlorá los precios de los agroquímicos, con lo cual se aspira a la reducción de los costos de producción.'),
(54, 2, 3, '2018-05-09 08:09:01', 'Falta de operatividad del Fideicomiso Fondo de Capital de Riesgo (FCR)', 'Dada la normativa vigente del Fideicomiso Fondo Capital de Riesgo, es imperante trabajar en la adecuación del Fideicomiso que permita la eficaz y eficiente ejecución de los procesos para su implementación, lo cual implica conforme el análisis realizado, la reforma a la escritura de constitución del Fideicomiso, y el Reglamento Técnico de Inversiones del Fideicomiso FCR.', 'La falta de coordinación y oportuna gestión de los miembros del Fideicomiso, y de la Fiduciaria causaría un retraso en la ejecución del Fideicomiso Fondo de Capital de Riesgo, lo que implicaría una ineficiente utilización de recursos públicos que fueron asignados para impulsar el desarrollo de emprendimientos innovadores, en su etapa de aplicación productiva.', 'Coordinación General de Servicios para la Producción, Juan Francisco Ballén', '000Ninguno', '2018-05-10 01:09:29', '2018-05-10 01:09:29', 9, 'Institucional y Presidencia', 'Se requiere el compromiso y empoderamiento de los miembros del Fideicomiso, y la oportuna gestión de la Fiduciaria. Por otra parte se requiere el desarrollo de mesas técnicas con más frecuencia, en las que se analice y se realice el seguimiento de avance del desarrollo de las propuestas de reglamentos, instructivos, procedimientos, mecanismos que permitan la eficiente implementación del Fideicomiso.'),
(55, 2, 1, '2018-05-09 04:55:00', 'Palmicultores piden declaratoria de emergencia del sector', 'Carlos Chávez, presidente de Asociación Nacional de Cultivadores de Palma Aceitera (Ancupa), expuso la problemática, que según explicó es inédita en el sector palmicultor. Son pequeños agricultores de Esmeraldas, Imbabura, Pichincha, Guayas y Los Ríos, los que ven amenazada su permanencia en la agricultura. Según explicó Chávez, se trata de una una crisis severa en todo el sector agrícola del país, que genera la pérdida de rentabilidad debido que los precios internacionales y locales que en los últimos años bajaron de forma excesiva. Además, registran costos de productividad altos. “Atravesamos por situaciones complejas en la parte fitosanitaria y crediticia”, enfatizó. \r\nLas cifras revelan la problemática que se vendría de no actuar de inmediato. Este sector ocupa el tercer lugar en área sembrada luego del cacao y maíz. Son 250 mil hectáreas. La palma es el cuarto producto agrícola en generación de divisas y genera 100 mil empleos indirectos y 50 mil directos.\r\n “A la fecha se perdieron 48 mil hectáreas y eso genera pérdida de empleo, beneficios y recursos. Registramos pérdidas acumuladas por cerca de 500 millones de dólares, 126 mil hectáreas de cultivos están en riesgo. Son 3 500 palmicultores afectados y 26 mil empleos directos en peligro”, aseguró', 'La falta de atención en este sector y la falta de control a las acciones propuesta por el gobierno para salvaguardar a la producción y rentabilidad de la palma afectaría a la generación de divisas y pondría en peligro el cultivo del producto y 100 mil empleos indirectos y 50 mil directos.', 'https://www.asambleanacional.gob.ec/es/noticia/55454-palmicultores-piden-declaratoria-de-emergencia-del', '000Ninguno', '2018-05-16 21:55:01', '2018-05-16 21:55:01', 10, '', 'Ejecutar la hoja de ruta propuesta por el MAG en la que se reactiva el Plan de Mejora Continua de Palma, y donde estarán tres mesas técnicas. La primera  incluirá la mejora productiva y sostenibilidad, impulsará la asociatividad y el financiamiento. La segunda mesa tratará temas de comercialización interna y externa, además de la diversificación de la producción, mientras que la tercera mesa analizará el tema de la enfermedad de la pudrición del cogollo, y el manejo de plagas.'),
(56, 2, 1, '2018-05-12 04:59:00', 'La sequía sería más crítica a finales del año', 'Según cifras del Gobierno Provincial de Manabí, de un millón de hectáreas en donde se realiza producción agrícola, 30 mil hectáreas son beneficiadas con sistema de riego. Joab López, director de Riego y Drenaje del Gobierno Provincial de Manabí, detalló que el pronóstico de sequía se da según un análisis conforme a las precipitaciones de este año, que no han sido concurrentes. “Este tipo de temperaturas y pocas precipitaciones causaría una escasez de agua o agrietamiento prematuro del suelo a fines de año”, comentó. Indicó que se prevé que la sequía afecte más a la zona sur, como Montecristi, Jipijapa, Paján, Pichincha y Olmedo.', 'Si no se genera y ejecuta un plan de acción ante los riesgos generados por la sequía, los cultivos y la tierra para la siembra serían afectados para el sector agropecuario ocasionando grandes pérdidas para los productores  y agricultores.', 'http://www.eldiario.ec/noticias-manabi-ecuador/471543-la-sequia-seria-mas-critica-a-finales-del-ano/', '000Ninguno', '2018-05-16 21:59:26', '2018-05-16 21:59:26', 10, '', 'Implementar en la zona de mayor afectación, sistemas de riego de aspersión por  goteo y microreservorios. En el caso del MAG, la entidad inaugurará el sistema de riego por aspersión  y goteo  en la parroquia Campozano, cantón Paján.'),
(57, 2, 1, '2018-05-16 05:04:00', 'Asambleístas consideran que ministro de Agricultura debería ir a juicio político.', 'Los legisladores Fernando Burbano y Verónica Guevara impulsan la posibilidad de realizar un juicio político contra el ministro de Agricultura y Ganadería, Rubén Flores, por supuesto incumplimiento de funciones. Señalan que existe inconformidad en el sector agricultor y denuncian que se estaría beneficiando a grandes productores, dejando a un lado a los pequeños. Burbano manifestó que existen preguntas que el Ministro de Agricultura no respondió durante su última comparecencia. Por su parte, Guevara destacó que los representantes de las distintas cadenas agroproductivas solicitan que se mantenga el precio oficial mínimo de sustentación del arroz, que era $35,50.', 'Si no se sustenta el trabajo realizado por el Señor Ministro Rubén Floren en el MAG durante su tiempo de gestión, podría ocasionar la salida del Ministro de la institución por presiones políticas.', 'http://ecuadorinmediato.com/index.php?module=Noticias&func=news_user_view&id=2818836840&umt=asambleedstas_consideran_que_ministro_de_agricultura_debereda_ir_a_juicio_poledtico', '000Ninguno', '2018-05-16 22:04:02', '2018-05-16 22:04:02', 10, '', 'Concurrir cuantas veces sea convocado a la Asamblea y documentadamente para contestar todas las preguntas que presenten los asambleístas respecto al trabajo realizado en el MAG durante su tiempo de gestión.'),
(58, 2, 1, '2018-05-11 05:10:00', 'Asambleístas consideran que ministro de Agricultura debería ir a juicio político.', 'Los legisladores Fernando Burbano y Verónica Guevara impulsan la posibilidad de realizar un juicio político contra el ministro de Agricultura y Ganadería, Rubén Flores, por supuesto incumplimiento de funciones. Señalan que existe inconformidad en el sector agricultor y denuncian que se estaría beneficiando a grandes productores, dejando a un lado a los pequeños. Burbano manifestó que existen preguntas que el Ministro de Agricultura no respondió durante su última comparecencia. Por su parte, Guevara destacó que los representantes de las distintas cadenas agroproductivas solicitan que se mantenga el precio oficial mínimo de sustentación del arroz, que era $35,50', 'Si no se sustenta el trabajo realizado por el Señor Ministro Rubén Floren en el MAG durante su tiempo de gestión, podría ocasionar la salida del Ministro de la institución por presiones políticas.', 'http://ecuadorinmediato.com/index.php?module=Noticias&func=news_user_view&id=2818836840&umt=asambleedstas_consideran_que_ministro_de_agricultura_debereda_ir_a_juicio_poledtico', '000Ninguno', '2018-05-16 22:10:02', '2018-05-16 22:10:02', 10, '', 'Concurrir cuantas veces sea convocado a la Asamblea y documentadamente para contestar todas las preguntas que presenten los asambleístas respecto al trabajo realizado en el MAG durante su tiempo de gestión.'),
(59, 2, 1, '2018-05-14 05:14:00', 'Agricultores se tomaron por una hora instalaciones de ministerio en Guayaquil', 'Alrededor de 150 agricultores, entre arroceros, maiceros, cacaoteros y otros, de Guayas, Los Ríos y Manabí, se tomaron el 14 de mayo por cerca de una hora las instalaciones del Ministerio de Agricultura y Ganadería (MAG), en Guayaquil. El motivo de la protesta fue solicitar al presidente de la República, Lenín Moreno, la salida del titular del MAG, Rubén Flores. \r\nManuel Gonzaga, presidente del Pueblo Montubio del Ecuador, indicó que el ministro tiene desatendido al sector agropecuario y que no ha accedido a los pedidos de los productores, como el de eliminar la franja de precios para el arroz y maíz. \"Ha hecho caso siempre a los agroindustriales, a los exportadores y no a los pequeños agricultores\", mencionó Gonzaga, tras acotar que si hasta el 25 de mayo el presidente Moreno no los atienden \"haremos una movilización masiva, a nivel nacional, para que nos pueda atender”.\r\nMiguel Ferruzola, director Provincial Agropecuario del Guayas, señaló que la protesta de los agricultores tiene tinte político.', 'Se debe crear y buscar espacios de participación del Sr Ministro de Agricultura para que exponga todas las dudas generadas por los agricultores y se pueda viabilizar acciones que cubran las necesidades de los mismos; para que de esta manera no se ponga en riesgo la salida el Ministro del MAG.', 'https://www.eltelegrafo.com.ec/noticias/economia/4/agricultores-ministerio-protesta-guayaquil', '000Ninguno', '2018-05-16 22:14:41', '2018-05-16 22:14:41', 10, '', 'El MAG coordinará continuamente con las entidades competentes: gobernaciones, intendencias, Superintendencia de Control de Poder del Mercado, Agencia de Regulación y Control Fito y Zoosanitario (Agrocalidad), Senae, el cumplimiento del marco legal y la observancia de los precios vigentes en base a un control permanente, para precautelar que todos los eslabones del sistema productivo actúen bajo los principios de transparencia, buenas prácticas comerciales y competencia leal. Adicionalmente que se cumpla con el  Código Integral Penal que establece sanción privativa de uno a tres años para quien no pague los precios establecidos.'),
(60, 2, 2, '2018-05-15 05:58:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero.', 'o	Baja priorización de esta problemática.                                                                                                                                                                                                                                               \r\n\r\no	Demora en convocatoria para reunión de los Comité de Seguridad.', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '1526511529-Anexos alertas.rar', '2018-05-16 22:58:49', '2018-05-16 22:58:49', 10, '', 'Solución propuesta (principal): Si bien la seguridad no es competencia del MAP, desde su perspectiva se busca evidenciar el problema mediante la recolección de información proveniente de entidades con competencia en materia de seguridad. Con esta acción se busca se analice y se propongan soluciones en las reuniones de los Comités de Seguridad provinciales.\r\nAcción realizada: Se generaron documentos de análisis de eventos, amenazas y riesgos sobre el sector pesquero y acuícola, de las provincias de Esmeraldas y Santa Elena y se la remitió a los respectivos Gobernadores para que promuevan reunión de Comités de Seguridad.\r\n\r\nSe solicitó información al Departamento de Estadística del ECU 911 correspondiente a marzo y abril de 2018'),
(61, 1, 3, '2018-05-16 06:25:00', 'Proyecto “ZEDE-QUITO”', 'La Empresa Pública Metropolitana de Servicios Aeroportuarios (EPMSA) requiere que se realice desmembramiento de una parte del terreno de la Zona Franca del Nuevo Aeropuerto Internacional Mariscal Sucre de Quito para proceder con la solicitud de establecimiento de dicho terreno como ZEDE.', 'Que no se emita el Decreto Ejecutivo donde se resuelva el desmembramiento del terreno solicitado (205.1).', 'Subsecretaría de Desarrollo Territorial', '000Ninguno', '2018-05-16 23:25:46', '2018-05-31 04:10:00', 10, '', 'Que el Presidente de la República mediante Decreto Ejecutivo libere 205.1 hectáreas de la Zona Franca del Nuevo Aeropuerto Internacional Mariscal Sucre de Quito para la declaratoria de la ZEDE QUITO.'),
(62, 2, 3, '2018-05-16 07:59:00', 'Programa Exporta Fácil – Quejas por servicio logístico del programa', 'En la última semana se han recibido quejas por parte de los clientes que usan el Programa Exporta Fácil; han señalado, falta de cumplimiento de los tiempos que se ofertan para arribo de mercadería además de la demora en cuanto a la celeridad en dar soluciones a las quejas realizadas.  El Ministerio de Industrias y Productividad ha puesto en conocimiento de los miembros del Comité de Exporta Fácil sobre estas particularidades para su intervención en la mejora integral del servicio logístico referido, y han manifestado que serán abordados en la siguiente sesión.', '1.- Los usuarios que se han visto afectados por el Programa Exporta Fácil podrían tomar medidas de presión mediáticas, al no tener solución inmediata a sus requerimientos.\r\n2.- El Programa Exporta Fácil podría presentar una reducción paulatina en el registro de atención tanto de los actuales como de los nuevos Mipymes, artesanos, emprendedores o unidades productivas de las EPS.', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '000Ninguno', '2018-05-17 00:59:43', '2018-05-17 00:59:43', 10, '', 'Se considera de carácter urgente, realizar la debida mejora de los procesos operativos y proveer los recursos financieros a la Empresa Pública Correos del Ecuador, en relación a los aspectos operativos internos  que permitan reactivar la empresa y brindar el servicio que oferta.'),
(63, 2, 1, '2018-05-16 01:22:00', 'Escasos técnicos para asistencia agropecuaria en Tungurahua.', 'Según las estadísticas arrojadas por el Instituto Nacional de Estadísticas y Censos (INEC), en Tungurahua existen cerca de 75 mil 285 hectáreas de cultivos. En su mayoría son pequeños agricultores los que requieren de acompañamiento. Esta necesidad es evidente en la ciudadanía que mira con mucha preocupación la falta de técnicos que aporten al desarrollo de sus actividades. En 2012 el Ministerio de Agricultura y Ganadería (MAG) implementó la Estrategia Hombro a Hombro, para que los agricultores sean atendidos en el territorio, y a través de este programa se crearon también las Unidades de Asistencia Técnica. En varias parroquias de la provincia, hasta el año pasado en estas unidades los profesionales brindaban atención a los productores. Los expertos visitaban y acompañaban en actividades agrícolas y ganaderas. Sin embargo, desde este año la ausencia de técnicos en varios sectores mantiene molestos a los productores.', 'La falta de técnicos en territorio dificulta la atención solicitada por los productores en actividades agropecuarias; lo que conlleva a que exista molestia por parte de este sector en las provincias que se brinda esta ayuda.', 'https://lahora.com.ec/tungurahua/noticia/1102157129/escasos-tecnicos-para-asistencia-agropecuaria-en-tungurahua', '000Ninguno', '2018-05-23 18:22:25', '2018-05-23 18:22:25', 11, 'Institucional', 'Ante la falta de técnicos, sean agrícolas o pecuarios, en territorio la solución propuesta sería una articulación interinstitucional mediante vinculación con la comunidad y pasantías pre profesionales de estudiantes de los últimos años de las carreras de ingeniería agronómica, medicina veterinaria y zootecnia, y otras carreras afines a los productos y servicios que brinda la institución.'),
(64, 2, 1, '2018-05-20 01:38:00', 'Producir es el camino', 'La estadística es fría.  Nos revela la realidad, sin maquillaje. A veces es dura, pero es necesaria. En el Ecuador, el Instituto Ecuatoriano de Estadísticas y Censos es el encargado de proporcionar datos sobre la situación del país. En marzo de este año emitió un reporte sobre el estado del empleo. La cosa es grave. Las cifras dicen que, de cada 100 ecuatorianos en edad de trabajar, solo 41 tienen un trabajo completo; es decir, con un sueldo equivalente o superior al mínimo, con afiliación al Seguro Social y con todas las garantías necesarias. Las otros 59 están subempleados; trabajan unas pocas horas a la semana o, simplemente, están sin trabajo. En Loja, la cosa está peor. Menos de 35 de cada 100 personas tienen empleo completo. En Pichincha casi 60 de cada 100 trabaja en buenas condiciones. El único camino, para remediar esto, es producir. Claro, se dice fácil, pero, es un tema complejo. No hay condiciones estructurales que incentiven la generación de nuevas empresas productoras de bienes y servicios. Tampoco hay infraestructura adecuada. Cuando perdimos los recursos del Plan Inmediato de Riego de Loja, se fueron las posibilidades de avanzar con instalaciones elementales. Tampoco existe decisión política para, por ejemplo, mecanizar el agro, dotando de un tractor a cada junta parroquial rural. En el caso de Loja eso sería una inversión inferior a los cinco millones de dólares.', 'El sector agropecuario contribuye significativamente al desarrollo urbano-industrial con alimentos y con la generación de divisas producto de sus exportaciones; si se descuida yno se atiende como se debe a este sector las consecuencias serían graves afectando al desempleo de varios ciudadanos así como al país en general.', 'https://lahora.com.ec/loja/noticia/1102157950/producir-es-el-camino', '000Ninguno', '2018-05-23 18:38:20', '2018-05-23 18:38:20', 11, 'Institucional', 'Implementar más centros de mecanización agrícola para entregar a las asociaciones de productores, y que sean administrados directamente luego de la asistencia técnica del MAG, los líderes pasen a administrarlas directamente.'),
(65, 2, 1, '2018-05-21 02:15:00', 'Sorprendentes declaraciones realizó el Ministro de Agricultura en Redes Sociales', 'El ministro de Agricultura y Ganadería, Rubén Flores ha declarado, en un discurso cuyo vídeo ha empezado a circular en redes sociales este fin de semana, que “hay sectores que pagan un millón y medio de dólares por el puesto de ministro”. Flores es ministro desde el pasado 18 de octubre, cuando reemplazó a Vanessa Cordero, quien duró menos de cinco meses en el cargo.\r\nEl asambleísta Héctor Yépez envió una solicitud al titular de la cartera de Estado para que acuda a la Asamblea Nacional y aclare sus palabras ya que este tipo de denuncias no pueden quedar en el aire. “He requerido que el ministro aclare qué sectores están ofreciendo un millón y medio de dólares, ¿a quién le han ofrecido?, ¿cuándo?, ¿cómo? Y si a él que ocupa el puesto le han hecho esa oferta, le han pagado o no por estar en el puesto”. Con esto coincide el asambleísta Luis Fernando Torres (PSC). “Las declaraciones del Ministro de Agricultura son gravísimas. Tiene que ser investigada políticamente en la Asamblea Nacional, y la Fiscalía igualmente debería proceder de oficio ya que lo que dice el ministro prácticamente es la comisión de un delito”', 'Las declaraciones que se remiten en medio público deben estar sustentadas ay corroboradas para evitar especulaciones y que desencaminen en malos entendidos.', 'https://www.youtube.com/watch?v=n6YuzucBRbU', '000Ninguno', '2018-05-23 19:15:08', '2018-05-23 19:15:08', 11, 'Institucional', 'Preparar una estrategia política que contribuya a clarificar que el cargo de Secretario de Estado en el MAG no tiene precio, sino que se obtiene por la capacidad, trabajo y experiencia de quien  lo asume.'),
(66, 2, 1, '2018-05-22 02:18:00', 'Agricultores retoman las protestas en Babahoyo', '‘Fuera Ministro, fuera’. Ese era el grito de decenas de agricultores la mañana de este 21 de mayo en las inmediaciones de la Dirección Provincial del Ministerio Agricultura y Ganadería (MAG), quienes una vez más volvieron a manifestar su descontento por el vaivén en el precio del arroz. Ángel Calero protestó debido a que por varias ocasiones se han establecido hojas de ruta con el ministro de Agricultura, Rubén Flores, para mejorar la condición de los productores, sin embargo ninguno de esos acuerdos se habría cumplido. El director provincial del MAG, Juan Bustamante, sostuvo que el control del precio es bastante complicado en las piladoras, pero aseguró que se está trabajando coordinadamente. “Estamos actuando de manera conjunta con el Intendente, comisarios y jefes políticos de cada territorio del cantón fluminense”, afirmó tras las denuncias verbales de los pequeños y medianos productores.', 'La discontinuidad del dialogo entre el Ministro y los agricultores para remitir información y aclarar las dudas existentes, haría que se prolonguen  y continúen mas protestas.', 'https://lahora.com.ec/losrios/noticia/1102158433/agricultores-retoman-las-protestas-en-babahoyo', '000Ninguno', '2018-05-23 19:18:08', '2018-05-23 19:18:08', 11, 'Institucional', 'Abrir un diálogo entre las  autoridades del MAG y  la UNA-EP en Babahoyo para que esta entidad pueda comprar una mayor cantidad de arroz a los productores y se mejore la atención.\r\n\r\nContinuar coordinando con las entidades competentes: gobernaciones, intendencias, Superintendencia de Control de Poder del Mercado, Agencia de Regulación y Control Fito y Zoosanitario (Agrocalidad), Senae, SRI para hacer respetar los precios determinados en los acuerdos ministeriales tanto en lo referente al arroz, maíz y banano.'),
(67, 2, 1, '2018-05-22 02:21:00', 'Agricultores abandonan sus tierras y migran a las ciudades.', 'Pujilí es el cantón con mayor índice de migración interna; la mayoría de familias se han ido a ciudades cercanas como Latacunga, Saquisilí y un tanto a las grandes ciudades como Quito, Guayaquil y Cuenca. Uno de los problemas de mayor impacto que atraviesan las comunidades en los últimos años es la migración de familias completas, este fenómeno a decir de los dirigentes comunitarios es por falta de apoyo gubernamental para la agricultura y ganadería.', 'La migración de agricultores pondría en riesgo las tierras cultivadas lo que ocasiona que que país no genere tanta producción alimenticia que genere valor agregado e ingresos al país.', 'https://lagaceta.com.ec/agricultores-abandonan-sus-tierras-y-migran-a-las-ciudades/', '000Ninguno', '2018-05-23 19:21:55', '2018-05-23 19:21:55', 11, 'Institucional', 'Fortalecer el desarrollo agropecuario y generar empleo para que las futuras generaciones no emigren a la ciudad y encuentren en el campo su desarrollo.\r\nInyectar al campo conocimiento y tecnología para que el país no solo produzca alimentos primarios sino elaborados  que generen valor agregado y el país pueda ingresar al mercado internacional.'),
(68, 2, 3, '2018-05-16 04:27:00', 'Notificación de Terminación por Mutuo Acuerdo del Convenio Marco proceso del SERCOP-SELPROV-063-2016', 'El 04 de mayo de 2018 vía oficio Nro. SERCOP-DCE—2018-0545-OF, el Sercop notificó a la empresa Tenaris la terminación por Mutuo Acuerdo del Convenio Marco de proceso SERCOP-SELPROV-063-2016, tubería sin costura, en base de las observaciones determinadas en el Informe técnico de revisión de tratamiento de hallazgos de auditoría de verificación e informe de viabilidad técnica., concediéndole 10 días a fin de que remita el Acta de Terminación por Mutuo Acuerdo debidamente firmada.', 'Cierre de una planta que contó con una inversión extrajera de US$16 millones (en activos no corrientes) y sus consecuentes beneficios en generación de empleo, sustitución de importaciones, disminución de salida de divisas y la nueva inversión para aumentar la capacidad productiva.', 'Subsecretaría de Industrias Intermedias y Finales', '1527114611-Notificación para cierre.pdf', '2018-05-23 21:27:30', '2018-05-23 22:30:11', 11, 'Presidencia', 'SERCOP debe reconsiderar su pronunciamiento sobre la terminación por Mutuo Acuerdo del Convenio Marco de proceso SERCOP-SELPROV-063-2016. \r\n\r\nPara el efecto el MIPRO remitió al SERCOP, el oficio MIPRO-MIPRO-2018-0850-OF solicitando considerar detenidamente los argumentos utilizados para dar\r\npor terminado el Convenio Marco antes mencionado.'),
(69, 2, 2, '2018-05-22 05:03:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', 'o	Baja priorización de esta problemática\r\no	Demora en convocatoria para reunión de los Comité de Seguridad', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '1527113028-Correo recibido ECU911 eventos maritimos.pdf', '2018-05-23 22:03:48', '2018-05-23 22:03:48', 11, 'Presidencia', 'Solución propuesta (principal): Si bien la seguridad no es competencia del MAP, desde su perspectiva se busca evidenciar el problema mediante la recolección de información proveniente de entidades con competencia en materia de seguridad. Con esta acción se busca se analice y se propongan soluciones en las reuniones de los Comités de Seguridad provinciales.\r\n\r\nAcción realizada: el departamento de Estadística del ECU911 comparte a la Dirección de Riesgos de este Ministerio, el registro de eventos peligrosos que se suscitan y son una amenaza para el sector pesquero artesanal y acuícola. Esta información será analizada y se generarán los reportes correspondientes a marzo y abril de 2018.'),
(70, 2, 1, '2018-05-23 01:08:00', 'Asambleísta pide informe a ministro Flores', 'El asambleísta del movimiento CREO, Héctor Yépez, en entrevista con Radio Sucre, señala “la preocupación que tenemos los agricultores y por declaraciones del ministro de Agricultura (Rubén Flores), que ha dicho hace poco que hay sectores que pagan un millón y medio de dólares por su puesto. Oiga, esa declaración es gravísima. Yo he pedido que él informe ¿qué sectores?, ¿a quién?, ¿cuándo?, ¿si a él le ofrecieron o no algo porque él está ahorita en el puesto? Esto es grave porque, ¿quién nombra a los ministros? El presidente de la República. Entonces, ¿qué está implícito en esa aseveración?, ¿a quién le pagan? Al presidente. Yo no quiero creer eso, pero por favor…”. Pregunta el periodista: ¿el ministro va a continuar? Yépez respondió: “Yo no sé, eso solo le corresponde decidirlo al presidente Lenín Moreno, y ojalá si lo sacaran no venga alguien peor que él, porque aquí lo de fondo no es cambiar ministros, lo de fondo es cambiar las políticas para ayudar a los agricultores, a nuestros montuvios, indígenas y ganaderos en el Ecuador”.', 'Para evitar confrontaciones y falsas divulgaciones se debe fundamentar las aseveraciones que se generan en los medios sociales.', 'https://www.facebook.com/radiosucre/videos/1753391414710604/)', '000Ninguno', '2018-05-30 18:08:28', '2018-05-30 18:08:28', 12, 'Institucional', 'Elaborar una estrategia política que contribuya a minimizar el impacto de estas declaraciones.'),
(71, 2, 1, '2018-05-24 01:13:00', 'Movilización para exigir salida de ministro de Agricultura.', 'La Federación Única Nacional de Afiliados al Seguro Social Campesino anunciaron movilizaciones en Guayaquil para exigir la salida de Rubén Flores como ministro de Agricultura.', 'Difundir los logros alcanzados por el Ministerio de Agricultura bajo el mando del Sr. Ministro Rubén Flores; de esta manera se evitará movilizaciones y protestas; así también generar espacios de diálogos con la Federación Única Nacional de Afiliados al Seguro Social Campesino para comunicar lo que se ha realizado en la gestión del ministro Flores.', 'https://www.youtube.com/watch?v=KmWIvaGTbUk', '000Ninguno', '2018-05-30 18:13:09', '2018-05-30 18:13:09', 12, 'Institucional', 'Continuar con la entrega de productos financieros y no financieros en territorio dando prioridad a los sectores productivos más representativos del sector rural.'),
(72, 2, 1, '2018-05-24 01:15:00', 'Trabajadores bananeros alegan que se están violando sus derechos con nueva modalidad de contratación', 'Jorge Acosta, coordinador de la Asociación de Trabajadores Agrícolas y Campesinos, refirió que la labor en las plantaciones bananeras es un trabajo continuo e intensivo, no es temporal o por ciclos, se exporta banano las 52 semanas del año, con temporadas altas y bajas. Ahora, los trabajadores de campo, o de cosecha o empaque están laborando 8 horas diarias, cinco días a la semana, en su mayoría. Dijo que le preocupa que a los trabajadores bananeros se les pague sin fórmula de salario básico. Lo preocupante, refirió, es que el actual Ministerio del Trabajo, profundiza esa práctica salarial violando los derechos de los trabajadores del sector, pues se dice que se va a trabajar 36 horas a la semana, 6 horas al día, \"eso es inaplicable, ese es un argumento falso que no se da en el sector bananero\".', 'Si no se realizan espacios de diálogos para generar una solución a las alegaciones de los trabajadores bananeros, desencadenaría en posibles protestas y huelgas que debilitarían a la producción del banano.', 'www.ecuadorenvivocom/economía/85-sp-651/', '000Ninguno', '2018-05-30 18:15:50', '2018-05-30 18:15:50', 12, 'Institucional', 'Impulsar el diálogo nacional y el trabajo digno a través de la socialización del Manual de Seguridad y Salud para la Industria Bananera entre productores, exportadores, trabajadores, asociaciones, gremios, sindicatos y representantes del sector bananero, promoviendo esta guía enfocadas a asegurar un trabajo digno con producción sostenible.'),
(73, 2, 1, '2018-05-26 01:19:00', 'Caso de contrabando de cebolla', 'Policía retuvo dos camiones cargados de cebolla. La propietaria del producto informó que trajo alrededor de 250 quintales de cebolla peruana para comerciar a manera de contrabando en Ecuador. “Es de contrabando para que voy a decir lo que no es”. La ciudadana peruana denunció además que fue extorsionada por miembros de la policía que le solicitaban dinero para pasar el producto. “El capitán Córdova manda a coger, le dicen los supuestos extorsionadores”, señaló. Son 8 dueños de esta mercadería.', 'La falta de control al contrabando de productos afectaría la producción de los mismos; se deben continuar con el control fronterizo, poniendo énfasis en la calidad el control.', 'www.facebook.com/aldiacomecvideos/1627450754033219/)', '000Ninguno', '2018-05-30 18:19:50', '2018-05-30 18:19:50', 12, 'Institucional', 'Coordinar con el Ministerio del Interior para que  recepten denuncias contra uniformados que mediante la extorsión  contribuyen al contrabando. Realizar una mesa técnica interinstitucional para la organización de operativos de control local donde las instituciones presenten sus procedimientos en torno al control del contrabando con la participación de los productores, que puedan ejercer la función de veedores.'),
(74, 2, 2, '2018-05-29 04:24:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', '•	El riesgo de la actividad es que la georreferenciación de los eventos no mantenga el mismo formato.\r\n\r\n•	Si esta actividad no se realiza, se carece de elementos para evidencias la problemática', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '000Ninguno', '2018-05-30 21:24:15', '2018-05-30 21:24:15', 12, 'Institucional y Presidencia', 'Si bien la seguridad no es competencia del MAP, desde su perspectiva se busca evidenciar el problema mediante la recolección de información proveniente de entidades con competencia en materia de seguridad. Con esta acción se busca se analice y se propongan soluciones en las reuniones de los Comités de Seguridad provinciales.'),
(76, 2, 2, '2018-06-05 03:06:00', 'Alto índice de delincuencia que afecta al sector camaronero y pesquero', '<p>Alto &iacute;ndice de delincuencia que afecta al sector camaronero y pesquero</p>', '<p>- El riesgo de la actividad es que el ECU 911 no env&iacute;e los eventos de delincuencia que afectan al sector camaronero y pesquero con su respectiva georreferenciaci&oacute;n.</p>\r\n\r\n<p>- Si esta actividad no se realiza, se carece de elementos para evidenciar la ubicaci&oacute;n de los eventos que afectan al sector pesquero artesanal y acu&iacute;cola.</p>', 'MAP - Dirección de Riesgos Sectoriales y Dirección de Pesca Artesanal', '000Ninguno', '2018-06-06 20:06:06', '2018-06-06 20:07:13', 13, 'Institucional', '<p>El Ministerio de Acuacultura y Pesca recibe peri&oacute;dicamente desde la Direcci&oacute;n Nacional de An&aacute;lisis de Datos del ECU911 informaci&oacute;n sobre eventos peligrosos que afectan al sector pesquero y acu&iacute;cola. Con esta informaci&oacute;n se busca conocer esta problem&aacute;tica y como var&iacute;a en el tiempo. Si bien el tema de la inseguridad no es una competencia de este Ministerio, es de mucho inter&eacute;s evidenciar esta situaci&oacute;n y compartirla con otras entidades que tienen competencia en materia de seguridad y de esta manera motivar el desarrollo de acciones en el mediano y largo plazo.</p>'),
(77, 1, 1, '2018-05-31 05:04:00', 'Asambleísta Guevara señala que presidenta de la Asamblea protege a ministro del MAG.', '<p>La asamble&iacute;sta Ver&oacute;nica Guevara, expuso en el programa L&iacute;nea Dura, conducido por el periodista Luis Ramiro Pozo, que se transmite por Facebook sobre la gesti&oacute;n del ministro de Agricultura y Ganader&iacute;a, Rub&eacute;n Flores. Se&ntilde;al&oacute; que el sector agropecuario es altamente vulnerable por su propia actividad. &ldquo;Casualmente el 31 de mayo est&aacute; anunciado un paro nacional agropecuario en el que todos los agricultores de las diferentes cadenas agroproductivas van a salir a reclamar, justamente, &iquest;por qu&eacute;? Porque no se est&aacute; cumpliendo con el programa de la Gran Minga Agropecuaria&rdquo;.</p>\r\n\r\n<p>Agreg&oacute; que &ldquo;tenemos un ministro que miente a los agricultores&rdquo;&nbsp; e indic&oacute; que en el proceso de di&aacute;logos no se respeta lo que los agricultores dicen.</p>\r\n\r\n<p>Cuestion&oacute; la vigencia de la franja de precios para la venta del arroz, que seg&uacute;n ella elimin&oacute; el precio m&iacute;nimo de sustentaci&oacute;n, y afirm&oacute; que mientras el precio baja en el campo no sucede lo mismo con el precio al consumidor.</p>\r\n\r\n<p>Indic&oacute; que ha propuesto una resoluci&oacute;n en la sesi&oacute;n 510 para que el ministro Rub&eacute;n Flores comparezca y responda las preguntas que tienen los asamble&iacute;stas para hacerle, pero critic&oacute; la actitud de la presidenta Elizabeth Cabezas, quien &ldquo;no puede darle prioridad al sector agropecuario y suspende las sesiones para proteger a este ministro&rdquo;.&nbsp;La asamble&iacute;sta Guevara consider&oacute; que el ministro Flores &ldquo;es el ministro de los industriales y de los comercializadores&rdquo;.&nbsp; Reiter&oacute; su pedido de juicio pol&iacute;tico al ministro del MAG, Rub&eacute;n Flores.</p>', '<h6 class=\"media-heading\">&nbsp;</h6>\r\n\r\n<h4 class=\"media-heading\">La falta de atenci&oacute;n a esta problem&aacute;tica, podr&iacute;a derivar en causales de contrabando, as&iacute; tambi&eacute;n en protestas y manifestaciones</h4>', 'https://www.facebook.com/lineaduraec/videos/2081691608766802/', '000Ninguno', '2018-06-06 22:04:00', '2018-06-06 22:04:00', 13, 'Institucional', '<p>Fortalecer la presencia de productores en los medios de comunicaci&oacute;n para que expongan sus testimonios de los beneficios recibidos a trav&eacute;s de la Gran Minga Nacional Agropecuaria. Definir una estrategia pol&iacute;tica para clarificar que la experiencia y el trabajo efectuado en favor de los agricultorestienen el reconocimiento de las principales autoridades del Gobierno Nacional.</p>');
INSERT INTO `csp_reportes_alertas` (`id`, `estado_reporte_id`, `institucion_id`, `fecha_atencion`, `tema`, `descripcion`, `riesgo_principal`, `fuente`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`, `solucion_propuesta`) VALUES
(78, 2, 1, '2018-06-03 05:07:00', 'Un futuro nefasto para el arroz', '<p>El r&eacute;gimen fij&oacute; este a&ntilde;o un precio piso de 32,50 y un techo de 35,50 d&oacute;lares por la saca de 200 libras en c&aacute;scara. En la zona conocida como Cedeg&eacute; en la v&iacute;a Babahoyo y Montalvo, en la provincia de Los R&iacute;os, los productores peque&ntilde;os est&aacute;n vendiendo parte de sus tierras para volver a sembrar, pero el riesgo es el mismo: precios bajos.</p>\r\n\r\n<p>Est&aacute; claro que con un a&ntilde;o m&aacute;s de precios bajos esa provincia ser&aacute; la m&aacute;s afectada: est&aacute; en zona baja y depende mucho del agua que caiga en el invierno y que se acumula para el verano. All&iacute; se produce el 30 % del total del arroz ecuatoriano. Por tanto la productividad es baja y los costos altos<strong><em>. </em></strong>Y es que, por ser una zona en su mayor&iacute;a baja, los campesinos no pueden cambiarse al cacao ni a cualquier otro cultivo perenne. Hoy, por eso, la gente sigue sembrando tambi&eacute;n con el dinero que a&uacute;n prestan o que les env&iacute;an sus familiares del exterior o de los hijos que viven y trabajan en las ciudades. Pero eso no es factible en el tiempo.</p>\r\n\r\n<p><strong>&ldquo;</strong>Los que tienen diez hect&aacute;reas venden cuatro para pagar las deudas a BanEcuador o a los chulqueros y con otra parte vuelven a sembrar&rdquo;, dice Washington N&uacute;&ntilde;ez, productor de arroz.</p>\r\n\r\n<p>En Guayas hay decepci&oacute;n. &ldquo;No vemos que el ministro tome las cosas en serio; sino que digan qu&eacute; est&aacute;n haciendo para solucionar el problema&rdquo;, agrega Julio Carchi, al sugerir una urgente intervenci&oacute;n del Estado en la compra de arroz.</p>', '<h4>La falta de atenci&oacute;n a esta problem&aacute;tica, podr&iacute;a derivar en causales de contrabando.</h4>', 'https://www.pressreader.com/ecuador/diario-expreso/20180603/281694025465327', '000Ninguno', '2018-06-06 22:07:56', '2018-06-06 22:07:56', 13, 'Institucional', '<p>Abrir nuevos mercados para la exportaci&oacute;n de la gram&iacute;nea y que se libere el 12% del IVA alos insumos agr&iacute;colas, de manera que disminuyan los costos de producci&oacute;n y los agricultores obtengan mayores ganancias.</p>'),
(79, 1, 1, '2018-06-05 05:15:00', 'Asambleísta Yépez: “el agro está en crisis nacional”', '<p>El pleno de la Asamblea Nacional tratar&aacute; el pedido del asamble&iacute;sta de CREO, H&eacute;ctor Y&eacute;pez, sobre el juicio pol&iacute;tico al ministro de Agricultura y Ganader&iacute;a, Rub&eacute;n Flores, por declaraciones publicadas en un v&iacute;deo institucional que se filtr&oacute; en redes sociales. &ldquo;Ahora, bien, el ministro de Agricultura, hace ya algunas semanas dijo en un evento p&uacute;blico que hay sectores que pagan un mill&oacute;n y medio de d&oacute;lares por el cargo de ministro. Esa afirmaci&oacute;n es grav&iacute;sima y yo he planteado al pleno, a ver, el ministro tiene que venir ac&aacute; a puntualizar &iquest;qu&eacute; sectores pagan?, con nombre y apellido, &iquest;a qui&eacute;nes le han pagado?&rdquo;.</p>\r\n\r\n<p>Agreg&oacute; que tambi&eacute;n desea consultarle &ldquo;si &eacute;l est&aacute; ah&iacute; sentado en el cargo si a &eacute;l le han ofrecido o &eacute;l ofreci&oacute; algo para sentarse y por &uacute;ltimo esta aseveraci&oacute;n ofende, compromete al presidente Len&iacute;n Moreno, porque que yo sepa el Presidente es el &uacute;nico en este pa&iacute;s que pone o cambia ministros. Entonces, lo que se est&aacute; sugiriendo por parte del se&ntilde;or ministro de Agricultura, pues &iquest;qui&eacute;n recibe ese mill&oacute;n y medio de d&oacute;lares?&rdquo;</p>', '<p>Informaci&oacute;n que genera malos entedidos, y desinformaci&oacute;n</p>', 'https://wetransfer.com/downloads/16c34b84404fb14e204b2293bbb387a220180605155130/afb39e5a453b8c51cbf253da9debd86620180605155130/e633c2).', '000Ninguno', '2018-06-06 22:15:19', '2018-06-06 22:15:19', 13, 'Institucional', '<p>Preparar toda la informaci&oacute;n respectiva para asistir a la Asamblea las veces que sean necesarias.</p>'),
(80, 2, 3, '2018-06-07 09:52:00', 'Norma expedida por Setec que contrapone lo establecido en Código Ingenios y Ley del Sistema de Calidad.', '<p>La Norma para Organismos Evaluadores de la Conformidad emitido por Setec fue revisada en la Segunda Sesi&oacute;n Ordinaria del Comit&eacute; realizada el 22 de mayo de 2018 a solicitud de Mipro, en virtud de la inconsistencia de dicha norma con lo dispuesto en el art&iacute;culo 37 del C&oacute;digo Org&aacute;nico de la Econom&iacute;a Social de los Conocimientos, Creatividad e Innovaci&oacute;n.</p>', '<p>Inclumplimiento de la Normativa del C&oacute;digo Ingenios y Ley del Sistema de Calidad</p>', 'Coordinación General de Servicios para la Producción, Juan Francisco Ballén', '000Ninguno', '2018-06-07 14:52:50', '2018-06-07 14:52:50', 14, 'Institucional', '<p>Revisi&oacute;n de la Norma sobre Organismos Evaluadores de la Conformidad por parte del Comit&eacute; Interinstitucional del Sistema Nacional de Cualificaciones Profesionales considerando la exposici&oacute;n de motivos que en reuni&oacute;n t&eacute;cnica realice la Directora del Servicio de Acreditaci&oacute;n Ecuatoriano.</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_reportes_hechos`
--

CREATE TABLE `csp_reportes_hechos` (
  `id` int(10) UNSIGNED NOT NULL,
  `institucion_id` int(11) NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_reporte` datetime NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `porcentaje_avance` int(11) NOT NULL,
  `lineas_discursivas` text COLLATE utf8mb4_unicode_ci,
  `anexo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `periodo_id` int(11) NOT NULL,
  `tipo_comunicacional` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_reportes_hechos`
--

INSERT INTO `csp_reportes_hechos` (`id`, `institucion_id`, `tema`, `descripcion`, `fuente`, `fecha_reporte`, `lugar`, `porcentaje_avance`, `lineas_discursivas`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`) VALUES
(1, 3, 'Suscripción de convenio de cooperación interinstitucional entre  el Ministerio de Industrias y Productividad y BanEcuador B.P.', 'Convencidos de continuar con el fortalecimiento del aparato productivo del país  el Ministerio de Industrias y Productividad ha encaminado sus esfuerzos hacia la inserción del Ecuador en el mercado mundial con bienes y servicios de alta calidad y gran valor agregado. Nuestra Carta Magna determina el mejoramiento al acceso de financiamiento productivo a través del sistema financiero público, privado y de la economía popular y solidaria, por tal razón se suscribe el convenio de Cooperación Interinstitucional entre el Ministerio de Industrias y Productividad y BANECUADOR B.P.', 'Coordinación General de Servicios,Denis Zurita', '2018-03-12 11:07:00', 'Universidad San Gregorio de Portoviejo', 100, 'El Ministerio de Industrias y Productividad y BanEcuador B.P, suscribieron el Convenio de Cooperación Interinstitucional, con el cual se impulsará la colocación de créditos a través de la banca pública destinado a emprendedores, artesanos, micro, pequeñas y medianas empresas, en la búsqueda de fomentar el desarrollo y la transformación de nuevos o mejorados productos que apunten al mejoramiento de la estructura productiva del país, a través de las líneas tradicionales y productos del Banco del Pueblo, que actualmente tiene BanEcuador B.P.', '000Ninguno', '2018-03-14 04:07:07', '2018-03-16 19:25:08', 1, ''),
(2, 3, 'Aprobación de la Agenda de Coordinación Intersectorial del Consejo Sectorial de la Producción - ACI', 'La ACI es el instrumento de planificación en el que se plasman las políticas, estrategias e instrumentos transversales del Sector Productivo; así como, la complementariedad con otros Consejos Sectoriales, con el propósito de alcanzar los objetivos del PND 2017-2021, de acuerdo a las necesidades y características del territorio.', 'Coordinación General de Planificación y Gestión Estratégica', '2018-03-12 02:06:00', 'Portoviejo - Manabí', 100, 'El Consejo Sectorial de la Producción, aprobó la Agenda de Coordinación Intersectorial de la Producción (ACI), en la cual se plasman las políticas, estrategias e instrumentos transversales del Sector Productivo.', '000Ninguno', '2018-03-14 19:06:44', '2018-03-14 21:13:34', 1, ''),
(3, 3, 'Feria Mujer Emprendedora 2018', 'Institución Responsable: Ministerio de Industrias y Productividad – MIPRO\r\nDependencia: Subsecretaría de MIPYMES y Artesanías\r\nEvento: Feria Mujer Emprendedora 2018\r\nFecha: 08, 09 y 10 de marzo de 2018\r\nLugar: El lobby del subsuelo 1 de la Plataforma Financiera Gubernamental, bloque amarillo, situado en la Av. Amazonas, entre Unión de Periodistas y Alfonso Pereira, en la ciudad de Quito.\r\nParticipantes: 24 mujeres emprendedoras\r\nActividades: Capacitación, conferencias, espacios de showroom y el desarrollo de una feria productiva.\r\nPorcentaje de avance: 100 % (Ejecutado)', 'Roberto Estévez', '2018-03-14 09:22:00', 'Plataforma Gubernamental Financiera, ciudad de Quito', 100, 'El Ministerio de Industrias y Productividad (MIPRO) a través de la Subsecretaría de MIPYMES y Artesanías, en conmemoración del Día Internacional de la Mujer y con el afán de resaltar la importancia de su aporte en la economía y el desarrollo de la sociedad ecuatoriana, organizó la “Feria Mujer Emprendedora 2018” que se llevó a cabo los días 8, 9 y 10 de marzo de 2018 en las instalaciones de la Plataforma Gubernamental Financiera, en Quito. \r\n\r\nEl evento que contó con una afluencia de más de 600 visitantes durante los tres días, propició la participación de 24 emprendedoras y artesanas nacionales de los diversos sectores productivos como: alimentos y bebidas, bisutería, cosméticos, textil, calzado, entre otros.\r\n\r\nAsimismo, y en el marco de la feria, se desarrollaron actividades de capacitación, conferencias, espacios de showroom con el objetivo de fortalecer habilidades de negociación y promoción de los productos o servicios de las 24 participantes.', '000Ninguno', '2018-03-15 02:22:47', '2018-03-15 02:22:47', 1, ''),
(4, 3, 'Contratos de Inversión con el Grupo HAMDAOUI', 'Análisis previo a suscribir Contratos de Inversión con el Grupo HAMDAOUI', 'Subsecretaría de Agroindustria y Procesamiento Acuícola, Ing. Jorge Chávez', '2018-03-14 09:53:00', 'Sala de reuniones del Despacho Ministerial', 10, 'El 13 de marzo de 2018, se lleva a cabo la reunión entre autoridades de Ministerio de Industrias y Productividad y representantes del Grupo Inversionista HAMDAOUI, quienes tienen el interés de firmar contratos de inversión por un monto mínimo de dos billones de dólares para fomentar y fortalecer aparato productivo del país.', '000Ninguno', '2018-03-15 02:53:28', '2018-03-15 02:53:28', 1, ''),
(5, 3, 'Participación en Taller internacional de Armonización de las políticas nacionales en la implementación del Marco Normativo para el Fomento de Cadenas Productivas y de Valor', 'El objetivo del taller fue fortalecer y asegurar el comercio internacional a través de las Normas del CODEX Alimentarius y la Convención Internacional de Protección Fitosanitaria. En este taller se tuvo la participación de delegados de los países de Bolivia, Colombia, Chile, Perú, delegados de la FAO y Parlamentarios Andinos; en el primer día se tuvo los respectivos saludos institucionales en donde la Ministra de Industrias y Productividad, Econ. Eva García Fabre dio sus palabras de la importancia de estos eventos para el fortalecimiento de la institucionalización de CODEX en el país.', 'Subsecretaría del Sistema de la Calidad', '2018-03-14 09:54:00', 'Quito.  Asamblea Nacional', 100, NULL, '000Ninguno', '2018-03-15 02:54:53', '2018-03-15 02:54:53', 1, ''),
(6, 3, 'Reunión con representantes de la empresa ELALCO, dentro de la ejecución del Proyecto Polo Forestal', 'La Subsecretaría de Industrias Básicas expuso el proyecto de \"Polo Forestal\" el cual comprende, Líneas de Producción Forestal e Implementación de una Planta de Pulpa. Los representantes de ELALCO se comprometieron a presentar una hoja de ruta con respecto a la siembra de los árboles, los mismos que servirán de provisión de materia prima para la planta de celulosa.', 'Subsecretaría de Industrias Básicas - Dr. Claudio Arcos', '2018-03-12 10:15:00', 'Quito', 15, 'Dentro del proyecto \"Polo Forestal\" que comprende líneas de producción forestal e implementación de una Planta de Pulpa, en reunión mantenida con los representantes de EL ALTO COTOPAXI (ELALCO),  se comprometieron a presentar una hoja de ruta con respecto a la siembra de los árboles, los mismos que servirán de provisión de materia prima para la planta de celulosa.', '000Ninguno', '2018-03-15 03:15:47', '2018-03-15 03:31:02', 1, ''),
(7, 3, 'Dotación de suministro eléctrico en Posorja', 'Reunión con participación de MIPRO, MTOP, CNEL y PETROECUADOR. Con las coordenadas de la propuesta de ubicación de la Subestación Posorja II, se realizó el análisis de su impacto en la ubicación propuesta en los estudios de factibilidad para la Planta de Aluminio. Resultado del mismo existe un solapamiento de aproximadamente 8600 m2 (75x115 m) entre los dos polígonos. Se identificaron además los predios requeridos para la Subestación.', 'Subsecretaría de Industrias Básicas - Dr. Claudio Arcos', '2018-03-12 10:21:00', 'Quito', 15, 'En base a los estudios de factibilidad propuestos para la construcción de la Planta de Aluminio y con las coordenadas de la propuesta de ubicación de la Subestación Posorja II, se realizó el análisis de su impacto.  \r\n\r\nEl estudio determinó que existe un solapamiento de aproximadamente 8600 m2 (75x115 m) entre los dos polígonos y  se identificaron además, los predios requeridos para la Subestación. \r\n\r\nLos predios en los que se ubicará la Subestación Posorja II (inmediaciones del Polo Industrial) se encuentran en proceso expropiatorio, por lo cual debe priorizarse el pago a propietarios para continuar con el proceso de estudios que se presentarán a MAE para la dotación de energía. La reunión en la que se conocieron estas novedades contó con la participación del  MIPRO, MTOP, CNEL Y PETROECUADOR. \r\n\r\nEl proceso de construcción del Polo Industrial de Posorja, con una potencial de inversión de USD 5.891 Millones y 10.767 empleos directos, ha tenido dificultades vinculadas a la expropiación de los predios, para el posterior establecimiento de la ZEDE, una situación identificada en diciembre de 2017.\r\n\r\nEn vista de la Insuficiente coordinación interinstitucional para que el proyecto avance, se generó un compromiso presidencial del Polo Industrial de Posorja, que motivará el trabajo coordinado y articulado entre todos los actores vinculados para consolidar el proyecto.  \r\n\r\nCon fecha 23 de febrero de 2018 se realizó una reunión para iniciar la coordinación interinstitucional MIPRO – MAE para análisis de la normativa técnica ambiental que sea pertinente,  en relación a los proyectos industriales en el Polo. En ese contexto, se realizará la propuesta de hoja de ruta para atender este aspecto fundamental en la promoción y atracción de inversiones.', '000Ninguno', '2018-03-15 03:21:54', '2018-03-15 03:32:26', 1, ''),
(8, 3, 'Acreditación por parte de Agrocalidad al Centro de Acopio Verdepamba (Sector lácteo) Convenio Mipro - PNUD', 'Acreditación por parte de Agrocalidad al Centro de Acopio Verdepamba (Sector lácteo) el mismo que contempla el desarrollo de 3.127 productores directos e indirectos, debido a la implementación del Programa de desarrollo de proveedores Convenio Mipro - PNUD - Caso Toni.', 'Coordinación General de Servicios, Denis Zurita', '2018-03-14 08:09:00', 'Quito', 100, 'Como parte de la implementación del programa de desarrollo de proveedores en el marco del Convenio suscrito entre el Ministerio de Industrias y Productividad y el Programa de las Naciones Unidas para el Desarrollo (PNUD), la empresa ancla Toni, se propuso como plan de mejora la acreditación de funcionamiento emitido por Agrocalidad del Centro de Acopio lácteo Verdepamba, la cual fue emitida satisfactoriamente, y que pretende fortalecer este sector lácteo y su producción.', '000Ninguno', '2018-03-22 01:09:17', '2018-03-22 01:09:17', 2, ''),
(9, 3, 'Inversiones en Polo Industrial de Posorja', 'Suscripción del Contrato de Inversión de la empresa Andespacific Group para implementación del Astillero de Posorja.', 'Subsecretaría de Industrias Básicas, Director de Desarrollo Productivo de Industrias Básicas – Christian Arias', '2018-03-21 08:58:00', 'Quito', 100, 'El 12 de marzo de 2018 se realizó la suscripción del contrato de inversión para implementación del Astillero de Poasorja, entre la empresa Andespacific Group y el Ministerio de Comercio Exterior e Inversiones, el cual contaba previamente con la aprobación del Consejo Sectorial de la Producción y un Memorando de Entendimiento con el Ministerio de Industrias y Productividad para acompañamiento técnico para la inversión y cumplimiento de los objetivos productivos. El proyecto representa una inversión estimada de 220 millones de dólares y una generación de más de 1000 empleos directos, siendo que en función del MOU suscrito se estableceránentre , el cual se implementará dentro del Polo de Desarrollo Industrial de Posorja, del cual también es liderado por el MIPRO respecto de las acciones interinstitucionales para su establecimiento, así como de seguimiento a las inversiones que formarán parte del mismo. Con la entrada en operación de este astillero se brindará atención a flota nacional y extranjera que transita en el Pacífico Sur con servicios de reparación y mantenimiento de embarcaciones de mediano y gran tamaño, que no eran ofertados previamente en nuestro país. Se estima que este proyecto entre en operación plena en los próximos 3 años.', '000Ninguno', '2018-03-22 01:58:28', '2018-03-22 01:58:55', 2, ''),
(10, 3, 'Suscripción del Convenio “Alemania comparte su expertise con Ecuador”', 'En la ciudad de Quito, el 20 de marzo de 2018, se realizó el Simposio Revolución Industrial 4.0, organizado por la Cámara de Industrias y Comercio Ecuatoriano Alemana.  En el evento, la Magister Eva García Fabre, hace referencia a que hoy día enfrentamos la cuarta revolución industrial que está transformando las organizaciones y la forma de producir y hacer negocios a nivel mundial. Impulsar este cambio, siguiendo el ejemplo de Alemania, es un trabajo en conjunto con el sector privado, sector público y la academia, a fin crear las condiciones para la adaptación de las tecnologías de la información en toda su amplitud, pueda tener lugar, en el sector industrial y proyectarlo hacia el futuro. \r\n\r\nLa Cámara Alemana es una institución privada, sin fines de lucro y su objetivo principal es el fomento de intercambios comerciales entre el Ecuador y Alemania.\r\n\r\nEl concepto de Industria 4.0 se presenta como un nuevo hito en el desarrollo industrial y agroindustrial que marcaría importantes cambios en el ámbito productivo, económico y social en el Ecuador.  Este es uno de los proyectos clave de la estrategia relativa a las tecnologías de punta del gobierno alemán, que promueven la revolución digital de las industrias; \r\n\r\nA fin de ahondar esfuerzos para el impulso de la Industria 4.0 en el sector productivo del Ecuador, se suscribió un Convenio de Cooperación entre el Ministerio de Industrias y Productividad y la Cámara de Industrias y Comercio Ecuatoriano Alemana, a fin de coordinar acciones para beneficiar al Ecuador y a su aparato productivo a través de nuevos conocimientos en torno a la Revolución Industrial 4.0 en base al concepto de “Alemania comparte su expertise con Ecuador”, y a la posibilidad de un mayor crecimiento para el país, respaldándose en la colaboración público-privada. Este convenio está alineado a los pilares de innovación y productividad de Política Industrial del Ecuador, tomando como base la experiencia de Alemania en el tema de Industria y Agroindustria 4.0.', 'Subsecretaría de Industrias Básicas, Dr. Claudio Arcos', '2018-03-21 09:06:00', 'Quito, Hotel Swisshotel', 100, 'La Industria 4.0, representa una serie de nuevos conceptos como el análisis masivo y avanzado de datos, mayor conectividad o automatización de tareas mediante inteligencia artificial. Estos conceptos son aplicables a todo tipo de industria, en especial a la manufacturera. Dentro de este, el sector agroindustrial representa el 43% del valor agregado bruto no petrolero industrial, empleando al 34% de la fuerza laboral manufacturera, con una balanza comercial positiva y con posibilidad de incrementar este superávit impulsando la innovación y una transformación digital.\r\n\r\nAlemania, es uno de los países pioneros en impulsar esta nueva revolución industrial. Con apoyo de la Cámara de Industrias y Comercio Ecuatoriano Alemana, compartirán su expertiz al sector privado y academia con el propósito de establecer un precedente en la cultura de desarrollo industrial del Ecuador. \r\n\r\nEn fortalecimiento de todos estos mecanismos, se ha suscrito el convenio “Alemania comparte su expertiz en Ecuador”, para el impulso de la Industria y Agroindustria 4.0 en el sector productivo del Ecuador. Con esto, el primer paso es establecer la hoja de ruta que permita la vinculación del sector privado nacional, con esta visión industrial de transformación digital.', '000Ninguno', '2018-03-22 02:06:41', '2018-03-22 02:06:41', 2, ''),
(11, 3, 'Solicitud de apoyo para viabilidad apoyo con Fondo Ítalo Ecuatoriano (FIEDS)', 'El día 20 de Marzo se lleva a cabo reunión en Cancillería entre Fondo Ítalo Ecuatoriano para Desarrollo Sostenible (FIEDS)y entidades de Ministerio de Industrias y Productividad, señalando que Agroindustria es el sector con mayor potencial para desarrollo competitivo y con capacidad de insertarse en mercado internacional (Unión Europea), para lo cual se busca cooperación de FIEDS, con iniciativas de implementación del Sistema Nacional de Trazabilidad en Alimentos para resaltar características y diferenciar su calidad y origen.', 'Subsecretaría de Agroindustria y Procesamiento Acuícola, Ing. Jorge Chávez', '2018-03-21 10:09:00', 'Quito', 100, NULL, '000Ninguno', '2018-03-22 03:09:25', '2018-03-22 03:09:25', 2, ''),
(12, 3, 'Reunión con Fondo Argentino de Cooperación (FO.AR)', 'El día 19 de Marzo se lleva a cabo un contacto entre el representante Ezequiel González Simkin de Instituto Nacional de Tecnología Industrial – INTI con entidades de Ministerio de Industrias y Productividad sobre apoyo de los proyectos aprobados por Comisión Mixta Ecuador-Argentina en el tema de capacitación de la cadena láctea en el Ecuador, con el compromiso que se llevará a cabo lo antes posible', 'Subsecretaría de Agroindustria y Procesamiento Acuícola, Ing. Jorge Chávez', '2018-03-21 10:09:00', 'Quito', 100, NULL, '000Ninguno', '2018-03-22 03:09:58', '2018-03-22 03:09:58', 2, ''),
(13, 3, 'Análisis técnicos contratos de inversión', 'Descripción: Aprobación de informes técnicos empresas: NESTLÉ ECUADOR S.A. Y PALMISTERIAS LAS GOLONDRINAS S.A.   emitidos por MIPRO para suscripción de contratos de inversión por parte de MCEI, que permitiría una inversión total USD 6.540.000,00', 'Subsecretaría de Agroindustria y Procesamiento Acuícola, Ing. Jorge Chávez', '2018-03-21 10:10:00', 'Quito', 100, NULL, '000Ninguno', '2018-03-22 03:10:31', '2018-03-22 03:10:31', 2, ''),
(14, 3, 'Reunión  MIPRO – MEER', 'El día 19 de marzo de 2018 se lleva a cabo reunión entre entidades de Ministerio de Industrias y Productividad - Ministerio de Electricidad y Energía Renovable sobre Irradiación ionizante para coordinar el ingreso del proyecto  a herramienta GPR para que pueda  contribuir con nuestra Intervención Emblemática como proyecto de Gasto Corriente.', 'Subsecretaría de Agroindustria y Procesamiento Acuícola, Ing. Jorge Chávez', '2018-03-21 10:11:00', 'Quito', 100, NULL, '000Ninguno', '2018-03-22 03:11:04', '2018-03-22 03:11:04', 2, ''),
(15, 3, 'Inicio de prestación del servicio de Registro de Producción Nacional para el cálculo del Valor Agregado Nacional, VAN', 'El sistema de Registro de Producción Nacional permite, aplicando una metodología internacional avalada por SERCOP, establecer el valor agregado nacional por producto y productor. Su principal aplicación actual es para el Programa “Casa para Todos” para promover la utilización de productos del sector nacional industrial, lo cual evitará la importación de materiales y salida de divisas, y por ende será un real reactivador de economía nacional. \r\nEl 21 de marzo se publicó en la página web institucional el acceso al servicio RPN. Para la difusión, se ha articulado con la Dirección de Comunicación para iniciar campaña en redes sociales. Con MIDUVI se está organizando la socialización del servicio.\r\nLink de acceso: http://www.industrias.gob.ec/mipro-presenta-la-herramienta-de-registro-de-produccion-nacional-2/', 'Coordinación general de Servicios para la Producción, Dennis Zurita', '2018-03-23 02:55:00', 'Quito', 30, 'El Ministerio de Industrias y Productividad ha puesto al servicio de la ciudadanía el Registro de Producción Nacional, un sistema que permite establecer para cada productor el valor agregado nacional (VAN) de sus productos. Es un mecanismo que permitirá promover el encadenamiento de proveedores nacionales con productores que requieran sus materias primas. Como parte de los beneficios del incremento del VAN en los producto, es el acceso a incentivos tributarios de la Ley de Reactivación Económica y compras públicas. Por ejemplo, en Compras Públicas para determinar el VAN de los materiales de construcción del Programa Casa para Todos, busca que se incorporen en las soluciones habitacionales los productos de nuestra industria nacional. Se invita al sector industrial a utilizar el sistema disponible en la página web del Mipro.', '000Ninguno', '2018-03-28 19:55:29', '2018-03-28 19:55:29', 3, ''),
(16, 1, 'CIERRE DEL PROYECTO DE AGROBIODIVERSIDAD', 'El ministro de Agricultura y Ganadería, Rubén Flores, participó en el cierre del Proyecto de Agrobiodiversidad, trabajado conjuntamente entre el Instituto Nacional de Investigaciones Agropecuaria (Iniap), Ministerio de Agricultura y Ganadería (MAG), la Organización de las Naciones Unidas  para la Alimentación y la Agricultura (FAO), el Fondo para el Medio Ambiente Mundial (GEF) y Heifer Ecuador, con la participación de agricultores familiares campesinos. Como resultados  del proyecto se aprobó la Ley de Agrobiodiversidad, Semillas y Fomento  de  la  Agricultura  Sostenible; tres  ordenanzas  sobre  uso  y conservación sostenible de la agrobiodiversidad: una provincial en Chimborazo y dos cantonales en Saraguro y Guamote, además de una campaña  sobre los  Derechos  de  los Agricultores del Tratado Internacional sobre de los Recursos Fitogenéticos para la  Alimentación  y  Agricultura (TIRFAA)  en  los  siete  cantones de  intervención.\r\n\r\nAdemás, en el proyecto están involucradas activamente siete organizaciones sociales; 4.160 familias beneficiarias que incorporan el manejo y uso sostenible de la agrobiodiversidad en 1.790 hectáreas, considerando que el 70% de las familias beneficiarias están representadas por  mujeres.\r\n\r\nSe suman 5 mil personas pertenecientes a la agricultura  familiar campesina, capacitadas en  temas de  manejo   de  la  agrobiodiversidad  y agroecología; y la oficialización  del sello de Agricultura Familiar Campesina, instrumento que tiene la finalidad de garantizar el origen social de los productos agroalimentarios desde las unidades de producción agrícola familiares.', 'http://www.agricultura.gob.ec/la-gran-minga-agropecuaria-rescata-la-agrobiodiversidad/)', '2018-03-21 05:33:00', 'Quito – Ecuador', 100, 'El Proyecto de Agrobiodiversidad fue  ejecutado por  Instituto Nacional de Investigaciones Agropecuaria (INIAP), Ministerio de Agricultura y Ganadería (MAG), la Organización de las Naciones Unidas  para la Alimentación y la Agricultura (FAO), el Fondo para el Medio Ambiente Mundial (GEF) y Heifer Ecuador, con la participación de agricultores familiares campesinos.\r\n\r\nComo resultado del proyecto, el país tiene la Ley de Agrobiodiversidad, Semillas y Fomento  de  la  Agricultura  Sostenible; tres  ordenanzas  sobre  uso  y conservación sostenible de la agrobiodiversidad: una provincial en Chimborazo y dos cantonales en Saraguro y Guamote, además de una campaña  sobre los  Derechos  de  los Agricultores del Tratado Internacional sobre de los Recursos Fitogenéticos para la  Alimentación  y  Agricultura  en  los  siete  cantones de  intervención.\r\n\r\nEstán involucradas activamente siete organizaciones sociales; 4.160 familias beneficiarias que incorporan el manejo y uso sostenible de la agrobiodiversidad en 1.790 hectáreas, considerando que el 70% de las familias beneficiarias están representadas por mujeres.', '1522258428-Intervención-del-ministro-Rubén-Flores.png', '2018-03-28 22:33:48', '2018-03-28 22:33:48', 3, ''),
(17, 1, 'RUEDA DE NEGOCIOS AGROPRODUCTIVOS, EN SANTA ELENA', 'Con el propósito de vincular directamente a los productores agrícolas de Santa Elena con la industria, el Ministerio de Agricultura y Ganadería (MAG) realizó una Rueda de Negocios Agroproductivos el pasado 24 de marzo, en la provincia de Santa Elena.\r\nEl acto se efectuó desde las 10:30 en el museo de Los Amantes de Sumpa, con la presencia de la vicepresidenta de la República, María Alejandra Vicuña; la viceministra de Agricultura y Ganadería, Mariuxi Gómez Torres; el gobernador de Santa Elena, David Sabando, y autoridades locales, del MAG y BanEcuador.\r\nEn total participaron 29 organizaciones de Santa Elena y cinco organizaciones de la provincia del Guayas (Daule, Salitre, y Santa Lucia) con el rubro arroz.\r\nContó con la presencia de aproximadamente 300 productores y consumidores.', 'http://www.agricultura.gob.ec/mag-promueve-ruedas-de-negocios-para-viabilizar-ventas-directas/)', '2018-03-24 05:41:00', 'Museo Los Amantes de Sumpa – Santa Elena', 100, 'El Ministerio de Agricultura y Ganadería promueve las ruedas de negocios para vincular directamente a los productores agropecuarios con la industria, para que los primeros sean directamente beneficiados.\r\n\r\nEstos espacios eliminan a los intermediarios, dinamizan la economía de la Agricultura Familiar Campesina, ya que proveen alimentos sanos, frescos y al mejor precio posible para satisfacer demandas de industrias locales y nacionales, aprovechando coyunturas. También se identifica oportunidades de mercados locales y regionales, organizar y articular la comercialización de economías rurales agropecuarias con futuras demandas institucionales.\r\n\r\nEn la rueda de negocios participaron como demandantes las industrias Pronaca, Nutrivital, Superior, Gustapan, Café Conquistador, Promasa; los hoteles Decameron, Hotel Punta del Mar; las cabañas turísticas y la empresa de servicios Cathering Fattoria.  Como ofertantes estuvieron asociaciones agrícolas  productoras de maíz, cacao, café y hortalizas; asociaciones frutales de maracuyá, limón, melón, sandía y papaya; asociaciones ganaderas, porcinas, ovinas, avícolas y de apicultores.', '1522258900-Participantes-en-la-rueda-de-negocios-768x432.png', '2018-03-28 22:41:40', '2018-03-28 22:41:40', 3, ''),
(19, 1, 'Reunión para analizar perspectivas de producción de maíz duro', 'Con representantes de las industrias avícolas y procesadoras de alimento balanceado, el Ministro de Agricultura y Ganadería, Rubén Flores, mantuvo una reunión para analizar las perspectivas de la cosecha de maíz amarillo duro 2018, la rueda de negocios de ese sector, y los precios de los productos avícolas.\r\nLos representantes de los productores avícolas y de las industrias balanceadoras presentaron propuestas para construir acuerdos que serán analizadas en el Consejo Consultivo de la Cadena del Maíz.', 'Twitter', '2018-03-27 05:48:00', 'Quito-Ecuador', 100, 'Productores avícolas, de la industria del balanceado, junto al ministro Rubén Flores analizaron las perspectivas de la cosecha de maíz amarillo duro 2018, así como la rueda de negocios de ese sector, y los precios de los productos avícolas.\r\n\r\nLos representantes de los productores avícolas y de las industrias de balanceado presentaron propuestas para construir acuerdos que serán analizadas en el Consejo Consultivo de la Cadena del Maíz. \r\n\r\nEn el Consejo Consultivo de la Cadena del Maíz se definirá el Precio Mínimo de Sustentación del quintal de maíz amarillo duro, materia prima básica para elaborar alimento balanceado.', '000Ninguno', '2018-03-28 22:48:50', '2018-03-28 22:48:50', 3, ''),
(20, 1, 'FIRMA DEL ACUERDO INTERINSTITUCIONAL PARA CONTROLAR Y REGULAR LA PRODUCCIÓN DE LECHE', 'Un acuerdo interministerial para controlar y regular la cadena de producción de la leche y sus derivados, incluido el suero de leche, firmaron representantes de los ministerios de Industrias y Productividad (MIPRO); Agricultura y Ganadería (MAG); Salud Pública (MSP) y Defensa Nacional, además del Servicio de Aduana del Ecuador (Senae), y la Superintendencia de Control del Poder del Mercado.\r\n\r\nCon la aplicación de este reglamento se pretende controlar todo el proceso de producción, desde el ordeño hasta la comercialización, pasando por el transporte, el acopio, el procesamiento, hasta la venta de productos lácteos.\r\nEsto determinará que el país tenga leche de mayor calidad, para contribuir a reducir los niveles de desnutrición en el país, además de que será una herramienta para combatir el contrabando.\r\n\r\nLas disposiciones del reglamento se aplicarán a la producción de leche obtenida de bovinos, caprinos, ovinos y búfalos, que tiene como destino el procesamiento, elaboración y comercialización de productos y sus derivados (incluido el suero de leche) para el consumo humano.', 'http://www.agricultura.gob.ec/con-reglamento-de-control-y-regulacion-de-produccion-de-leche-gobierno-ataca-problemas-del-sector/', '2018-03-27 05:57:00', 'Quito-Ecuador', 100, 'Los ministerios de Industrias y Productividad (MIPRO); Agricultura y Ganadería (MAG); Salud Pública (MSP) y Defensa Nacional, además del Servicio de Aduana del Ecuador (Senae), y la Superintendencia de Control del Poder del Mercado firmaron un Acuerdo Interministerial, mediante el cual se expide el reglamento para controlar y regular la cadena de producción de la leche y sus derivados, incluido el suero de leche.\r\n\r\nCon la aplicación de este reglamento se pretende controlar todo el proceso de producción, desde el ordeño hasta la comercialización, pasando por el transporte, el acopio, el procesamiento, hasta la venta de productos lácteos, para que el país tenga una leche de mayor calidad.\r\n\r\nEl reglamento delimita las competencias de cada una de las entidades públicas, participantes.\r\n\r\nLas disposiciones del reglamento se aplicarán a la producción de leche obtenida de bovinos, caprinos, ovinos y búfalos, que tiene como destino el procesamiento, elaboración y comercialización de productos y sus derivados (incluido el suero de leche) para el consumo humano.', '1522259840-Ministro-Rubén-Flores-durante-la-firma-del-Acuerdo-Interinstitucional-1-768x432.png', '2018-03-28 22:57:20', '2018-03-28 22:57:20', 3, ''),
(21, 1, 'Rueda de prensa', 'El ministro de Agricultura y Ganadería, Rubén Flores, dio una rueda de prensa en la que explicó las medidas implementadas para comercializar el arroz, así como informó del pago de más de un millón de dólares efectuado a la Empresa Pública Unidad Nacional de Almacenamiento (UNA-EP), recursos que le servirán a la entidad para cancelar a los productores de la gramínea.', 'http://www.agricultura.gob.ec/el-ministerio-de-agricultura-y-ganaderia-apoya-a-la-una-ep-con-recursos-de-deuda-del-2014/', '2018-03-21 05:58:00', 'Quito - Ecuador', 100, NULL, '1522259928-El-ministro-Rubén-Flores-junto-al-gerente-de-BanEcuador-Santiago-Campos-768x432.png', '2018-03-28 22:58:48', '2018-03-28 22:58:48', 3, ''),
(22, 1, 'Sesión del Directorio del INIAP', 'El ministro de Agricultura y Ganadería, Rubén Flores, participó en la sesión ordinaria del Iniap, junto a la subsecretaria de Ambiente del Ministerio del Ambiente, María Chiriboga; Juan Manuel Domínguez, director Ejecutivo del Instituto Nacional de Investigaciones Agropecuarias, y Juan Fernando Terán, delegado de la Senescyt.\r\n\r\nEn la reunión, el ministro Flores explicó que el Ministerio de Agricultura y Ganadería tiene tres instrumentos básicos para trabajar de manera articulada con los actores de las cadenas productivas y de los gobiernos locales: consejos consultivos, mesas técnicas y plataformas territoriales.', 'Twitter', '2018-03-23 06:02:00', 'Despacho Ministerial MAG', 100, NULL, '000Ninguno', '2018-03-28 23:02:07', '2018-03-28 23:02:07', 3, ''),
(23, 1, 'Mesa técnica del arroz', 'El Ministerio de Agricultura y Ganadería organizó una mesa técnica con la participación de líderes de productores de arroz, en Guayaquil. El propósito fue encontrar soluciones conjuntas a problemáticas en temas de comercialización, precios, almacenamiento, dotación de insumos, y otros contemplados en la hoja de ruta trazada con las organizaciones del sector', 'Twitter', '2018-03-26 06:03:00', 'Guayaquil-Ecuador', 100, NULL, '000Ninguno', '2018-03-28 23:03:05', '2018-03-28 23:03:05', 3, ''),
(24, 1, 'Seminario Tarjeta de Crédito Productiva', 'El ministro de Agricultura y Ganadería, Rubén Flores, participó en el Seminario “Tarjeta de Crédito Productiva”, organizado por la Facultad de Economía de la Pontificia Universidad Católica del Ecuador (PUCE).\r\nDijo que es necesario articular desde la política pública a la Universidad y al sector privado, entendiendo que este sector tiene un énfasis en la economía popular y solidaria.\r\n\r\nBanEcuador, como banca pública para el desarrollo, ha entregado más de USD 1.449,5 millones en créditos beneficiando a 378 mil personas que han podido generar Emprendimientos que han aportado al desarrollo de la economía popular y solidaria.', 'Twitter', '2018-03-28 06:04:00', 'Quito-Ecuador', 100, NULL, '000Ninguno', '2018-03-28 23:04:04', '2018-03-28 23:04:04', 3, ''),
(25, 3, 'Sesión Extraordinaria Nro.10-03-2018 del Consejo Sectorial de la Producción (CSP)', 'El 21 de marzo de 2018, se realizó la la Sesión Extraordinaria Nro.10-03-2018 del Consejo Sectorial de la Producción (CSP), en el cual se presentó del informe y coordinación de acciones sobre la reactivación productiva de Manabí, Esmeraldas, Zaruma y Portovelo. En referencia al informe sobre la reactivación productiva de Manabí, Esmeraldas, los miembros plenos hacen énfasis en la necesidad de articular con otras instituciones que guarden relación sobre la problemática que se está abordando, ya que se debe buscar complementariedad intersectorial, incluyendo aliados estratégicos como otros Consejo Sectoriales, como el de Hábitat y Vivienda, y Social. Se enfatizó la necesidad de articular los instrumentos que han sido aprobados en el pleno del Consejo Sectorial de la Producción (la Agenda de Coordinación Intersectorial (ACI), planes sectoriales y políticas de los miembros del CSP) con las estrategias planteadas para la reactivación productiva', 'Secretario Ad-Hoc del Consejo Sectorial de la Producción– Dr. Claudio Arcos', '2018-03-28 08:10:00', 'Quito', 100, 'En la Sesión Extraordinaria del Consejo Sectorial de la Producción realizada el 21 de marzo de 2018, se presentó el informe y coordinación de acciones sobre la reactivación productiva de Manabí, Esmeraldas, Zaruma y Portovelo.\r\n\r\nSe enfatizó la necesidad de articular los instrumentos que han sido aprobados en el pleno del Consejo Sectorial de la Producción (la Agenda de Coordinación Intersectorial (ACI), planes sectoriales y políticas de los miembros del CSP) con las estrategias planteadas para la reactivación productiva', '000Ninguno', '2018-03-29 01:10:18', '2018-03-29 01:10:18', 3, ''),
(26, 3, 'Foro de Inversiones Invest Ecuador 2018 (Participación MIPRO)', 'Presentación \"Desarrollo del Polo Industrial - ZEDE Posorja\", en la cuál se expuso la normativa de incentivos y beneficios aplicables para inversionistas, como base para el fomento de polos de desarrollo productivo, liderados por el MIPRO, con una visión de integración territorial y generación de un ambiente de atracción de inversiones para desarrollo económico local, provincial y nacional. Se detallaron avances, hoja de ruta y oportunidades de inversión en el Polo Industrial de Posorja, haciendo mención a los proyectos de Plantas de Aluminio, Cobre y Acero. Como fruto de este evento, se logró planificar una visita de inversionistas interesados en el Polo Industrial de Posorja, para el viernes 30 de marzo, quienes serán guiados y atendidos por personal del MIPRO.', 'Subsecretario de Industrias Básicas Subrogante, Ing. Christian Arias', '2018-03-28 08:16:00', 'Quito - Hotel Marriot', 100, 'En el Foro de Inversiones Invest Ecuador 2018, El Ministerio de Industrias y Productividad, presentó la visión de un desarrollo productivo anclado a tres ejes específicos como son el ordenamiento territorial y uso de suelo, vocación y potencialidad productiva e incentivos tributarios y no tributarios. A su vez, se puso a consideración las cualidades de proyectos productivos que buscan generar una sinergia sistémica entre las etapas extractivas y sus primeras fases de transformación en la cadena de valor a través de lo que son las Industrias Básicas.\r\n\r\nEl Ministerio de Industrias y Productividad se encuentra liderando la implementación del proyecto Polo Industrial de Posorja, el cual se convierte en pieza clave de las inversiones en sectores de industrias básicas, dentro de las que están contempladas la implementación de la Planta de Aluminio, la Planta de Cobre, la Planta de Acero, un Astillero, el Puerto de Aguas Profundas y áreas para el desarrollo de industrias conexas que abastezcan a este complejo industrial como por ejemplo la producción de químicos básicos, combustibles, gases, entre otras materias primas.\r\nEl enfoque es la creación de una plataforma que estará conformada en su totalidad por 2400 hectáreas aproximadamente, donde puedan establecerse varios modelos de inversión bajo la óptica de un desarrollo territorial industrial planificado y ordenado. En el cual se complementen y fomenten, no solo zonas industriales de gran dimensión, sino clústers productivos que diversifiquen la oferta. A su vez se busca contar con espacios para crear un diseño económico sostenible y sistémicamente virtuoso, apalancado en uno de los mejores accesos comerciales de la región como será la integración urbana planificada. Todos estos elementos consolidarán a su vez el efecto de crecimiento económico y social a nivel local, provincial y regional.\r\n\r\nEl MIPRO está a cargo de la aprobación de proyectos en el marco de la Ley de Asociaciones Público Privadas en lo referente al fomento de sectores productivos, con lo cual se promueve la producción nacional, dinamización de la economía, aumento de liquidez y generación de mayor interés y confianza, para que empresas nacionales e internacionales tengan como aliado al gobierno para la inversión en proyectos de interés general, ofreciendo incentivos tributarios por 10 años y exenciones arancelarias.\r\n\r\nPara el caso de Zonas Especiales de Desarrollo Económico, por Decreto Ejecutivo (252), el señor Presidente de la República, delegó al MIPRO como la entidad encargada de los aspectos técnicos para su declaratoria, funcionamiento y operación.', '1522268199-AGENDA_invest_mineria_27280318_ES.zip', '2018-03-29 01:16:39', '2018-03-29 01:16:39', 3, ''),
(27, 3, 'Presentación de Política Industrial a los Miembros del Consejo Consultivo Productivo y Tributario', 'El miércoles  21 de marzo de 2018, se realizó la reunión ampliada de este Comité Ejecutivo del Consejo Consultivo Productivo y Tributario, en la cual se presentó la Política Industrial, y como órgano asesor del Consejo Sectorial de la Producción, receptará las observaciones, comentarios y propuestas para fortalecer este instrumento de desarrollo productivo.', 'Ivan Carvallo, Secretario Ad Hoc CCPT', '2018-03-28 08:22:00', 'Despacho Ministerial', 100, 'El dialogo es permanente, con los actores del sector productivo y son parte de la construcción de las políticas para  mejorar la productividad  y generación de empleo de nuestro país.', '000Ninguno', '2018-03-29 01:22:56', '2018-03-29 01:22:56', 3, ''),
(28, 3, 'Socialización de instrumentos de inteligencia comercial de PRO ECUADOR', 'Taller impartido por PRO ECUADOR y el personal de la DINPCIB al que acudieron especialistas en desarrollo de mercados de las Subsecretarías del MIPRO. Se dio a conocer las herramientas de inteligencia comercial manejadas por PRO ECUADOR: boletines, cubos de información, estudios sectoriales, reportes de precios de productos ecuatorianos en el exterior, entre otros. Se obtuvo un importante intercambio de información y experiencias entre los asistentes, con miras a solventar los requerimientos de empresarios que acuden a esta Cartera de Estado en busca de información en el ámbito de comercio exterior.', 'Director de Inteligencia Negocios y Promoción Comercial de Industrias Básicas, Ec. Sebastián Ruiz', '2018-03-26 08:25:00', 'Quito', 100, 'En el ámbito de la inteligencia de negocios es vital desarrollar acciones conjuntas entre instituciones públicas. En este sentido, MIPRO y PROECUADOR han establecido líneas de apoyo con el propósito de aumentar las relaciones comerciales de sectores no tradicionales, y alcanzar un apoyo efectivo hacia el empresario y productor.', '000Ninguno', '2018-03-29 01:25:28', '2018-03-29 01:26:09', 3, ''),
(29, 3, 'Acuerdo Interinstitucional Reglamento de control y regulación de la cadena de producción de la leche y sus derivados incluido el suero de leche', 'El MIPRO será el encargado de apoyar el desarrollo del procesamiento industrial de la leche, derivados lácteos y aproechamiento de subproductos; así como de controlar su calidad en base a las normas vigentes, además de fomentar políticas de protección y cumplimiento de los derechos de los consumidores y obligaciones de los proveedores', 'MIPRO / Subsecretaría del Sistema de la Calidad', '2018-03-28 08:33:00', 'Quito', 100, 'Acuerdo Interinstitucional entre Ministerio de Agricultura y Ganadería, MIPRO, Ministerio de Salud Pública, Ministerio de Defensa Nacional, Servicio Nacional de Aduanas del Ecudor y Superintendencia de Control del Poder de Mercado, en el cual se expide el \"Reglamento de control y regulación de la cadena de producción de la leche y sus derivados incluido el suero de leche\"', '000Ninguno', '2018-03-29 01:33:32', '2018-03-29 01:33:32', 3, ''),
(30, 2, 'LEVANTAMIENTO DE INFORMACIÓN EN EL SECTOR PESQUERO', 'El Ministerio de Acuacultura y Pesca se encuentra en el proceso de levantar información actual de la población pesquera, debido a que la base de datos existente no está actualizada, esta información servirá para la generación de planes, y directrices estratégicas (Objetivos y metas) en beneficio del sector pesquero. \r\n\r\nPara el cumplimiento de este proceso se firmaron convenios con las organizaciones y asociaciones de pesca para que brinden el apoyo necesario y cumplir con el levantamiento de información estadística.', ': https://images.lahora.com.ec/esmeraldas/noticia/1102143777/levantan-informacion-en-el-sector-pesquero', '2018-03-27 10:17:00', 'Esmeraldas', 0, 'N/A', '000Ninguno', '2018-03-30 03:17:50', '2018-03-30 03:17:50', 4, ''),
(31, 2, '2.	Diecinueve Empresas suman esfuerzos para aplicar proyecto de mejora pesquera', 'La ministra de Acuacultura y Pesca, Katuska Drouet, ratificó la voluntad gubernamental de avanzar hacia una explotación responsable de los recursos del mar con una visión social y ambiental. El pronunciamiento se dio en la suscripción de un convenio para la estructuración de un proyecto de mejoras en las prácticas y gestión de la pesquería de pelágicos pequeños para asegurar la sustentabilidad de la cadena de valor de estas especies que son vitales para la industria de la harina, aceite de pescado y la producción de alimento balanceado para el camarón.\r\n\r\nAsí mismo insistió en la necesidad de crear sinergias para dar paso a una comunidad de ejecutores de buenas prácticas que conjuguen los intereses económicos y ambientales, vía la aplicación de una buena gobernanza y experiencias que fortalezcan capacidades técnicas. \r\n\r\nLa pesquería de pelágicos pequeños sostiene a la mayor parte de empresas que opera en los segmentos de harina, aceite de pescado y balanceado. Anualmente se capturan 218.000 toneladas métricas de estas especies, con la participación de 263 embarcaciones. Únicamente, la harina de pescado representó ingresos por USD 109 millones en el 2017, acorde con información del Banco Central del Ecuador (BCE).', 'http://www.periodicolaprimera.com/2018/03/19-empresas-suman-esfuerzos-para.html', '2018-03-27 10:19:00', 'Guayaquil', 0, NULL, '000Ninguno', '2018-03-30 03:19:31', '2018-03-30 03:19:31', 4, ''),
(32, 2, '3.	Sectores público y privado trabajan para ejecutar el Plan de Electrificación para el sector Camaronero', 'El compromiso del Gobierno Nacional de establecer un cambio de matriz productiva, por medio de proyectos que beneficien a los actores productivos del país se está logrando a través del Plan de Electrificación para el sector camaronero, mismo que busca una acuacultura eficiente y sustentable. \r\n\r\nLa ministra de Acuacultura y Pesca, Katuska Drouet, en la parroquia Chongón, visitó las instalaciones de la granja camaronera FINCACUA del grupo EMPAGRAN y socializó los beneficios de la sustitución del uso de combustibles por energía limpia para este tipo de camaroneras, con ello aportaría a la reducción de alrededor de 2 millones de toneladas de dióxido de carbono y mayor consumo de energía eléctrica.', 'http://radiohuancavilca.com.ec/cifras/2018/03/22/sectores-publico-y-privado-trabajan-para-ejecutar-el-plan-de-electrificacion-para-el-sector-camaronero/', '2018-03-27 10:20:00', 'Chongón - Guayaquil', 0, NULL, '000Ninguno', '2018-03-30 03:20:06', '2018-03-30 03:20:06', 4, ''),
(33, 2, '4.	Pescadores artesanales participan en jornada de carnetización', 'El Ministerio de Acuacultura y Pesca, con la finalidad de regularizar la actividad pesquera artesanal, así como a los comerciantes minoristas y mayoristas que operan en las caletas y aguas interiores, realizó una jornada de carnetización, donde participaron caletas pesqueras de Santa Rosa, San Pedro, Ayangue y Anconcito, de la provincia Santa Elena.\r\n\r\nLos permisos se emiten bajo un sistema en línea, y los técnicos de esta Cartera son los responsables de realizar este proceso y además de brindar el asesoramiento sobre los beneficios de carnetizarse.', ': http://mevnoticias.com/2018/03/20/santa-elena-pescadores-artesanales-participan-jornada-carnetizacion/', '2018-03-27 10:20:00', 'Santa Rosa, San Pedro, Ayangue y Anconcito – Santa Elena', 0, NULL, '000Ninguno', '2018-03-30 03:20:48', '2018-03-30 03:20:48', 4, ''),
(34, 2, '5.	Ministerio de Acuacultura y Pesca realiza investigación para reproducción de la especie bagre mota', 'El Ministerio de Acuacultura y Pesca, el Centro de Reproducción de Cachama (CEREC), y el Instituto Nacional de Pesca (INP), están realizando una investigación del ciclo de reproducción del bagre mota (calophysus macropterus), con el fin de contribuir al mejoramiento y fortalecimiento de la producción piscícola de la región amazónica.\r\nEl propósito del estudio es identificar y evaluar el grado de evolución que tiene el bagre mota; esto se realiza una vez que la especie está en fase de adaptación y entrando en la etapa de reproducción. Y con el Instituto Nacional de Pesca se está elaborando los protocolos y planes de manejo de la especie para dotar de alevines de bagre mota a los piscicultores', 'http://www.acuaculturaypesca.gob.ec/subpesca4473-map-realiza-investigacion-para-reproduccion-de-la-especie-bagre-mota.html', '2018-03-27 10:21:00', 'Santa Clara - Pastaza', 0, NULL, '000Ninguno', '2018-03-30 03:21:34', '2018-03-30 03:21:34', 4, ''),
(35, 2, '6.	Fortalecimiento de Seguridad Integral', 'El Ministerio de Acuacultura y Pesca, a través de la Dirección de Control Acuícola, realizó la Tercera Reunión del proyecto “Fortalecimiento de Seguridad Integral” en la provincia de Santa Elena en el cual tuvo como objetivo fortalecer a los gremios camaroneros brindándoles una plataforma geográfica informativa que les sirva para planificar y gestionar de mejor forma el desarrollo sustentable del sector Acuícola en Santa Elena y así también a través de la retroalimentación mutua de información, lograr obtener una plataforma informativa que contenga información oportuna que sirva a las entidades de seguridad brindar un auxilio con rapidez y eficacia.', 'N/A', '2018-03-27 10:22:00', 'Santa Elena', 0, NULL, '000Ninguno', '2018-03-30 03:22:28', '2018-03-30 03:22:28', 4, ''),
(36, 2, '7.	Certificación profesional a los Pescadores Artesanales', 'En la segunda fase del proyecto, se han certificado a 128 Pescadores Artesanales de la caleta Puerto Cayo del cantón Jipijapa, Provincia Manabí, dentro del proceso de certificación profesional en coordinación con el Instituto Tecnológico Superior Luis Arboleda Martínez y las organizaciones en la semana del 21 al 27 de marzo 2018.\r\nAdemás, se han realizado levantamiento de información para las evaluaciones teórica y práctica del proceso de certificación profesional a las organizaciones pesqueras de la caleta Arenales del cantón Portoviejo, Provincia Manabí, de 100 Pescadores Artesanales.', 'N/A', '2018-03-27 10:23:00', 'Puerto Cayo - Jipijapa', 17, NULL, '000Ninguno', '2018-03-30 03:23:15', '2018-03-30 03:23:15', 4, ''),
(37, 2, '8.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimiento a 18 Pescadores Artesanales en la provincia de El Oro (Huaquillas) que les permite fortalecer las capacidades técnicas que contribuyan al Manejo de los Recursos y Regulación de la Actividad Pesquera, Asistencia Organizacional y Fomento Productivo.', 'N/A', '2018-03-29 10:23:00', 'Huaquillas - El Oro', 13, NULL, '000Ninguno', '2018-03-30 03:23:57', '2018-03-30 03:23:57', 4, ''),
(38, 2, '9.	Permisos emitidos a nivel nacional de Pescadores Artesanales y de embarcaciones Artesanales', 'Se emitieron 71 permisos de Pescadores Artesanales y 47 permisos de Embarcaciones Artesanales a nivel nacional, mismos que permiten se realice la actividad pesquera artesanal de manera legal en el país.', 'N/A', '2018-03-27 10:26:00', 'MANABI', 0, NULL, '000Ninguno', '2018-03-30 03:26:25', '2018-03-30 03:26:25', 4, ''),
(39, 1, 'Reunión con organizaciones sociales', 'Representantes y dirigentes de organizaciones campesinas, indígenas y montubias se reunieron con el ministro de Agricultura y Ganadería, Rubén Flores, para acordar un trabajo conjunto y desarrollas agendas territoriales en sus sectores', 'Twitter', '2018-03-28 07:22:00', 'Quito - Ecuador', 100, NULL, '000Ninguno', '2018-04-05 00:22:56', '2018-04-05 00:22:56', 4, '');
INSERT INTO `csp_reportes_hechos` (`id`, `institucion_id`, `tema`, `descripcion`, `fuente`, `fecha_reporte`, `lugar`, `porcentaje_avance`, `lineas_discursivas`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`) VALUES
(40, 1, 'Consejo Consultivo del Arroz', 'En el Consejo Consultivo del Arroz, el ministro de Agricultura y Ganadería, Rubén Flores, planteó la necesidad de que en el país existan precios absolutamente objetivos y no políticos, y desde esa perspectiva planteó tres escenarios que bordean precios entre 32 y 35,50 dólares.\r\n\r\nTambién se discutió la necesidad de transparentar los márgenes a nivel del productor, industria y comerciante, y se planteó la necesidad de cómo reducir los costos de producción, cómo incrementar la productividad, cómo consolidar un mecanismo de comercialización eficiente y cómo hacer para que la cadena y el sistema agroalimentario nacional del arroz se conviertan en un ganador viendo que ya es excedentaria', 'Twitter', '2018-03-29 07:25:00', 'Guayaquil-Ecuador', 100, 'Se presentaron tres escenarios de precios que oscilan entre USD 32 y 35,50 la saca, pero se debe tener en cuenta el precio internacional, y en ese marco analizar y transparentar el precio, así como los márgenes a nivel del productor, industria y comerciante. \r\n\r\nEl nuevo precio mínimo de sustentación y la estrategia de comercialización deben ser definidas en  dos semanas, debido a que inicia la cosecha de arroz.\r\n\r\nSe plantea trabajar en cómo reducir los costos de producción, incrementar la productividad, consolidar un mecanismo de comercialización eficiente y cómo hacer que la excedentaria cadena y el sistema agroalimentario nacional del arroz se conviertan en actores beneficiarios de las políticas públicas aplicadas.', '000Ninguno', '2018-04-05 00:25:56', '2018-04-05 00:25:56', 4, ''),
(41, 1, 'Reunión de la Organización de Cacao', 'El ministro de Agricultura y Ganadería, Rubén Flores, participó en una reunión con los representantes de la Asociación Nacional de Exportadores de Cacao del Ecuador (Anecacao), y de la Organización Internacional del Cacao (ICCO) para trabajar en una hoja de ruta para determinar acciones y estrategias que beneficien a toda la cadena cacaotera del país.\r\nEn el encuentro también se trató la participación de Ecuador en la Conferencia Mundial del Cacao de ICCO', 'Twitter', '2018-03-29 07:34:00', 'Despacho Ministerial MAG', 100, 'Tener una estrategia ofensiva y no defensiva porque los acuerdos logrados en la Unión Europea (UE)  deben estar claros y alineados en conjunto con el sector privado.  \r\n\r\nEl cacao está dentro de la soberanía alimentaria de Ecuador y sobre esta base  el país construirá su posición en estas reuniones, para explicar la presencia de cadmio en la pepa de cacao.\r\n\r\nEcuador conformó un equipo multidisciplinario para investigar la procedencia del cadmio que se hace presente en el cacao, y espera que la UE no cambie los parámetros establecidos en la actualidad.', '000Ninguno', '2018-04-05 00:34:53', '2018-04-05 00:34:53', 4, ''),
(42, 1, 'Reunión interministerial', 'El ministro de Agricultura y Ganadería, Rubén Flores, se reunió con equipos de trabajo de los ministerios de Comercio Exterior y de Relaciones Exteriores para articular acciones interinstitucionales para el desarrollo del sector agrícola.\r\nPor medio del trabajo interinstitucional entre las tres entidades en los primeros nueve meses de Gobierno, se han dado soluciones a problemas existentes desde hace 15 años para sectores como el bananero, arrocero y camaronero', 'Twitter', '2018-04-03 07:35:00', 'Despacho Ministerial MAG', 100, 'La importación de productos agrícolas, avalados por el Acuerdo Comercial con la Unión Europea, no afecta a la comercialización de los productos nacionales, dado que dentro de los productos lácteos lo que más se importa es leche condensada, con 1 000 toneladas anuales, producto que no se fabrica en Ecuador. En quesos no se superan las 60 toneladas métricas; \r\nen leche en polvo se importaron 400 toneladas métricas, rubro en el que la importación aumenta en 20 toneladas anuales. En lo que va de año se importaron 50 TM de leche en polvo con adición de azúcar, sin embargo se planifica 359 TM. \r\n\r\nAnte la solicitud de abrir mercados internacionales a los productos lácteos nacionales, en el Comex se mencionó que Ecuador sanitariamente no está habilitado para exportar productos lácteos, hechos con leche o con sus derivados. \r\n\r\nYa se tuvo una reunión con Agrocalidad y las industrias, sin embargo Agrocalidad no cumplió con los compromisos adquiridos y el proceso se estancó. Por solicitud del ministro Rubén Flores, Agrocalidad deberá presentar una hoja de ruta para continuar con este proceso y que el sector ganadero pueda tener nuevos mercados donde comercializar sus productos. \r\n\r\nOtro de los acuerdos a los que se llegaron en la reunión fue que los ministerios utilizarán las mismas fuentes de información para no diferir en datos. Por ello, el Comex se comprometió a socializar su información sobre exportaciones e importaciones con el MAG.', '000Ninguno', '2018-04-05 00:35:55', '2018-04-05 00:35:55', 4, ''),
(43, 2, '1.	Plan de electrificación para el sector camaronero', '•	Se realizó una mesa de trabajo con camaroneros del Cantón Jama donde se identificó a la empresa NESCUR como la finca piloto para ejecución del Plan de Electrificación. En la reunión participaron 12 camaroneros que se encuentran emplazados en el área de influencia directa de la red de tendido eléctrico; estos camaroneros manifestaron su intención de tecnificarse mediante el uso de energías renovables.', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 07:43:00', 'Cantón Jama', 43, NULL, '1522871032-Asistencia en Jama.pdf', '2018-04-05 00:43:52', '2018-04-05 00:43:52', 4, ''),
(44, 2, '7.	Relanzamiento de programa “Mis Mariscos listos y mixtos”', 'Se entregaron 43 canastas listos y mixtos (productos frescos del mar empacados al vacío), en la cual participaron siete organizaciones pesqueras, beneficiando a 200 pescadores artesanales.', 'https://twitter.com/MinAcuaPescaEc/status/979492968674586635', '2018-04-03 07:44:00', 'MAP', 0, NULL, '1522871071-Anexo Canasta Listos y Mixtos.docx', '2018-04-05 00:44:31', '2018-04-05 00:44:31', 4, ''),
(45, 2, '1.	Plan de electrificación para el sector camaronero', '•	Se realizó una mesa de trabajo con camaroneros del Cantón Pedernales donde se identificó a la empresa DIVACCI como la finca piloto para ejecución del Plan de Electrificación. En la reunión participaron 11 camaroneros que se encuentran emplazados en el área de influencia directa de la red de tendido eléctrico; estos camaroneros manifestaron su intención de tecnificarse mediante el uso de energías renovables.', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 07:44:00', 'Cantón de Pedernales', 43, NULL, '1522871096-Asistencia Pedernales.pdf', '2018-04-05 00:44:56', '2018-04-05 00:44:56', 4, ''),
(46, 2, '1.	Plan de electrificación para el sector camaronero', '•	Se realizó la cuarta oficialización de 21 empresas interesadas en electrificarse, mediante Oficio MAP-SUBACUA-2018-3876; estas camaroneras interesadas cubren una superficie de 2.038,45 hectáreas distribuidas principalmente en la provincia de Manabí', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 07:46:00', 'Guayaquil', 43, NULL, '1522871174-MAP-SUBACUA-2018-3876-M.pdf', '2018-04-05 00:46:14', '2018-04-05 00:46:14', 4, ''),
(47, 2, '2.	Ejecución del Plan Sanidad Acuícola', 'Como parte del Plan de Sanidad Acuícola y su programa de monitoreo donde se determina el estado de salud y posibles factores que podrían afectar a la producción camaronera y cuyo objetivo es el de levantar información y línea base del estado zoosanitario, las principales prácticas y características de la actividad acuícola y la producción camaronera, detección de presencia de agentes patógenos (bacterias y virus) los cuales puedan causar problemas en maduraciones, laboratorios de producción de larvas y fincas camaroneras; el cual además permitirá establecer medidas de bioseguridad y buenas prácticas acuícolas. \r\n\r\nSe realizó la última etapa de monitoreo en la provincia de Santa Elena realizado desde el 27 al 29 de marzo de 2018, y cuya fecha de inicio fue desde el 19 de febrero de 2018.', 'http://www.acuaculturaypesca.gob.ec/subpesca4409-map-implementa-plan-nacional-de-sanidad-acuicola.html', '2018-04-03 07:48:00', 'Provincia de Santa Elena - San Pablo, Punta Carnero, La Diablica y Mar Bravo.', 34, NULL, '1522871314-Boletín MAP - Sanidad Acuícola SCI.pdf', '2018-04-05 00:48:34', '2018-04-05 00:48:34', 4, ''),
(48, 2, '3.	MAP fija veda anual de la merluza entre el 15 de septiembre y 31 de octubre', 'El Ministerio de Acuacultura y Pesca estableció el periodo anual de veda biológica de la merluza (Merluccius gayi) entre el 15 de septiembre y el 31 de octubre para embarcaciones artesanales e industriales incluida la pesca experimental polivalente. La decisión se adoptó con base en los indicadores reproductivos observados en la especie, determinados por los informes técnicos del Instituto Nacional de Pesca.\r\n\r\nEl Acuerdo Ministerial MAP-SRP-2018-0071-A fue suscrito por la subsecretaria de Recursos Pesqueros (s), Ana Álvarez Medina, y dejó sin efecto la fecha para la veda que se había fijado previamente, del 1 al 31 de abril y del 1 al 30 de septiembre.\r\n\r\nLas empresas procesadoras/empacadoras debidamente autorizadas, que tengan almacenadas merluzas capturadas y procesadas antes del periodo de veda, la podrán procesar y comercializar interna y externamente previa certificación de inventario (stock) por parte de la Dirección de Control.', 'http://www.acuaculturaypesca.gob.ec/subpesca4562-map-fija-veda-anual-de-la-merluza-entre-15-de-septiembre-y-31-de-octubre.html', '2018-04-03 07:52:00', 'Puerto Pesquero Artesanal de San Mateo - Manta', 0, 'El Ministerio de Acuacultura y Pesca suspendió la veda biológica para el recurso Merluza, que debía regir entre el 1 y 31 de abril, y estableció un nuevo periodo comprendido entre el 15 de septiembre y el 31 de octubre de 2018 para embarcaciones artesanales e industriales, incluida la pesca experimental polivalente. La decisión se adoptó con base en los indicadores reproductivos observados en la especie, determinados por los informes técnicos del instituto nacional de pesca.', '1522871546-Boletin de prensa MAP veda merluza.pdf', '2018-04-05 00:52:26', '2018-04-05 00:52:26', 4, ''),
(49, 2, '4.	Certificación profesional a los Pescadores Artesanales', 'En la segunda fase del proyecto, en la semana comprendida entre el 28 de marzo y el 3 de abril, se han realizado la evaluación teórica y práctica a 94 pescadores artesanales, dentro del proceso de certificación profesional en coordinación con el Instituto Técnológico Superior Luis Arboleda Martínez y las organizaciones pesqueras de la caleta Puerto Cayo del cantón Jipijapa Provincia Manabí. Además de realizar la socialización del proyecto a 100 pescadores de la caleta pesquera Los Arenales.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-04-03 07:54:00', 'caleta Puerto Cayo del cantón Jipijapa Provincia Manabí.', 29, NULL, '1522871660-infome_semanal_del__28_marzo_al_3_abril_2018_certificación_profesional.pdf', '2018-04-05 00:54:20', '2018-04-05 00:54:20', 4, ''),
(50, 2, '8.	Firma de Convenio World Wildlife Func Inc', 'El Ministerio de Acuacultura y Pesca y la organización conservacionista independiente en el mundo, World Wildlife Func Inc (WWF), suscribieron el martes en Manta un memorando de entendimiento para promover el manejo sostenible de las pesquerías y la competitividad del sector pesquero. El convenio ratifica el compromiso gubernamental de asegurar la explotación responsable de los recursos pesqueros e incluye el apoyo de la WWF en el proceso de diseño y aplicación de proyectos de mejoramiento, así como la conservación y manejo de especies.\r\nLas partes destacaron la importancia de los recursos pesqueros para la economía y la sociedad ecuatoriana, así como la necesidad de promover el manejo de las pesquerías y la competitividad del sector pesquero, con un enfoque ecosistémico para asegurar que estos recursos sigan utilizándose de forma sostenible. El acuerdo de cooperación, que tendrá una vigencia de cuatro años, busca además profundizar los beneficios económicos y ambientales de la actividad pesquera, que representó ingresos en divisas para el país por USD 1.559,3 millones en el 2017.', 'http://www.acuaculturaypesca.gob.ec/subpesca4571-ministerio-de-acuacultura-y-pescay-wwf-firman-convenio-para-promover-pesca-sostenible.html', '2018-04-03 07:54:00', 'Manta Host', 0, 'El Ministerio de Acuacultura y Pesca y la organización conservacionista independiente World Wildlife Func Inc (WWF) suscribieron el martes en Manta un memorando de entendimiento para promover el manejo sostenible de las pesquerías y la competitividad del sector pesquero. El convenio ratifica el compromiso gubernamental de asegurar la explotación responsable de los recursos pesqueros e incluye el apoyo de la WWF en el proceso de diseño y aplicación de proyectos de mejoramiento, así como la conservación y manejo de especies.', '1522871683-Boletin Firma de Convenio.pdf', '2018-04-05 00:54:43', '2018-04-05 00:54:43', 4, ''),
(51, 2, '9.	Mesa Técnica para regularización del Acuerdo para el ejercicio de la actividad en Tierras Altas', 'Se participó en una mesa técnica en el cantón de Durán donde se trató con delegados de otras instituciones la socialización y revisión del borrador de Acuerdo para regularizar camaroneras en tierras altas, donde participaron técnicos de la dirección de Control Acuícola, Políticas y Ordenamiento Acuícola y la Unidad de Asesoría Jurídica.', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 07:57:00', 'Durán—Provincia de Guayas', 0, NULL, '1522871842-Mesa Técnica para regularización del Acuerdo para el ejercicio de la actividad en Tierras Altas.pdf', '2018-04-05 00:57:22', '2018-04-05 00:57:22', 4, ''),
(52, 2, '5.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimiento a 84 Pescadores Artesanales en la provincia de Manabí (El Churo, Eloy Alfaro y Cojimies), que les permite fortalecer las capacidades técnicas en: Manejo de los Recursos y Regulación de la Actividad Pesquera, Asistencia Organizacional y Fomento Productivo.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-04-03 07:58:00', 'provincia de Manabí (El Churo, Eloy Alfaro y Cojimies)', 14, NULL, '1522871911-infome_semanal_del_28_marzo_al_3_abril_2018_capacitación_integral.pdf', '2018-04-05 00:58:31', '2018-04-05 00:58:31', 4, ''),
(53, 2, '10.	Capacitación sobre cultivo de cachama', 'En atención a petición realizada por la comunidad Kichwa Shandia, perteneciente a la provincia de Napo, se realizó capacitación sobre Cultivo y Manejo de Cachama dicha comunidad. A la misma, acudieron 21 miembros con quienes se discutió la importancia de la piscicultura en la Amazonía, tanto a nivel ecológico, cultural, tecnológico y económico.\r\n\r\nPosteriormente se expusieron todos los pasos para tener un cultivo exitoso de Cachamas, como es la selección correcta del sitio donde debe ser construida la piscina, preparación previa a la siembra de alevines, alimentación y algunas técnicas de manejo para evitar enfermedades en los peces y pérdida del cultivo.', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 07:58:00', 'Talag de la provincia de Napo.', 0, NULL, '1522871914-informe Capacitación sobre cultivo de cachama.pdf', '2018-04-05 00:58:34', '2018-04-05 00:58:34', 4, ''),
(54, 2, '11.	Inspección para evaluar condiciones oceanográficas que permitan el cultivo de ostras en el océano pacífico', 'En atención al requerimiento realizado por la Asociación Pesquera Artesanal Afiliada al Seguro Social Campesino y Pesquero de Jaramijó, donde solicita la asistencia técnica para determinar un área para el posible cultivo de ostra del Pacífico (Crassostrea gigas). La Subsecretaría de Acuacultura a través de los técnicos de la Dirección de Políticas y Ordenamiento Acuícola realizó inspección en el mar abierto, para evaluar las condiciones oceanográficas requeridas para el cultivo de este molusco en sistemas denominados “long line”. \r\n\r\nA dicha inspección asistieron cinco miembros de la Asociación Pesquera Artesanal Afiliada al Seguro Social Campesino y Pesquero de Jaramijó.', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 07:59:00', 'localidad de Jaramijó, provincia de Manabí.', 0, NULL, '1522871989-Informe DPOA Jaramijó.pdf', '2018-04-05 00:59:49', '2018-04-05 00:59:49', 4, ''),
(55, 2, '12. Festival de la Trucha', 'La Subsecretaría de Acuacultura participó en el segundo Festival de la Trucha con un stand donde se realizó la exposición del ciclo biológico de la trucha, y responder consultas a los asistentes en referencia a normativas y servicios del MAP.', 'https://1drv.ms/f/s!AkRyMdjiqPyggwSf8pYFbQbP5v2B', '2018-04-03 08:01:00', 'Cayambe-provincia de Pichincha', 0, NULL, '000Ninguno', '2018-04-05 01:01:46', '2018-04-05 01:13:49', 4, ''),
(56, 2, '6.	Permisos emitidos a nivel nacional de Pescadores Artesanales y de embarcaciones Artesanales', 'Se emitieron 51 permisos de Pescadores Artesanales y 46 permisos de Embarcaciones Artesanales a nivel nacional, 9 permisos a comerciantes minoristas, 15 permisos a comerciantes mayoristas, mismos que permiten se realice la actividad pesquera artesanal de manera legal en el país.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-04-03 09:06:00', 'Provincias: El Oro, Esmeraldas, Los Rios, Manabí', 0, NULL, '000Ninguno', '2018-04-05 02:06:31', '2018-04-05 02:06:31', 4, ''),
(57, 3, 'Asistencia Técnica Asociación Mentes Cristalinas', 'Asistencia técnica a la Asociación Mentes Cristalinas para la articulación del proyecto de elaboración de ataudes', 'Coordinación zonal 1', '2018-04-04 10:29:00', 'Atacames', 30, 'En el cantón de Atacames provincia Esmeraldas se esta llevando a cabo el apoyo a la Asociación mentes Cristalinas para el desarrollo de un proyecto de elaboración de ataudes.\r\n\r\nCon el apoyo en financiamiento de Gerente de SYMEP.SA Ing. Newton Patricio Rodriguez; ademas se realizó la donación de una hectarea de terreno para la construcción del taller.', '000Ninguno', '2018-04-05 03:29:49', '2018-04-05 03:29:49', 4, ''),
(58, 3, 'Capacitaciones', 'Fomento al Emprendimiento (40 asistentes)\r\n\r\nHerramientas de mercado negociación y venta (44 asistentes)\"', 'Coordinación zonal 3', '2018-04-28 10:32:00', 'Riobamba', 100, 'Se realizó las capacitaciones en Fomento al Emprendimiento y Herramientas de mercado negociación y venta con el objetivo de fortalecer de conocimientos a artesanos, Mipymes y miembros de las EPS.', '000Ninguno', '2018-04-05 03:32:36', '2018-04-05 03:32:36', 4, ''),
(59, 3, 'CAPACITACIÓN SOBRE BUENAS PRACTICAS DE HIGIENE', 'SE CAPACITO A 81 EXPENDEDORES DE LOS CENTROS DE ABASTOS DEL CANTÓN JIPIJAPA', 'Coordinación zonal 4', '2018-04-27 10:34:00', 'Jipijapa', 100, 'Concientes del fortalecimiento que se debe proporcionar a las Mipymes se capacitó a 83 comerciantes sobre Buenas Practicas de Higiene.', '000Ninguno', '2018-04-05 03:34:40', '2018-04-05 03:34:40', 4, ''),
(60, 3, 'Servicios de Formación y Capacitación a Empresas', 'Se gestiona la articulación con empresas públicas y privadas, para  la socializacíón de los servcios de formación y capacitación del Ministerio de Industrias y Productividad, con el objetivo de potencializar la oferta de bachillerato técnico productivo a los sectores.', 'Coordinación zonal 5', '2018-04-05 10:36:00', 'Guayaquil', 35, NULL, '000Ninguno', '2018-04-05 03:36:25', '2018-04-05 03:36:25', 4, ''),
(61, 3, 'Firma Convenio Interinstitucional CAPIA PREFECTURA AZUAY Y MIPRO', 'Firma Convenio Interinstitucional  para ejecución Feria Multisectorial ExpoAzuay 2018 con la participación de Mipymes, artesanos y eps. Con el apoyo de CAPIA, PREFECTURA AZUAY', 'Coordinación zonal 6', '2018-04-29 10:37:00', 'Cuenca', 100, 'El acceso a espacios de comercialización es una demanda de los sectores productivos para visibilizar sus productos y llegar a los consumidores.', '000Ninguno', '2018-04-05 03:37:39', '2018-04-05 03:37:39', 4, ''),
(62, 3, 'Conformación de la mesa de producción de la provincia de El Oro', 'En el ambito de la mesa se solicitó la socialización del contrato de YILPORT que incluye el tema del dragado de los seis muelles, el cual constituye un hito histórico fundamental para Puerto Bolívar, se posicionará en el mapa de la Región Sur, como un puerto mucho más atractivo para la llegada de los buques más grandes de contenedores, como parte de los planes de inversión.', 'Coordinación zonal 7', '2018-04-27 10:40:00', 'Machala', 5, 'El Dragado va a permitir acceso al puerto Bolivar y permite diversificar la logÍstica y oferta exportable de la zona, generando mayor competitividad.', '000Ninguno', '2018-04-05 03:40:41', '2018-04-05 03:40:41', 4, ''),
(63, 3, 'Taller de E-Commerce', 'Taller para dar a conocer al sector productivo las alternativas de canales de comercialización a través de servicios digitales y envío de productos', 'Coordinación zonal 7', '2018-04-29 10:41:00', 'Machala', 100, 'El MIPRO con el apoyo de la Cámara de Industrias de El Oro, Prefectura de El Oro y KRADAC imparten el taller de E-Commerce a más de 130 representantes del sector productivo de la provincia de El Oro', '000Ninguno', '2018-04-05 03:41:30', '2018-04-05 03:41:30', 4, ''),
(64, 3, 'Inteligencia Productiva: Roles y metodología de la Plataforma de Diálogo Nacional', 'Presidencia ha solicitado ampliar el seguimiento y visibilización de resultados de los diálogos presidenciales y diálogos sectoriales, a través de la herramienta digital desarrollada por el MIPRO, Inteligencia Productiva. La metodología de gestión de espacios de diálogo y el concepto de la herramienta han sido expuestos a autoridades y técnicos de Presidencia, SENPLADES y MCEI. La consigna es replicar las funcionalidades de este instrumento hacia el labor de monitoreo y control de las mesas de diálogo a cargo del Ejecutivo, en base al desarrollo de una nueva página web que reúna 4 componentes: diálogos presidenciales, diálogos sectoriales, inteligencia productiva y logros. La presentación de la herramienta a la ciudadanía se pretende realizar el 24 de mayo, a cargo de la Presidencia.', 'Subsecretario de Industrias Básicas, Dr. Claudio Arcos', '2018-03-05 12:06:00', 'Subsecretario de Industrias Básicas, Dr. Claudio Arcos', 20, 'En el ámbito de la innovación y las nuevas tecnologías, el gobierno de todos ha desarrollado un instrumento para que la ciudadanía pueda realizar el seguimiento a las propuestas que se han generado en los diferentes espacios de diálogo durante este primer año de gobierno. Esto se enmarca dentro de la propuesta de extender la transparencia de la gestión ejecutiva, esta vez, a través de una herramientas de gobierno abierto.', '000Ninguno', '2018-04-05 05:06:26', '2018-04-05 05:06:26', 5, ''),
(65, 3, 'Difusión de la prestación del servicio de Registro de Producción Nacional para el cálculo del Valor Agregado Nacional, VAN', 'El 21 de marzo se publica en la página web del Mipro, el acceso al servicio RPN. Se realizan actividades de difusión del servicio, al interior del Ministerio (Dirección de Comunicación Social ) y externamente (con Miduvi 29-marzo y Secretaría General de la Presidencia 10-abril) para que sea socializado, tanto la disponibilidad para la prestación del servicio en el formulario automatizado y los lineamientos respectivos emitidos por nuestra entidad.', 'Coordinador General de Servicios para la Producción, Ing. Dennis Zurita', '2018-04-11 02:18:00', 'A nivel nacional', 100, 'El Ministerio de Industrias y Productividad pone al servicio del sector industrial nacional, y la ciudadanía en general, el servicio de cálculo del valor agregado nacional de los bienes producidos en el país, herramienta de apoyo para el desarrollo productivo y encadenamiento para todos los proveedores nacionales de productos necesarios para las intervenciones emblemáticas, especialmente para el Programa “Casa para Todos”.', '000Ninguno', '2018-04-11 19:18:52', '2018-04-11 19:23:33', 5, ''),
(66, 1, 'Primera Mesa de Ganadería se efectuó en Galápagos', 'Para fortalecer el sector ganadero en la región insular, instituciones públicas y privadas, representantes de asociaciones ganaderas, productores independientes, institutos de investigación y conservación, organizaciones no gubernamentales participaron en la  primera “Mesa de ganadería Galápagos.\r\nLa actividad se desarrolló con el propósito de generar una línea de trabajo, concretar acuerdos y acciones estratégicas, así como definir un cronograma de seguimiento de acuerdo a las temáticas de producción, sanidad, comercialización y gobernabilidad.', 'http://www.agricultura.gob.ec/primera-mesa-de-ganaderia-se-efectuo-en-galapagos/', '2018-04-11 04:41:00', 'Santa Cruz - Galápagos', 30, 'A la primera mesa de ganadería asistieron representantes de instituciones públicas y privadas, asociaciones ganaderas, productores independientes, institutos de investigación y conservación, además de organizaciones no gubernamentales.\r\n\r\nEl propósito es generar una línea de trabajo, concretar acuerdos y acciones estratégicas, así como definir un cronograma de seguimiento de acuerdo a las temáticas de producción, sanidad, comercialización y gobernabilidad.\r\n\r\nLa mesa ganadera involucra a los actores de este medio para generar soluciones a las diferentes problemáticas, y efectuar un desarrollo sostenible y sustentable.', '000Ninguno', '2018-04-11 21:41:51', '2018-04-11 21:41:51', 5, ''),
(67, 1, 'Reunión con prefecto de Cotopaxi y participación en Gabinete', 'El ministro de Agricultura y Ganadería, Rubén Flores, se reunió con el prefecto de Cotopaxi, Jorge Guamán, para evaluar los avances alcanzados en temas de productos lácteos. Indicó que los controles respecto al uso de suero serán más estrictos y que se analiza la posibilidad de que no se utilice el 50% de leche y el 50% de suero como lo determina la norma INEN, sino que haya una relación 70-30 u 80-20 para garantizar el consumo de la leche que se produce en la provincia.\r\nAgregó que el suero  no es malo y que tampoco se puede eliminar en un 100% de los productos e indicó que trabajan en una reducción que signifique un mayor consumo de leche.', 'https://lahora.com.ec/cotopaxi/noticia/1102147787/propuestas-de-cotopaxi-se-procesan', '2018-04-11 04:43:00', 'Cotopaxi', 100, 'El Ministerio de Agricultura y Ganadería, junto a seis ministerios, suscribió el Acuerdo Interministerial 036, mediante el cual se controla y regula la producción de leche, incluido derivados y suero de leche.\r\n\r\nEl reglamento establece normas claras sobre el uso del suero, así como de la leche en la elaboración de derivados de leche y productos lácteos.\r\n\r\nEl reglamento establece responsabilidades de los entes reguladores y aporta a llevar a la práctica procesos sustentables, que al tiempo de garantizar la inocuidad de los alimentos, sean producto de prácticas amigables con el ambiente. En lo que le compete, el MAG estará encargado de inspeccionar y controlar la inocuidad en producción, acopio, transporte y comercialización de la leche cruda, incluido el suero de leche, del que se puede obtener pastillas de proteínas de leche.', '000Ninguno', '2018-04-11 21:43:38', '2018-04-11 21:43:38', 5, ''),
(68, 1, 'Recorrido por los nuevos laboratorios de la Universidad de Ambato', 'El ministro de Agricultura y Ganadería, Rubén Flores, asistió a la inauguración del campus de Seguridad y Soberanía Alimentaria de la Facultad de Ciencias Agropecuarias de la Universidad Técnica de Ambato, instalado en el sector Querochaca, cantón Cevallos.\r\nEn los laboratorios de la mencionada Universidad se podrán efectuar análisis de suelos, foliares, balanceados y botánicos.', 'Radio Ambato', '2018-04-05 04:45:00', 'Ambato', 100, NULL, '000Ninguno', '2018-04-11 21:45:32', '2018-04-11 21:45:32', 5, ''),
(69, 1, 'Reunión del Consejo Consultivo del Maíz', 'El 6 de abril se instaló en la ciudad de Guayaquil el Consejo Consultivo de la Cadena Agroalimentaria del maíz donde participaron alrededor de 40 representantes de asociaciones de productores e industria. \r\nSe trataron temas como: el contexto internacional del maíz, la situación actual y precios de la cadena, reglamento de comercialización de maíz, escenarios para la determinación del precio mínimo de sustentación, políticas de apoyo a la cadena y las posiciones de las mesas técnicas previas al Consejo Consultivo.', 'Twitter', '2018-04-06 04:48:00', 'Guayaquil', 100, NULL, '000Ninguno', '2018-04-11 21:48:43', '2018-04-11 21:48:43', 5, ''),
(70, 1, 'Operativos de control previo a la cosecha de maíz', 'Operativos de control para que estén bien calibradas las balanzas, básculas y los medidores de humedad efectuó el Ministerio de Agricultura y Ganadería (MAG) en los cantones Santa Lucía, Balzar, Pedro Carbo, de la provincia de Guayas, así como en los cantones Mocache, Ventanas, Buena Fe, Valencia, provincia de Los Ríos, que considerados de alta  productividad maicera.\r\nEl propósito es que mencionadas herramientas estén en óptimas condiciones, teniendo en cuenta que son factores determinantes para la calificación en el precio que obtendrán los agricultores por su producto son el peso y la humedad.', 'http://www.agricultura.gob.ec/mag-realiza-operativos-de-control-previo-a-inicio-de-la-cosecha-de-maiz', '2018-04-06 04:50:00', 'Guayas, Los Ríos', 100, 'El Ministerio de Agricultura y Ganadería (MAG) inició operativos de control para verificar que estén bien calibradas las balanzas, básculas y los medidores de humedad de maíz duro.\r\n\r\nEl propósito es que las mencionadas herramientas estén en óptimas condiciones, dado que son factores importantes para tener un peso exacto y el maíz sea adquirido con la humedad adecuada.\r\n\r\nLa tabla de precios que rige está basada en: porcentajes de impureza y humedad. Con los controles se pretende proteger a los pequeños productores y así evitar inconvenientes en el momento de la comercialización.', '000Ninguno', '2018-04-11 21:50:57', '2018-04-11 21:50:57', 5, ''),
(71, 1, 'MAG logra más salidas del arroz', 'El ministro de Agricultura y Ganadería, Rubén Flores, anunció que Venezuela comprará 13 mil toneladas de arroz, luego de que aceptara la propuesta efectuada en enero pasado.  \r\nEl Ministro además informó que la entidad analiza 32 mil expedientes recién recibidos de empresa pública Unidad Nacional de Almacenamiento (UNA EP) para poder cancelar una deuda de más de 14 millones que el MAG tiene con esta desde hace cuatro años.', 'http://www.agricultura.gob.ec/el-mag-logra-mas-salidas-al-arroz-venezuela-comprara-13-mil-tm', '2018-04-11 04:54:00', 'Quito', 100, 'Venezuela acogió la propuesta presentada por el Ministerio de Agricultura y Ganadería (MAG) el pasado 22 de enero, ante Carol Delgado, embajadora de Venezuela en Ecuador, y adquirirá 13 mil toneladas de arroz.\r\n\r\nProducto de la gestión que de manera articulada realizan los ministerios de Comercio Exterior, y de Agricultura y Ganadería, con la Empresa Pública Unidad Nacional de Almacenamiento (UNA EP) ya se exportó arroz a Colombia.\r\n\r\nReconociendo que el principal problema en el tema del arroz es la comercialización, junto a los productores se trabaja en un plan a 2030.', '000Ninguno', '2018-04-11 21:54:30', '2018-04-11 21:54:30', 5, ''),
(72, 3, 'Conferencia “Comercio Electrónico Como Una Herramienta Comercial”', 'Ministerio de Industrias y Productividad – MIPRO a través de la Subsecretaría de MIPYMES y Artesanías, desarrolló la Conferencia “Comercio Electrónico Como Una Herramienta Comercial” el día jueves 5 de abril.', 'Subsecretario de Mipymes y Artesanías, Roberto Estévez Echanique', '2018-04-11 05:01:00', 'Quito', 100, 'El Ministerio de Industrias y Productividad (MIPRO) a través de la Subsecretaría de MIPYMES y Artesanías, como unidad responsable en el apoyo a las Mipymes y Artesanos en la articulación de mercados, desarrollo una conferencia en la cual se destaca el uso de comercio electrónico como una fuerte herramienta que puede ser aprovechada como un canal más de comercialización. Se articuló con otras instituciones del Estado (CNT y Correos  del Ecuador), quienes tuvieron la oportunidad de promocionar sus productos que están vinculados directamente al comercio electrónico.', '000Ninguno', '2018-04-11 22:01:06', '2018-04-11 22:01:06', 5, ''),
(73, 3, 'Participación en el TALLER DE PRESENTACIÓN Y FORTALECIMIENTO DE LA GESTIÓN AMBIENTAL PARA EL POLO DE DESARROLLO INDUSTRIAL EN POSORJA.', 'Socialización a entidades públicas y privadas sobre la visión del MIPRO para un desarrollo productivo anclado a la implementación de Polos de Desarrollo Productivo y aspectos relevantes del Polo Industrial de Posorja, como uno de los proyectos de más alta relevancia nacional.', 'Director de Desarrollo Productivo de Industrias Básicas, Christian Arias.', '2018-04-11 10:11:00', 'Guayaquil', 100, 'El Polo Industrial de Posorja, que nace dentro de un enfoque de potenciar las ventajas competitivas propias de una zona apta para el desarrollo económico, industrial y productivo se convierte en uno de los proyectos más ambiciosos del Estado Ecuatoriano. El mismo busca una reconversión productiva encaminada a desarrollar, no solo las industrias básicas de carácter metalúrgico, sino que bajo una perspectiva de territorialidad, normativa ambiental, ordenamiento jurídico y beneficios fiscales establecidos en la ley, permitan la atracción de inversiones, potenciación de encadenamientos productivos, generación de empleo y distribución de la riqueza.', '000Ninguno', '2018-04-12 03:11:20', '2018-04-12 03:11:20', 5, ''),
(74, 2, '1.	Plan de Electrificación para el Sector Camaronero', 'Se realizaron mesas de trabajo con los gremios camaroneros de la Provincia de El Oro mencionados a continuación: \r\na.	Asociación de Productores Camaroneros Fronterizos “ASOCAM\"\r\nb.	Cooperativa    de   Producción    Pesquera    Sur   Pacífico “COOP. SUR PACÍFICO”\r\nc.	Cooperativa de Producción Pesquera Hualtaco- \"COOP. HUALTACO\"\r\nd.	Asociación de Productores   de Camarón Jorge Kayser- Santa Rosa -  \"APROCAM JK\" \r\ne.	Cámara de Productores de Camarón De El Oro - \"CPCEO\". \r\n\r\nEn los eventos participaron 60 camaroneros y se explicaron los beneficios de trabajar con energías renovables, iniciativa que se está impulsando mediante el Plan de Electrificación para el Sector Camaronero.\r\n\r\nPor otra parte, CFN indicó las diferentes líneas de crédito que los camaroneros podrán adoptar para realizar mejoras en sus fincas camaroneras, mientras que CNEL EP explicó los proyectos a desarrollarse en las zonas camaroneras. \r\n\r\nAl término de las socializaciones, los camaroneros de la Provincia de El Oro manifestaron su interés de electrificarse y de organizarse con la finalidad de crear Clústeres para asegurar la inversión estatal en los proyectos de tendido eléctrico que beneficiaran al sector; Se identificó una finca piloto de 39 hectáreas ubicada en Jambelí - Cantón Santa Rosa interesada en electrificarse y tecnificarse quien será el pionero en este sector.', 'Subsecretaría de Acuacultura', '2018-04-10 10:33:00', 'Provincia de El Oro', 43, NULL, '000Ninguno', '2018-04-12 03:33:41', '2018-04-12 03:33:41', 5, ''),
(75, 2, '2.	Sector atunero presentó propuesta de renovación de flota pesquera atunera del Ecuador', 'La ministra Katuska Drouet se reunió en la ciudad de Manta con delegados de Estaleiros Navais de Peniche (EPN) y China Shipbuilding Trading Co. Ltd. para dialogar en torno a la propuesta para la renovación flota pesquera atunera de Ecuador.\r\n\r\nEn el encuentro se revisó los aspectos técnicos y financieros de la oferta que fue socializada por separado a actores del sector privado.', 'https://twitter.com/MinAcuaPescaEc/status/982649348470255617', '2018-04-10 10:35:00', 'Manta', 0, NULL, '000Ninguno', '2018-04-12 03:35:08', '2018-04-12 03:35:08', 5, ''),
(76, 2, '3.	Certificación profesional a los Pescadores Artesanales', 'En la segunda fase del proyecto se ha realizado la evaluación teórica y práctica a 58 pescadores artesanales, dentro del proceso de certificación profesional en coordinación con el Instituto Tecnológico Superior Luis Arboleda Martínez y las organizaciones pesqueras de la caleta Santa Marianita del cantón Manta y San Clemente del Cantón Sucre Provincia Manabí.', 'MAP-Dirección de Pesca Artesanal', '2018-04-11 10:36:00', 'Provincia Manabí', 31, NULL, '1523504198-certificación_profesional_4_al_10_de_abril_2018.pdf', '2018-04-12 03:36:38', '2018-04-12 03:36:38', 5, ''),
(77, 2, '4.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimiento a 87 Pescadores Artesanales en las provincias de: i) Manabí (Jaramijó, Tosagua) ii) El Oro (Bajo Alto y Huaquillas), que les permite fortalecer las capacidades técnicas en: Manejo de los Recursos y Regulación de la Actividad Pesquera, Asistencia Organizacional y Fomento Productivo.', 'MAP-Dirección de Pesca Artesanal', '2018-04-10 10:38:00', 'Provincia Manabí y El Oro', 16, NULL, '1523504295-capacitación_integral_4_al_10_de_abril_2018.pdf', '2018-04-12 03:38:15', '2018-04-12 03:38:15', 5, ''),
(78, 2, '5.	Permisos emitidos a nivel nacional de Pescadores Artesanales y de embarcaciones Artesanales', 'Se emitieron 39 permisos de Pescadores Artesanales a nivel nacional, 47 permisos a comerciantes minoristas, 26 permisos a comerciantes mayoristas, mismos que permiten se realice la actividad pesquera artesanal de manera legal en el país.', 'MAP-Dirección de Pesca Artesanal', '2018-04-10 10:39:00', 'A nivel Nacional', 0, NULL, '000Ninguno', '2018-04-12 03:39:07', '2018-04-12 03:39:07', 5, ''),
(79, 2, '6.	Fortalecimiento de Seguridad Integral', 'Se realizó reunión del “Fortalecimiento de Seguridad Integral” con la participación de entidades de seguridad como la Policía Nacional, ECU911, Comando de Guardacostas, Agencia de Regulación y Control Hidrocarburífero y Capitanía del Guayas, en el cual tuvo como objetivo fortalecer a los gremios camaroneros brindándoles una plataforma geográfica informativa que les sirva para planificar y gestionar de mejor forma el desarrollo sustentable del sector Acuícola en el Guayas y así también a través de la retroalimentación mutua de información, lograr obtener una plataforma informativa que contenga información oportuna que sirva a las entidades de seguridad brindar un auxilio con rapidez y eficacia', 'MAP- Dirección de Control Acuícola', '2018-04-10 10:41:00', 'provincia del Guayas', 20, NULL, '1523504506-Invitación Plan Integral de Seguridad Acuícola.pdf', '2018-04-12 03:41:46', '2018-04-12 03:41:46', 5, ''),
(80, 2, '7.	Exportación de atún al mercado de la Unión Europea', 'La Ministra de esta Cartera de Estado mantuvo reunión de trabajo con representantes y miembros de los gremios de pesca (Cámara Nacional de Pesquería, ATUNEC, CEIPA), a fin de analizar aspectos relacionados con la exportación de atún al mercado de la Unión Europea, donde ratificó el cumplimiento de las regulaciones de este importante mercado.', 'MAP- Subsecretaría de Calidad', '2018-04-10 10:42:00', 'Guayaquil', 0, NULL, '000Ninguno', '2018-04-12 03:42:41', '2018-04-12 03:42:41', 5, ''),
(81, 2, '8.	Socialización de propuestas de Acuerdo Ministerial para el cultivo de camarón en tierras privadas con vocación agrícola', 'En instalaciones de Subsecretaría de Acuacultura se realizó reunión de trabajo con representantes de la Cámara Nacional de Acuacultura (CNA), Centro Nacional de Acuacultura e investigaciones marinas (CENAIM), para revisión y emisión de observaciones de la propuesta de Acuerdo Ministerial para la autorización del ejercicio de la actividad del cultivo de camarón en tierra privada con vocación agrícola económicamente no rentables.', 'MAP- Unidad de Políticas y Ordenamiento Acuícola', '2018-04-10 10:44:00', 'Guayaquil', 0, NULL, '1523504661-reunion_cna,_cenain.pdf', '2018-04-12 03:44:21', '2018-04-12 03:44:21', 5, ''),
(82, 2, '9.	MAP y MAE acuerdan revisar Estudio de Impacto Ambiental del Dragado de Puerto Bolívar para evitar efectos en Cadena del Camarón', 'Los ministros de Acuacultura y Pesca y Ambiente, Katuska Drouet y Tarcisio Granizo, acordaron con representantes de los gremios camaroneros revisar y profundizar el Estudio de Impacto Ambiental (EIA) al proyecto del dragado de Puerto Bolívar, El Oro, a fin de evitar posibles impactos en la cadena productiva del camarón. La decisión se adoptó en respuesta a las inquietudes del sector por las secuelas de la puesta en marcha de la obra.', 'MAP', '2018-04-10 10:45:00', 'Guayaquil', 0, 'LOS MINISTROS DE ACUACULTURA Y PESCA Y AMBIENTE, KATUSKA DROUET Y TARCISIO GRANIZO, ACORDARON EL VIERNES EN GUAYAQUIL CON REPRESENTANTES DE LOS GREMIOS CAMARONEROS REVISAR Y PROFUNDIZAR EL ESTUDIO DE IMPACTO AMBIENTAL (EIA) AL PROYECTO DEL DRAGADO DE PUERTO BOLÍVAR, EL ORO, A FIN DE EVITAR POSIBLES IMPACTOS EN LA CADENA PRODUCTIVA DEL CAMARÓN. LA DECISIÓN SE ADOPTÓ EN RESPUESTA A LAS INQUIETUDES DEL SECTOR POR LAS SECUELAS DE LA PUESTA EN MARCHA DE LA OBRA.\r\nLA MEDIDA RESPONDIÓ AL COMPROMISO DE LAS CARTERAS DE ESTADO DE PRECAUTELAR EL BIENESTAR DE ESTE SECTOR PRODUCTIVO Y A LA PREOCUPACIÓN EXPRESADA POR GREMIOS, COMO LA CÁMARA NACIONAL DE ACUACULTURA (CNA) Y REPRESENTANTES DE LOS GREMIOS CAMARONEROS DE LA PROVINCIA DE EL ORO, RESPECTO A ASPECTOS TÉCNICOS DEL ESTUDIO DE IMPACTO AMBIENTAL QUE FUE PRESENTADO POR LA CONCESIONARIA PARA EL DESARROLLO DEL DRAGADO DEL MUELLE, DE LA ZONA DE MANIOBRA Y DEL CANAL DE ACCESO A PUERTO BOLÍVAR.', '000Ninguno', '2018-04-12 03:45:35', '2018-04-12 03:51:48', 5, ''),
(83, 3, 'ENCUENTRO DE ENCADENAMIENTOS PRODUCTIVOS', 'En trabajo articulado con el MAG se realizó el encuentro de encadenamientos productos en el cual se dio a expuso a comerciantes productos de la zona para que ingresen a perchas o a establecimientos como hoteles y restaurantes', 'Coordinación zonal 1', '2018-04-04 08:45:00', 'Ibarra', 100, 'Los encadenamientos productivos permiten el desarrollo comercial del sector ante lo cual el Ministerio de Industrias y Productivdad en la ciudad de Ibarra desarrollo con el apoyo del MAG un encuentro en el que se dio a conocer a comerciantes productos elaborados en territorio.', '000Ninguno', '2018-04-12 13:45:09', '2018-04-12 13:45:09', 6, ''),
(84, 3, 'Fortalecimiento de Asociaciones productoras de sacha inchi', 'Capacitaciones a las siguientes asociaciones productoras de sacha inchi :  Asociación de Producción Agropecuaria , Asoproakuri, \r\nAsociación Agroindustrial Talag, Asociación Inti. Se impartió los siguientes temas: \r\n1. Motivación para emprender\r\n2. Propuesta de valor del producto\r\n3. Manejo de centro de acopio\r\n4. Fortalecimiento organizacional\r\n5. Mercados mundiales sacha inchi', 'Coordinación zonal 3', '2018-04-03 08:46:00', 'Tena', 100, 'Se capacitó a  las siguientes asociaciones productoras de sacha inchi :  Asociación de Producción Agropecuaria , Asoproakuri, \r\nAsociación Agroindustrial Talag, Asociación Inti.', '000Ninguno', '2018-04-12 13:46:42', '2018-04-12 13:46:42', 6, ''),
(85, 3, 'Mesa de Competividad de Cotopaxi', 'Análisis de problemáticas de los sectores: turismo, comercios, industrias, agroindustrias, transporte y logística mediante la metodología de las Mesas Competitivas', 'Coordinación zonal 3', '2018-04-05 08:47:00', 'Latacunga', 100, 'Se realizó las Mesas Competitivas de Cotopaxi, un espacio creado para analizar las problemáticas de los sectores (turismo, comercios, industrias, agroindustrias, transporte y logística) mediante la metodología de las Mesas Competitivas y proponer soluciones generadas por los actores y articuladas con la academia e instituciones públicas.', '000Ninguno', '2018-04-12 13:47:44', '2018-04-12 13:47:44', 6, ''),
(86, 3, 'Mesa de Concertación del Café', 'Participación en Mesa Interinstiucional de Concertación del Café.', 'Coordinación zonal 4', '2018-04-05 08:48:00', 'Portoviejo', 50, 'Se plantearon nuevas metas productivas para el desarrollo del sector cafetalero en la Provincia de Manabí.', '000Ninguno', '2018-04-12 13:48:50', '2018-04-12 13:48:50', 6, ''),
(87, 3, 'Reunion Asamblea General Federación de la Cámara de Industrias del Ecuador', 'Asamblea General Extraordinaria de la Federación Nacional de la Cámara de Industrias del Ecuador', 'Coordinación zonal 6', '2018-04-03 08:49:00', 'Cuenca - Azuay', 100, 'Reunión mantenida entre el Ministerio de Industrias y Productividad representado por el Sr. Viceministro y el Sr. Coordinador Zonal 6 con la Federación Nacional de Cámaras de Industrias el día martes 03 de abril de 2018 en la ciudad de Cuenca  con la finalidad de asistir a la convocatoria a Asamblea General Extraordinaria de la Federación Nacional de la Cámara de Industrias del Ecuador para dialogar sobre la política industrial y analizar  medidas económicas planteadas por el Gobierno Nacional\r\n\r\nEn referencia a las medidas económicas emitidas por el Gobierno Central se ha determinado la subida de Aranceles, respetando insumo y bienes de capital.\r\n\r\nLa preocupación por el sector Industrial respecto al listado definitivo de exoneración\r\n\r\nEl compromiso del Mipro es realizar seguimiento al listado definitivo.', '000Ninguno', '2018-04-12 13:49:34', '2018-04-12 13:49:34', 6, ''),
(88, 3, 'Capacitación en Mejora y Terminado de Productos Textiles.', 'Taller práctico de acabado de productos textiles dirigido a asociaciones del  de la zona minera de Zaruma y Portovelo', 'Coordinación zonal 7', '2018-04-02 08:50:00', 'Zaruma', 100, 'Fomentar ala reactivación productiva capacitando a los artesanos y emprendedores para mejorar e innovar sus productores generando mayor valor agregado', '000Ninguno', '2018-04-12 13:50:22', '2018-04-12 13:50:22', 6, ''),
(89, 3, 'Mesas de Competitividad', 'Realizar las mesas de Competitividad en la provincia de Zamora Chinchipe, cantón Yantzaza.', 'Coordinación zonal 7', '2018-04-05 08:51:00', 'Yantzaza', 100, 'Generar en territorio propuestas y requerimientos para afianzar el desarrollo y competitividad en cada una de las provincias, con actores públicos y privados que intervienen en la dinámica productiva de los sectores agroindustrial e industrial; acuacultura, turismo,\r\ntransporte, comercio y minería.', '000Ninguno', '2018-04-12 13:51:08', '2018-04-12 13:51:08', 6, ''),
(90, 3, 'Reunión Sectores Productivos de Manabí para exponer Politica Industrial', 'Conversatorio de la Politica Industrial con la presencia de la Sra. Ministra Eva Garcia Fabre y representantes del sector productivo artesanal.', 'Coordinación zonal 4', '2018-04-14 02:55:00', 'Portoviejo', 50, 'Dentro del esquema del cambio de la matriz productiva fue expuesta la politica industrial en un conversatorio con los gremios, representates del sector productivo empresarial, mipymes, comerciantes.', '000Ninguno', '2018-04-18 19:55:41', '2018-04-18 19:55:41', 6, ''),
(91, 3, 'Sesión Extraordinaria del Consejo Sectorial de la Producción', 'El 16 de Abril del 2018, se realizó la sesión extraordinaria del Consejo Sectorial de la Producción convocado por la Señora Magister Eva García Fabre.', 'Coordinación zonal 4', '2018-04-16 02:57:00', 'Manta', 100, 'Se trataron los temas: 1. Informe del cambio en la norma de acuerdo al Decreto Ejecutivo No. 365, 2. Informe referente a la Plataforma de Inteligencia Productiva , 3. Informe de trabajo realizado con el Ministerio de Economía y Finanzas.', '000Ninguno', '2018-04-18 19:57:11', '2018-04-18 19:57:11', 6, ''),
(92, 3, 'Visita  al Proyecto de Panaderia Ceibo Renacer', 'Visita conjunta  con el Señor Presidente de la República al Proyecto de vecinos Panaderia Ceibo Renacer, ciudadanos afectados por el Terremoto del 16 A.', 'Coordinación zonal 4', '2018-04-16 02:58:00', 'Manta', 50, NULL, '000Ninguno', '2018-04-18 19:58:11', '2018-04-18 19:58:11', 6, ''),
(93, 3, 'MESAS COMPETITIVAS EN LA PROVINCIA DE LOS RÍOS', 'SE REALIZÓ LA MESA COMPETITIVIDAD CON LOS SECTORES: AGROINDUSTRIA, COMERCIO, INDUSTRIA, TRANSPORTE Y TURISMO. \r\n153 PARTICIPANTES\r\n40 PROPUESTAS', 'Coordinación zonal 5', '2018-04-12 03:00:00', 'Babahoyo', 100, NULL, '000Ninguno', '2018-04-18 20:00:10', '2018-04-18 20:00:10', 6, ''),
(94, 3, 'INAUGURACIÓN DEL CENTRO INTEGRAL DE FAENAMIENTO DE LA PROVINCIA DE SANTA ELENA', 'SE LOGRÓ LA REPONTENCIACIÓN DEL CENTRO DE FAENAMIENTO DE LA LIBERTAD, PARA EL SERVICIO DE LA PROVINCIA DE SANTA ELENA, CON LO QUE SE INCORPORARÁ MAYOR VALOR AGREGADO EN LA PRODUCCIÓN DE CÁRNICOS, LA DIVERSIFICACIÓN PRODUCTIVA Y DE LOS MERCADOS, PARA GARANTIZAR LA INOCUIDAD DE ÉSTOS A LOS CONSUMIDORES.', 'Coordinación zonal 5', '2018-04-13 03:01:00', 'LA LIBERTAD', 100, NULL, '000Ninguno', '2018-04-18 20:01:02', '2018-04-18 20:01:02', 6, ''),
(95, 3, 'Feria ExpoAzuay 2018', 'Feria Multisectorial ExpoAzuay 2018 con la participación de Mipymes, artesanos y eps. Con el apoyo de CAPIA, PREFECTURA AZUAY', 'Coordinación zonal 6', '2018-04-13 03:02:00', 'Cuenca - Azuay', 100, NULL, '000Ninguno', '2018-04-18 20:02:18', '2018-04-18 20:02:18', 6, ''),
(96, 3, 'Recorrido del Bus de la Calidad en Zamora Chinchipe', 'El bus de la calidad recorrió la provincia de Zamora Chinchipe para análisis de muestras de productos procesados de café, carne, confitería y leche cruda;  en articulación con Agrocalidad.  \r\nSe analizaron 15 muestras de productos procesados y 24 muestras de leche cruda.', 'Coordinación zonal 7', '2018-04-09 03:03:00', 'Zamora Chinchipe', 100, 'El laboratorio movil del MIPRO visita el terrirotio, brindando servicios gratuitos al pequeño productor, con la  finalidad de optimizar la calidad de producción y el control de la inocuidad en los alimentos', '000Ninguno', '2018-04-18 20:03:19', '2018-04-18 20:03:19', 6, '');
INSERT INTO `csp_reportes_hechos` (`id`, `institucion_id`, `tema`, `descripcion`, `fuente`, `fecha_reporte`, `lugar`, `porcentaje_avance`, `lineas_discursivas`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`) VALUES
(97, 3, 'Semana de la Calidad', 'Jornadas de capacitación con el taller denominado \'Sistema de la Calidad\' en el cual se trataron los temas: sellos hace Bien hace Mejor, Buenas Prácticas de Manufactura y Ley del Consumidor. Este evento se realizó en la ciudades de Loja, Zamora y Machala con un alcance de 300 beneficiarios.', 'Coordinación zonal 7', '2018-04-11 03:04:00', '\"Loja,  El Oro  y  Zamora Chicnhipe', 100, NULL, '000Ninguno', '2018-04-18 20:04:52', '2018-04-18 20:04:52', 6, ''),
(98, 3, 'Taller de Cerámica', 'Capacitaciones en temas de pintura y terminado de piezas de cerámica dictado a mujeres artesanas de la comunidad de Cera, perteneciente a la parroquia Taquil.', 'Coordinación zonal 7', '2018-04-12 03:05:00', 'Loja', 100, NULL, '000Ninguno', '2018-04-18 20:05:53', '2018-04-18 20:05:53', 6, ''),
(99, 1, 'Reunión con organizaciones indígenas evangélicas', 'El ministro de Agricultura y Ganadería, Rubén Flores, se reunió con dirigentes del Consejo de Pueblos y Organizaciones Indígenas Evangélicas del Ecuador para buscar acuerdos de trabajo conjuntos con el Gobierno Nacional en favor de sus comunidades.', 'Twitter', '2018-04-11 03:57:00', 'Quito', 100, NULL, '000Ninguno', '2018-04-18 20:57:51', '2018-04-18 20:57:51', 6, ''),
(100, 1, 'Entrega de productos de la Gran Minga Agropecuaria, en Nueva Loja', 'Kits de arroz y maíz, títulos de propiedad de tierras, créditos, acuerdos ministeriales otorgando la personería jurídica asociativa, e indemnizaciones del seguro agrícola recibieron productores de la provincia de Sucumbíos.\r\nLas entregas se efectuaron durante la presentación de servicios financieros y no financieros de la Gran Minga Nacional Agropecuaria.\r\nEn el acto, el Ministro también defendió la fijación de precios de maíz y arroz, establecida mediante una franja de precios. \r\nAdemás, como parte de su agenda el Ministro se reunió con los miembros de la Mancomunidad del Norte, para mediante la cooperación interinstitucional promover proyectos de desarrollo agroproductivo entre el Ministerio de Agricultura y Ganadería conjuntamente con los gobiernos autónomos descentralizados de Imbabura, Carchi, Esmeraldas y Sucumbíos', 'http://www.agricultura.gob.ec/productores-de-sucumbios-reciben-beneficios-de-la-gran-minga-agropecuaria/', '2018-04-12 04:01:00', 'Nueva Loja - Sucumbíos', 100, 'La entrega de productos financieros y no financieros forma parte de la Gran Minga Nacional Agropecuaria, estrategia de intervención del Gobierno para desarrollar el agro del país.\r\n\r\nComo parte de esa estrategia, entre el 24 de mayo de 2017 y el 31 de marzo de 2018 el MAG, 32.256 predios han obtenido su título de propiedad, beneficiando a alrededor de 130 mil pequeños y medianos productores del país; más de 300 mil agricultores han sido capacitados y han recibido asistencia técnica.\r\n\r\nEn el contexto de la Gran Minga Agropecuaria, entre el 24 de mayo del año anterior y el 13 de abril de este año BanEcuador ha colocado USD 362,2 millones para potenciar los procesos de producción de 50.547 familias campesinas. \r\n\r\nCon la Mancomunidad del Norte (conformados por los gobiernos autónomos descentralizados de Imbabura, Carchi, Esmeraldas y Sucumbíos) se ejecutan políticas públicas para el agro, dentro del ámbito de sus atribuciones y competencias relacionadas con el fomento y desarrollo productivo y agropecuario territorial.', '000Ninguno', '2018-04-18 21:01:22', '2018-04-18 21:01:22', 6, ''),
(101, 1, 'Reunión con productores de Azuay y Cañar', 'El ministro de Agricultura y Ganadería, Rubén Flores, se reunió con productores de las provincias de Azuay y Cañar, para analizar los avances de las hojas de ruta en el sector ganadero. En el encuentro participaron Yaku Pérez, presidente de la Ecuarunari, así como pequeños ganaderos de Girón, Cumbe, Tarqui, Victoria de Portete, San Fernando, San José de Raranga y Jima, de Azuay. \r\nCon los dirigentes de los productores el Ministro firmó un acuerdo sobre lucha contra contrabando, promoción de consumo de leche, y suspensión de la aplicación del acuerdo interinstitucional 036 hasta tener un instructivo consensuado con la comunidad.', 'Twitter y http://www.agricultura.gob.ec/wp-content/uploads/2018/04/hoja-01.jpg', '2018-04-17 04:02:00', 'Cuenca', 100, 'Con productores de las provincias de Azuay y Cañar se analizó los avances de las hojas de ruta en el sector ganadero. En el encuentro participaron Yaku Pérez, presidente de la Ecuarunari, así como pequeños ganaderos de Girón, Cumbe, Tarqui, Victoria de Portete, San Fernando, San José de Raranga y Jima, de Azuay. \r\n\r\nEl ministro Rubén Flores firmó un acuerdo profundizar  la lucha contra contrabando de lácteos y derivados; proteger la producción nacional; promover el consumo de leche; suspender la aplicación del acuerdo interinstitucional 036 hasta tener un instructivo consensuado con la comunidad; suspender la implementación del areteo, guías de movilización y prohibición de venta de leche cruda; impulsar la reactivación de la planta de Girón; impulsar ante la Senescyt la implementación de un instituto tecnológico de producción de leche.', '000Ninguno', '2018-04-18 21:02:54', '2018-04-18 21:02:54', 6, ''),
(102, 1, 'Organizaciones sociales y campesinas dialogaron con el Presidente', 'Representantes de organizaciones campesinas y sociales dialogaron con el presidente Lenín Moreno; la vicepresidenta María Alejandra Vicuña; los ministros de Política, Miguel Carvajal, y de Agricultura y Ganadería, Rubén Flores, en el marco del Día de la Lucha Campesina.\r\nParticiparon dirigentes de la Federación de Comunas de Guayas, Coordinadora Nacional Campesina Eloy Alfaro, Confederación de Pueblos y Organizaciones Indígenas y Campesinas del Ecuador, Unión Provincial de Organizaciones Campesinas de Manabí, Federación Nacional de Trabajadores Agroindustriales, Campesinos e Indígenas Libres del Ecuador, Unión de Organizaciones Campesinas de Cangahua, Confederación Nacional de Afiliados al Seguro Social Campesino y Federación Nacional de Organizaciones Campesinas, Indígenas y Negras.', 'http://www.agricultura.gob.ec/organizaciones-campesinas-y-sociales-expresan-su-respaldo-al-gobierno/', '2018-04-17 04:03:00', 'Quito', 100, 'Los representantes de las organizaciones sociales y campesinas propusieron poner énfasis en una ley de fronteras,  para construir una política pública y alianzas para la zona de frontera donde los campesinos están entre los más afectados por la situación de inseguridad, además de considerar que es necesarios reformar las leyes de economía popular y solidaria, tránsito, comunas, entre otras, que deben adaptarse a las realidades territoriales.\r\n\r\nCon los productores se analizaron temas como la comercialización, precios, controles a contrabando, especulación, desarrollo de valor agregado en la producción nacional, servicios financieros y no financieros, pensiones jubilares y ampliación de afiliaciones al seguro campesino, entre otros. Solicitaron fortalecer la institucionalidad del Ministerio de Agricultura y Ganadería, limpiar la corrupción en todas las áreas y devolver la administración de la UNA EP a esta cartera de Estad.\r\n\r\nParticiparon en la reunión representantes de: la Federación de Comunas de Guayas, Coordinadora Nacional Campesina Eloy Alfaro, Confederación de Pueblos y Organizaciones Indígenas y Campesinas del Ecuador, Unión Provincial de Organizaciones Campesinas de Manabí, Federación Nacional de Trabajadores Agroindustriales, Campesinos e Indígenas Libres del Ecuador, Unión de Organizaciones Campesinas de Cangahua, Confederación Nacional de Afiliados al Seguro Social Campesino y Federación Nacional de Organizaciones Campesinas, Indígenas y Negras.', '000Ninguno', '2018-04-18 21:03:58', '2018-04-18 21:03:58', 6, ''),
(103, 1, 'Rueda de negocios de maíz', 'El Ministerio de Agricultura y Ganadería realiza la Sexta Rueda de Negocios del Maíz este 18 de abril, en el Centro de Exposiciones Plaza Baquerizo Moreno, en Guayaquil.\r\nEl evento tiene como propósito promover procesos de comercialización del maíz, fomentar la interacción directa entre asociaciones de productores e industrias balanceadoras, y fortalecer las capacidades negociadoras de las asociaciones para que el agricultor reciba un mejor precio sin la intervención de intermediarios.', 'Twitter', '2018-04-18 04:04:00', 'Guayaquil', 100, 'La Rueda de negocios promueve procesos de comercialización del maíz, fomenta la interacción directa entre asociaciones de productores e industrias balanceadoras, y fortalece las capacidades negociadoras de las asociaciones para que el agricultor reciba un mejor precio, sin la intervención de intermediarios.\r\n\r\nParticiparon 75 asociaciones de productores de maíz duro y cerca de 30 industrias balanceadoras y generadoras de proteína animal (aves, cerdos, huevos).\r\nLas ruedas de negocios promueven una estrategia transparente a beneficio de los pequeños y medianos productores del país.\r\n\r\nEl maíz duro es la materia prima básica para elaborar alimento balanceado para generar proteína animales; es decir, carne de pollo, carne de cerdo, además de huevos, productos de alta demanda en la dieta diaria de los ecuatorianos.', '000Ninguno', '2018-04-18 21:04:51', '2018-04-18 21:04:51', 6, ''),
(104, 2, '1.	Certificación profesional a los Pescadores Artesanales', 'En la segunda fase del proyecto, se han realizado evaluaciones teóricas y prácticas del proceso de certificación profesional en coordinación con el Instituto Tecnológico Superior Luis Arboleda Martínez y las organizaciones pesqueras de la caleta San Jacinto del cantón Sucre, Provincia Manabí, Certificando las capacidades técnicas de 26 Pescadores Artesanales.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-04-17 05:43:00', 'Provincia de Manabí', 32, NULL, '1524091397-infome_semanal_del_11_al_17_abril_2018_certificación_profesional.pdf', '2018-04-18 22:43:17', '2018-04-18 22:43:17', 6, ''),
(105, 2, '2.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimientos a 283 Pescadores Artesanales: \r\n\r\n-	En la provincia de Manabí FASE III (Plan de negocios, administración de empresas, contabilidad básica, marketing y comercialización y mercadeo digital): en los cantones de Tosagua y Sucre se beneficiaron a 38 pescadores artesanales;\r\n\r\n-	En la provincia de Esmeraldas FASE I y III (Pesca sustentable y conservación de los recursos, instrumentos de regularización de la pesca artesanal, buenas prácticas de higiene y manufactura, conservación de la pesca y valor agregado): en el cantón Muisne en las caletas pesqueras de Chamanga, Daule y Mompiche donde se beneficiaron a 162 pescadores artesanales;\r\n\r\n-	En la provincia de Pichincha FASE I y III (Pesca sustentable y conservación de los recursos, instrumentos de regularización de la pesca artesanal, buenas prácticas de higiene y manufactura y conservación de la pesca), en el cantón de Rumiñahui donde se beneficiaron a 37 pescadores artesanales;\r\n\r\n-	En la provincia de El Oro FASE II (Asociatividad, liderazgo organizacional, procesos de asociatividad y normativas vigentes) en el cantón Santa Rosa y El Guabo en las caletas pesqueras Puerto Jelí y Bajo Alto beneficiando a 46 pescadores artesanales.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-04-17 05:45:00', 'Provincia: Manabí, Esmeraldas, Pichincha y El Oro', 13, NULL, '1524091543-infome_semanal_del_11_al_17_abril_2018_capacitación_integral.pdf', '2018-04-18 22:45:43', '2018-04-18 22:45:43', 6, ''),
(106, 2, '4.	Feria “Casa Verde”', 'Se participó en la feria “Casa Verde” para la promoción de productos con valor agregado donde se presentaron 7 organizaciones del sector pesquero artesanal del Programa Mis Mariscos Listos y Mixtos apoyados por esta Cartera de Estado Ministerio de Acuacultura y Pesca.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-04-17 05:59:00', 'Manta', 0, NULL, '1524092366-Mis Mariscos listos y Lixtos.docx', '2018-04-18 22:59:26', '2018-04-18 22:59:26', 6, ''),
(107, 2, '5.	Plan de Electrificación para el Sector Camaronero', 'Como parte de las gestiones que realiza el Ministerio de Acuacultura y Pesca a través de la Subsecretaría de Acuacultura para buscar incentivos y generar confianza en el sector camaronero impulsando el desarrollo sostenible, se convocó a reunión de trabajo a funcionarios de la Corporación Nacional de Electricidad (CNEL EP) y la Agencia de Regulación y Control de Electricidad (ARCONEL) a fin de revisar y analizar el tema de la Re-Facturación (Tarifa especial) para este sector, en dicha reunión se contó con la participación de GPS Group quienes representan a un importante grupo de camaroneros (EMPAGRAN, PRODUMAR, LIMBOMAR, SANTA PRISCILA y LARVIQUEST) los cuales se han electrificado parcialmente y solicitan una tarifa preferencial conforme a lo dispuesto por ARCONEL en beneficio del sector camaronero.\r\n\r\nEn la actualidad CNEL EP y esta Cartera de Estado se encuentran en espera del pronunciamiento por parte de ARCONEL sobre las tarifas especiales solicitadas por este sector.', 'Ministerio de Acuacultura y Pesca, Ministerio de Electrificación y Energía Renovable, Corporación Nacional de Electricidad.', '2018-04-17 06:01:00', 'Guayaquil', 43, NULL, '1524092518-Reunión CNEL EP refacturación.jpeg', '2018-04-18 23:01:58', '2018-04-18 23:01:58', 6, ''),
(108, 2, '6.	Capacitación sobre Cultivo y Manejo de Cachama', 'Se realizó la capacitación sobre Cultivo y Manejo de Cachama a las comunidades Shuar Chuwitayu y Yuu en la provincia de Pastaza, el día 10 de abril de 2018, localizado en el Km. 62 Vía Puyo-Macas, parroquia Simón Bolívar. A la cita acudieron 16 miembros de la asociación Chuwitayu y Yuu con quienes se discutió la importancia de la piscicultura en la Amazonía, tanto a nivel ecológico, cultural, tecnológico y económico.\r\n\r\nAsí mismo, el 12 de abril de 2018 en el Salón Organización Nacionalidades Kichwa, en la ciudad de Puyo provincia de Pastaza, se capacitó a productores de la Federación de Organizaciones Agrícolas y Piscícolas. A la cita acudieron 38 asistentes que manifestaron su interés en adquirir alevines de cachamas para cultivos en fincas.\r\n\r\nEn dichas capacitaciones se expusieron los pasos para tener un cultivo exitoso de Cachamas, destacando la importancia de la selección correcta del sitio donde debe ser construida la piscina, preparación previa a la siembra de alevines, alimentación y algunas técnicas de manejo para evitar enfermedades en los peces y pérdida del cultivo.', 'MAP- Subsecretaría de Acuacultura-Dirección de Políticas y Ordenamiento Acuícola', '2018-04-17 06:05:00', 'Provincia de Pastaza', 0, NULL, '1524092718-Informe_de_capacitación Cultivo y Manejo de Cachama 12-04-2018.pdf', '2018-04-18 23:05:06', '2018-04-18 23:05:18', 6, ''),
(109, 2, '7.	Dotación de alevines de Cachama', 'En el centro de reproducción de cachamas CEREC una vez cumplido con los requisitos para efectuar la dotación de alevines, se realizó la dotación de 70.000 alevines de cachamas para 7 comunidades beneficiando a 84 productores pertenecientes a las Comunidades: \r\n\r\n•	Asociación Productores Agrícolas Tarimiat-Tiwi en la Comunidad Shuar Sagrado Corazón Yukias de la provincia de Morona Santiago.\r\n•	Comunidad Achuar Kupit de la provincia de Morona Santiago\r\n•	Comunidad Achuar Wampuik de la parroquia Huasaga cantón Taisha en la provincia de Morona Santiago.\r\n•	Comunidad Achuar Juyu Kamentsa de la parroquia Pampuentsa del cantón Taisha en la provincia de Morona Santiago.\r\n•	Comunidad Achuar Napurak en la provincia de Morona Santiago.\r\n•	Comunidad Achuar Setuch de la parroquia Pampuentsa en la provincia de Morona Santiago.\r\n•	Comunidad Achuar Surikentsa de la parroquia Huasaga del cantón Taisha en la provincia de Morona Santiago', 'MAP- Subsecretaría de Acuacultura-Dirección de Políticas y Ordenamiento Acuícola- Unidad de Fomento Acuícola y Estaciones Piscícolas.', '2018-04-17 06:06:00', 'Provincia Morona Santiago', 0, NULL, '1524092807-dotacion.rar', '2018-04-18 23:06:47', '2018-04-18 23:06:47', 6, ''),
(110, 2, '8.	Venta de Alevines de Cachama', 'En la estación piscícola EPAI ubicada en El Cajas, cantón Cuenca, provincia de Azuay una vez consolidado el listado de solicitudes de piscicultores de la provincia de Loja y Azuay para la compra de 9.000 alevines de trucha que se producen en la Estación Piscícola Arco Iris -EPAI, se procedió a la venta de los alevines que fueron previamente autorizados por el Subsecretario de Acuacultura para ser entregados el 11 de abril 2018 beneficiando a 16 piscicultores en territorio.', 'MAP- Subsecretaría de Acuacultura-Dirección de Políticas y Ordenamiento Acuícola', '2018-04-17 06:07:00', 'Provincia Azuay', 0, NULL, '1524092860-map-subacua-2018-4210-m-venta.pdf', '2018-04-18 23:07:40', '2018-04-18 23:07:40', 6, ''),
(111, 2, '9.	Socialización con la Cámara Nacional de Acuacultura', 'En atención a la solicitud realizada por la Cámara Nacional de Acuacultura, la Subsecretaría de Calidad e Inocuidad (SCI) el 13 de abril de 2018, sostuvo reunión con los mismos, a fin de presentar Informe Técnico sobre la actualización de los temas pendientes respecto a mercados internacionales para el camarón ecuatoriano. \r\n\r\nCon fecha 13 de abril de 2018, la Subsecretaría de Acuacultura presentó un informe técnico a los representantes de la Cámara Nacional de Acuacultura acerca de los requisitos sanitarios de mercados internacionales para el camarón ecuatoriano: Australia, México, Brasil, Corea, entre otros.', 'MAP-Subsecretaría de Calidad e Inocuidad', '2018-04-17 06:08:00', 'Guayaquil', 0, NULL, '1524092915-Oficio No. CNA-PE-044-2018.jpg', '2018-04-18 23:08:35', '2018-04-18 23:08:35', 6, ''),
(112, 3, 'ASISTENCIA TÉCNICA ASOCIACIÓN ÑURUKTA', 'La Asociación ÑURUKTA perteneciente al cantón Cayambe, es una planta procesadora de cebolla, de la cual se realiza la transformación en cebolla en polvo y cebolla en pasta.\r\n\r\nDe esta asistencia se beneficia, 6 comunidades del sector y  más de 2000 personas que se dedican al cultivo de la cebolla.', 'Coordinación zonal 1', '2018-04-21 02:41:00', 'Cayambe', 50, 'Con la finalidad de dar el impulso necesario para la dinamización de la economía, se estan brindando asistencias técnicas a Asociaciones con visión de exportación.', '000Ninguno', '2018-04-24 19:41:11', '2018-04-24 19:41:11', 7, ''),
(113, 3, 'Mesa de Competividad de Orellana', 'El pasado miércoles 18 de abril de 2018 se  realizó las Mesas Competitivas de Napo, un espacio creado para analizar las problemáticas de los distintos sectores productivos (turismo, comercios, industrias, agroindustrias, transporte y logística) mediante la metodología de las Mesas Competitivas, se busca proponer soluciones generadas por los actores y articuladas con la academia e instituciones públicas.\r\n-Evento organizado por el MIPRO CZ2.\r\n-Asistentes: 100 personas\r\n-En representación del MIPRO asistió:  la Sra. Ministra y el Ing. Jorge Chávez  Subsecretario (e) de Agroindustrias y Acuacultura.\r\n-Se contó con la presencia del  Mgs. Edwin Vinueza Gobernador de la provincia de Orellana; Sr. Antonio Cabrera Vicealcalde de Orellana, Ing. Mónica  Enríquez delegada de la Prefectura, Sr. Tony Angulo en representación de los emprendedores: Ing. Germán Moreta delegado de el Alcalde del GADM de Sacha; Ing. Pedro González Presidente de la Cámara de Turismo de Orellana; Sr. Alex Noboa Presidente de la Asociación Hotelera de Orellana; Sr. Adalberto Chango representante de la Asociación de Comerciantes de la Prov. De Orellana; Sandra Tapuy Representante de la Asociación de Productores Quichuas; Pedro Ureña Representante de la Asociación de Palmicultores de la Amazonía Ecuatoriana; Sr. Nelson Chanaluiza Representante de la asociación de textileros de Orellana, entre otros.\r\n-En cada una de las mesas se trazó una hoja de ruta para coordinar con las instituciones públicas involucradas.\r\n-Se reconoció la gestión del Mipro como un ente que crea articulación entre instituciones públicas para atender requerimientos del sector productivo de la provincia.', 'Coordinación zonal 2', '2018-04-18 02:45:00', 'Francisco de Orellana-Coca', 100, NULL, '000Ninguno', '2018-04-24 19:45:07', '2018-04-24 19:45:07', 7, ''),
(114, 3, 'Feria Artesanal y de Emprendimiento Riobamba Abril 2018', 'El pasado viernes 20 y sábado 21 de abril de 2018 se realizó la \"Feria Artesanal y de Emprendimiento Riobamba Abril 2018\" en la ciudad de Riobamba provincia de Chimborazo.\r\n\r\n-Organizada por: el Ministerio de Industrias y Productivdad a travez de su Coordinación Zonal 3 y la Asociación Artesanal Mikiwan Rurashka Riobamba.\r\n-Participaron 75 expositores de los sectores agroindustrial, madera y muebles, artesanías, textil, calzado.\r\n-se presentaron a rededor de 6,000 visitantes.\r\n-Se contó con la presencia del Coordinador Zonal 3 del MIPRO.\r\n-Además participaron del evento  la Gobernadora de Chimborazo, el Superintendente Zonal del la Superintendencia de Poder de Mercado.', 'Coordinación zonal 3', '2018-04-21 02:48:00', 'Riobamba', 100, NULL, '000Ninguno', '2018-04-24 19:48:17', '2018-04-24 19:48:17', 7, ''),
(115, 1, 'El café de Galápagos tendrá su propio sello', 'Como resultado de la gestión interinstitucional dentro de la Mesa de Café Galápagos se suscribió un convenio entre el Ministerio de Agricultura y Ganadería, el Gobierno Parroquial de Bellavista y la Cooperativa de Producción Cafetalera de las Islas Galápagos (COPGALACAF), para la elaboración de logotipo y manual de uso de la denominación de origen Café de Galápagos.', 'http://www.agricultura.gob.ec/el-cafe-de-galapagos-tendra-su-propio-sello/', '2018-04-19 12:55:00', 'Nueva Loja - Sucumbíos', 100, 'El Ministerio de Agricultura y Ganadería, el Gobierno Parroquial de Bellavista y la Cooperativa de Producción Cafetalera de las Islas Galápagos (COPGALACAF) firmaron un convenio para la elaboración de logotipo y manual de uso de la denominación de origen Café de Galápagos. \r\n\r\nCon el sello se busca garantizar el adecuado uso del logotipo de la Denominación de Origen, para así mantener una correcta identidad visual, que proteja y promueva el sello, que estará presente en todos los productos caliﬁcados.\r\n\r\nEl convenio es resultado de “III Mesa de Café Galápagos”, que se efectúa con el objetivo de dar a conocer acciones encaminadas al fortalecimiento del sector caficultor en las Islas.', '000Ninguno', '2018-04-25 17:55:03', '2018-04-25 17:55:03', 7, ''),
(116, 1, 'Mesa técnica del arroz en Guayaquil', 'En la Gobernación del Guayas se efectuó la mesa técnica del arroz, donde participaron representantes de los productores, de los ministerios de Comercio Exterior, y de Agricultura y Ganadería, además de BanEcuador, Servicio Nacional de Aduanas, Unidad Nacional de Almacenamiento. Se trataron temas referentes a comercialización, créditos y precio.', 'Twitter', '2018-04-23 12:58:00', 'Guayaquil', 100, 'En la mesa técnica se recogen las diferentes propuestas que tienen los actores de la cadena productiva del arroz, en temas de comercialización, créditos y precio. \r\n\r\nLos actores también recibieron una explicación de la franja de precios, sistema propuesto para comercializar el arroz y que está en vigencia desde el pasado 11 de abril, mediante Acuerdo Ministerial 047.\r\n\r\nPara la saca de 200 libras de arroz en cáscara, con 20% de humedad y 5% de impurezas, la franja de precios establece un precio piso de 32,30 dólares y un precio techo de 35,50 dólares.', '000Ninguno', '2018-04-25 17:58:43', '2018-04-25 17:58:43', 7, ''),
(117, 1, 'Ministro Rubén Flores participa en la Cuarta Conferencia Mundial de Cacao', 'El ministro de Agricultura y Ganadería, Rubén Flores, participa en la Cuarta Conferencia Mundial del Cacao, que se efectúa en Berlín, Alemania, hasta este 25 de abril. Está a cargo de esta conferencia la Organización Internacional del Cacao (ICCO).\r\nFlores consideró que es necesaria la corresponsabilidad de todos los actores de la cadena productiva del cacao, por lo que sugirió trabajar en conjunto y sobre todo que los compradores se conciencien en el tema de precios pagados.', 'http://www.agricultura.gob.ec/en-cuarta-conferencia-mundial-del-cacao-en-berlin-ministro-flores-pide-revisar-margenes-de-rentabilidad/ y Twiter', '2018-04-23 01:03:00', 'Berlín', 100, 'La Cuarta Conferencia Mundial del Cacao se efectúa en Berlín, Alemania, hasta este 25 de abril. Está a cargo de esta conferencia la Organización Internacional del Cacao (ICCO).\r\nEl ministro de Agricultura y Ganadería, Rubén Flores, presentó las perspectivas de producción de cacao hasta 2021.\r\n\r\nPara que haya un desarrollo equitativo de los productores de cacao, es necesaria la corresponsabilidad de todos los actores de la cadena productiva del cacao. Se sugiere trabajar en conjunto y sobre todo que los compradores se conciencien en el tema de precios pagados. \r\n\r\nEl 72% del negocio del cacao se queda en los países consumidores, mientras que tan solo cerca del 6% es para los productores. Eso evidencia que algo funciona mal en la estructuración de los márgenes.\r\n\r\nEl precio del chocolate es 7,3 veces mayor que el precio del cacao al productor, brecha que se reflejó con mayor evidencia en  2017, cuando bajó el precio del cacao, pero el valor del chocolate se incrementó', '000Ninguno', '2018-04-25 18:03:35', '2018-04-25 18:03:35', 7, ''),
(118, 3, 'Feria de Alimentos y Bebidas 2018', 'Evento: Feria de Alimentos y Bebidas 2018\r\nFecha: 20 de abril 2018\r\nLugar: Plaza Japón de la Plataforma Financiera Gubernamental, Quito.\r\nParticipantes: 28 emprendedores: 17 mujeres, 2 EPS y 9 hombres.\r\nPorcentaje de avance: 100 % (Ejecutado)\r\n\r\nLa Feria organizada por el Ministerio de Industrias y Productividad (Mipro), a través de la Subsecretaría de Mipymes y Artesanías, tuvo como principal objetivo el fortalecer los nexos de comercialización y promover la sosteniblilidad y sustentabilidad de los emprendimientos.', 'Subsecretario de Mipymes y Artesanías, Roberto Estévez Echanique', '2018-04-25 01:31:00', 'Quito', 100, 'El pasado 20 de abril en los exteriores de la Plataforma Gubernamental Financiera, en Quito, se llevó a cabo la “Feria de Alimentos y Bebidas 2018” con la participación de 29 actores de la Economía Popular y Solidaria, artesanos y Mipymes de Pichincha, Cotopaxi y Tungurahua, quienes contaron con un espacio para exhibir sus productos de calidad.\r\nLa Feria organizada por el Ministerio de Industrias y Productividad (Mipro), a través de la Subsecretaría de Mipymes y Artesanías, tuvo como principal objetivo el fortalecer los nexos de comercialización y promover la sosteniblilidad y sustentabilidad de los emprendimientos.', '000Ninguno', '2018-04-25 18:31:30', '2018-04-25 18:32:27', 7, ''),
(119, 3, 'Registro de Producción Nacional para el cálculo del Valor Agregado Nacional. Intervención Emblemática Casa para Todos', 'Con fecha 21 de marzo de 2018 se dio a conocer el servicio RPN (acceso) a través de la página web del MIPRO. Con fecha 19 de abril se mantuvo una reunión con  el Consejero de Gobierno, Sr. Mario Burbano de Lara y con el Gerente EP Casa para Todos, a quienes se informó sobre el servicio, la metodología y los beneficios del mismo; adicional, se solicitó su socialización, tanto del servicio en el formulario automatizado y de los lineamientos respectivos emitidos por nuestra entidad.', 'Coordinación General de Servicios para la Producción, Dennis Zurita', '2018-03-21 01:44:00', 'A nivel nacional', 100, 'El Ministerio de Industrias y Productividad pone al servicio del sector industrial nacional, y la ciudadanía en general, el servicio de cálculo del valor agregado nacional de los bienes producidos en el país, herramienta de apoyo para el desarrollo productivo y encadenamiento para todos los proveedores nacionales de productos necesarios para las Intervenciones Emblemáticas, especialmente para el Programa Casa para Todos.', '000Ninguno', '2018-04-25 18:44:51', '2018-04-25 18:46:19', 7, ''),
(120, 2, '1.	Certificación profesional a los Pescadores Artesanales', 'En la segunda fase del proyecto, la semana del 18 al 24 de abril 2018 se han realizado evaluaciones teóricas y prácticas del proceso de Certificación Profesional en coordinación con el Instituto Tecnológico Superior Luis Arboleda Martínez y las organizaciones pesqueras de la caleta Los Arenales-Crucita del cantón Portoviejo y la caleta pesquera San Jacinto del Cantón Sucre, Provincia Manabí, se logró certificar las capacidades técnicas a un total de 33 Pescadores Artesanales.', 'N/A', '2018-04-24 02:25:00', 'MAP DIRECCION DE PESCA ARTESANAL', 33, NULL, '1524684607-infome_semanal_del_18_al_24_abril_2018_certificación_profesional.pdf', '2018-04-25 19:25:28', '2018-04-25 19:30:07', 7, ''),
(121, 2, '2.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimientos a 146 Pescadores Artesanales en la provincia de Manabí en las siguientes caletas pesqueras: \r\n\r\n•	La Cabuya FASE III: Fomento Productivo Del Sector Pesquero Artesanal, beneficiando a 26 pescadores artesanales.\r\n•	Cojimíes: Manejo de los Recursos Bioacuáticos y Regularización de la Actividad Pesquera Artesanal, beneficiando a 20 pescadores artesanales\r\n•	Coaque FASE I: Manejo de los Recursos Bioacuáticos y Regularización de la Actividad Pesquera Artesanal, beneficiando a 43 pescadores artesanales\r\n•	San Lorenzo de Manta FASE I: Manejo de los Recursos Bioacuáticos y Regularización de la Actividad Pesquera Artesanal, beneficiando a 57 pescadores artesanales', 'N/A', '2018-04-24 02:27:00', 'Provincias de Manabí', 22, NULL, '1524684461-infome_semanal_del_18_al_24_abril_2018_capacitación_integral.pdf', '2018-04-25 19:27:41', '2018-04-25 19:27:41', 7, ''),
(122, 2, '3.	Permisos emitidos a nivel nacional de Pescadores Artesanales y de embarcaciones Artesanales', 'Se emitieron los siguientes permisos a nivel Nacional: \r\n\r\n•	137 permisos de Pescadores Artesanales\r\n•	3 permisos de Comerciante Minorista\r\n•	1 permisos de Comerciante Mayorista\r\n•	47 permisos de Embarcaciones Artesanales', 'N/A', '2018-04-24 02:33:00', 'A nivel Nacional', 0, NULL, '1524684826-Permisos de Pescadores _ Comerciantes 18 AL 24.xlsx', '2018-04-25 19:33:46', '2018-04-25 19:33:46', 7, ''),
(123, 2, '4.	Primer Encuentro de Organizaciones Pesqueras y Escuela de Formación de Líderes', 'Con el objetivo de difundir y promover las experiencias exitosas en temas de asociatividad y producción de las organizaciones pesqueras artesanales del país, el Ministerio de Acuacultura y Pesca, organizó el \"Primer Encuentro de Organizaciones Pesqueras y Escuela de Formación de Líderes\", desarrollado el viernes 20 de abril de 2018 en el auditorio de Autoridad Portuaria de Manta.\r\n\r\nLa ministra de Acuacultura y Pesca, Katuska Drouet, subrayó la necesidad de consolidar el liderazgo de las organizaciones pesqueras artesanales para que el sector pueda enfrentar los desafíos que entraña la instrumentación de proyectos que añadan valor a sus productos, mejoren la condición de vida de los pescadores y disminuyan su vulnerabilidad ante la sobreexplotación de especies o el cambio climático. El pronunciamiento se dio en el marco de la inauguración del ‘Primer Encuentro de Organizaciones Pesqueras y Escuela de Formación de Líderes’ que contó con la participación de 130 dirigentes de todo el país.\r\n\r\nAl encuentro acudieron representantes del sector, quienes, además de compartir experiencias exitosas de asociatividad y emprendimientos productivos, participaron en un ciclo de conferencias en el que se abordaron temáticas como el mejoramiento de las cadenas productivas, la importancia de los recursos pesqueros para la economía y la sociedad ecuatoriana, así como la necesidad de promover el manejo de las pesquerías y la competitividad del sector pesquero.', 'Boletín http://www.acuaculturaypesca.gob.ec/subpesca4670-actuamos-con-vision-y-responsabilidad-para-preservar-y-potenciar-la-pesca-artesanal-sostenible-ministra-de-acuacultura-y-pesca.html#)', '2018-04-24 02:38:00', 'Manta Autoridad Portuaria', 0, '“ACTUAMOS CON VISIÓN Y RESPONSABILIDAD PARA PRESERVAR Y POTENCIAR LA PESCA ARTESANAL SOSTENIBLE”: MINISTRA DE ACUACULTURA Y PESCA\r\n\r\n\r\nLA MINISTRA DE ACUACULTURA Y PESCA, KATUSKA DROUET, SUBRAYÓ LA NECESIDAD DE CONSOLIDAR EL LIDERAZGO DE LAS ORGANIZACIONES PESQUERAS ARTESANALES PARA QUE EL SECTOR PUEDA ENFRENTAR LOS DESAFÍOS QUE ENTRAÑA LA INSTRUMENTACIÓN DE PROYECTOS QUE AÑADAN VALOR A SUS PRODUCTOS, MEJOREN LA CONDICIÓN DE VIDA DE LOS PESCADORES Y DISMINUYAN SU VULNERABILIDAD ANTE LA SOBREEXPLOTACIÓN DE ESPECIES O EL CAMBIO CLIMÁTICO. EL PRONUNCIAMIENTO SE DIO EN EL MARCO DE LA INAUGURACIÓN DEL ‘PRIMER ENCUENTRO DE ORGANIZACIONES PESQUERAS Y ESCUELA DE FORMACIÓN DE LÍDERES’ QUE CONTÓ CON LA PARTICIPACIÓN DE 130 DIRIGENTES DE TODO EL PAÍS.\r\n\r\nAL ENCUENTRO ACUDIERON REPRESENTANTES DEL SECTOR, QUIENES, ADEMÁS DE COMPARTIR EXPERIENCIAS EXITOSAS DE ASOCIATIVIDAD Y EMPRENDIMIENTOS PRODUCTIVOS, PARTICIPARON EN UN CICLO DE CONFERENCIAS EN EL QUE SE ABORDARON TEMÁTICAS COMO EL MEJORAMIENTO DE LAS CADENAS PRODUCTIVAS, LA IMPORTANCIA DE LOS RECURSOS PESQUEROS PARA LA ECONOMÍA Y LA SOCIEDAD ECUATORIANA, ASÍ COMO LA NECESIDAD DE PROMOVER EL MANEJO DE LAS PESQUERÍAS Y LA COMPETITIVIDAD DEL SECTOR PESQUERO.', '1524685092-Boletin Primer Encuentro de Organizaciones Pesqueras y Escuela de Formación de Líderes.pdf', '2018-04-25 19:38:12', '2018-04-25 19:38:12', 7, ''),
(124, 2, '5.	Plan de Electrificación para el Sector Camaronero', 'Se convocó a mesa de trabajo con los directivos de la Corporación LANEC, quienes expresaron su firme interés en automatizar sus fincas camaroneras de aproximadamente 3000 hectáreas con sistemas de bombeo, alimentadores automáticos y equipos de aeración mediante el Proyecto del Plan de Electrificación para el Sector Camaronero. En dicha reunión se contó con la participación de funcionarios de CNEL EP quienes son los encargados dar la viabilidad factibilidad técnica.', 'N/A', '2018-04-24 02:43:00', 'Provincia del Guayas', 43, NULL, '1524685437-Respuesta a mesa de trabajo Corporación Lanec.PNG', '2018-04-25 19:43:57', '2018-04-25 19:43:57', 7, ''),
(125, 2, '6.	Diálogo con gremios camaroneros de la provincia de El Oro', 'La ministra Drouet dialogó en Machala con gremios de productores de camarón de la provincia de El Oro para revisar temas como seguridad, logística, normativa ambiental y mercados. Posteriormente, visitó la Isla Las Casitas, para analizar con sus dirigentes un proyecto para la operación de una camaronera comunitaria de 16 hectáreas.', 'https://twitter.com/MinAcuaPescaEc/status/987716786740187141', '2018-04-24 02:45:00', 'Machala', 0, NULL, '000Ninguno', '2018-04-25 19:45:41', '2018-04-25 19:45:41', 7, ''),
(126, 2, '7.	Capacitación sobre cultivo y Manejo de Cachama', 'Se realizó la capacitación sobre Cultivo y Manejo de Cachama a la Asociación Riveras del Bobonaza, el día 19 de abril de 2018, en el salón comunitario en el cantón y provincia de Pastaza. A la cita acudieron 23 miembros de la asociación con quienes se discutió la importancia de la piscicultura en la Amazonía, tanto a nivel ecológico, cultural, tecnológico y económico. En dicha capacitación se expusieron los pasos para tener un cultivo exitoso de Cachamas, como es la selección correcta del sitio donde debe ser construida la piscina, preparación previa a la siembra de alevines, alimentación y algunas técnicas de manejo para evitar enfermedades en los peces y pérdida del cultivo.', 'N/A', '2018-04-24 02:46:00', 'Provinci de Pastaza', 0, NULL, '1524685603-Informe de capacitación sobre cultivo y manejo de cachama.pdf', '2018-04-25 19:46:43', '2018-04-25 19:46:43', 7, ''),
(127, 2, '8.	Venta de alevines', 'En la estación piscícola CACHARI ubicada en el cantón Babahoyo provincia de Los Ríos una vez consolidada el listado de solicitudes de piscicultores, para la compra de 3.000 alevines de tilapia que se producen en la Estación Piscícola Cacharí, se procedió a la venta de los alevines que fueron previamente autorizados por el Subsecretario de Acuacultura para ser entregados el 18 de abril 2018 beneficiando a 12 piscicultores en territorio.', 'N/A', '2018-04-24 02:47:00', 'Provincia de Los Ríos', 0, NULL, '1524685674-MAP-SUBACUA-2018-4441-M.pdf', '2018-04-25 19:47:54', '2018-04-25 19:47:54', 7, ''),
(128, 2, '9.	Socialización con las empresas exportadoras de productos pesqueros y acuícolas sobre las consideraciones sanitarias y la coordinación logística de la visita de inspección del Servicio Nacional de Sanidad y Calidad Agroalimentaria de Argentina (SENASA).', 'Se realizó la socialización sobre la auditoría de inclusión y renovación de autorización que tendrán las empresas exportadoras de productos pesqueros y acuícolas, por parte del Servicio Nacional de Sanidad y Calidad Agroalimentaria de Argentina (SENASA), con el objetivo de incluir a nuevos establecimientos y renovar la autorización de exportación al mercado argentino. La agenda de inspección se desarrollará del 16 al 30 de julio de 2018 a 15 empresas de la ciudad de Guayaquil.', 'N/A', '2018-04-24 02:49:00', 'Guayaquil', 0, NULL, '1524685753-registro_de_asistencia_24-04-18.pdf', '2018-04-25 19:49:13', '2018-04-25 19:49:13', 7, ''),
(129, 3, 'Taller de socialización del anteproyecto de la norma Codex para niveles máximos de cadmio en chocolates y productos derivados del cacao.', 'Con fecha 24 de abril de 2018 se realiza socialización del anteproyecto de norma Codex para niveles máximos de Cadmio en chocolates y productos derivados del cacao, que tuvo como finalidad el involucramiento de la industria para el levantamiento de datos científicos de concentraciones de cadmio en chocolates de producción nacional que servirán como insumo para el desarrollo de la norma Codex.', 'Subsecretaría de Agroindustria y Procesamiento Acuícola, Jorge Chávez', '2018-04-25 03:58:00', 'MIPRO', 100, 'La Comisión Europea, mediante Reglamento 488/2014, del 12 de mayo de 2014, estableció niveles máximos para el Cadmio en algunos productos alimenticios (entre ellos el chocolate y productos derivados del cacao); mismos que entrarán en vigencia a partir del 01 de enero de 2019, en este contexto el CODEX hace la propuesta de trabajar en un anteproyecto de norma para fijar niveles máximos para cadmio en chocolate y derivados, es así que desde el año 2014 el Ecuador tomó la presidencia del Grupo de Trabajo Electrónico-GTE sobre “Niveles Máximos para el cadmio en el chocolate y productos derivados del cacao”.', '000Ninguno', '2018-04-25 20:58:46', '2018-04-25 20:58:46', 7, ''),
(130, 1, 'Participación en Cumbre Mundial Hambre Cero', 'El MAG participó en la III Cumbre Mundial Hambre Cero. La Viceministra Mariuxi Gómez expuso sobre “Seguridad con Soberanía Alimentaria: Política Pública Agropecuaria para el Fomento de Sistemas Productivos Sostenibles”.\r\n\r\nEn su exposición Gómez indicó que el MAG ejecuta el Programa Intersectorial de Alimentación y Nutrición del Ecuador, que articula acciones públicas, privadas y con cooperación internacional para promocionar una alimentación saludable, mejorar la nutrición, acceso a alimentos seguros, entre otros”\r\n\r\nEn el último día de la III Cumbre Mundial Hambre Cero, la Viceministra  moderó la Mesa Institucional en la que representantes de universidades sudamericanas, instituciones públicas y privadas compartieron y expusieron sus conocimientos con miras a erradicar el hambre.', 'Twitter', '2018-04-27 04:50:00', 'Cuenca-Azuay', 100, 'El Ministerio de Agricultura y Ganadería reconoce al ser humano como el eje de la política pública agropecuaria y de la política pública integral. De esta manera se busca una agricultura económicamente rentable, ambientalmente amigable y socialmente sostenible con un único objetivo: erradicar el hambre \r\n\r\nEl MAG ejecuta el Programa Intersectorial de Alimentación y Nutrición del Ecuador, que articula acciones públicas, privadas y con cooperación internacional para promocionar una alimentación saludable, mejorar la nutrición, acceso a alimentos seguros, entre otros.\r\n\r\nCon la Gran Minga Agropecuaria, el MAG trabaja  en plataformas territoriales que permiten llegar a las diferentes zonas rurales y personificarlas con los agricultores.  \r\n\r\nPara que la agricultura funcione, se debe pensar en componentes que trabajen de manera concatenada; no solo pensar en el clima, sino también en la parte económica, ambiental y la parte humana.\r\n\r\nEn el mundo se producen alimentos más que suficientes para todos, sin embargo existen 815 millones de personas que padecen hambre. Es importante que, como país se reconozca la magnitud de los riesgos y desafíos a nivel del planeta.', '000Ninguno', '2018-05-02 21:50:24', '2018-05-02 21:50:24', 8, ''),
(131, 2, '1.	Certificación profesional a los Pescadores Artesanales', 'Durante la semana del 25 de abril al 02 de mayo del año en curso, se han realizado evaluaciones teóricas y prácticas del proceso de certificación profesional en coordinación con el Instituto Tecnológico Superior Luis Arboleda Martínez y las organizaciones pesqueras de la caleta Los Arenales-Crucita del cantón Portoviejo, Provincia Manabí, Certificando las capacidades de 30 Pescadores Artesanales.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-05-01 07:23:00', 'Manabí', 34, NULL, '000Ninguno', '2018-05-03 00:23:38', '2018-05-03 00:23:38', 8, ''),
(132, 2, '2.	Comercialización de productos pesqueros con agregación de valor', 'En las instalaciones del Puerto Pesquero Artesanal de San Mateo donde se encuentra ubicado el Ministerio de Acuacultura y Pesca, a través de la Dirección de Pesca Artesanal se realizó la comercialización de manera directa de productos con agregación de valor de organizaciones pesqueras artesanales; donde se beneficiaron a 7 organizaciones distribuidas en el perfil costero de la provincia Manabí.', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-05-01 07:26:00', 'Provincia de Manabí', 0, NULL, '000Ninguno', '2018-05-03 00:26:23', '2018-05-03 00:26:23', 8, ''),
(133, 2, '3.	Socialización del Sistema Nacional de Sanidad, Calidad e Inocuidad Acuícola y Pesquera', 'El Ministerio de Acuacultura y Pesca, a través de la Subsecretaría de Calidad e Inocuidad, socializó con la Agencia Nacional de Regulación, Control y Vigilancia Sanitaria (ARCSA) la propuesta del “Sistema Nacional de Sanidad, Calidad e Inocuidad Acuícola y Pesquera, el cual consta en el borrador de la nueva Ley de Pesca y Acuacultura, misma que reemplazará a la actual, que data de 1974. Entre los temas expuestos estuvieron: Autoridad Sanitaria, Proyecto Ley de Pesca y Acuacultura, y competencias institucionales', 'Subsecretaría de Calidad e Inocuidad (SCI)', '2018-05-01 07:27:00', 'Guayaquil', 0, NULL, '000Ninguno', '2018-05-03 00:27:08', '2018-05-03 00:27:08', 8, ''),
(134, 2, '4.	Simposio Nicovita 2018', 'La ministra de Acuacultura y Pesca, Katuska Drouet, aseveró el miércoles en la Ciudad de Panamá que la aspiración gubernamental se enfoca en que el desarrollo del sector camaronero responda a un equilibrio saludable entre su crecimiento económico, equidad social y sustentabilidad ambiental, por lo que se trabaja con el sector privado en diferentes frentes para potenciar la cadena de valor de esta actividad, que representó ingresos de divisas para el país en el año 2017.\r\n\r\nEl pronunciamiento se dio en el marco de la inauguración de la IX Simposio Nicovita 2018, donde se destacó el esfuerzo de los empresarios del sector en temas como asegurar la calidad de post larvas en los laboratorios, el tratamiento de suelos y calidad de agua en las piscinas de cría, el uso de productos biológicos, el empleo de sistemas de recirculación controlada para evitar patógenos y la dotación de dietas alimenticias de calidad, en el marco del reforzamiento de la competitividad de las empresas camaroneras con vínculos con los mercados internacionales.', 'http://www.acuaculturaypesca.gob.ec/subpesca4684-buscamos-el-desarrollo-integral-del-sector-acuicola-del-ecuador-ministra-drouet.html', '2018-05-01 07:27:00', 'Panamá', 0, NULL, '000Ninguno', '2018-05-03 00:27:43', '2018-05-03 00:27:43', 8, ''),
(135, 2, '5.	Ecuador aplica una gestión sostenible en la industria atunera', 'El viceministro de Acuacultura y Pesca, Jorge Costain, se reunió el miércoles en Manta con el coordinador del programa Coastal Fisheries Initiative (CFI), Mariano Valverde, que se instrumenta en Ecuador y Perú con el apoyo del Programa de Naciones Unidas para el Desarrollo (PNUD). La iniciativa busca garantizar la sostenibilidad del sector pesquero, creando espacios de diálogo nacional para mejorar determinadas las prácticas de determinadas pesquerías en los campos económico, ambiental y social.', 'https://twitter.com/jorgemcostain/status/991732110821134336', '2018-05-01 07:28:00', 'Manta', 0, NULL, '000Ninguno', '2018-05-03 00:28:14', '2018-05-03 00:28:14', 8, ''),
(136, 3, 'Primer Foro PRO InnoVa', 'Promoción de la Nueva Economía, la Investigación el desarrollo y la innovación productiva I+D+i.', 'Coordinación General de Direccionamiento Empresarial', '2018-05-02 04:54:00', 'Quito', 100, 'El Foro PRO InnoVa, desarrollado por el Ministerio de Industrias y Productividad, incluyó aspectos relacionados a la promoción de la Nueva Economía, la Investigación, el desarrollo y la innovación productiva I+D+i, con nueve expositores de temas de innovación, desde políticas públicas hasta estrategias de mercadeo.', '000Ninguno', '2018-05-03 00:27:08', '2018-05-03 21:54:25', 8, ''),
(137, 3, 'Ruta del Cacao', 'Se visitó en territorio a las principales comunidades productoras de cacao.', 'Coordinación zonal 2', '2018-05-03 03:16:00', 'Tena', 100, 'El pasado 03 y 04  de mayo de 2018 se realizó la \"Ruta del Cacao\"  en la ciudad de Tena  provincia de Napo donde se visitó a las principales comunidades productoras de cacao. \r\n\r\n-El evento se organizo en coordinación con: MIPRO, Ecuador Estratégico, MAG, MINTUR, Cancillería, Subsecretaría de Cultura y Patrimonio.\r\n-Asistentes: 2 comunidades, 40 participantes.\r\n-Se reconoció la gestión del MIPRO como un ente que fortalce  la productividad y competitividad en la provincia. \"', '000Ninguno', '2018-05-09 20:16:54', '2018-05-09 20:16:54', 9, ''),
(138, 3, 'Primera Asamblea Productiva GADMA 2018', 'Se expuso magistralmente los temas: Registro Único de MIPYMES (RUA), Registro Único de MIPYMES (RUM) y Exporta fácil a 200 personas.', 'Coordinación zonal 3', '2018-05-03 03:24:00', 'Ambato', 100, 'El pasado jueves 03 de mayo de 2018 se realizó la Primera Asamblea Productiva GADMA 2018  en la ciudad de Ambato provincia de Tungurahua, entre los temas expuestos están:\r\n\r\nRegistro Único de MIPYMES (RUA)\r\n Registro Único de MIPYMES (RUM) \r\nExporta fácil.\r\n\r\n-Evento organizado por: GAD Ambato\r\n-Asistentes: 200 personas\r\n-Se reconoció la gestión del Mipro como un ente que capacita a la ciudadanía en temas relacionados a la productividad y competitividad en la provincia.', '000Ninguno', '2018-05-09 20:24:57', '2018-05-09 20:24:57', 9, ''),
(139, 3, 'Capacitaciones en: Motivación a Emprender y Propuesta de Valor', 'Capacitaciones en Motivación a Emprender y Propuesta de Valor, en el auditorio del GAD de Pujilí.\r\n\r\n-Evento organizado por: GAD de Pujilí y MIPRO.\r\n-Asistentes: 110 personas\r\n-Se reconoció la gestión del Mipro como un ente que capacita a la ciudadanía en temas relacionados a la productividad y competitividad en la provincia.', 'Coordinación zonal 3', '2018-05-03 03:28:00', 'Pujilí', 100, 'El pasado jueves 03 de mayo de 2018 se realizó la capacitación sobre: Motivación a Emprender y Propuesta de Valor, en el auditorio del GAD de Pujilí en la ciudad de Pujilí provincia de Cotopaxi.', '000Ninguno', '2018-05-09 20:28:47', '2018-05-09 20:28:47', 9, '');
INSERT INTO `csp_reportes_hechos` (`id`, `institucion_id`, `tema`, `descripcion`, `fuente`, `fecha_reporte`, `lugar`, `porcentaje_avance`, `lineas_discursivas`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`) VALUES
(140, 2, '1.	Programa Piloto de Formación y Capacitación “Mujeres del Mar de Ecuador”', 'El Ministerio de Acuacultura y Pesca, con el fin de mejorar las condiciones de vida de las familias de pescadores artesanales privados de libertad, desarrolló en Jaramijó el Programa Piloto de Formación y Capacitación “Mujeres del Mar de Ecuador”. La iniciativa proveerá conocimientos y habilidades a las integrantes de núcleos familiares afectados por el narcotráfico para identificar emprendimientos que generen mayores posibilidades de inserción laboral.\r\n\r\n“Mujeres del Mar de Ecuador” se compone de un ciclo de enseñanzas dirigidos a promover el autoempleo y la formación en emprendimientos. La oferta formativa está compuesta de cursos de contabilidad básica, marketing y comercialización, mercadeo digital, buenas prácticas de higiene y manufactura, conservación de la pesca, valor agregado y talleres teórico – prácticos en belleza, bisutería, corte y confección.', 'Boletín http://www.acuaculturaypesca.gob.ec/subpesca4710-somos-solidarios-con-la-problematica-de-las-companeras-madres-hijas-y-hermanas-de-los-pescadores-artesanales-drouet.html', '2018-05-08 04:05:00', 'Jaramijó, Provincia Manabí', 100, 'LANZAMIENTO DEL PROGRAMA PILOTO DE FORMACIÓN Y CAPACITACIÓN “MUJERES DEL MAR DE ECUADOR”\r\nEl Ministerio de Acuacultura y Pesca, con el propósito de mejorar las condiciones de vida de las familias de pescadores artesanales privados de libertad, lanzó el Programa Piloto de Formación y Capacitación “Mujeres del Mar de Ecuador”. La iniciativa proveerá conocimientos y habilidades a las integrantes de núcleos familiares afectados por el narcotráfico para identificar emprendimientos que generen mayores posibilidades de inserción laboral. \r\n\r\n“Mujeres del Mar de Ecuador” se compone de un ciclo de enseñanzas dirigidos a promover el autoempleo y la formación en emprendimientos.  La oferta formativa está compuesta de cursos de contabilidad básica, marketing y comercialización, mercadeo digital, buenas prácticas de higiene y manufactura, conservación de la pesca, valor agregado y talleres teórico - prácticos en belleza, bisutería, corte y confección. El programa en su primera fase capacitará a 70 mujeres de Manabí y prevé implementarse progresivamente en todo el país para beneficiar a más de 600 mujeres ligadas al sector pesquero artesanal.\r\n\r\nBeneficiarios:\r\nFase piloto: 70 mujeres en Manabí\r\nTotal: 600 mujeres en todo el país', '000Ninguno', '2018-05-09 21:05:36', '2018-05-09 22:34:34', 9, ''),
(141, 2, '2.	En Manta emprendedores del Sector Pesquero Artesanal promocionaron sus productos en la Feria Productiva, Gastronómica Artesanal de Productos del Mar y Aguas Interiores', 'El Ministerio de Acuacultura reunió el sábado 05 de mayo de 2018, en Manta a más de 70 productores del sector pesquero artesanal, quienes expusieron la diversidad de gastronomía típica de las provincias costeras en la “Feria Productiva, Gastronómica Artesanal de Productos del Mar y Aguas Interiores – Manta 2018”. La iniciativa, que contó con el apoyo del Gobierno Provincial de Manabí, refuerza las capacidades de las organizaciones y asociaciones pesqueras en lo referente a la agregación de valor a los recursos marinos y mejorar las condiciones de vida de sus integrantes.\r\n\r\nEn la feria participaron 15 organizaciones y asociaciones pesqueras de Manabí, Esmeraldas, El Oro, Guayas y Santa Elena. En esta ocasión el encocado de cangrejo, que prepararon los miembros de la Asociación de Producción Pesquera Bunche, Esmeraldas, fue elegido como el mejor plato típico.', 'http://www.acuaculturaypesca.gob.ec/subpesca4753-en-manta-emprendedores-del-sector-pesquero-artesanal-promocionaron-sus-productos-en-la-feria-productiva-gastronomica-artesanal-de-productos-del-mar-y-aguas-interiores.html', '2018-05-08 04:11:00', 'Manta – Playa el Murciélago', 100, 'APOYO AL SECTOR PESQUERO ARTESANAL\r\nEL MAP CONVOCÓ A 70 EMPRENDEDORES ARTESANALES DE LAS PROVINCIAS DE MANABÍ, EL ORO, ESMERALDAS, GUAYAS Y SANTA ELENA PARA PARTICIPAR EN LA PRIMERA FERIA PRODUCTIVA, GASTRONÓMICA DEL PRODUCTOS DEL MAR Y AGUAS INTERIORES, EN LA PLAYA EL MURCIÉLAGO, DE LA PROVINCIA DE MANABÍ, DONDE SE CONTÓ CON UNA GRAN AFLUENCIA DE CIUDADANOS QUE DEGUSTARON DE LA DIVERSIDAD GASTRONOMICA TÍPICA DE LAS PROVINCIAS.\r\nLA FERIA, QUE RECONOCE LA CULTURA GASTRONÓMICA MILENARIA Y LAS RIQUEZAS NATURALES DEL MAR Y LAS AGUAS INTERIORES DEL PAÍS, ES UNA INICIATIVA DEL MINISTERIO DE ACUACULTURA Y PESCA CON EL APOYO DEL GOBIERNO PROVINCIAL DE MANABÍ PARA APUNTALAR Y ACOMPAÑAR LAS INICIATIVAS DE LAS ORGANIZACIONES Y ASOCIACIONES PESQUERAS EN LO REFERENTE A LA AGREGACIÓN DE VALOR A LOS RECURSOS MARINOS Y MEJORAR LAS CONDICIONES DE VIDA DE SUS INTEGRANTES.', '000Ninguno', '2018-05-09 21:11:51', '2018-05-09 22:35:00', 9, ''),
(142, 1, 'Reunión de ministros de Agricultura de Colombia, Ecuador y Perú', 'Los ministros de Agricultura y Desarrollo Rural de Colombia, Juan Guillermo Zuluaga; de Agricultura y Ganadería de Ecuador, Rubén Flores; y, de Agricultura y Riego de Perú, Gustavo Mostajo se comprometieron a reactivar el trabajo emprendido en la IV Reunión del Consejo Andino de Ministros de la Región Andina, efectuada en junio de 2013.\r\n\r\nLos ministros acordaron una agenda con siete puntos, entre los que se destacan el reconocimiento de los desafíos y las oportunidades que representa la demanda creciente de alimentos a escala mundial y la necesidad de fomentar sistemas alimentarios sostenibles e inclusivos; dar una alta prioridad a la Agricultura Familiar; reactivar el mecanismo de reuniones del Consejo Andino de Ministros de Agricultura y fortalecer el Comité Andino Agropecuario; dar seguimiento al comercio subregional para prevenir prácticas distorsivas y donde se evalúen las sensibilidades propias, así como invitar al Ministerio de Desarrollo Rural y Tierras de Bolivia a sumarse a esta iniciativa.', 'https://www.agricultura.gob.ec/ministros-de-agricultura-de-colombia-peru-y-ecuador-deciden-reactivar-consejo-andino-e-impulsar-agricultura-familiar/)', '2018-05-03 04:15:00', 'Hotel Sheraton, ciudad de Quito', 100, 'Los ministros de Ecuador, Colombia y Perú se comprometieron a reactivar el trabajo emprendido en la IV Reunión del Consejo Andino de Ministros de la Región Andina, efectuada en junio de 2013.\r\n\r\nLos países andinos reconocieron  los desafíos y oportunidades que representa la demanda creciente de alimentos a escala mundial y la necesidad de fomentar sistemas alimentarios sostenibles e inclusivos.\r\n\r\nDar alta prioridad a la Agricultura Familiar, dentro de las políticas públicas del sector agrícola y para el desarrollo rural, además de reactivar el mecanismo de reuniones del Consejo Andino de Ministros de Agricultura y fortalecer el Comité Andino Agropecuario.\r\n\r\nInvitar al Ministerio de Desarrollo Rural y Tierras de Bolivia a sumarse a esta iniciativa.\r\n\r\nMantener estos espacios de diálogo para capturar la oportunidad que tiene América Latina, en el contexto mundial, como potencial abastecedora de alimentos para alrededor de 2.300 millones de personas adicionales que habitarán el planeta en los próximos 30 años.', '000Ninguno', '2018-05-09 21:15:15', '2018-05-09 21:15:15', 9, ''),
(143, 2, '3.	Suscripción de Convenio para la sostenibilidad de la industria atunera', 'El pasado 4 de mayo, el Subsecretario de Recursos Pesqueros, suscribió un Memorándum de Entendimiento con el coordinador del Grupo de Conservación del Atún, (TUNACONS), para sumar esfuerzos en la implementación del Plan de Acción del FIP, para la flota pesquera industrial atunera de las empresas Nirsa, Eurofish, Grupo Jadran, Servigrup Ec y Trimarine.', 'Twitter https://twitter.com/jorgemcostain/status/992451738702630918', '2018-05-08 04:16:00', 'Manta', 0, NULL, '1525900614-Anexo Suscripción de Convenio para la sostenibilidad de la industria atunera.docx', '2018-05-09 21:16:54', '2018-05-09 21:16:54', 9, ''),
(144, 1, 'Productores de El Oro se reunieron con el ministro Rubén Flores', 'Representantes de las asociaciones de bananeros, cacaoteros, cafetaleros, arroceros y avícolas de la provincia de El Oro se reunieron con el Ministro de Agricultura y Ganadería, Rubén Flores, en Machala.\r\n\r\nReferente al cultivo de banano, Rubén Flores dijo que se cuenta con instrumentos, tales como mesas técnicas y consejos consultivos de banano con una hoja de ruta sobre la sustentabilidad del cultivo en mediano y largo plazo.\r\n\r\nMedardo Fernández, presidente de la Red de Integración Banano para la Vida (Banavid), entregó peticiones al funcionario, entre las cuales solicitó la permanencia y el fortalecimiento de la Estrategia de Banano, con técnicos, vehículos y asistencias técnicas, lo cual fue atendido por el principal de esta Cartera de Estado.\r\n\r\nEntre los acuerdos a los que llegaron fue realizar una mesa técnica, el lunes 7 de mayo, en Guayaquil a la que deberán asistir los representantes de las asociaciones bananeras.', 'https://www.agricultura.gob.ec/productores-de-el-oro-se-reunieron-con-el-ministro-ruben-flores/', '2018-05-07 04:17:00', 'Edificio ex Predesur en Machala', 100, 'El MAG cuenta con instrumentos, tales como mesas técnicas y consejos consultivos de banano, en las que se establecieron hojas de ruta para darle  sustentabilidad al cultivo en el mediano y largo plazo.\r\n\r\nPara frenar el contrabando, el MAG articula acciones con 20 instituciones del Estado para combatir ese problema.\r\n\r\nEn Ecuador existen 1.800 organizaciones, de las cuales el Ministro Flores se ha reunido con 500. Continuará reuniéndose con los  diferentes dirigentes.\r\n\r\nEn cuatro meses de gestión en el MAG, la entidad canceló deudas y logró convenios con la Empresa Pública Unidad Nacional de Almacenamiento (UNA EP). Ahora la empresa cuenta con recursos suficientes para adquirir el arroz de la cosecha de invierno.', '000Ninguno', '2018-05-09 21:17:15', '2018-05-09 21:17:15', 9, ''),
(145, 1, 'Ministro Rubén Flores indica que decreto regulará precios de los insumos agrícolas', 'El Ministro de Agricultura y Ganadería, Rubén Flores, prepara un decreto para regular los precios de los insumos agropecuarios, como urea, glifosato, entre otros. Este fue uno de los anuncios que hizo en la Mesa Técnica del Arroz que se realizó el 7 de mayo con los productores en el Gobierno Zonal de Guayaquil. El decreto se consolidará en 15 días tras diálogos con los sectores. \r\n\r\nConforme se acordó en las diferentes espacios de dialogos, mesas técnicas y consejos consultivos, el MAG trabaja en la reducción de costos de producción, con el fin de generar mayor competitividad e ingresos a los agricultores. La regulación y control de los precios en el mercado de los agroquímicos resulta fundamental ya que es de los componentes más altos en la estructura de costos.', 'https://www.eltelegrafo.com.ec/noticias/economia/4/decreto-regulara-precios-insumos-agricolas', '2018-05-07 04:19:00', 'Zonal de Guayaquil', 100, 'Mediante un decreto se regulará los precios de los insumos agropecuarios. El documento estará listo en 15 días.\r\n\r\nEl MAG ayuda a los agricultores con kits agrícolas de maíz duro, arroz, arroz para semilleristas, algodón, papa, maíz duro para ensillaje, maíz suave y fréjol.\r\n\r\nCada kit está conformado por semillas de alta calidad (certificadas), abonos edáficos y agroinsumos adecuados que elevarán la producción.', '000Ninguno', '2018-05-09 21:19:18', '2018-05-10 00:06:35', 9, ''),
(146, 2, '4.	Nuevos Modelos de Gestión en los Puertos Pesqueros Artesanales del País', 'Con el fin de mejorar los modelos de gestión de los puertos pesqueros del país, en Manta el Subsecretario de Recursos Pesqueros, mantuvo una reunión de trabajo con los representantes de la Secretaría Nacional de Planificación y Desarrollo (SENPLADES) para conocer y plantear la colaboración del Ministerio de Acuacultura y Pesca en un proyecto de cooperación de la Unión Europea. \r\n\r\nFinalmente, se logró confirmar la participación de los técnicos del Ministerio de Acuacultura en los estudios que permitirán brindar facilidades y excelentes servicios para el sector de pesca artesanal.', 'Twitter  https://twitter.com/jorgemcostain/status/992132179789533184', '2018-05-08 04:23:00', 'Manta', 0, NULL, '1525901011-Anexo Nuevos Modelos de Gestión en los Puertos Pesqueros Artesanales del País.docx', '2018-05-09 21:23:31', '2018-05-09 21:23:31', 9, ''),
(147, 2, '5.	Ecuador y Perú, por un mismo Objetivo de Sostenibilidad', 'El Viceministro de Acuacultura y Pesca, se reunió el miércoles 2 de mayo, en Manta, provincia de Manabí con el Coordinador del Programa Coastal Fisheries Initiative (CFI), Mariano Valverde, que se instrumenta en Ecuador y Perú con el apoyo del Programa de Naciones Unidas para el Desarrollo (PNUD). La iniciativa busca garantizar la sostenibilidad del sector pesquero, creando espacios de diálogo nacional para mejorar determinadas las prácticas de determinadas pesquerías en los campos económico, ambiental y social.', 'Boletín http://www.acuaculturaypesca.gob.ec/subpesca4704-ecuador-aplica-una-gestion-sostenible-en-la-industria-atunera-drouet-2.html', '2018-05-08 04:26:00', 'Ministerio de Acuacultura y Pesca-Manta', 100, NULL, '1525901173-Ecuador y Peru por un mismo Objetivo de Sostenibilidad.pdf', '2018-05-09 21:26:13', '2018-05-09 21:26:13', 9, ''),
(148, 2, '6.	Renovaciones y nueva habilitación de establecimientos ecuatorianos para exportar productos al mercado de Panamá.', 'Del 2 al 4 de mayo de 2018, funcionarios de la Autoridad Panameña de Seguridad de Alimentos (AUPSA) del Ministerio de Desarrollo Agropecuario (MIDA), realizaron verificaciones sanitarias a tres establecimientos productores de alimento balanceado en las provincias de El Oro y Guayas.\r\n\r\nLas auditorías sanitarias para obtener la inclusión y renovación de la habilitación por parte de AUPSA, se realizaron con el acompañamiento de funcionarios de la Subsecretaría de Calidad e Inocuidad (SCI).\r\n\r\nEl 4 de mayo de 2018 se realizó la reunión de cierre de la visita por parte de SCI a la comitiva de AUPSA, para la revisión de resultados y el intercambio de experiencias en materia sanitaria de establecimientos productores de alimentos.', 'Subsecretaría de Calidad e Inocuidad (SCI).', '2018-05-08 04:27:00', 'Planta de Alimento Balanceado Productores de Camarón de El Oro (PCO) y Planta de Alimento Balanceado GISIS, en las provincias de El Oro y Guayas, respectivamente.', 100, NULL, '1525901241-Fotografias Renovaciones y nueva habilitación de establecimientos ecuatorianos para exportar productos al mercado de Panamá.pdf', '2018-05-09 21:27:21', '2018-05-09 21:27:21', 9, ''),
(149, 2, '7.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Del 02 al 08 de mayo 2018 se realizaron transferencias de conocimiento a 158 Pescadores Artesanales en la provincia de Manabí, del cantón Sucre, en la Fase I cuyo tema es Manejo de los Recursos Bioacuáticos y Regularización de la Actividad Pesquera Artesanal: \r\n\r\n•	Caleta Pesquera Punta de Mico beneficiando a 102 pescadores artesanales. \r\n•	Caleta Pesquera San Clemente beneficiando a 56 pescadores artesanales.', 'MAP – Dirección de Pesca Artesanal', '2018-05-08 04:29:00', 'provincia de Manabí, cantón Sucre', 25, NULL, '1525901348-Infome semanal_del_02_al_08_de_mayo_2018_Capacitación_Integral.PDF', '2018-05-09 21:29:08', '2018-05-09 21:29:08', 9, ''),
(150, 3, 'Reactivación de sanciones a Colombia', 'Dado que Colombia está impidiendo el ingreso de arroz ecuatoriano el Tribunal de Justicia de la Comunidad Andina aprobó la solicitud del Ecuador par aplicar medidas sancionatorias a 10 productos sensibles provenientes de Colombia.', 'Coordinación General de Servicios, Juan Francisco Ballén', '2018-05-08 07:50:00', 'Quito', 100, 'El Gobierno ecuatoriano reactivará las sanciones a Colombia eliminando preferencias arancelarias a 10 productos que incluyen entre otros confites, baterías, vehículos. La nueva decisión del Gobierno ecuatoriano se genera porque Colombia no ha dejado ingresar arroz al mercado local.', '000Ninguno', '2018-05-10 00:50:27', '2018-05-10 00:50:27', 9, ''),
(151, 3, 'Aprobación del \"Reglamento para el otorgamiento de la licencia de uso de la marca Primero Ecuador\"', 'Desde el 09 de noviembre de 2017 el Ministerio de Industrias y Productividad presentó a la Comisión Estratégica de Marcas la propuesta de \"Reglamento para el otorgamiento de la licencia de uso de la marca Primero Ecuador\". Acogidos los aportes a la propuesta, realizados por los miembros de la Comisión, y después de varias insistencias, la Comisión Estratégica de Marcas, en sesión ordinaria efectuada el 09 de mayo de 2018, aprobó el referido reglamento, lo cual viabiliza la reactivación de la prestación del servicio de concesión de licencias para el uso de la marca, como un mecanismo para promover el consumo de los productos del sector industrial nacional.', 'Coordinación General de Servicios, Juan Francisco Ballén', '2018-05-09 08:00:00', 'Quito', 100, 'El Ministerio de Industrias y Productividad pone al servicio del sector industrial nacional, y la ciudadanía en general, la marca “Primero Ecuador”, que identifica mediante su sello a productos y servicios nacionales para:\r\n-	Generar valor agregado intangible\r\n-	Potenciar el mercado interno.\r\n-	Fortalecer el crecimiento de todos los sectores industriales y de servicios, promoviendo la sustitución de importaciones.\r\n-	Contribuir a la creación de una cultura de valoración de la producción nacional.', '000Ninguno', '2018-05-10 01:00:49', '2018-05-10 01:00:49', 9, ''),
(152, 1, 'Flores propone construir un acuerdo nacional sobre la agricultura', 'El ministro de Agricultura y Ganadería, Rubén Flores, asistió el 9 de mayo a la Asamblea Nacional para comparecer ante la Comisión de Fiscalización y Control Político a dialogar sobre la problemática del arroz y las soluciones planteadas desde el Gobierno.\r\nLa comparecencia estuvo encabezada por la asambleísta de Alianza País, María José Carrión, acompañada de los demás miembros de la Comisión legislativa. Además se contó con la presencia de asambleístas de distintos partidos políticos, productores arroceros y representantes de instituciones públicas como la Unidad Nacional de Almacenamiento (UNA-EP), Servicio de Rentas Internas del Ecuador (SRI), Servicio Nacional de Contratación Pública, BanEcuador, y el Servicio Nacional de Aduana del Ecuador (Senae).\r\nFlores planteó construir un acuerdo nacional sobre agricultura, en el que participen productores y otros actores de las cadenas productivas, así como instituciones públicas y privadas para, conjuntamente con el MAG, impulsar el desarrollo sostenido del sector.\r\nLas soluciones logradas por medio de trabajo en territorio y del Consejo Consultivo del arroz que expuso en su asistencia el Ministro Flores incluyeron: la consolidación de una estrategia de comercialización y exportación, la estrategia de articulación de financiamiento a los pequeños productores, la coordinación con 19 instituciones para controlar el contrabando, el pago de deudas a la UNA-EP para darle liquidez y que pueda comprar la cercana cosecha. Además de la definición del reordenamiento institucional y el impulso al fortalecimiento gremial.', 'https://www.agricultura.gob.ec/flores-propone-construir-un-acuerdo-nacional-sobre-la-agricultura/', '2018-05-09 04:42:00', 'Quito- Pichincha', 100, 'En un acuerdo nacional sobre agricultura participarán productores y otros actores de las cadenas productivas, así como instituciones públicas y privadas para, conjuntamente con el MAG, impulsar el desarrollo sostenido del sector.\r\n\r\nSe buscará consolidar una estrategia de comercialización y exportación, así como la estrategia de articulación de financiamiento a los pequeños productores, y la coordinación con 19 instituciones para controlar el contrabando.', '000Ninguno', '2018-05-16 21:42:27', '2018-05-16 21:42:27', 10, ''),
(154, 1, 'Control interinstitucional de precios de arroz, maíz duro y banano', 'El titular del Ministerio de Agricultura y Ganadería (MAG), Rubén Flores, comunicó a los directivos de las industrias avícolas, piladoras de arroz y exportadoras de banano que se realizará un control interinstitucional para hacer respetar los precios determinados en los acuerdos ministeriales respectivos, con la finalidad de garantizar la actividad de los productores agrícolas, sobre todo, de los pequeños.\r\nPara el efecto, el Ministerio coordinará continuamente y con las entidades competentes: gobernaciones, intendencias, Superintendencia de Control de Poder del Mercado, Agencia de Regulación y Control Fito y Zoosanitario (Agrocalidad), Senae, SRI, “las acciones de control encaminadas al cumplimiento del marco legal y la observancia de los precios vigentes” para dar “tranquilidad a los productores y precautelar que todos los eslabones del sistema productivo actúen bajo los principios de transparencia, buenas prácticas.', 'https://www.agricultura.gob.ec/control-interinstitucional-de-precios-de-arroz-maiz-duro-y-banano/', '2018-05-09 04:47:00', 'Guayaquil-Guayas', 100, 'El MAG envió cartas a los directivos de las industrias avícolas, piladoras de arroz y exportadoras de banano, para informarles que se realizará un control interinstitucional para hacer respetar los precios determinados en los acuerdos ministeriales respectivos.\r\n\r\nEl Ministerio coordinará continuamente con las entidades competentes: gobernaciones, intendencias, Superintendencia de Control de Poder del Mercado, Agencia de Regulación y Control Fito y Zoosanitario (Agrocalidad), Senae, SRI, las acciones de control encaminadas al cumplimiento del marco legal y la observancia de los precios vigentes.\r\n\r\nSe pretende precautelar que todos los eslabones del sistema productivo actúen bajo los principios de transparencia, buenas prácticas.', '000Ninguno', '2018-05-16 21:47:48', '2018-05-16 21:47:48', 10, ''),
(155, 1, 'MAG y Tonicorp promueven cadena devalor inclusiva en el sector ganadero', 'El Ministerio de Agricultura y Ganadería (MAG), conjuntamente con Tonicorp, presentó oficialmente el Programa de Ganadería Socialmente Inclusiva implementado con la metodología del Programa de Naciones Unidas para el Desarrollo (PNUD).\r\nEl Programa de Ganadería Socialmente Inclusiva se desarrolló durante nueve meses, vinculando a la cadena de abastecimiento de leche Tonicorp a las asociaciones ganaderas de parroquias rurales como Irquis, Biblián, Verdepamba, Coyoctor y La Candelaria, pertenecientes a las provincias de Cañar y Azuay.\r\nEl impacto se evidencia en más de 3 mil familias, con la reducción de vulnerabilidades y pobreza, generando colaborativamente oportunidades de empleo pleno y productivo para mujeres y hombres del país.\r\nEn el lanzamiento del programa, el ministro de Agricultura y Ganadería, Rubén Flores, expresó que “el desafío de la agricultura en los próximos cinco años es convertirse en sustentable para capturar nichos de mercado. Para ello hay que lograr, sobre todo, el incremento de la productividad a través de un trabajo que se construye día a día de manera articulada, la leche es un componente estratégico en el proceso de nutrición”.', 'https://www.agricultura.gob.ec/mag-y-tonicorp-promueven-cadena-de-valor-inclusiva-en-el-sector-ganadero', '2018-05-15 04:49:00', 'Guayaquil-Guayas', 100, 'El Programa de Ganadería Socialmente Inclusiva, implementado con la metodología del Programa de Naciones Unidas para el Desarrollo (PNUD), vincula la cadena de abastecimiento de leche Tonicorp con las asociaciones ganaderas de parroquias rurales pertenecientes a las provincias de Cañar y Azuay.\r\n\r\nEl impacto se evidencia  en más de 3 mil familias, con la reducción de vulnerabilidades y pobreza, generando colaborativamente oportunidades de empleo pleno y productivo para mujeres y hombres del país.\r\n\r\nEl desafío de la agricultura en los próximos cinco años es convertirse en sustentable para capturar nichos de mercado. \r\n\r\nEl objetivo del proyecto es consolidar el sector alimenticio para garantizar una producción sostenible.', '000Ninguno', '2018-05-16 21:49:27', '2018-05-16 21:49:27', 10, ''),
(156, 2, '1.	MAP Fortalece la regularización de los pescadores artesanales en Esmeraldas', 'El Ministerio de Acuacultura y Pesca, la Escuela de Marina Mercante (Esmena) y la Fundación Ecuatoriana para el Desarrollo Marítimo (Fundemar) beneficiaron durante abril y mayo a 212 pescadores artesanales de la provincia de Esmeraldas, con facilidades para la realización de la certificación OMI sobre principios fundamentales de seguridad en la navegación y supervivencia en el mar. Esta certificación es uno de los requisitos para obtener la matrícula de personal marítimo y el permiso de pescador artesanal.\r\n\r\nLa acción articulada de las instituciones permitió que los beneficiarios reciban un descuento del 33% en el costo total del taller. Esta ayuda abarcó en primera instancia a los pescadores pertenecientes a las caletas pesqueras del cantón Río Verde, que comprenden los sectores de Rocafuerte, Tacusa, Palestina y Bocana de Ostionesen Esmeraldas y se extenderá paulatinamente en toda la provincia.', 'http://www.acuaculturaypesca.gob.ec/subpesca4758-map-fortalece-la-regularizacion-de-los-pescadores-artesanales-en-esmeraldas.html', '2018-05-15 05:48:00', 'Esmeraldas', 100, NULL, '1526510916-MAP FORTALECE LA REGULARIZACIÓN DE LOS PESCADORES ARTESANALES EN ESMERALDAS.pdf', '2018-05-16 22:48:36', '2018-05-16 22:48:36', 10, ''),
(157, 2, '2.	Autoridades se reúnen para reforzar acciones frente a la situación del sector pesquero artesanal de Esmeraldas', 'La Ministra Katuska Drouet y la Viceministra, mantuvieron una reunión de trabajo con representantes de la Cámara de Pesquería de Esmeraldas para revisar los proyectos de reactivación económica para el sector pesquero con el fin de articular junto a otras entidades los proyectos en su beneficio.', 'https://twitter.com/MinAcuaPescaEc/status/994277151921901568', '2018-05-15 05:49:00', 'San Mateo - Provincia de Manabí', 100, NULL, '000Ninguno', '2018-05-16 22:49:49', '2018-05-16 22:49:49', 10, ''),
(158, 2, '3.	MAP y ULEAM firman convenio de cooperación interinstitucional', 'El Ministerio de Acuacultura y Pesca (MAP) y la Universidad Laica “Eloy Alfaro” de Manabí (ULEAM) suscribieron el miércoles 09 de mayo del año en curso, en Manta un convenio de cooperación interinstitucional para promover el desarrollo académico e involucrar a la sociedad en los sectores pesquero y acuícola del país, a través de planes e investigaciones científicas en las que participarán tanto docentes y estudiantes como funcionarios del MAP.\r\n\r\nEl documento ratifica el compromiso ministerial de trabajar en coordinación con diferentes entidades públicas y privadas para la aplicación de proyectos que beneficien al progreso de estos importantes sectores productivos.', 'http://www.acuaculturaypesca.gob.ec/subpesca4767-map-y-uleam-firman-convenio-de-cooperacion-interinstitucional.html', '2018-05-15 05:51:00', 'Manta - Universidad Eloy Alfaro de Manabí', 100, NULL, '1526511073-MAP Y ULEAM FIRMAN CONVENIO DE COOPERACIÓN INTERINSTITUCIONAL.pdf', '2018-05-16 22:51:13', '2018-05-16 22:51:13', 10, ''),
(159, 2, '4.	MAP convocó a organismos del sector pesquero para revisar acciones contra la Pesca Ilegal No declarada No Reglamentada', 'Con el propósito de que Ecuador mantenga acciones para combatir la Pesca Ilegal, No Declarada y No Reglamentada, el Subsecretario de Recursos Pesqueros, junto a los representantes de los organismos del sector pesquero, como la Cámara Nacional de Pesquería , La Asociación de Atuneros del Ecuador (ATUNEC) y  La Cámara Ecuatoriana de Industriales y Procesadores Atuneros (CEIPA) se reunieron para revisar el Plan de acción que el Ministerio de Acuacultura presentará a la DG MARE, actual responsable de las políticas de la Comisión sobre asuntos marítimos y pesca, para ratificar su decisión de eliminar y desalentar este tipo de pesquería en las embarcaciones ecuatorianas.', 'https://twitter.com/jorgemcostain/status/994030481506209794', '2018-05-15 05:53:00', 'San Mateo, provincia de Manabí.', 100, NULL, '000Ninguno', '2018-05-16 22:53:14', '2018-05-16 22:53:14', 10, ''),
(160, 2, '5.	MAP realiza seguimiento a planes de electrificación', 'Con el objetivo de mejorar la competitividad del sector camaronero en armonía con el ambiente, la Ministra de Acuacultura y Pesca, Katuska Drouet revisó junto a representantes de Gps Group, los avances del Plan de Electrificación que beneficia a este importante sector productivo.\r\n\r\nGps Group, representante de un importante grupo camaronero, se comprometió a remitir información para que CNEL EP analice los diferentes escenarios técnicos, económicos y legales para formalizar una alianza público privada que impulse el desarrollo sostenible de esta importante actividad económica del país.', 'https://twitter.com/MinAcuaPescaEc/status/994038676568072192', '2018-05-15 05:54:00', 'Guayaquil', 43, NULL, '000Ninguno', '2018-05-16 22:54:12', '2018-05-16 22:54:12', 10, ''),
(161, 2, '6.	Ecuador y miembros cooperantes participan en la 8va reunión de la Comisión Interamericana del Atún Tropical (CIAT)', 'El Subsecretario de Recursos Pesqueros, junto a los representantes de los países miembros de la Comisión Interamericana del Atún Tropical (CIAT), como Canadá, EE. UU., Panamá, China, entre otros, participaron en la 8va reunión de trabajo desarrollada en La Jolla, en el sur de California, con la finalidad de verificar las normativas que se establecen para la conservación y ordenación de atunes y otras especies marinas en el Océano Pacífico Oriental.\r\n\r\nDurante el encuentro se afirmó el cumplimiento de todas las normativas respecto a la captura incidental, gracias a un trabajo articulado entre el Ministerio de Acuacultura y Pesca, el Instituto Nacional de Pesca y los armadores de embarcaciones ecuatorianas para cumplir con la sostenibilidad de los recursos del mar.\r\n\r\nAsí mismo, en la novena reunión donde se conocieron temas de sostenibilidad y sustentabilidad del atún en el Océano Pacífico Oriental, el subsecretario reafirmó el compromiso de los estudios científicos que el Ministerio de Acuacultura y Pesca desarrolla en el sector, como  los cruceros de investigación, donde se obtienen datos relevantes para incrementar el conocimiento de estos recursos, relacionados a su distribución, número de individuos, estructura de tallas, peso, condiciones reproductivas.', 'https://twitter.com/jorgemcostain/status/994679399319572482  	        https://twitter.com/jorgemcostain/status/994681138852651008', '2018-05-15 05:54:00', 'La Jolla, en el sur de California', 100, NULL, '000Ninguno', '2018-05-16 22:54:52', '2018-05-16 22:54:52', 10, ''),
(162, 2, '7.	La sostenibilidad y el desarrollo de las pesquerías se practicarán en Ecuador y Perú', 'Autoridades ambientales y pesqueras de Ecuador, Perú y representantes del Programa de Naciones Unidas para el Desarrollo PNUD, se reunieron en Piura para conocer las acciones a ejecutar en el marco de la implementación del proyecto Iniciativa de Pesquerías Costeras – América Latina por sus siglas en inglés Coastal Fisheries Initiative.\r\n\r\nEl proyecto contribuirá a afrontar el problema mundial de la sobrepesca, degradación de los recursos pesqueros y la biodiversidad costera y marina, ofreciendo beneficios, ambientales, sociales y económicos. El IPC cuenta con tres proyectos en Indonesia, América Latina (Ecuador y Perú) y África Occidental.', 'https://twitter.com/MinAcuaPescaEc/status/995392162954137600', '2018-05-15 05:55:00', 'Perú - Piura', 100, NULL, '000Ninguno', '2018-05-16 22:55:26', '2018-05-16 22:55:26', 10, ''),
(163, 2, '8.	MAP socializa las acciones para contrarrestar la delincuencia en altamar en General Villamil Playas', 'Autoridades del Ministerio de Acuacultura y Pesca y del Gobierno Nacional, incluido La Armada del Ecuador, el Ministerio de Ambiente, el Instituto Nacional de Pesca, dialogaron con pescadores artesanales de General Villamil Playas respecto a las acciones contra la delincuencia en altamar, abastecimiento de combustibles, áreas de pesca y ambiente.', 'https://twitter.com/MinAcuaPescaEc/status/995423012169056256', '2018-05-15 05:55:00', 'Provincia del Guayas - General Villamil Playas', 99, NULL, '000Ninguno', '2018-05-16 22:55:56', '2018-05-16 22:55:56', 10, ''),
(164, 2, '9.	Ejecución del Plan Sanidad Acuícola', 'El Plan de Sanidad Acuícola y su programa de monitoreo determinará el estado de salud y posibles factores que podrían afectar a la producción camaronera. Su objetivo es el de levantar información y línea base del estado zoosanitario. Asi como tambièn el plan permite establecer las principales prácticas y características de la actividad acuícola y la producción camaronera, detección de presencia de agentes patógenos (bacterias y virus) los cuales puedan causar problemas en maduraciones, laboratorios de producción de larvas y fincas camaroneras; el cual además permitirá establecer medidas de bioseguridad y buenas prácticas acuícolas. Del 8 al 11 de mayo de 2018, se inició el primer monitoreo en la provincia de Manabí en los cantones Monitoreo en Cañaveral, Cojimies, Pueblo Nuevo, La Violeta, Coaque, Puerto Cotera, Zurrones, Cheve, Chamanga, El Toro, y demás dependencias cercanas de Pedernales. Así como también, en los establecimientos de la zona de: Jama, Don Juan y San Vicente.', 'Ministerio de Acuacultura y Pesca - Subsecretaría de Calidad e Inocuidad', '2018-05-15 05:57:00', 'Provincia de Manabí.', 40, NULL, '1526511430-Anexos Plan Sanidad Acuícola.rar', '2018-05-16 22:57:10', '2018-05-16 22:57:10', 10, ''),
(165, 3, 'Mesas de Competitividad Pichincha', 'El 15 de mayo de 2018, se realizó la Mesa de Competitividad de Pichincha,  con la presencia de presidenta de la Asamblea Nacional, Elizabeth Cabezas Guerrero, y los representantes de los sectores productivos provinciales, incluidos los gobiernos locales, ratificó el compromiso de los sectores productivos de la provincia de trabajar coordinadamente en la generación de política pública de desarrollo.\r\n\r\nLa ministra de Industrias y Productividad, Eva García Fabre, hizo una síntesis de todo el trabajo realizado en las 23 provincias en las que se han desarrollado las mesas de competitividad, reflejadas en más de 2.500 participantes y alrededor de más de 800 propuestas recogidas.\r\n\r\nEl evento contó con la participación de 157 personas y 51 propuestas obtenidas en las diferentes mesas técnicas de diálogo realizadas.', 'Subsecretaría de Desarrollo Territorial', '2018-05-16 06:19:00', 'Quito', 100, 'EL 16 DE OCTUBRE DE 2017, CON LA PRESENCIA Y RESPALDO DEL SEÑOR PRESIDENTE DE LA REPÚBLICA, LENÍN MORENO GARCÉS, LA MINISTRA DE INDUSTRIAS Y PRODUCTIVIDAD, ECON. EVA GARCÍA FABRE, FIRMÓ EL ACUERDO NACIONAL POR LA PRODUCCIÓN Y EL EMPLEO. EN EL MARCO DE ESTE ACUERDO, EL DÍA 23 DE OCTUBRE DE 2017, EL MIPRO PRESENTÓ LAS MESAS DE COMPETITIVIDAD PROVINCIALES, COMO EL ESPACIO DE DIÁLOGO Y TRABAJO EN EL CUAL SE ARTICULARÁ A LA GRANDE, MEDIANA Y PEQUEÑA EMPRESA, ARTESANOS, EPS, ACADEMIA Y AL SECTOR PÚBLICO. DICHAS MESAS INICIARON EL 16 DE NOVIEMBRE DE 2017, Y CON LA MESA DE COMPETITIVIDAD DE PICHINCHA SE HABRÁ REALIZADO UN DESPLIEGUE QUE HA DADO COBERTURA A TODO EL ECUADOR CONTINENTAL. \r\n\r\nPARA LA GESTIÓN DE LAS MESAS DE COMPETITIVIDAD SE DESARROLLÓ LA PLATAFORMA DE GOBIERNO ABIERTO DENOMINADA \"INTELIGENCIA PRODUCTIVA\" (WWW.INTELIGENCIAPRODUCTIVA.GOB.EC), LA MISMA QUE BUSCA GARANTIZAR EL SEGUIMIENTO DE LAS PROPUESTAS QUE SE HAN OBTENIDO A TRAVÉS DE LAS DIFERENTES MESAS DE DIÁLOGO, DONDE LA CIUDADANÍA, SECTOR PRODUCTIVO Y ACADEMIA, DE FORMA INCLUSIVA Y PARTICIPATIVA, SON ACTORES FUNDAMENTALES PARA AVALAR LA GESTIÓN REALIZADA DE FORMA TRANSPARENTE, COLABORATIVA Y PARTICIPATIVA.\r\n\r\nLA MESA DE COMPETITIVIDAD DE PICHINCHA DESARROLLADA EL 15 DE MAYO DE 2018 EN QUITO, CONTÓ CON LA PRESENCIA DE PRESIDENTA DE LA ASAMBLEA NACIONAL, ELIZABETH CABEZAS GUERRERO, Y LOS REPRESENTANTES DE LOS SECTORES PRODUCTIVOS PROVINCIALES, INCLUIDOS LOS GOBIERNOS LOCALES, QUIENES RATIFICARON EL COMPROMISO DE LOS SECTORES PRODUCTIVOS DE LA PROVINCIA DE TRABAJAR COORDINADAMENTE EN LA GENERACIÓN DE POLÍTICA PÚBLICA DE DESARROLLO.\r\n\r\nEL EVENTO CONTÓ CON LA PARTICIPACIÓN DE 157 PERSONAS Y 51 PROPUESTAS OBTENIDAS EN LAS DIFERENTES MESAS TÉCNICAS DE DIÁLOGO REALIZADAS.', '000Ninguno', '2018-05-16 23:19:02', '2018-05-16 23:19:02', 10, ''),
(166, 3, 'Feria del día de la Madre 2018', 'Institución Responsable: Ministerio de Industrias y Productividad – MIPRO; Dependencia: Subsecretaría de MIPYMES y Artesanías, Evento: Feria del día de la Madre 2018, Fecha: 10 y 11 de mayo de 2018; Participantes: 38 expositores; Actividades: Desarrollo de una feria productiva.', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '2018-05-16 07:49:00', 'Quito, Plataforma Gubernamental Norte. Plaza Japón: Japón y UNP esquina. Sobre el patio de Comidas', 100, 'El Ministerio de Industrias y Productividad (MIPRO) a través de la Subsecretaría de MIPYMES y Artesanías, en conmemoración del Día Internacional de la Madre, organizó la “Feria Arte para Mamá” que se llevó a cabo los días 10 y 11 de mayo de 2018 en las instalaciones de la Plataforma Gubernamental Norte, en Quito. \r\n\r\nEl evento que contó con una afluencia de más de 1000 visitantes durante los dos días, propició la participación de 38 expositores nacionales de los diversos sectores productivos como: alimentos y bebidas, bisutería, cosméticos, textil, calzado, entre otros.', '000Ninguno', '2018-05-17 00:49:41', '2018-05-17 00:49:41', 10, ''),
(167, 3, 'Firma de Acuerdo Productivo Nacional', 'Firma de Acuerdo Productivo Nacional por parte de las ministras de Industrias y Productividad, Eva García Fabre, de Salud, Verónica Espinosa Serrano, y con los titulares del ARCSA, ALFE y CIPME y directivos de las demás empresas farmacéuticas adherentes', 'Subsecretaría de Industrias Intermedias y Finales', '2018-05-17 03:19:00', 'Cámara de Industrias de Guayaquil', 100, 'La suscripción de este primer Acuerdo Productivo Nacional con el sector farmacéutico sienta las bases para que este sector, que tiene 30 empresas industriales, pueda fomentar la inversión y desarrollar la producción nacional de medicamentos con procesos de calidad, incrementando de esta manera las exportaciones de estos productos, mejorando la competitividad y su participación en la demanda del mercado local, con el concurso de todos los actores involucrados (MSP, ARCSA, ALFE, CIPME, MIPRO).', '000Ninguno', '2018-05-17 20:19:36', '2018-05-17 20:19:36', 10, ''),
(168, 3, 'Primer Foro Empresarial Andino 2018', 'Primer Foro Empresarial Andino 2018, inaugurado por el Sr. Presidente de la República y organizado por el MIPRO, contó con la asistencia de 370 participantes aproximadamente entre los cuales estuvieron representantes de las cámaras, gremios de trabajadores, empresarios, actores de la economía popular y solidaria, autoridades de la Función Ejecutiva y ponentes internacionales, cuyo objetivo es crear un espacio de intercambio y socialización de las mejores prácticas regionales en temas de empleo, inversión y fortalecimiento de capacidades del sector productivo y empresarial.', 'Coordinación General de Planificación y Gestión Estratégica', '2018-05-17 06:13:00', 'Quito', 100, 'El foro fue importante para el sector productivo y empresarial para el desarrollo económico y social, tanto por la generación de empleo productivo como por la generación de riqueza, con este evento generamos un intercambio de experiencias y mejores prácticas en la definición de políticas públicas, programas y proyectos tanto desde el sector público como del sector privado, con énfasis en los temas relacionados al empleo juvenil, emprendimiento, desarrollo de proveedores y reactivación productiva, donde fue importante conocer las iniciativas y experiencias desarrolladas por los Países Miembros de la Comunidad Andina.', '000Ninguno', '2018-05-17 23:13:03', '2018-05-22 20:28:35', 10, 'Presidencia'),
(169, 3, 'Capacitación en defensa al consumidor y  etiquetado para calzado', 'El pasado 16 y 17 de mayo de 2018  se capacitó en etiquetado de clazado y defensa al consumidor a artesanos de la provincia de Tungurahua\r\n\r\n-Evento fue organizado por:  MIPRO, INEN, GADP Tungurahua.\r\n-Asistentes: 280  participantes\r\n-Se reconoció la gestión del MIPRO como la institución pública que capacita a artesanos y MIPYMES en etiquetado de calzado y defensa al consumidor con el objetivo de difundir los reglamentos y normativa INEN a artesanos informales y que logren obtener el certificado de conformidad.', 'Coordinación zonal 3', '2018-05-16 12:57:00', 'Ambato', 100, NULL, '000Ninguno', '2018-05-22 17:57:25', '2018-05-23 13:44:23', 11, 'Institucional'),
(170, 3, 'Capacitación en Educación Financiera', 'El pasado 18 de mayo de 2018  se realizó la capacitación Educación Financiera en La Maná-Cotopaxi a 50 participantes a la Asociación Esperanza.\r\n\r\n-Evento fue organizado por:  MIPRO y CACPECO.\r\n-Asistentes: 50  participantes\r\n-Se reconoció la gestión del MIPRO como la institución pública que capacita a artesanos y MIPYMES en Educación Financiera para contribuir al manejo de sus empresas.', 'Coordinación zonal 3', '2018-05-18 12:59:00', 'La Maná', 100, NULL, '000Ninguno', '2018-05-22 17:59:10', '2018-05-23 13:43:58', 11, 'Presidencia'),
(171, 3, 'Feria de Economía Popular y Solidaria COMERCIO JUSTO', 'El pasado 20 de mayo de 2018 se asistió a la Feria de Economía Popular y Solidaria COMERCIO JUSTO con 15 emprendimientos apoyados por el MIPRO.\r\n\r\n-El evento fue organizado por:  Municipio de Riobamba\r\n-Asistentes: 50 expositores, 15 emprendedores apoyados por el MIPRO y 3000 participantes.\r\n-Se reconoció la gestión del Mipro como la institución pública que apoya a las MIPYMES de la zona centro del país para desarrollar la comercialización con base en criterios del COMERCIO JUSTO.', 'Coordinación zonal 3', '2018-05-20 01:02:00', 'Riobamba', 100, NULL, '000Ninguno', '2018-05-22 18:02:16', '2018-05-22 18:02:16', 11, 'Presidencia'),
(172, 3, 'Taller teórico - práctico de fortalecimiento de la industria cárnica con experto Suizo', 'Se capacitó a 20 personas, entre representantes de la asociación frigorifico Cuenca Peñafiel y de la Asociación de Matarifes La Inmaculada Concepción\r\n\r\nLugar: Instalaciones frigorífico Cuenca Peñafiel, Asociación de matarifes La Inmaculada, e instalaciones del Colegio de Bachillerato Primero de Mayo de Yantzaza\r\n\r\nAutoridades: Directora de SWISSCONTAC, Director de Industrias Básicas e Intermedias, Gerente de Fundación LUNDIN, Rector del Colegio Primero de Mayo, Experto Suizo', 'Coordinación zonal 7', '2018-05-15 01:22:00', 'Zamora Chinchipe', 100, 'La alianza con Swisscontact permite gestionar actividades con la visión de fomentar el desarrollo de las pequeñas empresas asociativas  de la región Sur. Estos talleres prácticos y especializados permiten a los productores  optimizar los procesos productivos y generar mayor valor agregado.', '000Ninguno', '2018-05-22 18:22:24', '2018-05-22 18:22:24', 11, 'Presidencia'),
(173, 3, 'Taller  teórico - práctico de catering especializado y recetas suizas', '*Se capacitó a 14 representantes de la empresa Catering \"Las Peñas\"\r\n\r\n*Lugar: Cocina experimental de la empresa de Catering \"Las Peñas\"\r\n\r\n*Autoridades: Chef de Catering, experto suizo', 'Coordinación zonal 7', '2018-05-14 01:24:00', 'Zamora Chinchipe', 100, 'La alianza con Swisscontact permite gestionar actividades con la visión de fomentar el desarrollo de las pequeñas empresas asociativas  de la región Sur. Estos talleres prácticos y especializados permiten a los productores  optimizar los procesos productivos y generar mayor valor agregado.', '000Ninguno', '2018-05-22 18:24:21', '2018-05-23 13:45:07', 11, 'Institucional'),
(174, 3, 'Taller de catering y atención al cliente', '*Se capacitó a 17 mujeres de la \"Asociación de servicios de alimentación Pucará\" sector alimenticio.\r\n\r\n*Lugar: Instalaciones de colegio técnico 12 de Diciembre, del cantón Celica.\r\n\r\n*Autoridades: Director de MIPYMES y Agroindustrias', 'Coordinación zonal 7', '2018-05-22 01:25:00', 'Celica', 100, NULL, '000Ninguno', '2018-05-22 18:25:32', '2018-05-22 18:25:32', 11, 'Presidencia'),
(175, 3, '1er Foro Empresarial Anido', 'El pasado 17 y 18 de mayo del 2018, se realizó el 1er Foro Empresarial Anido. Foro inaugurado por el Sr. Presidente de la Republica, Lenin Moreno. Al mismo tiempo tuvo la presencia de Ministros, Embajadores y representantes del sector productivo y empresarial.  Se trataron temas de interés público como: empleo juvenil, emprendimiento, desarrollo de proveedores y reactivación productiva.\r\n\r\nLugar: Hotel Quito \r\n\r\nParticipantes: \r\n9 países\r\n5 moderadores\r\n15 ponentes\r\n630 espectadores', 'Despacho del Ministerio de Industrias y Productividad', '2018-05-22 01:42:00', 'Quito', 100, NULL, '000Ninguno', '2018-05-22 18:42:19', '2018-05-22 18:42:19', 11, 'Presidencia'),
(176, 3, 'Entrega de reconocimientos a las mejoras prácticas empresariales', 'El pasado 17 de mayo del 2018, dentro del 1er Foro Empresarial Andino se realizó un reconocimiento a las mejores prácticas empresariales a favor del desarrollo productivo y económico y local del país, las categorías que fueron premiadas fueron: Desarrollo de proveedores, Responsabilidad Social Empresarial, Reactivación pos-terremoto, Internacionalización productiva, Innovación productiva, Generación de empleo. En dichas categorías las empresas reconocidas fueron:\r\n\r\nArca continental, “Desarrollo de Proveedores”\r\nToni Corp, “Desarrollo de Proveedores”\r\nCorporación Favorita, “Desarrollo de Proveedores”\r\nGrupo Tía, “Desarrollo de Proveedores” \r\nGrupo Mavesa, “Responsabilidad Social Empresarial”\r\n Independiente Del Valle Futbol Club, “Reactivación productiva pos desastre”\r\nGobierno de República Checa, “Reactivación productiva pos desastre”\r\nFerromedica, “Generación de nuevas líneas de exportación”\r\nSertepec, “innovación productiva”\r\nAdelca, “Generación de Empleo”', 'Despacho del Ministerio de Industrias y Productividad', '2018-05-17 01:56:00', 'Quito', 97, NULL, '000Ninguno', '2018-05-22 18:56:38', '2018-05-22 18:56:38', 11, 'Presidencia'),
(177, 1, 'Gobierno apoya al sector palmicultor', 'El ministro de Agricultura y Ganadería, Rubén Flores, participó  en la inauguración de la planta refinadora de aceite de palma de la empresa Oleana, ubicaba en Tachina, provincia de Esmeraldas.\r\nEn esta planta se procesarán más de 80 mil toneladas anuales de aceites refinados, que serán destinados a la exportación, pero que también contribuirán a generar empleo adicional a los 100 mil trabajos que involucra actualmente ese sector en el país.\r\nFlores –quien en el recorrido por la planta estuvo acompañado del ministro de Comercio Exterior, Pablo Campana, y de representantes de la Asociación Nacional de Cultivadores de Palma Aceitera (Ancupa)- indicó que la producción de palma aceitera representa el 10% del Producto Interno Bruto agrícola nacional, por lo que lo el aporte del Gobierno está enfocado hacia el campo.\r\n“La palma se encuentra en el top ten de productos de exportación del país; es un rubro de importancia”, dijo el Ministro, quien indicó que existen oportunidades para esta actividad productiva, dado que hay mercados, por lo que el Gobierno facilitará el desarrollo de este sector.', 'https://www.agricultura.gob.ec/gobierno-apoya-al-sector-palmicultor/', '2018-05-18 01:10:00', 'Tachina, provincia de Esmeraldas.', 100, 'La planta refinadora de aceite de palma de la empresa Oleana, ubicada en Tachina, provincia de Esmeraldas, procesará más de 80 mil toneladas anuales de aceites refinados, que serán destinados a la exportación.\r\n\r\nLa planta contribuirá a  generar empleo adicional a los 100 mil trabajos que involucra actualmente el sector palmicultor en el país.\r\n\r\nLa producción de palma aceitera representa el 10% del Producto Interno Bruto agrícola nacional, por lo que lo el aporte del Gobierno está enfocado hacia el campo.\r\n\r\nLa palma se encuentra en el top ten de productos de exportación del país por lo que existen oportunidades para esta actividad productiva, dado que hay mercados, por lo que el Gobierno facilitará el desarrollo de este sector.\r\n\r\nCon  la operación de esta planta de Oleana se beneficiarán alrededor de 7 mil productores de palma de manera indirectamente, y de forma directa los 1200 palmicultores proveedores de la empresa.', '000Ninguno', '2018-05-23 18:10:01', '2018-05-23 18:10:01', 11, 'Institucional');
INSERT INTO `csp_reportes_hechos` (`id`, `institucion_id`, `tema`, `descripcion`, `fuente`, `fecha_reporte`, `lugar`, `porcentaje_avance`, `lineas_discursivas`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`) VALUES
(178, 1, 'Gobierno entregó el Manual de Seguridad  y Salud para la Industria Bananera', 'En las instalaciones de la Asociación de Pequeños Productores Bananeros El Guabo (Asoguabo), los ministros del Trabajo, Raúl Ledesma Huerta; y, de Agricultura y Ganadería, Rubén Flores, junto a John Preissing, representante de la Organización de las Naciones Unidas para la Alimentación (FAO) en Ecuador, entregaron el Manual de Seguridad y Salud para la Industria Bananera a cientos de representantes y trabajadores del sector.\r\n\r\nRubén Flores dijo que desde el ámbito agrícola, el Manual de Seguridad y Salud para la Industria Bananera será un referente en América Latina y el mundo, debido a que garantizará que los trabajadores tengan claros los riesgos que asumen y cómo minimizarlos, además de que se tendrá mano de obra calificada.\r\nVíctor Prada, de la FAO, expuso algunas características técnicas de este manual, que fue financiado por la Iniciativa de Comercio Sostenible (IDH), con la colaboración de Banana Link, la Secretaría del Foro Bananero, ministerios de Trabajo y de Agricultura y Ganadería, además del Instituto Ecuatoriano de Seguridad Social.', 'https://www.agricultura.gob.ec/gobierno-entrego-el-manual-de-seguridad-y-salud-para-la-industria-bananera/', '2018-05-21 01:13:00', 'Cantón El Guabo, provincia El Oro', 100, 'El Manual de Seguridad y Salud para la Industria Bananera será un referente en América Latina y el mundo, debido a que garantizará que los trabajadores tengan claros los riesgos que asumen y cómo minimizarlos, además de que se tendrá mano de obra calificada.\r\n\r\nLa aplicación del Manual permitirá precautelar los derechos humanos de los trabajadores y capacitar a más de 4 mil productores en la protección de sus trabajadores.\r\n\r\nEl Manual es una herramienta fundamental que permite entender el manejo adecuado de todo el proceso productivo del banano e identificar los potenciales riesgos. \r\nEl Manual promoverá una cultura de seguridad y salud en el sector bananero gracias a programas formativos y promocionales que beneficiarán a más de 145 mil trabajadores de 163 039 hectáreas de plantaciones de banano, repartidas en 4787 productores.', '000Ninguno', '2018-05-23 18:13:55', '2018-05-23 18:14:46', 11, 'Institucional'),
(179, 1, 'Estudiantes universitarios tendrán oportunidad de generar servicios para el desarrollo agropecuario', 'El Ministerio de Agricultura y Ganadería, BanEcuador, y la Secretaría de Educación Superior, Ciencia, Tecnología e Innovación (Senescyt), firmaron el convenio de cooperación interinstitucional ‘Sembrando conocimiento para el futuro’.\r\nPara el ministro de Agricultura y Ganadería, Rubén Flores, este convenio será “una  oportunidad para los jóvenes que están terminando la carrera, para generar servicios y desarrollar el sector agropecuario del país”.\r\nEl convenio se enmarca en la Gran Minga Nacional Agropecuaria y es un paraguas para consolidar trabajos con las universidades y los estudiantes.\r\nFlores considera que los productos no pueden quedarse solo en materia prima, sino que se debe pensar en realizar un trabajo conjunto con la academia para innovar y dar un salto cualitativo en la producción, inyectando  tecnología y creatividad a los productos primarios.', 'www.agricultura.gob.ec/estudiantes-universitarios-tendran-oportunidad-de-generar-servicios-para-el-desarrollo-agropecuario/', '2018-05-22 01:16:00', 'Centro Cívico Eloy Alfaro en Guayaquil', 100, 'El MAG, BanEcuador y la Senescyt firmaron el convenio “Sembrando para el futuro”, que tiene como propósito establecer un marco de cooperación interinstitucional para impulsar el desarrollo económico de los productores agropecuarios, con enfoque de género, generacional e intercultural.\r\n\r\nPromueve y fortalece el acceso a servicios financieros y no financieros a través de la articulación con instituciones de educación superior para la generación de investigación participativa, transferencia de tecnología y capacitación en los encadenamientos priorizados y territorios de agricultura familiar campesina diversificada, fortaleciendo así los principios de la economía popular y solidaria.\r\n\r\nLas entidades participantes promoverán servicios financieros y no financieros para favorecer a los productores agropecuarios, gestores de la innovación y al ecosistema de innovación y emprendimiento, articulando la educación técnica y tecnológica con la demanda de los actores del sector agropecuario.\r\n\r\nLas instituciones impulsarán una investigación participativa, con el propósito de generar valor agregado a la producción primaria.', '000Ninguno', '2018-05-23 18:16:17', '2018-05-23 18:16:17', 11, 'Institucional'),
(180, 3, 'Primer Foro Empresarial Andino 2018', 'Primer Foro Empresarial Andino 2018, inaugurado por el Sr. Presidente de la República y organizado por el MIPRO, contó con la asistencia de 637 participantes entre los cuales estuvieron representantes de las cámaras, gremios de trabajadores, empresarios, actores de la economía popular y solidaria, autoridades de la Función Ejecutiva y ponentes internacionales, cuyo objetivo es crear un espacio de intercambio y socialización de las mejores prácticas regionales en temas de empleo, inversión y fortalecimiento de capacidades del sector productivo y empresarial.', 'Coordinación General de Planificación y Gestión Estratégica', '2018-05-18 04:05:00', 'Quito,17 y 18 de mayo', 100, 'El foro fue importante para el sector productivo y empresarial para el desarrollo económico y social, tanto por la generación de empleo productivo como por la generación de riqueza, con este evento generamos un intercambio de experiencias y mejores prácticas en la definición de políticas públicas, programas y proyectos tanto desde el sector público como del sector privado, con énfasis en los temas relacionados al empleo juvenil, emprendimiento, desarrollo de proveedores y reactivación productiva, donde fue importante conocer las iniciativas y experiencias desarrolladas por los Países Miembros de la Comunidad Andina.', '000Ninguno', '2018-05-23 21:05:49', '2018-05-23 23:59:38', 11, 'Presidencia'),
(181, 3, 'Suscripción de Convenio entre Ministerio de Industrias y Productividad y Servicio Ecuatoriano de Capacitación (SECAP)', 'Suscripción del Convenio entre el Ministerio de Industrias y Productividad y el Servicio Ecuatoriano de Capacitación (SECAP) para brindar capacitación a 1.120 técnicos en Buenas Prácticas de Refrigeración y Aire Acondicionado, manejo de nuevas alternativas con cero potencial de agotamiento de la capa de ozono y bajo o nulo potencial de calentamiento global, en los próximos 18 meses, en 7 ciudades del país, por un monto de US$ 104.686.', 'Subsecretaría de Industrias Intermedias y Finales', '2018-05-22 04:09:00', 'Despacho Ministerial', 100, 'El 22 de mayo de 2018 se procedió con la firma de un convenio con el Servicio Ecuatoriano de Capacitación Profesional, por un monto de US$ 104.686, para capacitar en los próximos 18 meses y en 7 ciudades del país a 1.120 técnicos en Buenas Prácticas de Refrigeración y Aire Acondicionado, así como en el manejo de nuevas alternativas con cero potencial de agotamiento de la capa de ozono y bajo o nulo potencial de calentamiento global.', '000Ninguno', '2018-05-23 21:09:02', '2018-05-23 21:55:32', 11, 'Presidencia'),
(182, 3, 'Suscripción de Convenio entre Ministerio de Industrias y Productividad y Servicio Nacional de Aduana del Ecuador (SENAE)', 'Suscripción del Convenio entre Ministerio de Industrias y Productividad y Servicio Nacional de Aduana del Ecuador (SENAE) mediante el cual se entrega en donación tres identificadores de gases refrigerantes valorados en US$ 15.000 para identificar, evaluar y controlar el tráfico ilícito de sustancias agotadoras de la capa de Ozono –SAOs.', 'Subsecretaría de Industrias Intermedias y Finales', '2018-05-18 04:13:00', 'Despacho Ministerial', 100, 'El convenio que se suscribió el 18 de mayo de 2018 entre el Ministerio de Industrias y Productividad y Servicio Nacional de Aduana del Ecuador (SENAE), contempla la entrega en donación de tres (3) identificadores de gases refrigerantes valorados en US$ 15.000, los cuales permitirán a la Aduana del Ecuador trabajar en la identificación, evaluación y control del tráfico ilícito de sustancias agotadoras de la capa de ozono - SAOs, garantizando de esta manera el cumplimiento de los compromisos país, respecto a reducción y eliminación de estas sustancias.', '000Ninguno', '2018-05-23 21:13:10', '2018-05-23 21:55:19', 11, 'Presidencia'),
(183, 3, 'Inauguración del Laboratorio de Emisiones Vehiculares del Centro de Capacitación para la Investigación en Control de Emisiones Vehiculares (CCICEV), adscrito a la Escuela Politécnica Nacional (EPN)', 'Se inauguró el edificio y el equipamiento del laboratorio de emisiones vehiculares que forma parte del Centro de Homologación Vehicular apoyado y financiado por el MIPRO, a través del Plan Nacional de la Calidad, este laboratorio es administrado por el CCICEV.\r\n\r\nEl avance del 98% corresponde a la Obra civil (En lo que se refiere a la instalación del equipamiento, se encuentra pendiente el acondicionamiento: pruebas de funcionamiento del software, de los sistemas comunicacionales y del funcionamiento en conjunto de todos los equipos).', 'Subsecretaría de Industrias Intermedias y Finales', '2018-05-15 04:17:00', 'Laboratorio ubicado detras de la Metalmecánica San Bartolo de la Escuela Politécnica Nacional, en las calles Balzar y Pedro Vicente Maldonado, Sur de Quito', 98, 'Es el primer laboratorio a 2.800 m.s.n.m. que servirá para la evaluación de los gases contaminantes producto de la combustión de vehículos y certificar su cumplimiento dentro del marco normativo vigente previo a su entrada en circulación en el país. En cuanto al tema ambiental sin duda se convierte en un instrumento que permite evaluar las emisiones reales de los autos de acuerdo al tipo de vehículo y región donde circula, buscando alternativas que permitan reducir las emisiones generadas.', '000Ninguno', '2018-05-23 21:17:17', '2018-05-23 21:54:20', 11, 'Presidencia'),
(184, 3, 'Showroom – Mesas de Competitividad (Actividad Complementaria)', 'Institución Responsable: Ministerio de Industrias y Productividad – MIPRO; Dependencia: Subsecretaría de MIPYMES y Artesanías, Fecha: martes 15 de mayo de 2018; Participantes: 20 expositores entre emprendedores y artesanos nacionales; Actividades: Desarrollo de un showroom como actividad complementaria al evento de Mesas de Competitividad', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '2018-05-23 04:31:00', 'Cámara de la Pequeña y Mediana Empresa de Pichincha ubicada en la Av. Amazonas y Atahualpa, sector Parque La Carolina', 100, 'La Subsecretaría de Mipymes y Artesanías, participó con un showroom como actividad complementaria dentro del evento de Mesas de Competitividad organizado por esta Cartera de Estado.  El showroom contó con la participación de 20 expositores entre emprendedores y artesanos nacionales de diversos sectores productivos como: alimentos y bebidas, cosméticos, textil, calzado, limpieza, entre otros.', '000Ninguno', '2018-05-23 21:31:09', '2018-05-23 21:31:09', 11, 'Institucional'),
(185, 3, 'PROGRAMA ECOPAIS', 'Reunión con Ministerio de Hidrocarburos y EP PETROECUADOR para revisar los  escenarios y precios planteados del etanol que servirán para el análisis de los impactos del Programa ECOPAÍS', 'SUBSECRETARÍA DE AGROINDUSTRIA Y PROCESAMIENTO ACUÍCOLA', '2018-05-23 04:39:00', 'QUITO', 52, 'Análisis de alternativas que permitan reducir los costos que genera la gasolina ECOPAÍS.', '000Ninguno', '2018-05-23 21:39:11', '2018-05-23 21:39:11', 11, 'Institucional'),
(186, 2, '1.	MAP participa en el comité interinstitucional de economía popular y solidaria', 'La Ministra de Acuacultura y Pesca, participó en Quito en la definición de la hoja de ruta para el fortalecimiento de las políticas a favor de la promoción y desarrollo del sector de la Economía Popular y Solidaria, que incluyen el fortalecimiento de actores, acceso a mercados, la afinación y mejoramiento del instrumento de compras públicas y la prestación de servicios financieros.  Estos temas fueron analizados en el IX Comité Interinstitucional de Economía Popular y Solidaria liderado por la Vicepresidenta María Alejandra Vicuña.\r\n\r\nPosteriormente, mantuvo un encuentro protocolario con la presidenta de la Asamblea Nacional. En la cita se pasó revista a los distintos espacios de cooperación interinstitucional en torno al desarrollo de los sectores pesquero y acuícola y las iniciativas que tramita el organismo unicameral de 137 miembros para la reactivación productiva.', 'https://twitter.com/MinAcuaPescaEc/status/996425906443997184', '2018-05-22 04:40:00', 'Quito', 100, '1.	EL GOBIERNO NACIONAL ARTICULA ACCIONES INTEGRADAS CON LOS TITULARES DE LAS CARTERAS DE ESTADO DE LOS SECTORES PRODUCTIVOS, PARA EL FORTALECIMIENTO DE LAS POLÍTICAS A FAVOR DE LA PROMOCIÓN Y DESARROLLO DE LOS CIUDADANOS QUE PERTENECEN AL SECTOR DE LA ECONOMÍA POPULAR Y SOLIDARIA.\r\nEN EL IX COMITÉ INTERINSTITUCIONAL DE ECONOMÍA POPULAR Y SOLIDARIA REALIZADO EN QUITO, LA SEMANA PASADA, SE PLANTEÓ JUNTO A LA VICEPRESIDENTA, MARÍA ALEJANDRA VICUÑA TENER COMO META EN CADA INSTITUCIÓN PÚBLICA EL FORTALECIMIENTO DE ACTORES, ACCESO A MERCADOS, LA AFINACIÓN Y MEJORAMIENTO DEL INSTRUMENTO DE COMPRAS PÚBLICAS Y LA PRESTACIÓN DE SERVICIOS FINANCIEROS', '000Ninguno', '2018-05-23 21:40:52', '2018-05-23 21:42:03', 11, 'Presidencia'),
(187, 3, 'Reunión Fortalecimiento de la Política de Desarrollo Productivo Fronterizo', 'El pasado 18 de mayo de 2018, el Ministerio de Industrias y Productividad convocó una reunión interinstitucional, en la cual se desarrolló un taller de trabajo enfocado en el desarrollo productivo de la Zona Fronteriza Norte.\r\nLa reunión tuvo como objetivo fortalecer la Política de Desarrollo Productivo Fronterizo a través de la articulación de programas y proyectos de diferentes instituciones públicas. \r\nSe tuvo la participación de: \r\n•	Ministerio de Agricultura y Ganadería   \r\n•	Ministerio del Trabajo \r\n•	Ministerio de Hidrocarburos \r\n•	Ministerio de Acuacultura y Pesca \r\n•	Ministerio de Industrias y Productividad \r\n•	Corporación Financiera Nacional \r\n•	Senescyt', 'Despacho del Ministerio de Industrias y Productividad', '2018-05-18 04:42:00', 'Despacho - Ministerio de Industrias y Productivdad', 100, NULL, '000Ninguno', '2018-05-23 21:42:07', '2018-05-23 21:42:07', 11, 'Institucional y Presidencia'),
(188, 3, 'ALERTA SOBRE LA ENTRADA EN VIGENCIA DEL REGLAMENTO DE LA UNIÓN EUROPEA 488/2014 NIVELES MAXIMOS DE CADMIO EN CHOCOLATE', 'Reunión de la Mesa Técnica de Trabajo N6 Reglamento de la Unión Europea para el cadmio en chocolates y mezclas secas de azúcares.\r\nLa reunión efectuada el día 22 de junio de 2018 tuvo como objetivo la definición de una hoja de ruta y responsables  entre las instituciones involucradas', 'SUBSECRETARÍA DE AGROINDUSTRIA Y PROCESAMIENTO ACUÍCOLA', '2018-05-23 04:48:00', 'QUITO', 10, NULL, '000Ninguno', '2018-05-23 21:48:00', '2018-05-23 21:48:00', 11, 'Institucional'),
(189, 2, '2.	MAP certifica a segunda promoción de pescadores artesanales', 'Como resultado del convenio de cooperación interinstitucional entre el Ministerio de Acuacultura y Pesca (MAP) y el Instituto Tecnológico Superior “Luis Arboleda Martínez”, en Manta 78 pescadores artesanales de las comunidades pesqueras de Santa Rosa, Las Piñas, San Lorenzo, Liguiqui y Santa Marianita obtuvieron la Certificación de Competencias Laborales en el perfil “Pesca Artesanal”. \r\n\r\nLa Certificación de Competencias Laborales acredita y reconoce los conocimientos y destrezas ancestrales de los pescadores a través de capacitaciones técnicas. De esta forma el Gobierno Nacional contribuye a mejorar las condiciones de empleo y calidad de vida del sector pesquero. \r\n\r\nEn la semana del 16 al 22 de mayo 2018 se han realizado evaluaciones teóricas y prácticas del proceso de certificación profesional en coordinación con el Instituto Tecnológico Superior Luis Arboleda Martínez y las organizaciones pesqueras de la caleta Bahía De Caráquez del cantón Sucre, Provincia Manabí, certificando las capacidades de 34 Pescadores Artesanales.', 'http://www.acuaculturaypesca.gob.ec/subpesca4798-map-certifica-a-segunda-promocion-de-pescadores-artesanales.html', '2018-05-22 04:49:00', 'San Lorenzo, del cantón de Manta, provincia de Manabí', 35, '2.	EL MINISTERIO DE ACUACULTURA Y PESCA (MAP) REALIZÓ EL VIERNES LA GRADUACIÓN POR CERTIFICACIÓN DE COMPETENCIAS LABORALES, CON EL PERFIL DE PESCA ARTESANAL, DE 78 PESCADORES DE SAN LORENZO, SANTA MARIANITA, LIGÜIQUI Y LAS PIÑAS. ESTA INICIATIVA ES PARTE DE LOS ESFUERZOS DE LA INSTITUCIÓN PARA FORTALECER LA FORMACIÓN PROFESIONAL DEL SECTOR PESQUERO ARTESANAL MEDIANTE PROGRAMAS DE TRANSFERENCIA DE CONOCIMIENTOS.\r\nLOS 78 GRADUADOS, ENTRE HOMBRES Y MUJERES, FORMAN PARTE DEL PROGRAMA QUE LIDERA EL MAP EN MANABÍ EN COLABORACIÓN CON EL INSTITUTO TECNOLÓGICO SUPERIOR “LUIS ARBOLEDA MARTÍNEZ” (ITSLAM), QUE, TRAS UNA EVALUACIÓN EN TEORÍA Y PRÁCTICA A LOS INTERESADOS, PERMITE RECONOCER DE MANERA OFICIAL LAS HABILIDADES, CONOCIMIENTOS, ACTITUDES Y DESTREZAS EN EL PERFIL PESCA ARTESANAL EN LA SENECYT POR UN PERIODO DE 5 AÑOS.', '1527112635-infome_semanal_del_16_al_22_de_mayo_2018_certificación_profesional.pdf', '2018-05-23 21:49:59', '2018-05-23 21:57:15', 11, 'Presidencia'),
(190, 2, '3.	MAP suscribe convenio interinstitucional para reforzar acciones en la lucha contra la pesca ilegal', 'Con el propósito de aunar esfuerzos para establecer acciones integradas en la lucha contra la pesca ilegal no declarada y no reglamentada (INDNR), el Ministerio de Acuacultura y Pesca suscribió un convenio con la Subsecretaria de Puertos y Transporte Marítimo y Fluvial, el mismo que permitirá el intercambio de información respecto a las operaciones de las embarcaciones pesqueras nacionales o internacionales en puertos ecuatorianos.', 'https://twitter.com/jorgemcostain/status/997541129900974080', '2018-05-22 04:53:00', 'Manta, Ministerio de Acuacultura y Pesca', 100, '3.	COMO MEDIDA ANTE LA LUCHA CONTRA LA PESCA ILEGAL NO DECLADARA Y NO REGLAMENTADA A NIVEL NACIONAL EL MINISTERIO DE ACUACULTURA Y PESCA FIRMÓ UN CONVENIO CON LA SUBSECRETARIA DE PUERTOS Y TRANSPORTE MARÍTIMO Y FLUVIAL, PARA REALIZAR EL INTERCAMBIO DE INFORMACIÓN RESPECTO A LAS OPERACIONES DE LAS EMBARCACIONES PESQUERAS NACIONALES O INTERNACIONALES EN PUERTOS ECUATORIANOS.\r\n\r\nCOLABORAR CON MECANISMOS EFECTIVOS PERMITIRÁ GARANTIZAR A LOS CONSUMIDORES DEL MUNDO QUE NUESTROS PRODUCTOS DEL MAR, LLEGARÁN A SUS MESAS CON PRÁCTICAS PESQUERAS RESPONSABLES.', '000Ninguno', '2018-05-23 21:53:07', '2018-05-23 21:53:07', 11, 'Presidencia'),
(191, 3, 'Informe favorable de los contratos de inversión para las empresas Tiendas Industriales Asociadas y DIFARE bajo criterio consensuado con MCEI y MEF', 'Informe favorable de los contratos de inversión de las empresas TIA y DIFARE con criterio consensuado entre el Ministerio de Economía y Finanzas (MEF), Ministerio de Comercio Exterior e Inversiones (MCEI) y MIPRO para acogerse a los incentivos generales que prevé el COPCI. Estos contratos representan inversiones de US$127 millones y US$30 millones, respectivamente, en un plazo de 10 años. Y prevén generar alrededor de 3.000 plazas de empleo en el caso de TIA y en el caso de DIFARE se mantendrán las plazas de empleo actuales.', 'Subsecretaría de Industrias Intermedias y Finales', '2018-05-16 04:53:00', 'Ministerio de Industrias y Productividad', 100, 'Los informe favorables de los contratos de inversión de las empresas Tiendas Industriales Asociadas (TIA) y DIFARE, bajo criterio consensuado con MCEI y MEF para acogerse a los incentivos generales que prevé el COPCI, incrementará la inversión privada en US$157 millones aproximadamente, la que estará enfocada al desarrollo productivo y generación de 3.000 plazas de empleo, en un plazo de 10 años.', '000Ninguno', '2018-05-23 21:53:41', '2018-05-23 21:53:41', 11, 'Presidencia'),
(192, 2, '4.	Incentivo de alevines', 'El 16 de mayo de 2018, se entregó 10.000 alevines de cachama beneficiando a 12 piscicultores de la Unión de Artesanos Indígenas de Pastaza “INDICHURIS” en la provincia de Pastaza. \r\n\r\nAdicional, en atención a solicitudes realizadas por 5 piscicultores independientes de la misma provincia y comunidad antes mencionada se les dotó con 800 alevines por piscicultor.', 'https://nube.acuaculturaypesca.gob.ec/index.php/s/D1qY9mIhiOu87Kj', '2018-05-22 04:54:00', 'Provincia de Pastaza', 100, '4.	PARA CONTRIBUIR A LA TRANSFORMACIÓN DE LA MATRIZ PRODUCTIVA DEL ECUADOR, SE TRABAJA EN PROYECTOS DE ACUACULTURA Y MARICULTURA EN TODAS LAS PROVINCIAS; INCENTIVANDO LOS CULTIVOS MARINOS.\r\n\r\nEN ESTE CONTEXTO, EL MINISTERIO DE ACUACULTURA ENTREGÓ EL PASADO 16 DE MAYO DE 2018, 10.000 ALEVINES DE CACHAMA BENEFICIANDO A 12 PISCICULTORES DE LA UNIÓN DE ARTESANOS INDÍGENAS DE PASTAZA “INDICHURIS” EN LA PROVINCIA DE PASTAZA.', '000Ninguno', '2018-05-23 21:54:59', '2018-05-23 21:54:59', 11, 'Presidencia'),
(193, 2, '5.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimiento a 138 Pescadores Artesanales en la provincia de Manabí distribuidos en la Caleta Pesquera Puerto Cabuyal, Canoa, Surrones, Coaque, Salinas y Los Ciriales de Machalilla en la FASE I (Manejo de los Recursos Bioacuáticos y Regularización de la Actividad Pesquera Artesanal); En la caleta pesquera Coaque en la FASE II (Asistencia Organizacional Del Sector Pesquero Artesanal); y en la Caleta Pesquera Kilómetro 16 del cantón Sucre en la FASE III (Fomento Productivo Del Sector Pesquero Artesanal).', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-05-22 04:56:00', 'Provincia de Manabí', 28, '5.	A FIN DE CONTRIBUIR CON LA SEGURIDAD DE LOS PESCADORES ARTESANALES DURANTE SUS FAENAS DE PESCA Y DE FOMENTAR PRÁCTICAS DE PESCA RESPONSABLE HACIA EL ENTORNO Y SUS RECURSOS, EL MINISTERIO DE ACUACULTURA Y PESCA REALIZÓ TRANSFERENCIAS DE CONOCIMIENTOS EN TEMAS COMO: MANEJO DE LOS RECURSOS BIOACUÁTICOS Y REGULARIZACIÓN DE LA ACTIVIDAD PESQUERA ARTESANAL.  \r\n\r\nASÍ MISMO SE CUMPLIÓ CON ASISTENCIA ORGANIZACIONAL DEL SECTOR PESQUERO ARTESANAL PARA CONTRIBUIR A LA TRANSFORMACIÓN DE ENTES PRODUCTIVOS A ORGANIZACIONES PESQUERAS ARTESANALES E INDEPENDIENTES, INCENTIVANDO A LA CONFORMACIÓN DE ORGANIZACIONES Y APLICANDO CICLOS DE TALLERES DE FORMACIÓN A LOS CON ENFOQUE DE DERECHOS, GÉNERO Y PRODUCTIVIDAD.\r\n\r\n“TRABAJAMOS EN CONJUNTO PARA ALCANZAR GRANDES METAS Y UNA DE ESAS ES MEJORAR LA CALIDAD DE VIDA DEL SECTOR PESQUERO Y ACUÍCOLA”.', '1527112617-infome_semanal_del_16_al_22_de_mayo_2018_capacitación_integral.pdf', '2018-05-23 21:56:57', '2018-05-23 21:56:57', 11, 'Presidencia'),
(194, 2, '6.	Pescadores artesanales de San Mateo y Jaramijó conmemoran el primer año de gestión del MAP', 'Un grupo de pescadores artesanales de las caletas manabitas de San Mateo y Jaramijó protagonizó el lunes una procesión marítima en homenaje al primer aniversario de creación del Ministerio de Acuacultura y Pesca, reviviendo una de las más antiguas tradiciones de la rica cultura de nuestras comunidades pesqueras. El acto incluyó la visita de las imágenes de “El Señor de los Milagros” y “La Virgen del Mar” en representación de la fe, tradición y devoción que caracterizan a nuestras comunidades asentadas a lo largo del Océano Pacífico y que tienen a la pesca como su modo de vida.\r\n\r\nKatuska Drouet, titular del Ministerio de Acuacultura y Pesca, lideró la jornada ecuménica – cultural junto a representantes del sector pesquero artesanal. El cortejo naval estuvo conformado por más de 20 embarcaciones y partió de manera simultánea con sus patronos desde Jaramijó y San Mateo hasta LA altura de Barbasquillo, para posteriormente ingresar conjuntamente hasta el puerto pesquero de San Mateo, que acoge a la secretaría de Estado.', 'MAP-Dirección de Comunicación', '2018-05-22 04:58:00', 'Provincia de Manabí', 0, '6.	LAS COMUNIDADES, DEDICADAS DESDE HACE SIGLOS A LA PESCA DE MANABÍ CONMEMORARON EL PRIMER AÑO DE LOGROS DEL MINISTERIO DE ACUACULTURA Y PESCA CON UNA PROCESIÓN MARÍTIMA, REVIVIENDO UNA DE LAS MÁS ANTIGUAS TRADICIONES DE LA RICA CULTURA DE NUESTRAS COMUNIDADES PESQUERAS.\r\n\r\nESTE EVENTO SIMBOLIZA LA GRATITUD DE NUESTROS PESCADORES Y NOS COMPROMETE A SEGUIR TRABAJANDO POR CONSEGUIR MEJORES OPORTUNIDADES PARA ESTE SECTOR PRODUCTIVO, NO SÓLO DE MANABÍ SINO DEL PAÍS.', '1527112819-Pescadores artesanales de San Mateo y Jaramijó conmemoran el primer año de gestión del MAP.pdf', '2018-05-23 21:58:58', '2018-05-23 22:00:19', 11, 'Presidencia'),
(195, 3, 'Mesa Técnica de Trabajo 6 - Contenido de Cadmio en Cacao', 'Con fecha 22 de mayo se instaló la mesa técnica de cadmio con la finalidad de presentar una propuesta país sobre niveles máximos de cadmio en chocolate y derivados de cacao ante la implementación del CODEX ALIMENTARIUS en los próximos meses y esto afectaría a las exportaciones de Ecuador.', 'Coordinación General de Direccionamiento Empresarial', '2018-05-23 05:29:00', 'Quito', 10, NULL, '000Ninguno', '2018-05-23 22:29:33', '2018-05-23 22:31:04', 11, 'Presidencia'),
(196, 3, 'Mesa Técnica de Trabajo 6 - Comisión de Trabajo sobre Gestión de Riesgos', 'Se creó la comisión de trabajo para desarrollar un plan de acción para la Mesa Técnica de Trabajo 6 de medios de vida y productividad sobre la base del plan red de la Secretaría de Gestión de Riesgo.', 'Coordinación General de Direccionamiento Empresarial', '2018-05-23 05:37:00', 'Quito', 10, NULL, '000Ninguno', '2018-05-23 22:37:49', '2018-05-23 22:37:49', 11, 'Presidencia'),
(197, 3, 'Redelimitación Zona Franca del Aeropuerto Internacional Mariscal Sucre de Quito', 'Emisión de Decreto Ejecutivo No. 419 que redelimita el espacio de la Zona Franca del Aeropuerto Internacional de Quito “Mariscal Antonio José de Sucre” para el desarrollo de nuevos proyectos productivos a través de la redistribución de espacio territorial.', 'Christian Arias – Director de Promoción de Desarrollo Territorial Industrial', '2018-05-23 06:18:00', 'Quito - Pichincha', 100, 'Con el acompañamiento técnico del Ministerio de Industrias y Productividad, la empresa Pública Metropolitana de Servicios Aeroportuarios y Gestión de Zonas Francas y Regímenes Especiales presentó la solicitud para que se redelimite al área donde funciona la Zona Franca del Aeropuerto Internacional Mariscal Sucre de Quito. Con resolución otorgada por el Consejo Sectorial de la Producción en reunión del 31 de enero de 2018, se aprobó y emitió el dictamen favorable para la exclusión de 205,1 ha, las cuales servirán para que la Empresa Pública Metropolitana de Servicios Aeroportuarios continúen el proceso de constitución del proyecto de ZEDE Quito que comprenderá el desarrollo de actividades industriales y logísticas.', '1527117509-d_419_nuevo_mandato_._20180423162843.pdf', '2018-05-23 23:18:29', '2018-05-23 23:18:29', 11, 'Presidencia'),
(198, 3, 'Proyecto ZEDE QUITO', 'El 22 de mayo de 2018, en el despacho del Ministerio de Industrias y Productividad, se realizó una reunión entre la Econ. Eva García, Ministra de Industrias y Productividad y el alcalde de Quito, Mauricio Rodas, en la cual se realizó el intercambio de información sobre el proyecto ZEDE QUITO y se revisó la hoja de ruta para su conformación.', 'Subsecretaría de Desarrollo Territorial', '2018-05-22 07:01:00', 'Quito', 100, 'EPMSA ha propuesto la constitución de una Zona Especial de Desarrollo Económico colindante a la Zona Franca del Aeropuerto Internacional de Quito “Mariscal Antonio José de Sucre” para el desarrollo de actividades de diversificación industrial y logística, con la finalidad de incrementar la oferta exportable del país y sustitución estratégica de las importaciones, generando empleo de calidad y atrayendo inversión privada nacional y extranjera. El Proyecto estima un área de 205 hectáreas del Distrito Metropolitano de Quito. La Ministra de Industrias y Productividad, Econ. Eva García Fabre, mantuvo una reunión con Mauricio Rodas, Alcalde del Distrito Metropolitano de Quito, con la finalidad de definir las gestiones correspondientes y los próximos pasos que deberán realizarse para continuar con el proceso de conformación del proyecto de la Zona Especial de Desarrollo Económico y sus áreas de influencia.', '1527120070-Quito contará con Zona Especial de Desarrollo Económico.pdf', '2018-05-24 00:01:10', '2018-05-24 00:01:10', 11, 'Presidencia'),
(199, 1, 'Ecuador es un país para invertir', 'Rubén Flores, ministro de Agricultura y Ganadería, al inaugurar la planta de Bakels, destacó la importancia de la inversión local porque genera trabajo, valor agregado local, tejido social productivo que consolida el desarrollo integral de un país. \r\n\r\nBakels es una empresa  extranjera, líder en la elaboración y distribución de insumos  para panaderías y pastelerías,  que está en las ligas globales y que apuesta su inversión en Ecuador. “Esto demuestra que hay seguridad legal, condiciones de infraestructura para hacerlo, gente que cree en el talento nacional, lo que aporta al crecimiento económico de un país”, aseguró Flores.\r\n\r\nCristina Caicedo, gerente general de Bakels en Ecuador, indicó que esta empresa opera por más de 10 años en el país y hoy inaugura su planta de procesamiento con equipos técnicos de vanguardia. “Esto permitirá, con el talento humano calificado sacar nuevos productos con calidad e innovación en menor tiempo para el mundo de la panadería y pastelería, parte básica de la cadena alimenticia de los ecuatorianos”.', 'https://www.agricultura.gob.ec/ecuador-es-un-pais-para-invertir/)', '2018-05-23 12:59:00', 'Planta Bakels, Puembo, Pichincha', 100, 'La inversión local genera trabajo, valor agregado local, tejido social productivo que consolida el desarrollo integral de un país. \r\n\r\nBakels es una empresa  extranjera, líder en la elaboración y distribución de insumos  para panaderías y pastelerías,  que está en las ligas globales y que apuesta su inversión en Ecuador. \r\n\r\nEcuador tiene seguridad legal, condiciones de infraestructura para invertir, gente con  talento nacional, lo que aporta al crecimiento económico de un país.\r\n\r\nBakels opera en Ecuador por más de 10 años con una planta de procesamiento con equipos técnicos de vanguardia.', '000Ninguno', '2018-05-30 17:59:26', '2018-05-30 17:59:26', 12, 'Institucional'),
(200, 1, 'Ministro Rubén Flores participa en Congreso Mundial de la Papa', 'El ministro de Agricultura y Ganadería, Rubén Flores, participa en el X Congreso Mundial de la Papa y XXVIII Congreso de la Asociación Latinoamericana de la Papa (Alap 2018), que se desarrollará hasta el 31 de mayo de 2018 en el Centro de Convenciones de Cusco, en Perú.\r\n\r\nEn este evento se analizarán temas como el papel de la papa en la alimentación del futuro, tratado en Quito a inicios de mayo durante la reunión convocada por el ministro Flores, en la que participaron los ministros  de Agricultura y Desarrollo Rural de Colombia, Juan Guillermo Zuluaga; y, de Agricultura y Riego de Perú, Gustavo Mostajo. A través de este cónclave se retomaron las reuniones andinas.\r\n\r\nEn este encuentro participan más de 800 investigadores, científicos, productores y empresarios de la cadena de valor de la papa, así como representantes de varios gobiernos y de la Asociación Latinoamericana de la Papa (Alap).\r\n\r\nEn la inauguración participó el presidente de Perú, Martín Vizcarra; la vicepresidenta de ese país, Mercedes Aráoz; y, entre los invitados especiales, estuvo el ministro Rubén Flores, el representante del Ministro de Desarrollo Rural y Tierras de Bolivia, además de delegados del Instituto Nacional de Innovación Agraria de Perú (INIA) y de la Alap.', 'https://www.agricultura.gob.ec/ministro-ruben-flores-participa-en-congreso-mundial-de-la-papa/', '2018-05-28 01:01:00', 'Cuzco-Perú', 100, 'El X Congreso Mundial de la Papa y XXVIII Congreso de la Asociación Latinoamericana de la Papa (Alap 2018), se desarrolló del 28  hasta el 31 de mayo de 2018 en el Centro de Convenciones de Cusco, en Perú.\r\n\r\nSe analizaron temas como el papel de la papa en la alimentación del futuro,  la tecnología en papa y tendencias económicas mundiales, el cambio climático y sistemas agroalimentarios de la papa, las tendencias de consumo y mercados, el desarrollo de variedades y biotecnología, los efectos globales del cambio climático para el cultivo de papa, así como el futuro de la biotecnología moderna en el desarrollo varietal de este tubérculo.\r\n\r\nEn este cónclave participaron más de 800 investigadores, científicos, productores y empresarios de la cadena de valor de la papa, así como representantes de varios gobiernos y de la Asociación Latinoamericana de la Papa.', '000Ninguno', '2018-05-30 18:01:07', '2018-05-30 18:01:07', 12, 'Institucional'),
(201, 1, 'Ministro Flores firma convenio para enfrentar plaga que afecta a cítricos', 'El ministro de Agricultura y Ganadería de Ecuador, Rubén Flores, y el ministro de Agricultura y Riego de Perú, Gustavo Mostajo, suscribieron un convenio para enfrentar una plaga que afecta a los cítricos: limones, naranjas y mandarinas.\r\n\r\nMediante este documento, los dos países unen sus esfuerzos para enfrentar al Huanglongbing – HLB, la plaga más destructiva de limones, naranjas y mandarinas, que afecta a la producción de cítricos en varios países.\r\n\r\nEl HLB es transmitido por el insecto diaphorina citri, introducida al Ecuador en 2013, donde se encuentra en etapa de control mientras que en Perú se realiza una vigilancia permanente en la zona norte, donde se presentó un brote del vector en la región Tumbes, que fue extinguido de inmediato.', 'https://www.agricultura.gob.ec/ministro-flores-firma-convenio-para-enfrentar-plaga-que-afecta-a-citricos/', '2018-05-29 01:02:00', 'Cuzco-Perú', 100, 'Ecuador y Perú harán todos los esfuerzos para enfrentar una plaga Huanglongbing – HLB que afecta a los cítricos: limones, naranjas y mandarinas.\r\n\r\nEs la plaga más destructiva de limones, naranjas y mandarinas, que afecta a la producción de cítricos en varios países.\r\n\r\nEl HLB es transmitido por el insecto diaphorina citri, introducida al Ecuador en 2013, donde se encuentra en etapa de control, mientras que en Perú se realiza una vigilancia permanente en la zona norte, donde se presentó un brote del vector en la región Tumbes, que fue extinguido de inmediato.', '000Ninguno', '2018-05-30 18:02:34', '2018-05-30 18:02:34', 12, 'Institucional'),
(202, 1, 'Ministros de Agricultura del Área Andina promoverán el desarrollo de la agricultura familiar', 'Los cinco países del Área Andina ratificaron su compromiso para promover el desarrollo y la competitividad de la agricultura familiar, en el marco del X Congreso Mundial de la Papa, que se efectúa hasta mañana en el Cusco, Perú.\r\n\r\nEn esta cita, los ministros de Agricultura y Riego de Perú, Gustavo Mostajo; de Agricultura y Desarrollo Rural de Colombia, Juan Guillermo Zuluaga; y, de Agricultura y Ganadería de Ecuador, Rubén Flores, acordaron “otorgar una alta prioridad a la Agricultura Familiar dentro de las políticas públicas de agricultura y desarrollo rural”, así como “reconocer los avances en las políticas públicas y los espacios de diálogo”.', 'https://www.agricultura.gob.ec/ministros-de-agricultura-del-area-andina-promoveran-el-desarrollo-de-la-agricultura-familiar/', '2018-05-29 01:03:00', 'Cuzco-Perú', 100, 'En el X Congreso Mundial de la Papa, los cinco países del Área Andina ratificaron su compromiso para promover el desarrollo y la competitividad de la agricultura familiar dentro de las políticas públicas de agricultura y desarrollo rural y los espacios de diálogo, para lo cual suscribieron un convenio.\r\n\r\nColombia presentó los lineamientos estratégicos de política pública para la agricultura campesina familiar y comunitaria; Ecuador, el sello de la agricultura familiar para la comercialización de agroalimentos y Perú la implementación del Plan Nacional de Agricultura Familiar.\r\n\r\nLa agricultura familiar representa alrededor del 60% de la actividad agropecuaria de los países y es la fuente de abastecimiento de alimentos para la población.\r\n\r\nLos países se comprometen a conservar y mantener la biodiversidad de la papa para beneficiar la alimentación y nutrición de las familias, investigar e impulsar políticas públicas y diferenciadas, así como promover la innovación para brindar valor agregado a los productos agropecuarios y forestales.\r\n\r\nUna tercera reunión de ministros de Agricultura del Área Andina se efectuará en agosto, en Bolivia, allí los países presentarán sus experiencias de éxito para el desarrollo agropecuario. Ecuador propondrá la Minga Andina Agropecuaria.', '000Ninguno', '2018-05-30 18:03:53', '2018-05-30 18:03:53', 12, 'Institucional'),
(203, 1, 'Ministro Flores propone que sello de la agricultura familiar  sea la contraparte de certificaciones de sustentabilidad', 'El ministro de Agricultura y Ganadería, Rubén Flores, propuso que el sello de la agricultura familiar que tiene Ecuador se convierta en la contraparte a las certificaciones de sustentabilidad que exigen países que reciben productos ecuatorianos.\r\n\r\nLa propuesta la hizo durante una exposición efectuada en el marco del X Congreso Mundial de la Papa y XXVIII Congreso de la Asociación Latinoamericana de la Papa (Alap 2018), que se desarrollará hasta este 31 de mayo de 2018 en el Centro de Convenciones de Cusco, en Perú.\r\n\r\nEl Ministro consideró que el sello de la agricultura familiar garantiza el origen social de los productos agroalimentarios desde las unidades de producción agrícola familiares.', 'https://www.agricultura.gob.ec/ministro-flores-propone-que-sello-de-la-agricultura-familiar-sea-la-contraparte-de-certificaciones-de-sustentabilidad/', '2018-05-29 01:05:00', 'Cuzco-Perú', 100, 'El sello de la agricultura familiar que tiene Ecuador se convertirá  en la contraparte de las certificaciones de sustentabilidad que exigen países que reciben productos ecuatorianos, \r\nLa agricultura familiar genera alrededor del 70% de los alimentos de la población.\r\nLos países andinos deben generar valor agregado en territorio para dinamizar las economías y hacer sustentable la producción agrícola.\r\nLa agricultura familiar es un sistema productivo que genera empleo, soberanía alimentaria y que, articulado a la economía de escala, se dirige a la exportación y aporta a la agrobiodiversidad.\r\nLa papa tiene de 3 000 a 4 000 variedades que se producen entre Perú, Bolivia y Ecuador \r\nEn Ecuador hay 26 mil productores que generan 32 mil hectáreas de papa.', '000Ninguno', '2018-05-30 18:05:09', '2018-05-30 18:05:09', 12, 'Institucional'),
(204, 3, 'Feria Artesanal  \"Comercio Justo\"', 'El pasado 25 de mayo se realizó la Feria Artesanal \"Comercio Justo\" en la ciudad de el Tena\r\nOrganizado por: \"Maquita\" y el MIPRO.\r\n\r\n-Asistentes: 42 emprendimientos de la provincia de Napo y 1.500 personas visitaron la feria.\r\n-Autoridades que acompañaron en la feria: Dr. Sergio Chacón Prefecto, Sr. Alex Hurtado Gobernador de Napo.\r\n\r\nSe reconoció la gestión del MIPRO como una institución pública que apoya a los \r\nemprendimientos, fortalece la productividad y competitividad en la provincia de Napo.', 'Coordinación zonal 2', '2018-05-25 02:16:00', 'Tena', 100, NULL, '000Ninguno', '2018-05-30 19:16:13', '2018-06-01 01:38:15', 12, 'Presidencia'),
(205, 3, 'Capacitación de Educación Financiera', 'El pasado jueves 24 de mayo de 2018 se realizó el taller de Educación Financiera, dirigido a Micro empresarios, artesanos y  EPS de la provincia de Pastaza.\r\n\r\n-El evento fue organizado por:  Ministerio de Industrias y Productividad, con el apoyo de Cooperativa de Ahorro y Crédito de la Pequeña Empresa de Pastaza.\r\n-Asistentes: 20  Micro  empresarioas, artesanos y  EPS de la provincia \r\n-Se reconoció la gestión del Mipro como  institución pública que apoya al desarrollo productivo de  la provincia.', 'Coordinación zonal 3', '2018-05-24 02:19:00', 'Puyo', 100, NULL, '000Ninguno', '2018-05-30 19:19:49', '2018-06-01 01:39:38', 12, 'Presidencia'),
(208, 3, 'Taller CANVAS', 'El pasado 21 y 22 de mayo de 2018 se efectuó el taller MODELO CANVAS como herramienta de apoyo al modelo de negocio de los emprendedores de Cotopaxi.\r\n\r\n-El evento fue organizado por:  MIPRO.\r\n-Asistentes: 14 emprendedores\r\n-Se desarrollo una matriz que plasma la idea de negocio de los emprendedores, como una contribución del MIPRO al fomento al emprendimiento.', 'Coordinación zonal 3', '2018-05-22 02:24:00', 'Ambato - Latacunga', 100, NULL, '000Ninguno', '2018-05-30 19:24:07', '2018-06-01 01:40:20', 12, 'Presidencia'),
(209, 3, 'Fortalecimiento para Establecer nuevos emprendimientos del  Programa Habitacional Ceibo Renacer.', 'En Articulación con el Patronato Municipal de Manta, Alianza para el Emprendimiento y la Innovación AEI, CONQUITO y la Secretaría Técnica Plan Toda una Vida, Ministerio de Industrias y Productividad realizó fortalecimiento para generación de nuevas iniciativas empresariales  a 43 familias del Programa habitacional Ceibo Renacer, con el fin de fomentar emprendimientos productivos que permitan mejorar su sostenibilidad económica, en el cantón Manta.', 'Coordinación zonal 4', '2018-05-22 02:26:00', 'Manta', 100, NULL, '000Ninguno', '2018-05-30 19:26:38', '2018-06-01 01:41:56', 12, 'Presidencia'),
(210, 3, 'Inauguración de la Planta Procesadora de Jugo de Ciruela', 'En la comuna Limoncito en presencia de representantes de la Fundación Ing. Agronómo Juan Jose Castello Zambrano y el Subsecretario Mgs. Roberto Esteves, se inauguró la planta de procesamiento, durante el acto solemne se procedió a realizar un recorrido con el personal por las instalaciones; corresponde al convenio Fondepyme Nro. 00063', 'Coordinación zonal 5', '2018-05-23 02:28:00', 'Comuna Limoncito', 90, NULL, '000Ninguno', '2018-05-30 19:28:03', '2018-06-01 01:43:49', 12, 'Presidencia'),
(211, 3, 'Entrega de imagen corporativa', 'Se entregaron diseño de marca  a 8 MIPYMES de la Zona 7.\r\nServicio gratuito institucional a favor de los emprendimientos nacientes, que aportan a la generación de valor agregado en la producción local.', 'Coordinación zonal 7', '2018-05-21 02:30:00', 'Loja', 100, NULL, '000Ninguno', '2018-05-30 19:30:45', '2018-05-30 19:30:45', 12, 'Institucional y Presidencia'),
(212, 2, '1.	MAP y la comisión de la Unión Europea en Ecuador revisaron temas de interés para adquirir Cooperación Internacional', 'La ministra y su equipo de trabajo sostuvieron reunión con la delegación de la Unión Europea en Ecuador, con el objetivo de facilitar el comercio y articular cooperación entre la Unión Europea y Ecuador.', 'https://twitter.com/MinAcuaPescaEc/status/999378147916304384', '2018-05-29 04:07:00', 'Guayaquil', 100, 'EL MINISTERIO DE ACUACULTURA Y PESCA TRABAJA POR UN DESARROLLO INTEGRAL DEL SECTOR PESQUERO. CON ESTE OBJETIVO EN GUAYAQUIL JUNTO A LOS MIEMBROS DE LA UNIÓN EUROPEA DE ECUADOR, SE PASÓ REVISTA DE LA AGENDA QUE SE IMPULSA EN COOPERACIÓN Y COMERCIO.', '000Ninguno', '2018-05-30 21:07:59', '2018-05-30 21:07:59', 12, 'Institucional y Presidencia'),
(213, 2, '2.	Autoridades Internacionales confirmaron el compromiso de combatir la pesca ilegal en Ecuador', 'El Subsecretario de Recursos Pesqueros mantuvo reunión de trabajo en Bruselas con el Director de Gobernanza Internacional de los Océanos y Pesca Sostenible, para dar a conocer el Plan de Acción que el Ministerio de Acuacultura y Pesca elaboró, en función de cumplir con los resultados de la misión 2017, que involucra soluciones viables para los mares y océanos del planeta.\r\nDurante las actividades planificadas con la comisión, los técnicos de la Dirección General de Asuntos Marítimos y Pesca, también conocida como DG MARE, constataron los avances positivos de los procesos implementados por esta cartera de Estado en Ecuador.\r\nEl siguiente paso será la revisión de los aportes de la DGMARE al proyecto de Ley de Acuacultura y Pesca que está en proceso por parte del MAP', 'https://twitter.com/jorgemcostain/status/999712334250725376', '2018-05-29 04:09:00', 'Bruselas', 100, 'EN UN IMPORTANTE ENCUENTRO DE TRABAJO INTERNACIONAL EN BRUSELAS, EL DIRECTOR DE GOBERNANZA INTERNACIONAL DE LOS OCÉANOS Y PESCA SOSTENIBLE Y SU EQUIPO DE TRABAJO RATIFICÓ LOS BUENOS RESULTADOS QUE OBTUVO EL SECTOR PESQUERO DEL ECUADOR EN EL 2017, GRACIAS A UNA IMPORTANTE PARTICIPACIÓN PERMANENTE DEL SECTOR EN EL PLAN DE ACCIÓN, QUE EL MINISTERIO DE ACUACULTURA Y PESCA DEL ECUADOR ELABORÓ EN FUNCIÓN DE CUMPLIR CON LOS RESULTADOS DE LA MISIÓN 2017 QUE INVOLUCRA SOLUCIONES VIABLES PARA LOS MARES Y OCÉANOS DEL PLANETA.', '000Ninguno', '2018-05-30 21:09:43', '2018-05-30 21:28:36', 12, 'Presidencia'),
(214, 2, '3.	Ecuador asegura la sostenibilidad en el largo plazo de la industria del atún', 'La Ministra de Acuacultura y Pesca, aseguró el lunes en Bangkok que los esfuerzos del país se encuentran concentrados en asegurar la sostenibilidad en el largo plazo de la industria del atún, por lo que las políticas y acciones de los sectores público y privado apuntan a conseguir un equilibrio saludable entre el crecimiento sectorial y la preservación del recurso. \r\n\r\nEl pronunciamiento se realizó en el 15ª Conferencia y Exhibición Mundial del Atún INFOFISH 2018 que se desarrolla en la capital tailandesa.', 'http://www.acuaculturaypesca.gob.ec/subpesca4822-ecuador-asegura-la-sostenibilidad-en-el-largo-plazo-de-la-industria-del-atun-drouet.html', '2018-05-29 04:11:00', 'Bangkok, (Tailandia)', 100, 'LA INDUSTRIA ATUNERA DE ECUADOR RATIFICA SU LIDERAZGO MUNDIAL CON INVESTIGACIÓN, INNOVACIÓN Y LA SOSTENIBILIDAD DEL RECURSO EN BANGKOK EN LA XV INFOFISH WORLD TUNA TRADE CONFERENCE.\r\nLA TITULAR DE ESTE CARTERA DE ESTADO ANTE LA PRINCIPAL PREOCUPACIÓN QUE GIRA EN TORNO A LA SOSTENIBILIDAD DE LA INDUSTRIA ASEGURÓ QUE EL ATÚN DEL ECUADOR ES UN PRODUCTO LEGAL, DECLARADO Y REGLAMENTADO.', '1527719399-ECUADOR ASEGURA LA SOSTENIBILIDAD EN EL LARGO PLAZO DE LA INDUSTRIA DEL ATÚN.pdf', '2018-05-30 21:11:07', '2018-05-30 22:29:59', 12, 'Presidencia'),
(215, 2, '4.	MAP fortalece diálogo con el sector pesquero de Manabí', 'En Manta la Ministra de Acuacultura y Pesca (S), se reunió con representantes del sector pesquero artesanal de Manabí para dialogar entorno a iniciativas encaminadas a fortalecer la asociatividad de las organizaciones pesqueras y el trabajo conjunto.', 'https://twitter.com/MinAcuaPescaEc/status/1001246608032485377', '2018-05-29 04:12:00', 'Manta', 100, 'CON EL OBJETIVO DE CONSTRUIR ACCIONES QUE INVOLUCREN UN DESARROLLO JUSTO Y EQUITATIVO EN EL SECTOR PESQUERO, LA MINISTRA DE ACUACULTURA Y PESCA (S), CON LOS REPRESENTANTES DEL SECTOR PESQUERO ARTESANAL DE MANABÍ, ENTORNO A LA ELABORACIÓN DE INICIATIVAS ENCAMINADAS A FORTALECER LA ASOCIATIVIDAD DE LAS ORGANIZACIONES PESQUERAS Y EL TRABAJO CONJUNTO.', '000Ninguno', '2018-05-30 21:12:26', '2018-05-30 21:12:26', 12, 'Institucional y Presidencia'),
(216, 2, '5.	MAP solicitó reforzar acciones de seguridad para el sector pesquero y acuícola', 'La titular de esta cartera de Estado asistió a la sesión ordinaria del Consejo Sectorial de Seguridad, encabezada por las nuevas autoridades del Ministerio de Defensa Nacional para exponer los temas relacionados a la seguridad que se debe reforzar en los sectores pesquero y acuícola.', 'https://twitter.com/KatuskaDrouetEc/status/999440948789760000', '2018-05-29 04:15:00', 'Quito', 100, 'CON EL OBJETIVO DE PROTEGER Y CUIDAR LA VIDA DE LOS ACTORES DE LOS SECTORES PESQUERO Y ACUÍCOLA, QUE DÍA A DÍA TRABAJAN AURDAMENTE POR UNA CONSEGUIR Y MEJORAR SU CALIDAD DE VIDA, LA TITULAR DE ESTA CARTERA DE ESTADO EXPUSO LOS REQUERIMIENTOS EN MATERIA DE SEGURIDAD AL NUEVO CONSEJO SECTORIAL DE SEGURIDAD.\r\nEL GOBIERNO NACIONAL CON ESTOS ENCUENTROS PRETENDE REFORZAR LAS ACCIONES INTERINSTITUCIONALES PARA COMBATIR LA DELICUENCIA.', '000Ninguno', '2018-05-30 21:15:35', '2018-05-30 21:15:35', 12, 'Institucional y Presidencia'),
(217, 2, '6.	Ecuador asegura el cumplimiento de protocolos alimentarios de los productos del mar para mantener relaciones comerciales con Canadá', 'La Subsecretaria de Calidad e Inocuidad, mantuvo reunión de trabajo junto a los delegados de la Agencia Canadiense de Inspección de Alimentos, con el propósito de dar seguimiento al itinerario de inspecciones y sobre todo mantener los permisos de exportación de productos pesqueros y acuícolas a Canadá.', 'https://twitter.com/MinAcuaPescaEc/status/1001187550051135488', '2018-05-29 04:16:00', 'Guayaquil', 20, 'CON LA FINALIDAD DE MANTENER Y CONSERVAR LAS RELACIONES COMERCIALES CON CÁNADA, LA SUBSECRETARIA DE CALIDAD E INOCUIDAD DEL MAP SE REUNIÓ CON LA AGENCIA CANADIENSE DE INSPECCIÓN DE ALIMENTOS PARA MANTENER PERMISOS DE EXPORTACIÓN AL MERCADO DE CANADÁ, BAJO EL CUMPLIMIENTO DEL PROGRAMA DE FORTALECIMIENTO DE SEGURIDAD ALIMENTARIA.', '000Ninguno', '2018-05-30 21:16:44', '2018-05-30 21:16:44', 12, 'Institucional y Presidencia');
INSERT INTO `csp_reportes_hechos` (`id`, `institucion_id`, `tema`, `descripcion`, `fuente`, `fecha_reporte`, `lugar`, `porcentaje_avance`, `lineas_discursivas`, `anexo`, `created_at`, `updated_at`, `periodo_id`, `tipo_comunicacional`) VALUES
(218, 2, '7.	Programa de Capacitación Integral para los Pescadores Artesanales', 'Se realizaron transferencias de conocimiento a 31 Pescadores Artesanales en la provincia de Santa Elena en la Caleta Pesquera Ballenita en la FASE II: Asistencia Organizacional del Sector Pesquero Artesanal.', 'MAP - Dirección de Pesca Artesanal', '2018-05-29 04:18:00', 'Provincia de Santa Elena', 28, 'EL GOBIERNO NACIONAL, A TRAVÉS DEL MINISTERIO DE ACUACULTURA Y PESCA TIENE ENTRE COMPROMISOS CON EL SECTOR PESQUERO ARTESANAL IMPULSAR LA COMPETITIVIDAD Y PRODUCTIVIDAD DEL SECTOR PESQUERO ARTESANAL, ES POR ESTE MOTIVO QUE EL EQUIPO DEL MAP AVANZA POSITIVAMENTE CON UN PORCENTAJE DEL 28% EN LA TRANSFERENCIA DE CONOCIMIENTOS A PESCADORES ARTESANALES A NIVEL NACIONAL.\r\nLA ACTUALIZACIÓN DE CONOCIMIENTOS TÉCNICOS EN CADA PROVINCIA CON ACTIVIDADES PESQUERAS PERMITIRÁ DESARROLLAR HABILIDADES Y CONSTRUIR UN ESTADO MÁS MODERNO', '1527715278-infome_semanal_del_23_al_29_de_mayo_2018_capacitación_integral.pdf', '2018-05-30 21:18:16', '2018-05-30 21:21:18', 12, 'Presidencia'),
(219, 2, '8.	Capacitación de los Servicios que brinda la Dirección de Pesca Artesanal al sector pesquero artesanal del Ecuador', 'El lunes 28 y martes 29 de mayo del año en curso, el Ministerio de Acuacultura y Pesca realizó la capacitación a 122 estudiantes de la Universidad Laica Eloy Alfaro de Manabí, en atención a la vinculación con la sociedad en el sector pesquero. Esta iniciativa es parte de los esfuerzos que realiza la institución, para fortalecer la formación profesional de este sector.', 'MAP – Dirección de Pesca Artesanal', '2018-05-29 04:20:00', 'Manta', 100, 'COMO PARTE DEL CONVENIO SUSCRITO ENTRE EL MINISTERIO DE ACUACULTURA Y PESCA (MAP), Y LA UNIVERIDAD LAICA ELOY ALFARO DE MANABÍ (ULEAM), ESTE LUNES 28 Y MARTES 29 DE MAYO DEL AÑO EN CURSO, EL MINISTERIO DE ACUACULTURA Y PESCA REALIZÓ LA CAPACITACIÓN A 122 ESTUDIANTES QUE SE SUMARARÁN AL PROCESO DE LEVANTAMIENTO DE INFORMACIÓN DEL SECTOR PESQUERO.\r\n ESTA INICIATIVA ES PARTE DE LOS ESFUERZOS QUE REALIZA LA INSTITUCIÓN, PARA FORTALECER LA ACTIVIDAD PESQUERA ARTESANAL EN EL PAIS.', '000Ninguno', '2018-05-30 21:20:02', '2018-05-30 21:22:00', 12, 'Presidencia'),
(220, 3, 'MIPRO prepara y coordina capacitación para la “Rueda de Negocios de Codificación de Productos” en Junio 2018', 'El Ministerio de Industrias y Productividad – MIPRO, a través de la Subsecretaría de MIPYMES y Artesanías, en el marco de las Ruedas de Negocio conjuntas para codificación de productos en cadenas comerciales, coordinó el pasado lunes 28 de mayo de 2018 la transferencia de conocimientos para 40 emprendedores que participarán en la rueda de negocios a realizarse el primero de junio de 2018, en la sala de uso múltiple de la Plataforma Gubernamental de Gestión Financiera ubicada en el norte de la ciudad de Quito.  Dicha capacitación forma parte de un esfuerzo interinstitucional para asegurar un proceso de codificación de productos, efectivo, en cadenas comerciales; y fue impartida por funcionarios del Ministerio de Industrias y Productividad – MIPRO, Superintendencia de Control del Poder de Mercado - SCPM, Agencia Nacional de Regulación, Control y Vigilancia Sanitaria - ARCSA, Servicio Ecuatoriano de Normalización – INEN, Servicio de Rentas Internas del Ecuador – SRI, Agencia de Regulación y Control Fito y Zoosanitario – Agrocalidad, CONQUITO - Agencia de Promoción Económica y GS1.', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '2018-05-30 04:43:00', 'Quito, Agencia de Promoción Económica - CONQUITO, Av. Maldonado Oe1-172 y Carlos María de la Torre.', 100, '40 emprendedores fueron capacitados el pasado lunes 28 de mayo de 2018, en los conocimientos previos para su participación en la “Rueda de Negocios de Codificación de Productos” que se realizará el próximo primero de junio de 2018.', '000Ninguno', '2018-05-30 21:43:21', '2018-06-01 22:27:04', 12, 'Presidencia'),
(221, 3, 'MIPRO apoya a las Mipymes y Unidades Productivas Artesanales, EPS y Emprendedores mediante capacitación sobre canales de comercialización', 'El Ministerio de Industrias y Productividad (MIPRO) a través de la Subsecretaría de Mipymes y Artesanías, el pasado martes 29 mayo de 2018, capacitó alrededor de 70 Mipymes y Unidades Productivas Artesanales, EPS y Emprendedores de la ciudad de Quito, sobre los diversos canales de promoción y comercialización con la temática: ¿Cómo y cuándo ingresar a cadenas de supermercados?. La capacitación se realizó en la Plataforma Gubernamental Norte, en Quito en el marco del cumplimiento del objetivo estratégico institucional: Incrementar el desarrollo de la asociatividad para fortalecer la capacidad de gestión y negociación de MIPYMES, EPS y Unidades Productiva Artesanales, apoyando el emprendimiento productivo y la redistribución de la riqueza.', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '2018-05-30 04:47:00', 'Quito, Sala de Capacitación de la Plataforma Gubernamental de Gestión Financiera. Planta Baja, Av. Amazonas entre La Unión Nacional de Periodistas y Villalengua', 100, 'El pasado martes 29 de mayo, alrededor de 70 Mipymes y Unidades Productivas Artesanales, EPS y Emprendedores de la ciudad de Quito fueron capacitados sobre mecanismos y canales para promoción y comercialización con la temática: ¿Cómo y cuándo ingresar a cadenas de supermercados?', '000Ninguno', '2018-05-30 21:47:20', '2018-06-01 22:20:26', 12, 'Presidencia'),
(223, 3, 'Cooperación Técnica para la realización de la Mesa Técnica de Trabajo 6 control de la fiebre aftosa', 'En la reunión de seguimiento de la Mesa Técnica de Trabajo 6 realizada el miércoles 30 de mayo de 2018, se presentaron los informes del estado actual y se revisaron los compromisos que están pendientes por parte de las instituciones participantes, se realizará en los próximos días una campaña de vacunación para prevenir los brotes de fiebre aftosa.', 'Coordinación General de Direccionamiento Empresarial', '2018-05-30 06:50:00', 'Quito', 15, NULL, '000Ninguno', '2018-05-30 23:50:03', '2018-06-01 18:59:35', 12, 'Institucional'),
(224, 3, 'Cooperación Técnica para análisis del contenido de cadmio en chocolate de exportación', 'En reunión realizada el martes 29 de mayo se dio a conocer la postura país que se aprobó en Bruselas y se solicitará a los representantes de Anecacao alinearse a dicha postura.  Se ha programado una reunión con Anecacao para el viernes 1 de junio.', 'Coordinación General de Direccionamiento Empresarial', '2018-05-30 06:53:00', 'Quito', 20, NULL, '000Ninguno', '2018-05-30 23:53:13', '2018-06-01 19:01:37', 12, 'Institucional'),
(225, 3, 'Cooperación Técnica para la elaboración del plan de acción de la Mesa Técnica de Trabajo 6', 'Con fecha 29 de mayo se realizó la reunión de la comisión asignada para la elaboración de la propuesta del plan de respuesta y reactivación de la Mesa Técnica de Trabajo 6 de Gestión de Riesgo \"Medios de Vida y Productividad\" a fin de construir una propuesta conjunta que deberá ser presentada en la próxima reunión de esta mesa técnica que esta programada para el 06 de junio.', 'Coordinación General de Direccionamiento Empresarial', '2018-05-30 06:56:00', 'Quito', 50, NULL, '000Ninguno', '2018-05-30 23:56:33', '2018-05-30 23:59:21', 12, 'Institucional'),
(226, 3, 'MIPRO coopera con la CAMICON y expone Registro de Producción Nacional y Valor Agregado Nacional', 'Participación de la señora Ministra de Industrias y Productividad en la inauguración del X Congreso de la Construcción, Infraestructura y Vivienda organizado por Cámara de la Industria de la Construcción, Camicon, con la participación del Ministro de Desarrollo Urbano y Vivienda, empresas privadas, constructoras, productoras, promotoras, academia, delegados de embajadas, gremios, y entidades públicas, relacionadas con el tema de Vivienda de Interés Social. Se expuso el Registro de Producción Nacional y se invita a sumarse a las empresas registradas en el Mipro para el cálculo del Valor Agregado Nacional, VAN, conforme Acuerdo 18 027.', 'Coordinador General de Servicios para la Producción, Juan Francisco Ballén', '2018-05-30 07:45:00', 'Quito, Hotel Hilton Colón', 100, 'El Ministerio de Industrias y Productividad, apoyando fuertemente al Programa Casa para Todos, participó en la difusión del sistema de Registro de Producción Nacional que permite el cálculo del Valor Agregado Nacional, en cumplimiento de la política nacional y la nueva política industrial (en construcción): “Garantizar la participación de la industria nacional dentro del Programa”.', '000Ninguno', '2018-05-31 00:45:26', '2018-06-01 22:13:25', 12, 'Presidencia'),
(228, 3, 'Lanzamiento de la campaña: “Ni una guagua menos”', 'El pasado 01 de junio de 2018 en la ciudad del Puyo se realizó  la campaña ni una guagua menos, el evento fue  organizado por el MIES, con el apoyo del MIPRO\r\nasistentes: 1500 personas\r\nSe reconoció al Mipro como institución que apoya en al cumplimiento de los derechos de los niños', 'Coordinación zonal 3', '2018-06-01 09:43:00', 'Puyo', 100, NULL, '000Ninguno', '2018-06-05 14:43:13', '2018-06-05 14:43:13', 13, 'Institucional y Presidencia'),
(229, 3, 'Encuentro  productivo territorial', 'El pasado 29 de mayo de 2018 se desarrolló el Encuentro Productivo Territorial con la distinguida participación de la Ministra de Industrias y Productividad, Eva García y  empresarios de la Zona 3.                                                                    \r\n\r\n-El evento fue organizado por el MIPRO                                                                                                                        \r\n -Asistentes: 128 participantes                                                                                                                                  \r\n-Se dio a conocer las actividades realizadas por el MIPRO para  mejorar la producción en el país.', 'Coordinación zonal 3', '2018-05-29 09:44:00', 'Latacunga', 100, NULL, '000Ninguno', '2018-06-05 14:44:57', '2018-06-05 14:44:57', 13, 'Institucional y Presidencia'),
(230, 3, 'Taller Modelo Canvas', 'El pasado 31 de mayo de 2018 se desarrolló un taller sobre el  Modelo de negocio “Canvas”, dirigido a estudiantes de la Universidad Estatal Amazónica \r\n\r\n-El evento organizado por: MIPRO.\r\n-Asistentes: 14 participantes\r\n-Se dio a conocer la estructura del modelo de negocio Canvas, con el objetivo de desarrollar un modelo de negocio en  emprendimientos y negocios establecidos.', 'Coordinación zonal 3', '2018-05-31 09:46:00', 'Puyo', 100, NULL, '000Ninguno', '2018-06-05 14:46:14', '2018-06-05 14:46:14', 13, 'Institucional y Presidencia'),
(231, 3, 'Capacitación en Educación Financiera', 'El pasado 31 de mayo del 2018, se realizó una capacitación sobre educación financiera, dirigida a 40 artesanos  y Mipymes.\r\nCapacitación organizada por el Mirpo en conjunto con la Cooperativa CACPECO', 'Coordinación zonal 3', '2018-05-31 09:48:00', 'Riobamba', 100, NULL, '000Ninguno', '2018-06-05 14:48:49', '2018-06-05 14:48:49', 13, 'Institucional y Presidencia'),
(232, 3, 'Mesas Territoriales Interinstitucionales de Economía Popular y Solidaria', 'En el cantón Portoviejo, se realizó la Segunda Mesa Territorial convocada por Vicepresidencia, a través del IEPS, donde asistieron representantes de organismos estatales de la zona 4; a fin de construir una agenda de trabajo que permita articular las demandas de las organizaciones de Economía Popular y Solidaría de la zona. \r\nEl Mipro aporta con la identificación de las cadenas productivas y  el levantamiento de línea base de los actores.', 'Coordinación zonal 4', '2018-05-30 09:51:00', 'Portoviejo', 100, NULL, '000Ninguno', '2018-06-05 14:51:01', '2018-06-05 14:51:01', 13, 'Institucional y Presidencia'),
(233, 3, 'Taller de Estrategias de Publicidad a bajo costo', 'EL pasado 01 de junio del presente año, se realizó un taller de estrategias de publicidad en articulación con empresa AICELX. \r\nTaller dirigido a 70 personas del sector productivo en el cual se trataron temas como: Importancia de la publicidad, casos de empresas y productos, casos personales de éxito.', 'Coordinación zonal 7', '2018-05-31 09:52:00', 'El Oro', 100, NULL, '000Ninguno', '2018-06-05 14:52:24', '2018-06-05 14:52:24', 13, 'Institucional y Presidencia'),
(234, 2, '1.	MAP realiza seguimiento al cumplimiento de las buenas prácticas en los laboratorios de larvas de camarón', '<p>Con la finalidad de revisar el cumplimiento de las normas de operatividad y regularidad en los laboratorios de larvas de camar&oacute;n, funcionarios del Ministerio de Acuacultura y Pesca junto a otras carteras de Estado como Servicio de Rentas Internas-SRI, Ministerio del Ambiente, Agencia de Regulaci&oacute;n y Control Hidrocarbur&iacute;fero-ARCH y Polic&iacute;a Nacional, realizaron operativos de control en Manta, Puerto Cayo y Jaramij&oacute;.</p>', 'https://twitter.com/MinAcuaPescaEc/status/1002694833822105601', '2018-06-05 02:35:00', 'Provincia de Manabí.', 100, '<p>CON LA FINALIDAD DE PRECAUTELAR LA INDUSTRIA CAMARONERA DEL PA&Iacute;S, EL PRIMERO DE JUNIO FUNCIONARIOS DEL MINISTERIO DE ACUACULTURA Y PESCA JUNTO A OTRAS INSTITUCIONES P&Uacute;BLICAS, REALIZARON UN OPERATIVO DE CONTROL INTERINSTITUCIONAL EN LA ZONA SUR DE MANAB&Iacute;, PARA VERIFICAR EL CUMPLIMIENTO DE TRAZABILIDAD QUE DEBEN DE GESTIONAR LOS LABORATORIOS DE LARVAS DE CAMAR&Oacute;N.</p>\r\n\r\n<p>CON LAS ACCIONES MANCOMUNADAS DE LAS INSTITUCIONES DEL ESTADO, EL GOBIERNO NACIONAL INDUCE AL SECTOR CAMARONERO QUE TODAS LAS ACTIVIDADES DE LA CADENA PRODUCTIVA SEAN DE FORMA REGULARIZADA, Y CON ESTAS ACCIONES LOGRE POSICIONARSE EN EL MERCADO INTERNACIONAL.&nbsp;</p>', '000Ninguno', '2018-06-06 19:35:53', '2018-06-06 19:35:53', 13, 'Institucional y Presidencia'),
(235, 2, '2.	30 embarcaciones artesanales de Manabí recibieron permisos de pesca', '<p>En Manab&iacute;, pescadores de Puerto Cayo y La Boca participaron en la jornada de inspecci&oacute;n de m&aacute;s de 30 embarcaciones artesanales, que realizaron funcionarios del Ministerio de Acuacultura y Pesca, con el fin de regular sus permisos de pesca. La jornada cont&oacute; con la colaboraci&oacute;n de la Armada del Ecuador.</p>', 'https://twitter.com/MinAcuaPescaEc/status/1003102999068205056', '2018-06-05 02:43:00', 'Provincia de Manabí', 100, '<p>CON EL OBJETIVO DE REGULARIZAR LA ACTIVIDAD PESQUERA ARTESANAL, AS&Iacute; COMO LA LABOR DE LOS COMERCIANTES MINORISTAS Y MAYORISTAS EN CADA PROVINCIA, EL MINISTERIO DE ACUACULTURA Y PESCA ENTREG&Oacute; PERMISOS A M&Aacute;S DE 30 EMBARCACIONES ARTESANALES DE PUERTO CAYO Y LA BOCA.</p>\r\n\r\n<p>CADA JORNADA DE INSPECCI&Oacute;N QUE LOS FUNCIONARIOS DEL MAP REALIZAN ANTES DE OTORGAR LOS PERMISOS DE PESCA, PERMITE QUE LOS ACTORES DE ESTA IMPORTANTE CADENA UTILICEN CORRECTAMENTE LOS RECURSOS NATURALES DEL PA&Iacute;S.</p>', '000Ninguno', '2018-06-06 19:43:23', '2018-06-06 19:43:23', 13, 'Institucional y Presidencia'),
(236, 2, '3.	MAP fortalece Cooperación Bilateral con Corea', '<p>Con el prop&oacute;sito de mejorar los procesos para asegurar la inocuidad de productos de pesca y acuacultura para exportaci&oacute;n, la embajada de Corea del Sur entreg&oacute; el martes 05 de mayo de 2018, en la ciudad de Guayaquil al Ministerio de Acuacultura y Pesca una donaci&oacute;n de equipos para los laboratorios de la instituci&oacute;n, con lo que se refuerza la transferencia de tecnolog&iacute;a orientada a la gesti&oacute;n de seguridad alimentaria. La entrega forma parte de las activas relaciones con el pa&iacute;s asi&aacute;tico.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Entre los equipos donados por el Gobierno de Corea se encuentran los siguientes:</p>\r\n\r\n<ul>\r\n	<li>2 centr&iacute;fugas</li>\r\n	<li>3 balanzas Anal&iacute;ticas</li>\r\n	<li>1 analizador de Geles (Foto documentador)</li>\r\n	<li>1 auto evaporador</li>\r\n	<li>2 espectrofot&oacute;metro UV</li>\r\n	<li>1 equipo de almacenamiento (Ultra congelador)</li>\r\n	<li>1 generador de Nitr&oacute;geno</li>\r\n</ul>', 'https://bit.ly/2szgrbM', '2018-06-05 02:50:00', 'Guayaquil', 100, '<p>LA TRANSFERENCIA DE TECNOLOG&Iacute;A ES UNO DE LOS PRINCIPALES PILARES DEL ACUERDO ENTRE AMBAS INSTITUCIONES, LA CUAL PERMITIR&Aacute; FORTALECER LOS PROCESOS DE CONTROL DE LA INOCUIDAD DE LOS PRODUCTOS DE PESCA Y ACUACULTURA PARA BRINDAR SERVICIO DE CALIDAD DEL SECTOR EXPORTADOR.</p>\r\n\r\n<p>ENTRE LOS EQUIPOS DONADOS SE ENCUENTRAN: BALANZAS ANAL&Iacute;TICAS, ANALIZADOR DE GELES, AUTO EVAPORADOR, ESPECTROFOT&Oacute;METRO UV Y EQUIPOS DE ALMACENAMIENTO REFRIGERADO.</p>', '1528314749-Boletin de prensa-Donación COREA.pdf', '2018-06-06 19:50:35', '2018-06-06 19:52:29', 13, 'Institucional y Presidencia'),
(237, 2, '4.	Inicia construcción del Centro de Procesamiento de Camarón en San Vicente', '<p>La Ministra de Acuacultura y Pesca subrogante, asisti&oacute; al cant&oacute;n de San Vicente, de la provincia de Manab&iacute;, para presenciar el inicio de la construcci&oacute;n del centro de procesamiento de camar&oacute;n, obra que representa relevancia para sus habitantes por la generaci&oacute;n de recursos que generar&aacute; para el cant&oacute;n y la reactivaci&oacute;n productiva en las zonas afectas por el terremoto del 16 de abril.</p>\r\n\r\n<p>El proyecto pretende beneficiar a las mujeres de la comunidad e incluirlas en el desarrollo del proyecto, para promover un crecimiento econ&oacute;mico y acelerar un desarrollo sostenible en Manab&iacute;.</p>\r\n\r\n<p>Los actores que financian esta importante obra son el Fondo Italiano Ecuatoriano y otros entes de cooperaci&oacute;n internacional que trabajan por el desarrollo a nivel mundial.</p>', 'https://twitter.com/MinAcuaPescaEc/status/1002006950257848321', '2018-06-05 02:53:00', 'Provincia de Manabí', 100, '<p>LOS PROYECTOS QUE ACELERAR&Aacute;N LA REACTIVACI&Oacute;N PRODUCTIVA DE LOS SECTORES PESQUERO Y ACU&Iacute;COLA DE LAS ZONAS AFECTADAS POR EL TERREMOTO DEL PASADO 16 DE ABRIL, LOGRAN AVANZAR PRONTO, GRACIAS AL RESULTADO DE ALIANZAS LOGRADAS POR DEL MINISTERIO DE ACUACULTURA Y PESCA CON EL FONDO &Iacute;TALO ECUATORIANO PARA EL DESARROLLO SOSTENIBLE (FIEDS), QUIENES A TRAV&Eacute;S DE SU APORTE FINANCIERO PERMITEN FORTALECER INICIATIVAS QUE GENERAN DIN&Aacute;MICA Y SINERGIA DE DESARROLLO EN DETERMINADOS &Aacute;MBITOS SECTORIALES.</p>', '000Ninguno', '2018-06-06 19:53:36', '2018-06-06 19:53:36', 13, 'Institucional y Presidencia'),
(238, 2, '5.	Certificación profesional a los Pescadores Artesanales', '<p>En la segunda fase del proyecto, se realiz&oacute; las evaluaciones te&oacute;ricas y pr&aacute;cticas de 32 pescadores artesanales de la caleta pesquera de Bah&iacute;a de Car&aacute;quez como parte del proceso de certificaci&oacute;n profesional en coordinaci&oacute;n con el Instituto Tecnol&oacute;gico Superior Luis Arboleda Mart&iacute;nez y las organizaciones pesqueras de los cantones Sucre en la Provincia Manab&iacute;.</p>', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-06-05 02:54:00', 'Provincia Manabí', 36, '<p>LA CERTIFICACI&Oacute;N TIENE POR OBJETIVO RECONOCER FORMALMENTE LAS COMPETENCIAS LABORALES QUE LOS PESCADORES ARTESANALES HAN ADQUIRIDO EN EL MAR, EN UNA ACTIVIDAD MILENARIA QUE ES VITAL PARA LA ECONOM&Iacute;A NACIONAL Y QUE CONTRIBUYE A RATIFICAR EL LIDERAZGO DEL PA&Iacute;S COMO PA&Iacute;S PESQUERO.</p>\r\n\r\n<p>EL MINISTERIO DE ACUACULTURA Y PESCA CON ESTOS ANTECEDENTES, PROMUEVE QUE LAS ACTIVIDADES PESQUERAS Y ACU&Iacute;COLAS SE DESARROLLEN EN FORMA COMPETITIVA, EFICIENTE Y SOSTENIBLE EN EL TIEMPO, PRESERVANDO LOS RECURSOS HIDROBIOL&Oacute;GICOS Y PROTEGIENDO SU AMBIENTE.</p>', '1528314882-infome_semanal_del_30_mayo_al_05_junio_2018_certificación_profesional.pdf', '2018-06-06 19:54:42', '2018-06-06 19:54:42', 13, 'Institucional y Presidencia'),
(239, 2, '6.	Programa de Capacitación Integral para los Pescadores Artesanales', '<p>Se realizaron transferencia de conocimientos a 95 Pescadores Artesanales de las provincias: Manab&iacute;: cant&oacute;n Pedernales, caleta pesquera La Bonilla en la FASE I: Manejo de los Recursos Bioacu&aacute;ticos y Regularizaci&oacute;n de la Actividad Pesquera Artesanal; y de la provincia Guayas: cant&oacute;n Naranjal, caleta pesquera Santa Rosa De Flandes en la FASE II: Asistencia Organizacional Del Sector Pesquero Artesanal.</p>', 'MAP – Dirección de Pesca Artesanal', '2018-06-05 02:55:00', 'Provincia de Manabí y Guayas', 30, '<p>FORTALECER LAS CAPACIDADES DE LOS PESCADORES ARTESANALES, MEDIANTE CAPACITACIONES PERMANENTES, PARA ELEVAR SUS NIVELES DE CONOCIMIENTO, PRODUCTIVIDAD Y CONSERVACI&Oacute;N DURANTE SUS ACTIVIDADES DE PESCA ES UNA DE LAS PRIORIDADES DEL GOBIERNO NACIONAL.</p>\r\n\r\n<p>POR ESTE MOTIVO SE REALIZARON TRANSFERENCIA DE CONOCIMIENTOS A 95 PESCADORES ARTESANALES DE LAS PROVINCIAS DE MANAB&Iacute; Y GUAYAS CON TEMAS SOBRE EL MANEJO DE LOS RECURSOS BIOACU&Aacute;TICOS, REGULARIZACI&Oacute;N DE LA ACTIVIDAD PESQUERA ARTESANAL Y ASISTENCIA ORGANIZACIONAL PARA FAVORECER AL SECTOR PESQUERO ARTESANAL.</p>', '1528314959-infome_semanal_del_30_mayo_al_05_junio_2018_capacitación_integral.pdf', '2018-06-06 19:55:59', '2018-06-06 19:55:59', 13, 'Institucional y Presidencia'),
(240, 2, '7.	Programa “Mis Mariscos Listos y Mixtos”', '<p>El jueves 31 de mayo se mantuvo reuni&oacute;n con los socios de la red de tiendas de Manta que agrupa a 80 locales de ventas de productos de consumos masivos para la inserci&oacute;n de mariscos congelados de las 7 organizaciones que participan del programa &ldquo;Mis Mariscos Listos y Mixtos&rdquo; de la provincia Manab&iacute;, en atenci&oacute;n a la vinculaci&oacute;n con la empresa privada en la comercializaci&oacute;n de productos con agregaci&oacute;n de valor del sector pesquero. Esta iniciativa es parte de los esfuerzos que realiza la instituci&oacute;n, para fortalecer la cadena productiva con valor agregado de los productos del sector pesquero artesanal<strong>.</strong></p>', 'MAP – DIRECCIÓN DE PESCA ARTESANAL', '2018-06-05 02:58:00', 'Provincia Manabí', 0, '<p>EN ATENCI&Oacute;N A LA VINCULACI&Oacute;N QUE EL GOBIERNO NACIONAL MANTIENE CON LA EMPRESA PRIVADA, EL MAP MANTUVO UNA PRODUCTIVA REUNI&Oacute;N CON LOS SOCIOS DE LA RED DE TIENDAS DE MANTA, QUE AGRUPA A 80 LOCALES DE VENTAS DE PRODUCTOS DE CONSUMOS MASIVOS PARA LA INSERCI&Oacute;N DE MARISCOS CONGELADOS DE&nbsp; 7 ORGANIZACIONES QUE PARTICIPAN DEL PROGRAMA &ldquo;MIS MARISCOS LISTOS Y MIXTOS&rdquo; DE LA PROVINCIA MANAB&Iacute;, &nbsp;CON LA FINALIDAD DE APOYAR Y FORTALECER LA CADENA PRODUCTIVA CON VALOR AGREGADO DE LOS PRODUCTOS DEL SECTOR PESQUERO ARTESANAL.</p>\r\n\r\n<p>LOS PRODUCTOS PESQUEROS DEL PROGRAMA MIS MARISCOS LISTOS Y MIXTOS SON PROCESADOS EN LA PLANTA PILOTO, DEL MINISTERIO DE ACUACULTURA Y PESCA (MAP) QUE FUNCIONA EN EL PUERTO PESQUERO ARTESANAL DE SAN MATEO; DONDE LOS EMPRENDEDORES RECIBEN CAPACITACI&Oacute;N Y ASISTENCIA T&Eacute;CNICA PERMANENTE EN TEMAS DE MARKETING Y COMERCIALIZACI&Oacute;N, BUENAS PR&Aacute;CTICAS DE MANUFACTURAS Y VALOR AGREGADO A LOS PRODUCTOS DE LA PESCA ARTESANAL, ENTRE OTROS.</p>', '1528315102-ACTA DE REUNION RUEDA DE TIENDA.pdf', '2018-06-06 19:58:22', '2018-06-06 19:58:22', 13, 'Institucional y Presidencia'),
(241, 2, '8.	Plan de Electrificación para el Sector Camaronero', '<p>El Ministerio de Acuacultura y Pesca (MAP) y Ministerio de Electricidad y Energ&iacute;a Renovable (MEER) implementan el &ldquo;Plan de Electrificaci&oacute;n para el Sector Camaronero&rdquo;, con la finalidad de buscar una acuacultura eficiente y sustentable, adem&aacute;s de apoyar al mejoramiento de la competitividad del sector agro-industrial, y contribuir al reemplazo de combustibles derivados de petr&oacute;leo para la generaci&oacute;n de energ&iacute;a el&eacute;ctrica.</p>\r\n\r\n<p>Esta cartera de Estado a trav&eacute;s de la Subsecretar&iacute;a de Acuacultura ha gestionado con el Banco de Desarrollo de Am&eacute;rica Latina (CAF) la cooperaci&oacute;n t&eacute;cnica no Rembolsable de un estudio para levantar la l&iacute;nea base del sector camaronero que describa las estrategias y proceso de transici&oacute;n del cambio de uso de energ&iacute;a.</p>\r\n\r\n<p>En este contexto se ha publicado la propuesta para la contrataci&oacute;n de servicios profesionales para la formulaci&oacute;n del programa &ldquo;Reducci&oacute;n de Emisiones Gases Efecto Invernadero a trav&eacute;s del fortalecimiento de la distribuci&oacute;n y reconversi&oacute;n energ&eacute;tica de la cadena de valor de los sectores productivos del Ecuador&rdquo;.</p>\r\n\r\n<p>La convocatoria se encuentra disponible en el siguiente enlace:</p>\r\n\r\n<p>http://www.acuaculturaypesca.gob.ec/subpesca4846-convocatorias-institucionales.html</p>', 'http://www.acuaculturaypesca.gob.ec/subpesca4846-convocatorias-institucionales.html', '2018-06-05 02:59:00', 'Guayaquil', 47, '<p>CON LA FINALIDAD DE BUSCAR UNA ACUACULTURA EFICIENTE Y SUSTENTABLE, ADEM&Aacute;S DE APOYAR AL MEJORAMIENTO DE LA COMPETITIVIDAD DEL SECTOR AGRO-INDUSTRIAL, Y CONTRIBUIR AL REEMPLAZO DE COMBUSTIBLES DERIVADOS DE PETR&Oacute;LEO PARA LA GENERACI&Oacute;N DE ENERG&Iacute;A EL&Eacute;CTRICA.</p>\r\n\r\n<p>ESTA CARTERA DE ESTADO JUNTO A EL BANCO DE DESARROLLO DE AM&Eacute;RICA LATINA (CAF) GESTIONA LA COOPERACI&Oacute;N T&Eacute;CNICA NO REMBOLSABLE DE UN ESTUDIO PARA LEVANTAR LA L&Iacute;NEA BASE DEL SECTOR CAMARONERO QUE DESCRIBA LAS ESTRATEGIAS Y PROCESO DE TRANSICI&Oacute;N DEL CAMBIO DE USO DE ENERG&Iacute;A.</p>\r\n\r\n<p>EN ESTE CONTEXTO SE HA PUBLICADO LA PROPUESTA PARA LA CONTRATACI&Oacute;N DE SERVICIOS PROFESIONALES PARA LA FORMULACI&Oacute;N DEL PROGRAMA &ldquo;REDUCCI&Oacute;N DE EMISIONES GASES EFECTO INVERNADERO, A TRAV&Eacute;S DEL FORTALECIMIENTO DE LA DISTRIBUCI&Oacute;N Y RECONVERSI&Oacute;N ENERG&Eacute;TICA DE LA CADENA DE VALOR DE LOS SECTORES PRODUCTIVOS DEL ECUADOR&rdquo;.</p>', '1528315248-Convocatoria Institucional.pdf', '2018-06-06 19:59:30', '2018-06-06 20:00:48', 13, 'Institucional y Presidencia'),
(242, 2, '9.	MAP conmemoró el día del niño con actividades que reafirman el compromiso del Gobierno Nacional', '<p>En el marco del D&iacute;a del Ni&ntilde;o, la Ministra subrogante, comparti&oacute; un emotivo encuentro con los ni&ntilde;os de la Casa de Acogida Hogar de Bel&eacute;n en Portoviejo, provincia de Manab&iacute;, en donde a trav&eacute;s de actividades l&uacute;dicas y recreativas la autoridad reafirm&oacute; el compromiso del presidente Len&iacute;n Moreno, en trabajar en los derechos y pol&iacute;ticas del desarrollo integral de la ni&ntilde;ez y adolescencia.</p>', 'https://twitter.com/MinAcuaPescaEc/status/1002352010988064768', '2018-06-05 03:01:00', 'Portoviejo, Manabí', 93, '<p>PARA CELEBRAR EL D&Iacute;A DEL NI&Ntilde;O, ESTE A&Ntilde;O, EL MINISTERIO DE ACUACULTURA Y PESCA COMPARTI&Oacute; UNA TARDE DE JUEGOS Y RISAS CON LOS NI&Ntilde;OS Y NI&Ntilde;AS DE LA CASA ACOGIDA HOGAR DE BEL&Eacute;N, PARA FORJAR EN CADA UNA DE LAS EMOCIONES DE LOS INFANTES, MENSAJES Y VALORES QUE PERMITIR&Aacute;N CONSTRUIR UN MEJOR FUTURO PARA LA PATRIA.</p>\r\n\r\n<p>A TRAV&Eacute;S DEL DI&Aacute;LOGO, SE LES MENCION&Oacute; LA IMPORTANCIA QUE TIENE EL GOBIERNO NACIONAL POR HACER CUMPLIR TODOS SUS DERECHOS, Y FOMENTAR CON ELLOS A LA HUMANIDAD LAS NOBLES Y PEQUE&Ntilde;AS OBRAS QUE HACEN SIN INTER&Eacute;S, POR EL BIEN A LOS DEM&Aacute;S.</p>', '000Ninguno', '2018-06-06 20:01:48', '2018-06-06 20:01:48', 13, 'Institucional y Presidencia'),
(243, 1, 'MAG y BE presentan el Acuerdo Nacional por el Desarrollo Agropecuario y Rural, y la tarjeta productiva', '<p>Cerca de 1200 productores de Manab&iacute; se congregaron en el Coliseo 3 de Mayo del cant&oacute;n Jipijapa para ser part&iacute;cipes del lanzamiento del Acuerdo Nacional por el Desarrollo Agropecuario y Rural (Andar), fruto de los di&aacute;logos iniciados el a&ntilde;o anterior como parte de la pol&iacute;tica establecida por el presidente Len&iacute;n Moreno Garc&eacute;s.</p>\r\n\r\n<p>Mediante este acuerdo, el sector agropecuario busca consolidar la relaci&oacute;n entre productores, as&iacute; como entre los sectores p&uacute;blico y privado para lograr el despegue agr&iacute;cola con la fuerza que tiene, dijo Rub&eacute;n Flores, ministro de Agricultura y Ganader&iacute;a, y Presidente del Directorio de BanEcuador.</p>\r\n\r\n<p>&ldquo;Es importante garantizar m&aacute;rgenes de ganancia que permitan ganar a todos y vivir dignamente&rdquo;, afirm&oacute; el Ministro, quien tambi&eacute;n se refiri&oacute; a los avances que tiene la Gran Minga Agropecuaria en el pa&iacute;s, estrategia que ofrece productos financieros y no financieros para, de manera articulada, desarrollar el sector agropecuario del pa&iacute;s.</p>', 'https://www.agricultura.gob.ec/mag-y-be-presentan-el-acuerdo-nacional-por-el-desarrollo-agropecuario-y-rural-y-la-tarjeta-productiva/', '2018-05-31 04:47:00', 'Jipijapa Manabí', 100, '<ul>\r\n	<li>Con el Acuerdo Nacional por el Desarrollo Agropecuario y Rural (ANDAR) las dirigencias y las organizaciones saldr&aacute;n fortalecidas, mirando hacia un mismo horizonte, sintiendo las ventajas de tener un pa&iacute;s con una gran perspectiva de desarrollo.</li>\r\n	<li>ANDAR crea conexiones entre industriales, comercializadores, intermediarios, proveedores y peque&ntilde;os productores; es incluyente y participativo para generar&nbsp; productos con valor agregado. El proceso de construcci&oacute;n debe ser el elemento de est&iacute;mulo e inclusi&oacute;n.</li>\r\n	<li>ANDAR ser&aacute; un trabajo grande, movilizador, que demandar&aacute; un esfuerzo de todos para, al fin, labrar, sembrar y cosechar el desarrollo agropecuario nacional.</li>\r\n	<li>Este acuerdo permitir&aacute; dar sostenibilidad al agro, tener un sector econ&oacute;micamente rentable, socialmente justo, ambientalmente responsable y mucho m&aacute;s &eacute;tico.</li>\r\n	<li>La tarjeta productiva es un mecanismo de pago que permite a los productores adquirir kits agropecuarios en las casas comerciales y/o sus establecimientos asociados en territorio, que ser&aacute;n previamente calificados por el Ministerio de Agricultura y Ganader&iacute;a. Tambi&eacute;n facilita para que los agricultores cuenten con recursos durante todo el a&ntilde;o y reciban incentivos por ser buenos pagadores.</li>\r\n</ul>', '000Ninguno', '2018-06-06 21:47:28', '2018-06-06 22:21:38', 13, 'Institucional'),
(244, 1, 'Se desarticula red delictiva que contrabandeaba más de USD 260 mil mensuales en maíz y arroz', '<h4>La captura de una organizaci&oacute;n delictiva dedicada al contrabando de arroz, ma&iacute;z, bicarbonato, licores, entre otros productos, fue motivo para la rueda de prensa que brind&oacute; Rub&eacute;n Flores, ministro de Agricultura y Ganader&iacute;a, junto al general Luis Lara, director Nacional de la Polic&iacute;a Judicial e Investigaciones.</h4>\r\n\r\n<h4><br />\r\nEl operativo se realiz&oacute; en la provincia de Loja, tras el seguimiento y la investigaci&oacute;n realizados por parte de la Polic&iacute;a Judicial y la Unidad de Delitos Aduaneros y Tributarios (UDAT).</h4>\r\n\r\n<h4>Como resultado de esta acci&oacute;n policial se allanaron 11 inmuebles, se detuvo a 10 ciudadanos y se incautaron 3 veh&iacute;culos, USD 4270 en efectivo, una cosedora de fundas para arroz, documentos comerciales, entre otros objetos vinculantes.</h4>\r\n\r\n<p>Seg&uacute;n las investigaciones policiales apuntadas a la estructura delictiva, la organizaci&oacute;n contrabandeaba y movilizaba alrededor de mil quintales de ma&iacute;z y mil quintales de arroz cada semana, con un valor estimado de 17 mil d&oacute;lares y 48 mil d&oacute;lares semanales, respectivamente.</p>', 'https://www.agricultura.gob.ec/se-desarticula-red-delictiva-que-contrabandeaba-mas-de-usd-260-mil-mensuales-en-maiz-y-arroz', '2018-06-01 04:50:00', 'Quito', 100, '<ul>\r\n	<li>\r\n	<h3>La organizaci&oacute;n contrabandeaba y movilizaba alrededor de mil quintales de ma&iacute;z duro y mil quintales de arroz cada semana, con un valor estimado de 17 mil d&oacute;lares y 48 mil d&oacute;lares semanales, respectivamente. El producto extranjero era mezclado con el nacional para poder ser comercializado.</h3>\r\n	</li>\r\n	<li>\r\n	<h3>La organizaci&oacute;n tambi&eacute;n ingresaba de manera ilegal bicarbonato, licores, entre otros productos.</h3>\r\n	</li>\r\n	<li>\r\n	<h3>La captura fue un trabajo articulado entre la Polic&iacute;a Nacional y el Ministerio de Agricultura y Ganader&iacute;a, en la provincia de Loja, tras el seguimiento y la investigaci&oacute;n realizados por parte de la Polic&iacute;a Judicial y la Unidad de Delitos Aduaneros y Tributarios (UDAT).</h3>\r\n	</li>\r\n	<li>\r\n	<h3>Resultado de esta acci&oacute;n policial se allanaron 11 inmuebles, se detuvo a 10 ciudadanos y se incautaron tres veh&iacute;culos, adem&aacute;s de USD 4270 en efectivo, una cosedora de fundas para arroz, documentos comerciales, entre otros objetos vinculantes.</h3>\r\n	</li>\r\n</ul>', '000Ninguno', '2018-06-06 21:50:07', '2018-06-06 22:22:56', 13, 'Institucional'),
(245, 1, 'Ministro Flores pone al consorcio Salinerito como ejemplo de desarrollo integral del ser humano', '<p>Productores de la parroquia Salinas, de la provincia de Bol&iacute;var, ser&aacute;n beneficiados con la entrada en funcionamiento del edificio Queseras de Bol&iacute;var, que la Fundaci&oacute;n Consorcio de Queser&iacute;as Rurales Comunitarias (Funconquerucom) inaugur&oacute; este 1 de junio en el sector de La Floresta, en Quito.</p>\r\n\r\n<p>En este edificio habr&aacute; mayores espacios para comercializar los productos de los 1219 productores de Salinas, que laboran bajo un sistema de econom&iacute;a solidaria, pero especialmente los quesos de las 30 queser&iacute;as que existen en la zona.</p>\r\n\r\n<p>Esas queser&iacute;as generan empleo para alrededor de 3 mil trabajadores, 50 administradores y 30 comerciantes, quienes est&aacute;n involucrados en el procesamiento diario de entre 20 mil y 30 mil litros de leche. Se estima que anualmente el consorcio genera unos USD 8 millones.</p>', 'https://www.agricultura.gob.ec/ministro-flores-pone-al-consorcio-salinerito-como-ejemplo-de-desarrollo-integral-del-ser-humano', '2018-06-01 04:52:00', 'Quito', 100, '<ul>\r\n	<li>La Fundaci&oacute;n Consorcio de Queser&iacute;as Rurales Comunitarias (Funconquerucom) inaugur&oacute; en el sector de La Floresta, en Quito, el edificio&nbsp; Queseras de Bol&iacute;var donde comercializar&aacute; los productos de los 1219 productores de Salinas, parroquia de la provincia de Bol&iacute;var.</li>\r\n	<li>Desde 1970, los productores de Salinas trabajan bajo un sistema de econom&iacute;a solidaria y comunitaria, sistema bajo el que producen embutidos y c&aacute;rnicos; chocolates y confiter&iacute;a; mix de frutas deshidratadas, textiles, adem&aacute;s de aceites esenciales. Se estima que anualmente el consorcio genera unos USD 8 millones.</li>\r\n	<li>En Salinas existen 30 queser&iacute;as que generan empleo para alrededor de 3 mil trabajadores, 50 administradores y 30 comerciantes, quienes est&aacute;n involucrados en el procesamiento diario de entre 20 mil y 30 mil litros de leche.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '000Ninguno', '2018-06-06 21:52:54', '2018-06-06 22:23:52', 13, 'Institucional'),
(246, 3, 'Cooperación técnica para la elaboración del plan de acción de la Mesa Técnica de Trabajo 6', '<p>En reunión del 06 de junio de 2018 se realizó el seguimiento a la Mesa Técnica de Trabajo 6 \"Medios de Vida y Productividad\" para elaboración y aprobación del plan de acción para la gestión de riesgos y respuesta ante eventos, la cual se trabajará con los delegados institucionales de la mesa y luego se presentará a las máximas autoridades para su aprobación.</p>\r\n\r\n<p> </p>\r\n\r\n<p> </p>', 'Coordinación General de Direccionamiento Empresarial', '2018-06-06 05:49:00', 'Quito', 55, NULL, '000Ninguno', '2018-06-06 22:49:15', '2018-06-07 03:02:02', 13, 'Institucional'),
(247, 3, 'Feria por el Día del Niño denominada “Mil Travesuras”.', '<p>El Ministerio de Industrias y Productividad (MIPRO) a trav&eacute;s de la Subsecretar&iacute;a de Mipymes y Artesan&iacute;as, organiz&oacute; la Feria por el D&iacute;a del Ni&ntilde;o denominada &ldquo;Mil Travesuras&rdquo; que se llev&oacute; a cabo el jueves 31 y viernes 1 de junio de 2018 en las instalaciones de la Plataforma Gubernamental Financiera, en Quito.</p>\r\n\r\n<p>El evento cuyo objetivo fue brindar un espacio de promoci&oacute;n y comercializaci&oacute;n de productos enfocados en las ni&ntilde;as y ni&ntilde;os del Ecuador como muestra del emprendimiento productivo en este tipo de sectores cont&oacute; con la participaci&oacute;n de 20 expositores entre Mipymes, Unidades productivas Artesanales y Emprendedores productores de juguetes, confiter&iacute;a, calzado, textiles y accesorios para ni&ntilde;os y ni&ntilde;as; evento en donde adem&aacute;s, se registr&oacute; la generaci&oacute;n de 6 contactos de promesa de futura comercializaci&oacute;n a mediano plazo.</p>', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '2018-06-06 07:20:00', 'Quito, laterales de la Plaza Japón de la Plataforma Financiera Gubernamental, bloque amarillo, situado en la Av. Amazonas, entre Unión de Periodistas y Alfonso Pereira.', 100, '<p>Alrededor de 20 expositores entre Mipymes, Unidades productivas Artesanales y Emprendedores productores de juguetes, confiter&iacute;a, calzado, textiles y accesorios para ni&ntilde;os y ni&ntilde;as participaron en la Feria por el D&iacute;a del Ni&ntilde;o denominada &ldquo;Mil Travesuras&rdquo; que se llev&oacute; a cabo el jueves 31 y viernes 1 de junio de 2018 en las instalaciones de la Plataforma Gubernamental Financiera, en Quito.</p>', '000Ninguno', '2018-06-07 00:20:02', '2018-06-07 00:20:02', 13, 'Institucional'),
(248, 3, 'Rueda de Negocios para Codificación de Productos Edición local Quito', '<p>El Ministerio de Industrias y Productividad &ndash; MIPRO, a trav&eacute;s de la Subsecretar&iacute;a de MIPYMES y Artesan&iacute;as, en el marco de la cooperaci&oacute;n interinstitucional multisectorial organiz&oacute;, la Rueda de Negocios para Codificaci&oacute;n de Productos que se llev&oacute; a cabo el pasado viernes 01 de junio de 2018 en la Sala de Uso M&uacute;ltiple de la Plataforma Gubernamental de Gesti&oacute;n Financiera ubicada en el norte de la ciudad de Quito.</p>\r\n\r\n<p>El evento tuvo enfoque en el sector productivo y empresarial para el desarrollo econ&oacute;mico y comercial de las MIPYMES&nbsp; mediante la realizaci&oacute;n de acciones que promuevan el desarrollo de proveedores y cont&oacute; con la participaci&oacute;n de 34 Mipymes de los diversos sectores productivos como: alimentos y bebidas, bisuter&iacute;a, cosm&eacute;ticos, textil, calzado, y 5 cadenas comercializadoras: T&iacute;a S.A, Farmaenlace, Coral Hipermercados, Consorcio Comercio Justo y Supermercados Santa Mar&iacute;a. Se registraron en total 170 enlaces comerciales. La metodolog&iacute;a&nbsp; aplicada ser&aacute; evaluada para su r&eacute;plica a nivel territorial.</p>\r\n\r\n<p>La Rueda de Negocios tiene por objetivo el promover la diversificaci&oacute;n de mecanismos que incentiven los procesos de formalizaci&oacute;n y agregadores de valor en cuanto a su competitividad dentro de los mercados locales y enfocados a su futura vinculaci&oacute;n en el mercado nacional e internacional; adicionalmente, este evento de acceso a mercados forma parte de un esfuerzo interinstitucional para asegurar un proceso de codificaci&oacute;n de productos efectivo, en cadenas comerciales; y cuenta con el apoyo de la Presidencia de la Rep&uacute;blica, Superintendencia de Control del Poder de Mercado - SCPM, Agencia Nacional de Regulaci&oacute;n, Control y Vigilancia Sanitaria - ARCSA, Servicio Ecuatoriano de Normalizaci&oacute;n &ndash; INEN, Servicio de Rentas Internas del Ecuador &ndash; SRI, Agencia de Regulaci&oacute;n y Control Fito y Zoosanitario &ndash; Agrocalidad, Gobierno Aut&oacute;nomo Descentralizado de la provincia de Pichincha, CONQUITO - Agencia de Promoci&oacute;n Econ&oacute;mica, AEI y GS1.</p>', 'Subsecretaría de MIPYMES y Artesanías, Roberto Estévez Echanique', '2018-06-06 07:21:00', 'Quito, Sala de Uso Múltiple de la Plataforma Gubernamental de Gestión Financiera.', 100, '<p>34 Mipymes y 5 cadenas comercializadoras de los diversos sectores productivos como: alimentos y bebidas, bisuter&iacute;a, cosm&eacute;ticos, textil, calzado, entre otros, participaron el pasado viernes 01 de junio en la Rueda de Negocios para Codificaci&oacute;n de Productos, edici&oacute;n local, organizado por el MIPRO que se llev&oacute; a cabo en la Sala M&uacute;ltiple de la Plataforma Gubernamental de Gesti&oacute;n Financiera, de la ciudad de Quito, generando 170 enlaces comerciales.</p>', '000Ninguno', '2018-06-07 00:21:55', '2018-06-07 00:21:55', 13, 'Institucional y Presidencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_reporte_estados`
--

CREATE TABLE `csp_reporte_estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_reporte_estados`
--

INSERT INTO `csp_reporte_estados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Resuelto', NULL, NULL),
(2, 'No resuelto', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_tipo_agendas`
--

CREATE TABLE `csp_tipo_agendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_agenda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_tipo_agendas`
--

INSERT INTO `csp_tipo_agendas` (`id`, `nombre_tipo_agenda`, `created_at`, `updated_at`) VALUES
(1, 'Actividad', NULL, NULL),
(2, 'Obra', NULL, NULL),
(3, 'Proyecto', NULL, NULL),
(4, 'Reunión', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `csp_tipo_impacto_agendas`
--

CREATE TABLE `csp_tipo_impacto_agendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_impacto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `csp_tipo_impacto_agendas`
--

INSERT INTO `csp_tipo_impacto_agendas` (`id`, `nombre_impacto`, `created_at`, `updated_at`) VALUES
(1, 'Beneficiarios', NULL, NULL),
(2, 'Inversión', NULL, NULL),
(3, 'Generación de Empleo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_publicacions`
--

CREATE TABLE `estado_publicacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_estado_publicacions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'puede ser borrador / publicado / sin publicar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_publicacions`
--

INSERT INTO `estado_publicacions` (`id`, `nombre_estado_publicacions`, `created_at`, `updated_at`) VALUES
(1, 'Publicar', '2018-07-12 14:23:17', '2018-07-12 14:23:17'),
(2, 'Borrador', '2018-07-12 14:23:17', '2018-07-12 14:23:17'),
(3, 'Privado', '2018-07-12 14:23:18', '2018-07-12 14:23:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_solucion`
--

CREATE TABLE `estado_solucion` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_solucion`
--

INSERT INTO `estado_solucion` (`id`, `nombre_estado`, `created_at`, `updated_at`) VALUES
(1, 'En Análisis', '2017-11-21 02:15:59', '2017-11-21 02:15:59'),
(2, 'En Análisis', '2017-11-21 02:15:59', '2017-11-21 02:15:59'),
(3, 'En Desarrollo', '2017-11-21 02:15:59', '2017-11-21 02:15:59'),
(4, 'Finalizado', '2017-11-21 02:15:59', '2017-11-21 02:15:59'),
(5, 'Desestimadas', '2017-11-21 02:15:59', '2017-11-21 02:15:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_ciudadano`
--

CREATE TABLE `evaluacion_ciudadano` (
  `ev_solicitud_id` int(11) DEFAULT NULL,
  `ev_semaforo` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_evento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provincia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre_evento`, `created_at`, `updated_at`, `provincia_id`) VALUES
(1, 'Mesas de Competitividad-Loja', '2017-11-24 00:22:34', '2017-11-24 00:22:34', 12),
(2, 'Mesas de competitividad Loja-Loja', '2017-11-24 00:23:27', '2017-11-24 00:23:27', 12),
(3, 'Mesas de Competitividad Provincial LOJA-Loja', '2017-11-24 00:23:54', '2017-11-24 00:23:54', 12),
(16, 'MESAS DE COMPETITIVIDAD PROVINCIALES CARCHI-Carchi', '2018-01-06 01:46:27', '2018-01-06 01:46:27', 4),
(17, 'MESAS DE COMPETITIVIDAD PROVINCIALES CHIMBORAZO-Chimborazo', '2018-01-06 02:29:21', '2018-01-06 02:29:21', 5),
(18, 'MESAS DE COMPETITIVIDAD PROVINCIALES MANABI-Manabí', '2018-01-06 03:11:16', '2018-01-06 03:11:16', 14),
(19, 'MESA COMPETITIVA PROVINCIAL EL ORO-El Oro', '2018-01-06 04:12:17', '2018-01-06 04:12:17', 7),
(20, 'MESAS DE COMPETITIVIDAD EL ORO-El Oro', '2018-01-06 04:17:30', '2018-01-06 04:17:30', 7),
(21, 'Mesa de Competitividad Esmeraldas-Esmeraldas', '2018-01-06 04:26:08', '2018-01-06 04:26:08', 8),
(22, 'MESA COMPETITIVA PROVINCIAL Esmeraldas-Esmeraldas', '2018-01-06 04:34:48', '2018-01-06 04:34:48', 8),
(23, 'MESAS DE COMPETITIVIDAD PROVINCIALES Esmeraldas-Esmeraldas', '2018-01-06 05:24:58', '2018-01-06 05:24:58', 8),
(24, 'Mesa de Competitividad Imbabura-Imbabura', '2018-01-06 05:31:02', '2018-01-06 05:31:02', 11),
(25, 'MESA COMPETITIVA PROVINCIAL DE LOJA-Loja', '2018-01-06 05:48:34', '2018-01-06 05:48:34', 12),
(26, 'MESA PRODUCTIVA-Tungurahua', '2018-01-08 20:01:38', '2018-01-08 20:01:38', 23),
(27, 'Mesa de Competitividad en Tungurahua-Tungurahua', '2018-01-08 20:07:25', '2018-01-08 20:07:25', 23),
(28, 'Mesa de Comercio Tungurahua-Tungurahua', '2018-01-08 20:11:32', '2018-01-08 20:11:32', 23),
(29, 'MESA PRODUCTIVA -Tungurahua', '2018-01-08 20:39:14', '2018-01-08 20:39:14', 23),
(30, 'MESAS DE COMPETITIVIDAD-Pichincha', '2018-01-11 09:24:34', '2018-01-11 09:24:34', 19),
(31, 'Mesas de Compettitividad Provinciales-Azuay', '2018-01-23 01:00:38', '2018-01-23 01:00:38', 1),
(32, 'MESAS COMPETITIVAS PROVINCIALES -Azuay', '2018-01-23 19:44:08', '2018-01-23 19:44:08', 1),
(33, 'Ministerio de Turismo Bolivar-Bolívar', '2018-02-06 21:39:01', '2018-02-06 21:39:01', 2),
(34, 'Mesa de Agroindustria-Bolívar', '2018-02-07 01:05:58', '2018-02-07 01:05:58', 2),
(35, 'MESAS DE COMPETIVIDAD INDUSTRIA BOLIVAR-Bolívar', '2018-02-07 01:35:12', '2018-02-07 01:35:12', 2),
(36, 'Mesa de Competitividad Provincial-Bolívar', '2018-02-07 01:56:29', '2018-02-07 01:56:29', 2),
(37, 'Consejo Consultivo Productivo Tributario (CCPT)-Nacional', '2018-03-28 22:21:18', '2018-03-28 22:21:18', 25),
(38, 'MESAS COMPETITIVAS PROVINCIALES-Sucumbios', '2018-05-22 23:07:30', '2018-05-22 23:07:30', 22),
(39, 'MESAS COMPETITIVAS PRODUCTIVAS PROVINCIALES-Sucumbios', '2018-05-22 23:18:16', '2018-05-22 23:18:16', 22),
(40, 'MESAS COMPETITIVAS PROVINCIALES-Cañar', '2018-05-23 16:06:22', '2018-05-23 16:06:22', 3),
(41, 'MESAS DE COMPETITIVIDAD-Cañar', '2018-05-23 16:44:40', '2018-05-23 16:44:40', 3),
(42, 'Mesas de Competitividad-Zamora Chinchipe', '2018-05-23 19:34:55', '2018-05-23 19:34:55', 24),
(43, 'MESAS DE COMPETITIVIDAD PROVINCIALES-Zamora Chinchipe', '2018-05-23 19:41:02', '2018-05-23 19:41:02', 24),
(44, 'MESA DE COMPETITIVIDAD-Zamora Chinchipe', '2018-05-23 20:28:42', '2018-05-23 20:28:42', 24),
(45, 'MESA PRODUCTIVA - SANTA ELENA-Santa Elena', '2018-05-23 20:50:03', '2018-05-23 20:50:03', 20),
(46, 'Mesas de competitividad -Santa Elena', '2018-05-23 22:06:25', '2018-05-23 22:06:25', 20),
(47, 'Mesa de Competitividad-Santa Elena', '2018-05-23 22:31:16', '2018-05-23 22:31:16', 20),
(48, 'MESA COMPETITIVIDAD-Santa Elena', '2018-05-23 22:41:26', '2018-05-23 22:41:26', 20),
(49, 'MESAS DE COMPETITIVIDAD-Santa Elena', '2018-05-23 22:43:35', '2018-05-23 22:43:35', 20),
(50, 'MESAS DE COMPETITIVAD CAPITULO SANTA ELENA -Santa Elena', '2018-05-23 22:47:08', '2018-05-23 22:47:08', 20),
(51, 'MESA PRODUCTIVA-Pastaza', '2018-05-23 23:35:02', '2018-05-23 23:35:02', 18),
(52, 'Mesas de Competitividad-Morona Santiago', '2018-05-24 00:26:48', '2018-05-24 00:26:48', 15),
(53, 'MESA COMPETITIVA PROVINCIAL NAPO-Napo', '2018-05-24 14:36:59', '2018-05-24 14:36:59', 16),
(54, 'Mesa Productiva Pastaza-Napo', '2018-05-24 15:25:55', '2018-05-24 15:25:55', 16),
(55, 'MESA PRODUCTIVA-Napo', '2018-05-24 15:37:58', '2018-05-24 15:37:58', 16),
(56, 'Mesas de Competividad-Pichincha', '2018-05-24 16:05:08', '2018-05-24 16:05:08', 19),
(57, '=+[4]Registro!B1-Pichincha', '2018-05-24 16:16:31', '2018-05-24 16:16:31', 19),
(58, 'Mesas Quito-Pichincha', '2018-05-24 16:27:52', '2018-05-24 16:27:52', 19),
(59, 'MESA DE COMPETITIVIDAD -Pichincha', '2018-05-24 16:43:33', '2018-05-24 16:43:33', 19),
(60, 'MESAS DE COMPETITIVAD - LOS RIOS-Los Ríos', '2018-05-24 23:13:24', '2018-05-24 23:13:24', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indice_competitividads`
--

CREATE TABLE `indice_competitividads` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_indice_competitividad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre del pilar del indice',
  `descripcion_indice_competitividad` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'descripcion nombre del pilar del indice',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `indice_competitividads`
--

INSERT INTO `indice_competitividads` (`id`, `nombre_indice_competitividad`, `descripcion_indice_competitividad`, `created_at`, `updated_at`) VALUES
(1, 'Desarrollo Integral de las personas', '(6 Indicadores) Supone que a mayor educación, menor pobreza y menor mortalidad más competitividad', '2018-07-11 21:20:22', '2018-07-11 21:20:22'),
(2, 'Desempeño Económico', '( 9 indicadores) A mayor producción, mayor valor agregado, menor concentración y menor desigualdad; mayor competitividad', '2018-07-11 21:20:22', '2018-07-11 21:20:22'),
(3, 'Empleo', '(4 indicadores) A más empleo, y menor desempleo; mayor competitividad', '2018-07-11 21:20:22', '2018-07-11 21:20:22'),
(4, 'Gestión Empresarial', '(4 indicadores) A mayor cantidad de activos , empresas, industrias y Pymes; mayor competitividad provincial', '2018-07-11 21:20:22', '2018-07-11 21:20:22'),
(5, 'Infraestructura y Localización', 'A mayor cobertura de telefonía, mayor cantidad de vías asfaltadas , menor distancia a puertos y aeropuertos; mayor competitividad', '2018-07-11 21:20:23', '2018-07-11 21:20:23'),
(6, 'Seguridad Jurídica', 'A mayor capacidad de recursos físicos y de personal; y menor cantidad de delitos ; mayor competitividad.', '2018-07-11 21:20:23', '2018-07-11 21:20:23'),
(7, 'Internacionalización y Apertura', 'A mayor capacidad exportadora e inversión mayor competitividad', '2018-07-11 21:20:23', '2018-07-11 21:20:23'),
(8, 'Gestión, Gobiernos e Instituciones', 'A mayor capacidad de recursos físicos y de personal; y menor cantidad de delitos ; mayor competitividad.', '2018-07-11 21:20:23', '2018-07-11 21:20:23'),
(9, 'Mercados Financieros', 'A mayor cantidad de recursos colocados y desembolsados, menor nivel de morosidad y mayor cobertura con sucursales bancarias; mejor competitividad.', '2018-07-11 21:20:24', '2018-07-11 21:20:24'),
(10, 'Recursos Naturales y Ambiente', 'A mayor cantidad de recursos naturales mayor competitividad.', '2018-07-11 21:20:24', '2018-07-11 21:20:24'),
(11, 'Habilitantes de Innovación, Ciencia y Tecnología', 'Mientras más profesionales, cobertura de internet, telefonía celular y número de universidades y carreras universitarias, mayor competitividad', '2018-07-11 21:20:24', '2018-07-11 21:20:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucions`
--

CREATE TABLE `institucions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_institucion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siglas_institucion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `institucions`
--

INSERT INTO `institucions` (`id`, `nombre_institucion`, `siglas_institucion`, `created_at`, `updated_at`) VALUES
(1, 'Ministerio de Agricultura y Ganadería', 'MAG', NULL, NULL),
(2, 'Ministerio de Acuacultura y Pesca', 'MAP', NULL, NULL),
(3, 'Ministerio de Industrias y Productividad', 'MIPRO', NULL, NULL),
(4, 'Secretaria General', 'STR', NULL, NULL),
(5, 'Agencia de Regulación y Control de la Bioseguridad y Cuarentena para Galápagos', 'ABG', '2018-06-08 03:19:37', '2018-06-08 03:19:37'),
(6, 'Agencia de Aseguramiento de la Calidad de los Servicios de Salud y Medicina Prepagada AGR', 'ACESS', '2018-06-08 03:19:37', '2018-06-08 03:19:37'),
(7, 'Agencia de Regulación y Control Fito y Zoosanitario – AGROCALIDAD', 'AGR', '2018-06-08 03:19:37', '2018-06-08 03:19:37'),
(8, 'Empresa Pública Municipal de Agua Potable y Alcantarillado de Chone', 'AGUASCHUNO', '2018-06-08 03:19:37', '2018-06-08 03:19:37'),
(9, 'Asociación de Municipalidades Ecuatorianas', 'AME', '2018-06-08 03:19:37', '2018-06-08 03:19:37'),
(10, 'Agencia Nacional de Regulación y Control de Transporte Terrestre, Tránsito y Seguridad Vial', 'ANT', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(11, 'Autoridad Portuaria de Esmeraldas', 'APE', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(12, 'Autoridad Portuaria de Guayaquil', ' APG', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(13, 'Autoridad Portuaria de Manta', 'APM', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(14, 'Autoridad Portuaria de Puerto Bolívar', 'APPB', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(15, 'Agencia de Regulación y Control del Agua', 'ARCA', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(16, 'Agencia de Regulación y Control Minero', 'ARCOM', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(17, 'Agencia de Regulación y Control de Electricidad', 'ARCONEL', '2018-06-08 03:19:38', '2018-06-08 03:19:38'),
(18, 'Agencia de Regulación y Control de las Telecomunicaciones', 'ARCOTEL', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(19, 'Agencia de Regulación y Control Postal', 'ARCP', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(20, 'Agencia Nacional de Regulación, Control y Vigilancia Sanitaria', 'ARCSA', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(21, 'Agencia de Regulación y Control Hidrocarburífero', 'ARCH', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(22, 'Fuerza Naval', 'ARE', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(23, 'Astilleros Navales Ecuatorianos', 'ASTINAVEEP', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(24, 'Autoridad de Tránsito Mancomunada Centro Guayas', 'ATMCG', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(25, 'BANECUADOR B.P.', 'BANECUADOR', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(26, 'Banco Central del Ecuador', 'BCE', '2018-06-08 03:19:39', '2018-06-08 03:19:39'),
(27, 'Banco de Desarrollo del Ecuador', 'BDE', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(28, 'Banco Ecuatoriano de la Vivienda en liquidación', 'BEVLIQ', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(29, 'Banco del Instituto Ecuatoriano de Seguridad Social', 'BIESS', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(30, 'Banco Nacional de Fomento en Liquidación', 'BNF', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(31, 'Cuerpo de Bomberos de Baños de Agua Santa', 'C.B.B.', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(32, 'Cuerpo de Bomberos del Cantón Cascales', 'CBCC', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(33, 'Cuerpo de Bomberos de Cayambe', 'CBC', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(34, 'Cuerpo de Bomberos del Distrito Metropolitano de Quito', 'CBDMQ', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(35, 'Cuerpo de Bomberos del Cantón Francisco de Orellana', 'CBFO', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(36, 'Cuerpo de Bomberos Municipal de Babahoyo', 'CBM-B', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(37, 'Cuerpo de Bomberos Pedro Moncayo', 'CBPM', '2018-06-08 03:19:40', '2018-06-08 03:19:40'),
(38, 'Cuerpo de Bomberos de Salinas', 'CBS', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(39, 'Corporación Ciudad Alfaro', 'CCA', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(40, 'Casa de la Cultura Ecuatoriana Benjamín Carrión', 'CCE', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(41, 'Comando Conjunto', 'CCFFAA', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(42, 'Empresa Pública Correos del Ecuador', 'CDE-EP', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(43, 'Consejo de Evaluación, Acreditación y Aseguramiento de la Calidad de la Educación Superior', 'CEAACES', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(44, 'Centros de Entrenamiento para el Alto Rendimiento', 'CEAREP', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(45, 'Centro de Educación Continua', 'CEC-EPN', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(46, 'Empresa Pública Centro de Educación Continua', 'EPN CEC-IAEN', '2018-06-08 03:19:41', '2018-06-08 03:19:41'),
(47, 'Corporación Eléctrica del Ecuador', 'CELEC-EP', '2018-06-08 03:19:42', '2018-06-08 03:19:42'),
(48, 'Empresa Pública Coordinadora de Empresas Públicas Municipales de Antonio Ante', 'CEMAA-EP', '2018-06-08 03:19:42', '2018-06-08 03:19:42'),
(49, 'Operador Nacional de Electricidad,', 'CENACE', '2018-06-08 03:19:42', '2018-06-08 03:19:42'),
(50, 'Empresa Eléctrica Regional Centro Sur C.A.', 'CENACE CENTROSUR', '2018-06-08 03:19:42', '2018-06-08 03:19:42'),
(51, 'Consejo de Educación Superior', 'CES', '2018-06-08 03:19:42', '2018-06-08 03:19:42'),
(52, 'Corporación Financiera Nacional B.P.', 'CFN', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(53, 'Consejo De Gobierno De Galápagos', 'CGREG', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(54, 'Centro Interamericano de Artesanías y Artes Populares', 'CIDAP', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(55, 'Consejo Nacional de Competencias', 'CNC', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(56, 'Compañia Nacional de Danza', 'CND', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(57, 'Empresa Eléctrica Pública Estratégica Corporación Nacional de Electricidad CNEL EP', 'CNEL', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(58, 'Consejo Nacional para la Igualdad de Género', 'CNIG', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(59, 'Consejo Nacional para la Igualdad Intergeneracional', 'CNII', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(60, 'Consejo Nacional para la Igualdad de Movilidad Humana', 'CNIMH', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(61, 'Consejo Nacional para la Igualdad de Pueblos y Nacionalidades', 'CNIPN', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(62, 'Corporación Nacional de Telecomunicaciones', 'CNT-EP', '2018-06-08 03:19:43', '2018-06-08 03:19:43'),
(63, 'Consejo Nacional para la Igualdad de Discapacidades', 'CONADIS', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(64, 'Corporación Nacional de Finanzas Populares y Solidarias', 'CONAFIPS', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(65, 'Consejo Nacional de Salud', 'CONASA', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(66, 'Conferencia Plurinacional e Intercultural de Soberanía Alimentaria', 'COPISA', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(67, 'Consejo de Regulación y Desarrollo de la Información y Comunicación', 'CORDICOM', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(68, 'Corporación del Seguro de Depósitos, Fondo de Liquidez y Fondo de Seguros Privados', 'COSEDE', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(69, 'Consejo de Participación Ciudadana y Control Social', 'CPCCS', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(70, 'Comisión de Tránsito del Ecuador', 'CTE', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(71, 'Dirección General de Aviación Civil', 'DGAC', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(72, 'Dirección General del Registro Civil, Identificación y Cedulación', 'DIGERCIC', '2018-06-08 03:19:44', '2018-06-08 03:19:44'),
(73, 'Dirección Nacional de Registro de Datos Públicos', 'DINARDAP', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(74, 'Defensoría Pública', 'DP', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(75, 'Defensoría del Pueblo', 'DPE', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(76, 'Empresa de Agua Potable y Alcantarillado', 'EAPASM', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(77, 'San Mateo', 'EAPA', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(78, 'Instituto para el Ecodesarrollo Regional Amazónico', 'ECORAE', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(79, 'Empresa Eléctrica Azogues C.A.', 'EEA', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(80, 'Empresa Eléctrica Ambato Regional Centro Norte S.A.', 'EEASA', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(81, 'Ecuador Estratégico EP', 'EEEP', '2018-06-08 03:19:45', '2018-06-08 03:19:45'),
(82, 'Electro Generadora del Austro S.A.', 'EEGA', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(83, 'Empresa Eléctrica Provincial Galápagos', 'EEPGSA', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(84, 'Empresa Eléctrica Quito', 'EEQ', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(85, 'Empresa Eléctrica Riobamba S.A.', 'EERSA', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(86, 'Empresa Eléctrica Regional del Sur', 'EERSSA', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(87, 'Fuerza Terrestre', 'EJERCITO', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(88, 'Empresa Eléctrica Provincial Cotopaxi S.A.', 'ELEPCOSA', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(89, 'Empresa Pública Municipal de Agua Potable y Alcantarillado de Daule', 'EMAPAD', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(90, 'Empresa Pública Municipal de Agua Potable y Alcantarillado de Durán', 'EMAPAD-EP', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(91, 'Empresa Municipal de Agua Potable, Alcantarillado y  Saneamiento de Gualaceo ', 'EMAPAS-GEP', '2018-06-08 03:19:46', '2018-06-08 03:19:46'),
(92, 'Empresa Pública Municipal de Agua Potable y Alcantarillado de la Troncal', 'EMAPATEP', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(93, 'Empresa Coordinadora de Empresas Públicas', 'EMCOEP', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(94, 'Empresa Eléctrica Regional Norte', 'EMELNORTE', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(95, 'Empresa Pública Vial de Asfalto y Obras Civiles', 'EMPROVIAL', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(96, 'Empresa Nacional Minera', 'ENAMI', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(97, 'Empresa Pública de Fármacos', 'ENFARMA EP', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(98, 'Empresa Pública de Agua Potable y Alcantarillado de Antonio Ante', 'EPAA-AA', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(99, 'Empresa Pública del Agua', 'EPA', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(100, 'Empresa Pública Aguas de Manta', 'EPAM', '2018-06-08 03:19:47', '2018-06-08 03:19:47'),
(101, 'Empresa Pública Cementera del Ecuador', 'EPCE', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(102, 'Empresa Pública Casa para Todos EP', 'EPCPT', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(103, 'Empresa Pública Municipal de Agua Potable y Alcantarillado y Saneamiento del cantón Calvas', 'EP-EMAPAC', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(104, 'Empresa Pública Municipal Mercado de Productores Agrícolas San Pedro de Riobamba', 'EP-EMMPA', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(105, 'IEmpresa Pública Fábrica Imbabura', 'EPF', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(106, 'Empresa Pública Municipal de Agua Potable y Alcantarillado de Latacunga', 'EPMAPAL', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(107, 'Empresa Pública Municipal de Agua Potable y Alcantarillado de Santo Domingo', 'EPMAPA-SD', '2018-06-08 03:19:48', '2018-06-08 03:19:48'),
(108, 'Empresa Pública Municipal de Agua Potable y Alcantarillado Sanitario del cantón Jipijapa', 'EPMAPAS-J', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(109, 'Empresa Pública De Movilidad De La Mancomunidad De Cotopaxi', 'EPMC', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(110, 'Registro de la Propiedad del Cantón Santo Domingo', 'EPMRPSD', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(111, 'Empresa Pública Municipal de Tránsito de Guayaquil', 'EPMTG', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(112, 'Empresa Pública YACHAY E.P.', 'EPYEP', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(113, 'Empresa Pública Municipal de Telecomunicaciones, Agua Potable, Alcantarillado y Saneamiento  Cuenca', 'ETAPA-EP', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(114, 'Fuerza Aérea Ecuatoriana', 'FA', '2018-06-08 03:19:49', '2018-06-08 03:19:49'),
(115, 'Ferrocarriles del Ecuador Empresa Pública', 'FEEP', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(116, 'Empresa Pública Flota Petrolera Ecuatoriana FLOPEC', 'FLOPEC', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(117, 'Gobierno Autónomo Descentralizado  Municipal del cantón Baños de Agua Santa', 'GADBAS', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(118, 'Gobierno Autónomo Descentralizado Municipal del cantón Cumandá', 'GADCC', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(119, 'Gobierno Autónomo Descentralizado Municipal del Cantón Latacunga', 'GADCL', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(120, 'Gobierno Autónomo Descentralizado Municipal del Cantón Crnel. Marcelino Maridueña', 'GAD-CMM-A', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(121, 'Gobierno Autónomo Descentralizado Municipal del cantón Saquisilí', 'GADCS', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(122, 'Gobierno Autónomo Descentralizado Municipal del cantón Valencia', 'GADCV', '2018-06-08 03:19:50', '2018-06-08 03:19:50'),
(123, 'Gobierno Autónomo Descentralizado Municipal del cantón Huaquillas', 'GADH', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(124, 'Gobierno Autónomo Descentralizado Intercultural del Cantón Cañar', 'GADICC', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(125, 'Gobierno Autónomo Descentralizado Municipal de San Miguel de Ibarra', 'GADI', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(126, 'Gobierno Autónomo Descentralizado Ilustre Municipalidad del Cantón Daule', 'GADIMCD', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(127, 'Gobierno Autónomo Descentralizado  Municipal del cantón Jama', 'GADJAMA', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(128, 'Gobierno Autónomo Descentralizado Municipal del Cantón 24 de Mayo', 'GADM24MAYO', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(129, 'Gobierno Autónomo Descentralizado Municipal de Archidona', 'GADMA', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(130, 'Gobierno Autónomo Descentralizado Municipal del Cantón Ambato', 'GADMA', '2018-06-08 03:19:51', '2018-06-08 03:19:51'),
(131, 'Gobierno Autónomo Descentralizado Municipal del cantón Aguarico', 'GADMCA', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(132, 'Gobierno Autónomo Descentralizado Municipal del cantón Baba', 'GADMCB', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(133, 'Gobierno Autónomo Descentralizado Municipal del cantón Chimbo', 'GADMCCH', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(134, 'Gobierno Autónomo Descentralizado Municipal del Cantón Durán', 'GADMCD', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(135, 'Gobierno Autónomo Descentralizado Municipal del Cantón El Empalme', 'GADMCEE', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(136, 'Gobierno Autónomo Descentralizado  Municipal del cantón Cevallos', 'GADMCEV', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(137, 'Gobierno Autónomo Descentralizado del Cantón Gualaceo', 'GADMCG', '2018-06-08 03:19:52', '2018-06-08 03:19:52'),
(138, 'Gobierno Autónomo Descentralizado Municipal de Cascales', 'GADMC', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(139, 'Gobierno Autónomo Descentralizado Municipal del Cantón Gonzalo Pizarro', 'GADMCGP', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(140, 'Gobierno Autónomo Descentralizado Municipal del cantón Junín', 'GADMCJ', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(141, 'Gobierno Autónomo Descentralizado Municipal del cantón la Concordia', 'GADMCLC', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(142, 'Gobierno Autónomo Descentralizado Municipal del Cantón Manta', 'GADMCMANTA', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(143, 'Gobierno Autónomo Descentralizado del  Cantón  Montalvo', 'GADMCM', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(144, 'Gobierno Autónomo Descentralizado Municipal del Cantón Mejía', 'GADMCM', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(145, 'Gobierno Autónomo Descentralizado Municipal del Cantón Naranjal', 'GADMCN', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(146, 'Gobierno Autónomo Descentralizado Municipal del Cantón Pedro Carbo', 'GADMCPC', '2018-06-08 03:19:53', '2018-06-08 03:19:53'),
(147, 'Gobierno Autónomo Descentralizado Municipal del cantón Pastaza', 'GADMCP', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(148, 'Gobierno Autónomo Descentralizado Municipal del Cantón Puerto Quito', 'GADMCPQ', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(149, 'Gobierno Autónomo Descentralizado Municipal del Cantón Pedro Vicente Maldonado', 'GADMCPVM', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(150, 'Gobierno Autónomo Descentralizado Municipal Del Cantón Quevedo', 'GADMCQ', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(151, 'Gobierno Autónomo Descentralizado  Municipal del cantón Quinindé', 'GADMCQ', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(152, 'Gobierno Autónomo Descentralizado Municipal del Cantón Rocafuerte', 'GADMCR', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(153, 'Gobierno Autónomo Descentralizado Municipal del cantón Sucre', 'GADMCS', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(154, 'Gobierno Autónomo Descentralizado Municipal de Chambo', 'GADMCH', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(155, 'Gobierno Autónomo Descentralizado Municipal de Girón', 'GADMDG', '2018-06-08 03:19:54', '2018-06-08 03:19:54'),
(156, 'Gobierno Autónomo Descentralizado Municipal Francisco de Orellana', 'GADMFO', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(157, 'Gobierno Autónomo Descentralizado del Cantón Mira', 'GADMIRA', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(158, 'Gobierno Autónomo Descentralizado Municipal de Lago Agrio', 'GADMLA', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(159, 'Gobierno Autónomo Descentralizado Municipal del cantón San Francisco de Milagro', 'GADMM', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(160, 'Gobierno Autónomo Descentralizado Municipal de Montúfar', 'GADMM', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(161, 'Gobierno Autónomo Descentralizado  Municipal del cantón Oña', 'GADMO', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(162, 'Gobierno Autónomo Descentralizado Municipal de Pallatanga', 'GADMP', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(163, 'Gobierno Autónomo Descentralizado Municipal de Portovelo', 'GADMP', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(164, 'Gobierno Autónomo Descentralizado Municipal de Portoviejo', 'GADMP', '2018-06-08 03:19:55', '2018-06-08 03:19:55'),
(165, 'Gobierno Autónomo Descentralizado Municipal de Pucará', 'GADMP', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(166, 'Gobierno Autónomo Descentralizado Municipal de Puyango', 'GADMP', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(167, 'Gobierno Municipal del Cantón Putumayo', 'GADMP', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(168, 'Gobierno Autónomo Descentralizado Municipal del Cantón Puerto López', 'GADMPL', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(169, 'Gobierno Autónomo Descentralizado Municipal del cantón Riobamba', 'GADMR', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(170, 'Gobierno Autónomo Descentralizado  Municipal de Santa Ana de Cotacachi', 'GADMSAC', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(171, 'Gobierno  Autónomo Descentralizado Municipal de Santa Cruz', 'GADMSC', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(172, 'Gobierno Autónomo Descentralizado  Municipal San Cristobal de Patate', 'GADMSCP', '2018-06-08 03:19:56', '2018-06-08 03:19:56'),
(173, 'Gobierno Autónomo Descentralizado Municipal de Santo Domingo', 'GADMSD', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(174, 'Gobierno Autónomo Descentralizado Municipal del cantón Salcedo', 'GADMS', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(175, 'Gobierno Autónomo Descentralizado Municipal de Sigchos', 'GADMS', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(176, 'Gobierno Autónomo Descentralizado Municipal de San Miguel de los Bancos', 'GADMSMB', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(177, 'Gobierno Autónomo Descentralizado Municipal San Pedro de Huaca', 'GADMSPH', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(178, 'Gobierno Autónomo Descentralizado Municipal del Cantón Santa Rosa', 'GADMSR', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(179, 'Gobierno Autónomo Descentralizado Municipal de Tena', 'GADMT', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(180, 'Gobierno Autónomo Descentralizado Municipal de San Miguel de Urcuquí', 'GADMU', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(181, 'Gobierno Autónomo Descentralizado Municipal de Pangua', 'GADMUPAN', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(182, 'Gobierno Autónomo Descentralizado Municipal del Cantón Vinces', 'GADMVINCES', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(183, 'Gobierno Autónomo Descentralizado Municipal de Zaruma', 'GADMZ', '2018-06-08 03:19:57', '2018-06-08 03:19:57'),
(184, 'Gobierno Autónomo Descentralizado Parroquial  Rural de Cutuglagua', 'GADPC', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(185, 'Gobierno Autónomo Descentralizado Parroquial Rural de Conocoto', 'GADPRC', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(186, 'Gobierno Autónomo Descentralizado Parroquial Rural de Nuevo Quito', 'GADPRNQ', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(187, 'Gobierno Autónomo Descentralizado Parroquial Rural de Río Corrientes', 'GADPRRC', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(188, 'Gobierno Autónomo Descentralizado  Parroquia Rural San Antonio de Pichincha', 'GADPRSAP', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(189, 'Gobierno Autónomo Descentralizado Provincial de Santa Elena', 'GADPSE', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(190, 'Gobierno Autónomo Descentralizado Municipal de Sígsig', 'GADS-MS', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(191, 'Gobierno Cantonal de Pindal', 'GCP', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(192, 'Empresa Pública de Movilidad del Gobierno Autónomo Descentralizado Municipal del Cantón Gualaceo', 'G-MOVEP', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(193, 'Gobierno Parroquial San Joaquín', 'GPSJ', '2018-06-08 03:19:58', '2018-06-08 03:19:58'),
(194, 'Hospital de Especialidades Fuerzas Armadas N1', 'HE-1', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(195, 'Hidroeléctrica del Litoral HIDROLITORAL EP', 'HLT EP', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(196, 'Instituto Altos Estudios Nacionales', 'IAEN', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(197, 'Instituto de Cine y Creación Audiovisual', 'ICCA', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(198, 'Instituto Espacial Ecuatoriano', 'IEE', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(199, 'Instituto Ecuatoriano de Propiedad Intelectual', 'IEPI', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(200, 'Instituto Nacional de Economía Popular y Solidaria', 'IEPS', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(201, 'Instituto Ecuatoriano de Seguridad Social', ' IESS', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(202, 'Instituto de Fomento de las Artes, Innovación y Creatividades', 'IFAIC', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(203, 'Instituto de Fomento al Talento Humano', 'IFTH', '2018-06-08 03:19:59', '2018-06-08 03:19:59'),
(204, 'Instituto Geográfico Militar', 'IGM', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(205, 'Instituto de Idiomas, Ciencias y Saberes Ancestrales', 'IICSAE', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(206, 'Empresa Pública Ikiam E.P.', 'IKIAMEP', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(207, 'Universidad Regional Amazónica  IKIAM', 'IKIAM', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(208, 'Instituto Nacional de Biodiversidad', 'INABIO', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(209, 'Instituto Antártico Ecuatoriano', 'INAE', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(210, 'Instituto Nacional de Meteorología e Hidrología', 'INAMHI', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(211, 'Instituto Nacional de Donación y Transplantes de Órganos Tejidos y Células', 'INDOT', '2018-06-08 03:20:00', '2018-06-08 03:20:00'),
(212, 'Instituto Nacional de Estadística y Censos', 'INEC', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(213, 'Servicio Ecuatoriano de Normalización', 'INEN', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(214, 'Instituto Nacional de Eficiencia Energética y Energías Renovables', 'INER', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(215, 'Instituto Nacional de Evaluación Educativa', 'INEVAL', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(216, 'Instituto Nacional de Investigaciones Agropecuarias', 'INIAP', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(217, 'Instituto Nacional de Investigación Geológico Minero Metalúrgico', 'INIGEMM', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(218, 'Servicio de Gestión Inmobiliaria del Sector Público', 'INMOBILIAR', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(219, 'Instituto Oceanográfico de la Armada', 'INOCAR', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(220, 'Instituto Nacional de Patrimonio Cultural', 'INPC', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(221, 'Instituto Nacional de Investigación en Salud Pública  INSPI  Dr. Leopoldo Izquieta Pérez', 'INSPI', '2018-06-08 03:20:01', '2018-06-08 03:20:01'),
(222, 'Instituto de Provisión de Alimentos', 'IPA', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(223, 'Infraestructuras Pesqueras del Ecuador, Empresa Pública', 'IPEEP', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(224, 'Sección Nacional del Instituto Panamericano de Geografía e Historia', 'IPGH', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(225, 'Instituto de Seguridad Social de las Fuerzas Armadas', 'ISSFA', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(226, 'Instituto Superior Tecnológico de Artes del Ecuador', 'ITAE', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(227, 'Junta Nacional de Defensa del Artesano', 'JNDA', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(228, 'Jefatura Provincial de Bomberos Loja JRHJunta de Recursos Hidráulicos y Obras Básicas', 'JPBL', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(229, 'Gobierno Autónomo Descentralizado Municipal de Antonio Ante', 'MAA', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(230, 'Ministerio del Ambiente', 'MAE', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(231, 'Ministerio de Coordinación de Conocimiento y Talento Humano', 'MCCTH', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(232, 'Ministerio de Comercio Exterior e Inversiones', 'MCEI', '2018-06-08 03:20:02', '2018-06-08 03:20:02'),
(233, 'Ministerio de Coordinación de la Producción, Empleo y Competitividad', 'MCPEC', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(234, 'Ministerio de Cultura y Patrimonio', 'MCYP', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(235, 'Ministerio Del Interior', 'MDI', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(236, 'Ministerio del Deporte', 'MD', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(237, 'Ministerio de Defensa Nacional', 'MDN', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(238, 'Ministerio del Trabajo', 'MDT', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(239, 'Ministerio de Electricidad y Energía Renovable', 'MEER', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(240, 'Ministerio de Economía y Finanzas', 'MEF', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(241, 'Ministerio de Hidrocarburos', 'MH', '2018-06-08 03:20:03', '2018-06-08 03:20:03'),
(242, 'Ministerio de Coordinación de Seguridad', 'MICS', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(243, 'Ministerio de Desarrollo Urbano y Vivienda', 'MIDUVI', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(244, 'Ministerio de Inclusión Económica y Social', 'MIES', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(245, 'Ministerio de Educación', 'MINEDUC', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(246, 'Ministerio de Telecomunicaciones y de la Sociedad de la Información', 'MINTEL', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(247, 'Ministerio de Justicia, Derechos Humanos y Cultos', 'MJDHC', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(248, 'Mancomunidad de Movilidad Centro Guayas', 'MMCG', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(249, 'Ministerio de Minería', 'MM', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(250, 'Empresa Pública Medios Públicos de Comunicación del Ecuador  Medios Públicos EP', 'MPEP', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(251, 'Ministerio de Relaciones Exteriores y Movilidad Humana', 'MREMH', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(252, 'Ministerio de Salud Pública', 'MSP', '2018-06-08 03:20:04', '2018-06-08 03:20:04'),
(253, 'Ministerio de Turismo', 'MT', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(254, 'Ministerio de Transporte y Obras Públicas', 'MTOP', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(255, 'Mancomunidad de Tránsito de Sucumbíos EP', 'MTS-EP', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(256, 'Operaciones RIO NAPO Compañia de Economía Mixta', 'ORNCEM', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(257, 'Orquesta Sinfónica de Cuenca', 'OSC', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(258, 'Orquesta Sinfónica de Guayaquil', 'OSG', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(259, 'Orquesta Sinfónica Nacional del Ecuador', 'OSNE', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(260, 'Petroamazonas EP', 'PAM', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(261, 'Plan Binacional de Desarrollo de la Región Fronteriza', 'PBDRF', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(262, 'PetroEcuador', 'PETRO', '2018-06-08 03:20:05', '2018-06-08 03:20:05'),
(263, 'Policía Nacional', 'PN', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(264, 'Patronato Provincial de Sucumbios', 'PPASS', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(265, 'Instituto de Promoción de Exportaciones e Inversiones Extranjeras PRO ECUADOR', 'PROECU', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(266, 'Presidencia de la República', 'PR', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(267, 'Empresa Pública Municipal de Pruebas', 'PRUEBAS', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(268, 'Refinería del Pacífico Eloy Alfaro', 'RDP', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(269, 'Revisión Técnica Vehicular RETEVE E.P.', 'RETEVEE.P', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(270, 'Registro Mercantil del cantón Esmeraldas', 'RMCE', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(271, 'Registro Mercantil del cantón Guayaquil', 'RMCG', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(272, 'Registro Mercantil del cantón Cuenca', 'RMC', '2018-06-08 03:20:06', '2018-06-08 03:20:06'),
(273, 'Registro Mercantil del cantón Santo Domingo', 'RMCSD', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(274, 'Registro Municipal de la Propiedad y Mercantil del Cantón Playas', 'RMPCP', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(275, 'Registro Municipal de la Propiedad del Cantón Quevedo', 'RMPQ', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(276, 'Registro Mercantil del cantón Quito', 'RMQ', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(277, 'Registro de la Propiedad y Mercantil del cantón Biblián', 'RPMCB', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(278, 'Registro de la Propiedad y Mercantil del Cantón Pedro Moncayo', 'RPMPM', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(279, 'Registro de la Propiedad y Mercantil del Cantón La Troncal', 'RPYMCLT', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(280, 'Servicio de Acreditación Ecuatoriano', 'SAE', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(281, 'Servicio Aeropolicial', 'SAP', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(282, 'Empresa de Municiones Santa Bárbara', 'SBEP', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(283, 'Superintendencia de Bancos y Seguros', 'SBS', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(284, 'Servicio Ecuatoriano de Capacitación Profesional', 'SECAP', '2018-06-08 03:20:07', '2018-06-08 03:20:07'),
(285, 'Servicio de Contratación de Obras', 'SECOB', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(286, 'Ministerio de Coordinación de los Sectores Estratégicos', 'SE', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(287, 'Servicio Nacional de Aduana del Ecuador', 'SENAE', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(288, 'Secretaría del Agua', 'SENAGUA', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(289, 'Secretaría de Educación Superior, Ciencia y Tecnología', 'SENESCYT', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(290, 'Secretaría Nacional de Planificación y Desarrollo', 'SENPLADES', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(291, 'Superintendencia de Economía Popular y Solidaria', 'SEPS', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(292, 'Servicio Nacional de Contratación Pública', 'SERCOP', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(293, 'Secretaría Técnica de Cooperación Internacional', 'SETECI', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(294, 'Secretaría Técnica del Sistema Nacional de Cualificaciones Profesionales', 'SETEC', '2018-06-08 03:20:08', '2018-06-08 03:20:08'),
(295, 'Secretaría Técnica de Prevención Integral de Drogas', 'SETED', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(296, 'Secretaría Técnica de Juventudes', 'SETEJU', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(297, 'Secretaría de Gestión de Riesgos', 'SGR', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(298, 'Secretaría de Hidrocarburos', 'SH', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(299, 'Secretaría de Inteligencia', 'SIN', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(300, 'Servicio Integrado de Seguridad ECU 911', 'SIS', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(301, 'Secretaría Nacional de Comunicación', 'SNC', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(302, 'Secretaría Nacional de Gestión de la Política', 'SNGP', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(303, 'Servicio Nacional de Medicina Legal y Ciencias Forenses', 'SNMLCF', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(304, 'Servicio Público para Pago de Accidentes de Tránsito', 'SPPAT', '2018-06-08 03:20:09', '2018-06-08 03:20:09'),
(305, 'Servicio de Protección Presidencial', 'SPP', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(306, 'Servicio de Rentas Internas', 'SRI', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(307, 'Secretaría Técnica del Comité Interinstitucional de Prevención de Asentamientos Irregulares', 'STCPAHI', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(308, 'Secretaría Técnica para la Gestión Inclusiva en Discapacidades', 'STD', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(309, 'Secretaría Técnica del Plan Toda una Vida', 'STPTV', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(310, 'Tame Línea Aérea del Ecuador EP', 'TAME', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(311, 'Tribunal Contencioso Electoral', 'TCE', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(312, 'Transportes Navieros Ecuatorianos   TRANSNAVE', 'TNE', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(313, 'Universidad Agraria del Ecuador', 'UAE', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(314, 'Unidad de Análisis Financiero y Económico', 'UAFE', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(315, 'Universidad Estatal Amazónica', 'UEA', '2018-06-08 03:20:10', '2018-06-08 03:20:10'),
(316, 'Universidad Estatal de Bolívar', 'UEB', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(317, 'Empresa Pública La UEMPRENDE', 'UEMPRENDE', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(318, 'Unidad de Gestión y Ejecución de Derecho Público del Fideicomiso AGD  CFN no más Impunidad', 'UGEDEP', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(319, 'Empresa Pública Ingeniería, Materiales y Sistemas UGEP', 'UGEP', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(320, 'Universidad de Guayaquil', 'UG', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(321, 'Universidad de Investigación de Tecnología Experimental Yachay', 'UITEY', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(322, 'Empresa Pública Unidad Nacional de Almacenamiento UNA EP', 'UNAEP', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(323, 'Universidad Estatal de Milagro', 'UNEMI', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(324, 'Universidad Politécnica Estatal del Carchi', 'UPEC', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(325, 'Universidad Técnica Luis Vargas Torres de Esmeraldas', 'UTELVT', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(326, 'Universidad Técnica Estatal de Quevedo', 'UTEQ', '2018-06-08 03:20:11', '2018-06-08 03:20:11'),
(327, 'Universidad Técnica de Manabí', 'UTM', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(328, 'Universidad Técnica del Norte', 'UTN', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(329, 'Vicepresidencia de la República', 'VPR', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(330, 'Vicepresidencia de la República', 'VPR', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(331, 'Gobierno Autonomos Descentralizado', 'GAD', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(332, 'Otras Funciones del Estado', 'OFE', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(333, 'Junta de Agua Potable', 'JAP', '2018-06-08 03:20:12', '2018-06-08 03:20:12'),
(334, 'Junta de Agua Riego', 'JAR', '2018-06-08 03:20:12', '2018-06-08 03:20:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion_usuarios`
--

CREATE TABLE `institucion_usuarios` (
  `id` int(11) NOT NULL,
  `institucion_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `institucion_usuarios`
--

INSERT INTO `institucion_usuarios` (`id`, `institucion_id`, `usuario_id`, `activo`, `created_at`, `updated_at`) VALUES
(1, 3, 75, 0, '2018-08-24 16:02:20', '2018-08-24 16:02:20'),
(3, 10, 81, 0, '2018-08-24 17:40:48', '2018-08-24 17:40:48'),
(4, 253, 89, 0, '2018-08-24 20:20:54', '2018-08-24 20:20:54'),
(5, 251, 99, 0, '2018-08-24 20:31:57', '2018-08-24 20:31:57'),
(6, 238, 90, 0, '2018-08-28 17:10:38', '2018-08-28 17:10:38'),
(7, 290, 87, 0, '2018-08-28 17:12:26', '2018-08-28 17:12:26'),
(8, 238, 393, 0, '2018-08-28 17:47:38', '2018-08-28 17:28:03'),
(9, 201, 403, 0, '2018-09-03 15:42:36', '2018-09-03 15:42:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrumentos`
--

CREATE TABLE `instrumentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_instrumento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `instrumentos`
--

INSERT INTO `instrumentos` (`id`, `nombre_instrumento`, `created_at`, `updated_at`) VALUES
(1, 'uno', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(2, 'Acuerdo', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(3, 'Asistencia técnica', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(4, 'Asociatividad,', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(5, 'Big data', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(6, 'Contratación pública', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(7, 'Convenios ', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(8, 'Desarrollo del proyecto', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(9, 'Ejecución del proyecto', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(10, 'Financiamiento', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(11, 'Incentivos tributarios', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(12, 'Infraestructura', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(13, 'Insumos', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(14, 'Intervención zonal', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(15, 'Inversión ', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(16, 'Ley', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(17, 'Logística', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(18, 'Ordenanzas', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(19, 'Personal adecuado', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(20, 'Política pública', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(21, 'Precios', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(22, 'Recursos asignados', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(23, 'Reglamento', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(24, 'Tecnología', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(25, 'Tratado comercial', '2017-11-10 05:03:08', '2017-11-10 05:03:08'),
(26, 'Constitución', '2017-11-24 10:00:00', '2017-11-24 10:00:00'),
(27, 'Consulta Popular', '2017-11-24 10:00:00', '2017-11-24 10:00:00'),
(28, 'Resolución', '2017-11-24 10:00:00', '2017-11-24 10:00:00'),
(29, 'Capacitación', '2017-11-24 10:00:00', '2017-11-24 10:00:00'),
(30, 'Decreto Ejecutivo', '2017-11-24 10:00:00', '2017-11-24 10:00:00'),
(31, 'Norma Técnica', '2017-11-24 10:00:00', '2017-11-24 10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_mesa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `nombre_mesa`, `created_at`, `updated_at`) VALUES
(1, 'Acuícola', NULL, NULL),
(2, 'Adecuar el marco de contratación laboral a la realidad productiva', NULL, NULL),
(3, 'Agricultura Familiar  y Agroindustrial', NULL, NULL),
(4, 'Agroindustria', NULL, NULL),
(5, 'Arroz', NULL, NULL),
(6, 'Automotriz Motos', NULL, NULL),
(7, 'Banano', NULL, NULL),
(8, 'Cacao', NULL, NULL),
(9, 'Café', NULL, NULL),
(10, 'Camarón, atún, pesca artesanal, otros', NULL, NULL),
(11, 'Caña de azucar', NULL, NULL),
(12, 'Caucho y plástico', NULL, NULL),
(13, 'Comercio', NULL, NULL),
(14, 'Construcción y vivienda', NULL, NULL),
(15, 'Entidades financieras y seguros', NULL, NULL),
(16, 'Flores', NULL, NULL),
(17, 'Ganadería', NULL, NULL),
(18, 'Industria', NULL, NULL),
(19, 'Industrias de electrodomésticos y electrónicos', NULL, NULL),
(20, 'Logística y transporte', NULL, NULL),
(21, 'Madera', NULL, NULL),
(22, 'Maíz, soya, balanceados, avicultura y porcicultura', NULL, NULL),
(23, 'Metalmecánica', NULL, NULL),
(24, 'Minería e hidrocarburos', NULL, NULL),
(25, 'Palma', NULL, NULL),
(26, 'Papel y cartón', NULL, NULL),
(27, 'Química, farmacéutica, productos de aseo y cosméticos', NULL, NULL),
(28, 'Servicios', NULL, NULL),
(29, 'Textil y calzado', NULL, NULL),
(30, 'Transporte', NULL, NULL),
(31, 'Turismo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_dialogo`
--

CREATE TABLE `mesa_dialogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre de la mesa de dialogo',
  `tipo_dialogo_id` int(10) UNSIGNED NOT NULL,
  `organizador_id` int(10) UNSIGNED NOT NULL,
  `consejo_sectorial_id` int(10) UNSIGNED DEFAULT NULL,
  `lider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Líder de la mesa de dialogo',
  `coordinador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Coordinador u Funcionario Zonal Responsable',
  `sistematizador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Sistematizador(es), separadas por coma',
  `zona_id` int(10) UNSIGNED DEFAULT NULL,
  `provincia_id` int(10) UNSIGNED DEFAULT NULL,
  `canton_id` int(10) UNSIGNED DEFAULT NULL,
  `parroquia_id` int(10) UNSIGNED DEFAULT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Lugar donde se lleva a cabo la mesa de dialogo',
  `organizacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Organización o Grupo con quien se da el diálogo',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sector_id` int(10) UNSIGNED DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci COMMENT 'Descripción de la mesa de dialogo',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mesa_dialogo`
--

INSERT INTO `mesa_dialogo` (`id`, `nombre`, `tipo_dialogo_id`, `organizador_id`, `consejo_sectorial_id`, `lider`, `coordinador`, `sistematizador`, `zona_id`, `provincia_id`, `canton_id`, `parroquia_id`, `lugar`, `organizacion`, `fecha`, `sector_id`, `descripcion`, `user_id`, `created_at`, `updated_at`) VALUES
(132, 'Turismo -CCPT-CSPEYP', 2, 253, 4, '', '', 'Nelly Fernanda Alvarado Ochoa', 4, 14, 137, NULL, 'Portoviejo', '', '2017-07-30 05:00:00', 1, '', 1, '2018-08-24 19:41:17', '2018-08-24 19:41:17'),
(133, 'Agenda Sector Externo', 2, 251, 4, '', '', 'Evelyn  Rendón', 9, 10, 77, NULL, 'Guayaquil', '', '2017-07-31 05:00:00', 9, '', 1, '2018-08-24 19:56:34', '2018-08-24 19:56:34'),
(134, 'Política Exterior - Movilidad Humana', 2, 251, 4, '', '', 'Tania Fernanda  Gutiérrez', 1, 8, 67, NULL, 'Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '', '2019-11-20 05:00:00', 9, '', 1, '2018-08-24 19:57:14', '2018-08-24 19:57:14'),
(135, 'Agenda Sector Externo', 2, 251, 1, '', '', 'Evelyn  Rendón', 9, 10, 77, NULL, 'Guayaquil', '', '2018-07-31 05:00:00', 9, '', 1, '2018-08-30 17:48:17', '2018-08-30 17:48:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_10_16_172439_add_sipocs_table', 1),
(4, '2017_10_16_172538_add_thematics_table', 1),
(5, '2017_10_16_172654_add_ambits_table', 1),
(6, '2017_10_16_172820_add_sectors_table', 1),
(7, '2017_10_19_163720_create_vsectors_table', 1),
(8, '2017_10_23_205153_create_pajustadas_table', 1),
(9, '2017_10_31_155042_create_provincias_table', 1),
(10, '2017_10_31_173809_create_eventos_table', 1),
(11, '2017_11_06_201205_create_instrumentos_table', 1),
(12, '2017_11_07_215259_create_solucions_table', 1),
(13, '2017_11_13_224514_create_roles_table', 1),
(14, '2017_11_13_225423_create_role_user_table', 1),
(15, '2017_11_14_152320_add_column_to_table', 1),
(16, '2017_11_14_163723_create_evento_solucion_user_table', 1),
(17, '2017_11_14_174018_add_column_to_table_users', 1),
(18, '2017_11_14_200711_add_apellido_cedula_telefono_celular_to_users_table', 1),
(19, '2017_11_15_171909_add_create_tipo_empresa_table', 1),
(20, '2017_11_15_174647_add_tipo_empresa_id_to_solucions_table', 1),
(21, '2017_11_15_183314_drop_solucion_id_in_user_evento_solucion_table', 1),
(22, '2017_11_17_165823_add_region_to_provincias_table', 1),
(23, '2017_11_21_162527_add_id_mesa_to_solucions_table', 1),
(24, '2017_11_21_164732_create_mesas_table', 1),
(25, '2017_11_23_201708_add_estado_id_solucions_table', 1),
(26, '2017_11_24_141139_create_actor__solucion_table', 1),
(27, '2017_11_24_141203_create_estado_solucion_table', 1),
(28, '2017_11_24_141216_create_actividades_table', 1),
(29, '2017_11_24_141228_create_archivos_table', 1),
(30, '2018_03_07_031244_create_csp_reportes_hechos_table', 1),
(31, '2018_03_07_031519_create_csp_reporte_estados_table', 1),
(32, '2018_03_07_031556_create_csp_reportes_alertas_table', 1),
(33, '2018_03_07_031644_create_csp_acciones_alertas_table', 1),
(34, '2018_03_07_202705_create_institucions_table', 1),
(35, '2018_03_14_163958_create_csp_periodo_reportes_table', 2),
(36, '2018_04_03_155118_create_cantons_table', 2),
(37, '2018_04_03_155338_create_csp_tipo_agendas_table', 2),
(38, '2018_04_03_155414_create_csp_periodo_agendas_table', 2),
(39, '2018_04_03_155612_create_csp_tipo_impacto_agendas_table', 2),
(40, '2018_04_03_155722_create_csp_agenda_territorials_table', 2),
(41, '2018_05_25_164042_create_consejo_sectorials_table', 3),
(42, '2018_05_26_095644_create_consejo_institucions_table', 3),
(43, '2018_05_31_142550_create_tipo_dialogo_table', 3),
(44, '2018_05_31_143020_create_tipo_participante_table', 3),
(45, '2018_05_31_154247_create_zona_table', 3),
(46, '2018_06_01_105118_create_parroquia_table', 3),
(47, '2018_06_01_114648_create_mesa_dialogo_table', 3),
(48, '2018_06_01_115812_add_propuesta_solucion_pajustada_palabras_clave_to_solucions_table', 3),
(49, '2018_06_01_133521_create_participante_table', 3),
(50, '2018_06_01_142638_add_zona_to_provincias_table', 3),
(51, '2018_06_01_152925_add_zona_to_cantons_table', 3),
(52, '2018_06_07_115604_create_palabras_claves_table', 3),
(53, '2018_06_13_100041_add_ponderacion_to_solucions', 4),
(75, '2018_06_15_110302_create_cn_tipo_impuestos_table', 5),
(76, '2018_06_15_110323_create_cn_tipo_cifra_nacionals_table', 5),
(77, '2018_06_15_110353_create_cn_tipo_empresas_table', 5),
(78, '2018_06_15_110558_create_cn_provincias_table', 5),
(79, '2018_06_15_110622_create_cn_ciius_table', 5),
(80, '2018_06_15_110705_create_cn_tipo_fuentes_table', 5),
(81, '2018_06_15_110805_create_cn_cifras_nacionales_table', 5),
(82, '2018_06_15_110823_create_cn_poblacions_table', 5),
(84, '2018_06_18_113817_add_columnas_to_solucions_table', 6),
(86, '2018_07_03_101650_add_institucion_id_to_actor_solucion', 7),
(87, '2018_07_06_122600_create_user_institucions_table', 8),
(88, '2018_07_11_103030_create_indice_competitividads_table', 9),
(89, '2018_07_11_103950_create_politicas_table', 9),
(90, '2018_07_11_105208_create_estado_publicacions_table', 9),
(94, '2018_07_11_111945_add_fkpolitica_to_solucions', 11),
(95, '2018_07_11_112050_add_fkestadoPublicacion_to_solucions', 11),
(96, '2018_07_11_111921_add_fkindice_to_solucions', 12),
(97, '2018_07_11_165145_create_plan_nacionals_table', 13),
(98, '2018_07_11_165722_add_fkplannacional_to_solucions', 13),
(102, '2018_07_13_120932_add_cod_to_solucion_table', 14),
(103, '2018_08_08_112850_create_tipo_pruebas_table', 15),
(104, '2018_08_17_155916_add_conflicto_to_solucions', 15),
(105, '2018_08_28_095408_add_es_cs_to_user_table', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_ciudadano`
--

CREATE TABLE `notificacion_ciudadano` (
  `not_cd_id` int(11) NOT NULL,
  `not_cd_email` varchar(50) NOT NULL,
  `not_cd_fecha` date DEFAULT NULL,
  `not_cd_solucion_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificacion_ciudadano`
--

INSERT INTO `notificacion_ciudadano` (`not_cd_id`, `not_cd_email`, `not_cd_fecha`, `not_cd_solucion_id`, `created_at`, `updated_at`) VALUES
(1, 'csgallardof@gmail.com', '2018-08-30', 2970, '2018-08-30 15:23:21', '2018-08-30 15:23:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_ciudadano_propuesta`
--

CREATE TABLE `notificacion_ciudadano_propuesta` (
  `not_cdp_id` int(11) NOT NULL,
  `not_cdp_solucion_id` int(11) DEFAULT NULL,
  `not_cdp_fecha` date DEFAULT NULL,
  `not_cdp_estado` int(11) DEFAULT '0',
  `not_cdp_detalle` varchar(100) DEFAULT NULL,
  `not_cdp_tipo_cambio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion_quincenal`
--

CREATE TABLE `notificacion_quincenal` (
  `solucion_id` int(11) DEFAULT NULL,
  `problema_solucion` varchar(500) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `estado_solucion` varchar(100) DEFAULT NULL,
  `dependencia` varchar(100) DEFAULT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `email_usuario` varchar(200) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_creacion_not` date DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pajustadas`
--

CREATE TABLE `pajustadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_pajustada` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comentario_union` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras_claves`
--

CREATE TABLE `palabras_claves` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Palabra Clave',
  `solucion_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `palabras_claves`
--

INSERT INTO `palabras_claves` (`id`, `nombre`, `solucion_id`, `created_at`, `updated_at`) VALUES
(1, 'Seguimiento Turístico', 2970, '2018-08-24 19:41:17', '2018-08-24 19:41:17'),
(2, 'Regularización Turística', 2971, '2018-08-24 19:41:17', '2018-08-24 19:41:17'),
(3, 'Promoción Turística', 2972, '2018-08-24 19:56:34', '2018-08-24 19:56:34'),
(4, 'Integración', 2973, '2018-08-24 19:57:14', '2018-08-24 19:57:14'),
(5, 'Interculturalidad', 2973, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(6, 'Plan Binacional', 2974, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(7, 'Repatriación', 2975, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(8, 'Acuerdo Comercial', 2976, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(9, 'Justicia Fiscal ', 2977, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(10, 'Transnacionales', 2977, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(11, 'Relaciones Internacionales', 2978, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(12, 'Cultura Arte', 2979, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(13, 'Calidad', 2980, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(14, 'Servicios', 2980, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(15, 'Misiones Diplomáticas', 2981, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(16, 'Cultura Arte', 2982, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(17, 'Promoción Turística', 2983, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(18, 'Calidad', 2984, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(19, 'Servicios', 2984, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(20, 'Promoción Turística', 2985, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(21, 'Promoción Turística', 2986, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(22, 'Cultura Arte', 2987, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(23, 'Cultura Arte', 2988, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(24, 'Cultura Arte', 2989, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(25, 'Cultura Arte', 2990, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(26, 'Cultura Arte', 2991, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(27, 'Cultura Arte', 2992, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(28, 'Asistencia', 2993, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(29, ' Vulnerabilidad', 2993, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(30, 'Inclusion', 2994, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(31, 'Servicio', 2995, '2018-08-24 19:57:15', '2018-08-24 19:57:15'),
(32, 'Promoción Turística', 2996, '2018-08-30 17:48:17', '2018-08-30 17:48:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `id` int(10) UNSIGNED NOT NULL,
  `canton_id` int(11) NOT NULL,
  `nombre_parroquia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`id`, `canton_id`, `nombre_parroquia`, `created_at`, `updated_at`) VALUES
(1, 137, 'otro', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `id` int(10) UNSIGNED NOT NULL,
  `mesa_dialogo_id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombres del participante',
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Apellidos del participante',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Sector o grupo en el que participará',
  `tipo_participante_id` int(10) UNSIGNED DEFAULT NULL,
  `empresa` timestamp NULL DEFAULT NULL COMMENT 'Empresa u organización',
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cargo que ocupa el participante en la empresa',
  `sector_empresa_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Sector o grupo en el que trabaja la empresa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_nacionals`
--

CREATE TABLE `plan_nacionals` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_plan_nacional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre del plan nacional',
  `detalle_plan_nacional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre del plan nacional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_nacionals`
--

INSERT INTO `plan_nacionals` (`id`, `nombre_plan_nacional`, `detalle_plan_nacional`, `created_at`, `updated_at`) VALUES
(1, 'Social', 'descripcion Social', '2018-07-11 22:16:01', '2018-07-11 22:16:01'),
(2, 'Productivo', 'descripcion productivo', '2018-07-11 22:16:02', '2018-07-11 22:16:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicas`
--

CREATE TABLE `politicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_politica` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de la politica',
  `descripcion_politica` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre de la politica',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `politicas`
--

INSERT INTO `politicas` (`id`, `nombre_politica`, `descripcion_politica`, `created_at`, `updated_at`) VALUES
(1, 'Social', '', '2018-07-11 21:34:12', '2018-07-11 21:34:12'),
(2, 'Productivo', '', '2018-07-11 21:34:12', '2018-07-11 21:34:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_provincia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `region` int(11) NOT NULL,
  `zona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre_provincia`, `created_at`, `updated_at`, `region`, `zona_id`) VALUES
(1, 'Azuay', '2017-11-01 08:06:11', '2017-11-01 08:14:27', 2, NULL),
(2, 'Bolívar', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(3, 'Cañar', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(4, 'Carchi', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(5, 'Chimborazo', '2017-11-08 03:55:00', '2017-11-24 00:52:34', 2, NULL),
(6, 'Cotopaxi', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(7, 'El Oro', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 1, NULL),
(8, 'Esmeraldas', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 1, NULL),
(9, 'Galápagos', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 4, NULL),
(10, 'Guayas', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 1, NULL),
(11, 'Imbabura', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(12, 'Loja', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(13, 'Los Ríos', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 1, NULL),
(14, 'Manabí', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 1, NULL),
(15, 'Morona Santiago', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 3, NULL),
(16, 'Napo', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 3, NULL),
(17, 'Orellana', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 3, NULL),
(18, 'Pastaza', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 3, NULL),
(19, 'Pichincha', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(20, 'Santa Elena', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 1, NULL),
(21, 'Santo Domingo de los Tsáchilas', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(22, 'Sucumbios', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 3, NULL),
(23, 'Tungurahua', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 2, NULL),
(24, 'Zamora Chinchipe', '2017-11-08 03:55:00', '2017-11-08 03:55:00', 3, NULL),
(25, 'Nacional', '2019-01-07 16:55:00', '2019-01-07 16:55:00', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2017-12-07 10:00:00', '2017-12-07 10:00:00'),
(2, 'Participante', '2017-12-07 10:00:00', '2017-12-07 10:00:00'),
(3, 'Institución', '2017-12-07 10:00:00', '2017-12-07 10:00:00'),
(4, 'ConsejoSectorial', '2017-12-07 10:00:00', '2017-12-07 10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 132, 2, NULL, NULL),
(3, 133, 2, NULL, NULL),
(4, 134, 2, NULL, NULL),
(5, 135, 2, NULL, NULL),
(6, 136, 2, NULL, NULL),
(7, 137, 2, NULL, NULL),
(8, 138, 2, NULL, NULL),
(9, 139, 2, NULL, NULL),
(10, 140, 2, NULL, NULL),
(11, 141, 2, NULL, NULL),
(12, 142, 2, NULL, NULL),
(13, 143, 2, NULL, NULL),
(14, 144, 2, NULL, NULL),
(15, 145, 2, NULL, NULL),
(16, 146, 2, NULL, NULL),
(17, 147, 2, NULL, NULL),
(18, 148, 2, NULL, NULL),
(19, 149, 2, NULL, NULL),
(20, 150, 2, NULL, NULL),
(21, 151, 2, NULL, NULL),
(22, 152, 2, NULL, NULL),
(23, 153, 2, NULL, NULL),
(24, 154, 2, NULL, NULL),
(25, 155, 2, NULL, NULL),
(26, 156, 2, NULL, NULL),
(27, 157, 2, NULL, NULL),
(28, 158, 2, NULL, NULL),
(29, 159, 2, NULL, NULL),
(30, 160, 2, NULL, NULL),
(31, 161, 2, NULL, NULL),
(32, 162, 2, NULL, NULL),
(33, 163, 2, NULL, NULL),
(34, 164, 2, NULL, NULL),
(35, 165, 2, NULL, NULL),
(36, 166, 2, NULL, NULL),
(37, 167, 2, NULL, NULL),
(38, 168, 2, NULL, NULL),
(39, 169, 2, NULL, NULL),
(40, 170, 2, NULL, NULL),
(41, 171, 2, NULL, NULL),
(42, 172, 2, NULL, NULL),
(43, 173, 2, NULL, NULL),
(44, 174, 2, NULL, NULL),
(45, 175, 2, NULL, NULL),
(46, 176, 2, NULL, NULL),
(47, 177, 2, NULL, NULL),
(48, 178, 2, NULL, NULL),
(49, 179, 2, NULL, NULL),
(50, 180, 2, NULL, NULL),
(51, 181, 2, NULL, NULL),
(52, 182, 2, NULL, NULL),
(53, 183, 2, NULL, NULL),
(54, 184, 2, NULL, NULL),
(55, 185, 2, NULL, NULL),
(56, 186, 2, NULL, NULL),
(57, 187, 2, NULL, NULL),
(58, 188, 2, NULL, NULL),
(59, 189, 2, NULL, NULL),
(60, 190, 2, NULL, NULL),
(61, 191, 2, NULL, NULL),
(62, 192, 2, NULL, NULL),
(63, 193, 2, NULL, NULL),
(64, 194, 2, NULL, NULL),
(65, 1, 3, '2017-12-07 10:00:00', '2017-12-07 10:00:00'),
(66, 194, 5, '2017-12-07 10:00:00', '2017-12-07 10:00:00'),
(67, 195, 2, NULL, NULL),
(68, 196, 2, NULL, NULL),
(69, 197, 2, NULL, NULL),
(70, 199, 2, NULL, NULL),
(71, 68, 3, NULL, NULL),
(72, 69, 3, NULL, NULL),
(73, 70, 3, NULL, NULL),
(74, 71, 3, NULL, NULL),
(75, 72, 3, NULL, NULL),
(76, 73, 3, NULL, NULL),
(77, 74, 3, NULL, NULL),
(78, 75, 3, NULL, NULL),
(79, 76, 3, NULL, NULL),
(80, 77, 3, NULL, NULL),
(81, 78, 3, NULL, NULL),
(82, 79, 3, NULL, NULL),
(83, 80, 3, NULL, NULL),
(84, 81, 3, NULL, NULL),
(85, 82, 3, NULL, NULL),
(86, 83, 3, NULL, NULL),
(87, 84, 3, NULL, NULL),
(88, 85, 3, NULL, NULL),
(89, 86, 3, NULL, NULL),
(90, 87, 3, NULL, NULL),
(91, 88, 3, NULL, NULL),
(92, 89, 3, NULL, NULL),
(93, 90, 3, NULL, NULL),
(94, 91, 3, NULL, NULL),
(95, 92, 3, NULL, NULL),
(96, 93, 3, NULL, NULL),
(97, 94, 3, NULL, NULL),
(98, 95, 3, NULL, NULL),
(99, 96, 3, NULL, NULL),
(100, 97, 3, NULL, NULL),
(101, 98, 3, NULL, NULL),
(102, 99, 3, NULL, NULL),
(103, 100, 2, NULL, NULL),
(104, 101, 3, NULL, NULL),
(105, 102, 3, NULL, NULL),
(106, 103, 3, NULL, NULL),
(107, 104, 3, NULL, NULL),
(108, 105, 2, NULL, NULL),
(109, 106, 2, NULL, NULL),
(110, 107, 2, NULL, NULL),
(111, 108, 2, NULL, NULL),
(112, 109, 2, NULL, NULL),
(113, 110, 2, NULL, NULL),
(114, 111, 2, NULL, NULL),
(115, 112, 2, NULL, NULL),
(116, 113, 2, NULL, NULL),
(117, 114, 2, NULL, NULL),
(118, 115, 2, NULL, NULL),
(119, 116, 2, NULL, NULL),
(120, 117, 2, NULL, NULL),
(121, 118, 2, NULL, NULL),
(122, 119, 2, NULL, NULL),
(123, 120, 2, NULL, NULL),
(124, 121, 2, NULL, NULL),
(125, 122, 2, NULL, NULL),
(126, 123, 2, NULL, NULL),
(127, 124, 2, NULL, NULL),
(128, 125, 2, NULL, NULL),
(129, 126, 2, NULL, NULL),
(130, 127, 2, NULL, NULL),
(131, 128, 2, NULL, NULL),
(132, 129, 2, NULL, NULL),
(133, 130, 2, NULL, NULL),
(134, 131, 2, NULL, NULL),
(135, 132, 2, NULL, NULL),
(136, 133, 2, NULL, NULL),
(137, 134, 2, NULL, NULL),
(138, 135, 2, NULL, NULL),
(139, 136, 2, NULL, NULL),
(140, 137, 2, NULL, NULL),
(141, 139, 2, NULL, NULL),
(142, 140, 2, NULL, NULL),
(143, 141, 2, NULL, NULL),
(144, 142, 2, NULL, NULL),
(145, 143, 2, NULL, NULL),
(146, 144, 2, NULL, NULL),
(147, 145, 2, NULL, NULL),
(148, 146, 2, NULL, NULL),
(149, 147, 2, NULL, NULL),
(150, 148, 2, NULL, NULL),
(151, 149, 2, NULL, NULL),
(152, 150, 2, NULL, NULL),
(153, 151, 2, NULL, NULL),
(154, 152, 2, NULL, NULL),
(155, 153, 2, NULL, NULL),
(156, 154, 2, NULL, NULL),
(157, 155, 2, NULL, NULL),
(158, 156, 2, NULL, NULL),
(159, 157, 2, NULL, NULL),
(160, 158, 2, NULL, NULL),
(161, 159, 2, NULL, NULL),
(162, 160, 2, NULL, NULL),
(163, 161, 2, NULL, NULL),
(164, 162, 2, NULL, NULL),
(165, 163, 2, NULL, NULL),
(166, 164, 2, NULL, NULL),
(167, 165, 2, NULL, NULL),
(168, 166, 2, NULL, NULL),
(169, 167, 2, NULL, NULL),
(170, 168, 2, NULL, NULL),
(171, 169, 2, NULL, NULL),
(172, 170, 2, NULL, NULL),
(173, 171, 2, NULL, NULL),
(174, 172, 2, NULL, NULL),
(175, 173, 2, NULL, NULL),
(176, 174, 2, NULL, NULL),
(177, 175, 2, NULL, NULL),
(178, 176, 2, NULL, NULL),
(179, 177, 2, NULL, NULL),
(180, 178, 2, NULL, NULL),
(181, 179, 2, NULL, NULL),
(182, 180, 2, NULL, NULL),
(183, 181, 2, NULL, NULL),
(184, 182, 2, NULL, NULL),
(185, 183, 2, NULL, NULL),
(186, 184, 2, NULL, NULL),
(187, 185, 2, NULL, NULL),
(188, 186, 2, NULL, NULL),
(189, 187, 2, NULL, NULL),
(190, 188, 2, NULL, NULL),
(191, 189, 2, NULL, NULL),
(192, 190, 2, NULL, NULL),
(193, 191, 2, NULL, NULL),
(194, 192, 2, NULL, NULL),
(195, 193, 2, NULL, NULL),
(196, 194, 2, NULL, NULL),
(197, 195, 2, NULL, NULL),
(198, 196, 2, NULL, NULL),
(199, 197, 2, NULL, NULL),
(200, 198, 2, NULL, NULL),
(201, 199, 2, NULL, NULL),
(202, 200, 2, NULL, NULL),
(203, 201, 2, NULL, NULL),
(204, 202, 2, NULL, NULL),
(205, 203, 2, NULL, NULL),
(206, 204, 2, NULL, NULL),
(207, 207, 2, NULL, NULL),
(208, 208, 2, NULL, NULL),
(209, 209, 2, NULL, NULL),
(210, 210, 2, NULL, NULL),
(211, 211, 2, NULL, NULL),
(212, 212, 2, NULL, NULL),
(213, 213, 2, NULL, NULL),
(214, 214, 2, NULL, NULL),
(215, 215, 2, NULL, NULL),
(216, 216, 2, NULL, NULL),
(217, 217, 2, NULL, NULL),
(218, 218, 2, NULL, NULL),
(219, 219, 2, NULL, NULL),
(220, 220, 2, NULL, NULL),
(221, 221, 2, NULL, NULL),
(222, 222, 2, NULL, NULL),
(223, 223, 2, NULL, NULL),
(224, 224, 2, NULL, NULL),
(225, 225, 2, NULL, NULL),
(226, 226, 2, NULL, NULL),
(227, 227, 2, NULL, NULL),
(228, 228, 2, NULL, NULL),
(229, 229, 2, NULL, NULL),
(230, 230, 2, NULL, NULL),
(231, 231, 2, NULL, NULL),
(232, 232, 2, NULL, NULL),
(233, 233, 2, NULL, NULL),
(234, 234, 2, NULL, NULL),
(235, 235, 2, NULL, NULL),
(236, 236, 2, NULL, NULL),
(237, 237, 2, NULL, NULL),
(238, 238, 2, NULL, NULL),
(239, 239, 2, NULL, NULL),
(240, 240, 2, NULL, NULL),
(241, 241, 2, NULL, NULL),
(242, 242, 2, NULL, NULL),
(243, 243, 2, NULL, NULL),
(244, 244, 2, NULL, NULL),
(245, 245, 2, NULL, NULL),
(246, 246, 2, NULL, NULL),
(247, 247, 2, NULL, NULL),
(248, 248, 2, NULL, NULL),
(249, 249, 2, NULL, NULL),
(250, 250, 2, NULL, NULL),
(251, 251, 2, NULL, NULL),
(252, 252, 2, NULL, NULL),
(253, 253, 2, NULL, NULL),
(254, 254, 2, NULL, NULL),
(255, 255, 2, NULL, NULL),
(256, 256, 2, NULL, NULL),
(257, 257, 2, NULL, NULL),
(258, 258, 2, NULL, NULL),
(259, 259, 3, NULL, NULL),
(260, 260, 3, NULL, NULL),
(261, 261, 3, NULL, NULL),
(262, 262, 3, NULL, NULL),
(263, 263, 3, NULL, NULL),
(264, 264, 3, NULL, NULL),
(265, 265, 3, NULL, NULL),
(266, 266, 3, NULL, NULL),
(267, 267, 3, NULL, NULL),
(268, 268, 3, NULL, NULL),
(269, 269, 3, NULL, NULL),
(270, 270, 3, NULL, NULL),
(271, 271, 3, NULL, NULL),
(272, 261, 3, NULL, NULL),
(273, 262, 3, NULL, NULL),
(274, 263, 3, NULL, NULL),
(275, 264, 3, NULL, NULL),
(276, 265, 3, NULL, NULL),
(277, 266, 3, NULL, NULL),
(278, 267, 3, NULL, NULL),
(279, 268, 3, NULL, NULL),
(280, 269, 3, NULL, NULL),
(281, 270, 3, NULL, NULL),
(282, 271, 3, NULL, NULL),
(283, 272, 3, NULL, NULL),
(284, 273, 3, NULL, NULL),
(285, 274, 3, NULL, NULL),
(289, 275, 3, NULL, NULL),
(290, 276, 3, NULL, NULL),
(291, 277, 3, NULL, NULL),
(292, 278, 3, NULL, NULL),
(293, 279, 3, NULL, NULL),
(294, 280, 3, NULL, NULL),
(295, 281, 3, NULL, NULL),
(296, 282, 3, NULL, NULL),
(297, 283, 3, NULL, NULL),
(298, 284, 2, NULL, NULL),
(299, 285, 2, NULL, NULL),
(300, 286, 2, NULL, NULL),
(301, 287, 2, NULL, NULL),
(302, 288, 2, NULL, NULL),
(303, 289, 2, NULL, NULL),
(304, 290, 2, NULL, NULL),
(305, 291, 2, NULL, NULL),
(306, 292, 2, NULL, NULL),
(307, 293, 2, NULL, NULL),
(308, 294, 2, NULL, NULL),
(309, 295, 2, NULL, NULL),
(310, 296, 2, NULL, NULL),
(311, 297, 2, NULL, NULL),
(312, 298, 2, NULL, NULL),
(313, 299, 2, NULL, NULL),
(314, 300, 2, NULL, NULL),
(315, 301, 2, NULL, NULL),
(316, 302, 2, NULL, NULL),
(317, 303, 2, NULL, NULL),
(318, 304, 2, NULL, NULL),
(319, 305, 2, NULL, NULL),
(320, 306, 2, NULL, NULL),
(321, 307, 2, NULL, NULL),
(322, 308, 2, NULL, NULL),
(323, 309, 2, NULL, NULL),
(324, 310, 2, NULL, NULL),
(325, 311, 2, NULL, NULL),
(326, 312, 2, NULL, NULL),
(327, 313, 2, NULL, NULL),
(328, 314, 2, NULL, NULL),
(329, 315, 2, NULL, NULL),
(330, 316, 2, NULL, NULL),
(331, 317, 2, NULL, NULL),
(332, 318, 2, NULL, NULL),
(333, 319, 2, NULL, NULL),
(334, 320, 2, NULL, NULL),
(335, 321, 2, NULL, NULL),
(336, 322, 2, NULL, NULL),
(337, 323, 2, NULL, NULL),
(338, 324, 2, NULL, NULL),
(339, 325, 2, NULL, NULL),
(340, 326, 2, NULL, NULL),
(341, 327, 2, NULL, NULL),
(342, 328, 2, NULL, NULL),
(343, 329, 2, NULL, NULL),
(344, 330, 2, NULL, NULL),
(345, 331, 2, NULL, NULL),
(346, 332, 2, NULL, NULL),
(347, 333, 2, NULL, NULL),
(348, 334, 2, NULL, NULL),
(349, 335, 2, NULL, NULL),
(350, 336, 2, NULL, NULL),
(351, 337, 2, NULL, NULL),
(352, 338, 2, NULL, NULL),
(353, 339, 2, NULL, NULL),
(354, 340, 2, NULL, NULL),
(355, 341, 2, NULL, NULL),
(356, 342, 2, NULL, NULL),
(357, 343, 2, NULL, NULL),
(358, 344, 2, NULL, NULL),
(359, 345, 2, NULL, NULL),
(360, 346, 2, NULL, NULL),
(361, 347, 2, NULL, NULL),
(362, 348, 2, NULL, NULL),
(363, 349, 2, NULL, NULL),
(364, 350, 2, NULL, NULL),
(365, 351, 2, NULL, NULL),
(366, 354, 2, NULL, NULL),
(367, 355, 2, NULL, NULL),
(368, 356, 2, NULL, NULL),
(369, 357, 2, NULL, NULL),
(370, 358, 2, NULL, NULL),
(371, 359, 2, NULL, NULL),
(372, 360, 2, NULL, NULL),
(373, 363, 2, NULL, NULL),
(374, 364, 2, NULL, NULL),
(375, 365, 2, NULL, NULL),
(376, 366, 2, NULL, NULL),
(377, 367, 2, NULL, NULL),
(378, 368, 2, NULL, NULL),
(379, 369, 2, NULL, NULL),
(380, 370, 2, NULL, NULL),
(381, 371, 2, NULL, NULL),
(382, 372, 2, NULL, NULL),
(383, 373, 2, NULL, NULL),
(384, 374, 2, NULL, NULL),
(385, 375, 2, NULL, NULL),
(386, 376, 2, NULL, NULL),
(387, 377, 2, NULL, NULL),
(388, 378, 2, NULL, NULL),
(389, 379, 2, NULL, NULL),
(390, 380, 2, NULL, NULL),
(391, 381, 2, NULL, NULL),
(392, 382, 2, NULL, NULL),
(393, 383, 2, NULL, NULL),
(394, 384, 2, NULL, NULL),
(395, 385, 2, NULL, NULL),
(396, 386, 2, NULL, NULL),
(397, 387, 2, NULL, NULL),
(398, 388, 2, NULL, NULL),
(399, 389, 2, NULL, NULL),
(400, 390, 2, NULL, NULL),
(401, 391, 3, NULL, NULL),
(402, 392, 4, NULL, NULL),
(404, 393, 4, '2018-08-28 17:56:03', '2018-08-28 17:56:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectors`
--

CREATE TABLE `sectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_sector` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sectors`
--

INSERT INTO `sectors` (`id`, `nombre_sector`, `created_at`, `updated_at`) VALUES
(1, 'Turismo', '2017-10-20 06:31:19', '2017-10-20 06:31:19'),
(2, 'Acuícola', '2017-10-20 06:27:39', '2017-10-20 06:27:39'),
(3, 'Agroindustria', '2017-10-20 06:27:39', '2017-10-20 06:27:39'),
(4, 'Industria', '2017-10-20 06:27:39', '2017-10-20 06:27:39'),
(5, 'Transporte', '2017-10-20 06:27:39', '2017-11-24 00:52:59'),
(6, 'Comercio', '2017-11-23 20:00:00', '2017-11-23 20:00:00'),
(7, 'Consejo Consultivo Productivo Tributario (CCPT)', '2018-03-28 16:21:00', '2018-03-28 16:21:00'),
(8, 'Economía Popular y Solidaria', '2018-03-28 16:21:00', '2018-03-28 16:21:00'),
(9, 'Movilidad Humana', '2018-03-28 16:21:00', '2018-03-28 16:21:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipocs`
--

CREATE TABLE `sipocs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_sipoc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipocs`
--

INSERT INTO `sipocs` (`id`, `nombre_sipoc`, `created_at`, `updated_at`) VALUES
(1, 'Proveedores', '2017-10-19 08:34:07', '2017-10-19 08:34:07'),
(2, 'Insumos', '2017-10-19 08:34:13', '2017-10-19 08:34:13'),
(3, 'Proceso', '2017-10-19 08:34:24', '2017-10-19 08:34:24'),
(4, 'Producto', '2017-10-19 08:34:32', '2017-10-19 08:34:32'),
(5, 'Mercado', '2017-10-19 08:34:41', '2017-10-19 08:34:41'),
(6, 'otro', '2017-11-08 11:43:58', '2017-11-08 11:43:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solucions`
--

CREATE TABLE `solucions` (
  `id` int(10) UNSIGNED NOT NULL,
  `problema_solucion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `problema_validar_solucion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verbo_solucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sujeto_solucion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento_solucion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinador_zonal_solucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable_solucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `corresponsable_solucion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sistematizador_solucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lider_mesa_solucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_fuente` int(11) NOT NULL,
  `ambit_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `instrumento_id` int(11) NOT NULL,
  `pajustada_id` int(11) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `sipoc_id` int(11) NOT NULL,
  `thematic_id` int(11) NOT NULL,
  `vsector_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_empresa_id` int(11) NOT NULL,
  `solucion_ccpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesa_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `supuestos_cumplimientos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `riesgos_cumplimiento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `plazo_cumplimiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_cumplimiento` date NOT NULL,
  `propuesta_solucion` text COLLATE utf8mb4_unicode_ci COMMENT 'Propuesta solución',
  `pajustada` text COLLATE utf8mb4_unicode_ci COMMENT 'Propuesta ajustada',
  `palabras_clave` text COLLATE utf8mb4_unicode_ci COMMENT 'Palabras clave relacionadas a la propuesta, separadas por comas',
  `ponderacion` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `lugar_solucion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_solucion` date NOT NULL,
  `politica_id` int(10) UNSIGNED DEFAULT NULL,
  `estado_publicacion_id` int(10) UNSIGNED DEFAULT NULL,
  `indice_competitividad_id` int(10) UNSIGNED DEFAULT NULL,
  `plan_nacional_id` int(10) UNSIGNED DEFAULT NULL,
  `cod_solucions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'codigo solucions',
  `conflicto` tinyint(1) NOT NULL COMMENT 'propuesta en conflicto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solucions`
--

INSERT INTO `solucions` (`id`, `problema_solucion`, `problema_validar_solucion`, `verbo_solucion`, `sujeto_solucion`, `complemento_solucion`, `coordinador_zonal_solucion`, `responsable_solucion`, `corresponsable_solucion`, `sistematizador_solucion`, `lider_mesa_solucion`, `tipo_fuente`, `ambit_id`, `evento_id`, `instrumento_id`, `pajustada_id`, `provincia_id`, `sector_id`, `sipoc_id`, `thematic_id`, `vsector_id`, `created_at`, `updated_at`, `tipo_empresa_id`, `solucion_ccpt`, `mesa_id`, `estado_id`, `supuestos_cumplimientos`, `riesgos_cumplimiento`, `plazo_cumplimiento`, `fecha_cumplimiento`, `propuesta_solucion`, `pajustada`, `palabras_clave`, `ponderacion`, `zona_id`, `lugar_solucion`, `fecha_solucion`, `politica_id`, `estado_publicacion_id`, `indice_competitividad_id`, `plan_nacional_id`, `cod_solucions`, `conflicto`) VALUES
(2970, '', '', '', '', '', '', 'MT', NULL, 'Nelly Fernanda Alvarado Ochoa', '', 2, 6, 0, 0, 0, 14, 0, 6, 0, 0, '2018-08-24 19:41:17', '2018-08-24 19:41:17', 0, '', 132, 1, '', '', 'Largo', '0000-00-00', 'Creación de un Comité de Turismo, encargado del seguimiento y evaluación de la implementación de las políticas y acciones acordadas para el sector ( PETROECUADOR, MINTUR, Federación Nacional de Turismo)', 'Creación de un Comité de Turismo para el seguimiento y evaluación de la implementación de las políticas y acciones.', 'Seguimiento Turístico', 50, 4, 'Portoviejo', '2017-07-30', 2, NULL, 2, 2, 'MT-2017-07-30-144117', 0),
(2971, '', '', '', '', '', '', 'MT', NULL, 'Nelly Fernanda Alvarado Ochoa', '', 2, 7, 0, 0, 0, 14, 0, 6, 0, 0, '2018-08-24 19:41:17', '2018-08-24 19:41:17', 0, '', 132, 1, '', '', 'Corto', '0000-00-00', 'Adoptar un esquema de regulación en el sector turístico que permita la integración de la Economía Popular y Solidaria', 'Regularización en el sector turístico para la integración de la economía popular y solidaria.', 'Regularización Turística', 100, 4, 'Portoviejo', '2017-07-30', 2, NULL, 6, 2, 'MT-2017-07-30-144117', 0),
(2972, '', '', '', '', '', '', 'MT', NULL, 'Evelyn  Rendón', '', 2, 25, 0, 0, 0, 10, 0, 6, 0, 0, '2018-08-24 19:56:34', '2018-08-24 19:56:34', 0, '', 133, 1, '', '', 'Corto', '0000-00-00', 'Participar en  ferias que posicionen al país como destino turístico a nivel internacional : cultura, paisajes y productos', 'Ferias que posicionen al país: cultura, paisajes y productos', 'Promoción Turística', 100, 9, 'Guayaquil', '2017-07-31', 2, NULL, 2, 2, 'MT-2017-07-31-145634', 0),
(2973, '', '', '', '', '', '', 'MIPRO', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 26, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:14', '2018-08-24 20:44:21', 0, '', 134, 4, '', '', 'Largo', '0000-00-00', 'Reactivar  de los espacios de participación de los representantes de los diferentes pueblos y nacionalidades en  organismos como la CAN y UNASUR, para fortalecer su representativa en organismos regionales.', 'Fortalecer los mecanismos de integración regional (CAN, UNASUR, CELAC, etc.), procurando la existencia de espacios de participación intercultural', 'Integración, Interculturalidad', 25, 1, 'Esmeraldas, Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '2017-08-16', 1, NULL, 4, 1, 'MIPRO-2017-08-16-145714', 0),
(2974, '', '', '', '', '', '', 'SENPLADES', 'MREMH, GAD', 'Tania Fernanda  Gutiérrez', '', 2, 26, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Mediano', '0000-00-00', 'Involucramiento de los ciudadanos en la construcción del Plan Binacional Ecuador-Colombia', 'Participación de la ciudadanía en la construcción del Plan Binacional', 'Plan Binacional', 50, 1, 'Esmeraldas, Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '2017-08-16', 2, NULL, 4, 1, 'SENPLADES-2017-08-16-145715', 0),
(2975, '', '', '', '', '', '', 'MIPRO', 'MREMH, MDI, MDN', 'Tania Fernanda  Gutiérrez', '', 2, 26, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-30 19:41:45', 0, '', 134, 4, '', '', 'Largo', '0000-00-00', 'Mejorar la agilidad de los procesos de repatriación de los/as ecuatorianos/as privadas de la libertad', 'Repatriación de compatriotas ecuatorianos privados de la libertad', 'Repatriación', 100, 1, 'Esmeraldas, Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '2017-08-16', 1, NULL, 4, 1, 'MIPRO-2017-08-16-145715', 0),
(2976, '', '', '', '', '', '', 'MCEI', 'MIPRO, MAG, MAP, MREMH, SENPLADES, MEF, MH, SENAE', 'Tania Fernanda  Gutiérrez', '', 2, 25, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Promover acercamientos comerciales, basados en el principio del “comercio ético”, orientado a lograr negociaciones equilibradas, complementación económica y reducción de las asimetrías comerciales', 'Promover el fortalecimiento de las relaciones comerciales con socios estratégicos, con orientación a lograr negociaciones comerciales equilibradas, integración y complementación económica, y reducción de las asimetrías comerciales.', 'Acuerdo Comercial', 25, 5, 'GUAYAS', '2017-08-16', 2, NULL, 4, 1, 'MCEI-2017-08-16-145715', 0),
(2977, '', '', '', '', '', '', 'MREMH', 'SRI, MEF', 'Tania Fernanda  Gutiérrez', '', 2, 27, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Consolidar el trabajo que Ecuador ha venido abanderando en diferentes foros internacionales, sobre todo ONU esto permitirá afianzar su liderazgo y aproveche ciertas plataformas (G77+China, CELAC y Unasur) para posicionarse como referente en el tratamiento de la problemática sobre la justicia fiscal y las actividades de las empresas transnacionales y su afectación a los derechos humanos', 'Promocionar las iniciativas ecuatorianas para alcanzar una mayor justicia fiscal, la NAFR, los mecanismos regionales de solución de controversias en materia de inversiones y promover la adopción de un instrumento internacional sobre transnacionales y derechos humanos', 'Justicia Fiscal , Transnacionales', 100, 9, 'PICHINCHA', '2017-08-16', 1, NULL, 4, 1, 'MREMH-2017-08-16-145715', 0),
(2978, '', '', '', '', '', '', 'MDN', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 28, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Consolidar la integración regional como mecanismo para garantizar y defender la agenda de paz desde los espacios de la UNASUR y CELAC', 'Integracion de Ecuador a la agenda de Paz a nivel de Latinoamerica y Caribe', 'Relaciones Internacionales', 100, 9, 'PICHINCHA', '2017-08-16', 1, NULL, 4, 1, 'MDN-2017-08-16-145715', 0),
(2979, '', '', '', '', '', '', 'MIPRO', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-30 17:52:49', 0, '', 134, 3, '', '', 'Largo', '0000-00-00', 'Establecer alianzas estratégicas con otros mercados internacionales que posibiliten la exportación de productos, bienes y servicios culturales y patrimoniales', 'Generar alianzas estratégicas en los mercados internacionales para la exportación de productos, bienes y servicios culturales y patrimoniales', 'Cultura Arte', 25, 9, 'Quito, Pichincha', '2017-08-16', 2, NULL, 4, 1, 'MIPRO-2017-08-16-145715', 0),
(2980, '', '', '', '', '', '', 'MCYP', 'MREMH, MCEI', 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Implementar normas internacionales de calidad en los servicios y productos del sector cultural, patrimonial y turístico', 'Implementar normas internacionales de calidad en los servicios y productos del sector cultural, patrimonial y turístico', 'Calidad, Servicios', 50, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 1, 'MCYP-2017-08-16-145715', 0),
(2981, '', '', '', '', '', '', 'MT', 'MREMH', 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Mediano', '0000-00-00', 'Incorporar las funciones de promoción cultural y turística para las misiones diplomáticas en el mundo, para lo cual se debería capacitar en estos temas a los funcionarios del servicio exterior', 'Incorporar las funciones de promoción cultural y turistica para las misiones diplomáticas en el mundo', 'Misiones Diplomáticas', 100, 9, 'Quito, Pichincha', '2017-08-16', 2, NULL, 4, 1, 'MT-2017-08-16-145715', 0),
(2982, '', '', '', '', '', '', 'MCYP', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Proponer la creación del Pasaporte Cultural que facilite la movilidad de los actores culturales en Latinoamérica', 'Crear un pasaporte cultural para los gestores culturales en America Latina', 'Cultura Arte', 25, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 1, 'MCYP-2017-08-16-145715', 0),
(2983, '', '', '', '', '', '', 'MT', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Fortalecer los espacios y medios de difusión a nivel nacional e internacional para la promoción de la cultura y el turismo del Ecuador en el mundo', 'Fortalecer los espacios y medios de difusión para la promoción de la cultura y el turismo del Ecuador en el mundo', 'Promoción Turística', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 1, 'MT-2017-08-16-145715', 0),
(2984, '', '', '', '', '', '', 'MT', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 30, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Mediano', '0000-00-00', 'Implementar normas internacionales de calidad en los servicios y productos del sector  turístico', 'Normas de calidad en sector del turistico', 'Calidad, Servicios', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MT-2017-08-16-145715', 0),
(2985, '', '', '', '', '', '', 'MIPRO', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 32, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Promover el turismo en Ecuador en todos los ámbitos de participación de los compatriotas en el exterior', 'Promocion turistica con la participacion de los compatriotas que viven en el exterior', 'Promoción Turística', 0, 10, '', '0000-00-00', 1, NULL, 4, 2, 'MIPRO--145715', 0),
(2986, '', '', '', '', '', '', 'MT', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 32, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Generar estrategias de promoción turística para el  intercambio cultural, idioma, turismo, cultura, artesanías, gastronomía ecuatoriana', 'Promoción de intercambio cultural, idioma, turismo, cultura, artesanías, gastronomía ecuatoriana', 'Promoción Turística', 0, 10, '', '0000-00-00', 1, NULL, 4, 2, 'MT--145715', 0),
(2987, '', '', '', '', '', '', 'MCYP', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 26, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Exponer estratégicamente la riqueza cultural del país con la participación de los pueblos y nacionalidades', 'Exposcion de la riqueza cultural con la participación de los pueblos y nacionalidades', 'Cultura Arte', 100, 1, 'Esmeraldas, Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '2017-08-16', 1, NULL, 4, 2, 'MCYP-2017-08-16-145715', 0),
(2988, '', '', '', '', '', '', 'MCYP', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 26, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Participar activamente del Ecuador en ferias culturales internacionales', 'Participación en ferias culturales', 'Cultura Arte', 50, 1, 'Esmeraldas, Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '2017-08-16', 1, NULL, 4, 2, 'MCYP-2017-08-16-145715', 0),
(2989, '', '', '', '', '', '', 'MIPRO', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 26, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Promover la circulación de productos culturales desde el Ecuador hacia el mundo', 'Promover la circulacion de productos culturales', 'Cultura Arte', 100, 1, 'Esmeraldas, Esmeraldas, Auditorio de la Flota Petrolera Ecuatoriana (FLOPEC)', '2017-08-16', 1, NULL, 4, 2, 'MIPRO-2017-08-16-145715', 0),
(2990, '', '', '', '', '', '', 'MCYP', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Promocionar la identidad y cultura ecuatoriana a nivel internacional con la oferta de bienes y servicios de actores por medio de actores estratégicos como la comunidad ecuatoriana en el exterior', 'Promocionar la identidad y cultura ecuatoriana a nivel internacional con la oferta de bienes y servicios de actores por medio de actores estratégicos como la comunidad ecuatoriana en el exterior', 'Cultura Arte', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MCYP-2017-08-16-145715', 0),
(2991, '', '', '', '', '', '', 'MCYP', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Establecer redes para potenciar la promoción de saberes y conocimientos de las comunidades, de sitios arqueológicos, museos y ciudadades patrimoniales a nivel nacional e internacional', 'Generar redes para potenciar la promoción de saberes y conocimientos de las comunidades, de sitios arqueológicos, museos y ciudadades patrimoniales a nivel nacional e internacional', 'Cultura Arte', 50, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MCYP-2017-08-16-145715', 0),
(2992, '', '', '', '', '', '', 'MIPRO', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 29, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Largo', '0000-00-00', 'Facilitar el acceso a mecanismos de fomento cultural, tanto nacionales como internacionales que permita coproducciones con otros países, para la promoción cultural y patrimonial en el exterior', 'Facilitar el acceso a mecanismos de fomento cultural, tanto nacionales como internacionales', 'Cultura Arte', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MIPRO-2017-08-16-145715', 0),
(2993, '', '', '', '', '', '', 'MREMH', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 32, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Promover la protección de los derechos de los migrantes ecuatorianos en el exterior, la recuperación de capacidades e integración de la comunidad migrante retornada y a sus familias en el país', 'Promover la proteccción de los derechos de los migrantes ecuatorianos en el exterio y en el retrono al pais', 'Asistencia,  Vulnerabilidad', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MREMH-2017-08-16-145715', 0),
(2994, '', '', '', '', '', '', 'MREMH', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 32, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Mediano', '0000-00-00', 'Impulsar la Inclusion e integración de las y los ciudadanos extranjeros transeuntes, residentes temporales o permanentes en el Ecuador; y de las personas en necesidad de protección internacional', 'Impulsar la Inclusion e integración de las y los ciudadanos extranjeros transeuntes, residentes temporales o permanentes en el ecuador; y de las personas en necesidad de protección internacional', 'Inclusion', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MREMH-2017-08-16-145715', 0),
(2995, '', '', '', '', '', '', 'MREMH', NULL, 'Tania Fernanda  Gutiérrez', '', 2, 32, 0, 0, 0, 8, 0, 6, 0, 0, '2018-08-24 19:57:15', '2018-08-24 19:57:15', 0, '', 134, 1, '', '', 'Corto', '0000-00-00', 'Mejoramiento continuo de la eficiencia y calidad de servicios consulares para personas en situación de movilidad humana en el Ecuador y en el Exterio; a través de una gestion eficiente, moderna y de calidad', 'Mejoramiento continuo de la eficiencia y calidad de servicios consulares para personas en situación de movilidad humana', 'Servicio', 100, 9, 'Quito, Pichincha', '2017-08-16', 1, NULL, 4, 2, 'MREMH-2017-08-16-145715', 0),
(2996, '', '', '', '', '', '', 'MT', NULL, 'Evelyn  Rendón', '', 2, 25, 0, 0, 0, 10, 0, 6, 0, 0, '2018-08-30 17:48:17', '2018-08-30 17:48:17', 0, '', 135, 1, '', '', 'Corto', '0000-00-00', 'Participar en  ferias que posicionen al país como destino turístico a nivel internacional : cultura, paisajes y productos', 'Ferias que posicionen al país: cultura, paisajes y productos', 'Promoción Turística', 100, 9, 'Guayaquil', '2017-07-31', 2, NULL, 2, 2, 'MT-2017-07-31-124817', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `thematics`
--

CREATE TABLE `thematics` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_thematic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `thematics`
--

INSERT INTO `thematics` (`id`, `nombre_thematic`, `created_at`, `updated_at`) VALUES
(1, 'Acceso a mercados', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(2, 'Entorno productivo', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(3, 'Innovación calidad y emprendimiento', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(4, 'Inversión y financiamiento', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(5, 'Tributación', '2017-12-09 04:13:02', '2017-12-09 04:13:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dialogo`
--

CREATE TABLE `tipo_dialogo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_dialogo`
--

INSERT INTO `tipo_dialogo` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Presidente', '2018-06-12 19:40:33', '2018-06-12 19:40:33'),
(2, 'Sectorial', '2018-06-12 19:40:33', '2018-06-12 19:40:33'),
(3, 'Productivo', '2018-06-12 19:40:33', '2018-06-12 19:40:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empresa`
--

CREATE TABLE `tipo_empresa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_empresa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_empresa`
--

INSERT INTO `tipo_empresa` (`id`, `nombre_tipo_empresa`, `created_at`, `updated_at`) VALUES
(1, 'Microempresa', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(2, 'Empresa Pequeña', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(3, 'Empresa Mediana', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(4, 'Empresa Grande', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(5, 'EPS', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(6, 'Artesano', '2017-12-09 04:13:02', '2017-12-09 04:13:02'),
(7, 'Transversal', '2017-12-09 04:13:02', '2017-12-09 04:13:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_participante`
--

CREATE TABLE `tipo_participante` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_participante`
--

INSERT INTO `tipo_participante` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Público', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(2, 'Privado', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(3, 'EPS', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(4, 'Artesano', '2018-06-12 19:40:34', '2018-06-12 19:40:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pruebas`
--

CREATE TABLE `tipo_pruebas` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apellidos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_fuente` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `vsector_id` int(11) NOT NULL,
  `institucion_id` int(11) DEFAULT NULL,
  `es_cs` tinyint(1) NOT NULL COMMENT 'si el usuario es consejo sectorial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `apellidos`, `cedula`, `telefono`, `celular`, `tipo_fuente`, `sector_id`, `vsector_id`, `institucion_id`, `es_cs`) VALUES
(1, 'carlos', 'csgallardof@gmail.com', '$2y$10$3.OTpnHr5ibcA5BfFjnmduwBkOVfHXZvZY1okYeTto3KDHTSnf.ua', 'OEsL7fFpw17tX3kjfvthFHiqCAISF9yolbUFnVsHmLgGWoRhUCdeY8hbPsky', '2017-10-17 08:49:44', '2017-10-17 08:49:44', '', '', '', '', 0, 0, 0, 0, 0),
(2, 'Ramiro ', 'arq.rmaita@hotmail.com', '$2y$10$liNfhYw3ekR0xjYGJuQV3eBKikAqG95p9.T2HhRmLfbEXtoHDcYK6', NULL, '2017-11-24 00:22:34', '2017-11-24 00:22:34', 'Maita', '1102026794', '2683158', '0991288438', 1, 26, 3, 0, 0),
(3, 'Wladimir', 'wladiluq@yahoo.es', '$2y$10$tZBVWomD1UKnE8qFH.CeUubKNNjLfFTPr27632kRkW0dXkLV1cqh.', NULL, '2017-11-24 00:22:34', '2017-11-24 00:22:34', 'Ludeña', '1103113740', '2657044', '0981667703', 1, 26, 3, 0, 0),
(4, 'Tania', 'tochoa@utpl.edu.ec', '$2y$10$FHfGxuUnMvRA803lg1HBEeFeNEqTxd/aSZPW5OPbLiKzTsMz1huJm', NULL, '2017-11-24 00:22:34', '2017-11-24 00:22:34', 'Ochoa', '1103868327', '72614082', '0969982287', 1, 26, 3, 0, 0),
(5, 'Alex', 'apludena@utpl.edu.ec', '$2y$10$Tbxu9ceBLqVrgtJkk6Eqo.MiySDY1Eu5k6ul1eiNKuUEevgPLW/hC', NULL, '2017-11-24 00:22:34', '2017-11-24 00:22:34', 'Ludeña Reyes', '1104197791', NULL, '0999567211', 1, 26, 4, 0, 0),
(6, 'Maria Paulina', 'paulina.paladinez@turismo.gob.ec', '$2y$10$zM2KdC1DEx9h1e9TIsqucOTZxeCdbpRydoYaLMEddWz7Zqc9rDELy', NULL, '2017-11-24 00:22:34', '2017-11-24 00:22:34', 'Paladinez', '1103563209', '2139598', '0993495199', 1, 26, 3, 0, 0),
(7, 'Jessica', 'jessica_castillo@induiwia.com', '$2y$10$shVgsHjFc78.qgtIWOl2ReJve9VFJoND1YzDiK6Zvp.sa/SYFkSc2', NULL, '2017-11-24 00:22:35', '2017-11-24 00:22:35', 'Castillo', '1104115751', NULL, '0985761276', 1, 26, 2, 0, 0),
(8, 'Silvana', 'silvana.r@yahoo.es', '$2y$10$95BSFEd8zNwTb3EOO.Yz0.4UTkEItF3qDb3LgDtSAqljTDsGTPkCe', NULL, '2017-11-24 00:22:35', '2017-11-24 00:22:35', 'Hernandez', '1104691033', '2571220', '098481402', 1, 26, 2, 0, 0),
(9, 'Ricardo', 'rpazmino@loja.gob.ec', '$2y$10$Y4KlRFMmody9gflvD63vX./MRqoUQSIQIEReQBpIm7jUt3K/QQN4.', NULL, '2017-11-24 00:22:35', '2017-11-24 00:22:35', 'Pazmiño', '1103034540', NULL, '0995720206', 1, 26, 3, 0, 0),
(10, 'Diego', 'capturloja@gmail.com', '$2y$10$QEqSUpoas5HLiCygerqu9.QBMDvd3nr6vsTb9I8IazVZvMbqliK5a', NULL, '2017-11-24 00:22:35', '2017-11-24 00:22:35', 'Diaz', '1103983712', '2571500', '0985270354', 1, 26, 2, 0, 0),
(11, 'Gustavo', 'gmejia@mag.gob.ec', '$2y$10$7AnuMxvUM5IWcO4u99UlVOcsGG.J1BWmYChpfbI532.0W6Rth9ucm', NULL, '2017-11-24 00:23:27', '2017-11-24 00:23:27', 'Mejía', '1103559546', '-', '0983229863', 1, 28, 3, 0, 0),
(12, 'Jhoselyn ', 'jhosesk@hotmail.com', '$2y$10$cEgLc/bMC3D7pIxKqo/Tj.OlCzJaYvG6fayBxE0GsHxwVxbd1vRCi', NULL, '2017-11-24 00:23:27', '2017-11-24 00:23:27', 'Cuenca Carrión', '1104969140', '-', '0999241939', 1, 28, 2, 0, 0),
(13, 'Gabriela', 'gabriela.medina@cs.gob.ec', '$2y$10$ZadT3THHPTRTY3sMK/C6T.GPWldpx55OsvIuf4E49zaMuiW5CoTv6', NULL, '2017-11-24 00:23:27', '2017-11-24 00:23:27', 'Medina', '1104336159', '3702380', '0988096789', 1, 28, 3, 0, 0),
(14, 'Ximena Monica', 'ximena_lamt@hotmail.com', '$2y$10$PQjkJia83ze29N0g3U6ZYOl2Dseebo8YMYpfeQFEpKEAUL53IK17O', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'León', '1101565267', NULL, '0990620490', 1, 28, 2, 0, 0),
(15, 'Sinda', 'scastro@senplades.gob.ec', '$2y$10$FsGgvXoYQs/mIcK4EF2Ps.ZbFoJeszpjLf98fvzirKsovBNSVxdLK', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Castro', '1103257687', NULL, '0980469546', 1, 28, 3, 0, 0),
(16, 'Patricio', 'pato1bravo@hotmail.com', '$2y$10$hOohUPj3e2sIywJpmzuCtuI43OQxhdD75UXxTqQEGRvpT4/0WR6Mq', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Bravo ', '1102697221', NULL, '0997679914', 1, 28, 2, 0, 0),
(17, 'René', 'renem24@yahoo.es', '$2y$10$ie2cnL5po3xe9OuRxKy3q.51BLCVdx/oVvHjvoaXrf8.d5.3eCMfS', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Maldonado', '1103425813', NULL, '0982426026', 1, 28, 2, 0, 0),
(18, 'Carlos Manuel', 'carlosmunoz@hotmail.com', '$2y$10$vzEQkh4qeyLdB1W6/xMzyeHK8caZx7eACFlUvnhXHu3yJkAst3uf6', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Muñoz Peña', '0110342514', NULL, '0989217806', 1, 28, 2, 0, 0),
(19, 'César David', 'cesar.david.andrade1996@gmail.com', '$2y$10$RYJo3c9lxsd5z4PL76j0mO7XvuW.fgIHgRrHPn0/iUE0oKCu06V66', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Andrade Yépez', '1109323843', NULL, '0996330299', 1, 28, 2, 0, 0),
(20, 'Jimmy Israel', 'jiveintimilla@hotmail.com', '$2y$10$A2j5lNWuFTgwfus1.tS0yumQCV5HJ0xZNi2tNXf/7yzTXokc0wpfm', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Ventimilla', '1104187198', '2102514', '09933722534', 1, 28, 2, 0, 0),
(21, 'Manuel', 'mfernando@hotmail.com', '$2y$10$AwzdX0gbmQebka/tCIubzeJVeXMD9GV49YWOjwnKKm4IhYvufKjc6', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Espinoza Godoy', '1103377402', '2540080', '0994879554', 1, 28, 2, 0, 0),
(22, 'Angel', 'procesadora@hotmail.com', '$2y$10$NXTJDTr6hlPd6qPSEt9vSecpxDHDzkY3XAWoEM9UNow1XMsPmqkn.', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Buri', '1104175672', '2677614', '0988687188', 1, 28, 2, 0, 0),
(23, 'Patricio', 'pjaramillojiron@gmail.com', '$2y$10$Pfh4HoSstJuynCxXGewrr.D6bWiOFrF1ED0JWGOfBWDeKFeZJqODe', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Jaramillo Jirón', '1104052368', NULL, '0986933611', 1, 28, 2, 0, 0),
(24, 'Marcelo', 'incogalee@hotmail.com', '$2y$10$QJTiqFMjSPi5S2uBVL0ojeihKaPwXwbWBh7OWza1lrJnXLxkcTzUG', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Gallardo', '1102314372', NULL, '0990807681', 1, 28, 2, 0, 0),
(25, 'Alicia', 'alice.val.pal@hotmail.com', '$2y$10$ZTfF8k6V8/ZA6ndfadrYmuDpzcuCU8kxdds9ZP139J1BBVQETkUDu', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Valdivieso Palacios', '1102471206', NULL, '0099454912', 1, 28, 2, 0, 0),
(26, 'Aldo', 'aldoreyes@gmail.com', '$2y$10$tpPwbjKLegLksNJToMmvpuobtHW9Yu9ihDkGIehOYh5Dmkrv4zNyy', NULL, '2017-11-24 00:23:28', '2017-11-24 00:23:28', 'Reyes', '1103569891', NULL, '0988970023', 1, 28, 2, 0, 0),
(27, 'JOSE ALBERTO ', 'gerencia@ecolac.com.ec', '$2y$10$eidiSre3tJlHfwg9f4sG0.Ap/aDJuozNnTPaSVhtg27Q54iipiNbW', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'GARCIA BURNEO', '1102392907', '2611411', '09973211985', 1, 29, 3, 0, 0),
(28, 'EDISON ', 'eprama.ep@gmail.com', '$2y$10$NfK9fsXO4fAiNiMw2yOSE.WaH7U1VLZiXxwrUzOPyonTj.zKypffu', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'MERINO ULLAURI', '1103819304', '2696564', '0992197770', 1, 29, 4, 0, 0),
(29, 'RAMON', 'ramonceli2007@hotmail.com', '$2y$10$j3Gl/wSMOUQwXKHdEqCtFODPHIgV5VQo.gGqXtMqAeZrgzu6TtNom', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'CELI MONTOYA', '1102599428', '0994504311', '0994504311', 1, 29, 4, 0, 0),
(30, 'PABLO', 'ocuenca@loja.gob.ec', '$2y$10$fuOdz/JGEjphNv5pj1nUQOB2aT16BSbawfjg1vJUILBNHyYRp78Q2', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'CUENCA LOZANO', '1104472103', NULL, '0997498453', 1, 29, 3, 0, 0),
(31, 'ELIANA', 'esilva@loja.gob.ec', '$2y$10$zK/bWyCSfff/gf9u8KZOg.ZMfXLLSRXKGIqnmUm78rnvPGhAEeqau', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'SILVA', '1206015149', '162', '0994205181', 1, 29, 3, 0, 0),
(32, 'EDGAR', 'edgar.romero@controlsanitario.gob.ec', '$2y$10$BOlekylHOD6Vrrx349x8qu3TetYq3Vn9eNpISx0RzmFaM3ZUbn9kO', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'ROMERO', '1900385921', NULL, '0991931660', 1, 29, 3, 0, 0),
(33, 'SERGIO ', 'scabrera@cfn.fin.ec', '$2y$10$cNKDh2hJISzkGxLmFmNhB.J3qZTCoGXOF1Cji8c9/O1RHxPCmm/3q', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'CABRERA', '1104454370', NULL, '0969531057', 1, 29, 3, 0, 0),
(34, 'VERONICA', 'veronica.loaiza@controlsanitario.gob.ec', '$2y$10$mnooGLc45niXPco4xJAA/OzSUPVc12KF/MVfLzijyvl129wQ.ApDG', NULL, '2017-11-24 00:23:54', '2017-11-24 00:23:54', 'LOAIZA', '1103987804', '2579096', '0993725455', 1, 29, 3, 0, 0),
(35, 'ERNESTO', 'ecastro@mag.gob.ec', '$2y$10$wCIYuiDDZFg.oM3jANsYv./GdE3Tml3soOnOFxffVCHX32mkijehK', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'CASTRO JARAMILLO', '0704012624', '960100 ext 1446', '0992929630', 1, 29, 3, 0, 0),
(36, 'YOLANDA ', 'y293055@hotmail.es', '$2y$10$yfJOyDFQrPsz7oEpczU.ZeMudnyDgIh9Gw9x0qYXWkT1cE0tZPUPq', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'ORTIZ', '1101480943', '575931', '0992852644', 1, 29, 4, 0, 0),
(37, 'DIEGO ', 'dflara@utpl.edu.ec', '$2y$10$LH9HFgy3AOru.uUQKoeQ9.aoHpkNye187yma.YiTz9ioD.bEFempS', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'LARA LARA', '1109800404', '2614207', '0999733559', 1, 29, 3, 0, 0),
(38, 'ALEX ', 'alexsoc@hotmail.com', '$2y$10$eLplFKziFKzXIAkYjYrSveCTTiFdRhrjMH1.jKGrHI/MeWkJVwA8a', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'CARDENAS RODRIGUEZ', '1109812613', NULL, '0998592190', 1, 29, 4, 0, 0),
(39, 'KELVIN', 'kelvins33@hotmail.com', '$2y$10$SFVIXu6.LtbMRiuWsHb5Ueh8NTQL7rjo/2jp5dGqUpJID5AS1ZFcW', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'SIGCHO AZANZA', '1102918016', NULL, '0999134770', 1, 29, 4, 0, 0),
(40, 'AMADA', 'amada@ile.com.ec', '$2y$10$HXyuFl..oOX/PcHlpHBuMeoIHBLqmgeQHdFQKDaOd.PaFRbUfhWnu', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'GODOY', '1101461612', '2663170', '0999488454', 1, 29, 4, 0, 0),
(41, 'JUAN', 'juansempertegui@unl.edu.ec', '$2y$10$s1jXv8Eblo9R8dv4LpJwS.GdDxFftQOPXnysthmPdAsfKULqZIDZK', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'SEMPERTEGUI', '1102985296', '2663170', '0999488454', 1, 29, 4, 0, 0),
(42, 'JORGE', 'jrojas@prefloja.com', '$2y$10$OtJUtYEIQk5ojRHOF5qTYev3VSocsPVADIfxoe4gGBDwMN6pqZG9a', NULL, '2017-11-24 00:23:55', '2017-11-24 00:23:55', 'ROJAS MERCHAN', '1103404511', NULL, '0992362174', 1, 29, 3, 0, 0),
(43, 'Alonzo', 'arzunigax@utpl.edu.ec', '$2y$10$WcSYsCQErxkY3fx62j5qK.ESJ6GM3EzUxTzfLygfRNrZNYE3honNq', NULL, '2017-11-24 00:24:22', '2017-11-24 00:24:22', 'Zuñiga', '1102407788', '34343434343', '0999679789', 1, 30, 4, 0, 0),
(44, 'Marco ', 'mortega@mipro.gob.ec', '$2y$10$M5NGLog/kS2/IABzgCpHuubCZmeQKHDtZTQIcFupbroVjEl5VOHWK', NULL, '2017-11-24 00:24:22', '2017-11-24 00:24:22', 'Ortega', '6666666666', '343434334343', '0993739558', 1, 30, 3, 0, 0),
(45, 'Miguel ', 'mcastillo@mipro.gob.ec', '$2y$10$V4hQ3avUBEJJ7SeFiNcbMOyXoptWbP94Qi./RpPb0EFCxcyPoaGZu', NULL, '2017-11-24 00:24:22', '2017-11-24 00:24:22', 'Castillo', '1103145536', '3434443434343', '0981949036', 1, 30, 3, 0, 0),
(46, 'Gina ', 'ginapcj@gmail.com', '$2y$10$hwOlr2ROe45d0uY/Tff2Y.QdptTJ.P7MV6e.iyuTLMjv7rxSkCsr6', NULL, '2017-11-24 00:24:22', '2017-11-24 00:24:22', 'Carriòn', '0914011655', '3435543434343', '0981010418', 1, 30, 4, 0, 0),
(47, 'GUADALUPE', 'gdmacas@sri.gob.ec', '$2y$10$vdWbjD5y1l.OYyOjCbLz5exRiZ/RIfBeUW4A.tg6TUHasnlPc0K9u', NULL, '2017-11-24 02:38:35', '2017-11-24 02:38:35', 'MACAS SÀNCHEZ', '1104162688', '072571012 ext 7737', '0982760954', 1, 31, 3, 0, 0),
(48, 'MARÍA LORENA', 'mlbo23@yahoo.es', '$2y$10$Jl9AFnY1LqjGeFuroi0B1eCzaOl1U8HKv3JDazVnZ9QFehO78RW.O', NULL, '2017-11-24 02:38:35', '2017-11-24 02:38:35', 'BUSTAMANTE OJEDA', '1103504534', '072571012 ext 7762', '0992139377', 1, 31, 3, 0, 0),
(49, 'HYPATIA', 'hpiedra@iepi.gob.ec', '$2y$10$G.XTq2.bxlC0sXxq1Pajk.Xmm.2f2Zk8Ba9UinoA9B3M81xk7/kgK', NULL, '2017-11-24 02:38:35', '2017-11-24 02:38:35', 'PIEDRA ILLESCAS', '0703508408', '72565774', '0982220988', 1, 31, 1, 0, 0),
(50, 'AUGUSTO FABRICIO', 'abendaño@presidency.com', '$2y$10$.G7ZhZNUt3RvyO7iar.F0uoXTkjifn/a3wpWeUAJ8708JQTCBeTq2', NULL, '2017-11-24 02:38:35', '2017-11-24 02:38:35', 'ABENDAÑO LEGARDA', '1102809801', '72575143', '0991944984', 1, 31, 2, 0, 0),
(51, 'JANELA', 'karomeroch@uide.edu.ec', '$2y$10$0WzTCa35Nskq/SF/J5k7EO2AYh2TBx3w8iim/CFan5LeiImJeYmBq', 'LJXI0Yf5XwYmhi5WdUGLSiOuBqlUf8fvmjzuieuVS63yflq397d0IxJbbZ2U', '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'ROMERO', '0914426259', '72584567', '0958917989', 3, 31, 4, 0, 0),
(52, 'LADY', 'lady.ramon@banecuador.fin.ec', '$2y$10$aXArozVWU4KGDC.pqZirrezO2pBAdbwIGzQwGAXrNsjGG5tbxOPbS', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'RAMÓN', '0104418637', '72570570', '0996747866', 1, 31, 3, 0, 0),
(53, 'RUTH', 'ruth_patricia@hotmail.com', '$2y$10$Id7aoGX5hjeOhuQuwp9Z0u7770ymW5HtXVnwJbxQ.qXVUGE4ELHjW', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'ARIAS B', '1103989974', 'S/N', '0995700918', 1, 31, 2, 0, 0),
(54, 'AGUSTIN', 'aklacomic@gmail.com', '$2y$10$KdrZ/0FTHmzsuJAUjQB7K.KMlJIkO8vhHEhoafJpEggb6QJ6QEBe.', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'VALLE HUALPA', '1104536980', '72586450', '0958744779', 1, 31, 2, 0, 0),
(55, 'MARÍA DEL CISNE', 'mdtituania@utpl.edu.ec', '$2y$10$7zpoyozrxXb0Ot3Y0ehss.j2/3vHJMyVOGCQ6nE3M8IhHqhvQXuc.', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'TITUAÑA CASTILLO', '1103751770', '3701444 ext 2559', '0991015478', 1, 31, 4, 0, 0),
(56, 'MARITZA JACKERINE', 'ingmaritza.pena@gmail.com', '$2y$10$YkHxWeCHxrXjaJ3YKtlWOeaJlJJOyP0ZMpgBKqgc3AsHTwLmXMRFa', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'PEÑA VELEZ', '1104004516', 'S/N', '0997698280', 1, 31, 4, 0, 0),
(57, 'RAQUEL', 'jerapadilla@yahoo.es', '$2y$10$/k/cdBFjqkADbmXRn.qiWe8JUdy1n0tZsTjO6zPw379BATaaXKnTK', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'PADILLA ABAD', '0701718454', '109172', '0991244546', 1, 31, 4, 0, 0),
(58, 'VICENTE CRISTOBAL', 'vicenteanaluisa@scpm.gob.ec', '$2y$10$UVtQy0KFq9TJnQhkOeU3aORa9N.L7AzbcIvWvNEriBRKZsRRdtPWW', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'ANALUISA LOOR', '1101731500', '72565108', '0995710005', 1, 31, 3, 0, 0),
(59, 'EDUARDO', 'eduardo.andrade@scpm.gob.ec', '$2y$10$QNutz86zBt6c.ijkdBLzAuTWMwFGCIaq2r4b3eTnOI.gM8jTZzSvK', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'ANDRADE ALVARADO', '1104874944', 'S/N', '0995101837', 1, 31, 3, 0, 0),
(60, 'NOEMI', 'noemimorocho_10@hotmail.com', '$2y$10$S4KYiNb6aSXvcD1sWOOAYu8jMDB0AwkIRd07NrXXng5nqhdcHJ/xG', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'MOROCHO', '1103467583', 'S/N', '0969626314', 1, 31, 2, 0, 0),
(61, 'MONICA ALEXANDRA', 'bas-manimiel2017@yahoo.com', '$2y$10$Pk/H7WD3JmIsRvBfviR7Z.7QhRMfgiZcAWPsp.wLBL7bz/I6Dvu5O', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'MORA SISALIMA', '1102905437', '72583681', '0988649058', 1, 31, 2, 0, 0),
(62, 'NEUZA CECILIA', 'ing.nccueva@hotmail.com', '$2y$10$nGwPvjQeMyOGc4sS6AdcJ.w.iy0961709jNie/tH5yt0wm1CBnKcC', NULL, '2017-11-24 02:38:36', '2017-11-24 02:38:36', 'CUEVA JIMENEZ', '1103976054', '72552024', '0985000549', 1, 31, 4, 0, 0),
(63, 'LENIN', 'lennin.pelaez@unl.edu.ec', '$2y$10$Usp.hh2dEhuiLBWpx/Px0OrcdznMADgeQgLbdSqNFio3JQIOO80ba', NULL, '2017-11-24 02:38:37', '2017-11-24 02:38:37', 'PELAEZ', '1103748776', '72588144', '0996971464', 1, 31, 4, 0, 0),
(65, 'Jose Luis ', 'jose.ojeda@acuaculturaypesca.gob.ec', '$2y$10$jYMQr2n38MJ2WZz8545qD.47vosG9Tkhqdt0P0MrCoEOMz21bdgyS', NULL, '2017-12-11 23:06:41', '2017-12-11 23:06:41', 'Ojeda', '0703530683', '072927505', '0958847677', 1, 27, 3, 0, 0),
(66, 'María', 'agrimingoldse@gmail.com', '$2y$10$XJ.ASjSbe1omHX.6eTOcYONcd7CUGpD0LVSWpdAfVGpPUW4IAI7W6', NULL, '2017-12-11 23:06:41', '2017-12-11 23:06:41', 'Jimbo', '0703748749', '2960399', '0994886675', 1, 27, 4, 0, 0),
(67, 'Alexandra', 'camaraproductorescamaroneloro@hotmail.com', '$2y$10$sB01hTthDsAErIakbPaukOHNx9vFTdwY3RYWQ3fZAaBGTIgbbH35K', NULL, '2017-12-11 23:09:50', '2017-12-11 23:09:50', 'Galvez barrera', '0702669995', '2931556', '0994679097', 1, 27, 4, 0, 0),
(68, 'MIPRO DEMO 2', 'miprodemo@gmail.com', '$2y$10$RJrFx8Lhga4iiVu.Ag0iieEuFInVfLYwFMJf7EfW7rHaEW9Ly02KG', '1SNpyjMLNlO3DFLstW4KZxJ75HVnQJuPNCZh9EHtFAz8stHalnDIJqjCxYQo', '2017-12-18 23:12:35', '2017-12-18 23:12:51', '', '', NULL, NULL, 3, 0, 0, 0, 0),
(75, 'MIPRO', 'cguanochanga@mipro.gob.ec', '$2y$10$I2dEpyEyg4PzGIHoFKiB3OxPYHsPt2bIGxbpo/lM1eXzYhNDhAOry', '4FNCco7u3XZ5JCFjEQm5LFhLmsDCZRiPPT3j55g7FYW3nr9zynVmto113E33', '2018-01-09 01:31:43', '2018-01-09 01:31:43', '', '1000001756', NULL, NULL, 3, 0, 0, 0, 0),
(76, 'MAP', 'lissette.litardo@acuaculturaypesca.gob.ec', '$2y$10$cmh1n1LNjoqSTfMRZyECB.q63KWUbFuPwWJx905dNKhiPBErZMugO', 'I0TF2rlsGHAjgOXm1EsL3T7fIPFucXLumnS6IXvERCKdKaQQHObzPDFZg7lD', '2018-01-09 01:43:55', '2018-01-09 01:43:55', '', '1313287995', NULL, NULL, 3, 0, 0, 0, 0),
(77, 'ARCOTEL', 'javier.merino@arcotel.gob.ec', '$2y$10$MPRaROTi07EwV1jXt79pveqnZj81DFlCyId0xSO3RBjf8JOS0r6Vy', NULL, '2018-01-09 01:48:51', '2018-01-09 01:48:51', '', '1716720543', NULL, NULL, 3, 0, 0, 0, 0),
(78, 'STRC', 'luisjavier.ordonez@gmail.com', '$2y$10$6A0OusKbEw4..1VM6qRG6.hIW/wMiVCH1J9APLhDeBJOZlUCqk7fG', NULL, '2018-01-09 01:49:53', '2018-01-09 01:49:53', '', '1306215763', NULL, NULL, 3, 0, 0, 0, 0),
(79, 'MEER', 'francisco.dulce@meer.gob.ec', '$2y$10$lrZH1H/n8HkV.WUf25e9nuDw03.Azw8tHqIDwShQBCKenaBd46vli', 'e3ZFtlIVfRAX5OIYWiCgoOrDaAuQ2dyUW4nM77l6vG2rb7tR7PzTSuSNXeWO', '2018-01-09 01:53:09', '2018-01-09 01:53:09', '', '0924550429', NULL, NULL, 3, 0, 0, 0, 0),
(80, 'INMOBILIAR', 'patricia.munoz@inmobiliar.gob.ec', '$2y$10$4TKYOtd9acAFi0.j8qzzdOferye4llIGyVxA7obgfiruE2Yw5N1oW', NULL, '2018-01-09 01:59:23', '2018-01-09 01:59:23', '', '1720227345', NULL, NULL, 3, 0, 0, 0, 0),
(81, 'SAE', 'anaranjo@acreditacion.gob.ec', '$2y$10$fh0c31l3AyOArW1xl16Xp.KjlIPrzuu/ac6Zn7/HWTn7UqsSHz3p6', 'alGGUqY5LE46DUhERtaguWZlfqk3Pm3zbXh0sQIDjU9jRpwOG7JbhGKujZmO', '2018-01-09 02:42:46', '2018-01-09 02:42:46', '', '1717543878', NULL, NULL, 3, 0, 0, 0, 0),
(82, 'YACHAY', 'pdmoreno@yachay.gob.ec', '$2y$10$Zv/F4b1e5IzzKy1quyeiMOsckIULepUSQhY/rbfHO/7K29CVTPAOa', NULL, '2018-01-09 02:44:52', '2018-01-09 02:44:52', '', '1717223182', NULL, NULL, 3, 0, 0, 0, 0),
(83, 'MINTEL', 'efren.donoso@mintel.gob.ec', '$2y$10$oxKdncnHnwrU5NUbq4kMEeKII5/kVVuaB0NCovaIads3WmT2ifb3m', 'aRyO67A3s9dndQZ9DpmXwxHGsBDYLAUUrYDYfe9Es6y1l7yyL36d4zbY6PmC', '2018-01-09 19:12:00', '2018-01-09 19:12:00', '', '1000001726', NULL, NULL, 3, 0, 0, 0, 0),
(84, 'MAG', 'groman@mag.gob.ec', '$2y$10$pc07.aVWNGkK4g2hkhRW2.uUPmWOE6zGuOwTs4VzugcYUhd23gIx.', 'NOBRPelVZdO8GQ4rVt55Er4wOHVvn7IlbVUAMYvlL57Sg0SLS4kH8RWHTTVJ', '2018-01-09 19:12:38', '2018-01-09 19:12:38', '', '1000001727', NULL, NULL, 3, 0, 0, 0, 0),
(85, 'MTOP', 'clvasconez@mtop.gob.ec', '$2y$10$H.8sP5.1DDvcXe1XWjY9weykNyNHfpCahqVhhfsuxq47LhmnJaHz.', 'sLhbTGpRhiwQsbERljlfYxjKuaiqVvUWQLHh36RsUHec09lngjmtUq5YNi9j', '2018-01-09 19:13:55', '2018-01-09 19:13:55', '', '1000001739', NULL, NULL, 3, 0, 0, 0, 0),
(86, 'SRI', 'becarrillo@sri.gob.ec', '$2y$10$CAp/s5FSZ2Xd8cP61Px6/u.MEYK.wguZrDg8A.hGCg9z6P6x7hRJS', 'fr4qyKVZCTmhYOjVaXTTKDtzBNfCtatl9EWbAPDJRgKvZXm7ugSW918mqQ1M', '2018-01-09 19:14:37', '2018-01-09 19:14:37', '', '1000001761', NULL, NULL, 3, 0, 0, 0, 0),
(87, 'SENPLADES', 'dborja@senplades.gob.ec', '$2y$10$ke2MbGk9Jsv0pOuUfmLr9O1fgbBemKhmptsnpzMdeJEvcl6olL12m', NULL, '2018-01-09 19:15:11', '2018-01-09 19:15:11', '', '1000001762', NULL, NULL, 3, 0, 0, 0, 0),
(88, 'CFN', 'srevelo@cfn.fin.ec', '$2y$10$1EkInDwES351mf.OdhFqZ.uetc02ia0RErXTnrSCfK7s81pk7UwEO', 'Q0ThkAwBpYclCJC0nJTTyEX9PUySNlSuIVsYF1o5JNewR9aTdvdCzWI7b7Od', '2018-01-10 02:17:11', '2018-01-10 02:17:11', '', '1000001701', NULL, NULL, 3, 0, 0, 0, 0),
(89, 'MINTUR', 'xavier.rueda@turismo.gob.ec', '$2y$10$0WzTCa35Nskq/SF/J5k7EO2AYh2TBx3w8iim/CFan5LeiImJeYmBq', 'M0zwrrdMQWsHRLg5lyFmS20WQguD4UFiyeTPXy8LwopRbFSSwCJHc9CMPA95', '2018-01-10 02:19:39', '2018-01-10 02:19:39', '', '1709219867', NULL, NULL, 3, 0, 0, 0, 0),
(90, 'MDT', 'liliana_paredes@trabajo.gob.ec', '$2y$10$EFzLFYI2sRSr2hqi5g9WQ.0P0pw0C3XU4EehIGmmH1ePtS/tmHxkK', 'N9UyjsRTPTbXpz7UblM2oy8GTXDV7tTtxMAzjtWAxzGZYTj5NijOSGDUCRuO', '2018-01-10 02:20:08', '2018-01-10 02:20:08', '', '1720208808', NULL, NULL, 3, 0, 0, 0, 0),
(91, 'PETROECUADOR', 'gabriela.rovalino@eppetroecuador.ec', '$2y$10$zpU1o.ftVIcxk3ntSA3WMeF3vxGnyequMJ85dT9ZSY.HJaB/jMsti', NULL, '2018-01-10 02:21:01', '2018-01-10 02:21:01', '', '1715936595', NULL, NULL, 3, 0, 0, 0, 0),
(92, 'DAC', 'ana.aguilar@aviacioncivil.gob.ec', '$2y$10$MHipwytbOqbf9j.zyhPJo.sWxdOFbm6ebPZrTxaq5ffpD6qEp47sm', 'PYwunOeQxflXzmyLjVn5fgLaqvsf0SmZfJuqZbIaDCeei6FHJRpXAd6IHpHH', '2018-01-10 02:22:56', '2018-01-10 02:22:56', '', '1717787004', NULL, NULL, 3, 0, 0, 0, 0),
(93, 'IEPS', 'ana.murillo@ieps.gob.ec', '$2y$10$LM1HqULArNXc0/areM4VIeq.TqOFyGc7oyqQlYkqSOhdxYWj14O6e', 'VwILT66aHhF8G4ZeMQzw9VuQoYL1UOLUD8qIJoSxhDWijzGpa5mfnnbzgOmT', '2018-01-10 02:23:37', '2018-01-10 02:23:37', '', '0925410599', NULL, NULL, 3, 0, 0, 0, 0),
(94, 'SENAE', 'sjarrin@aduana.gob.ec', '$2y$10$KInT3ouYr1SUf.jeZSJkWO1yvI/ARtRRUPNdhcZFH8QrdZo8CKiR.', '3hDEJmTWZiamsVyXZcAC3cLYGjYh7XvoZz6kEN9unhcQSlc7BPyV0Z4JRvDB', '2018-01-10 02:24:57', '2018-01-10 02:24:57', '', '1000004567', NULL, NULL, 3, 0, 0, 0, 0),
(95, 'INEN - María Auxiliadora Bedón', 'mbedon@normalizacion.gob.ec', '$2y$10$hNlyefMk/kIKLJh8vNB7BO0T00Iqu2M6T2guQknmHSiRx5N/LAoOi', 'f6THt7vhBUykbQI3YLP9LWwHuJyD0SGNC9CgUU40mLowq679cXbptC0ppJSk', '2018-01-10 02:25:26', '2018-01-10 02:25:26', 'Salazar', '1710244367', NULL, NULL, 3, 0, 0, 0, 0),
(96, 'CNT', 'faustino.guaman@cnt.gob.ec', '$2y$10$rmO/KykfXSTLxnXudwEaeuOTAB.TlMCoXyNbZdAncq0roZy6FTtCG', NULL, '2018-01-10 02:26:05', '2018-01-10 02:26:05', '', '1708234859', NULL, NULL, 3, 0, 0, 0, 0),
(97, 'PROECUADOR - Karina Montenegro', 'kmontenegrop@proecuador.gob.ec', '$2y$10$azn9ovcfTYagDXLqibWYheunzvXWr7ZXD4b.OYZ2V.IGR49RGebBi', 'S1uayylseg4ZLnO8o9CHNGCPJQaFStZoI6Q2lQYJeo1rB2Ysz13t4VKuIkwD', '2018-01-10 02:26:54', '2018-01-10 02:26:54', '', '1713648663', NULL, NULL, 3, 0, 0, 0, 0),
(98, 'ARCSA', 'francisco.lopez@controlsanitario.gob.ec', '$2y$10$8OJh1VJQvT32.ipEwXZ5NuYYRJoHN35g9qOtt9HXU3uLccRmbKgiK', 'AzeWTs25IIMopKcNpkFgLRVgFchteYKGUonZIHXfa13MbqkxKGmMz8lUjhbF', '2018-01-10 20:42:45', '2018-01-10 20:42:45', '', '1714044995', NULL, NULL, 3, 0, 0, 0, 0),
(99, 'AGROCALIDAD', 'veronica.rivadeneira@agrocalidad.gob.ec', '$2y$10$4IUkQM51Amy7E4FKTWmCGOvcXLnDRdoz9XE2PQuu/qhXVSFFZ5Vae', 'rpxuVfFDKlCWfDF8x9jiTzQY9Dwc4EslryTz2byrk8FNNdxtduYDBLFGmRdO', '2018-01-10 21:05:09', '2018-01-10 21:05:09', '', '1717559031', NULL, NULL, 3, 0, 0, 0, 0),
(100, 'Jorge Luis', 'jorgepantojam@gmail.com', '$2y$10$urgsLmo0BksuuDrcmUznrOWBK1hy9PTa/.vIqCIgeE2MoGspFTOaS', NULL, '2018-01-11 09:24:34', '2018-01-11 09:24:34', 'Pantoja Méndez', '1710427939', '2676300', '0958919489', 1, 2, 4, 0, 0),
(101, 'DEMO MIPRO', 'jpantoja@mipro.gob.ec', '$2y$10$rKorsnBrJI0HeBQ6Ax1Rie//4jv0UHWn6z1YxE41J07fv4BHpaXVq', '8BhMt4hXAarYi7EEF6B3Zhlurauny7iTKQQ2BOwqeVw7ls0J5TZsNKBIB7X5', '2018-01-11 09:29:28', '2018-01-11 09:29:28', '', '1007897939', NULL, NULL, 3, 0, 0, 0, 0),
(102, 'MEF', 'palban@finanzas.gob.ec', '$2y$10$tqVKtfpsOBTbfFSu2bR1G.O6ifxGR.9fzhTCSnevFJHRXSQRzj6.i', 'IxTPid8hx7unSOUpq5nLWcXse3S3gEiwz0PTYR8E4nl1AwTiGT5Vmd5TBf51', '2018-01-18 21:14:37', '2018-01-18 21:14:37', '', '1712793403', NULL, NULL, 3, 0, 0, 0, 0),
(103, 'BANECUADOR', 'erika.palma@banecuador.fin.ec', '$2y$10$w6cE32F6ii9GtkhLB7yeheZsX181w640R4C27GEE4VmkVTdihe5OG', 'wR8Hny820NTg5mNLURSjqqBBWOYUIFW1wMALNjYaLu4Xz7ro4EkQ0pS5PYbt', '2018-01-19 20:04:42', '2018-01-19 20:04:42', '', '0401338645', NULL, NULL, 3, 0, 0, 0, 0),
(104, 'SENAE', 'juan@aduana.gob.ec', '$2y$10$KInT3ouYr1SUf.jeZSJkWO1yvI/ARtRRUPNdhcZFH8QrdZo8CKiR.', NULL, '2018-01-19 22:19:42', '2018-01-19 22:19:42', '', '1715278451', NULL, NULL, 3, 0, 0, 0, 0),
(105, 'Carlos', 'carlos1984castillo@gmail.com', '$2y$10$slUIwVok9nPyTE7QG..T6uYKRFQ6sPja9AalSZe1wLj3q5/H5/r3K', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Castillo', '0908082090', '07410060', '0992431650', 1, 3, 4, 0, 0),
(106, 'Dolores ', 'presidenciarenafipse@gmail.com', '$2y$10$7i0IrkDLJB3cHPZLEVOAMOj6rzxdzah4omjs7pIl2V2AOC2lCF1dm', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Solorzano', '0300908753', NULL, '0998412589', 1, 3, 4, 0, 0),
(107, 'Johanna', 'johanna6363@hotmail.com', '$2y$10$qtlNQgD4ygvCDat9GxSVWeg.K4Pt2Cf9vnfcONxk.YYD.qK1bdT2m', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Uguña', '0104821442', '072837179', '0959746555', 1, 3, 4, 0, 0),
(108, 'Edgar ', 'edgar.villena@ucuenca.edu.ec', '$2y$10$FKyFY3vkcH6zlsUuIC2TfuUxY/jy0hsMfTZjvLhHCqRuGDcW5frBq', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Villena', '1700179748', '033026282', '0989909407', 1, 3, 4, 0, 0),
(109, 'Estefanía ', 'tefarevalo@hotmail.com', '$2y$10$xj06Q2gHc/oDGnlNHNolre5gnqdvFQ0ISQyCdnz3STdhAX54vCeRm', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Arévalo', '0105601926', '074040282', '0987117817', 1, 3, 4, 0, 0),
(110, 'Brigida Isabet', 'josedavid@demo.gob.ec', '$2y$10$uai4d.eKXdHrtA/ScWLWE.8l3A9443nwt1XOliz9iFfMODOzqvZ7C', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Criollo ', '0103956140', '22222222', '022222222', 1, 3, 4, 0, 0),
(111, 'Rómulo', 'eddymoscoso09@hotmail.com', '$2y$10$l.OVa1xmyB2.CK9wrQgDdOpCyrMAJ7GVWiV2U908YbklZa8o.F1ue', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Moscoso', '0102955119', '22222222', '0997337638', 1, 3, 4, 0, 0),
(112, 'Antonio ', 'pijili2011@hotmail.com', '$2y$10$YyqnFPlnbaQadNy9xsQPh.fyLXeHGVGjEhvR89FJDQvJSbvjcwbMu', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Martinez', '0151520442', '22222222', '0979657145', 1, 3, 4, 0, 0),
(113, 'Fanny', 'finiguez@mag.gob.ec', '$2y$10$i1inBxxBE/97iXIO0MKEQeLc5xjWaeKrhCyK1094qgzD6ji98QX5q', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Íñiguez ', '0104484811', '22222222', '0995949142', 1, 3, 4, 0, 0),
(114, 'Jorge ', 'jegu_02@hotmail.com', '$2y$10$73J0uOXbpdJxn2Dbu7j/Y.ZuSxXFYlc7RyFMqes1jDduCICyE/s/S', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Guartotanga', '0101648632', '22222222', '0992200121', 1, 3, 4, 0, 0),
(115, 'Juana Catalina', 'j.ordoñez@agroazuay.ec', '$2y$10$DwPv2Vwc7TmEm/ihjiewgeYQ6Vn8zGxDmQsNwUtPd3nnamQRQdHE.', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Ordóñez', '0104226352', '072842588', '0939458956', 1, 3, 4, 0, 0),
(116, 'Lenin Gustavo', 'g.clavijo@agroazuay.ec', '$2y$10$gvLeEvGX1tkbskPKoxMq6uwX/nqvR19KBuGTvvnsZewCzCfar9CQ2', NULL, '2018-01-23 01:00:38', '2018-01-23 01:00:38', 'Clavijo', '0102594694', '072842588', '0999576831', 1, 3, 4, 0, 0),
(117, 'Lucía ', 'lcabrera@normalizacion.gob.ec', '$2y$10$6aPQhdxMdTTiq67pOudbC.YgVE52e6/ysZiHNPTRbR86MFb8qFg0e', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Cabrera', '0101765394', '22222222', '0996412900', 1, 3, 4, 0, 0),
(118, 'Ludgardo', 'ludgardo50@gmail.com', '$2y$10$cFCtxad5u1j/dWnBv6g0hOWUQ0vTT0BPJ3fxweZUJ6XORF9XdQ2KO', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Urgilez', '0101525285', '22222222', '0923962199', 1, 3, 4, 0, 0),
(119, 'Rosa María', 'maria-marquina63@hotmail.com', '$2y$10$I/XjI4JmlgYCU36cO94Yqu8dxQPWpYnUsu6UbHLF3/n7BS5jsqKVO', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Maquina', '0101792182', '074081268', '0998377004', 1, 3, 4, 0, 0),
(120, 'Blanca', 'cooprafaelg@gmail.com', '$2y$10$UjHG8B5Wfgp2yqHHOWuNzuXiXM0NjalBmF2rwop8Q06KPs3OSPYuq', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Espinoza', '0300719572', '22222222', '0991306264', 1, 3, 4, 0, 0),
(121, 'Ninfa', 'charocabrera57@hotmail.com', '$2y$10$gnaWMN2UNIwA7y7MWof1GORCctKKg8G6a/24S27yF89kUv6/dH7Um', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Cabrera', '0701243230', '22222222', '0988254466', 1, 3, 4, 0, 0),
(122, 'Carlos Cristóbal', 'chocopepadeoro@yahoo.es', '$2y$10$XyTkPY7DOtqDl2wKDNbiDO5v.bbRwUKze2iMqs4E6pbgQoiL12Puq', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Castillo ', '0300444791', '072410666', '0099620416', 1, 3, 4, 0, 0),
(123, 'Edwin Benito', 'edwin@raywana.com', '$2y$10$N78vqEuco0.gFZUffrQWC.rh7gL36wsCPM9ZD.69pcUaQXaaJPjGm', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'López Paucar', '1900536291', '22222222', '0980332234', 1, 3, 4, 0, 0),
(124, 'Freddy Patricio', 'corpraicesalimandinos@gmail.com', '$2y$10$tu1LmEzkbsQzsMWIsAxiKe4GM5DXd6oDKULv2KNTAs5F88I3GmYU6', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Montaño Tapia', '0104126214', '0724218848', '0989914184', 1, 3, 4, 0, 0),
(125, 'Pedro', 'pcsr2008@hotmail.com', '$2y$10$AqPfPvZ9X8kGDumu5I/46.yFgLh7LU5ZwofwB0zX7fRfSMyRhjJda', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Salgado Rodriguez', '0102908373 ', '072823327', '0987180275', 1, 3, 4, 0, 0),
(126, 'Santiago', 'santiagotoledo78@gmail.com', '$2y$10$cm6MTilbouPmWJ.YXVfaDuPMsUEkqhV05Hh4WbnzPkGiGAIyyrAYy', NULL, '2018-01-23 01:00:39', '2018-01-23 01:00:39', 'Toledo', '0102481520', '22222222', '0995150800', 1, 3, 4, 0, 0),
(127, 'Mirian Patricia', 'patricia.zhunio@gualaceo.gob.ec', '$2y$10$m4WEN7OQGNAWFLmZCmerMu2DDe.KAutJbAGZ12UpYSYDVJFPZ3Jwi', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Zhunio Garcia', '0105073753', 'N/A', '0987431315', 1, 6, 4, 0, 0),
(128, 'Cecilia', 'ceciliabad@sercop.gob.ec', '$2y$10$zOez9AL3nq1jg9ipl5jQae8gsNYNdm.z23CW4ttDuQCSy4WYb6V8W', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Abad Carpio', '0102132586', 'N/A', '0998461911', 1, 6, 4, 0, 0),
(129, 'Dayana', 'prueba@prueba.gob.ec', '$2y$10$C3UHRLA3FyQiCUv3l/8KBuuhPiee.k2rcAq/naUF7WlPJ87JOJfMy', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Agreda', '0703867606', 'N/A', '0987131715', 1, 4, 4, 0, 0),
(130, 'Ana', 'pedrosalazaraguirre@hotmail.com', '$2y$10$QY15hEN3wJ14XfLJgjHHoOV/paVaK2DTFwZLvkkXJ1.Ot.6dIUSXq', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Aguilar Chimbo', '0103391223', '074087549', '0981779119', 1, 6, 4, 0, 0),
(131, 'Carlos', 'caralv2000@yahoo.com', '$2y$10$mO6dNcIEIoRJi1jUBGZuK./IaHDIQrTmaTwo5BvN9EGEi0JXepAx.', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Alavarez', '0100771203', '2810756', '0994526522', 1, 6, 4, 0, 0),
(132, 'Francisco Oswaldo', 'oalvarado.rios@gmail.com', '$2y$10$fAHLvWpKi1XgmVt4v7Pcter4qrGhV8sLueQjwuOdx5XnGy0mi17HC', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Alvarado Ríos', '0101302420', '072801011', '0999306042', 1, 4, 4, 0, 0),
(133, 'Jorge Xavier', 'xavier_alvarez@outlook.com', '$2y$10$dIi1evW0iPws2SinN9srwOIoDLWrBcB/LbCzBNnyu7bGKSdxRjBWS', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Alvarez Ochoa', '0102581519', NULL, '0993220862', 1, 6, 4, 0, 0),
(134, 'Katy', 'katyandrade@hotmail.com', '$2y$10$wAtxGOIx8vjvf1ehC9BT8u4RLLhAHYKe9UVGp3gZfJ7aEWaRYghXm', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Andrade', '0103875492', '4199690', '0988839270', 1, 6, 4, 0, 0),
(135, 'Lino', 'litargmode@hotmail.com', '$2y$10$DDltGsT8/i2G4e.OjEWz8uV0wW5ialeZiovLNEmXEz/Sn30XecWga', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Anguisaca', '0101301091', 'N/A', '0999086889', 1, 6, 4, 0, 0),
(136, 'Ruben Enrique', 'eco_arce@hotmail.com', '$2y$10$xE1BLq1zaFsg.WmodnFL8esG9/7dsQtM9OaazlLFG7sAwicUMvBK6', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Arce Sanchez', '0104622899', 'N/A', '0983390741', 1, 4, 4, 0, 0),
(137, 'Juan', 'juan.avila@tecmasur.com', '$2y$10$B.A4qPNZ1rHZLwSkylLInOvUCoTx0LfGIVgsMap1nVc82STfOaw.C', NULL, '2018-01-23 19:44:08', '2018-01-23 19:44:08', 'Avila', '0102410313', 'N/A', '0995141106', 1, 4, 4, 0, 0),
(139, 'Jose Gerardo', 'Boterjoseg23@hotmail.com', '$2y$10$5L.E3WEBDEI.kgKUi1VQIejjQtglDwYabU6owtIyeGl4QvRwaOwqK', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Botero Ovalle', '1722831300', 'N/A', '0979284988', 1, 4, 4, 0, 0),
(140, 'Oscar', 'obravo@mp3caraudio.net', '$2y$10$kRU7Kw6rLKeDFp7VrkmDNOhPgPZDyAxieMP9jZYNx4OusGh34rrfa', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Bravo', '0101729150', 'N/A', '0994455369', 1, 6, 4, 0, 0),
(141, 'Catalina ', 'ingccabrera@hotmail.com', '$2y$10$EliqevBNdaNsQs32CJv5v.GLtY41EMRaZO54vqexb1GcaN3tmeR2y', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Cabrera', '0102526258', 'N/A', '0994052645', 1, 4, 4, 0, 0),
(142, 'Adrian Mauricio', 'amcalderon@senplades.gob.ec', '$2y$10$xoTKHZDOYFJYQuw41zv1j.ppxuJWL9a0oPN0j6woWpGCVIyTxAiYi', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Calderon villavicencio', '0105893374', 'N/A', '0991696671', 1, 6, 4, 0, 0),
(143, 'Xavier', 'xecc_e@hotmail.com', '$2y$10$acwJp.KCnz1.1coX0xAOkuWWgVKepPkVQODd7tGevI/BkW60SjbWS', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Calle Calle', '0102423670', '2831730', '0990981722', 1, 6, 4, 0, 0),
(144, 'Sonia Margot', 'soniamcallem@gmail.com', '$2y$10$PwjdgBIPQ5k/BuOUOyInXOGfFO.OhHN14rspEm7BdQEfg06GQ707e', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Calle Morocho', '0102922515', 'N/A', '0999978555', 1, 4, 4, 0, 0),
(145, 'Jaime Gustavo', 'gcalleproduccion@outlook.com', '$2y$10$jeitqn7y0K1hWYNIfW5sGOFm0PDNm96S6BgfDN2L9Eq1zwc8AAHDW', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Calle Morocho', '0101766376', 'N/A', '0997615069', 1, 4, 4, 0, 0),
(146, 'Carlos Luis', 'carloscal1vache@hotmail.com', '$2y$10$r.njBw/RvCyFBuLO/KgZ.OVjdyWVPgFb0Lvz7a6jsdhqEgFCS.Ipy', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Calvache Rodas', '0102797966', 'N/A', '0988855670', 1, 4, 4, 0, 0),
(147, 'Jose Luis', 'ventas@equisplast.com', '$2y$10$DQwh4us28yVl7Is5boKbHeBXzNRIvGwFBZHbZcKPymcgEDOPY5Usu', NULL, '2018-01-23 20:25:25', '2018-01-23 20:25:25', 'Camacho Guerrero', '0104436139', 'N/A', '0995819149', 1, 4, 4, 0, 0),
(148, 'Teofilo ', 'teofilocastro@vitefama.com.ec', '$2y$10$DWuIs.iL2hKToxPSzoplceps2fID0CIGeylkIXpxLILpL.3OCf17G', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Castro', '1400145072', 'N/A', '0982771916', 1, 4, 4, 0, 0),
(149, 'Xavier', 'xavier.castro@unac.edu.ec', '$2y$10$ttZeipdGgr4.NDNRXhmGmeZyx4Mh7N7MP6AXRFxfHQ.92oTX.ybXy', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Castro Serrano', '0104258523', 'N/A', '0984337828', 1, 6, 4, 0, 0),
(150, 'Yadira Lorena', 'yadicev@gmail.com', '$2y$10$ZGq/oVP2SYY2PoQLrdjOB.C8AutUfXpxa6PsKVka05LzcQneoO1pu', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Cevallos Aleaga', '1104015746', '072615312', '0987222548', 1, 4, 4, 0, 0),
(151, 'Jorge', 'gerenciaandina@cermosa.com.ec', '$2y$10$v1GvOSMoSQ2XJNw5cJyVqOPOIPGR40HLoSC6kA9kpc1/fQBhPzIVy', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Cisneros', '0102068847', NULL, '0992101920', 1, 4, 4, 0, 0),
(152, 'Boris', 'bcoellar@agni.com.ec', '$2y$10$1yQ02.rbPcE6OaNhSB/qUOOznxXPte.jZW1ssExBpukoJ0E3Nn59q', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Coellar', '0102646387', '72808244', '0997004028', 1, 6, 4, 0, 0),
(153, 'Mery Piedad', 'mericordova17@hotmail.com', '$2y$10$qyu1Dq.v.vcThxlqvFZTxuyS59pStR2MB5Dy2lEULWbwJAwbUuuFS', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Córdova Gómez', '0102636263', NULL, '0992553158', 1, 4, 4, 0, 0),
(154, 'Marlene', 'roqusabad217@gmail.com', '$2y$10$4GB2icEjwdW.p044WnTsheYAHk4.pAxKR02TQiwB4SbZyeoyMrgD2', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Coroso Abad', '0301911301', NULL, '0979258898', 1, 6, 4, 0, 0),
(155, 'Estefania ', 'prueba2@prueba.gob.ec', '$2y$10$iWVRvjjLCm.Ni6Q5oZmlh.SLMKHCH41o.SJPQzpsK/L5GrmVTV2WK', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Crespo', '0301563490', NULL, '0992735172', 1, 6, 4, 0, 0),
(156, 'Lorena. ', 'lordna_nueve@yahoo.es', '$2y$10$.ON.Ux0xq/gpTMirp3W9vOZnU7COpGoeeh5TKEkWqeXPFwG1FNT12', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Crespo ', '0102560865', NULL, '0959568978', 1, 4, 4, 0, 0),
(157, 'Luis Guillermo', 'lcrespo@mp3caraudio.et', '$2y$10$n0XjPONbuoqYayUewTMz0eVUz9VjVHAWJ495YQbDfPdnmU3PyFtku', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Crespo Cordero', '0102409687', NULL, '0983356523', 1, 4, 4, 0, 0),
(158, 'Manuel Rosendo ', 'contabilidad@incodisa.com.ec', '$2y$10$NyQRsUxm5ukIn5dTE3HIwOEYbF3sMxRLB.3VXxF9hsxB3ykvutxWu', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Criollo Roldan ', '0100812015', NULL, '0998870505', 1, 4, 4, 0, 0),
(159, 'Gustavo', 'gcuesta@mag.gob.ec', '$2y$10$G9PNcJHCxCiHd8QFE2pZR..FLGAcgsXKjqq/Cer.OnyAIDKTNcvIS', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'Cuesta', '1722379182', NULL, '0995789135', 1, 6, 4, 0, 0),
(160, 'Noura', 'ndelrio@cuenca.gob.ec', '$2y$10$PN0rwdSlnqxE8taLefEqDez/kuhu5l8sWmaed4ntI7Y2xy0w9g9n.', NULL, '2018-01-23 20:25:26', '2018-01-23 20:25:26', 'del Rio', '0103966370', NULL, '0982848569', 1, 6, 4, 0, 0),
(161, 'Marcelo', 'mdelgado@interpro.ec', '$2y$10$wW74PBJelWWtYmTAbeGH7OwjHeYmTJkHSyGfvyvV0d3mWp3fIYxKq', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Delgado', '0102942729', '72816782', '0996068636', 1, 6, 4, 0, 0),
(162, 'Romulo', 'rodelpa@hotmail.com', '$2y$10$98xtswx2AIvDXCHdPlNqAep0dI/7v0vJ/a4ajsdlPNoJPGR6vATB2', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Delgado', '0102060647', '72876313', '0997787890', 1, 6, 4, 0, 0),
(163, 'Juan Diego ', 'gerencia@grafisum.com', '$2y$10$tEMeo4J9hio7VfnSA8tGkOvqG2pGZTbhmA9jIRAbN/b2GYCaFH8j6', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Durán Andrade', '0101822104', NULL, '0999104641', 1, 4, 4, 0, 0),
(164, 'Sebastián', 'soporte.led@tecmasur.com', '$2y$10$Jmqrhy8gA8muVtGO5bd1b.q0Ufki0NjohrmOsAQ07jjy0YYuLTf/e', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Egas', '1710166404', NULL, '0991696358', 1, 4, 4, 0, 0),
(165, 'SERCOP', 'Carcgu1510', '$2y$10$0WzTCa35Nskq/SF/J5k7EO2AYh2TBx3w8iim/CFan5LeiImJeYmBq', 'DvKJjQ9wDZ2xchViEiOrXTQj5UWIEOxtkDwqNCD9mjgJmadf8gh23tV27Xqh', '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Escandon', '0105831251', NULL, '0991459830', 3, 4, 4, 0, 0),
(166, 'Sebastian ', 'sebastianfernandez@unae.gob.ec', '$2y$10$fieeaLQMq0YyeWbAWu5XC.4WXlN7GAqlL1Jc2WY1cUgmHxNoMpclm', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Fernandez de Cordova ', '0109118898', NULL, '0995798365', 1, 4, 4, 0, 0),
(167, 'Juan Eugenio', 'jgalarzatorre@mag.gob.ec', '$2y$10$0a7LmnjKaBQpjmIwtgOPvuZHeEe6rYzx0gaEyoH8O714VqIC70FSi', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Galarza Torres', '0102016623', NULL, '0996348791', 1, 4, 4, 0, 0),
(168, 'Angelica', 'amgarcia@azuay.gob.ec', '$2y$10$p.UUiZkABP97oYFjrA/Y9OEcQvg5hhymSSro6Pswgn4YFXEDVImOW', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Garcia Verdugo', '0102132750', NULL, '0987685303', 1, 4, 4, 0, 0),
(169, 'Rosana Estefanía', 'rosanageorcke@gmail.com', '$2y$10$3juVRuCKO1XSjKNZ5qizZeM7zAHZ46PNOGWgFxmGCJtxbg1885HcK', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Goercke León', '0104443064', NULL, '0987166178', 1, 4, 4, 0, 0),
(170, 'Juan Pablo', 'jpguerra@ucacsur.com.ec', '$2y$10$ZaRG.awyNrEN4F/QgUM1YOvh0kJhwRnveSa1Nq5JdWtShJ6l3FmOO', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Guerra', '0103560017', NULL, '0994415870', 1, 4, 4, 0, 0),
(171, 'Belén', 'bguerrero@azuay.gob.ec', '$2y$10$2Y7Vf5jt2J5eCy0ygPCjzOX6sc4UyoIHSY7RzdI3KINULdOPMDXrW', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Guerrero', '0105590657', NULL, '0998001986', 1, 4, 4, 0, 0),
(172, 'Bayron Benjamin', 'bayron.guzman@politica.gob.ec', '$2y$10$by0VaTHylKDlTmzNqVKk2OY1WjHaI2LQPgXRgs0..AsNRpL8yZiL6', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Guzman Ochoa', '0102962123', NULL, '0998275365', 1, 4, 4, 0, 0),
(173, 'Edwin Rene', 'edwinidrovo@hotmail.com', '$2y$10$zqrkKnvx5QS8y1oz.zxb/O5UlBYd1WS6bhywlT.oCyDXYsCFepKZe', NULL, '2018-01-23 20:25:27', '2018-01-23 20:25:27', 'Idrovo', '0103976478', NULL, '0987291834', 1, 4, 4, 0, 0),
(174, 'Roman ', 'ridrovo@ups.edu.ec', '$2y$10$UOjn0yiZRSIx6dxOVyp2tuSrVCY446yoYAHlXov6UEkdyZeKtcO.q', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Idrovo Daza', '0102073459', NULL, '0993043566', 1, 6, 4, 0, 0),
(175, 'José ', 'jiglesias@pacifico.gob.ec', '$2y$10$/C9WXTrnL1BcgLGkK8jEYuFREa9uuy4BIW7KpKs5HVnzmjJoahQUy', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Iglesias', '0300822811', '2831145', '0993239554', 1, 6, 4, 0, 0),
(176, 'Hermelinda', 'prueba3@prueba.gob.ec', '$2y$10$cxPOpW.f1RVpEPljf5DwXeddIR5nMeJabU2jxlsbB7aZiPA6JKFZu', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Lema', '0301592119', NULL, '0999265303', 1, 4, 4, 0, 0),
(177, 'Carmen ', 'cmalo@cidap.com', '$2y$10$EWFk/Gu08bzkV7xo1KGnXOMkEG7UI9h9qvjd7zNuARyp2rHDyRiGG', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Malo Ponce', '0104772587', NULL, '0996452424', 1, 4, 4, 0, 0),
(178, 'Victor', 'victorlmarin@hotmail.com', '$2y$10$iHi/JcQ8WUBr0j78whSeu.W5Ys.rFsGQ8m96QSxuX05TM3pBdh3v.', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Marín', '0102170909', NULL, '0980327240', 1, 4, 4, 0, 0),
(179, 'Paola ', 'rrpp@industriascuenca.org.ec', '$2y$10$QydvMEMjt8/gtJ/rTVrjlOvaGqQ3S97omuQmOphgJewJ7Htm4jeeO', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Martinez ', '0104647110', NULL, '0987103774', 1, 6, 4, 0, 0),
(180, 'Omar', 'prueba4@prueba.gob.ec', '$2y$10$hBGsGOe92Q8TBLGCyHmYcecWP0HdB08LsOZV1LR8XSQh3b6r6vqhy', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Medina Torres', '1111111113', NULL, '0987536062', 1, 4, 4, 0, 0),
(181, 'Martha ', 'contab1@homeroortega.com', '$2y$10$xbwGoz0HqlfMN1Vaz9.wbu7MpEv58W.ZOrQ3EkqpiMnR3of78zNeG', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Mena', '0101533503', NULL, '0999437509', 1, 4, 4, 0, 0),
(182, 'Esteban ', 'emendoza@azuay.gob.ec', '$2y$10$hpvQJ9vsalNti76NaFootuuCv6wHaueUymwF/b.d.rGGWnnjZAvWm', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Mendoza', '0102896677', NULL, '0998831648', 1, 6, 4, 0, 0),
(183, 'María', 'prueba5@prueba.gob.ec', '$2y$10$St2fDCcWn21FB88qgRiGBOAvMFSH4GwFloiJ5FyYBK6D1.tGHZJNG', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Minchala', '0301502803', '3055489', NULL, 1, 6, 4, 0, 0),
(184, 'Jorge ', 'george-001@hotmail.es', '$2y$10$jDQCos0QTJ2qOLw0UfvWwuSwexxox/0Pvq5cRrW/hC55QlKCKhmMa', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Minchala', '0106511553', NULL, '0990038245', 1, 6, 4, 0, 0),
(185, 'Blanca  Luna ', 'blancaluna110177@gmail.com', '$2y$10$8bA1PKMjoux73c31r9lXzO66KQXDQqiI337IL5zxOoRrKjfnUC7/q', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Miranda', '0301346102', NULL, '0999023838', 1, 6, 4, 0, 0),
(186, 'Edward Steve', 'emiranda@mp3caraudio.net', '$2y$10$UECOVaq5XhGvca6EvMXxKOBwM3AmsIF4MiqhQ3KHo4bxMNpiMsvtK', NULL, '2018-01-23 20:25:28', '2018-01-23 20:25:28', 'Miranda Tavarez', '0103208450', NULL, '0983336515', 1, 4, 4, 0, 0),
(187, 'Jaime Arturo', 'mmoreno@ccomercio.com.ec', '$2y$10$4vGXdLDM7MDx.Rw8Ibbxye3ML3a2gQ8NIu6VHa8xjhbsOXuG7/KA2', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Moreno Martinez', '0101958277', NULL, '0998346643', 1, 4, 4, 0, 0),
(188, 'Julia ', 'munozju@presidencia.gob.ec', '$2y$10$Pj.7/9MZpQjQgVn9BO5so.8eY0BgKYSQQHz3Uh2e4dZSL0tcBwRpO', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Muñoz ', '1717527244', NULL, NULL, 1, 4, 4, 0, 0),
(189, 'Marcelo Alfredo', 'DECUEROMUNOZ@HOTMAIL.COM', '$2y$10$kUC38eUUStJ5XrqJ7b7G9uw2aSiTBIjsFQsIpnb2qhvOVBrYDeJfq', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Muñoz Calderón', '0102042660', '072892919', '0999134495', 1, 4, 4, 0, 0),
(190, 'Miguel Fernando', 'cmim01@hotmail.com', '$2y$10$r9iBjUoO.8OH67gdAFAPr.NQHvAvknaflf4YzFnCFN6rMo7dOOOOu', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Narváez Vélez', '0101697944', '072901271', '0998697511', 1, 4, 4, 0, 0),
(191, 'Ana Feliza ', 'anafeliza8a@hotmail.com', '$2y$10$7KmOAQkQuQR/FxEU07y85uJ/YvKyIA0WHMtq4/B1VRpoNEw5tPzAi', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Ochoa ', '0102126059', NULL, '0967763933', 1, 4, 4, 0, 0),
(192, 'Ana Cristina', 'ana.palacios@controlsanitario.gob.ec', '$2y$10$49qIQZq6NmBiuaV5ccFhZ.L8BuOR1qJIUuYv20QwvyPE2/mqVBPZe', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Palacios Aguilera', '0103978524', '4126468', '0999069424', 1, 4, 4, 0, 0),
(193, 'Juan Fernando ', 'Jfparedesroldan@hotmail.com', '$2y$10$BXDDsQbi/GNacuxA1v3ipeT2b36G0uK0hPbsJj1Ik1NLuPGoMAtja', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Paredes Roldan', '0101703387', NULL, '0992627947', 1, 4, 4, 0, 0),
(194, 'Luis ', 'luis.pastor@eduace.ec', '$2y$10$9KDXNEw2W5VE082oQHmu/.k9Boymz0sWNOl0H86ctBKJzP3iSiw22', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Pastor ', '0502147432', NULL, '0999500315', 1, 4, 4, 0, 0),
(195, 'Ricardo Paul', 'prueba8@prueba.gob.ec', '$2y$10$vD9IzP23GS0U21K7bHiyquD2zro36l1Rwya/Icsj6Vddtwn5aTDeW', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Pereira Alvarez', '0103210971', NULL, '0N/A', 1, 4, 4, 0, 0),
(196, 'Miguel', 'mapi@hotmail.es', '$2y$10$Ig0PPQnhJ.ypEJtO4NCJ7e7.ffKT.HGzUAAfSgWJNVke41.17ZG8i', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Pesantez', '0101734291', NULL, '0998630226', 1, 4, 4, 0, 0),
(197, 'Edwin Mauricio', 'chocosophiecuenca@gmail.com', '$2y$10$YkOzdnbWgZk7O0.8JBulIOSGAVcHY9LY8M7PBOf63suXv7lPe5o4O', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Pillco Farez', '0104614805', '074177408', '0967420927', 1, 4, 4, 0, 0),
(198, 'Javier', 'javierpolo3000@yahoo.es', '$2y$10$/6lD/cgO.LSVdgxWshcUG.3PR50g/SaEd.l.D.HfkMxbKBtzp2AV2', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Polo', '0102555117', '74054007', '0939479197', 1, 4, 4, 0, 0),
(199, 'Fernando   ', 'fponton@azuay.gob.ec', '$2y$10$AJwoqiWmHpK/KChocQZRN.ct/Lg6rWoKP22Q0wWsy9c2Ymy9M4BXK', NULL, '2018-01-23 20:25:29', '2018-01-23 20:25:29', 'Pontón', '0703503862', NULL, '0996354005', 1, 4, 4, 0, 0),
(200, 'Jaime Santiago', 'santiago.reino@tecmasur.com', '$2y$10$cdShvD4VE2fWlJQS6wo8Ze4OvBSjWK/NIKob5HqXWnVIn4hbbs5oS', NULL, '2018-01-23 20:25:30', '2018-01-23 20:25:30', 'Reino Campos', '0102184181', '072829151', '0998135972', 1, 4, 4, 0, 0),
(201, 'Gabriela', 'gabyriera91@gmail.com', '$2y$10$DTsgtQb2PeBDOpUIyvYYO.buMY6TMztNKGxLYNDU9GVLUiFhkMwy2', NULL, '2018-01-23 20:25:30', '2018-01-23 20:25:30', 'Riera', '0105628365', '74097056', '0960905228', 1, 6, 4, 0, 0),
(202, 'Carlos Alberto ', 'crojas@edec.gob.ec', '$2y$10$hcsFbqrpsytGgPbxSTMA2epwueQND0Hk0euSEfOr3xlgPxsgRgBpy', NULL, '2018-01-23 20:25:30', '2018-01-23 20:25:30', 'Rojas Pacurucu', '0102710019', NULL, '0984924906', 1, 6, 4, 0, 0),
(203, 'Fernando', 'nandito@cablemoden.com.ec', '$2y$10$TCXaTcS3TyvIOOePL.JXKe0cQvlgNO6RnsDpUz9TPrZgDegZjxKf2', NULL, '2018-01-23 20:25:30', '2018-01-23 20:25:30', 'Romero', '0101762954', NULL, '0993126504', 1, 6, 4, 0, 0),
(204, 'Rene', 'rruiz@cuenca.gob.ec', '$2y$10$UoVGg2VaP03r1TnufxTn.OwQX5edXYvawx4lab89D8LXuWuxkrFre', NULL, '2018-01-23 20:25:30', '2018-01-23 20:25:30', 'Ruiz', '0102632510', NULL, '0995630601', 1, 6, 4, 0, 0),
(207, 'Vicente Rafael', 'vsanchez@normailzación.gob.ec', '$2y$10$WItdZwvcuk.npYOrjA2O6Oiku/vsjIAbAg6I7R4a6oCv9M2Sqb0ua', NULL, '2018-01-23 20:27:18', '2018-01-23 20:27:18', 'Sanchez Medina', '0103080610', '3702020', '0N/A', 1, 6, 4, 0, 0),
(208, 'Marcelo  ', 'mserrano@diserval.com', '$2y$10$wdApAZN2g9eW/xn2Mre7BO8hZcRp2L81TVHf257HyecdR0vhwzxpS', NULL, '2018-01-23 20:27:18', '2018-01-23 20:27:18', 'Serrano', '0100652403', '072820331', '0999128687', 1, 6, 4, 0, 0),
(209, 'Tatiana ', 'tatianatello85@hotmail.com', '$2y$10$kyX5cMisrYc8orKJ68hHqeVarvnFGF1OCFHD1ArEji3R/0YCFm6Ei', NULL, '2018-01-23 20:27:18', '2018-01-23 20:27:18', 'Tello', '1400481904', NULL, '0984294200', 1, 6, 4, 0, 0),
(210, 'Veronica ', 'vnca.torres@hotmail.com', '$2y$10$kzw0BKp4AeHF6osOvRyjHeS6HzPmjXrshCN7KC1A24h0OevG10JWu', NULL, '2018-01-23 20:27:18', '2018-01-23 20:27:18', 'Torres', '0104300769', NULL, '0989063649', 1, 6, 4, 0, 0),
(211, 'Ruth Cecilia ', 'rvaldivieso@normalizacion.gob.ec', '$2y$10$AVvMDxiNs1WoHswWOXTxHOQCn84lP9GL2bfgixfD7OZq87oa.bPFS', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Valdivieso Sanchez', '0102047617', NULL, '0999892006', 1, 6, 4, 0, 0),
(212, 'Juan Marcelo', 'socelec.gerente@ecasa-la.com', '$2y$10$3XKHX670u2UT7WRWE009fe9bvb83asjv/aWQVDzI6Rrwj7SNnyd5C', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Vallejo Moscoso', '0101880301', NULL, '0999457858', 1, 6, 4, 0, 0),
(213, 'Sonia Patricia', 'maskalavida@gmail.com', '$2y$10$n0khNagfosvTcHYybO9NSee8TPf5alRGxhYP79ih8LT2/au3a2aHa', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Vazquez Loaiza', '0102672441', NULL, '0995395723', 1, 6, 4, 0, 0),
(214, 'Jamileth Susana', 'svazquez@iepi.gob.ec', '$2y$10$vpcm2DzBs8TsYTW1PA.fhuAeEhEAtkNOvxs9Rn9p47yd4C5xuGS86', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Vazquez Zambrano', '0103363354', NULL, '0995639286', 1, 6, 4, 0, 0),
(215, 'Ana Julia ', 'avega@ups.edu.ec', '$2y$10$D76A5qXF6d8ORZnKwQuGMecUfaab0ZEGVPpAahwRBxkKCcj.eDDqS', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Vega Luna', '0102135480', NULL, '0998034521', 1, 6, 4, 0, 0),
(216, 'Mario', 'mariovillamarin@gmail.com', '$2y$10$0ciSdufhptZWJa2HWJsfBuPKmvxVSqhCbyt5gxkDlY5IeMPB3zjO6', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Villamarin', '0604022186', NULL, '0960850543', 1, 6, 4, 0, 0),
(217, 'Mauro', 'maurovintimilla@yahoo.es', '$2y$10$JyZgzaUzeiK/R/rkfiCUJO71/14547vbkjykO7ywdZFWTvH8F9Xv6', NULL, '2018-01-23 20:27:19', '2018-01-23 20:27:19', 'Vintimilla Castro', '0101005163', NULL, '0985812016', 1, 6, 4, 0, 0),
(218, 'CARMEN PATRICIA ', 'pa7y_lopez@hotmail.com', '$2y$10$FgGAwyzsInVVDeAS6UD8Me7SZwGuXg6Ct9so0tP9AmJR/8/2fhDXm', NULL, '2018-02-06 21:39:01', '2018-02-06 21:39:01', 'LÓPEZ GONZALEZ ', '1704586414', '2845840', '0984885799', 1, 1, 4, 0, 0),
(219, 'CARMÉN BEATRIZ', 'betisin_3@hotmail.com', '$2y$10$GK4Ige27U75cVWJ4C8oAIe2vGFhKeWmaFlecbrcoeDtNpZPRT7oWe', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'REA MINCHALO', '0201224359', '2970061', '0985465512', 1, 1, 3, 0, 0),
(220, 'GERMAN PATRICIO', 'germanátricio@yahoo.com', '$2y$10$mDKePw2NsqxwUNZA3olzkuznVj67r.TN7snGVEcMRVq1LZjCskbba', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'SANCHEZ CHÁVEZ', '0201416005', NULL, '0991970679', 1, 1, 4, 0, 0),
(221, 'JOSÉ SEGUNDO', 'prueba2@inteligenica.gob.ec', '$2y$10$0rJ6.nLVxwcS3pQKJRTFA.8/9yrihuXm5m40pIMRS0CKh9T6hK55O', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'GARZÓN PEREZ', '0201423019', NULL, '0990509584', 1, 1, 4, 0, 0),
(222, 'LUIS ALBERTO ', 'rea.gavilanez1962@yahoo.com', '$2y$10$rlkdJgW3mkZcvLOVXe5VyuvKVvrCj8tCDw9j.afTf7s4R4QNOtObS', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'REA GAVILÁNEZ', '0200750313', NULL, '0969575106', 1, 1, 4, 0, 0),
(223, 'YOLANDA SOFÍA', 'sofiazl@hotmail.com', '$2y$10$qwNQ74QLcV09XU8wNmEzCOBrvsycBlafjnaIcZ/SPPUslps4H0Eya', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'ZAMBRANO LEÓN ', '0201731551', '2550837', '0994279138', 1, 1, 3, 0, 0),
(224, 'VERÓNICA ALEXANDRA', 'v.silva@secap.gob.ec', '$2y$10$Sf4Od4kk2rzSDWe1q92EgeIU68W0kgfPKXfZxGuVZ1kR/3n5IhgDK', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'SILVA OLALLA', '0603990599', '2550837', '0987045852', 1, 1, 3, 0, 0),
(225, 'OMAR ', 'salinasmatiamiturismo@gmail.com', '$2y$10$acR/kHLah3B3wI08z.04g.HtbHJQ/t7euYdcQSQe5IYjrDHPiv0H.', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'TUAPANTA', '1803951308', NULL, '0995630095', 1, 1, 4, 0, 0);
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `apellidos`, `cedula`, `telefono`, `celular`, `tipo_fuente`, `sector_id`, `vsector_id`, `institucion_id`, `es_cs`) VALUES
(226, 'CESAR', 'cesarvlarrea@gmail.com', '$2y$10$VGAyeJMQHsCLM1j7kWFB1eDQVPhMi0pbGHzQAKyNP1mrEw1Of/gp.', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'LARREA VELA', '0201581949', '2646048', '0998907121', 1, 1, 3, 0, 0),
(227, 'LUCÍA ', 'deliaarguello_9@hotmail.com', '$2y$10$ssPkv1tbInX3VvT33AEphOT.yD95fxu4Iyk6LHG2pXuiO8WzrkFMS', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'ARGUELLO DOMINGUEZ', '0201547192', '2200085', '0990593233', 1, 1, 3, 0, 0),
(228, 'WILLIAM', 'eldurosa@hotmail.com', '$2y$10$u6lFoFg0tjf.ejUDYTkzM.J5/w0/4bS4.y6c6DkAJ3Q5cpH6X7GGS', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'RAMIREZ LÓPEZ', '1808328958', NULL, '0982480464', 1, 1, 4, 0, 0),
(229, 'HIBETH SHERALEE', 'bethshera@hotmail.com', '$2y$10$wzoWNxv3QAGRAkqxkJjarOBTDqz4tELJYDfC8wsynVJg2AT2uchJ.', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'VELARDE UBILLA', '0201922473', NULL, '0969014108', 1, 1, 4, 0, 0),
(230, 'MARTHA ', 'marthaarregui@turismo.gob.ec', '$2y$10$T92NJNcGPgeQn5SHrQd6B.pdgWpEvsRnVNZtdl11HxMer4NkiwEti', NULL, '2018-02-06 21:39:02', '2018-02-06 21:39:02', 'ARREGUI VEGA', '0201629169', '29551249', '0997660395', 1, 1, 3, 0, 0),
(231, 'BLANCA JESENNIA', 'bmerchan@senplades.gob.ec', '$2y$10$YyN.uj56cK6HxW/9rT.pKuTwQoQB0MgJrRqW8akO31jxIOhzN61ou', NULL, '2018-02-06 21:39:03', '2018-02-06 21:39:03', 'MERCHÁN ACOSTA', '0922334339', '04-38051110', '0983515444', 1, 1, 3, 0, 0),
(232, 'JOSE', 'prueba3@inteligenica.gob.ec', '$2y$10$lu/Dnok3h9JrfYGgDNGMi.PCzFa93g37I6zZTNpjzoMRbOChqzXXe', NULL, '2018-02-06 21:39:03', '2018-02-06 21:39:03', 'VISCAÍNO', '0200675387', NULL, '0090528924', 1, 1, 3, 0, 0),
(233, 'GALO', 'gavaconsa@hotmail.com', '$2y$10$vkG5j2T5s/2YPBO8wCvhrep1BPE6YFEXyyfsvXVCCjzD.sBsWyP/m', NULL, '2018-02-06 21:39:03', '2018-02-06 21:39:03', 'VASCONEZ', '0986042722', '03-2550779', '0986042722', 1, 1, 3, 0, 0),
(234, 'MAURICIO', 'amargo@gmail.com', '$2y$10$JkFvSYZql9/D5AzMqKTYPej7ifqA17aXuE6oV5sWplxQS8EBblZwi', NULL, '2018-02-06 21:39:03', '2018-02-06 21:39:03', 'MARTÍN', '0200269977', NULL, '0959107588', 1, 1, 3, 0, 0),
(235, 'MÓNICA', 'mbonillajoya@yahoo.es', '$2y$10$ga0V4QjKJRB4KpBwLvnZdeLaMvxUFxOFKrJgVc4NHVsdMT/jeRoXK', NULL, '2018-02-06 21:39:03', '2018-02-06 21:39:03', 'BONILLA', '0201896388', NULL, '0999616570', 1, 1, 4, 0, 0),
(236, 'Felix ', 'felixculqui@banecuador.fin.ec ', '$2y$10$0lK0fisiADRYgcAhPWYPoeE1WD0QKCt/LO.GsTxIgqDbR/2/LmjoK', NULL, '2018-02-07 01:05:58', '2018-02-07 01:05:58', 'Culqui ', '0201483716', '032551134', '0989224548', 1, 3, 3, 0, 0),
(237, 'Alexis ', 'alexistamayo@ambiente.gob.ec  ', '$2y$10$3yIckwFWxbhXfCqcMaCs1.lScQ1GLpu.1zXttjaZSxJ/KYyLYmisW', NULL, '2018-02-07 01:05:58', '2018-02-07 01:05:58', 'Tamayo ', '0201059441', '04-2281874', NULL, 1, 3, 3, 0, 0),
(238, 'Julio', 'julio córdova_20@yahoo.com ', '$2y$10$xJmwtM4XYZa9NPFKTBGK8.ElPIkAy0nWPApGmgMzL98EdQWp0b21q', NULL, '2018-02-07 01:05:58', '2018-02-07 01:05:58', ' Córdova ', '0201107349', NULL, '0988634067', 1, 3, 3, 0, 0),
(239, 'Mauricio', 'prueba4@inteligencia.gob.ec', '$2y$10$ez9wlFhS.T3GUrq9wrGZ4uVbUhqpp/jrEdBZPEljR/i3i8UOBcX3y', NULL, '2018-02-07 01:05:58', '2018-02-07 01:05:58', ' Martínez ', '0200209978', NULL, '0959107258', 1, 3, 3, 0, 0),
(240, 'Tula', 'tula_aguila@yahoo.es', '$2y$10$YvgIXrT/md6Rkxc0GGKj2.ucdj4cGz7zpnejqb0B9JrSFT96N8c2y', NULL, '2018-02-07 01:05:58', '2018-02-07 01:05:58', ' Águila Vargas', '1202210910', '32637027', '0994665810', 1, 3, 1, 0, 0),
(241, 'Jorge ', 'jorgecorderoruiz@gmail.com  ', '$2y$10$7j57ooTDGwFU.5Bnw7Y3KOQShXaf9uQWVRHoRkak8oflipUgPPMh6', NULL, '2018-02-07 01:05:58', '2018-02-07 01:05:58', 'Cordero ', '0201715687', NULL, '0991979363', 1, 3, 3, 0, 0),
(242, 'Mariana ', 'marisabelcal81@hotmail.com', '$2y$10$IbY2VlNL0e2S67f0g5Md8OAO5LuUgvCdKaDlJBovn9Am83MA731..', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Calero ', '0201652864', '03-2635183', '0988310160', 1, 3, 3, 0, 0),
(243, 'Fabricio ', 'fabriciosaltos@yahoo.com  ', '$2y$10$1v0.DK9JmV.8DVLZAYlk/eZipxK1py2dgmZ1r45YRoeVauYXzVh3O', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Saltos ', '0020104370', '03-02630349', '0098934241', 1, 3, 3, 0, 0),
(244, 'Alfonso ', 'idado3@hotmail.com', '$2y$10$PD5C6R/lTSlLLmzqVaNIrejjRfasRn4ic5FxEZv9rYOL4zqCiirOS', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Moreno ', '1709027997', NULL, '0996534212', 1, 3, 1, 0, 0),
(245, 'Carlos', 'carlos_gue@live.com', '$2y$10$Nq834GS2BCoeIV/9UJx.S.Y8RffGkEHtUWVdeIXBm7dRupOlUfFFy', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', ' Guerrero ', '0200683423', '032550205', '0992419940', 1, 3, 3, 0, 0),
(246, 'Holger ', 'Holger_azogue@yahoo.es ', '$2y$10$IAc412IT4ZJg7DyEvn9PseRBebyZ5M4NwLk3ABSW.gbB7ILW4OpJW', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Yanchalaquín ', '0201333390', NULL, '0980520078', 1, 3, 4, 0, 0),
(247, 'Gustavo ', 'gustavovargas87@gmail.com  ', '$2y$10$GEETDQBBBJqRoCxeTBOZfuaQqjKsHEy/1NOetzHK4m9V8yszPGtjm', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Vargas ', '0201381233', NULL, '0987459969', 1, 3, 4, 0, 0),
(248, 'Mariela ', 'mquinatoa@salinerito.com', '$2y$10$xkDsFAwhsfaNtblr9tVum.I5dShNTNY7B/Z68WV1bKb0NHKqAoPcC', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Quinatoa ', '1803388576', NULL, '0997853424', 1, 3, 4, 0, 0),
(249, 'Ubaldo ', 'ubaldo@tral.com  ', '$2y$10$gvuQS/HQ6U3vGYGX2XxLguOPYfDjD7i9jaGp1lxYcNattNZ7cEabu', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Toscano ', '0170474922', '03-2585244', NULL, 1, 3, 4, 0, 0),
(250, 'Elicio ', 'elicio.ramos@hotmail.com', '$2y$10$ZeHU31SqHWLByEOKMj6uSebKLXdfJxsOGZ4XVhxw.bfCKyIt.nPra', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Ramos', '0501815021', NULL, '0980235607', 1, 3, 4, 0, 0),
(251, 'Benjamín ', 'ben_520@live.com', '$2y$10$L7U.nCdlNczZwReWpuW1B.8PmavZB9a9gIgjGestayUUbB6H8ukgK', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Ramos Tixilema', '0100637577', NULL, NULL, 1, 3, 4, 0, 0),
(252, 'Hugo ', 'hayala@asomez.com', '$2y$10$8yVySul6VIAYg.SXdpJxtOeJqTMbvYyf5RYAc14.YqENvg6.UGl/y', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Ayala ', '1708038039', NULL, '0999426853', 1, 3, 4, 0, 0),
(253, 'Israel ', 'idarcan@guarandatc.fin.ec', '$2y$10$quzrS5aokZ9JK49jLJ/ROuLbZzMwAdkoOai8vyKgNt09aSaDCu9R.', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Alarcón Mestanza', '6201583967', '03-02551013', '0981689559', 1, 3, 4, 0, 0),
(254, 'Mery ', 'unocach2013@gmail.com', '$2y$10$dgD2DllPDa6x4anfsU0Hj.41a8a.IedBu9Cl710p.yr3oOn3RqCfa', NULL, '2018-02-07 01:05:59', '2018-02-07 01:05:59', 'Borja Cabezas', '0912280090', NULL, '0980298256', 1, 3, 4, 0, 0),
(255, 'Narcisa ', 'narcisaninobanda@yahoo.com  ', '$2y$10$SV23yRLjIR.ofSVW1XfwW.9U5pgmnOuWh.C1sbIK7Vg/QvGShSKcy', NULL, '2018-02-07 01:06:00', '2018-02-07 01:06:00', 'Ninobanda ', '0201736105', '03-2550078', '0991436640', 1, 3, 4, 0, 0),
(256, 'Vinicio ', 'salinerito@hotmail.com', '$2y$10$.rvJt2on.M3aNEalCrBpE.egcezFn.TjhEHZypvi162eOL233THq6', NULL, '2018-02-07 01:06:00', '2018-02-07 01:06:00', 'Ramírez ', '1802997831', '03-2210152', '0939611010', 1, 3, 4, 0, 0),
(257, 'Antonio López ', 'marlop_1723@hotmail.com', '$2y$10$UXtxfShWwL1aEiLNraYM5eX4rryqZwWiYgcK0sLoko3cxTDc0Lmja', NULL, '2018-02-07 01:06:00', '2018-02-07 01:06:00', 'López  López ', '0201814522', '03-2210209', '0988110759', 1, 3, 4, 0, 0),
(258, 'Luis ', 'lriverag@yahoo.com', '$2y$10$P3vDHrhI0duqI3ZDhDz.HOxUNwFVTAp2G1sXKBfPH2wPFCCfLJQN2', NULL, '2018-02-07 01:06:00', '2018-02-07 01:06:00', 'Rivera ', '0201015542', NULL, '0981401001', 1, 3, 4, 0, 0),
(259, 'Secretario', 'secretario@gmail.com', '$2y$10$3.OTpnHr5ibcA5BfFjnmduwBkOVfHXZvZY1okYeTto3KDHTSnf.ua', 'TDVXGDNXd8JyXWW0BtRhLcsOVuML1UqNTR71qMRMo6Z9jU7soPcXxZH959Hu', '2017-10-17 08:49:44', '2017-10-17 08:49:44', '', '', '', '', 3, 0, 0, 2, 0),
(260, 'Institución', 'institucion@gmail.com', '$2y$10$3.OTpnHr5ibcA5BfFjnmduwBkOVfHXZvZY1okYeTto3KDHTSnf.ua', 'XCINvd93WNZqfkAdP5HpgrcIEGzA9S8JnfDHcD4n7H6GPw3gKeGj8CCSm30E', '2017-10-17 08:49:44', '2017-10-17 08:49:44', '', '', '', '', 4, 0, 0, 2, 0),
(261, 'Ana Elizabeth Cox Vásconez', 'acox@mipro.gob.ec', '$2y$10$U4fVpv.DGpNXeDuS.eL.POZmHSN2mFS4vc8AhLv1.a7a2JjdbNr5S', 'boTlM5GluGVHrbD68oaACUlmJlhVtRW4cTGclxgFXTceXJC79BDhY5VWaRos', '2018-03-13 02:17:48', '2018-03-13 02:17:48', '', '1213141501', NULL, NULL, 4, 0, 0, 3, 0),
(262, 'Jean Steve Carrera López', 'jcarrera@mipro.gob.ec', '$2y$10$IHBnfwB5ue3nn0jLiqO52O2eymQtURJ/tboUhALV8e.a8GtNUwirG', 'd6urNAJcBqCsF6vMY9SdQWMarjmWN9MK3Lm8R88c7Z6iloBJpW4qAKeILOYj', '2018-03-13 02:20:30', '2018-03-13 02:20:30', '', '1213141502', NULL, NULL, 4, 0, 0, 3, 0),
(263, 'Alexis Dimitri Valencia Moreno', 'advalencia@mipro.gob.ec', '$2y$10$/SE3uIyqayk1eb0OcgSTZOrd/sQ5ZSXQEs1djTv3ipWAlWOfuOr.m', 'ukYopih5GaZshXXUbRRqd0jiOJtvaeHbbQwZGodpIAjHXf9310O18PajcDIG', '2018-03-13 02:21:43', '2018-03-13 02:21:43', '', '1213141503', NULL, NULL, 4, 0, 0, 3, 0),
(264, 'Roberto Estévez Echanique', 'restevez@mipro.gob.ec', '$2y$10$/YxTvuztOSfYvyEAFulmmeU9UNksR5E0V9jCcjzN5rhtYpi6.b7Xu', 'E67QONtRKn9DDFcVOgVyNVkPWNLXoL3rT6IC3redKVizIJoonglR4S8m8Zp7', '2018-03-13 02:22:34', '2018-03-13 02:22:34', '', '1213141504', NULL, NULL, 4, 0, 0, 3, 0),
(265, 'Jorge Ulises Chávez Ledesma', 'jchavez@mipro.gob.ec', '$2y$10$e1LtVcHbyr.6VW5P2K0a6e4JCNtu5TH40jzMiN4CiJt6TpeahCwqe', 'GlNhPUR4k3QJT7KAhUkAuNhubsAAxdnGKKKyYvGdiUauIvcAlwj63T7yf4rF', '2018-03-13 02:24:03', '2018-03-13 02:24:03', '', '1213141505', NULL, NULL, 4, 0, 0, 3, 0),
(266, 'Juan Francisco Ballen', 'jballen@mipro.gob.ec', '$2y$10$F9eVUQlumgYKD.K3SyUF..z1tAs1TPuYM9OGsP8Nb28Gt1dtySGTG', 'qmD7yYvd4qkRMibgb4DcBIf6cH8vc9ohoRMp3nLvRhlPwYJDVEZUnkV2nss1', '2018-03-13 02:30:02', '2018-03-13 02:30:02', '', '1213141506', NULL, NULL, 4, 0, 0, 3, 0),
(267, 'Oswaldo Pablo de la Torre Neira', 'pdelatorre@mipro.gob.ec', '$2y$10$nE8iFVQXnnfsNVrU7TJAnuAMOsIsIecA2OIdP9BShz09zPa2kKaNy', '0MPmXjUm2SQznzPYh82OdWo3ExfnCmjUmYxwkclSyuOqdqEN1J4WS5PAaCgR', '2018-03-13 02:31:09', '2018-03-13 02:31:09', '', '1213141508', NULL, NULL, 4, 0, 0, 3, 0),
(268, 'Hector Patricio Torres Torres', 'htorres@mipro.gob.ec', '$2y$10$2x/ikTrzWgCBuEFlNH1OtO4ebKKM49E.27Z86xQ9xnwHYYE/4H13e', 'tQbDHg0i6afz8YzaWoWlcvy77JFbvrPNqvZADQOF7rHkIjtVgvlG18FbOH7s', '2018-03-13 02:35:04', '2018-03-13 02:35:04', '', '1213141509', NULL, NULL, 4, 0, 0, 3, 0),
(269, 'Carolina Guanochanga Moreno', 'cguanochangacsp@mipro.gob.ec', '$2y$10$ostBu3K8vNj9oEstRSyeY.nIc0GhYfw4P3mGAPx0jzqyLAUzxS9XS', 'rU7JSkSoVk4OpjylJqn9IrmSSKokcYbk7oglPBYPK7hvXdNkxYze4lNrwH9O', '2018-03-13 02:36:06', '2018-03-13 02:36:06', '', '1213141510', NULL, NULL, 4, 0, 0, 3, 0),
(270, 'Rosa Beatríz Rodríguez Tamayo', 'rrodriguez@mipro.gob.ec', '$2y$10$u2Qym1BImfX4fOEO9Yh7WuAAoDBtQASBS2JM7qf9tS/8jK8do68my', 'cbiNPWSzCrrIPfoBptfpqJtlIanpOacizpD2DiBJGI3kR4nwv22rBQ7gLnng', '2018-03-13 02:38:05', '2018-03-13 02:38:05', '', '1213141511', NULL, NULL, 4, 0, 0, 3, 0),
(271, 'Ricardo Xavier Zambrano Pereira', 'rzambrano@mipro.gob.ec', '$2y$10$NnRj4MUkk/qHXlLCYDQsiegQQv7yOG1rYp9dyI9C9wLdx25TlkdBG', 'mkK8p1km0iqwsJgZTdXq1OqkPbBksyz4K0X69sPWszzRAagTCfpfu0BjBTSv', '2018-03-13 02:39:35', '2018-03-13 02:39:35', '', '1213141512', NULL, NULL, 4, 0, 0, 3, 0),
(272, 'Secretario Consejo', 'inteligencia@mipro.gob.ec', '$2y$10$1bu7lTiuaWu2n8Da5zQxXutWuQsciWZelIK1iQNEOmOQ2H66jW956', 'EDYZFoOxgTw81gC3go1NiBkKI26NijqCjeOKFm52IGAl4AEWzPsxtKBJ2ljl', '2018-03-14 19:08:50', '2018-03-14 19:08:50', '', '1213141513', NULL, NULL, 5, 0, 0, NULL, 0),
(273, 'Felipe Altamirano', 'faltamirano@mipro.gob.ec', '$2y$10$Nbs1cpncg3JFvsrgAzAXluE6wo1a34b.plRC39uVjRt2CtakmH/8a', 'cAzEVVRiN5X9fszPDzADvXwQ9QFf7FS9XrDNSbp0on1xs2UdbUHw8s7nzjIk', '2018-03-14 19:19:55', '2018-03-14 19:19:55', '', '1213141514', NULL, NULL, 5, 0, 0, NULL, 0),
(274, 'Claudio Arcos', 'cclaudio@mipro.gob.ec', '$2y$10$0sauTKpeUFyni5GpMPxn1.gJ7xisXPIiaZfj4hOjJRygqTz/hl/rK', 'Rf0m4jGtkYfcxQQ4KO8XGzcFhJW7GsLctdGID6Z6rC6zPCDqt11UwMwZfZV8', '2018-03-14 19:49:34', '2018-03-14 19:49:34', '', '1213141515', NULL, NULL, 4, 0, 0, 3, 0),
(275, 'HIDROCARBUROS', 'maria.haro@hidrocarburos', '$2y$10$ePbc3Koli4eCPBzsjYZ8uOLfMlrz2I9CEcdmeL/WKxU1jwfhCt9g.', NULL, '2018-03-16 23:25:42', '2018-03-16 23:25:42', '', '1306217890', NULL, NULL, 3, 0, 0, NULL, 0),
(277, 'SENAGUA', 'german.rodriguez@senagua.gob.ec', '$2y$10$C4svXfvaWwMi7eoCHdv89.XKQrmndZvuWCXVY5SEe6tRHsa.in2P2', NULL, '2018-03-20 02:49:20', '2018-03-20 02:49:20', '', '1000001763', NULL, NULL, 3, 0, 0, NULL, 0),
(278, 'Soledad Naranjo', 'soledad.naranjo@acuaculturaypesca.gob.ec', '$2y$10$3Dhy/YrzNcY9L6lOy.dSFOfS5qN67gu7l9hrikTaoaJpKhJXNx21m', 'RO53iKapZ5EKGIe7fixhrFYtqaISbMpPFI5ak1437T4pivWg0pMQ4jcDRLpl', '2018-03-22 01:36:32', '2018-03-22 01:36:32', '', '1213141520', NULL, NULL, 4, 0, 0, 2, 0),
(279, 'Ana Belén Noguera Ascázubi', 'anoguera@mag.gob.ec', '$2y$10$HwcOUnSAZbdB2OR2/AJMJ.Y042xj7szcPmpQ9UsjZwIm66XsCkeea', 'cYTi8qkCLOyS4GBpuh2YS11XWF0Po3C1MY04Xd7iP8GtquFbrGWOlG6svJ6f', '2018-03-22 01:36:53', '2018-03-22 01:36:53', '', '1213141521', NULL, NULL, 4, 0, 0, 1, 0),
(281, 'José David Recalde Rodríguez', 'jd.recalde@eeep.gob.ec', '$2y$10$J0HL.tLUK5nUNNs35hXvYei7TBYvrOFUa3lkowdw6bnEeOt1Zdpea', NULL, '2018-03-22 01:42:45', '2018-03-22 01:42:45', '', '1213141522', NULL, NULL, 4, 0, 0, 4, 0),
(282, 'SENESCYT', 'dcueva@senescyt.gob.ec', '$2y$10$U3Ajm.stBue9mWBzIDH5UuUSj0kbdm1xp21gkwP4sBIEH14mIoAf.', 'O1JJ6gyVEdULevlHsWDpUVtgfPuhx0fUrYc6PQiBWvOygOFkTYexftl6ldhd', '2018-04-17 16:19:43', '2018-04-17 16:19:43', '', '1306217891', NULL, NULL, 3, 0, 0, NULL, 0),
(283, 'MCEI', 'rita.cisneros@comercioexterior.gob.ec', '$2y$10$V8uYS8CmLhcz5DR9DJJaqu6evrg5eU5v3BhgMP.H.DKs/JcNvIAFy', 'xpNu9iNkNwA8L5lmI2yFw4Pz6cONssMEgCnduT9LpkrtD81F9E0RyChaWqVf', '2018-04-17 21:58:01', '2018-04-17 21:58:01', '', '1306217892', NULL, NULL, 3, 0, 0, NULL, 0),
(284, 'MARIA NATIVIDAD', 'inteligencia128@inteligencia.gob.ec', '$2y$10$f4jJErz9FZMNzlCbTgNsWOSNyFH/z7QjcalSJnYbC7KYzZSTTVinq', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'PASTUIZACA GUAMAN', '0301602637', '222', '0999034370', 1, 3, 4, NULL, 0),
(285, 'HONORIO MOISES', 'inteligencia129@inteligencia.gob.ec', '$2y$10$.8Mozak.Oizgw9JXVN.vm.Q6/6ECwR4X9usJalrhk3uK0DOMSYIl.', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'PASTUIZACA PAREDES', '0300669447', '222', '0998081855', 1, 3, 4, NULL, 0),
(286, 'JOSE PEDRO', 'inteligencia130@inteligencia.gob.ec', '$2y$10$PlA68FwGZz5dgtI.X3/AG.IxqTJLxd5xb9i2BxSvJj754Q.88r9w2', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'LEMA AREVALO', '0300342128', '222', '0999839307', 1, 3, 4, NULL, 0),
(287, 'SANTOS', 'inteligencia131@inteligencia.gob.ec', '$2y$10$Fy5FuLDLXl1ZsgwnwhBvPuKeEtyCI39znPJ/kp0KEZwbCix1Xhpw.', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'GUAMAN', '0300828243', '222', '0999839307', 1, 3, 4, NULL, 0),
(288, 'AIDA DEL ROCIO', 'inteligencia132@inteligencia.gob.ec', '$2y$10$vG6PLUAdjlq5XymgQ0sKfueIkPbqUSYLLkFyUPOsR0FC/GvagOtwe', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'FERNANDEZ BARRERA', '0300947926', '222', '0072230839', 1, 3, 4, NULL, 0),
(289, 'MARIA ZOILA', 'inteligencia133@inteligencia.gob.ec', '$2y$10$ASifoj1dQxHvZ92LOOP7Q.PIEk/8sHIBgVeGC3OKcXp204uiIsBAS', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'GUAMAN', '0602288243', '222', '0992848984', 1, 3, 4, NULL, 0),
(290, 'NUBE AZUCENA', 'inteligencia134@inteligencia.gob.ec', '$2y$10$bG9nhZvmXUc0OtTrqPklSeNAMONHzrSGLxCHhLSMAStoyVYs2twOe', NULL, '2018-05-23 16:06:22', '2018-05-23 16:06:22', 'GUIRACOCHA CAZHCO', ' 0301520227', '222', '0995137545', 1, 3, 4, NULL, 0),
(291, 'KARLA FERNANDA', 'inteligencia135@inteligencia.gob.ec', '$2y$10$tI2bh/SUx7/DAw3yzXBhE.9o6rP1ArHXtZVgPseCI67hoPQmw3cjW', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'QUITO SAULA', '0302210646', '222', '0991114389', 1, 3, 4, NULL, 0),
(292, 'ROSA MERCEDES', 'inteligencia136@inteligencia.gob.ec', '$2y$10$t7HNQUsjSvxMPCkaxlm0seJL7h8YxUnKD3YeYFhq4aWaalec3fW3u', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'CUENCA ZHAGÑAY', '0301947743', '222', '0995544465', 1, 3, 4, NULL, 0),
(293, 'EDISON RAUL', 'inteligencia138@inteligencia.gob.ec', '$2y$10$QdsQq0m/PhIkItTqlAqtNuOHa1MNnHPNgw85M./9OQQA1mBX3yYoO', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'BERNAL PATIÑO', '0301726345', '222', '0989557418', 1, 3, 4, NULL, 0),
(294, 'ABELINA MARIA', 'inteligencia139@inteligencia.gob.ec', '$2y$10$NN1YbNvW3qso.RgJ68THF.TUj41MMUZo81bj39QcpCvHYRt0QOwW.', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'CHABLA HUMALA', '0300856655', '222', '0984782687', 1, 3, 4, NULL, 0),
(295, 'JORGE', 'inteligencia140@inteligencia.gob.ec', '$2y$10$mDuHWO91spjs4QlEpzDQlem0UIZkUmp7daWepsXmtqKNcMNhxXvzi', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'MUÑOZ', '0302275191', '222', '0992973310', 1, 3, 4, NULL, 0),
(296, 'PEDRO', 'inteligencia141@inteligencia.gob.ec', '$2y$10$VBB7sWqEJTmRXmk42JfkK..PbxndToAtqnCh05kEDLoZgY1CRWkw6', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'MAYANCELA QUINDE', '0301312815', '222', '0983271412', 1, 3, 4, NULL, 0),
(297, 'MARIA ESTEFANIA', 'inteligencia142@inteligencia.gob.ec', '$2y$10$LkFmrsxj.4EZfn35770jyOVEVdrtnajagbOn8C16rzfBVkz/5zwWa', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'ACERO POMAVILLA', '0301312559', '222', '0999839307', 1, 3, 4, NULL, 0),
(298, 'LUIS HUMBERTO', 'inteligencia143@inteligencia.gob.ec', '$2y$10$w/F2LFePjWDzYNEVAYvwzeeAbjzvqoUQ1y45jvfEFfo1SrMQrHOWu', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'URGILEZ CHIMBORAZO', '0301154845', '222', '0995467731', 1, 3, 4, NULL, 0),
(299, 'BLANCA NUBE', 'inteligencia144@inteligencia.gob.ec', '$2y$10$Xylw01E5DdNkvuYiJQRCEOcpVj.lS01m0zaEP6hVhL0u4acxbA.Y.', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'FAJARDO MONTERO', '0301297388', '222', '0958753093', 1, 3, 4, NULL, 0),
(300, 'MARIA MAGDALENA', 'inteligencia145@inteligencia.gob.ec', '$2y$10$1ktVtP8Nq4YkgoBpHqvBiuZMJQbJ3yszSt6pw1wzSvqseLAR21CX2', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'ZUMBA MAYANCELA', '0301849527', '222', '0988834329', 1, 3, 4, NULL, 0),
(301, 'MARIA BLANCA', 'inteligencia146@inteligencia.gob.ec', '$2y$10$JGNfVwbysEC7mHIevU5zwuQiYN3ZYHeBcvZ8D08.dp2fMy8a.n2ke', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'QUIZHPI TAPIA', '0300874997', '222', '0984314707', 1, 3, 4, NULL, 0),
(302, 'ROCIO', 'inteligencia147@inteligencia.gob.ec', '$2y$10$Or9nlp9FNf1g5E6JlMYzQeuWPj8pUvNc3lHWY/aNU..OgxgC7xVai', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'AUQUI', '0300856986', '222', '0962792915', 1, 3, 4, NULL, 0),
(303, 'MARIA ALINA', 'inteligencia148@inteligencia.gob.ec', '$2y$10$byF3iMjEuY08UuakwwPRA.tYCy8FtKpwLxJV3nl7QN0HmJ4Ms5bBW', NULL, '2018-05-23 16:06:23', '2018-05-23 16:06:23', 'GALARZA ROMERO', '0300787835', '222', '0984566687', 1, 3, 4, NULL, 0),
(304, 'LUZ MARÍA', 'inteligencia150@inteligencia.gob.ec', '$2y$10$oPwaR0mQKZ/WDMGAgaKmw.uQQWSPZ7zqqAXs0WwwmkaFGv5hIXnAC', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'JERES LIMA ', '0300716875', '072230988', '02222', 1, 6, 4, NULL, 0),
(305, 'DOLORES', 'inteligencia151@inteligencia.gob.ec', '$2y$10$a2Az3s.JHVjsNQefUgu09OxQE.M.ml.k.Hf8EKP9v.faRM0slD4C6', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'GUALPA', '0300595998', '2222', '02222', 1, 6, 4, NULL, 0),
(306, 'LOURDES', 'inteligencia152@inteligencia.gob.ec', '$2y$10$T.xCja4IMepWiiBlOldYb.hwQ7oEtbU589kYH2ZocC15SnW6Dfeci', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'ROMERO', '0301411427', '2222', '0984722262', 1, 6, 4, NULL, 0),
(307, 'VIVIANA ', 'inteligencia153@inteligencia.gob.ec', '$2y$10$l.59OjEerjxOfATXaTCcUOj9qgI2Eoyn2X3V5MS3eAv4qMagA71cy', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'VIVAR', '0914219316', '2222', '0996155948', 1, 6, 4, NULL, 0),
(308, 'JORGE', 'inteligencia154@inteligencia.gob.ec', '$2y$10$Dom7YyH4fzSGl9wfzjgCleXe4RxIEgoJryv6TMI99CQ5Sx87XND82', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'MUÑOZ', '0302235197', '2222', '0992355320', 1, 6, 4, NULL, 0),
(309, 'IVAN ', 'frgarcia@ucacue.edu.ec', '$2y$10$m41SBQL4WrqQcCXSW0Sqa.16QCAZ59x99w2d1DoElb3.zfFdfzd7u', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'GARCIA ALVAREZ', '0300682705', '2222', '0987237055', 1, 6, 4, NULL, 0),
(310, 'OLGER', 'waranxy@hotmail.com', '$2y$10$nX9a.w85pxyol6wID1Cp5ex5GTSBhzCNBZxGuU7nBWfnHLLL6PVua', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'MOROCHO VASQUEZ', '0302603188', '2222', NULL, 1, 6, 4, NULL, 0),
(311, 'JUAN ', 'juan.1972@hotmail.com', '$2y$10$wdUAax/n.zoTX2ye60oQH.MDYgrCzA9JQN5xmK.EWQzmzmiVdzzwa', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'SOLIS', '0301183539', '2222', '0994756368', 1, 6, 4, NULL, 0),
(312, 'MANUEL', 'inteligencia156@inteligencia.gob.ec', '$2y$10$d3UPPInecovaN.PBaFCzjOt3k7I626Gwh0ilBKMe2rf6YGw1IQEne', NULL, '2018-05-23 16:44:40', '2018-05-23 16:44:40', 'PALAGUACHI', '0300641909', '2222', '0998097493', 1, 6, 4, NULL, 0),
(313, 'LUIS GAVINO', 'lugavino1@hotmail.com', '$2y$10$YQVpxAlY0lFLWREdUAN9GOIN0Lqx0aD0SfC1qmbGkUakdbBtR8L0a', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'ROJAS', '0300571353', '072219010', '0998427042', 1, 6, 4, NULL, 0),
(314, 'MARIA ANGELA ', 'inteligencia160@inteligencia.gob.ec', '$2y$10$zbbXttdvL8N532cisKstpeDGn1aABjttLIiduWo2OqUdgWAh1igcy', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'DUTAN ', '0300268661', '072231705', '02222', 1, 6, 4, NULL, 0),
(315, 'MANUEL JESÚS ', 'inteligencia161@inteligencia.gob.ec', '$2y$10$E.znxWnci/jyeQxibOKXoOYf27.093GfYtY72yfF/fINN45L5r9/a', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'GUAMÁN ', '0300556412', '2222', '02222', 1, 6, 4, NULL, 0),
(316, 'BLANCA', 'inteligencia162@inteligencia.gob.ec', '$2y$10$kyKWJEXgi3credHInrYKTe1ej5UwRelejWwDNly0Xuz455gcTnPru', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'GÓMEZ', '0300843695', '2222', '02222', 1, 6, 4, NULL, 0),
(317, 'FANNY DE NUBE ', 'inteligencia163@inteligencia.gob.ec', '$2y$10$pq6YMj8jbyzLriefWx9ek.zugD8GR3fbJmX458Zcb60bUB74sxZWW', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'TAPIA', '0307264198', '2222', '0999794347', 1, 6, 4, NULL, 0),
(318, 'ROSA', 'inteligencia164@inteligencia.gob.ec', '$2y$10$p3OU1gxc/4Cw0AVmMqMIF.LCkRPKl7GCq3PJtlFww6pNzUTVRR3Jm', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'GUALPA', '0300641263', '072177083', '02222', 1, 6, 4, NULL, 0),
(319, 'MARIA NOEMI', 'inteligencia165@inteligencia.gob.ec', '$2y$10$4zgt9GfOtJnfknByfV.NOubV/AtmPU4IHsJd7nL0W3lMtodPU63NG', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'PINGUIL ', '0300549219', '2222', '02222', 1, 6, 4, NULL, 0),
(320, 'CARMEN ', 'inteligencia166@inteligencia.gob.ec', '$2y$10$vLp.TAA0zBFHFfLNX.XzFOUHra485f.onHdqTrhyhRfUlE9EGnO4e', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'GUAMÁN ', '0300471232', '2222', '0099549487', 1, 6, 4, NULL, 0),
(321, 'EDELINA ', 'inteligencia167@inteligencia.gob.ec', '$2y$10$An60OAEKg8vyE8b3OqARyOQj.F94emOOzAnnxKG45sEFLa52ltoOu', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'PINGUIL ', '0300846561', '2222', '02222', 1, 6, 4, NULL, 0),
(322, 'PAOLA ', 'inteligencia168@inteligencia.gob.ec', '$2y$10$czvXLDV9H5hleXX/cKinN.uk6iifzWPCh8w3zsiQAzCQLhrDWfC5u', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'MORENO', '0103483129', '2222', '0994041251', 1, 6, 4, NULL, 0),
(323, 'MARTHA CECILIA ', 'inteligencia170@inteligencia.gob.ec', '$2y$10$/xL4Y2jXYkgFXHvaZN3TROgwikCmArOd7jHSGvDaoevCGmEoMm2wu', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'LEMA', '0301630240', '072231291', '02222', 1, 6, 4, NULL, 0),
(324, 'LUCIA', 'inteligencia171@inteligencia.gob.ec', '$2y$10$TZ/YKZ2vpcy1wKB0y9JVpOHrRUpegSQQQRrrEm2uu.hZWhy31Bgqi', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'ESPINOZA', '0301091229', '072231999', '02222', 1, 6, 4, NULL, 0),
(325, 'EVANGELINA ', 'inteligencia172@inteligencia.gob.ec', '$2y$10$7Vfxtt8JAcJKZi24fu4ayOybS6RMBaNzn7DcaW1MR5/RALmApzz6S', NULL, '2018-05-23 16:44:41', '2018-05-23 16:44:41', 'MARTINEZ', '0300417524', '072231524', '02222', 1, 6, 4, NULL, 0),
(326, 'GLORIA MARIA', 'inteligencia173@inteligencia.gob.ec', '$2y$10$31G9pteegCXKUompJXlTBOQeHaTOpwkbDPmZVb8m0C7u.P07qS/tG', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'SANMARTIN', '0301095840', '072230977', '02222', 1, 6, 4, NULL, 0),
(327, 'MIGUEL ANGEL ', 'inteligencia174@inteligencia.gob.ec', '$2y$10$Aj/uVntWz6UdwC55F4FoIOYKgu16BcJOEn1.7zwn6JBIPzfz6A8A2', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'ACEVEDO ', '0300592680', '072231308', '02222', 1, 6, 4, NULL, 0),
(328, 'FLOR ALEXANDRA ', 'inteligencia175@inteligencia.gob.ec', '$2y$10$kAuPo5slwJwd0j/01lWyEurvRhbmBhtWDDWIViBI00JSdXt4t7ZYm', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'ACEVEDO ', '0302029921', '072231308', '0969020116', 1, 6, 4, NULL, 0),
(329, 'SORAIDA', 'inteligencia176@inteligencia.gob.ec', '$2y$10$n8fGwJVdrplG4VNuyw/4d.VL0KFn4zycmA9EOg74ljKdwxtHtBpu2', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'SUQUILEMA', '0302102645', '073055488', '02222', 1, 6, 4, NULL, 0),
(330, 'NARCIZA AZUCENA', 'nareyesc@ucacue.edu.ec', '$2y$10$UvV8kQVZALpDE1ztbLKOz.oseToLBorvFTmXOlA3qSXtrc6ggQXFa', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'REYES CARDENAS', '0300959202', '072243444 Ext. 2', '0998086488', 1, 6, 4, NULL, 0),
(331, 'JUAN DIEGO ', 'jdochoac@ucacue.edu.ec', '$2y$10$m1rAnDeMvLvjcXMOSK/aJOdFO7l8synOfg6UzOZ24KnztFCRsC6WO', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'OCHOA', '0301747143', '072243444 Ext. 2', '0984162043', 1, 6, 4, NULL, 0),
(332, 'MARTHA', 'marthaabadcalderon@hotmail.com', '$2y$10$IuuHZWTq6mGpw013.bUQ0.3t1ZyqUGHVvtdRkU4oUNii6BRd0HJ8m', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'ABAD', '0301026639', '2222', '0995107037', 1, 6, 4, NULL, 0),
(333, 'ISRAEL ', 'rociocallecalle2462@hotmail.com', '$2y$10$svWxr0AC3T0SuTNeNOF87OcYgM15WmHWtOBGa5aBe3gw.HfQsWZlC', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'CALLE', '0300830106', '072242449', '0998107819', 1, 6, 4, NULL, 0),
(334, 'JUAN CARLOS ', 'jc-creativa@hotmail.com', '$2y$10$dSmG1XTbYgBOTdS5W/nY.uiOuzGr3k993MXwPMohUK9NIssNE1JIC', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'LATACELA', '0301499018', '072247855', '0984887446', 1, 6, 4, NULL, 0),
(335, 'FABIAN ', 'framirezv@ucacue.edu.ec', '$2y$10$31bQ7pOdaj4AVR0keMBdVe9VaTz80HYjhW5pAVV7/dmNdGStZq5La', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'RAMIREZ', '0301162996', '072174544', '0996441171', 1, 6, 4, NULL, 0),
(336, 'CORNELIO', 'inteligencia177@inteligencia.gob.ec', '$2y$10$ci/WAYhJj3ksdprJZOwa2OttLI1KazmA71TvSd8CzCYDMYQH96E8e', NULL, '2018-05-23 16:44:42', '2018-05-23 16:44:42', 'PRIETO', '0300766797', '072240678', '0999744608', 1, 6, 4, NULL, 0),
(337, 'GERMAN ', 'batista.j29@hotmail.com', '$2y$10$oI8FHDre8Zal72HDB7OCe.lxTXWFlyqiu2Dls4WcHK8.yXPuw8K2a', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'BAUTISTA JIMENEZ', '1900227370', '222', '0997432423', 1, 3, 4, NULL, 0),
(338, 'KLEBER', 'isaisfebrero@hotmail.es', '$2y$10$ozXRdRdZG2rk/MIJl13SleuTMxry4871nHgGe5BNKN.hh1VCO13Hi', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'QUEZADA BANEGAS', '1900803584', '222', '0985145318', 1, 3, 4, NULL, 0),
(339, 'JULIO', 'tuliocoh@hotmail.com', '$2y$10$kOUH1RC179mMUB5o1zSfy.OYq3AcEIIN9dSd3Ponky/DBk2xTYqpC', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'ONTANEDA HIDALGO', '1103470835', '222', '0991115092', 1, 3, 3, NULL, 0),
(340, 'JHONY FABIAN', 'jhony_chamba29@hotmail.com', '$2y$10$/k6VFCnaNlfRskBvQuSAhOvPdHO4Q5zbyMpgvJqCqt.N/55bX8oj2', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'CHAMBA PUGLLA', '1900604404', '222', '0982846995', 1, 3, 3, NULL, 0),
(341, 'OTTO EDUBERT', 'otto.montaval@controlsanitario.gob.ec', '$2y$10$m4jscRQFU33yDp2uCDBWK.NwQHB1GExHbWr5pB3AI6ZHYn58vPpm.', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'MONTALVAN', '1103281240', '222', '0968028753', 1, 3, 3, NULL, 0),
(342, 'CARLOS BYRON', 'ccastillo@mag.gob.ec', '$2y$10$Df40gsn0C2brHWqd4brj8u6c7vrueexMjvVbhilISY9wnok3dgKfW', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'CASTILLO D', '1900352624', '222', '0997980499', 1, 3, 3, NULL, 0),
(343, 'FABIAN MIGUEL ', 'fcarrillo@mag.gob.ec', '$2y$10$Xw0ziDsjpE6h2ss5.MEc6eKbj5GZ8s1lcTPWVZ/dQFJGlaZJnHqxW', NULL, '2018-05-23 19:41:02', '2018-05-23 19:41:02', 'CARRILLO R', '0604139311', '222', '0998454750', 1, 3, 3, NULL, 0),
(344, 'RENE', 'yogurtakky_@hotmail.com', '$2y$10$cOr/.FU1DsZEiHTNYInpBeoWTOmKZEPLwhBvOfxEYcshsRr6545fa', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'LOJANO', '1900430958', '222', '0992441376', 1, 3, 4, NULL, 0),
(345, 'TROTSKY', 'trotsky.guerrrero@ieps.gob.ec', '$2y$10$rH1Jlin6pFMbtXa.pYTpIuZGRZY2keu5Wam2fJu8dinguFQ4PRPaG', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'GUERRERO', '1103323679', '2608194', '0984863655', 1, 3, 3, NULL, 0),
(346, 'EUGENIO', 'agropzachin@gmail.com', '$2y$10$AZsxAy77Pp5YGsC4xzt0EegqQv2Mu8GCgIAA1wCC8X1DIduLEC9qq', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'REYES', '1900075910', '2117020', '0099353670', 1, 3, 3, NULL, 0),
(347, 'NORA', 'jefeproduccion@apeosae.com', '$2y$10$fb1b7Fyayy/6HrwIxuSdzOgI99UvU2x3hBRwNwMfOqH2t7Z630X46', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'RAMON LABANDA', '1103662977', NULL, '0999351801', 1, 3, 4, NULL, 0),
(348, 'MONICA', 'presidencia@apeosae.com', '$2y$10$eXaigtp6kJdHSjL2DSnjuez8BLS7CROwqTaIDWmb2ndBlS/0INBRO', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'GUAMAN', '1900338839', '3037580', '0986850120', 1, 3, 4, NULL, 0),
(349, 'CARLOS', 'carloscajamarcaquezada@hotmail.com', '$2y$10$YZNAT3UVGuBK7NYscJmocug4SCqCMvsZ0MCku64tnsERYNLik4kb.', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'CAJAMARCA QUEZADA', '1100098001', '2119600', '0983601498', 1, 3, 4, NULL, 0),
(350, 'OLGA MARIA', 'inteligencia1212@inteligencia.com', '$2y$10$8t4fdDGhCdRacclnPX3Duua5940daOjgsPlFPvr0/lPHvYCK7taru', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'SARANGO ULLOA', '1900289420', NULL, '0988131750', 1, 3, 4, NULL, 0),
(351, 'VILMA M', 'vilimariana15mar@yahoo.com', '$2y$10$OrvusYm0MPUyaXjs/v1zSuwSMTcwFuV7Cz2uqkPYwq/ZAz8hwSvRC', NULL, '2018-05-23 19:41:03', '2018-05-23 19:41:03', 'TAIZHA ORTEGA', '1900288562', '3036339', '0900505621', 1, 3, 3, NULL, 0),
(354, 'MARIA PETRONA', 'inteligencia1222@inteligencia.com', '$2y$10$vnVHq8vYu.LWnoPmTKNG7uRBIqGWqyiJSuzN03M2I3HnMINnR7AiO', NULL, '2018-05-23 19:41:39', '2018-05-23 19:41:39', 'GONSALES', '1900461920', NULL, '0992168795', 1, 3, 4, NULL, 0),
(355, 'MARIA PIEDAD', 'piacuen1981@hotmail.com', '$2y$10$A/7uXPwIY1e5CXGRCZ0Cf.A8A5XQ4Q.7xjOxCUvw2OORh8IralIma', NULL, '2018-05-23 19:41:39', '2018-05-23 19:41:39', 'CUENCA ', '1900447287', NULL, '0985888264', 1, 3, 3, NULL, 0),
(356, 'MAURA DORALIZA', 'maura.dsanchez@hotmail.com', '$2y$10$XF1rBqGMgjAt8otj73kmy.wP93xqS1zKZMA008CbkMp2AxpzOv5xq', NULL, '2018-05-23 19:41:39', '2018-05-23 19:41:39', 'SANCHEZ', '0701457947', '2300276', '0990530973', 1, 3, 4, NULL, 0),
(357, 'JAIME NOLBERTO', 'jaime.ramos56@yahoo.es', '$2y$10$msjZnlGb24/PeK6iRi/elO8lHM8NhGfKH8s1c460HoZ.DfYGooDV6', NULL, '2018-05-23 19:41:39', '2018-05-23 19:41:39', 'RAMOS OJEDA', '1900628627', '2605305', '0959517886', 1, 3, 3, NULL, 0),
(358, 'BYRON RAIMUNDO', 'byronochoa80@hotmail.com', '$2y$10$1n0TrZRbltDYSpBg3aGC5OnPGx4/6tSDqOCqvTnCeTjs5SGimtnXK', NULL, '2018-05-23 19:41:39', '2018-05-23 19:41:39', 'OCHOA ALVAREZ', '1103668362', '3037161', '0995619962', 1, 3, 3, NULL, 0),
(359, 'VANESA ', 'lady.rojas@acuacultura', '$2y$10$xQojkACW3RSN504bHaTa2eJF.wlgf/gYWElVEPCObMd5sz/C3RStm', NULL, '2018-05-23 19:47:44', '2018-05-23 19:47:44', 'ROJAS A.', '1103345854', NULL, '0991132000', 1, 2, 3, NULL, 0),
(360, 'DARIO', 'dario.maldonado@gmail.com', '$2y$10$KekottSxT/T6PPWOIWuLq.gQ/o7qu1J2RTJjx6WcJxcPsmGyU1tgq', NULL, '2018-05-23 19:47:44', '2018-05-23 19:47:44', 'MALDONADO ', '1103586630', NULL, '0969665165', 1, 2, 4, NULL, 0),
(363, 'SEBASTIAN', 'dario.maldonado3@gmail.com', '$2y$10$ARXR3Rb8cjuMPvTTwMVCdeRanWaTsju4VT229rexUBFNi/Fn4BisW', NULL, '2018-05-23 19:48:51', '2018-05-23 19:48:51', 'GUALAN', '1102779178', NULL, '0990112803', 1, 2, 4, NULL, 0),
(364, 'ANA LUCIA ', 'anasacatene@gmail.com', '$2y$10$obl0rsgwMqctVKWitb.kSe6/Ma1wCKmKGQWD4LTk39qs4meq9jgJi', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'SACA', '1900754530', NULL, '0939680866', 1, 2, 4, NULL, 0),
(365, 'LENIN ', 'acualensa@hotmail.com', '$2y$10$xDKQdBdyqc8XgoDC1kjVHev7L8tSUtGAtojQiE2ukMLBdFmxwza2e', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'MORENO ', '1103572051', NULL, '0994624049', 1, 2, 4, NULL, 0),
(366, 'KARLA ', 'chambalopez@981@gmail.com', '$2y$10$Z50Z/vuiju4cNxQ5221.vO/V9Rl1Xi5bGIagNpmXz/9Pxo3BdrzPu', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'CHAMBA ', '1900431336', NULL, '0991356859', 1, 2, 4, NULL, 0),
(367, 'DIANA ', 'inteligencia789@inteligencia.com', '$2y$10$qH93lR9A3IxP52BLZFA78OUXed7RWPITB8wcCtNGouRlhjzgT0qlK', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'JIRON ', '1900466408', NULL, NULL, 1, 2, 4, NULL, 0),
(368, 'HERMINIA YOLANDA ', 'inteligencia1235@inteligencia.com', '$2y$10$HCe2PWTZ.2lltrcrDfiyL./w4C3c.iaXgmP2hTlcHTGrXb75uKeWy', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'RAMON TORRES ', '1101824595', NULL, '0967222558', 1, 2, 4, NULL, 0),
(369, 'PAULA TEREZA', 'inteligencia1236@inteligencia.com', '$2y$10$IT2mbt6zku3el7V200PZe.o9lfA09xLwxPqDGNs2mXkT4lJxdRM7y', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'ATIENCIA ', '1900258532', NULL, '0981817269', 1, 2, 4, NULL, 0),
(370, 'MISHEL CAROLINA ', 'inteligencia1237@inteligencia.com', '$2y$10$kzJWcxSM5F.4VLenM9pjg.BjydSPNsWB8NMQamsIuTYT5xlu.plga', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'UJUKAM ', '1950008035', NULL, NULL, 1, 2, 4, NULL, 0),
(371, 'ROSA ', 'inteligencia1238@inteligencia.com', '$2y$10$SJeDeYnVU6y/9E2hykrpPe.fzxAzFf.XUy8JTeMztiwvuHTr/AvxO', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'AGUILAR ', '1900278126', NULL, '0991846238', 1, 2, 4, NULL, 0),
(372, 'MARIA ISABLE ', 'inteligencia1239@inteligencia.com', '$2y$10$HYa9PEzTcGnNfhezpyKJju/5/oH3Y1htRP2ea6ZK28QdZDq.JfdWC', NULL, '2018-05-23 19:48:52', '2018-05-23 19:48:52', 'TENE POMA ', '1900289263', NULL, '0939680866', 1, 2, 4, NULL, 0),
(373, 'MIGUEL ANTONIO', 'toniguaman@hotmail.com', '$2y$10$H.Bgkev1RtBzR2nT8rZPyO4hoByC2vqWX4kYSMgDp.3GUSIavdED6', NULL, '2018-05-23 20:28:42', '2018-05-23 20:28:42', 'GUAMAN', '0 703547168', NULL, '0979407131', 1, 5, 4, NULL, 0),
(374, 'DALTON ', 'daltonceli1857@hotmail.com', '$2y$10$47z/K.s5FI3aJeQIjaSYDevLwVRsxv5498SS19r2Eol9.oxBfWV0y', NULL, '2018-05-23 20:28:42', '2018-05-23 20:28:42', 'CELI CELI', '1900126085', '2300063', '0997009005', 1, 5, 4, NULL, 0),
(375, 'DIEGO M.', 'diego.bejarano@ant.gob.ec', '$2y$10$sAzvJyGVM2m4Gs5pncmsF.riTYSyJEnuFB6ezFlMMANqw/0miQCHK', NULL, '2018-05-23 20:28:42', '2018-05-23 20:28:42', 'BEJARANO', '1900340699', '2608192', '0984163926', 1, 5, 3, NULL, 0),
(376, 'ROSSI ICONOR', 'rossi_cuenca@ant.gob.ec', '$2y$10$ZpebqwLluAGjAwwj5UgzZOCfZy/kA/qVH5ZVb6UK/fCO69/etDkfq', NULL, '2018-05-23 20:28:43', '2018-05-23 20:28:43', 'CUENCA', '1104134372', '2605281', '0996770507', 1, 5, 3, NULL, 0),
(377, 'GLENDA', 'gmedina@mtop.gob.ec', '$2y$10$yO1iyV1HIYYQO//ffssbi.aWcgcx.kevHHEIAh/PLzrxhPtheuriS', NULL, '2018-05-23 20:28:43', '2018-05-23 20:28:43', 'MEDINA MEDINA', '1900355626', NULL, '0959198956', 1, 5, 3, NULL, 0),
(378, 'Karla Lisbeth ', 'lis3oct@hotmail.com', '$2y$10$Cnqrgc7K9jl0sjQ.TsoV/uGL3GewU7LSXHjfWy23pmKz0.RYvKMJ2', NULL, '2018-05-23 20:35:28', '2018-05-23 20:35:28', 'Abad Jiménez', '1900843473', NULL, '0959603234', 1, 6, 1, NULL, 0),
(379, 'Nelson Anibal', 'nelson1940m@hotmail.com', '$2y$10$MJbwZ4p.YaeAlVJQhoi9kuYzoXACv6XrPTlMbyBa9M2mIPFJJQkee', NULL, '2018-05-23 20:35:28', '2018-05-23 20:35:28', 'Morocho Correa', '1100045168', NULL, '0980216460', 1, 6, 4, NULL, 0),
(380, 'Brigite Margoth', 'bmpatino@sri.gob.ec', '$2y$10$U4GJuKTFhsq29J1CY3Vk..6H/xWXgtGc8pxciWq01EdhVkEiCr5Rm', NULL, '2018-05-23 20:35:29', '2018-05-23 20:35:29', 'Patiño Ramón', '1103042345', NULL, '0992294510', 1, 6, 3, NULL, 0),
(381, 'Elsa Polonia', 'inteligencia1299@mipro.gob.ec', '$2y$10$T0Zn5i5sO1d1Aw2/4S821.13XxiAtbCZZG42PfG0MsbjgVoCnZbXe', NULL, '2018-05-23 20:35:29', '2018-05-23 20:35:29', 'Tinitana Jumbo', '1900219856', NULL, '0990802018', 1, 6, 4, NULL, 0),
(382, 'Yolanda ', 'inteligencia1259@mipro.gob.ec', '$2y$10$.4iE4dVx7hR73kFfjHrE3eFlMFCubelFZ3WFwuOLqXg7xblsDFJY6', NULL, '2018-05-23 20:35:29', '2018-05-23 20:35:29', 'Rueda Jumbo', '1900119221', NULL, '0967911457', 1, 6, 4, NULL, 0),
(383, 'Virman Mariela', 'angelitomelodi@gmail.com', '$2y$10$nRrhZ7TPACIw2bp3xqmQuuscG9upm1OTZF7BV/rRaDZ0Rzfd2u6qq', NULL, '2018-05-23 20:35:29', '2018-05-23 20:35:29', 'Abrigo Sarango', '1900789064', NULL, '0968213935', 1, 6, 4, NULL, 0),
(384, 'Jose Noe ', 'inteligencia5345@inteligencia.com', '$2y$10$f.N3QT6xUSJ/3f2YrD3IjOaLhvMxr3L/uJU/eyR2wEaelzWgC0GF2', NULL, '2018-05-23 20:43:37', '2018-05-23 20:43:37', 'Guaillas', '1100165859', NULL, '0997775495', 1, 1, 4, NULL, 0),
(385, 'Marco', 'dmarcosbar@hotmail.com', '$2y$10$UCZF.nroJvcA.0ovNZWqSu7H5NkhfJA4QtUt.5IEOJRTy5kV2vGzO', NULL, '2018-05-23 20:43:38', '2018-05-23 20:43:38', 'Cevallos ', '0703563619', NULL, '0992162288', 1, 1, 4, NULL, 0),
(386, 'Guilman', 'inteligencia5346@inteligencia.com', '$2y$10$uAxDAX2a7QJmoFAkvw869u02HTioFqb9lOConCDPV43He7J1KPzrS', NULL, '2018-05-23 20:43:38', '2018-05-23 20:43:38', 'Espinosa ', '1102044722', NULL, '0988928542', 1, 1, 4, NULL, 0),
(387, 'Darlin Alexander', 'darlin-1991@hotmail.com', '$2y$10$6BhI13kH32eoUwWTe1cxHOIW6vmqj6MjbxZ307vTluw0dMbOlsnu2', NULL, '2018-05-23 20:43:38', '2018-05-23 20:43:38', 'Espinosa Gaona', '1900744564', '2300791', NULL, 1, 1, 4, NULL, 0),
(388, 'Paul Jose', 'paul.pardo@turismo.gob.ec', '$2y$10$uEGGPz7d30Ja9mG9JpQ9GOYTq8oXyJ9WfuzkFACKniAZBRKZH6mKC', NULL, '2018-05-23 20:43:38', '2018-05-23 20:43:38', 'Pardo Villalta ', '1103773469', '8606466 ext 2775', '0995986681', 1, 1, 3, NULL, 0),
(389, 'Ana Patricia', 'aparmijos@utpl.edu.ec', '$2y$10$lnXs3eYSInrYGF7.66W38eG6AjACoq19Ywg96g4t/RLnfNpajfBdO', NULL, '2018-05-23 20:43:38', '2018-05-23 20:43:38', 'Armijos Maurad ', '1103348346', NULL, '0984976248', 1, 1, 4, NULL, 0),
(390, 'Mauricio ', 'mpartiedo@utpl.edu.ec', '$2y$10$p.ncyRmI6Sw5uxLDq9mf0.iJwGipNUvDw1eElK4n5s1eLB15naK1a', NULL, '2018-05-23 20:43:38', '2018-05-23 20:43:38', 'Artiedo Ponce ', '1002155214', NULL, '0980252502', 1, 1, 4, NULL, 0),
(391, 'SECOB', 'dadiaz@secob.gob.ec', '$2y$10$3.OTpnHr5ibcA5BfFjnmduwBkOVfHXZvZY1okYeTto3KDHTSnf.ua', NULL, '2018-05-24 20:55:05', '2018-05-24 20:55:05', '', '1306217894', NULL, NULL, 3, 0, 0, NULL, 0),
(392, 'DIRNEA', 'fespinoza@armada.mil.ec', '$2y$10$3.OTpnHr5ibcA5BfFjnmduwBkOVfHXZvZY1okYeTto3KDHTSnf.ua', 'ROvtK8mxqEkMTOCuOzbAmlaqOMPdLyl3V9wgvd9GtlWyqbA1bdyCfrzTC5Yp', '2018-05-24 21:28:50', '2018-05-24 21:28:50', '', '1306217895', NULL, NULL, 3, 0, 0, NULL, 0),
(393, 'MDT-CS', 'liliana_paredes_consejo@trabajo.gob.ec', '$2y$10$EFzLFYI2sRSr2hqi5g9WQ.0P0pw0C3XU4EehIGmmH1ePtS/tmHxkK', '4IernwKGi4oPGo3UVLoOJFfB0IFM1WHRA4pOQM0cNGsRSh2xj0Lp5tE4CydF', '2018-01-10 02:20:08', '2018-01-10 02:20:08', '', '1720208808', NULL, NULL, 3, 0, 0, 0, 1),
(403, 'usuario', 'csgallardof103@gmail.com', '$2y$10$8RZeJbP4m774TdwxDaYA2.ajf2.2DGm9nmV2a2gBbxUyWg41snYc.', NULL, '2018-09-03 15:42:36', '2018-09-03 15:42:36', 'carlos', '1709219102', '2222', '9999', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_evento_solucion`
--

CREATE TABLE `user_evento_solucion` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_evento_solucion`
--

INSERT INTO `user_evento_solucion` (`id`, `user_id`, `evento_id`, `created_at`, `updated_at`) VALUES
(1, 132, 1, NULL, NULL),
(2, 133, 1, NULL, NULL),
(3, 134, 1, NULL, NULL),
(4, 135, 1, NULL, NULL),
(5, 136, 1, NULL, NULL),
(6, 137, 1, NULL, NULL),
(7, 138, 1, NULL, NULL),
(8, 139, 1, NULL, NULL),
(9, 140, 1, NULL, NULL),
(10, 141, 2, NULL, NULL),
(11, 142, 2, NULL, NULL),
(12, 143, 2, NULL, NULL),
(13, 144, 2, NULL, NULL),
(14, 145, 2, NULL, NULL),
(15, 146, 2, NULL, NULL),
(16, 147, 2, NULL, NULL),
(17, 148, 2, NULL, NULL),
(18, 149, 2, NULL, NULL),
(19, 150, 2, NULL, NULL),
(20, 151, 2, NULL, NULL),
(21, 152, 2, NULL, NULL),
(22, 153, 2, NULL, NULL),
(23, 154, 2, NULL, NULL),
(24, 155, 2, NULL, NULL),
(25, 156, 2, NULL, NULL),
(26, 157, 3, NULL, NULL),
(27, 158, 3, NULL, NULL),
(28, 159, 3, NULL, NULL),
(29, 160, 3, NULL, NULL),
(30, 161, 3, NULL, NULL),
(31, 162, 3, NULL, NULL),
(32, 163, 3, NULL, NULL),
(33, 164, 3, NULL, NULL),
(34, 165, 3, NULL, NULL),
(35, 166, 3, NULL, NULL),
(36, 167, 3, NULL, NULL),
(37, 168, 3, NULL, NULL),
(38, 169, 3, NULL, NULL),
(39, 170, 3, NULL, NULL),
(40, 171, 3, NULL, NULL),
(41, 172, 3, NULL, NULL),
(42, 173, 1, NULL, NULL),
(43, 174, 1, NULL, NULL),
(44, 175, 1, NULL, NULL),
(45, 176, 1, NULL, NULL),
(46, 177, 1, NULL, NULL),
(47, 178, 1, NULL, NULL),
(48, 179, 1, NULL, NULL),
(49, 180, 1, NULL, NULL),
(50, 181, 1, NULL, NULL),
(51, 182, 1, NULL, NULL),
(52, 183, 1, NULL, NULL),
(53, 184, 1, NULL, NULL),
(54, 185, 1, NULL, NULL),
(55, 186, 1, NULL, NULL),
(56, 187, 1, NULL, NULL),
(57, 188, 1, NULL, NULL),
(58, 189, 1, NULL, NULL),
(59, 190, 1, NULL, NULL),
(60, 191, 1, NULL, NULL),
(61, 192, 1, NULL, NULL),
(62, 193, 1, NULL, NULL),
(63, 194, 1, NULL, NULL),
(64, 195, 4, NULL, NULL),
(65, 196, 4, NULL, NULL),
(66, 197, 4, NULL, NULL),
(67, 199, 4, NULL, NULL),
(68, 100, 30, NULL, NULL),
(69, 105, 31, NULL, NULL),
(70, 106, 31, NULL, NULL),
(71, 107, 31, NULL, NULL),
(72, 108, 31, NULL, NULL),
(73, 109, 31, NULL, NULL),
(74, 110, 31, NULL, NULL),
(75, 111, 31, NULL, NULL),
(76, 112, 31, NULL, NULL),
(77, 113, 31, NULL, NULL),
(78, 114, 31, NULL, NULL),
(79, 115, 31, NULL, NULL),
(80, 116, 31, NULL, NULL),
(81, 117, 31, NULL, NULL),
(82, 118, 31, NULL, NULL),
(83, 119, 31, NULL, NULL),
(84, 120, 31, NULL, NULL),
(85, 121, 31, NULL, NULL),
(86, 122, 31, NULL, NULL),
(87, 123, 31, NULL, NULL),
(88, 124, 31, NULL, NULL),
(89, 125, 31, NULL, NULL),
(90, 126, 31, NULL, NULL),
(91, 127, 32, NULL, NULL),
(92, 128, 32, NULL, NULL),
(93, 129, 32, NULL, NULL),
(94, 130, 32, NULL, NULL),
(95, 131, 32, NULL, NULL),
(96, 132, 32, NULL, NULL),
(97, 133, 32, NULL, NULL),
(98, 134, 32, NULL, NULL),
(99, 135, 32, NULL, NULL),
(100, 136, 32, NULL, NULL),
(101, 137, 32, NULL, NULL),
(102, 139, 32, NULL, NULL),
(103, 140, 32, NULL, NULL),
(104, 141, 32, NULL, NULL),
(105, 142, 32, NULL, NULL),
(106, 143, 32, NULL, NULL),
(107, 144, 32, NULL, NULL),
(108, 145, 32, NULL, NULL),
(109, 146, 32, NULL, NULL),
(110, 147, 32, NULL, NULL),
(111, 148, 32, NULL, NULL),
(112, 149, 32, NULL, NULL),
(113, 150, 32, NULL, NULL),
(114, 151, 32, NULL, NULL),
(115, 152, 32, NULL, NULL),
(116, 153, 32, NULL, NULL),
(117, 154, 32, NULL, NULL),
(118, 155, 32, NULL, NULL),
(119, 156, 32, NULL, NULL),
(120, 157, 32, NULL, NULL),
(121, 158, 32, NULL, NULL),
(122, 159, 32, NULL, NULL),
(123, 160, 32, NULL, NULL),
(124, 161, 32, NULL, NULL),
(125, 162, 32, NULL, NULL),
(126, 163, 32, NULL, NULL),
(127, 164, 32, NULL, NULL),
(128, 165, 32, NULL, NULL),
(129, 166, 32, NULL, NULL),
(130, 167, 32, NULL, NULL),
(131, 168, 32, NULL, NULL),
(132, 169, 32, NULL, NULL),
(133, 170, 32, NULL, NULL),
(134, 171, 32, NULL, NULL),
(135, 172, 32, NULL, NULL),
(136, 173, 32, NULL, NULL),
(137, 174, 32, NULL, NULL),
(138, 175, 32, NULL, NULL),
(139, 176, 32, NULL, NULL),
(140, 177, 32, NULL, NULL),
(141, 178, 32, NULL, NULL),
(142, 179, 32, NULL, NULL),
(143, 180, 32, NULL, NULL),
(144, 181, 32, NULL, NULL),
(145, 182, 32, NULL, NULL),
(146, 183, 32, NULL, NULL),
(147, 184, 32, NULL, NULL),
(148, 185, 32, NULL, NULL),
(149, 186, 32, NULL, NULL),
(150, 187, 32, NULL, NULL),
(151, 188, 32, NULL, NULL),
(152, 189, 32, NULL, NULL),
(153, 190, 32, NULL, NULL),
(154, 191, 32, NULL, NULL),
(155, 192, 32, NULL, NULL),
(156, 193, 32, NULL, NULL),
(157, 194, 32, NULL, NULL),
(158, 195, 32, NULL, NULL),
(159, 196, 32, NULL, NULL),
(160, 197, 32, NULL, NULL),
(161, 198, 32, NULL, NULL),
(162, 199, 32, NULL, NULL),
(163, 200, 32, NULL, NULL),
(164, 201, 32, NULL, NULL),
(165, 202, 32, NULL, NULL),
(166, 203, 32, NULL, NULL),
(167, 204, 32, NULL, NULL),
(168, 207, 32, NULL, NULL),
(169, 208, 32, NULL, NULL),
(170, 209, 32, NULL, NULL),
(171, 210, 32, NULL, NULL),
(172, 211, 32, NULL, NULL),
(173, 212, 32, NULL, NULL),
(174, 213, 32, NULL, NULL),
(175, 214, 32, NULL, NULL),
(176, 215, 32, NULL, NULL),
(177, 216, 32, NULL, NULL),
(178, 217, 32, NULL, NULL),
(179, 218, 33, NULL, NULL),
(180, 219, 33, NULL, NULL),
(181, 220, 33, NULL, NULL),
(182, 221, 33, NULL, NULL),
(183, 222, 33, NULL, NULL),
(184, 223, 33, NULL, NULL),
(185, 224, 33, NULL, NULL),
(186, 225, 33, NULL, NULL),
(187, 226, 33, NULL, NULL),
(188, 227, 33, NULL, NULL),
(189, 228, 33, NULL, NULL),
(190, 229, 33, NULL, NULL),
(191, 230, 33, NULL, NULL),
(192, 231, 33, NULL, NULL),
(193, 232, 33, NULL, NULL),
(194, 233, 33, NULL, NULL),
(195, 234, 33, NULL, NULL),
(196, 235, 33, NULL, NULL),
(197, 236, 34, NULL, NULL),
(198, 237, 34, NULL, NULL),
(199, 238, 34, NULL, NULL),
(200, 239, 34, NULL, NULL),
(201, 240, 34, NULL, NULL),
(202, 241, 34, NULL, NULL),
(203, 242, 34, NULL, NULL),
(204, 243, 34, NULL, NULL),
(205, 244, 34, NULL, NULL),
(206, 245, 34, NULL, NULL),
(207, 246, 34, NULL, NULL),
(208, 247, 34, NULL, NULL),
(209, 248, 34, NULL, NULL),
(210, 249, 34, NULL, NULL),
(211, 250, 34, NULL, NULL),
(212, 251, 34, NULL, NULL),
(213, 252, 34, NULL, NULL),
(214, 253, 34, NULL, NULL),
(215, 254, 34, NULL, NULL),
(216, 255, 34, NULL, NULL),
(217, 256, 34, NULL, NULL),
(218, 257, 34, NULL, NULL),
(219, 258, 34, NULL, NULL),
(220, 284, 40, NULL, NULL),
(221, 285, 40, NULL, NULL),
(222, 286, 40, NULL, NULL),
(223, 287, 40, NULL, NULL),
(224, 288, 40, NULL, NULL),
(225, 289, 40, NULL, NULL),
(226, 290, 40, NULL, NULL),
(227, 291, 40, NULL, NULL),
(228, 292, 40, NULL, NULL),
(229, 293, 40, NULL, NULL),
(230, 294, 40, NULL, NULL),
(231, 295, 40, NULL, NULL),
(232, 296, 40, NULL, NULL),
(233, 297, 40, NULL, NULL),
(234, 298, 40, NULL, NULL),
(235, 299, 40, NULL, NULL),
(236, 300, 40, NULL, NULL),
(237, 301, 40, NULL, NULL),
(238, 302, 40, NULL, NULL),
(239, 303, 40, NULL, NULL),
(240, 304, 41, NULL, NULL),
(241, 305, 41, NULL, NULL),
(242, 306, 41, NULL, NULL),
(243, 307, 41, NULL, NULL),
(244, 308, 41, NULL, NULL),
(245, 309, 41, NULL, NULL),
(246, 310, 41, NULL, NULL),
(247, 311, 41, NULL, NULL),
(248, 312, 41, NULL, NULL),
(249, 313, 41, NULL, NULL),
(250, 314, 41, NULL, NULL),
(251, 315, 41, NULL, NULL),
(252, 316, 41, NULL, NULL),
(253, 317, 41, NULL, NULL),
(254, 318, 41, NULL, NULL),
(255, 319, 41, NULL, NULL),
(256, 320, 41, NULL, NULL),
(257, 321, 41, NULL, NULL),
(258, 322, 41, NULL, NULL),
(259, 323, 41, NULL, NULL),
(260, 324, 41, NULL, NULL),
(261, 325, 41, NULL, NULL),
(262, 326, 41, NULL, NULL),
(263, 327, 41, NULL, NULL),
(264, 328, 41, NULL, NULL),
(265, 329, 41, NULL, NULL),
(266, 330, 41, NULL, NULL),
(267, 331, 41, NULL, NULL),
(268, 332, 41, NULL, NULL),
(269, 333, 41, NULL, NULL),
(270, 334, 41, NULL, NULL),
(271, 335, 41, NULL, NULL),
(272, 336, 41, NULL, NULL),
(273, 337, 43, NULL, NULL),
(274, 338, 43, NULL, NULL),
(275, 339, 43, NULL, NULL),
(276, 340, 43, NULL, NULL),
(277, 341, 43, NULL, NULL),
(278, 342, 43, NULL, NULL),
(279, 343, 43, NULL, NULL),
(280, 344, 43, NULL, NULL),
(281, 345, 43, NULL, NULL),
(282, 346, 43, NULL, NULL),
(283, 347, 43, NULL, NULL),
(284, 348, 43, NULL, NULL),
(285, 349, 43, NULL, NULL),
(286, 350, 43, NULL, NULL),
(287, 351, 43, NULL, NULL),
(288, 354, 43, NULL, NULL),
(289, 355, 43, NULL, NULL),
(290, 356, 43, NULL, NULL),
(291, 357, 43, NULL, NULL),
(292, 358, 43, NULL, NULL),
(293, 359, 42, NULL, NULL),
(294, 360, 42, NULL, NULL),
(295, 363, 42, NULL, NULL),
(296, 364, 42, NULL, NULL),
(297, 365, 42, NULL, NULL),
(298, 366, 42, NULL, NULL),
(299, 367, 42, NULL, NULL),
(300, 368, 42, NULL, NULL),
(301, 369, 42, NULL, NULL),
(302, 370, 42, NULL, NULL),
(303, 371, 42, NULL, NULL),
(304, 372, 42, NULL, NULL),
(305, 373, 44, NULL, NULL),
(306, 374, 44, NULL, NULL),
(307, 375, 44, NULL, NULL),
(308, 376, 44, NULL, NULL),
(309, 377, 44, NULL, NULL),
(310, 378, 42, NULL, NULL),
(311, 379, 42, NULL, NULL),
(312, 380, 42, NULL, NULL),
(313, 381, 42, NULL, NULL),
(314, 382, 42, NULL, NULL),
(315, 383, 42, NULL, NULL),
(316, 384, 42, NULL, NULL),
(317, 385, 42, NULL, NULL),
(318, 386, 42, NULL, NULL),
(319, 387, 42, NULL, NULL),
(320, 388, 42, NULL, NULL),
(321, 389, 42, NULL, NULL),
(322, 390, 42, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_institucions`
--

CREATE TABLE `user_institucions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `institucion_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_institucions`
--

INSERT INTO `user_institucions` (`id`, `user_id`, `institucion_id`, `created_at`, `updated_at`) VALUES
(1, 75, 3, NULL, NULL),
(2, 87, 290, NULL, NULL),
(3, 90, 238, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vsectors`
--

CREATE TABLE `vsectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_vsector` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vsectors`
--

INSERT INTO `vsectors` (`id`, `nombre_vsector`, `created_at`, `updated_at`) VALUES
(1, 'EPS', '2017-10-20 10:08:27', '2017-10-20 10:08:27'),
(2, 'Artesano', '2017-10-20 10:12:40', '2017-10-20 10:12:40'),
(3, 'Público', '2017-10-20 10:12:40', '2017-10-20 10:12:40'),
(4, 'Privado', '2017-10-20 10:12:40', '2017-10-20 10:12:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Zona de Planificación 1 – Norte', 'Esmeraldas, Carchi, Imbabura, Sucumbíos', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(2, 'Zona de Planificación 2 – Centro Norte', 'Pichincha (excepto el Distrito Metropolitano), Napo, Orellana', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(3, 'Zona de Planificación 3 – Centro', 'Cotopaxi, Chimborazo, Pastaza, Tungurahua', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(4, 'Zona de Planificación 4 – Pacífico', 'Manabí, Santo Domingo de Los Tsáchilas', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(5, 'Zona de Planificación 5 – Litoral', 'Guayas (excepto los cantones de Guayaquil, Samborondón y Duran), Los Ríos, Santa Elena, Bolívar, Galápagos', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(6, 'Zona de Planificación 6 – Austro', 'Azuay, Cañar, Morona Santiago', '2018-06-12 19:40:34', '2018-06-12 19:40:34'),
(7, 'Zona de Planificación 7 – Sur', 'El Oro, Loja, Zamora Chinchipe', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(8, 'Zona de Planificación 8', 'Guayaquil, Durán, Sanboromdon', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(9, 'Zona de Planificación 9', 'Distrito Metropolitano de Quito', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(10, 'Exterior', 'Africa, Europa, Asia, Oceania, America', '2018-06-12 19:40:35', '2018-06-12 19:40:35'),
(11, 'S/D', 'No identifica', '2018-06-12 19:40:35', '2018-06-12 19:40:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actor_solucion`
--
ALTER TABLE `actor_solucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ambits`
--
ALTER TABLE `ambits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cantons`
--
ALTER TABLE `cantons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cantons_provincia_id_index` (`provincia_id`);

--
-- Indices de la tabla `cn_cifras_nacionales`
--
ALTER TABLE `cn_cifras_nacionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cn_cifras_nacionales_tipo_impuesto_id_foreign` (`tipo_impuesto_id`),
  ADD KEY `cn_cifras_nacionales_tipo_cifra_nacional_id_foreign` (`tipo_cifra_nacional_id`),
  ADD KEY `cn_cifras_nacionales_tipo_empresa_id_foreign` (`tipo_empresa_id`),
  ADD KEY `cn_cifras_nacionales_provincia_id_foreign` (`provincia_id`),
  ADD KEY `cn_cifras_nacionales_ciiu_id_foreign` (`ciiu_id`),
  ADD KEY `cn_cifras_nacionales_tipo_fuente_id_foreign` (`tipo_fuente_id`);

--
-- Indices de la tabla `cn_ciius`
--
ALTER TABLE `cn_ciius`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cn_poblacions`
--
ALTER TABLE `cn_poblacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cn_poblacions_tipo_fuente_id_foreign` (`tipo_fuente_id`),
  ADD KEY `cn_poblacions_provincia_id_foreign` (`provincia_id`);

--
-- Indices de la tabla `cn_provincias`
--
ALTER TABLE `cn_provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cn_tipo_cifra_nacionals`
--
ALTER TABLE `cn_tipo_cifra_nacionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cn_tipo_empresas`
--
ALTER TABLE `cn_tipo_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cn_tipo_fuentes`
--
ALTER TABLE `cn_tipo_fuentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cn_tipo_impuestos`
--
ALTER TABLE `cn_tipo_impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consejo_institucions`
--
ALTER TABLE `consejo_institucions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consejo_institucions_consejo_id_index` (`consejo_id`),
  ADD KEY `consejo_institucions_institucion_id_index` (`institucion_id`);

--
-- Indices de la tabla `consejo_sectorials`
--
ALTER TABLE `consejo_sectorials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `csp_acciones_alertas`
--
ALTER TABLE `csp_acciones_alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `csp_acciones_alertas_reporte_alerta_id_index` (`reporte_alerta_id`);

--
-- Indices de la tabla `csp_agenda_territorials`
--
ALTER TABLE `csp_agenda_territorials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `csp_agenda_territorials_institucion_id_index` (`institucion_id`),
  ADD KEY `csp_agenda_territorials_canton_id_index` (`canton_id`),
  ADD KEY `csp_agenda_territorials_tipo_agenda_id_index` (`tipo_agenda_id`),
  ADD KEY `csp_agenda_territorials_tipo_impacto_id_index` (`tipo_impacto_id`),
  ADD KEY `csp_agenda_territorials_periodo_agenda_id_index` (`periodo_agenda_id`);

--
-- Indices de la tabla `csp_periodo_agendas`
--
ALTER TABLE `csp_periodo_agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `csp_periodo_reportes`
--
ALTER TABLE `csp_periodo_reportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `csp_reportes_alertas`
--
ALTER TABLE `csp_reportes_alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `csp_reportes_alertas_estado_reporte_id_index` (`estado_reporte_id`),
  ADD KEY `csp_reportes_alertas_institucion_id_index` (`institucion_id`);

--
-- Indices de la tabla `csp_reportes_hechos`
--
ALTER TABLE `csp_reportes_hechos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `csp_reportes_hechos_institucion_id_index` (`institucion_id`);

--
-- Indices de la tabla `csp_reporte_estados`
--
ALTER TABLE `csp_reporte_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `csp_tipo_agendas`
--
ALTER TABLE `csp_tipo_agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `csp_tipo_impacto_agendas`
--
ALTER TABLE `csp_tipo_impacto_agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_publicacions`
--
ALTER TABLE `estado_publicacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_solucion`
--
ALTER TABLE `estado_solucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `indice_competitividads`
--
ALTER TABLE `indice_competitividads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `institucions`
--
ALTER TABLE `institucions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `institucion_usuarios`
--
ALTER TABLE `institucion_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesa_dialogo`
--
ALTER TABLE `mesa_dialogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesa_dialogo_tipo_dialogo_id_foreign` (`tipo_dialogo_id`),
  ADD KEY `mesa_dialogo_organizador_id_foreign` (`organizador_id`),
  ADD KEY `mesa_dialogo_consejo_sectorial_id_foreign` (`consejo_sectorial_id`),
  ADD KEY `mesa_dialogo_zona_id_foreign` (`zona_id`),
  ADD KEY `mesa_dialogo_provincia_id_foreign` (`provincia_id`),
  ADD KEY `mesa_dialogo_canton_id_foreign` (`canton_id`),
  ADD KEY `mesa_dialogo_parroquia_id_foreign` (`parroquia_id`),
  ADD KEY `mesa_dialogo_sector_id_foreign` (`sector_id`),
  ADD KEY `mesa_dialogo_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacion_ciudadano`
--
ALTER TABLE `notificacion_ciudadano`
  ADD PRIMARY KEY (`not_cd_id`);

--
-- Indices de la tabla `notificacion_ciudadano_propuesta`
--
ALTER TABLE `notificacion_ciudadano_propuesta`
  ADD PRIMARY KEY (`not_cdp_id`);

--
-- Indices de la tabla `pajustadas`
--
ALTER TABLE `pajustadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `palabras_claves`
--
ALTER TABLE `palabras_claves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `palabras_claves_solucion_id_foreign` (`solucion_id`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parroquia_canton_id_index` (`canton_id`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participante_mesa_dialogo_id_foreign` (`mesa_dialogo_id`),
  ADD KEY `participante_sector_id_foreign` (`sector_id`),
  ADD KEY `participante_tipo_participante_id_foreign` (`tipo_participante_id`),
  ADD KEY `participante_sector_empresa_id_foreign` (`sector_empresa_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `plan_nacionals`
--
ALTER TABLE `plan_nacionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `politicas`
--
ALTER TABLE `politicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sipocs`
--
ALTER TABLE `sipocs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solucions`
--
ALTER TABLE `solucions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solucions_politica_id_foreign` (`politica_id`),
  ADD KEY `solucions_estado_publicacion_id_foreign` (`estado_publicacion_id`),
  ADD KEY `solucions_indice_competitividad_id_foreign` (`indice_competitividad_id`),
  ADD KEY `solucions_plan_nacional_id_foreign` (`plan_nacional_id`);

--
-- Indices de la tabla `thematics`
--
ALTER TABLE `thematics`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_dialogo`
--
ALTER TABLE `tipo_dialogo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_empresa`
--
ALTER TABLE `tipo_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_participante`
--
ALTER TABLE `tipo_participante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pruebas`
--
ALTER TABLE `tipo_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_evento_solucion`
--
ALTER TABLE `user_evento_solucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_institucions`
--
ALTER TABLE `user_institucions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vsectors`
--
ALTER TABLE `vsectors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `actor_solucion`
--
ALTER TABLE `actor_solucion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `ambits`
--
ALTER TABLE `ambits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `cantons`
--
ALTER TABLE `cantons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT de la tabla `cn_cifras_nacionales`
--
ALTER TABLE `cn_cifras_nacionales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_ciius`
--
ALTER TABLE `cn_ciius`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_poblacions`
--
ALTER TABLE `cn_poblacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_provincias`
--
ALTER TABLE `cn_provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_tipo_cifra_nacionals`
--
ALTER TABLE `cn_tipo_cifra_nacionals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_tipo_empresas`
--
ALTER TABLE `cn_tipo_empresas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_tipo_fuentes`
--
ALTER TABLE `cn_tipo_fuentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cn_tipo_impuestos`
--
ALTER TABLE `cn_tipo_impuestos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consejo_institucions`
--
ALTER TABLE `consejo_institucions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `consejo_sectorials`
--
ALTER TABLE `consejo_sectorials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `csp_acciones_alertas`
--
ALTER TABLE `csp_acciones_alertas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `csp_agenda_territorials`
--
ALTER TABLE `csp_agenda_territorials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `csp_periodo_agendas`
--
ALTER TABLE `csp_periodo_agendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `csp_periodo_reportes`
--
ALTER TABLE `csp_periodo_reportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `csp_reportes_alertas`
--
ALTER TABLE `csp_reportes_alertas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `csp_reportes_hechos`
--
ALTER TABLE `csp_reportes_hechos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT de la tabla `csp_reporte_estados`
--
ALTER TABLE `csp_reporte_estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `csp_tipo_agendas`
--
ALTER TABLE `csp_tipo_agendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `csp_tipo_impacto_agendas`
--
ALTER TABLE `csp_tipo_impacto_agendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_publicacions`
--
ALTER TABLE `estado_publicacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_solucion`
--
ALTER TABLE `estado_solucion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `indice_competitividads`
--
ALTER TABLE `indice_competitividads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `institucions`
--
ALTER TABLE `institucions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT de la tabla `institucion_usuarios`
--
ALTER TABLE `institucion_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `mesa_dialogo`
--
ALTER TABLE `mesa_dialogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `notificacion_ciudadano`
--
ALTER TABLE `notificacion_ciudadano`
  MODIFY `not_cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notificacion_ciudadano_propuesta`
--
ALTER TABLE `notificacion_ciudadano_propuesta`
  MODIFY `not_cdp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pajustadas`
--
ALTER TABLE `pajustadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `palabras_claves`
--
ALTER TABLE `palabras_claves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_nacionals`
--
ALTER TABLE `plan_nacionals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `politicas`
--
ALTER TABLE `politicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT de la tabla `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `sipocs`
--
ALTER TABLE `sipocs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solucions`
--
ALTER TABLE `solucions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2997;

--
-- AUTO_INCREMENT de la tabla `thematics`
--
ALTER TABLE `thematics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_dialogo`
--
ALTER TABLE `tipo_dialogo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_empresa`
--
ALTER TABLE `tipo_empresa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_participante`
--
ALTER TABLE `tipo_participante`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_pruebas`
--
ALTER TABLE `tipo_pruebas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT de la tabla `user_evento_solucion`
--
ALTER TABLE `user_evento_solucion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT de la tabla `user_institucions`
--
ALTER TABLE `user_institucions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vsectors`
--
ALTER TABLE `vsectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cn_cifras_nacionales`
--
ALTER TABLE `cn_cifras_nacionales`
  ADD CONSTRAINT `cn_cifras_nacionales_ciiu_id_foreign` FOREIGN KEY (`ciiu_id`) REFERENCES `cn_ciius` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cn_cifras_nacionales_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `cn_provincias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cn_cifras_nacionales_tipo_cifra_nacional_id_foreign` FOREIGN KEY (`tipo_cifra_nacional_id`) REFERENCES `cn_tipo_cifra_nacionals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cn_cifras_nacionales_tipo_empresa_id_foreign` FOREIGN KEY (`tipo_empresa_id`) REFERENCES `cn_tipo_empresas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cn_cifras_nacionales_tipo_fuente_id_foreign` FOREIGN KEY (`tipo_fuente_id`) REFERENCES `cn_tipo_fuentes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cn_cifras_nacionales_tipo_impuesto_id_foreign` FOREIGN KEY (`tipo_impuesto_id`) REFERENCES `cn_tipo_impuestos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cn_poblacions`
--
ALTER TABLE `cn_poblacions`
  ADD CONSTRAINT `cn_poblacions_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `cn_provincias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cn_poblacions_tipo_fuente_id_foreign` FOREIGN KEY (`tipo_fuente_id`) REFERENCES `cn_tipo_fuentes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `consejo_institucions`
--
ALTER TABLE `consejo_institucions`
  ADD CONSTRAINT `consejo_institucions_consejo_id_foreign` FOREIGN KEY (`consejo_id`) REFERENCES `consejo_sectorials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consejo_institucions_institucion_id_foreign` FOREIGN KEY (`institucion_id`) REFERENCES `institucions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mesa_dialogo`
--
ALTER TABLE `mesa_dialogo`
  ADD CONSTRAINT `mesa_dialogo_canton_id_foreign` FOREIGN KEY (`canton_id`) REFERENCES `cantons` (`id`),
  ADD CONSTRAINT `mesa_dialogo_consejo_sectorial_id_foreign` FOREIGN KEY (`consejo_sectorial_id`) REFERENCES `institucions` (`id`),
  ADD CONSTRAINT `mesa_dialogo_organizador_id_foreign` FOREIGN KEY (`organizador_id`) REFERENCES `institucions` (`id`),
  ADD CONSTRAINT `mesa_dialogo_parroquia_id_foreign` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquia` (`id`),
  ADD CONSTRAINT `mesa_dialogo_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`),
  ADD CONSTRAINT `mesa_dialogo_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`),
  ADD CONSTRAINT `mesa_dialogo_tipo_dialogo_id_foreign` FOREIGN KEY (`tipo_dialogo_id`) REFERENCES `tipo_dialogo` (`id`),
  ADD CONSTRAINT `mesa_dialogo_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mesa_dialogo_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`);

--
-- Filtros para la tabla `palabras_claves`
--
ALTER TABLE `palabras_claves`
  ADD CONSTRAINT `palabras_claves_solucion_id_foreign` FOREIGN KEY (`solucion_id`) REFERENCES `solucions` (`id`);

--
-- Filtros para la tabla `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_mesa_dialogo_id_foreign` FOREIGN KEY (`mesa_dialogo_id`) REFERENCES `mesa_dialogo` (`id`),
  ADD CONSTRAINT `participante_sector_empresa_id_foreign` FOREIGN KEY (`sector_empresa_id`) REFERENCES `sectors` (`id`),
  ADD CONSTRAINT `participante_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`),
  ADD CONSTRAINT `participante_tipo_participante_id_foreign` FOREIGN KEY (`tipo_participante_id`) REFERENCES `tipo_participante` (`id`);

--
-- Filtros para la tabla `solucions`
--
ALTER TABLE `solucions`
  ADD CONSTRAINT `solucions_estado_publicacion_id_foreign` FOREIGN KEY (`estado_publicacion_id`) REFERENCES `estado_publicacions` (`id`),
  ADD CONSTRAINT `solucions_indice_competitividad_id_foreign` FOREIGN KEY (`indice_competitividad_id`) REFERENCES `indice_competitividads` (`id`),
  ADD CONSTRAINT `solucions_plan_nacional_id_foreign` FOREIGN KEY (`plan_nacional_id`) REFERENCES `plan_nacionals` (`id`),
  ADD CONSTRAINT `solucions_politica_id_foreign` FOREIGN KEY (`politica_id`) REFERENCES `politicas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
