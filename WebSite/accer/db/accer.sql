-- MySQL dump 10.16  Distrib 10.1.23-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: accer
-- ------------------------------------------------------
-- Server version	10.1.23-MariaDB-9+deb9u1

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
-- Table structure for table `authcookieremember`
--

DROP TABLE IF EXISTS `authcookieremember`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authcookieremember` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) unsigned NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authcookieremember`
--

LOCK TABLES `authcookieremember` WRITE;
/*!40000 ALTER TABLE `authcookieremember` DISABLE KEYS */;
INSERT INTO `authcookieremember` VALUES (4,1,'1=-=-934317f425843979fbd12a3e62ecd16caaafab8bd4ed0271abe3b80c9fd49537356a192b7913b04c54574d18c28d46e6395428ab',1550438403),(5,3,'3=-=-9e8d62eb21e01cddd14690dd674fc6ee3257c4ae0f211ce4f51d3d2c9392deee77de68daecd823babbb58edb1c8e14d7106e83bb',1552503381);
/*!40000 ALTER TABLE `authcookieremember` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authsess`
--

DROP TABLE IF EXISTS `authsess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authsess` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) unsigned NOT NULL,
  `token` varchar(255) NOT NULL,
  `IP` varchar(100) NOT NULL,
  `PHPSESSID` varchar(255) NOT NULL,
  `expire` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authsess`
--

LOCK TABLES `authsess` WRITE;
/*!40000 ALTER TABLE `authsess` DISABLE KEYS */;
INSERT INTO `authsess` VALUES (4,1,'1=-=-9da8123517963d30f21ea9a2a791a01ffad0a8253e68feb958072f41f959f3fc356a192b7913b04c54574d18c28d46e6395428ab','88.139.79.108','4sj8i5uofd1m52lq0aiiq00tc7',1521405455),(5,3,'3=-=-b9eacf539a70f657dbb120b48ec226a8585c5c88e8f85709b7ef2bceade91c6b77de68daecd823babbb58edb1c8e14d7106e83bb','163.5.141.181','jvmvmj2ffj5emusq57pumto8i1',1520971455);
/*!40000 ALTER TABLE `authsess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_user` int(10) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_post` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,1,'Télécharger le jeu : https://accer.ddns.net/download.php','2018-03-18 11:00:52');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `download`
--

DROP TABLE IF EXISTS `download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `download` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IP` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download`
--

LOCK TABLES `download` WRITE;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
INSERT INTO `download` VALUES (1,'88.139.79.108');
/*!40000 ALTER TABLE `download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `erreurs`
--

DROP TABLE IF EXISTS `erreurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `erreurs` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `erreur` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erreurs`
--

LOCK TABLES `erreurs` WRITE;
/*!40000 ALTER TABLE `erreurs` DISABLE KEYS */;
INSERT INTO `erreurs` VALUES (1,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767688'),(2,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767688'),(3,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767688'),(4,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767700'),(5,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767700'),(6,'[2] file_put_contents(/var/www/accer/.cache/source/source.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767700'),(7,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767700'),(8,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767700'),(9,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767700'),(10,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767704'),(11,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767704'),(12,'[2] file_put_contents(/var/www/accer/.cache/report/report.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767704'),(13,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767704'),(14,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767704'),(15,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767704'),(16,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767706'),(17,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767706'),(18,'[2] file_put_contents(/var/www/accer/.cache/progress/progress.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767706'),(19,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767706'),(20,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767707'),(21,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767707'),(22,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767800'),(23,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767800'),(24,'[2] file_put_contents(/var/www/accer/.cache/progress/progress.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767800'),(25,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767800'),(26,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767800'),(27,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767800'),(28,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767804'),(29,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767804'),(30,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767804'),(31,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767894'),(32,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767894'),(33,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767894'),(34,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767897'),(35,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767897'),(36,'[2] file_put_contents(/var/www/accer/.cache/download/download.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767897'),(37,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767897'),(38,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767898'),(39,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767898'),(40,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767902'),(41,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767902'),(42,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767902'),(43,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767905'),(44,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767905'),(45,'[2] file_put_contents(/var/www/accer/.cache/project/project.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767905'),(46,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767905'),(47,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767905'),(48,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767905'),(49,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767907'),(50,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767907'),(51,'[2] file_put_contents(/var/www/accer/.cache/progress/progress.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767907'),(52,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767907'),(53,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767907'),(54,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767907'),(55,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767909'),(56,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767909'),(57,'[2] file_put_contents(/var/www/accer/.cache/download/download.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 58)  at 1517767909'),(58,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767909'),(59,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767909'),(60,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767909'),(61,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767930'),(62,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767930'),(63,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767930'),(64,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767950'),(65,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767950'),(66,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767950'),(67,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767952'),(68,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767952'),(69,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767952'),(70,'[2] mkdir(): Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 14)  at 1517767982'),(71,'[2] mkdir(): No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 53)  at 1517767982'),(72,'[2] file_put_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1517767982'),(73,'[2] session_regenerate_id(): Cannot regenerate session id - session is not active\nFichier : /var/www/accer/class/UserManager.php (ligne 85)  at 1517770203'),(74,'[2] fopen(/var/www/accer/data/maintenance.tmp): failed to open stream: Permission denied\nFichier : /var/www/accer/function/maintenance.php (ligne 45)  at 1517791117'),(75,'[2] fopen(/var/www/accer/data/maintenance.tmp): failed to open stream: Permission denied\nFichier : /var/www/accer/function/maintenance.php (ligne 45)  at 1517791143'),(76,'[2] fopen(/var/www/accer/data/maintenance.tmp): failed to open stream: Permission denied\nFichier : /var/www/accer/function/maintenance.php (ligne 45)  at 1517791150'),(77,'[2] fopen(/var/www/accer/data/maintenance.tmp): failed to open stream: Permission denied\nFichier : /var/www/accer/function/maintenance.php (ligne 45)  at 1517791211'),(78,'[2] fopen(/var/www/accer/data/maintenance.tmp): failed to open stream: Permission denied\nFichier : /var/www/accer/function/maintenance.php (ligne 45)  at 1517791437'),(79,'[8] Undefined index: _admin_maj\nFichier : /var/www/accer/public/index.php (ligne 13)  at 1517791567'),(80,'[2] move_uploaded_file(/var/www/accer/data/shadowminer/report/CahierDesCharges_ACCEr.pdf): failed to open stream: Permission denied\nFichier : /var/www/accer/class/PdfManager.php (ligne 37)  at 1517791825'),(81,'[2] move_uploaded_file(): Unable to move \'/tmp/phpjwoOxF\' to \'/var/www/accer/data/shadowminer/report/CahierDesCharges_ACCEr.pdf\'\nFichier : /var/www/accer/class/PdfManager.php (ligne 37)  at 1517791825'),(82,'[2] file_get_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 42)  at 1517830274'),(83,'[2] file_get_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 42)  at 1517830275'),(84,'[2] file_get_contents(/var/www/accer/.cache/report/report.cache): failed to open stream: Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 44)  at 1517830285'),(85,'[2] file_get_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 42)  at 1517830285'),(86,'[2] file_get_contents(/var/www/accer/.cache/image/1=-=e7d77248ba895137ce6e4b697bc30ed252fba4a7-90.cache): failed to open stream: Permission denied\nFichier : /var/www/accer/class/CacheManager.php (ligne 42)  at 1517830287'),(87,'[2] readfile(/var/www/accer/data/shadowminer/report/CahierDesCharges_ACCEr.pdf): failed to open stream: Permission denied\nFichier : /var/www/accer/class/PdfManager.php (ligne 109)  at 1517830299'),(88,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 133)  at 1517857719'),(89,'[2] imagecreatefrompng(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 110)  at 1517857719'),(90,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 116)  at 1517857719'),(91,'[2] Division by zero\nFichier : /var/www/accer/class/ImageManager.php (ligne 117)  at 1517857719'),(92,'[2] imagecreatetruecolor() expects parameter 2 to be integer, float given\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1517857719'),(93,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 133)  at 1517857720'),(94,'[2] imagecreatefrompng(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 110)  at 1517857720'),(95,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 116)  at 1517857720'),(96,'[2] Division by zero\nFichier : /var/www/accer/class/ImageManager.php (ligne 117)  at 1517857720'),(97,'[2] imagecreatetruecolor() expects parameter 2 to be integer, float given\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1517857720'),(98,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 133)  at 1517857722'),(99,'[2] imagecreatefrompng(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 110)  at 1517857722'),(100,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 116)  at 1517857722'),(101,'[2] Division by zero\nFichier : /var/www/accer/class/ImageManager.php (ligne 117)  at 1517857722'),(102,'[2] imagecreatetruecolor() expects parameter 2 to be integer, float given\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1517857722'),(103,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 133)  at 1517857722'),(104,'[2] imagecreatefrompng(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 110)  at 1517857722'),(105,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 116)  at 1517857722'),(106,'[2] Division by zero\nFichier : /var/www/accer/class/ImageManager.php (ligne 117)  at 1517857722'),(107,'[2] imagecreatetruecolor() expects parameter 2 to be integer, float given\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1517857722'),(108,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 133)  at 1517857723'),(109,'[2] imagecreatefrompng(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 110)  at 1517857723'),(110,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 116)  at 1517857723'),(111,'[2] Division by zero\nFichier : /var/www/accer/class/ImageManager.php (ligne 117)  at 1517857723'),(112,'[2] imagecreatetruecolor() expects parameter 2 to be integer, float given\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1517857723'),(113,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 133)  at 1517857723'),(114,'[2] imagecreatefrompng(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 110)  at 1517857723'),(115,'[2] getimagesize(/var/www/accer/data/image/accer_logo.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 116)  at 1517857723'),(116,'[2] Division by zero\nFichier : /var/www/accer/class/ImageManager.php (ligne 117)  at 1517857723'),(117,'[2] imagecreatetruecolor() expects parameter 2 to be integer, float given\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1517857723'),(118,'[2] move_uploaded_file(/var/www/accer/data/image//9c1b1bea2e87dda17c3f61075a70e9da9278249370ad7cfef2faba3c68c077077a1dd52d046385f27bc854d1390ab4a0cd571d58ba3205fd29dd02f1a3d3ed1d.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 71)  at 1517864155'),(119,'[2] move_uploaded_file(): Unable to move \'/tmp/php3bYLEZ\' to \'/var/www/accer/data/image//9c1b1bea2e87dda17c3f61075a70e9da9278249370ad7cfef2faba3c68c077077a1dd52d046385f27bc854d1390ab4a0cd571d58ba3205fd29dd02f1a3d3ed1d.png\'\nFichier : /var/www/accer/class/ImageManager.php (ligne 71)  at 1517864155'),(120,'[2] move_uploaded_file(/var/www/accer/data/image//380d57ac4f0d174a70cb5c48b8d88f09ee876b5fb818caaa713e1ba40f5d3c7867645c1e86473adf49c61b4519ef00a84112a60f6ae160e543236a55f8df002e.png): failed to open stream: Permission denied\nFichier : /var/www/accer/class/ImageManager.php (ligne 71)  at 1517864898'),(121,'[2] move_uploaded_file(): Unable to move \'/tmp/phpkPEZM5\' to \'/var/www/accer/data/image//380d57ac4f0d174a70cb5c48b8d88f09ee876b5fb818caaa713e1ba40f5d3c7867645c1e86473adf49c61b4519ef00a84112a60f6ae160e543236a55f8df002e.png\'\nFichier : /var/www/accer/class/ImageManager.php (ligne 71)  at 1517864898'),(122,'[8] Undefined index: _admin_maj\nFichier : /var/www/accer/public/index.php (ligne 13)  at 1518101289'),(123,'[8] Undefined index: _admin_maj\nFichier : /var/www/accer/public/index.php (ligne 13)  at 1518106802'),(124,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620494'),(125,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620504'),(126,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620504'),(127,'[2] imagecreatetruecolor(): Invalid image dimensions\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1518620527'),(128,'[2] file_exists() expects parameter 1 to be a valid path, string given\nFichier : /var/www/accer/class/CacheManager.php (ligne 24)  at 1518620534'),(129,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620534'),(130,'[2] file_put_contents() expects parameter 1 to be a valid path, string given\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1518620534'),(131,'[2] imagecreatetruecolor(): Invalid image dimensions\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1518620545'),(132,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620546'),(133,'[2] imagecreatetruecolor(): Invalid image dimensions\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1518620546'),(134,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620548'),(135,'[2] file_put_contents(/var/www/accer/.cache/image/....//....//....//....//....//....//....//....//....//....//....//....//etc/passwd-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1518620548'),(136,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620554'),(137,'[2] file_put_contents(/var/www/accer/.cache/image/C:/boot.ini-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1518620554'),(138,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620554'),(139,'[2] imagecreatetruecolor(): Invalid image dimensions\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1518620554'),(140,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620554'),(141,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620554'),(142,'[2] file_put_contents(/var/www/accer/.cache/image/file:/C:/boot.ini-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1518620554'),(143,'[2] imagecreatetruecolor(): Invalid image dimensions\nFichier : /var/www/accer/class/ImageManager.php (ligne 118)  at 1518620554'),(144,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620554'),(145,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/ImageManager.php (ligne 146)  at 1518620555'),(146,'[2] file_put_contents(/var/www/accer/.cache/image/file:/C:\\boot.ini-90.cache): failed to open stream: No such file or directory\nFichier : /var/www/accer/class/CacheManager.php (ligne 56)  at 1518620555'),(147,'[2] session_regenerate_id(): Cannot regenerate session id - session is not active\nFichier : /var/www/accer/class/UserManager.php (ligne 85)  at 1518899187'),(148,'[2] session_regenerate_id(): Cannot regenerate session id - session is not active\nFichier : /var/www/accer/class/UserManager.php (ligne 85)  at 1518902377'),(149,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/PdfManager.php (ligne 90)  at 1520195923'),(150,'[8] Undefined offset: 1\nFichier : /var/www/accer/class/PdfManager.php (ligne 90)  at 1520195935'),(151,'[8] Use of undefined constant this - assumed \'this\'\nFichier : /var/www/accer/class/DownloadManager.php (ligne 39)  at 1521314103'),(152,'[8] Use of undefined constant exe_name - assumed \'exe_name\'\nFichier : /var/www/accer/class/DownloadManager.php (ligne 39)  at 1521314103'),(153,'[2] readfile(/var/www/accer/data/shadowminer/build/ShadownMiner.beta.exe): failed to open stream: Permission denied\nFichier : /var/www/accer/class/DownloadManager.php (ligne 40)  at 1521314103'),(154,'[4096] Object of class DownloadManager could not be converted to string\nFichier : /var/www/accer/class/DownloadManager.php (ligne 39)  at 1521314211'),(155,'[8] Use of undefined constant exe_name - assumed \'exe_name\'\nFichier : /var/www/accer/class/DownloadManager.php (ligne 39)  at 1521314211'),(156,'[2] readfile(/var/www/accer/data/shadowminer/build/ShadownMiner.beta.exe): failed to open stream: Permission denied\nFichier : /var/www/accer/class/DownloadManager.php (ligne 40)  at 1521314211'),(157,'[2] readfile(/var/www/accer/data/shadowminer/build/ShadownMiner.beta.exe): failed to open stream: Permission denied\nFichier : /var/www/accer/class/DownloadManager.php (ligne 40)  at 1521317066');
/*!40000 ALTER TABLE `erreurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `extension` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'e7d77248ba895137ce6e4b697bc30ed252fba4a7','/var/www/accer/data/image/accer_logo.png','png'),(2,'531397f92e7dd28aeb2b92d6ffe3fed4192693d7','/var/www/accer/data/image/avatar_defaut.jpg','jpg'),(3,'ff38476159937cb1c6fe383711c498cf5bff6a5d','/var/www/accer/data/image//9c1b1bea2e87dda17c3f61075a70e9da9278249370ad7cfef2faba3c68c077077a1dd52d046385f27bc854d1390ab4a0cd571d58ba3205fd29dd02f1a3d3ed1d.png','png'),(4,'4fac303328606e82818cba668cbb4db2214797e6','/var/www/accer/data/image//380d57ac4f0d174a70cb5c48b8d88f09ee876b5fb818caaa713e1ba40f5d3c7867645c1e86473adf49c61b4519ef00a84112a60f6ae160e543236a55f8df002e.png','png'),(5,'fbef60e3d37544f0752e40f97dc9ff3b21d2f608','/var/www/accer/data/image//2a8d9604f04d2fe69384ccf60fa12c88a169fb0a2863410989c9b0c90e45ec2ce4441dc5dc92b268713fc38c6922e58b3e350c84182577301a4c79f3b94a52b6.png','png'),(6,'28099b3bd0638bc11d6bcf968c4cccb98d11522e','/var/www/accer/data/image//ca29a660098a38cbe7fac04d752256e311ffe48c024c273a0429a2cca75d6e87a0cdc860e725c1fb36d65b49a47a5548e3a5bfdae6fba4822c6fff05c8bd7baf.jpg','jpg');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pdf`
--

DROP TABLE IF EXISTS `pdf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdf` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pdf`
--

LOCK TABLES `pdf` WRITE;
/*!40000 ALTER TABLE `pdf` DISABLE KEYS */;
INSERT INTO `pdf` VALUES (2,'02a9e44065e64ce4d9a488c04a760c6957f14215','/var/www/accer/data/shadowminer/report/CahierDesCharges_ACCEr_v2.pdf'),(3,'7028f1effd557c31e4f712422ac3923988a5d93f','/var/www/accer/data/shadowminer/report/rapport1.pdf');
/*!40000 ALTER TABLE `pdf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `progress` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `etat` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` VALUES (1,1,'Site Web','Création des pages et de l\'api','2018-02-05 01:51:20',75),(2,1,'Mise en place du serveur','sur raspberry pi 3B:\r\n- installation serveur et base de données\r\n- création d\'un compte no-ip avec un sous domaine (accer.ddns.net)','2018-02-05 01:51:54',100),(4,1,'Préfabs joueurs','pour le solo et le multi','2018-02-21 17:07:52',50),(5,1,'Préfabs de map','porte, sol, flamme, piège ...','2018-02-24 18:01:38',50),(6,1,'Création de quelques niveaux',' de 2 à 5','2018-02-25 17:01:53',10),(7,1,'Network','mise en place du serveur multijoueur (PHOTON)','2018-03-16 16:55:55',40);
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ID_user` int(10) unsigned NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `pdf_content` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (3,1,'Cahier des Charges ACCEr','Voici le cahier des charges du groupe ACCEr pour le projet de S2 à EPITTA.\r\nLe dévellopement du jeu Shadow Miner pourra être suivi sur ce site.\r\n\r\nACCEr','2018-02-16 20:47:25','2'),(4,1,'Rapport de soutenance n°1','Voici notre rapport de soutenance.\r\nNous présentons l\'avancement du jeu ainsi que les étapes futurs.\r\n\r\nACCEr','2018-03-16 16:58:30','3');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_register` datetime NOT NULL,
  `avatar_path` varchar(255) DEFAULT '2',
  `description` text,
  `rank` enum('user','admin','webmaster') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'FARINAZZO','Cédric','cedric.farinazzo@epita.fr','a99885e8ab226ebf4604b741113db99dd9c3ff8097301f143cd9bca32bd5bfc232007d851d2ecd0936ff0e7504551f28d45867b7b291acff506518c5a406872c','2018-02-16 19:18:55','5','chef de projet','webmaster'),(2,'Claudel','Antoine','antoine.claudel@hotmail.fr','c1f7b255974d4138524754937a79ae3bbc705ddf579ff4679cc48ecaf348610b4ddafc4bade4f22bf81c411b11b6232f85113237c6a2fb7d645b09e4063e48a1','2018-02-23 14:07:41','6','Le plus beau des beau gosses sur Terre','admin'),(3,'Grizzi','Edgar','edgar.grizzi@epita.fr','37a4e3a4a39bfa7fe3f922ecde33b1ebff8d920c3949686b7af9660a0a120f00957aaeaa3a126dd6b785ec0a5f3bdee3d57c5ea61da5ba4485dcc54a50ffc518','2018-03-13 19:56:21','2',NULL,'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-18 20:38:38
