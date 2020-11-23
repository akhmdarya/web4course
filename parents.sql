-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 27 2020 г., 14:42
-- Версия сервера: 10.1.32-MariaDB
-- Версия PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `parents`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buy`
--

CREATE TABLE `buy` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) CHARACTER SET latin1 NOT NULL,
  `IMAGE` varchar(255) CHARACTER SET latin1 NOT NULL,
  `PRICE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `buy`
--

INSERT INTO `buy` (`ID`, `NAME`, `IMAGE`, `PRICE`) VALUES
(1, 'GoPro Hero 7', '4cam.png', 100),
(3, 'GoPro Hero 8', '3cam.png', 200),
(4, 'GoPro Hero MAX', '2cam.png', 300),
(5, 'GoPro Hero 7 black', '1cam.png', 350);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `com_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`com_id`, `com_user`, `com_text`, `com_date`, `com_post_id`) VALUES
(78, '55', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2020-04-27 03:04:01', 63),
(79, '55', '63333333', '2020-04-27 03:04:19', 0),
(80, '55', 'Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶Ð¶', '2020-04-27 03:07:38', 63);

-- --------------------------------------------------------

--
-- Структура таблицы `parents`
--

CREATE TABLE `parents` (
  `parents_login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `parents_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `parents_id` int(11) NOT NULL,
  `parents_fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parents_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parents_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `parents`
--

INSERT INTO `parents` (`parents_login`, `parents_password`, `parents_id`, `parents_fullname`, `parents_mail`, `parents_img`) VALUES
('test@test.com', '123', 36, '', '', '1user.png'),
('admin4', 'qwerty', 54, '', 'admin@mail.ru1', 'c72b0f56e7f81feb75e00cf6fc803a5882874a8f'),
('Roma', '123', 55, '', 'admin@mail.ru333', '0B4A1904.jpg'),
('Ð³', 'Ðµ', 56, '', '', '1user.png'),
('iii', 'j', 57, '', '', '1user.png'),
('user2', 'likelike', 58, '', '', '1user.png'),
('user3', 'likelike', 60, '', '', '1user.png'),
('user4', 'likelike', 61, '', '', '1user.png'),
('esss', '12345678', 62, '', '', '1user.png'),
('iii', '77777777', 63, '', '', '1user.png'),
('user5', '12345678', 64, '', '', '1user.png'),
('u2', '123', 65, '', '', '1user.png'),
('22', '222', 66, '', '', '1user.png'),
('tww', 'tww', 67, '', '', '1user.png'),
('Roma', '123', 68, '', '', '1user.png'),
('Roma', '12345678', 69, '', '', '1user.png'),
('rrrrrrr', '11111111', 70, '', '', '1user.png'),
('rrrrrrr', '11111111', 71, '', '', '1user.png'),
('Roma', '12345678', 72, '', '', '1user.png'),
('111', 'rrr', 73, '', '', '1user.png'),
('111111', '111', 78, '', '', '1user.png'),
('admin8', 'qwerty', 79, '', '', '1user.png'),
('eeeee', 'eeee', 80, '', '', '1user.png'),
('uuuuu', '12345678', 81, '', '', '1user.png'),
('qqqqq111', '111', 82, '', '', '1user.png'),
('yyyyyy', 'yyy', 83, '', '', '1user.png');

-- --------------------------------------------------------

--
-- Структура таблицы `teams_task`
--

CREATE TABLE `teams_task` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `teams_task`
--

INSERT INTO `teams_task` (`team_id`, `team_name`, `team_country`, `team_city`) VALUES
(1, 'Madrid', 'Spain', 'Madrid'),
(3, 'Espanyol', 'Spainnnn', 'Barcelonaa'),
(20, 'aaa', 'cccc', 'bbb'),
(21, '', 'Spain', ''),
(22, '', 'Spainnnnnn', 'bbb'),
(26, 'TEAM1', 'KZ', 'KOKSHETAY'),
(28, '', 'Spain', 'Madrid');

-- --------------------------------------------------------

--
-- Структура таблицы `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `tweet` text COLLATE utf8_unicode_ci NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `link` varchar(9000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tweets`
--

INSERT INTO `tweets` (`id`, `user_id`, `title`, `tweet`, `post_date`, `link`) VALUES
(1, 36, 'title1', 'Drag and drop is a simple way to allow users to upload their files by dropping to the container. Nowadays most websites allow uploading using both drag and drop and the file browse e.g. PushBullet, Facebook, SlideShare, etc.  I am using AJAX to save the file to the server which triggers when the file dropped on the target container.', '2020-03-08 17:33:27', 'https://www.w3schools.com/html/html5_draganddrop.asp'),
(62, 55, 'aqaaaaaaf', 'aaaaaaaaaaaaa', '2020-04-24 13:02:35', ''),
(63, 55, 'zccccccc', 'cccccccccc', '2020-04-24 15:13:03', ''),
(64, 55, 'title2', 'tototot', '2020-04-24 18:22:27', ''),
(65, 55, 'ÐºÑ‰ÐºÑ‰ÐºÑ‰ÐºÑ‰', 'Ð²Ñ‹Ñ„Ð°Ñ‹Ð¿Ð²Ñ€Ð°Ñ€Ð¾ÑŒÑ‚', '2020-04-26 14:39:35', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Индексы таблицы `parents`
--
ALTER TABLE `parents`
  ADD UNIQUE KEY `parents_id` (`parents_id`);

--
-- Индексы таблицы `teams_task`
--
ALTER TABLE `teams_task`
  ADD PRIMARY KEY (`team_id`);

--
-- Индексы таблицы `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buy`
--
ALTER TABLE `buy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `parents`
--
ALTER TABLE `parents`
  MODIFY `parents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT для таблицы `teams_task`
--
ALTER TABLE `teams_task`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `parents` (`parents_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
