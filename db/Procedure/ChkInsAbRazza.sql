USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsAbRazza;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsAbRazza
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsAbRazza(
pIdPersonaggio int(11),
pIdAbRazza int
) RETURNS varchar(5)
--
ChkInsAbRazza:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdAbRazza int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idAbilitadirazza
      into lvIdPersonaggio, lvIdAbRazza
      from pg_abilitadirazza
     where idPersonaggio = pIdPersonaggio
         and idAbilitadirazza = pIdAbRazza;
    --
    if lvRecNotFound = 1 then
        insert into pg_abilitadirazza (
            idPersonaggio, idAbilitadirazza
        ) VALUES (
            pIdPersonaggio, pIdAbRazza
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;