-- MySQL dump 10.13  Distrib 5.7.11, for Linux (i686)
--
-- Host: localhost    Database: osu
-- ------------------------------------------------------
-- Server version	5.7.11
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `osu_genres`
--

INSERT INTO `osu_genres` VALUES (0,'Any');
INSERT INTO `osu_genres` VALUES (1,'Unspecified');
INSERT INTO `osu_genres` VALUES (2,'Video Game');
INSERT INTO `osu_genres` VALUES (3,'Anime');
INSERT INTO `osu_genres` VALUES (4,'Rock');
INSERT INTO `osu_genres` VALUES (5,'Pop');
INSERT INTO `osu_genres` VALUES (6,'Other');
INSERT INTO `osu_genres` VALUES (7,'Novelty');
INSERT INTO `osu_genres` VALUES (9,'Hip Hop');
INSERT INTO `osu_genres` VALUES (10,'Electronic');

--
-- Dumping data for table `osu_languages`
--

INSERT INTO `osu_languages` VALUES (0,'Any',0);
INSERT INTO `osu_languages` VALUES (1,'Other',11);
INSERT INTO `osu_languages` VALUES (2,'English',1);
INSERT INTO `osu_languages` VALUES (3,'Japanese',6);
INSERT INTO `osu_languages` VALUES (4,'Chinese',2);
INSERT INTO `osu_languages` VALUES (5,'Instrumental',10);
INSERT INTO `osu_languages` VALUES (6,'Korean',7);
INSERT INTO `osu_languages` VALUES (7,'French',3);
INSERT INTO `osu_languages` VALUES (8,'German',4);
INSERT INTO `osu_languages` VALUES (9,'Swedish',9);
INSERT INTO `osu_languages` VALUES (10,'Spanish',8);
INSERT INTO `osu_languages` VALUES (11,'Italian',5);
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-03 15:06:03
