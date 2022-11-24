-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.17-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema nebula
--

CREATE DATABASE IF NOT EXISTS nebula;
USE nebula;

--
-- Definition of table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
  `remetente` int(16) unsigned NOT NULL,
  `destinatario` int(16) unsigned NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `datahora` datetime NOT NULL,
  `lida` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;


--
-- Definition of table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(128) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `post_id` int(64) unsigned NOT NULL,
  `msg` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


--
-- Definition of table `conexoes`
--

DROP TABLE IF EXISTS `conexoes`;
CREATE TABLE `conexoes` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(16) unsigned NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `valor` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conexoes`
--

/*!40000 ALTER TABLE `conexoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `conexoes` ENABLE KEYS */;


--
-- Definition of table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE `follow` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `idmaior` int(16) unsigned NOT NULL,
  `idmenor` int(16) unsigned NOT NULL,
  `maiormenor` int(1) unsigned NOT NULL DEFAULT 0,
  `menormaior` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow`
--

/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;


--
-- Definition of table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` int(16) unsigned NOT NULL,
  `post` int(64) unsigned NOT NULL,
  `validade` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` (`id`,`usuario`,`post`,`validade`) VALUES 
 (56,1024,54,0),
 (57,1025,55,0),
 (58,1025,54,0),
 (59,1026,55,0),
 (60,1026,54,0);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;


--
-- Definition of table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `codigo_2FA` varchar(16) NOT NULL,
  `validade_2FA` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1027 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`id`,`email`,`senha`,`codigo_2FA`,`validade_2FA`) VALUES 
 (1024,'9b27e0eb13a25fd9c24e1ead841a163f95a8c47d12d5ddf4bff217f18908b76d','2c70dfbc967bd610fc7fbc6dfef0708a99d6be1fc44be3dffa47f0dde132442b','',0),
 (1025,'f82d0f4030aa3b3cdc1c9b662f758635c1ec9a5f914aaecbf7b429e6e7d895ec','2c70dfbc967bd610fc7fbc6dfef0708a99d6be1fc44be3dffa47f0dde132442b','',0),
 (1026,'b02f2f241b59742039ab4da25e242420cd0bb25226952a9eca2aa8f116d327c9','2c70dfbc967bd610fc7fbc6dfef0708a99d6be1fc44be3dffa47f0dde132442b','',0);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;


--
-- Definition of table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `destinatario` int(16) unsigned NOT NULL,
  `remetente` int(16) unsigned NOT NULL,
  `interacao` int(64) unsigned NOT NULL,
  `tipo` int(1) unsigned NOT NULL,
  `lida` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;


--
-- Definition of table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `tipo` int(1) unsigned NOT NULL DEFAULT 0,
  `midia` varchar(70) DEFAULT NULL,
  `curtidas` int(20) unsigned NOT NULL DEFAULT 0,
  `conteudo` varchar(1000) DEFAULT NULL,
  `com_user_id` int(16) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`,`user_id`,`tipo`,`midia`,`curtidas`,`conteudo`,`com_user_id`) VALUES 
 (54,1024,1,'10241669319884.jpg',3,'T2kgcGVzc29hbCwgc291IG5vdmEgbm8gTmVidWxhIQ==',0),
 (55,1025,0,NULL,2,'Vm9jw6pzIGVzdMOjbyB2ZW5kbyBDaGFpbnNhdyBNYW4/',0),
 (56,1026,1,'10261669320114.jpg',0,'UG93ZXIgUzI=',0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


--
-- Definition of table `salvos`
--

DROP TABLE IF EXISTS `salvos`;
CREATE TABLE `salvos` (
  `user_id` int(16) unsigned NOT NULL,
  `post_id` int(64) unsigned NOT NULL,
  `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salvos`
--

/*!40000 ALTER TABLE `salvos` DISABLE KEYS */;
/*!40000 ALTER TABLE `salvos` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(16) unsigned NOT NULL DEFAULT 0,
  `usuario` varchar(16) NOT NULL DEFAULT 'Nulo',
  `uid` varchar(4) NOT NULL DEFAULT '1000',
  `bio` varchar(450) DEFAULT 'T2zDoSwgZXUgc291IG5vdm8oYSkgbm8gTmVidWxhIQ==',
  `icon` varchar(20) NOT NULL DEFAULT 'df.png',
  `banner` varchar(20) NOT NULL DEFAULT 'df.jpg',
  `seguindo` int(10) unsigned NOT NULL DEFAULT 0,
  `seguidores` int(10) unsigned NOT NULL DEFAULT 0,
  `tipo` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`usuario`,`uid`,`bio`,`icon`,`banner`,`seguindo`,`seguidores`,`tipo`) VALUES 
 (1024,'UNSC Savannah','6012','T2zDoSwgZXUgc291IGEgU2F2YW5uYWgh','10241669319840.jpg','10241669319845.jpeg',0,0,0),
 (1025,'UNSC Saratoga','2855','T2zDoSwgdHVkbyBiZW0/','10251669319951.jpg','10251669319982.jpg',0,0,0),
 (1026,'UNSC Grafton','4836','T2zDoSwgbWV1IG5vbWUgw6kgR3JhZnRvbiEh','10261669320123.jpg','10261669320130.jpg',0,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
