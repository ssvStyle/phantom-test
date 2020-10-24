-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 24 2020 г., 19:35
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phantom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `model_id` bigint(20) NOT NULL,
  `number` varchar(20) NOT NULL,
  `credit` double NOT NULL,
  `status_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `brand_id`, `model_id`, `number`, `credit`, `status_id`) VALUES
(1, 1, 4, 'BH4590BM', 0.27, 1),
(2, 2, 6, 'KL3901BK', 0, 1),
(3, 5, 21, 'KЕ2243ГВ', 0, 1),
(4, 7, 33, 'KO2436MK', 0, 3),
(5, 8, 42, 'HB0811LK', 0.28, 4),
(6, 1, 5, 'BL7990GM', 0.52, 3),
(7, 3, 13, 'LG5602KN', 0, 3),
(8, 1, 3, 'TY2023UX', 1500.2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `car_brands`
--

CREATE TABLE `car_brands` (
  `id` bigint(20) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `car_brands`
--

INSERT INTO `car_brands` (`id`, `brand_name`) VALUES
(1, 'Mitsubishi'),
(2, 'Toyota'),
(3, 'Lexus'),
(4, 'Acura'),
(5, 'Honda'),
(6, 'Isuzu'),
(7, 'Nissan'),
(8, 'Mazda');

-- --------------------------------------------------------

--
-- Структура таблицы `groop_settings`
--

CREATE TABLE `groop_settings` (
  `id` int(11) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `setting_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groop_settings`
--

INSERT INTO `groop_settings` (`id`, `group_id`, `setting_id`) VALUES
(75, 3, 1),
(76, 3, 2),
(77, 3, 3),
(182, 2, 1),
(183, 2, 2),
(184, 2, 3),
(185, 2, 4),
(186, 2, 5),
(196, 4, 3),
(197, 4, 4),
(198, 4, 5),
(210, 1, 1),
(211, 1, 2),
(212, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` bigint(20) NOT NULL,
  `group_name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `group_name`) VALUES
(1, 'users'),
(2, 'admin'),
(3, 'boss'),
(4, 'client'),
(5, 'BlackList');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `login_who_edited` varchar(255) NOT NULL,
  `header` mediumtext NOT NULL,
  `message` mediumtext NOT NULL,
  `status_from_settings` bigint(20) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `login_who_edited`, `header`, `message`, `status_from_settings`, `created_at`) VALUES
(294, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"Резерв\" на \"В работе\".', 3, 1603460381),
(295, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"Угон\" на \"Резерв\".', 2, 1603460384),
(296, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"В работе\" на \"На выдачу\".', 1, 1603462122),
(297, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"На выдачу\".', 1, 1603462382),
(298, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"На выдачу\" на \"Резерв\".', 2, 1603462406),
(299, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"Резерв\" на \"В работе\".', 3, 1603462500),
(300, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"На выдачу\".', 1, 1603462658),
(301, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"На выдачу\" на \"В работе\".', 3, 1603463114),
(302, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"На выдачу\" на \"Ремонт\".', 4, 1603463227),
(303, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"На выдачу\".', 1, 1603463271),
(304, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"На выдачу\" на \"Резерв\".', 2, 1603463284),
(305, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"Резерв\" на \"Угон\".', 5, 1603463306),
(306, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"Угон\" на \"В работе\".', 3, 1603465073),
(307, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"На выдачу\".', 1, 1603465097),
(308, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"На выдачу\" на \"В работе\".', 3, 1603465110),
(309, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"Ремонт\" на \"Резерв\".', 2, 1603469027),
(310, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"Резерв\" на \"На выдачу\".', 1, 1603469558),
(311, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"На выдачу\" на \"В работе\".', 3, 1603469753),
(312, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"Резерв\" на \"На выдачу\".', 1, 1603471112),
(313, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"Ремонт\".', 4, 1603471137),
(314, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KO2436MK c \"В работе\" на \"Резерв\".', 2, 1603471152),
(315, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"Резерв\" на \"Ремонт\".', 4, 1603471169),
(316, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"На выдачу\" на \"Угон\".', 5, 1603471220),
(317, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KO2436MK c \"Резерв\" на \"Ремонт\".', 4, 1603471364),
(318, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KO2436MK c \"Ремонт\" на \"В работе\".', 3, 1603471375),
(319, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"Угон\" на \"В работе\".', 3, 1603471401),
(320, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"В работе\" на \"Ремонт\".', 4, 1603471423),
(321, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"Ремонт\" на \"В работе\".', 3, 1603471464),
(322, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером BL7990GM c \"Резерв\" на \"В работе\".', 3, 1603471487),
(323, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером TY2023UX c \"На выдачу\" на \"В работе\".', 3, 1603471494),
(324, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером LG5602KN c \"Резерв\" на \"В работе\".', 3, 1603471509),
(325, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"Ремонт\" на \"В работе\".', 3, 1603471534),
(326, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"Ремонт\" на \"В работе\".', 3, 1603471573),
(327, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"В работе\" на \"Резерв\".', 2, 1603472815),
(328, 'Serj', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"Резерв\" на \"В работе\".', 3, 1603472832),
(329, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"В работе\" на \"На выдачу\".', 1, 1603475752),
(330, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"На выдачу\" на \"Резерв\".', 2, 1603479988),
(331, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"В работе\" на \"Угон\".', 5, 1603480002),
(332, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"Резерв\" на \"На выдачу\".', 1, 1603480008),
(333, 'ssv', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"На выдачу\".', 1, 1603482988),
(334, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"На выдачу\" на \"В работе\".', 3, 1603483056),
(335, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"В работе\" на \"Ремонт\".', 4, 1603483986),
(336, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"На выдачу\".', 1, 1603485455),
(337, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"На выдачу\" на \"В работе\".', 3, 1603485524),
(338, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"В работе\" на \"Резерв\".', 2, 1603501891),
(339, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером BH4590BM c \"Резерв\" на \"На выдачу\".', 1, 1603502000),
(340, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером KL3901BK c \"Ремонт\" на \"На выдачу\".', 1, 1603502039),
(341, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"На выдачу\" на \"В работе\".', 3, 1603502059),
(342, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером HB0811LK c \"Угон\" на \"Ремонт\".', 4, 1603502104),
(343, 'admin2', 'Изменение статуса', 'Изменился статус у авто с номером KЕ2243ГВ c \"В работе\" на \"На выдачу\".', 1, 1603502113);

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE `models` (
  `id` bigint(20) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `brands_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`id`, `model_name`, `brands_id`) VALUES
