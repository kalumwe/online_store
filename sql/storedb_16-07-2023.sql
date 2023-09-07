-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 16, 2023 at 07:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--
-- Creation: Jun 21, 2023 at 01:36 AM
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `sessionId` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `firstName` varchar(50) DEFAULT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address1` varchar(70) DEFAULT NULL,
  `address2` varchar(70) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `cart`:
--   `userId`
--       `users` -> `user_id`
--

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userId`, `sessionId`, `token`, `status`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `address1`, `address2`, `city`, `province`, `country`, `createdAt`, `updatedAt`, `content`) VALUES
(63, 5, '5', NULL, 'Added to cart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:15:36', NULL, NULL),
(65, 4, '4', NULL, 'Added to cart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-23 12:26:42', NULL, NULL),
(90, 4, '4', NULL, 'Added to cart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-01 16:25:24', NULL, NULL),
(96, 5, '5', NULL, 'Added to cart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-03 17:45:36', NULL, NULL),
(101, 4, '4', NULL, 'Added to cart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 15:27:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--
-- Creation: Jun 21, 2023 at 06:42 PM
--

CREATE TABLE `cart_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(100) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `quantity` smallint(6) NOT NULL DEFAULT 1,
  `size` varchar(20) NOT NULL,
  `color` varchar(15) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `cart_item`:
--   `cartId`
--       `cart` -> `id`
--   `productId`
--       `product` -> `id`
--

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`id`, `productId`, `cartId`, `sku`, `price`, `discount`, `quantity`, `size`, `color`, `active`, `createdAt`, `updatedAt`, `content`) VALUES
(49, 1, 63, '', 0, 0, 1, 'XL', 'white', 0, '2023-06-23 12:15:36', '2023-06-23 14:15:36', NULL),
(51, 1, 65, '', 0, 0, 2, 'L', 'white', 0, '2023-06-23 12:26:42', '2023-06-23 14:26:42', NULL),
(76, 2, 90, '', 0, 0, 1, 'L', 'black', 0, '2023-07-01 16:25:24', '2023-07-01 18:25:24', NULL),
(82, 2, 96, '', 0, 0, 1, 'M', 'black', 0, '2023-07-03 17:45:36', '2023-07-03 21:58:48', NULL),
(87, 12, 101, '', 0, 0, 1, 'S', 'white', 0, '2023-07-15 15:27:30', '2023-07-15 17:27:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Jun 21, 2023 at 01:36 AM
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED DEFAULT NULL,
  `categoryName` varchar(75) NOT NULL,
  `metaTitle` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `catContent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `category`:
--   `productId`
--       `category` -> `id`
--   `productId`
--       `product` -> `id`
--

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `productId`, `categoryName`, `metaTitle`, `slug`, `catContent`) VALUES
(1, NULL, 'men', NULL, '23354rdffghj', NULL),
(2, NULL, 'ladies', NULL, '264567fgdrf', NULL),
(3, NULL, 'accessories', NULL, '87t6r6tfjyj', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--
-- Creation: Jun 21, 2023 at 01:37 AM
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `sessionId` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `subTotal` float NOT NULL DEFAULT 0,
  `itemDiscount` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `shipping` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT 0,
  `promo` varchar(50) DEFAULT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `grandTotal` float NOT NULL DEFAULT 0,
  `firstName` varchar(50) DEFAULT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `order`:
--   `productId`
--       `product` -> `id`
--   `userId`
--       `users` -> `user_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--
-- Creation: Jun 21, 2023 at 01:37 AM
--

CREATE TABLE `order_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(100) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `quantity` smallint(6) NOT NULL DEFAULT 0,
  `createdAt` datetime NOT NULL,
  `uodatedAt` datetime DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `order_item`:
--   `orderId`
--       `order` -> `id`
--   `productId`
--       `product` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Jun 21, 2023 at 01:38 AM
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(75) NOT NULL,
  `megaTitle` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `summary` tinytext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `imageDetail` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `sku` varchar(100) NOT NULL,
  `price` float UNSIGNED NOT NULL DEFAULT 0,
  `oldPrice` float DEFAULT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `quantity` smallint(6) UNSIGNED NOT NULL DEFAULT 0,
  `shop` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `publishedAt` datetime DEFAULT NULL,
  `startsAt` datetime DEFAULT NULL,
  `endsAt` datetime DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product`:
--   `userId`
--       `users` -> `user_id`
--

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `userId`, `title`, `megaTitle`, `slug`, `summary`, `description`, `type`, `brand`, `image`, `imageDetail`, `thumb`, `sku`, `price`, `oldPrice`, `discount`, `quantity`, `shop`, `createdAt`, `updatedAt`, `publishedAt`, `startsAt`, `endsAt`, `content`) VALUES
(1, NULL, 'White Blouse Armani', NULL, '1235467890', NULL, 'White lace top, woven, has a round neck, short sleeves, has knitted lining attached', 't-shirt', 'armani', 'product2.jpg', 'detailbig', 'detailsquare', 'adfghfg1434546', 143, NULL, 20, 4, 0, '2023-06-14 00:50:27', '2023-06-22 01:58:32', NULL, NULL, NULL, 'Define style this season with Armani\'s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.'),
(2, NULL, 'Black Blouse Versace', NULL, '0987675434', NULL, 'Black Blouse Versace', 't-shirt', 'versace', 'product3.jpg', 'product3_', 'basketsquare', 'ytdert6545rt54rf', 144, NULL, 50, 0, 0, '2023-06-14 00:50:27', '2023-07-03 17:49:22', NULL, NULL, NULL, NULL),
(3, NULL, 'Fur coat', NULL, '8765r469887', 'Fur coat with very but very very long name', 'Fur coat with very but very very long name', 'coat', NULL, 'product1.jpg', 'product1_', NULL, 'hgcdrfdrtd3452', 250, NULL, 0, 0, 0, '2023-06-14 00:53:54', '2023-06-21 20:28:36', NULL, NULL, NULL, NULL),
(4, NULL, 'White Plain T-shirt', NULL, '76r5gh5478t76', 'White Plain T-shirt', 'White Plain T-shirt', 't-shirt', NULL, 'product-3.jpg', 'product-3_', NULL, '67548457iuihgg', 79, 99, 0, 10, 0, '2023-06-16 01:13:59', '2023-06-21 20:28:37', NULL, NULL, NULL, NULL),
(5, NULL, 'White Sweater', NULL, '764587766555frtff', 'White Sweater', 'White Sweater', 't-shirt', NULL, 'product4.jpg', 'product4_', NULL, '6558767867rddchffgv', 129, 149, 5, 8, 0, '2023-06-16 01:13:59', '2023-06-22 02:20:50', NULL, NULL, NULL, NULL),
(6, NULL, 'Black Nike Sneakers', NULL, '784587767yhgvkh', 'Black Nike Sneakers', 'Black Nike Sneakers', 'sneakers', 'nike', 'product-11.jpg', 'product-11_', NULL, '654679jgfcjdc', 379, 399, 0, 5, 0, '2023-06-16 01:20:54', '2023-06-21 20:28:37', NULL, NULL, NULL, NULL),
(7, NULL, 'Apple Watch', NULL, '873865043gdecnjui', 'Apple Watch', 'Apple Watch', 'watch', 'apple', 'product-8.jpg', 'product-detail-', NULL, '765685336ugfvvdgjvg', 599, NULL, 0, 5, 0, '2023-06-16 01:20:54', '2023-06-21 20:28:37', NULL, NULL, NULL, NULL),
(8, NULL, 'Men Blue Suit', NULL, '9634333fhngg', 'Blue Jacket', 'Blue Jacket', 't-shirt', NULL, 'product_5.jpg', 'product_5_', NULL, '775434533gvbzxxe', 189, 199, 0, 3, 0, '2023-06-16 01:51:20', '2023-07-15 15:01:41', NULL, NULL, NULL, NULL),
(9, NULL, 'Ladies White T-shirt', NULL, '', NULL, 'Ladies White T-shirt with cactus image', 't-shirt', NULL, 'product-08.jpg', 'product-08', NULL, 'ytdre55356859btdr34w6khj', 59, 79, 0, 15, 0, '2023-07-15 14:07:03', '2023-07-15 14:11:44', NULL, NULL, NULL, NULL),
(10, NULL, 'Ladies Grey T-shirt', NULL, '67uut6455768i6o7tgyb', 'Ladies Grey Summer T-shirt', 'Ladies Grey Summer T-shirt', 't-shirt', NULL, 'product-16.jpg', 'product-16', 'product-16thumb', 'ioiyut667565546i7tyg87', 39, 49, 0, 10, 0, '2023-07-15 14:45:47', '2023-07-15 14:45:47', NULL, NULL, NULL, NULL),
(11, NULL, 'Men Blue Jacket', NULL, '86785#oyuiy897vggb', 'Men Blue Jacket', 'Men Blue spring Jacket', 't-shirt', NULL, 'product-detail-02.jpg', 'product-detail-02', 'product-detail-02thumb', 'uyg4e687988uijjnkhre3', 99, 119, 10, 5, 0, '2023-07-15 14:55:59', '2023-07-15 15:00:06', NULL, NULL, NULL, NULL),
(12, NULL, 'Ladies White Summer T-shirt', NULL, 'hy456jtr56ujui65ed', 'Ladies White Summer T-shirt', 'Ladies White Summer T-shirt', 't-shirt', NULL, 'product-01.jpg', 'product-01', 'product-01thumb', '6ytft76iu97gmjbdrwe', 29, 49, 5, 5, 0, '2023-07-15 15:10:20', '2023-07-15 15:26:48', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--
-- Creation: Jun 21, 2023 at 01:38 AM
--

CREATE TABLE `product_category` (
  `productId` bigint(20) UNSIGNED NOT NULL,
  `categoryId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product_category`:
--   `categoryId`
--       `category` -> `id`
--   `productId`
--       `product` -> `id`
--

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`productId`, `categoryId`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 1),
(7, 3),
(8, 1),
(9, 2),
(10, 2),
(11, 1),
(12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_meta`
--
-- Creation: Jun 21, 2023 at 01:38 AM
--

CREATE TABLE `product_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(50) NOT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product_meta`:
--   `productId`
--       `product` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--
-- Creation: Jun 21, 2023 at 01:39 AM
--

CREATE TABLE `product_review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `parentId` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `rating` smallint(6) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime NOT NULL,
  `publishedAt` datetime DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product_review`:
--   `parentId`
--       `product_review` -> `id`
--   `productId`
--       `product` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--
-- Creation: Jun 21, 2023 at 01:39 AM
--

CREATE TABLE `product_tag` (
  `productId` bigint(20) UNSIGNED NOT NULL,
  `tagId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `product_tag`:
--   `productId`
--       `product` -> `id`
--   `tagId`
--       `tag` -> `id`
--

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`productId`, `tagId`) VALUES
(1, 1),
(2, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--
-- Creation: Jun 21, 2023 at 01:40 AM
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `rating` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `ratings`:
--   `productId`
--       `product` -> `id`
--   `userId`
--       `users` -> `user_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--
-- Creation: Jun 21, 2023 at 01:40 AM
--

CREATE TABLE `tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoryId` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(75) NOT NULL,
  `megaTitle` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `tag`:
--   `categoryId`
--       `category` -> `id`
--

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `categoryId`, `title`, `megaTitle`, `slug`, `content`) VALUES
(1, NULL, 'clothing', NULL, '876865gvjb', NULL),
(2, NULL, 'shoes', NULL, '56375jfffgg', NULL),
(3, NULL, 'accessories', NULL, '87655684rrtu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--
-- Creation: Jun 21, 2023 at 01:41 AM
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT 0,
  `mode` smallint(6) NOT NULL DEFAULT 0,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `createdAt` datetime NOT NULL,
  `uodatedAt` datetime DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `transaction`:
--   `orderId`
--       `order` -> `id`
--   `userId`
--       `users` -> `user_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jun 12, 2023 at 06:35 PM
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `u_name` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` char(255) NOT NULL,
  `street` varchar(80) NOT NULL,
  `zip` char(10) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `tel` char(20) DEFAULT NULL,
  `intro` tinytext DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_level` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `u_name`, `email`, `pass`, `street`, `zip`, `state`, `country`, `tel`, `intro`, `updated`, `reg_date`, `user_level`) VALUES
(1, 'kalu', 'mwe', 'Kalukav', 'kalukav@gmail.com', '3??c??e? ?{?0', 'lsk', '111111', 'Lusaka', 'Zambia', '0967304171', NULL, '2023-06-07 21:34:59', '2023-06-07 21:34:59', 0),
(2, 'Kalu', 'Jerry', 'kalukavyo', 'kalu@gmail.com', '3??c??e? ?{?0', 'piru', '45654', 'Lusaka', 'Zambia', NULL, NULL, '2023-06-08 21:07:38', '2023-06-08 21:07:38', 0),
(3, 'sub', 'zero', 'subzero', 'subzero@gmail.com', '3??c??e? ?{?0', 'piru', '33040', 'Lusaka', 'Zambia', NULL, NULL, '2023-06-09 01:31:06', '2023-06-09 01:31:06', 0),
(4, 'Kalu', 'Mweshi', 'kalumwe', 'kalukav55@gmail.com', '$2y$10$4LNTZvhAeqSwneukRarp8uZndj/kxd6V/vOFxNFhRmPsv8t.TbZsm', 'Lusaka, Zambia', '10100', 'Lusaka', 'Aruba', '0961125756', 'whats up!', '2023-07-04 18:30:10', '2023-06-09 19:33:00', 0),
(5, 'Kalumba', 'Kavyo', 'Kalu', 'kalu2@gmail.com', '$2y$10$bWIncblx8snfJ0Fh0oOjzednEn25cAYQkfjMO5QLJbHtLKMIZj1FW', 'lusaka, zambia', '111111', 'Lusaka', 'Zambia', '0967304171', 'whats up', '2023-07-03 17:43:50', '2023-06-23 11:55:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--
-- Creation: Jun 25, 2023 at 06:33 PM
--

CREATE TABLE `variant` (
  `variantId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `color` varchar(15) DEFAULT NULL,
  `sale` tinyint(1) UNSIGNED DEFAULT NULL,
  `new` tinyint(1) UNSIGNED DEFAULT NULL,
  `gift` tinyint(1) UNSIGNED DEFAULT 0,
  `sold` tinyint(3) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `variant`:
--   `productId`
--       `product` -> `id`
--

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`variantId`, `productId`, `size`, `color`, `sale`, `new`, `gift`, `sold`) VALUES
(1, 1, 'XL', 'white', 0, 0, 0, 0),
(2, 2, 'L', 'black', 1, 0, 0, 0),
(3, 3, 'M', 'blue', 0, 1, 0, 0),
(4, 4, 'S', 'white', 1, 1, 1, 0),
(5, 5, 'M', 'white', 1, NULL, 0, 0),
(6, 6, '34', 'black', 1, 1, 0, 0),
(7, 7, NULL, 'black', NULL, 1, 0, 0),
(8, 8, 'XL', 'blue', 0, 0, 0, 1),
(9, 9, 'M', 'white', 1, 1, 0, 0),
(10, 10, 'M', 'grey', 1, NULL, 0, 0),
(11, 11, 'L', 'blue', 1, 1, 0, 0),
(12, 12, 'S', 'white', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--
-- Creation: Jun 23, 2023 at 09:25 AM
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `wishlist`:
--   `productId`
--       `product` -> `id`
--   `userId`
--       `users` -> `user_id`
--

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `productId`, `userId`, `status`, `added`) VALUES
(4, 4, 4, 'Added to wishlist', '2023-06-23 11:39:27'),
(6, 2, 4, 'Added to wishlist', '2023-06-23 11:39:56'),
(8, 8, 4, 'Added to wishlist', '2023-06-23 11:40:42'),
(10, 8, 5, 'Added to wishlist', '2023-06-23 12:06:57'),
(14, 2, 5, 'Added to wishlist', '2023-06-27 02:14:43'),
(15, 1, 5, 'Added to wishlist', '2023-06-29 18:22:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user` (`userId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_poduct` (`productId`),
  ADD KEY `cart_item_cart` (`cartId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentId` (`productId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user` (`userId`),
  ADD KEY `order_prod` (`productId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_prod` (`productId`),
  ADD KEY `order_item_order` (`orderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `product_user` (`userId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`productId`,`categoryId`),
  ADD KEY `pc_category` (`categoryId`);

--
-- Indexes for table `product_meta`
--
ALTER TABLE `product_meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productId` (`productId`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_parent` (`parentId`),
  ADD KEY `review_product` (`productId`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`productId`,`tagId`),
  ADD KEY `pc_tag` (`tagId`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_prod` (`productId`),
  ADD KEY `ratings_user` (`userId`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_tag` (`categoryId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transction_user` (`userId`),
  ADD KEY `transaction_order` (`orderId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `u_name` (`u_name`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`variantId`),
  ADD KEY `variant_prod` (`productId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist-prod` (`productId`),
  ADD KEY `wishlist-user` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_meta`
--
ALTER TABLE `product_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `variantId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cartUser` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart-item-cart` FOREIGN KEY (`cartId`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_prod` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_parent` FOREIGN KEY (`productId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_category` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order-prod` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order-user` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order-item-order` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order-item-prod` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_user` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `pc_category` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_product` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_meta`
--
ALTER TABLE `product_meta`
  ADD CONSTRAINT `meta_product` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `review_parent` FOREIGN KEY (`parentId`) REFERENCES `product_review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_product` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `pc_prodct` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_tag` FOREIGN KEY (`tagId`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings-prod` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings-user` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `cat_tag` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transction-order` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transction-user` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant-prod` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_prod` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_user` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
