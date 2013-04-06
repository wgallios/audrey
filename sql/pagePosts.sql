DROP TABLE IF EXISTS `pagePosts`;

CREATE TABLE `pagePosts` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `datestamp` datetime DEFAULT NULL,
    `userid` int(10) UNSIGNED DEFAULT NULL,
    `domain` VARCHAR(300) DEFAULT NULL,
    `post` TEXT DEFAULT NULL,
    `deleted` BINARY DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
