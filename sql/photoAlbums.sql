DROP TABLE IF EXISTS `photoAlbums`;

CREATE TABLE `photoAlbums` (
      `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
      `datestamp` DATETIME NULL ,
      `albumName` VARCHAR(150) NULL ,
      `deleted` BINARY NULL ,
      `deleteDate` DATETIME NULL ,
      PRIMARY KEY (`id`) )
ENGINE = InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
