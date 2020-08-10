-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 08, 2020 lúc 12:13 PM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dat_phong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `level`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$gny0ogg42Y54Sn7QFjW61uP5mmsgHVhjosBJEg9JliAcVK8OW/lxC', '0388346413', 1, 1, NULL, '2019-09-17 10:55:01', NULL),
(2, 'quynh', 'quynhngu10021999@gmail.com', '$2y$10$waxKzbpI6XLVkw03H/IixuNmnuQxiwpKXw4NQfVyKWi9p68hnh8TK', '35416103632', 2, 1, NULL, '2019-09-17 11:00:56', '2019-09-17 11:00:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `day` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `total_billed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`bill_id`, `user_id`, `check_in`, `check_out`, `day`, `status`, `total_billed`) VALUES
(1, 2, '2019-09-18', '2019-09-24', 6, 2, 1800000),
(2, 2, '2019-09-18', '2019-09-24', 6, 1, 1800000),
(4, 3, '2019-09-24', '2019-09-28', 4, 1, 1200000),
(5, 3, '2019-09-28', '2019-09-30', 2, 1, 600000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cate_room`
--

CREATE TABLE `cate_room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `describe` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cate_room`
--

INSERT INTO `cate_room` (`id`, `name`, `price`, `image`, `describe`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Thị Thảo', 300000, 'áo sơ mi.jpg', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', '2019-09-17 11:01:22', NULL),
(2, 'rau củ', 400000, 'coto.jpg', 'asssssssssssssssssssssssss', '1', '2019-09-17 11:01:40', NULL),
(3, 'adming', 10000, 'domino.jpg', 'ffffffffffffffffffffffffff', '1', '2020-07-08 03:11:43', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailed_invoice`
--

CREATE TABLE `detailed_invoice` (
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `detailed_invoice`
--

INSERT INTO `detailed_invoice` (`bill_id`, `room_id`) VALUES
(1, 2),
(2, 1),
(4, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2019_08_10_032250_create_admin_table', 1),
(17, '2019_08_10_032402_create_cate_room_table', 1),
(18, '2019_08_10_032432_create_room_table', 1),
(19, '2019_08_10_032507_create_users_table', 1),
(20, '2019_08_10_032532_create_bill_table', 1),
(21, '2019_08_10_032625_create_detailed_invoice_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cate_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`id`, `name`, `slug`, `cate_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Phòng 101', '1', 1, 1, NULL, NULL),
(2, 'Phòng 102', '1', 1, 1, NULL, NULL),
(3, 'Phòng 201', '1', 2, 1, NULL, NULL),
(4, 'Phòng 202', '1', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `identity_card`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'nguyễn thị thảo', 'thao19011999@gmail.com', '01654161036', '$2y$10$5Zv2sKQuZn4f4VgyRTJC1OPoyFBK7dbaZxJ6PUPL.6k8Vlpj1S80u', '4444443333333', NULL, 1, NULL, NULL),
(2, 'quynh', 'quynhngu10021999@gmail.com', '35416103621', '$2y$10$Ahlm6twkoXFqkcc0/1vyJOj9huyiB9wBSmWC2H0mZtlj/yM4.pEem', '44444444433333333', NULL, 1, NULL, NULL),
(3, 'do', 'do@gmail.com', '013454164036', '$2y$10$Txv4u.K5NSg.vMzdxUnszeCaD//yricr.p22jltXoWUJjqTWMlxP.', '444444444333333332', NULL, 1, NULL, NULL),
(4, 'abc', 'email@gmail.com', '3541610362', '123456', 'asd', NULL, 1, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bill_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cate_room`
--
ALTER TABLE `cate_room`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `detailed_invoice`
--
ALTER TABLE `detailed_invoice`
  ADD KEY `detailed_invoice_bill_id_foreign` (`bill_id`),
  ADD KEY `detailed_invoice_room_id_foreign` (`room_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_cate_id_foreign` (`cate_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `cate_room`
--
ALTER TABLE `cate_room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `detailed_invoice`
--
ALTER TABLE `detailed_invoice`
  ADD CONSTRAINT `detailed_invoice_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detailed_invoice_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `cate_room` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
