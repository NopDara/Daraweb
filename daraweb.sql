-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 11:57 AM
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
-- Database: `daraweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `subject`, `class`) VALUES
(1, '', '', 'A'),
(2, '', '', 'B'),
(3, '', '', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `start_at` varchar(100) NOT NULL,
  `end_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `class_id`, `teacher_id`, `subject_id`, `start_at`, `end_at`) VALUES
(1, 3, 1, 3, '7:00 am', '10:00 am'),
(2, 1, 1, 3, '8:00 am', '12:00 am'),
(3, 3, 1, 1, '7:00 am', '10:00 am'),
(4, 2, 1, 1, '7:00 am', '10:00 am'),
(5, 1, 1, 2, '7:00 am', '10:00 am');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `users_id`, `name`, `sex`, `email`, `password`, `photo`, `phone`, `address`, `role`, `is_ban`) VALUES
(1, 6, 'Pisal', 'male', '', '', '../img/306893860_3257909304460867_269040896365992265_n.jpg', '098446210', 'dongkor', 'student', 0),
(2, 8, 'ya', 'male', '', '', '../img/308990587_814631886389589_4535959942558933691_n.jpg', '098446210', 'dongkor', 'student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `student_id`, `course_id`, `score`) VALUES
(1, 2, 2, 12.00),
(2, 1, 4, 0.00),
(3, 2, 4, 0.00),
(4, 1, 5, 50.00),
(5, 2, 5, 70.00),
(6, 2, 1, 1.00),
(7, 1, 1, 0.00),
(8, 1, 3, 0.00),
(9, 2, 3, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject`, `name`) VALUES
(1, 'khmer', ''),
(2, 'englsih', ''),
(3, 'php', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `users_id`, `name`, `sex`, `email`, `password`, `photo`, `phone`, `address`, `role`, `is_ban`) VALUES
(1, 7, 'smey', 'male', '', '', '../img/240c6794d9758f7ee139c2d7fdbfe305.jpg', '098446210', 'dongkor', 'teacher', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL COMMENT 'admin,teacher,student',
  `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unban,1=ban',
  `create_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `email`, `password`, `photo`, `phone`, `address`, `role`, `is_ban`, `create_at`) VALUES
(2, 'Nop Dara', 'male', 'pongteanob@gmail.com', '$2y$10$IM8WqX7PaTPdrva3KuovL.m65AMLWAkVEE7QGyQQmNTmBf7NCM0tm', '../img/red_among_us_png_842x1024.webp', '098446210', 'dongkor', 'admin', 0, '2024-02-14'),
(3, 'Dom', 'male', 'Dom@gmail.com', '$2y$10$0GO1emPevoyEtpAkIV5FBuUbq.xc.BcTTun843.GJveVmVnA/52Gu', '../img/ea9c8e538414599290bf396e7b1b2121.jpg', '098446210', 'dongkor', 'teacher', 0, '2024-02-14'),
(4, 'tip', 'male', 'tip@gmail.com', '$2y$10$Jgy8U5qWn4aIWgJRxSUQxeQL9gwoqVB7Om6oTn2YCWDLUrdaoG.ZG', '../img/347844fa8f6fe9676baf92a341b77c1e.jpg', '098446210', 'dongkor', 'admin', 0, '2024-02-14'),
(5, 'sey', 'male', 'sey@gmail.com', '$2y$10$rExUjYReFUuzZh7x2jsureivffOEo21WmL9z8Wr5oGgaPjr8oWroG', '../img/295282085_371865268431587_8161191096411520034_n.jpg', '098446210', 'dongkor', 'student', 0, '2024-02-14'),
(6, 'Pisal', 'male', 'pisal@gmail.com', '$2y$10$hay/dzqqWQJnO/nGBCAWUep94YDRFIFp3Vv2lyTM9jIPF2Fsp94Ze', '../img/306893860_3257909304460867_269040896365992265_n.jpg', '098446210', 'dongkor', 'student', 0, '2024-02-14'),
(7, 'smey', 'male', 'smey@gmail.com', '$2y$10$HDB7yPFq81hrfDF7re5aKOp13PYMw.dhByCv5nVc0Cv8wYOTQ6Rfi', '../img/240c6794d9758f7ee139c2d7fdbfe305.jpg', '098446210', 'dongkor', 'teacher', 0, '2024-02-14'),
(8, 'ya', 'male', 'ya@gamail.com', '$2y$10$ygpCifAutFvOvylQ1/opTeZHEQaTxmJW5jcFzUyckCwPU/qeNJ.M.', '../img/308990587_814631886389589_4535959942558933691_n.jpg', '098446210', 'dongkor', 'student', 0, '2024-02-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_ibfk_1` (`users_id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_ibfk_1` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `course_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
