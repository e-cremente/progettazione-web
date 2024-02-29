USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdInfoGeneriche;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdInfoGeneriche`(
pIdPersonaggio int(11) ,
pPPRimanenti int,
pPuntiMagiaRimanenti int,
pPuntiMagiaTotali int,
pVelMovimento int 
)
UpdInfoGeneriche: BEGIN
    
        UPDATE personaggi
           SET PPRestanti = pPPRimanenti,
               PuntiMagiaRestanti = pPuntiMagiaRimanenti,
               PuntiMagiaTotali = pPuntiMagiaTotali,
               VelMovimento = pVelMovimento
         WHERE idPersonaggio = pIdPersonaggio;

end
//