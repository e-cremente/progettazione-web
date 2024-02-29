USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsSvantaggio;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsSvantaggio
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsSvantaggio(
pIdPersonaggio int(11),
pIdSvantaggio int
) RETURNS varchar(5)
--
ChkInsSvantaggio:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdSvantaggio int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idSvantaggio
      into lvIdPersonaggio, lvIdSvantaggio
      from pg_svantaggi
     where idPersonaggio = pIdPersonaggio
         and idSvantaggio = pIdSvantaggio;
    --
    if lvRecNotFound = 1 then
        insert into pg_svantaggi (
            idPersonaggio, idSvantaggio
        ) VALUES (
            pIdPersonaggio, pIdSvantaggio
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;