USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelProfilo;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelProfilo`(
pUser varchar(32) 
)
DelProfilo: BEGIN
    
        DECLARE lvIdPersonaggio INT;
        DECLARE done INT DEFAULT FALSE;
        DECLARE cursor_i CURSOR FOR SELECT idPersonaggio FROM personaggi WHERE Creatore = pUser;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
        
        OPEN cursor_i;
        
        loop_personaggi: LOOP
            FETCH cursor_i INTO lvIdPersonaggio;
            
            IF done THEN   
                LEAVE loop_personaggi;
            END IF;
            
            CALL DelPersonaggio(lvIdPersonaggio);
        
        END LOOP;
        
        CLOSE cursor_i;
        
        DELETE FROM utenti WHERE Username = pUser;
         
end
//