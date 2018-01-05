-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.29-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para escuela
CREATE DATABASE IF NOT EXISTS `escuela` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `escuela`;

-- Volcando estructura para tabla escuela.t_alumnos
CREATE TABLE IF NOT EXISTS `t_alumnos` (
  `id_t_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `ap_paterno` varchar(80) DEFAULT NULL,
  `ap_materno` varchar(80) DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_t_usuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla escuela.t_alumnos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `t_alumnos` DISABLE KEYS */;
INSERT INTO `t_alumnos` (`id_t_usuarios`, `nombre`, `ap_paterno`, `ap_materno`, `activo`) VALUES
	(1, 'John', 'Dow', 'Down', 1);
/*!40000 ALTER TABLE `t_alumnos` ENABLE KEYS */;

-- Volcando estructura para tabla escuela.t_calificaciones
CREATE TABLE IF NOT EXISTS `t_calificaciones` (
  `id_t_calificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `id_t_materias` int(11) NOT NULL,
  `id_t_usuarios` int(11) NOT NULL,
  `calificacion` decimal(10,2) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_t_calificaciones`),
  KEY `id_t_materias` (`id_t_materias`),
  CONSTRAINT `t_calificaciones_ibfk_1` FOREIGN KEY (`id_t_materias`) REFERENCES `t_materias` (`id_t_materias`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla escuela.t_calificaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `t_calificaciones` DISABLE KEYS */;
INSERT INTO `t_calificaciones` (`id_t_calificaciones`, `id_t_materias`, `id_t_usuarios`, `calificacion`, `fecha_registro`) VALUES
	(19, 3, 1, 6.00, '2018-01-05');
/*!40000 ALTER TABLE `t_calificaciones` ENABLE KEYS */;

-- Volcando estructura para tabla escuela.t_materias
CREATE TABLE IF NOT EXISTS `t_materias` (
  `id_t_materias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_t_materias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla escuela.t_materias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `t_materias` DISABLE KEYS */;
INSERT INTO `t_materias` (`id_t_materias`, `nombre`, `activo`) VALUES
	(1, 'matematicas', 1),
	(2, 'programacion I', 1),
	(3, 'ingenieria de sofware', 1);
/*!40000 ALTER TABLE `t_materias` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
