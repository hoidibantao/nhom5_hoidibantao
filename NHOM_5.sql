-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 04:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thuvan.sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_name` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_name`, `admin_id`, `email`, `password`) VALUES
('hoidibantao-admin', 1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `cart_many` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`cart_many`, `cart_id`, `product_name`, `product_id`, `product_price`, `product_img`) VALUES
(1, 271, 'AirPods (thế hệ thứ 3)', 27, '5000000', '13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_link` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `warranty` varchar(50) NOT NULL DEFAULT '1 năm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_link`, `category_id`, `category_name`) VALUES
('macbook.php', 1, 'Macbook'),
('iphone.php', 2, 'iPhone'),
('ipad.php', 3, 'iPad'),
('phukienapple.php', 4, 'Phụ kiện Apple');


-- --------------------------------------------------------

--
-- Table structure for table `tb_client`
--

CREATE TABLE `tb_client` (
  `client_note` text NOT NULL,
  `client_email` varchar(150) NOT NULL,
  `client_password` varchar(100) NOT NULL,
  `transport` int(11) NOT NULL,
  `client_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_phone` int(50) NOT NULL,
  `client_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_client`
--

INSERT INTO `tb_client` (`client_note`, `client_email`, `client_password`, `transport`, `client_name`, `client_phone`, `client_address`) VALUES
('', 'thuvan@gmail.com', '416ceb0d7a96d2e9a0ac3ec37735493b', 0, 'Thu Van', 123456789, 'Ninh Hòa'),
('', 'thanhtoan@gmail.com', 'b94915bb6cdb18530628273537b6b054', 0, '93ceee5b95534fdd2e2f7cee14ca8fe6', 124566679, 'Thanh Hóa'),
('', 'thuvan0610@gmail.com', '', 0, 'Thu Vân', 869689684, 'Vạn Giã'),
('', 'h@gmail.com', '', 0, 'Mua ipad', 12345666, 'Thanh Hóa'),
('', 'h@gmail.com', '', 0, 'Mua ipad', 12345666, 'Thanh Hóa'),
('', 'thanhtoan@gmail.com', '', 0, 'Thu Vân', 124566679, 'Nha Trang'),
('', 'thanhtoan@gmail.com', '', 0, 'Trần Văn A', 124566679, 'Nha Trang'),
('Mua tai nghe', 'thuvan0610@gmail.com', '', 0, 'Thu Vân', 869689684, 'Nha Trang'),
('', 'thanhtoan@gmail.com', '', 0, 'Thu Vân', 124566679, 'Nha Trang'),
('', 'thanhtoan@gmail.com', '', 0, 'Thu Vân', 124566679, 'Nha Trang'),
('', 'quochoi0857@gmail.com', '', 0, 'Mua macbook', 869689684, 'Vạn Giã'),
('', 'h@gmail.com', '', 0, 'test', 12345666, 'Phú Yên'),
('', 'thanhtoan@gmail.com', '', 0, 'Thu Vân', 124566679, 'Nha Trang'),
('', 'thanhtoan@gmail.com', '', 0, 'Thu Vân', 12345678, 'Nha Trang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `client_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `oder_status` int(11) NOT NULL DEFAULT '0',
  `cancel_oder` int(11) NOT NULL,
  `order_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_many` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`client_id`, `order_date`, `oder_status`, `cancel_oder`, `order_id`, `product_id`, `order_many`) VALUES
