DELIMITER $$
DROP PROCEDURE IF EXISTS `r_updateCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_updateCategory`(
	in _id int,
    in _name varchar(45),
    in _description varchar(255)
	)
BEGIN
	
    update note_category set
        name = coalesce(_name, name),
        description = coalesce(_description, description),
        when_updated = now()
    where id = _id;
    
    select *
    from note_category
    where id = _id;
    
END$$
DELIMITER ;
