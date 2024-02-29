USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.InsUpdAbilitaDeiLadri;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsUpdAbilitaDeiLadri`(
pIdPersonaggio int(11) ,
pIdAbilitaladri int,
pBase int,
pRazza int,
pDestr int,
pArm int,
pTratti int,
pOggetti int,
pLivello int,
pSpeciale int
)
InsUpdAbilitaDeiLadri: BEGIN
    DECLARE DUPLICATED_KEY CONDITION FOR 1062;
    DECLARE lvDuplicatedKey int default 0;
    DECLARE CONTINUE HANDLER FOR DUPLICATED_KEY set lvDuplicatedKey = 1;
--
    INSERT INTO pg_abilitaladri(
        idPersonaggio, idAbilitaladri, Base, Razza, Destrezza, Armatura, Tratti, Oggetti, Livello, Speciale
    ) VALUES (
        pIdPersonaggio, pIdAbilitaladri, pBase, pRazza, pDestr, pArm, pTratti, pOggetti, pLivello, pSpeciale
    );
    --
    if lvDuplicatedKey = 1 then
        UPDATE pg_abilitaladri
           SET Base = pBase,
                     Razza = pRazza,
                     Destrezza = pDestr,
                     Armatura = pArm,
                     Tratti = pTratti,
                     Oggetti = pOggetti,
                     Livello = pLivello,
                     Speciale = pSpeciale
         WHERE idPersonaggio = pIdPersonaggio
           AND idAbilitaladri = pIdAbilitaladri;
    end if;
end
//
delimiter ;