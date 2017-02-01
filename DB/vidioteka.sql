-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Лют 01 2017 р., 23:13
-- Версія сервера: 10.0.17-MariaDB
-- Версія PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `vidioteka`
--

-- --------------------------------------------------------

--
-- Структура таблиці `address`
--

CREATE TABLE `address` (
  `id` int(6) NOT NULL,
  `id_countries` int(6) NOT NULL,
  `id_town` int(6) NOT NULL,
  `street` varchar(100) NOT NULL,
  `_index` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `address`
--

INSERT INTO `address` (`id`, `id_countries`, `id_town`, `street`, `_index`) VALUES
(1, 2, 1, '2', 6050),
(2, 2, 1, '1', 60503),
(3, 1, 2, '2', 6058),
(4, 13, 4, '4', 50423),
(5, 2, 4, '2', 58526),
(6, 1, 1, 'Ukraine Chernivtsi region Gertsaevsky pH. SL. Hryatska ow. Central 381', 60503),
(7, 1, 1, 'центральна 43', 65208),
(8, 1, 1, 'region Gert', 5632);

-- --------------------------------------------------------

--
-- Структура таблиці `countries`
--

CREATE TABLE `countries` (
  `id` int(6) NOT NULL,
  `countries` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `countries`
--

INSERT INTO `countries` (`id`, `countries`) VALUES
(1, 'Україна'),
(2, 'США'),
(3, '$cont'),
(4, 'Канада'),
(5, 'Росія'),
(10, 'Німечина'),
(11, '1'),
(12, '1'),
(13, 'Румунія');

-- --------------------------------------------------------

--
-- Структура таблиці `directors`
--

CREATE TABLE `directors` (
  `id` int(6) NOT NULL,
  `S_Name` varchar(250) NOT NULL,
  `L_Name` varchar(250) NOT NULL,
  `Y_Birth` int(4) NOT NULL,
  `Y_Death` int(4) DEFAULT NULL,
  `id_contries` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `directors`
--

INSERT INTO `directors` (`id`, `S_Name`, `L_Name`, `Y_Birth`, `Y_Death`, `id_contries`) VALUES
(1, 'Петров', 'Андрій', 1981, NULL, 1),
(24, 'Андрій', 'Довженко', 1845, 2000, 1),
(27, 'Довженко', 'Маріна', 1974, 2011, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genres` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `genres`
--

INSERT INTO `genres` (`id`, `genres`) VALUES
(1, 'Ужаси'),
(4, 'Боєвик');

-- --------------------------------------------------------

--
-- Структура таблиці `movies`
--

CREATE TABLE `movies` (
  `id` int(6) NOT NULL,
  `id_directors` int(6) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `id_genres` int(6) NOT NULL,
  `Duration` int(8) NOT NULL,
  `year` year(4) NOT NULL,
  `Biudjet` int(250) NOT NULL,
  `id_Studio` int(6) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `movies`
--

INSERT INTO `movies` (`id`, `id_directors`, `Name`, `id_genres`, `Duration`, `year`, `Biudjet`, `id_Studio`, `Date`) VALUES
(1, 1, 'Заклятіє', 1, 150, 2016, 65000, 2, '2017-01-01'),
(4, 24, 'Зверополіс', 1, 156, 2014, 6520, 2, '2017-01-03'),
(5, 1, 'Мудреці', 4, 158, 2014, 6800, 1, '2016-12-26');

-- --------------------------------------------------------

--
-- Структура таблиці `studio`
--

CREATE TABLE `studio` (
  `id` int(6) NOT NULL,
  `Name_studio` varchar(100) NOT NULL,
  `id_Address` int(6) NOT NULL,
  `Contact` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `studio`
--

INSERT INTO `studio` (`id`, `Name_studio`, `id_Address`, `Contact`) VALUES
(1, 'Мосфільм', 2, 'Іваненко Петро'),
(2, 'Союзфільм', 1, 'Пупкін Іван'),
(3, 'Марвел', 5, 'Аодаіце Іван'),
(8, 'Дісней', 7, 'Міхай Андрій'),
(9, 'Марвел', 8, 'Міхай Андрій');

-- --------------------------------------------------------

--
-- Структура таблиці `town`
--

CREATE TABLE `town` (
  `id` int(6) NOT NULL,
  `town` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `town`
--

INSERT INTO `town` (`id`, `town`) VALUES
(1, 'Чернівці'),
(2, 'Донецік'),
(3, '1'),
(4, 'Бухарест');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `address`
--
ALTER TABLE `address`
  ADD KEY `id` (`id`),
  ADD KEY `id_Contry` (`id_countries`),
  ADD KEY `id_Citi` (`id_town`),
  ADD KEY `id_Stret` (`street`);

--
-- Індекси таблиці `countries`
--
ALTER TABLE `countries`
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `directors`
--
ALTER TABLE `directors`
  ADD KEY `id` (`id`),
  ADD KEY `id_Citizeche` (`id_contries`);

--
-- Індекси таблиці `genres`
--
ALTER TABLE `genres`
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Індекси таблиці `movies`
--
ALTER TABLE `movies`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id_Janre` (`id_genres`),
  ADD KEY `id_Studio` (`id_Studio`),
  ADD KEY `id_S_L_Name` (`id_directors`),
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `studio`
--
ALTER TABLE `studio`
  ADD KEY `id` (`id`),
  ADD KEY `id_Adres` (`id_Address`);

--
-- Індекси таблиці `town`
--
ALTER TABLE `town`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `address`
--
ALTER TABLE `address`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблиці `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблиці `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблиці `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблиці `studio`
--
ALTER TABLE `studio`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблиці `town`
--
ALTER TABLE `town`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_countries`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`id_town`) REFERENCES `town` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `directors`
--
ALTER TABLE `directors`
  ADD CONSTRAINT `directors_ibfk_1` FOREIGN KEY (`id_contries`) REFERENCES `countries` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`id_genres`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`id_Studio`) REFERENCES `studio` (`id`),
  ADD CONSTRAINT `movies_ibfk_3` FOREIGN KEY (`id_directors`) REFERENCES `directors` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `studio`
--
ALTER TABLE `studio`
  ADD CONSTRAINT `studio_ibfk_1` FOREIGN KEY (`id_Address`) REFERENCES `address` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
