-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: us-cdbr-azure-central-a.cloudapp.net    Database: CS3380-ajwc5f
-- ------------------------------------------------------
-- Server version	5.5.40-log

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
-- Table structure for table `pilot`
--

DROP TABLE IF EXISTS `pilot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pilot` (
  `fname` varchar(15) DEFAULT NULL,
  `lname` varchar(15) NOT NULL,
  `license_num` int(11) NOT NULL AUTO_INCREMENT,
  `birthdate` datetime NOT NULL,
  PRIMARY KEY (`license_num`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pilot`
--

LOCK TABLES `pilot` WRITE;
/*!40000 ALTER TABLE `pilot` DISABLE KEYS */;
INSERT INTO `pilot` VALUES ('Tyroil','Smoochie',1,'1995-05-09 00:00:00'),('Javaris Jamar','Javarison',11,'1983-10-20 00:00:00'),('Ibrahim','Moizoos',21,'1989-04-29 00:00:00'),('Xmus Jaxon','Flaxton',31,'1980-06-08 00:00:00'),('Hingle','McCringleberry',41,'1985-03-27 00:00:00'),('Ozamataz','Buckshank',51,'1988-10-28 00:00:00'),('Saggitariutt','Jefferspin',61,'1993-08-19 00:00:00'),('X-Wing','@Aliciousness',71,'1991-05-17 00:00:00'),('T.J. A.J. R.J.','Backslashin',81,'1988-12-21 00:00:00'),('Dan','Jones',91,'1992-01-04 00:00:00');
/*!40000 ALTER TABLE `pilot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plane`
--

DROP TABLE IF EXISTS `plane`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plane` (
  `tail_num` varchar(10) NOT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `owner_license_num` int(11) DEFAULT NULL,
  `num_engines` int(11) DEFAULT NULL,
  PRIMARY KEY (`tail_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plane`
--

LOCK TABLES `plane` WRITE;
/*!40000 ALTER TABLE `plane` DISABLE KEYS */;
INSERT INTO `plane` VALUES ('A123','Boeing','747',1,4),('B562','Boeing','747SP',3,4),('B821','CoolPlanes','777',9,2),('C453','Boeing','747-400',2,4),('C840','Boeing','787',10,2),('D584','Boeing','767',6,2),('E236','Boeing','E-767',7,4),('E901','Incom','T-65 X-wing',4,4);
/*!40000 ALTER TABLE `plane` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-14 20:56:50
