-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 06:00 PM
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
-- Database: `sitin`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `content` varchar(254) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee`
--

INSERT INTO `fee` (`id`, `student_id`, `content`, `date_created`) VALUES
(1, 4, 'asdasdas', '2024-05-06 23:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `s_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `laboratory` varchar(254) NOT NULL,
  `purpose` varchar(254) NOT NULL,
  `time_in` datetime NOT NULL DEFAULT current_timestamp(),
  `time_out` datetime DEFAULT NULL,
  `day` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`s_id`, `student_id`, `laboratory`, `purpose`, `time_in`, `time_out`, `day`) VALUES
(5, 4, 'Lab 524', 'Java', '2024-03-25 00:35:42', '2024-03-24 17:40:20', ''),
(6, 6, 'Lab 524', 'Java', '2024-03-25 01:16:58', '2024-03-25 05:11:24', ''),
(7, 6, 'Lab 524', 'Java', '2024-03-25 01:17:46', '2024-03-25 05:11:24', ''),
(8, 6, 'Lab 524', 'Java', '2024-03-25 12:10:59', '2024-03-25 05:11:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `idno` int(10) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `midname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `age` int(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contactno` int(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `address` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sessions` int(11) NOT NULL DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `idno`, `firstname`, `midname`, `lastname`, `age`, `gender`, `contactno`, `email`, `address`, `password`, `sessions`) VALUES
(3, 21507777, 'David John', 'Cas', 'Capoy', 20, 'Male', 2147483647, 'djc@gmail.com', '128- F. A. Lopez St. Balaga Drive, Labangon, Cebu City', '1234', 30),
(4, 123456, 'Allan', 'Mae', 'Villegas', 22, 'Male', 911111111, 'ak@gmail.com', 'Cebu City', '1234', 30),
(5, 1234123, 'Allan', 'Mae', 'Villegas', 22, 'Male', 911111111, 'ak@gmail.com', 'Cebu City', '1234', 30),
(6, 112313312, 'Allan', 'Peter', 'Cayatano', 22, 'Male', 2147483647, 'aadk@gmail.com', 'Cebu City', '1234', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_fee` (`student_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `fk_student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fee`
--
ALTER TABLE `fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fee`
--
ALTER TABLE `fee`
  ADD CONSTRAINT `student_id_fee` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
