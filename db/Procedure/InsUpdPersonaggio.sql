USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.InsUpdPersonaggio;

delimiter //
CREATE PROCEDURE InsUpdPersonaggio(
pIdPersonaggio int(11) ,
pCreatore varchar(32),
pNome varchar(20),
pRazza int(11),
pClasse int(11),
pClassi_Secondarie varchar(45),
pAllineamento varchar(2),
pLivello int(11),
pLivelli_Secondari varchar(45),
pEsperienza int(11),
pOrigine varchar(45),
pFamiglia varchar(45),
pStirpe_Clan varchar(45),
pReligione varchar(45),
pClasse_Sociale varchar(45),
pFratelli_Sorelle varchar(45),
pSesso varchar(1),
pAnni int(11),
pAltezza int(11),
pPeso int(11),
pCapelli varchar(20),
pOcchi varchar(20),
pAspetto varchar(20)
)
--
InsUpdPersonaggio: BEGIN
    DECLARE DUPLICATED_KEY CONDITION FOR 1062;
    DECLARE lvDuplicatedKey int default 0;
    DECLARE CONTINUE HANDLER FOR DUPLICATED_KEY set lvDuplicatedKey = 1;
--
    INSERT INTO personaggi (
        idPersonaggio, Creatore, Nome, Razza, Classe, Classi_Secondarie,
        Allineamento, Livello, Livelli_Secondari, Esperienza, Origine, Famiglia,
        Stirpe_Clan, Religione, Classe_Sociale, Fratelli_Sorelle,
        Sesso, Anni, Altezza, Peso,
        Capelli, Occhi, Aspetto
    ) VALUES (
        pIdPersonaggio, pCreatore, pNome, pRazza, pClasse, pClassi_Secondarie,
        pAllineamento, pLivello, pLivelli_Secondari, pEsperienza, pOrigine, pFamiglia,
        pStirpe_Clan, pReligione, pClasse_Sociale, pFratelli_Sorelle,
        pSesso, pAnni, pAltezza, pPeso,
        pCapelli, pOcchi, pAspetto
    );
    --
    if lvDuplicatedKey = 1 then
        UPDATE personaggi
           SET Creatore=pCreatore,
               Nome = pNome,
               Razza = pRazza,
               Classe = pClasse,
               Classi_Secondarie = pClassi_Secondarie,
               Allineamento = pAllineamento,
               Livello = pLivello,
               Livelli_Secondari = pLivelli_Secondari,
               Esperienza = pEsperienza,
               Origine = pOrigine,
               Famiglia = pFamiglia,
               Stirpe_Clan = pStirpe_Clan,
               Religione = pReligione,
               Classe_Sociale = pClasse_Sociale,
               Fratelli_Sorelle = pFratelli_Sorelle,
               Sesso = pSesso,
               Anni = pAnni,
               Altezza = pAltezza,
               Peso = pPeso,
               Capelli = pCapelli,
               Occhi = pOcchi,
               Aspetto = pAspetto
         WHERE idPersonaggio = pIdPersonaggio;
    end if;
end
//
DELIMITER ;
