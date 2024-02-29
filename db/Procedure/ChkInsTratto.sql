USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsTratto;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsTratto
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsTratto(
pIdPersonaggio int(11),
pIdTratto int
) RETURNS varchar(5)
--
ChkInsTratto:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdTratto int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idTratto
      into lvIdPersonaggio, lvIdTratto
      from pg_tratti
     where idPersonaggio = pIdPersonaggio
         and idTratto = pIdTratto;
    --
    if lvRecNotFound = 1 then
        insert into pg_tratti (
            idPersonaggio, idTratto
        ) VALUES (
            pIdPersonaggio, pIdTratto
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;