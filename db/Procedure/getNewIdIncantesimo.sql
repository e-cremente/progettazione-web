USE adndproject;

DROP FUNCTION IF EXISTS adndproject.getNewIdIncantesimo;

delimiter //

-- --------------------------------------------------------------------------------
-- getNewIdIncantesimo
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION getNewIdIncantesimo(
) RETURNS int
--
getNewIdIncantesimo:BEGIN
    DECLARE Result int;
     --
    select coalesce(max(idIncantesimo), 0)  into Result
        from incantesimi;
    --
    set Result = Result + 1;
    --
    return Result;
END
//
DELIMITER ;