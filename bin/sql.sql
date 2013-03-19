
SHOW DATABASES;

SHOW TABLES;

EXPLAIN users;

EXPLAIN settings;

EXPLAIN photoAlbums;


UPDATE users SET passwd = SHA1('') WHERE id =

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

SELECT * FROM photoAlbums


DROP TABLE IF EXISTS `albumPhotos`;

CREATE TABLE `albumPhotos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datestamp` datetime DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `caption` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

