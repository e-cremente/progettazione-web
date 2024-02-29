USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsProficienza;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsProficienza
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsProficienza(
pIdPersonaggio int(11),
pIdProficienza int,
pValore int
) RETURNS varchar(5)
--
ChkInsProficienza:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdProficienza int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idProficienza
      into lvIdPersonaggio, lvIdProficienza
      from pg_proficienze
     where idPersonaggio = pIdPersonaggio
         and idProficienza = pIdProficienza;
    --
    if lvRecNotFound = 1 then
        insert into pg_proficienze (
            idPersonaggio, idProficienza, Valore
        ) VALUES (
            pIdPersonaggio, pIdProficienza, pValore
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;