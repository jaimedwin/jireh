-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: jireh
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1:10.3.22+maria~bionic

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
-- Table structure for table `actuacionproceso`
--

DROP TABLE IF EXISTS `actuacionproceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacionproceso` (
  `actuacionproceso_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actuacionproceso_fechaactuacion` date NOT NULL,
  `actuacionproceso_actuacion` char(250) NOT NULL,
  `actuacionproceso_anotacion` varchar(1000) DEFAULT NULL,
  `actuacionproceso_nombredocumento` char(255) NOT NULL,
  `actuacionproceso_fechainiciatermino` date DEFAULT NULL,
  `actuacionproceso_fechafinalizatermino` date DEFAULT NULL,
  `actuacionproceso_fecharegistro` date NOT NULL,
  `proceso_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`actuacionproceso_id`),
  KEY `actuacionproceso_FK` (`proceso_id`),
  CONSTRAINT `actuacionproceso_FK` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`proceso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuacionproceso`
--

LOCK TABLES `actuacionproceso` WRITE;
/*!40000 ALTER TABLE `actuacionproceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `actuacionproceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `carrera_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carrera_abreviatura` char(10) NOT NULL,
  `carrera_descripción` char(50) NOT NULL,
  `fuerza_id` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`carrera_id`),
  UNIQUE KEY `carrera_abreviatura` (`carrera_abreviatura`),
  KEY `FK_carrera_fuerza` (`fuerza_id`),
  CONSTRAINT `carrera_FK` FOREIGN KEY (`fuerza_id`) REFERENCES `fuerza` (`fuerza_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudadproceso`
--

DROP TABLE IF EXISTS `ciudadproceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudadproceso` (
  `ciudadproceso_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ciudadproceso_nombre` varchar(500) NOT NULL,
  PRIMARY KEY (`ciudadproceso_id`),
  UNIQUE KEY `ciudadproceso_nombre` (`ciudadproceso_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudadproceso`
--

LOCK TABLES `ciudadproceso` WRITE;
/*!40000 ALTER TABLE `ciudadproceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudadproceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clienteproceso`
--

DROP TABLE IF EXISTS `clienteproceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clienteproceso` (
  `clienteproceso_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `personanatural_id` int(10) unsigned NOT NULL,
  `proceso_id` int(10) unsigned NOT NULL,
  `tipodemanda_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`clienteproceso_id`),
  KEY `clienteproceso_FK` (`personanatural_id`),
  KEY `clienteproceso_FK_1` (`proceso_id`),
  KEY `clienteproceso_FK_2` (`tipodemanda_id`),
  CONSTRAINT `clienteproceso_FK` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`),
  CONSTRAINT `clienteproceso_FK_1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`proceso_id`),
  CONSTRAINT `clienteproceso_FK_2` FOREIGN KEY (`tipodemanda_id`) REFERENCES `tipodemanda` (`tipodemanda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clienteproceso`
--

LOCK TABLES `clienteproceso` WRITE;
/*!40000 ALTER TABLE `clienteproceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `clienteproceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato` (
  `contrato_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_ruta` char(250) NOT NULL,
  `contrato_valor` bigint(20) unsigned NOT NULL,
  `personanatural_id` int(10) unsigned NOT NULL,
  `tipocontrato_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`contrato_id`),
  KEY `contrato_FK` (`personanatural_id`),
  KEY `contrato_FK_1` (`tipocontrato_id`),
  CONSTRAINT `contrato_FK` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`),
  CONSTRAINT `contrato_FK_1` FOREIGN KEY (`tipocontrato_id`) REFERENCES `tipocontrato` (`tipocontrato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato`
--

LOCK TABLES `contrato` WRITE;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `corporacion`
--

DROP TABLE IF EXISTS `corporacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corporacion` (
  `corporacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `corporacion_nombre` char(100) NOT NULL,
  `corporacion_correonotificacion` varchar(320) DEFAULT NULL,
  PRIMARY KEY (`corporacion_id`),
  UNIQUE KEY `corporacion_nombre` (`corporacion_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corporacion`
--

LOCK TABLES `corporacion` WRITE;
/*!40000 ALTER TABLE `corporacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `corporacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `correo`
--

DROP TABLE IF EXISTS `correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `correo` (
  `correo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `correo_electronico` varchar(320) NOT NULL,
  `correo_principal` tinyint(1) NOT NULL DEFAULT 0,
  `personanatural_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`correo_id`),
  UNIQUE KEY `correo_electronico` (`correo_electronico`),
  KEY `correo_FK` (`personanatural_id`),
  CONSTRAINT `correo_FK` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correo`
--

LOCK TABLES `correo` WRITE;
/*!40000 ALTER TABLE `correo` DISABLE KEYS */;
/*!40000 ALTER TABLE `correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `documento_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `documento_nombrearchivo` char(250) NOT NULL,
  `tipodocumento_id` int(10) unsigned NOT NULL,
  `personanatural_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`documento_id`),
  KEY `FK__tipodocumento` (`tipodocumento_id`),
  KEY `documento_FK_1` (`personanatural_id`),
  CONSTRAINT `documento_FK` FOREIGN KEY (`tipodocumento_id`) REFERENCES `tipodocumento` (`tipodocumento_id`),
  CONSTRAINT `documento_FK_1` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eps`
--

DROP TABLE IF EXISTS `eps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eps` (
  `eps_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eps_abreviatura` char(25) NOT NULL,
  `eps_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`eps_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eps`
--

LOCK TABLES `eps` WRITE;
/*!40000 ALTER TABLE `eps` DISABLE KEYS */;
/*!40000 ALTER TABLE `eps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `estado_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado_descripcion` char(50) NOT NULL,
  PRIMARY KEY (`estado_id`),
  UNIQUE KEY `estado_UN` (`estado_descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expedicion`
--

DROP TABLE IF EXISTS `expedicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expedicion` (
  `expedicion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expedicion_lugar` varchar(50) NOT NULL,
  PRIMARY KEY (`expedicion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expedicion`
--

LOCK TABLES `expedicion` WRITE;
/*!40000 ALTER TABLE `expedicion` DISABLE KEYS */;
/*!40000 ALTER TABLE `expedicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fondodepension`
--

DROP TABLE IF EXISTS `fondodepension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fondodepension` (
  `fondodepension_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fondodepension_abreviatura` char(15) NOT NULL,
  `fondodepension_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`fondodepension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fondodepension`
--

LOCK TABLES `fondodepension` WRITE;
/*!40000 ALTER TABLE `fondodepension` DISABLE KEYS */;
/*!40000 ALTER TABLE `fondodepension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuerza`
--

DROP TABLE IF EXISTS `fuerza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuerza` (
  `fuerza_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fuerza_abreviatura` char(10) NOT NULL,
  `fuerza_descripcion` char(250) NOT NULL,
  PRIMARY KEY (`fuerza_id`),
  UNIQUE KEY `fuerza_abreviatura` (`fuerza_abreviatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuerza`
--

LOCK TABLES `fuerza` WRITE;
/*!40000 ALTER TABLE `fuerza` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuerza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grado`
--

DROP TABLE IF EXISTS `grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grado` (
  `grado_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grado_abreviatura` char(10) NOT NULL,
  `grado_descripcion` char(50) NOT NULL,
  `carrera_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`grado_id`),
  UNIQUE KEY `grado_abreviatura` (`grado_abreviatura`),
  KEY `FK__carrera` (`carrera_id`),
  CONSTRAINT `grado_FK` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`carrera_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado`
--

LOCK TABLES `grado` WRITE;
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `pago_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pago_fecha` date NOT NULL,
  `pago_abono` bigint(20) NOT NULL,
  `pago_nrecibo` varchar(20) DEFAULT NULL,
  `contrato_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pago_id`),
  UNIQUE KEY `pago_nrecibo` (`pago_nrecibo`),
  KEY `FK_pago` (`contrato_id`),
  CONSTRAINT `FK_pago` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`contrato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personajuridica`
--

DROP TABLE IF EXISTS `personajuridica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personajuridica` (
  `personajuridica_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personajuridica_nit` varchar(35) NOT NULL,
  `personajuridica_razonsocial` varchar(500) NOT NULL,
  `personajuridica_direccion` varchar(500) DEFAULT NULL,
  `personanatural_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`personajuridica_id`),
  KEY `personajuridica_FK` (`personanatural_id`),
  CONSTRAINT `personajuridica_FK` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personajuridica`
--

LOCK TABLES `personajuridica` WRITE;
/*!40000 ALTER TABLE `personajuridica` DISABLE KEYS */;
/*!40000 ALTER TABLE `personajuridica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personanatural`
--

DROP TABLE IF EXISTS `personanatural`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personanatural` (
  `personanatural_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personanatural_codigo` varchar(15) NOT NULL,
  `personanatural_nombres` char(100) NOT NULL,
  `personanatural_apellidopaterno` char(75) DEFAULT NULL,
  `personanatural_apellidomaterno` char(75) DEFAULT NULL,
  `tipodocumentoidentificacion_id` int(10) unsigned NOT NULL,
  `personanatural_numerodocumento` varchar(15) NOT NULL,
  `expedicion_id` int(10) unsigned NOT NULL,
  `personanatural_fechaexpedicion` date DEFAULT NULL,
  `personanatural_fechanacimiento` date DEFAULT NULL,
  `personanatural_direccion` varchar(500) NOT NULL,
  `eps_id` int(10) unsigned NOT NULL,
  `fondodepensiones_id` int(10) unsigned NOT NULL,
  `grado_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`personanatural_id`),
  UNIQUE KEY `personanatural_UN` (`personanatural_numerodocumento`),
  UNIQUE KEY `personanatural_UN1` (`personanatural_codigo`),
  KEY `personanatural_FK` (`tipodocumentoidentificacion_id`),
  KEY `personanatural_FK_1` (`expedicion_id`),
  KEY `personanatural_FK_3` (`eps_id`),
  KEY `personanatural_FK_2` (`grado_id`),
  CONSTRAINT `personanatural_FK` FOREIGN KEY (`tipodocumentoidentificacion_id`) REFERENCES `tipodocumentoidentificacion` (`tipodocumentoidentificacion_id`),
  CONSTRAINT `personanatural_FK_1` FOREIGN KEY (`expedicion_id`) REFERENCES `expedicion` (`expedicion_id`),
  CONSTRAINT `personanatural_FK_2` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`grado_id`),
  CONSTRAINT `personanatural_FK_3` FOREIGN KEY (`eps_id`) REFERENCES `eps` (`eps_id`),
  CONSTRAINT `personanatural_FK_4` FOREIGN KEY (`personanatural_id`) REFERENCES `fondodepension` (`fondodepension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personanatural`
--

LOCK TABLES `personanatural` WRITE;
/*!40000 ALTER TABLE `personanatural` DISABLE KEYS */;
/*!40000 ALTER TABLE `personanatural` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponente`
--

DROP TABLE IF EXISTS `ponente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ponente` (
  `ponente_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ponente_nombrecompleto` char(200) NOT NULL,
  PRIMARY KEY (`ponente_id`),
  UNIQUE KEY `magistrado_nombrecompleto` (`ponente_nombrecompleto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponente`
--

LOCK TABLES `ponente` WRITE;
/*!40000 ALTER TABLE `ponente` DISABLE KEYS */;
/*!40000 ALTER TABLE `ponente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso` (
  `proceso_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proceso_codigo` varchar(15) NOT NULL,
  `proceso_numero` char(35) NOT NULL,
  `ciudadproceso_id` int(10) unsigned NOT NULL,
  `corporacion_id` int(10) unsigned NOT NULL,
  `ponente_id` int(10) unsigned NOT NULL,
  `estado_id` int(10) unsigned NOT NULL,
  `recordatorio_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`proceso_id`),
  UNIQUE KEY `proceso_numero` (`proceso_numero`),
  UNIQUE KEY `proceso_UN` (`proceso_codigo`),
  KEY `proceso_FK` (`ciudadproceso_id`),
  KEY `proceso_FK_1` (`corporacion_id`),
  KEY `proceso_FK_2` (`ponente_id`),
  KEY `proceso_FK_3` (`estado_id`),
  KEY `proceso_FK_4` (`recordatorio_id`),
  CONSTRAINT `proceso_FK` FOREIGN KEY (`ciudadproceso_id`) REFERENCES `ciudadproceso` (`ciudadproceso_id`),
  CONSTRAINT `proceso_FK_1` FOREIGN KEY (`corporacion_id`) REFERENCES `corporacion` (`corporacion_id`),
  CONSTRAINT `proceso_FK_2` FOREIGN KEY (`ponente_id`) REFERENCES `ponente` (`ponente_id`),
  CONSTRAINT `proceso_FK_3` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`estado_id`),
  CONSTRAINT `proceso_FK_4` FOREIGN KEY (`recordatorio_id`) REFERENCES `recordatorio` (`recordatorio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recordatorio`
--

DROP TABLE IF EXISTS `recordatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recordatorio` (
  `recordatorio_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recordatorio_observacion` varchar(1000) NOT NULL,
  `recordatorio_fecha` date NOT NULL,
  PRIMARY KEY (`recordatorio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recordatorio`
--

LOCK TABLES `recordatorio` WRITE;
/*!40000 ALTER TABLE `recordatorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `recordatorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registroconsulta`
--

DROP TABLE IF EXISTS `registroconsulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registroconsulta` (
  `registroconsulta_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personanatural_id` int(10) unsigned NOT NULL,
  `proceso_id` int(10) unsigned NOT NULL,
  `registroconsulta_fecha` date NOT NULL,
  `registroconsulta_hora` time NOT NULL,
  PRIMARY KEY (`registroconsulta_id`),
  KEY `registroconsulta_FK` (`personanatural_id`),
  KEY `registroconsulta_FK_1` (`proceso_id`),
  CONSTRAINT `registroconsulta_FK` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`),
  CONSTRAINT `registroconsulta_FK_1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`proceso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registroconsulta`
--

LOCK TABLES `registroconsulta` WRITE;
/*!40000 ALTER TABLE `registroconsulta` DISABLE KEYS */;
/*!40000 ALTER TABLE `registroconsulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefono` (
  `telefono_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `telefono_numero` varchar(50) NOT NULL,
  `telefono_principal` tinyint(1) NOT NULL DEFAULT 0,
  `personanatural_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`telefono_id`),
  UNIQUE KEY `telefono_numero` (`telefono_numero`),
  KEY `telefono_FK` (`personanatural_id`),
  CONSTRAINT `telefono_FK` FOREIGN KEY (`personanatural_id`) REFERENCES `personanatural` (`personanatural_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono`
--

LOCK TABLES `telefono` WRITE;
/*!40000 ALTER TABLE `telefono` DISABLE KEYS */;
/*!40000 ALTER TABLE `telefono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipocontrato`
--

DROP TABLE IF EXISTS `tipocontrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipocontrato` (
  `tipocontrato_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipocontrato_descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`tipocontrato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipocontrato`
--

LOCK TABLES `tipocontrato` WRITE;
/*!40000 ALTER TABLE `tipocontrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipocontrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodemanda`
--

DROP TABLE IF EXISTS `tipodemanda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipodemanda` (
  `tipodemanda_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipodemanda_abreviatura` char(10) NOT NULL,
  `tipodemanda_descripcion` char(250) NOT NULL,
  `tipodemanda_cometario` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`tipodemanda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodemanda`
--

LOCK TABLES `tipodemanda` WRITE;
/*!40000 ALTER TABLE `tipodemanda` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodemanda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipodocumento` (
  `tipodocumento_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipodocumento_abreviatura` char(5) NOT NULL,
  `tipodocumento_descripcion` char(30) NOT NULL,
  `tipodocumento_comentario` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`tipodocumento_id`),
  UNIQUE KEY `tipodocumento_abreviatura` (`tipodocumento_abreviatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodocumento`
--

LOCK TABLES `tipodocumento` WRITE;
/*!40000 ALTER TABLE `tipodocumento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodocumento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumentoidentificacion`
--

DROP TABLE IF EXISTS `tipodocumentoidentificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipodocumentoidentificacion` (
  `tipodocumentoidentificacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipodocumentoidentificacion_abreviatura` char(10) NOT NULL,
  `tipodocumentoidentificacion_descripcion` char(200) NOT NULL,
  PRIMARY KEY (`tipodocumentoidentificacion_id`),
  UNIQUE KEY `tipodocumentoidentificacion_UN` (`tipodocumentoidentificacion_abreviatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodocumentoidentificacion`
--

LOCK TABLES `tipodocumentoidentificacion` WRITE;
/*!40000 ALTER TABLE `tipodocumentoidentificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodocumentoidentificacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-10 15:29:15
