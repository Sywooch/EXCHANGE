-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 26 2017 г., 16:49
-- Версия сервера: 10.1.18-MariaDB
-- Версия PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `exchange`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `passwordHash` varchar(255) NOT NULL,
  `passwordResetToken` varchar(255) DEFAULT NULL,
  `passwordResetExpire` int(11) DEFAULT NULL,
  `createdAt` int(11) NOT NULL,
  `updatedAt` int(11) NOT NULL,
  `authKey` varchar(32) DEFAULT NULL,
  `emailConfirmToken` varchar(255) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `firstName`, `lastName`, `role`, `status`, `passwordHash`, `passwordResetToken`, `passwordResetExpire`, `createdAt`, `updatedAt`, `authKey`, `emailConfirmToken`, `data`) VALUES
(1, 'admin', 'admin@test.com', 'Admin', 'Admin', NULL, 1, '$2y$13$ZQHCI0badKK39UZeDaUm/.770MIvbMz4yg3Kmoz9faGV5Fu.fixgC', NULL, NULL, 1481070616, 1481070616, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `watches` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `is_main` tinyint(1) DEFAULT '0',
  `content` text,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `image`, `code`) VALUES
(7, '', '<a href=\"http://ovz2.stils1606.1dx56.vps.myjino.ru/?rid=<USERID>\"><img alt=\"Обменник\" title=\"Обменять\" src=\"http://ovz2.stils1606.1dx56.vps.myjino.ru/yii2images/images/image-by-item-and-alias?item=Banner7&dirtyAlias=591316438a-1.jpg\"></a>'),
(8, '', '<a href=\"http://ovz2.stils1606.1dx56.vps.myjino.ru/?rid=<USERID>\"><img alt=\"Обменник\" title=\"Обменять\" src=\"http://ovz2.stils1606.1dx56.vps.myjino.ru/yii2images/images/image-by-item-and-alias?item=Banner8&dirtyAlias=a84d2d6464-1.jpg\"></a>');

-- --------------------------------------------------------

--
-- Структура таблицы `bonus`
--

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL,
  `from` decimal(19,4) DEFAULT NULL,
  `to` decimal(19,4) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bonus`
--

INSERT INTO `bonus` (`id`, `from`, `to`, `percent`) VALUES
(1, '1000.0000', '2000.0000', 3),
(2, '2000.0000', '5000.0000', 5),
(3, '5000.0000', '10000.0000', 10),
(4, '10000.0000', '15000.0000', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `course_parser`
--

CREATE TABLE `course_parser` (
  `id` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `value` decimal(19,6) DEFAULT NULL,
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `course_parser`
--

INSERT INTO `course_parser` (`id`, `from`, `to`, `value`, `updated`) VALUES
(11, 'RUR', 'USD', '0.016906', '2017-01-26'),
(12, 'USD', 'RUR', '59.148900', '2017-01-26'),
(17, 'btc', 'USD', '887.000000', '2017-01-26'),
(18, 'btc', 'RUR', '53339.500000', '2017-01-26'),
(19, 'USD', 'btc', '0.001127', '2017-01-26'),
(20, 'RUR', 'btc', '0.000019', '2017-01-26');

-- --------------------------------------------------------

--
-- Структура таблицы `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `credentials`
--

INSERT INTO `credentials` (`id`, `slug`, `value`) VALUES
(1, 'email', 'web-obmen.net@gmail.com'),
(2, 'jabber', 'web-obmen@exploit.im'),
(3, 'icq', 'ICQ 641432'),
(4, 'phone', '+380635515085');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `reserve` decimal(15,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `is_voucher` tinyint(1) DEFAULT NULL,
  `voucher_title` varchar(255) DEFAULT 'Код ваучера'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `icon`, `reserve`, `type`, `wallet`, `is_voucher`, `voucher_title`) VALUES
