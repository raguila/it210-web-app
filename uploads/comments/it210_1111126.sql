-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2014 at 03:42 AM
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
  `PostTitle` varchar(50) DEFAULT NULL,
  `PostTypeID` int(11) NOT NULL DEFAULT '1',
  `PostContent` varchar(255) NOT NULL,
  `Tags` varchar(50) DEFAULT NULL COMMENT 'separate by comma ',
  `Attachment` varchar(50) NOT NULL DEFAULT 'attachment/post/',
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `PostTitle`, `PostTypeID`, `PostContent`, `Tags`, `Attachment`, `AttachmentTypeID`, `UserID`, `Likes`, `Pinned`, `TimeStamp`) VALUES
(3, 'Sample', 1, 'Sample Post! :)', 'sample, first', '/sample/path', 1, 1, 0, 0, '2014-12-01 02:41:17'),
(4, NULL, 1, 'Sample naman. Please. Kahit isa lang. :(', NULL, 'attachment/post/', 1, 1, NULL, NULL, '0000-00-00 00:00:00'),
(5, NULL, 1, 'Isa pa please. Gumana ka naman. :(', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-29 16:00:00'),
(6, NULL, 1, 'Isa pa po. Para macheck yung time. :)', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 10:02:12'),
(7, 'Sample nam', 1, 'Sample naman para sa title! :)', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 10:06:51'),
(8, 'Sample ulit par...', 1, 'Sample ulit para sa title. Mukang totoo na dapat. :)', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 10:09:04'),
(9, 'Sample po ulit....', 1, 'Sample po ulit. Sana tama na ituuuu! ', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 10:56:01'),
(10, 'Sample po ulit....', 1, 'Sample po ulit. Maling kanina yung nalog e. :(', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 10:58:56'),
(11, 'Sample sana tam...', 1, 'Sample sana tama ang user. :))', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 11:08:58'),
(12, 'Hi po. Hihihihi...', 1, 'Hi po. Hihihihi <3', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 11:12:21'),
(13, 'Sample po ulit....', 1, 'Sample po ulit. Sana maprint na yung users. :)', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 11:20:57'),
(14, 'SAmple. Labas n...', 1, 'SAmple. Labas naman yung username. :)', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 11:23:13'),
(15, 'aasaasasas...', 1, 'aasaasasas', NULL, 'attachment/post/', 1, 1, NULL, NULL, '2014-11-30 19:23:33');

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
