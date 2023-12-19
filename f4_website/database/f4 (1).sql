-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 03:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f4`
--
CREATE DATABASE IF NOT EXISTS `f4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `f4`;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(55) NOT NULL,
  `combopackage_id` int(11) NOT NULL,
  `act_type_id` int(11) NOT NULL,
  `activity_image` varchar(255) NOT NULL,
  `available_time` time NOT NULL,
  `description` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - active || I - inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `activity_name`, `combopackage_id`, `act_type_id`, `activity_image`, `available_time`, `description`, `location_id`, `price`, `status`) VALUES
(1, 'Sumlang lake tour', 2, 1, '../images/sumlang_lake.jpg\"', '00:00:00', 'Embark on a serene journey at Sumlang Lake in Camalig, Albay. Nestled under the watchful gaze of Mayon Volcano, enjoy a peaceful boat ride amidst lush greenery. Nature\'s beauty unfolds as you unwind by the lake\'s tranquil waters.\r\n#SumlangLakeEscape', 1, 25, 'A'),
(2, 'Balsa Tour in Sumlang lake', 2, 3, '../images/balsa_tour_sumlanglake.jpg', '00:00:00', 'Dive into the hearat of nature with our Sumlang Lake Balsa Tour! Drift gently on the crystal-clear waters surrounded by the stunning landscapes of Camalig, Albay. Relax, soak in the picturesque views, and let the gentle ripples guide you through an unforgettable experience.#SumlangBalsaTour#NatureEscape', 1, 25, 'A'),
(3, 'Kayaking in Sumlang lake', 2, 3, '../images/kayaking_sumlanglake.jpg', '00:00:00', 'Embark on an exhilarating kayaking adventure at Sumlang Lake! Paddle through the pristine waters against the backdrop of Mayon Volcano, immersing yourself in the natural beauty of Camalig, Albay. Whether you\'re a novice or an experienced paddler, the calm lake offers a perfect setting for a memorable kayaking experience.\r\n#kayakSumlangLake\r\n#NatureThrills', 1, 50, 'A'),
(6, 'Aqua Biking in Sumlang lake (30 min)', 2, 3, '../images/aqua_biking_sumlanglake.jpeg', '00:00:00', 'Explore the beauty of Sumlang Lake in a unique way with our Aqua Biking experience! Glide effortlessly on the water, combining the thrill of biking with the tranquility of the lake. Enjoy the stunning views of Camalig, Albay, and Mayon Volcano while indulging in a refreshing and exciting aquatic adventure.\r\n#SumlangAquaBiking\r\n#Lakeadventure', 1, 50, 'A'),
(7, 'Floating cottage for Sumlang lake', 2, 3, '../images/floating_cottage_sumlanglake.jpeg', '00:00:00', 'Experience blessful tranquility in our Floating Cottage at Sumlang Lake. Nestled against the breathtaking backdrop of Mayon Volcano in Camalig, Albay, this charming escape offers a peaceful oasis atop the gentle ripples of the lake. Immerse yourself in nature\'s embrace while enjoying the comfort of a floating haven.\r\n#SumlangFloatingCottage\r\n#LakeRetreat', 1, 300, 'A'),
(8, 'Balsa Tour in Sumlang lake', 1, 1, '../images/balsa_tour_sumlanglake.jpg', '00:00:00', 'Dive into the hearat of nature with our Sumlang Lake Balsa Tour! Drift gently on the crystal-clear waters surrounded by the stunning landscapes of Camalig, Albay. Relax, soak in the picturesque views, and let the gentle ripples guide you through an unforgettable experience.\r\n#SumlangBalsaTour\r\n#NatureEscape', 1, 50, 'A'),
(9, 'Kayaking in Sumlang lake', 1, 4, '../images/kayaking_sumlanglake.jpg', '00:00:00', 'Embark on an exhilarating kayaking adventure at Sumlang Lake! Paddle through the pristine waters against the backdrop of Mayon Volcano, immersing yourself in the natural beauty of Camalig, Albay. Whether you\'re a novice or an experienced paddler, the calm lake offers a perfect setting for a memorable kayaking experience.\r\n#kayakSumlangLake\r\n#NatureThrills', 1, 75, 'A'),
(10, 'Aqua Biking in Sumlang lake (30 min)', 1, 4, '../images/aqua_biking_sumlanglake.jpeg', '00:00:00', 'Explore the beauty of Sumlang Lake in a unique way with our Aqua Biking experience! Glide effortlessly on the water, combining the thrill of biking with the tranquility of the lake. Enjoy the stunning views of Camalig, Albay, and Mayon Volcano while indulging in a refreshing and exciting aquatic adventure.\r\n#SumlangAquaBiking\r\n#Lakeadventure', 1, 75, 'A'),
(11, 'Floating cottage for Sumlang lake', 1, 4, '../images/floating_cottage_sumlanglake.jpeg', '00:00:00', 'Experience blessful tranquility in our Floating Cottage at Sumlang Lake. Nestled against the breathtaking backdrop of Mayon Volcano in Camalig, Albay, this charming escape offers a peaceful oasis atop the gentle ripples of the lake. Immerse yourself in nature\'s embrace while enjoying the comfort of a floating haven.\r\n#SumlangFloatingCottage\r\n#LakeRetreat', 1, 325, 'A'),
(12, 'Cagsawa Ruins Tour', 3, 1, '', '00:00:00', '', 1, 20, 'A'),
(13, 'Short Trail ATV in Camalig Ruins', 3, 3, '', '00:00:00', '', 1, 300, 'A'),
(14, 'Snake Trail ATV in Camalig Ruins', 3, 3, '', '00:00:00', '', 1, 500, 'A'),
(15, 'Grassland Trail ATV in Camalig Ruins', 3, 3, '', '00:00:00', '', 1, 600, 'A'),
(16, 'Green Lava Trail ATV in Camalig Ruins', 3, 3, '', '00:00:00', '', 1, 1600, 'A'),
(17, 'Black Lava Trail ATV in Camalig Ruins', 3, 3, '', '00:00:00', '', 1, 1850, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `activities_copy`
--

CREATE TABLE `activities_copy` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(55) NOT NULL,
  `combopackage_id` int(11) NOT NULL,
  `act_type_id` int(11) NOT NULL,
  `activity_image` varchar(255) NOT NULL,
  `available_time` time NOT NULL,
  `address` varchar(255) NOT NULL COMMENT 'may be deleted later on due to irrelevancy',
  `description` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities_copy`
--

INSERT INTO `activities_copy` (`activity_id`, `activity_name`, `combopackage_id`, `act_type_id`, `activity_image`, `available_time`, `address`, `description`, `location_id`, `price`) VALUES
(1, 'Sumlang lake', 0, 1, '', '00:00:00', '', '', 1, 0),
(2, 'Cagsawa ruins', 0, 1, '', '00:00:00', '', '', 1, 0),
(3, 'Farm Plate', 0, 1, '', '00:00:00', '', '', 1, 0),
(4, 'Highlands Park', 0, 1, '', '00:00:00', 'Boulevard, Legazpi City', '', 1, 0),
(5, 'Bambusetum Park', 0, 1, '', '00:00:00', 'Kawa Kawa', '', 1, 20),
(6, 'De Mansions Events Place', 0, 1, '', '00:00:00', 'Purok 5, Rawis, Legazpi City', '', 1, 50),
(7, 'Cagsawa ruins ATV Adventure (short trail)', 0, 2, '', '00:00:00', '', '- A trail of shorter distance or duration.\r\n- May be suitable for beginners or those looking for a quick ride.', 1, 300),
(8, 'Cagsawa ruins ATV Adventure (snake trail)', 0, 2, '', '00:00:00', '', '- A winding or curving trail resembling a snake\'s path.\r\n- Could offer a more challenging and adventurous ride.', 1, 500),
(9, 'Cagsawa ruins ATV Adventure (Grassland trail)', 0, 2, '', '00:00:00', '', '- A trail through a grassy landscape.\r\n- Offers a different terrain experience more open and scenic view.', 1, 600),
(10, 'Cagsawa ruins ATV Adventure (Green Lava Trail)', 0, 2, '', '00:00:00', '', '- A trail with green vegetation-covered volcanic terrain.\r\n- It showcase a lush surrounding.', 1, 1600),
(11, 'Cagsawa ruins ATV Adventure (Black Lava Trail)', 0, 2, '', '00:00:00', '', '- A trail through volcanic terrain with black surrounding.\r\n- Solidified lava and volcanic rocks can put a challenge on the rides', 1, 1850),
(12, 'Sumlang lake', 0, 1, '', '00:00:00', '', '', 1, 0),
(13, 'Cagsawa ruins', 0, 1, '', '00:00:00', '', '', 1, 0),
(14, 'Farm Plate', 0, 1, '', '00:00:00', '', '', 1, 0),
(15, 'Highlands Park', 0, 1, '', '00:00:00', 'Boulevard, Legazpi City', '', 1, 0),
(16, 'Bambusetum Park', 0, 1, '', '00:00:00', 'Kawa Kawa', '', 1, 20),
(17, 'De Mansions Events Place', 0, 1, '', '00:00:00', 'Purok 5, Rawis, Legazpi City', '', 1, 50),
(18, 'Cagsawa ruins ATV Adventure (short trail)', 0, 2, '', '00:00:00', '', '- A trail of shorter distance or duration.\r\n- May be suitable for beginners or those looking for a quick ride.', 1, 300),
(19, 'Cagsawa ruins ATV Adventure (snake trail)', 0, 2, '', '00:00:00', '', '- A winding or curving trail resembling a snake\'s path.\r\n- Could offer a more challenging and adventurous ride.', 1, 500),
(20, 'Cagsawa ruins ATV Adventure (Grassland trail)', 0, 2, '', '00:00:00', '', '- A trail through a grassy landscape.\r\n- Offers a different terrain experience more open and scenic view.', 1, 600),
(21, 'Cagsawa ruins ATV Adventure (Green Lava Trail)', 0, 2, '', '00:00:00', '', '- A trail with green vegetation-covered volcanic terrain.\r\n- It showcase a lush surrounding.', 1, 1600),
(22, 'Cagsawa ruins ATV Adventure (Black Lava Trail)', 0, 2, '', '00:00:00', '', '- A trail through volcanic terrain with black surrounding.\r\n- Solidified lava and volcanic rocks can put a challenge on the rides', 1, 1850);

-- --------------------------------------------------------

--
-- Table structure for table `activitytype`
--

CREATE TABLE `activitytype` (
  `act_type_id` int(11) NOT NULL,
  `act_type_name` varchar(55) NOT NULL,
  `act_type_status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - active || I - inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activitytype`
--

INSERT INTO `activitytype` (`act_type_id`, `act_type_name`, `act_type_status`) VALUES
(1, 'Tour', 'A'),
(2, 'ATV', 'A'),
(3, 'package', 'A'),
(4, 'aquatic', 'A'),
(5, 'Extreme', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `bookingpackage`
--

CREATE TABLE `bookingpackage` (
  `booking_id` int(11) NOT NULL,
  `ref_num` varchar(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_amount` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` char(11) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingpackage`
--

INSERT INTO `bookingpackage` (`booking_id`, `ref_num`, `user_id`, `package_id`, `check_in_date`, `check_out_date`, `total_amount`, `order_date`, `status`) VALUES
(1, '69S5S3W6', 1, 2, '2023-12-05', '2023-12-05', 1770, '2023-12-19 03:55:15', 'Cancelled'),
(2, '56R0B4M4', 3, 5, '2023-12-30', '2023-12-31', 2400, '2023-12-19 03:34:05', 'Canceled'),
(3, '42G5Y6H8', 1, 3, '2023-12-05', '2023-12-05', 1050, '2023-12-19 03:33:55', 'Booked'),
(4, '50B4F2V3', 1, 3, '2023-12-18', '2023-12-18', 1050, '2023-12-19 04:19:33', 'Cancelled'),
(6, '26J4A3Y0', 1, 2, '2023-12-19', '2023-12-21', 1845, '2023-12-19 04:19:30', 'Cancelled'),
(7, '39W8H2Z4', 1, 5, '2023-12-23', '2023-12-24', 2650, '2023-12-19 04:43:13', 'Canceled'),
(8, '36Q3B2X3', 4, 2, '2023-12-26', '2023-12-19', 2100, '2023-12-19 05:42:11', 'Pending'),
(9, '99F2R9M5', 1, 3, '2023-12-19', '2023-12-20', 1075, '2023-12-19 06:45:39', 'Pending'),
(10, '67A0X1K5', 3, 3, '2023-12-19', '2023-12-19', 1050, '2023-12-19 07:09:25', 'Pending'),
(11, '21S8L1Q8', 1, 3, '2023-12-19', '2023-12-21', 1100, '2023-12-19 08:01:40', 'Pending'),
(12, '24Q6D5K5', 1, 2, '2023-12-19', '2023-12-19', 1775, '2023-12-19 08:29:22', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `combopackage`
--

CREATE TABLE `combopackage` (
  `combopackage_id` int(11) NOT NULL,
  `combopackage_name` varchar(55) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - active || I - inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `combopackage`
--

INSERT INTO `combopackage` (`combopackage_id`, `combopackage_name`, `status`) VALUES
(1, 'None', 'A'),
(2, 'sumlang_lake_package', 'A'),
(3, 'cagsawa-ruins_package', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `customerschedule`
--

CREATE TABLE `customerschedule` (
  `schedule_id` int(11) NOT NULL,
  `ref_num` varchar(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `start_of_activity` time NOT NULL,
  `end_of_activity` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerschedule`
--

INSERT INTO `customerschedule` (`schedule_id`, `ref_num`, `user_id`, `day`, `activity_id`, `start_of_activity`, `end_of_activity`) VALUES
(1, '69S5S3W6', 1, 1, 12, '00:00:00', '12:00:00'),
(2, '56R0B4M4', 3, 1, 9, '12:00:00', '18:00:00'),
(3, '56R0B4M4', 3, 2, 10, '12:00:00', '18:00:00'),
(4, '42G5Y6H8', 1, 1, 3, '12:00:00', '18:00:00'),
(5, '50B4F2V3', 1, 1, 6, '12:00:00', '18:00:00'),
(6, '26J4A3Y0', 1, 1, 1, '12:00:00', '18:00:00'),
(7, '26J4A3Y0', 1, 2, 8, '12:00:00', '18:00:00'),
(8, '26J4A3Y0', 1, 3, 12, '12:00:00', '18:00:00'),
(9, '39W8H2Z4', 1, 1, 9, '12:00:00', '18:00:00'),
(10, '39W8H2Z4', 1, 2, 11, '12:00:00', '18:00:00'),
(11, '36Q3B2X3', 4, 1, 1, '12:00:00', '18:00:00'),
(12, '36Q3B2X3', 4, 2, 8, '12:00:00', '18:00:00'),
(13, '36Q3B2X3', 4, 3, 8, '12:00:00', '18:00:00'),
(14, '36Q3B2X3', 4, 4, 8, '12:00:00', '18:00:00'),
(15, '36Q3B2X3', 4, 5, 8, '12:00:00', '18:00:00'),
(16, '36Q3B2X3', 4, 6, 8, '12:00:00', '18:00:00'),
(17, '36Q3B2X3', 4, 7, 8, '12:00:00', '18:00:00'),
(18, '36Q3B2X3', 4, 8, 1, '12:00:00', '18:00:00'),
(19, '99F2R9M5', 1, 1, 1, '12:00:00', '18:00:00'),
(20, '99F2R9M5', 1, 2, 3, '12:00:00', '18:00:00'),
(21, '67A0X1K5', 3, 1, 6, '12:00:00', '18:00:00'),
(22, '21S8L1Q8', 1, 1, 1, '12:00:00', '18:00:00'),
(23, '21S8L1Q8', 1, 2, 2, '12:00:00', '18:00:00'),
(24, '21S8L1Q8', 1, 3, 3, '12:00:00', '18:00:00'),
(25, '24Q6D5K5', 1, 1, 1, '12:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_message` text NOT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(55) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - active || I - inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `status`) VALUES
(1, 'Albay', 'I'),
(2, 'Jovellar', 'I'),
(3, 'APPLE', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `type_of_package` varchar(55) NOT NULL COMMENT 'tour/package/adventure',
  `combopackage_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `package_cost` float NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - active || I - inactive',
  `package_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `description`, `type_of_package`, `combopackage_id`, `location_id`, `package_cost`, `status`, `package_img`) VALUES
(2, 'Albay All-day Tour', 'Explore the rich cultural tapestry and natural wonders of Albay with our All-Day Tour. Immerse youself in the local charm as you traverse through vibrant landscapes and witness the region\'s diverse heritage. Engage in a day filled with captivating experiences, from cultural encounters to scenic marvels. Our Albay All-Day Tour promises an unforgettable journey, unveiling the hidden gems and stories that make this destination truly special. Join us for a day of discovery and create lasting memories in the heart of Albay.', 'tour', 1, 1, 1750, 'A', '../images/ALBAY_all_tour (1).png'),
(3, 'Sumlang Lake Tour Package', 'This bountiful lake offers and unhindered view of Mt.Mayon. It has now become an Instagram-worthy attraction. Not much to do here except for the activities mentioned on the below, but it has a relaxing atmosphere as it is surrounded by greenery.', 'package', 2, 1, 1000, 'A', '../images/balsa_tour_sumlanglake.jpg'),
(4, 'Camalig Ruins Tour Package', 'Just outside the town proper of Daraga, Albay, lies th belfry of a 16th century church that was destroyed as Mayon had its most violent eruption in recorded history on Feb 1, 1814\r\n\r\nToday, the remains of the church (bell tower) is famous to thousands of tourist, both local and international, as it is set against the magnificent backdrop, the Mayon Volcano.', 'package', 3, 1, 1000, 'A', '../images/cagsawa_ruins.jpg'),
(5, 'Albay Adventure Package', 'Embark on an exhilarating journey with our Albay Adventure Package, a curated experience that blends nature\'s beauty and thrilling activities. Discover the picturesque landscapes of Albay while engaging in adrenaline-pumping adventures. From exploring volcanic wonders to embracing the vibrant local culture, this package offers a perfect blend of excitement and relaxation. Immerse yourself in the unique charm of Albay through outdoor activities and cultural encounters, creating memories that linger long after the adventure concludes. Albay Adventure Package - where every moment is a new discovery and every experience is an adventure.', 'adventure', 1, 1, 2250, 'A', '../images/Albay_Adventure_Package.png'),
(6, 'rdffffdf', 'dfdfdffdfdsf', 'tour', 1, 1, 4, 'I', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `middle_name` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `user_type` char(1) NOT NULL DEFAULT 'U' COMMENT 'U - user || A - admin',
  `user_status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - active || I - inactive',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `address`, `username`, `password`, `user_type`, `user_status`, `date_created`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', 'test', 'U', 'A', '2023-11-14 15:01:26'),
(2, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'A', 'A', '2023-11-26 15:30:08'),
(3, 'catina', 'selwyn', 'pogi', 'centro oriental', 'sellyboy', '123', 'U', 'A', '2023-12-05 05:51:55'),
(4, 'Baloloy', 'Rio', 'Bandoquillo', 'Pandayan SDA', 'toni', '123456', 'U', 'A', '2023-12-19 05:32:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `act_type_id` (`act_type_id`),
  ADD KEY `combopackage_id` (`combopackage_id`);

--
-- Indexes for table `activities_copy`
--
ALTER TABLE `activities_copy`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `act_type_id` (`act_type_id`);

--
-- Indexes for table `activitytype`
--
ALTER TABLE `activitytype`
  ADD PRIMARY KEY (`act_type_id`);

--
-- Indexes for table `bookingpackage`
--
ALTER TABLE `bookingpackage`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `combopackage`
--
ALTER TABLE `combopackage`
  ADD PRIMARY KEY (`combopackage_id`);

--
-- Indexes for table `customerschedule`
--
ALTER TABLE `customerschedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `combopackage_id` (`combopackage_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `activities_copy`
--
ALTER TABLE `activities_copy`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `activitytype`
--
ALTER TABLE `activitytype`
  MODIFY `act_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookingpackage`
--
ALTER TABLE `bookingpackage`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `combopackage`
--
ALTER TABLE `combopackage`
  MODIFY `combopackage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customerschedule`
--
ALTER TABLE `customerschedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`act_type_id`) REFERENCES `activitytype` (`act_type_id`),
  ADD CONSTRAINT `activities_ibfk_3` FOREIGN KEY (`combopackage_id`) REFERENCES `combopackage` (`combopackage_id`);

--
-- Constraints for table `bookingpackage`
--
ALTER TABLE `bookingpackage`
  ADD CONSTRAINT `bookingpackage_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`),
  ADD CONSTRAINT `bookingpackage_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `package_ibfk_2` FOREIGN KEY (`combopackage_id`) REFERENCES `combopackage` (`combopackage_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
