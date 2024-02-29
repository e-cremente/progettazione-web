USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsArma;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsArma
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsArma(
pIdPersonaggio int(11),
pIdArma int
) RETURNS varchar(5)
--
ChkInsArma:BEGIN
    DECLARE lvIdPersonaggio int(11);
    DECLARE lvIdArma int;
    DECLARE Result varchar(5);
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    SET Result = 'false';
    --
    select idPersonaggio, idArma
      into lvIdPersonaggio, lvIdArma
      from pg_arma
     where idPersonaggio = pIdPersonaggio
         and idArma = pIdArma;
    --
    if lvRecNotFound = 1 then
        insert into pg_arma (
            idPersonaggio, idArma
        ) VALUES (
            pIdPersonaggio, pIdArma
        );
        --
        SET Result = 'true';
    end if;
    --
    return Result;
END
//
DELIMITER ;
