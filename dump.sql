/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.3-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: Laravel
-- ------------------------------------------------------
-- Server version	11.8.3-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `compte_bancaires`
--

DROP TABLE IF EXISTS `compte_bancaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `compte_bancaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `numeroClient` bigint(20) unsigned NOT NULL,
  `solde` int(11) NOT NULL,
  `typeDeCompte` varchar(255) NOT NULL,
  `dateOuverture` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `compte_bancaires_numeroclient_foreign` (`numeroClient`),
  CONSTRAINT `compte_bancaires_numeroclient_foreign` FOREIGN KEY (`numeroClient`) REFERENCES `compte_clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compte_bancaires`
--

LOCK TABLES `compte_bancaires` WRITE;
/*!40000 ALTER TABLE `compte_bancaires` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `compte_bancaires` VALUES
(1,1,451717799,'Individuel','2025-11-05'),
(2,2,5435359,'Individuel','2025-11-09');
/*!40000 ALTER TABLE `compte_bancaires` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `compte_clients`
--

DROP TABLE IF EXISTS `compte_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `compte_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `numeroTel` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compte_clients`
--

LOCK TABLES `compte_clients` WRITE;
/*!40000 ALTER TABLE `compte_clients` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `compte_clients` VALUES
(1,'Lefort','Paul','31 Rue Lavoisier',609316496,'paul.lefort.sio@gmail.com'),
(2,'Royant','Aurelien','neuilly plaissance',609316496,'truc@gmail.com');
/*!40000 ALTER TABLE `compte_clients` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `comptebancaire_compteclient`
--

DROP TABLE IF EXISTS `comptebancaire_compteclient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comptebancaire_compteclient` (
  `idClient` bigint(20) unsigned NOT NULL,
  `idCompteBancaire` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idClient`,`idCompteBancaire`),
  KEY `comptebancaire_compteclient_idcomptebancaire_foreign` (`idCompteBancaire`),
  CONSTRAINT `comptebancaire_compteclient_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `compte_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comptebancaire_compteclient_idcomptebancaire_foreign` FOREIGN KEY (`idCompteBancaire`) REFERENCES `compte_bancaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comptebancaire_compteclient`
--

LOCK TABLES `comptebancaire_compteclient` WRITE;
/*!40000 ALTER TABLE `comptebancaire_compteclient` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `comptebancaire_compteclient` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(5,'2025_09_29_073741_add_uuid_to_users_table',1),
(6,'2025_10_08_151954_add_customer_number_to_users_table',1),
(7,'2025_10_08_153649_remove_uuid_from_users_table',1),
(128,'2014_10_12_000000_create_users_table',2),
(129,'2014_10_12_100000_create_password_reset_tokens_table',2),
(130,'2019_08_19_000000_create_failed_jobs_table',2),
(131,'2019_12_14_000001_create_personal_access_tokens_table',2),
(132,'2025_11_05_142628_create_compte_clients_table',2),
(133,'2025_11_05_143521_create_compte_bancaires_table',2),
(134,'2025_11_05_151736_create_comptebancaire_compteclient_table',2),
(135,'2025_11_05_153635_create_operations_table',2),
(136,'2025_11_12_000000_modify_users_table_add_numero',3),
(137,'2025_11_26_133838_modify_user_table_add_status',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `operations`
--

DROP TABLE IF EXISTS `operations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `operations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `typeOperation` varchar(255) NOT NULL,
  `dateOperation` datetime NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `compteDebite` bigint(20) unsigned DEFAULT NULL,
  `compteCredite` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operations_comptedebite_foreign` (`compteDebite`),
  KEY `operations_comptecredite_foreign` (`compteCredite`),
  CONSTRAINT `operations_comptecredite_foreign` FOREIGN KEY (`compteCredite`) REFERENCES `compte_bancaires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `operations_comptedebite_foreign` FOREIGN KEY (`compteDebite`) REFERENCES `compte_bancaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operations`
--

LOCK TABLES `operations` WRITE;
/*!40000 ALTER TABLE `operations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `operations` VALUES
(1,'C','2025-11-05 20:34:44',100.00,NULL,1),
(2,'C','2025-11-05 20:35:39',1000000.00,NULL,1),
(3,'D','2025-11-05 20:36:02',1000000.00,1,NULL),
(4,'C','2025-11-05 20:39:00',1.00,NULL,1),
(5,'C','2025-11-06 12:10:58',10000000.00,NULL,1),
(6,'D','2025-11-06 12:11:27',43234432.00,1,NULL),
(7,'D','2025-11-06 12:12:20',43234432.00,1,NULL),
(8,'C','2025-11-09 20:04:12',523452345.00,NULL,1),
(9,'V','2025-11-09 20:04:26',5.00,1,2),
(10,'D','2025-11-10 07:49:12',500000.00,1,NULL),
(11,'C','2025-11-12 13:06:29',5000000.00,NULL,1),
(12,'D','2025-11-12 15:07:15',12.00,1,NULL);
/*!40000 ALTER TABLE `operations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_numero_unique` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,1,'12345678','$2y$12$Il.PITIif6D1ibqOME88ierqJr.jvdJRM6eGYtMDkBB/sV0dQWYNi',NULL,'2025-11-12 12:20:21','2025-11-12 12:20:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-11-26 17:51:35
