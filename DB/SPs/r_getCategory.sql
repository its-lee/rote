DELIMITER $$
DROP PROCEDURE IF EXISTS `r_getCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_getCategory`(
	in _id int
	)
BEGIN
	
    select * from note_category
    where (_id is null or _id = id);
    
END$$
DELIMITER ;
