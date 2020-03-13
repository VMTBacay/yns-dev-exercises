-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2020 at 08:09 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microblog2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `body` varchar(140) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `body`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(1, 12, 5, 'ã“ã‚“ã«ã¡ã¯ã€world!', '2020-03-03 03:25:23', '2020-03-03 04:48:37', 0, NULL),
(2, 12, 5, 'Hello, world!', '2020-03-03 04:05:17', '2020-03-03 04:05:17', 0, NULL),
(3, 12, 5, 'blahlbhalbhblah', '2020-03-03 04:55:01', '2020-03-03 04:55:08', 1, '2020-03-03 04:55:08'),
(4, 12, 5, 'qwertyqwerty', '2020-03-03 04:56:37', '2020-03-03 04:58:09', 1, '2020-03-03 04:58:09'),
(5, 12, 5, 'oshapodfij;stripling', '2020-03-03 06:29:46', '2020-03-03 06:31:42', 1, '2020-03-03 06:31:42'),
(6, 12, 5, 'helloo\r\n', '2020-03-05 03:40:48', '2020-03-05 03:41:38', 1, '2020-03-05 03:41:38'),
(7, 12, 5, 'Â¡Hola, world!', '2020-03-05 07:28:49', '2020-03-05 07:28:49', 0, NULL),
(8, 12, 5, 'ä½ å¥½, world!', '2020-03-05 07:29:14', '2020-03-05 07:29:14', 0, NULL),
(9, 12, 5, 'Hallo, world!', '2020-03-05 07:31:12', '2020-03-05 07:31:12', 0, NULL),
(10, 12, 5, 'ÐŸÑ€Ð¸Ð²ÐµÑ‚, world!', '2020-03-05 07:32:22', '2020-03-05 07:32:22', 0, NULL),
(11, 12, 5, 'à¤¨à¤®à¤¸à¥à¤¤à¥‡, world!', '2020-03-05 07:33:55', '2020-03-05 07:33:55', 0, NULL),
(12, 12, 5, 'ì•ˆë…•, world!', '2020-03-05 07:34:25', '2020-03-05 07:34:25', 0, NULL),
(13, 12, 5, 'Ù…Ø±Ø­Ø¨Ø§ØŒ, world!', '2020-03-05 07:37:14', '2020-03-05 07:37:14', 0, NULL),
(14, 12, 5, 'adsf', '2020-03-05 07:39:05', '2020-03-05 07:39:14', 1, '2020-03-05 07:39:14'),
(15, 12, 5, 'fff', '2020-03-05 07:42:17', '2020-03-05 07:42:44', 1, '2020-03-05 07:42:44'),
(16, 12, 5, 'fff\r\n', '2020-03-05 07:42:53', '2020-03-05 07:44:43', 1, '2020-03-05 07:44:43'),
(17, 12, 19, 'nnnnnnnnnnnn', '2020-03-05 07:52:13', '2020-03-05 07:52:13', 0, NULL),
(18, 19, 5, 'Î“ÎµÎ¹Î¬ ÏƒÎ¿Ï…, world!', '2020-03-06 03:20:48', '2020-03-06 03:20:48', 0, NULL),
(19, 19, 5, 'Bonjour, world!', '2020-03-06 03:22:56', '2020-03-06 03:22:56', 0, NULL),
(20, 19, 5, 'sdfff', '2020-03-06 03:27:57', '2020-03-06 04:46:49', 1, '2020-03-06 04:46:49'),
(21, 19, 5, 'fdsfadf', '2020-03-06 03:28:43', '2020-03-06 04:46:46', 1, '2020-03-06 04:46:46'),
(22, 19, 5, 'fsadf', '2020-03-06 03:29:54', '2020-03-06 04:46:42', 1, '2020-03-06 04:46:42'),
(23, 19, 5, 'sdfdas', '2020-03-06 03:31:15', '2020-03-06 04:46:36', 1, '2020-03-06 04:46:36'),
(24, 19, 5, 'd', '2020-03-06 03:50:37', '2020-03-06 04:13:20', 1, '2020-03-06 04:13:20'),
(25, 19, 5, 'd', '2020-03-06 03:51:01', '2020-03-06 04:13:25', 1, '2020-03-06 04:13:25'),
(26, 19, 5, 'asfff', '2020-03-06 04:42:36', '2020-03-06 04:42:54', 1, '2020-03-06 04:42:54'),
(27, 19, 5, 'Hej, world!', '2020-03-06 04:49:51', '2020-03-06 04:49:51', 0, NULL),
(28, 52, 40, 'hola globe', '2020-03-10 09:11:24', '2020-03-10 09:12:05', 1, '2020-03-10 09:12:05'),
(29, 52, 5, 'hey, world', '2020-03-10 09:19:27', '2020-03-10 09:19:55', 1, '2020-03-10 09:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `follower_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(20, 11, 12, '2020-03-04 09:38:36', '2020-03-06 07:49:02', 0, '2020-03-06 07:48:59'),
(21, 10, 11, '2020-03-04 10:35:48', NULL, 0, NULL),
(22, 10, 12, '2020-03-04 06:20:12', '2020-03-04 06:33:22', 0, '2020-03-04 06:32:12'),
(23, 12, 11, '2020-03-04 14:09:05', NULL, 0, NULL),
(24, 12, 9, '2020-03-04 10:05:04', '2020-03-04 10:24:35', 0, '2020-03-04 10:24:35'),
(25, 9, 12, '2020-03-05 09:57:28', '2020-03-06 07:35:41', 1, '2020-03-06 07:35:41'),
(26, 12, 19, '2020-03-06 03:17:51', '2020-03-06 03:17:51', 0, NULL),
(27, 15, 12, '2020-03-06 07:23:54', '2020-03-06 07:38:27', 1, '2020-03-06 07:38:27'),
(28, 19, 12, '2020-03-06 07:36:09', '2020-03-06 07:37:50', 0, '2020-03-06 07:37:40'),
(29, 12, 20, '2020-03-09 06:40:37', '2020-03-10 02:49:48', 1, '2020-03-10 02:49:48'),
(30, 15, 20, '2020-03-09 08:03:26', '2020-03-09 08:03:29', 1, '2020-03-09 08:03:29'),
(32, 9, 52, '2020-03-10 09:13:45', '2020-03-10 09:14:07', 0, '2020-03-10 09:13:58'),
(33, 12, 52, '2020-03-10 09:14:56', '2020-03-10 09:27:35', 0, '2020-03-10 09:27:33'),
(34, 19, 52, '2020-03-10 09:20:02', '2020-03-10 09:20:05', 1, '2020-03-10 09:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(1, 12, 5, '2020-03-02 08:24:15', '2020-03-05 07:47:50', 0, '2020-03-05 07:47:47'),
(2, 11, 5, '2020-03-02 08:48:29', '2020-03-02 08:48:29', 0, NULL),
(3, 12, 8, '2020-03-03 09:59:52', '2020-03-03 10:00:15', 0, '2020-03-03 10:00:03'),
(4, 12, 19, '2020-03-05 07:47:35', '2020-03-05 08:02:34', 0, '2020-03-05 07:47:39'),
(5, 19, 6, '2020-03-06 06:44:15', '2020-03-06 06:54:10', 1, '2020-03-06 06:54:10'),
(6, 12, 6, '2020-03-06 07:48:55', '2020-03-06 07:48:57', 1, '2020-03-06 07:48:57'),
(7, 12, 31, '2020-03-09 03:46:29', '2020-03-09 03:46:29', 0, NULL),
(11, 12, 38, '2020-03-10 08:57:49', '2020-03-10 08:57:49', 0, NULL),
(12, 52, 39, '2020-03-10 09:09:24', '2020-03-10 09:10:10', 0, '2020-03-10 09:09:28'),
(13, 12, 46, '2020-03-11 08:53:52', '2020-03-11 08:53:52', 0, NULL),
(14, 20, 50, '2020-03-11 09:11:58', '2020-03-11 10:02:23', 0, '2020-03-11 10:02:20'),
(15, 20, 49, '2020-03-11 09:55:35', '2020-03-11 09:55:36', 0, NULL),
(16, 12, 61, '2020-03-12 04:37:17', '2020-03-12 09:39:10', 1, '2020-03-12 09:39:10'),
(17, 12, 55, '2020-03-12 04:54:59', '2020-03-12 07:34:18', 1, '2020-03-12 07:34:18'),
(21, 12, 54, '2020-03-12 06:03:25', '2020-03-12 06:28:17', 1, '2020-03-12 06:28:17'),
(258, 12, 66, '2020-03-13 04:05:30', '2020-03-13 04:05:31', 1, '2020-03-13 04:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` varchar(140) NOT NULL,
  `repost_id` bigint(20) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `repost_id`, `image`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(5, 12, 'Hello, ', 'ä¸–ç•Œï¼', NULL, NULL, '2020-02-27 06:45:58', '2020-03-03 04:04:28', 0, '2020-03-02 08:01:34'),
(6, 11, 'asdsad', 'sdfassdsfdf', NULL, NULL, '2020-02-27 09:33:26', '2020-03-02 06:05:46', 0, '2020-03-02 06:05:46'),
(7, 11, 'helloooooooooooooooooo', 'nurse', NULL, NULL, '2020-02-27 09:36:47', '2020-03-02 08:04:44', 1, '2020-03-02 08:04:44'),
(8, 12, 'world!', 'Hello, ', NULL, NULL, '2020-02-27 09:51:47', '2020-03-09 03:46:56', 1, '2020-03-09 03:46:56'),
(17, 10, 'AAAAAAAAAA', 'bbbbbbbbbbbbbbbbbbbbbbb', NULL, NULL, '2020-03-04 03:33:53', '2020-03-04 03:33:53', 0, NULL),
(18, 12, 'asdfsdlkfj', 'jlkj;jk', NULL, NULL, '2020-03-05 03:36:36', '2020-03-05 08:08:11', 1, '2020-03-05 08:08:11'),
(19, 12, 'yyy', 'yyyyyy', NULL, NULL, '2020-03-05 07:46:23', '2020-03-05 08:08:22', 1, '2020-03-05 08:08:22'),
(20, 12, 'asdfasdfsdfsfd', 'ddeffefeefeeeeefwewfewffeweef', NULL, NULL, '2020-03-05 08:25:40', '2020-03-05 08:26:20', 1, '2020-03-05 08:26:20'),
(28, 12, 'Face reveal', '*gasp*', NULL, 'smiley(1).png', '2020-03-05 09:00:53', '2020-03-05 09:12:32', 0, NULL),
(29, 19, 'a', 'a', NULL, NULL, '2020-03-06 05:01:10', '2020-03-06 05:01:10', 0, NULL),
(30, 19, 'asdf', 'fff', NULL, NULL, '2020-03-06 06:55:51', '2020-03-06 06:55:51', 0, NULL),
(31, 19, 'jkl', 'jkl', NULL, NULL, '2020-03-06 06:56:04', '2020-03-06 06:56:04', 0, NULL),
(32, 12, 'asdsad', 'asdf', NULL, NULL, '2020-03-09 03:56:28', '2020-03-09 03:57:09', 1, '2020-03-09 03:57:09'),
(33, 20, 'Hey', 'Hi', NULL, 'asdf1.png', '2020-03-09 08:57:57', '2020-03-10 02:49:44', 1, '2020-03-10 02:49:44'),
(34, 20, 'asdsad', 'asdfff', NULL, NULL, '2020-03-10 02:53:50', '2020-03-11 09:03:38', 1, '2020-03-11 09:03:38'),
(37, 12, 'asdfasdf', 'sadfasdfasdf', NULL, 'smiley3.png', '2020-03-10 08:53:47', '2020-03-10 08:56:13', 1, '2020-03-10 08:56:13'),
(38, 12, 'aksdjflkjj', '<script type=\'application/javascript\'>alert(\'xss\');</script>', NULL, NULL, '2020-03-10 08:57:24', '2020-03-10 08:57:24', 0, NULL),
(39, 52, 'Hello,', 'world!', NULL, NULL, '2020-03-10 09:09:13', '2020-03-10 09:10:37', 1, '2020-03-10 09:10:37'),
(40, 52, 'Hello', 'world', NULL, NULL, '2020-03-10 09:11:01', '2020-03-10 09:11:01', 0, NULL),
(41, 12, 'asdf', 'fdfdf', NULL, 'aris (2).rar', '2020-03-11 08:49:46', '2020-03-11 08:49:46', 0, NULL),
(42, 12, 'asdf', 'aaaaaaaaaaaaa', NULL, NULL, '2020-03-11 08:50:32', '2020-03-11 08:50:32', 0, NULL),
(43, 12, 'asdf', 'aaaaaaaaaaaaa', NULL, NULL, '2020-03-11 08:50:32', '2020-03-11 08:50:32', 0, NULL),
(44, 12, 'asdf', 'aaaaaaaaaaaaa', NULL, NULL, '2020-03-11 08:50:32', '2020-03-11 08:50:32', 0, NULL),
(45, 12, 'asdf', 'aaaaaaaaaaaaa', NULL, NULL, '2020-03-11 08:50:33', '2020-03-11 08:50:33', 0, NULL),
(46, 12, 'asdf', 'aaaaaaaaaaaaa', NULL, NULL, '2020-03-11 08:50:33', '2020-03-11 08:50:33', 0, NULL),
(47, 20, ' ', ' ', NULL, NULL, '2020-03-11 09:04:27', '2020-03-11 09:04:40', 1, '2020-03-11 09:04:40'),
(48, 20, 'adf  asd', 'adf  asd', NULL, NULL, '2020-03-11 09:05:44', '2020-03-11 09:05:44', 0, NULL),
(49, 20, 'ffffff                          fffffffff', 'ffffff                          fffffffff', NULL, NULL, '2020-03-11 09:06:08', '2020-03-11 09:06:08', 0, NULL),
(50, 20, 'a', 'a', NULL, NULL, '2020-03-11 09:07:33', '2020-03-11 10:32:39', 0, NULL),
(51, 12, 'ljlj', 'ljlj', NULL, NULL, '2020-03-12 02:08:18', '2020-03-12 02:08:18', 0, NULL),
(52, 12, 'hello', 'hello', NULL, 'asdf3.png', '2020-03-12 02:26:30', '2020-03-12 02:26:30', 0, NULL),
(53, 12, 'asdf', 'asdf', NULL, NULL, '2020-03-12 02:35:08', '2020-03-12 02:35:15', 1, '2020-03-12 02:35:15'),
(54, 12, 'kjhkj', 'kjhkj', NULL, NULL, '2020-03-12 02:37:21', '2020-03-12 02:37:21', 0, NULL),
(55, 12, 'lkn', 'lkn', NULL, NULL, '2020-03-12 02:41:10', '2020-03-12 02:41:10', 0, NULL),
(56, 12, 'asdf', 'asdf', NULL, NULL, '2020-03-12 02:42:09', '2020-03-12 02:47:24', 1, '2020-03-12 02:47:24'),
(57, 12, 'asdf', 'asdf', NULL, NULL, '2020-03-12 02:42:35', '2020-03-12 02:47:18', 1, '2020-03-12 02:47:18'),
(58, 12, 'sadf', 'sadf', NULL, NULL, '2020-03-12 02:44:43', '2020-03-12 02:47:13', 1, '2020-03-12 02:47:13'),
(59, 12, 'asdf', 'asdf', NULL, NULL, '2020-03-12 02:45:54', '2020-03-12 02:47:07', 1, '2020-03-12 02:47:07'),
(60, 12, 'fasdf', 'fasdf', NULL, NULL, '2020-03-12 02:46:52', '2020-03-12 02:47:02', 1, '2020-03-12 02:47:02'),
(61, 12, 'j,nmfasd', 'j,nmfasd', NULL, 'smiley(1)3.png', '2020-03-12 03:05:02', '2020-03-12 04:12:39', 0, NULL),
(62, 12, 'asdf', 'asdf', NULL, NULL, '2020-03-12 07:52:18', '2020-03-12 07:52:23', 1, '2020-03-12 07:52:23'),
(64, 12, 'lkjlj', 'lkjlj', NULL, NULL, '2020-03-12 09:48:30', '2020-03-12 09:48:30', 0, NULL),
(65, 12, 'kmklmn', 'kmklmn', 17, NULL, '2020-03-12 10:01:34', '2020-03-12 10:01:34', 0, NULL),
(66, 12, 'LKJLK', 'LKJLK', 61, NULL, '2020-03-13 04:00:32', '2020-03-13 07:01:28', 0, NULL),
(72, 12, 'lijlkn', 'lijlkn', 66, NULL, '2020-03-13 07:59:51', '2020-03-13 07:59:51', 0, NULL),
(73, 12, 'kjhbkjbn', 'kjhbkjbn', 72, NULL, '2020-03-13 08:07:41', '2020-03-13 08:07:41', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reposts`
--

CREATE TABLE `reposts` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reposts`
--

INSERT INTO `reposts` (`id`, `user_id`, `post_id`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(1, 12, 5, '2020-03-02 04:07:56', '2020-03-05 07:47:54', 1, '2020-03-05 07:47:54'),
(2, 11, 6, '2020-03-02 06:05:31', '2020-03-02 06:05:31', 1, NULL),
(6, 11, 17, '2020-03-04 03:36:05', '2020-03-04 03:36:05', 0, NULL),
(7, 12, 17, '2020-03-04 06:37:57', '2020-03-04 06:37:57', 0, NULL),
(8, 12, 19, '2020-03-05 07:55:46', '2020-03-05 07:55:46', 0, NULL),
(9, 12, 20, '2020-03-05 08:26:13', '2020-03-05 08:26:13', 0, NULL),
(10, 19, 6, '2020-03-06 06:44:22', '2020-03-06 06:44:22', 0, NULL),
(11, 12, 6, '2020-03-06 07:49:04', '2020-03-06 07:49:06', 1, '2020-03-06 07:49:06'),
(13, 52, 39, '2020-03-10 09:10:15', '2020-03-10 09:10:15', 0, NULL),
(14, 12, 61, '2020-03-13 03:24:36', '2020-03-13 03:24:36', 0, '2020-03-13 03:24:33'),
(15, 12, 65, '2020-03-13 07:11:12', '2020-03-13 07:11:13', 1, '2020-03-13 07:11:13'),
(16, 12, 66, '2020-03-13 04:53:46', '2020-03-13 04:53:46', 1, '2020-03-13 04:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_pic` varchar(250) NOT NULL DEFAULT 'default_profile_pic.jpg',
  `activation_code` int(11) NOT NULL DEFAULT 0,
  `activation_code_date` datetime NOT NULL DEFAULT current_timestamp(),
  `activated` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_pic`, `activation_code`, `activation_code_date`, `activated`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(8, 'qwerqwer', 'asdf@sd.casfd', 'mnbmnbmnbm', 'default_profile_pic.jpg', 0, '2020-02-27 09:16:22', 0, '2020-02-27 02:16:22', '2020-02-27 02:16:22', 0, NULL),
(9, 'fdsafdsa', 'dddd@sd.casfd', 'mnbmnbmnbm', 'default_profile_pic.jpg', 0, '2020-02-27 09:49:57', 1, '2020-02-27 02:49:57', '2020-02-27 02:49:57', 0, NULL),
(10, 'vbvbvbvb', 'klkl@sd.casfd', 'vbvbvbvb', 'default_profile_pic.jpg', 0, '2020-02-27 10:15:45', 1, '2020-02-27 03:15:34', '2020-02-27 03:15:34', 0, NULL),
(11, 'jimbob', 'nlkn@sd.casfd', 'jimmybobo', 'default_profile_pic.jpg', 208536, '2020-02-27 10:58:04', 1, '2020-02-27 03:58:04', '2020-02-27 03:58:04', 0, NULL),
(12, 'helloworld', 'aaaaaaaaaaa@sadff.ccd', 'helloworld', 'asdf6.png', 950733, '2020-02-27 13:12:50', 1, '2020-02-27 06:12:50', '2020-03-12 04:17:29', 0, NULL),
(15, 'blahblah', 'vehavo4060@nuevomail.com', 'blahblah', 'default_profile_pic.jpg', 538333, '2020-03-05 17:04:48', 1, '2020-03-05 10:04:48', '2020-03-05 10:04:48', 0, NULL),
(19, 'twewytwewy', 'h3110w0r1d@x3mailer.com', 'twewytwewy', 'default_profile_pic.jpg', 121351, '2020-03-06 10:03:24', 1, '2020-03-06 03:03:24', '2020-03-06 03:03:24', 0, NULL),
(20, 'tutututu', 'vodil26931@hxqmail.com', 'tutututu', 'asdf.png', 246775, '2020-03-09 13:28:02', 1, '2020-03-09 06:28:02', '2020-03-09 08:57:30', 0, NULL),
(27, 'aaaaaa', 'a@aaa.aaa', 'aaaaaaaaaaaa', 'default_profile_pic.jpg', 867194, '2020-03-10 10:42:45', 0, '2020-03-10 03:42:45', '2020-03-10 03:42:45', 0, NULL),
(52, 'aaaaaaa', 'vmtbacay@gmail.com', '11111111', 'smiley(1)2.png', 772956, '2020-03-10 16:06:44', 1, '2020-03-10 09:06:44', '2020-03-10 09:24:45', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `repost_id` (`repost_id`);

--
-- Indexes for table `reposts`
--
ALTER TABLE `reposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `reposts_ibfk_1` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `reposts`
--
ALTER TABLE `reposts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reposts`
--
ALTER TABLE `reposts`
  ADD CONSTRAINT `reposts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
