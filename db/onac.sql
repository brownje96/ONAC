-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: onac
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE DATABASE onac;
USE onac;

--
-- Table structure for table `community`
--

DROP TABLE IF EXISTS `community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `community` (
  `communityID` int(11) NOT NULL AUTO_INCREMENT,
  `communityName` varchar(25) NOT NULL,
  `isPrivate` bit(1) NOT NULL DEFAULT b'0',
  `privateReason` text DEFAULT NULL,
  `foundingUser` varchar(25) NOT NULL,
  `foundingTimestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `isWarned` bit(1) NOT NULL DEFAULT b'0',
  `warnedReason` text DEFAULT NULL,
  `isBanned` bit(1) NOT NULL DEFAULT b'0',
  `bannedReason` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`communityID`),
  UNIQUE KEY `community_UN` (`communityName`),
  KEY `community_FK` (`foundingUser`),
  CONSTRAINT `community_FK` FOREIGN KEY (`foundingUser`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COMMENT='this tables stores the communities created on this instance of ONAC.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community`
--

LOCK TABLES `community` WRITE;
/*!40000 ALTER TABLE `community` DISABLE KEYS */;
/*!40000 ALTER TABLE `community` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invex`
--

DROP TABLE IF EXISTS `invex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userInvited` varchar(25) NOT NULL,
  `community` varchar(25) NOT NULL,
  `approvingModerator` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invex_FK` (`userInvited`),
  KEY `invex_FK_1` (`community`),
  KEY `invex_FK_2` (`approvingModerator`),
  CONSTRAINT `invex_FK` FOREIGN KEY (`userInvited`) REFERENCES `user` (`username`),
  CONSTRAINT `invex_FK_1` FOREIGN KEY (`community`) REFERENCES `community` (`communityName`),
  CONSTRAINT `invex_FK_2` FOREIGN KEY (`approvingModerator`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='this table stores the invites to private communities.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invex`
--

LOCK TABLES `invex` WRITE;
/*!40000 ALTER TABLE `invex` DISABLE KEYS */;
/*!40000 ALTER TABLE `invex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderators`
--

DROP TABLE IF EXISTS `moderators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moderators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `community` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moderators_FK` (`username`),
  KEY `moderators_FK_1` (`community`),
  CONSTRAINT `moderators_FK` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  CONSTRAINT `moderators_FK_1` FOREIGN KEY (`community`) REFERENCES `community` (`communityName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This table describes what users are moderators of what communities.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderators`
--

LOCK TABLES `moderators` WRITE;
/*!40000 ALTER TABLE `moderators` DISABLE KEYS */;
/*!40000 ALTER TABLE `moderators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `postHash` varchar(10) NOT NULL,
  `poster` varchar(25) NOT NULL,
  `community` varchar(25) NOT NULL,
  `caption` text NOT NULL,
  `postTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `nsfw` bit(1) NOT NULL DEFAULT b'0',
  `locked` bit(1) NOT NULL,
  `contents` text NOT NULL,
  PRIMARY KEY (`postID`),
  UNIQUE KEY `post_UN` (`postHash`),
  KEY `post_FK` (`poster`),
  KEY `post_FK_1` (`community`),
  CONSTRAINT `post_FK` FOREIGN KEY (`poster`) REFERENCES `user` (`username`),
  CONSTRAINT `post_FK_1` FOREIGN KEY (`community`) REFERENCES `community` (`communityName`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COMMENT='this table stores the posts.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `passHash` text NOT NULL,
  `shadowed` bit(1) NOT NULL DEFAULT b'0',
  `banned` bit(1) NOT NULL DEFAULT b'0',
  `email` text DEFAULT NULL,
  `verified` bit(1) NOT NULL DEFAULT b'0',
  `creationTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`userID`),
  UNIQUE KEY `user_UN` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COMMENT='this table stores the users for an ONAC instance.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'onac'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-06 19:26:14
