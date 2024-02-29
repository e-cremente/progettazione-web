USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdPuntiFerita;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdPuntiFerita`(
pIdPersonaggio int(11) ,
pPuntiFerita int,
pFerite int
)
UpdPuntiFerita: BEGIN
    
        UPDATE personaggi
           SET MaxPuntiFerita = pPuntiFerita,
               Ferite = pFerite
         WHERE idPersonaggio = pIdPersonaggio;

end
//