-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 08 2020 г., 15:03
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geek_php_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `url`, `name`, `size`, `views`) VALUES
(1, '/php_base/imgs/slide1.jpg', 'slide1', 530, 6),
(2, '/php_base/imgs/slide2.jpg', 'slide2', 579, 5),
(3, '/php_base/imgs/slide3.jpg', 'slide3', 268, 0),
(4, '/php_base/imgs/slide4.jpg', 'slide4', 113, 2),
(5, '/php_base/imgs/slide5.jpg', 'slide5', 256, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `order_data` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_name`, `address`, `email`, `phone`, `price`, `order_data`, `status`) VALUES
(1, 1, 'Вася', '', 'i.yemelyanova@gmail.com', '89268950512', 756, '{\"4\":{\"id\":\"4\",\"name\":\"Товар 4\",\"price\":\"113\",\"count\":2},\"1\":{\"id\":\"1\",\"name\":\"Товар 1\",\"price\":\"530\",\"count\":1}}', 1),
(2, 1, 'Вася', '', 'i.yemelyanova@gmail.com', '89268950512', 256, '{\"5\":{\"id\":\"5\",\"name\":\"Товар 5\",\"price\":\"256\",\"count\":1}}', 0),
(3, 4, 'Ася', '', 'i.yemelyanova@gmail.com', '89268950512', 1024, '{\"6\":{\"id\":\"6\",\"name\":\"Товар 6\",\"price\":\"256\",\"count\":4}}', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `url`, `name`, `price`, `views`) VALUES
(1, 'img/slide1.jpg', 'Товар 1', 530, 29),
(2, 'img/slide2.jpg', 'Товар 2', 579, 12),
(3, 'img/slide3.jpg', 'Товар 3', 268, 0),
(4, 'img/slide4.jpg', 'Товар 4', 113, 37),
(5, 'img/slide5.jpg', 'Товар 5', 256, 8),
(6, 'img/slide6.jpg', 'Товар 6', 256, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `author`, `comment`) VALUES
(4, 4, 'test3', 'еще один'),
(6, 4, 'Новый юзер', 'Тестовый коммент'),
(7, 1, 'Тест Тестов', 'Комментарий к товару'),
(8, 5, 'я', 'ну и еще');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `phone`, `email`, `address`, `is_admin`) VALUES
(1, 'test', '$2y$10$UAR8aZzOOpE9CNxJwU9tPe9REXXo6.F5.B/V/uapGVVRuSTFT8hoa', 'Вася', '89268950512', 'i.yemelyanova@gmail.com', '', 0),
(2, 't', '$2y$10$BknGClDaDcF6L6EreDW12ee/AG2GQk2nCOXsmaiyHdXe6pY.skgny', 'q', 'q', 'q', '', 0),
(3, 'admin', '$2y$10$9.b3E.MKiogTje72Xz/i1OIeCtBGNCBi.bKWvpl7Ebrko6dyjPjU2', 'Админ', '111111', 'admin@admin.ru', '', 1),
(4, 'test2', '$2y$10$lLdxdUcJPBJAo4oToEzqhOTau5K9DXLskWD12O7iF585yYyRdvNgu', 'Ася', '89268950512', 'i.yemelyanova@gmail.com', '', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
