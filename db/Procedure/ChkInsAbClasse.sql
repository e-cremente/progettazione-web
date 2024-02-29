USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsAbClasse;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsAbClasse
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsAbClasse(
pIdPersonaggio int(11),
pIdAbClasse int
) RETURNS varchar(5)
--
ChkInsAbClasse:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdAbClasse int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idAbilitadiclasse
      into lvIdPersonaggio, lvIdAbClasse
      from pg_abilitadiclasse
     where idPersonaggio = pIdPersonaggio
         and idAbilitadiclasse = pIdAbClasse;
    --
    if lvRecNotFound = 1 then
        insert into pg_abilitadiclasse (
            idPersonaggio, idAbilitadiclasse
        ) VALUES (
            pIdPersonaggio, pIdAbClasse
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;