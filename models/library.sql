-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 02:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `idBook` int(10) NOT NULL,
  `nameBook` varchar(100) NOT NULL,
  `quantityBook` int(11) NOT NULL,
  `imgBook` varchar(255) NOT NULL,
  `creatorBook` varchar(50) NOT NULL,
  `publisherBook` varchar(255) NOT NULL,
  `dateBook` year(4) NOT NULL,
  `desBook` varchar(500) NOT NULL,
  `id_Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`idBook`, `nameBook`, `quantityBook`, `imgBook`, `creatorBook`, `publisherBook`, `dateBook`, `desBook`, `id_Category`) VALUES
(1, 'Harry Potter', 10, '', 'J.K. Rowling', 'Trương Văn Đạt', 2005, 'A fantasy novel series', 8),
(2, 'To Kill a Mockingbird', 5, '', 'Harper Lee', 'Trương Văn Đạt', 1960, 'A classic American novel', 9),
(3, 'The Great Gatsby', 3, '', 'F. Scott Fitzgerald', 'Trương Văn Đạt', 1925, 'A novel set in the Jazz Age', 10),
(4, 'Pride and Prejudice', 7, '', 'Jane Austen', 'Trương Văn Đạt', 0000, 'A classic romance novel', 11),
(5, '1984', 8, '', 'George Orwell', 'Trương Văn Đạt', 1949, 'A dystopian novel', 12),
(6, 'The Catcher in the Rye', 4, '', 'J.D. Salinger', 'Trương Văn Đạt', 1951, 'A coming-of-age novel', 13),
(7, 'To Kill a Kingdom', 6, '', 'Alexandra Christo', 'Trương Văn Đạt', 2018, 'A fantasy novel about sirens and pirates', 14),
(8, 'The Alchemist', 2, '', 'Paulo Coelho', 'Trương Văn Đạt', 1988, 'A philosophical novel', 12),
(9, 'The Da Vinci Code', 9, '', 'Dan Brown', 'Trương Văn Đạt', 2003, 'A mystery thriller', 11),
(10, 'The Lord of the Rings', 3, '', 'J.R.R. Tolkien', 'Trương Văn Đạt', 1954, 'An epic high fantasy novel', 12),
(11, 'The Hobbit', 5, '', 'J.R.R. Tolkien', 'Trương Văn Đạt', 1937, 'A fantasy adventure novel', 10),
(12, 'The Chronicles of Narnia', 7, '', 'C.S. Lewis', 'Trương Văn Đạt', 1950, 'A series of fantasy novels', 9);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` int(11) NOT NULL,
  `nameCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idCategory`, `nameCategory`) VALUES
(8, 'Bài giảng'),
(9, 'Giáo trình'),
(10, 'Đề tài NCKH'),
(11, 'Luận án'),
(12, 'Luận văn'),
(13, 'Tiểu luận/ĐATN'),
(14, 'Tiểu thuyết');

-- --------------------------------------------------------

--
-- Table structure for table `google_account`
--

CREATE TABLE `google_account` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('google','facebook','twitter','linkedin') NOT NULL DEFAULT 'google',
  `oauth_uid` varchar(50) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `idRequest` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `id_Book` int(11) NOT NULL,
  `dateRequest` datetime NOT NULL,
  `statusRequest` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`idRequest`, `id_User`, `id_Book`, `dateRequest`, `statusRequest`) VALUES
