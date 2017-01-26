-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Січ 26 2017 р., 22:00
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
-- Структура таблиці `addreses`
--

CREATE TABLE `addreses` (
  `id` int(6) NOT NULL,
  `id_Contry` int(6) NOT NULL,
  `id_Citi` int(6) NOT NULL,
  `id_Stret` int(6) NOT NULL,
  `Home` int(6) NOT NULL,
  `_index` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `addreses`
--

INSERT INTO `addreses` (`id`, `id_Contry`, `id_Citi`, `id_Stret`, `Home`, `_index`) VALUES
(1, 2, 1, 2, 49, 6050),
(2, 2, 1, 1, 5, 60503);

-- --------------------------------------------------------

--
-- Структура таблиці `city`
--

CREATE TABLE `city` (
  `id` int(6) NOT NULL,
  `City` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `city`
--

INSERT INTO `city` (`id`, `City`) VALUES
(1, 'Чернівці'),
(2, 'Донецік');

-- --------------------------------------------------------

--
-- Структура таблиці `contry`
--

CREATE TABLE `contry` (
  `id` int(6) NOT NULL,
  `Contry` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `contry`
--

INSERT INTO `contry` (`id`, `Contry`) VALUES
(1, 'Україна'),
(2, 'США');

-- --------------------------------------------------------

--
-- Структура таблиці `janres`
--

CREATE TABLE `janres` (
  `id` int(11) NOT NULL,
  `janre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `janres`
--

INSERT INTO `janres` (`id`, `janre`) VALUES
(1, 'Ужаси');

-- --------------------------------------------------------

--
-- Структура таблиці `movies`
--

CREATE TABLE `movies` (
  `id_S_L_Name` int(6) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `id_Janre` int(6) NOT NULL,
  `Duration` int(8) NOT NULL,
  `Yer` year(4) NOT NULL,
  `Biudjet` int(250) NOT NULL,
  `id_Studio` int(6) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `movies`
--

INSERT INTO `movies` (`id_S_L_Name`, `Name`, `id_Janre`, `Duration`, `Yer`, `Biudjet`, `id_Studio`, `Date`) VALUES
(1, 'Заклятіє', 1, 150, 2016, 65000, 2, '2017-01-01');

-- --------------------------------------------------------

--
-- Структура таблиці `regisers`
--

CREATE TABLE `regisers` (
  `id` int(6) NOT NULL,
  `S_Name` varchar(250) NOT NULL,
  `L_Name` varchar(250) NOT NULL,
  `Y_Byrd` int(4) NOT NULL,
  `Y_Dead` int(4) DEFAULT NULL,
  `id_Citizeche` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `regisers`
--

INSERT INTO `regisers` (`id`, `S_Name`, `L_Name`, `Y_Byrd`, `Y_Dead`, `id_Citizeche`) VALUES
(1, 'Петров', 'Андрій', 1981, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `strets`
--

CREATE TABLE `strets` (
  `id` int(6) NOT NULL,
  `stret` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `strets`
--

INSERT INTO `strets` (`id`, `stret`) VALUES
(1, 'Головна'),
(2, 'Університеціка');

-- --------------------------------------------------------

--
-- Структура таблиці `studions`
--

CREATE TABLE `studions` (
  `id` int(6) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `id_Adres` int(6) NOT NULL,
  `Contact` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `studions`
--

INSERT INTO `studions` (`id`, `Name`, `id_Adres`, `Contact`) VALUES
(1, 'Мосфільм', 2, 'Іваненко Петро'),
(2, 'Союзфільм', 1, 'Пупкін Іван');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `addreses`
--
ALTER TABLE `addreses`
  ADD KEY `id` (`id`),
  ADD KEY `id_Contry` (`id_Contry`),
  ADD KEY `id_Citi` (`id_Citi`),
  ADD KEY `id_Stret` (`id_Stret`);

--
-- Індекси таблиці `city`
--
ALTER TABLE `city`
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `contry`
--
ALTER TABLE `contry`
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `janres`
--
ALTER TABLE `janres`
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Індекси таблиці `movies`
--
ALTER TABLE `movies`
  ADD KEY `id_Janre` (`id_Janre`),
  ADD KEY `id_Studio` (`id_Studio`),
  ADD KEY `id_S_L_Name` (`id_S_L_Name`);

--
-- Індекси таблиці `regisers`
--
ALTER TABLE `regisers`
  ADD KEY `id` (`id`),
  ADD KEY `id_Citizeche` (`id_Citizeche`);

--
-- Індекси таблиці `strets`
--
ALTER TABLE `strets`
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `studions`
--
ALTER TABLE `studions`
  ADD KEY `id` (`id`),
  ADD KEY `id_Adres` (`id_Adres`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `addreses`
--
ALTER TABLE `addreses`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `city`
--
ALTER TABLE `city`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `contry`
--
ALTER TABLE `contry`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `janres`
--
ALTER TABLE `janres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблиці `regisers`
--
ALTER TABLE `regisers`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблиці `strets`
--
ALTER TABLE `strets`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `studions`
--
ALTER TABLE `studions`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `addreses`
--
ALTER TABLE `addreses`
  ADD CONSTRAINT `addreses_ibfk_1` FOREIGN KEY (`id_Contry`) REFERENCES `contry` (`id`),
  ADD CONSTRAINT `addreses_ibfk_2` FOREIGN KEY (`id_Citi`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `addreses_ibfk_3` FOREIGN KEY (`id_Stret`) REFERENCES `strets` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`id_Janre`) REFERENCES `janres` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`id_Studio`) REFERENCES `studions` (`id`),
  ADD CONSTRAINT `movies_ibfk_3` FOREIGN KEY (`id_S_L_Name`) REFERENCES `regisers` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `regisers`
--
ALTER TABLE `regisers`
  ADD CONSTRAINT `regisers_ibfk_1` FOREIGN KEY (`id_Citizeche`) REFERENCES `contry` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `studions`
--
ALTER TABLE `studions`
  ADD CONSTRAINT `studions_ibfk_1` FOREIGN KEY (`id_Adres`) REFERENCES `addreses` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