(59, '2025-11-06 16:27:06', 0, 0, 12, 4, 6),
(62, '2025-11-06 01:10:09', 0, 0, 15, 8, 1),
(63, '2025-11-06 01:15:08', 0, 0, 16, 12, 1),
(65, '2025-11-11 02:21:35', 0, 0, 18, 40, 10),
(66, '2025-11-06 15:18:21', 0, 0, 19, 38, 1),
(67, '2025-11-06 15:28:49', 0, 0, 20, 5, 20),
(69, '2025-11-07 03:02:17', 0, 0, 22, 5, 1),
(70, '2025-11-07 03:03:43', 0, 0, 23, 26, 1),
(71, '2025-11-07 03:04:30', 0, 0, 24, 5, 1),
(72, '2025-11-10 06:25:22', 0, 0, 25, 44, 1),
(72, '2025-11-10 06:25:22', 0, 0, 26, 42, 1),
(72, '2025-11-10 06:25:22', 0, 0, 27, 25, 10),
(74, '2025-11-10 06:27:21', 0, 0, 28, 42, 1),
(77, '2025-11-10 06:29:39', 0, 0, 29, 5, 1),
(78, '2025-11-10 06:30:57', 0, 0, 30, 5, 1),
(80, '2025-11-10 06:32:13', 0, 0, 31, 41, 1),
(81, '2025-11-10 06:35:08', 0, 0, 32, 27, 5),
(82, '2025-11-10 15:44:38', 0, 0, 33, 44, 1),
(83, '2025-11-10 15:48:21', 0, 0, 34, 4, 1),
(83, '2025-11-10 15:48:21', 0, 0, 35, 5, 1),
(84, '2025-11-10 15:49:13', 0, 0, 36, 44, 1),
(85, '2025-11-10 15:52:03', 0, 0, 37, 5, 1),
(86, '2025-11-10 15:57:24', 0, 0, 38, 4, 1),
(87, '2025-11-10 15:58:53', 0, 0, 39, 44, 1),
(88, '2025-11-10 15:59:19', 0, 0, 40, 5, 10),
(89, '2025-11-10 16:43:35', 0, 0, 41, 5, 1),
(89, '2025-11-10 16:43:35', 0, 0, 42, 5, 1),
(90, '2025-11-11 02:37:55', 0, 0, 43, 44, 5),
(90, '2025-11-11 02:37:55', 0, 0, 44, 4, 5),
(90, '2025-11-11 02:37:55', 0, 0, 45, 44, 2),
(90, '2025-11-11 02:37:55', 0, 0, 46, 44, 5),
(91, '2025-11-11 02:38:49', 0, 0, 47, 38, 1),
(92, '2025-11-11 03:10:48', 0, 0, 48, 28, 10),
(92, '2025-11-11 03:10:48', 0, 0, 49, 43, 5),
(93, '2025-11-11 05:00:55', 0, 0, 50, 4, 4),
(93, '2025-11-11 05:00:55', 0, 0, 51, 5, 2),
(94, '2025-11-11 05:26:47', 0, 0, 52, 4, 2),
(94, '2025-11-11 05:26:47', 0, 0, 53, 34, 10),
(95, '2025-11-11 10:37:04', 0, 0, 54, 5, 3),
(95, '2025-11-11 10:37:04', 0, 0, 55, 38, 1),
(96, '2025-11-11 11:36:57', 0, 0, 56, 38, 4),
(96, '2025-11-11 11:36:57', 0, 0, 57, 4, 7),
(96, '2025-11-11 11:36:57', 0, 0, 58, 41, 10),
(97, '2025-11-11 11:37:22', 0, 0, 59, 5, 6),
(98, '2025-11-11 11:37:59', 0, 0, 60, 38, 6),
(99, '2025-11-11 11:45:37', 0, 0, 61, 4, 10),
(100, '2025-11-11 11:47:30', 0, 0, 62, 5, 48),
(101, '2025-11-11 11:56:07', 0, 0, 63, 43, 5),
(102, '2025-11-11 11:59:01', 0, 0, 64, 5, 5);
-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_detail` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_warranty` varchar(100) NOT NULL DEFAULT '1 năm',
  `product_sale` varchar(100) NULL,
  `product_active` int(11) NOT NULL,
  `product_hot` int(11) NOT NULL,
  `product_many` int(11) NOT NULL,
  `product_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_detail`, `product_id`, `category_id`, `product_name`, `product_price`, `product_sale`, `product_active`, `product_hot`, `product_many`, `product_img`) VALUES
