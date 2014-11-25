-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2014 at 06:37 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `CommentContent` varchar(255) NOT NULL,
  `Attachment` varchar(50) NOT NULL,
  `AttachmentTypeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Like` int(11) NOT NULL,
  `TimeStamp` timestamp NOT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `AttachmentTypeID` (`AttachmentTypeID`),
  KEY `UserID` (`UserID`),
  KEY `PostID` (`PostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `PostTitle` varchar(50) NOT NULL,
  `PostTypeID` int(11) NOT NULL,
  `PostContent` varchar(255) NOT NULL,
  `TagID` int(11) NOT NULL,
  `Attachment` varchar(50) NOT NULL,
  `AttachmentTypeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Like` int(11) NOT NULL,
  `Pinned` int(1) NOT NULL,
  `TimeStamp` timestamp NOT NULL,
  PRIMARY KEY (`PostID`),
  KEY `PostTypeID` (`PostTypeID`),
  KEY `TagID` (`TagID`),
  KEY `AttachmentTypeID` (`AttachmentTypeID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_type`
--

CREATE TABLE IF NOT EXISTS `post_type` (
  `PostTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `PostTypeDescription` varchar(30) NOT NULL,
  PRIMARY KEY (`PostTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `MiddleName`, `LastName`, `UserName`, `Password`, `UserTypeID`, `ClassSection`, `Picture`, `StudentNumber`, `EmployeeNumber`) VALUES
(1, 'Roinand', 'Baral', 'Aguila', 'roi', '4eb2f856e8c3c20f2a0bd9cd45197918', 1, 'EF-1L', 'NA', '2009-23791', '');

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
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tags` (`TagID`),
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
