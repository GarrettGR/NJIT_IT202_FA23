-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: it202
-- ------------------------------------------------------
-- Server version	8.1.0

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
  `breadID` int NOT NULL AUTO_INCREMENT,
  `breadCategoryID` int NOT NULL,
  `breadCode` varchar(10) NOT NULL,
  `breadName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`breadID`),
  UNIQUE KEY `breadCode` (`breadCode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bread`
--

LOCK TABLES `bread` WRITE;
/*!40000 ALTER TABLE `bread` DISABLE KEYS */;
INSERT INTO `bread` VALUES (1,1,'BRD-001','Buddy','2 year old Cockatiel',43.13,'2021-12-31 23:59:59'),(2,1,'BRD-002','Cupcake','4 month old Parakeet',7.27,'2021-12-31 23:59:59'),(3,1,'BRD-003','Sunshine','1 year old Lovebird',6.94,'2023-10-20 18:06:57'),(4,2,'CAT-001','Simba','6 month old American Shorthair',12.91,'2021-12-31 23:59:59'),(5,2,'CAT-002','Nala','8 month old Siamese',43.73,'2021-12-31 23:59:59'),(6,2,'CAT-003','Luna','3 year old Domestic Longhair',79.90,'2023-10-20 18:06:57'),(7,3,'DOG-001','Bailey','9 month old Beagle',68.32,'2021-12-31 23:59:59'),(8,3,'DOG-002','Sadie','3 year old Golden Retriever',1.90,'2021-12-31 23:59:59'),(9,3,'DOG-003','Cooper','8 week old Poodle',4.55,'2023-10-20 18:06:57'),(10,4,'SNA-001','Asmodeus','2 month old Western Hognose',17.02,'2021-12-31 23:59:59'),(11,4,'SNA-002','Basil','4 month old Garter',71.48,'2021-12-31 23:59:59'),(12,4,'SNA-003','Diablo','1 year old King Snake',6.32,'2023-10-20 18:06:57'),(13,5,'FIS-001','Flipper','Guppy',17.16,'2021-12-31 23:59:59'),(14,5,'FIS-002','Finley','Neon Tetra',66.84,'2021-12-31 23:59:59'),(15,5,'FIS-003','Goldie','Goldfish',82.71,'2023-10-20 18:06:57');
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

-- Dump completed on 2023-10-20 23:56:23
