USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgProficienza;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgProficienza`(
pIdPersonaggio int(11) ,
pIdProficienza int
)
DelPgProficienza: BEGIN
    
        DELETE FROM pg_proficienze
         WHERE idPersonaggio = pIdPersonaggio
             AND idProficienza = pIdProficienza;

end
//