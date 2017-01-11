CREATE DATABASE  IF NOT EXISTS `rote`;
USE `rote`;

/* Turn foreign key checks off temporarily to allow possible deletion of linked tables. */
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `namespace` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext,
  PRIMARY KEY (`namespace`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `note_category`;
CREATE TABLE `note_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `when_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `when_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` longtext,
  `category_id` int(11) NOT NULL,
  `when_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `when_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `note_note_category_idx` (`category_id`),
  CONSTRAINT `note_note_category` FOREIGN KEY (`category_id`) REFERENCES `note_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/* Make sure we turn foreign key checks back on now we're done! */
SET FOREIGN_KEY_CHECKS=1;
