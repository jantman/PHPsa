-- MySQL dump 10.10
--
-- Host: localhost    Database: PHPsa
-- ------------------------------------------------------
-- Server version	5.0.26

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
-- Table structure for table `PHPsa_config_module_pages`
--

DROP TABLE IF EXISTS `PHPsa_config_module_pages`;
CREATE TABLE `PHPsa_config_module_pages` (
  `mod_name` varchar(50) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_path` varchar(100) default NULL,
  `page_order` tinyint(4) unsigned default NULL,
  `updated_ts` int(10) unsigned default NULL,
  PRIMARY KEY  (`mod_name`,`page_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PHPsa_config_module_pages`
--

LOCK TABLES `PHPsa_config_module_pages` WRITE;
/*!40000 ALTER TABLE `PHPsa_config_module_pages` DISABLE KEYS */;
INSERT INTO `PHPsa_config_module_pages` VALUES ('Logs','Home','index.php',0,1254927551),('Logs','Viewer','viewer.php',1,1254927551);
/*!40000 ALTER TABLE `PHPsa_config_module_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PHPsa_config_modules`
--

DROP TABLE IF EXISTS `PHPsa_config_modules`;
CREATE TABLE `PHPsa_config_modules` (
  `mod_name` varchar(50) NOT NULL,
  `mod_path` varchar(100) default NULL,
  `mod_order` tinyint(4) unsigned default NULL,
  `mod_is_enabled` tinyint(1) unsigned default '0',
  `updated_ts` int(10) unsigned default NULL,
  PRIMARY KEY  (`mod_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PHPsa_config_modules`
--

LOCK TABLES `PHPsa_config_modules` WRITE;
/*!40000 ALTER TABLE `PHPsa_config_modules` DISABLE KEYS */;
INSERT INTO `PHPsa_config_modules` VALUES ('Logs','modules/logs/',1,1,1254927551);
/*!40000 ALTER TABLE `PHPsa_config_modules` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-10-07 15:13:10
