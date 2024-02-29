USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdPgProficienza;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdPgProficienza`(
pIdPersonaggio int(11) ,
pIdProficienza int,
pValore int
)
UpdPgProficienza: BEGIN
    
        UPDATE pg_proficienze
           SET Valore = pValore
         WHERE idPersonaggio = pIdPersonaggio
             AND idProficienza = pIdProficienza;

end
//