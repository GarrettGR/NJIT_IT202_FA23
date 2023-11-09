-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: sql1.njit.edu    Database: grg
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bread`
--

DROP TABLE IF EXISTS `bread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bread` (
  `breadID` int(11) NOT NULL AUTO_INCREMENT,
  `breadCategoryID` int(11) NOT NULL,
  `breadCode` varchar(10) NOT NULL,
  `breadName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`breadID`),
  UNIQUE KEY `breadCode` (`breadCode`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bread`
--

LOCK TABLES `bread` WRITE;
/*!40000 ALTER TABLE `bread` DISABLE KEYS */;
INSERT INTO `bread` VALUES (1,1,'BRD-001','Buddy','2 year old Cockatiel',30.61,'2021-12-31 23:59:59'),(2,1,'BRD-002','Cupcake','4 month old Parakeet',65.90,'2021-12-31 23:59:59'),(3,1,'BRD-003','Sunshine','1 year old Lovebird',37.68,'2023-11-04 18:09:20'),(4,2,'CAT-001','Simba','6 month old American Shorthair',90.68,'2021-12-31 23:59:59'),(5,2,'CAT-002','Nala','8 month old Siamese',40.37,'2021-12-31 23:59:59'),(6,2,'CAT-003','Luna','3 year old Domestic Longhair',29.83,'2023-11-04 18:09:20'),(7,3,'DOG-001','Bailey','9 month old Beagle',28.00,'2021-12-31 23:59:59'),(8,3,'DOG-002','Sadie','3 year old Golden Retriever',50.54,'2021-12-31 23:59:59'),(9,3,'DOG-003','Cooper','8 week old Poodle',68.68,'2023-11-04 18:09:20'),(10,4,'SNA-001','Asmodeus','2 month old Western Hognose',91.79,'2021-12-31 23:59:59'),(11,4,'SNA-002','Basil','4 month old Garter',52.91,'2021-12-31 23:59:59'),(12,4,'SNA-003','Diablo','1 year old King Snake',89.18,'2023-11-04 18:09:20'),(13,5,'FIS-001','Flipper','Guppy',87.19,'2021-12-31 23:59:59'),(14,5,'FIS-002','Finley','Neon Tetra',68.39,'2021-12-31 23:59:59'),(15,5,'FIS-003','Goldie','Goldfish',80.38,'2023-11-04 18:09:20'),(47,2,'CAT-004','Cement Mixer','American shorthair',69.69,'2023-11-06 22:03:29'),(48,1,'BRD-004','Sunny','canary -- a natural-born test bird',0.99,'2023-11-09 09:21:48'),(49,1,'BRD-005','Sunny ii','Another test bird',0.99,'2023-11-09 09:22:57'),(50,1,'BRD-006','sunny iii','yet another canary',0.99,'2023-11-09 09:28:42'),(51,1,'BRD-008','Sunny iv','yet another canary',0.99,'2023-11-09 09:47:43'),(52,1,'BRD-009','sunny v','a test boid',1.99,'2023-11-09 09:48:06'),(54,6,'LZD-001','lizzy iggy','our first iguana friend',120.99,'2023-11-09 09:53:20');
/*!40000 ALTER TABLE `bread` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-09  9:57:54
