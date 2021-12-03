CREATE DATABASE  IF NOT EXISTS `clinicmsdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `clinicmsdb`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: clinicmsdb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.14-MariaDB

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
-- Table structure for table `care_equipments`
--

DROP TABLE IF EXISTS `care_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_equipments` (
  `care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `measurement_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`care_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `care_equipments`
--

LOCK TABLES `care_equipments` WRITE;
/*!40000 ALTER TABLE `care_equipments` DISABLE KEYS */;
INSERT INTO `care_equipments` VALUES (1,1,'Test',400.00,'TEST',0,'2021-12-03 05:59:14','2021-12-03 06:07:00'),(2,2,'test 2',99.00,'test 2',0,'2021-12-03 05:59:15','2021-12-03 05:59:15'),(3,1,'test 1',850.00,'test 3',0,'2021-12-03 05:59:15','2021-12-03 05:59:15'),(4,1,'TEST',12.00,'test',0,'2021-12-03 06:06:38','2021-12-03 06:06:38'),(5,1,'TEST',40.00,'test',1,'2021-12-03 06:07:29','2021-12-03 06:07:53');
/*!40000 ALTER TABLE `care_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_ups`
--

DROP TABLE IF EXISTS `check_ups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_ups` (
  `check_up_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clinic_appointment_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `temperature` varchar(45) DEFAULT NULL,
  `pulse_rate` varchar(45) DEFAULT NULL,
  `respiratory_rate` varchar(45) DEFAULT NULL,
  `blood_pressure` varchar(45) DEFAULT NULL,
  `random_blood_sugar` varchar(45) DEFAULT NULL,
  `medicine_given` text DEFAULT NULL,
  `others` text DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  PRIMARY KEY (`check_up_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_ups`
--

LOCK TABLES `check_ups` WRITE;
/*!40000 ALTER TABLE `check_ups` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_ups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic_appointments`
--

DROP TABLE IF EXISTS `clinic_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic_appointments` (
  `clinic_appointment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `is_confirmed` int(11) DEFAULT 0,
  `date_appoint` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`clinic_appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_appointments`
--

LOCK TABLES `clinic_appointments` WRITE;
/*!40000 ALTER TABLE `clinic_appointments` DISABLE KEYS */;
INSERT INTO `clinic_appointments` VALUES (1,1,'TEST',0,NULL,0,'2021-12-03 07:49:45','2021-12-03 07:53:04');
/*!40000 ALTER TABLE `clinic_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'BSIT','Bachelor of Science Major in Information Technology',0,'2021-12-03 00:13:03','2021-12-03 00:13:03'),(2,'BSCpE','Bachelor of Science Major in Computer Engineering',0,'2021-12-03 00:13:03','2021-12-03 00:13:03'),(3,'BSECE','Bachelor of Science Major in Electronics',0,'2021-12-03 00:13:03','2021-12-03 00:13:03');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `first_aid_kits`
--

DROP TABLE IF EXISTS `first_aid_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `first_aid_kits` (
  `first_aid_kit_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `measurement_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`first_aid_kit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `first_aid_kits`
--

LOCK TABLES `first_aid_kits` WRITE;
/*!40000 ALTER TABLE `first_aid_kits` DISABLE KEYS */;
INSERT INTO `first_aid_kits` VALUES (1,1,'Test',59.00,0,'2021-12-03 05:29:48','2021-12-03 05:29:48'),(2,2,'Test 2',60.00,0,'2021-12-03 05:29:48','2021-12-03 05:29:48'),(3,1,'Test 3 ',39.00,0,'2021-12-03 05:29:48','2021-12-03 05:29:48'),(4,1,'TEST',12.00,0,'2021-12-03 05:46:51','2021-12-03 05:46:51'),(5,1,'ETO NA',400.00,1,'2021-12-03 05:51:41','2021-12-03 05:51:54');
/*!40000 ALTER TABLE `first_aid_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurements`
--

DROP TABLE IF EXISTS `measurements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measurements` (
  `measurement_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`measurement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurements`
--

LOCK TABLES `measurements` WRITE;
/*!40000 ALTER TABLE `measurements` DISABLE KEYS */;
INSERT INTO `measurements` VALUES (1,'Kg','Kilogram',0,'2021-12-03 05:28:29','2021-12-03 05:28:29'),(2,'Mg','Miligram',0,'2021-12-03 05:28:29','2021-12-03 05:28:29');
/*!40000 ALTER TABLE `measurements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicines` (
  `medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicines`
--

LOCK TABLES `medicines` WRITE;
/*!40000 ALTER TABLE `medicines` DISABLE KEYS */;
INSERT INTO `medicines` VALUES (1,'test','test',80.00,0,'2021-12-03 04:47:40','2021-12-03 04:56:28'),(2,'test 2','test 2',99.00,0,'2021-12-03 04:47:40','2021-12-03 04:47:40'),(3,'TEST','TEST',12.00,1,'2021-12-03 04:56:05','2021-12-03 04:56:11'),(4,'Isa pa','brand',5.00,0,'2021-12-03 05:38:30','2021-12-03 05:38:30');
/*!40000 ALTER TABLE `medicines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_type`
--

DROP TABLE IF EXISTS `patient_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_type` (
  `patient_type_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`patient_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_type`
--

LOCK TABLES `patient_type` WRITE;
/*!40000 ALTER TABLE `patient_type` DISABLE KEYS */;
INSERT INTO `patient_type` VALUES (1,'Faculty',0,'2021-12-02 04:58:27','2021-12-02 04:58:27'),(2,'Student',0,'2021-12-02 04:58:27','2021-12-02 04:58:27'),(3,'Others',0,'2021-12-02 05:10:24','2021-12-02 05:10:24');
/*!40000 ALTER TABLE `patient_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `patient_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_code` varchar(45) DEFAULT NULL,
  `patient_type_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'PC-000001',1,1,'arjaydiangzon@gmail.com','arjaydiangzon','arjay','pinca','diangzon','jr.',18,'male','1998',NULL,0,'2021-12-02 12:12:53','2021-12-02 12:12:53'),(2,'',0,0,'','','','','','',0,'','0','0',1,'2021-12-03 02:30:19','2021-12-03 03:40:50'),(3,'123',2,2,'Test','test','Arjay','Pinca','Diangzon','',21,'Male','III','2',0,'2021-12-03 02:52:22','2021-12-03 02:52:22'),(4,'123',2,2,'sxdsa','dsad','sadas','dsa','dsa','I',12,'Female','II','2',1,'2021-12-03 03:13:53','2021-12-03 03:47:13'),(5,'test',1,0,'test@gmail.com','test','test','test','test','I',12,'Others','','',0,'2021-12-03 04:08:37','2021-12-03 04:08:37'),(6,'1321',1,0,'e','te','te','','te','',12,'Male','','',0,'2021-12-03 04:28:22','2021-12-03 04:28:22'),(7,'321ds',2,2,'dsa','das','dsada','dsadas','dasda','Sr.',21,'Female','II','3',0,'2021-12-03 04:28:51','2021-12-03 04:28:51'),(8,'asd',2,2,'asd','asd','sad','adas','asd','I',1,'Female','II','2',0,'2021-12-03 04:34:08','2021-12-03 04:34:08'),(9,'31',1,0,'das','asd','321','dsa','das','III',12,'Male','','',0,'2021-12-03 04:35:07','2021-12-03 04:35:07');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(45) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'US-000001',1,'admin','admin','admin','jr.','admin@gmail.com','admin',0,'2021-12-02 06:18:25','2021-12-02 06:58:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'clinicmsdb'
--

--
-- Dumping routines for database 'clinicmsdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-03 16:04:12
