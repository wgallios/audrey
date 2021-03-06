DROP TABLE IF EXISTS `codes`;

CREATE TABLE `codes` (
  `group` int(10) unsigned NOT NULL,
  `code` int(10) unsigned NOT NULL,
  `display` varchar(300) DEFAULT NULL,
  `active` binary(1) DEFAULT NULL,
  `editable` binary(1) DEFAULT NULL,
  PRIMARY KEY (`group`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert  into `codes`(`group`,`code`,`display`,`active`,`editable`) values
(1,0,'User statuses','1','0'),
(1,1,'Active','1','0'),
(1,2,'Disabled','1','0'),
(1,3,'Deleted','1','1'),
(2,0,'Relationship Statuses','1','1'),
(2,1,'Single','1','1'),
(2,2,'In a Relationship','1','1'),
(2,3,'Married','1','1'),
(2,4,'Divorced','1','1'),
(2,5,'It\'s Complicated =/','1','1'),
(3,0,'Weight Types','1','0'),
(3,1,'Lbs','1','0'),
(3,2,'Kg','1','0'),
(4,0,'Gender Types','1','1'),
(4,1,'Male','1','1'),
(4,2,'Female','1','1');
