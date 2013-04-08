DROP TABLE IF EXISTS `dbUpgradeFiles`;

CREATE TABLE `dbUpgradeFiles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `datestamp` datetime DEFAULT NULL,
    `userid` INT(10) UNSIGNED DEFAULT 0,
    `filename` VARCHAR(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


