CREATE DATABASE  IF NOT EXISTS `stage_rm` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `stage_rm`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 10.238.85.62    Database: stage_rm
-- ------------------------------------------------------
-- Server version	5.1.62-0ubuntu0.11.10.1

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
-- Table structure for table `stageReservation`
--

DROP TABLE IF EXISTS `stageReservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stageReservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_reserved` date NOT NULL,
  `date_reserved_from` date NOT NULL,
  `date_reserved_to` date NOT NULL,
  `stage_name` varchar(64) NOT NULL,
  `spec_id` varchar(64) NOT NULL,
  `spec_name` varchar(128) NOT NULL,
  `status` char(1) NOT NULL,
  `overwritten_date` date DEFAULT NULL,
  `overwriting_spec` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stageReservation`
--

LOCK TABLES `stageReservation` WRITE;
/*!40000 ALTER TABLE `stageReservation` DISABLE KEYS */;
INSERT INTO `stageReservation` VALUES (105,'2012-08-06','2012-09-22','2012-09-30','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(106,'2012-08-06','2012-10-10','2013-01-31','STAGE2VM4237','53908-05','US KB and Common KB','R',NULL,NULL),(104,'2012-08-06','2012-09-15','2012-09-16','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(99,'2012-08-06','2012-09-03','2012-09-07','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(97,'2012-08-02','2012-10-01','2012-10-31','STAGE2VM4244','51576','Russia KYC','R',NULL,NULL),(98,'2012-08-04','2012-09-01','2012-09-30','STAGE2VM4246','50738','Enhanced Sending Limits ','R',NULL,NULL),(94,'2012-08-02','2012-09-03','2012-10-31','STAGE2VM4243','51576','Russia KYC','R',NULL,NULL),(102,'2012-08-06','2012-09-01','2012-09-02','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(100,'2012-08-06','2012-09-10','2012-09-14','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(101,'2012-08-06','2012-09-17','2012-09-21','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(89,'2012-08-02','2012-09-01','2012-10-31','STAGE2VM4245','0','Remittance Transfer Rule','R',NULL,NULL),(88,'2012-08-02','2012-09-01','2012-09-30','STAGE2VM4244','0','Remittance Transfer Rule','O',NULL,NULL),(103,'2012-08-06','2012-09-08','2012-09-09','STAGE2VM4247','4112809','JP KYC Data Migration','R',NULL,NULL),(86,'2012-08-02','2012-09-01','2012-10-31','STAGE2VM4242','50738','Enhanced Sending Limits ','R',NULL,NULL),(85,'2012-08-02','2012-09-01','2012-10-31','STAGE2VM4240','53436','Canada KYC Project ','R',NULL,NULL),(84,'2012-08-02','2012-09-01','2012-10-31','STAGE2VM4239','53436','Canada KYC Project ','R',NULL,NULL),(83,'2012-08-02','2012-09-01','2012-10-31','STAGE2VM4241','51576_04','Russia Limits ','R',NULL,NULL),(82,'2012-08-02','2012-09-01','2012-10-31','STAGE2VM4238','53887','Davis - Track1 ','R',NULL,NULL),(81,'2012-08-02','2012-09-01','2012-10-09','STAGE2VM4237','51656_04','US IRS 4B ','R',NULL,NULL),(80,'2012-08-02','2012-09-01','2012-10-20','STAGE2VM4236','51656_04','US IRS 4B ','R',NULL,NULL),(111,'2012-08-07','2012-09-01','2012-09-30','STAGE2VM4244',' ','Remittance Transfer Rule','R',NULL,NULL),(112,'2012-08-07','2012-11-01','2012-11-30','STAGE2VM4238','53887 ','Davis - Track1 ','O',NULL,NULL),(113,'2012-08-07','2012-11-01','2012-11-30','STAGE2VM4245',' ','Remittance Transfer Rule','R',NULL,NULL),(114,'2012-08-07','2012-11-01','2012-11-30','STAGE2VM4238','53887 ','Davis - Track1 ','R',NULL,NULL),(115,'2012-08-07','2012-10-01','2012-11-30','STAGE2VM4246',' ','Remittance Transfer Rule','R',NULL,NULL);
/*!40000 ALTER TABLE `stageReservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spec`
--

DROP TABLE IF EXISTS `spec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spec` (
  `spec_id` varchar(64) NOT NULL,
  `spec_name` varchar(64) DEFAULT NULL,
  `spec_lead_email` varchar(64) DEFAULT NULL,
  `dtl_email` varchar(64) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spec`
--

LOCK TABLES `spec` WRITE;
/*!40000 ALTER TABLE `spec` DISABLE KEYS */;
INSERT INTO `spec` VALUES (' 51576','Russia KYC','DL-PP-Russia-Compliance-Dev@corp.ebay.com','DL-PP-Russia-Compliance-Dev@corp.ebay.com',11),('53436','Canada KYC Project ','vipjain@paypal.com','',10),('53887 ','Davis - Track1 ',' pravindranathan@paypal.com','',9),('51656_04','US IRS 4B ','Vikashkumar@paypal.com','',8),(' ','Remittance Transfer Rule','soaggarwal@paypal.com','',12),(' 51576_04','Russia Limits ','vipjain@paypal.com','',13),('50738','Enhanced Sending Limits ','soaggarwal@paypal.com','',14),('51656 ','USIRS','vikashkumar@paypal.com','DL-PP-USIRS-Compliance <DL-PP-USIRS-Compliance@corp.ebay.com',15),('4112809','JP KYC Data Migration','marvirosales@paypal.com','marvirosales@paypal.com',16),('53908-05','US KB and Common KB','msrikkanth@paypal.com','',17);
/*!40000 ALTER TABLE `spec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage`
--

DROP TABLE IF EXISTS `stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage` (
  `stage_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(64) NOT NULL,
  PRIMARY KEY (`stage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage`
--

LOCK TABLES `stage` WRITE;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
INSERT INTO `stage` VALUES (24,'STAGE2VM4236','www.stage2vm4236.qa.paypal.com'),(25,'STAGE2VM4237','www.stage2vm4237.qa.paypal.com'),(26,'STAGE2VM4238','www.stage2vm4238.qa.paypal.com'),(27,'STAGE2VM4239','www.stage2vm4239.qa.paypal.com'),(28,'STAGE2VM4240','www.stage2vm4240.qa.paypal.com'),(29,'STAGE2VM4241','www.stage2vm4241.qa.paypal.com'),(30,'STAGE2VM4242','www.stage2vm4242.qa.paypal.com'),(31,'STAGE2VM4243','www.stage2vm4243.qa.paypal.com'),(32,'STAGE2VM4244','www.stage2vm4244.qa.paypal.com'),(33,'STAGE2VM4245','www.stage2vm4245.qa.paypal.com'),(34,'STAGE2VM4246','www.stage2vm4246.qa.paypal.com'),(35,'STAGE2VM4247','www.stage2vm4247.qa.paypal.com');
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-08-14 17:00:17
