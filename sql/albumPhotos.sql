DROP TABLE IF EXISTS `albumPhotos`;

CREATE TABLE `albumPhotos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datestamp` datetime DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `caption` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

