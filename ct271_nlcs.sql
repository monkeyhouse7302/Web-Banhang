-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 10:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct271_nlcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(0, 'Phụ kiện khác'),
(1, 'Giày nam'),
(2, 'Giày nữ');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `product_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `full_name`, `email`, `phone_number`, `address`, `payment`, `note`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Mai Phuc Hau', 'haub2005712@student.ctu.edu.vn', '0907983329', 'Vinh Long', 'Thanh toán tiền mặt khi nhận hàng (COD)', '', 4704000, 'Đang xử lý', '2023-11-05 05:24:41', '2023-11-05 05:24:41'),
(2, 'Nguyen Mai Phuc Hau', 'haub2005712@student.ctu.edu.vn', '0907983329', 'Vinh Long', 'Thanh toán tiền mặt khi nhận hàng (COD)', '', 4235000, 'Đã hủy', '2023-11-05 10:16:29', '2023-11-07 03:32:22'),
(3, 'Nguyen Mai Phuc Hau', 'haub2005712@student.ctu.edu.vn', '0907983329', 'Binh Minh, Vinh Long', 'Thanh toán tiền mặt khi nhận hàng (COD)', '', 2730000, 'Đã hủy', '2023-11-06 13:16:39', '2023-11-07 03:32:37'),
(4, 'Nguyễn Mai Phúc Hậu', 'haub2005712@student.ctu.edu.vn', '0907983329', 'Xã Thuận An, Bình Minh, Vĩnh Long', 'Thanh toán chuyển khoản (Internet Banking)', '', 9630000, 'Đã hủy', '2023-11-10 04:09:10', '2023-11-10 04:11:06'),
(5, 'Trần Tiến Đạt', 'datb2005710@student.ctu.edu.vn', '0825049249', 'Kiên Giang', 'Thanh toán chuyển khoản (Internet Banking)', '', 6171000, 'Đang xử lý', '2023-11-10 11:45:41', '2023-11-10 11:45:41'),
(6, 'Trần Tiến Đạt', 'datb2005710@student.ctu.edu.vn', '0825049249', 'Kiên Giang', 'Thanh toán tiền mặt khi nhận hàng (COD)', '', 2109000, 'Đã giao', '2023-11-10 11:46:22', '2023-11-10 11:51:09'),
(7, 'Lê Phú Mỹ', 'lephumy@gmail.com', '0901234567', 'An Giang', 'Thanh toán tiền mặt khi nhận hàng (COD)', '', 5529000, 'Đã giao', '2023-11-10 11:47:36', '2023-11-10 11:51:22'),
(8, 'Lê Phú Mỹ', 'lephumy@gmail.com', '0901234567', 'Cần Thơ', 'Thanh toán chuyển khoản (Internet Banking)', '', 1109000, 'Đã giao', '2023-11-10 11:48:06', '2023-11-10 11:50:50'),
(9, 'Nguyễn Dũng Phương Huy', 'phuonghuy@gmail.com', '0907654321', 'Cần Thơ', 'Thanh toán tiền mặt khi nhận hàng (COD)', '', 4830000, 'Đã giao', '2023-11-10 11:49:06', '2023-11-10 11:51:46'),
(10, 'Nguyễn Mai Phúc Hậu', 'nguyenmaiphuchau@gmail.com', '0902399093', 'Phường Long Hòa, Quận Bình Thủy, Thành phố Cần Thơ, 94108, Việt Nam', 'Thanh toán chuyển khoản (Internet Banking)', '', 2822000, 'Đang xử lý', '2023-11-20 09:33:39', '2023-11-20 09:33:39'),
(11, 'Lê Phú Mỹ', 'my@gmail.com', '0901234561', 'Phường Long Hòa, Quận Bình Thủy, Thành phố Cần Thơ, 94108, Việt Nam', 'Thanh toán tiền mặt khi nhận hàng (COD)', 'Không', 6541000, 'Đang xử lý', '2023-11-20 09:34:41', '2023-11-20 09:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `amounts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`order_id`, `product_id`, `amounts`) VALUES
(1, 2, 1),
(1, 7, 1),
(2, 2, 1),
(2, 1, 1),
(3, 8, 1),
(4, 11, 2),
(5, 1, 1),
(5, 18, 1),
(5, 28, 1),
(6, 35, 1),
(6, 25, 1),
(7, 14, 1),
(7, 19, 1),
(8, 32, 1),
(9, 29, 1),
(9, 13, 1),
(10, 1, 1),
(11, 1, 1),
(11, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `brand`, `price`, `category_id`, `Image`, `created_at`, `updated_at`) VALUES
(1, 'Nike Gamma Force', 'Nike', 2792000, 2, 'Gamma_Force.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(2, 'Nike Court Vision', 'Nike', 1413000, 2, 'Court_Vision.png', '2023-10-29 14:49:41', '2023-10-29 14:52:41'),
(3, 'Nike Blazer Lo 77', 'Nike', 2499000, 1, 'Blazer_Lo.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(4, 'Nike Air Max 90', 'Nike', 3719000, 1, 'Air_Max_90.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(5, 'Nike Waffle One', 'Nike', 3099000, 1, 'Waffle_One.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(6, 'Nike Zoom Fly 5', 'Nike', 4699000, 2, 'Zoom_Fly_5.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(7, 'Nike React Infinity 3', 'Nike', 3261000, 1, 'React_Infinity_3.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(8, 'Adidas Advantage', 'Adidas', 2700000, 1, 'Adidas_Advantage.png', '2023-10-29 14:49:41', '2023-11-06 13:15:27'),
(9, 'Adidas FORUM LOW', 'Adidas', 2600000, 1, 'FORUM_LOW.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(10, 'Adidas UltraBoost 22', 'Adidas', 3640000, 1, 'UltraBoost_22.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(11, 'Adidas ULTRA 4DFWD', 'Adidas', 4800000, 1, 'ULTRA_4DFWD.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(12, 'Adidas OSADE', 'Adidas', 2400000, 2, 'OSADE.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(13, 'Adidas ASTIR', 'Adidas', 2800000, 2, 'ASTIR.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(14, 'Adidas RACER TR23', 'Adidas', 1800000, 2, 'RACER_TR23.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(15, 'Puma-180 Perf', 'Puma', 3099000, 1, 'Puma-180_Perf.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(16, 'Puma RS X3', 'Puma', 1399000, 1, 'RS-X3.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(17, 'Puma Slipstream Prm', 'Puma', 3099000, 2, 'Slipstream_Prm.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(18, 'Puma Rs-X Gen', 'Puma', 2099000, 1, 'Rs-X_Gen.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(19, 'Puma Clyde Og', 'Puma', 3699000, 1, 'Clyde_Og.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(20, 'Puma Puma-180', 'Puma', 3099000, 2, 'Puma-180.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(21, 'Puma Cali Court Match', 'Puma', 3099000, 2, 'Cali_Court_Match.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(22, 'Converse Chuck 70', 'Converse', 2000000, 1, 'Chuck_70.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(23, 'Converse Jack Purcell', 'Converse', 1020000, 1, 'Jack_Purcell.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(24, 'Converse As-1 Pro', 'Converse', 2300000, 1, 'As-1_Pro.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(25, 'Converse Chuck Taylor All Star', 'Converse', 1700000, 2, 'Chuck_Taylor.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(26, 'Converse Chuck 70 Canvas', 'Converse', 1900000, 2, 'Chuck_70_Canvas.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(27, 'Converse El Distrito 2.0', 'Converse', 960000, 1, 'El_Distrito.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(28, 'Converse Chuck 70 Plus', 'Converse', 1250000, 2, 'Chuck_70_Plus.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(29, 'Áo Khoác Adidas Fi 3S Fz Q4', 'Adidas', 2000000, 0, 'Fi_3S_Fz_Q4.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(30, 'Vớ Adidas Light No Show (3 Đôi)', 'Adidas', 300000, 0, 'Light_No_Show.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(31, 'Ba Lô Thể Thao Adidas Classics Fabric Tech', 'Adidas', 770000, 0, 'Fabric_Tech.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(32, 'Ba Lô Thể Thao Nike Elmntl-Hbr', 'Nike', 1079000, 0, 'Elmntl-Hbr.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(33, 'Túi Đeo Chéo Chuck Taylor Patch Sling Pack', 'Converse', 350000, 0, 'Sling_Pack.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(34, 'Balo Puma Phase Aop-Love', 'Puma', 539000, 0, 'Aop-Love.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(35, 'Vớ Thể Thao Nike Everyday Cushioned Training No-Show (3 Đôi)', 'Nike', 379000, 0, 'Cushioned_Training.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41'),
(36, 'Vớ Puma 3P Apac(3 Đôi)', 'Puma', 249000, 0, '3P_Apac.png', '2023-10-29 14:49:41', '2023-10-29 14:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `full_name`, `phone_number`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'b2005712', 'Nguyễn Mai Phúc Hậu', '0907983329', 'haub2005712@student.ctu.edu.vn', '$2y$10$BOGIcdZ2WyBX0jjEmbObm.AnLTUDt7woy0wO3ROjGGQXbpSCJFHMa', '2023-10-29 14:49:41', '2023-11-17 08:49:13'),
(2, 'b2005710', 'Trần Tiến Đạt', '0825049249', 'datb2005710@student.ctu.edu.vn', '$2y$10$BOGIcdZ2WyBX0jjEmbObm.AnLTUDt7woy0wO3ROjGGQXbpSCJFHMa', '2023-11-09 10:55:09', '2023-11-09 10:55:09'),
(3, 'phumy', 'Lê Phú Mỹ', '0901234567', 'lephumy@gmail.com', '$2y$10$Zy..wHRDipEn7Kh6PdVP4udl5LIUF.lf4bHenmx3MnfhObi3cd4cu', '2023-11-10 11:43:27', '2023-11-10 11:43:27'),
(4, 'phuonghuy', 'Nguyễn Dũng Phương Huy', '0907654321', 'phuonghuy@gmail.com', '$2y$10$44J96Ud3o8/upHbaDB9njO8Y5fljUlNuKJ5.IgohCffD4CO3xnwSy', '2023-11-10 11:44:42', '2023-11-10 11:44:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
