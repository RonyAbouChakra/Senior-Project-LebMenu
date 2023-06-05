-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2023 at 12:03 PM
-- Server version: 5.7.35-log
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lebmenudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `video_source` text COLLATE utf8_bin NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_admin_ad` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ad`
--

INSERT INTO `ad` (`id`, `title`, `description`, `video_source`, `admin_id`) VALUES
(3, 'New restaurant', 'first 1', '163b30e56ca8baCapture001.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(2, 'Rony Abou Chakra', 'ronyabouchakra@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_message` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `content`, `date`, `user_id`) VALUES
(27, 'Heyy i will send you a message', '2023-01-03', 4),
(28, 'hello , i am a new customer in your website', '2023-01-08', 6),
(29, 'heyyyyy', '2023-01-08', 4),
(30, 'hey hello admin', '2023-01-08', 8);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `menu_link` text COLLATE utf8_bin NOT NULL,
  `location` text COLLATE utf8_bin NOT NULL,
  `image_source` text COLLATE utf8_bin NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_admin_post` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `name`, `description`, `menu_link`, `location`, `image_source`, `admin_id`) VALUES
(18, 'al-Saniour', 'a beef restaurant', 'https://meet.google.com/rvr-grig-csz', 'beirut', '163ba98d123946alsaniour.jpg', 2),
(22, 'Al-Mandaloun', 'a seafood restaurant', 'https://www.google.com/search?q=Lina%27s+coffee&amp;tbm=isch&amp;ved=2ahUKEwidlNuE37f8AhWYX6QEHW8CCHsQ2-cCegQIABAA&amp;oq=Lina%27s+coffee&amp;gs_lcp=CgNpbWcQAzIHCAAQgAQQGDIHCAAQgAQQGDIHCAAQgAQQGDoECAAQQzoFCAAQgAQ6CAgAEIAEELEDOgsIABCABBCxAxCDAToFCAAQsQM6BAgAEB5Q7wRY0zRguzZoAHAAeASAAb0CiAH7GZIBCDAuMTUuMy4xmAEAoAEBqgELZ3dzLXdpei1pbWewAQDAAQE&amp;sclient=img&amp;ei=65e6Y93yBJi_kdUP74Sg2Ac&amp;bih=656&amp;biw=1366&amp;rlz=1C1GGRV_enLB792LB792#imgrc=oDT3_rG44BoHaM', 'tripoli', '163cbd1a052babAlmandaloun.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(4, 'Abbas', 'abbaschoker@hotmail.com', '147'),
(5, 'rita', 'ritaabouchakra@hotmail.com', '333'),
(6, 'elie', 'elieabouhabib@hotmail.com', '1234'),
(7, 'joelle', 'joelleabouchakra1@gmail.com', '123456'),
(8, 'emile', 'emileaboudiwan@gmail.com', '1477');

-- --------------------------------------------------------

--
-- Table structure for table `user_rate_post`
--

DROP TABLE IF EXISTS `user_rate_post`;
CREATE TABLE IF NOT EXISTS `user_rate_post` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `FK_rate_post` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_rate_post`
--

INSERT INTO `user_rate_post` (`user_id`, `post_id`, `rating`) VALUES
(4, 18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_save_post`
--

DROP TABLE IF EXISTS `user_save_post`;
CREATE TABLE IF NOT EXISTS `user_save_post` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `FK_save_post` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_save_post`
--

INSERT INTO `user_save_post` (`user_id`, `post_id`) VALUES
(4, 22);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `FK_admin_ad` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_user_message` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_rate_post`
--
ALTER TABLE `user_rate_post`
  ADD CONSTRAINT `FK_rate_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_rate_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_save_post`
--
ALTER TABLE `user_save_post`
  ADD CONSTRAINT `FK_save_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_save_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
