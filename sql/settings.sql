/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `settings` */

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
  `authKey` char(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
