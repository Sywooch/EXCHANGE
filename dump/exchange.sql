-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 11 2016 г., 19:20
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 7.0.13

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
-- Структура таблицы `course_parser`
--

CREATE TABLE `course_parser` (
  `id` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `value` decimal(19,4) DEFAULT NULL,
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `course_parser`
--

INSERT INTO `course_parser` (`id`, `from`, `to`, `value`, `updated`) VALUES
(11, 'RUR', 'USD', '0.0158', '2016-12-11'),
(12, 'USD', 'RUR', '63.3028', '2016-12-11');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `reserve` decimal(15,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `title`, `icon`, `reserve`, `type`) VALUES
(3, 'Perfectmoney', '', '10000.00', 'USD'),
(4, 'PM E-voucher', '', '10000.00', ''),
(5, 'Bitcoin', '', '10000.00', ''),
(6, 'Яндекс.Деньги', '', '100000.00', 'RUR'),
(7, 'Qiwi', '', '100000.00', 'RUR'),
(8, 'Сбербанк', '', '100000.00', 'RUR'),
(9, 'Альфа-Банк', '', '100000.00', 'RUR'),
(10, 'Приватбанк', '', '50000.00', 'UAH'),
(11, 'Western Union', '', '10000.00', 'USD'),
(12, 'Contact', '', '100000.00', 'RUR'),
(13, 'Unistream', '', '100000.00', 'RUR'),
(17, 'BTC-e', '', '10000.00', 'USD');

-- --------------------------------------------------------

--
-- Структура таблицы `exchange_direction`
--

CREATE TABLE `exchange_direction` (
  `id` int(11) NOT NULL,
  `currency_from` int(11) DEFAULT NULL,
  `currency_to` int(11) DEFAULT NULL,
  `course` decimal(19,4) DEFAULT NULL,
  `exchange_percent` float DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `min_comission` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exchange_direction`
--

INSERT INTO `exchange_direction` (`id`, `currency_from`, `currency_to`, `course`, `exchange_percent`, `min`, `max`, `min_comission`, `enabled`) VALUES
(35, 3, 17, '1.0000', 1, 1, 1000, 1, 1),
(36, 3, 5, '1.0000', 1, 1, 1000, 1, 1),
(37, 3, 6, '63.3028', 1, 1, 1000, 1, 1),
(38, 3, 7, '63.3028', 1, 1, 1000, 1, 1),
(39, 3, 8, '63.3028', 1, 1, 1000, 1, 1),
(40, 3, 9, '63.3028', 1, 1, 1000, 1, 1),
(41, 3, 10, '1.0000', 1, 1, 1000, 1, 1),
(42, 3, 11, '1.0000', 1, 1, 1000, 1, 1),
(43, 3, 12, '63.3028', 1, 1, 1000, 1, 1),
(44, 3, 13, '63.3028', 1, 1, 1000, 1, 1),
(45, 4, 17, '1.0000', 1, 1, 100000, 1, 1),
(46, 4, 5, '1.0000', 1, 1, 100000, 1, 1),
(47, 4, 6, '1.0000', 1, 1, 100000, 1, 1),
(48, 4, 7, '1.0000', 1, 1, 100000, 1, 1),
(49, 4, 8, '1.0000', 1, 1, 100000, 1, 1),
(50, 4, 9, '1.0000', 1, 1, 100000, 1, 1),
(51, 4, 10, '1.0000', 1, 1, 100000, 1, 1),
(52, 4, 11, '1.0000', 1, 1, 100000, 1, 1),
(53, 4, 12, '1.0000', 1, 1, 100000, 1, 1),
(54, 4, 13, '1.0000', 1, 1, 100000, 1, 1),
(71, 17, 3, '1.0000', 1, 1, 100000, 1, 1),
(72, 17, 4, '1.0000', 1, 1, 100000, 1, 1),
(73, 17, 6, '63.3028', 1, 1, 100000, 1, 1),
(74, 17, 7, '63.3028', 1, 1, 100000, 1, 1),
(75, 17, 8, '63.3028', 1, 1, 100000, 1, 1),
(76, 17, 9, '63.3028', 1, 1, 100000, 1, 1),
(77, 17, 10, '1.0000', 1, 1, 100000, 1, 1),
(78, 17, 11, '1.0000', 1, 1, 100000, 1, 1),
(79, 17, 12, '63.3028', 1, 1, 100000, 1, 1),
(80, 17, 13, '63.3028', 1, 1, 100000, 1, 1),
(81, 5, 3, '1.0000', 1, 1, 100000, 1, 1),
(82, 5, 4, '1.0000', 1, 1, 100000, 1, 1),
(83, 5, 6, '1.0000', 1, 1, 100000, 1, 1),
(84, 5, 7, '1.0000', 1, 1, 100000, 1, 1),
(85, 5, 8, '1.0000', 1, 1, 100000, 1, 1),
(86, 5, 9, '1.0000', 1, 1, 100000, 1, 1),
(87, 5, 10, '1.0000', 1, 1, 100000, 1, 1),
(88, 5, 11, '1.0000', 1, 1, 100000, 1, 1),
(89, 5, 12, '1.0000', 1, 1, 100000, 1, 1),
(90, 5, 13, '1.0000', 1, 1, 100000, 1, 1),
(91, 6, 3, '0.0158', 1, 1, 100000, 1, 1),
(92, 6, 4, '1.0000', 1, 1, 100000, 1, 1),
(93, 6, 17, '0.0158', 1, 1, 100000, 1, 1),
(94, 6, 7, '1.0000', 1, 1, 100000, 1, 1),
(95, 6, 8, '1.0000', 1, 1, 100000, 1, 1),
(96, 6, 9, '1.0000', 1, 1, 100000, 1, 1),
(97, 6, 10, '1.0000', 1, 1, 100000, 1, 1),
(98, 6, 11, '0.0158', 1, 1, 100000, 1, 1),
(99, 6, 12, '1.0000', 1, 1, 100000, 1, 1),
(100, 6, 13, '1.0000', 1, 1, 100000, 1, 1),
(101, 7, 3, '0.0158', 1, 1, 100000, 1, 1),
(102, 7, 4, '1.0000', 1, 1, 100000, 1, 1),
(103, 7, 17, '0.0158', 1, 1, 100000, 1, 1),
(104, 7, 6, '1.0000', 1, 1, 100000, 1, 1),
(105, 7, 8, '1.0000', 1, 1, 100000, 1, 1),
(106, 7, 9, '1.0000', 1, 1, 100000, 1, 1),
(107, 7, 10, '1.0000', 1, 1, 100000, 1, 1),
(108, 7, 11, '0.0158', 1, 1, 100000, 1, 1),
(109, 7, 12, '1.0000', 1, 1, 100000, 1, 1),
(110, 7, 13, '1.0000', 1, 1, 100000, 1, 1),
(111, 8, 3, '0.0158', 1, 1, 100000, 1, 1),
(112, 8, 4, '1.0000', 1, 1, 100000, 1, 1),
(113, 8, 17, '0.0158', 1, 1, 100000, 1, 1),
(114, 8, 6, '1.0000', 1, 1, 100000, 1, 1),
(115, 8, 7, '1.0000', 1, 1, 100000, 1, 1),
(116, 8, 9, '1.0000', 1, 1, 100000, 1, 1),
(117, 8, 10, '1.0000', 1, 1, 100000, 1, 1),
(118, 9, 3, '0.0158', 1, 1, 100000, 1, 1),
(119, 9, 4, '1.0000', 1, 1, 100000, 1, 1),
(120, 9, 17, '0.0158', 1, 1, 100000, 1, 1),
(121, 9, 6, '1.0000', 1, 1, 100000, 1, 1),
(122, 9, 8, '1.0000', 1, 1, 100000, 1, 1),
(123, 9, 10, '1.0000', 1, 1, 100000, 1, 1),
(124, 10, 3, '1.0000', 1, 1, 100000, 1, 1),
(125, 10, 4, '1.0000', 1, 1, 100000, 1, 1),
(126, 10, 17, '1.0000', 1, 1, 100000, 1, 1),
(127, 10, 6, '1.0000', 1, 1, 100000, 1, 1),
(128, 10, 7, '1.0000', 1, 1, 100000, 1, 1),
(129, 10, 9, '1.0000', 1, 1, 100000, 1, 1),
(136, 11, 3, '1.0000', 1, 1, 100000, 1, 1),
(137, 11, 4, '1.0000', 1, 1, 100000, 1, 1),
(138, 11, 17, '1.0000', 1, 1, 100000, 1, 1),
(139, 11, 6, '63.3028', 1, 1, 100000, 1, 1),
(140, 11, 7, '63.3028', 1, 1, 100000, 1, 1),
(141, 11, 9, '63.3028', 1, 1, 100000, 1, 1);

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
(18, 'Testimonials/Testimonial7/31e6cb.jpg', 7, 1, 'Testimonial', '3357732fa8-1', '');

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
('m140622_111540_create_image_table', 1481075820),
('m140622_111545_add_name_to_image_table', 1481075821),
('m161207_014851_create_currency_table', 1481075477),
('m161207_034239_create_exchange_direction_table', 1481082220),
('m161208_061312_create_course_parser_table', 1481177601),
('m161208_133012_create_order_table', 1481203952),
('m161211_173042_add_ip_column_to_order_table', 1481477451),
('m161211_180525_create_settings_table', 1481479533),
('m161211_182120_create_testimonial_table', 1481480714),
('m161211_190904_add_date_column_to_testimonial_table', 1481483500);

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
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `exchange_id`, `from_value`, `to_value`, `card`, `bank`, `fio`, `wallet`, `email`, `date`, `status`, `ip`) VALUES
(1, 38, '100.0000', '6339.0000', '1111323287220912', 'Bank Bank', 'Fio Fio Fio', '0009283912347584', 'dubztep45@gmail.com', '2016-12-08 14:12:10', 1, '46.63.24.252'),
(2, 98, '500.0000', '7.9000', '1212343534203', 'bank babk', 'FIO', '1208941319287398173', 'slobodian04@mail.ru', '2016-12-11 18:12:55', 1, '46.63.24.252'),
(3, 98, '500.0000', '7.9000', '1212343534203', 'bank babk', 'FIO', '1208941319287398173', 'slobodian04@mail.ru', '2016-12-11 18:12:56', 1, '46.63.24.252');

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
(1, 'how_it_works', '\\r\\n                <p>Электронные валюты прочно заняли свое место в современном мире. С их появлением жизнь человека стала значительно проще. Оплачивать практически все услуги и покупки теперь вы можете в электронном виде. Это избавит вас от необходимости выходить из дома, обналичивать средства, стоять в очереди в банке. К сожалению, не все сайты сумели быстро сориентироваться на появление большого количества разных электронных валют, которыми расплачиваются современные пользователи интернет сети.</p>\\r\\n                <p>Если еще несколько лет назад выгодный обмен виртуальной электронной валюты был настоящей проблемой, то сегодня сделать это очень просто с помощью нашего сервиса. </p>\\r\\n                <p>Мы готовы предоставить нашим клиентам сервис высокого уровня и оперативность в оказании услуг. Кроме 100 % гарантии сохранности получаемых нами средств, мы обеспечиваем круглосуточную поддержку своих клиентов и стараемся сделать процесс перевода и обмена проще, доступнее, понятнее.</p>\\r\\n                <p>Мы стремимся к постоянному росту и предоставляем услуги на высоком уровне обслуживания. Это касается абсолютно всех сделок с виртуальными валютами, которые проходят через наш сервис.</p>\\r\\n                <p>Наш сайт оборудован понятным интерфейсом, мы стараемся предложить своим клиентам максимально выгодные курсы обмена, а так же учитываем все пожелания и замечания.</p>\\r\\n\\r\\n                <p class=\"m-top\">Вы можете получить у нас квалифицированную поддержку, если вам требуется:</p>\\r\\n                <ul>\\r\\n                    <li>совершить обмен между кошельками одной валюты;</li>\\r\\n                    <li>обменять одну электронную валюту на другую;</li>\\r\\n                    <li>перевести электронные деньги на карту любого из банков;</li>\\r\\n                    <li>пополнить баланс кошелька с карты.</li>\\r\\n                </ul>\\r\\n\\r\\n                <p>Сотрудничая с нами, вы получаете не только уверенность в честности проводимой сделки, но и значительно экономите на совершении переводов.</p>\\r\\n                <p>С нашей компанией выгодный обмен электронных валют стал возможен, мы предлагаем нашим клиентам прозрачное сотрудничество без скрытых процентов и дополнительных оплат за обслуживание.</p>\\r\\n                <p>Электронные валюты прочно заняли свое место в современном мире. С их появлением жизнь человека стала значительно проще. Оплачивать практически все услуги и покупки теперь вы можете в электронном виде. Это избавит вас от необходимости выходить из дома, обналичивать средства, стоять в очереди в банке. К сожалению, не все сайты сумели быстро сориентироваться на появление большого количества разных электронных валют, которыми расплачиваются современные пользователи интернет сети.</p>\\r\\n                <p>Если еще несколько лет назад выгодный обмен виртуальной электронной валюты был настоящей проблемой, то сегодня сделать это очень просто с помощью нашего сервиса. </p>\\r\\n                <p>Мы готовы предоставить нашим клиентам сервис высокого уровня и оперативность в оказании услуг. Кроме 100 % гарантии сохранности получаемых нами средств, мы обеспечиваем круглосуточную поддержку своих клиентов и стараемся сделать процесс перевода и обмена проще, доступнее, понятнее.</p>\\r\\n                <p>Мы стремимся к постоянному росту и предоставляем услуги на высоком уровне обслуживания. Это касается абсолютно всех сделок с виртуальными валютами, которые проходят через наш сервис.</p>\\r\\n                <p>Наш сайт оборудован понятным интерфейсом, мы стараемся предложить своим клиентам максимально выгодные курсы обмена, а так же учитываем все пожелания и замечания.</p>\\r\\n\\r\\n                <p class=\"m-top\">Вы можете получить у нас квалифицированную поддержку, если вам требуется:</p>\\r\\n                <ul>\\r\\n                    <li>совершить обмен между кошельками одной валюты;</li>\\r\\n                    <li>обменять одну электронную валюту на другую;</li>\\r\\n                    <li>перевести электронные деньги на карту любого из банков;</li>\\r\\n                    <li>пополнить баланс кошелька с карты.</li>\\r\\n                </ul>\\r\\n\\r\\n                <p>Сотрудничая с нами, вы получаете не только уверенность в честности проводимой сделки, но и значительно экономите на совершении переводов.</p>\\r\\n                <p>С нашей компанией выгодный обмен электронных валют стал возможен, мы предлагаем нашим клиентам прозрачное сотрудничество без скрытых процентов и дополнительных оплат за обслуживание.</p>', 1);

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
(4, 'roma', '', 'slobodian04@mail.ru', 'ed[pwpeokwd', 1, '2016-11-12'),
(5, 'Some Name', '', 'slobodian04@mail.ru', 'Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text ', 1, '2016-11-12'),
(6, 'TEst name', '', 'slobodian04@mail.ru', 'testimonial testimonial testimonial testimonial testimonial ', 1, '2016-11-12'),
(7, 'TEst name', '', 'test@email.com', 'test test test test test test test test test test test test ', 1, '2016-11-12');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `course_parser`
--
ALTER TABLE `course_parser`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
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
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `testimonial`
--
ALTER TABLE `testimonial`
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
-- AUTO_INCREMENT для таблицы `course_parser`
--
ALTER TABLE `course_parser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `exchange_direction`
--
ALTER TABLE `exchange_direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
