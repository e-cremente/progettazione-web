USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.InsUpdTiroSalvezza;

delimiter //
-- --------------------------------------------------------------------------------
-- InsUpdTiroSalvezza
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsUpdTiroSalvezza`(
pIdPersonaggio int(11) ,
pIdTiroSalvezza int,
pModificatore varchar(8)
)
InsUpdTiroSalvezza: BEGIN
    DECLARE DUPLICATED_KEY CONDITION FOR 1062;
    DECLARE lvDuplicatedKey int default 0;
    DECLARE CONTINUE HANDLER FOR DUPLICATED_KEY set lvDuplicatedKey = 1;
--
    INSERT INTO pg_tirosalv_mod (
        idPersonaggio, idTiroSalvezza, Modificatore
    ) VALUES (
        pIdPersonaggio, pIdTiroSalvezza, pModificatore
    );
    --
    if lvDuplicatedKey = 1 then
        UPDATE pg_tirosalv_mod
           SET Modificatore = pModificatore
         WHERE idPersonaggio = pIdPersonaggio
           AND idTiroSalvezza = pIdTiroSalvezza;
    end if;
end
//
delimiter ;