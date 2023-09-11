-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 12:24 PM
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
-- Database: `test-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_authors`
--

CREATE TABLE `tbl_authors` (
  `AUTHOR_ID` int(6) NOT NULL,
  `AUTHOR_NAME` varchar(100) DEFAULT NULL,
  `AUTHOR_CREATION_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `AUTHOR_UPDATION_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_authors`
--

INSERT INTO `tbl_authors` (`AUTHOR_ID`, `AUTHOR_NAME`, `AUTHOR_CREATION_DATE`, `AUTHOR_UPDATION_DATE`) VALUES
(1, 'Amit Garg', '2023-06-15 09:33:10', '2023-06-15 09:33:10'),
(2, 'Lalit Kumar', '2023-06-15 09:33:10', '2023-06-15 09:33:10'),
(3, 'Vinay Kumar Singh', '2023-06-15 09:33:10', '2023-06-15 09:33:10'),
(4, 'Sharad Kumar ', '2023-06-15 09:33:10', '2023-06-15 09:33:10'),
(5, 'Gunjan Verma', '2023-06-15 09:33:10', '2023-06-15 09:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookdetails`
--

CREATE TABLE `tbl_bookdetails` (
  `BOOK_ID` int(6) NOT NULL,
  `BOOK_TITLE` varchar(100) DEFAULT NULL,
  `BOOK_AUTHOR_ID` int(6) DEFAULT NULL,
  `BOOK_TYPE_ID` int(6) NOT NULL,
  `DATE_OF_RELEASE` date NOT NULL,
  `VOLUME` int(3) DEFAULT NULL,
  `BOOK_LANGUAGE` varchar(35) DEFAULT NULL,
  `ISBN` varchar(35) NOT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `CREATED_BY` int(6) DEFAULT NULL,
  `CREATED_ON` timestamp NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(6) DEFAULT NULL,
  `UPDATED_ON` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BOOK_IMG` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bookdetails`
--

INSERT INTO `tbl_bookdetails` (`BOOK_ID`, `BOOK_TITLE`, `BOOK_AUTHOR_ID`, `BOOK_TYPE_ID`, `DATE_OF_RELEASE`, `VOLUME`, `BOOK_LANGUAGE`, `ISBN`, `PRICE`, `CREATED_BY`, `CREATED_ON`, `UPDATED_BY`, `UPDATED_ON`, `BOOK_IMG`) VALUES
(101, 'Junior level books Introduction to Computers', 1, 2, '2013-06-06', 0, 'English', '987-93-5019-561-1', 100.00, 1, '2023-06-16 05:22:45', 1, '2023-06-16 05:23:51', NULL),
(102, 'Publish News Letters', 1, 1, '2017-03-10', 0, 'English', '', 120.00, 1, '2023-06-16 05:22:45', 1, '2023-06-16 05:24:09', NULL),
(103, 'Client Server Computing', 2, 2, '2016-04-07', 0, 'English', '987-93-8067-432-2', 100.00, 1, '2023-06-16 05:22:45', 1, '2023-06-16 05:24:28', NULL),
(104, 'DATA STRUCTURES', 3, 1, '2016-09-30', 0, 'English', '978-93-5136-389-1', 100.00, 1, '2023-06-16 05:22:45', 1, '2023-06-21 06:00:20', NULL),
(105, 'CBOT', 5, 2, '2023-12-11', 0, 'English', '', 80.00, 1, '2023-06-16 05:22:45', 1, '2023-06-16 05:24:59', NULL),
(107, 'Programming with Python', 4, 2, '0000-00-00', NULL, NULL, '893-823-432-43', 200.00, NULL, '2023-06-22 06:55:57', NULL, '2023-06-22 06:55:57', ''),
(108, '\"Coding with Harry\"', 2, 2, '2017-03-10', 1, 'English', '826-382-77-21', 100.00, 5, '2023-06-22 10:17:33', NULL, '2023-06-22 10:17:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookmaster`
--

CREATE TABLE `tbl_bookmaster` (
  `BOOK_ACCESSION_ID` int(6) NOT NULL,
  `BOOK_ID` int(6) NOT NULL,
  `BOOK_STATUS` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bookmaster`
--

INSERT INTO `tbl_bookmaster` (`BOOK_ACCESSION_ID`, `BOOK_ID`, `BOOK_STATUS`) VALUES
(1, 105, 1),
(2, 105, NULL),
(3, 103, 0),
(4, 101, 1),
(5, 102, 0),
(6, 104, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booktype`
--

CREATE TABLE `tbl_booktype` (
  `BOOK_TYPE_ID` int(6) NOT NULL,
  `BOOK_TYPE_NAME` varchar(100) NOT NULL,
  `CABINET_NO` int(6) DEFAULT NULL,
  `STATUS` int(1) DEFAULT NULL,
  `CREATED_ON` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_ON` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booktype`
--

INSERT INTO `tbl_booktype` (`BOOK_TYPE_ID`, `BOOK_TYPE_NAME`, `CABINET_NO`, `STATUS`, `CREATED_ON`, `UPDATED_ON`) VALUES
(1, 'Information Technology', 1, 1, '2023-06-19 07:25:12', '2023-06-19 07:25:12'),
(2, 'Computer Science', 2, 0, '2023-06-19 07:25:12', '2023-06-19 07:25:12'),
(3, 'young adult', NULL, 1, '2023-06-22 11:20:16', '2023-06-22 11:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issuenreturn`
--

CREATE TABLE `tbl_issuenreturn` (
  `ISSUE_ID` int(6) NOT NULL,
  `ACCESSION_FK_ID` int(6) NOT NULL,
  `USERS_FK_ID` int(6) NOT NULL,
  `STATUS` int(1) DEFAULT NULL,
  `ISSUE_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `RETURN_DATE` timestamp NULL DEFAULT NULL,
  `UPDATED_ON` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `UPDATED_BY` int(6) DEFAULT NULL,
  `UPDATED_BY_NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_issuenreturn`
--

INSERT INTO `tbl_issuenreturn` (`ISSUE_ID`, `ACCESSION_FK_ID`, `USERS_FK_ID`, `STATUS`, `ISSUE_DATE`, `RETURN_DATE`, `UPDATED_ON`, `UPDATED_BY`, `UPDATED_BY_NAME`) VALUES
(1, 3, 4, 0, '2023-06-16 06:41:01', NULL, '2023-06-20 16:41:12', NULL, NULL),
(2, 4, 2, 1, '2023-06-14 10:56:01', '2023-06-21 09:05:32', '2023-06-22 14:35:44', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newbookrequest`
--

CREATE TABLE `tbl_newbookrequest` (
  `BOOK_REQUEST_ID` int(6) NOT NULL,
  `BOOK_REQUESTED_ON` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BOOK_REQUEST_BY` int(6) NOT NULL,
  `IS_APPROVED_FLAG` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_newbookrequest`
--

INSERT INTO `tbl_newbookrequest` (`BOOK_REQUEST_ID`, `BOOK_REQUESTED_ON`, `BOOK_REQUEST_BY`, `IS_APPROVED_FLAG`) VALUES
(1, '2023-06-16 06:27:00', 4, NULL),
(5, '2023-06-16 06:27:00', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `USER_ID` int(6) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `USERS_GENERATED_ID` varchar(100) NOT NULL,
  `USER_PASSWORD` varchar(120) NOT NULL,
  `NAME_OF_USER` varchar(120) NOT NULL,
  `USER_TYPE` int(6) NOT NULL,
  `USER_EMAIL` varchar(150) DEFAULT NULL,
  `USER_STATUS` int(1) DEFAULT NULL,
  `USER_CREATED_ON` timestamp NULL DEFAULT current_timestamp(),
  `USER_UPDATED_ON` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`USER_ID`, `USERNAME`, `USERS_GENERATED_ID`, `USER_PASSWORD`, `NAME_OF_USER`, `USER_TYPE`, `USER_EMAIL`, `USER_STATUS`, `USER_CREATED_ON`, `USER_UPDATED_ON`) VALUES
(1, 'admin', 'UID01', '0c909a141f1f2c0a1cb602b0b2d7d050', 'Devesh', 1, 'user@gmail.com', 0, '2023-05-31 18:35:27', '2023-06-28 06:14:12'),
(2, 'user1', 'UID02', '6ad14ba9986e3615423dfca256d04e3f', 'Joy', 2, 'user1@gmail.com', 1, '2023-05-31 18:35:27', '2023-06-22 14:15:09'),
(4, 'user5', 'UID03', '6ad14ba9986e3615423dfca256d04e3f', 'Joanisa', 2, 'user2@gmail.com', 0, '2023-06-16 06:22:56', '2023-06-27 13:45:29'),
(5, 'admin2', 'UID04', '0192023a7bbd73250516f069df18b500', 'Lynn', 1, 'admin2@gmail.com', 0, '2023-06-19 09:20:34', '2023-06-27 13:45:17'),
(6, 'user', 'UID05', '6ad14ba9986e3615423dfca256d04e3f', 'Koni', 2, 'user@gmail.com', 0, '2023-06-21 21:29:14', '2023-06-22 15:18:06'),
(19, 'sang', 'UID06', 'bb1fd84f3c93eecf02e3153cccf98d98', 'sang', 2, 'sang@gmail.com', 1, '2023-06-22 15:17:08', '2023-06-22 15:17:08'),
(20, 'ccbello', 'UID13', '06964dce9addb1c5cb5d6e3d9838f733', 'Camila', 2, 'camila@gmail.com', 1, NULL, NULL),
(21, 'Gimejoy', 'UID07', '0d5425118d7aaa57e0f18a9e0d87104b', 'Gime Joy Saikia', 2, 'joysekhars@gmail.com', 1, NULL, '2023-06-27 05:39:41'),
(22, 'joysaikia2', 'UID08', '0d5425118d7aaa57e0f18a9e0d87104b', 'Joy', 2, 'JOY@GMAIL.COM', 1, NULL, '2023-06-28 09:03:31'),
(23, 'user4', 'UID09', '6ad14ba9986e3615423dfca256d04e3f', 'user4', 2, 'user4@gmail.com', 1, '2023-06-28 09:04:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE `tbl_usertype` (
  `USER_TYPE_ID` int(6) NOT NULL,
  `USER_TYPE_NAME` varchar(100) NOT NULL,
  `CREATED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`USER_TYPE_ID`, `USER_TYPE_NAME`, `CREATED_ON`) VALUES
(1, 'ADMIN', '2023-06-15 11:47:43'),
(2, 'USER', '2023-06-15 11:47:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_authors`
--
ALTER TABLE `tbl_authors`
  ADD PRIMARY KEY (`AUTHOR_ID`);

--
-- Indexes for table `tbl_bookdetails`
--
ALTER TABLE `tbl_bookdetails`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `BOOK_TYPE_FK` (`BOOK_TYPE_ID`),
  ADD KEY `BOOK_AUTHOR_IF_FK` (`BOOK_AUTHOR_ID`),
  ADD KEY `UPDATED_BY_FK` (`UPDATED_BY`),
  ADD KEY `CREATED_BY_FK` (`CREATED_BY`);

--
-- Indexes for table `tbl_bookmaster`
--
ALTER TABLE `tbl_bookmaster`
  ADD PRIMARY KEY (`BOOK_ACCESSION_ID`),
  ADD KEY `BOOK_ID_FK` (`BOOK_ID`);

--
-- Indexes for table `tbl_booktype`
--
ALTER TABLE `tbl_booktype`
  ADD PRIMARY KEY (`BOOK_TYPE_ID`);

--
-- Indexes for table `tbl_issuenreturn`
--
ALTER TABLE `tbl_issuenreturn`
  ADD PRIMARY KEY (`ISSUE_ID`),
  ADD KEY `ACCESSION_ID_FK` (`ACCESSION_FK_ID`),
  ADD KEY `USERS_ID_FK` (`USERS_FK_ID`),
  ADD KEY `UPDATED_BY` (`UPDATED_BY`);

--
-- Indexes for table `tbl_newbookrequest`
--
ALTER TABLE `tbl_newbookrequest`
  ADD PRIMARY KEY (`BOOK_REQUEST_ID`),
  ADD KEY `BOOK_REQUEST_BY_FK` (`BOOK_REQUEST_BY`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `USER_TYPE_FK` (`USER_TYPE`);

--
-- Indexes for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  ADD PRIMARY KEY (`USER_TYPE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_authors`
--
ALTER TABLE `tbl_authors`
  MODIFY `AUTHOR_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_bookdetails`
--
ALTER TABLE `tbl_bookdetails`
  MODIFY `BOOK_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_bookmaster`
--
ALTER TABLE `tbl_bookmaster`
  MODIFY `BOOK_ACCESSION_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_booktype`
--
ALTER TABLE `tbl_booktype`
  MODIFY `BOOK_TYPE_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_issuenreturn`
--
ALTER TABLE `tbl_issuenreturn`
  MODIFY `ISSUE_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_newbookrequest`
--
ALTER TABLE `tbl_newbookrequest`
  MODIFY `BOOK_REQUEST_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `USER_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  MODIFY `USER_TYPE_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bookdetails`
--
ALTER TABLE `tbl_bookdetails`
  ADD CONSTRAINT `BOOK_AUTHOR_IF_FK` FOREIGN KEY (`BOOK_AUTHOR_ID`) REFERENCES `tbl_authors` (`AUTHOR_ID`),
  ADD CONSTRAINT `BOOK_TYPE_FK` FOREIGN KEY (`BOOK_TYPE_ID`) REFERENCES `tbl_booktype` (`BOOK_TYPE_ID`),
  ADD CONSTRAINT `CREATED_BY_FK` FOREIGN KEY (`CREATED_BY`) REFERENCES `tbl_users` (`USER_ID`),
  ADD CONSTRAINT `UPDATED_BY_FK` FOREIGN KEY (`UPDATED_BY`) REFERENCES `tbl_users` (`USER_ID`);

--
-- Constraints for table `tbl_bookmaster`
--
ALTER TABLE `tbl_bookmaster`
  ADD CONSTRAINT `BOOK_ID_FK` FOREIGN KEY (`BOOK_ID`) REFERENCES `tbl_bookdetails` (`BOOK_ID`);

--
-- Constraints for table `tbl_issuenreturn`
--
ALTER TABLE `tbl_issuenreturn`
  ADD CONSTRAINT `ACCESSION_ID_FK` FOREIGN KEY (`ACCESSION_FK_ID`) REFERENCES `tbl_bookmaster` (`BOOK_ACCESSION_ID`),
  ADD CONSTRAINT `UPDATED_BY` FOREIGN KEY (`UPDATED_BY`) REFERENCES `tbl_users` (`USER_ID`);

--
-- Constraints for table `tbl_newbookrequest`
--
ALTER TABLE `tbl_newbookrequest`
  ADD CONSTRAINT `BOOK_REQUEST_BY_FK` FOREIGN KEY (`BOOK_REQUEST_BY`) REFERENCES `tbl_users` (`USER_ID`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `USER_TYPE_FK` FOREIGN KEY (`USER_TYPE`) REFERENCES `tbl_usertype` (`USER_TYPE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
