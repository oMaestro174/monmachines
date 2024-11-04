-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           8.0.40 - MySQL Community Server - GPL
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para machine_monitoring
DROP DATABASE IF EXISTS `machine_monitoring`;
CREATE DATABASE IF NOT EXISTS `machine_monitoring` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `machine_monitoring`;

-- Copiando estrutura para tabela machine_monitoring.machines
DROP TABLE IF EXISTS `machines`;
CREATE TABLE IF NOT EXISTS `machines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` enum('running','stopped','maintenance','inactive','overload','morra') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela machine_monitoring.machines: ~3 rows (aproximadamente)
INSERT INTO `machines` (`id`, `name`, `status`, `last_updated`) VALUES
	(1, 'Machine 1', 'maintenance', '2024-11-02 20:27:12'),
	(2, 'Machine 2', 'overload', '2024-11-02 14:39:04'),
	(3, 'Machine 3', 'morra', '2024-11-02 20:35:48');

-- Copiando estrutura para tabela machine_monitoring.status_history
DROP TABLE IF EXISTS `status_history`;
CREATE TABLE IF NOT EXISTS `status_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `machine_id` int NOT NULL,
  `status` enum('running','stopped','maintenance','inactive','overload','morra') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `changed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `machine_id` (`machine_id`),
  CONSTRAINT `status_history_ibfk_1` FOREIGN KEY (`machine_id`) REFERENCES `machines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela machine_monitoring.status_history: ~24 rows (aproximadamente)
INSERT INTO `status_history` (`id`, `machine_id`, `status`, `changed_at`) VALUES
	(1, 2, 'running', '2024-11-02 05:03:00'),
	(2, 3, 'maintenance', '2024-11-02 05:03:10'),
	(3, 3, 'running', '2024-11-02 05:11:03'),
	(4, 3, 'stopped', '2024-11-02 05:13:26'),
	(5, 3, 'maintenance', '2024-11-02 05:18:21'),
	(6, 2, 'stopped', '2024-11-02 05:18:46'),
	(7, 2, 'stopped', '2024-11-02 14:35:42'),
	(8, 1, 'maintenance', '2024-11-02 14:36:06'),
	(9, 1, 'running', '2024-11-02 14:36:09'),
	(10, 2, 'inactive', '2024-11-02 14:39:01'),
	(11, 2, 'overload', '2024-11-02 14:39:04'),
	(12, 1, 'overload', '2024-11-02 14:39:35'),
	(13, 1, 'maintenance', '2024-11-02 14:39:49'),
	(14, 1, 'stopped', '2024-11-02 14:39:58'),
	(15, 1, 'running', '2024-11-02 20:24:25'),
	(16, 1, 'maintenance', '2024-11-02 20:24:26'),
	(17, 1, 'inactive', '2024-11-02 20:24:26'),
	(18, 1, 'overload', '2024-11-02 20:24:27'),
	(19, 1, 'maintenance', '2024-11-02 20:27:09'),
	(20, 1, 'stopped', '2024-11-02 20:27:09'),
	(21, 1, 'running', '2024-11-02 20:27:10'),
	(22, 1, 'overload', '2024-11-02 20:27:11'),
	(23, 1, 'inactive', '2024-11-02 20:27:11'),
	(24, 1, 'maintenance', '2024-11-02 20:27:12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