(3, 'Perfectmoney', '', '10000.00', 'USD', 'U2512772', 0, 'Код ваучера'),
(4, 'PM E-voucher', '', '10000.00', 'USD', '', 1, 'Код ваучера'),
(5, 'Bitcoin', '', '98.80', 'btc', '', 0, 'Код ваучера'),
(6, 'Яндекс.Деньги', '', '299200.00', 'RUR', '41001808763927', 0, 'Код ваучера'),
(7, 'Qiwi', '', '299970.30', 'RUR', '', 0, 'Код ваучера'),
(8, 'Сбербанк', '', '300000.00', 'RUR', '', 0, 'Код ваучера'),
(9, 'Альфа-Банк', '', '300000.00', 'RUR', '', 0, 'Код ваучера'),
(10, 'Приватбанк', '', '200000.00', 'UAH', '', 0, 'Код ваучера'),
(11, 'Western Union', '', '10000.00', 'USD', '', 0, 'Код ваучера'),
(12, 'Contact', '', '100000.00', 'RUR', NULL, NULL, 'Код ваучера'),
(13, 'Unistream', '', '100000.00', 'RUR', NULL, NULL, 'Код ваучера'),
(17, 'BTC-e', '', '50000.00', 'USD', '', 1, 'Код ваучера'),
(25, 'Наличные', '', '100000.00', 'USD', '', 0, ''),
(26, 'ВТБ 24', '', '300000.00', 'RUR', '', 1, ''),
(27, 'VISA, MC ', '', '500000.00', 'RUR', '', 1, ''),
(28, 'VISA, MC', '', '150000.00', 'UAH', '', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `currency_fields`
--

CREATE TABLE `currency_fields` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency_fields`
--

INSERT INTO `currency_fields` (`id`, `currency_id`, `title`) VALUES
(32, 26, 'Номер вашего кошелька для получения'),
(33, 26, 'Контактный номер телефона'),
(34, 27, 'Номер вашего кошелька для получения денег'),
(35, 27, 'Контактный номер телефона');

-- --------------------------------------------------------

--
-- Структура таблицы `exchange_direction`
--

CREATE TABLE `exchange_direction` (
  `id` int(11) NOT NULL,
  `currency_from` int(11) DEFAULT NULL,
  `currency_to` int(11) DEFAULT NULL,
  `course` decimal(19,6) DEFAULT NULL,
  `exchange_percent` float DEFAULT NULL,
  `min` decimal(19,2) DEFAULT '1.00',
  `max` int(11) DEFAULT NULL,
  `min_comission` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exchange_direction`
--

INSERT INTO `exchange_direction` (`id`, `currency_from`, `currency_to`, `course`, `exchange_percent`, `min`, `max`, `min_comission`, `enabled`) VALUES
(400, 4, 5, '0.001127', 1, '1.00', 100000, 1, 0),
(401, 4, 6, '59.148900', 1, '1.00', 100000, 1, 1),
(402, 4, 7, '59.148900', 1, '1.00', 100000, 1, 1),
(403, 4, 8, '59.148900', 1, '1.00', 100000, 1, 1),
(404, 4, 9, '59.148900', 1, '1.00', 100000, 1, 1),
(405, 4, 10, '1.000000', 1, '1.00', 100000, 1, 1),
(406, 4, 11, '1.000000', 1, '1.00', 100000, 1, 1),
(407, 4, 17, '1.000000', 1, '1.00', 100000, 1, 1),
(408, 4, 25, '1.000000', 1, '1.00', 100000, 1, 1),
(409, 4, 26, '59.148900', 1, '1.00', 100000, 1, 1),
(410, 4, 27, '59.148900', 1, '1.00', 100000, 1, 1),
(411, 4, 28, '1.000000', 1, '1.00', 100000, 1, 1),
(683, 5, 3, '887.000000', 3, '0.01', 100, 4, 1),
(684, 5, 4, '887.000000', 3, '0.01', 100, 4, 1),
(685, 5, 6, '53339.500000', 1, '0.01', 100, 4, 1),
(686, 5, 7, '53339.500000', 1, '0.01', 100, 4, 1),
(687, 5, 8, '53339.500000', 1, '0.10', 100, 4, 1),
(688, 5, 9, '53339.500000', 1, '0.10', 100, 4, 1),
(689, 5, 26, '53339.500000', 1, '0.10', 100, 4, 1),
(690, 5, 10, '857.001000', 1, '0.05', 100, 4, 1),
(691, 5, 25, '887.000000', 1, '1.00', 100, 4, 1),
(692, 5, 27, '53339.500000', 1, '0.05', 100, 4, 1),
(693, 5, 28, '50860.331400', 1, '0.05', 100, 4, 1),
(694, 5, 11, '887.000000', 1, '1.00', 100, 4, 1),
(809, 17, 3, '1.000000', 3, '10.00', 100000, 4, 1),
(810, 17, 4, '1.000000', 3, '10.00', 100000, 1, 1),
(811, 17, 6, '59.148900', 2, '10.00', 100000, 1, 1),
(812, 17, 7, '59.148900', 1, '10.00', 100000, 1, 1),
(813, 17, 8, '59.148900', 3, '10.00', 100000, 1, 1),
(814, 17, 9, '59.148900', 2, '10.00', 100000, 1, 1),
(815, 17, 26, '59.148900', 2, '10.00', 100000, 1, 1),
(816, 17, 10, '28.000000', 2, '10.00', 100000, 1, 1),
(817, 17, 25, '500.000000', 1, '10.00', 100000, 25, 1),
(818, 17, 27, '59.148900', 3, '10.00', 100000, 1, 1),
(819, 17, 28, '59.401500', 3, '10.00', 100000, 1, 1),
(820, 17, 11, '1.000000', 5, '500.00', 100000, 50, 1),
(833, 10, 3, '1.000000', 1, '1.00', 100000, 1, 0),
(835, 26, 3, '0.016906', 1, '1.00', 100000, 1, 0),
(860, 28, 3, '1.000000', 1, '1.00', 100000, 1, 0),
(861, 13, 3, '0.016906', 1, '1.00', 100000, 1, 0),
(862, 12, 3, '0.016906', 1, '1.00', 100000, 1, 0),
(863, 9, 3, '0.016906', 1, '1.00', 100000, 1, 0),
(864, 8, 3, '0.016906', 1, '1.00', 100000, 1, 0),
(872, 27, 3, '0.016906', 1, '1.00', 100000, 1, 0),
(899, 11, 3, '1.000000', 6, '500.00', 5000, 50, 1),
(900, 11, 4, '1.000000', 6, '500.00', 5000, 50, 1),
(901, 11, 5, '0.001127', 6, '500.00', 5000, 50, 1),
(902, 11, 17, '1.000000', 6, '500.00', 5000, 50, 1),
(903, 6, 3, '0.016906', 6, '1000.00', 300000, 4, 1),
(904, 6, 4, '0.016906', 6, '1000.00', 300000, 4, 1),
(905, 6, 5, '0.000019', 8, '1000.00', 300000, 4, 1),
(906, 6, 17, '0.016906', 8, '1000.00', 300000, 4, 1),
(907, 6, 7, '1.000000', 3, '300.00', 300000, 100, 1),
(908, 6, 25, '0.016806', 1, '20000.00', 300000, 4, 1),
(909, 6, 28, '0.430000', 1, '1000.00', 300000, 4, 1),
(916, 25, 3, '1.000000', 1.5, '1000.00', 100000, 1, 1),
(917, 25, 4, '1.000000', 1.5, '1000.00', 100000, 1, 1),
(918, 25, 5, '0.001127', 2.5, '1000.00', 100000, 1, 1),
(919, 25, 17, '1.000000', 2.5, '1000.00', 100000, 1, 1),
(920, 25, 6, '59.501400', 1, '1000.00', 100000, 1, 1),
(921, 25, 7, '59.501400', 1, '1000.00', 100000, 1, 1),
(929, 7, 3, '0.016906', 9, '1000.00', 100000, 1, 1),
(930, 7, 4, '0.016906', 9, '1000.00', 100000, 1, 1),
(931, 7, 5, '0.000019', 10, '1000.00', 100000, 1, 1),
(932, 7, 17, '0.016906', 10, '1000.00', 100000, 1, 1),
(933, 7, 6, '1.000000', 4, '300.00', 100000, 100, 1),
(934, 7, 10, '0.430000', 1, '1000.00', 100000, 1, 1),
(935, 7, 25, '0.016806', 1, '20000.00', 100000, 1, 1),
(936, 3, 5, '0.001127', 3, '10.00', 100000, 4, 1),
(937, 3, 17, '1.000000', 3, '10.00', 100000, 4, 1),
(938, 3, 6, '59.148900', 2, '10.00', 100000, 4, 1),
(939, 3, 7, '59.148900', 2, '10.00', 100000, 4, 1),
(940, 3, 8, '59.148900', 3, '10.00', 100000, 4, 1),
(941, 3, 9, '59.148900', 3, '10.00', 100000, 4, 1),
(942, 3, 26, '59.148900', 3, '10.00', 100000, 4, 1),
(943, 3, 10, '28.000000', 3, '10.00', 100000, 4, 1),
(944, 3, 25, '1.000000', 4, '1000.00', 100000, 4, 1),
(945, 3, 27, '59.148900', 3, '10.00', 100000, 4, 1),
(946, 3, 28, '28.000000', 3, '10.00', 100000, 4, 1),
(947, 3, 11, '1.000000', 4, '1000.00', 100000, 40, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(1, 'Currencies/Currency2/690704.png', 2, 1, 'Currency', '533c4667f9-1', ''),
(2, 'Currencies/Currency3/9fe77a.png', 3, 1, 'Currency', '9e2b10ebe1-1', ''),
(3, 'Currencies/Currency4/f05457.png', 4, 1, 'Currency', 'a3cad90246-1', ''),
(4, 'Currencies/Currency5/88d61e.png', 5, 1, 'Currency', '5c161d63e3-1', ''),
(5, 'Currencies/Currency6/66cc0d.png', 6, 1, 'Currency', '6997d66562-1', ''),
(6, 'Currencies/Currency7/53a247.png', 7, 1, 'Currency', '6558f6adcf-1', ''),
(7, 'Currencies/Currency8/aa072b.png', 8, 1, 'Currency', 'e02c613b11-1', ''),
(8, 'Currencies/Currency9/5214e3.png', 9, 1, 'Currency', 'cc72b0a9c7-1', ''),
(9, 'Currencies/Currency10/ee352a.png', 10, 1, 'Currency', 'd37ee82bc9-1', ''),
(10, 'Currencies/Currency11/0960be.png', 11, 1, 'Currency', '77e66aa518-1', ''),
(11, 'Currencies/Currency12/4fb6e9.png', 12, 1, 'Currency', 'fd9d327af3-1', ''),
(12, 'Currencies/Currency13/fcf0f9.png', 13, 1, 'Currency', '5a9567c25a-1', ''),
(13, 'Currencies/Currency16/7ea24d.jpg', 16, 1, 'Currency', '2077c01ab9-1', ''),
(14, 'Currencies/Currency17/c07c6a.png', 17, 1, 'Currency', '4b0ef1a784-1', ''),
(15, 'Testimonials/Testimonial4/ddc859.jpg', 4, 1, 'Testimonial', 'a0f95cd64d-1', ''),
(16, 'Testimonials/Testimonial5/2bfc63.jpg', 5, 1, 'Testimonial', 'b4b85390c2-1', ''),
(17, 'Testimonials/Testimonial6/6860e6.jpg', 6, 1, 'Testimonial', '31aa913d74-1', ''),
(18, 'Testimonials/Testimonial7/31e6cb.jpg', 7, 1, 'Testimonial', '3357732fa8-1', ''),
(19, 'News/News4/b1da58.jpg', 4, 1, 'News', '2aa66c9953-1', ''),
(20, 'News/News1/c930b1.jpg', 1, 1, 'News', '1cd9a3f674-1', ''),
(21, 'News/News2/c7fca9.jpg', 2, 1, 'News', '3e40fbb189-1', ''),
(22, 'News/News3/c87418.jpg', 3, 1, 'News', 'd57822caee-1', ''),
(23, 'Articles/Article1/3b440a.jpg', 1, 1, 'Article', '486a6313c7-1', ''),
(24, 'Articles/Article2/52a5a7.jpg', 2, 1, 'Article', 'bb031e0b58-1', ''),
(25, 'Articles/Article3/694e48.jpg', 3, 1, 'Article', '4b624fa1a3-1', ''),
(26, 'Articles/Article4/0e74ca.jpg', 4, 1, 'Article', 'b6b01b105e-1', ''),
(27, 'Articles/Article5/853450.jpg', 5, 1, 'Article', '3418984b98-1', ''),
(28, 'Articles/Article6/a70bd2.jpg', 6, 1, 'Article', 'bd1c852010-1', ''),
(29, 'Banners/Banner2/8ff987.jpg', 2, 1, 'Banner', 'ecfc61b4c5-1', ''),
(30, 'Banners/Banner3/f21fab.jpg', 3, 1, 'Banner', '6dcd2f5374-1', ''),
(31, 'Banners/Banner4/82da51.jpg', 4, 1, 'Banner', '0489c81245-1', ''),
(32, 'Banners/Banner4/9d1f52.jpg', 4, NULL, 'Banner', '31d8fba81f-2', ''),
(33, 'Banners/Banner5/ec65af.jpg', 5, 1, 'Banner', '2c16ac71dd-1', ''),
(34, 'Banners/Banner6/98611a.jpg', 6, 1, 'Banner', '7828b83ff9-1', ''),
(35, 'Banners/Banner7/65b1db.jpg', 7, 1, 'Banner', '591316438a-1', ''),
(36, 'Banners/Banner8/1effb7.jpg', 8, 1, 'Banner', 'a84d2d6464-1', ''),
(37, 'News/News5/7436d6.jpg', 5, 1, 'News', '072d856ad4-1', ''),
(38, 'Testimonials/Testimonial8/62ceff.jpg', 8, 1, 'Testimonial', '2bec3a9572-1', ''),
(39, 'Testimonials/Testimonial9/a907e7.jpg', 9, 1, 'Testimonial', '2f35f0a562-1', ''),
(40, 'Testimonials/Testimonial10/4722fd.jpg', 10, 1, 'Testimonial', '90e59383d0-1', ''),
(41, 'Currencies/Currency25/22ab29.png', 25, 1, 'Currency', '410b1efac2-1', ''),
(43, 'Currencies/Currency26/3581a8.png', 26, 1, 'Currency', '4ff79a8c2b-1', ''),
(44, 'Currencies/Currency27/307f21.jpg', 27, 1, 'Currency', '12e85a3695-1', ''),
(45, 'Currencies/Currency28/dbf4fa.jpg', 28, 1, 'Currency', '2c6fef2420-1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1481070613),
('m000000_000001_create_admin_table', 1481070616),
('m140209_132017_init', 1481598593),
('m140403_174025_create_account_table', 1481598594),
('m140504_113157_update_tables', 1481598595),
('m140504_130429_create_token_table', 1481598595),
('m140622_111540_create_image_table', 1481075820),
('m140622_111545_add_name_to_image_table', 1481075821),
('m140830_171933_fix_ip_field', 1481598596),
('m140830_172703_change_account_table_name', 1481598596),
('m141222_110026_update_ip_field', 1481598596),
('m141222_135246_alter_username_length', 1481598596),
('m150614_103145_update_social_account_table', 1481598597),
('m150623_212711_fix_username_notnull', 1481598598),
('m151218_234654_add_timezone_to_profile', 1481598598),
('m161207_014851_create_currency_table', 1481075477),
('m161207_034239_create_exchange_direction_table', 1481082220),
('m161208_061312_create_course_parser_table', 1481177601),
('m161208_133012_create_order_table', 1481203952),
('m161211_173042_add_ip_column_to_order_table', 1481477451),
('m161211_180525_create_settings_table', 1481479533),
('m161211_182120_create_testimonial_table', 1481480714),
('m161211_190904_add_date_column_to_testimonial_table', 1481483500),
('m161212_024542_create_page_table', 1481510855),
('m161212_043457_create_news_table', 1481517425),
('m161212_043622_create_article_table', 1481517425),
('m161212_044503_add_content_column_to_news_table', 1481517944),
('m161212_044514_add_content_column_to_article_table', 1481517944),
('m161212_044527_add_slug_column_to_news_table', 1481517945),
('m161212_044534_add_slug_column_to_article_table', 1481517946),
('m161212_202203_add_new_field_to_user', 1481598668),
('m161213_005553_add_user_id_column_to_order_table', 1481598669),
('m161213_102108_create_user_wallet_table', 1481753063),
('m161213_195022_add_wallet_column_to_currency_table', 1481753063),
('m161213_202049_create_currency_fields_table', 1481753064),
('m161213_211119_create_order_fields_table', 1481753064),
('m161214_201059_add_history_column_to_order_table', 1481753065),
('m161215_144151_create_banner_table', 1481816663),
('m161215_164222_create_referal_table', 1481894632),
('m161215_164404_create_referal_statistic_table', 1481894633),
('m161216_183750_create_referal_order_table', 1481916664),
('m161216_183957_add_wallet_field_to_referal_order_table', 1481916664),
('m161216_185015_add_status_field_to_referal_order_table', 1481916665),
('m161216_194404_add_field_id_to_user_wallet_table', 1481920652),
('m161220_023629_add_columns_to_currency', 1482201594),
('m161220_023700_add_voucher_field_to_order_table', 1482201595),
('m161220_182609_create_bonus_table', 1482260638),
('m170113_084530_create_settings_table', 1484297267),
('m170114_185053_add_field_to_order_table', 1484421449);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `watches` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `content` text,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `date`, `watches`, `enabled`, `content`, `slug`) VALUES
(5, 'Межбанк: доллар усиливает позиции', '', '2017-01-12', NULL, 1, '<div class=\"image\" style=\"outline: 0px; box-sizing: border-box; text-align: center; color: rgb(0, 0, 0); font-family: Tahoma, Verdana, sans-serif; font-size: 14.4px;\">&nbsp;</div>\r\n\r\n<div class=\"progressive-news-text\" style=\"outline: 0px; box-sizing: border-box; font-stretch: normal; font-size: 16px; line-height: 25px; font-family: Georgia, serif; padding-right: 10px; margin-bottom: 30px; color: rgb(0, 0, 0);\">\r\n<p>&nbsp; &nbsp; Четверг не принес радости сторонникам гривны, также как и полной ясности с трендом по курсу доллара на валютном межбанке. Гривна прочно увязла в позиционных войнах с долларом и, по-прежнему &mdash; девальвирует. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp;Нацбанк пока в ситуацию не вмешивается, очевидно надеясь, что само собой все уладится. Но это&nbsp;вряд-ли произойдет. Тревожным звоночком для регулятора может служить&nbsp;поведение наличного доллара на валютном рынке, точнее &mdash; его рост сначала до 28 гривен, а затем &mdash; продолжение роста котировок с целью в 29 гривен.</p>\r\n\r\n<p>&nbsp; &nbsp; Если такой значительный разрыв между котировками безналичного доллара на межбанке и наличным рынком будет еще больше расти или даже просто сохранится &nbsp;&mdash; жди новых &laquo;рекордов&raquo; на межбанке. Этот разрыв станет основным драйвером роста межбанковских котировок, так как банки будут в пределах своей валютной позиции покупать доллар на торгах и подкрепляя кассы&nbsp;наличным долларом &mdash; через свои обменники &mdash; продавать его на рынке. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>Несмотря на низкие нормативы валютной позиции, которые связывают руки финучреждениям в этой ситуации, такого развития событий будет достаточно, чтобы постоянно давить на валютный курс. Тем более, что увеличение соцвыплат и банкротство очередного банка (читай новые выплаты ФГВФЛ ) &mdash; добавят желающих прикупить наличную валюту. Этим будут активно пользоваться спекулянты, вздергивая курс. Так что без активного вмешательства Нацбанка, как основного поставщика валюты на&nbsp;<a class=\"autolink\" href=\"http://minfin.com.ua/currency/mb/\" style=\"color: black; text-decoration: none; outline: 0px; box-sizing: border-box; border-bottom: 1px solid rgb(187, 187, 187);\" target=\"_blank\">межбанк</a>&nbsp;на тот период пока &laquo;не раскачаются&raquo; экспортеры после новогодних праздников &mdash; не обойтись. Весь вопрос &mdash; до какого предела хочет отпустить Нацбанк курс доллара, не особо вмешиваясь в ход торгов на этой неделе. Пока, судя по всему, это 27,50 -28,00 гривен. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ситуация на рынке остается достаточно нервозной.</p>\r\n</div>\r\n', 'mezhbank-dollar-usilivaet-pozicii');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `exchange_id` int(11) DEFAULT NULL,
  `from_value` decimal(19,4) DEFAULT NULL,
  `to_value` decimal(19,4) DEFAULT NULL,
  `card` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `ip` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `history` tinyint(1) DEFAULT '1',
  `voucher` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `exchange_id`, `from_value`, `to_value`, `card`, `bank`, `fio`, `wallet`, `email`, `date`, `status`, `ip`, `user_id`, `history`, `voucher`, `phone`) VALUES
(1, 38, '100.0000', '6339.0000', '1111323287220912', 'Bank Bank', 'Fio Fio Fio', '0009283912347584', 'dubztep45@gmail.com', '2016-12-08 14:12:10', 1, '46.63.24.252', 0, 1, NULL, ''),
(2, 98, '500.0000', '7.9000', '1212343534203', 'bank babk', 'FIO', '1208941319287398173', 'slobodian04@mail.ru', '2016-12-11 18:12:55', 1, '46.63.24.252', 0, 1, NULL, ''),
(3, 98, '500.0000', '7.9000', '1212343534203', 'bank babk', 'FIO', '1208941319287398173', 'slobodian04@mail.ru', '2016-12-11 18:12:56', 1, '46.63.24.252', 0, 1, NULL, ''),
(4, 98, '65000.0000', '1027.0000', '1111111111111111', 'BANK bank', 'FIO FIO', '1234123412341234', 'slobodian04@mail.ru', '2016-12-12 02:12:40', 1, '46.63.24.252', 0, 1, NULL, ''),
(5, 136, '0.0000', '0.0000', '', '', '', '', '', '2016-12-13 09:12:02', 1, '185.91.179.76', NULL, 1, NULL, ''),
(6, 79, NULL, NULL, '', '', '', '', '', '2016-12-13 09:12:15', 1, '185.91.179.76', NULL, 1, NULL, ''),
(7, 49, '0.0000', '0.0000', '', '', '', '', '', '2016-12-13 10:12:25', 1, '185.91.179.76', NULL, 1, NULL, ''),
(8, 49, NULL, NULL, '', '', '', '', '', '2016-12-13 10:12:34', 1, '185.91.179.76', NULL, 1, NULL, ''),
(9, 98, '0.0000', '0.0000', '', '', '', '', '', '2016-12-13 13:12:33', 1, '185.91.179.76', NULL, 1, NULL, ''),
(10, 120, '10000.0000', '160.0000', '123213123123213', '123213421321312', '12321312321321', '123213213213213', 'test@test.com', '2016-12-13 13:12:12', 1, '188.190.171.184', 3, 1, NULL, ''),
(11, 86, '2000.0000', '1980.0000', '2312313213', 'bank bank', '12321ed23e2e', '108238303189791273913', 'test@test.com', '2016-12-13 13:12:36', 1, '188.190.171.184', 3, 1, NULL, ''),
(12, 35, '0.0000', '0.0000', '', '', '', '', '', '2016-12-13 13:12:39', 1, '92.100.96.237', NULL, 1, NULL, ''),
(13, 91, NULL, '0.0000', '', '', '', '', '', '2016-12-13 14:12:00', 1, '185.91.179.76', 3, 1, NULL, ''),
(14, 43, '1000.0000', '60964.6000', '21123123123', 'd', 'dsfsdf', '23423434324324', 'mail@mail.ru', '2016-12-13 16:12:43', 1, '92.100.76.7', NULL, 1, NULL, ''),
(15, 37, '1000.0000', '60199.8000', NULL, NULL, 'sdfsdfsdfsdfsd', NULL, 'sdfsdfsdfsd', '2016-12-15 11:35:59', 0, '217.66.158.158', 3, 1, NULL, ''),
(16, 35, '500.0000', '495.0000', NULL, NULL, 'sdasd', NULL, 'stils1606@rambler.ru', '2016-12-16 23:42:47', 0, '92.100.66.227', 3, 1, NULL, ''),
(17, 38, '10.0000', '611.3400', NULL, NULL, 'Fio Fio', NULL, 'slobodian04@mail.ru', '2016-12-17 04:31:40', 0, '46.63.24.252', NULL, 1, '', ''),
(18, 39, '100.0000', '6113.4000', NULL, NULL, 'dewok', NULL, 'slobodian04@mail.ru', '2016-12-19 06:10:58', 0, '46.63.24.252', 25, 1, NULL, ''),
(19, 39, '100.0000', '6113.4000', NULL, NULL, 'dewok', NULL, 'slobodian04@mail.ru', '2016-12-19 06:12:25', 0, '46.63.24.252', 25, 1, NULL, ''),
(20, 39, '100.0000', '6113.4000', NULL, NULL, 'dewok', NULL, 'slobodian04@mail.ru', '2016-12-19 06:13:05', 4, '46.63.24.252', 25, 1, '', ''),
(21, 71, '1000.0000', '990.0000', NULL, NULL, 'ЖДанов ИГорь', NULL, 'yabot@ua.fm', '2016-12-19 16:05:43', 3, '130.180.216.42', NULL, 1, '', ''),
(22, 37, '500.0000', '30567.0000', NULL, NULL, 'ваыва', NULL, 'ываыва', '2016-12-19 18:45:06', 0, '217.66.152.136', NULL, 1, NULL, ''),
(23, 41, '0.0000', '0.0000', NULL, NULL, '213', NULL, '213', '2016-12-19 18:47:26', 0, '217.66.152.136', NULL, 1, NULL, ''),
(24, 41, '0.0000', '0.0000', NULL, NULL, '213', NULL, '213', '2016-12-19 18:47:27', 0, '217.66.152.136', NULL, 1, NULL, ''),
(25, 41, '0.0000', '0.0000', NULL, NULL, '213', NULL, '213', '2016-12-19 18:47:28', 0, '217.66.152.136', NULL, 1, NULL, ''),
(26, 41, '0.0000', '0.0000', NULL, NULL, '213', NULL, '213', '2016-12-19 18:47:28', 0, '217.66.152.136', NULL, 1, NULL, ''),
(27, 41, '0.0000', '0.0000', NULL, NULL, '213', NULL, '213', '2016-12-19 18:47:28', 0, '217.66.152.136', NULL, 1, NULL, ''),
(28, 49, '1000.0000', '990.0000', NULL, NULL, 'SLooooo', NULL, 'slobodian04@mail.ru', '2016-12-20 05:56:16', 0, '46.63.24.252', 25, 1, NULL, ''),
(29, 140, '100.0000', '6117.5200', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'slobodian04@mail.ru', '2016-12-20 05:57:12', 0, '46.63.24.252', 25, 1, NULL, ''),
(30, 140, '100.0000', '6117.5200', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'slobodian04@mail.ru', '2016-12-20 05:58:09', 0, '46.63.24.252', 25, 1, NULL, ''),
(31, 47, '100.0000', '99.0000', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'slobodian04@mail.ru', '2016-12-20 05:59:40', 0, '46.63.24.252', 25, 1, '', ''),
(32, 49, '100.0000', '99.0000', NULL, NULL, 'test voucher field by user', NULL, 'slobodian04@mail.ru', '2016-12-20 06:56:07', 0, '46.63.24.252', 25, 1, '', ''),
(33, 102, '1000.0000', '990.0000', NULL, NULL, 'test voucher field by admin', NULL, 'slobodian04@mail.ru', '2016-12-20 06:56:51', 4, '46.63.24.252', 25, 1, 'voucher test admin mail', ''),
(34, 35, '0.0000', '0.0000', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:47:02', 0, '185.91.179.76', 3, 1, NULL, ''),
(35, 35, '0.0000', '0.0000', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:47:08', 0, '185.91.179.76', 3, 1, NULL, ''),
(36, 35, '3434.0000', '3399.6600', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:47:19', 0, '185.91.179.76', 3, 1, NULL, ''),
(37, 35, '3434.0000', '3399.6600', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:47:21', 0, '185.91.179.76', 3, 1, NULL, ''),
(38, 95, '3000.0000', '2970.0000', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:54:33', 0, '185.91.179.76', 3, 1, NULL, ''),
(39, 95, '3000.0000', '2970.0000', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:54:36', 0, '185.91.179.76', 3, 1, NULL, ''),
(40, 99, '0.0000', '0.0000', NULL, NULL, 'dffs', NULL, 'sdfsd', '2016-12-20 11:54:41', 0, '185.91.179.76', 3, 1, NULL, ''),
(41, 95, '3333.0000', '203896.9400', NULL, NULL, 'fdhfhf', NULL, 'fhfhfhr', '2016-12-20 11:57:01', 0, '185.91.179.76', 3, 1, NULL, ''),
(42, 100, '0.0000', '0.0000', NULL, NULL, 'fdhfhf', NULL, 'fhfhfhr', '2016-12-20 11:57:11', 0, '185.91.179.76', 3, 1, NULL, ''),
(43, 100, '0.0000', '0.0000', NULL, NULL, 'fdhfhf', NULL, 'fhfhfhr', '2016-12-20 11:57:18', 0, '185.91.179.76', 3, 1, NULL, ''),
(44, 100, '0.0000', '0.0000', NULL, NULL, 'fdhfhf', NULL, 'fhfhfhr', '2016-12-20 11:57:24', 0, '185.91.179.76', 3, 1, NULL, ''),
(45, 100, '0.0000', '0.0000', NULL, NULL, 'fdhfhf', NULL, 'fhfhfhr', '2016-12-20 11:57:24', 0, '185.91.179.76', 3, 1, NULL, ''),
(46, 105, '5454.0000', '5399.4600', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 11:58:39', 0, '185.91.179.76', 3, 1, NULL, ''),
(47, 84, '32434.0000', '32109.6600', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 12:30:58', 0, '185.91.179.76', 3, 1, NULL, ''),
(48, 108, '1000.0000', '16.0000', NULL, NULL, 'swswqdw', NULL, 'slobodian04@mail.ru', '2016-12-20 12:32:59', 0, '188.190.171.184', 25, 1, NULL, ''),
(49, 40, '654.0000', '40008.5800', NULL, NULL, 'ytrytrytr', NULL, 'test@test.com', '2016-12-20 12:33:16', 0, '185.91.179.76', 3, 1, NULL, ''),
(50, 39, '87987.0000', '5382622.3200', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 12:33:32', 0, '185.91.179.76', 3, 1, NULL, ''),
(51, 98, '1000.0000', '16.0000', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'dubztep45@gmail.com', '2016-12-20 12:37:56', 3, '188.190.171.184', 25, 1, '', ''),
(52, 73, '1000.0000', '61175.2000', NULL, NULL, 'Жданов Игорь Иванович', NULL, 'yabot@ua.fm', '2016-12-20 13:01:44', 0, '130.180.216.125', NULL, 1, NULL, ''),
(53, 117, '3423.0000', '3388.7700', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 13:05:02', 0, '185.91.179.76', 3, 1, '', ''),
(54, 71, '1000.0000', '990.0000', NULL, NULL, 'ЖДанов ИГорь', NULL, 'kjubrff45@yandex.ru', '2016-12-20 13:05:34', 0, '130.180.216.125', NULL, 1, NULL, ''),
(55, 73, '500.0000', '30587.6000', NULL, NULL, 'ропонго', NULL, '123@123.ru', '2016-12-20 13:05:52', 0, '92.100.81.139', NULL, 1, '13', ''),
(56, 117, '45345.0000', '44891.5500', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 13:06:25', 0, '185.91.179.76', 3, 1, NULL, ''),
(57, 35, '100.0000', '99.0000', NULL, NULL, 'ропонго', NULL, '123@123.ru', '2016-12-20 13:07:57', 0, '92.100.81.139', NULL, 1, NULL, ''),
(58, 35, '1000.0000', '990.0000', NULL, NULL, 'ропонго', NULL, 'stils1606@gmail.com', '2016-12-20 14:02:09', 4, '92.100.81.139', NULL, 1, '', ''),
(59, 40, '1000.0000', '61175.2000', NULL, NULL, 'ропонго', NULL, 'stils1606@gmail.com', '2016-12-20 14:03:14', 4, '92.100.81.139', NULL, 1, '', ''),
(60, 39, '1000.0000', '61175.2000', NULL, NULL, 'ропонго', NULL, 'stils1606@gmail.com', '2016-12-20 14:06:30', 0, '92.100.81.139', NULL, 1, NULL, ''),
(61, 109, '45345.0000', '2773989.4400', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 14:29:54', 0, '185.91.179.76', NULL, 1, NULL, ''),
(62, 44, '0.0000', '0.0000', NULL, NULL, 'ваппроо', NULL, 'snqzvdmbsyvc@gmail.com', '2016-12-20 15:48:57', 0, '193.238.152.80', NULL, 1, '', ''),
(63, 38, '200.0000', '12235.0400', NULL, NULL, 'ваппроо', NULL, 'snqzvdmbsyvc@gmail.com', '2016-12-20 15:49:42', 0, '193.238.152.80', NULL, 1, '', ''),
(64, 109, '34234.0000', '2094271.8000', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 15:55:36', 0, '185.91.179.76', NULL, 1, NULL, ''),
(65, 101, '4536.0000', '34534.0000', NULL, NULL, 'gsgtrh', NULL, 'rterytry@yet.com', '2016-12-20 15:55:42', 0, '185.91.179.76', NULL, 1, NULL, ''),
(66, 101, '4536.0000', '34534.0000', NULL, NULL, 'gsgtrh', NULL, 'rterytry@yet.com', '2016-12-20 15:55:43', 0, '185.91.179.76', NULL, 1, NULL, ''),
(67, 101, '4536.0000', '34534.0000', NULL, NULL, 'gsgtrh', NULL, 'rterytry@yet.com', '2016-12-20 15:55:45', 0, '185.91.179.76', NULL, 1, NULL, ''),
(68, 41, '0.0000', '0.0000', NULL, NULL, 'dthdh', NULL, 'test@test.com', '2016-12-20 15:57:02', 0, '185.91.179.76', NULL, 1, NULL, ''),
(69, 82, '3456.0000', '3421.4400', NULL, NULL, 'rsfgth', NULL, 'test@test.com', '2016-12-20 15:59:38', 0, '185.91.179.76', 3, 1, NULL, ''),
(70, 82, '88.0000', '87.1200', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 16:06:26', 0, '185.91.179.76', 3, 1, NULL, ''),
(71, 82, '5454.0000', '5399.4600', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 16:19:44', 0, '185.91.179.76', 3, 1, '', ''),
(72, 124, '5454.0000', '5399.4600', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 16:21:56', 0, '185.91.179.76', 3, 1, NULL, ''),
(73, 37, '5454.0000', '333649.5400', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 16:25:41', 0, '185.91.179.76', NULL, 1, NULL, ''),
(74, 39, '89888989.0000', '5498976879.8700', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 16:26:20', 0, '185.91.179.76', NULL, 1, '', ''),
(75, 105, '8798789.0000', '8710801.1100', NULL, NULL, 'dffs', NULL, 'test@test.com', '2016-12-20 16:29:48', 0, '185.91.179.76', NULL, 1, '', ''),
(76, 38, '1000.0000', '61175.2000', NULL, NULL, '121', NULL, 'webpartners123@gmail.com', '2016-12-20 22:14:39', 4, '92.100.76.161', NULL, 1, '', ''),
(77, 38, '1000.0000', '61175.2000', NULL, NULL, 'ропонго', NULL, 'stils1606@yandex.ru', '2016-12-20 22:30:56', 0, '92.100.76.161', NULL, 1, '', ''),
(78, 94, '1000.0000', '990.0000', NULL, NULL, 'dewdwd', NULL, 'dubztep45@gmail.com', '2016-12-21 23:51:03', 0, '46.63.24.252', NULL, 1, '', ''),
(79, 151, '1000.0000', '970.0000', NULL, NULL, 'owdjoewid', NULL, 'slobodian04@mail.ru', '2016-12-21 23:52:51', 4, '46.63.24.252', NULL, 1, '', ''),
(80, 139, '10.0000', '604.9800', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'someref@some.com', '2016-12-22 09:46:51', 4, '46.63.24.252', NULL, 1, '', ''),
(81, 98, '500.0000', '8.1000', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'someref@some.com', '2016-12-22 10:18:46', 0, '46.63.24.252', 37, 1, '', ''),
(82, 104, '1000.0000', '990.0000', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'someref@some.com', '2016-12-22 11:08:15', 0, '46.63.24.252', 1, 1, '', ''),
(83, 164, '1000.0000', '990.0000', NULL, NULL, 'Жданов Игорь Иванович', NULL, 'kjubrff100@yandex.ru', '2016-12-26 16:06:01', 2, '130.180.219.241', 39, 1, NULL, ''),
(84, 187, '1000.0000', '980.0000', NULL, NULL, 'Жданов Игорь Иванович', NULL, 'kjubrff100@yandex.ru', '2017-01-02 12:37:51', 4, '130.180.219.168', 39, 1, 'weklrfwour58932iohjkljv;fkosjf938uro3', ''),
(85, 188, '10000.0000', '10.0000', NULL, NULL, 'Жданов Игорь Иванович', NULL, 'kjubrff100@yandex.ru', '2017-01-02 12:43:14', 4, '130.180.219.168', 39, 1, 'Kjlksjkvn3495093jklsmklvmsl09435u4i23jlkfdsmfl', ''),
(86, 91, '10000.0000', '163.0000', NULL, NULL, 'Gadfly hhffg.  Gghhhhhhhh', NULL, 'dubztep45@gmail.com', '2017-01-03 11:17:05', 3, '46.63.24.252', NULL, 1, '', ''),
(87, 91, '1000.0000', '16.3000', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'dubztep45@gmail.com', '2017-01-03 11:26:32', 3, '46.63.24.252', NULL, 1, '', ''),
(88, 94, '1000.0000', '990.0000', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'the.acrux.studio@gmail.com', '2017-01-03 11:27:37', 3, '46.63.24.252', NULL, 1, '', ''),
(89, 190, '100.0000', '5641.0900', NULL, NULL, 'Ivanov Ivan Ivanovich', NULL, 'the.acrux.studio@gmail.com', '2017-01-03 11:28:33', 3, '46.63.24.252', 5, 1, '', ''),
(90, 189, '44.0000', '2353.4900', NULL, NULL, 'ропонго', NULL, 'stils1606@yandex.ru', '2017-01-03 11:55:25', 3, '92.100.67.202', 27, 1, '', ''),
(91, 188, '100.0000', '0.1100', NULL, NULL, 'Богатырева Елена', NULL, 'love-pink@ukr.net', '2017-01-11 15:57:18', 0, '130.180.220.100', 40, 1, NULL, ''),
(92, 188, '100.0000', '0.1100', NULL, NULL, 'Богатырева Елена', NULL, 'love-pink@ukr.net', '2017-01-11 15:57:21', 0, '130.180.220.100', 40, 1, '', ''),
(93, 189, '504.0000', '29178.3000', NULL, NULL, 'dghjkl,nm', NULL, 'love-pink@ukr.net', '2017-01-12 13:21:57', 0, '130.180.218.82', 40, 1, NULL, ''),
(94, 189, '508.0000', '29178.3000', NULL, NULL, 'dghjkl,nm', NULL, 'love-pink@ukr.net', '2017-01-12 13:21:58', 0, '130.180.218.82', 40, 1, '', ''),
(95, 102, '10000.0000', '9900.0000', NULL, NULL, 'dghjkl,nm', NULL, 'love-pink@ukr.net', '2017-01-12 13:24:56', 0, '130.180.218.82', 40, 1, NULL, ''),
(96, 102, '10000.0000', '9900.0000', NULL, NULL, 'dghjkl,nm', NULL, 'love-pink@ukr.net', '2017-01-12 13:24:57', 0, '130.180.218.82', 40, 1, NULL, ''),
(97, 73, '1000.0000', '58776.3000', NULL, NULL, 'Кирилл', NULL, 'mail@mail.ru', '2017-01-14 21:49:01', 0, '92.100.91.41', 27, 1, NULL, ''),
(98, 106, '79000.0000', '78210.0000', NULL, NULL, 'gggggggggggg', 'jjjjjjjjjjjjjjjjjj', 'cryivanbtc@gmail.com', '2017-01-14 22:19:23', 0, '130.180.216.61', 40, 1, NULL, '+380539958024'),
(99, 106, '79000.0000', '78210.0000', NULL, NULL, 'gggggggggggg', 'jjjjjjjjjjjjjjjjjj', 'cryivanbtc@gmail.com', '2017-01-14 22:19:25', 0, '130.180.216.61', 40, 1, NULL, '+380539958024'),
(100, 242, '7903.0000', '454894.7200', NULL, NULL, 'gggggggggggg', 'jjjjjjjjjjjjjjjjjj', 'love-pink@ukr.net', '2017-01-15 20:22:47', 0, '130.180.220.139', 40, 1, NULL, '+380539958024'),
(101, 242, '7907.0000', '454894.7200', NULL, NULL, 'gggggggggggg', 'jjjjjjjjjjjjjjjjjj', 'love-pink@ukr.net', '2017-01-15 20:22:53', 0, '130.180.220.139', 40, 1, NULL, '+380539958024'),
(102, 254, '503.0000', '28553.9800', NULL, NULL, '9999999999999', '9999999999', 'love-pink@ukr.net', '2017-01-16 17:16:48', 3, '78.111.185.111', 40, 1, NULL, '+380539958024'),
(103, 390, '100.0000', '99.0000', NULL, NULL, 'Ivanov Ivan Ivanovich', '12321321321', 'dubztep45@gmail.com', '2017-01-16 23:22:25', 0, '46.63.24.252', NULL, 1, NULL, '1098329821'),
(104, 396, '100.0000', '99.0000', NULL, NULL, 'Ivanov Ivan Ivanovich', '12321321321', 'dubztep45@gmail.com', '2017-01-16 23:40:20', 0, '46.63.24.252', NULL, 1, NULL, '986264200'),
(105, 389, '1000.0000', '990.0000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-16 23:51:31', 0, '92.100.103.22', 27, 1, NULL, '9111111111'),
(106, 396, '10000.0000', '9900.0000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-16 23:52:04', 0, '92.100.103.22', 27, 1, NULL, '9111111111'),
(107, 635, '1000.0000', '1.2000', NULL, NULL, 'Иванович Игорь', '16JoM6cfCXUWLdf8whRGTzvgqy335UD8Df', 'yabot@ua.fm', '2017-01-17 13:41:34', 3, '130.180.217.236', NULL, 1, NULL, '+380931156712'),
(108, 709, '17.0000', '800.0000', NULL, NULL, 'gggggggggggg', '9999999999', 'love-pink@ukr.net', '2017-01-18 21:56:25', 3, '78.111.190.14', NULL, 1, NULL, '+380539958024'),
(109, 766, '1000.0000', '960.0000', NULL, NULL, '', '', '', '2017-01-19 22:27:38', 0, '109.86.200.217', NULL, 1, NULL, ''),
(110, 840, '14.0000', '9.9000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-21 22:01:03', 2, '92.100.75.142', 27, 1, NULL, '9111111111'),
(111, 840, '14.0000', '9.9000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-21 22:01:32', 2, '92.100.75.142', 27, 1, NULL, '9111111111'),
(112, 840, '14.0000', '9.9000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-21 22:01:48', 2, '92.100.75.142', 27, 1, NULL, '9111111111'),
(113, 850, '1000.0000', '16.6000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-21 23:17:36', 0, '92.100.75.142', 27, 1, NULL, '9111111111'),
(114, 850, '1000.0000', '16.6000', NULL, NULL, 'Кирилл', '23423434324324', 'stils1606@rambler.ru', '2017-01-21 23:27:04', 0, '92.100.75.142', 27, 1, NULL, '9111111111');

-- --------------------------------------------------------

--
-- Структура таблицы `order_fields`
--

CREATE TABLE `order_fields` (
  `id` int(11) NOT NULL,
  `field_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_fields`
--

INSERT INTO `order_fields` (`id`, `field_id`, `value`, `order_id`) VALUES
(1, 1, '234131243', 15),
(2, 2, 'saasf', 15),
(3, 1, 'sdsadasd', 16),
(4, 2, 'asds', 16),
(5, 1, '123123123123', 17),
(6, 1, '891372971', 18),
(7, 1, '891372971', 19),
(8, 1, '891372971', 20),
(9, 1, 'U2512772', 21),
(10, 1, '13123', 22),
(11, 1, '3213213', 23),
(12, 1, '3213213', 24),
(13, 1, '3213213', 25),
(14, 1, '3213213', 26),
(15, 1, '3213213', 27),
(16, 4, '2131', 28),
(17, 1, 'dasdasdsad', 34),
(18, 1, 'dasdasdsad', 35),
(19, 1, 'dasdasdsad', 36),
(20, 1, 'dasdasdsad', 37),
(21, 1, '32234242', 41),
(22, 1, 'dasdasdsad', 42),
(23, 1, 'dasdasdsad', 43),
(24, 1, 'dasdasdsad', 44),
(25, 1, 'dasdasdsad', 45),
(26, 1, 'dasdasdsad', 49),
(27, 1, 'dasdasdsad', 50),
(28, 1, 'U2512772', 54),
(29, 1, 'dasdasdsad', 56),
(30, 1, '123', 57),
(31, 1, '122', 58),
(32, 1, '12213', 59),
(33, 1, '112321', 60),
(34, 1, 'dasdasdsad', 61),
(35, 1, 'U2512772', 62),
(36, 1, 'U2512772', 63),
(37, 1, 'dasdasdsad', 64),
(38, 1, 'retyry', 68),
(39, 1, 'dasdasdsad', 72),
(40, 1, 'dasdasdsad', 73),
(41, 1, 'dasdasdsad', 74),
(42, 1, '12123', 76),
(43, 1, 'sdsadasd', 77),
(44, 1, 'edwoiw234234', 79),
(45, 1, 'U2512772', 83),
(46, 1, 'U2512772', 84),
(47, 1, 'U25667722', 85),
(48, 1, '63373733736434', 86),
(49, 1, 'edwoiw234234', 87),
(50, 1, 'edwoiw234234', 89),
(51, 1, '34234324', 90),
(52, 1, '11199933', 91),
(53, 1, '11199933', 92),
(54, 1, '11199933', 93),
(55, 1, '11199933', 94);

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `content`, `slug`) VALUES
(1, 'О СЕРВИСЕ', '<p><strong>100 монет является сертифицированным партнером платежной системы Perfect Money.</strong></p><p>Мы готовы предоставить нашим клиентам сервис высокого уровня и оперативность в оказании услуг по обмену, покупке и продаже электронных валют на наиболее выгодных условиях в Интернете.</p><p>Мы используем в своей работе высоколиквидные средства, осуществляющие надежный обмен, поэтому можем предложить выгодные условия для наших клиентов. Мы получили сертификат от Perfect Money и являемся ее официальным партнером.</p><p>На данный момент наша система работает со всеми наиболее востребованными платежными системами, которые востребованы пользователями интернета для совершения разного рода операций.</p><p>Вывод денег, перевод и обналичивание может осуществляться не только между двумя электронными системами, но и с них на банковскую карту и обратно.</p><p>Активно наши клиенты пользуются услугой перевода средств с одной валюты в другую между разными кошельками, в том числе и Perfect Money USD. Во время сотрудничества мы стараемся сделать все возможное, чтобы у наших клиентов не возникали проблемы с выводом.</p><p>С нашей помощью процесс обналичивания стал еще проще, теперь нет необходимости заводить сертификат или делать привязку карты к платежной системе.</p><p>Все переводы осуществляются в максимально короткие сроки, что является еще одним неоспоримым преимуществом сотрудничества с нашей компанией.</p><p>Постоянное пополнение резервов позволяет избежать задержек в связи с отсутствием средств. Мы стремимся предложить своим клиентам лучшие условия обслуживания, поэтому постоянно совершенствуем свой сервис и улучшаем обслуживание.</p><p>Мы строго следим за качеством проводимых сделок и при выявлении каких-либо действий, связанных с мошенничеством, моментально блокируем пользователя до тех пор, пока он не предоставит объяснения относительно собственных действий.</p>', 'o-servise'),
(2, 'Правила', '<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">1. Общие положения</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.1&nbsp;Настоящее Соглашение регламентирует порядок и условия предоставления услуг сервисом Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.2&nbsp;Web-obmen.net &ndash; программно-аппаратный сервис, находящийся в сети интернет по адресу Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.3&nbsp;Клиент - лицо, желающее воспользоваться услугами Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.4&nbsp;Web-obmen.net и Клиент совместно именуются Стороны.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.5&nbsp;Стороны признают настоящее Соглашение в электронной форме равнозначным по юридической силе Соглашению, заключенному в письменной форме.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.6&nbsp;Настоящее Соглашение считается заключенным на условиях публичной оферты, акцептуемой Клиентом в ходе подачи заявки на сайте Web-obmen.net на использование услуг, предоставляемыми сервисом.</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">2. Предмет Соглашения</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">2.1 Web-obmen.net оказывает Клиенту услуги (пункт 4 Соглашения) в соответствии с регламентом (пункт 5 Соглашения) при соблюдении обязательных условий (пункт 9 Соглашения).</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">2.2&nbsp;Клиент пользуется услугами Web-obmen.net и оплачивает их в соответствии с условиями настоящего Соглашения..</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">3. Права и обязанности сторон</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1&nbsp;Web-obmen.net обязуется:</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1.1&nbsp;Оказывать Клиенту услуги по обмену электронных денег платежных систем Qiwi, Perfect Money, BTC-E.com, BTC, Яндекс-Деньги согласно правилам и регламенту настоящего Соглашения.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1.2&nbsp;Оказывать Клиенту необходимую ему техническую и консультационную поддержку, связанную с использованием и предоставлением услуг Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1.3&nbsp;Хранить всю информацию (адреса, суммы, время, идентификационные данные (персональные данные) и т.д.) по обменным операциям Клиентов и предоставлять её по первому требованию Клиентов, к которым она относится, за исключением операций с анонимными платежными системами .</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1.4&nbsp;Хранить в тайне и не разглашать информацию по обменным операциям, а также личные данные Клиентов Web-obmen.net третьим лицам, за исключением следующих ситуаций:\r\n<ul style=\"list-style-type:none\">\r\n	<li>- по законному решению суда по месту нахождения владельца сервиса Web-obmen.net;</li>\r\n	<li>- по законному запросу компетентных органов по месту нахождения владельца сервиса Web-obmen.net;</li>\r\n	<li>- по запросу администрации одной из платежных систем</li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1.5&nbsp;Вести точную статистику по скидкам Клиентов.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.1.6&nbsp;Перевести средства, причитающиеся клиенту или третьему лицу на указанные реквизиты не позднее 48 часов с момента обращения клиента с жалобой о не приходе после обмена средств, в случаях, описанных в пунктах 3.2.5, 5.4, 5.5 и 5.6 настоящего Соглашения.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2&nbsp;Клиент обязуется:</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.1&nbsp;Указывать точные и достоверные платежные реквизиты как свои, так и третьих лиц.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.2&nbsp;Указывать точный, достоверный и работоспособный электронный почтовый ящик.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.3&nbsp;Следить за работоспособностью своего ящика электронной почты, компьютера, в том числе применять актуальные антивирусные ПО.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.4&nbsp;Выполнять каждый пункт настоящего Соглашения.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.5&nbsp;Сообщить администрации Web-obmen.net о частичном или полном не поступлении средств на указанные реквизиты клиента или третьего лица в результате произведенного обмена, а также о не поступлении средств, в случаях, указанных в пунктах 5.4, 5.5 и 5.6 не позднее 30-ти дней с момента не поступления средств, в противном случае эти средства поступают в распоряжение администрации Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.6&nbsp;Предоставить заведомо верный номер своего мобильного телефона для регистрации, контрольного (входящего) звонка от службы безопасности сервиса, получения паролей, коротких текстовых сообщений (SMS/СМС ) и других способов информирования и дополнительной идентификации для сервиса 100monet.pro.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.2.7&nbsp;Своими действиями не нарушать действующее законодательство страны, в которой находится Клиент, осуществляя обменные операции с помощью сервиса Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3&nbsp;Администрация Web-obmen.net имеет право:</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.1&nbsp;Приостанавливать сервис для технической модернизации или устранения функциональных ошибок.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.2&nbsp;Приостанавливать текущий обмен (транзакцию), в случае законного обращения компетентных органов, администраций платежных систем, а также пользователей с жалобой о мошенничестве, на время выяснения обстоятельств.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.3&nbsp;Устанавливать и изменять размер скидок на обмен электронных денег по своему усмотрению.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.4&nbsp;Устанавливать и изменять размер комиссии, взимаемой с клиента в результате обмена электронных денег, по своему усмотрению.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.5&nbsp;Отказать в предоставлении услуг любому клиенту без объяснения причин.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.6&nbsp;Требовать от Клиента подтверждения своей принадлежности к электронному обмену с помощью: E-mail, скриншота электронного кошелька, а также, в случае необходимости, путем проверочного звонка на номер телефона, указанных при заполнении формы обмена, с которого были отправлены средства для совершения электронного обмена, если этот обмен завершился с ошибкой.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">v3.3.7&nbsp;Прекратить переписку или переговоры с Клиентом, если Клиент грубит, оскорбляет, задает вопросы, не относящиеся к службе поддержки Web-obmen.net или сам не отвечает на поставленные вопросы службы поддержки.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">3.3.8&nbsp;Заблокировать обмен согласно пунктам 5.4, 5.5 и 5.6 регламента обмена электронных денег.</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">4. Предоставляемые услуги</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">4.1&nbsp;Web-obmen.net предоставляет следующие услуги: обмен электронных денег, на сайте 100monet.pro, а именно обмен Qiwi, Perfect Money, BTC-E.com, BTC, Яндекс-Деньги с возможным использованием банков указанных на сайте.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">4.2&nbsp;Web-obmen.net не проверяет правомочность и законность владения Клиентом средствами, предлагаемыми к обмену.</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">5. Регламент обмена электронных денег</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">5.1&nbsp;Обмен считается начатым, когда сервис Web-obmen.net получит от Клиента полную сумму, предназначенную для данного обмена.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">5.2&nbsp;Обмен считается законченным, когда Web-obmen.net переведет предназначенную Клиенту или третьему лицу сумму на платежные реквизиты, указанные Клиентом, в результате данного обмена.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">5.3&nbsp;Обмен электронными денежными средствами не может быть отменен, если он уже начат, так же как и возврат Клиенту денежных средств, которые он хотел обменять.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">5.4&nbsp;В случае поступления от Клиента суммы отличной от той, что была указана при оформлении обмена, Web-obmen.net имеет право приостановить обмен, а в дальнейшем после обращения Клиента, согласно пункту 3.2.5, выплатить фактически полученную сумму, пересчитанную по курсу, который действовал на момент начала обмена.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">5.5&nbsp;В случае, если Клиент указал не существующие или заблокированные реквизиты, на которые должна была в результате обмена поступить сумма, Web-obmen.net может приостановить обмен, а в дальнейшем после обращения Клиента, согласно пункту 3.2.5, вернуть средства на счет, с которого они поступили, за вычетом комиссии платежных систем и штрафа в размере 2% от возвращаемой суммы.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">5.6&nbsp;В случае изменения примечания к платежу или оплаты выписанного счета с другого аккаунта обмен может быть заблокирован, а после обращения Клиента, согласно пункту 3.2.5 сумма обмена будет возвращена за вычетом 1% от суммы обмена и комиссии платежных систем.</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">6. Ответственности сторон</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">6.1&nbsp;Web-obmen.net не несет ответственности и не возмещает убытки, возникшие при неправильном (несанкционированном) использовании сервиса, а также ошибок Клиента, совершенных при заполнение формы обмена, которые могут привести к переводу средств на ошибочно указанный счет, в этом случае отменить операцию обмена или вернуть средства обратно невозможно.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">6.2&nbsp;Web-obmen.net не несет ответственности за потери и/или ущерб (убыток), возникший в связи с невозможностью использования Клиентом собственного оборудования и/или его элементов и/или отсутствием необходимой полной или частичной функциональности оборудования или его элементов.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">6.3&nbsp;Web-obmen.net не несет ответственности за ошибки, упущения или задержки платежей, допущенные электронными платежными системами и банками.</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">7. Изменение информации</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">7.1&nbsp;Настоящее Соглашение может быть изменено и дополнено администрацией Web-obmen.net; изменения вступают в силу с момента публикации Соглашения на Интернет-сайте Web-obmen.net</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">8. Форс-мажор</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">8.1&nbsp;Стороны не несут ответственность за задержки или неисполнение своих обязательств, согласно настоящего Соглашения и/или договоренностей, в результате возникновения обстоятельств непреодолимой силы, включая (без ограничения) стихийные бедствия, акты правительственной или регулирующей власти, войны, огня (пожара), наводнения, взрыва, терроризма, бунта, гражданского волнения, хакерских атак, отсутствия, не функционирования или сбоя работы энергоснабжения, поставщиков Интернет услуг, сетей связи или других систем, сетей и услуг.</div>\r\n</div>\r\n\r\n<div class=\"point\" style=\"box-sizing: border-box; outline: none; margin: 0px 0px 24px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; background-color: rgb(246, 246, 246);\">\r\n<div class=\"name\" style=\"box-sizing: border-box; outline: none; font-size: 18px; line-height: 18px; color: rgb(30, 173, 87); font-weight: 600; margin: 0px 0px 11px;\">9. Обязательные условия проведения обменных операций</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">9.1&nbsp;Запрещено пользоваться услугами сервиса Web-obmen.net для проведения незаконных переводов и мошеннических действий. Пользуясь услугами сервиса Web-obmen.net, Клиент дает согласие на то, что любая попытка обмена средств сомнительного происхождения будет иметь судебное преследование в соответствии с действующим законодательством страны, с территории которой Клиент осуществляет обменные операции.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">9.2&nbsp;Администрация сервиса Web-obmen.net оставляет за собой право предоставлять информацию о подобных платежах компетентным органам, администрациям платежных систем, а также жертвам мошеннических действий по их требованию, если факт незаконных действий будет доказан.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">9.3&nbsp;Обмен производится при условии, что Клиент при помощи сервиса Web-obmen.net выводит цифровые знаки только со своего электронного кошелька и сам несет ответственность за источники и способы поступления на его электронный кошелек, ввиду отсутствия возможности проверки их происхождения Сервисом Web-obmen.net.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">9.4&nbsp;Сервис Web-obmen.net не несет ответственности за совершенные обменные операции по поручению Клиента в пользу третьих лиц.</div>\r\n\r\n<div class=\"s-point\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">9.5&nbsp;Использование сервиса Web-obmen.net, после нажатия кнопки &laquo;Я согласен с правилами обмена&raquo;, означает, что Клиент принимает все требования согласно настоящего Соглашения.</div>\r\n</div>\r\n', 'pravila'),
(3, 'Партнерам', '<p>Мы предлагаем желающим принять участие в нашей партнерской программе, в которой каждый участник сможет заработать на обмене электронных валют. Участвуя в ней, Вы сможете зарабатывать деньги вместе с нами.</p><p>После регистрации в Вам необходимо разместить на Ваших веб-страницах (в личном блоге, в подписях на форумах и т.д.) ссылку, ведущую пользователей на наш веб-сайт. Ссылка должна содержать уникальный код, однозначно идентифицирующий, что клиента привлекли Вы. Вы сможете зарабатывать от 10% до 30% от суммы прибыли от обмена.</p><p>ВНИМАНИЕ! По некоторым направлениям обменам комиссия составляет 0% или даже имеет отрицательное значение. В этих случаях партнёрское вознаграждение не начисляется.</p><p>Чем больше клиентов Вы пригласите на наш сайт, чем больше обменов они совершат - тем больше денег Вы заработаете. Вы можете заказать вывод в Ваш Qiwi кошелек, как только Ваш заработок будет больше или равен 100 руб.</p><p>Вы зарабатываете % от прибыли нашего сервиса с каждого привлеченного вами клиента. Процент растет от общей суммы обменов ваших рефералов первого уровня, а также от количества привлечённых рефералов. Все вознаграждения зачисляются только при условии статуса заявки &quot;выполнена&quot;.</p>', 'partneram'),
(4, 'Контакты', '<div class=\"c-title\" style=\"box-sizing: border-box; outline: none; font-weight: 600; color: rgb(0, 0, 0); font-size: 14px; line-height: 17px; text-transform: uppercase; font-family: &quot;Open Sans&quot;, sans-serif;\">ОБМЕН НАЛИЧНЫХ ВОЗМОЖЕН В МОСКВЕ, КИЕВЕ, ХАРЬКОВЕ</div>\r\n\r\n<div class=\"contacts\" style=\"box-sizing: border-box; outline: none; margin: 35px 0px 29px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px; \">\r\n<div class=\"schedule\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 22px; margin: 0px 0px 4px; padding: 0px 0px 0px 30px; background: url(&quot;../img/c-schedule-ico.png&quot;) left top 3px no-repeat;\">Пн-Вс, с 9-00 до 23-00</div>\r\n\r\n<div class=\"phone\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 22px; margin: 0px 0px 4px; padding: 0px 0px 0px 30px; background: url(&quot;../img/c-phone-ico.png&quot;) left top 5px no-repeat;\">&nbsp;</div>\r\n\r\n<div class=\"icq\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 22px; margin: 0px 0px 4px; padding: 0px 0px 0px 30px; background: url(&quot;../img/c-icq-ico.png&quot;) left top 3px no-repeat;\">web-obmen@exploit.im</div>\r\n\r\n<div class=\"jabber\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 22px; margin: 0px 0px 4px; padding: 0px 0px 0px 30px; background: url(&quot;../img/c-jabber-ico.png&quot;) left top 3px no-repeat;\">web-obmen.net@gmail.com</div>\r\n\r\n<div class=\"email\" style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 22px; margin: 0px 0px 4px; padding: 0px 0px 0px 30px; background: url(&quot;../img/c-mail-ico.png&quot;) left top 5px no-repeat;\">ICQ 641432</div>\r\n</div>\r\n\r\n<div class=\"c-title\" style=\"box-sizing: border-box; outline: none; font-weight: 600; color: rgb(0, 0, 0); font-size: 14px; line-height: 17px; text-transform: uppercase; font-family: &quot;Open Sans&quot;, sans-serif;\">ВЫ МОЖЕТЕ:</div>\r\n\r\n<div class=\"cans\" style=\"box-sizing: border-box; outline: none; margin: 10px 0px 37px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">\r\n<div style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">1.&nbsp;Позвонить и мы подтвердим операцию.</div>\r\n\r\n<div style=\"box-sizing: border-box; outline: none; font-size: 14px; line-height: 17px; margin: 0px 0px 10px;\">2.&nbsp;Направить произвольный набор цифр в виде смс на наш номер и мы озвучим его в переписке. Если все верно, то обмен производим.</div>\r\n</div>\r\n\r\n<div class=\"attention\" style=\"box-sizing: border-box; outline: none; color: rgb(30, 173, 87); font-weight: 600; font-size: 14px; line-height: 17px; margin: 0px 0px 36px; font-family: &quot;Open Sans&quot;, sans-serif; \">ВНИМАНИЕ! Мы не звоним и не отправляем клиентам смс для подтверждения операции. Будьте внимательны.</div>\r\n\r\n<div class=\"c-title\" style=\"box-sizing: border-box; outline: none; font-weight: 600; color: rgb(0, 0, 0); font-size: 14px; line-height: 17px; text-transform: uppercase; font-family: &quot;Open Sans&quot;, sans-serif;\">ГАРАНТИИ:</div>\r\n\r\n<div class=\"guards\" style=\"box-sizing: border-box; outline: none; margin: 10px 0px 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">\r\n<p>сертифицированный партнер платежной системы Perfect Money</p>\r\n\r\n<p>отзывы в теме на MMGP.ru:&nbsp;<span style=\"color:#006633\">http://mmgp.ru/showthread.php?t=65266</span></p>\r\n\r\n<p>отзывы в теме на <span style=\"color:rgb(0, 0, 0); font-family:open sans,sans-serif; font-size:16px\">forum.searchengines:</span>&nbsp;<span style=\"color:#006633\">http://forum.searchengines.ru/showthread.php?t=533268</span></p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n', 'kontakty');

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `referal`
--

CREATE TABLE `referal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `referal_id` int(11) DEFAULT NULL,
  `exchanges` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `referal`
--

INSERT INTO `referal` (`id`, `user_id`, `referal_id`, `exchanges`) VALUES
(1, 1, 37, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `referal_order`
--

CREATE TABLE `referal_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sum` decimal(19,4) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `referal_order`
--

INSERT INTO `referal_order` (`id`, `user_id`, `sum`, `currency_id`, `date`, `wallet`, `status`) VALUES
(1, 3, '0.0000', 3, '2016-12-20 11:25:28', '', 0),
(2, 3, '0.0000', 3, '2016-12-20 11:25:40', '', 0),
(3, 3, '0.0000', 3, '2016-12-20 11:50:56', 'dfsdf', 0),
(4, 3, '0.0000', 5, '2016-12-20 11:51:13', 'dfsdf', 4),
(5, 3, '0.0000', 3, '2016-12-20 11:51:15', '', 4),
(6, 3, '0.0000', 6, '2016-12-20 11:56:17', '2342434343', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `referal_statistic`
--

CREATE TABLE `referal_statistic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `incoming` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `referal_statistic`
--

INSERT INTO `referal_statistic` (`id`, `user_id`, `incoming`) VALUES
(1, 27, 12),
(2, 2147483647, 1),
(3, 2147483647, 1),
(4, 2147483647, 1),
(5, 2147483647, 1),
(6, 2147483647, 1),
(7, 2147483647, 1),
(8, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `slug`, `content`, `type`) VALUES
(1, 'how_it_works', '<p>С помощью нашего сервиса очень просто сделать обмен электронной валюты</p>\r\n\r\n<p>Мы готовы предоставить нашим клиентам сервис высокого уровня и оперативность в оказании услуг. Кроме 100 % гарантии сохранности получаемых нами средств, мы обеспечиваем круглосуточную поддержку своих клиентов и стараемся сделать процесс перевода и обмена проще, доступнее, понятнее.</p>\r\n\r\n<p>Мы предоставляем услуги на высоком уровне обслуживания. Это касается абсолютно всех сделок с виртуальными валютами, которые проходят через наш сервис.</p>\r\n\r\n<p>Наш сайт оборудован понятным интерфейсом, мы стараемся предложить своим клиентам максимально выгодные курсы обмена, а так же учитываем все пожелания и замечания.</p>\r\n\r\n<p>Вы можете получить у нас квалифицированную поддержку, если вам требуется:</p>\r\n\r\n<ul>\r\n	<li>совершить обмен между кошельками одной валюты;</li>\r\n	<li>обменять одну электронную валюту на другую;</li>\r\n	<li>перевести электронные деньги на карту любого из банков;</li>\r\n	<li>пополнить баланс кошелька с карты.</li>\r\n</ul>\r\n\r\n<p>Сотрудничая с нами, вы получаете не только уверенность в честности проводимой сделки, но и значительно экономите на совершении переводов.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1),
(2, 'mail_order_start', '<p>Ваша заявка принята в обработку:<br />\r\n<br />\r\n&lt;ORDERINFO&gt;<br />\r\n<br />\r\n&copy;&nbsp;&lt;SITEURL&gt;</p>\r\n', NULL),
(3, 'mail_register', '<p>Поздравляем! Вы зарегистрировались на сайте &lt;SITEURL&gt;. Данные для входа:<br />\r\n<br />\r\n&lt;CREDENTIALS&gt;<br />\r\n<br />\r\n&copy;&nbsp;&lt;SITEURL&gt;</p>\r\n', NULL),
(4, 'mail_order_status', '<p>Изменен статус заявки на &lt;ORDERSTATUS&gt;:<br />\r\n<br />\r\n&lt;ORDERINFO&gt;<br />\r\n<br />\r\n&copy;&nbsp;&lt;SITEURL&gt;</p>\r\n', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` text,
  `enabled` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `avatar`, `email`, `content`, `enabled`, `date`) VALUES
(8, 'Елена', '', 'love-pink@ukr.net', 'Меняла крупную сумму киви на ПМ. Обменяли быстро и по Очень хорошему курсу. Рекомендую)', 1, '2017-01-14'),
(12, 'Кирилл', 'undefined', 'stils1606@rambler.ru', 'Меня с вм на яд. Все очень быстро, рекомендую', 1, '2017-01-14'),
(13, 'Maxim', 'undefined', 'cryivanbtc@gmail.com', 'Меняю регулярно и в разных направлениях, все быстро и без проблем.', 1, '2017-01-16'),
(15, 'Кирилл', 'undefined', 'stils1606@rambler.ru', 'Тест', 1, '2017-01-16');

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `source`) VALUES
(1, 'dubztep45', 'dubztep45@gmail.com', '$2y$10$NOuSOyry8cuCVyxmq5kvPug9GGLcPF/Ax7fdMxnp63rLkIFQg3yRa', 'TZ-vwDIUCNoinbE8NlPkMlFTo0HMpo_q', 1481598706, NULL, NULL, '10.0.0.184', 1481598707, 1481598707, 0, 'source'),
(2, 'c_gv', 'c_gv@bk.ru', '$2y$10$.xfU56OaOudE77Zc74/es.evKMBwpbIgwkJ0/.2jFQ8OsxEevz8U.', '2DzyDuM9of9eg5sJ-TL10fA9MTu6DBT4', 1481624327, NULL, NULL, '10.0.0.184', 1481624327, 1481624327, 0, ''),
(3, 'test', 'test@test.com', '$2y$10$ef351RFf4TVaBksAyoechu8uQP1meGUYE7s73d40OC0D2L7Rmrzhe', '9K_pAFubFOqbedos-r5Bh0K2JzEorF8-', 1481624816, NULL, NULL, '10.0.0.184', 1481624816, 1481624816, 0, ''),
(5, 'the.acrux.studio', 'the.acrux.studio@gmail.com', '$2y$10$p/.Qyl0zKbfz6EdiO60f8.ZBSOxqxoYKUZ83y1YLtkCrunYE7me1G', 'YzlUuLo0T35JoxE3Pb6hG5bBK1WunPGA', 1481938829, NULL, NULL, '10.0.0.184', 1481938830, 1481938830, 0, '13312123'),
(25, 'slobodian04', 'slobodian04@mail.ru', '$2y$10$ZpgwMQSuB/LPyAP12/GT.eKoz8U/RyGtvtbu81XtpDO61KMkpNwoa', '5sMUSxh3qjOnR6VZw6J4brFghuI-gd8J', 1482116969, NULL, NULL, '10.0.0.184', 1482116969, 1482116969, 0, ''),
(26, 'yabot', 'yabot@ua.fm', '$2y$10$cd9ATYJRjNJ18SxwgmIk6Od/V9gDtuUMqV7RjFjZz9RnTQUNV0P7a', 'reJGK8_6XqaPwKFXYuNr4cEES6XUK5jo', 1482152743, NULL, NULL, '10.0.0.184', 1482152744, 1482152744, 0, NULL),
(27, 'stils1606', 'stils1606@yandex.ru', '$2y$10$nUXkXyM4M5.d6gWG0TNIv.Sn0qELud4nZ14PrTE04.R8TDu81pVaW', 'AWNYe3y1r9dR50lBj997F-eUJ0mMSP9C', 1482157345, NULL, NULL, '10.0.0.184', 1482157345, 1482157345, 0, ''),
(28, 'yabot2', 'yabot2@ua.fm', '$2y$10$6jUTIv/BoNKS0SBobolti.8aKrXKPhwR5ic4dg9E2/Xr3HxknlLYu', 'g1wKwr10MCP9pCkijj7nq35YQ3cbk-LA', 1482157537, NULL, NULL, '10.0.0.184', 1482157537, 1482157537, 0, 'интернет'),
(29, 'kjubrff45', 'kjubrff45@yandex.ru', '$2y$10$3tvDjyoH3l9PD9q7Jnwcvu07THyqhmXs1Vu.ujaPhqhJswPf6/km6', 's65-X1wgcvmOHnhQ5Hf02JgcCqZL7Hin', 1482228334, NULL, NULL, '10.0.0.184', 1482228335, 1482228335, 0, NULL),
(30, '123', '123@123.ru', '$2y$10$xlrZLATpDiTO71nwR8y0Xu37XR3N1Eeb/Wlr3XCwsUjbUu5L0tLfS', 'AKMo036CSjsTSZTatIRu5fOPB6Pa1QlB', 1482228352, NULL, NULL, '10.0.0.184', 1482228353, 1482228353, 0, NULL),
(31, 'snqzvdmbsyvc', 'snqzvdmbsyvc@gmail.com', '$2y$10$KhP.osHS9VPQzbFXENCe/eYNETGC8UKQZjBRKaMI0/TvGUd/IUvr6', 'NsCgZt4KkDvw5qRkbejZq3VvlSu5C7LO', 1482238137, NULL, NULL, '10.0.0.184', 1482238138, 1482238138, 0, NULL),
(32, 'rterytry', 'rterytry@yet.com', '$2y$10$go3Gb/wocU2NwF7.VGGk/e4AfTt/998hNjeO6kNFo8cyEMQrYADwm', 'SoJ7BapRiZWNxtyGUSn6XsfuW-3rge8d', 1482238542, NULL, NULL, '10.0.0.184', 1482238542, 1482238542, 0, NULL),
(33, 'kjurff100', 'kjurff100@yandex.ru', '$2y$10$9.lTLyzcB2Bxnd94Dm9K0ufcFdxqplOtdXdQGbqEDYxIM.8O2kBVu', 'dGVMjWECZldkLT2E9sPf4HgED_0SoTCX', 1482238673, NULL, NULL, '10.0.0.184', 1482238674, 1482238674, 0, 'inet'),
(35, 'kirill', 'kirill@wpartners.ru', '$2y$10$pMwgmLlT1eSoMSfE2k0XhunYzFuL25TACcKKrO3texzIZoqtaqkKa', 'YrTQRzcKZ1qquJSBzvTEUvGIyeyZ9g41', 1482260935, NULL, NULL, '10.0.0.184', 1482260935, 1482260935, 0, ''),
(36, 'webpartners123', 'webpartners123@gmail.com', '$2y$10$zK0K2LlxNXbrOXVjbFoEku0kEeJm2nYNLoIx5w5J8Z1UzMEJjDKPa', 'AlYlZaC6M2bfSSvk_iDbMHvoyil8aJJ1', 1482261279, NULL, NULL, '10.0.0.184', 1482261280, 1482261280, 0, NULL),
(37, 'someref', 'someref@some.com', '$2y$10$rGjKRCBCL32D3Hkh1/r2COlWilwP/y22Fw4tcvOXnXeDoN0.h/8.C', 'NMzuiON-5HXsPlerPRuBPWGqLDV-Zrxe', 1482389156, NULL, NULL, '10.0.0.184', 1482389157, 1482389157, 0, ''),
(38, 'aaaa', 'aaaa@sss.com', '$2y$10$3v7bK26fni4fteGBglBsaOH2qe5wDfP9zZKlxUVqFgAgcuESWpwiW', 'TItdjLceQswVQ8ED4Lf6PCgV4HBJAGtr', 1482757372, NULL, NULL, '10.0.0.184', 1482757372, 1482757372, 0, '23p'),
(39, 'kjubrff100', 'kjubrff100@yandex.ru', '$2y$10$XQUhB8W5DlPJ1nxU8nHn9eqrsx82W6mLTCvWSDSmDxK0e/AEYz/Ri', '0A2hcijMW9GY6Hf_zwfd6ukaEctZAbpq', 1482757409, NULL, NULL, '10.0.0.184', 1482757409, 1482757409, 0, '111'),
(40, 'love-pink', 'love-pink@ukr.net', '$2y$10$kA8hyRmirmMkqtmOchIkfenWPNFhbVGR3.8CXBGV.9Ie.XLgGAmnO', 'uE73w5Bex73TTLt2ZRxq4B0dqEVwMevJ', 1484130371, NULL, NULL, '10.0.0.184', 1484130371, 1484130371, 0, ''),
(41, 'lady-pink', 'lady-pink@ukr.net', '$2y$10$gV7NqjAo9wTsnv24x/u2UunahY0X1JAxBZPuh.j8SH9ezuEuw7AEm', '_QMNFvDV3Z3UFvZ7VElI17bMuLJol3KN', 1484421448, NULL, NULL, '10.0.0.184', 1484421449, 1484421449, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `currency_id`, `user_id`, `wallet`, `field_id`) VALUES
(1, 3, 3, 'dasdasdsad', 1),
(2, 3, 1, '132132132', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `course_parser`
--
ALTER TABLE `course_parser`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency_fields`
--
ALTER TABLE `currency_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exchange_direction`
--
ALTER TABLE `exchange_direction`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_fields`
--
ALTER TABLE `order_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `referal_order`
--
ALTER TABLE `referal_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `referal_statistic`
--
ALTER TABLE `referal_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Индексы таблицы `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_email` (`email`),
  ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- Индексы таблицы `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `course_parser`
--
ALTER TABLE `course_parser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `currency_fields`
--
ALTER TABLE `currency_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `exchange_direction`
--
ALTER TABLE `exchange_direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=948;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT для таблицы `order_fields`
--
ALTER TABLE `order_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `referal`
--
ALTER TABLE `referal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `referal_order`
--
ALTER TABLE `referal_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `referal_statistic`
--
ALTER TABLE `referal_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
