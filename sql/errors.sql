DROP TABLE IF EXISTS `errors`;

CREATE TABLE `errors` (
  `id` int(10) unsigned NOT NULL,
  `errorMsg` varchar(300) DEFAULT NULL,
  `description` text,
  `solution` text,
  `url` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


insert  into `errors`(`id`,`errorMsg`,`description`,`solution`,`url`) values 
(1,'SQL ERROR','SQL Error',NULL,'*'),
(2,'Get is not supported','Get is not supported by save info page',NULL,'*'),
(3,'Setup Error',NULL ,NULL,'/setup');
