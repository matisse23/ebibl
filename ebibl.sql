-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 07 2015 г., 19:24
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ebibl`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id_aut` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_aut`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id_aut`, `name`) VALUES
(1, 'Bradberry'),
(2, 'King'),
(3, 'KIng Strugatsky'),
(4, 'London');

-- --------------------------------------------------------

--
-- Структура таблицы `aut_bks`
--

CREATE TABLE IF NOT EXISTS `aut_bks` (
  `id_aut` int(11) NOT NULL,
  `id_bks` int(11) NOT NULL,
  KEY `id_aut` (`id_aut`),
  KEY `id_bks` (`id_bks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `aut_bks`
--

INSERT INTO `aut_bks` (`id_aut`, `id_bks`) VALUES
(1, 1),
(1, 7),
(2, 2),
(3, 3),
(3, 6),
(3, 5),
(4, 8),
(2, 9),
(4, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id_bks` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bks`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_bks`, `title`) VALUES
(1, 'The Martian Chronicles'),
(2, '11/22/63'),
(3, 'Roadside Picnic'),
(4, 'White Fang'),
(5, 'Snail on the Slope'),
(6, 'The Doomed City'),
(7, 'Fahrenheit 451'),
(8, 'The Sea-Wolf '),
(9, 'UNDER THE DOME');

-- --------------------------------------------------------

--
-- Структура таблицы `oshibka`
--

CREATE TABLE IF NOT EXISTS `oshibka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(12) NOT NULL,
  `date` datetime NOT NULL,
  `col` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation` int(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `activation`, `date`) VALUES
(1, 'aa', 'dd4385932a3430c2ae59ca6e5633ebcbb3p6f', 1, '0000-00-00 00:00:00'),
(2, 'aaa', 'e99e29ff2b3796f65f0469efcd61c841b3p6f', 1, '2015-09-06 12:49:56');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `aut_bks`
--
ALTER TABLE `aut_bks`
  ADD CONSTRAINT `aut_bks_ibfk_1` FOREIGN KEY (`id_aut`) REFERENCES `authors` (`id_aut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aut_bks_ibfk_2` FOREIGN KEY (`id_bks`) REFERENCES `books` (`id_bks`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
