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
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `artist_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) DEFAULT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(40) NOT NULL,
  PRIMARY KEY (`artist_id`),
  UNIQUE KEY `full_name` (`last_name`,`first_name`,`middle_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,'Omar','A','Alkendi');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`),
  KEY `login` (`email`,`pass`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `order_contents`
--

DROP TABLE IF EXISTS `order_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_contents` (
  `oc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `print_id` int(10) unsigned NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `price` decimal(6,2) unsigned NOT NULL,
  `ship_date` datetime DEFAULT NULL,
  PRIMARY KEY (`oc_id`),
  KEY `order_id` (`order_id`),
  KEY `print_id` (`print_id`),
  KEY `ship_date` (`ship_date`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_contents`
--

LOCK TABLES `order_contents` WRITE;
/*!40000 ALTER TABLE `order_contents` DISABLE KEYS */;
INSERT INTO `order_contents` VALUES (1,1,2,3,9.99,NULL),(2,5,8,3,12.99,NULL);
/*!40000 ALTER TABLE `order_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `total` decimal(10,2) unsigned NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `order_date` (`order_date`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,178.93,'2019-12-07 11:23:47'),(5,13,38.97,'2019-12-08 23:40:03'),(6,13,38.97,'2019-12-08 23:50:24'),(7,13,12.99,'2019-12-09 00:46:12'),(8,13,129.90,'2019-12-09 00:46:27'),(9,13,64.95,'2019-12-09 00:46:43');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prints`
--

DROP TABLE IF EXISTS `prints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prints` (
  `print_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `artist_id` int(10) unsigned NOT NULL,
  `print_name` varchar(60) NOT NULL,
  `price` decimal(6,2) unsigned NOT NULL,
  `size` varchar(60) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_name` varchar(60) NOT NULL,
  PRIMARY KEY (`print_id`),
  KEY `artist_id` (`artist_id`),
  KEY `print_name` (`print_name`),
  KEY `price` (`price`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prints`
--

LOCK TABLES `prints` WRITE;
/*!40000 ALTER TABLE `prints` DISABLE KEYS */;
INSERT INTO `prints` VALUES (1,1,'Myself',99.99,'2*2','O','20190701_202553.jpg'),(2,1,'lol',9.99,'2*2','lol','Capture.PNG'),(7,1,'xx',55.55,NULL,NULL,'coffee.jpg'),(6,1,'jhk',4.99,'5*5','CCCCC','coffee.jpg');
/*!40000 ALTER TABLE `prints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Larry','Ullman','email@example.com','e727d1464ae12436e899a726da5b2f11d8381b26','2019-12-06 18:19:08'),(2,'Zoe','Isabella','email2@example.com','6b793ca1c216835ba85c1fbd1399ce729e34b4e5','2019-12-06 18:19:08'),(3,'John','Lennon','john@beatles.com','2a50435b0f512f60988db719106a258fb7e338ff','2019-12-06 18:19:08'),(4,'Paul','McCartney','paul@beatles.com','6ae16792c502a5b47da180ce8456e5ae7d65e262','2019-12-06 18:19:08'),(5,'George','Harrison','george@beatles.com ','1af17e73721dbe0c40011b82ed4bb1a7dbe3ce29','2019-12-06 18:19:08'),(6,'Ringo','Starr','ringo@beatles.com','520f73691bcf89d508d923a2dbc8e6fa58efb522','2019-12-06 18:19:08'),(7,'David','Jones','davey@monkees.com','ec23244e40137ef72763267f17ed6c7ebb2b019f','2019-12-06 18:19:08'),(8,'Peter','Tork','peter@monkees.com','b8f6bc0c646f68ec6f27653f8473ae4ae81fd302','2019-12-06 18:19:08'),(9,'Micky','Dolenz','micky@monkees.com ','0599b6e3c9206ef135c83a921294ba6417dbc673','2019-12-06 18:19:08'),(10,'Mike','Nesmith','mike@monkees.com','804a1773e9985abeb1f2605e0cc22211cc58cb1b','2019-12-06 18:19:08'),(11,'David','Sedaris','david@authors.com','f54e748ae9624210402eeb2c15a9f506a110ef72','2019-12-06 18:19:08'),(12,'Nick','Hornby','nick@authors.com','815f12d7b9d7cd690d4781015c2a0a5b3ae207c0','2019-12-06 18:19:08'),(13,'Melissa','Bank','melissa@authors.com','15ac6793642add347cbf24b8884b97947f637091','2019-12-06 18:19:08'),(14,'Toni','Morrison','toni@authors.com','ce3a79105879624f762c01ecb8abee7b31e67df5','2019-12-06 18:19:08'),(15,'Jonathan','Franzen','jonathan@authors.com','c969581a0a7d6f790f4b520225f34fd90a09c86f','2019-12-06 18:19:08'),(16,'Don','DeLillo','don@authors.com','01a3ff9a11b328afd3e5affcba4cc9e539c4c455','2019-12-06 18:19:08'),(17,'Graham','Greene','graham@authors.com','7c16ec1fcbc8c3ec99790f25c310ef63febb1bb3','2019-12-06 18:19:08'),(18,'Michael','Chabon','michael@authors.com','bd58cc413f97c33930778416a6dbd2d67720dc41','2019-12-06 18:19:08'),(19,'Richard','Brautigan','richard@authors.com','b1f8414005c218fb53b661f17b4f671bccecea3d','2019-12-06 18:19:08'),(20,'Russell','Banks','russell@authors.com','6bc4056557e33f1e209870ab578ed362f8b3c1b8','2019-12-06 18:19:08'),(21,'Homer','Simpson','homer@simpson.com','54a0b2dcbc5a944907d29304405f0552344b3847','2019-12-06 18:19:08'),(22,'Marge','Simpson','marge@simpson.com','cea9be7b57e183dea0e4cf000489fe073908c0ca','2019-12-06 18:19:08'),(23,'Bart','Simpson','bart@simpson.com','73265774abd1028ed8ef06afc5fa0f9a7ccbb6aa','2019-12-06 18:19:08'),(24,'Lisa','Simpson','lisa@simpson.com','a09bb16971ec0759dfff75c088f004e205c9e27b','2019-12-06 18:19:08'),(25,'Maggie','Simpson','maggie@simpson.com','0e87350b393ceced1d4751b828d18102be123edb','2019-12-06 18:19:08'),(26,'Abe','Simpson','abe@simpson.com','6591827c8e3d4624e8fc1ee324f31fa389fdafb4','2019-12-06 18:19:08'),(27,'Omar','Alkendi','omar@gmail.com','e5645ce68edc3de5f3abd11aaf29f2a542ad3121','2019-12-06 18:21:08'),(41,'Omar','Alkendi','omar@gmail.com','b678914aaecc16432d0b1d557ea44c4e44080646','2019-12-07 14:12:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-08 17:25:51
