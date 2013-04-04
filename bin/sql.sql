
SHOW DATABASES;

SHOW TABLES;

EXPLAIN users;

EXPLAIN settings;

EXPLAIN photoAlbums;

EXPLAIN albumPhotos;

UPDATE users SET passwd = SHA1('') WHERE id =


SELECT * FROM albumPhotos WHERE albumId = 5;


SELECT * FROM albumPhotos;

SELECT * 
, codeDisplay(1, status) statusDisplay
FROM
users


SELECT *
, (bit & (SELECT permissions FROM users WHERE id = '1')) as assigned
FROM permissions
WHERE active = 1
ORDER BY label



SELECT *
, (bit & (SELECT permissions FROM users WHERE id = '3')) as assigned
FROM permissions
WHERE active = 1
ORDER BY label


SELECT COUNT(*) cnt FROM users WHERE username = 'wgallios'

SELECT id, albumName AS `name`, 1 AS `type`
FROM photoAlbums
WHERE `deleted` = 0
ORDER BY name


SELECT * FROM codes;

DROP TABLE IF EXISTS `albumPhotos`;

CREATE TABLE `albumPhotos` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `datestamp` datetime DEFAULT NULL,
    `albumId` INT(10) UNSIGNED DEFAULT NULL,
    `file` varchar(250) DEFAULT NULL,
    `caption` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


ALTER TABLE settings ADD profilePicture VARCHAR(300);

ALTER TABLE users DROP COLUMN profilePicture;



SELECT * FROM settings;
