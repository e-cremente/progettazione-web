USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelArmaProf;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelArmaProf`(
pIdPersonaggio int(11) ,
pIdArma int
)
DelArmaProf: BEGIN
    
        DELETE FROM pg_proficienzearmi
         WHERE idPersonaggio = pIdPersonaggio
             AND idArma = pIdArma;

end
//