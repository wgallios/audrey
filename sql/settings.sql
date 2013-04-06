DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `firstName` varchar(250) DEFAULT NULL,
  `lastName` varchar(250) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` smallint(5) DEFAULT NULL,
  `heightFeet` smallint(5) unsigned DEFAULT NULL,
  `heightInches` smallint(5) unsigned DEFAULT NULL,
  `weight` smallint(6) DEFAULT NULL,
  `weightType` smallint(6) DEFAULT NULL,
  `relationshipStatus` smallint(6) DEFAULT NULL,
  `aboutMe` text,
  `majorVersion` int(10) unsigned DEFAULT NULL,
  `minorVersion` int(10) unsigned DEFAULT NULL,
  `authKey` char(16) DEFAULT NULL,
  `siteTitle` VARCHAR(150) DEFAULT NULL,
  `profilePicture` VARCHAR(300) DEFAULT NULL,
  `domain` VARCHAR(300) DEFAULT NULL,
  `seoCrawable` BINARY DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