(2, 1, 1, '0000-00-00 00:00:00', 0),
(5, 1, 2, '2024-05-19 03:21:26', 0),
(10, 1, 1, '2024-05-19 03:27:34', 0),
(11, 1, 1, '2024-05-19 03:30:15', 0),
(12, 1, 4, '2024-05-19 03:30:26', 0),
(13, 1, 2, '2024-05-19 03:34:58', 0),
(14, 1, 8, '2024-05-19 03:43:56', 0),
(15, 1, 5, '2024-05-19 03:44:28', 0),
(18, 1, 6, '2024-05-19 04:46:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `idUpload` int(10) NOT NULL,
  `uploadURL` varchar(500) NOT NULL,
  `titleUpload` varchar(255) NOT NULL,
  `timeUpload` datetime NOT NULL,
  `id_User` int(10) NOT NULL,
  `id_Book` int(10) DEFAULT NULL,
  `id_Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`idUpload`, `uploadURL`, `titleUpload`, `timeUpload`, `id_User`, `id_Book`, `id_Category`) VALUES
(15, 'https://res.cloudinary.com/dfjcxmlot/image/upload/v1716044697/library_CTUT/noss3x6fslgwrklukrdg.pdf', 'Tàaaaaaaaaa', '2024-05-18 22:04:49', 1, 7, 13),
(18, 'https://res.cloudinary.com/dfjcxmlot/image/upload/v1716061511/library_CTUT/ig8hbd58rqp1bqgimyg2.pdf', 'AAAAAAA2321', '2024-05-19 02:45:03', 1, NULL, 11),
(19, 'https://res.cloudinary.com/dfjcxmlot/image/upload/v1716064947/library_CTUT/txa3x5gnx572pu2wemwh.pdf', 'DAAT', '2024-05-19 03:42:18', 1, NULL, 10),
(32, 'https://res.cloudinary.com/dfjcxmlot/image/upload/v1716068468/library_CTUT/lkdhv3xvjst3zi6tidwc.pdf', '31111', '2024-05-19 04:41:00', 1, NULL, 11),
(34, 'https://res.cloudinary.com/dfjcxmlot/image/upload/v1716068684/library_CTUT/ipcyo1sre5gw6jnrfww1.pdf', 'awww', '2024-05-19 04:44:35', 1, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `studentCode` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `identificationNumber` varchar(12) NOT NULL,
  `roleAccess` int(11) NOT NULL DEFAULT 1,
  `className` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `studentCode`, `password`, `fullName`, `dateOfBirth`, `address`, `phoneNumber`, `email`, `identificationNumber`, `roleAccess`, `className`) VALUES
(1, '2100143', '$2y$10$DUH/AuLaz3vhP0/YWeVQZOps9NfGwLYD3K8XtuFiCLRRhBHHZPUla', 'Trương Văn Đạt', '2003-01-26', 'Sóc Trăng', '0352039701', 'tvdat2100143@student.ctuet.edu.vn', '2147483647', 1, 'KPTM0121'),
(3, '2101364', '$2y$10$dEkVu/L7CY3j..LVnzq1M.w.oBS.CqznACZbFuZWyQB0hOY91KQ.C', 'Nguyễn Lê Tấn Đạt', '2003-04-20', 'Óc Eo, Thoại Sơn, An Giang', '0397364664', 'dat.nglt@gmail.com', '2147483647', 1, 'KTPM0121'),
(5, '2101251', '$2y$10$ipFP9KWYD9ul.WZf2ZQvyue1nrlwsUizilh6QgxpiF0siPzMbjgKS', 'Lê Nguyễn Minh Hòa', '2003-09-27', 'Cần Thơ', '0836752978', 'lnmhoa@gmail.com', '243535760465', 0, 'KTPM0121');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idBook`),
  ADD UNIQUE KEY `tenSach` (`nameBook`),
  ADD KEY `id_Category` (`id_Category`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `google_account`
--
ALTER TABLE `google_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`idRequest`),
  ADD KEY `id_Book` (`id_Book`),
  ADD KEY `id_User` (`id_User`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`idUpload`),
  ADD KEY `idUser` (`id_User`),
  ADD KEY `idBook` (`id_Book`),
  ADD KEY `id_Category` (`id_Category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `idBook` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `google_account`
--
ALTER TABLE `google_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `idRequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `idUpload` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_Category`) REFERENCES `category` (`idCategory`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_Book`) REFERENCES `book` (`idBook`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `upload_ibfk_2` FOREIGN KEY (`id_Book`) REFERENCES `book` (`idBook`),
  ADD CONSTRAINT `upload_ibfk_3` FOREIGN KEY (`id_Category`) REFERENCES `category` (`idCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
