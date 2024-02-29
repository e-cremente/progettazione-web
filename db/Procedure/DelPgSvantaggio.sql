USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgSvantaggio;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgSvantaggio`(
pIdPersonaggio int(11) ,
pIdSvantaggio int
)
DelPgSvantaggio: BEGIN
    
        DELETE FROM pg_svantaggi
         WHERE idPersonaggio = pIdPersonaggio
             AND idSvantaggio = pIdSvantaggio;

end
//