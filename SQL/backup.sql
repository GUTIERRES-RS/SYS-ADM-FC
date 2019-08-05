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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Empresa de Testes','00.000.000.0000-00','00 90000-0000'),(2,'Outra empresa de Teste','00.000.000.0000-00','00 90000-0000');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc_grupos`
--

LOCK TABLES `lanc_grupos` WRITE;
/*!40000 ALTER TABLE `lanc_grupos` DISABLE KEYS */;
INSERT INTO `lanc_grupos` VALUES (1,1,'Entrada','1'),(2,1,'Saída','1');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lanc_tipos`
--

LOCK TABLES `lanc_tipos` WRITE;
/*!40000 ALTER TABLE `lanc_tipos` DISABLE KEYS */;
INSERT INTO `lanc_tipos` VALUES (1,1,1,'BATATA','1'),(2,1,2,'COMBUSTIVEL','1'),(3,1,1,'ALFACE','1'),(4,1,2,'PESSOAL','1'),(5,1,2,'AGUA','1'),(6,1,2,'LUZ','1');
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
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `ativo` varchar(2) NOT NULL,
  PRIMARY KEY (`id_lancamento`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos`
--

LOCK TABLES `lancamentos` WRITE;
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;
INSERT INTO `lancamentos` VALUES (49,1,1,1,'Teste de lançamento 1',100.00,'2019-08-02','1'),(50,1,2,2,'Caminhonete INP-0000',50.00,'2019-08-02','1'),(51,1,2,4,'Teste de lançamento 3',310.00,'2019-08-02','1'),(52,1,1,1,'Teste de lançamento 4',200.00,'2019-08-02','1'),(53,1,1,1,'Teste de lançamento 1',100.00,'2019-07-02','1'),(54,1,2,5,'Teste de lançamento 4',50.00,'2019-07-02','1'),(55,1,2,6,'Teste de lançamento 1',150.00,'2019-06-02','1'),(56,1,1,1,'Teste de lançamento 1',200.00,'2019-06-02','1'),(57,1,1,3,'Teste de lançamento 1',150.00,'2019-06-02','1'),(58,1,1,3,'Teste de lançamento 1',500.00,'2019-04-02','1'),(59,1,2,5,'Teste de lançamento 1',250.00,'2019-04-02','1'),(60,1,1,1,'Teste de lançamento 1',300.00,'2019-03-02','1'),(61,1,2,6,'Teste de lançamento 3',100.00,'2019-03-02','1'),(62,1,1,1,'Teste de lançamento 1',200.00,'2019-02-02','1'),(63,1,2,2,'Teste de lançamento 2',100.00,'2019-02-02','1');
/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_painel`
--

DROP TABLE IF EXISTS `users_painel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users_painel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) NOT NULL,
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
INSERT INTO `users_painel` VALUES (1,1,'Administrador','admin','c62d929e7b7e7b6165923a5dfc60cb56','1','1'),(2,2,'Teste','Teste','c62d929e7b7e7b6165923a5dfc60cb56','1','2'),(3,1,'Usuario','usuario','c62d929e7b7e7b6165923a5dfc60cb56','1','3'),(4,2,'Jalo','jalo','c62d929e7b7e7b6165923a5dfc60cb56','1','3');
/*!40000 ALTER TABLE `users_painel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_painel_on`
--

DROP TABLE IF EXISTS `users_painel_on`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users_painel_on` (
  `id_users_painel_on` int(11) NOT NULL AUTO_INCREMENT,
  `users_painel_id` int(11) DEFAULT NULL,
  `users_painel_ip` varchar(45) DEFAULT NULL,
  `users_painel_temp` datetime DEFAULT NULL,
  `users_painel_ativo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_users_painel_on`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_painel_on`
--

LOCK TABLES `users_painel_on` WRITE;
/*!40000 ALTER TABLE `users_painel_on` DISABLE KEYS */;
INSERT INTO `users_painel_on` VALUES (1,1,'127.0.0.1','2019-08-02 17:39:38','1'),(2,2,'127.0.0.1','2019-07-12 19:43:29','0'),(3,3,'127.0.0.1','2019-07-17 21:59:32','0'),(4,4,'127.0.0.1','2019-07-19 18:47:48','0');
/*!40000 ALTER TABLE `users_painel_on` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-05 14:18:46
