-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: biometric
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','$2y$10$uxD8r08jmLVqYQ34GSD2HO.W/2XTesaG7AG8v8NagRaL6fnDRdk.q');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `attendance_list`
--

DROP TABLE IF EXISTS `attendance_list`;
/*!50001 DROP VIEW IF EXISTS `attendance_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `attendance_list` AS SELECT
 1 AS `fullName`,
  1 AS `lrn`,
  1 AS `attendance_id`,
  1 AS `enrolled_id`,
  1 AS `fingerscan`,
  1 AS `clockType`,
  1 AS `date_created` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `attendance_record`
--

DROP TABLE IF EXISTS `attendance_record`;
/*!50001 DROP VIEW IF EXISTS `attendance_record`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `attendance_record` AS SELECT
 1 AS `fullName`,
  1 AS `lrn`,
  1 AS `attendance_id`,
  1 AS `enrolled_id`,
  1 AS `fingerscan`,
  1 AS `date_created` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `attendance_record_list`
--

DROP TABLE IF EXISTS `attendance_record_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_record_list` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_id` int(11) NOT NULL,
  `rec_type` int(11) NOT NULL COMMENT '1 clock in 2 clockout',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rec_id`),
  KEY `fk_attendanceid` (`attendance_id`),
  CONSTRAINT `fk_attendanceid` FOREIGN KEY (`attendance_id`) REFERENCES `fingerprint_enroll` (`attendance_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_record_list`
--

LOCK TABLES `attendance_record_list` WRITE;
/*!40000 ALTER TABLE `attendance_record_list` DISABLE KEYS */;
INSERT INTO `attendance_record_list` VALUES (7,20,1,'2023-12-26 10:46:26'),(8,20,2,'2023-12-26 10:47:12'),(17,20,1,'2023-12-27 03:29:33'),(18,20,2,'2023-12-27 03:31:16'),(19,21,1,'2023-12-27 03:35:25');
/*!40000 ALTER TABLE `attendance_record_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `classdetails`
--

DROP TABLE IF EXISTS `classdetails`;
/*!50001 DROP VIEW IF EXISTS `classdetails`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `classdetails` AS SELECT
 1 AS `class_id`,
  1 AS `class_name`,
  1 AS `section_id`,
  1 AS `subject_id`,
  1 AS `teacher_id`,
  1 AS `class_limit`,
  1 AS `room_number`,
  1 AS `scheduled_time`,
  1 AS `timeofDay`,
  1 AS `year_level`,
  1 AS `date_created`,
  1 AS `sectionName`,
  1 AS `sectionId`,
  1 AS `subjectId`,
  1 AS `subjectName`,
  1 AS `yearId`,
  1 AS `yearName`,
  1 AS `teacherId`,
  1 AS `teacherName` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `classes_record`
--

DROP TABLE IF EXISTS `classes_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes_record` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `scheduled_time` varchar(50) NOT NULL,
  `timeofDay` varchar(50) NOT NULL,
  `year_level` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`class_id`),
  KEY `fk_section_id` (`section_id`),
  KEY `fk_subject_id` (`subject_id`),
  KEY `fk_year_level` (`year_level`),
  KEY `fk_teacher_id` (`teacher_id`),
  CONSTRAINT `fk_section_id` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_year_level` FOREIGN KEY (`year_level`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes_record`
--

LOCK TABLES `classes_record` WRITE;
/*!40000 ALTER TABLE `classes_record` DISABLE KEYS */;
INSERT INTO `classes_record` VALUES (8,'ALPHA',1,1,23,1,'00:50 08:55','morning',10,'2023-11-13 16:50:33'),(19,'GAMA',3,1,23,4,'08:30 AM-10:30 AM','morning',10,'2023-11-13 18:22:49');
/*!40000 ALTER TABLE `classes_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergency_contact`
--

DROP TABLE IF EXISTS `emergency_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergency_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactName` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_emergency` (`student_id`),
  CONSTRAINT `fk_student_emergency` FOREIGN KEY (`student_id`) REFERENCES `student_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_contact`
--

LOCK TABLES `emergency_contact` WRITE;
/*!40000 ALTER TABLE `emergency_contact` DISABLE KEYS */;
INSERT INTO `emergency_contact` VALUES (42,'DOMINGA REQUESTAS','sister','09534534534',5),(43,'JUNIOR MILAN','sister','09453454353',6),(44,'TEST','sister','09564564564',7),(45,'MANDO MILAN','parents','09342342334',8),(46,'MANNY MANUEL','parents','09453453453',9),(47,'TEST','parents','09345345345',10),(48,'DELA CRUZ MAURO','parents','09435345345',12);
/*!40000 ALTER TABLE `emergency_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment_record`
--

DROP TABLE IF EXISTS `enrollment_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollment_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gwa` varchar(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `submit_report` int(11) DEFAULT NULL,
  `receipt_id` int(11) DEFAULT NULL,
  `date_enrolled` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `section_id` (`section_id`),
  KEY `year_level` (`year_level`),
  KEY `submit_report` (`submit_report`),
  KEY `fk_receipt_id` (`receipt_id`),
  CONSTRAINT `enrollment_record_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrollment_record_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrollment_record_ibfk_3` FOREIGN KEY (`year_level`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrollment_record_ibfk_4` FOREIGN KEY (`submit_report`) REFERENCES `student_submitted` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_receipt_id` FOREIGN KEY (`receipt_id`) REFERENCES `receipt_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment_record`
--

LOCK TABLES `enrollment_record` WRITE;
/*!40000 ALTER TABLE `enrollment_record` DISABLE KEYS */;
INSERT INTO `enrollment_record` VALUES (38,'90',5,1,10,74,11,'2023-11-06 17:34:00'),(39,'89',6,3,10,75,12,'2024-11-06 17:42:26'),(44,'90',12,7,14,80,17,'2023-11-14 16:09:42');
/*!40000 ALTER TABLE `enrollment_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `enrollment_records`
--

DROP TABLE IF EXISTS `enrollment_records`;
/*!50001 DROP VIEW IF EXISTS `enrollment_records`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `enrollment_records` AS SELECT
 1 AS `enrollment_id`,
  1 AS `student_id`,
  1 AS `lrn`,
  1 AS `fullName`,
  1 AS `lastName`,
  1 AS `middleName`,
  1 AS `firstName`,
  1 AS `nationality`,
  1 AS `profile`,
  1 AS `gender`,
  1 AS `age`,
  1 AS `birthdate`,
  1 AS `pbirth`,
  1 AS `studentNumber`,
  1 AS `currentAddress`,
  1 AS `gwa`,
  1 AS `fingerprint_upload`,
  1 AS `sectionId`,
  1 AS `sectionName`,
  1 AS `yearLevelId`,
  1 AS `yearType`,
  1 AS `yearLevel`,
  1 AS `contactName`,
  1 AS `relationship`,
  1 AS `phone`,
  1 AS `fatherName`,
  1 AS `fatherOccupation`,
  1 AS `fatherNumber`,
  1 AS `motherName`,
  1 AS `motherOccupation`,
  1 AS `motherNumber`,
  1 AS `guardianName`,
  1 AS `guardianNumber`,
  1 AS `guardianAddress`,
  1 AS `report_card`,
  1 AS `formSf10`,
  1 AS `birthCertificate`,
  1 AS `good_moral`,
  1 AS `medical_cert`,
  1 AS `rec_letter`,
  1 AS `study_permit`,
  1 AS `alien_regcard`,
  1 AS `passport_copy`,
  1 AS `auth_school_record`,
  1 AS `type`,
  1 AS `date_enrolled`,
  1 AS `yearEnrolled`,
  1 AS `submit_id`,
  1 AS `receipt_id`,
  1 AS `typeFee`,
  1 AS `miscellanious`,
  1 AS `bookModules`,
  1 AS `tuitionFee`,
  1 AS `totalFee`,
  1 AS `fullCashPayment` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `fingerprint_enroll`
--

DROP TABLE IF EXISTS `fingerprint_enroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fingerprint_enroll` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `enrolled_id` int(11) NOT NULL,
  `fingerscan` varchar(4000) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`attendance_id`),
  KEY `fk_enrolled_id` (`enrolled_id`),
  CONSTRAINT `fk_enrolled_id` FOREIGN KEY (`enrolled_id`) REFERENCES `enrollment_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fingerprint_enroll`
--

LOCK TABLES `fingerprint_enroll` WRITE;
/*!40000 ALTER TABLE `fingerprint_enroll` DISABLE KEYS */;
INSERT INTO `fingerprint_enroll` VALUES (20,38,'APiTAcgq43NcwEE3CaRx8JkUVZLYq5WAM1tjdWGuLYolj5QgKeTrRMjYQeRsAMAK-d1Wxkab7Lf5bNy4trW_BSmCl7otOQF2yf6wejrpaxOKlQ56CONz9X-6tFM57JaBf9AWq6lYh5SGtTX-JaBYeZy4zggJ-lngYWdsnlMCLFRLr3JRj3aV1p_byQhBSVVWXKjZGoCD_OVqHe0LK2kVDFdwFrEIKxIBjB-AGP6SsWGA1w_oAGlDkcbGtphmdUY0JXJqMydXRq4nh5I_pQ0MzKBAFwLGbpolBsEq8dNPfrXWF6B__L59xAzRddaZRWnvdQZH8nHCqlNTbeFKUrFsZP4LuGCgRkt8ip74QQrGfOSLztlz9cmUWX6fpVYcNmEZVtgD_OE6YJ1einq1Cewc8UgJgtVC6eEil2_rGN-iJOKoKFmYu-dWpszd-qHDG7JGHB3C5PQQXVmA3ntKlqx8MglrnbRL_w_TOnNz6kivr_JXGi5gR4AK_1OazagvtWYgsMiZdRzF6TNkliMgEaj6dMrj6WXYiqNvAPiUAcgq43NcwEE3CaRx8JcUVZJeEl9M91U_ZViTXRyGPw84uWh_928m4-mfRmE_r9XAIvPq37LTiTXalQNr4PCXRl1rTczGnXEUDLzmMCjRJNuNMAyukwW_-bKKHLLfGQEkxuyFIGOH4nimDQY0jQOp_LHgus1nZO1ugOLMWesxWPm4KHMtSZh3nXKXSJewM08U89fYUcjZMaV2j14_LxN2GHmT12lcB0D5629jI1McQAvYw0qk7U8e0I6F_8xVBgo8Wkd6gUQMwGVyvjxA0Ipc1zfrt3RZy9u1Co8YOyWT_uonapXesp0Z7ApYT_bfK19YtR3h2HGcH9tb9tapwsLpoi3zhXMxoI-1iockxC3qofLgg8OD9yCfpYC9ncttNsTimEtVE2AZ54QNPk8-4ZE-rPF9zy11LLNydr5hzd9I6lbaxREPLrs7NR4Vf3BrqqHJyjuwy-3-iLhYOW64pfV35xukMOBAFcISbMWo5kvJBFYGIiRb0bFTnPXIbojb9T-YhXoYmLsbXJbAlAk_t8fCPU1jqfT9bwD4lAHIKuNzXMBBNwmkcfCXFFWSXhJfTPdVP2VYk10chj8POLlof_dvJuPpn0ZhP6_VwCLz6t-y04k12pUDa-Dwl0Zda03Mxp1xFAy85jAo0STbjTAMrpMFv_myihyy3xkBJMbshSBjh-J4pg0GNI0Dqfyx4LrNZ2TtboDizFnrMVj5uChzLUmYd51yl0iXsDNPFPPX2FHI2TGldo9ePy8Tdhh5k9dpXAdA-etvYyNTHEAL2MNKpO1PHtCOhf_MVQYKPFpHeoFEDMBlcr48QNCKXNc367d0WcvbtQqPGDslk_7qJ2qV3rKdGewKWE_23ytfWLUd4dhxnB_bW_bWqcLC6aIt84VzMaCPtYqHJMQt6qHy4IPDg_cgn6WAvZ3LbTbE4phLVRNgGeeEDT5PPuGRPqzxfc8tdSyzcna-Yc3fSOpW2sURDy67OzUeFX9wa6qhyco7sMvt_oi4WDluuKX1d-cbpDDgQBXCEmzFqOZLyQRWBiIkW9GxU5z1yG6I2_U_mIV6GJi7G1yWwJQJP7fHwj1NY6n0_W8A6JUByCrjc1zAQTcJpHFwgRRVku-fGjryKg_IfcnkLS-Xp6ZANZjSS2aYAMuHDbRJTWqpD7Kenkdac-VTDoBgr7kTmECMyujwVJLbmfxRg5bktTDLTD24u0sST_mIkGlJQS_7vncBKiPnTAnbUQoDZsnJSXyT0uJblTwdizvmAKo-TfDnIW42hri8lwnTTFO7_rf2JiECmRTu6haiY1-TlaNcLBqPGpweTCrb9pidm9O-vHaWhDcm-az6hgL4OAw__RqyImu7aFKyKlFydqrv2v4vCp45HM-DpIIyGJOmiaHFj8TMLl9Q1WPf--1obftSzNfMyoFi97KG6n0FeNkrNYeKL8NpiGAZziKdr3g05fs-nuwdkSDMNQGqeYsPp-I2YPcV_NuKbOAdRlrhaLvsEYU_qvN11abXK_8klQ4Mwpp_PxzLJdXxzBvSzPY7rDbNdiENBK1U6ewywO0QZLdsMflVQ-llsL1E64kjjSlujs0aGiyC2wHgqRzSoRW0h1HAjfqEr9eDqKzrpfXpBlZEPFjrVcHbYTuQbzp_AAA','2023-12-26 09:57:34'),(21,39,'APiRAcgq43NcwEE3CaRxMPEUVZLkDQEBJSAZolzsYleP6yYBoKqlp9SojPx3od7L1kv0Hdl7CIGm0s2sxiBayFPIC2fx6KiGniteNG38wNC4ipbSxTppPmVDY5WCgNQOmw2lyrW0iVVaRKJhUhx4H1ZHv3pQNOfkvELpZNzcDNTfjgZuom2lLtR-RscmeCNvAXgm4FNtsAdWzAXw_lVqo167jDwpz3QEJlV3_vvky0h0L91q_KBGhbDfFuZzSO5mxPAWAByO8poNRXURyifL_OzyngvwLQfiUACo0Xv6m9lz82h3zcUAuB5vtpFIWG6mmtLv-y1K6Yd4oeb9c75pVVJTFseXYnekhnBxfDGYz7iBDQZlpPtuhjq2_2-OMvo0AFn4b3Ghq_ZNiytyLu5tgfu7HtIOzoIpQNkPeg1HzBY_6rKiRE8wsfkw60obfPTVNHlXaaC4MIeGEs1bpWXnFWlbk4q6_AuyesoNkCvnNo8rzT3yx1MXhqjTnPlEDhkMDsXoSWXeUjHPDMxK4nabhD_QmRl1bwD4kgHIKuNzXMBBNwmkcbCNFFWSxNAI06H8KDW89faBuwwv8QkMg6ig0hrCHtiT3nnZRGvXSi6aliFLm6_n9h1fuETfgstomAhCp7Q5tEDRqZecNIBtDo3R3wim3NGE7yEyYkzwthvrGyw1Ml_KZSgYZ3gqQUj1BlgiSL-hEkhoBdCEO6H875kJ48p5OWwaT8ujdHcIP1-Zel7Kl5xiwKLrycdeKTuMeV0D87E0HMErxFg0Q5EcFJrzAjZaxO0DcFIJ_UDTQNgRNQ7cYjaqPngtiyL-0SCJPRAJUgzap9mr0xR8DQEYoluyhXLqtkKUka2PqykFijXE7TRZE4_db51HzUUMM6BFzB7NziFue7SB_EUzQguK00oyNox2qe4dFEM91Ru2fpVpBV3txPVb_l1GFqg_k9KAYrUR_Y5_aRhNbnHeD4KCx8TBJfv73Cp_15vV7qMCALPkrPpXZEegs4a4UvNYsZSgyFIP1sW6Khl3pXIJfOyGd-cte8D7h0JgNKg9dDQ2J4xY7VR40O5oiqp2Wx4fawBvAPiSAcgq43NcwEE3CaRxsI0UVZLE0AjTofwoNbz19oG7DC_xCQyDqKDSGsIe2JPeedlEa9dKLpqWIUubr-f2HV-4RN-Cy2iYCEKntDm0QNGpl5w0gG0OjdHfCKbc0YTvITJiTPC2G-sbLDUyX8plKBhneCpBSPUGWCJIv6ESSGgF0IQ7ofzvmQnjynk5bBpPy6N0dwg_X5l6XsqXnGLAouvJx14pO4x5XQPzsTQcwSvEWDRDkRwUmvMCNlrE7QNwUgn9QNNA2BE1DtxiNqo-eC2LIv7RIIk9EAlSDNqn2avTFHwNARiiW7KFcuq2QpSRrY-rKQWKNcTtNFkTj91vnUfNRQwzoEXMHs3OIW57tIH8RTNCC4rTSjI2jHap7h0UQz3VG7Z-lWkFXe3E9Vv-XUYWqD-T0oBitRH9jn9pGE1ucd4PgoLHxMEl-_vcKn_Xm9XuowIAs-Ss-ldkR6CzhrhS81ixlKDIUg_WxboqGXelcgl87IZ35y17wPuHQmA0qD10NDYnjFjtVHjQ7miKqnZbHh9rAG8A6JIByCrjc1zAQTcJpHEw_xRVkt-ucqP7L4xIxwcVuZ7Pr1l1xq9HSz75iwxXAdyQeM53qZzmxSxFfiinLa5uKglL-WQpdu_n__WGCFUrOWlfkLb-YosQKoVX7XHdZz4mWnvGCLVcIbG9ryk3JQZlkHAkUMXkXRgtNaGwXOIGmLwuCSvv2YjK5nSpAXtzXy1qTQ2ixf_eSJMnPG9XDVmHvr5zmtvmsIltvJWnnaKkOB2DlQlrlDsEHdVqeQuPUORtTGK9_6ZydqEITci0zn6EN8W85JAH2W9HlIiGY9XRkJ8W4JJNcUXbLYYXczjETLu_MQJUMO55MgmeHtAgZRoVZml70xU5uCOSREKhudB_qIHy4HYYaLNagdWTRFU1Xm01pe-QAmobpig4sM9332EoudyJXJDl6_ZY7eTIECYTcbZX-srbTzUu_PqG4UFVbbI3Tdq8XVApe5RwOxzKZ-7jB2Bm8db-xEBHvJQy_WDdZ1Ko1PSYT2-DKXTh4A4Z9L6JlvG48Pp7wCMGOMo99w3u5ntPFCnfb3DdfwAAcFABcN1_AAA','2023-12-27 03:35:01');
/*!40000 ALTER TABLE `fingerprint_enroll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_record`
--

DROP TABLE IF EXISTS `receipt_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeFee` varchar(50) NOT NULL,
  `miscellanious` varchar(50) NOT NULL,
  `bookModules` varchar(100) NOT NULL,
  `tuitionFee` varchar(50) NOT NULL,
  `totalFee` varchar(50) NOT NULL,
  `fullCashPayment` varchar(20) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `receipt_record_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_record`
--

LOCK TABLES `receipt_record` WRITE;
/*!40000 ALTER TABLE `receipt_record` DISABLE KEYS */;
INSERT INTO `receipt_record` VALUES (11,'(JR HIGH SCHOOL)','13,050.00','8,325.00','10,450.00','31,925.00','30,880.00',5,'2023-11-06 17:34:00'),(12,'(JR HIGH SCHOOL)','13,050.00','8,325.00','10,450.00','31,925.00','30,880.00',6,'2023-11-06 17:42:26'),(13,'(PRESCHOOL)','10,045.00','5,905.00','15,000.00','30,950.00','29,450.00',7,'2023-11-11 03:18:25'),(14,'(SENIOR HIGH SCHOOL)','7,670.00','0.00','17,500.00','25,170.00','25,170.00',8,'2023-11-14 15:22:00'),(15,'(INTERMIDIATE)','12,850.00','6,750.00','9,350.00','28,950.00','28,015.00',9,'2023-11-14 15:32:15'),(16,'(JR HIGH SCHOOL)','13,050.00','8,325.00','10,450.00','31,925.00','30,880.00',10,'2023-11-14 15:42:45'),(17,'(JR HIGH SCHOOL)','13,050.00','8,325.00','10,450.00','31,925.00','30,880.00',12,'2023-11-14 16:09:42');
/*!40000 ALTER TABLE `receipt_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_data`
--

DROP TABLE IF EXISTS `registration_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_name` varchar(255) NOT NULL,
  `registration_email` varchar(255) NOT NULL,
  `reg_dob` date NOT NULL,
  `reg_bplace` varchar(255) NOT NULL,
  `reg_gender` varchar(10) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `reg_glevel` varchar(20) NOT NULL,
  `guardian_name` varchar(255) NOT NULL,
  `guardian_email` varchar(255) NOT NULL,
  `guardian_phone` varchar(15) NOT NULL,
  `guardian_relationship` varchar(255) NOT NULL,
  `file_137` varchar(255) DEFAULT NULL,
  `file_birthcert` varchar(255) DEFAULT NULL,
  `file_goodmoral` varchar(255) DEFAULT NULL,
  `file_recommendationletter` varchar(255) DEFAULT NULL,
  `file_medcert` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ref_number` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_email` varchar(255) NOT NULL,
  `father_phone` varchar(255) NOT NULL,
  `father_address` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_email` varchar(255) NOT NULL,
  `mother_phone` varchar(255) NOT NULL,
  `mother_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_data`
--

LOCK TABLES `registration_data` WRITE;
/*!40000 ALTER TABLE `registration_data` DISABLE KEYS */;
INSERT INTO `registration_data` VALUES (15,'Hanz Eduard Maclan','yohanmaxwell22@gmail.com','2001-09-22','Manila','male','075 Sitio Tambubong, Longos','Grade 12','John Benedic','yohanmaxwell22@gmail.com','09686565019','friend','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-04 05:42:42','REG202312040642426634','','','','','','','',''),(16,'John Benedic Cristobal','ben@naol.tk','2002-06-17','Calumpit','male','381 PUROK 6 LONGOS','Grade 12','Hanz Eduard Maclan','ben@naol.tk','09955125307','Friend','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-05 15:12:13','REG202312051612138952','Benito Cristobal','ben@naol.tk','09955125307','381 PUROK 6 LONGOS','Cristina Cristobal','ben@naol.tk','09955125307','381 PUROK 6 LONGOS'),(17,'Lanz Steven Maclan','lanzsteven0616@gmail.com','2006-06-16','Manila','male','075 Sitio Tambubong, Longos','Grade 12','Hanz Eduard Maclan','yohanmaxwell22@gmail.com','09686565019','Uncle','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-05 15:45:14','REG202312051645147746','MAMERTO IGNACIO CRISTOBAL','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos','JINKY C. YOUKHANA','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos'),(18,'Lanz Steven Maclan','lanzsteven0616@gmail.com','2006-06-16','Manila','male','075 Sitio Tambubong, Longos','Grade 12','Hanz Eduard Maclan','yohanmaxwell22@gmail.com','09686565019','Uncle','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-05 15:46:40','REG202312051646409476','MAMERTO IGNACIO CRISTOBAL','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos','JINKY C. YOUKHANA','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos'),(19,'Lanz Steven Maclan','lanzsteven0616@gmail.com','2006-06-16','Manila','male','075 Sitio Tambubong, Longos','Grade 12','Hanz Eduard Maclan','yohanmaxwell22@gmail.com','09686565019','Uncle','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-05 15:48:40','REG202312051648402427','MAMERTO IGNACIO CRISTOBAL','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos','JINKY C. YOUKHANA','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos'),(20,'Hanz Cristobal','yohanmaxwell22@gmail.com','2001-09-22','Manila','male','Longos','Grade 12','John Benedic','ben@naol.tk','09955125307','Friend','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-05 15:49:32','REG202312051649326672','MAMERTO IGNACIO CRISTOBAL','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos','ELVIRA JUNIAR CRISTOBAL','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos'),(21,'Hanz Eduard Maclan','yohanmaxwell22@gmail.com','2001-09-22','Manila','male','075 Sitio Tambubong, Longos','Grade 12','John benedic','yohanmaxwell22@gmail.com','09686565019','Friend','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-05 15:54:23','REG202312051654237470','EDUARDO S. MACLAN JR.','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos','JINKY C. YOUKHANA','yohanmaxwell22@gmail.com','09686565019','075 Sitio Tambubong, Longos'),(22,'BENEDIC','mynameisbend@gmail.com','2002-06-17','longos','male','longso','Grade 12','John Benedic','yohanmaxwell22@gmail.com','09686565019','Uncle','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-06 04:49:47','REG202312060549476444','Benito Cristobal','ben@naol.tk','09955125307','381 PUROK 6 LONGOS','Cristina Cristobal','ben@naol.tk','09955125307','381 PUROK 6 LONGOS'),(23,'Angelica Marquez','marquezangelica1920@gmail.com','2000-01-01','malolos','female','075 Sitio Tambubong, Longos','Nursery','dksjsadsd','guardian@gmail.com','09918315771','grandmother','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','2023-12-07 06:00:05','REG202312070700046161','dasda','father@gmail.com','09918315771','eewqeqe`','jkhjhhj','mother@gmail.com','09918315771','dadas'),(24,'test','dev.me28@gmail.com','2023-12-24','090908','male','Freelancing','Grade 1','Test','test@gmail.com','09664543432','Test','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','2023-12-24 04:57:16','REG202312240557165217','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Test'),(25,'test','dev.me28@gmail.com','2023-12-24','090908','male','Freelancing','Grade 1','Test','test@gmail.com','09664543432','Test','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','2023-12-24 04:57:22','REG202312240557227759','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Test'),(26,'test','dev.me28@gmail.com','2023-12-24','090908','male','Freelancing','Grade 1','Test','test@gmail.com','09664543432','Test','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','2023-12-24 04:57:48','REG202312240557489194','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Test'),(27,'test','dev.me28@gmail.com','2023-12-24','090908','male','Freelancing','Grade 1','Test','test@gmail.com','09664543432','Test','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, your file is too large.','2023-12-24 04:58:11','REG202312240558113880','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Test'),(28,'test','dev.me28@gmail.com','2023-12-24','090908','male','Freelancing','Grade 5','Test','test@gmail.com','09664543432','Test','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','2023-12-24 05:01:09','REG202312240601094036','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Freelancing'),(29,'test','dev.me28@gmail.com','2023-12-05','090908','male','Freelancing','Grade 9','Test','test@gmail.com','09664543432','Test','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','2023-12-28 11:19:48','REG202312281219486636','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Freelancing'),(30,'test','dev.me28@gmail.com','2023-11-29','090908','female','Freelancing','Grade 8','Test','test@gmail.com','09664543432','Test','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, there was an error uploading your file.','Sorry, only JPG, JPEG, PNG, and PDF files are allowed.','Sorry, there was an error uploading your file.','Sorry, there was an error uploading your file.','2023-12-28 22:36:03','REG202312282336037520','test','test@gmail.com','09123456789','Freelancing','Test','test@gmail.com','09123456789','Freelancing');
/*!40000 ALTER TABLE `registration_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relative_record`
--

DROP TABLE IF EXISTS `relative_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relative_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatherName` varchar(50) NOT NULL,
  `fatherOccupation` varchar(50) NOT NULL,
  `fatherNumber` varchar(11) NOT NULL,
  `motherName` varchar(50) NOT NULL,
  `motherOccupation` varchar(50) NOT NULL,
  `motherNumber` varchar(11) NOT NULL,
  `guardianName` varchar(50) NOT NULL,
  `guardianNumber` varchar(11) NOT NULL,
  `guardianAddress` varchar(100) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_relative_id` (`student_id`),
  CONSTRAINT `fk_student_relative_id` FOREIGN KEY (`student_id`) REFERENCES `student_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relative_record`
--

LOCK TABLES `relative_record` WRITE;
/*!40000 ALTER TABLE `relative_record` DISABLE KEYS */;
INSERT INTO `relative_record` VALUES (45,'RENE REQUESTAS','TEST','09453453453','MARLYN REQUESTAS','housewife','09453453453','','','',5),(46,'ANGELO  MILAN','driver','09453453453','MARLYN MILAN','housewife','09534534534','','','',6),(47,'TEST','TEST','09546456456','TEST','TEST','09564564564','MARLYN MANDO','09454353453','MANILA',7),(48,'MANDO MILAN','driver','09534542343','MARIA MILAN','housewife','09342342342','','','',8),(49,'MANNY MANUEL','driver','09423424234','MANEL MANUEL','housewife','09453453453','','','',9),(50,'TEST','TEST','09434534534','TEST','TEST','09453453453','TEST','09435435345','Test',10),(51,'DELACUZ MAURO','driver','09534534534','DELA CRUZ MINDA','housewife','09453453453','','','',12);
/*!40000 ALTER TABLE `relative_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schoolyear`
--

DROP TABLE IF EXISTS `schoolyear`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schoolyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schoolyear`
--

LOCK TABLES `schoolyear` WRITE;
/*!40000 ALTER TABLE `schoolyear` DISABLE KEYS */;
INSERT INTO `schoolyear` VALUES (1,'2023-01-02','2024-01-01');
/*!40000 ALTER TABLE `schoolyear` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `limit_section` varchar(50) DEFAULT NULL,
  `min_grade` varchar(11) DEFAULT NULL,
  `max_grade` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES (1,'A','30','96','100'),(2,'B','30','90','95'),(3,'C','30','85','89'),(4,'D','30','80','84'),(5,'E','30','75','79'),(7,'SAMUEL',NULL,NULL,NULL);
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_record`
--

DROP TABLE IF EXISTS `student_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lrn` varchar(12) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `birthdate` varchar(11) NOT NULL,
  `pbirth` varchar(100) NOT NULL,
  `studentNumber` varchar(50) NOT NULL,
  `currentAddress` varchar(100) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `fingerprint_upload` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_record`
--

LOCK TABLES `student_record` WRITE;
/*!40000 ALTER TABLE `student_record` DISABLE KEYS */;
INSERT INTO `student_record` VALUES (5,'131663090012','REQUESTAS','MARCOS','MARVIN','REQUESTAS MARCOS MARVIN','profile131663090012.jpg','male','15','2008-09-09','CALOOCAN CITY','09453453453','Caloocan City','FILIPINO','fingerprint131663090012.jpg','2023-11-06 17:34:00'),(6,'131663095464','STEVE','MILAN','DULATRE ','STEVE MILAN DULATRE ','profile131663095464.webp','male','20','2003-10-15','CALOOCAHAN CITY','09534534534','CaloocaHAN City','FILIPINO','fingerprint131663090012.jpg','2023-11-06 17:42:25'),(7,'131663090012','STEVE','MARCOS','MARVIN','STEVE MARCOS MARVIN','','male','14','2009-09-09','tets','09563435345','Sample Address','FILIPINO','','2023-11-11 03:18:25'),(8,'124346437434','MILAN','MARQUEZ','MARK','MILAN MARQUEZ MARK','','male','17','2006-09-09','bulacan','09445342342','bulacan city','FILIPINO','','2023-11-14 15:22:00'),(9,'234254353452','MANUEL','LAMPA','AQUINO','MANUEL LAMPA AQUINO','','male','13','2010-09-09','CALOOCAN CITY','09435345345','Caloocan City','FILIPINO','','2023-11-14 15:32:15'),(10,'131663090012','DELA CRUZ','PENA','ARMANDO','DELA CRUZ PENA ARMANDO','','male','18','2005-08-09','tets','09454534534','Caloocan City','FILIPINO','','2023-11-14 15:42:45'),(11,'131663090012','REQUESTAS','PENA','ARMANDO','REQUESTAS PENA ARMANDO','','male','18','2005-09-09','tets','09353453454','Sample Address','FILIPINO','','2023-11-14 15:45:43'),(12,'202356607124','DELAPENIA','PENA','ARMANDO','DELAPENIA PENA ARMANDO','profile202356607124.webp','male','18','2005-09-09','BURGOS','09434234234','Burgos','FILIPINO','fingerprint202356607124.webp','2023-11-14 16:09:41');
/*!40000 ALTER TABLE `student_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_subject`
--

DROP TABLE IF EXISTS `student_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `teachers_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  KEY `year_level` (`year_level`),
  KEY `teachers_id` (`teachers_id`),
  CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`year_level`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_subject_ibfk_3` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_subject`
--

LOCK TABLES `student_subject` WRITE;
/*!40000 ALTER TABLE `student_subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_submitted`
--

DROP TABLE IF EXISTS `student_submitted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_submitted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_card` varchar(5) DEFAULT NULL,
  `formSf10` varchar(5) DEFAULT NULL,
  `birthCertificate` varchar(5) DEFAULT NULL,
  `good_moral` varchar(5) DEFAULT NULL,
  `medical_cert` varchar(5) DEFAULT NULL,
  `rec_letter` varchar(5) DEFAULT NULL,
  `study_permit` varchar(5) DEFAULT NULL,
  `alien_regcard` varchar(5) DEFAULT NULL,
  `passport_copy` varchar(5) DEFAULT NULL,
  `auth_school_record` varchar(5) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL COMMENT 'local 0 | foreign 1',
  `student_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_student_id` (`student_id`),
  CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_record` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_submitted`
--

LOCK TABLES `student_submitted` WRITE;
/*!40000 ALTER TABLE `student_submitted` DISABLE KEYS */;
INSERT INTO `student_submitted` VALUES (74,'1','0','0','1','0','1','0','0','0','0','local',5,'2023-11-06 17:34:00'),(75,'0','0','1','0','0','0','1','0','1','1','foreign',6,'2023-11-06 17:42:26'),(76,'1','0','0','1','0','1','0','0','0','0','local',7,'2023-11-11 03:18:25'),(77,'1','1','1','1','1','1','0','0','0','0','local',8,'2023-11-14 15:22:00'),(78,'1','1','1','1','1','1','0','0','0','0','local',9,'2023-11-14 15:32:15'),(79,'1','1','1','1','1','1','0','0','0','0','local',10,'2023-11-14 15:42:45'),(80,'1','1','1','1','1','1','0','0','0','0','local',12,'2023-11-14 16:09:42');
/*!40000 ALTER TABLE `student_submitted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sub_subject` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'ENGLISH',NULL),(2,'FILIPINO',NULL),(3,'MATH',NULL),(4,'SCIENCE',NULL),(5,'ESP',NULL),(6,'ESL',NULL),(7,'MATHEMATICS',NULL),(8,'ARALIN PANLIPUNAN(AP)',NULL),(9,'EDUKASYON SA PAGPAPAKATAO(ESP)',NULL),(10,'MAPEH(MUSIC)',''),(11,'MOTHER TONGUE',NULL),(12,'TECHNOLOGY AND LIVEHOOD EDUCATION','TLE'),(13,'MAPEH(ART)',NULL),(14,'MAPEH(PE)',NULL),(15,'MAPEH(HEALTH)',NULL),(16,'ORAL COMMUNICATION',NULL),(17,'KOMUNIKASYON AT PANANALIKSIK SA WIKANG AT KULTURANG PILIPINO',NULL),(18,'GENERAL MATHEMATICS',NULL),(19,'EARTH AND LIFE SCIENCE',NULL),(20,'PHYSICAL EDUCATION AND HEALTH',NULL),(21,'ENGLISH FOR ACADEMICS AND PROFESSIONAL PURPOSES',NULL),(22,'CREATIVE WRITING/ MALIKHAING PAGSULAT',NULL),(23,'ORGANIZATION MANAGEMENT',NULL),(24,'GENERAL PHYSICS(ELECTIVE 1)',NULL),(25,'READING AND WRITING',NULL),(26,'PAGBASA AT PAGSUSURI NG IBAT IBANG TEKSTO TUNGO SA PANANALIKSIK',NULL),(27,'STATISTIC AND PROBABILITY',NULL),(28,'PHYSICAL SICENCE',NULL),(29,'PHYSICAL EDUCATION AND HEALTH',NULL),(30,'DISASTER READINESS AND RISK REDUCTION',NULL),(31,'PRACTICAL RESEARCH 1',NULL),(32,'FILIPINO SA PILING LARANG',NULL),(33,'21ST CENTURY LITERATURE FROM THE PHILIPPINES AND THE WORLD',NULL),(34,'CONTEMPORARY PHILIPPINES ARTS FROM THE REGIONS',NULL),(35,'UNDERSTANDING CULTURE SOCIETY AND POLITICS',NULL),(36,'INTRODUCTION TO THE PHILOSOPHY OF THE HUMAN PERSON/PAMBUNGAD SA PILOSOPIYA NG TAO',NULL),(37,'PRACTICAL RESEARCH 2',NULL),(38,'ENTREPRENEURSHIP',NULL),(39,'PHILIPPINE POLITICS AND GOVERNANCE',NULL),(40,'MEDIA AND INFORMATION LITERACY',NULL),(41,'PERSONAL DEVELOPMENT/PANSARILING KAUNLARAN',NULL),(42,'EMPOWERMENT TECHNOLOGIES',NULL),(43,'INQUIRIES,INVESTIGATION AND IMMERSION',NULL),(44,'APPLIED ECONOMICS',NULL),(45,'DISCIPLINE AND IDEAS SOCIAL SCIENCES',NULL),(46,'GENERAL PHYSICS (ELECTIVE 2)',NULL),(47,'WORK IMMERSION',NULL);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `teacher_attendance`
--

DROP TABLE IF EXISTS `teacher_attendance`;
/*!50001 DROP VIEW IF EXISTS `teacher_attendance`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teacher_attendance` AS SELECT
 1 AS `fullName`,
  1 AS `lrn`,
  1 AS `attendance_id`,
  1 AS `enrolled_id`,
  1 AS `fingerscan`,
  1 AS `clockType`,
  1 AS `date_created`,
  1 AS `sectionName`,
  1 AS `yearLevel`,
  1 AS `class_name`,
  1 AS `account_id` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `teacher_credentials`
--

DROP TABLE IF EXISTS `teacher_credentials`;
/*!50001 DROP VIEW IF EXISTS `teacher_credentials`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teacher_credentials` AS SELECT
 1 AS `id`,
  1 AS `username`,
  1 AS `password`,
  1 AS `role`,
  1 AS `date_created`,
  1 AS `profile` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `teacher_details`
--

DROP TABLE IF EXISTS `teacher_details`;
/*!50001 DROP VIEW IF EXISTS `teacher_details`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teacher_details` AS SELECT
 1 AS `record_id`,
  1 AS `teacher_profile_id`,
  1 AS `fullName`,
  1 AS `profile`,
  1 AS `gender`,
  1 AS `age`,
  1 AS `birthdate`,
  1 AS `address`,
  1 AS `course_taken`,
  1 AS `account_id`,
  1 AS `subject_id`,
  1 AS `subjectName`,
  1 AS `year_id`,
  1 AS `yearLevel`,
  1 AS `yearType` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `teacher_profile`
--

DROP TABLE IF EXISTS `teacher_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(50) NOT NULL,
  `profile` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` varchar(6) NOT NULL,
  `birthdate` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `course_taken` varchar(50) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_id` (`account_id`),
  CONSTRAINT `fk_account_id` FOREIGN KEY (`account_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_profile`
--

LOCK TABLES `teacher_profile` WRITE;
/*!40000 ALTER TABLE `teacher_profile` DISABLE KEYS */;
INSERT INTO `teacher_profile` VALUES (23,'JOHNDENO ARAGON','jeff.jpg','male','33','1990-10-10','MABALACAT PAMPANGA','MECHANICAL ENGINEER',3),(25,'JOHNDEN ARAGON','teachjohn.jpg','male','23','2000-09-09','Bulanac City','MECHANICAL ENGINEER',3),(26,'RONALDO MARZO','teachjohn.jpg','male','23','2000-09-09','IT','MECHANICAL ENGINEER',2);
/*!40000 ALTER TABLE `teacher_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_record`
--

DROP TABLE IF EXISTS `teacher_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `subject_id` (`subject_id`),
  KEY `year_level` (`year_level`),
  CONSTRAINT `teacher_record_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `teacher_record_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `teacher_record_ibfk_3` FOREIGN KEY (`year_level`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_record`
--

LOCK TABLES `teacher_record` WRITE;
/*!40000 ALTER TABLE `teacher_record` DISABLE KEYS */;
INSERT INTO `teacher_record` VALUES (50,23,1,7),(51,23,3,12),(57,25,17,9),(58,25,19,11),(59,25,10,7),(60,26,1,6),(61,26,42,10),(62,26,16,9);
/*!40000 ALTER TABLE `teacher_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `teacherdetailsrecord`
--

DROP TABLE IF EXISTS `teacherdetailsrecord`;
/*!50001 DROP VIEW IF EXISTS `teacherdetailsrecord`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `teacherdetailsrecord` AS SELECT
 1 AS `teach_id`,
  1 AS `account_id`,
  1 AS `teacher_profile_id`,
  1 AS `fullName`,
  1 AS `profile`,
  1 AS `gender`,
  1 AS `age`,
  1 AS `birthdate`,
  1 AS `address`,
  1 AS `course_taken`,
  1 AS `subjectChosen`,
  1 AS `subjectIdLevel`,
  1 AS `levelChosen` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(350) NOT NULL,
  `role` int(1) NOT NULL COMMENT '1 = Administrator | 2 = Teacher',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$vp9epCOhuMO1ZLYTTT.oMOvFgsRF3ZiJhRCJWRpmTKMSUfs67iSDy',1,'2023-10-25 14:05:59'),(2,'teacher02','$2y$10$Xd1Vv5QBvNiudGVtUmdmzOYpLNlm1D2gaWjWt4H90yR/tjat9kB7i',2,'2023-10-25 14:05:59'),(3,'teacher01','$2y$10$asLxitcbQRkDwjRTlYF2B.crbA4NSFm9kiQlLMLnnFIY77uKfrfEC',2,'2023-11-08 05:24:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `year`
--

DROP TABLE IF EXISTS `year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 = elementary| 2 = high school 3-senior high 4 collage',
  `qualify_age` int(2) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `year`
--

LOCK TABLES `year` WRITE;
/*!40000 ALTER TABLE `year` DISABLE KEYS */;
INSERT INTO `year` VALUES (1,'Nursery',1,2,'2023-10-26 11:23:04'),(2,'Kinder',1,4,'2023-10-26 11:23:04'),(3,'Grade 1',1,6,'2023-10-26 11:23:04'),(4,'Grade 2',1,7,'2023-10-26 11:23:04'),(5,'Grade 3',1,8,'2023-10-26 11:23:04'),(6,'Grade 4',1,9,'2023-10-26 11:23:04'),(7,'Grade 5',1,10,'2023-10-26 11:23:04'),(8,'Grade 6',1,11,'2023-10-26 11:23:04'),(9,'Grade 7',2,12,'2023-10-26 11:23:04'),(10,'Grade 8',2,13,'2023-10-26 11:23:04'),(11,'Grade 9',2,14,'2023-10-26 11:23:04'),(12,'Grade 10',2,15,'2023-10-26 11:23:04'),(13,'Grade 11',3,16,'2023-10-26 11:23:04'),(14,'Grade 12',3,17,'2023-10-26 11:23:04');
/*!40000 ALTER TABLE `year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `attendance_list`
--

/*!50001 DROP VIEW IF EXISTS `attendance_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `attendance_list` AS select `s`.`fullName` AS `fullName`,`s`.`lrn` AS `lrn`,`a`.`attendance_id` AS `attendance_id`,`a`.`enrolled_id` AS `enrolled_id`,`a`.`fingerscan` AS `fingerscan`,`at`.`rec_type` AS `clockType`,`at`.`date_created` AS `date_created` from (((`fingerprint_enroll` `a` join `enrollment_record` `er` on(`er`.`id` = `a`.`enrolled_id`)) join `student_record` `s` on(`s`.`id` = `er`.`student_id`)) join `attendance_record_list` `at` on(`at`.`attendance_id` = `a`.`attendance_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `attendance_record`
--

/*!50001 DROP VIEW IF EXISTS `attendance_record`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `attendance_record` AS select `s`.`fullName` AS `fullName`,`s`.`lrn` AS `lrn`,`a`.`attendance_id` AS `attendance_id`,`a`.`enrolled_id` AS `enrolled_id`,`a`.`fingerscan` AS `fingerscan`,`a`.`date_created` AS `date_created` from ((`fingerprint_enroll` `a` join `enrollment_record` `er` on(`er`.`id` = `a`.`enrolled_id`)) join `student_record` `s` on(`s`.`id` = `er`.`student_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `classdetails`
--

/*!50001 DROP VIEW IF EXISTS `classdetails`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `classdetails` AS select `cl`.`class_id` AS `class_id`,`cl`.`class_name` AS `class_name`,`cl`.`section_id` AS `section_id`,`cl`.`subject_id` AS `subject_id`,`cl`.`teacher_id` AS `teacher_id`,`s`.`limit_section` AS `class_limit`,`cl`.`room_number` AS `room_number`,`cl`.`scheduled_time` AS `scheduled_time`,`cl`.`timeofDay` AS `timeofDay`,`cl`.`year_level` AS `year_level`,`cl`.`date_created` AS `date_created`,`s`.`name` AS `sectionName`,`s`.`id` AS `sectionId`,`sub`.`id` AS `subjectId`,`sub`.`name` AS `subjectName`,`y`.`id` AS `yearId`,`y`.`name` AS `yearName`,`tp`.`id` AS `teacherId`,`tp`.`fullName` AS `teacherName` from ((((`classes_record` `cl` join `section` `s` on(`s`.`id` = `cl`.`section_id`)) join `subject` `sub` on(`sub`.`id` = `cl`.`subject_id`)) join `teacher_profile` `tp` on(`tp`.`id` = `cl`.`teacher_id`)) join `year` `y` on(`y`.`id` = `cl`.`year_level`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `enrollment_records`
--

/*!50001 DROP VIEW IF EXISTS `enrollment_records`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `enrollment_records` AS select `e`.`id` AS `enrollment_id`,`e`.`student_id` AS `student_id`,`s`.`lrn` AS `lrn`,`s`.`fullName` AS `fullName`,`s`.`lname` AS `lastName`,`s`.`mname` AS `middleName`,`s`.`fname` AS `firstName`,`s`.`nationality` AS `nationality`,`s`.`profile` AS `profile`,`s`.`gender` AS `gender`,`s`.`age` AS `age`,`s`.`birthdate` AS `birthdate`,`s`.`pbirth` AS `pbirth`,`s`.`studentNumber` AS `studentNumber`,`s`.`currentAddress` AS `currentAddress`,`e`.`gwa` AS `gwa`,`s`.`fingerprint_upload` AS `fingerprint_upload`,`sc`.`id` AS `sectionId`,`sc`.`name` AS `sectionName`,`y`.`id` AS `yearLevelId`,`y`.`type` AS `yearType`,`y`.`name` AS `yearLevel`,`em`.`contactName` AS `contactName`,`em`.`relationship` AS `relationship`,`em`.`phone` AS `phone`,`r`.`fatherName` AS `fatherName`,`r`.`fatherOccupation` AS `fatherOccupation`,`r`.`fatherNumber` AS `fatherNumber`,`r`.`motherName` AS `motherName`,`r`.`motherOccupation` AS `motherOccupation`,`r`.`motherNumber` AS `motherNumber`,`r`.`guardianName` AS `guardianName`,`r`.`guardianNumber` AS `guardianNumber`,`r`.`guardianAddress` AS `guardianAddress`,`sr`.`report_card` AS `report_card`,`sr`.`formSf10` AS `formSf10`,`sr`.`birthCertificate` AS `birthCertificate`,`sr`.`good_moral` AS `good_moral`,`sr`.`medical_cert` AS `medical_cert`,`sr`.`rec_letter` AS `rec_letter`,`sr`.`study_permit` AS `study_permit`,`sr`.`alien_regcard` AS `alien_regcard`,`sr`.`passport_copy` AS `passport_copy`,`sr`.`auth_school_record` AS `auth_school_record`,`sr`.`type` AS `type`,`e`.`date_enrolled` AS `date_enrolled`,year(`e`.`date_enrolled`) AS `yearEnrolled`,`e`.`submit_report` AS `submit_id`,`e`.`receipt_id` AS `receipt_id`,`sm`.`typeFee` AS `typeFee`,`sm`.`miscellanious` AS `miscellanious`,`sm`.`bookModules` AS `bookModules`,`sm`.`tuitionFee` AS `tuitionFee`,`sm`.`totalFee` AS `totalFee`,`sm`.`fullCashPayment` AS `fullCashPayment` from (((((((`enrollment_record` `e` join `student_record` `s` on(`s`.`id` = `e`.`student_id`)) join `emergency_contact` `em` on(`em`.`student_id` = `e`.`student_id`)) join `relative_record` `r` on(`r`.`student_id` = `e`.`student_id`)) join `student_submitted` `sr` on(`sr`.`id` = `e`.`submit_report`)) join `section` `sc` on(`sc`.`id` = `e`.`section_id`)) join `year` `y` on(`y`.`id` = `e`.`year_level`)) join `receipt_record` `sm` on(`sm`.`id` = `e`.`receipt_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teacher_attendance`
--

/*!50001 DROP VIEW IF EXISTS `teacher_attendance`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teacher_attendance` AS select `al`.`fullName` AS `fullName`,`al`.`lrn` AS `lrn`,`al`.`attendance_id` AS `attendance_id`,`al`.`enrolled_id` AS `enrolled_id`,`al`.`fingerscan` AS `fingerscan`,`al`.`clockType` AS `clockType`,`al`.`date_created` AS `date_created`,`en`.`sectionName` AS `sectionName`,`en`.`yearLevel` AS `yearLevel`,`cl`.`class_name` AS `class_name`,`tch`.`account_id` AS `account_id` from (((`attendance_list` `al` join `enrollment_records` `en` on(`en`.`enrollment_id` = `al`.`enrolled_id`)) join `classes_record` `cl` on(`cl`.`section_id` = `en`.`sectionId` and `cl`.`year_level` = `en`.`yearLevelId`)) join `teacher_profile` `tch` on(`tch`.`id` = `cl`.`teacher_id`)) order by `al`.`date_created` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teacher_credentials`
--

/*!50001 DROP VIEW IF EXISTS `teacher_credentials`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teacher_credentials` AS select `u`.`id` AS `id`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`role` AS `role`,`u`.`date_created` AS `date_created`,`th`.`profile` AS `profile` from (`users` `u` join `teacher_profile` `th` on(`th`.`account_id` = `u`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teacher_details`
--

/*!50001 DROP VIEW IF EXISTS `teacher_details`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teacher_details` AS select `tr`.`id` AS `record_id`,`tp`.`id` AS `teacher_profile_id`,`tp`.`fullName` AS `fullName`,`tp`.`profile` AS `profile`,`tp`.`gender` AS `gender`,`tp`.`age` AS `age`,`tp`.`birthdate` AS `birthdate`,`tp`.`address` AS `address`,`tp`.`course_taken` AS `course_taken`,`tp`.`account_id` AS `account_id`,`s`.`id` AS `subject_id`,`s`.`name` AS `subjectName`,`y`.`id` AS `year_id`,`y`.`name` AS `yearLevel`,`y`.`type` AS `yearType` from (((`teacher_record` `tr` join `teacher_profile` `tp` on(`tp`.`id` = `tr`.`teacher_id`)) join `subject` `s` on(`s`.`id` = `tr`.`subject_id`)) join `year` `y` on(`y`.`id` = `tr`.`year_level`)) group by `tr`.`teacher_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `teacherdetailsrecord`
--

/*!50001 DROP VIEW IF EXISTS `teacherdetailsrecord`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `teacherdetailsrecord` AS select `tr`.`id` AS `teach_id`,`tp`.`account_id` AS `account_id`,`tp`.`id` AS `teacher_profile_id`,`tp`.`fullName` AS `fullName`,`tp`.`profile` AS `profile`,`tp`.`gender` AS `gender`,`tp`.`age` AS `age`,`tp`.`birthdate` AS `birthdate`,`tp`.`address` AS `address`,`tp`.`course_taken` AS `course_taken`,group_concat(concat(`s`.`name`,' (',`y`.`name`,')') separator ', ') AS `subjectChosen`,concat('[',group_concat(concat('{ \'subject\':',`s`.`id`,', \'level\':',`y`.`id`,', \'id\':',`tr`.`id`,'}') separator ', '),']') AS `subjectIdLevel`,group_concat(`y`.`name` separator ', ') AS `levelChosen` from (((`teacher_record` `tr` join `teacher_profile` `tp` on(`tp`.`id` = `tr`.`teacher_id`)) join `subject` `s` on(`s`.`id` = `tr`.`subject_id`)) join `year` `y` on(`y`.`id` = `tr`.`year_level`)) group by `tr`.`teacher_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-29  9:16:40
