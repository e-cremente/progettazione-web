USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdEquipaggiamento;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdEquipaggiamento`(
pIdPersonaggio int(11) ,
pEquipaggiamento text
)
UpdEquipaggiamento: BEGIN
    
        UPDATE personaggi
           SET Equipaggiamento = pEquipaggiamento
         WHERE idPersonaggio = pIdPersonaggio;

end
//