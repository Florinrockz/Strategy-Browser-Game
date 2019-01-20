-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2019 at 06:31 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `browsergame`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `income_wood` int(11) NOT NULL,
  `income_stone` int(11) NOT NULL,
  `income_iron` int(11) NOT NULL,
  `income_gold` int(11) NOT NULL,
  `wood_cost` int(11) NOT NULL,
  `stone_cost` int(11) NOT NULL,
  `iron_cost` int(11) NOT NULL,
  `gold_cost` int(11) NOT NULL,
  `defense` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `income_wood`, `income_stone`, `income_iron`, `income_gold`, `wood_cost`, `stone_cost`, `iron_cost`, `gold_cost`, `defense`) VALUES
(1, 'Town Hall', 50, 50, 50, 50, 100, 100, 100, 100, 25),
(2, 'Guard Tower', 0, 0, 0, 0, 30, 30, 30, 30, 50);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `stone` int(11) NOT NULL,
  `wood` int(11) NOT NULL,
  `iron` int(11) NOT NULL,
  `gold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `stone`, `wood`, `iron`, `gold`) VALUES
(1, 1000, 1000, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `register_date`) VALUES
(1, 'test', 'test123', 'test@test.com', '2019-01-16 22:27:07'),
(2, 'test2', 'test2', 'test2@test.com', '2019-01-16 22:30:30'),
(4, 'test3', 'test3', 'test3@test.com', '2019-01-16 23:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `world`
--

CREATE TABLE `world` (
  `id` int(11) NOT NULL,
  `buildings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `world`
--

INSERT INTO `world` (`id`, `buildings`) VALUES
(1, '0;0;0;0;0;0;0;0;0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
