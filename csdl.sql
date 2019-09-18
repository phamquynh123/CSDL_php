-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 08, 2019 lúc 05:02 PM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `csdl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'phamquynh047@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ASUS', '2018-10-21 12:21:08', NULL),
(2, 'Dell', '2018-10-21 12:21:19', NULL),
(3, 'MacBook', '2018-10-21 12:21:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'xanh da trời', '#58FAF4', '2018-10-18 09:34:14', NULL),
(2, 'Đen', '#000000', '2018-10-18 09:34:39', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `product_id`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'public/image/product/10176072_675004515893543_2153573210783511303_n.jpg', '2018-10-01 15:10:29', '2018-10-01 15:10:32'),
(2, 1, 'abcdabcd', '2018-10-01 15:10:44', NULL),
(3, 2, 'public/image/product/maxresdefault.jpg', '2018-10-25 16:30:04', NULL),
(4, 2, 'public/image/product/u_10157746.jpg', '2018-11-17 10:36:16', NULL),
(5, 6, 'public/image/product/dell1.jpg', '2018-11-30 10:37:47', NULL),
(6, 6, 'public/image/product/zenux303_3.png', '2018-11-30 10:37:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `total`, `created_at`) VALUES
(2, 6, NULL, '60,000,000', NULL),
(4, 9, NULL, '10,000,000', NULL),
(6, 10, NULL, '10,000,000', NULL),
(7, 11, NULL, '80,000,000', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `product_detail_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime(2) DEFAULT NULL,
  `quantity_buy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `product_detail_id`, `product_id`, `order_id`, `created_at`, `quantity_buy`) VALUES
(6, 5, 2, 2, '2018-11-27 03:03:52.00', 4),
(7, 7, 1, 2, '2018-11-27 03:03:52.00', 2),
(8, 5, 1, 4, '2018-11-27 03:07:24.00', 1),
(9, 7, 2, 6, '2018-11-27 03:10:14.00', 1),
(10, 5, 2, 7, '2018-11-30 10:32:47.00', 5),
(11, 1, 1, 7, '2018-11-30 10:32:47.00', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `brand_id`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Zenbook ', 1, '2018-10-01 15:45:44', NULL, 'lorem100Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam animi beatae obcaecati reprehenderit, placeat facilis aut. Magnam rem voluptatem, officia a eligendi placeat architecto natus eaque et quis repudiandae optio temporibus fugiat, i'),
(2, 'Zenbook2017   ', 1, '2018-10-18 00:38:17', NULL, 'ZenBook là dòng máy tính xách tay siêu cơ động, nhưng chiếc Zenbook UX430UQ-GV044T tinh tế và lịch lãm này là sự khác biệt hơn cả: chúng tôi đã tạo ra một ZenBook 13 inch thân thiện với du lịch sở hữu màn hiển thị 14 inch thân thiện với công việc! Lần đầu'),
(6, 'dell', 2, '2018-11-30 10:36:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_detail`
--

CREATE TABLE `products_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `screen` varchar(255) DEFAULT NULL,
  `ram_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products_detail`
--

INSERT INTO `products_detail` (`id`, `product_id`, `color_id`, `price`, `quantity`, `screen`, `ram_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '15000000', '10', '14 ink', '1', '2018-10-25 17:06:43', NULL),
(2, 1, 2, '20000000', '20', '14 ink', '2', '2018-10-26 01:40:08', NULL),
(4, 1, 1, '10000000', '20', '15 ink', '1', '2018-10-30 01:49:01', NULL),
(5, 2, 1, '10000000', '100', '14 ink', '2', '2018-10-30 01:50:14', NULL),
(7, 2, 1, '10000000', '10 ', '15 ink ', '3 ', '2018-11-01 12:52:00', '2018-11-03 21:51:40'),
(8, 6, 2, '10000000', '10', '14 ink', '2', '2018-11-30 10:37:06', NULL),
(9, 6, 1, '10000000', '10', '14 ink', '2', '2018-11-30 10:37:16', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rams`
--

CREATE TABLE `rams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `rams`
--

INSERT INTO `rams` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '4GB', '2018-10-11 13:16:44', '2018-10-11 13:16:47'),
(2, '8GB', '2018-10-11 13:16:57', '2018-10-11 13:17:01'),
(3, '16GB', '2018-10-11 13:17:16', '2018-10-11 13:17:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(6, 'nhom12', 'nhom12@gmail.com', 'nhom12 ha nội', '0987654321', '2018-11-27 03:03:52', NULL),
(9, 'q', 'q@g.c', 'ưewe', '5645', '2018-11-27 03:09:47', NULL),
(10, 'trang', 'trang@gmail.com', '123', '123', '2018-11-27 03:10:14', NULL),
(11, 'nhom14', 'nhom14@gmail.com', 'nhom14', '0765432176', '2018-11-30 10:32:47', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Chỉ mục cho bảng `products_detail`
--
ALTER TABLE `products_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Chỉ mục cho bảng `rams`
--
ALTER TABLE `rams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `products_detail`
--
ALTER TABLE `products_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `rams`
--
ALTER TABLE `rams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
