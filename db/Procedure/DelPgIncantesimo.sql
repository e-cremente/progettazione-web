USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgIncantesimo;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgIncantesimo`(
pIdPersonaggio int(11) ,
pNomeIncantesimo varchar(45)
)
DelPgIncantesimo: BEGIN
    
        DELETE FROM pg_incantesimi
         WHERE idPersonaggio = pIdPersonaggio
             AND Nome = pNomeIncantesimo;

end
//