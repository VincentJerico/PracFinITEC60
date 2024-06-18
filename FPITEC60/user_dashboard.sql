-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 07:42 AM
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
-- Database: `user_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `remember_me_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `age`, `date_of_birth`, `gender`, `password`, `time_in`, `time_out`, `remember_me_token`, `reset_token`, `reset_expiry`) VALUES
(15, 'testuser1', 'testuser1@example.com', 20, '2003-12-07', 'Male', '$2y$10$Hm208jTeDpOP5mGD.SdqKu57nUkA90vqwRH3s2rJLBwo/w5ND3mZ2', '2024-06-16 02:21:46', '2024-06-16 02:21:51', NULL, 'aeaa3d3c147cb05e6472de73eda3e021', '2024-06-17 19:21:00'),
(16, 'testuser2', 'testuser2@example.com', 21, '2002-12-21', 'Female', '$2y$10$H04hATjZ7Wewxgv1o5W7TesecGlUTXidR8mYohkVdmYJ3SGIUgC/W', '2024-06-16 02:22:53', '2024-06-16 02:24:46', NULL, NULL, NULL),
(17, 'testuser3', 'testuser3@example.com', 7, '2017-03-20', 'Male', '$2y$10$XaDfHFpjbNTjNcc6GIBiPuUdch4m1OPWHoLyyCjmP3fkZh4yv7BOC', '2024-06-18 13:41:03', '2024-06-18 13:27:07', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
