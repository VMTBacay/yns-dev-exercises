-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: quiz
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(150) NOT NULL,
  `choices` varchar(100) NOT NULL,
  `answer` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'A fictional Princeton Plainsboro Teaching Hospital in New Jersey, was the set of what popular American television medical drama starring Hugh Laurie?','House, M.D|Scrubs|E.R.','House, M.D'),(2,'Girl with a Pearl Earring is an oil painting by which Dutch Golden Age painter?','Gaius Worzel|Johannes Vermeer|Ignatz Victor','Johannes Vermeer'),(3,'When referring to phone calls made over the internet, what does the acronym VoIP stand for?','Voice over Internet Protocol|Vice of Ice Price|Venting on Instagram Posts','Voice over Internet Protocol'),(4,'Released in 1941, what is the only Disney animated feature film with a title character that never speaks?','The Little Mermaid|Pirates of the Caribbean|Dumbo','Dumbo'),(5,'Which famous World War II general competed in the Olympics?','Adolf Hitler|George Patton|Craig Charles','George Patton'),(6,'When referring to a website’s address was does the acronym URL stand for?','Universal Radical Length|Uniform Resource Locator|Ur Really Lame','Uniform Resource Locator'),(7,'What is the Latin term for the phrase “seize the day”?','Carpe Diem|Memento Mori|Requescat In Pace','Carpe Diem'),(8,'In L. Frank Baum’s original 1900 novel, The Wonderful Wizard of Oz, what color were Dorothy’s shoes?','Silver|Red|Emerald','Silver'),(9,'Mac Gargan is the alter ego of what Spider-Man villain?','Scorpion|Venom|Spider-Man','Scorpion'),(10,'What term describes the amount of light a planetary body reflects?','Alvedo|Albedo|Alpedo','Albedo');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-14 15:44:01
