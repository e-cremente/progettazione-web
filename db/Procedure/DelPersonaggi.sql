USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DelPersonaggi;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelPersonaggi`(
pIdPersonaggioIni int ,
pIdPersonaggioFin int
)
DelPersonaggi: BEGIN
declare i int;

set i = pIdPersonaggioIni;

ciclo: LOOP
    call DelPersonaggio(i);
    if i < pIdPersonaggioFin then
        set i = i+1;
        iterate ciclo;
    end if;
    leave ciclo;
END LOOP ciclo;

end
//