DELIMITER $$

CREATE
    FUNCTION `codeDislay`(iGroup INT UNSIGNED, iCode INT UNSIGNED)
            RETURNS VARCHAR(300)
BEGIN
DECLARE returnDisplay VARCHAR(300);
    
SELECT display FROM codes WHERE `group` = iGroup AND `code` = iCode INTO returnDisplay;
    
RETURN returnDisplay;
END$$

DELIMITER ;
