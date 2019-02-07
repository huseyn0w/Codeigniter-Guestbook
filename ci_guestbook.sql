-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 07 2019 г., 18:32
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ci_guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `front_pages`
--

CREATE TABLE `front_pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `front_pages`
--

INSERT INTO `front_pages` (`id`, `title`, `url`, `created_date`, `visibility`) VALUES
(1, 'Homepage', '', '2019-02-05 22:30:13', 1),
(2, 'Profile', 'myprofile', '2019-02-05 22:31:11', 2),
(3, 'Admin panel', 'admin', '2019-02-05 22:32:07', 3),
(5, 'Add new review', 'reviews/add', '2019-02-05 22:33:39', 2),
(6, 'Logout', 'logout', '2019-02-07 13:49:19', 2),
(7, 'Register', 'register', '2019-02-07 14:29:29', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `full_text` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `author_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `header`, `excerpt`, `full_text`, `created_date`, `approved`, `author_id`) VALUES
(54, 'Review by admin', 'review header', '<p style=\"text-align:center;\"><strong>review full body</strong></p>', '2019-02-07 14:25:41', 1, 1),
(55, 'review by user', 'Review excerpt', '<p>Nice GB!</p>', '2019-02-07 14:26:11', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'user'),
(7, 'administrator');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'github_url', 'https://github.com/huseyn0w/ci_guestbook'),
(2, 'posts_per_page', '5'),
(3, 'main_title', 'CI Guestbook'),
(4, 'front_copyright', '<p class=\"copyright text-muted\">Created by <a href=\"https://linkedin.com/in/huseyn0w\">Elman Hüseynov</a></p>'),
(5, 'small_headline', 'Simple guestbook created on Codeigniter framework with love!');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL DEFAULT '1',
  `avatar_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `registration_date`, `role`, `avatar_url`) VALUES
(1, 'admin', '$2y$10$mL4kpgGdhY.CYh92LoJbsuy09IKSASEVQOdtek0EvREjXowtRS6Ee', 'admin@admin.com', 'Elman Huseynov1', '2019-01-26 17:59:42', 7, 'http://guestbook/uploads/prof26.jpg'),
(11, 'test', '$2y$10$4ubTdYHjmQ7egJq23mPXeOrdE/yrCJZdqq2n0vwlfBwjBS0sYb74a', 'test@test.com', 'test name', '2019-02-07 15:08:12', 1, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `front_pages`
--
ALTER TABLE `front_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `front_pages`
--
ALTER TABLE `front_pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
