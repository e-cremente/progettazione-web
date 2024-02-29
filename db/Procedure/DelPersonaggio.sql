USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPersonaggio;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPersonaggio`(
pIdPersonaggio int(11) 
)
DelPersonaggio: BEGIN
    
        DELETE FROM pg_abilita
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_abilitadiclasse
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_abilitadirazza
         WHERE idPersonaggio = pIdPersonaggio;
        
        DELETE FROM pg_abilitaladri
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_arma
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_armatura
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_incantesimi
         WHERE idPersonaggio = pIdPersonaggio;
        
        DELETE FROM pg_moneta
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_proficienze
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_proficienzearmi
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_stilicombattimento
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_svantaggi
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_tirosalv_mod
         WHERE idPersonaggio = pIdPersonaggio;
         
        DELETE FROM pg_tratti
         WHERE idPersonaggio = pIdPersonaggio;
             
        DELETE FROM personaggi
         WHERE idPersonaggio = pIdPersonaggio;
         
end
//