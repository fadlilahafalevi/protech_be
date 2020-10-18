-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: db_protech
-- ------------------------------------------------------
-- Server version 5.5.5-10.4.11-MariaDB

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
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `bank_name` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bank_code` (`bank_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_ref`
--

DROP TABLE IF EXISTS `bank_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `account_number` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `account_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `user_code` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_ref_bank_fk` (`bank_code`),
  KEY `bank_ref_user_fk` (`user_code`),
  CONSTRAINT `bank_ref_bank_fk` FOREIGN KEY (`bank_code`) REFERENCES `bank` (`bank_code`),
  CONSTRAINT `bank_ref_user_fk` FOREIGN KEY (`user_code`) REFERENCES `user` (`user_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_ref`
--

LOCK TABLES `bank_ref` WRITE;
/*!40000 ALTER TABLE `bank_ref` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `customer_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `techinician_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `service_detail_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `order_datetime` datetime NOT NULL,
  `img_proof_of_payment` int(11) NOT NULL,
  `additional_info` text COLLATE utf8_bin NOT NULL,
  `order_status_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `total_payment` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_code` (`order_code`),
  KEY `order_order_status_fk` (`order_status_code`),
  KEY `order_user_fk` (`customer_code`),
  KEY `order_user_fk_1` (`techinician_code`),
  CONSTRAINT `order_order_status_fk` FOREIGN KEY (`order_status_code`) REFERENCES `order_status` (`order_status_code`),
  CONSTRAINT `order_user_fk` FOREIGN KEY (`customer_code`) REFERENCES `user` (`user_code`),
  CONSTRAINT `order_user_fk_1` FOREIGN KEY (`techinician_code`) REFERENCES `user` (`user_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `order_status_name` varchar(10) COLLATE utf8_bin NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_status_code` (`order_status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_unique_code`
--

DROP TABLE IF EXISTS `payment_unique_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_unique_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `unique_number` varchar(5) COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_unique_code_order_fk` (`order_code`),
  CONSTRAINT `payment_unique_code_order_fk` FOREIGN KEY (`order_code`) REFERENCES `order` (`order_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_unique_code`
--

LOCK TABLES `payment_unique_code` WRITE;
/*!40000 ALTER TABLE `payment_unique_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_unique_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rate_order`
--

DROP TABLE IF EXISTS `rate_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rate_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `order_rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rate_order_order_fk` (`order_code`),
  CONSTRAINT `rate_order_order_fk` FOREIGN KEY (`order_code`) REFERENCES `order` (`order_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rate_order`
--

LOCK TABLES `rate_order` WRITE;
/*!40000 ALTER TABLE `rate_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `rate_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `service_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `service_desc` varchar(50) COLLATE utf8_bin NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_code` (`service_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'S001','Air','Servis terkait air',1);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_detail`
--

DROP TABLE IF EXISTS `service_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `service_detail_code` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `price` decimal(13,2) DEFAULT NULL,
  `img_icon` mediumblob DEFAULT NULL,
  `service_detail_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_code_detail` (`service_detail_code`),
  KEY `service_detail_service_fk` (`service_code`),
  CONSTRAINT `service_detail_service_fk` FOREIGN KEY (`service_code`) REFERENCES `service` (`service_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_detail`
--

LOCK TABLES `service_detail` WRITE;
/*!40000 ALTER TABLE `service_detail` DISABLE KEYS */;
INSERT INTO `service_detail` VALUES (1,'S001','SD001',50000.00,'','Perbaikan Pipa Biasa');
/*!40000 ALTER TABLE `service_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_ref`
--

DROP TABLE IF EXISTS `service_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `service_detail_code` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_ref_service_detail_fk` (`service_detail_code`),
  KEY `service_ref_user_fk` (`user_code`),
  CONSTRAINT `service_ref_service_detail_fk` FOREIGN KEY (`service_detail_code`) REFERENCES `service_detail` (`service_detail_code`),
  CONSTRAINT `service_ref_user_fk` FOREIGN KEY (`user_code`) REFERENCES `user` (`user_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_ref`
--

LOCK TABLES `service_ref` WRITE;
/*!40000 ALTER TABLE `service_ref` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `fullname` varchar(80) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_code` (`user_code`),
  KEY `user_user_role_fk` (`role_code`),
  CONSTRAINT `user_user_role_fk` FOREIGN KEY (`role_code`) REFERENCES `user_role` (`role_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'A001','superadmin','21232f297a57a5a743894a0e4a801fc3','su','super@admin.co.id','superadmin','082299229922','super admin',1),(2,'CST01','fadlilah','21232f297a57a5a743894a0e4a801fc3','cst','fadlilah@mail.com','Fadlilah Achmad','082299229922','tangerang',1),(3,'TCH01','teknisiBaru','21232f297a57a5a743894a0e4a801fc3','tch','teknisi@teknisi','Budi','0829292929','tangerang',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_identity_detail`
--

DROP TABLE IF EXISTS `user_identity_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_identity_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `no_ktp` varchar(50) COLLATE utf8_bin NOT NULL,
  `pass_photo` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_identity_detail`
--

LOCK TABLES `user_identity_detail` WRITE;
/*!40000 ALTER TABLE `user_identity_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_identity_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_code` varchar(5) COLLATE utf8_bin NOT NULL,
  `role_name` varchar(15) COLLATE utf8_bin NOT NULL,
  `active_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_code` (`role_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'su','superadmin',1),(2,'adm','admin',1),(3,'cst','customer',1),(4,'tch','technician',1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_protech'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-18 17:23:25