(1, 'Colt', 1),
(2, 'Lancer', 1),
(3, 'ASX', 1),
(4, 'Galant', 1),
(5, 'Outlander', 1),
(6, 'Aygo', 2),
(7, 'Yaris', 2),
(8, 'Etios', 2),
(9, 'Auris', 2),
(10, 'Corolla', 2),
(11, 'Avensis', 2),
(12, 'UX', 3),
(13, 'NX', 3),
(14, 'RX', 3),
(15, 'GX', 3),
(16, 'MDX', 4),
(17, 'NSX', 4),
(18, 'TLX', 4),
(19, 'Jazz', 5),
(20, 'Civic', 5),
(21, 'Accord', 5),
(22, 'Legend', 5),
(23, 'NSX', 5),
(24, 'S2000', 5),
(25, 'CR-V', 5),
(26, 'D-Max', 6),
(27, 'MU-X', 6),
(28, 'Ascender', 6),
(29, 'Micra', 7),
(30, 'Tiida', 7),
(31, 'Note', 7),
(32, 'Almera', 7),
(33, 'Leaf', 7),
(34, 'Teana', 7),
(35, 'Qashqai', 7),
(36, 'Juke', 7),
(37, 'Terrano', 7),
(38, 'CX-7', 8),
(39, 'MX-5', 8),
(40, '5', 8),
(41, '6', 8),
(42, 'RX-8', 8),
(43, '2', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `msg_for_users`
--

CREATE TABLE `msg_for_users` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `msg_status` varchar(255) NOT NULL,
  `message_id` bigint(20) NOT NULL,
  `is_read` int(11) DEFAULT '0',
  `time_to_timeout_to_send` bigint(20) DEFAULT NULL,
  `is_send_email` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `msg_for_users`
--

INSERT INTO `msg_for_users` (`id`, `user_id`, `msg_status`, `message_id`, `is_read`, `time_to_timeout_to_send`, `is_send_email`) VALUES
(556, 1, 'send', 294, 1, 1603460981, 0),
(557, 5, 'new', 294, 0, 1603460981, 0),
(558, 1, 'send', 295, 1, 1603460984, 0),
(559, 3, 'new', 295, 0, 1603460984, 0),
(560, 4, 'new', 295, 0, 1603460984, 0),
(561, 1, 'send', 296, 1, 1603462722, 0),
(562, 1, 'send', 297, 1, 1603462982, 0),
(563, 1, 'send', 298, 1, 1603463006, 0),
(564, 3, 'new', 298, 0, 1603463006, 0),
(565, 4, 'new', 298, 0, 1603463006, 0),
(566, 1, 'send', 299, 1, 1603463100, 0),
(567, 5, 'new', 299, 0, 1603463100, 0),
(568, 1, 'send', 300, 1, 1603463258, 0),
(569, 1, 'send', 301, 1, 1603463714, 0),
(570, 5, 'new', 301, 0, 1603463714, 0),
(571, 1, 'send', 302, 1, 1603463828, 0),
(572, 3, 'new', 302, 0, 1603463828, 0),
(573, 4, 'new', 302, 0, 1603463828, 0),
(574, 1, 'send', 303, 1, 1603463871, 0),
(575, 1, 'send', 304, 1, 1603463884, 0),
(576, 3, 'new', 304, 0, 1603463884, 0),
(577, 4, 'new', 304, 0, 1603463884, 0),
(578, 1, 'send', 305, 1, 1603463906, 0),
(579, 5, 'new', 305, 0, 1603463906, 0),
(580, 1, 'send', 306, 1, 1603465673, 0),
(581, 1, 'send', 307, 1, 1603465697, 0),
(582, 1, 'send', 308, 1, 1603465710, 0),
(583, 1, 'send', 309, 1, 1603469627, 0),
(584, 3, 'new', 309, 0, 1603469627, 0),
(585, 4, 'new', 309, 0, 1603469627, 0),
(586, 1, 'send', 310, 1, 1603470159, 0),
(587, 1, 'send', 311, 1, 1603470354, 0),
(588, 3, 'new', 313, 0, 1603471737, 0),
(589, 4, 'new', 313, 0, 1603471737, 0),
(590, 5, 'new', 313, 0, 1603471737, 0),
(591, 3, 'new', 314, 0, 1603471752, 0),
(592, 4, 'new', 314, 0, 1603471752, 0),
(593, 3, 'new', 315, 0, 1603471769, 0),
(594, 4, 'new', 315, 0, 1603471769, 0),
(595, 5, 'new', 315, 0, 1603471769, 0),
(596, 2, 'send', 316, 1, 1603471820, 0),
(597, 3, 'new', 317, 0, 1603471964, 0),
(598, 4, 'new', 317, 0, 1603471964, 0),
(599, 5, 'new', 317, 0, 1603471964, 0),
(600, 2, 'send', 318, 1, 1603471975, 0),
(601, 2, 'send', 319, 1, 1603472001, 0),
(602, 1, 'send', 320, 1, 1603472023, 0),
(603, 3, 'new', 320, 0, 1603472023, 0),
(604, 4, 'new', 320, 0, 1603472023, 0),
(605, 5, 'new', 320, 0, 1603472023, 0),
(606, 2, 'send', 321, 1, 1603472064, 0),
(607, 2, 'send', 322, 1, 1603472087, 0),
(608, 2, 'send', 323, 1, 1603472094, 0),
(609, 2, 'send', 324, 1, 1603472109, 0),
(610, 2, 'send', 325, 1, 1603472134, 0),
(611, 2, 'send', 326, 1, 1603472173, 0),
(612, 3, 'new', 327, 0, 1603473415, 0),
(613, 4, 'new', 327, 0, 1603473415, 0),
(614, 2, 'send', 328, 1, 1603473432, 0),
(615, 1, 'send', 329, 1, 1603476352, 0),
(616, 1, 'send', 330, 1, 1603480588, 0),
(617, 3, 'new', 330, 0, 1603480588, 0),
(618, 4, 'new', 330, 0, 1603480588, 0),
(619, 1, 'send', 331, 1, 1603480602, 0),
(620, 1, 'send', 332, 1, 1603480608, 0),
(621, 1, 'send', 333, 1, 1603483588, 0),
(622, 1, 'send', 334, 1, 1603483656, 0),
(623, 1, 'send', 335, 1, 1603484586, 0),
(624, 2, 'new', 335, 0, 1603484587, 0),
(625, 3, 'new', 335, 0, 1603484587, 0),
(626, 4, 'new', 335, 0, 1603484587, 0),
(627, 5, 'new', 335, 0, 1603484587, 0),
(628, 1, 'send', 336, 1, 1603486055, 0),
(629, 1, 'send', 337, 1, 1603486124, 0),
(630, 1, 'send', 338, 0, 1603502491, 0),
(631, 4, 'new', 338, 0, 1603502491, 0),
(632, 1, 'send', 340, 1, 1603502639, 0),
(633, 2, 'new', 342, 0, 1603502704, 0),
(634, 5, 'new', 342, 0, 1603502704, 0),
(635, 1, 'send', 343, 0, 1603502713, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `msg_status`
--

CREATE TABLE `msg_status` (
  `id` bigint(20) NOT NULL,
  `status_name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) NOT NULL,
  `name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'На выдачу'),
(2, 'Резерв'),
(3, 'В работе'),
(4, 'Ремонт'),
(5, 'Угон');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `login` varchar(255) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `email` mediumtext NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `group_id` bigint(20) NOT NULL,
  `session_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `psw`, `email`, `created_at`, `updated_at`, `group_id`, `session_token`) VALUES
(1, 'Serj', '$2y$10$G0Io2BQjpYFD.8.M39RzSOOqcEEiKTiYYnRiVgG0KVgB.M73BLqM.', 'test@gmail.com', 1602929044, 1603463361, 3, '28c3b6416fee7773b9a6baec202c6be1e6e3e1e9'),
(2, 'ssv', '$2y$10$YLP6VuuxbbboQciCz.9OrOGRMPXXSFmqADOACNCoSKEvdFVYM202a', 'ssv.style@gmail.com', 1603275034, 1603482956, 1, ''),
(3, 'ssv2324', '$2y$10$zdbnQlo89KtqBTDdVuCQselbwIpNx4U9gBscNg/Udq0v2YPxO8MDu', 'ssv.style@gmail.com', 1603275054, 1603382958, 4, ''),
(4, 'ssv2', '$2y$10$se/aVc.XkwaazY2JepQUPeBra52qbTW1A25RWTMfhQbArO3M6C1bS', 'ssv.style@gmail.com', 1603380111, 0, 4, ''),
(5, 'ssv3', '$2y$10$c0e0fQiDreMDMrsYYdgKmu3Tc4U4JvP2.OHLpdlvcPvgZTxXc6jZO', 'dsfsad@sdfs.waqssda', 1603380124, 1603463370, 1, ''),
(6, 'admin2', '$2y$10$0qYD/2pYlfvXb4EbjyXg8umG5WaHq8QlnUelUKunTG469K6oGPAeG', 'test@gmail.com', 1603482944, 0, 1, '0e808935ea77878a486a9e5dc92d00bb72bbf254');

-- --------------------------------------------------------

--
-- Структура таблицы `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `setting_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `setting_id`) VALUES
(84, 4, 2),
(167, 1, 2),
(168, 1, 5),
(179, 2, 1),
(180, 2, 2),
(181, 2, 3),
(182, 2, 5),
(186, 6, 2),
(187, 6, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groop_settings`
--
ALTER TABLE `groop_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `setting_id` (`setting_id`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_from_settings` (`status_from_settings`);

--
-- Индексы таблицы `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_id` (`brands_id`);

--
-- Индексы таблицы `msg_for_users`
--
ALTER TABLE `msg_for_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `message_id` (`message_id`);

--
-- Индексы таблицы `msg_status`
--
ALTER TABLE `msg_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Индексы таблицы `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `setting_id` (`setting_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `groop_settings`
--
ALTER TABLE `groop_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `msg_for_users`
--
ALTER TABLE `msg_for_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=636;

--
-- AUTO_INCREMENT для таблицы `msg_status`
--
ALTER TABLE `msg_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`id`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`),
  ADD CONSTRAINT `cars_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `groop_settings`
--
ALTER TABLE `groop_settings`
  ADD CONSTRAINT `groop_settings_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `groop_settings_ibfk_2` FOREIGN KEY (`setting_id`) REFERENCES `statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`status_from_settings`) REFERENCES `statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`brands_id`) REFERENCES `car_brands` (`id`);

--
-- Ограничения внешнего ключа таблицы `msg_for_users`
--
ALTER TABLE `msg_for_users`
  ADD CONSTRAINT `msg_for_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `msg_for_users_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_settings_ibfk_2` FOREIGN KEY (`setting_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