('Màn hình HDR True Tone, dải màu rộng (P3), Haptic Touch, tỷ lệ tương phản 2.000.000:1, độ sáng tối đa 800 nit và đỉnh 1200 nit (HDR), lớp phủ kháng dầu và hỗ trợ hiển thị nhiều ngôn ngữ.', 4, 2, 'iPhone 14', '20000000', '', 1, 1, 19, '7.jpg'),
('Màn hình Super Retina XDR, màn hình toàn phần OLED 6,1 inch, công nghệ Dynamic Island.', 5, 2, 'iPhone 15', '30000000', '', 1, 1, 20, '8.jpg'),
('Màn hình Multi-Touch 10,9 inch LED nền IPS, độ phân giải 2360x1640, True Tone, độ sáng 500 nit, lớp phủ kháng dầu, hỗ trợ Apple Pencil (USB-C) và bàn phím.', 25, 3, 'iPad Gen 10', '11500000', '', 1, 0, 10, '1.jpg'),
('Camera Wide 8MP khẩu độ ƒ/2.4, zoom kỹ thuật số 5x, chụp Panorama, HDR, chống rung và chế độ chụp liên tục.', 26, 3, 'iPad Gen 9', '9000000', '', 1, 0, 10, '6.jpg'),
('AirPods có thiết kế nhẹ, dạng đường viền, thân ngắn hơn 33%, cảm biến lực giúp điều khiển dễ dàng và cảm giác đeo thoải mái.', 27, 4, 'AirPods (thế hệ thứ 3)', '5000000', '', 1, 0, 9, '13.jpg'),
('Magic Trackpad kết nối không dây, hỗ trợ Multi-Touch và Force Touch, cho phép nhấn ở bất kỳ vị trí nào trên bề mặt.', 28, 4, 'Magic Trackpad', '4000000', '', 1, 0, 10, '14.jpg'),
('Magic Mouse kết nối không dây, sạc lại được, thiết kế đáy tối ưu cho chuyển động mượt mà và bề mặt Multi-Touch hỗ trợ thao tác vuốt và cuộn.', 29, 4, 'Magic Mouse', '2400000', '', 1, 0, 10, '15.jpg'),
('Magic Keyboard Folio dành cho iPad Gen 10, tích hợp bàn di chuột, 14 phím chức năng và thiết kế hai phần linh hoạt.', 30, 4, 'Magic Keyboard Folio', '7000000', '', 1, 0, 10, '17.jpg'),
('Magic Keyboard có Touch ID, đem lại trải nghiệm gõ phím chính xác và thoải mái, tích hợp Numeric Keypad.', 31, 4, 'Magic Keyboard', '4700000', '', 1, 0, 10, '16.jpg'),
('Smart Folio mỏng nhẹ, bảo vệ mặt trước và sau iPad, tự động bật tắt màn hình, gắn bằng nam châm và gập được nhiều kiểu.', 32, 4, 'Smart Folio', '2200000', '', 1, 0, 10, '18.jpg'),
('Bộ Tiếp Hợp USB-C sang Apple Pencil dùng để ghép nối và sạc Apple Pencil (thế hệ 1) với iPad Gen 10.', 33, 4, 'Bộ Tiếp Hợp USB-C sang Apple Pencil', '300000', '', 1, 0, 10, '19.jpg'),
('AirPods Pro thế hệ 2 với khử tiếng ồn chủ động mạnh gấp đôi, chế độ xuyên âm và âm thanh thích ứng.', 34, 4, 'AirPods Pro (thế hệ thứ 2)', '6200000', '', 1, 0, 10, '20.jpg'),
('Apple Pencil (USB-C) phù hợp cho ghi chú, phác họa, đánh dấu tài liệu, độ chính xác cao, độ trễ thấp và nhạy với độ nghiêng.', 35, 4, 'Apple Pencil (USB-C)', '2000000', '', 1, 0, 10, '21.jpg'),
('Màn hình Multi-Touch 10,9 inch LED IPS, dải màu rộng (P3), True Tone, lớp phủ kháng dầu và mặt kính cán mỏng.', 36, 3, 'iPad Air 5', '13000000', '', 1, 0, 10, '37.jpg'),
('Camera Wide 8MP, khẩu độ ƒ/2.4, zoom 5x, Panorama 43MP, HDR và chống rung, phù hợp với iPhone 15 Pro.', 38, 2, 'iPhone 15 Pro', '40000000', '', 1, 1, 0, '9.jpg'),
('iPad mini 6 dùng chip A15 Bionic 6 nhân với 15 nghìn tỷ bóng dẫn, hiệu suất mạnh hơn và tiết kiệm năng lượng hơn 15% so với A14.', 40, 3, 'iPad mini', '20000000', '', 1, 1, 10, '3.jpg'),
('iPad Air 4 có màn hình Liquid Retina 10.9 inch, độ phân giải 1640x2360, True Tone, dải màu P3 và độ hiển thị chính xác.', 41, 3, 'iPad Air 4', '11500000', '', 1, 1, 0, '2.jpg'),
('iPad Pro 11 có màn hình Liquid Retina 11 inch, LED nền IPS, độ phân giải 2388x1668, ProMotion, dải màu P3 và True Tone.', 42, 3, 'iPad Pro 11', '22000000', '', 1, 1, 10, '5.jpg'),
('MacBook Pro 14 dùng chip Apple M1 Pro, tiến trình 5nm, CPU 8 lõi với hiệu năng mạnh hơn 70%.', 43, 1, 'Macbook Pro 14', '48999000', '', 1, 1, 3, '11.jpg'),
('MacBook Air M1 mang lại hiệu năng vượt trội, xử lý tốt tác vụ văn phòng và đồ hoạ chuyên nghiệp.', 44, 1, 'MacBook Air M1', '27000000', '', 1, 1, 10, '10.jpg'),
('MacBook Pro 16 với màn hình Liquid Retina XDR 16 inch, ba cổng Thunderbolt 4, HDMI, SDXC, MagSafe 3 và sạc USB-C 140W.', 45, 1, 'MacBook Pro 16', '75000000', '', 1, 1, 0, '12.jpg'),
-- iPhone 15 series (ví dụ nâng cấp thêm các model)
('iPhone 15 Plus, màn hình Super Retina XDR, Dynamic Island, camera Pro 48MP, Face ID.', 46, 2, 'iPhone 15 Plus', '32000000', '', 1, 1, 10, 'ip15.jpg'),
('iPhone 15 Pro, màn hình Super Retina XDR 6.1 inch, chip A17 Bionic, camera Pro 48MP, Dynamic Island.', 47, 2, 'iPhone 15 Pro', '40000000', '', 1, 1, 5, '15pro.jpg'),
('iPhone 15 Pro Max, màn hình 6.7 inch, chip A17 Bionic, zoom quang 5x, camera Pro nâng cao.', 48, 2, 'iPhone 15 Pro Max', '47000000', '', 1, 1, 5, '15pm.jpg'),
-- iPhone 16 series
('iPhone 16, màn hình Super Retina XDR, chip A18 Bionic, camera nâng cấp.', 49, 2, 'iPhone 16', '50000000', '', 1, 1, 10, 'ip16.png'),
('iPhone 16 Pro, màn hình 6.1 inch, chip A18 Bionic, camera Pro 48MP, Dynamic Island.', 50, 2, 'iPhone 16 Pro', '58000000', '', 1, 1, 5, '16p.png'),
('iPhone 16e, màn hình 6.7 inch, chip A18 Bionic, zoom quang 5x, camera Pro cao cấp.', 51, 2, 'iPhone 16e', '65000000', '', 1, 1, 5, '16e.jpg'),
-- iPhone 17 series
('iPhone 17, màn hình Super Retina XDR, chip A19 Bionic, camera nâng cấp với chế độ Pro.', 52, 2, 'iPhone 17', '68000000', '', 1, 1, 10, 'ip17.jpg'),
('iPhone 17 Pro, màn hình 6.1 inch, chip A19 Bionic, camera Pro 48MP, Dynamic Island.', 53, 2, 'iPhone 17 Pro', '75000000', '', 1, 1, 5, '17p.jpg'),
('iPhone 17 Pro Max, màn hình 6.7 inch, chip A19 Bionic, zoom quang 5x, camera Pro cao cấp.', 54, 2, 'iPhone 17 Pro Max', '82000000', '', 1, 1, 5, '17pm.jpg'),
-- MacBook mới
('MacBook Pro M5 16 inch 2025, chip M3 Pro, RAM 32GB, SSD 1TB, màn hình Liquid Retina XDR.', 55, 1, 'MacBook Pro M5', '85000000', '', 1, 1, 3, 'm55.jpg'),
('MacBook Air 2025, chip M3, RAM 16GB, SSD 512GB, mỏng nhẹ, pin dài 18 giờ.', 56, 1, 'MacBook Air M3', '45000000', '', 1, 1, 10, 'air.jpg'),
('MacBook Pro 16 inch 2025, chip M3 Max, RAM 64GB, SSD 2TB, màn hình Liquid Retina XDR 16 inch, hiệu năng cao.', 57, 1, 'MacBook Pro 16 M3 Max', '155000000', '', 1, 1, 2, 'p16.jpg');


