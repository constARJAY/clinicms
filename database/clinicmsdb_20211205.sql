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
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `announcement_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `care_equipments`
--

LOCK TABLES `care_equipments` WRITE;
/*!40000 ALTER TABLE `care_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `care_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_up_medicines`
--

DROP TABLE IF EXISTS `check_up_medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_up_medicines` (
  `check_up_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_up_medicines`
--

LOCK TABLES `check_up_medicines` WRITE;
/*!40000 ALTER TABLE `check_up_medicines` DISABLE KEYS */;
INSERT INTO `check_up_medicines` VALUES (1,1,1,50.00,0,'2021-12-05 05:39:20','2021-12-05 05:39:20'),(2,1,2,800.00,0,'2021-12-05 05:39:20','2021-12-05 05:39:20');
/*!40000 ALTER TABLE `check_up_medicines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_up_treatments`
--

DROP TABLE IF EXISTS `check_up_treatments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_up_treatments` (
  `check_up_treatment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `tooth_number` int(11) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_treatment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_up_treatments`
--

LOCK TABLES `check_up_treatments` WRITE;
/*!40000 ALTER TABLE `check_up_treatments` DISABLE KEYS */;
INSERT INTO `check_up_treatments` VALUES (1,1,8,'test',0,'2021-12-05 05:39:20','2021-12-05 05:39:20'),(2,1,12,'test',0,'2021-12-05 05:39:20','2021-12-05 05:39:20');
/*!40000 ALTER TABLE `check_up_treatments` ENABLE KEYS */;
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
  `service_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `temperature` varchar(45) DEFAULT NULL,
  `pulse_rate` varchar(45) DEFAULT NULL,
  `respiratory_rate` varchar(45) DEFAULT NULL,
  `blood_pressure` varchar(45) DEFAULT NULL,
  `random_blood_sugar` varchar(45) DEFAULT NULL,
  `others` text DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_ups`
--

LOCK TABLES `check_ups` WRITE;
/*!40000 ALTER TABLE `check_ups` DISABLE KEYS */;
INSERT INTO `check_ups` VALUES (1,1,2,1,'test','test','test','test','test','test','test',0,'2021-12-05 05:39:20','2021-12-05 05:39:20');
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
  `service_id` bigint(20) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `date_appointment` date DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`clinic_appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_appointments`
--

LOCK TABLES `clinic_appointments` WRITE;
/*!40000 ALTER TABLE `clinic_appointments` DISABLE KEYS */;
INSERT INTO `clinic_appointments` VALUES (1,1,2,'TEST','2021-12-15',1,0,'2021-12-05 05:35:10','2021-12-05 11:49:53'),(2,1,2,'test','2021-12-03',0,1,'2021-12-05 11:49:28','2021-12-05 11:49:36');
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
-- Table structure for table `dental_certificates`
--

DROP TABLE IF EXISTS `dental_certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dental_certificates` (
  `dental_certificate_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) DEFAULT NULL,
  `date_header` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sign_name` varchar(45) DEFAULT NULL,
  `sign_note` varchar(255) DEFAULT NULL,
  `comment_name` varchar(45) DEFAULT NULL,
  `comment_note` varchar(255) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`dental_certificate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dental_certificates`
--

LOCK TABLES `dental_certificates` WRITE;
/*!40000 ALTER TABLE `dental_certificates` DISABLE KEYS */;
INSERT INTO `dental_certificates` VALUES (1,1,'2021-12-07','test','sign3','test','comment3','test','2021-12-16',0,'2021-12-05 05:41:15','2021-12-05 05:41:15');
/*!40000 ALTER TABLE `dental_certificates` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `first_aid_kits`
--

LOCK TABLES `first_aid_kits` WRITE;
/*!40000 ALTER TABLE `first_aid_kits` DISABLE KEYS */;
INSERT INTO `first_aid_kits` VALUES (1,1,'test',400.00,0,'2021-12-05 06:03:19','2021-12-05 06:03:19');
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
-- Table structure for table `medicine_transactions`
--

DROP TABLE IF EXISTS `medicine_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicine_transactions` (
  `medicine_transaction_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `stocks` decimal(15,2) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `remaining` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`medicine_transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine_transactions`
--

LOCK TABLES `medicine_transactions` WRITE;
/*!40000 ALTER TABLE `medicine_transactions` DISABLE KEYS */;
INSERT INTO `medicine_transactions` VALUES (1,1,1,100.00,50.00,50.00,0,'2021-12-05 05:39:20','2021-12-05 05:39:20'),(2,1,2,850.00,800.00,50.00,0,'2021-12-05 05:39:20','2021-12-05 05:39:20');
/*!40000 ALTER TABLE `medicine_transactions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicines`
--

LOCK TABLES `medicines` WRITE;
/*!40000 ALTER TABLE `medicines` DISABLE KEYS */;
INSERT INTO `medicines` VALUES (1,'Bioflu','-',50.00,0,'2021-12-05 05:18:07','2021-12-05 05:39:20'),(2,'Biogesic','-',50.00,0,'2021-12-05 05:18:45','2021-12-05 05:39:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='1 - Faculty\n2 - Students\n3 - Others';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_type`
--

LOCK TABLES `patient_type` WRITE;
/*!40000 ALTER TABLE `patient_type` DISABLE KEYS */;
INSERT INTO `patient_type` VALUES (1,'Faculty',0,'2021-12-02 04:58:27','2021-12-02 04:58:27'),(2,'Student',0,'2021-12-02 04:58:27','2021-12-02 04:58:27'),(3,'Non-Teaching',0,'2021-12-02 05:10:24','2021-12-04 18:12:25'),(4,'External Stakeholders',0,'2021-12-04 18:12:25','2021-12-04 18:12:25'),(5,'Others',0,'2021-12-04 18:12:34','2021-12-04 18:12:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'16-242301',2,1,'johndoe@gmail.com','johndoe','John','Verdadero','Mapagmahal','',25,'Male','18','18',0,'2021-12-05 05:25:15','2021-12-05 05:25:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Nurse',0,'2021-12-04 11:13:57','2021-12-04 11:13:57'),(2,'Doctor',0,'2021-12-04 11:13:57','2021-12-04 11:13:57'),(3,'Dentist',0,'2021-12-04 11:13:57','2021-12-04 11:13:57'),(4,'Physician',0,'2021-12-04 11:13:57','2021-12-04 11:13:57');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `service_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='1 - Medical\n2 - Dental\n3 - Dispensing Medicine';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Medical','Sample Description',0,'2021-12-04 00:49:07','2021-12-04 00:49:07'),(2,'Dental','Sample Description',0,'2021-12-04 00:49:07','2021-12-04 00:49:07'),(3,'Dispensing Medicine','Sample Description',0,'2021-12-04 04:52:19','2021-12-04 04:52:19');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `survey_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `q1` int(11) DEFAULT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL,
  `q6` int(11) DEFAULT NULL,
  `q7` int(11) DEFAULT NULL,
  `q8` int(11) DEFAULT NULL,
  `q9` int(11) DEFAULT NULL,
  `q10` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,1,1,1,5,4,3,2,1,2,3,4,5,4,0,'2021-12-05 05:39:20','2021-12-05 05:57:46'),(2,2,1,1,1,1,2,1,2,1,1,1,1,4,0,'2021-08-05 05:39:20','2021-12-05 11:35:43');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_setup`
--

DROP TABLE IF EXISTS `system_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_setup` (
  `systemSetupID` int(11) NOT NULL AUTO_INCREMENT,
  `systemEmail` text NOT NULL,
  PRIMARY KEY (`systemSetupID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_setup`
--

LOCK TABLES `system_setup` WRITE;
/*!40000 ALTER TABLE `system_setup` DISABLE KEYS */;
INSERT INTO `system_setup` VALUES (1,'arjaydiangzon@gmail.com');
/*!40000 ALTER TABLE `system_setup` ENABLE KEYS */;
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
  `gender` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'US-000001',1,'Akosin','','Admin','','Female','20','admin@gmail.com','admin',0,'2021-12-02 06:18:25','2021-12-04 15:32:32'),(2,NULL,NULL,'TEST','','Admin','','Male','18','test@gmail.com','test',1,'2021-12-04 11:33:02','2021-12-04 11:34:21');
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

-- Dump completed on 2021-12-05 19:51:45
