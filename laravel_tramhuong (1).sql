-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 25, 2025 lúc 12:31 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel_tramhuong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_danhmuc` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `ten_danhmuc`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vòng Trầm Hương', 1, '2025-04-21 01:47:21', '2025-04-21 01:47:21'),
(2, 'Phật Bản Mệnh Theo Tuổi', 1, '2025-04-21 01:47:31', '2025-04-21 01:47:31'),
(3, 'Nhang, Nụ Trầm Hương', 1, '2025-04-21 01:47:45', '2025-04-21 01:47:45'),
(4, 'Thác Khói Trầm Hương', 1, '2025-04-21 01:47:51', '2025-04-21 01:47:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_veryfied_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id`, `fullname`, `email`, `email_veryfied_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', NULL, '$2y$12$.n5I1WKDz1mLm8UYCExHAO8TafoQITejgYNMMXz8ah2SkV.0SpuGG', NULL, '2025-04-21 01:48:07', '2025-04-21 01:48:07'),
(2, 'Nguyễn Văn A', '123@gmail.com', NULL, '$2y$12$bF3x1jx99BDiU749DT1q2eSSPLKJHbs5VFNkQScop90NLzXr/HWE.', NULL, '2025-04-21 01:48:16', '2025-04-21 03:09:48'),
(3, 'Nguyễn Văn B', 've@gmail.com', NULL, '$2y$12$lX1FYnOQ8PB0ldQJDoClPecPh8SuwyO5RC6lzQnO2GcaKoUwXg5du', NULL, '2025-04-21 01:48:32', '2025-04-21 01:48:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_04_21_073918_create_users_table', 1),
(3, '2025_04_21_073940_create_login_table', 1),
(4, '2025_04_21_073956_create_category_table', 1),
(5, '2025_04_21_074010_create_product_table', 1),
(6, '2025_04_21_074025_create_orders_table', 1),
(7, '2025_04_21_074047_create_order_details_table', 1),
(8, '2025_04_21_113102_modify_orders_table_drop_foreign_key', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `tongtien` decimal(15,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `trang_thai` varchar(255) NOT NULL DEFAULT 'Chờ xác nhận',
  `vnpay_txn_ref` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `sdt`, `diachi`, `tongtien`, `payment_method`, `trang_thai`, `vnpay_txn_ref`, `created_at`, `updated_at`) VALUES
(9, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'cod', 'Đơn hàng đã được gửi đi', NULL, '2025-04-21 02:06:19', '2025-04-21 02:11:41'),
(10, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 34000000.00, 'cod', 'Đơn hàng đã được gửi đi', NULL, '2025-04-21 02:12:45', '2025-04-21 02:12:58'),
(15, 2, 'Nguyễn Văn A', '123@gmail.com', '0987654321', 'tam kỳ', 16000000.00, 'cod', 'Chờ xác nhận', NULL, '2025-04-21 04:32:42', '2025-04-21 04:32:42'),
(16, 2, 'Nguyễn Văn A', '123@gmail.com', '0987654321', 'tam kỳ', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 04:35:59', '2025-04-21 04:35:59'),
(17, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 04:41:06', '2025-04-21 04:41:06'),
(18, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 04:43:52', '2025-04-21 04:43:52'),
(19, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 04:47:15', '2025-04-21 04:47:15'),
(20, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 04:55:06', '2025-04-21 04:55:06'),
(21, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 04:58:53', '2025-04-21 04:58:53'),
(22, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 05:00:49', '2025-04-21 05:00:49'),
(23, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 05:15:33', '2025-04-21 05:15:33'),
(24, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 05:18:45', '2025-04-21 05:18:45'),
(25, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 05:24:08', '2025-04-21 05:24:08'),
(26, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 17000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 17:46:11', '2025-04-21 17:46:11'),
(27, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 17:49:21', '2025-04-21 17:49:21'),
(28, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 17:55:27', '2025-04-21 17:55:27'),
(29, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 17000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 17:57:59', '2025-04-21 17:57:59'),
(30, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 18:00:50', '2025-04-21 18:00:50'),
(31, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 17000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 18:01:54', '2025-04-21 18:01:54'),
(32, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 18:02:32', '2025-04-21 18:02:32'),
(33, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'tam kỳ', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 18:03:45', '2025-04-21 18:03:45'),
(34, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 18:04:24', '2025-04-21 18:04:24'),
(35, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 17000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-21 18:05:13', '2025-04-21 18:05:13'),
(36, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-21 18:06:12', '2025-04-21 18:06:12'),
(37, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 03:28:11', '2025-04-22 03:28:11'),
(38, 3, 'admin', 'lo@gmail.com', '0123456789', 'tam kỳ', 16000000.00, 'cod', 'Chờ xác nhận', NULL, '2025-04-22 03:28:35', '2025-04-22 03:28:35'),
(39, 3, 'nguyễn minh lĩnh', 'hhhhh@gmail.com', '0987654321', 'Tiên Phong, Tiên Phước, Quảng Nam', 17000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 03:49:15', '2025-04-22 03:49:15'),
(40, 3, 'Nguyễn Văn A', 'hhhhh@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 03:53:36', '2025-04-22 03:53:36'),
(41, 3, 'nguyễn minh lĩnh', '123@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 04:14:06', '2025-04-22 04:14:06'),
(42, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 04:18:49', '2025-04-22 04:18:49'),
(43, 3, 'Nguyễn Văn A', '123@gmail.com', '0987654321', 'tam kỳ', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 04:22:20', '2025-04-22 04:22:20'),
(44, 3, 'nguyễn minh lĩnh', 've@gmail.com', '0987654321', 'Tiên Phong, Tiên Phước, Quảng Nam', 16000000.00, 'vnpay', 'Chờ thanh toán', NULL, '2025-04-22 04:32:05', '2025-04-22 04:32:05'),
(45, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Đã thanh toán', NULL, '2025-04-22 04:36:09', '2025-04-22 04:36:39'),
(46, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 16000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-22 04:38:25', '2025-04-22 04:38:49'),
(47, 3, 'Nguyễn Văn A', '123@gmail.com', '0987654321', 'tam kỳ', 16000000.00, 'cod', 'Chờ xác nhận', NULL, '2025-04-22 04:43:13', '2025-04-22 04:43:13'),
(48, 3, 'Nguyễn Văn B', 've@gmail.com', '0123456789', 'Quảng Nam', 17000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-22 04:43:49', '2025-04-22 04:44:33'),
(49, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 1000000.00, 'cod', 'Chờ xác nhận', NULL, '2025-04-24 06:30:16', '2025-04-24 06:30:16'),
(50, 1, 'nguyễn minh lĩnh', 'linhclear@gmail.com', '0337263708', 'Tiên Phong, Tiên Phước, Quảng Nam', 1000000.00, 'vnpay', 'Thanh toán thành công', NULL, '2025-04-24 06:30:42', '2025-04-24 06:33:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ten_sanpham` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giasp` decimal(15,2) NOT NULL,
  `tongtien` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `ten_sanpham`, `soluong`, `giasp`, `tongtien`, `created_at`, `updated_at`) VALUES
(2, 9, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 02:06:19', '2025-04-21 02:06:19'),
(3, 10, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 2, 17000000.00, 34000000.00, '2025-04-21 02:12:45', '2025-04-21 02:12:45'),
(5, 15, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 04:32:42', '2025-04-21 04:32:42'),
(6, 16, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 04:35:59', '2025-04-21 04:35:59'),
(7, 17, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 04:41:06', '2025-04-21 04:41:06'),
(8, 18, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 04:43:52', '2025-04-21 04:43:52'),
(9, 19, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 04:47:15', '2025-04-21 04:47:15'),
(10, 20, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 04:55:06', '2025-04-21 04:55:06'),
(11, 21, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 04:58:53', '2025-04-21 04:58:53'),
(12, 22, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 05:00:49', '2025-04-21 05:00:49'),
(13, 23, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 05:15:33', '2025-04-21 05:15:33'),
(14, 24, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 05:18:45', '2025-04-21 05:18:45'),
(15, 25, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 05:24:08', '2025-04-21 05:24:08'),
(16, 26, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 17:46:11', '2025-04-21 17:46:11'),
(17, 27, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 17:49:21', '2025-04-21 17:49:21'),
(18, 28, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 17:55:27', '2025-04-21 17:55:27'),
(19, 29, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 17:57:59', '2025-04-21 17:57:59'),
(20, 30, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 18:00:50', '2025-04-21 18:00:50'),
(21, 31, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 18:01:54', '2025-04-21 18:01:54'),
(22, 32, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 18:02:32', '2025-04-21 18:02:32'),
(23, 33, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 18:03:45', '2025-04-21 18:03:45'),
(24, 34, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-21 18:04:24', '2025-04-21 18:04:24'),
(25, 35, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 18:05:13', '2025-04-21 18:05:13'),
(26, 36, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-21 18:06:12', '2025-04-21 18:06:12'),
(27, 37, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 03:28:11', '2025-04-22 03:28:11'),
(28, 38, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 03:28:35', '2025-04-22 03:28:35'),
(29, 39, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-22 03:49:15', '2025-04-22 03:49:15'),
(30, 40, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 03:53:36', '2025-04-22 03:53:36'),
(31, 41, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:14:06', '2025-04-22 04:14:06'),
(32, 42, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:18:49', '2025-04-22 04:18:49'),
(33, 43, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:22:20', '2025-04-22 04:22:20'),
(34, 44, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:32:05', '2025-04-22 04:32:05'),
(35, 45, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:36:10', '2025-04-22 04:36:10'),
(36, 46, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:38:25', '2025-04-22 04:38:25'),
(37, 47, 1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 1, 16000000.00, 16000000.00, '2025-04-22 04:43:13', '2025-04-22 04:43:13'),
(38, 48, 2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 1, 17000000.00, 17000000.00, '2025-04-22 04:43:49', '2025-04-22 04:43:49'),
(39, 49, 22, 'Nhang Trầm Hương Không Tăm Thường', 1, 1000000.00, 1000000.00, '2025-04-24 06:30:16', '2025-04-24 06:30:16'),
(40, 50, 24, 'NHANG SÀO TRẦM HƯƠNG TIÊN PHƯỚC', 1, 1000000.00, 1000000.00, '2025-04-24 06:30:42', '2025-04-24 06:30:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_sanpham` varchar(255) NOT NULL,
  `giasp` decimal(15,2) NOT NULL,
  `danhmuc_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `ten_sanpham`, `giasp`, `danhmuc_id`, `img`, `mota`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vòng Tay Trầm Hương Thiên Nhiên 10 li', 16000000.00, 1, 'uploads/f90kLzps1eYKt89Yw8BbRSm8zgOZlLO9eUUBfTSl.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thê hệ tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại.\"', 1, '2025-04-21 01:49:12', '2025-04-21 01:49:12'),
(2, 'Vòng Tay Đốt Trúc Nam - InĐo Chìm Nước', 17000000.00, 1, 'uploads/vgyf4AMGFwdiSbe5gDg97D014CnnjaXQRZtSlnQi.jpg', '- Vòng Tay Trầm INDO Chìm Nước 100% Tự Nhiên - Hương thơm tự nhiên, thơm đậm, thơm vĩnh viễn - Chuỗi Trầm Hương Bạn có thể đeo tay rất sang trọng - Cam Kết hàng thiên nhiên 100% - Bảo hành mùi hương và xâu vòng vĩnh viễn - Chuỗi Trầm chìm từng viên, có thể test Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình.\"\"', 1, '2025-04-21 01:49:35', '2025-04-21 01:49:35'),
(3, 'Vòng Tay Trầm Hương Chìm - INDO', 18000000.00, 1, 'uploads/6jqZRtKS45FRQfATpCeOq5LmFIYLr4vTwVObugNE.jpg', '- Vòng Tay Trầm INDO Chìm Nước 100% Tự Nhiên - Hương thơm tự nhiên, thơm đậm, thơm vĩnh viễn - Chuỗi Trầm Hương Bạn có thể đeo tay rất sang trọng - Cam Kết hàng thiên nhiên 100% - Bảo hành mùi hương và xâu vòng vĩnh viễn - Chuỗi Trầm chìm từng viên, có thể test Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 05:36:45', '2025-04-24 05:36:45'),
(4, 'Vòng Tay Trầm Hương Nữ 6ly - chìm nước', 21000000.00, 1, 'uploads/uZF2vmvsr6HdCbGweUNqIIefaxRxWwMG4bLh0H4F.jpg', '- Vòng Tay Trầm INDO Chìm Nước 100% Tự Nhiên - Hương thơm tự nhiên, thơm đậm, thơm vĩnh viễn - bi vàng 18k - Chuỗi Trầm Hương Bạn có thể đeo tay rất sang trọng - Cam Kết hàng thiên nhiên 100% - Bảo hành mùi hương và xâu vòng vĩnh viễn - Chuỗi Trầm chìm từng viên, có thể test Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thê hệ tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại.\"', 1, '2025-04-24 05:37:08', '2025-04-24 05:37:08'),
(5, 'VÒNG TAY TRẦM HƯƠNG VIỆT NAM MIX TỲ HƯU VÀNG 24K', 32000000.00, 1, 'uploads/90pgqb4fIHZaxaMp6gzyBN8xzq8so1T1coXH4ZTV.jpg', 'Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi. Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thê hệ tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại.\"', 1, '2025-04-24 05:37:39', '2025-04-24 05:37:39'),
(6, 'Chuỗi Hạt Trầm Hương 108 Hạt - Malaysia', 16000000.00, 1, 'uploads/GXW1qchAiPmK0oKkgYJmN15tjBtV60hTj3aRLBkO.jpg', 'Mỗi hạt trầm hương, trong chuỗi 108 hạt, không chỉ là nguồn hương thơm dịu dàng, mà còn là biểu tượng của sự linh thiêng và tinh khiết. Trầm hương, từ lâu đã là biểu tượng của sự thanh tịnh và tâm hồn, mang lại không gian bình yên và giảm căng thẳng. Số 108, trong văn hóa đông Á, đại diện cho sự hoàn hảo và kết nối với vũ trụ. Chuỗi hạt này không chỉ là sản phẩm thủ công tinh tế mà còn là hành trình kết nối toàn diện với thế giới xung quanh, mang đến sự cân bằng và hài hòa cho cuộc sống. Chuỗi hạt trầm hương 108 hạt được kết từ 108 hạt trầm hương có kích thước 6mm, Vòng trầm có tuổi tích trầm lên đến hơn 35 năm nên có lượng tinh dầu khá nhiều và đen, tỏa ra hương thơm rõ có vị thanh xen lẫn vị ngọt nhẹ rất thoải mái khi hít vào hương thơm từ linh khí trời đất khiến bạn nhớ mãi mùi hương quyến rũ ấy. Thông Tin Chi Tiết: Hương thơm: Hương thơm dịu ngọt Xuất xứ: Trầm hương Malaysia Kích Thước: 6mm\"', 1, '2025-04-24 05:38:36', '2025-04-24 05:38:36'),
(7, 'VÒNG TAY TRẦM HƯƠNG ĐỐT TRÚC BỘC VÀNG 18K', 26000000.00, 1, 'uploads/DDRmINMZi4HygHgaHtL1USKEoFlLaawnZfsGaxlR.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căng thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 05:39:11', '2025-04-24 05:39:11'),
(8, 'Chuỗi Hạt Trầm Hương Mix sen vàng 24k 6li', 17000000.00, 1, 'uploads/wVm7PYSzWXltf9BKfc43lRKsNw04snBRsgQS6s1A.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căng thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 05:39:41', '2025-04-24 05:39:41'),
(9, 'Phật Bản Mệnh: PHẬT QUAN ÂM BỒ TÁT', 15000000.00, 2, 'uploads/B5kmaJjPpXyEWlhyvBFL0tSIRTpzc8lNgzfW9oYQ.jpg', 'Mặt Dây Chuyền Trầm Hương Quan Thế Âm Bồ Tát là một kiệt tác nghệ thuật và tâm linh, nơi sự tinh tế và linh thiêng hòa quyện. Được điêu khắc tỉ mĩ với hình ảnh của Phật Quan Thế Âm Bồ Tát, mỗi chiếc dây chuyền là một biểu tượng của lòng nhân ái và sự bảo vệ. Chế tác từ trầm hương chìm nước, sản phẩm mang đến không chỉ một hương thơm ngọt ngào mà còn là sự kết hợp hoàn hảo giữa vẻ đẹp nghệ thuật và giá trị tâm linh. Cho dù bạn là người yêu trang sức hay đang tìm kiếm một món quà ý nghĩa, Mặt Dây Chuyền Trầm Hương Quan Thế Âm Bồ Tát là sự lựa chọn tuyệt vời để tận hưởng vẻ đẹp và tinh tế mỗi ngày. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 40mm Chiều Rộng: Rộng 26mm Trọng Lượng: ~8,7g Móc Vàng: Vàng 18k\"', 1, '2025-04-24 05:40:46', '2025-04-24 05:40:46'),
(10, 'Phật Bản Mệnh: ĐIÊU kHẮC TUỔI MÃO', 13000000.00, 2, 'uploads/6X7UgiiM48E4cnvPTxyG8jL5c7p59yKEZ83VWOEp.jpg', 'Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 40mm Chiều Rộng: Rộng 26mm Trọng Lượng: ~8,7g Móc Vàng: Vàng 18k Hạt trầm hương tự nhiên, mỗi viên như một tinh túy của sức sống, phát ra hương thơm ngọt ngào, kích thích giác quan và tạo nên không gian bình yên. Hình ngọn núi vươn cao, biểu tượng cho sức mạnh và kiên nhẫn, tạo nên sự cân bằng hoàn hảo giữa thiên nhiên và tâm linh.\"', 1, '2025-04-24 05:42:00', '2025-04-24 05:42:00'),
(11, 'Phật Bản Mệnh: ĐIÊU KHẮC TUỔI NGỌ', 13000000.00, 2, 'uploads/0rVlIYzUSTrRnlptD8Dnrlnp4tgN3VEwXnOK0AWW.jpg', 'Hạt trầm hương tự nhiên, mỗi viên như một tinh túy của sức sống, phát ra hương thơm ngọt ngào, kích thích giác quan và tạo nên không gian bình yên. Hình ngọn núi vươn cao, biểu tượng cho sức mạnh và kiên nhẫn, tạo nên sự cân bằng hoàn hảo giữa thiên nhiên và tâm linh. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 45mm Chiều Rộng: Rộng 34mm Trọng Lượng: ~7.3 Vàng: Vàng 18k\"', 1, '2025-04-24 05:42:39', '2025-04-24 05:42:39'),
(12, 'Phật Bản Mệnh: ĐIÊU KHẮC PHẬT DI LẶC', 15000000.00, 2, 'uploads/jcL2O9z6oCPnwBwynUbsLip482jPLtELOFSW4J1Q.jpg', 'Trong Mặt Dây Chuyền Trầm Hương Tạc Tượng Phật Di Lạc, sự kết hợp tinh tế giữa hương thơm trầm hương và hình tượng Phật Di Lạc không chỉ mang đến vẻ đẹp nghệ thuật mà còn chứa đựng những ý nghĩa tâm linh và sức khỏe tích cực. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 54mm Chiều Rộng: Rộng 22mm Trọng Lượng: ~ 9.5g Vàng: Vàng 18k\"', 1, '2025-04-24 05:43:11', '2025-04-24 05:43:11'),
(13, 'Phật Bản Mệnh: ĐIÊU KHẮC TUỔI TÝ', 13000000.00, 2, 'uploads/bS2Lr45b41z6smfrSahBUMXK7aLBcURkcV4vQAjQ.jpg', 'Hạt trầm hương tự nhiên, mỗi viên như một tinh túy của sức sống, phát ra hương thơm ngọt ngào, kích thích giác quan và tạo nên không gian bình yên. Hình ngọn núi vươn cao, biểu tượng cho sức mạnh và kiên nhẫn, tạo nên sự cân bằng hoàn hảo giữa thiên nhiên và tâm linh. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 45mm Chiều Rộng: Rộng 34mm Trọng Lượng: ~7.3 Vàng: Vàng 18k\"', 1, '2025-04-24 05:43:41', '2025-04-24 05:43:41'),
(14, 'Phật Bản Mệnh: ĐIÊU KHẮC TUỔI DẬU', 13000000.00, 2, 'uploads/R34ksvdOmDWiTVC6G9jRsanubOJwINI69YvzM4vX.jpg', 'Hạt trầm hương tự nhiên, mỗi viên như một tinh túy của sức sống, phát ra hương thơm ngọt ngào, kích thích giác quan và tạo nên không gian bình yên. Hình ngọn núi vươn cao, biểu tượng cho sức mạnh và kiên nhẫn, tạo nên sự cân bằng hoàn hảo giữa thiên nhiên và tâm linh. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 45mm Chiều Rộng: Rộng 34mm Trọng Lượng: ~7.3 Vàng: Vàng 18k\"', 1, '2025-04-24 05:44:12', '2025-04-24 05:44:12'),
(15, 'Phật Bản Mệnh: TUỔI SỬU VÀ TUỔI DẦN', 13000000.00, 2, 'uploads/uotRJmv7tbS76iF8VwkURNpwNiLD7V6WncmgHQwc.jpg', 'Hạt trầm hương tự nhiên, mỗi viên như một tinh túy của sức sống, phát ra hương thơm ngọt ngào, kích thích giác quan và tạo nên không gian bình yên. Hình ngọn núi vươn cao, biểu tượng cho sức mạnh và kiên nhẫn, tạo nên sự cân bằng hoàn hảo giữa thiên nhiên và tâm linh. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 45mm Chiều Rộng: Rộng 34mm Trọng Lượng: ~7.3 Vàng: Vàng 18k\"', 1, '2025-04-24 05:44:50', '2025-04-24 05:44:50'),
(16, 'Phật Bản Mệnh: PHẬT TUỔI TUẤT VÀ TUỔI HỢI', 13000000.00, 2, 'uploads/jc2dlTAL3sF07Y07AFYbROhHIRKcYejA79TYLrZj.jpg', 'Hạt trầm hương tự nhiên, mỗi viên như một tinh túy của sức sống, phát ra hương thơm ngọt ngào, kích thích giác quan và tạo nên không gian bình yên. Hình ngọn núi vươn cao, biểu tượng cho sức mạnh và kiên nhẫn, tạo nên sự cân bằng hoàn hảo giữa thiên nhiên và tâm linh. Thông Tin Chi Tiết: Hương Thơm: Mùi thơm ngọt dịu nhẹ Chất Liệu: Trầm hương chìm nước Xuất Xứ: Trầm Hương Indonesia Chiều Cao: Cao 45mm Chiều Rộng: Rộng 34mm Trọng Lượng: ~7.3 Vàng: Vàng 18k\"', 1, '2025-04-24 05:46:18', '2025-04-24 05:46:18'),
(17, 'Trầm Hương Nụ Thượng Hạng - Premium - 100% Thiên Nhiên', 5000000.00, 3, 'uploads/xXMsXu0fTjTJdikzSwmiDZXLc36RHWoqEkCegiwC.png', '\"Nhang nụ trầm hương thượng hạng - tinh hoa từ thiên nhiên, mang đến cho bạn không gian sống thư thái, an lành. Với thành phần 100% trầm hương tự nhiên, sản phẩm mang đến hương thơm ấm áp, ngọt ngào, giúp bạn thư giãn, giảm stress hiệu quả. Không chỉ vậy, trầm hương còn có nhiều công dụng tuyệt vời như cải thiện giấc ngủ, tăng cường sức khỏe, mang lại may mắn và tài lộc. Hãy để hương trầm đưa bạn đến một thế giới yên bình, nơi bạn có thể tận hưởng những giây phút thư giãn tuyệt vời nhất.\" Thông tin chi tiết: Thành Phần: 99% trầm hương tự nhiên, 1% keo bời lời tự nhiên. Nguồn Gốc: Trầm Hương Việt Nam Số Lượng: 30 viên. Thời Gian Cháy: ~ 25 phút. Hương Thơm: Dịu ngọt, lưu hương lâu. Cam Kết: Đổi trả miễn phí toàn quốc nếu mùi hương không thơm hoặc sản phẩm lỗi,không hài lòng Quý Khách hoàn tiền 100%\"', 1, '2025-04-24 05:47:17', '2025-04-24 05:47:17'),
(18, 'Nhang Nụ Trầm Hương Thượng Hạng', 4000000.00, 3, 'uploads/TuA04soBf1x0tFxtwTU6cd28B6ZaFlMkc3wHNhWh.png', 'Bạn đã bao giờ thử mùi hương nào có vị ngọt chưa ? Đặc Biệt Nụ Thượng Hạng có hương thơm dịu ngọt sâu, có vị ngọt khựng lại ở cổ, có nhiều tác dụng cho sức khỏe như giảm stress, an thần, tịnh tâm, lợi cho sức khỏe và đồng thời giú thanh lọc không khí, tẩy uế, trừ tà không gian ở của bạn giúp tăng vượng khí đem lại sự may mắn cho gia chủ khi sử dụng. Nên trầm nụ thích hợp sử dụng trong thờ cúng ông bà, dâng lên tổ tiên, dốt trong các dịp lễ tết, lê hội tôn giao hay dùng trong xông nhà, cửa hàng sắp khai trương TRầm nụ thích hợp dùng cho những cuộc họp, trà đạo, ngồi thiền.....\"', 1, '2025-04-24 05:47:51', '2025-04-24 05:47:51'),
(19, 'Trầm Nụ Cao Cấp Cho Thác Khói TIÊN PHƯỚC', 3000000.00, 3, 'uploads/6LAeA1O5aXmvbKwDfgTFHvRGnus6kKQiZje83k4f.jpg', 'Nhang Trầm nụ thác khói Trầm hương là sản phẩm được làm từ 100% tự nhiên nên rất tốt cho sức khỏe. Gọi là trầm nụ bởi hình dáng của viên hương giống như một nụ sen hoặc nụ hồng chưa nở. Cấu tạo của trầm nụ bên dưới có đục lỗ để khói có thể chảy ngược xuống nên khi kết hợp Thác khói ta có thể chiêm ngưỡng vẽ đẹp dòng khói chảy xuống nhẹ nhàng huyền ảo , mùi hương Trầm dịu ngọt. Giup tinh thần thư giãn Lưu hương rất lâu nên có khả năng CHIÊU TÀI – DẪN LỘC mang lại may mắn, thuận lợi trong việc mua bán kinh doanh, và theo phong thủy thì cần bằng năng lượng dương rất tốt cho phong thủy ngôi nhà của bạn. Số Lượng : 30 viên Trọng Lượng : ~ 52 gam Thời Gian cháy : 15 phút ~ 20 phút Thành Phần : Bột trầm hương nguyên chất, keo bời lời tự nhiên, nước sạch. Xuất Sứ : Việt nam\"\"', 1, '2025-04-24 05:48:18', '2025-04-24 05:48:46'),
(20, 'NHANG VÒNG TRẦM HƯƠNG CAO CẤP 18H', 2000000.00, 3, 'uploads/4mWzLh91eNUIhzfZy3F8HUQmM4geelIxAloLqIk7.jpg', 'NHANG VÒNG TRẦM HƯƠNG CAO CẤP 18H\r\nSố Lượng: 10 Vòng\r\nTrọng Lượng: ~350 GAM\r\nThời Gian cháy: 18 giờ Thành Phần: Bột trầm hương nguyên chất, keo bời lời tự nhiên, nước sạch.\r\nXuất Sứ: Việt nam\"\"', 1, '2025-04-24 05:49:18', '2025-04-24 05:49:18'),
(21, 'NHANG VÒNG TRẦM HƯƠNG-LOẠI LỚN 12H', 1000000.00, 3, 'uploads/5d29rkOoXIJ9kbyiVEP2wf5QeI19t0ju3uIzY1Qu.jpg', 'NHANG TRẦM KHOANH 12H\r\n\r\n\r\nSố Lượng: 10 Vòng\r\nTrọng Lượng: ~250 gam\r\nThời Gian cháy: 12 giờ Thành Phần: Bột trầm hương nguyên chất, keo bời lời tự nhiên, nước sạch.\r\nXuất Sứ: Việt nam\"\"', 1, '2025-04-24 05:49:47', '2025-04-24 05:49:47'),
(22, 'Nhang Trầm Hương Không Tăm Thường', 1000000.00, 3, 'uploads/IQben0jRh2FXVdrNri7wktkaL9HEJ7wxmssnokPd.jpg', 'Nhang trầm hương không tăm được sử dụng phổ biến trong thiền định, yoga, trà đạo, bởi mùi hương ngọt ngào, dễ chịu của nó giúp thư giãn tinh thần, tăng cường sự tập trung, giúp người tập dễ dàng đạt trạng thái thiền định, tập trung cao độ.\r\nTrong thiền định, nhang trầm hương không tăm giúp tạo ra bầu không khí tĩnh lặng, thư thái, giúp người tập dễ dàng thả lỏng cơ thể, tâm trí, tập trung vào hơi thở, từ đó đạt được trạng thái thiền định.\r\nTrong yoga, nhang trầm hương không tăm giúp tạo ra bầu không khí thanh lọc, thư thái, giúp người tập dễ dàng tập luyện, nâng cao hiệu quả tập luyện. Trong trà đạo, nhang trầm hương không tăm giúp nâng cao hương vị của trà, tạo ra bầu không khí thưởng trà tao nhã, tinh tế. Q', 1, '2025-04-24 05:50:15', '2025-04-24 05:50:15'),
(23, 'Nhang Trầm Hương Không Tăm Cao Cấp', 2000000.00, 3, 'uploads/NZuj9VYvseNhSxsCoFLhV8NphlN8Kxee5iNOm4lR.jpg', 'Nhang trầm hương không tăm được sử dụng phổ biến trong thiền định, yoga, trà đạo, bởi mùi hương ngọt ngào, dễ chịu của nó giúp thư giãn tinh thần, tăng cường sự tập trung, giúp người tập dễ dàng đạt trạng thái thiền định, tập trung cao độ. Trong thiền định, nhang trầm hương không tăm giúp tạo ra bầu không khí tĩnh lặng, thư thái, giúp người tập dễ dàng thả lỏng cơ thể, tâm trí, tập trung vào hơi thở, từ đó đạt được trạng thái thiền định. Trong yoga, nhang trầm hương không tăm giúp tạo ra bầu không khí thanh lọc, thư thái, giúp người tập dễ dàng tập luyện, nâng cao hiệu quả tập luyện. Trong trà đạo, nhang trầm hương không tăm giúp nâng cao hương vị của trà, tạo ra bầu không khí thưởng trà tao nhã, tinh tế. Quy cách đóng gói: -Nhang Trầm Hương Không Tăm Hộp 100 Nén trầm không tăm cao cấp - Hộp Gỗ Hương 2 Ngăn Hộp 100 Nén trầm không tăm cao cấp Tích hợp hộp đốt tiện lợi\"', 1, '2025-04-24 05:50:41', '2025-04-24 05:50:41'),
(24, 'NHANG SÀO TRẦM HƯƠNG TIÊN PHƯỚC', 1000000.00, 3, 'uploads/dt6HeMi6TpDfVYa8tS3m5HtBosWa1jR0QFULQmaU.jpg', 'Nhang sào là dòng sản phẩm có ưu điểm nổi trội nhất đó là\r\nthời gian cháy dài từ 7,5 giờ đến 8 giờ vì được sản xuất với\r\nkết cấu cây to nhiều lớp rất thích hợp đốt trong những nghi lễ lớn\r\nhoặc ngày tết và mong muốn thưởng thức mùi hương trầm lâu hơn.\"\"', 1, '2025-04-24 05:51:05', '2025-04-24 05:51:05'),
(25, 'Bột trầm nguyên chất kiến kim tự nhiên (LOẠI CAO CẤP)', 1000000.00, 3, 'uploads/vYIo0NfSnTIy3iRtpmaBuPd35eOgWW2sMthoH6iO.jpg', 'Trọng Lượng: 100g\r\n\r\n\r\nThành Phần: Bột trầm nguyên chất\r\n\r\nThương hiệu: Trầm hương Tiên Phước\r\n\r\nNguồn gốc: Quảng Nam\"', 1, '2025-04-24 05:51:50', '2025-04-24 05:51:50'),
(26, 'Trầm hương nụ cao cấp Tiên Phước', 1000000.00, 3, 'uploads/ijzfjex18gykWYDhlQHGYG5OmpfcGMxtmjuhB4Xk.jpg', 'Số Lượng: 100 viên\r\nTrọng Lượng: ~ 115 gam\r\nThời Gian cháy: 15 phút ~ 20 phút\r\nThành Phần: Bột trầm hương nguyên chất, keo bời lời tự nhiên, nước sạch.\r\nXuất Sứ: Việt Nam\r\n\r\nMột số dụng đốt nụ trầm hương cao cấp bạn có thể quan tâm:\r\n- Kỳ lân xông trầm bằng gỗ muồng\r\n- Lư đốt trầm hương bằng gỗ hương nắp đồng\"', 1, '2025-04-24 05:52:28', '2025-04-24 05:52:28'),
(27, 'Nụ trầm Kiến kim rừng tự nhiên loại đặt biệt', 2000000.00, 3, 'uploads/4Pyy0d80Tp2FXAN4pGC6hgaah4NkRws8LizBS0Lc.jpg', 'là sản phẩm mang đậm bản sắc văn hóa Việt Nam. Sản phẩm không chỉ mang lại hương thơm thiên nhiên, an lành cho tâm hồn mà còn thể hiện sự tinh tế, chu đáo của người tặng.\r\nVới thành phần 100% trầm hương tự nhiên, sản phẩm có hương thơm dịu ngọt, thanh mát, giúp thư giãn tinh thần, xua tan mệt mỏi. Thời gian cháy lâu (khoảng 60 phút) giúp tiết kiệm thời gian và chi phí. Mẫu mã đẹp mắt, sang trọng, thích hợp để làm quà tặng.\r\nLựa chọn hộp quà tặng trầm vân mây là lựa chọn hoàn hảo để dành tặng cho người thân, bạn bè, đối tác trong các dịp lễ Tết, tân gia, khai trương,... Sản phẩm chắc chắn sẽ mang lại sự hài lòng cho người nhận.\"', 1, '2025-04-24 05:53:04', '2025-04-24 05:53:04'),
(28, 'Nhang có tăm- nhang trầm hương thiên nhiên sạch', 2000000.00, 3, 'uploads/4cfzDreYH5Y9pIJc3biQRXzFOFCbfNCPOtFYGhad.jpg', 'là sản phẩm mang đậm bản sắc văn hóa Việt Nam. Sản phẩm không chỉ mang lại hương thơm thiên nhiên, an lành cho tâm hồn mà còn thể hiện sự tinh tế, chu đáo của người tặng.\r\nVới thành phần 100% trầm hương tự nhiên, sản phẩm có hương thơm dịu ngọt, thanh mát, giúp thư giãn tinh thần, xua tan mệt mỏi. Thời gian cháy lâu (khoảng 60 phút) giúp tiết kiệm thời gian và chi phí. Mẫu mã đẹp mắt, sang trọng, thích hợp để làm quà tặng.\r\nLựa chọn hộp quà tặng trầm vân mây là lựa chọn hoàn hảo để dành tặng cho người thân, bạn bè, đối tác trong các dịp lễ Tết, tân gia, khai trương,... Sản phẩm chắc chắn sẽ mang lại sự hài lòng cho người nhận.\"\"', 1, '2025-04-24 05:53:44', '2025-04-24 05:53:44'),
(29, 'BỘT TRẦM HƯƠNG THIÊN NHIÊN', 1000000.00, 3, 'uploads/U3mT7GXxe4267ZbNrPWD0fxnIPymG9tUc0KAcnph.jpg', 'BỘT TRẦM HƯƠNG TỰ NHIÊN\r\nTrọng Lượng: 50gr - 100gr\r\nThành Phần: Bột trầm nguyên chất\r\nThương hiệu: Trầm hương Tiên Phước\r\nNguồn gốc: Quảng Nam\r\nCÔNG DỤNG: Dùng đẻ xông nhà, khử nùi hôi khó chịu, mùi thức ăn, mùi thuốc lá, sơn ẩm mốc\r\n- Tẩy uế xua đuổi khí xấu phong long.... tốt cho phong thủy tâm linh\r\n- Gia tăng năng lượng tài lộc có khả năng lưu hương lâu\r\nCÁCH DÙNG:\r\n- cho 3 - 5g bột vào lư xông trầm, chén, khây nhôm... theo hình chóp núi. đốt trực tiếp lên bè mặt bột rồi để hương lan tỏa\r\n- Dùng lò xông trầm điện cho bột vào khây nhôm cắm ddienj để hương lan tảo\"', 1, '2025-04-24 05:54:23', '2025-04-24 05:54:23'),
(30, 'Nhang Trầm Hương Thượng Hạng 40cm', 1000000.00, 3, 'uploads/12C84qKvYmVw7WZbyuuI6SjpRTaV3EdD6KS8Qan6.jpg', 'Nhang Trầm hương có tăm là một trong những sản phẩm phổ biến nhất hiện nay và gắn liền với đời sống tâm linh của người việt nam nói riêng và thế giới nói chung . Việc thắp hương hằng ngày trong mỗi gia đình, hoặc vào dịp lễ tết, cúng giỗ, thần tài thổ địa, các nghi lễ ... Là một văn hóa có từ rất lâu đời của người việt nam.\r\n\r\n\r\nSố Lượng : 650 cây - Chân Tâm đỏ\r\nTrọng Lượng : 500g\r\nKích Thước : 30 cm\r\nThời Gian cháy : ~40 phút\r\nThành Phần : Bột Trầm hương nguyên chất, Keo bời lời tự nhiên, Tăm tre, Nước sạch\r\nThương hiệu : TRẦM HƯƠNG TIÊN PHƯỚC\"', 1, '2025-04-24 05:55:18', '2025-04-24 05:55:18'),
(31, 'Nụ trầm hương đặt biệt cao cấp loại 1', 1000000.00, 3, 'uploads/rzqtg14xLwGx7lQJ8jQcmC3uSYkSMkyW8ZVv0GTL.jpg', 'Nụ trầm kiến kim tự nhiên vip, nguyên chất 100% trầm hương không hóa chất được làm từ những miếng trầm đã được tỉa sạch chỉ còn lại dầu trầm , mùi thơm ngọt hậu, đậm sâu, vương vấn khó quên.\r\nCông dụng của việc đốt trầm hương:\r\n– Tẩy ô uế và xua đuổi đi tà khí, thu hút vượng khí cho gia đình.\r\n– Làm sạch không khí ô nhiễm, khử độc mùi hôi và những mùi ẩm mốc.\r\n– Trầm với mùi hương dịu nhẹ thế nên việc xông trầm sẽ giúp an thần, thư giãn đầu óc thoải mái và dễ chịu hơn sau những giờ học tập và làm việc căng thẳng.\r\n– Sử dụng trầm hương giúp thu hút tài lộc, may mắn trong kinh doanh, xông tẩy nhà cửa cho gia chủ.\r\n- Nụ trầm: 35 nụ/hộp\"', 1, '2025-04-24 05:55:48', '2025-04-24 05:55:48'),
(32, 'Bột Trầm Hương Nguyên Chất( Loại phổ thông)', 1000000.00, 3, 'uploads/kqwIkmhSoFseUKhAm9FBc6I5qOCW6CW0o2OPw2AC.jpg', '- Miêu tả: Bột trầm hương VIP từ trầm kiến rừng tự nhiên nguyên miếng đã tỉa bỏ sạch phần dó trắng và xay thành bột ;\r\n- Cách dùng: Đốt bằng dĩa, các dụng cụ thưởng trầm hoặc xông lư điện, Sử dụng làm nụ, nhang trầm loại đặt biệt ;\r\n- Trọng lượng: 100gr\r\n- Giá: 500.000 dong\r\n- Công dụng: Thư giãn tinh thần, giảm căng thẳng, thu hút tài lộc, may mắn...\r\n- Thường dùng để thưởng thức, làm quà biếu tặng sang trọng\"\"', 1, '2025-04-24 05:56:26', '2025-04-24 05:57:23'),
(33, 'Thác Khói Phật Di Lạc Hồ Lô - Lớn', 13000000.00, 4, 'uploads/8oiRVsxZjVZV466f5QAPxgD4P87b6WCCiWN3iGzL.jpg', 'Thác khói di lạc hồ lô siaze lớn\r\nChất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sangtrọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẽ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"\"\"', 1, '2025-04-24 05:58:43', '2025-04-24 06:25:48'),
(34, 'Thác Khói Di Lạc dang tay đèn led', 13000000.00, 4, 'uploads/l5lzvymXgyodBsoHSzi8I9GNe1Fg83fW751LSaI5.jpg', 'Thác khói di lạc đèn led\r\nChất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 47cm rộng 30cm\r\nBộ thác khói gồm có:\r\n+ 1 đèn led\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sang trọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẽ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"', 1, '2025-04-24 05:59:18', '2025-04-24 05:59:18'),
(35, 'Thác khói trầm hương cao cấp Phật Di Lặc chiêu tài', 15000000.00, 4, 'uploads/BPxsjtnRTRnKwYa8iLmrDIDbBCndRlgpK15wXbbg.jpg', 'Thác khói di lạc\r\nChất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sang trọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẻ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc b', 1, '2025-04-24 06:00:18', '2025-04-24 06:00:18'),
(36, 'Tiểu Cảnh Phật Quan Âm Bồ Tát Tài Lộc', 15000000.00, 4, 'uploads/hoBBBd4gcZNAg5Yb2gub4kEXia5Jugca8b6xYk4L.jpg', 'Thác khói di lạc\r\nChất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sangtrọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẽ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"', 1, '2025-04-24 06:01:30', '2025-04-24 06:01:30'),
(37, 'Thác Khói Phật Quan Thế Âm - Bồ Tát', 16000000.00, 4, 'uploads/hcCVhjxLKE3oWzqTbhdbxA3Ax6ocP2HeRpMaH9LV.jpg', 'Chất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sang trọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẻ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"\"', 1, '2025-04-24 06:02:20', '2025-04-24 06:02:20'),
(38, 'Thác Nước Phong Thủy Tượng Phật Di Lặc', 13000000.00, 4, 'uploads/YVK6qCZINcqHeM7PJvJUXFGG87XR6zPgCBAfC4Gb.jpg', 'Chất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sang trọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẻ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"', 1, '2025-04-24 06:02:54', '2025-04-24 06:02:54'),
(39, 'Thác nước phong thủy để bàn có Phật Di Lặc', 15000000.00, 4, 'uploads/fxyyzFUqKZne0qbG3qGoiE6NrTlqCNkC6l09Vjw9.jpg', 'Thác khói di lặc\r\nChất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sang trọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẻ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"', 1, '2025-04-24 06:03:18', '2025-04-24 06:03:18'),
(40, 'Thác khói trầm hương Công Decor Hà Nội', 17000000.00, 4, 'uploads/qxmNPemPeU7OVXMgcYyOTDh1oIAhtuXSTgLq8HuR.jpg', 'Chất liệu: Gốm Sứ\r\nXuất sứ: Trung Quốc\r\nKích thước: Cao 48cm rộng 46cm\r\nBộ thác khói gồm có:\r\n+ Bộ thác khói\r\n+ 1 đèn led lớn\r\n+ 1 đế gỗ\r\n+ 1 Phật Di lạc\r\n+ 1 máy bơm nước\r\n+ 1 máy phun sương\r\nThác Khói Di Lạc hẳn là 1 món quà sang trọng mà ai cũng muốn được nhận, hãy dành tặng cho người thân của bạn 1 món quà ý nghĩa nhất nhé. Không những mang vẻ đẹp tinh xảo mà còn mang lại cảm giác yên bình, có tiếng nước chảy của suối cao, có cây có lá, đặc biệt hơn hết có Vị Phật đang Ngồi Cười mang niềm vui tài lộc đến chúng ta\"', 1, '2025-04-24 06:03:44', '2025-04-24 06:03:44'),
(41, 'THÁC KHÓI - PHẬT NGỒI CUNG TRĂNG', 1000000.00, 4, 'uploads/nVve9DwmfyiFVUxmuoIFOuCaZJHNJfDOsJykLzls.jpg', 'Nếu đã mua Thác khói trầm hương Phật ngồi cung trăng thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\"', 1, '2025-04-24 06:05:06', '2025-04-24 06:05:06'),
(42, 'THÁC KHÓI - PHẬT BÀ TỌA SEN', 1000000.00, 4, 'uploads/pKGzIrV20YWh5sXYkpYVmKDeLbXTBmTrPqfR70Ec.jpg', 'Nếu đã mua Thác khói trầm hương Bồ Tát ngồi cung trăng thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\"', 1, '2025-04-24 06:05:47', '2025-04-24 06:05:47'),
(43, 'THÁC KHÓI - ĐÚC THEO MẪU DĨA RỒNG', 1000000.00, 4, 'uploads/w2OlqAQ5zduRkbWpBEnula9Y9Y9p691FYnWpxEIe.jpg', 'Thác khói đĩa rồng nhả ngọc là sản phẩm tinh tế được làm từ gốm tráng men. Sản phẩm phù hợp làm quà tặng hay dùng trang trí ở phòng làm việc phòng khách.\r\nKích thước đường kính: 20cm\r\nSản phẩm dùng cùng thác khói trầm hương đĩa rồng nhả ngọc:\r\n- Trầm hương nụ thác khói cao cấp\r\n- Trầm nụ thác khói thường\r\n\"', 1, '2025-04-24 06:06:50', '2025-04-24 06:06:50'),
(44, 'THÁC KHÓI - RỒNG NHÃ KHÓI', 1000000.00, 4, 'uploads/270ReE1wfIzCkD55pEpxMBH94rOyW5qTEFnxXTrt.jpg', 'Thác khói trầm hương Rồng nhã khói được làm bằng sứ tráng men, là một sản phẩm dùng để đốt nhang trầm nụ. Khi đốt sẽ tạo khói nhưng điều đặc biệt là khói sẽ không bay lên như bình thường mà theo rãnh đã được tạo sẵn từ thác khói chảy ngược từ trên cao như dòng thác\r\nNếu đã mua Thác khói trầm hương Rồng nhả khói thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\r\n\"', 1, '2025-04-24 06:07:22', '2025-04-24 06:07:22'),
(45, 'THÁC KHÓI - PHẬT BÀ ĐÈN LED', 1000000.00, 4, 'uploads/wQIexYg2JC9P6gf6Qpoi8EthfwxDX0uvulAS0Xn3.jpg', 'Nếu đã mua Thác khói trầm hương Bồ Tát Phổ Hiền (đèn LED) thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\r\n\"', 1, '2025-04-24 06:08:08', '2025-04-24 06:08:08'),
(46, 'THÁC KHÓI - PHẬT ÔNG ĐÈN LED', 1000000.00, 4, 'uploads/sZpO0H8wZZA2tKSaDsccbOoo5y9FyfB3mVGHIVwA.jpg', 'Nếu đã mua Thác khói trầm hương Phật A Di Đà (đèn LED) thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\r\n\"', 1, '2025-04-24 06:08:38', '2025-04-24 06:08:38'),
(47, 'THÁC KHÓI - PHẬT DI LẶC TRANG TRÍ ĐÈN LED', 1000000.00, 4, 'uploads/nRbZEhTB1vfqwthd78oCiKXpJdktQByg7sjDhNWp.jpg', 'Kích thước: 12cm x 10cm rất nhỏ gọn nên có thể để bất cứ ở đâu (phòng khách, phòng làm việc, bàn thờ gia tiên...)\r\nNếu đã mua Thác khói trầm hương Phật Di Lặc (đèn LED) thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\r\n\"', 1, '2025-04-24 06:09:19', '2025-04-24 06:10:48'),
(48, 'THÁC KHÓI - ĐÚC THEO MẪU BẢO LIÊN ĐĂNG', 1000000.00, 4, 'uploads/E2tOnBBHkQr3emnEnhEIYtBokzltiG0ih1jPi2vf.jpg', 'Kích thước: 26 x 13cm (dài x rộng) nhỏ gọn nên có thể để bất cứ ở đâu (phòng khách, phòng làm việc, bàn thờ gia tiên...)\r\nNếu đã mua Thác khói trầm hương Bảo Liên Đăng thì bạn không nên bỏ qua sản phẩm này:\r\n- Trầm hương nụ cao cấp cho thác khói\r\n- Trầm nụ thác khói thường\r\n>> Bạn thể xem các mẫu thác khói khác tại: Thác Khói Trầm hương\r\n\"', 1, '2025-04-24 06:09:59', '2025-04-24 06:09:59'),
(49, 'VÒNG TAY TRẦM HƯƠNG HẠT DẸP BI VÀNG', 27000000.00, 1, 'uploads/E0aqMgjC4ehx4TIFwmnVx7eCvkDVaZC2shiir7zz.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:12:58', '2025-04-24 06:12:58'),
(50, 'VÒNG TAY TRẦM HƯƠNG VIỆT NAM', 20000000.00, 1, 'uploads/cckTPytMgDir0bAOIR0VCSeGi6Wr8kWaEUuiTlyt.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:13:31', '2025-04-24 06:13:31'),
(51, 'VÒNG TAY TRẦM HƯƠNG VIỆT NAM 12LI', 23000000.00, 1, 'uploads/5WFgr8Qc4ORJJfAhjTRHK0T3fQDiEZNjV9PivgbH.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:14:01', '2025-04-24 06:14:01'),
(52, 'VÒNG TAY TRẦM HƯƠNG TIÊN PHƯỚC 14LI', 25000000.00, 1, 'uploads/83xNYSIMHjGngOGpdOXCNHCRJR5uBUlctsasns3I.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"\"', 1, '2025-04-24 06:14:33', '2025-04-24 06:14:33'),
(53, 'VÒNG TAY TRẦM HƯƠNG NỮ ĐỐT TRÚC', 27000000.00, 1, 'uploads/LPnaHVzUSBuJO6O1tVM7W9S50BK8fdCFjF0911XL.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:15:00', '2025-04-24 06:15:00'),
(54, 'VÒNG TAY NAM NỮ ĐỐT TRÚC BỘC VÀNG 9999', 36000000.00, 1, 'uploads/SzXLG3QxsTKZSdlfopqGKvYn40d3i5MRPvIbwd3d.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thê hệ tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:16:04', '2025-04-24 06:16:04'),
(55, 'VÒNG TAY TRẦM HƯƠNG TIÊN PHƯỚC VIP', 24000000.00, 1, 'uploads/2sjPBAaBxZGfK7E0iCblpiZovNAVLywZSG8neA1N.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:16:44', '2025-04-24 06:16:44'),
(56, 'VÒNG TAY TRẦM HƯƠNG THIÊN NHIÊN', 20000000.00, 1, 'uploads/0pWkTVRcJfByHi0OaVL6lZhejmrHelU87bisqz2g.jpg', 'Bạn rất cần một món quà vô cùng ý nghĩa, không kém phần sang trọng và đẳng cấp nhưng chi phí không nằm ngoài tầm tay của bạn. Hãy chọn vòng tay trầm hương món quà vô cùng ý nghĩa giúp bạn nói lên tất cả tình cảm của mình bằng cả tấm lòng đối với cha mẹ, người thân, sếp, đối tác, bạn bè hoặc mối quan hệ quan trọng đối với bạn và đặc biệt cho người ấy nhân ngày lễ tình nhân. Để gắn chặt tình đoàn kết, nuôi dưỡng các mối quan hệ, thể hiện tình cảm của mình đối với những người mình coi trọng, những người mình yêu thương. Và còn nhiều hơn thế nữa chỉ có người sở hữu mới cảm nhận hết được những điều tuyệt vời mà sản phẩm mang lại. Khi đeo vòng tay, chuỗi hạt trầm hương sẽ có mùi hương thoang thoảng, thơm vĩnh viễn, trầm hương có vị cay, đắng, tính ấm, hơi ngọt, làn khí giáng xuống, đẩy lùi các khí âm, tạp khí, trừ tà, tạo điều kiện cho tài khí và giúp thu hút năng lượng, dịu nhẹ sự căn thẳng thần kinh, giảm stress. Chính vì vậy bạn nên đeo VÒNG TAY – CHUỖI HẠT TRẦM HƯƠNG. vòng tay trầm hương không những mang lại sự sang trọng, may mắn mà còn mang lại tài lộc cho gia chủ, mùi hương luôn bên mình. Chính vì những công dụng tuyệt vời trên mà vòng tay trầm hương có giá trị cao và được nhiều người sử dụng rộng rãi.\"', 1, '2025-04-24 06:17:10', '2025-04-24 06:17:10'),
(57, 'VÒNG CỔ TRẦM HƯƠNG VIỆT NAM', 26000000.00, 1, 'uploads/QRoS6R7h4tjO9hILVpKxOT7k4QkQxmYg470tvARQ.jpg', '- sợi dây chuyền được nhập khẩu từ indo\r\n- đặc biệt hơn là mặt dây chuyền là hàng rừng việt nam\r\n- Với sự phối hợp hài hòa giữa các đốt trầm tạo nên một sản phẩm sang trọng, thời thượng\r\n- Hương thơm của sản phẩm có tác dụng kích thích não bộ, tăng khả năng sáng tạo, tư duy siêu hình\r\n- Sử dụng sản phẩm như một vật hộ thân để thu hút vận may\r\n- Đổi trả và hoàn tiền nếu sản phẩm bị lỗi\r\n\"', 1, '2025-04-24 06:17:38', '2025-04-24 06:17:38'),
(58, 'VÒNG TAY TRẦM HƯƠNG TIÊN PHƯỚC 015', 31000000.00, 1, 'uploads/p4XG3KfxiooXBktWMiuAinAn9YIxcj9iDh4IMzFP.jpg', '- Với sự phối hợp hài hòa giữa các đốt trầm và vàng 18k tạo nên một sản phẩm sang trọng, thời thượng\r\n- Hương thơm của sản phẩm có tác dụng kích thích não bộ, tăng khả năng sáng tạo, tư duy siêu hình\r\n- Sử dụng sản phẩm như một vật hộ thân để thu hút vận may\r\n- Đổi trả và hoàn tiền nếu sản phẩm bị lỗi\r\n\"\"', 1, '2025-04-24 06:18:05', '2025-04-24 06:18:05'),
(59, 'VÒNG TAY TRẦM HƯƠNG TIÊN PHƯỚC', 48000000.00, 1, 'uploads/agNnZpjFPl4o8fRMK8ZrScchRSI1cCy2cltn4nl7.jpg', '- Sản phẩm được kết hợp hòa giữa các khối hình chữ nhật, đốt trúc và vàng 18k\r\n- Đảm bảo vàng thật 100%\r\n- Mặt của vòng tay là hình logo của shop - Sản phẩm được thiết kế riêng chỉ có duy nhất 1 sợi\r\n\"', 1, '2025-04-24 06:19:58', '2025-04-24 06:19:58'),
(60, 'VÒNG TAY TRẦM HƯƠNG TIÊN PHƯỚC HẠT NHỎ', 16000000.00, 1, 'uploads/4cwcs6YsdHGvR73eddSK0bTghBewQuP5V8lUuI2E.jpg', '-Sản phẩm được làm từ 100% trầm hương thiên nhiên Indo.\r\n- Mùi hương vĩnh viễn.\r\n- Không gây dị ứng, ngứa.\r\n- Hoàn tiền 100% nếu sản phẩm sai sự thật.\r\n\"\"', 1, '2025-04-24 06:20:28', '2025-04-24 06:20:28'),
(61, 'VÒNG TRẦM INDO XEN KẺ HẠT TRẦM VÀ HẠT VÀNG', 29000000.00, 1, 'uploads/7I6RpkOWCXtJfhepxQt4CUBaWcX4OQ9lsjt9W1oz.jpg', 'Tên sản phẩm: Vòng trầm indo xen kẻ hạt trầm và hạt vàng\r\nLoại trầm: Trầm hương thiên nhiên\r\nLoại vàng: 18k\r\nXuất xứ: Quảng Nam\r\nGiá: 6.500.000 đồng\r\nCông dụng\r\n✔ Tránh tà ma.. hơi lạnh. Phong long.\r\n✔ Lá bùa hộ mệnh cho bản thân.\r\n✔ Thích hợp người yếu bóng vía.\r\n✔ Mang lại may mắn cho chủ nhân\r\n\"\"', 1, '2025-04-24 06:20:58', '2025-04-24 06:20:58'),
(62, 'VÒNG TAY TRẦM HƯƠNG THIÊN NHIÊN 12LY', 24000000.00, 1, 'uploads/e0CK37SNivGaR3AmnRQrqgCYxzMugM2QJnxiGnGg.jpg', 'Tên sản phẩm: Vòng tay trầm thiên nhiên 12 ly\r\nLoại trầm: Trầm hương thiên nhiên\r\nKích thước: 12 ly\r\nXuất xứ: Quảng Nam\r\nGía 15.000.000 đồng\r\nCông dụng\r\n✔ Tránh tà ma.. hơi lạnh. Phong long.\r\n✔ Lá bùa hộ mệnh cho bản thân.\r\n✔ Thích hợp người yếu bóng vía.\r\n✔ Mang lại may mắn cho chủ nhân\r\n\"', 1, '2025-04-24 06:21:34', '2025-04-24 06:21:34'),
(63, 'VÒNG TAY TRẦM HƯƠNG VIỆT NAM 18LI', 28000000.00, 1, 'uploads/g8UHMVHQZieae4JtEJyf4LOZEB0eyWojLB2eflcS.jpg', '- Với sự phối hợp hài hòa giữa các đốt trầm tạo nên một sản phẩm sang trọng, thời thượng\r\n- Hương thơm của sản phẩm có tác dụng kích thích não bộ, tăng khả năng sáng tạo, tư duy siêu hình\r\n- Sử dụng sản phẩm như một vật hộ thân để thu hút vận may\r\n- Đổi trả và hoàn tiền nếu sản phẩm bị lỗi\r\n\"\"\"', 1, '2025-04-24 06:22:01', '2025-04-24 06:22:01'),
(64, 'VÒNG TAY TRẦM HƯƠNG NAM 10LY', 21000000.00, 1, 'uploads/Z02KnH6lIJy0F5mzNwkiHbPtVMKzO3boQdsb9h6y.jpg', 'SỢI TRẦM MẮT TỬ CHÌM NƯỚC\r\nHàng Tiên Phước\r\n- Với sự phối hợp hài hòa giữa các đốt trầm và vàng 18k tạo nên một sản phẩm sang trọng, thời thượng\r\n- Hương thơm của sản phẩm có tác dụng kích thích não bộ, tăng khả năng sáng tạo, tư duy siêu hình\r\n- Sử dụng sản phẩm như một vật hộ thân để thu hút vận ma\r\n- Đổi trả và hoàn tiền nếu sản phẩm bị lỗi\r\n\"\"\"\"', 1, '2025-04-24 06:22:49', '2025-04-24 06:22:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_veryfied_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_veryfied_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trùm Code Lỏ', 'admin@gmail.com', NULL, '$2y$12$oZwUoamr2.ZX7P8gBWrrp..UEu5HM41eG4ii39txzn6jWKIUakbEW', NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_email_unique` (`email`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_danhmuc_id_foreign` (`danhmuc_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_danhmuc_id_foreign` FOREIGN KEY (`danhmuc_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
