-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 14 2023 г., 10:43
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oopbd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `package`
--

CREATE TABLE `package` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(5) NOT NULL,
  `user` varchar(12) NOT NULL,
  `carnum` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `settime` date NOT NULL,
  `endtime` date NOT NULL,
  `price` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `package`
--

INSERT INTO `package` (`id`, `type`, `user`, `carnum`, `settime`, `endtime`, `price`) VALUES
(8, 'casco', '123123456456', '111III01', '2023-04-13', '2024-04-13', 0),
(9, 'osago', '030303602000', '222Aks02', '2023-04-13', '2023-10-13', 0),
(10, 'casco', '888888888888', 'y123rty', '2023-04-13', '2024-04-13', 0),
(11, 'green', '888888888888', '265ujk12', '2023-04-13', '2023-10-13', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `tel` varchar(12) NOT NULL,
  `iin` varchar(12) NOT NULL,
  `email` varchar(265) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `tel`, `iin`, `email`, `pass`, `admin`) VALUES
(1, 'Yergali', '+77772398674', '031226500298', 'ergali.erga@mail.ru', 'ebf90badac0effa923e5666b92b9c176', 1),
(3, NULL, '87774561122', '011232500987', 'mail@example.com', 'passs', 0),
(4, NULL, '+77078087788', '041211400875', 'jaymail@gmail.com', '5009a882ac96f53991a9e23c2eecba4a', 0),
(5, 'Maksat Akseleu', '87475903766', '030303602000', 'maksatakselu@gmail.com', '666df95fdd91bcf10eefb1b89cdf6be4', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `package`
--
ALTER TABLE `package`
  ADD UNIQUE KEY `id_package` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `tel` (`tel`,`iin`,`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `package`
--
ALTER TABLE `package`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
