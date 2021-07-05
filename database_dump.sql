-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 05 2021 г., 14:47
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `asudb_new`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(64) COLLATE cp1251_bin NOT NULL,
  `email` text COLLATE cp1251_bin DEFAULT NULL,
  `password` text COLLATE cp1251_bin NOT NULL,
  `token` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `email`, `password`, `token`) VALUES
(1, 'admin', 'muffinnorth@yandex.ru', '$2y$10$RQTNCljxNnUm.uySqX6hV.dQg7Pn4z0kHoUe.AUWnmYrhX33Nq7BG', 365962);

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL,
  `name` text COLLATE cp1251_bin NOT NULL,
  `group` text COLLATE cp1251_bin NOT NULL,
  `review` longtext COLLATE cp1251_bin DEFAULT NULL,
  `city` text COLLATE cp1251_bin NOT NULL,
  `workplace` text COLLATE cp1251_bin DEFAULT NULL,
  `email` text COLLATE cp1251_bin NOT NULL,
  `avatar_path` text COLLATE cp1251_bin NOT NULL,
  `from` int(11) NOT NULL,
  `moderation_type` int(11) NOT NULL,
  `favorites` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `ID` bigint(20) NOT NULL,
  `who` int(11) NOT NULL,
  `when` datetime NOT NULL,
  `what` varchar(255) COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `property` varchar(30) COLLATE cp1251_bin NOT NULL,
  `value` text COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_bin;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`property`, `value`) VALUES
('acceptMessage', 'Спасибо %name%! Ваш отзыв принят! '),
('adminMail', 'muffinnorth@ya.ru'),
('denyMessage', 'Извините %name%! Ваш отзыв отклонен! '),
('feedbackMessageTitle', 'Статус вашего отзыва'),
('footerMessage', '--------------\nАСУ-50 '),
('openToFeeds', 'true');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginUnique` (`login`);

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `login` (`who`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`property`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `login` FOREIGN KEY (`who`) REFERENCES `admins` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
