CREATE DATABASE  IF NOT EXISTS `bioskop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bioskop`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bioskop
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bioskop`
--

LOCK TABLES `bioskop` WRITE;
/*!40000 ALTER TABLE `bioskop` DISABLE KEYS */;
/*!40000 ALTER TABLE `bioskop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `film`
--

LOCK TABLES `film` WRITE;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
/*!40000 ALTER TABLE `film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `karta`
--

LOCK TABLES `karta` WRITE;
/*!40000 ALTER TABLE `karta` DISABLE KEYS */;
/*!40000 ALTER TABLE `karta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `menadzer`
--

LOCK TABLES `menadzer` WRITE;
/*!40000 ALTER TABLE `menadzer` DISABLE KEYS */;
/*!40000 ALTER TABLE `menadzer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_05_29_153029_create_bioskop',1),(4,'2018_05_29_154750_create_film',1),(5,'2018_05_29_155421_create_zaposleni',1),(6,'2018_05_29_155829_create_salterski_sluzbenik',1),(7,'2018_05_29_160058_create_menadzer',1),(8,'2018_05_29_160313_create_administrator',1),(9,'2018_05_29_160442_create_repetoar',1),(10,'2018_05_29_162357_create_projekcija',1),(11,'2018_05_29_163405_create_karta',1),(12,'2018_05_29_163912_create_rezervacija',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `projekcija`
--

LOCK TABLES `projekcija` WRITE;
/*!40000 ALTER TABLE `projekcija` DISABLE KEYS */;
/*!40000 ALTER TABLE `projekcija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `repertoar`
--

LOCK TABLES `repertoar` WRITE;
/*!40000 ALTER TABLE `repertoar` DISABLE KEYS */;
/*!40000 ALTER TABLE `repertoar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rezervacija`
--

LOCK TABLES `rezervacija` WRITE;
/*!40000 ALTER TABLE `rezervacija` DISABLE KEYS */;
/*!40000 ALTER TABLE `rezervacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `salterski_sluzbenik`
--

LOCK TABLES `salterski_sluzbenik` WRITE;
/*!40000 ALTER TABLE `salterski_sluzbenik` DISABLE KEYS */;
/*!40000 ALTER TABLE `salterski_sluzbenik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `zaposleni`
--

LOCK TABLES `zaposleni` WRITE;
/*!40000 ALTER TABLE `zaposleni` DISABLE KEYS */;
/*!40000 ALTER TABLE `zaposleni` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29 18:47:07
