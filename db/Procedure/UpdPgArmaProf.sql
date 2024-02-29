USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdPgArmaProf;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdPgArmaProf`(
pIdPersonaggio int(11) ,
pIdArma int,
pPP int,
pScelta tinyint,
pEsperto tinyint,
pSpec tinyint,
pMaestro tinyint,
pAlto tinyint,
pGrande tinyint
)
UpdPgArmaProf: BEGIN
    
        UPDATE pg_proficienzearmi
           SET PP = pPP,
               Scelta = pScelta,
               Esperto = pEsperto,
               Specializzato = pSpec,
               Maestro = pMaestro,
               Alto = pAlto,
               Grande = pGrande
         WHERE idPersonaggio = pIdPersonaggio
             AND idArma = pIdArma;

end
//