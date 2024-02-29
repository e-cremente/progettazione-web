USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.EliminaPersonaggio;

delimiter //
CREATE DEFINER=root@localhost PROCEDURE EliminaPersonaggio(
pIdPersonaggio int
)
--
EliminaPersonaggio:BEGIN
    DECLARE PERSONAGGIO_INESISTENTE CONDITION FOR SQLSTATE '45000';
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
/*    if EsistePersonaggio(pIdPersonaggio) = 'N' then
        SIGNAL PERSONAGGIO_INESISTENTE SET MESSAGE_TEXT = 'Personaggio inesistente';
    end if;*/
    -- Eliminiamo abilita
    delete from pg_abilita
     where IdPersonaggio = pIdPersonaggio;
    -- Eliminiamo i tiri salvezza
    delete from pg_tirosalv_mod
     where IdPersonaggio = pIdPersonaggio;
    -- Elimiamo il personaggio
    delete from personaggi
     where IdPersonaggio = pIdPersonaggio;
 END
//
DELIMITER ;
