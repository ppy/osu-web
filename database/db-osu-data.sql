-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: osu
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB-1~trusty-log
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
INSERT INTO `migrations` VALUES ('2015_06_04_083548_infinite_stock_products',6);
INSERT INTO `migrations` VALUES ('2015_06_04_093340_custom_product_implementations',6);
INSERT INTO `migrations` VALUES ('2015_06_18_022845_order_transaction_id',7);
INSERT INTO `migrations` VALUES ('2015_06_19_050528_add_order_paid_at_column',7);
INSERT INTO `migrations` VALUES ('2015_07_08_042238_create_tournaments_tables',8);
INSERT INTO `migrations` VALUES ('2015_07_09_084235_create_user_profile_customizations_table',9);
INSERT INTO `migrations` VALUES ('2015_07_09_091745_add_tournament_description_text',8);
INSERT INTO `migrations` VALUES ('2015_07_09_105144_create_tournaments_registrations_table',8);
INSERT INTO `migrations` VALUES ('2015_08_10_083016_add_slug_to_achievements',10);
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-02 12:34:22
