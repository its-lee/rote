DELIMITER $$
DROP PROCEDURE IF EXISTS `r_deleteNote`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_deleteNote`(
	in _id int
	)
BEGIN
	
    delete from note where id = _id;
    
END$$
DELIMITER ;
