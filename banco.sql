-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: greatsell
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `anexos`
--

DROP TABLE IF EXISTS `anexos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anexos` (
  `idAnexos` int(11) NOT NULL AUTO_INCREMENT,
  `anexo` varchar(45) DEFAULT NULL,
  `thumb` varchar(45) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `path` varchar(300) DEFAULT NULL,
  `os_id` int(11) NOT NULL,
  PRIMARY KEY (`idAnexos`),
  KEY `fk_anexos_os1` (`os_id`),
  CONSTRAINT `fk_anexos_os1` FOREIGN KEY (`os_id`) REFERENCES `os` (`idOs`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anexos`
--

LOCK TABLES `anexos` WRITE;
/*!40000 ALTER TABLE `anexos` DISABLE KEYS */;
/*!40000 ALTER TABLE `anexos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('96bd8b5e829b3e54ec1ed4f74d6c926e','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36',1540343808,'a:6:{s:9:\"user_data\";s:0:\"\";s:4:\"nome\";s:14:\"Gabriel Vieira\";s:2:\"id\";s:1:\"3\";s:9:\"permissao\";s:1:\"1\";s:6:\"logado\";b:1;s:8:\"entidade\";s:1:\"1\";}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idClientes` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(255) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `dataCadastro` date DEFAULT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `entidade` int(11) NOT NULL,
  PRIMARY KEY (`idClientes`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (187,'Cliente de Samara','','(33) 3333-33333','','','2016-06-23','','','','','','',2),(189,'CLIENTE DE SAMARA 2','','(23) 4234-23423','','','2016-06-24','','','','','','',2),(190,'Gabriel','9999999999','(47) 9132-4698','','gabrielvra@outlook.com','2016-09-24','','','','Blumenau','Santa Catarina','',1),(200,'Leonardo','','(47) 9913-24698','','','2017-05-27','','','','','','',1),(202,'cliente final','','(47) 9913-24698','','','2017-08-23','','','','','','',3);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `idDocumentos` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(70) DEFAULT NULL,
  `descricao` text,
  `file` varchar(100) DEFAULT NULL,
  `path` varchar(300) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `cadastro` date DEFAULT NULL,
  `categoria` varchar(80) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `tamanho` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDocumentos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emitente`
--

DROP TABLE IF EXISTS `emitente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emitente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `ie` varchar(50) DEFAULT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `uf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url_logo` varchar(225) DEFAULT NULL,
  `entidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emitente`
--

LOCK TABLES `emitente` WRITE;
/*!40000 ALTER TABLE `emitente` DISABLE KEYS */;
INSERT INTO `emitente` VALUES (1,'Auto Luchi','10.821.107.0001/54','255.861.559','José Deeke','45','Asilo','Blumenau','SC','(47) 3035-6633','contato@autoluchi.com.br','http://gsvieira.com.br/greatsell/assets/uploads/33a610ee7e537cb88a671d9bf673a8a4.JPG',1),(2,'Samara Key','077.939.849-19','0','Alfredo Balistieri','106','Velha','Blumenau','SC','(47) 991248995','samyeffting@gmail.com','http://localhost/greatsell/assets/uploads/510ab231c1302e60ceff096295db855c.png',2),(3,'GS Sistemas','077.939.849-19','0','Alfredo Balistieri','106','Velha','Blumenau','SC','4791324698','gabrielvra@outlook.com','http://gsvieira.com.br/greatsell/assets/uploads/80cc45f4210c6d496a56e64ed0f3f6a1.JPG',3);
/*!40000 ALTER TABLE `emitente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_de_vendas`
--

DROP TABLE IF EXISTS `itens_de_vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_de_vendas` (
  `idItens` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` decimal(15,2) DEFAULT NULL,
  `vendas_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  `valor_unitario` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idItens`),
  KEY `fk_itens_de_vendas_vendas1` (`vendas_id`),
  KEY `fk_itens_de_vendas_produtos1` (`produtos_id`),
  CONSTRAINT `fk_itens_de_vendas_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`idProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_de_vendas_vendas1` FOREIGN KEY (`vendas_id`) REFERENCES `vendas` (`idVendas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_de_vendas`
--

LOCK TABLES `itens_de_vendas` WRITE;
/*!40000 ALTER TABLE `itens_de_vendas` DISABLE KEYS */;
INSERT INTO `itens_de_vendas` VALUES (21,1.00,12,4,11998.88),(22,3.00,15,7,100.00),(23,1.00,14,5,62.00);
/*!40000 ALTER TABLE `itens_de_vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamentos`
--

DROP TABLE IF EXISTS `lancamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamentos` (
  `idLancamentos` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `valor` decimal(15,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `baixado` tinyint(1) DEFAULT NULL,
  `cliente_fornecedor` varchar(255) DEFAULT NULL,
  `forma_pgto` varchar(100) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `anexo` varchar(250) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `os_id` int(11) DEFAULT NULL,
  `entidade` int(11) NOT NULL,
  `venda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idLancamentos`),
  KEY `fk_lancamentos_clientes1` (`clientes_id`),
  KEY `fk_os_lancamento` (`os_id`),
  CONSTRAINT `fk_lancamentos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_os_lancamento` FOREIGN KEY (`os_id`) REFERENCES `os` (`idOs`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamentos`
--

LOCK TABLES `lancamentos` WRITE;
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;
INSERT INTO `lancamentos` VALUES (25,'Fatura da venda #12',11998.88,'2016-12-03',NULL,0,'Cliente de Samara','Dinheiro','receita',NULL,187,NULL,2,12),(26,'Teste de despesa',111.11,'2016-12-03','2016-12-03',0,'ssasdasd','Dinheiro','despesa',NULL,NULL,NULL,2,NULL),(27,'receita teste',200.00,'2016-12-03','2016-12-03',1,'eteste','Dinheiro','receita',NULL,NULL,NULL,2,NULL),(29,'Fatura da OS #19',300.00,'2017-05-27','2017-05-27',0,'Leonardo','Dinheiro','receita',NULL,200,19,1,NULL),(35,'os 20',1000.00,'2017-06-30','2017-06-06',0,'gabriel','Dinheiro','receita',NULL,NULL,NULL,3,NULL),(36,'Fatura da venda #15',300.00,'2017-09-01',NULL,1,'cliente final','Dinheiro','receita',NULL,202,NULL,3,15),(37,'sdfsdfsdfsdf',1000.00,'2017-09-01','2017-09-01',0,'sdfsdfsdf','Dinheiro','despesa',NULL,NULL,NULL,3,NULL),(38,'Fatura da venda #14',61.99,'2018-10-26',NULL,1,'Gabriel','Dinheiro','receita',NULL,190,NULL,1,14);
/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `os`
--

DROP TABLE IF EXISTS `os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `os` (
  `idOs` int(11) NOT NULL AUTO_INCREMENT,
  `dataInicial` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `garantia` varchar(45) DEFAULT NULL,
  `descricaoProduto` varchar(150) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `observacoes` varchar(150) DEFAULT NULL,
  `valorTotal` decimal(15,2) DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `lancamento` int(11) DEFAULT NULL,
  `faturado` tinyint(1) NOT NULL,
  `entidade` int(11) NOT NULL,
  `desconto` decimal(15,2) NOT NULL,
  `quilometragem` decimal(15,2) DEFAULT NULL,
  `placa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idOs`),
  KEY `fk_os_clientes1` (`clientes_id`),
  KEY `fk_os_usuarios1` (`usuarios_id`),
  KEY `fk_os_lancamentos1` (`lancamento`),
  CONSTRAINT `fk_os_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_os_lancamentos1` FOREIGN KEY (`lancamento`) REFERENCES `lancamentos` (`idLancamentos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_os_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `os`
--

LOCK TABLES `os` WRITE;
/*!40000 ALTER TABLE `os` DISABLE KEYS */;
INSERT INTO `os` VALUES (13,'2016-12-03',NULL,'','','Orçamento','',12998.11,189,7,NULL,0,2,40.00,NULL,NULL),(14,'2016-12-08',NULL,'','','Faturado','',0.00,187,7,NULL,0,2,0.00,NULL,NULL),(15,'2016-12-09',NULL,'','','Finalizado','',0.00,187,7,NULL,0,2,0.00,NULL,NULL),(19,'2017-05-19','2018-10-23','','DESCRIÇÃO','Finalizado','OBSERVAÇÃO',262.00,200,3,NULL,1,1,0.00,111111.00,''),(20,'2017-08-23',NULL,'','TESTE DE CADASTRO','Orçamento','',0.00,202,9,NULL,0,3,0.00,NULL,NULL),(21,'2017-09-01',NULL,'','','Orçamento','',2500.00,202,9,NULL,0,3,0.00,NULL,NULL);
/*!40000 ALTER TABLE `os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissoes` (
  `idPermissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `permissoes` text,
  `situacao` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idPermissao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (1,'Administrador','a:38:{s:8:\"aCliente\";s:1:\"1\";s:8:\"eCliente\";s:1:\"1\";s:8:\"dCliente\";s:1:\"1\";s:8:\"vCliente\";s:1:\"1\";s:8:\"aProduto\";s:1:\"1\";s:8:\"eProduto\";s:1:\"1\";s:8:\"dProduto\";s:1:\"1\";s:8:\"vProduto\";s:1:\"1\";s:8:\"aServico\";s:1:\"1\";s:8:\"eServico\";s:1:\"1\";s:8:\"dServico\";s:1:\"1\";s:8:\"vServico\";s:1:\"1\";s:3:\"aOs\";s:1:\"1\";s:3:\"eOs\";s:1:\"1\";s:3:\"dOs\";s:1:\"1\";s:3:\"vOs\";s:1:\"1\";s:6:\"aVenda\";s:1:\"1\";s:6:\"eVenda\";s:1:\"1\";s:6:\"dVenda\";s:1:\"1\";s:6:\"vVenda\";s:1:\"1\";s:8:\"aArquivo\";s:1:\"1\";s:8:\"eArquivo\";s:1:\"1\";s:8:\"dArquivo\";s:1:\"1\";s:8:\"vArquivo\";s:1:\"1\";s:11:\"aLancamento\";s:1:\"1\";s:11:\"eLancamento\";s:1:\"1\";s:11:\"dLancamento\";s:1:\"1\";s:11:\"vLancamento\";s:1:\"1\";s:8:\"cUsuario\";s:1:\"1\";s:9:\"cEmitente\";s:1:\"1\";s:10:\"cPermissao\";s:1:\"1\";s:7:\"cBackup\";s:1:\"1\";s:8:\"rCliente\";s:1:\"1\";s:8:\"rProduto\";s:1:\"1\";s:8:\"rServico\";s:1:\"1\";s:3:\"rOs\";s:1:\"1\";s:6:\"rVenda\";s:1:\"1\";s:11:\"rFinanceiro\";s:1:\"1\";}',1,'2014-09-03'),(2,'Usuário','a:38:{s:8:\"aCliente\";s:1:\"1\";s:8:\"eCliente\";s:1:\"1\";s:8:\"dCliente\";s:1:\"1\";s:8:\"vCliente\";s:1:\"1\";s:8:\"aProduto\";s:1:\"1\";s:8:\"eProduto\";s:1:\"1\";s:8:\"dProduto\";s:1:\"1\";s:8:\"vProduto\";s:1:\"1\";s:8:\"aServico\";s:1:\"1\";s:8:\"eServico\";s:1:\"1\";s:8:\"dServico\";s:1:\"1\";s:8:\"vServico\";s:1:\"1\";s:3:\"aOs\";s:1:\"1\";s:3:\"eOs\";s:1:\"1\";s:3:\"dOs\";s:1:\"1\";s:3:\"vOs\";s:1:\"1\";s:6:\"aVenda\";s:1:\"1\";s:6:\"eVenda\";s:1:\"1\";s:6:\"dVenda\";s:1:\"1\";s:6:\"vVenda\";s:1:\"1\";s:8:\"aArquivo\";s:1:\"1\";s:8:\"eArquivo\";s:1:\"1\";s:8:\"dArquivo\";s:1:\"1\";s:8:\"vArquivo\";s:1:\"1\";s:11:\"aLancamento\";s:1:\"1\";s:11:\"eLancamento\";s:1:\"1\";s:11:\"dLancamento\";s:1:\"1\";s:11:\"vLancamento\";s:1:\"1\";s:8:\"cUsuario\";s:1:\"1\";s:9:\"cEmitente\";s:1:\"1\";s:10:\"cPermissao\";s:1:\"1\";s:7:\"cBackup\";s:1:\"1\";s:8:\"rCliente\";s:1:\"1\";s:8:\"rProduto\";s:1:\"1\";s:8:\"rServico\";s:1:\"1\";s:3:\"rOs\";s:1:\"1\";s:6:\"rVenda\";s:1:\"1\";s:11:\"rFinanceiro\";s:1:\"1\";}',1,'2016-06-15');
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `idProdutos` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(80) NOT NULL,
  `unidade` varchar(10) DEFAULT NULL,
  `precoCompra` decimal(15,2) DEFAULT NULL,
  `precoVenda` decimal(15,2) NOT NULL,
  `estoque` decimal(15,2) NOT NULL,
  `estoqueMinimo` decimal(15,2) DEFAULT NULL,
  `entidade` int(11) NOT NULL,
  PRIMARY KEY (`idProdutos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (4,'Produto da Samara','9',1111.99,11998.88,8.00,0.00,2),(5,'Produto','Un',50.00,62.00,67.00,2.00,1),(6,'PRODUTO DE SAMARA','Un',99.00,999.88,9889.00,2.00,2),(7,'iPhone 5s 64gb','1',2000.00,2500.00,66.00,0.00,3);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos_os`
--

DROP TABLE IF EXISTS `produtos_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_os` (
  `idProdutos_os` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` decimal(15,2) NOT NULL,
  `os_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  `valor_unitario` decimal(15,2) DEFAULT NULL,
  `localCompra` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProdutos_os`),
  KEY `fk_produtos_os_os1` (`os_id`),
  KEY `fk_produtos_os_produtos1` (`produtos_id`),
  CONSTRAINT `fk_produtos_os_os1` FOREIGN KEY (`os_id`) REFERENCES `os` (`idOs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_os_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`idProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_os`
--

LOCK TABLES `produtos_os` WRITE;
/*!40000 ALTER TABLE `produtos_os` DISABLE KEYS */;
INSERT INTO `produtos_os` VALUES (3,1.00,13,4,11998.88,NULL),(4,1.00,21,7,2500.00,NULL),(5,1.00,19,5,62.00,'localCompra');
/*!40000 ALTER TABLE `produtos_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos` (
  `idServicos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `preco` decimal(15,2) NOT NULL,
  `entidade` int(11) NOT NULL,
  PRIMARY KEY (`idServicos`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (3,'Serviço de samara','Samara',999.23,2),(6,'Serviço de samara 2','Muito trabalho, bem feito e com otima qualidade',93.92,2),(7,'Troca de tela','Troca, limpeza e montagem',100.00,3),(8,'Mão de obra','',100.00,1),(9,'7','7778979798',0.07,3);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_os`
--

DROP TABLE IF EXISTS `servicos_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos_os` (
  `idServicos_os` int(11) NOT NULL AUTO_INCREMENT,
  `os_id` int(11) NOT NULL,
  `servicos_id` int(11) NOT NULL,
  `quantidade` decimal(15,2) NOT NULL,
  `valor_unitario` decimal(15,2) NOT NULL,
  PRIMARY KEY (`idServicos_os`),
  KEY `fk_servicos_os_os1` (`os_id`),
  KEY `fk_servicos_os_servicos1` (`servicos_id`),
  CONSTRAINT `fk_servicos_os_os1` FOREIGN KEY (`os_id`) REFERENCES `os` (`idOs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicos_os_servicos1` FOREIGN KEY (`servicos_id`) REFERENCES `servicos` (`idServicos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos_os`
--

LOCK TABLES `servicos_os` WRITE;
/*!40000 ALTER TABLE `servicos_os` DISABLE KEYS */;
INSERT INTO `servicos_os` VALUES (1,13,3,1.00,999.23),(4,19,8,2.00,100.00);
/*!40000 ALTER TABLE `servicos_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL,
  `dataCadastro` date NOT NULL,
  `permissoes_id` int(11) NOT NULL,
  `entidade` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `fk_usuarios_permissoes1_idx` (`permissoes_id`),
  CONSTRAINT `fk_usuarios_permissoes1` FOREIGN KEY (`permissoes_id`) REFERENCES `permissoes` (`idPermissao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Gabriel Vieira','','','','','','','','contato@gsvieira.com.br','d033e22ae348aeb5660fc2140aec35850c4da997','(47) 3035-6633','',1,'2015-09-29',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendas` (
  `idVendas` int(11) NOT NULL AUTO_INCREMENT,
  `dataVenda` date DEFAULT NULL,
  `valorTotal` decimal(15,2) DEFAULT NULL,
  `desconto` decimal(15,2) DEFAULT NULL,
  `faturado` tinyint(1) DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `lancamentos_id` int(11) DEFAULT NULL,
  `observacao` varchar(255) NOT NULL,
  `entidade` int(11) NOT NULL,
  PRIMARY KEY (`idVendas`),
  KEY `fk_vendas_clientes1` (`clientes_id`),
  KEY `fk_vendas_usuarios1` (`usuarios_id`),
  KEY `fk_vendas_lancamentos1` (`lancamentos_id`),
  CONSTRAINT `fk_vendas_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vendas_lancamentos1` FOREIGN KEY (`lancamentos_id`) REFERENCES `lancamentos` (`idLancamentos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vendas_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (12,'2016-12-03',11998.88,NULL,1,187,7,NULL,'',2),(14,'2017-05-27',62.00,0.01,1,190,3,NULL,'Observação',1),(15,'2017-09-01',300.00,NULL,1,202,9,NULL,'',3);
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-23 22:21:16
