USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgAbRazza;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgAbRazza`(
pIdPersonaggio int(11) ,
pIdAbRazza int
)
DelPgAbRazza: BEGIN
    
        DELETE FROM pg_abilitadirazza
         WHERE idPersonaggio = pIdPersonaggio
             AND idAbilitadirazza = pIdAbRazza;

end
//