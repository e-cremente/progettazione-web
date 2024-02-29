USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.writeLog;

delimiter //
CREATE PROCEDURE writeLog(
pNomeFunzione varchar(64) ,
pMessaggio varchar(1024)
)
--
writeLog: BEGIN
--
    INSERT INTO logtable (
        nomefunzione, messaggio
    ) VALUES (
        pNomeFunzione, pMessaggio
    );
end
//
DELIMITER ;
