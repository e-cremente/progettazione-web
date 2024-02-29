USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelArma;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelArma`(
pIdPersonaggio int(11) ,
pIdArma int
)
DelArma: BEGIN
    
        DELETE FROM pg_arma
         WHERE idPersonaggio = pIdPersonaggio
             AND idArma = pIdArma;

end
//