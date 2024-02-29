USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdPgStileComb;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdPgStileComb`(
pIdPersonaggio int(11) ,
pIdStile int,
pPP int,
pSpec tinyint
)
UpdPgStileComb: BEGIN
    
        UPDATE pg_stilicombattimento
           SET PP = pPP,
                     Specializzazione = pSpec
         WHERE idPersonaggio = pIdPersonaggio
             AND idStile = pIdStile;

end
//