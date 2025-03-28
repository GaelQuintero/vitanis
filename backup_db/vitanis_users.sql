-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: vitanis
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (20,'Admin User','admin@example.com',NULL,'$2y$12$Z6Jx4.JW3VgKKN05.anfquJ9TCygZIK6IVP11jgZFZbuMkwQOprtW',NULL,'2025-03-21 03:50:29','2025-03-21 03:50:29'),(21,'Imelda Krajcik','susie.kris@example.net','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','2dB9WCvOPd','2025-03-21 03:50:30','2025-03-21 03:50:30'),(22,'Dr. Brando Ryan','forrest61@example.net','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','sw7sCtlTsS','2025-03-21 03:50:30','2025-03-21 03:50:30'),(23,'Alva Little','heath68@example.com','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','A1SDREGdAH','2025-03-21 03:50:30','2025-03-21 03:50:30'),(24,'Lurline Bernhard','bianka.ritchie@example.org','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','w69RAhbL9U','2025-03-21 03:50:30','2025-03-21 03:50:30'),(25,'Savannah Kemmer DVM','zella.ferry@example.net','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','IXyMZmUWmK','2025-03-21 03:50:30','2025-03-21 03:50:30'),(26,'Mr. Willis Pacocha V','ynicolas@example.net','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','qzWkpwKbyQ','2025-03-21 03:50:30','2025-03-21 03:50:30'),(27,'Dr. Bennie Blick Jr.','cloyd.fisher@example.com','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','6h5yrjhMoj','2025-03-21 03:50:30','2025-03-21 03:50:30'),(28,'Reginald Anderson','smitham.henriette@example.com','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','So3PwJ4kgu','2025-03-21 03:50:30','2025-03-21 03:50:30'),(29,'Selena Schumm','jacky13@example.net','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','FgTxJPx16V','2025-03-21 03:50:30','2025-03-21 03:50:30'),(30,'Maximillia Leffler','camron54@example.org','2025-03-21 03:50:30','$2y$12$KHmX97bPfzORjMYWuDRSc.XJqwhEJExo9qALL5y0qF2MWTbG0nsXC','Xe2zo5orLU','2025-03-21 03:50:30','2025-03-21 03:50:30'),(31,'Prof. Nayeli Robel','diamond90@example.org','2025-03-21 03:51:26','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','TQmAj6jNFq','2025-03-21 03:51:26','2025-03-21 03:51:26'),(32,'Ivah Rice','dorothea43@example.net','2025-03-21 03:51:27','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','ZjQqbqnXkK','2025-03-21 03:51:27','2025-03-21 03:51:27'),(33,'Dr. Melany Shields','aiden.oconnell@example.net','2025-03-21 03:51:27','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','b4US5porad','2025-03-21 03:51:27','2025-03-21 03:51:27'),(34,'Ada Lubowitz','rtromp@example.org',NULL,'$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','gbywoPPcfN','2025-03-21 03:51:27','2025-03-21 03:51:27'),(35,'Stephan Abbott','stroman.laurel@example.org','2025-03-21 03:51:27','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','xzmBbMhhiO','2025-03-21 03:51:27','2025-03-21 03:51:27'),(36,'Travis Cremin','qklein@example.org',NULL,'$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','onRXPVPB2P','2025-03-21 03:51:28','2025-03-21 03:51:28'),(37,'Prof. Benny Witting I','keira22@example.com','2025-03-21 03:51:28','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','9CTqW7zYpg','2025-03-21 03:51:28','2025-03-21 03:51:28'),(38,'Orland Becker','caleigh74@example.org','2025-03-21 03:51:28','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','RpyNcDwd0x','2025-03-21 03:51:28','2025-03-21 03:51:28'),(39,'Miss Marian Kreiger','reynold.legros@example.net','2025-03-21 03:51:28','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','huimF2nJzk','2025-03-21 03:51:28','2025-03-21 03:51:28'),(40,'Yadira Pouros Jr.','zhauck@example.org','2025-03-21 03:51:28','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','peaQuvBZxh','2025-03-21 03:51:28','2025-03-21 03:51:28'),(41,'Mrs. Lori Haley III','weissnat.nigel@example.com','2025-03-21 03:51:29','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','owrrHb6B69','2025-03-21 03:51:29','2025-03-21 03:51:29'),(42,'Miss Evalyn Lockman','marilyne70@example.com','2025-03-21 03:51:29','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','q5JKJKbO94','2025-03-21 03:51:29','2025-03-21 03:51:29'),(43,'Bertha Bogisich DDS','audrey73@example.org','2025-03-21 03:51:29','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','EeBNWpe1Uf','2025-03-21 03:51:29','2025-03-21 03:51:29'),(44,'Dr. Zion Johnston','upton.leda@example.net','2025-03-21 03:51:29','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','LIpuafRF5r','2025-03-21 03:51:29','2025-03-21 03:51:29'),(45,'Prof. Thad Kovacek II','geo.mosciski@example.com','2025-03-21 03:51:29','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','CHUm38jn06','2025-03-21 03:51:29','2025-03-21 03:51:29'),(46,'Brannon Volkman MD','krath@example.net','2025-03-21 03:51:31','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','f1Eb0GsQZS','2025-03-21 03:51:31','2025-03-21 03:51:31'),(47,'Gideon Larson','cmraz@example.com','2025-03-21 03:51:31','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','p7gcC5n7XC','2025-03-21 03:51:31','2025-03-21 03:51:31'),(48,'Dr. Tiana Bartell PhD','wrunolfsdottir@example.org','2025-03-21 03:51:31','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','Rv7TkMBu1P','2025-03-21 03:51:31','2025-03-21 03:51:31'),(49,'Dr. Rebecca Lindgren Jr.','witting.katelynn@example.org','2025-03-21 03:51:31','$2y$12$mqq/So93gGbfAQ06WWgdNebyy1w0SSZdYE4XEbdf2AzLcN7UdSY4C','paDz3Vzguz','2025-03-21 03:51:31','2025-03-21 03:51:31'),(50,'Liti','robertogael664@gmail.com',NULL,'$2y$12$LGStgvQEK9Ff.Xbm4NnkaeV2F5iTljLk1G6/YErI/D65gEvjY3im.',NULL,'2025-03-21 05:19:06','2025-03-21 05:19:06');
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

-- Dump completed on 2025-03-20 18:46:09
