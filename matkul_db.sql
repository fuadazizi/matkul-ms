-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: matkulms_db
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matkul` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dosen_id_matkul_foreign` (`id_matkul`),
  CONSTRAINT `dosen_id_matkul_foreign` FOREIGN KEY (`id_matkul`) REFERENCES `matakuliah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` VALUES (1,2,'Melody Laksani','2024-11-13 16:08:09','2024-11-13 16:08:09'),(2,2,'Deddy Cahyadi','2024-11-13 16:08:41','2024-11-13 16:08:41'),(3,3,'Faisal Firi','2024-11-13 16:09:07','2024-11-13 16:11:49'),(4,3,'John Harriz','2024-11-13 16:09:48','2024-11-13 16:09:48'),(5,4,'Alan Turing','2024-11-13 16:10:15','2024-11-13 16:10:15'),(6,4,'Fedric Hughman','2024-11-13 16:10:28','2024-11-13 16:10:28'),(7,5,'Alexandra Hartono','2024-11-13 16:10:47','2024-11-13 16:10:47');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwalkuliah`
--

DROP TABLE IF EXISTS `jadwalkuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwalkuliah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_dosen` bigint unsigned NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` time NOT NULL,
  `ruang_kuliah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwalkuliah_id_dosen_foreign` (`id_dosen`),
  CONSTRAINT `jadwalkuliah_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwalkuliah`
--

LOCK TABLES `jadwalkuliah` WRITE;
/*!40000 ALTER TABLE `jadwalkuliah` DISABLE KEYS */;
INSERT INTO `jadwalkuliah` VALUES (1,3,'Jumat','08:30:00','KU3',120,'2024-11-13 16:14:22','2024-11-14 07:21:55'),(6,1,'Jumat','10:30:00','KU3',120,'2024-11-13 16:21:56','2024-11-14 06:54:03'),(8,1,'Jumat','08:30:00','KU3',120,'2024-11-14 00:36:55','2024-11-14 01:48:17');
/*!40000 ALTER TABLE `jadwalkuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mahasiswa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES (1,'Freya','Informatika','2020','2024-11-13 16:03:40','2024-11-13 16:03:40'),(2,'John','Informatika','2020','2024-11-13 16:03:51','2024-11-13 16:03:51'),(4,'Surya','Informatika','2020','2024-11-13 16:04:29','2024-11-13 16:04:29'),(5,'Polkan','Teknik Logistik','2021','2024-11-13 16:04:50','2024-11-13 16:04:50'),(7,'Budi','Informatika','2022','2024-11-14 01:32:13','2024-11-14 01:32:13');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa_jadwal`
--

DROP TABLE IF EXISTS `mahasiswa_jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mahasiswa_jadwal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_jadwal` bigint unsigned NOT NULL,
  `id_mhs` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_jadwal_id_jadwal_foreign` (`id_jadwal`),
  KEY `mahasiswa_jadwal_id_mhs_foreign` (`id_mhs`),
  CONSTRAINT `mahasiswa_jadwal_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwalkuliah` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mahasiswa_jadwal_id_mhs_foreign` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa_jadwal`
--

LOCK TABLES `mahasiswa_jadwal` WRITE;
/*!40000 ALTER TABLE `mahasiswa_jadwal` DISABLE KEYS */;
INSERT INTO `mahasiswa_jadwal` VALUES (4,6,1,'2024-11-13 16:21:56','2024-11-13 16:21:56'),(7,1,1,'2024-11-13 16:21:56','2024-11-14 07:21:22'),(12,8,1,'2024-11-14 00:36:55','2024-11-14 00:36:55'),(16,8,2,'2024-11-14 05:51:19','2024-11-14 05:51:19'),(18,1,2,'2024-11-14 06:04:37','2024-11-14 07:21:22'),(19,6,2,'2024-11-14 06:53:38','2024-11-14 06:53:38'),(20,6,7,'2024-11-14 06:53:38','2024-11-14 06:53:38'),(21,1,7,'2024-11-14 07:21:22','2024-11-14 07:21:22');
/*!40000 ALTER TABLE `mahasiswa_jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matakuliah`
--

DROP TABLE IF EXISTS `matakuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matakuliah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matakuliah`
--

LOCK TABLES `matakuliah` WRITE;
/*!40000 ALTER TABLE `matakuliah` DISABLE KEYS */;
INSERT INTO `matakuliah` VALUES (1,'Daspro',4,'2024-11-13 16:05:39','2024-11-13 16:05:39'),(2,'Fisika Dasar',3,'2024-11-13 16:06:22','2024-11-13 16:06:22'),(3,'Bahasa Inggris',4,'2024-11-13 16:06:34','2024-11-13 16:06:34'),(4,'Machine Learning',2,'2024-11-13 16:06:43','2024-11-13 16:06:43'),(5,'Production Planning',4,'2024-11-13 16:07:11','2024-11-13 16:07:11');
/*!40000 ALTER TABLE `matakuliah` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-14 16:26:42