-- --------------------------------------------------------

--
-- Table structure for table `tb_transaction`
--

CREATE TABLE `tb_transaction` (
  `transaction_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `transaction_many` int(11) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `client_id` int(11) NOT NULL,
  `oder_status` int(11) NOT NULL DEFAULT '0',
  `canceloder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaction`
--

INSERT INTO `tb_transaction` (`transaction_id`, `product_id`, `transaction_many`, `transaction_date`, `client_id`, `oder_status`, `canceloder`) VALUES
(1, 4, 6, '2025-11-12 13:11:00', 59, 1, 0),
(2, 8, 1, '2025-11-12 01:10:09', 62, 0, 0),
(3, 12, 1, '2025-11-12 01:15:08', 63, 0, 0),
(4, 38, 50, '2025-11-12 01:39:53', 64, 1, 0),
(5, 40, 10, '2025-11-12 01:51:58', 65, 0, 0),
(8, 4, 6, '2025-11-12 13:06:25', 59, 1, 0),
(9, 8, 1, '2025-11-12 01:10:09', 62, 0, 0),
(10, 12, 1, '2025-11-12 01:15:08', 63, 0, 0),
(11, 38, 50, '2025-11-12 01:39:53', 64, 1, 0),
(12, 40, 10, '2025-11-12 01:51:58', 65, 0, 0),
(15, 41, 60, '2025-11-11 17:00:00', 68, 0, 0),
(16, 5, 1, '2025-11-11 17:00:00', 69, 0, 0),
(17, 26, 1, '2025-11-11 17:00:00', 70, 0, 0),
(18, 5, 1, '2025-11-11 17:00:00', 71, 0, 0),
(19, 4, 1, '2025-11-11 17:00:00', 83, 0, 0),
(20, 5, 1, '2025-11-11 17:00:00', 83, 0, 0),
(22, 44, 1, '2025-11-11 17:00:00', 84, 0, 0),
(23, 5, 1, '2025-11-11 17:00:00', 85, 0, 0),
(24, 4, 1, '2025-11-11 17:00:00', 86, 0, 0),
(25, 44, 1, '2025-11-11 17:00:00', 87, 0, 0),
(26, 5, 10, '2025-11-11 17:00:00', 88, 0, 0),
(27, 5, 1, '2025-11-11 17:00:00', 89, 0, 0),
(28, 5, 1, '2025-11-11 17:00:00', 89, 0, 0),
(29, 44, 5, '2025-11-11 17:00:00', 90, 0, 0),
(30, 4, 5, '2025-11-11 17:00:00', 90, 0, 0),
(31, 44, 2, '2025-11-11 17:00:00', 90, 0, 0),
(32, 44, 5, '2025-11-11 17:00:00', 90, 0, 0);


DROP TRIGGER IF EXISTS auto_warranty;
DELIMITER $$

CREATE TRIGGER auto_warranty
BEFORE INSERT ON tb_product
FOR EACH ROW
BEGIN
    IF NEW.category_id IN (1,2,3) THEN
        SET NEW.product_warranty = '1 năm';
    END IF;
END$$

DELIMITER ;

UPDATE tb_product
SET product_warranty = CASE
    WHEN category_id IN (1,2,3) THEN '1 năm'
    WHEN category_id = 4 THEN '6 tháng'
    ELSE '0 tháng'
END;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
