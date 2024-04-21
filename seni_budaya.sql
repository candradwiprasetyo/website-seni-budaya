-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 08:15 PM
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
-- Database: `seni_budaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `article_name` varchar(100) NOT NULL,
  `article_description` text NOT NULL,
  `article_images` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `article_name`, `article_description`, `article_images`, `created_at`, `updated_at`) VALUES
(1, 'Jaranan sebagai Kegemaran Kesenian Kampoeng Thengul, Kabupaten Bojonegoro', '', '1.webp', '2024-01-11 00:43:46', '2024-04-22 00:45:58'),
(2, 'Kolaborasi KKN UAD dan Padukuhan Padaan Kulon : Pentas Seni Ndolalak Munggang Sajikan Acara Perpisah', '', '2.webp', '2024-02-06 00:43:46', '2024-04-22 00:45:58'),
(3, 'Warisan Kerajinan Gerabah Khas Kasongan Jogja ', '', '3.webp', '2024-04-09 00:45:19', '2024-04-22 00:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `artworks`
--

CREATE TABLE `artworks` (
  `artwork_id` int(11) NOT NULL,
  `artwork_name` varchar(100) NOT NULL,
  `artwork_images` text NOT NULL,
  `artwork_description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artworks`
--

INSERT INTO `artworks` (`artwork_id`, `artwork_name`, `artwork_images`, `artwork_description`, `created_at`, `updated_at`) VALUES
(1, 'artwork 1', '1.jpg', '', '2024-04-22 00:24:13', '2024-04-22 00:24:13'),
(2, 'artwork 2', '2.jpg', '', '2024-04-22 00:24:13', '2024-04-22 00:24:13'),
(3, 'artwork 3', '3.jpeg', '', '2024-04-22 00:24:13', '2024-04-22 00:24:13'),
(4, 'artwork 4', '4.jpg', '', '2024-04-22 00:24:13', '2024-04-22 00:24:13'),
(5, 'artwork 5', '5.jpg', '', '2024-04-22 00:24:13', '2024-04-22 00:24:13'),
(6, 'artwork 6', '6.jpg', '', '2024-04-22 00:24:13', '2024-04-22 00:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_description` text NOT NULL,
  `event_location` varchar(100) NOT NULL,
  `event_images` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_description`, `event_location`, `event_images`, `created_at`, `updated_at`) VALUES
(1, 'Art Jog', '', 'Jogja National Museum', '1.webp', '2024-04-22 00:33:18', '2024-04-22 00:33:18'),
(2, 'Bencoolen Dhol Attraction', '', 'Taman Budaya Bengkulu', '2.webp', '2024-04-22 00:33:45', '2024-04-22 00:33:45'),
(3, 'Solo Batik Carnival', '', 'Jalan Slamet Riyadi Solo', '3.webp', '2024-04-22 00:34:25', '2024-04-22 00:34:25'),
(4, 'Tenggarong International Folk & Art Festival', '', 'Tenggarong, Kalimantan Timur', '4.webp', '2024-04-22 00:34:49', '2024-04-22 00:34:49'),
(5, 'Kenduri Seni Melayu', '', 'Harbour Bay Batam', '5.webp', '2024-04-22 00:35:10', '2024-04-22 00:35:10'),
(6, 'Katresnan Pagelaran Batang', '', 'Taman Budaya Yogyakarta', '6.webp', '2024-04-22 00:35:37', '2024-04-22 00:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL,
  `forum_title` text NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `forum_title`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Merajut Kebhinekaan Melalui Seni, Budaya dan Pariwisata', 'Binus Online Learning', '2024-01-17 00:52:06', '2024-04-22 00:53:21'),
(2, 'Bentang Tubuh, Batu, Hasrat : Sejumlah Esai Seni Rupa', 'Binus Online Learning', '2024-02-21 00:52:06', '2024-04-22 00:53:21'),
(3, 'Memaknai Wayang dan Gamelan Temu Silang Jawa, Islam, dan Global', 'Binus Online Learning', '2024-04-23 00:52:51', '2024-04-22 00:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_name` varchar(100) NOT NULL,
  `question_email` varchar(100) NOT NULL,
  `question_phone` varchar(20) NOT NULL,
  `question_title` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `artworks`
--
ALTER TABLE `artworks`
  ADD PRIMARY KEY (`artwork_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artworks`
--
ALTER TABLE `artworks`
  MODIFY `artwork_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
