
SHOW DATABASES;

SHOW TABLES;

EXPLAIN users;

EXPLAIN settings;


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
