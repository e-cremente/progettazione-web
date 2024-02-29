USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgTratto;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgTratto`(
pIdPersonaggio int(11) ,
pIdTratto int
)
DelPgTratto: BEGIN
    
        DELETE FROM pg_tratti
         WHERE idPersonaggio = pIdPersonaggio
             AND idTratto = pIdTratto;

end
//