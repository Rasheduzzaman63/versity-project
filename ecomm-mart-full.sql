-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 06:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm-mart-full`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `shipping_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL COMMENT 'not unit price',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `member_id`, `shipping_id`, `product_id`, `product_name`, `product_image`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(2, 5, NULL, 25, 'BYHUBYENG Restaurant Pager Wireless Waiter Call System 1 Watch+5 Button Receiver', '/upload/products/image-1656488922.jpg', 2, 4000, '2022-06-29 09:20:52', '2022-06-29 09:20:57'),
(3, 5, NULL, 13, 'EiD Special Premium Cotton Polo Shirt For Men', '/upload/products/image-1656487413.jpg', 3, 2700, '2022-06-29 09:21:54', '2022-06-29 09:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authored_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `authored_by`, `created_at`, `updated_at`) VALUES
(1, 'Birthday', 0, '2020-09-29 02:54:06', '2020-10-31 23:22:48'),
(8, 'Marriage Anniversary', 1, '2020-09-29 02:54:16', '2022-06-26 18:58:59'),
(11, 'Reception', 0, '2020-10-31 23:23:56', '2020-10-31 23:23:56'),
(12, 'Valentine\'s Day', 1, '2020-10-31 23:24:28', '2022-06-26 18:59:15'),
(14, 'Ping Pong Doll', 1, '2022-02-19 12:34:05', '2022-06-24 16:48:42'),
(15, 'Electronics', 1, '2022-06-26 18:35:20', '2022-06-26 18:35:20'),
(16, 'Clothing', 1, '2022-06-26 18:35:29', '2022-06-26 18:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL COMMENT 'Active,Inactive',
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `authored_by` int(11) DEFAULT NULL COMMENT 'authored_by needed if member is created by admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `phone`, `address`, `status`, `image`, `remember_token`, `authored_by`, `created_at`, `updated_at`) VALUES
(1, 'Member1', 'member1@m.com', '$2y$10$B8nuNo.cJz7bYqrrCSywROS4ZX/HJO6svFeR6XxbTafX7WM7ZUa0W', '024656555', 'Address', 'Active', 'upload/member-profiles/avatar-1656087198.png', NULL, NULL, '2022-06-24 09:30:09', '2022-06-24 16:13:19'),
(5, 'Member4', 'm4@m.com', '$2y$10$s2C02uzmhAN7iWwu5t/1NeATUUPSqMIbfUVAk6zF57lAMvoww.RRS', '6545656', 'adfasf', 'Active', 'upload/member-profiles/avatar-1656088994.png', NULL, NULL, '2022-06-24 16:43:14', '2022-06-24 16:43:14'),
(6, 'rafik', 'rafikul@gmail.com', '$2y$10$VbsTaxnqMldrEfTTLZFqk.5mRNKugNSVnBTlyeMLP8n2ZuQSk8dDO', '01775836798', 'mirpur 13- 1200', 'Active', 'upload/member-profiles/rafik-1658226908.jpg', NULL, NULL, '2022-07-19 10:35:08', '2022-07-19 10:35:08'),
(7, 'arian', 'user5@gmail.com', '$2y$10$YDcxCYmmn0P.W9Y1FuJ52eW7E5yLck5UxIWuqM0jzkX4JHhXnCrvS', '01778468597', 'badda.gulshan 2', 'Active', 'upload/member-profiles/600-600-1658293612.jpg', NULL, NULL, '2022-07-20 05:06:52', '2022-07-20 05:06:52'),
(8, 'mariom', 'user6@gmail.com', '$2y$10$9PA69iUpXal8vP2Z01D4oe1aXiH1O2ekFICDtZZucsqcDC5o5U/BK', '01778468594', 'dhaka,mirpur 13', 'Active', 'upload/member-profiles/IMG202001-1658296188.jpg', NULL, NULL, '2022-07-20 05:49:49', '2022-07-20 05:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `order_total` float NOT NULL,
  `shipping_date` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Pending','Accepted','Shipping','Delivered','Cancelled') NOT NULL COMMENT 'Pending,Accepted,Shipping,Delivered,Cancelled',
  `authored_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `member_id`, `payment_id`, `order_no`, `order_total`, `shipping_date`, `address`, `status`, `authored_by`, `created_at`, `updated_at`) VALUES
(1, '6', '1', '62d68941d48f7', 36666, '2022-07-12', 'mirpur 13- 1200', 'Accepted', 1, '2022-07-19 10:36:49', '2022-07-19 10:37:43'),
(2, '6', '2', '62d689a46e669', 5092, '2022-07-04', 'mirpur 13- 1200', 'Delivered', 1, '2022-07-19 10:38:28', '2022-07-19 10:38:45'),
(3, '7', '3', '62d78dceb4d64', 13138, '2022-07-04', 'badda.gulshan 2', 'Pending', NULL, '2022-07-20 05:08:30', '2022-07-20 05:08:30'),
(4, '6', '1', '2', 2, '2022-06-28', 'mirpur 13', 'Accepted', 1, '2022-07-20 05:28:10', '2022-07-20 05:28:10'),
(5, '8', '4', '62d797bf6c31d', 3462, '2022-07-24', 'dhaka,mirpur 13', 'Pending', NULL, '2022-07-20 05:50:55', '2022-07-20 05:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `authored_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_image`, `quantity`, `price`, `authored_by`, `created_at`, `updated_at`) VALUES
(1, '1', '24', 'Smart Wifi RGB Symphony Lamp LED Pickup Light Bluetooth App Control Music Rhythm Lights Gaming Bar TV Computer Desk Ambient Lamp', '/upload/products/image-1656488852.jpg', 2, 36000, NULL, '2022-07-19 10:36:49', '2022-07-19 10:36:49'),
(2, '2', '20', 'Samsung Solo Microwave Oven with Ceramic Enamel Cavity 23L | MS23K3513AK/D2', '/upload/products/image-1656488592.jpg', 1, 5000, NULL, '2022-07-19 10:38:28', '2022-07-19 10:38:28'),
(3, '3', '21', 'MINI Projector A30C Pro Smart TV Box Home Theater Projectors Cinema Mirror Phone LED Video Projector for Home 4k Video', '/upload/products/image-1656488671.jpg', 1, 7000, NULL, '2022-07-20 05:08:30', '2022-07-20 05:08:30'),
(4, '3', '20', 'Samsung Solo Microwave Oven with Ceramic Enamel Cavity 23L | MS23K3513AK/D2', '/upload/products/image-1656488592.jpg', 1, 5000, NULL, '2022-07-20 05:08:30', '2022-07-20 05:08:30'),
(5, '3', '13', 'EiD Special Premium Cotton Polo Shirt For Men', '/upload/products/image-1656487413.jpg', 1, 900, NULL, '2022-07-20 05:08:30', '2022-07-20 05:08:30'),
(6, '5', '10', 'Kaftan Abaya Bourka For Women ( DUBAI CHERRY FABRIC)', '/upload/products/image-1656487178.jpg', 2, 2200, NULL, '2022-07-20 05:50:55', '2022-07-20 05:50:55'),
(7, '5', '8', 'Hoodie niqab butterfly hooded muslim womens hijab prayer hijab cover niqab women veil burqa arab niqab', '/upload/products/image-1656487016.jpg', 1, 1200, NULL, '2022-07-20 05:50:55', '2022-07-20 05:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_method` enum('cash_on_delivery','bKash') NOT NULL COMMENT 'cash_on_delivery,bKash',
  `trx_num` varchar(255) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `payment_from_mobile` varchar(255) DEFAULT NULL,
  `payment_to_mobile` varchar(255) DEFAULT NULL,
  `authored_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_method`, `trx_num`, `member_id`, `payment_from_mobile`, `payment_to_mobile`, `authored_by`, `created_at`, `updated_at`) VALUES
(1, 'bKash', 's4524s4df', '6', '-01770583679', '01700000000', NULL, '2022-07-19 10:36:49', '2022-07-19 10:36:49'),
(2, 'bKash', 'ues1658', '6', '-01770583679', '01700000000', NULL, '2022-07-19 10:38:28', '2022-07-19 10:38:28'),
(3, 'bKash', '584646sg1', '7', '01770583679', '01700000000', NULL, '2022-07-20 05:08:30', '2022-07-20 05:08:30'),
(4, 'bKash', 'dsd212', '8', '-01770583679', '01700000000', NULL, '2022-07-20 05:50:55', '2022-07-20 05:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `authored_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `short_description`, `long_description`, `image`, `authored_by`, `created_at`, `updated_at`) VALUES
(2, 'Happy Birthday Cake Topper- 1pcs', '1', 500, 'Material: Acrylic\r\nSize: Approx 5\"-6\" wide. The Height depends on the topper style !!!', 'Material: Acrylic\r\nSize: Approx 5\"-6\" wide. The Height depends on the topper style !!!\r\nColor Options: Natural Wood; Black, White, Pink, Sky Blue, Blue, Purple, Green, Red, Gold, Silver; Mirror Gold ,Mirror Silver.\r\nFor the custom order, please email us for you customized request.\r\nThis elegant cake topper is perfect for your wedding cake topper or birthday party!\r\nSpecifications of Happy Birthday Cake Topper- 1pcs\r\nBrand \r\nNo Brand\r\nSKU \r\n167604178_BD-1101380589\r\nWhat’s in the box\r\nHappy Birthday Cake Topper- 1pcs', '/upload/products/image-1656268943.jpg', 1, '2022-06-26 18:42:24', '2022-06-26 18:42:24'),
(3, 'Mold Paper Cases Cake Decorating - 100 Pieces - Multicolor', '1', 400, 'No Brand\r\nSKU \r\n197387161_BD-1143960753\r\nWhat’s in the box\r\nCupcake Liner Baking Cups 100 piec /Mold Paper Cases Cake Decorating - 100 pcs - Multicolor', 'No Brand\r\nSKU \r\n197387161_BD-1143960753\r\nWhat is in the box\r\nCupcake Liner Baking Cups 100 piec /Mold Paper Cases Cake Decorating - 100 pcs - Multi color', '/upload/products/image-1656269104.jpg', 1, '2022-06-26 18:45:04', '2022-06-26 18:45:04'),
(4, 'HAPPY BIRTHDAY CANDLE FOR CAKE 13 PEICE/LATTER.FOR BIRTHDAY', '1', 600, 'Birthday candle 13 piece.Alphabate.For birthday party.Multicolor.13 piece candle.\r\nSpecifications of HAPPY BIRTHDAY CANDLE FOR CAKE 13 PEICE/LATTER.FOR BIRTHDAY DECORATION.\r\nBrand \r\nNo Brand\r\nSKU \r\n220767621_BD-1167901017', 'Birthday candle 13 piece.Alphabate.For birthday party.Multicolor.13 piece candle.\r\nSpecifications of HAPPY BIRTHDAY CANDLE FOR CAKE 13 PEICE/LATTER.FOR BIRTHDAY DECORATION.\r\nBrand \r\nNo Brand\r\nSKU \r\n220767621_BD-1167901017', '/upload/products/image-1656269166.jpg', 1, '2022-06-26 18:46:06', '2022-06-26 18:46:06'),
(5, 'Nestle KitKat 4 Fingers Chocolate 36.5g', '1', 700, 'Nestle KitKat Chocolate Bar is the ideal snack for those who really value their break. Just unwrap the bar and break off one of the fingers, snap it and savour the deliciously smooth milk chocolate.', 'Product Type: Chocolate\r\nCapacity: 4Fingers\r\nBrand: Nestle KitKat\r\nWeight: 36.5g\r\nNestle KitKat 4 Fingers Chocolate 36.5g\r\nNestle KitKat Chocolate Bar is the ideal snack for those who really value their break. Just unwrap the bar and break off one of the fingers, snap it and savour the deliciously smooth milk chocolate.\r\nSpecifications of Nestle KitKat 4 Fingers Chocolate 36.5g\r\nBrand \r\nNestle KitKat\r\nSKU \r\n184045450_BD-1128727876\r\nCapacity \r\n36.5gm\r\nCountry of Origin \r\nNot Specified\r\nWeight \r\n30 gm\r\nPack Size \r\n1\r\nWhat’s in the box\r\nNestle KitKat 4 Fingers Chocolate 36.5g', '/upload/products/image-1656269374.jpg', 1, '2022-06-26 18:49:34', '2022-06-26 18:49:34'),
(6, 'Chocolate Combo Offer', '1', 550, 'Description: Total Chocolate 07Pcs.\r\n1 Pcs Kitkat 3F.\r\n2 Pcs Cadbury Dairy milk.\r\n1 Pcs Cadbury 5 star.\r\n1 Pcs Cadbury Dairy Park.\r\n1 Pcs Kitkat \r\n1 Pcs Snickers', 'Product details of Chocolate Combo Offer\r\nDescription: Total Chocolate 07Pcs.\r\n1 Pcs Kitkat 3F.\r\n2 Pcs Cadbury Dairy milk.\r\n1 Pcs Cadbury 5 star.\r\n1 Pcs Cadbury Dairy Park.\r\n1 Pcs Kitkat \r\n1 Pcs Snickers \r\nAll Chocolate With Decoration Box.\r\nSpecifications of Chocolate Combo Offer\r\nBrand \r\nNo Brand\r\nSKU \r\n183746344_BD-1128244706\r\nCapacity \r\n300g\r\nWhat’s in the box\r\nChocolate Combo Offer', '/upload/products/image-1656269442.jpg', 1, '2022-06-26 18:50:42', '2022-06-26 18:50:42'),
(7, 'Exclusive designed Gown 1piece long kurti different koti, Gown long kurti For Stylish Women / Girls', '16', 1500, 'Description: Product details of Exclusive designed Gown 1piece long kurti different koti, Gown long kurti For Stylish Women / Girls\r\nProduct Type: 1Pice Long Kurti\r\nColor: Same As pic\r\nMain Material: Linen ,Sleeve.Long\r\n;Very Nice And Comfortable\r\nKamij; Body Size 36-44 Ani Body Use', 'Description: Product details of Exclusive designed Gown 1piece long kurti different koti, Gown long kurti For Stylish Women / Girls\r\nProduct Type: 1Pice Long Kurti\r\nColor: Same As pic\r\nMain Material: Linen ,Sleeve.Long\r\n;Very Nice And Comfortable\r\nKamij; Body Size 36-44 Ani Body Use\r\n100% Color Granti\r\nKamij Long 50+\r\nIt is made of high quality materials,durable enought for your daily wearing\r\nStylish and fashion design make you more attractive\r\nThis Dress is GORGEOUS! Loving the lace and how comfy it is! Don\'t miss out on this must have dress.\r\nGreat for Party,Daily,Casual,I am sure you will like it!\r\nThis lightweight, Dress is perfect for those carefree days\r\nSpecifications of Exclusive designed Gown 1piece long kurti different koti, Gown long kurti For Stylish Women / Girls\r\nBrand \r\nNo Brand\r\nSKU \r\n229564461_BD-1174345626\r\nMain Material \r\nCotton\r\nWhat’s in the box\r\nGown 1piece', '/upload/products/image-1656486901.jpg', 1, '2022-06-29 07:15:01', '2022-06-29 07:15:01'),
(8, 'Hoodie niqab butterfly hooded muslim womens hijab prayer hijab cover niqab women veil burqa arab niqab', '16', 1200, 'Description: Product details of Hoodie niqab butterfly hooded muslim womens hijab prayer hijab cover niqab women veil burqa arab niqab', 'Description: Product details of Hoodie niqab butterfly hooded muslim womens hijab prayer hijab cover niqab women veil burqa arab niqab\r\nLight -weight\r\nVery useful product upper side full cover\r\nUseful for prayer and outing for muslim women\r\nColor: black\r\nMaterial: diamond georgette\r\nSize: 180cmÃ90cm\r\nLight -weight\r\nSpecifications of Hoodie niqab butterfly hooded muslim womens hijab prayer hijab cover niqab women veil burqa arab niqab\r\nBrand \r\nNo Brand\r\nSKU \r\n192026494_BD-1138876676\r\nMain Material \r\nGeorgette\r\nWhat’s in the box\r\nHoodie niqab butterfly hooded muslim womens hijab prayer hijab cover niqab women veil burqa arab niqab', '/upload/products/image-1656487016.jpg', 1, '2022-06-29 07:16:56', '2022-06-29 07:16:56'),
(9, 'Error 404 Cotton Summer Tank Top For Men - 16837T', '16', 500, 'Description: Product details of Error 404 Cotton Summer Tank Top For Men - 16837T', 'Description: Product details of Error 404 Cotton Summer Tank Top For Men - 16837T\r\nProduct Details:\r\n· Band Name : Stone Rose\r\n· Product Type: Tank Top\r\n· Fabric : 100 % Cotton\r\n· Type : Round Neck\r\n· 165 GSM\r\nTank Top Size Measurement\r\nM- Long-26.5 x Chest-37.5\r\nL- Long-27.5 x Chest-39.5\r\nXL- Long-28.5 x Chest-41.5\r\nXXL- Long-29.5 x Chest-43.5\r\nSpecifications of Error 404 Cotton Summer Tank Top For Men - 16837T\r\nBrand \r\nStone Rose\r\nSKU \r\n227621621_BD-1171698085\r\nMain Material \r\nCotton\r\nWhat’s in the box\r\nError 404 Tank Top For Men\'s By Stone Rose - 16837T', '/upload/products/image-1656487100.jpg', 1, '2022-06-29 07:18:20', '2022-06-29 07:18:20'),
(10, 'Kaftan Abaya Bourka For Women ( DUBAI CHERRY FABRIC)', '16', 1100, 'Description: Product details of Kaftan Abaya Bourka For Women ( DUBAI CHERRY FABRIC)', 'Description: Product details of Kaftan Abaya Bourka For Women ( DUBAI CHERRY FABRIC)\r\nProduct details of Kaftan Abaya Bourka For Women (DUBAI CHERRY FABRIC)\r\nMaterials : Cherry Fabric\r\nSize : Please Check size option\r\nFashion abaya Borka.\r\nColor As Picture Shown\r\nDesign As picture Shown (Pipen color can be change).\r\nFor any question by Chat now.\r\nProduct details of Kaftan Abaya Bourka For Women (DUBAI CHERRY FABRIC)\r\nMaterials : Cherry Fabric\r\nSize : Please Check size option\r\nFashion abaya Borka.\r\nColor As Picture Shown\r\nDesign As picture Shown (Pipen color can be change).\r\nFor any question by Chat now.\r\nSpecifications of Kaftan Abaya Bourka For Women ( DUBAI CHERRY FABRIC)\r\nBrand \r\nNo Brand\r\nSKU \r\n209217737_BD-1159475320\r\nMain Material \r\nGeorgette\r\nWhat’s in the box\r\nKaftan Abaya Bourka For Women ( DUBAI CHERRY FABRIC)', '/upload/products/image-1656487178.jpg', 1, '2022-06-29 07:19:39', '2022-06-29 07:19:39'),
(11, 'Embroidery Work New Exclusive long kurti, deferent kurti, China Lilen clothes, long 1 piece Kurtis For Women/Girls', '16', 1600, 'Description: Product details of Embroidery Work New Exclusive long kurti, deferent kurti, China Lilen clothes, long 1 piece Kurtis For Women/Girls', 'Description: Product details of Embroidery Work New Exclusive long kurti, deferent kurti, China Lilen clothes, long 1 piece Kurtis For Women/Girls\r\nProduct Type: 1Pice Long Kurti\r\nColor: Same As pic\r\nMain Material: Linen ,Sleeve.Long\r\n;Very Nice And Comfortable\r\nKamij; Body Size 36-44 Ani Body Use\r\n100% Color Granti\r\nKamij Long 50+\r\nIt is made of high quality materials,durable enought for your daily wearing\r\nStylish and fashion design make you more attractive\r\nThis Dress is GORGEOUS! Loving the lace and how comfy it is! Don\'t miss out on this must have dress.\r\nGreat for Party,Daily,Casual,I am sure you will like it!\r\nThis lightweight, Dress is perfect for those carefree days\r\nSpecifications of Embroidery Work New Exclusive long kurti, deferent kurti, China Lilen clothes, long 1 piece Kurtis For Women/Girls\r\nBrand \r\nNo Brand\r\nSKU \r\n234810224_BD-1177722294\r\nMain Material \r\nLinen\r\nWhat’s in the box\r\nEmbroidery Work New Exclusive long kurti, deferent kurti, China Lilen clothes, long 1 piece Kurtis For Women/Girls', '/upload/products/image-1656487297.jpg', 1, '2022-06-29 07:21:37', '2022-06-29 07:21:37'),
(12, 'Pant', '16', 700, 'Description: Product details of Error 404 Cotton Summer Tank Top For Men - 16837T', 'Description: Product details of Error 404 Cotton Summer Tank Top For Men - 16837T\r\nProduct Details:\r\n· Band Name : Stone Rose\r\n· Product Type: Tank Top\r\n· Fabric : 100 % Cotton\r\n· Type : Round Neck\r\n· 165 GSM\r\nTank Top Size Measurement\r\nM- Long-26.5 x Chest-37.5\r\nL- Long-27.5 x Chest-39.5\r\nXL- Long-28.5 x Chest-41.5\r\nXXL- Long-29.5 x Chest-43.5\r\nSpecifications of Error 404 Cotton Summer Tank Top For Men - 16837T\r\nBrand \r\nStone Rose\r\nSKU \r\n227621621_BD-1171698085\r\nMain Material \r\nCotton\r\nWhat’s in the box\r\nError 404 Tank Top For Men\'s By Stone Rose - 16837T', '/upload/products/image-1656487361.jpg', 1, '2022-06-29 07:22:41', '2022-06-29 07:35:21'),
(13, 'EiD Special Premium Cotton Polo Shirt For Men', '16', 900, 'Description: Product details of EiD Special Premium Cotton Polo Shirt For Men\r\nProduct Type: Polo Shirt\r\nMaterial: PK Cotton', 'Description: Product details of EiD Special Premium Cotton Polo Shirt For Men\r\nProduct Type: Polo Shirt\r\nMaterial: PK Cotton\r\nGender: Men\r\nFit Type: Regular Fit\r\nStylish Design\r\n100% QC Pass.\r\nExport Quality Swing\r\nGSM: 190-200 (+-10)\r\nOccasion: Casual Summer Wear and sports.\r\n7 days Return Easy Return\r\nMade in: Bangladesh\r\nAll-Over Printed\r\nPrint QC Passed\r\nBrand: Ahmed Lifestyle\r\nSize Chart:\r\nM - Chest - 38\", Length – 28”\r\nL - Chest - 40\"Length - 29\"\r\nXL- Chest - 42\", Length – 30\"\r\nPremium quality Polo Shirt with 100% QC pass product. Fabric and swing is very high quality. This Polo Shirt is suitable for any condition of winter. It\'s casual looking and also very stylish.', '/upload/products/image-1656487413.jpg', 1, '2022-06-29 07:23:33', '2022-06-29 07:23:33'),
(14, '[World Premiere] New Arrivals Tablet Mi Pad 5 Max Snapdragon 888 Android 11 12GB RAM 512GB ROM 2.5K LCD Screen Android Tablete 5', '15', 20000, '-', 'Description: Model: Pad 5 Max\r\n\r\nCPU: Snapdragon 888 Deca core\r\n\r\nRAM+ROM: 12GB+512GB\r\n\r\nScreen: 10.1 inch, 1600*2560 resolution, LCD\r\n\r\nBattery: 8800mAh(Typ) ,Support Fast Charging\r\n\r\nOS: Android 11\r\n\r\nWeight: 525g\r\n\r\nDimensions: 270 x180 x 8mm\r\n\r\nNetwork: 4G,5G, Wi-Fi, Bluetooth\r\n\r\nWIFI: 802.11 a/b/g/n/ac\r\n\r\nBluetooth: V5.0\r\n\r\nGPS: GPS + Beidou + A-GPS\r\n\r\nInterface: Type C 3.1 / Micro SD, POGO Pin*4\r\n\r\nSensor: Gravity sensor, TOF, light sensor, gyroscope, Hall sensor, vibration motor\r\n\r\nCamera: 13MP dual front cameras , 24MP rear camera\r\n\r\nPackage Content ----Pad 5 Max | Adapter | USB Type-C Cable | Quick Start Guide | Screen protective film | Leather Case cover', '/upload/products/image-1656487676.jpg', 1, '2022-06-29 07:27:56', '2022-06-29 07:27:56'),
(15, 'Delux GM908CV Silent Rechargeable Ergonomic Office Wireless Keyboard Bluetooth USB 2.4G Slim with Hand Palm Rest for Windows Mac', '15', 500, '-', 'Description: Version: DELUX GM908CV Wireless ergonomic keyboard \r\nDimension: 42(L)*22(W)*2(H)cm\r\nNet Weight: About 0.88kg\r\nKey Switch: Scissor switches\r\nKey Life: >3 million times\r\nConnection: 2.4G wireless(come with USB receiver) and BT5.0(BT1+BT2), use with up to 3 devices\r\nBattery: Built-in 210 mAh rechargeable battery\r\nBattery Endurance: at a single charge, last for 200 hours\r\nOperating System: Compatible with Microsoft system/Win8/10/Mac os 10.12/Android 4.3 or higher', '/upload/products/image-1656487727.jpg', 1, '2022-06-29 07:28:47', '2022-06-29 07:28:47'),
(16, 'Brand New 16GB-DDR4 15.6inch IPS Cheap-Laptop Windows11 Intel N5095 Quad-Core Notebook 128G-1T SSD Fingerprint Backlit 5G-WIFI', '15', 45000, '-', 'Description: \r\nDesign: Exquisite workmanship, narrow bezel,lightweight and tough, smooth and soft touch, premium feel.\r\nDisplay: 15.6 inch high light transmittance and color saturation.\r\nOperation System: Powered by Win 10/11 , safe and stable, support numerous smart APPs.\r\nBattery: 7000mah, long time standby, best for home office use and travel.\r\nOthers: Support WiFi, Bluetooth 4.0, Multiple Applications, Books, Wallpapers, Calendar, Calculator, Clock, etc.', '/upload/products/image-1656487766.jpg', 1, '2022-06-29 07:29:27', '2022-06-29 07:29:27'),
(17, 'DERE V10 Laptop 11.6\" Touch Screen Laptop 8GB RAM 256GB SSD 360° Flip Intel Celeron N4000 Portable Computer Windows 11 Notebook', '15', 55000, '-', 'Description: 1.360°Flip-and-fold\r\n3.10-point Touch\r\n2.11.6\" 1Kg Weight\r\n6.Intel Celeron N4000，up to 2.8GHz\r\n4.4GB DDR4 RAM, 128GB SSD&8GB LPDDR4 RAM, 256GB SSD\r\n5.Intel 9th generation UHD Graphics 600 14nm up to 650MHz\r\n7.ac Dual-bandwiFi 2.4G/5G\r\n8.Windows 11 Home(4+128-Windows ）\r\n9.30W front cambuilt-in micror', '/upload/products/image-1656487805.jpg', 1, '2022-06-29 07:30:06', '2022-06-29 07:30:06'),
(18, 'Realme C31 4GB 64GB Green (Best Price Challenge)', '15', 20000, '-', 'Description: realme C31 4GB 64GB \r\nBrand: realme \r\nModel: C31 \r\nOperating System: realme UI (Based on Android 11)\r\nProcessor: UNISOC T610\r\nCPU: Octa-core CPU, 12nm\r\nGPU: Mali-G52\r\nRAM: 4GB LPDDR4X\r\nROM: 64GB\r\nDisplay: 6.5\" HD+ Mini-drop Fullscreen (LCD multi-touch display)\r\nResolution: 1600-by-720-pixel resolution\r\nBack Camera: 13MP (Primary Camera) + 2MP (B&W lens) + 2MP (Macro lens)\r\nPhotography function: Night Mode, Panoramic view, Expert, Timelapse, Portrait Mode, HDR, Ultra macro, AI Beauty, Filter, Chroma Boost\r\nVideo Recording: Support 1080P/30fps video recording\r\nFront Camera: 5MP AI selfie camera\r\nPhotography function: Portrait Mode, Timelapse, Panoramic view, Beauty Mode, HDR, Face-Recognition, Filter\r\nBattery & Charging: 5000mAh Massive Battery | Supports reverse charging\r\nCellular: 3-Card Slot (2 SIM Card + 1 MicroSD) | 2G/3G/4G\r\nWireless: WIFI 802.11 b/g/n | Bluetooth 5.0 | GPS/AGPS/Beidou/Glonass\r\nPorts: 3.5mm headset jack | Micro-USB\r\nSensors: Fingerprint (rear-mounted) | Magnetic induction sensor | Light sensor | Proximity sensor | Acceleration sensor\r\nColor: Green (As given picture)', '/upload/products/image-1656487853.jpg', 1, '2022-06-29 07:30:53', '2022-06-29 07:30:53'),
(20, 'Samsung Solo Microwave Oven with Ceramic Enamel Cavity 23L | MS23K3513AK/D2', '15', 5000, '-', 'Description: \r\nProduct details of Samsung Solo Microwave Oven with Ceramic Enamel Cavity 23L | MS23K3513AK/D2\r\nProduct Type: Solo\r\nInstallation Type: Freestanding\r\nOven Capacity: 23 L\r\nColor (Door): Black\r\nColor (Cabinet): Black\r\nDoor Type: Handle\r\nCavity Material: Ceramic Enamel\r\nTurntable Size: 288 mm\r\nDisplay Type: LED\r\nPower Source: 240V / 50Hz\r\nOutput Power (Microwave): 800 W\r\nPower Consumption (Microwave): 1150 W\r\nClock: Yes\r\n30 sec. plus: Yes\r\nEco Mode: Yes\r\nDefrost (Auto / Power / Sensor): Quick\r\nSensor Cook: No\r\nAuto Steam Cook: No\r\nAuto Programs: Yes\r\nAuto Cook: Yes\r\nDeodorization: Yes\r\nChild Safety Lock: Yes\r\nKitchen Timer: No\r\nCeramic Enamel Cavity: 10 years\r\nSpare parts: 1 year\r\nAfter sales: 1 year\r\nSpecifications of Samsung Solo Microwave Oven with Ceramic Enamel Cavity 23L | MS23K3513AK/D2\r\nBrand \r\nSamsung\r\nSKU \r\n243018616_BD-1187159843\r\nModel \r\nMS23K3513AK/D2\r\nWhat’s in the box\r\nSamsung Microwave oven MS23K3513AK/D2', '/upload/products/image-1656488592.jpg', 1, '2022-06-29 07:43:12', '2022-06-29 07:43:12'),
(21, 'MINI Projector A30C Pro Smart TV Box Home Theater Projectors Cinema Mirror Phone LED Video Projector for Home 4k Video', '15', 7000, '-', 'Description: A30 - Basic version\r\nSupport U disk to read videos and pictures. Connect TV boxes, XBOX, PS, Switch, computer devices via HDMI\r\n\r\nA30C - Sync Screen version\r\nA30C Built-in 2.4G and 5G WIFI. It offers an easier way to mirror screen by wire-free connections\r\n\r\nHow to install battery on A30C Pro\r\nPlease noted that battery is unplugged in transit to meet the requirements of ECO friendly and transportation safety. Please follow the instructions below to connect the power cord when received.\r\n\r\nMini size and rich interface\r\nExquisite appearance, exquisite interior design. Everything is for a more perfect user experience.', '/upload/products/image-1656488671.jpg', 1, '2022-06-29 07:44:31', '2022-06-29 07:44:31'),
(22, 'Walton WFD-1B6-GDEL/GDEH-XX Frost Refrigerator - 132 Ltr', '15', 30000, '-', 'Description: \r\nProduct details of Walton WFD-1B6-GDEL/GDEH-XX Frost Refrigerator - 132 Ltr\r\nType:Direct Cool\r\nGross Volume:132 Ltr\r\nNet Volume: 129 Ltr\r\nRefrigerant:R600a / R134a\r\nSpecifications of Walton WFD-1B6-GDEL/GDEH-XX Frost Refrigerator - 132 Ltr\r\nBrand \r\nWalton\r\nSKU \r\n132252222_BD-1053122713\r\nRefrigerator Type \r\nTop Mount Freezer\r\nNumber of doors \r\n2\r\nNofrost system \r\nNo\r\nWhat’s in the box\r\nওয়াল্টন WFD-1B6-GDEL/GDEH-XX ফ্রস্ট রেফ্রিজারেটর-132 ltr', '/upload/products/image-1656488726.jpg', 1, '2022-06-29 07:45:26', '2022-06-29 07:45:26'),
(23, 'Walton Refrigerator-WFAT-2A3-GDEL-XX-Gross-213 Ltr', '15', 40000, '-', 'Description: \r\nProduct details of Walton Refrigerator-WFAT-2A3-GDEL-XX-Gross-213 Ltr\r\n   Type: Direct Cool\r\n   Gross Volume OD: 213 Ltr OD\r\n   Outer Dimension  Manufacturer declared\r\n   Net Volume: 176 Ltr\r\n   Refrigerant: R600a R134a\r\nProduct color might vary from the showcased color\r\nCooling Features :\r\nType: Direct Cool\r\nCapacity :\r\nGross Volume (Outer Dimension, Manufacturer declared): 213 Ltr.\r\nNet Volume: 176 Ltr.\r\nNet Weight: 45.5 Â± 2 Kg\r\nGross Weight: 53 Â± 2 Kg.', '/upload/products/image-1656488789.jpg', 1, '2022-06-29 07:46:29', '2022-06-29 07:46:29'),
(24, 'Smart Wifi RGB Symphony Lamp LED Pickup Light Bluetooth App Control Music Rhythm Lights Gaming Bar TV Computer Desk Ambient Lamp', '15', 18000, '-', 'Description: \r\nFeatures:\r\n1. Built-in highly sensitive pickup, pick up external sound signals, light bar can be synchronized with the screen music or sound smoothly, dazzling colors will add more color depth to your room, creating a fascinating and fun gaming experience\r\n2. Built-in chip, support APP control lighting effect\r\n3. Multi-scene application: living room, kitchen, study, entertainment room ,DJ disco, stage party, computer desktop, and TV\r\n4. 2 types of installation: Vertical / Horizontal\r\nBluetooth: It can be connected to Bluetooth and controlled by APP. There are no gradients, only a single color can be displayed.\r\nIt is not possible to have more than one color in the light at the same time.\r\n\r\nWIFI: It can be connected to Bluetooth and WIFI, and supports APP control and voice assistant control. The WIFI model supports mainstream third-party voice assistants on the market. Gradient and monochrome modes are supported. Multiple colors can appear in the light at the same time.\r\nSpecification:\r\nProduct Name: Smart LED Light Bars with Bluetooth APP Control\r\nProduct Size: 3.1*3.1*31cm\r\nPower: 5W\r\nProduct Voltage: USB 5V 1A\r\nLight Color: RGB + W\r\nPackage Size: 32*9*4cm\r\nLamp Bead Specifications: 5050 built-in chip full color lamp beads\r\nPower Supply: USB\r\nController: External controller\r\nControl Mode: BLE\r\nProduct Material: ABS synthetic plastic + PVC\r\nNumber of LEDs: 32', '/upload/products/image-1656488852.jpg', 1, '2022-06-29 07:47:32', '2022-06-29 07:47:32'),
(25, 'BYHUBYENG Restaurant Pager Wireless Waiter Call System 1 Watch+5 Button Receiver', '15', 2000, '-', 'Description: The wireless receiver wrist watch pager system not only can be used in restaurant, hotel, clinic,shop or anywhere customer waiting for their service.also a emergency call tool for elderly,pregnant,children disabled.\r\n1 Upgraded Display Screen\r\nWatch Receiver use dot matrix LCD screen to maintain the image clarity;\r\nOled touchscreen display in blue colour the watch display can be easily read under strong sunlight;', '/upload/products/image-1656488922.jpg', 1, '2022-06-29 07:48:42', '2022-06-29 07:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `authored_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_image`, `title`, `description`, `link`, `authored_by`, `created_at`, `updated_at`) VALUES
(2, '/upload/sliders/slider_image-1656007768.jpg', 'Gift', 'Gift', NULL, 1, '2022-06-23 18:09:28', '2022-06-23 18:09:28'),
(4, '/upload/sliders/slider_image-1656144356.jpg', 'Men Collection', 'Men Collection', NULL, 1, '2022-06-25 08:05:56', '2022-06-25 08:05:56'),
(5, '/upload/sliders/slider_image-1656144387.jpg', 'Mega Deals', 'Mega Deals', NULL, 1, '2022-06-25 08:06:27', '2022-06-25 08:06:27'),
(6, '/upload/sliders/slider_image-1656144420.jpg', 'Phones and Accessories', 'Phones and Accessories', NULL, 1, '2022-06-25 08:07:00', '2022-06-25 08:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive' COMMENT 'Inactive, Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'SARWAR HOSSAIN', 'sarwarhossain.cmt@gmail.com', NULL, '$2y$10$3qk6nVa8.lEpaVlQYpicuuVqd.G3CxJkML2dblb4gtCJznWIDdqq.', NULL, '01770583679', '/upload/profiles/User-1658293407.jpg', 'Active', '2021-10-28 01:57:36', '2022-07-20 09:39:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
