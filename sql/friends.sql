DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `datestamp` datetime DEFAULT NULL,
    `userid` int(10) UNSIGNED DEFAULT NULL,
    `domain` VARCHAR(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
