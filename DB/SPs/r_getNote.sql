DELIMITER $$
DROP PROCEDURE IF EXISTS `r_getNote`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `r_getNote`(
	in _id int,
	in _offset bigint unsigned, 
	in _limit bigint unsigned,
	in _category_id int,
	in _title varchar(255)
	)
BEGIN
	
	set _offset = coalesce(_offset, 0);
	set _limit = coalesce(_limit, 18446744073709551615);
	
	select
		n.*,
		nc.name as category_name
	from note n
	inner join note_category nc
	on n.category_id = nc.id
	where
		(_id is null or n.id = _id) and
		(_category_id is null or n.category_id = _category_id) and
		(_title is null or n.title like concat('%', _title, '%'))
	order by n.when_updated desc
	limit _offset, _limit;
	
END$$
DELIMITER ;
