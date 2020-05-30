DELIMITER $$
DROP PROCEDURE IF EXISTS `r_deleteCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_deleteCategory`(
    in _id int
    )
BEGIN
    
    delete from note_category where id = _id;
    
END$$
DELIMITER ;
