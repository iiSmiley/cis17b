CREATE DATABASE  IF NOT EXISTS `survey_engine` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `survey_engine`;
-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: survey_engine
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

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
-- Table structure for table `entity_user`
--

DROP TABLE IF EXISTS `entity_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_level` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_user`
--

LOCK TABLES `entity_user` WRITE;
/*!40000 ALTER TABLE `entity_user` DISABLE KEYS */;
INSERT INTO `entity_user` VALUES (1,'Omar','Alkendi','omar@gmail.com','40BD001563085FC35165329EA1FF5C5ECBDBBEEF','2019-12-08 02:27:29',1),(8,'Skyler','Clark','C@k.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:45:06',1),(9,'Valued','Customer','v@c.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:46:18',1),(11,'Valued','Customer','v@m.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:50:45',2),(12,'Hassan','Alsafi','h@a.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 19:47:40',2),(13,'Zoo','man','z@a.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 19:48:35',2),(14,'Om','Al','mm@aa.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-09 13:46:08',2);
/*!40000 ALTER TABLE `entity_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enum_ans`
--

DROP TABLE IF EXISTS `enum_ans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enum_ans` (
  `ans_id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(100) DEFAULT NULL,
  `response` mediumint(7) DEFAULT NULL,
  PRIMARY KEY (`ans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enum_ans`
--

LOCK TABLES `enum_ans` WRITE;
/*!40000 ALTER TABLE `enum_ans` DISABLE KEYS */;
INSERT INTO `enum_ans` VALUES (1,'Pizza',4),(2,'Salad',NULL),(3,'Sushi',1),(4,'Shawarma',1),(5,'Taco',NULL),(6,'Black',1),(7,'Grey',4),(8,'White',NULL),(9,'NON',NULL),(10,'ALL',1),(11,'Cat',5),(12,'Dog',NULL),(13,'Horse',NULL),(14,'Lion',1),(15,'Snake',NULL);
/*!40000 ALTER TABLE `enum_ans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enum_qstn`
--

DROP TABLE IF EXISTS `enum_qstn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enum_qstn` (
  `qstn_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(100) DEFAULT NULL,
  `qstn` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`qstn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enum_qstn`
--

LOCK TABLES `enum_qstn` WRITE;
/*!40000 ALTER TABLE `enum_qstn` DISABLE KEYS */;
INSERT INTO `enum_qstn` VALUES (1,'NA','Food?'),(2,'NA','Color?'),(3,'NA','Animal?');
/*!40000 ALTER TABLE `enum_qstn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enum_survey`
--

DROP TABLE IF EXISTS `enum_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enum_survey` (
  `survey_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_title` varchar(50) DEFAULT NULL,
  `survey_desc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enum_survey`
--

LOCK TABLES `enum_survey` WRITE;
/*!40000 ALTER TABLE `enum_survey` DISABLE KEYS */;
INSERT INTO `enum_survey` VALUES (1,'Fav?','Bla Bla');
/*!40000 ALTER TABLE `enum_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` mediumint(7) DEFAULT NULL,
  `qstn_id` mediumint(7) DEFAULT NULL,
  `ans_id` mediumint(7) DEFAULT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (1,1,1,1),(2,1,1,2),(3,1,1,3),(4,1,1,4),(5,1,1,5),(6,1,2,6),(7,1,2,7),(8,1,2,8),(9,1,2,9),(10,1,2,10),(11,1,3,11),(12,1,3,12),(13,1,3,13),(14,1,3,14),(15,1,3,15);
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-09 15:03:33
