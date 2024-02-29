USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.InsUpdRicchezze;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsUpdRicchezze`(
pIdPersonaggio int(11) ,
pIdMoneta int,
pQuantita int
)
InsUpdRicchezze: BEGIN
    DECLARE DUPLICATED_KEY CONDITION FOR 1062;
    DECLARE lvDuplicatedKey int default 0;
    DECLARE CONTINUE HANDLER FOR DUPLICATED_KEY set lvDuplicatedKey = 1;
--
    INSERT INTO pg_moneta (
        idPersonaggio, idMoneta, Quantita
    ) VALUES (
        pIdPersonaggio, pIdMoneta, pQuantita
    );
    --
    if lvDuplicatedKey = 1 then
        UPDATE pg_moneta
           SET Quantita = pQuantita
         WHERE idPersonaggio = pIdPersonaggio
           AND idMoneta = pIdMoneta;
    end if;
end
//
delimiter ;