USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdPgSvantaggio;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdPgSvantaggio`(
pIdPersonaggio int(11) ,
pIdSvantaggio int,
pGrave tinyint
)
UpdPgSvantaggio: BEGIN
    
        UPDATE pg_svantaggi
           SET Grave = pGrave
         WHERE idPersonaggio = pIdPersonaggio
             AND idSvantaggio = pIdSvantaggio;

end
//