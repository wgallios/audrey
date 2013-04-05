DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `bit` bigint(20) unsigned NOT NULL,
  `label` varchar(250) DEFAULT NULL,
  `Description` text,
  `active` binary(1) DEFAULT NULL,
  PRIMARY KEY (`bit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert  into `permissions`(`bit`,`label`,`Description`,`active`) values 
(1,'Admin','Gives users admin permissions to the site.','1'),
(2,'User','Regular Backend User.','1'),
(4,'Assign Permissions','Allows user to assign permissions to other users.','1');
