DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datestamp` datetime DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `passwd` varchar(250) DEFAULT NULL,
  `firstName` varchar(250) DEFAULT NULL,
  `lastName` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `status` smallint(5) unsigned DEFAULT NULL,
  `permissions` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
