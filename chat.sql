-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2025 at 10:57 PM
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
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads_draft`
--

CREATE TABLE `ads_draft` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `managerId` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `conditions` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `location` varchar(2000) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `img2` varchar(200) NOT NULL,
  `img3` varchar(200) NOT NULL,
  `img4` varchar(200) NOT NULL,
  `img5` varchar(200) NOT NULL,
  `img6` varchar(200) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads_listing`
--

CREATE TABLE `ads_listing` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `managerId` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `conditions` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `location` varchar(2000) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `img2` varchar(200) NOT NULL,
  `img3` varchar(200) NOT NULL,
  `img4` varchar(200) NOT NULL,
  `img5` varchar(200) NOT NULL,
  `img6` varchar(200) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `star` varchar(200) NOT NULL,
  `visibility` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads_listing_temp_img`
--

CREATE TABLE `ads_listing_temp_img` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advert_manager`
--

CREATE TABLE `advert_manager` (
  `managerId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `compName` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `active` varchar(200) NOT NULL,
  `adspix` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `regDate` date DEFAULT current_timestamp(),
  `service1` varchar(200) NOT NULL,
  `service2` varchar(200) NOT NULL,
  `service3` varchar(200) NOT NULL,
  `service4` varchar(200) NOT NULL,
  `service5` varchar(200) NOT NULL,
  `service6` varchar(200) NOT NULL,
  `service7` varchar(200) NOT NULL,
  `service8` varchar(200) NOT NULL,
  `service9` varchar(200) NOT NULL,
  `service10` varchar(200) NOT NULL,
  `service11` varchar(200) NOT NULL,
  `service12` varchar(200) NOT NULL,
  `service13` varchar(200) NOT NULL,
  `service14` varchar(200) NOT NULL,
  `service15` varchar(200) NOT NULL,
  `service16` varchar(200) NOT NULL,
  `service17` varchar(200) NOT NULL,
  `service18` varchar(200) NOT NULL,
  `service19` varchar(200) NOT NULL,
  `service20` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `senderid` int(11) NOT NULL,
  `receiverid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'unread',
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `message`, `senderid`, `receiverid`, `date`, `status`, `image`) VALUES
(167, 'Hello  Bro', 55, 56, '2025-06-21 17:20:13', 'read', ''),
(168, 'Howfa', 56, 55, '2025-06-21 17:21:18', 'read', ''),
(169, 'Hello', 56, 59, '2025-08-07 13:24:10', 'unread', ''),
(170, 'Hello', 56, 55, '2025-08-08 10:02:15', 'unread', ''),
(171, 'hallo', 56, 62, '2025-08-08 10:02:44', 'unread', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment_like`
--

CREATE TABLE `comment_like` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_like`
--

INSERT INTO `comment_like` (`id`, `userid`, `com_id`, `type`, `timestamp`) VALUES
(76, 55, 115, 1, '2025-06-21 17:27:33'),
(77, 56, 118, 0, '2025-08-05 19:34:05'),
(78, 56, 117, 1, '2025-08-05 19:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `controls`
--

CREATE TABLE `controls` (
  `id` int(11) NOT NULL,
  `conName` varchar(2000) NOT NULL,
  `conditions` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `draft_temp_img_src`
--

CREATE TABLE `draft_temp_img_src` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edit_draft_temp_img`
--

CREATE TABLE `edit_draft_temp_img` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `draftId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `contact` varchar(2000) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `contacted` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `title`, `contact`, `attachment`, `userid`, `contacted`) VALUES
(35, 'Greate Job', 'You Guys are really doing great.. I love this, keep it up', '', 3, '1590966829'),
(43, 'this is the best site ever', 'congrats brother', '', 2, '1592256668'),
(57, 'Am Glad to see this site', 'Very impressive bro.. keep it up', '', 1, '1605429788'),
(66, 'Good Site', 'cool', '', 1, '1632762060');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `color` varchar(200) NOT NULL,
  `cover` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `member_count` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `privacy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `category_id`, `admin`, `color`, `cover`, `description`, `member_count`, `created`, `privacy`) VALUES
(31, 'Biology', 5, 55, '#FFFFFF', 'eblaze_illustrate9.png', 'This is a biology group here', 2, '2025-06-21 17:11:12', 'Public'),
(32, 'Anatomy', 5, 55, '#FFFFFF', 'eblaze_illustrate8.png', 'This is anatomy group that deals with human body and organs', 3, '2025-06-21 17:12:18', 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `group_categories`
--

CREATE TABLE `group_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `group_categories`
--

INSERT INTO `group_categories` (`category_id`, `category_name`) VALUES
(6, 'Community'),
(5, 'Education'),
(3, 'Gaming'),
(4, 'Hobbies'),
(2, 'Sports'),
(1, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `group_chats`
--

CREATE TABLE `group_chats` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `senderid` int(11) NOT NULL,
  `message` text NOT NULL,
  `chat_image` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_chats`
--

INSERT INTO `group_chats` (`id`, `group_id`, `senderid`, `message`, `chat_image`, `timestamp`) VALUES
(13, 32, 57, 'Hello guys', NULL, '2025-06-22 14:30:23'),
(14, 32, 56, 'hey whats good?', NULL, '2025-06-22 14:31:21'),
(15, 32, 56, 'yooo', NULL, '2025-06-22 14:31:58'),
(16, 32, 56, 'study line by line...', 'file_68581411644018.93783091.docx', '2025-06-22 14:32:49'),
(17, 32, 57, 'Vote please', 'file_68581444648c44.17594817.jpg', '2025-06-22 14:33:40'),
(18, 32, 56, '', 'file_685814b57a9c15.60352745.pptx', '2025-06-22 14:35:33'),
(19, 32, 55, 'Hello', NULL, '2025-06-22 15:34:37'),
(20, 32, 55, 'Whats up', NULL, '2025-06-22 15:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_date` datetime DEFAULT current_timestamp(),
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`member_id`, `group_id`, `user_id`, `joined_date`, `is_admin`) VALUES
(18, 31, 55, '2025-06-21 18:11:12', 1),
(19, 32, 55, '2025-06-21 18:12:18', 1),
(20, 31, 56, '2025-06-21 18:16:46', 0),
(21, 32, 56, '2025-06-22 15:27:53', 0),
(22, 32, 57, '2025-06-22 15:28:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postcomments`
--

CREATE TABLE `postcomments` (
  `com_id` int(11) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `posted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postcomments`
--

INSERT INTO `postcomments` (`com_id`, `attachment`, `comment`, `post_id`, `userid`, `posted`) VALUES
(115, '', 'Hello great post', 32, 55, '1750526840'),
(116, '1f680-89810197.png', '', 32, 55, '1750526871'),
(117, '', 'Hello good', 32, 55, '1750526882'),
(118, '', 'welldone', 32, 56, '1750526930');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `background` varchar(200) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `attachment` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `created` varchar(200) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `image1` varchar(400) NOT NULL,
  `image2` varchar(400) NOT NULL,
  `image3` varchar(400) NOT NULL,
  `image4` varchar(400) NOT NULL,
  `image5` varchar(400) NOT NULL,
  `image6` varchar(400) NOT NULL,
  `image7` varchar(400) NOT NULL,
  `image8` varchar(400) NOT NULL,
  `image9` varchar(400) NOT NULL,
  `image10` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post`, `background`, `location`, `attachment`, `userid`, `created`, `modified`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`, `image7`, `image8`, `image9`, `image10`) VALUES
(32, 'Hello this is a new post i just mader', '', 'FULAFIA', '', 55, '1750526802', '2025-06-21 17:26:42', 'bet-1025081888.png', '81709470-laptop-with-login-form-page-on-screen-sign-in-to-account-user-authorization-login-authentication-pag-1129230931.jpg', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `reactType` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`id`, `userid`, `post_id`, `reactType`) VALUES
(305, 55, 32, 'love'),
(306, 56, 32, 'haha');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `report` varchar(200) NOT NULL,
  `attachment` varchar(250) NOT NULL,
  `reporting_from` varchar(2000) NOT NULL,
  `userid` int(11) NOT NULL,
  `victim_reported` int(11) NOT NULL,
  `post_comment_id` int(11) NOT NULL,
  `date_received` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `title`, `report`, `attachment`, `reporting_from`, `userid`, `victim_reported`, `post_comment_id`, `date_received`) VALUES
(128, 'Reported - Your Post', 'reporting post\r\n', '', 'Post_Page', 1, 1, 555, '2021-09-28 08:36:48'),
(129, 'Reported - Augustine Gabriel', 'The post is void', '', 'Post_Page', 13, 1, 555, '2021-09-28 09:19:30'),
(130, 'reported with attachment', 'Cool', '2021-09-28 09.20.05.jpg', '', 13, 0, 0, '2021-09-28 09:20:26'),
(131, 'Reported - Augustine Gabriel', 'Bad guy', '', 'Comment_Page', 13, 1, 448, '2021-09-28 09:22:12'),
(132, 'Reported - Your Post', 'nnn', '', 'Post_Page', 1, 1, 2, '2021-10-25 11:16:14'),
(133, 'reported with attachment', 'Cool', 'Screenshot_20211104-073613.png', '', 1, 0, 0, '2021-11-04 17:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `sampleid`
--

CREATE TABLE `sampleid` (
  `id` int(11) NOT NULL,
  `ids` varchar(200) NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sampleid`
--

INSERT INTO `sampleid` (`id`, `ids`, `userid`) VALUES
(2, 'FUL/COM/001', 54),
(3, 'FUL/COM/001', 55),
(7, '2020/CP/CSC/001', 56),
(8, '2020/CP/CSC/002', 65),
(9, '2020/CP/CSC/003', 57),
(10, '2020/CP/CSC/004', 68),
(15, 'FUL/ART/001', 59),
(16, '2020/ART/ENG/001', 61),
(17, '2020/ART/ENG/002', 62),
(18, '2020/ART/ENG/003', 70),
(19, '2020/ART/ENG/004', 71);

-- --------------------------------------------------------

--
-- Table structure for table `skill_category`
--

CREATE TABLE `skill_category` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `active` varchar(20) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill_category`
--

INSERT INTO `skill_category` (`cat_id`, `category`, `description`, `photo`, `active`, `created`) VALUES
(1, 'Web Development', 'Complete free course on <span style=\"color:#e1e3ff; font-family:cursive;font-size:18px;\">Coding</span> <br> Web Design & General Programming <br> Acquire Skills Today', 'programmer.jpg', 'active', '2021-11-22'),
(2, 'Graphics Arts', 'Computer and Mobile <span style=\"color:#e1e3ff; font-family:cursive;font-size:18px;\">Graphics</span> <br> Bringing the Delusional To <br>Transverse Reality.', 'graphics.png', '', '2021-09-19'),
(3, 'Affiliate Marketing\r\n', 'Engage In An <span style=\"color:#e1e3ff; font-family:cursive;font-size:18px;\">Online Marketing</span> <br>Earn Financially By Marketing For Companies.', 'market.png', '', '2021-11-22'),
(4, 'Life Ideas', 'The Embodiment of <span style=\"color:#e1e3ff; font-family:cursive;font-size:18px;\">Actions</span> <br> Reality, Phenomena, Subject, Dreams<br>Different Directions | Innovations', 'ideas.jpg', '', '2021-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `temp_attach`
--

CREATE TABLE `temp_attach` (
  `temp_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `images` varchar(400) NOT NULL,
  `posted` varchar(200) NOT NULL,
  `draft` int(11) NOT NULL,
  `posttext` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `category` varchar(225) NOT NULL,
  `userid` int(11) NOT NULL,
  `upload_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `coverpix` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `institution` varchar(200) NOT NULL,
  `course` varchar(200) NOT NULL,
  `moreschool` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `occupation` varchar(200) NOT NULL,
  `moreWorkExp` varchar(200) NOT NULL,
  `interests` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL,
  `updatedate` date NOT NULL DEFAULT curdate(),
  `updatetime` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `gender`, `coverpix`, `phone`, `institution`, `course`, `moreschool`, `country`, `location`, `occupation`, `moreWorkExp`, `interests`, `type`, `userid`, `updatedate`, `updatetime`) VALUES
(52, '', '', '09064318922', 'xddszzzzzzz', 'CRS', '', 'Nigeria', '', '', '', '', 'user', 55, '2025-06-21', '18:10:03'),
(53, 'Male', 'BSB_1st-Order-468264925.gif', '09064318992', '', 'Computer', '', 'Nigeria', '', '', '', '', 'user', 56, '2025-06-21', '18:15:25'),
(54, 'Male', '1002281355-1032797627.jpg', '09064318922', '', 'English', '', 'Nigeria', '', '', '', '', 'user', 57, '2025-06-22', '15:25:59'),
(65, '', '', '', '', '', '', '', '', '', '', '', 'admin', 66, '2025-08-09', '17:52:01'),
(66, '', '', '', '', '', '', '', '', '', '', '', 'admin', 67, '2025-08-09', '17:52:37'),
(68, '', '', '', '', '', '', '', '', '', '', '', 'staff', 69, '2025-08-09', '18:04:07'),
(69, '', '', '', '', '', '', '', '', '', '', '', 'staff', 56, '2025-08-09', '21:47:19'),
(70, '', '', '', '', '', '', '', '', '', '', '', 'admin', 56, '2025-08-09', '21:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `profilepix` varchar(200) NOT NULL,
  `nick` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `regdate` date NOT NULL DEFAULT curdate(),
  `regtime` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `profilepix`, `nick`, `name`, `email`, `password`, `status`, `regdate`, `regtime`) VALUES
(55, 'user2-160x160.jpg', 'gabson', 'Augustine Gabriel', 'gabson2939@gmail.com', '$2y$10$16kYQdZyANg5wzwwaz.qoOw00tQjrD9kj9DLk0vOvpW93mKIZ.czi', 'staff', '2025-06-21', '18:10:03'),
(56, 'IMG-20240206-WA0007-1509865908.jpg', 'sp', 'SP', 'info@vantafolio.com', '$2y$10$QlByM0aQq7Vtu8OahDg3ZOJtXwboPIwHtCpl64lsm0mU8IAWVvgfG', 'admin', '2025-06-21', '18:15:25'),
(57, 'user5-128x128.jpg', 'shamo', 'shamo', 'shamo@g.com', '$2y$10$5L6N8l6eq8.n9jqpnh1eFey.Hco6m1IvSC6ecpsSCoMV.USVAK.w.', 'student', '2025-06-22', '15:25:59'),
(58, '', '', 'Amevye', 'amevyematthew@gmail.com', '$2y$10$h5G2VjQk.izktbA1CzpqmeQloibdwjUgkKSjlm/5.n5fgHqm4gV4y', 'admin', '2025-08-07', '13:28:13'),
(59, '', '', 'James Bone', 'james@g.com', '$2y$10$/NbU6GcL9TaHWN05rFoGge2v.7LanA5YFZ2TPniJtRSGWok4tYSj2', 'admin', '2025-08-07', '13:36:27'),
(61, '', '', 'gabson', 'gabson@g.com', '$2y$10$obZvWWLrgDefOvLOyyej8OT2bxlR2CM6tRJkfVNU11.GKWD79VVSG', 'student', '2025-08-07', '14:57:06'),
(62, '', '', 'admin', 'admin@a.com', '$2y$10$zrHcfi8s01SQX.WiGASsl.Ky5IESE4fkGbuaxtFA6GAD.LO5pwJSK', 'student', '2025-08-07', '15:13:33'),
(63, '', '', 'admin', 'admin@g.com', '$2y$10$MMsfBxjFeO6xrIrvKzmpQeJmSQMicus58D4vYs6KW975XlBFTCbRK', 'student', '2025-08-07', '15:14:43'),
(64, '', 'Bushy', 'chairman', 'chair@g.com', '$2y$10$bCKtRelpPS3NSyCLQvuEwesgornSJNJlZILLOHkCAk7AV699VXLee', 'student', '2025-08-07', '15:15:26'),
(65, '', '', 'new', 'new@n.com', '$2y$10$.3vrR6UXr2sGwjxrNnNq2eNZi1MrMe6T5RqQw9DeIKEtThwoy.D6a', 'student', '2025-08-07', '15:35:11'),
(66, '', '', 'NewAdmin', 'aj@aj.com', '$2y$10$k.7cG.kEZegN0QC882UQbe5IUAYnRmzRrZuOdhQ7wxs5ikYfAVU/y', 'admin', '2025-08-09', '17:52:01'),
(67, '', '', 'Clara', 'clara@g.com', '$2y$10$E4v/FxTGeXT84NeRBC6M5Ov4NcZ6bTy3D1VbkEUWwww2l1zo4gdxy', 'student', '2025-08-09', '17:52:37'),
(69, '', '', 'Ebuka', 'ebu@y.com', '$2y$10$Mh6bWd8zPpdgbac/ovSSFuAxlwEoKJ4Eo4SgJOxmhbDIJmQ5wA7rO', 'student', '2025-08-09', '18:04:07'),
(70, '', '', 'Favour', 'fav@fav.com', '$2y$10$XtE5OO0HOCeWLOZQ7mb.fOBQb0CqXbje1VfG32MhbakzKkTn2VkiS', 'staff', '2025-08-09', '21:47:19'),
(71, '', '', 'timothy', 'Tim@f.com', '$2y$10$xkecgwynG6fF7eCwkMmYmuWCicL3FkzMdIjckwD4R.sslsiaNoNv6', 'staff', '2025-08-09', '21:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_read_status`
--

CREATE TABLE `user_group_read_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `last_read_chat_id` int(11) DEFAULT NULL,
  `last_read_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_group_read_status`
--

INSERT INTO `user_group_read_status` (`id`, `user_id`, `group_id`, `last_read_chat_id`, `last_read_at`) VALUES
(3, 56, 31, NULL, '2025-06-21 17:18:43'),
(5, 55, 31, NULL, '2025-06-21 18:15:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads_draft`
--
ALTER TABLE `ads_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userid`),
  ADD KEY `managerIDS` (`managerId`);

--
-- Indexes for table `ads_listing`
--
ALTER TABLE `ads_listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userid`),
  ADD KEY `manager_fkey` (`managerId`);

--
-- Indexes for table `ads_listing_temp_img`
--
ALTER TABLE `ads_listing_temp_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advert_manager`
--
ALTER TABLE `advert_manager`
  ADD PRIMARY KEY (`managerId`),
  ADD KEY `admanger` (`userid`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_key` (`senderid`),
  ADD KEY `chat_fr` (`receiverid`);

--
-- Indexes for table `comment_like`
--
ALTER TABLE `comment_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_post` (`com_id`),
  ADD KEY `comment_userid` (`userid`);

--
-- Indexes for table `controls`
--
ALTER TABLE `controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `control` (`userid`);

--
-- Indexes for table `draft_temp_img_src`
--
ALTER TABLE `draft_temp_img_src`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edit_draft_temp_img`
--
ALTER TABLE `edit_draft_temp_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `fk_group_category` (`category_id`),
  ADD KEY `fk_groups_admin` (`admin`);

--
-- Indexes for table `group_categories`
--
ALTER TABLE `group_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `group_chats`
--
ALTER TABLE `group_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cfk_group_id` (`group_id`),
  ADD KEY `cfk_senderid` (`senderid`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `post_comments` (`userid`),
  ADD KEY `post_com_key` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_key` (`userid`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_key` (`post_id`),
  ADD KEY `post_like` (`userid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampleid`
--
ALTER TABLE `sampleid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_category`
--
ALTER TABLE `skill_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `temp_attach`
--
ALTER TABLE `temp_attach`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_uploads` (`userid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_key` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_group_read_status`
--
ALTER TABLE `user_group_read_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_group` (`user_id`,`group_id`),
  ADD KEY `fk_ugrs_group` (`group_id`),
  ADD KEY `fk_ugrs_last_read_chat` (`last_read_chat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads_draft`
--
ALTER TABLE `ads_draft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `ads_listing`
--
ALTER TABLE `ads_listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `ads_listing_temp_img`
--
ALTER TABLE `ads_listing_temp_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1246;

--
-- AUTO_INCREMENT for table `advert_manager`
--
ALTER TABLE `advert_manager`
  MODIFY `managerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `comment_like`
--
ALTER TABLE `comment_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `controls`
--
ALTER TABLE `controls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `draft_temp_img_src`
--
ALTER TABLE `draft_temp_img_src`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `edit_draft_temp_img`
--
ALTER TABLE `edit_draft_temp_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1246;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `group_categories`
--
ALTER TABLE `group_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_chats`
--
ALTER TABLE `group_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `sampleid`
--
ALTER TABLE `sampleid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `temp_attach`
--
ALTER TABLE `temp_attach`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1546;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user_group_read_status`
--
ALTER TABLE `user_group_read_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads_draft`
--
ALTER TABLE `ads_draft`
  ADD CONSTRAINT `managerIDS` FOREIGN KEY (`managerId`) REFERENCES `advert_manager` (`managerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ads_listing`
--
ALTER TABLE `ads_listing`
  ADD CONSTRAINT `manager_fkey` FOREIGN KEY (`managerId`) REFERENCES `advert_manager` (`managerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advert_manager`
--
ALTER TABLE `advert_manager`
  ADD CONSTRAINT `admanger` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chat_f` FOREIGN KEY (`senderid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_fr` FOREIGN KEY (`receiverid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_f` FOREIGN KEY (`senderid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_like`
--
ALTER TABLE `comment_like`
  ADD CONSTRAINT `comment_post` FOREIGN KEY (`com_id`) REFERENCES `postcomments` (`com_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `controls`
--
ALTER TABLE `controls`
  ADD CONSTRAINT `control` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_group_category` FOREIGN KEY (`category_id`) REFERENCES `group_categories` (`category_id`),
  ADD CONSTRAINT `fk_groups_admin` FOREIGN KEY (`admin`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_chats`
--
ALTER TABLE `group_chats`
  ADD CONSTRAINT `cfk_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_group_chat_senderid` FOREIGN KEY (`senderid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_ff` FOREIGN KEY (`senderid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `postcomments`
--
ALTER TABLE `postcomments`
  ADD CONSTRAINT `post_com_key` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_key` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `like_key` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_like` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timeline`
--
ALTER TABLE `timeline`
  ADD CONSTRAINT `users_uploads` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdata`
--
ALTER TABLE `userdata`
  ADD CONSTRAINT `users_key` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_group_read_status`
--
ALTER TABLE `user_group_read_status`
  ADD CONSTRAINT `fk_ugrs_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ugrs_last_read_chat` FOREIGN KEY (`last_read_chat_id`) REFERENCES `group_chats` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ugrs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
