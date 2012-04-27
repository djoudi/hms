-- MySQL dump 10.13  Distrib 5.5.20, for Win64 (x86)
--
-- Host: localhost    Database: hms
-- ------------------------------------------------------
-- Server version	5.5.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest` (
  `Id` varchar(45) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest`
--

LOCK TABLES `guest` WRITE;
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metadata`
--

DROP TABLE IF EXISTS `metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metadata` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Room_Id` int(11) NOT NULL,
  `Key` varchar(45) DEFAULT NULL,
  `Value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_MetaData_Room1` (`Room_Id`),
  CONSTRAINT `fk_MetaData_Room1` FOREIGN KEY (`Room_Id`) REFERENCES `room` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metadata`
--

LOCK TABLES `metadata` WRITE;
/*!40000 ALTER TABLE `metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Type_Id` int(11) NOT NULL,
  `Tags` varchar(100) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `IsArchieved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_Room_Type1` (`Type_Id`),
  CONSTRAINT `fk_Room_Type1` FOREIGN KEY (`Type_Id`) REFERENCES `roomtype` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (3,'A001',1,'A, B, C',NULL,0);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_with_guest`
--

DROP TABLE IF EXISTS `room_with_guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_with_guest` (
  `Room_Id` int(11) NOT NULL,
  `Guest_Id` varchar(45) NOT NULL,
  `CheckInDate` datetime NOT NULL,
  `CheckOutDate` datetime DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Room_Id`,`Guest_Id`,`CheckInDate`),
  KEY `fk_Room_has_Guest_Guest1` (`Guest_Id`),
  KEY `fk_Room_has_Guest_Room1` (`Room_Id`),
  CONSTRAINT `fk_Room_has_Guest_Room1` FOREIGN KEY (`Room_Id`) REFERENCES `room` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Room_has_Guest_Guest1` FOREIGN KEY (`Guest_Id`) REFERENCES `guest` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_with_guest`
--

LOCK TABLES `room_with_guest` WRITE;
/*!40000 ALTER TABLE `room_with_guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `room_with_guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roompriceschedule`
--

DROP TABLE IF EXISTS `roompriceschedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roompriceschedule` (
  `Room_Id` int(11) NOT NULL,
  `Date` varchar(45) NOT NULL,
  `Price` float DEFAULT NULL,
  `IsArchieved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Room_Id`,`Date`),
  KEY `fk_PriceSchedule_Room1` (`Room_Id`),
  CONSTRAINT `fk_PriceSchedule_Room1` FOREIGN KEY (`Room_Id`) REFERENCES `room` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roompriceschedule`
--

LOCK TABLES `roompriceschedule` WRITE;
/*!40000 ALTER TABLE `roompriceschedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `roompriceschedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roomtype`
--

DROP TABLE IF EXISTS `roomtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roomtype` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Desc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roomtype`
--

LOCK TABLES `roomtype` WRITE;
/*!40000 ALTER TABLE `roomtype` DISABLE KEYS */;
INSERT INTO `roomtype` VALUES (1,'一楼有窗',''),(2,'一楼无窗',''),(3,'二楼有窗',''),(4,'二楼无窗','');
/*!40000 ALTER TABLE `roomtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (2,'A',1),(3,'B',1),(4,'C',1);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typepriceschedule`
--

DROP TABLE IF EXISTS `typepriceschedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typepriceschedule` (
  `Type_Id` int(11) NOT NULL,
  `Date` varchar(45) NOT NULL,
  `Price` varchar(45) DEFAULT NULL,
  `IsArchieved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Type_Id`,`Date`),
  KEY `fk_TypePriceSchedule_Type1` (`Type_Id`),
  CONSTRAINT `fk_TypePriceSchedule_Type1` FOREIGN KEY (`Type_Id`) REFERENCES `roomtype` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typepriceschedule`
--

LOCK TABLES `typepriceschedule` WRITE;
/*!40000 ALTER TABLE `typepriceschedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `typepriceschedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-04-16  1:17:08
