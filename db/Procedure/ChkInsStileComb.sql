USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsStileComb;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsStileComb
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsStileComb(
pIdPersonaggio int(11),
pIdStile int
) RETURNS varchar(5)
--
ChkInsStileComb:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdStile int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idStile
      into lvIdPersonaggio, lvIdStile
      from pg_stilicombattimento
     where idPersonaggio = pIdPersonaggio
         and idStile = pIdStile;
    --
    if lvRecNotFound = 1 then
        insert into pg_stilicombattimento (
            idPersonaggio, idStile
        ) VALUES (
            pIdPersonaggio, pIdStile
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;