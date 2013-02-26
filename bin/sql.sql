
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

