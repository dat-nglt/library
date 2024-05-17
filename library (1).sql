-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 17, 2024 lúc 03:15 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `library`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `idBook` int(10) NOT NULL,
  `typeBook` varchar(50) NOT NULL,
  `typeDocument` varchar(50) NOT NULL,
  `creatorBook` varchar(50) NOT NULL,
  `dateBook` year(4) NOT NULL,
  `desBook` varchar(500) NOT NULL,
  `nameBook` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`idBook`, `typeBook`, `typeDocument`, `creatorBook`, `dateBook`, `desBook`, `nameBook`) VALUES
(1, 'Sách in, sách điện tử', 'Bài giảng', 'Lê Nguyễn Minh Hoà', '2020', '250 tr.', NULL),
(2, 'Sách in, sách điện tử', 'Sách học', 'Eric Matthes', '2019', '560 tr.', NULL),
(3, 'Sách in, sách điện tử', 'Sách học', 'Robert C. Martin', '2008', '432 tr.', NULL),
(4, 'Sách in, sách điện tử', 'Sách học', 'Andrew Hunt, David Thomas', '1999', '352 tr.', NULL),
(5, 'Sách in, sách điện tử', 'Sách giáo trình', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. ', '2009', '1312 tr.', NULL),
(6, 'Sách in, sách điện tử', 'Sách học', 'Erich Gamma, Richard Helm, Ralph Johnson, John Vli', '1994', '395 tr.', NULL),
(7, 'Sách in, sách điện tử', 'Sách kinh doanh', 'Eric Ries', '2011', '336 tr.', NULL),
(8, 'Sách in, sách điện tử', 'Sách học', 'Gayle Laakmann McDowell', '2015', '687 tr.', NULL),
(9, 'Sách in, sách điện tử', 'Sách học', 'Ian Goodfellow, Yoshua Bengio, Aaron Courville', '2016', '800 tr.', NULL),
(10, 'Sách in, sách điện tử', 'Sách giáo trình', 'Brian W. Kernighan, Dennis M. Ritchie', '1988', '288 tr.', NULL),
(11, 'Sách in, sách điện tử', 'Sách học', 'Eric Freeman, Elisabeth Robson, Bert Bates, Kathy ', '2004', '676 tr.', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `google_account`
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
-- Cấu trúc bảng cho bảng `upload`
--

CREATE TABLE `upload` (
  `idUpload` int(10) NOT NULL,
  `uploadURL` varchar(500) NOT NULL,
  `creatorUpload` varchar(255) NOT NULL,
  `titleUpload` varchar(255) NOT NULL,
  `EmailUpload` varchar(50) NOT NULL,
  `typeUpload` varchar(50) NOT NULL,
  `timeUpload` datetime NOT NULL,
  `idUser` int(10) NOT NULL,
  `idBook` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `upload`
--

INSERT INTO `upload` (`idUpload`, `uploadURL`, `creatorUpload`, `titleUpload`, `EmailUpload`, `typeUpload`, `timeUpload`, `idUser`, `idBook`) VALUES
(8, '312', '312', '312', '312', '312', '2024-05-16 22:47:51', 1, NULL),
(10, 'https://res.cloudinary.com/dfjcxmlot/image/upload/v1715896484/library_CTUT/nxc3lzcya9b5unohktbr.pdf', '3123', '321', 'truongvandat365@gmail.com', '2', '2024-05-17 04:54:39', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
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
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `studentCode`, `password`, `fullName`, `dateOfBirth`, `address`, `phoneNumber`, `email`, `identificationNumber`, `roleAccess`, `className`) VALUES
(1, '2100143', '$2y$10$DUH/AuLaz3vhP0/YWeVQZOps9NfGwLYD3K8XtuFiCLRRhBHHZPUla', 'Trương Văn Đạt', '2003-01-26', 'Sóc Trăng', '0352039701', 'tvdat2100143@student.ctuet.edu.vn', '094203001572', 1, 'KPTM0121'),
(3, '2101364', '$2y$10$dEkVu/L7CY3j..LVnzq1M.w.oBS.CqznACZbFuZWyQB0hOY91KQ.C', 'Nguyễn Lê Tấn Đạt', '2003-04-20', 'Óc Eo, Thoại Sơn, An Giang', '0397364664', 'dat.nglt@gmail.com', '089203002653', 1, 'Kỹ thuật phần mềm Khoá 9');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idBook`),
  ADD UNIQUE KEY `nameBook` (`nameBook`);

--
-- Chỉ mục cho bảng `google_account`
--
ALTER TABLE `google_account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`idUpload`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `ibBook` (`idBook`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `book`
--
ALTER TABLE `book`
  MODIFY `idBook` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `google_account`
--
ALTER TABLE `google_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `upload`
--
ALTER TABLE `upload`
  MODIFY `idUpload` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `upload_ibfk_2` FOREIGN KEY (`idBook`) REFERENCES `book` (`idBook`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
