/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `bit` bigint(20) unsigned NOT NULL,
  `label` varchar(250) DEFAULT NULL,
  `Description` text,
  `active` binary(1) DEFAULT NULL,
  PRIMARY KEY (`bit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `permissions` */

insert  into `permissions`(`bit`,`label`,`Description`,`active`) values 
(1,'Admin','Gives users admin permissions to the site.','1'),
(2,'User','Regular Backend User.','1'),
(4,'Assign Permissions','Allows user to assign permissions to other users.','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
