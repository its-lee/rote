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
    
    select
        n.*,
        nc.name as category_name
    from note n
    inner join note_category nc
    on n.category_id = nc.id
    where n.id = last_insert_id();
    
END$$
DELIMITER ;
