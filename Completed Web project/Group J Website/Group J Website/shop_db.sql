-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 12:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(13, 3, 1, 'MH40 Wireless Paris Saint-Germain', 89400, 1, 'MH40WPSGPT2_Angle_800x800_800x800_7f3b8e92-b5b7-48b3-bf5f-453d0af30c21.png'),
(14, 3, 2, 'AKG N20U Premium In-Ear Headphones', 38800, 1, '793feb28b0cb1e6e782c052a702d8ad6.jpg'),
(15, 3, 4, 'Sony XBR-65A1E 65-Inch 4K Ultra HD Smart OLED TV', 956000, 1, '16194_250__1_cee96397-0276-4480-9361-6640fdb80b54.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'MH40 Wireless Paris Saint-Germain', 'In Stock', 89400, 'MH40WPSGPT2_Angle_800x800_800x800_7f3b8e92-b5b7-48b3-bf5f-453d0af30c21.png', 'MH40WPSGPT2_Stand_800x800_800x800_4173cbcc-a3f6-464b-9a30-9001219008af.png', 'MH40WPSGPT2_Straight_800x800_800x800_2cca1ed9-b3a1-4649-bd52-e4546fe69e26.png'),
(2, 'AKG N20U Premium In-Ear Headphones', 'In Stock', 38800, '793feb28b0cb1e6e782c052a702d8ad6.jpg', 'ea89e78de4918352434e6127aed25c1d.jpg', '793feb28b0cb1e6e782c052a702d8ad6_1024x.jpg'),
(4, 'Sony XBR-65A1E 65-Inch 4K Ultra HD Smart OLED TV', 'In Stock', 956000, '16194_250__1_cee96397-0276-4480-9361-6640fdb80b54.jpg', '16194_338__3_3e562e90-751f-4004-8755-9ac996ccb34a.jpg', '16194_539__2_64d118bc-505a-41ad-ae13-dcfee85f72db.jpg'),
(5, 'Sony STR-ZA810ES 7.2-Ch Hi-Res AV Receiver', 'In Stock', 208000, '13899_515__1_c82bbfa4-1699-40be-a72b-13575e558ab5.jpg', '13899_538__4_da9eaa7e-4699-423b-a629-573d1bdebaf9.jpg', '13899_627__3_c54244f5-ee67-40a3-9af4-9895716794af.jpg'),
(6, 'JBL Flip 4 Waterproof Portable Bluetooth Speaker', 'In Stock', 22400, '13124_608__2_2330a5b1-0aeb-4b20-a669-d6d1ce580b5d.jpg', '13124_914__1_dc7d656f-43d6-4ec6-840d-3af318cccd4e.jpg', '13124_937__4_ce1913e5-2fb9-4958-95a7-6f893ff92ee9.jpg'),
(9, 'Pioneer SW-8MK2  Subwoofer', 'In Stock', 47500, '81HrrDOLEwL._SL1500.jpg', '81HrrDOLEwL._SL1500_1024x (1).jpg', '81HrrDOLEwL._SL1500_1024x.jpg'),
(10, 'Sony VW295ES 4K HDR Home Theater Projector', 'In Stock', 1493900, 'vpl-vw295es_1.jpg', 'vpl-vw295es_2.jpg', 'vpl-vw295es_6.jpg'),
(11, 'Sony STR-ZA810ES A/V Receiver', 'In Stock', 208000, '13899_515__1_c82bbfa4-1699-40be-a72b-13575e558ab5.jpg', '13899_538__4_da9eaa7e-4699-423b-a629-573d1bdebaf9.jpg', '13899_627__3_c54244f5-ee67-40a3-9af4-9895716794af.jpg'),
(12, 'Sennheiser ClipMic  Mobile Recording Microphone', 'In Stock', 59400, '14031_997__1_046d4bea-a336-4fa2-8109-4a898ef3d416 (1).jpg', '14031_851__2_1155d2dd-276d-4055-a34b-80189cd9d866.jpg', '14031_997__1_046d4bea-a336-4fa2-8109-4a898ef3d416.jpg'),
(13, 'Yamaha Wireless Speaker WX-051', 'In Stock', 149000, '71APfN3f-0L._SL1500.jpg', 'b21f3637f1764ff789e4bf68c7ef5271_12075_4687x2753_d128f2e238d601d9803f2797b97a28ac_1.jpg', '33_b_2831x1737_89a3365eb3e41fca9a2522f523f1b1a5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'admin', 'sanojdayarathna5cc@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42'),
(3, 'Sano', 'daya@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
