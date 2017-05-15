-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: dev    Database: inventario
-- ------------------------------------------------------
-- Server version	5.5.52-0+deb8u1

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
-- Table structure for table `container`
--

DROP TABLE IF EXISTS `container`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_sala` bigint(20) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `container_id_uindex` (`id`),
  KEY `container_sala_id_fk` (`id_sala`),
  CONSTRAINT `container_sala_id_fk` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `container`
--

LOCK TABLES `container` WRITE;
/*!40000 ALTER TABLE `container` DISABLE KEYS */;
INSERT INTO `container` VALUES (1,1,'A','Armário A'),(2,1,'B','Armário B'),(3,1,'C','Gaveteiro A'),(4,2,'A','Caixa A'),(5,1,'789','ASD'),(6,12,'1','Armário 1'),(7,12,'2','Armário 2'),(8,12,'132','qweqwe');
/*!40000 ALTER TABLE `container` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagina`
--

DROP TABLE IF EXISTS `pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina` (
  `id` varchar(15) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `visivel` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pagina_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagina`
--

LOCK TABLES `pagina` WRITE;
/*!40000 ALTER TABLE `pagina` DISABLE KEYS */;
INSERT INTO `pagina` VALUES ('cadastrar','Cadastrar Equipamento',''),('getcontainers','','\0'),('getsalas','','\0'),('sel_resp','Selecionar Responsável','\0'),('sel_sala','Selecionar Sala','\0');
/*!40000 ALTER TABLE `pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao` (
  `id_pagina` varchar(15) NOT NULL,
  `id_grupo` varchar(10) NOT NULL,
  KEY `permissao_pagina_id_fk` (`id_pagina`),
  CONSTRAINT `permissao_pagina_id_fk` FOREIGN KEY (`id_pagina`) REFERENCES `pagina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao`
--

LOCK TABLES `permissao` WRITE;
/*!40000 ALTER TABLE `permissao` DISABLE KEYS */;
INSERT INTO `permissao` VALUES ('sel_resp','*'),('sel_sala','10004'),('cadastrar','*'),('getcontainers','10004'),('getsalas','10004');
/*!40000 ALTER TABLE `permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `predio`
--

DROP TABLE IF EXISTS `predio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `predio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `predio_id_uindex` (`id`),
  UNIQUE KEY `predio_nome_uindex` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `predio`
--

LOCK TABLES `predio` WRITE;
/*!40000 ALTER TABLE `predio` DISABLE KEYS */;
INSERT INTO `predio` VALUES (1,'5','prédio principal'),(2,'5A','pr2'),(3,'5B','pr3'),(4,'5C','pr4'),(5,'5D','pr5'),(6,'5E','prx'),(25,'Tambo','Longe'),(26,'1','3');
/*!40000 ALTER TABLE `predio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sala` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_predio` bigint(20) NOT NULL,
  `nro` varchar(10) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sala_id_uindex` (`id`),
  KEY `sala_predio_id_fk` (`id_predio`),
  CONSTRAINT `sala_predio_id_fk` FOREIGN KEY (`id_predio`) REFERENCES `predio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
INSERT INTO `sala` VALUES (1,1,'142','Departamento Técnico'),(2,1,'111','Sala XYZ'),(3,2,'321','Sala Teste'),(8,1,'001','Portaria'),(9,1,'x','nova sala'),(10,1,'987897','456564'),(11,1,'bolo','chocolate'),(12,4,'302','Professores');
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-15 11:03:13
