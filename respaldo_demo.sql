-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: trazabilidad
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `material_id` bigint unsigned NOT NULL,
  `quantity` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventories_material_id_foreign` (`material_id`),
  CONSTRAINT `inventories_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (1,4,-52.00,'2026-05-24 06:36:10','2026-05-24 07:06:06'),(2,3,-48.00,'2026-05-24 07:06:30','2026-05-24 07:06:30');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labor_entries`
--

DROP TABLE IF EXISTS `labor_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labor_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `worker_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `work_date` date NOT NULL,
  `hours` decimal(8,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `labor_entries_worker_id_foreign` (`worker_id`),
  KEY `labor_entries_project_id_foreign` (`project_id`),
  CONSTRAINT `labor_entries_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `labor_entries_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labor_entries`
--

LOCK TABLES `labor_entries` WRITE;
/*!40000 ALTER TABLE `labor_entries` DISABLE KEYS */;
INSERT INTO `labor_entries` VALUES (1,2,2,'2026-06-02',3.00,'Se corta el material','2026-06-02 07:10:23','2026-06-02 07:10:23'),(2,3,2,'2026-06-02',7.00,NULL,'2026-06-02 07:23:09','2026-06-02 07:39:04'),(3,2,3,'2026-06-02',6.00,'Cortar laterales y traseros','2026-06-02 18:51:07','2026-06-02 18:51:07'),(4,2,3,'2026-06-03',19.00,'| Se corto bases | Se cortan las bases #10, #11 y #12.\r\nSe cortan las paredes de carros #10 #11 y #12 | No hay','2026-06-03 05:42:25','2026-06-04 05:14:28'),(5,3,3,'2026-06-03',15.00,'Se pule y trazan dos bases | Se pule y trazan dos bases | Soldando base #2 (Indumet)','2026-06-03 06:36:09','2026-06-03 18:17:47'),(6,4,3,'2026-06-03',6.00,'Supervicion detallada de el trazo y pre ensamble de base con canales | Supervicion detallada de el trazo y pre ensamble de base con canales','2026-06-03 07:45:56','2026-06-03 07:51:05'),(7,3,3,'2026-06-04',6.00,'Soldadura de base #3 (Indumet) | Soldadura de base #3 (Indumet)','2026-06-03 18:18:23','2026-06-03 18:18:32'),(8,3,3,'2026-06-02',4.00,'dejela asi | dejela asi','2026-06-03 18:19:54','2026-06-03 18:20:03'),(9,2,3,'2026-06-04',3.00,'Tampoco hay','2026-06-04 05:15:09','2026-06-04 05:15:09');
/*!40000 ALTER TABLE `labor_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_cost` decimal(12,2) DEFAULT NULL,
  `initial_quantity` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_quantity` decimal(10,2) DEFAULT NULL,
  `purchase_cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `materials_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (3,'MAT-00002','Tungsteno 3/32\" azul','und',1200.00,100.00,'2026-05-24 05:32:50','2026-05-26 07:07:36','unidad',NULL,12000.00),(4,'MAT-00004','Disco corte 4 1/2\" x 3/32\"','und',1360.00,0.00,'2026-05-24 05:58:33','2026-05-24 05:58:33',NULL,NULL,NULL),(7,'MAT-00005','Disco flap 4 1/2\" grano 80','und',600.00,0.00,'2026-05-25 06:17:39','2026-05-25 06:18:02',NULL,NULL,NULL),(8,'MAT-00008','Ringlete','und',12000.00,10.00,'2026-06-02 18:43:11','2026-06-03 06:56:50','unidad',NULL,12000.00),(9,'MAT-00009','Escobillas pulidora wurth','und',16000.00,2.00,'2026-06-03 07:43:28','2026-06-03 07:43:28','unidad',NULL,16000.00),(10,'MAT-00010','Disco pulir 4 1/2\" 1/4\"','und',8000.00,10.00,'2026-06-03 18:12:54','2026-06-03 18:12:54','unidad',NULL,8000.00),(11,'MAT-00011','Disco corte 7\"','und',15000.00,10.00,'2026-06-04 22:22:19','2026-06-04 22:22:19','unidad',NULL,15000.00),(12,'MAT-00012','Flexometro','und',20000.00,5.00,'2026-06-09 06:43:51','2026-06-09 06:43:51','Unidad',NULL,20000.00);
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_20_004924_create_materials_table',1),(5,'2026_05_20_004925_create_inventories_table',1),(6,'2026_05_20_004925_create_projects_table',1),(7,'2026_05_20_014731_create_movements_table',1),(8,'2026_05_21_021437_add_budget_to_projects_table',1),(9,'2026_05_21_023840_create_workers_table',1),(10,'2026_05_21_023913_create_project_worker_table',1),(11,'2026_05_23_235017_add_purchase_fields_to_materials_table',2),(12,'2026_05_24_004139_add_code_to_materials_table',3),(13,'2026_05_26_015415_add_initial_quantity_to_materials_table',4),(14,'2026_06_02_015232_create_labor_entries_table',5),(15,'2026_06_04_004221_add_worker_id_to_movements_table',6),(16,'2026_06_04_014932_add_role_to_users_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('in','out','return','adjust') COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `quantity` decimal(12,2) NOT NULL,
  `barcode_scanned` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `worker_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movements_material_id_foreign` (`material_id`),
  KEY `movements_project_id_foreign` (`project_id`),
  KEY `movements_user_id_foreign` (`user_id`),
  KEY `movements_worker_id_foreign` (`worker_id`),
  CONSTRAINT `movements_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `movements_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `movements_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movements`
--

LOCK TABLES `movements` WRITE;
/*!40000 ALTER TABLE `movements` DISABLE KEYS */;
INSERT INTO `movements` VALUES (1,'out',4,2,1,2.00,'MAT-00004',NULL,'2026-05-24 06:36:10','2026-05-24 06:36:10',NULL),(2,'out',4,2,1,20.00,'MAT-00004',NULL,'2026-05-24 07:05:15','2026-05-24 07:05:15',NULL),(3,'out',4,2,1,30.00,'MAT-00004',NULL,'2026-05-24 07:06:06','2026-05-24 07:06:06',NULL),(4,'out',3,2,1,48.00,'MAT-00002',NULL,'2026-05-24 07:06:30','2026-05-24 07:06:30',NULL),(5,'out',7,2,1,10.00,'MAT-00005',NULL,'2026-05-25 06:18:54','2026-05-25 06:18:54',NULL),(6,'in',3,NULL,1,50.00,'MAT-00002','Ajuste por edición','2026-05-26 07:07:11','2026-05-26 07:07:11',NULL),(7,'in',3,NULL,1,50.00,'MAT-00002','Ajuste por edición','2026-05-26 07:07:36','2026-05-26 07:07:36',NULL),(8,'out',3,2,1,10.00,'MAT-00002',NULL,'2026-05-26 07:08:04','2026-05-26 07:08:04',NULL),(9,'in',8,NULL,1,10.00,'MAT-00008','Stock inicial','2026-06-02 18:43:11','2026-06-02 18:43:11',NULL),(10,'out',8,2,1,1.00,'MAT-00008','Para la primera linea de tubería','2026-06-02 18:44:51','2026-06-02 18:44:51',NULL),(11,'out',8,3,1,1.00,'MAT-00008','Pulir traseros','2026-06-02 19:20:18','2026-06-02 19:20:18',NULL),(12,'out',8,3,1,2.00,'MAT-00008',NULL,'2026-06-03 07:20:51','2026-06-03 07:20:51',NULL),(13,'out',8,3,1,1.00,'MAt-00008',NULL,'2026-06-03 07:32:58','2026-06-03 07:32:58',NULL),(14,'in',9,NULL,1,2.00,'MAT-00009','Stock inicial','2026-06-03 07:43:28','2026-06-03 07:43:28',NULL),(15,'out',9,3,1,2.00,'Mat-00009','Se cambian escobillas a pulidora wurth','2026-06-03 07:44:04','2026-06-03 07:44:04',NULL),(16,'in',10,NULL,1,10.00,'MAT-00010','Stock inicial','2026-06-03 18:12:54','2026-06-03 18:12:54',NULL),(17,'out',8,3,1,1.00,'mat-00008','Para pulir bases 11, 12 y 13','2026-06-03 18:14:55','2026-06-03 18:14:55',NULL),(18,'out',8,2,1,1.00,'Mat-00008','Pulir tuberia','2026-06-03 18:34:00','2026-06-03 18:34:00',NULL),(19,'out',8,3,1,1.00,'Mat-00008','Pulir rapido','2026-06-04 05:59:17','2026-06-04 05:59:17',2),(20,'out',8,3,1,1.00,'Mat-00008','Pulir fondos 12 y 13','2026-06-04 22:21:11','2026-06-04 22:21:11',2),(21,'in',11,NULL,1,10.00,'MAT-00011','Stock inicial','2026-06-04 22:22:19','2026-06-04 22:22:19',NULL),(22,'out',8,3,1,1.00,'Mat-00008','Pulir todavia','2026-06-04 23:16:06','2026-06-04 23:16:06',3),(23,'out',4,2,2,1.00,'MAT-00004','Desde mi pc','2026-06-09 06:27:52','2026-06-09 06:27:52',2),(24,'in',12,NULL,2,5.00,'MAT-00012','Stock inicial','2026-06-09 06:43:51','2026-06-09 06:43:51',NULL),(25,'out',12,3,2,1.00,'MAT-00012','Desde otro pc','2026-06-09 06:51:50','2026-06-09 06:51:50',2),(26,'out',12,2,2,1.00,'MAT-00012','Desde pc de milena','2026-06-09 07:11:16','2026-06-09 07:11:16',3),(27,'out',12,2,2,1.00,'Mat-00012','Desde celular','2026-06-09 07:12:53','2026-06-09 07:12:53',4),(28,'out',8,2,3,1.00,'Mat-00008','jhsfgjkaefhugqe','2026-06-09 18:07:26','2026-06-09 18:07:26',3),(29,'out',12,2,2,2.00,'Mat-00012','Todo bien','2026-06-10 06:47:11','2026-06-10 06:47:11',2);
/*!40000 ALTER TABLE `movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_worker`
--

DROP TABLE IF EXISTS `project_worker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_worker` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `worker_id` bigint unsigned NOT NULL,
  `hours` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_worker_project_id_foreign` (`project_id`),
  KEY `project_worker_worker_id_foreign` (`worker_id`),
  CONSTRAINT `project_worker_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_worker_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_worker`
--

LOCK TABLES `project_worker` WRITE;
/*!40000 ALTER TABLE `project_worker` DISABLE KEYS */;
INSERT INTO `project_worker` VALUES (3,2,2,40.00,'2026-05-24 05:15:41','2026-06-04 22:26:30'),(4,2,3,40.00,'2026-05-31 06:42:42','2026-06-04 22:26:30'),(5,3,2,50.00,'2026-06-02 18:47:36','2026-06-02 18:47:36'),(6,3,3,50.00,'2026-06-02 18:47:36','2026-06-02 18:47:36'),(7,2,4,40.00,'2026-06-04 22:26:30','2026-06-04 22:26:30');
/*!40000 ALTER TABLE `project_worker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('planned','active','finished') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'planned',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `estimated_hours` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (2,'Acoplar tuberia',5000000.00,'Super','planned',NULL,NULL,45,'2026-05-24 05:14:58','2026-05-24 05:14:58'),(3,'Carros Tommy',100000000.00,'Industrias Tommy','planned',NULL,NULL,300,'2026-06-02 18:46:27','2026-06-02 18:46:27');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0iDRIkylbd2Obp6vt9OMeIdMy56HuQaA4sFyx1yf',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiazA4WGZLNWY5S1dlT0txU0p1UXhMazJMR2JrdUlBa253MHN0dGNzQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781057568),('3ScoIo99p52hBCL7R8R1wXDpsjN7gOzKdEz3j7UE',2,'192.168.1.23','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoic3F6VzJSZklOalZscWJUdWVsY3EyOUE2RWdIWXQ5NTNKOGZQa3poNyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTkyLjE2OC4xLjE1OjgwMDAvd2FyZWhvdXNlIjtzOjU6InJvdXRlIjtzOjE1OiJ3YXJlaG91c2UuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1781052356),('41Muz9dcjF1fiXy1OuuKGYOChlrxfjqGvHnNgJ0X',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWdmQTNKT1ZwRVNtcXMxcDVYekhrNzU4cEkyTVFYVFdJQ25UblM4TiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly91cmxzLXRvb2xraXQtZWRnZXMtYnJlYXRoaW5nLnRyeWNsb3VkZmxhcmUuY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781055826),('4X3UXkc0pedSAWIsrHGQ7JHiVeE90vy1p8yu57Kl',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ1g0bWttU050M0x5UHRPc05KMnBZVTdMTG1kWktzaHdnTjdva0NqcyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NzoiaHR0cDovL2NvdW50eS11bHRpbWF0dW0tc2lyZW4ubmdyb2stZnJlZS5kZXYvdXNlcnMvY3JlYXRlIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L3VzZXJzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxMjoidXNlcnMuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781059853),('57Y2DxZW1tanjpH7mUIp05WaHxEcm6czo9JDdiDt',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclI1UFhOMjVRNFJwYUsxRTQzUGFNSWhmeGRQdWhrQTVjS2JGUXdwaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L3Byb2plY3RzIjtzOjU6InJvdXRlIjtzOjE0OiJwcm9qZWN0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1781060632),('5DAhxEmuH7f6d7Bwn4F5u9qc2aCXmAi0Jtm393yi',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOEZ1c1hxUHFnUjB5NWlZUnZuWk9HMVF4dFhpdzA5Z2FucEpJcXM3TiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cDovL2NvdW50eS11bHRpbWF0dW0tc2lyZW4ubmdyb2stZnJlZS5kZXYvZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781058478),('97FQVBY9swjmjWOUHSPoiRUUTvFXiZtQIZ2Je132',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidUxReGNrSFk4T3JxTVVTMGlSMldPblhmTnA2WmtQYjE4U1hYU21xZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781058513),('9Eq4hfQCeiNJIwCSrBrYPVqGuF3pDUhJpJaPudXr',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmpTcTQxRHJ5bXlsQVRaVFp6dVllT3Q1WlZEb3V0TlVDSVkzM1ZraCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781058911),('9lThtSOZE2UxtInIrz06rQmxpifOBZm0fr6TiyQ7',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHhpQnBwOENlb0lqcWY5NzQ0Q1pKSm1UUFpiNUJCRk9xQjZrWnhvQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781059350),('9WbfGsTsKMmr2oZbHkA5lFh4m3aLODLjlN7ujY3f',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXVHWnBEMGxHZEpRN3RDRjNrNmtNclI2NDNHaUhVQ1hOUGNRSzNuYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8wLjAuMC4wOjgwMDAvd2FyZWhvdXNlIjtzOjU6InJvdXRlIjtzOjE1OiJ3YXJlaG91c2UuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1781052274),('AYzzpGExO2WckCDCKekqWlRjN5ePSOdufVH0LgWE',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibFhtOTNUNmtZdFZnVmZoQXJFY1VJYkJkVml4U1FlNTBPczBtUGJUbyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2MzoiaHR0cDovL3VybHMtdG9vbGtpdC1lZGdlcy1icmVhdGhpbmcudHJ5Y2xvdWRmbGFyZS5jb20vZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91cmxzLXRvb2xraXQtZWRnZXMtYnJlYXRoaW5nLnRyeWNsb3VkZmxhcmUuY29tL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781055883),('bdpYolM7os7ciUyMSpTtYeww3fYMlo7OiFzFw4uf',NULL,'127.0.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.5 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUloU0ExTkJyUnMwejZUeDNudEtRNzRXOUs3TEFMWGVMYWNyeVR3ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9zaG93ZXJzLXN1cnJvdW5kaW5nLXdpbGwtYXJjaGl0ZWN0LnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781054278),('F3zlmvJALyzkf7iQLNM8Z8AB4tP38vkyxHhb0B3d',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiejV2VG56T3kweElGQk81WUZrSjVhbHpCcEZuaUFzc0VKN0V3S1JhayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cDovL2NvdW50eS11bHRpbWF0dW0tc2lyZW4ubmdyb2stZnJlZS5kZXYvbGFib3IiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo1MDoiaHR0cDovL2NvdW50eS11bHRpbWF0dW0tc2lyZW4ubmdyb2stZnJlZS5kZXYvbGFib3IiO3M6NToicm91dGUiO3M6MTE6ImxhYm9yLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781059350),('f5RdXVBThk5tqKlRhHlAmtkTbMM0dfQrfSJF9ssv',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1c4VmpZQzRFZ1Z1VmlwTTBzOXVsTldjVlRjbm9kSWJndFF2Z3habCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781059853),('fdDBQh8t87hBPifhDTL0l2kQDJ3gJJRXciC7xLDz',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWRBWnhWS2UyUE0wWk56dWE5QVVQYU41VEVTUVltd2RrUTZYdGZubiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781058411),('HcUcPJUUyM5q93zZS8sIVwkIqyDT926icsVvdNG9',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzltcVlIblBnWlc5YWVIdVR1TldZem1HVFR6c3A5MlZKdEVxRUkwWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9zaG93ZXJzLXN1cnJvdW5kaW5nLXdpbGwtYXJjaGl0ZWN0LnRyeWNsb3VkZmxhcmUuY29tIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781054047),('htozJzlrPOCUERXBycOinHd4QwrJkGNusD25NUlr',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoic1F1WWFSMUN4djVqUjVQQldFZW10NUJNVXgzRk51a0U2cWtkMnBQZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9zb3VwLXhib3gtbGlzdGVuaW5nLWNvb2tpbmcudHJ5Y2xvdWRmbGFyZS5jb20iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781055545),('IK4iy5xEpJIZCQxT9S2PuuVGcKt4ziGInZOfwNaW',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGhjUnlmY2x5aXM0R0Q4UlVRY3RqTFpCU3B0R0dkQ011a2hHTElhSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9zaG93ZXJzLXN1cnJvdW5kaW5nLXdpbGwtYXJjaGl0ZWN0LnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781054062),('JtL1wk8atRijfnuPbTVzE7K4gUJ0Cr20kdxNrJvn',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmE2T1JvVWVYQ0JzekxHU2ZHaHJNS0JYemJVS0twZkZxSmJpS0lUMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781059297),('lgDcad4KeSw0BulyF9oRCKAqDPhq3IXZVajs7jps',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEZUcnVTMVdQWnVhRzlBNVYxZ0sxb08zbENuUHVNanlyU29wOXNsVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly91cmxzLXRvb2xraXQtZWRnZXMtYnJlYXRoaW5nLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781056913),('LmvQJdKGCLcHErBmatHPUSG5UAla6nEk9UTpcGL1',2,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM1FTaFM5RWhCdHF2c1ZlWTVEUmpJR2o3WlVQNmVrdW5OQWQwcDIwbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L3VzZXJzIjtzOjU6InJvdXRlIjtzOjExOiJ1c2Vycy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1781060224),('mbOO3z6D51JbfRIpezsyq6GE85fNfAOf32DaR4yh',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVdaNzVIeUl1WVUzbTRCTDc1bEw5THdLZGdicEk4RTRnRWlldWVIcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly9zb3VwLXhib3gtbGlzdGVuaW5nLWNvb2tpbmcudHJ5Y2xvdWRmbGFyZS5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781055560),('mRcXAMoIaDeWI5i93TWP2u9jRXpPZku25WbHyCA8',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoieThLaTE4V0ZlbldUTEtJZWh5blBsNDVUTXFXN1dteVJzNEVUd1VVSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781058411),('NHQv0zpX51aodZzw7sHFKAz76vo4LsYnUjYFeSew',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoicU5vU1Q1T29wcXRCUXpZQlpNem9kclFFaW8weEE5WHpFSnZBUDhtMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781058478),('nkD0fqa4MbEJCljhQoidYWIoF87G6KcNunZ5se1j',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjVWajlxa1BYMURLc2ExSmNXWlRmSEdzVjVub2d1TWZYN0NyV1d4ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9zaG93ZXJzLXN1cnJvdW5kaW5nLXdpbGwtYXJjaGl0ZWN0LnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781054049),('PDPxjX7mfL1RffJtQkOpfAl5HGtmxP74y3v55tff',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXZJRFp4Y0RFR2tDQXZ3QzhqWG44cDVjMjg3Ujg4cUd3MlprMWdwVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly9zb3VwLXhib3gtbGlzdGVuaW5nLWNvb2tpbmcudHJ5Y2xvdWRmbGFyZS5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781055547),('Pmve9oVIFYBtoOsFLx9hTrp3X63FadJDRadaGjZM',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFB0ZHI1d1BySUN5cTlTZDJOVjh6QnJWdEViaWE1REQ0UTZWc2RrMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781059737),('qEUrC676p3RoEelwCtj9gRhqOwGaUyYJ4SDEzoFS',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW5WUUpkaWxZeXJMbXFHWGtCTXg5RUU5V2FVZGFqQ0xGNTJYMjR6SSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781058616),('SJfY5MqfN6kKc7y0SVZgc2BqZrjrFFjdiHk7fs2m',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUk1RVlBMzlGSEdUYjBxMFFWY0YwclFvNlQ1STBia1BZTThFdW9HayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9jb3VudHktdWx0aW1hdHVtLXNpcmVuLm5ncm9rLWZyZWUuZGV2L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781059399),('vwj5RQxjyokiMX8VLrHjauTlK05Zh6WS0CgKgvFC',3,'192.168.1.5','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWjIwMDh5bHBXcHFKdDAyMHg5aFplejhHNEtHY3dNaE5Uczd2cEgxNSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTkyLjE2OC4xLjE1OjgwMDAvd2FyZWhvdXNlIjtzOjU6InJvdXRlIjtzOjE1OiJ3YXJlaG91c2UuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=',1781052547),('Vwog3RCXWQ9qfxqRX1z52lSvbnJhk4xszjyYT47F',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGxEZ2FIMWI2Zk5BcG82cldHdGNocXJHQlFsdUN6dHJBaHlkQmU2cyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC93YXJlaG91c2UiO3M6NToicm91dGUiO3M6MTU6IndhcmVob3VzZS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1781056919),('VwwF5EYrhRxQZ0ACmgANWUYPj9QeFXWJMgfei5q8',2,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTJDb09sckF4bVdXOERNR3gyQ1ZkdFl6M1JvOGVLRG9ZbjhjdW9DMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly9zaG93ZXJzLXN1cnJvdW5kaW5nLXdpbGwtYXJjaGl0ZWN0LnRyeWNsb3VkZmxhcmUuY29tL2ludmVudG9yeSI7czo1OiJyb3V0ZSI7czoxNToiaW52ZW50b3J5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1781054755),('WFkjw1onPFkUoy7BucEdV2if1d5cMnwmhDnOn4u0',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVmNEcTdhOEtPVlo4OEpybWtMMXJIVmVkZmJTMnMzRm0wY2Y1OVhIQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2OToiaHR0cDovL3Nob3dlcnMtc3Vycm91bmRpbmctd2lsbC1hcmNoaXRlY3QudHJ5Y2xvdWRmbGFyZS5jb20vaW52ZW50b3J5Ijt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly9zaG93ZXJzLXN1cnJvdW5kaW5nLXdpbGwtYXJjaGl0ZWN0LnRyeWNsb3VkZmxhcmUuY29tL2ludmVudG9yeSI7czo1OiJyb3V0ZSI7czoxNToiaW52ZW50b3J5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781054061),('Wil3WO3eKrGKj02uNgao6wHOuQkcoKhPZbXcloDQ',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiejRIZWJzZkVpZk5QZ3J5Wk01Y1lBeWVMZ3Nyb2RQSTVScWNzR2FCOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781058853),('WVLKewvZ6Vo3tQQVn9xd9yvPtUvGeYuaErFGIXBs',2,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTThCVUttb1ZuMlpMQnRtS2lCZ0w4Y1A0eDNpVjh2S2xxQ3lqOTRvSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly91cmxzLXRvb2xraXQtZWRnZXMtYnJlYXRoaW5nLnRyeWNsb3VkZmxhcmUuY29tL2ludmVudG9yeSI7czo1OiJyb3V0ZSI7czoxNToiaW52ZW50b3J5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1781056068),('xD13paP35HkSLYbwt2Nfbc8z1idSTy1FnSkKprh3',NULL,'127.0.0.1','WhatsApp/2.23.20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3FVZFFJaHJwZlI5c0gwWEM2bmRiSEhHQnBhbHVWejBsRjNvVVcwTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly91cmxzLXRvb2xraXQtZWRnZXMtYnJlYXRoaW5nLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781055827),('YlyXAGrc9RFteAQW8ivfmvkzGwJ92KMWjUQG1WPW',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTmxpNjBDT2xEYjhEbkxWb2djZ2JjUnNoRzRRWDVRSzMzeXZuUUxEWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbnZlbnRvcnkiO3M6NToicm91dGUiO3M6MTU6ImludmVudG9yeS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1781060594),('Z9K6Q1sVOOwGSINQsEVrZF3BeRy1XgUGsKlPvs8c',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkdJOXQzQTBnMnh2SmdYTXYxbWhNUFY2UTNLMnEzbDFWNDlzV2RVQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly91cmxzLXRvb2xraXQtZWRnZXMtYnJlYXRoaW5nLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781055883),('ZLD2u4x7tLpoPfsYdW1JSAPbcC0SEJOu6rr5CALG',NULL,'127.0.0.1','curl/7.81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTVzRGNJRDRNUXZDQ3NIOThaam1yNm5NYUJYaXFCYUlXcUZlY0VvQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781059257);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

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
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'worker',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Indumet','indumet@gmail.com',NULL,'$2y$12$OePVbxLGw0AqhyEJesgBIOqFwIeFIOnMyhEi7zkMu3/2XwjiIZcG6',NULL,'2026-05-22 07:04:18','2026-06-04 07:37:50','admin'),(2,'Robinson Eduardo Galvez','robinsoneduardogalvez@gmail.com',NULL,'$2y$12$OGE3IY5uuac1ervC9iVFTenq5fpNor6eUv9Q.uaN2RGigHYo86Ku2','YL5a8vFQ6gy00SMTGVQAqbQ0yM4AJX9JdNeMDZV6OEPuxy3uVtPisk4P1Q6i','2026-06-09 06:04:50','2026-06-09 06:04:50','admin'),(3,'Luis Fernando Osorio','luisfernandoosorio@gmail.com',NULL,'$2y$12$xVmscL0vXAh5rLVvCNaCCe3NRVHV6hsZn.sC.qmFqas1au2Z42oEa',NULL,'2026-06-09 07:23:23','2026-06-09 07:23:23','warehouse'),(4,'Ivan Felipe Castañeda','ivanfelipecastaneda@gmail.com',NULL,'$2y$12$xAmxutlOXZbVmL20gCaQOOVI3Tiuj4ABJG1awB14KdeQJkc/lAVTS',NULL,'2026-06-09 08:19:09','2026-06-09 08:19:09','worker'),(5,'Andrés','andres@gmail.com',NULL,'$2y$12$vxMC4Ki6yVvc35eCGZP7luVA.nUcC1QiS986FgSmlQp9S8Yi93j3W',NULL,'2026-06-10 07:51:55','2026-06-10 07:51:55','worker');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hour_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers`
--

LOCK TABLES `workers` WRITE;
/*!40000 ALTER TABLE `workers` DISABLE KEYS */;
INSERT INTO `workers` VALUES (2,'Robinson Eduardo Galvez','Todero',56000.00,'2026-05-24 05:15:26','2026-05-24 05:15:26'),(3,'Andres Rios','Soldador',40000.00,'2026-05-31 06:22:20','2026-05-31 07:02:46'),(4,'Camila Galvez','Supervisora',50000.00,'2026-06-03 07:45:04','2026-06-03 07:45:04');
/*!40000 ALTER TABLE `workers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-09 22:04:28
