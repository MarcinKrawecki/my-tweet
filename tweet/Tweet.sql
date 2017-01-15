-- phpMyAdmin SQL Dump
-- version 4.6.4deb1+deb.cihar.com~xenial.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2016 at 12:44 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tweet`
--

-- --------------------------------------------------------

--
-- Table structure for table `coments`
--

CREATE TABLE `coments` (
  `id` int(11) NOT NULL,
  `content` varchar(60) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coments`
--

INSERT INTO `coments` (`id`, `content`, `user_id`, `news_id`, `creation_date`) VALUES
(1, 'something', 1, 2, '2016-11-29 19:59:41'),
(2, 'anything', 2, 3, '2016-11-29 19:59:41'),
(3, 'nothing', 3, 1, '2016-11-29 19:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text,
  `user_id_sender` int(11) DEFAULT NULL,
  `user_id_reciver` int(11) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `messege_read` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `user_id_sender`, `user_id_reciver`, `creation_date`, `messege_read`) VALUES
(1, 'text1', 1, 2, '2016-11-29 19:59:42', NULL),
(2, 'text2', 2, 3, '2016-11-29 19:59:42', NULL),
(3, 'text3', 3, 1, '2016-11-29 19:59:42', NULL),
(4, '67', 4, 2, '2016-12-01 20:16:11', NULL),
(5, '90', 4, 1, '2016-12-01 20:16:20', NULL),
(6, '0', 1, 2, '2016-12-02 10:59:17', NULL),
(7, 'asdfghjkl', 1, 4, '2016-12-02 10:59:46', NULL),
(8, 'do johna', 2, 4, '2016-12-02 11:00:29', NULL),
(9, 'do adama', 2, 3, '2016-12-02 11:00:48', NULL),
(10, 'AHJ', 1, 3, '2016-12-02 13:59:17', NULL),
(11, '14:01', 1, 4, '2016-12-02 14:01:47', NULL),
(12, '5', 1, 2, '2016-12-02 14:22:22', NULL),
(13, '14:22', 1, 4, '2016-12-02 14:22:38', NULL),
(14, 'sdfg', 1, 3, '2016-12-02 17:12:29', NULL),
(15, 'dziala', 1, 4, '2016-12-02 17:51:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `content` varchar(140) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `content`, `user_id`, `creation_date`) VALUES
(1, 'new news1', 1, '2016-11-29 19:59:41'),
(2, 'new news2', 2, '2016-11-29 19:59:41'),
(3, 'new news3', 3, '2016-11-29 19:59:41'),
(4, 'new news1', 1, '2016-12-01 18:26:58'),
(5, '1234', 1, '2016-12-01 18:51:15'),
(6, '1234', 1, '2016-12-01 18:52:19'),
(7, '1234', 1, '2016-12-01 18:52:38'),
(8, '1234', 1, '2016-12-01 18:57:28'),
(9, '234567', 4, '2016-12-01 18:58:04'),
(10, '234567', 4, '2016-12-01 19:05:29'),
(11, '234567', 4, '2016-12-01 19:07:04'),
(12, '234567', 4, '2016-12-01 19:07:07'),
(13, '234567', 4, '2016-12-01 19:07:18'),
(14, '234567', 4, '2016-12-01 19:09:03'),
(15, '234567', 4, '2016-12-01 19:09:53'),
(16, '234567', 4, '2016-12-01 19:12:25'),
(17, '234567', 4, '2016-12-01 19:12:54'),
(18, '234567', 4, '2016-12-01 19:13:21'),
(19, '234567', 4, '2016-12-01 19:14:48'),
(20, '234567', 4, '2016-12-01 19:17:18'),
(21, '234567', 4, '2016-12-01 19:17:53'),
(22, '234567', 4, '2016-12-01 19:18:17'),
(23, '234567', 4, '2016-12-01 19:18:35'),
(24, '234567', 4, '2016-12-01 19:18:39'),
(25, '234567', 4, '2016-12-01 19:18:42'),
(26, '234567', 4, '2016-12-01 19:18:45'),
(27, '234567', 4, '2016-12-01 19:18:46'),
(28, '999', 4, '2016-12-02 12:19:13'),
(29, 'asdfghjk', 1, '2016-12-02 17:51:09'),
(30, 'dziala!!!!', 1, '2016-12-02 17:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(64) DEFAULT NULL,
  `user_password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'John', 'john@co.uk', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Ann', 'ann@co.uk', '674f3c2c1a8a6f90461e8a66fb5550ba'),
(3, 'Adam', 'adam@co.uk', 'c5c53759e4dd1bfe8b3dcfec37d0ea72'),
(4, 'etan', 'etan@co.uk', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coments`
--
ALTER TABLE `coments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_coments_user_id_users_id` (`user_id`),
  ADD KEY `FK_coments_news_id_news_id` (`news_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_messages_user_id_sender_users_id` (`user_id_sender`),
  ADD KEY `FK_messages_user_id_reciver_users_id` (`user_id_reciver`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_news_user_id_users_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coments`
--
ALTER TABLE `coments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `coments`
--
ALTER TABLE `coments`
  ADD CONSTRAINT `FK_coments_news_id_news_id` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `FK_coments_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_messages_user_id_reciver_users_id` FOREIGN KEY (`user_id_reciver`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_messages_user_id_sender_users_id` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_news_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
