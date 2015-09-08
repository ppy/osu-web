-- MySQL dump 10.13  Distrib 5.6.24-72.2, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: osu
-- ------------------------------------------------------
-- Server version	5.6.24-72.2-log

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`migration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_achievements`
--

DROP TABLE IF EXISTS `osu_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_achievements` (
  `achievement_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(50) NOT NULL,
  `grouping` varchar(30) NOT NULL DEFAULT '-',
  `ordering` tinyint(10) unsigned NOT NULL,
  `quest_ordering` tinyint(4) DEFAULT NULL,
  `quest_instructions` text,
  PRIMARY KEY (`achievement_id`),
  KEY `display_order` (`grouping`,`ordering`),
  KEY `quest_ordering` (`quest_ordering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_apikeys`
--

DROP TABLE IF EXISTS `osu_apikeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_apikeys` (
  `key` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `app_name` varchar(100) NOT NULL DEFAULT '',
  `app_url` varchar(100) NOT NULL DEFAULT '',
  `api_key` varchar(52) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `hit_count` bigint(20) unsigned NOT NULL DEFAULT '0',
  `miss_count` int(10) unsigned NOT NULL DEFAULT '0',
  `revoked` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`key`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_beatmaps`
--

DROP TABLE IF EXISTS `osu_beatmaps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_beatmaps` (
  `beatmap_id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `beatmapset_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `checksum` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `version` varchar(80) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `total_length` mediumint(11) unsigned NOT NULL DEFAULT '0',
  `hit_length` mediumint(11) unsigned NOT NULL DEFAULT '0',
  `countTotal` smallint(11) unsigned NOT NULL DEFAULT '0',
  `countNormal` smallint(11) unsigned NOT NULL DEFAULT '0',
  `countSlider` smallint(11) unsigned NOT NULL DEFAULT '0',
  `countSpinner` smallint(11) unsigned NOT NULL DEFAULT '0',
  `diff_drain` float unsigned NOT NULL DEFAULT '0',
  `diff_size` float unsigned NOT NULL DEFAULT '0',
  `diff_overall` float unsigned NOT NULL DEFAULT '0',
  `diff_approach` float unsigned NOT NULL DEFAULT '0',
  `playmode` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `approved` tinyint(3) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `difficultyrating` float NOT NULL DEFAULT '0',
  `playcount` mediumint(11) unsigned NOT NULL DEFAULT '0',
  `passcount` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `orphaned` tinyint(1) NOT NULL DEFAULT '0',
  `youtube_preview` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`beatmap_id`),
  KEY `beatmapset_id` (`beatmapset_id`),
  KEY `filename` (`filename`),
  KEY `checksum` (`checksum`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_beatmapsets`
--

DROP TABLE IF EXISTS `osu_beatmapsets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_beatmapsets` (
  `beatmapset_id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `thread_id` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `artist` varchar(80) NOT NULL DEFAULT '',
  `artist_unicode` varchar(80) DEFAULT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `title_unicode` varchar(80) DEFAULT NULL,
  `creator` varchar(80) NOT NULL DEFAULT '',
  `source` varchar(200) NOT NULL DEFAULT '',
  `tags` varchar(1000) NOT NULL DEFAULT '',
  `video` tinyint(1) NOT NULL DEFAULT '0',
  `storyboard` tinyint(1) NOT NULL DEFAULT '0',
  `epilepsy` tinyint(1) NOT NULL DEFAULT '0',
  `bpm` float NOT NULL DEFAULT '0',
  `versions_available` tinyint(11) unsigned NOT NULL DEFAULT '1',
  `approved` tinyint(11) NOT NULL DEFAULT '0',
  `approvedby_id` mediumint(11) unsigned DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `submit_date` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` varchar(120) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `rating` float unsigned NOT NULL DEFAULT '0',
  `offset` smallint(6) NOT NULL DEFAULT '0',
  `displaytitle` varchar(200) NOT NULL DEFAULT '',
  `genre_id` smallint(6) unsigned NOT NULL DEFAULT '1',
  `language_id` smallint(6) unsigned NOT NULL DEFAULT '1',
  `star_priority` smallint(6) NOT NULL DEFAULT '0',
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `filesize_novideo` bigint(11) DEFAULT NULL,
  `body_hash` binary(16) DEFAULT NULL,
  `header_hash` binary(16) DEFAULT NULL,
  `osz2_hash` binary(16) DEFAULT NULL,
  `download_disabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `download_disabled_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `thread_icon_date` datetime DEFAULT NULL,
  `favourite_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `play_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `difficulty_names` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`beatmapset_id`),
  KEY `user_id` (`user_id`),
  KEY `thread_id` (`thread_id`),
  KEY `genre_id` (`genre_id`),
  KEY `approved_2` (`approved`,`star_priority`),
  KEY `approved` (`approved`,`active`,`approved_date`),
  KEY `favourite_count` (`favourite_count`),
  KEY `approved_3` (`approved`,`active`,`last_update`),
  KEY `filename` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_changelog`
--

DROP TABLE IF EXISTS `osu_changelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_changelog` (
  `changelog_id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `prefix` char(1) NOT NULL DEFAULT '*',
  `category` varchar(50) NOT NULL DEFAULT '',
  `message` varchar(8000) NOT NULL DEFAULT '',
  `checksum` varchar(40) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `private` tinyint(4) NOT NULL DEFAULT '0',
  `major` tinyint(4) NOT NULL DEFAULT '0',
  `tweet` tinyint(4) NOT NULL DEFAULT '0',
  `build` varchar(50) DEFAULT NULL,
  `thread_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`changelog_id`),
  UNIQUE KEY `unique_checksum` (`checksum`),
  KEY `time` (`date`),
  KEY `major_release` (`build`,`date`),
  KEY `category` (`category`,`changelog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_countries`
--

DROP TABLE IF EXISTS `osu_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_countries` (
  `acronym` char(2) NOT NULL,
  `name` varchar(150) NOT NULL,
  `rankedscore` bigint(20) NOT NULL,
  `playcount` bigint(20) NOT NULL,
  `usercount` bigint(20) NOT NULL DEFAULT '0',
  `pp` bigint(20) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `shipping_rate` float NOT NULL DEFAULT '1',
  PRIMARY KEY (`acronym`),
  KEY `rankedscore` (`rankedscore`),
  KEY `playcount` (`playcount`),
  KEY `display` (`display`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_login_attempts`
--

DROP TABLE IF EXISTS `osu_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_login_attempts` (
  `ip` varchar(128) NOT NULL,
  `failed_attempts` mediumint(5) unsigned NOT NULL DEFAULT '1',
  `total_attempts` smallint(5) unsigned NOT NULL DEFAULT '1',
  `unique_ids` smallint(5) unsigned NOT NULL DEFAULT '1',
  `failed_ids` text NOT NULL,
  `last_attempt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip`),
  KEY `last_attempt` (`last_attempt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_user_achievements`
--

DROP TABLE IF EXISTS `osu_user_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_user_achievements` (
  `user_id` mediumint(9) NOT NULL,
  `achievement_id` mediumint(9) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`achievement_id`),
  KEY `user_id` (`user_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_user_banhistory`
--

DROP TABLE IF EXISTS `osu_user_banhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_user_banhistory` (
  `ban_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `reason` varchar(8000) DEFAULT 'Blanket Cheating Action',
  `supporting_url` varchar(255) DEFAULT NULL,
  `ban_status` tinyint(4) DEFAULT '1',
  `period` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `banner_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ban_id`),
  KEY `user_id_2` (`user_id`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPRESSED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_user_stats`
--

DROP TABLE IF EXISTS `osu_user_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_user_stats` (
  `user_id` mediumint(9) NOT NULL,
  `count300` int(11) NOT NULL DEFAULT '0',
  `count100` int(11) NOT NULL DEFAULT '0',
  `count50` int(11) NOT NULL DEFAULT '0',
  `countMiss` int(11) NOT NULL DEFAULT '0',
  `accuracy_total` bigint(20) unsigned NOT NULL,
  `accuracy_count` bigint(5) unsigned NOT NULL,
  `accuracy` float NOT NULL,
  `playcount` mediumint(11) NOT NULL,
  `ranked_score` bigint(20) NOT NULL,
  `total_score` bigint(20) NOT NULL,
  `x_rank_count` mediumint(9) NOT NULL,
  `s_rank_count` mediumint(9) NOT NULL,
  `a_rank_count` mediumint(9) NOT NULL,
  `rank` mediumint(9) NOT NULL,
  `level` float unsigned NOT NULL,
  `replay_popularity` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fail_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `exit_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `max_combo` smallint(10) unsigned NOT NULL DEFAULT '0',
  `country_acronym` char(2) NOT NULL DEFAULT '',
  `rank_score` float unsigned NOT NULL,
  `rank_score_index` int(10) unsigned NOT NULL,
  `accuracy_new` float unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_played` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `ranked_score` (`ranked_score`),
  KEY `rank_score` (`rank_score`),
  KEY `country_acronym_2` (`country_acronym`,`rank_score`),
  KEY `playcount` (`playcount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_user_stats_fruits`
--

DROP TABLE IF EXISTS `osu_user_stats_fruits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_user_stats_fruits` (
  `user_id` mediumint(9) NOT NULL,
  `count300` int(11) NOT NULL DEFAULT '0',
  `count100` int(11) NOT NULL DEFAULT '0',
  `count50` int(11) NOT NULL DEFAULT '0',
  `countMiss` int(11) NOT NULL DEFAULT '0',
  `accuracy_total` bigint(20) unsigned NOT NULL,
  `accuracy_count` bigint(5) unsigned NOT NULL,
  `accuracy` float NOT NULL,
  `playcount` mediumint(11) NOT NULL,
  `ranked_score` bigint(20) NOT NULL,
  `total_score` bigint(20) NOT NULL,
  `x_rank_count` mediumint(9) NOT NULL,
  `s_rank_count` mediumint(9) NOT NULL,
  `a_rank_count` mediumint(9) NOT NULL,
  `rank` mediumint(9) NOT NULL,
  `level` float unsigned NOT NULL,
  `replay_popularity` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fail_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `exit_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `max_combo` smallint(10) unsigned NOT NULL DEFAULT '0',
  `country_acronym` char(2) NOT NULL DEFAULT '',
  `rank_score` float unsigned NOT NULL,
  `rank_score_index` int(10) unsigned NOT NULL,
  `accuracy_new` float unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_played` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `ranked_score` (`ranked_score`),
  KEY `playcount` (`playcount`),
  KEY `rank_score` (`rank_score`),
  KEY `country_acronym` (`country_acronym`,`rank_score`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_user_stats_mania`
--

DROP TABLE IF EXISTS `osu_user_stats_mania`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_user_stats_mania` (
  `user_id` mediumint(9) NOT NULL,
  `count300` int(11) NOT NULL DEFAULT '0',
  `count100` int(11) NOT NULL DEFAULT '0',
  `count50` int(11) NOT NULL DEFAULT '0',
  `countMiss` int(11) NOT NULL DEFAULT '0',
  `accuracy_total` bigint(20) unsigned NOT NULL,
  `accuracy_count` bigint(5) unsigned NOT NULL,
  `accuracy` float NOT NULL,
  `playcount` mediumint(11) NOT NULL,
  `ranked_score` bigint(20) NOT NULL,
  `total_score` bigint(20) NOT NULL,
  `x_rank_count` mediumint(9) NOT NULL,
  `s_rank_count` mediumint(9) NOT NULL,
  `a_rank_count` mediumint(9) NOT NULL,
  `rank` mediumint(9) NOT NULL,
  `level` float unsigned NOT NULL,
  `replay_popularity` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fail_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `exit_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `max_combo` smallint(10) unsigned NOT NULL DEFAULT '0',
  `country_acronym` char(2) NOT NULL DEFAULT '',
  `rank_score` float unsigned NOT NULL,
  `rank_score_index` int(10) unsigned NOT NULL,
  `accuracy_new` float unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_played` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `ranked_score` (`ranked_score`),
  KEY `rank_score` (`rank_score`),
  KEY `country_acronym_2` (`country_acronym`,`rank_score`),
  KEY `playcount` (`playcount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_user_stats_taiko`
--

DROP TABLE IF EXISTS `osu_user_stats_taiko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_user_stats_taiko` (
  `user_id` mediumint(9) NOT NULL,
  `count300` int(11) NOT NULL DEFAULT '0',
  `count100` int(11) NOT NULL DEFAULT '0',
  `count50` int(11) NOT NULL DEFAULT '0',
  `countMiss` int(11) NOT NULL DEFAULT '0',
  `accuracy_total` bigint(20) unsigned NOT NULL,
  `accuracy_count` bigint(5) unsigned NOT NULL,
  `accuracy` float NOT NULL,
  `playcount` mediumint(11) NOT NULL,
  `ranked_score` bigint(20) NOT NULL,
  `total_score` bigint(20) NOT NULL,
  `x_rank_count` mediumint(9) NOT NULL,
  `s_rank_count` mediumint(9) NOT NULL,
  `a_rank_count` mediumint(9) NOT NULL,
  `rank` mediumint(9) NOT NULL,
  `level` float unsigned NOT NULL,
  `replay_popularity` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fail_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `exit_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `max_combo` smallint(10) unsigned NOT NULL DEFAULT '0',
  `country_acronym` char(2) NOT NULL DEFAULT '',
  `rank_score` float unsigned NOT NULL,
  `rank_score_index` int(10) unsigned NOT NULL,
  `accuracy_new` float unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_played` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `ranked_score` (`ranked_score`),
  KEY `playcount` (`playcount`),
  KEY `rank_score` (`rank_score`),
  KEY `country_acronym` (`country_acronym`,`rank_score`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `osu_username_change_history`
--

DROP TABLE IF EXISTS `osu_username_change_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `osu_username_change_history` (
  `change_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `type` enum('support','paid','admin','revert','inactive') NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username_last` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`change_id`),
  KEY `user_id` (`user_id`),
  KEY `username_last` (`username_last`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Stores historical changes to user''s usernames over time.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_acl_groups`
--

DROP TABLE IF EXISTS `phpbb_acl_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_acl_groups` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `auth_opt_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_disallow`
--

DROP TABLE IF EXISTS `phpbb_disallow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `disallow_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`disallow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_forums`
--

DROP TABLE IF EXISTS `phpbb_forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_parents` mediumtext COLLATE utf8_bin NOT NULL,
  `forum_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc` text COLLATE utf8_bin NOT NULL,
  `forum_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_desc_uid` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_password` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_style` smallint(4) unsigned NOT NULL DEFAULT '0',
  `forum_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules` text COLLATE utf8_bin NOT NULL,
  `forum_rules_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_rules_uid` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_topics_per_page` tinyint(4) NOT NULL DEFAULT '0',
  `forum_type` tinyint(4) NOT NULL DEFAULT '0',
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_real` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_subject` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_flags` tinyint(4) NOT NULL DEFAULT '32',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_indexing` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_icons` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_sigs` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `prune_next` int(11) unsigned NOT NULL DEFAULT '0',
  `prune_days` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_freq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_lastpost_id` (`forum_last_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_posts`
--

DROP TABLE IF EXISTS `phpbb_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_approved` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_text` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_postcount` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_edit_user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_edit_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `osu_kudosobtained` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `tid_post_time` (`topic_id`,`post_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_ranks`
--

DROP TABLE IF EXISTS `phpbb_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ranks` (
  `rank_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `rank_min` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rank_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_smilies`
--

DROP TABLE IF EXISTS `phpbb_smilies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_smilies` (
  `smiley_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `emotion` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_url` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`smiley_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_topics`
--

DROP TABLE IF EXISTS `phpbb_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_approved` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `topic_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_time_limit` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_replies_real` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_first_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_first_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_subject` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_last_view_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `poll_start` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_length` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_max_options` tinyint(4) NOT NULL DEFAULT '1',
  `poll_last_vote` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `osu_starpriority` smallint(6) NOT NULL DEFAULT '0',
  `osu_lastreplytype` enum('none','creator','bat') COLLATE utf8_bin NOT NULL DEFAULT 'none',
  PRIMARY KEY (`topic_id`),
  KEY `last_post_time` (`topic_last_post_time`),
  KEY `forum_appr_last` (`forum_id`,`topic_approved`,`topic_last_post_id`),
  KEY `fid_time_moved` (`forum_id`,`topic_last_post_time`,`topic_moved_id`),
  KEY `tid_fid_iconid` (`topic_id`,`forum_id`,`icon_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`,`topic_last_post_time`),
  KEY `star_sort` (`forum_id`,`topic_type`,`osu_starpriority`,`topic_last_post_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_topics_track`
--

DROP TABLE IF EXISTS `phpbb_topics_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_topics_track` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_user_group`
--

DROP TABLE IF EXISTS `phpbb_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_leader` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phpbb_users`
--

DROP TABLE IF EXISTS `phpbb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(2) NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '2',
  `user_permissions` mediumtext COLLATE utf8_bin NOT NULL,
  `user_perm_from` mediumint(8) unsigned DEFAULT '0',
  `user_ip` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `username_clean` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_password` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_passchg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_email_hash` bigint(20) NOT NULL DEFAULT '0',
  `user_birthday` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastmark` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpost_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpage` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_confirm_key` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_search` int(11) unsigned NOT NULL DEFAULT '0',
  `user_warnings` tinyint(4) NOT NULL DEFAULT '0',
  `user_last_warning` int(11) unsigned NOT NULL DEFAULT '0',
  `user_login_attempts` tinyint(4) NOT NULL DEFAULT '0',
  `user_inactive_reason` tinyint(2) NOT NULL DEFAULT '0',
  `user_inactive_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_lang` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_timezone` decimal(5,2) NOT NULL DEFAULT '0.00',
  `user_dst` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_dateformat` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i',
  `user_style` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new_privmsg` smallint(4) NOT NULL DEFAULT '0',
  `user_unread_privmsg` smallint(4) NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_message_rules` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_full_folder` int(11) NOT NULL DEFAULT '-3',
  `user_emailtime` int(11) unsigned NOT NULL DEFAULT '0',
  `user_topic_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_topic_sortby_type` char(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_topic_sortby_dir` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'd',
  `user_post_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_post_sortby_type` char(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_post_sortby_dir` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `user_notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_notify_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_notify_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_allow_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_massemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_options` int(11) unsigned NOT NULL DEFAULT '895',
  `user_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_type` tinyint(2) NOT NULL DEFAULT '0',
  `user_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_sig` mediumtext COLLATE utf8_bin NOT NULL,
  `user_sig_bbcode_uid` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_sig_bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_from` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_lastfm` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_lastfm_session` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_twitter` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_msnm` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_jabber` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_website` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_occ` text COLLATE utf8_bin NOT NULL,
  `user_interests` text COLLATE utf8_bin NOT NULL,
  `user_actkey` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_newpasswd` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `osu_mapperrank` float NOT NULL DEFAULT '0',
  `osu_testversion` tinyint(1) NOT NULL DEFAULT '0',
  `osu_subscriber` tinyint(1) NOT NULL DEFAULT '0',
  `osu_subscriptionexpiry` date DEFAULT NULL,
  `osu_kudosavailable` smallint(5) NOT NULL DEFAULT '0',
  `osu_kudosdenied` smallint(5) unsigned NOT NULL DEFAULT '0',
  `osu_kudostotal` smallint(5) NOT NULL DEFAULT '0',
  `country_acronym` char(2) COLLATE utf8_bin NOT NULL DEFAULT '',
  `userpage_post_id` mediumint(8) unsigned DEFAULT NULL,
  `username_previous` varchar(1024) COLLATE utf8_bin DEFAULT NULL,
  `osu_featurevotes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `osu_playstyle` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `osu_playmode` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_clean` (`username_clean`),
  UNIQUE KEY `username_id` (`username`,`user_id`),
  KEY `user_email_hash` (`user_email_hash`),
  KEY `osu_mapperrank` (`osu_mapperrank`),
  KEY `osu_kudostotal` (`osu_kudostotal`),
  KEY `country_acronym` (`country_acronym`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tournament_registrations`
--

DROP TABLE IF EXISTS `tournament_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_registrations` (
  `registration_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `tournament_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `play_mode` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rank_min` int(10) unsigned DEFAULT NULL,
  `rank_max` int(10) unsigned DEFAULT NULL,
  `signup_open` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `signup_close` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tournament_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_profile_customizations`
--

DROP TABLE IF EXISTS `user_profile_customizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile_customizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cover_json` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_profile_customizations_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-04 16:41:57
