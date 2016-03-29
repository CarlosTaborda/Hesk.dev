-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: hesk
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb8u1

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
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `id_equipo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `asignado_a` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sucursal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES ('0','No existe equipo','Es una entrada por defecto','2016-03-01','Nadie','102');
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `observacion`
--

DROP TABLE IF EXISTS `observacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `observacion` (
  `id_observacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `id_equipo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `tema` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fotografias` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_observacion`),
  KEY `observacion_ticket` (`id_ticket`),
  KEY `observacion_equipo` (`id_equipo`),
  CONSTRAINT `ObservacionEquipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observacion`
--

LOCK TABLES `observacion` WRITE;
/*!40000 ALTER TABLE `observacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `observacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursal`
--

LOCK TABLES `sucursal` WRITE;
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT INTO `sucursal` VALUES (102,'PRI'),(103,'COR'),(104,'CIE'),(105,'MLI'),(106,'PLA'),(107,'SAB'),(108,'SIN'),(109,'GRA'),(110,'PBE'),(111,'VIL'),(112,'TAU'),(113,'PGA'),(114,'PBO'),(115,'PLO'),(116,'SEV'),(117,'CHI'),(119,'CAL'),(120,'AGU'),(121,'BAR'),(123,'TUL'),(124,'PER'),(125,'PER'),(126,'PER'),(127,'PER'),(128,'VIR'),(130,'SRO'),(131,'DQS'),(133,'ARM'),(135,'MAN'),(136,'MAN'),(137,'DOR'),(138,'MAG'),(139,'VIL'),(140,'IBA'),(141,'SIN'),(142,'MON'),(143,'IBA'),(144,'ACA'),(148,'CER'),(149,'QUI'),(150,'CER'),(151,'CAR'),(152,'ARM'),(153,'SAH'),(154,'LOR'),(155,'YOP'),(156,'BOG'),(157,'AGU'),(158,'ESP'),(159,'MAR'),(160,'VIL'),(195,'SIN');
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `email_responsable` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `ticket_sucursal` (`id_sucursal`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1418195263,'Andres Olarte','carlos.aguirre@lagobo.com.co','nuevo','oportudata',102,'');
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (3,'Carlos Felipe Aguirre Taborda','carlos.aguirre@lagobo.com.co','32879f25bd72ea0ffb187d8f9bd1499b7a3ed1dd','adm','hardware redes aurora otro ',1),(4,'Carlos Felipe Aguirre Taborda','carlos.aguirre@lagobo.com.co','32879f25bd72ea0ffb187d8f9bd1499b7a3ed1dd','adm','hardware redes aurora otro ',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-27 21:51:15
