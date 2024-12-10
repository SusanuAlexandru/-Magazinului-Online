-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 11 2024 г., 00:27
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `magazin_sport`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ciclizm', '2024-11-26 17:27:19', '2024-12-10 18:58:00'),
(3, 'Tenis', '2024-12-10 21:49:43', '2024-12-10 21:49:43'),
(4, 'Fotbal', '2024-12-10 21:52:46', '2024-12-10 21:52:46'),
(5, 'Fitness', '2024-12-10 22:03:50', '2024-12-10 22:03:50'),
(6, 'Yoga', '2024-12-10 22:04:52', '2024-12-10 22:04:52'),
(7, 'Drumeție', '2024-12-10 22:08:29', '2024-12-10 22:08:29'),
(8, 'Box', '2024-12-10 22:19:24', '2024-12-10 22:19:24');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Confirmed','Shipped','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `description`, `price`, `stock`, `category_id`, `brand`, `created_at`, `updated_at`) VALUES
(13, '6758c62741829_fh7362-3.jpg', 'Minge de fotbal \"ProKick\"', 'Minge de fotbal profesională, confecționată din piele sintetică de calitate', 120.00, 43, 4, 'Adidas', '2024-12-03 10:38:04', '2024-12-10 21:52:56'),
(14, '6758c5280e810_tipos_de_deportes_con_raqueta_52596_orig.jpg', ' Racheta de tenis \"SpeedMaster\"', ' Rachetă ușoară, ideală pentru jocuri de viteză și precizie', 550.00, 32, 3, ' Wilson', '2024-12-03 10:43:03', '2024-12-10 21:49:56'),
(30, '6758c80301281_pexels-luftschnitzel-100582.jpg', ' Bicicletă de munte \"MountainX\"', 'Bicicletă robustă, perfectă pentru trasee montane dificile', 1800.00, 20, 1, 'Trek', '2024-12-10 21:44:28', '2024-12-10 22:00:19'),
(31, '6758c6fecb594_26e1ac1d1989bd5fda1aed3b092da79d.webp', 'Set de gantere reglabile \"FitPower\"', ' Set de gantere reglabile, cu greutăți ajustabile ', 350.00, 50, 5, 'Reebok', '2024-12-10 21:55:58', '2024-12-10 22:05:03'),
(32, '6758c86daecbc_saltea-yoga-sportmann-trikona-verde.jpg', 'Saltea de yoga \"ZenirMater\"', 'Saltea confortabilă pentru yoga, cu aderență excelentă', 100.00, 60, 6, 'Nike', '2024-12-10 22:02:05', '2024-12-10 22:05:18'),
(33, '6758c9ad02f64_rucsac_drumetie_-_trekking_pinguin_activent_55l-_verde_2020_.jpg', 'Rucsac de drumeție \"TrailBlazer\"', 'ucsac ergonomic, cu multiple compartimente', 250.00, 10, 7, 'The North Face', '2024-12-10 22:07:25', '2024-12-10 22:08:37'),
(34, '6758cb095ac2e_manusi-box-kickboxing-pro-armura-piele-639739.webp', 'Mănuși de box \"FightMaster\"', 'Mănuși de box din piele sintetică, cu protecție suplimentară', 700.00, 15, 8, 'Everlast', '2024-12-10 22:10:58', '2024-12-10 22:19:40'),
(35, '6758cb9b160df_Spiuk---Casca-ciclism-DHARMA-Edition-helmet---portocaliu-flacara-negru.jpg', 'Casca de ciclism \"SpeedGuard\"', 'Cască de ciclism ușoară și bine ventilată, cu protecție sporită', 500.00, 20, 1, 'Giro', '2024-12-10 22:15:39', '2024-12-10 22:15:39');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `review_date`, `created_at`, `updated_at`) VALUES
(7, 13, 1, 3, 'gfbfdxb', '2024-12-03 20:31:51', '2024-12-03 20:31:52', '2024-12-03 20:31:52'),
(8, 13, 1, 3, 'vdv', '2024-12-03 20:43:14', '2024-12-03 20:43:14', '2024-12-03 20:43:14'),
(9, 13, 1, 3, 'vdv', '2024-12-03 20:43:57', '2024-12-03 20:43:57', '2024-12-03 20:43:57'),
(10, 13, 1, 3, 'xfg x', '2024-12-03 20:44:04', '2024-12-03 20:44:04', '2024-12-03 20:44:04'),
(11, 14, 1, 3, 'Se poate mai bine', '2024-12-03 21:32:50', '2024-12-03 21:32:50', '2024-12-03 21:32:50'),
(12, 13, 1, 3, 'Se poate mai bine', '2024-12-03 22:14:42', '2024-12-03 22:14:42', '2024-12-03 22:14:42'),
(13, 13, 3, 2, 'fnftynd', '2024-12-10 16:43:39', '2024-12-10 16:43:39', '2024-12-10 16:43:39'),
(14, 14, 2, 5, 'Foarte bine', '2024-12-10 18:00:48', '2024-12-10 18:00:48', '2024-12-10 18:00:48');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Alex', 'testemail@gmail.com', '$2y$10$4kmYz.X4.g6anUd5U.EYLer5kffA9paVheFzSqGUdb5tSzBKUr8fK', 'user', '2024-12-10 14:27:49', '2024-12-10 22:39:35'),
(3, 'Alexandru', 'susanu.alexandru@elev.cihcahul.md', '$2y$10$94J5dwBf/4PwmZ0jAIOKreKkMEGJbXnBA13FdYdoJW8zU09dmaEJq', 'admin', '2024-12-10 14:56:58', '2024-12-10 14:56:58');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
