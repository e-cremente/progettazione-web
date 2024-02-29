USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.UpdPgArma;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdPgArma`(
pIdPersonaggio int(11) ,
pIdArma int,
pAtkRound int,
pModAtkDanno varchar(8),
pThaco int,
pRaggio int
)
UpdPgArma: BEGIN
    
        UPDATE pg_arma
           SET AtkRound = pAtkRound,
               ModAtkDanno = pModAtkDanno,
               Thaco = pThaco,
               Raggio = pRaggio
         WHERE idPersonaggio = pIdPersonaggio
             AND idArma = pIdArma;

end
//