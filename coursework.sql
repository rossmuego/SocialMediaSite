-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2016 at 09:15 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment` varchar(70) NOT NULL,
  `commenter_id` varchar(4) NOT NULL,
  `videoID` varchar(11) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment`, `commenter_id`, `videoID`, `time`, `commentID`) VALUES
('john Wilhelm ', '1', 'vyimNxGZ--Y', '2016-02-22 13:53:03', 1),
('john Wilhelm ', '1', 'vyimNxGZ--Y', '2016-02-22 13:53:04', 2),
('john Wilhelm ', '1', 'vyimNxGZ--Y', '2016-02-22 13:53:04', 3),
('john Wilhelm ', '1', 'vyimNxGZ--Y', '2016-02-22 13:53:04', 4),
('john Wilhelm ', '1', 'vyimNxGZ--Y', '2016-02-22 13:53:05', 5),
('jOHN wAS HERE', '1', 'vyimNxGZ--Y', '2016-02-22 13:54:06', 6),
('HELLO', '1', 'vyimNxGZ--Y', '2016-02-22 13:54:14', 7),
('HELLO', '1', 'vyimNxGZ--Y', '2016-02-22 13:54:26', 8),
('HELLO', '1', 'vyimNxGZ--Y', '2016-02-22 13:54:27', 9),
('HELLO', '1', 'vyimNxGZ--Y', '2016-02-22 13:54:29', 10),
('jOHN Wilhelm ', '1', 'vyimNxGZ--Y', '2016-02-22 13:55:30', 11),
('Hello', '1', 'vyimNxGZ--Y', '2016-02-22 13:57:02', 12),
('john was here test comment for today sorry mate i wonte', '1', 'vyimNxGZ--Y', '2016-02-22 13:57:56', 13),
('xchjgcghjgfghjhghjhgfghjhgfghjhghjkjhgfghjkjhgfghjjhgfd', '1', 'vyimNxGZ--Y', '2016-02-22 13:58:12', 14);

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `follower_id` int(4) NOT NULL,
  `following_id` int(4) NOT NULL,
  `followed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`follower_id`, `following_id`, `followed`) VALUES
(1, 3, 1),
(2, 1, 1),
(3, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(2, 1, 1),
(4, 5, 1),
(3, 6, 1),
(6, 5, 1),
(8, 7, 1),
(1, 5, 1),
(14, 1, 1),
(2, 3, 1),
(15, 1, 1),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `songName` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `songID` varchar(255) NOT NULL,
  `submitter` varchar(255) NOT NULL,
  `votes_up` int(4) NOT NULL,
  `votes_down` int(4) NOT NULL,
  `vote_diff` int(4) NOT NULL,
  `submit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`songName`, `artist`, `songID`, `submitter`, `votes_up`, `votes_down`, `vote_diff`, `submit_id`) VALUES
('bob', 'jim', 'evQsOFQju08', '1', 30, 5567, -5537, 1),
('Downhearted', 'Pegboard Nerds', 'vyimNxGZ--Y', '1', 143, 65, 78, 2),
('Reforget', 'Lauv', 'QAi0OwUXBeQ', '1', 319, 236, 83, 3),
('Wickedskengman ', 'Stormzy', 'OBeR1wgWmCY', '3', 16, 14, 2, 4),
('Memories', 'Exit Black', '5ckt0nqVc80', '2', 88, 43, 45, 5),
('One', 'Pmac', 'lLJyOMcFYeA', '1', 1, 1, 0, 7),
('fgbn', 'god', '', '1', 1, 0, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `soundcloud` varchar(255) NOT NULL,
  `bio` varchar(500) NOT NULL,
  `location` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `user_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `username`, `email`, `password`, `facebook`, `twitter`, `youtube`, `soundcloud`, `bio`, `location`, `profile_pic`, `user_id`) VALUES
('Ross Muego', 'rossmuego', 'ross@ross.com', 'password', '', '', '', '', '', '', '1456235565ross.jpg', 1),
('John Wilhelm', 'bearded Beauty', 'john@ross.com', 'password', '', '', '', '', '', '', '1454531669john.jpg', 2),
('Duncan Grigor', 'Duncy', 'duncan@ross.com', 'password', '', '', '', '', '', '', '1454531742duncan.jpg', 3),
('Josh O Brien', 'joshjoshobs', 'josh@ross.com', 'password', '', '', '', '', '', '', '145453216412246994_981546818573758_5567958618853148907_n.jpg', 4),
('Dylan Mills', 'millsyHMFC', 'dylan@ross.com', 'password', '', '', '', '', '', '', '145453220812507620_1122864787754268_6868484170226893342_n.jpg', 5),
('Thomas Higgins', 'tam', 'thomas@ross.com', 'password', '', '', '', '', '', '', '14545322541915006_993884810673118_6140882983643096432_n.jpg', 6),
('Samuel Odetayo', 'black sam', 'sam@ross.com', 'password', '', '', '', '', '', '', '145453229012647384_1114683071877907_6408751323295654889_n.jpg', 7),
('Kenny White', 'Jimmy Hendrix', 'kenny@ross.com', 'password', '', '', '', '', '', '', '145453233112038036_775441409232737_2807659904406094955_n.jpg', 8),
('Lesley Muego', 'Lesley', 'lesley@ross.com', 'password', '', '', '', '', '', '', 'lesley.jpg', 9),
('David Muego', 'David', 'david@ross.com', 'password', '', '', '', '', '', '', 'david.jpg', 10),
('Lewis Muego', 'Lewis', 'lewis@ross.com', 'password', '', '', '', '', '', '', 'lewis.jpg', 12),
('Jamie Morton', 'Jamsy', 'jamie@ross.com', 'password', '', '', '', '', '', '', 'default.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `user` varchar(255) NOT NULL,
  `songID` varchar(11) NOT NULL,
  `voted` int(1) NOT NULL,
  `totalvotes` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`user`, `songID`, `voted`, `totalvotes`) VALUES
('rossmuego@gmail.com', '5ckt0nqVc80', 1, 1),
('rossmuego@gmail.com', 'QAi0OwUXBeQ', 2, 2),
('rossmuego@gmail.com', 'evQsOFQju08', 1, 3),
('rossmuego@gmail.com', 'OBeR1wgWmCY', 1, 4),
('rossmuego@gmail.com', 'vyimNxGZ--Y', 1, 6),
('rossmuego@gmail.com', 'lLJyOMcFYeA', 2, 7),
('colin@ross.com', 'OBeR1wgWmCY', 1, 8),
('colin@ross.com', '5ckt0nqVc80', 1, 9),
('colin@ross.com', 'vyimNxGZ--Y', 1, 10),
('colin@ross.com', 'QAi0OwUXBeQ', 1, 11),
('colin@ross.com', 'lLJyOMcFYeA', 1, 12),
('ross@ross.com', '5ckt0nqVc80', 2, 13),
('ross@ross.com', '', 1, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`totalvotes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `totalvotes` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
