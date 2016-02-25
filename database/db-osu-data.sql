-- MySQL dump 10.15  Distrib 10.0.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: osu
-- ------------------------------------------------------
-- Server version	5.7.9-log
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` VALUES ('2013_12_24_180249_create_notifications_table',1);
INSERT INTO `migrations` VALUES ('2014_05_02_190748_add_shipping_rate_to_osu_countries_table',1);
INSERT INTO `migrations` VALUES ('2015_01_23_114030_extend_products_table',2);
INSERT INTO `migrations` VALUES ('2015_01_29_013313_add_last_order_tracking_state',3);
INSERT INTO `migrations` VALUES ('2015_02_03_051509_record_cost_and_shipping_in_order',4);
INSERT INTO `migrations` VALUES ('2015_02_04_165733_record_cost_and_shipping_in_order_populate',5);
INSERT INTO `migrations` VALUES ('2015_05_01_013313_add_item_family',6);
INSERT INTO `migrations` VALUES ('2015_06_04_083548_infinite_stock_products',7);
INSERT INTO `migrations` VALUES ('2015_06_04_093340_custom_product_implementations',8);
INSERT INTO `migrations` VALUES ('2015_06_18_022845_order_transaction_id',9);
INSERT INTO `migrations` VALUES ('2015_06_19_050528_add_order_paid_at_column',10);
INSERT INTO `migrations` VALUES ('2015_07_08_042238_create_tournaments_tables',11);
INSERT INTO `migrations` VALUES ('2015_07_09_084235_create_user_profile_customizations_table',13);
INSERT INTO `migrations` VALUES ('2015_07_09_091745_add_tournament_description_text',12);
INSERT INTO `migrations` VALUES ('2015_07_09_105144_create_tournaments_registrations_table',12);
INSERT INTO `migrations` VALUES ('2015_08_10_083016_add_slug_to_achievements',14);
INSERT INTO `migrations` VALUES ('2015_11_16_065319_create_topic_covers_table',15);
INSERT INTO `migrations` VALUES ('2015_11_20_122003_add_unique_index_to_forum_topic_covers_forum_id',16);
INSERT INTO `migrations` VALUES ('2015_12_07_061307_create_forum_covers_table',17);
INSERT INTO `migrations` VALUES ('2016_01_12_074035_unique_user_customization_user_id',18);
INSERT INTO `migrations` VALUES ('2016_01_26_194005_disable_products',19);
INSERT INTO `migrations` VALUES ('2016_01_29_090810_add_description_to_achievements',20);

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

--
-- Dumping data for table `osu_counts`
--
INSERT INTO `osu_counts` VALUES ('pp_rank_column',90);


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-04 19:33:22
