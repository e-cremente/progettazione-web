USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.InsUpdCaratteristica;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsUpdCaratteristica`(
pIdPersonaggio int(11) ,
pIdAbilita int,
pVal_Abilita varchar(16),
pVal_Skill1 int,
pVal_Skill2 int
)
InsUpdCaratteristica: BEGIN
    DECLARE DUPLICATED_KEY CONDITION FOR 1062;
    DECLARE lvDuplicatedKey int default 0;
    DECLARE CONTINUE HANDLER FOR DUPLICATED_KEY set lvDuplicatedKey = 1;
--
    INSERT INTO pg_abilita (
        idPersonaggio, idAbilita, Val_Abilita, Val_Skill1, Val_Skill2
    ) VALUES (
        pIdPersonaggio, pIdAbilita, pVal_Abilita, pVal_Skill1, pVal_Skill2
    );
    --
    if lvDuplicatedKey = 1 then
        UPDATE pg_abilita
           SET Val_Abilita = pVal_Abilita,
               Val_Skill1 = pVal_Skill1,
               Val_Skill2 = pVal_Skill2
         WHERE idPersonaggio = pIdPersonaggio
           AND idAbilita = pIdAbilita;
    end if;
end
//
delimiter ;