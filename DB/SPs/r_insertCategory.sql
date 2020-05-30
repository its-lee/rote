DELIMITER $$
DROP PROCEDURE IF EXISTS `r_insertCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_insertCategory`(
    in _name varchar(45),
    in _description varchar(255)
    )
BEGIN
    
    insert into note_category (
        name, 
        description
    ) values (
        _name, 
        _description
    );
    
    select * 
    from note_category
    where id = last_insert_id();
    
END$$
DELIMITER ;
