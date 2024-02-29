USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.GetMenu;

delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMenu`(
pUsername varchar(32)
)
GetMenu: BEGIN
    SELECT vm.VociMenuId as Id,
           vm.Lingua,
           tl.Testo,
           vm.idpadre,
           vm.Azione
      FROM vocimenu vm
           INNER JOIN testoelingua tl ON (
               tl.idOggetto = vm.VociMenuId
               AND tl.Lingua = vm.Lingua
           )
     WHERE vm.VociMenuId not between 100500 and 100699
    UNION
    SELECT vm.VociMenuId as Id,
           vm.Lingua,
           tl.Testo,
           vm.idpadre,
           vm.Azione
      FROM vocimenu vm
           INNER JOIN testoelingua tl ON (
               tl.idOggetto = vm.VociMenuId
               AND tl.Lingua = vm.Lingua
           )
     WHERE vm.VociMenuId = 100500
       and pUsername is not null
    UNION
    select 100500+IdPersonaggio Id,
           'it' lingua,
           concat(idPersonaggio, ': ', p.Nome, ',  ', r.Nome, ',  ', c.Nome, ', Lvl ', p.Livello) Testo,
           100500 idPadre,
           concat('CreaNuovoPersonaggio.php?idPersonaggio=',IdPersonaggio) Azione
      from utenti u
           inner join personaggi p on (
               p.creatore = u.username
           )
           inner join razza r on (
               r.idRazza = p.Razza
           )
           inner join classe c on (
               c.idClasse = p.Classe
           )
     where username = coalesce(pUsername, 'NESSUNO')
    ;
END
//
