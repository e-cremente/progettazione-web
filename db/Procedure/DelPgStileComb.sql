USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgStileComb;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgStileComb`(
pIdPersonaggio int(11) ,
pIdStile int
)
DelPgStileComb: BEGIN
    
        DELETE FROM pg_stilicombattimento
         WHERE idPersonaggio = pIdPersonaggio
             AND idStile = pIdStile;

end
//