-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2014 at 02:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `it210`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment_type`
--

CREATE TABLE IF NOT EXISTS `attachment_type` (
  `AttachmentTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `AttachmentTypeDescription` varchar(30) NOT NULL,
  `AttachmentTypePath` varchar(20) NOT NULL,
  PRIMARY KEY (`AttachmentTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attachment_type`
--

INSERT INTO `attachment_type` (`AttachmentTypeID`, `AttachmentTypeDescription`, `AttachmentTypePath`) VALUES
(1, 'File', 'web/attachment/file/');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `CommentContent` varchar(255) NOT NULL,
  `Attachment` varchar(50) DEFAULT NULL,
  `AttachmentTypeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Like` int(11) NOT NULL,
  `TimeStamp` timestamp NOT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `AttachmentTypeID` (`AttachmentTypeID`),
  KEY `UserID` (`UserID`),
  KEY `PostID` (`PostID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `CommentContent`, `Attachment`, `AttachmentTypeID`, `UserID`, `PostID`, `Like`, `TimeStamp`) VALUES
(1, 'Sample Comment', NULL, 1, 1, 3, 0, '2014-12-07 10:45:30'),
(2, 'Sample comment!!!', NULL, 1, 1, 21, 0, '2014-12-07 17:23:25'),
(3, 'Sample Comment! Gumanaaaa ka na. Please.', NULL, 1, 1, 4, 0, '2014-12-07 22:01:48'),
(4, 'Isa pang comment. Belat. :P', NULL, 1, 1, 4, 0, '2014-12-07 22:02:29'),
(5, 'Isa pang comment. :)', NULL, 1, 1, 3, 0, '2014-12-08 07:17:17'),
(6, 'Isa pang comment ulit! :)', NULL, 1, 1, 3, 0, '2014-12-08 10:05:26'),
(7, 'Sample! 4th comment! :)', NULL, 1, 1, 3, 0, '2014-12-08 10:21:16'),
(8, 'Sample. 5th Comment! :)', NULL, 1, 1, 3, 0, '2014-12-08 10:26:19'),
(9, 'Comment ulit. 6th na. :)', NULL, 1, 1, 3, 0, '2014-12-08 10:47:47'),
(10, 'I </3 EZ DAWG', NULL, 1, 1, 20, 0, '2014-12-08 10:49:04'),
(11, 'I EZ DAWG', NULL, 1, 1, 20, 0, '2014-12-08 10:49:23'),
(12, 'I <3 EZ DAWG', NULL, 1, 1, 20, 0, '2014-12-08 10:49:51'),
(13, 'I </3 ', NULL, 1, 1, 20, 0, '2014-12-08 10:50:03'),
(14, '</3', NULL, 1, 1, 20, 0, '2014-12-08 10:58:48'),
(15, 'HiHi :*', NULL, 1, 1, 20, 0, '2014-12-08 12:26:38'),
(16, 'Bagong comment! :)', NULL, 1, 1, 3, 0, '2014-12-08 12:34:47'),
(17, 'w3w', NULL, 1, 1, 22, 0, '2014-12-08 12:35:01'),
(18, 'Comment dito o. :)', NULL, 1, 1, 4, 0, '2014-12-08 15:18:26'),
(19, 'Dagdag pang comment. :))', NULL, 1, 1, 3, 0, '2014-12-08 15:28:06'),
(20, 'EZ DAWG', NULL, 1, 1, 20, 0, '2014-12-08 15:47:30'),
(21, 'Hello po. :)', NULL, 1, 1, 27, 0, '2014-12-09 10:47:03'),
(22, 'Dag dag comment', NULL, 1, 1, 29, 0, '2014-12-09 15:20:45'),
(23, 'Comment', 'naruto_22.jpg', 1, 1, 29, 0, '2014-12-09 18:40:10'),
(24, 'Sample comment sa popular na may attachment. :)', 'naruto_1111123.jpg', 1, 1, 3, 0, '2014-12-09 18:38:14'),
(25, 'Lagyan din ng file! ', 'naruto_1111124.jpg', 1, 1, 27, 0, '2014-12-09 18:38:14'),
(26, 'Sample comment from individual post. :)', '', 1, 1, 29, 0, '2014-12-09 18:29:58'),
(27, 'Sample comment again from post with file. :)', 'it210_1111126.sql', 1, 1, 29, 0, '2014-12-09 18:38:36'),
(28, 'Sample na may attachment. :)', 'naruto_1111127.jpg', 1, 1, 29, 0, '2014-12-10 04:23:32'),
(29, 'ghjghjgh', NULL, 1, 1, 16, 0, '2014-12-10 04:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `NotificationID` int(11) NOT NULL AUTO_INCREMENT,
  `PostID` int(11) NOT NULL,
  `NotificationContent` varchar(255) NOT NULL,
  `NotificationType` varchar(10) NOT NULL COMMENT 'comment/like',
  `NotificationFrom` int(11) NOT NULL COMMENT 'UserID in session',
  `TimeStamp` timestamp NOT NULL,
  PRIMARY KEY (`NotificationID`),
  KEY `PostID` (`PostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `PostTitle` varchar(50) DEFAULT NULL,
  `PostTypeID` int(11) NOT NULL DEFAULT '1',
  `PostContent` varchar(255) NOT NULL,
  `Tags` varchar(50) DEFAULT NULL COMMENT 'separate by comma ',
  `Attachment` varchar(50) DEFAULT NULL,
  `AttachmentTypeID` int(11) NOT NULL DEFAULT '1',
  `UserID` int(11) NOT NULL DEFAULT '1',
  `Likes` int(11) DEFAULT NULL,
  `Pinned` int(1) DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL,
  PRIMARY KEY (`PostID`),
  KEY `PostTypeID` (`PostTypeID`),
  KEY `TagID` (`Tags`),
  KEY `AttachmentTypeID` (`AttachmentTypeID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `PostTitle`, `PostTypeID`, `PostContent`, `Tags`, `Attachment`, `AttachmentTypeID`, `UserID`, `Likes`, `Pinned`, `TimeStamp`) VALUES
(3, 'Sample', 1, 'Sample Post! :)', 'sample, first', NULL, 1, 1, 25, 0, '2014-12-08 14:38:24'),
(4, 'Sample', 1, 'Sample naman. Please. Kahit isa lang. :(', 'sample', NULL, 1, 1, 23, NULL, '2014-12-09 14:17:15'),
(7, 'Sample nam', 1, 'Sample naman para sa title! :)', 'sample', NULL, 1, 1, 1, NULL, '2014-12-09 14:17:15'),
(8, 'Sample ulit par...', 1, 'Sample ulit para sa title. Mukang totoo na dapat. :)', 'sample', NULL, 1, 1, 14, NULL, '2014-12-09 14:17:15'),
(9, 'Sample po ulit....', 1, 'Sample po ulit. Sana tama na ituuuu! ', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(10, 'Sample po ulit....', 1, 'Sample po ulit. Maling kanina yung nalog e. :(', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(11, 'Sample sana tam...', 1, 'Sample sana tama ang user. :))', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(12, 'Hi po. Hihihihi...', 1, 'Hi po. Hihihihi <3', NULL, NULL, 1, 1, 0, NULL, '2014-11-30 11:12:21'),
(13, 'Sample po ulit....', 1, 'Sample po ulit. Sana maprint na yung users. :)', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(14, 'SAmple. Labas n...', 1, 'SAmple. Labas naman yung username. :)', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(15, 'aasaasasas...', 1, 'aasaasasas', NULL, NULL, 1, 1, 0, NULL, '2014-11-30 19:23:33'),
(16, 'Sample po na ba...', 1, 'Sample po na bago. :)) December na o. ', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(17, 'Sample muna uli...', 1, 'Sample muna ulit. Dapat tama ka na talaga. As in tamang tama! ', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(18, 'Sample na bago....', 1, 'Sample na bago. :)) ', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(19, 'Sample. Dapat t...', 1, 'Sample. Dapat tama ang oras. Haha. :)) ', 'sample', NULL, 1, 1, 0, NULL, '2014-12-09 14:17:15'),
(20, 'I <3 EZ DAWG...', 1, 'I <3 EZ DAWG', NULL, NULL, 1, 1, 3, 0, '2014-12-08 11:43:17'),
(21, 'Sample na may s...', 1, 'Sample na may sorting something. :)', NULL, NULL, 1, 1, 5, NULL, '2014-12-07 15:26:10'),
(22, 'Pinakabago! :)...', 1, 'Pinakabago! :)', NULL, NULL, 1, 1, 1, 0, '2014-12-08 14:37:58'),
(23, 'So may nakauplo...', 1, 'So may nakaupload dito. :)', NULL, NULL, 1, 1, 0, 0, '2014-12-09 08:19:34'),
(24, 'Sample at may n...', 1, 'Sample at may nakaupload dito. :)', NULL, 'naruto.jpg', 1, 1, 0, 0, '2014-12-09 08:41:42'),
(25, 'Sample na may u...', 1, 'Sample na may upload na kakaiba ang filename. :)', NULL, 'naruto_24.jpg', 1, 1, 0, 0, '2014-12-09 09:01:29'),
(26, 'Sample ulit na ...', 1, 'Sample ulit na dapat iba na ang filename. :)', NULL, 'naruto_25.jpg', 1, 1, 0, 0, '2014-12-09 09:01:29'),
(27, 'Sample na sana ...', 1, 'Sample na sana mabago na yung file_name. :)', NULL, 'naruto_26.jpg', 1, 1, 2, 1, '2014-12-09 09:01:29'),
(28, 'Sample ulit. Sa...', 1, 'Sample ulit. Sana tama na ayung file Name. Huhu.', 'sample', 'naruto_27.jpg', 1, 1, 0, 0, '2014-12-09 14:14:32'),
(29, 'Posts. ...', 1, 'Posts. ', NULL, NULL, 1, 1, 1, 0, '2014-12-09 14:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `post_type`
--

CREATE TABLE IF NOT EXISTS `post_type` (
  `PostTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `PostTypeDescription` varchar(30) NOT NULL,
  PRIMARY KEY (`PostTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `post_type`
--

INSERT INTO `post_type` (`PostTypeID`, `PostTypeDescription`) VALUES
(1, 'Announcements');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `TagID` int(11) NOT NULL AUTO_INCREMENT,
  `TagDescription` varchar(30) NOT NULL,
  PRIMARY KEY (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(30) NOT NULL,
  `MiddleName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserTypeID` int(11) NOT NULL,
  `ClassSection` varchar(30) NOT NULL,
  `Picture` varchar(30) NOT NULL,
  `StudentNumber` varchar(15) NOT NULL,
  `EmployeeNumber` varchar(15) NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `UserTypeID` (`UserTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `MiddleName`, `LastName`, `UserName`, `Password`, `UserTypeID`, `ClassSection`, `Picture`, `StudentNumber`, `EmployeeNumber`) VALUES
(1, 'Roinand', 'Baral', 'Aguila', 'roi', '4eb2f856e8c3c20f2a0bd9cd45197918', 1, 'EF-1L', 'roi.png', '2009-23791', ''),
(2, 'Sample', 'Sample', 'Sample', 'sample', '5e8ff9bf55ba3508199d22e984129be6', 1, 'EF-1L', '/asdasd/asd', '2009-12345', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `UserTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `UserTypeDescription` varchar(50) NOT NULL,
  PRIMARY KEY (`UserTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`UserTypeID`, `UserTypeDescription`) VALUES
(1, 'Admin'),
(2, 'Professor'),
(3, 'Student');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`AttachmentTypeID`) REFERENCES `attachment_type` (`AttachmentTypeID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`PostTypeID`) REFERENCES `post_type` (`PostTypeID`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`AttachmentTypeID`) REFERENCES `attachment_type` (`AttachmentTypeID`),
  ADD CONSTRAINT `posts_ibfk_4` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserTypeID`) REFERENCES `user_type` (`UserTypeID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
