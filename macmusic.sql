-- MySQL dump 10.11
--
-- Host: localhost    Database: macmusic
-- ------------------------------------------------------
-- Server version	5.0.75-0ubuntu10.5

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
-- Table structure for table `composer_piece_link`
--

DROP TABLE IF EXISTS `composer_piece_link`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `composer_piece_link` (
  `id` int(8) NOT NULL auto_increment,
  `composer_id` int(8) NOT NULL,
  `piece_id` int(8) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_composer_piece_link_composer_id` (`composer_id`),
  KEY `FK_composer_piece_link_piece_id` (`piece_id`),
  CONSTRAINT `FK_composer_piece_link_composer_id` FOREIGN KEY (`composer_id`) REFERENCES `composers` (`id`),
  CONSTRAINT `FK_composer_piece_link_piece_id` FOREIGN KEY (`piece_id`) REFERENCES `pieces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `composer_piece_link`
--

LOCK TABLES `composer_piece_link` WRITE;
/*!40000 ALTER TABLE `composer_piece_link` DISABLE KEYS */;
INSERT INTO `composer_piece_link` VALUES (3,9,18),(5,11,21),(6,12,22),(7,13,23),(10,15,26),(11,16,28),(12,17,30),(13,19,31),(14,6,32),(15,14,34),(16,6,35),(17,20,39),(18,21,40),(19,22,41),(21,24,43),(22,23,44),(23,25,46),(24,26,47),(25,28,48),(26,27,48),(27,29,49),(28,30,50),(29,31,51),(30,32,52),(32,34,54),(33,33,54),(34,35,56),(35,36,57),(36,37,58),(37,38,59),(38,39,60),(39,40,61),(40,41,62),(41,42,63),(42,43,64),(43,44,64),(44,45,65),(45,46,66),(46,23,67),(47,23,68),(48,47,69),(49,48,70),(50,49,71),(51,50,72),(52,51,73),(53,52,74),(54,53,75),(55,15,76),(56,72,77),(57,54,78),(58,55,79),(59,56,80),(60,57,81),(61,13,82),(62,58,83),(63,49,84),(64,59,85),(65,60,86),(66,62,88),(67,12,89),(68,63,90),(69,64,92),(70,65,93),(71,66,94),(72,38,95),(73,51,96),(74,67,97),(75,6,98),(76,56,99),(77,68,100),(78,37,101),(79,69,105),(80,24,106),(81,70,107),(82,71,107),(83,23,108),(84,10,109),(85,1,110),(86,2,111),(87,3,112),(88,4,114),(89,5,115),(90,6,116),(91,7,117),(92,8,118),(93,57,123);
/*!40000 ALTER TABLE `composer_piece_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `composers`
--

DROP TABLE IF EXISTS `composers`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `composers` (
  `id` int(8) NOT NULL auto_increment,
  `fname` varchar(50) default NULL,
  `mname` varchar(50) default NULL,
  `lname` varchar(50) default NULL,
  `birth` int(8) default NULL,
  `death` int(8) default NULL,
  `era_id` int(8) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FK_composers_era_id` (`era_id`),
  CONSTRAINT `FK_composers_era_id` FOREIGN KEY (`era_id`) REFERENCES `era` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `composers`
--

LOCK TABLES `composers` WRITE;
/*!40000 ALTER TABLE `composers` DISABLE KEYS */;
INSERT INTO `composers` VALUES (1,'Johannes',NULL,'Brahms',1833,1897,5,'2011-05-06 13:44:31'),(2,'Joseph',NULL,'Olivadoti',1893,1977,6,'2011-05-06 13:44:31'),(3,'Bill',NULL,'Thomas',NULL,NULL,6,'2011-05-06 13:44:31'),(4,'John',NULL,'Hosay',NULL,NULL,6,'2011-05-06 13:44:31'),(5,'Joseph',NULL,'Compello',NULL,NULL,6,'2011-05-06 13:44:31'),(6,'Frank','William','Erickson',1923,1996,6,'2011-05-06 13:44:31'),(7,'John',NULL,'O\'neill',1932,NULL,6,'2011-05-06 13:44:31'),(8,'George','Philipp','Telemann',1681,1767,3,'2011-05-06 13:44:31'),(9,'David','R.','Gillingham',1947,NULL,6,'2011-05-06 13:44:31'),(10,'Andre',NULL,'Jutras',NULL,NULL,6,'2011-05-06 13:44:31'),(11,'Andrew',NULL,'Boysen Jr.',1968,NULL,6,'2011-05-06 13:44:31'),(12,'Frank',NULL,'Ticheli',1958,NULL,6,'2011-05-06 13:44:31'),(13,'Catherine',NULL,'McMichael',1954,NULL,6,'2011-05-06 13:44:31'),(14,'Bob',NULL,'Merrill',1921,1998,6,'2011-05-06 13:44:31'),(15,'Brian',NULL,'Balmages',1975,NULL,6,'2011-05-06 13:44:31'),(16,'Andrew',NULL,'Balent',NULL,NULL,NULL,'2011-05-06 13:44:31'),(17,'Harry',NULL,'Gregson-Williams',1961,NULL,6,'2011-05-06 13:44:31'),(18,'Carl','Maria','von Weber',1786,1826,5,'2011-05-06 13:44:31'),(19,'Igor',NULL,'Stravinsky',1882,1971,6,'2011-05-06 13:44:31'),(20,'Steven',NULL,'Bryant',1972,NULL,6,'2011-05-06 13:44:31'),(21,'Alfred',NULL,'Reed',1921,2005,6,'2011-05-06 13:44:31'),(22,'James','L.','Hosay',1959,NULL,6,'2011-05-06 13:44:31'),(23,'John',NULL,'Williams',1932,NULL,6,'2011-05-06 13:44:31'),(24,'John','Philip','Sousa',1854,1932,5,'2011-05-06 13:44:31'),(25,'Ludwig',NULL,'van Beethoven',1770,1827,4,'2011-05-06 13:44:31'),(26,'Robert',NULL,'Washburn',1928,NULL,6,'2011-05-06 13:44:31'),(27,'John',NULL,'Davenport',NULL,NULL,NULL,'2011-05-06 13:44:31'),(28,'Eddie',NULL,'Cooley',NULL,NULL,NULL,'2011-05-06 13:44:31'),(29,'Dmitri',NULL,'Shostakovich',1906,1975,6,'2011-05-06 13:44:31'),(30,'Percy','Aldridge','Grainger',1882,1961,6,'2011-05-06 13:44:31'),(31,'Eric',NULL,'Whitacre',1970,NULL,6,'2011-05-06 13:44:31'),(32,'Mark',NULL,'Williams',NULL,NULL,NULL,'2011-05-06 13:44:31'),(33,'Hugh',NULL,'Martin',1914,2011,6,'2011-05-06 13:44:31'),(34,'Ralph',NULL,'Blane',1914,1995,6,'2011-05-06 13:44:31'),(35,'Howard',NULL,'Rowe Jr.',NULL,NULL,NULL,'2011-05-06 13:44:31'),(36,'Brian',NULL,'Setzer',NULL,NULL,NULL,'2011-05-06 13:44:31'),(37,'Wolfgang','Amadeus','Mozart',1756,1791,4,'2011-05-06 13:44:31'),(38,'Robert','W.','Smith',1958,NULL,6,'2011-05-06 13:44:31'),(39,'John','Barnes','Chance',1932,1972,6,'2011-05-06 13:44:31'),(40,'John',NULL,'Massari',1957,NULL,6,'2011-05-06 13:44:31'),(41,'Alex',NULL,'Lithgow',1870,1929,NULL,'2011-05-06 13:44:31'),(42,'James',NULL,'Swearingen',NULL,NULL,NULL,'2011-05-06 13:44:31'),(43,'Edward',NULL,'Pola',NULL,NULL,NULL,'2011-05-06 13:44:31'),(44,'George',NULL,'Wyle',NULL,NULL,NULL,'2011-05-06 13:44:31'),(45,'David',NULL,'Gorham',NULL,NULL,NULL,'2011-05-06 13:44:31'),(46,'Johann','Sebastian','Bach',1685,1750,3,'2011-05-06 13:44:31'),(47,'Bruce',NULL,'Pearson',NULL,NULL,NULL,'2011-05-06 13:44:31'),(48,'Harry',NULL,'Sommers',1925,1999,6,'2011-05-06 13:44:31'),(49,'Ralph','Vaughan','Williams',1872,1958,6,'2011-05-06 13:44:31'),(50,'Ernesto',NULL,'Lecuona',1895,1963,6,'2011-05-06 13:44:31'),(51,'Elliot','Del','Borgo',1938,NULL,6,'2011-05-06 13:44:31'),(52,'Eric',NULL,'Osterling',1926,2005,6,'2011-05-06 13:44:31'),(53,'Jay',NULL,'Chattaway',1946,NULL,6,'2011-05-06 13:44:31'),(54,'Giacomo',NULL,'Puccini',1858,1924,5,'2011-05-06 13:44:31'),(55,'Kent',NULL,'Kennan',1913,2003,6,'2011-05-06 13:44:31'),(56,'Clare',NULL,'Grundman',1996,NULL,6,'2011-05-06 13:44:31'),(57,'Adolphe',NULL,'Adam',1803,1856,5,'2011-06-09 02:12:17'),(58,'Charles',NULL,'Gounod',1818,1893,5,'2011-05-06 13:44:31'),(59,'Jack',NULL,'Stamp',NULL,NULL,NULL,'2011-05-06 13:44:31'),(60,'Samuel','R.','Hazo',1966,NULL,6,'2011-05-06 13:44:31'),(61,'N.',NULL,'Rimsky-Korsakov',1844,1908,5,'2011-05-06 13:44:31'),(62,'Elena','Roussanova','Lucas',NULL,NULL,6,'2011-05-06 13:44:31'),(63,'Brian',NULL,'West',NULL,NULL,6,'2011-05-06 13:44:31'),(64,'John',NULL,'O\'Reilly',1940,NULL,6,'2011-05-06 13:44:31'),(65,'Leroy',NULL,'Anderson',1908,1975,6,'2011-05-06 13:44:31'),(66,'Carl',NULL,'Strommen',NULL,NULL,NULL,'2011-05-06 13:44:31'),(67,'Caesar',NULL,'Giovannini',1925,NULL,6,'2011-05-06 13:44:31'),(68,'Felix',NULL,'Mendelssohn',1809,1847,5,'2011-05-06 13:44:31'),(69,'John','H.','Hopkins',1820,1891,5,'2011-05-06 13:44:31'),(70,'John',NULL,'Lennon',1940,1980,6,'2011-05-06 13:44:31'),(71,'Paul',NULL,'McCartney',1942,NULL,6,'2011-05-06 13:44:31'),(72,'Hans',NULL,'Zimmer',1957,NULL,6,'2011-05-06 13:44:31');
/*!40000 ALTER TABLE `composers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ensemble`
--

DROP TABLE IF EXISTS `ensemble`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ensemble` (
  `id` int(8) NOT NULL,
  `name` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ensemble`
--

LOCK TABLES `ensemble` WRITE;
/*!40000 ALTER TABLE `ensemble` DISABLE KEYS */;
INSERT INTO `ensemble` VALUES (1,'Concert Band'),(2,'Strings'),(3,'Symphony'),(4,'Stage Band'),(5,'Vocal'),(6,'Guitar'),(7,'Keyboard'),(8,'Orchestra'),(9,'Not Available');
/*!40000 ALTER TABLE `ensemble` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `era`
--

DROP TABLE IF EXISTS `era`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `era` (
  `id` int(8) NOT NULL auto_increment,
  `era` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `era`
--

LOCK TABLES `era` WRITE;
/*!40000 ALTER TABLE `era` DISABLE KEYS */;
INSERT INTO `era` VALUES (1,'Medieval'),(2,'Renaissance'),(3,'Baroque'),(4,'Classical'),(5,'Romantic'),(6,'20th Century'),(7,'Not Available');
/*!40000 ALTER TABLE `era` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `piece_description`
--

DROP TABLE IF EXISTS `piece_description`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `piece_description` (
  `id` int(8) NOT NULL auto_increment,
  `piece_id` int(8) NOT NULL,
  `description` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `FK_piece_description_piece_id` (`piece_id`),
  CONSTRAINT `FK_piece_description_piece_id` FOREIGN KEY (`piece_id`) REFERENCES `pieces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `piece_description`
--

LOCK TABLES `piece_description` WRITE;
/*!40000 ALTER TABLE `piece_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `piece_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pieces`
--

DROP TABLE IF EXISTS `pieces`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pieces` (
  `id` int(8) NOT NULL auto_increment,
  `title` varchar(75) NOT NULL,
  `arranger` varchar(50) default NULL,
  `grade` double default NULL,
  `duration` varchar(50) default NULL,
  `ensemble_id` int(8) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_pieces_ensemble_id` (`ensemble_id`),
  CONSTRAINT `FK_pieces_ensemble_id` FOREIGN KEY (`ensemble_id`) REFERENCES `ensemble` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pieces`
--

LOCK TABLES `pieces` WRITE;
/*!40000 ALTER TABLE `pieces` DISABLE KEYS */;
INSERT INTO `pieces` VALUES (18,'At Morning\'s First Light','',3,'00:03:50',1),(21,'Branden\'s Rainbow','',4,'00:11:25',1),(22,'Cajun Folk Song','',3,'00:06:42',1),(23,'Cape Breton Postcard','',3,'00:07:00',1),(26,'Chant and Savage Dances','',2.5,'00:04:10',1),(27,'Chant Rituals','Elliot Del Borgo',3,'00:06:09',1),(28,'Chorale and Festival March','',NULL,NULL,1),(29,'A Christmas Fantasia','John Edmondson',2.5,'00:02:30',1),(30,'The Chronicles of Narnia','',3,NULL,1),(31,'Danse Infernale','Merle J. Isaac',5,'00:03:15',1),(32,'Deep River Suite','',4,NULL,1),(33,'Box Office Blockbusters','Jay Bocook',NULL,NULL,1),(34,'Carnival Selection','',NULL,NULL,1),(35,'Chaconne','',NULL,NULL,1),(36,'Delmar Celebration','John Edmondson',NULL,NULL,1),(38,'Disney at the Movie','John Higgins',3,NULL,1),(39,'Dusk','',4,'00:05:15',1),(40,'El Camino Real','',5,'00:09:30',1),(41,'Epic Fantasy on \"We Three Kings\"','',1.5,'00:03:20',1),(43,'Fairest of the Fair','',2.5,'00:03:37',1),(44,'Theme from \"E. T.\"','James D. Ployhar',NULL,NULL,1),(45,'Fanfare Prelude on \"God of Our Fathers\"','Jim Curnow',NULL,NULL,1),(46,'Fanfare Prelude on \"Ode to Joy\"','Jim Curnow',NULL,'00:02:55',1),(47,'Fantasia on \"God Rest You Merry, Gentlemen\"','',NULL,NULL,1),(48,'Fever','',2,'00:02:28',1),(49,'Folk Dances','H. Roberts Reynolds',NULL,NULL,1),(50,'Themes from \"Green Bushes\"','Larry D. Daehn',NULL,NULL,1),(51,'Ghost Train','',NULL,NULL,1),(52,'Greenwillow Portrait','',NULL,'00:03:05',1),(54,'Have Yourself a Merry Little Christmas','',NULL,'00:03:46',1),(55,'Home for Christmas','Seth Markham',NULL,'00:03:56',1),(56,'Honor and Empire','',2,'00:02:55',1),(57,'If You Can\'t Rock Me','Paul Murtha',3,NULL,1),(58,'\"Il Re Pastore\" Overture','Clifford P. Barnes',NULL,NULL,1),(59,'Incantation','',3,'00:05:23',1),(60,'Incantation and Dance','',5,'00:07:23',1),(61,'Intimita','',5,'00:08:15',1),(62,'Invercargill','Calvin Custer',3,NULL,1),(63,'Invicta','',3,'00:05:30',1),(64,'It\'s the Most Wonderful Time of the Year','Chris Sharp',4,'00:02:00',1),(65,'Jana\'s Dance','',2.5,'00:03:54',1),(66,'Jesu, Joy of Man\'s Desiring','Philip Sparke',3,'00:04:15',1),(67,'John Williams: Four Symphonic Themes','Paul Lavender',NULL,NULL,1),(68,'John Williams: The Symphonic Marches','John Higgins',NULL,NULL,1),(69,'Joyance','',2.5,NULL,1),(70,'Little Suite for String Orchestra','',NULL,NULL,1),(71,'Linden Lea','',NULL,NULL,1),(72,'MalagueÃ±a','Sammy Nestico',NULL,NULL,1),(73,'Marche Royale','',4,'00:04:30',1),(74,'March for a Festive Occasion','',NULL,'00:02:25',1),(75,'Mazama','',NULL,NULL,1),(76,'Midnight on Main Street','',5,NULL,1),(77,'Music From Gladiator','John Wasson',3,'00:04:43',1),(78,'Nessun Dorma','',NULL,NULL,1),(79,'Night Soliloquy','',8,'00:04:38',1),(80,'Normandy','',3,'00:04:15',1),(81,'O Holy Night','Calvin Custer',4,NULL,1),(82,'Pax','',2,'00:03:20',1),(83,'Petite Symphonie','',4,'00:19:30',1),(84,'Rhosymedre','Walter Beeler',4,'00:04:00',1),(85,'Ricercamp','',5,'00:06:45',1),(86,'Rivers','',2,'00:04:35',1),(87,'Russian Easter Overture','',NULL,'00:04:30',1),(88,'Russian Folk Dance','',1.5,'00:02:33',1),(89,'Sanctuary','',5,'00:09:30',1),(90,'Sandy Bay March','',2,'00:02:15',1),(91,'Serenade in C','',NULL,NULL,1),(92,'Skye Boat Song','',1,'00:03:00',1),(93,'Sleigh Ride','',4,'00:03:00',1),(94,'Storm Mountain Jubilee','',1,'00:01:55',1),(95,'Symphonic Festival','',4,NULL,1),(96,'Symphonic Legend','',4,NULL,1),(97,'Symphony In One Movement','Wayne Robinson',3,NULL,1),(98,'Toccata for Band','',NULL,NULL,1),(99,'Three Carols for Christmas','',NULL,NULL,1),(100,'Three Chorales for Band','Richard Landes',NULL,NULL,1),(101,'Trauermusik','Eric Osterling',NULL,'00:06:20',1),(102,'Tryptich','Elliot Del Borgo',3,NULL,1),(103,'Twas in the Moon of Wintertime','Robert W. Smith',NULL,NULL,1),(104,'Ukrainian Bell Carol','Richard L. Saucedo',3,'00:01:47',1),(105,'We Three Kings of Orient Are','James D. Ployhar',NULL,NULL,1),(106,'The White Rose March','Keith Brion',4,'00:03:00',1),(107,'Yesterday','Caesar Giovannini',NULL,'00:04:55',1),(108,'Young Person\'s Guide to John Williams','Jay Bocook',3,'00:05:32',1),(109,'A Barrie North Celebration','',4,'00:07:32',1),(110,'Academic Festival Overture','V. F. Safranek',NULL,NULL,1),(111,'Air Waves','',3,'00:03:00',1),(112,'All Around the Circle','',3,'00:03:15',1),(113,'All the Pretty Little Horses','',1,'00:02:30',1),(114,'Along the Caney Fork','',2,'00:03:30',1),(115,'Antiquitus','',NULL,NULL,1),(116,'American Christmas Festival','',NULL,NULL,1),(117,'An April Overture','',NULL,NULL,1),(118,'Aria','Larry D. Daehn',2,NULL,1),(119,'testing','',NULL,NULL,9),(120,'testing','',NULL,NULL,9),(121,'testing','',NULL,NULL,9),(122,'testing','',NULL,NULL,9),(123,'testing','',NULL,NULL,9);
/*!40000 ALTER TABLE `pieces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(8) NOT NULL auto_increment,
  `login` varchar(16) character set latin1 collate latin1_bin NOT NULL,
  `password` varchar(64) character set latin1 collate latin1_bin NOT NULL,
  `fname` varchar(32) collate utf8_unicode_ci default NULL,
  `lname` varchar(32) collate utf8_unicode_ci default NULL,
  `isactive` int(50) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'MacMusic','9e376d9a6d2fe72adb4a6b5459ebbc4b','Admin','Admin',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-09 13:40:03
