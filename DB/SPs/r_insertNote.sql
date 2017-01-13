DELIMITER $$
DROP PROCEDURE IF EXISTS `r_insertNote`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_insertNote`(
	in _title varchar(255), 
	in _content longtext,
	in _category_id int
	)
BEGIN
	
    insert into note (
        title, 
        content, 
        category_id
    ) values (
        _title,
        _content, 
        _category_id
    );
    
    select * 
    from note
    where id = last_insert_id();
	
END$$
DELIMITER ;
