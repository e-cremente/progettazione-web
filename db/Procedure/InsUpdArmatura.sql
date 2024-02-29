USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.InsUpdArmatura;

delimiter //

-- --------------------------------------------------------------------------------
-- InsUpdArmatura
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsUpdArmatura`(
pIdPersonaggio int(11) ,
pIdArmatura int,
pCA int,
pSorpreso int,
pSenzaScudo int,
pAlleSpalle int,
pIncantesimi int,
pDifese varchar(2048)
)
InsUpdArmatura: BEGIN
    DECLARE lvDuplicatedKey int;
    
    set lvDuplicatedKey = (select count(*)
    from pg_armatura 
    where idPersonaggio = pIdPersonaggio);
--
     if lvDuplicatedKey = 1 then
        UPDATE pg_armatura
           SET CA = pCA,
               Sorpreso = pSorpreso,
               SenzaScudo = pSenzaScudo,
               AlleSpalle = pAlleSpalle,
               Incantesimi = pIncantesimi,
               Difese = pDifese
         WHERE idPersonaggio = pIdPersonaggio;
    else
    INSERT INTO pg_armatura (
        idPersonaggio, idArmatura, CA, Sorpreso, SenzaScudo, AlleSpalle, Incantesimi, Difese
    ) VALUES (
        pIdPersonaggio, pIdArmatura, pCA, pSorpreso, pSenzaScudo, pAlleSpalle, pIncantesimi, pDifese
    );
end if;
end
//
delimiter ;