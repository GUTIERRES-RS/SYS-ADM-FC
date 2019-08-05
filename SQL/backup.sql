<<<<<<< HEAD
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: painel
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `fone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'SG Suporte a T.I.','00.000.000.0000-00','00 90000-0000');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lanc_grupos`
--

DROP TABLE IF EXISTS `lanc_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lanc_grupos` (
  `id_lanc_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_lanc_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc_grupos`
--

LOCK TABLES `lanc_grupos` WRITE;
/*!40000 ALTER TABLE `lanc_grupos` DISABLE KEYS */;
INSERT INTO `lanc_grupos` VALUES (1,1,'Entrada','1'),(2,1,'Saída','1'),(3,1,'Despesas','1'),(5,1,'Teste','1');
/*!40000 ALTER TABLE `lanc_grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lanc_tipos`
--

DROP TABLE IF EXISTS `lanc_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lanc_tipos` (
  `id_lanc_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_lanc_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc_tipos`
--

LOCK TABLES `lanc_tipos` WRITE;
/*!40000 ALTER TABLE `lanc_tipos` DISABLE KEYS */;
INSERT INTO `lanc_tipos` VALUES (1,1,1,'BATATA','1'),(2,1,2,'COMBUSTIVEL','1'),(3,1,1,'ALFACE','1'),(4,1,3,'PESSOAL','1');
/*!40000 ALTER TABLE `lanc_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamentos`
--

DROP TABLE IF EXISTS `lancamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lancamentos` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `id_lanc_tipo` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `ativo` varchar(2) NOT NULL,
  PRIMARY KEY (`id_lancamento`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos`
--

LOCK TABLES `lancamentos` WRITE;
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;
INSERT INTO `lancamentos` VALUES (1,1,1,1,'Venda da Colheita','10.00   ','2019-06-05','1'),(2,1,2,2,'Caminhote INP-0000','10.00  ','2019-06-05','1'),(3,1,1,3,'Venda da Colheita','10.00','2019-06-05','1'),(4,1,2,2,'Teste de lançamento 1','15.00 ','2019-06-07','1'),(5,1,2,2,'Teste de lançamento 1','15.00 ','2019-06-07','1'),(9,1,1,1,'Teste de lançamento 1','15.00 ','2019-06-07','1'),(10,1,2,2,'Moto INP-0000','50.00','2019-06-07','1'),(11,1,1,1,'Colheita Março','100.00','2019-06-07','1'),(12,1,1,3,'Colheita Janeiro','1000.00','2019-01-02','1'),(13,1,3,4,'Lanche','15.00','2019-06-07','1');
/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_config`
--

DROP TABLE IF EXISTS `site_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_config` (
  `id_site_config` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `ativo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_site_config`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_config`
--

LOCK TABLES `site_config` WRITE;
/*!40000 ALTER TABLE `site_config` DISABLE KEYS */;
INSERT INTO `site_config` VALUES (1,'On','1');
/*!40000 ALTER TABLE `site_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_painel`
--

DROP TABLE IF EXISTS `users_painel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users_painel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `ativo` varchar(2) NOT NULL,
  `nivel` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_painel`
-- PASS: q1w2e3r4

LOCK TABLES `users_painel` WRITE;
/*!40000 ALTER TABLE `users_painel` DISABLE KEYS */;
INSERT INTO `users_painel` VALUES (1,'Administrador','admin','c62d929e7b7e7b6165923a5dfc60cb56','1','1'),(2,'Santamassa','santamassa','c62d929e7b7e7b6165923a5dfc60cb56','1','2'),(3,'Usuario','usuario','c62d929e7b7e7b6165923a5dfc60cb56','1','3');
/*!40000 ALTER TABLE `users_painel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-10 15:42:21
=======
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: painel
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `fone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'SG Suporte a T.I.','00.000.000.0000-00','00 90000-0000');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lanc_grupos`
--

DROP TABLE IF EXISTS `lanc_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lanc_grupos` (
  `id_lanc_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_lanc_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc_grupos`
--

LOCK TABLES `lanc_grupos` WRITE;
/*!40000 ALTER TABLE `lanc_grupos` DISABLE KEYS */;
INSERT INTO `lanc_grupos` VALUES (1,1,'Entrada','1'),(2,1,'Saída','1'),(3,1,'Despesas','1'),(5,1,'Teste','1');
/*!40000 ALTER TABLE `lanc_grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lanc_tipos`
--

DROP TABLE IF EXISTS `lanc_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lanc_tipos` (
  `id_lanc_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_lanc_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc_tipos`
--

LOCK TABLES `lanc_tipos` WRITE;
/*!40000 ALTER TABLE `lanc_tipos` DISABLE KEYS */;
INSERT INTO `lanc_tipos` VALUES (1,1,1,'BATATA','1'),(2,1,2,'COMBUSTIVEL','1'),(3,1,1,'ALFACE','1'),(4,1,3,'PESSOAL','1');
/*!40000 ALTER TABLE `lanc_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamentos`
--

DROP TABLE IF EXISTS `lancamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lancamentos` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_lanc_grupo` int(11) NOT NULL,
  `id_lanc_tipo` int(11) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `ativo` varchar(2) NOT NULL,
  PRIMARY KEY (`id_lancamento`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos`
--

LOCK TABLES `lancamentos` WRITE;
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;
INSERT INTO `lancamentos` VALUES (1,1,1,1,'Venda da Colheita','10.00   ','2019-06-05','1'),(2,1,2,2,'Caminhote INP-0000','10.00  ','2019-06-05','1'),(3,1,1,3,'Venda da Colheita','10.00','2019-06-05','1'),(4,1,2,2,'Teste de lançamento 1','15.00 ','2019-06-07','1'),(5,1,2,2,'Teste de lançamento 1','15.00 ','2019-06-07','1'),(9,1,1,1,'Teste de lançamento 1','15.00 ','2019-06-07','1'),(10,1,2,2,'Moto INP-0000','50.00','2019-06-07','1'),(11,1,1,1,'Colheita Março','100.00','2019-06-07','1'),(12,1,1,3,'Colheita Janeiro','1000.00','2019-01-02','1'),(13,1,3,4,'Lanche','15.00','2019-06-07','1');
/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_config`
--

DROP TABLE IF EXISTS `site_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `site_config` (
  `id_site_config` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `ativo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_site_config`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_config`
--

LOCK TABLES `site_config` WRITE;
/*!40000 ALTER TABLE `site_config` DISABLE KEYS */;
INSERT INTO `site_config` VALUES (1,'On','1');
/*!40000 ALTER TABLE `site_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_painel`
--

DROP TABLE IF EXISTS `users_painel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users_painel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `ativo` varchar(2) NOT NULL,
  `nivel` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_painel`
-- PASS: q1w2e3r4

LOCK TABLES `users_painel` WRITE;
/*!40000 ALTER TABLE `users_painel` DISABLE KEYS */;
INSERT INTO `users_painel` VALUES (1,'Administrador','admin','c62d929e7b7e7b6165923a5dfc60cb56','1','1'),(2,'Santamassa','santamassa','c62d929e7b7e7b6165923a5dfc60cb56','1','2'),(3,'Usuario','usuario','c62d929e7b7e7b6165923a5dfc60cb56','1','3');
/*!40000 ALTER TABLE `users_painel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-10 15:42:21
>>>>>>> c7009ac66b0057fa9bd105f27372c4368d65b96f
