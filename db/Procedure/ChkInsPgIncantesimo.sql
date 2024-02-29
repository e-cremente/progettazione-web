USE adndproject;

DROP FUNCTION IF EXISTS adndproject.ChkInsPgIncantesimo;

delimiter //

-- --------------------------------------------------------------------------------
-- ChkInsPgIncantesimo
-- --------------------------------------------------------------------------------

CREATE DEFINER=`root`@`localhost` FUNCTION ChkInsPgIncantesimo(
pIdPersonaggio int(11),
pNomeIncantesimo varchar(45),
pIdIncantesimo int,
pLivello int,
pComponenti varchar(16),
pDurata varchar(45),
pRaggio varchar(45),
pTiroSalvezza varchar(45),
pVelocita int,
pEffetto varchar(45)
) RETURNS int
--
ChkInsPgIncantesimo:BEGIN
    DECLARE lvIdIncantesimo int;
    DECLARE lvFlagEsiste varchar(1) default 'N';
    DECLARE lvRecNotFound int default 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvRecNotFound = 1;
    --
    select idIncantesimo
      into lvIdIncantesimo
      from incantesimi
     where NomeIncantesimo = pNomeIncantesimo;
    --
    if lvRecNotFound = 1 then
        set lvIdIncantesimo = getNewIdIncantesimo();
        insert into incantesimi(
            NomeIncantesimo, idIncantesimo
        ) VALUES (
            pNomeIncantesimo, lvIdIncantesimo
        );
        --
    end if;
    -- qui lvIdIncantesimo è diverso da null
    set lvRecNotFound = 0;
    --
    select 'S' into lvFlagEsiste
        from pg_incantesimi
     where idPersonaggio = pIdPersonaggio
         and Nome = pNomeIncantesimo;
    --
    if pIdIncantesimo is null and lvFlagEsiste = 'N' then
        insert into pg_incantesimi(
                idPersonaggio, Nome, Livello, Componenti, Durata, Raggio, TiroSalvezza, Velocita, Effetto
            ) VALUES (
                pIdPersonaggio, pNomeIncantesimo, pLivello, pComponenti, pDurata, pRaggio, pTiroSalvezza, pVelocita, pEffetto
            );
        return lvIdIncantesimo;
    elseif pIdIncantesimo is null and lvFlagEsiste = 'S' then
        return null;
    elseif pIdIncantesimo is not null and lvFlagEsiste = 'N' then
        if pIdIncantesimo <> lvIdIncantesimo then return null; end if;
        insert into pg_incantesimi(
                idPersonaggio, Nome, Livello, Componenti, Durata, Raggio, TiroSalvezza, Velocita, Effetto
            ) VALUES (
                pIdPersonaggio, pNomeIncantesimo, pLivello, pComponenti, pDurata, pRaggio, pTiroSalvezza, pVelocita, pEffetto
            );
        return lvIdIncantesimo;
    elseif pIdIncantesimo is not null and lvFlagEsiste = 'S' then
        update pg_incantesimi 
        set Livello = pLivello,
            Componenti = pComponenti,
            Durata = pDurata,
            Raggio = pRaggio,
            TiroSalvezza = pTiroSalvezza,
            Velocita = pVelocita,
            Effetto = pEffetto
        where idPersonaggio = pIdPersonaggio
           and Nome = pNomeIncantesimo;
        return lvIdIncantesimo;
    end if;
    --
    return null;
END
//
DELIMITER ;