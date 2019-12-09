CREATE DATABASE  IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test`;
-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: test
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
-- Table structure for table `entity_dept`
--

DROP TABLE IF EXISTS `entity_dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_dept` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_dept`
--

LOCK TABLES `entity_dept` WRITE;
/*!40000 ALTER TABLE `entity_dept` DISABLE KEYS */;
INSERT INTO `entity_dept` VALUES (1,'Whole Bean'),(2,'Ground Bean'),(3,'coffee Machines'),(4,'Miscellaneous'),(8,'Mugs');
/*!40000 ALTER TABLE `entity_dept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_order`
--

DROP TABLE IF EXISTS `entity_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` mediumint(7) DEFAULT NULL,
  `total` float(12,2) DEFAULT NULL,
  `order_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_order`
--

LOCK TABLES `entity_order` WRITE;
/*!40000 ALTER TABLE `entity_order` DISABLE KEYS */;
INSERT INTO `entity_order` VALUES (3,13,12.99,'2019-12-08 16:50:33'),(4,13,129.90,'2019-12-08 16:50:49');
/*!40000 ALTER TABLE `entity_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_order_contents`
--

DROP TABLE IF EXISTS `entity_order_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_order_contents` (
  `oc_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(7) DEFAULT NULL,
  `prod_id` mediumint(7) DEFAULT NULL,
  `quantity` mediumint(7) DEFAULT NULL,
  `price` mediumint(7) DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  PRIMARY KEY (`oc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_order_contents`
--

LOCK TABLES `entity_order_contents` WRITE;
/*!40000 ALTER TABLE `entity_order_contents` DISABLE KEYS */;
INSERT INTO `entity_order_contents` VALUES (1,7,8,1,13,NULL),(2,8,8,10,13,NULL),(3,9,8,5,13,NULL),(4,1,8,1,13,NULL),(5,2,8,10,13,NULL),(6,3,8,1,13,NULL),(7,4,8,10,13,'2019-12-08 17:08:58');
/*!40000 ALTER TABLE `entity_order_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_prod`
--

DROP TABLE IF EXISTS `entity_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_prod` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` mediumint(7) DEFAULT NULL,
  `prod_name` varchar(50) DEFAULT NULL,
  `price` float(12,2) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `img_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_prod`
--

LOCK TABLES `entity_prod` WRITE;
/*!40000 ALTER TABLE `entity_prod` DISABLE KEYS */;
INSERT INTO `entity_prod` VALUES (8,1,'Coffee',12.99,'Yummy in the tummy.','coffee.jpg');
/*!40000 ALTER TABLE `entity_prod` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_user`
--

LOCK TABLES `entity_user` WRITE;
/*!40000 ALTER TABLE `entity_user` DISABLE KEYS */;
INSERT INTO `entity_user` VALUES (0,'Omar','Alkendi','omar@gmail.com','40BD001563085FC35165329EA1FF5C5ECBDBBEEF','2019-12-08 02:27:29',1),(8,'Skyler','Clark','C@k.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:45:06',1),(9,'Valued','Customer','v@c.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:46:18',1),(11,'Valued','Customer','v@m.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:50:45',2),(12,'Hassan','Alsafi','h@a.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 19:47:40',2),(13,'Zoo','man','z@a.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 19:48:35',2);
/*!40000 ALTER TABLE `entity_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enum_user_level`
--

DROP TABLE IF EXISTS `enum_user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enum_user_level` (
  `enum_id` int(10) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`enum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enum_user_level`
--

LOCK TABLES `enum_user_level` WRITE;
/*!40000 ALTER TABLE `enum_user_level` DISABLE KEYS */;
INSERT INTO `enum_user_level` VALUES (1,'Admin'),(2,'Customer');
/*!40000 ALTER TABLE `enum_user_level` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-09 15:02:32
CREATE DATABASE  IF NOT EXISTS `coffee_sack` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `coffee_sack`;
-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: coffee_sack
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
-- Table structure for table `entity_dept`
--

DROP TABLE IF EXISTS `entity_dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_dept` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_dept`
--

LOCK TABLES `entity_dept` WRITE;
/*!40000 ALTER TABLE `entity_dept` DISABLE KEYS */;
INSERT INTO `entity_dept` VALUES (1,'Whole Bean'),(2,'Ground Bean'),(3,'coffee Machines'),(4,'Miscellaneous'),(8,'Mugs');
/*!40000 ALTER TABLE `entity_dept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_order`
--

DROP TABLE IF EXISTS `entity_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` mediumint(7) DEFAULT NULL,
  `total` float(12,2) DEFAULT NULL,
  `order_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_order`
--

LOCK TABLES `entity_order` WRITE;
/*!40000 ALTER TABLE `entity_order` DISABLE KEYS */;
INSERT INTO `entity_order` VALUES (3,13,12.99,'2019-12-08 16:50:33'),(4,13,129.90,'2019-12-08 16:50:49');
/*!40000 ALTER TABLE `entity_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_order_contents`
--

DROP TABLE IF EXISTS `entity_order_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_order_contents` (
  `oc_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(7) DEFAULT NULL,
  `prod_id` mediumint(7) DEFAULT NULL,
  `quantity` mediumint(7) DEFAULT NULL,
  `price` mediumint(7) DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  PRIMARY KEY (`oc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_order_contents`
--

LOCK TABLES `entity_order_contents` WRITE;
/*!40000 ALTER TABLE `entity_order_contents` DISABLE KEYS */;
INSERT INTO `entity_order_contents` VALUES (1,7,8,1,13,NULL),(2,8,8,10,13,NULL),(3,9,8,5,13,NULL),(4,1,8,1,13,NULL),(5,2,8,10,13,NULL),(6,3,8,1,13,NULL),(7,4,8,10,13,'2019-12-08 17:08:58');
/*!40000 ALTER TABLE `entity_order_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_prod`
--

DROP TABLE IF EXISTS `entity_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_prod` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` mediumint(7) DEFAULT NULL,
  `prod_name` varchar(50) DEFAULT NULL,
  `price` float(12,2) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `img_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_prod`
--

LOCK TABLES `entity_prod` WRITE;
/*!40000 ALTER TABLE `entity_prod` DISABLE KEYS */;
INSERT INTO `entity_prod` VALUES (8,1,'Coffee',12.99,'Yummy in the tummy.','coffee.jpg');
/*!40000 ALTER TABLE `entity_prod` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_user`
--

LOCK TABLES `entity_user` WRITE;
/*!40000 ALTER TABLE `entity_user` DISABLE KEYS */;
INSERT INTO `entity_user` VALUES (0,'Omar','Alkendi','omar@gmail.com','40BD001563085FC35165329EA1FF5C5ECBDBBEEF','2019-12-08 02:27:29',1),(8,'Skyler','Clark','C@k.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:45:06',1),(9,'Valued','Customer','v@c.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:46:18',1),(11,'Valued','Customer','v@m.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 02:50:45',2),(12,'Hassan','Alsafi','h@a.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 19:47:40',2),(13,'Zoo','man','z@a.com','c4be67d34dc855233e08a042d1cca0a450a804c4','2019-12-08 19:48:35',2);
/*!40000 ALTER TABLE `entity_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enum_user_level`
--

DROP TABLE IF EXISTS `enum_user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enum_user_level` (
  `enum_id` int(10) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`enum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enum_user_level`
--

LOCK TABLES `enum_user_level` WRITE;
/*!40000 ALTER TABLE `enum_user_level` DISABLE KEYS */;
INSERT INTO `enum_user_level` VALUES (1,'Admin'),(2,'Customer');
/*!40000 ALTER TABLE `enum_user_level` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-09 15:02:32
