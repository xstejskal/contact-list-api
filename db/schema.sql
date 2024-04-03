SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `company` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `company`, `email`) VALUES
(1,	'Jan',	'Stejskal',	NULL,	'xstejskal@centrum.cz');

DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `contact_id` int(10) unsigned NOT NULL,
  `number` varchar(16) NOT NULL,
  PRIMARY KEY (`contact_id`,`number`),
  CONSTRAINT `phone_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `phone` (`contact_id`, `number`) VALUES
(1,	'+420111222333'),
(1,	'+420333222111');