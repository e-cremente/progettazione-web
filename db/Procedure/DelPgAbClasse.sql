USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPgAbClasse;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPgAbClasse`(
pIdPersonaggio int(11) ,
pIdAbClasse int
)
DelPgAbClasse: BEGIN
    
        DELETE FROM pg_abilitadiclasse
         WHERE idPersonaggio = pIdPersonaggio
             AND idAbilitadiclasse = pIdAbClasse;

end
//